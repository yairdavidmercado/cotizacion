<?php
session_start();
include 'conexion.php';

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
mysqli_set_charset($con, "utf8mb4");

if (mysqli_connect_errno()) {
  echo json_encode(["success" => false, "message" => "Failed to connect: " . mysqli_connect_error()]);
  exit;
}

header('Content-Type: application/json; charset=utf-8');

// 1) Leer JSON
$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

if (!is_array($data)) {
  echo json_encode(["success" => false, "message" => "JSON inválido o vacío"]);
  exit;
}

// 2) Validaciones mínimas del “principal”
$id_autor = isset($_SESSION['id']) ? (int)$_SESSION['id'] : 0;

$id_titular   = isset($data["id_titular"]) ? (int)$data["id_titular"] : 0;
$id_hotel     = isset($data["id_hotel"]) ? (int)$data["id_hotel"] : 0;
$cod_vendedor = isset($data["cod_vendedor"]) ? trim($data["cod_vendedor"]) : "";
$cotizaciones = isset($data["cotizaciones"]) ? $data["cotizaciones"] : [];

if ($id_titular <= 0) {
  echo json_encode(["success" => false, "message" => "id_titular requerido"]);
  exit;
}

if ($id_hotel <= 0) {
  echo json_encode(["success" => false, "message" => "id_hotel requerido"]);
  exit;
}

if ($cod_vendedor === "") {
  echo json_encode(["success" => false, "message" => "cod_vendedor requerido"]);
  exit;
}

if (!is_array($cotizaciones) || count($cotizaciones) === 0) {
  echo json_encode(["success" => false, "message" => "Debes enviar al menos una cotización en cotizaciones[]"]);
  exit;
}

// 3) Transacción
mysqli_begin_transaction($con);

try {

  // ====== A) INSERT TABLA PRINCIPAL (encabezado) ======
  // Sugerencia de tabla: cotizacion_master
  $sqlHeader = "INSERT INTO cotizacion_master (id_titular, id_hotel, cod_vendedor, id_autor)
                VALUES (?, ?, ?, ?)";

  $stmtHeader = mysqli_prepare($con, $sqlHeader);
  if (!$stmtHeader) throw new Exception("Prepare header failed: " . mysqli_error($con));

  mysqli_stmt_bind_param($stmtHeader, "iisi", $id_titular, $id_hotel, $cod_vendedor, $id_autor);
  if (!mysqli_stmt_execute($stmtHeader)) throw new Exception("Execute header failed: " . mysqli_stmt_error($stmtHeader));

  $id_principal = mysqli_insert_id($con);
  mysqli_stmt_close($stmtHeader);

  // ====== B) INSERT DETALLE(S) ======
  // Aquí puedes:
  // - (1) reutilizar tu tabla actual "cotizacion" agregándole columna id_principal
  // o
  // - (2) crear una nueva "cotizacion_detalle"
  //
  // Yo asumo que vas a agregar id_principal a la tabla cotizacion actual.
  $sqlDetalle = "INSERT INTO cotizacion (
      id_principal,
      cod_vendedor, n_infante, n_child, n_adult_s, n_adult_d, n_adult_t_c,
      id_titular, id_hotel, id_terminos, id_tarifa, id_plan, id_motivo,
      noche, acomodo, fecha_entrada, fecha_salida, id_autor, tipo_cotizacion
    ) VALUES (
      ?, ?, ?, ?, ?, ?, ?,
      ?, ?, ?, ?, ?, ?,
      ?, ?, ?, ?, ?, ?
    )";

  $stmtDet = mysqli_prepare($con, $sqlDetalle);
  if (!$stmtDet) throw new Exception("Prepare detalle failed: " . mysqli_error($con));

  $ids_detalle = [];

  foreach ($cotizaciones as $c) {

    // Validaciones por item (ajusta a tu lógica)
    $tipo_cotizacion = isset($c["tipo_cotizacion"]) ? (int)$c["tipo_cotizacion"] : 0;

    $n_infante   = isset($c["n_infante"]) ? (int)$c["n_infante"] : 0;
    $n_child     = isset($c["n_child"]) ? (int)$c["n_child"] : 0;
    $n_adult_s   = isset($c["n_adult_s"]) ? (int)$c["n_adult_s"] : 0;
    $n_adult_d   = isset($c["n_adult_d"]) ? (int)$c["n_adult_d"] : 0;
    $n_adult_t_c = isset($c["n_adult_t_c"]) ? (int)$c["n_adult_t_c"] : 0;

    $id_terminos = isset($c["id_terminos"]) ? (int)$c["id_terminos"] : 0;
    $id_tarifa   = isset($c["id_tarifa"]) ? (int)$c["id_tarifa"] : 0;
    $id_plan     = isset($c["id_plan"]) ? (int)$c["id_plan"] : 0;
    $id_motivo   = isset($c["id_motivo"]) ? (int)$c["id_motivo"] : 0;

    $noche = isset($c["noche"]) ? $c["noche"] : 0; // puede ser "N/A"
    if ($noche === "N/A") $noche = 0;
    $noche = (int)$noche;

    $acomodo = isset($c["acomodo"]) ? (string)$c["acomodo"] : "";

    $fecha_entrada = isset($c["fecha_entrada"]) ? (string)$c["fecha_entrada"] : "";
    $fecha_salida  = isset($c["fecha_salida"]) ? (string)$c["fecha_salida"] : "";

    // Bind (ojo con los tipos)
    mysqli_stmt_bind_param(
      $stmtDet,
      "isiiiiiiiiiiiisssii",
      $id_principal,
      $cod_vendedor,
      $n_infante,
      $n_child,
      $n_adult_s,
      $n_adult_d,
      $n_adult_t_c,
      $id_titular,
      $id_hotel,
      $id_terminos,
      $id_tarifa,
      $id_plan,
      $id_motivo,
      $noche,
      $acomodo,
      $fecha_entrada,
      $fecha_salida,
      $id_autor,
      $tipo_cotizacion
    );

    if (!mysqli_stmt_execute($stmtDet)) {
      throw new Exception("Execute detalle failed: " . mysqli_stmt_error($stmtDet));
    }

    $ids_detalle[] = mysqli_insert_id($con);
  }

  mysqli_stmt_close($stmtDet);

  // 4) Commit
  mysqli_commit($con);

  error_log("guardar_cotizacion - Guardado exitoso: id_principal=$id_principal, ids_detalle=" . json_encode($ids_detalle));

  echo json_encode([
    "success" => true,
    "message" => "OK",
    "id_principal" => $id_principal,
    "ids_detalle" => $ids_detalle
  ]);

} catch (Exception $e) {
  mysqli_rollback($con);
  echo json_encode([
    "success" => false,
    "message" => $e->getMessage()
  ]);
}

mysqli_close($con);