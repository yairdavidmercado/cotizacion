<?php
session_start();
include 'conexion.php';

$id_cotizacion = isset($_POST["id_cotizacion"]) ? intval($_POST["id_cotizacion"]) : 0;
$deposito_raw = isset($_POST["deposito"]) ? $_POST["deposito"] : "0";
$id_hotel = isset($_POST["id_hotel"]) ? intval($_POST["id_hotel"]) : 0;
$id_autor = isset($_SESSION['id']) ? intval($_SESSION['id']) : 0;
$reserva_input = isset($_POST["id_reserva"]) ? trim($_POST["id_reserva"]) : "";

$response = [];
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (mysqli_connect_errno()) {
    echo json_encode([
        "success" => false,
        "message" => "Failed to connect to MySQL: " . mysqli_connect_error()
    ]);
    exit;
}

try {
    $deposito = intval(preg_replace('/\D/', '', (string)$deposito_raw));
    if ($id_cotizacion <= 0) {
        throw new Exception("Cotización inválida");
    }
    if ($deposito <= 0) {
        throw new Exception("El monto del voucher debe ser mayor a 0");
    }

    $count_stmt = mysqli_prepare($con, "SELECT COUNT(*) FROM vaucher WHERE id_cotizacion = ? AND activo = 1");
    mysqli_stmt_bind_param($count_stmt, "i", $id_cotizacion);
    mysqli_stmt_execute($count_stmt);
    mysqli_stmt_bind_result($count_stmt, $total_abonos_actuales);
    mysqli_stmt_fetch($count_stmt);
    mysqli_stmt_close($count_stmt);

    $es_primer_abono = intval($total_abonos_actuales) === 0;
    $reserva = $es_primer_abono ? $reserva_input : "";

    if ($es_primer_abono && $reserva === "") {
        throw new Exception("Debes ingresar número de reserva para el primer abono");
    }

    $codigo = "";
    $id_metodo_pago = 0;

    $stmt = mysqli_prepare($con, "INSERT INTO vaucher (id_cotizacion, codigo, deposito, id_metodo_pago, id_hotel, id_autor, reserva) VALUES (?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "isdiiis", $id_cotizacion, $codigo, $deposito, $id_metodo_pago, $id_hotel, $id_autor, $reserva);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        $response["success"] = true;
        $response["id"] = mysqli_insert_id($con);
        $response["message"] = "Voucher guardado correctamente";
    } else {
        $response["success"] = false;
        $response["id"] = 0;
        $response["message"] = "No se pudo guardar el voucher";
    }

    mysqli_stmt_close($stmt);
    echo json_encode($response);
} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}

mysqli_close($con);
?>
