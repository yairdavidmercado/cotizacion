<?php
session_start();
include '../conexion.php';

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$con) {
    http_response_code(500);
    echo 'Error de conexión a base de datos';
    exit;
}

$id_hotel = isset($_SESSION['id_hotel']) ? intval($_SESSION['id_hotel']) : 0;
$id_autor = isset($_SESSION['id']) ? intval($_SESSION['id']) : 0;
$id_perfil = isset($_SESSION['perfil']) ? $_SESSION['perfil'] : '';
$nombre_hotel = isset($_SESSION['nombre_hotel']) ? $_SESSION['nombre_hotel'] : 'EMPRESA NO ENCONTRADA';

$tipo_fecha = isset($_GET['tipo_fecha']) ? trim($_GET['tipo_fecha']) : 'fecha_expedicion';
$fecha_inicio = isset($_GET['fecha_inicio']) ? trim($_GET['fecha_inicio']) : '';
$fecha_fin = isset($_GET['fecha_fin']) ? trim($_GET['fecha_fin']) : '';

$columnas_fecha = array(
    'fecha_expedicion' => 'c.fecha_expedicion',
    'fecha_checkin' => 'c.fecha_entrada',
    'fecha_checkout' => 'c.fecha_salida'
);

if (!isset($columnas_fecha[$tipo_fecha])) {
    http_response_code(400);
    echo 'Tipo de fecha inválido';
    exit;
}

if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha_inicio) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha_fin)) {
    http_response_code(400);
    echo 'Rango de fecha inválido';
    exit;
}

if ($fecha_inicio > $fecha_fin) {
    http_response_code(400);
    echo 'La fecha inicio no puede ser mayor a fecha fin';
    exit;
}

function filterData(&$str) {
    $str = (string)$str;
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"')) {
        $str = '"' . str_replace('"', '""', $str) . '"';
    }
}

$columna_fecha_sql = $columnas_fecha[$tipo_fecha];
$filtro_autor = '';
if ($id_perfil !== 'SUPERADMIN') {
    $filtro_autor = ' AND cm.id_autor = ? ';
}

$sql = "
SELECT
    cm.id AS id_master,
    CONCAT_WS(' ', u.nombre1, u.nombre2, u.apellido1, u.apellido2) AS cliente,
    c.id AS id_cotizacion,
    DATE(c.fecha_expedicion) AS fecha_expedicion,
    DATE(c.fecha_entrada) AS fecha_checkin,
    DATE(c.fecha_salida) AS fecha_checkout,
    c.tipo_cotizacion,
    COALESCE(v.reserva, '') AS reserva,
    (
        (
            COALESCE(c.n_child, 0) * COALESCE(t.child, 0) +
            COALESCE(c.n_adult_s, 0) * COALESCE(t.adult_s, 0) +
            COALESCE(c.n_adult_d, 0) * COALESCE(t.adult_d, 0) +
            COALESCE(c.n_adult_t_c, 0) * COALESCE(t.adult_t_c, 0)
        ) *
        (
            CASE
                WHEN c.noche IS NULL OR c.noche = '' OR c.noche = 'N/A' OR c.noche = 0 THEN 1
                WHEN c.noche REGEXP '^[0-9]+$' THEN CAST(c.noche AS UNSIGNED)
                ELSE 1
            END
        )
    ) AS total_cotizacion,
    COALESCE(v.total_abono, 0) AS total_abono,
    (
        (
            (
                COALESCE(c.n_child, 0) * COALESCE(t.child, 0) +
                COALESCE(c.n_adult_s, 0) * COALESCE(t.adult_s, 0) +
                COALESCE(c.n_adult_d, 0) * COALESCE(t.adult_d, 0) +
                COALESCE(c.n_adult_t_c, 0) * COALESCE(t.adult_t_c, 0)
            ) *
            (
                CASE
                    WHEN c.noche IS NULL OR c.noche = '' OR c.noche = 'N/A' OR c.noche = 0 THEN 1
                    WHEN c.noche REGEXP '^[0-9]+$' THEN CAST(c.noche AS UNSIGNED)
                    ELSE 1
                END
            )
        ) - COALESCE(v.total_abono, 0)
    ) AS saldo_pendiente
FROM cotizacion_master cm
INNER JOIN cotizacion c ON c.id_principal = cm.id AND c.activo = 1
LEFT JOIN usuarios u ON u.id = cm.id_titular
LEFT JOIN tarifas t ON t.id = c.id_tarifa
LEFT JOIN (
    SELECT id_cotizacion, SUM(COALESCE(deposito, 0)) AS total_abono, MAX(COALESCE(reserva, '')) AS reserva
    FROM vaucher
    WHERE activo = 1
    GROUP BY id_cotizacion
) v ON v.id_cotizacion = c.id
WHERE cm.id_hotel = ?
  AND DATE($columna_fecha_sql) BETWEEN ? AND ?
  $filtro_autor
ORDER BY cm.id DESC, c.id ASC
";

$stmt = mysqli_prepare($con, $sql);
if (!$stmt) {
    http_response_code(500);
    echo 'No se pudo preparar el reporte';
    exit;
}

if ($id_perfil !== 'SUPERADMIN') {
    mysqli_stmt_bind_param($stmt, 'issi', $id_hotel, $fecha_inicio, $fecha_fin, $id_autor);
} else {
    mysqli_stmt_bind_param($stmt, 'iss', $id_hotel, $fecha_inicio, $fecha_fin);
}

mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

$fileName = 'Reporte_Voucher_' . date('Y-m-d') . '.xls';
$fields = array('ID MASTER', 'ID COTIZACION', 'CLIENTE', 'RESERVA', 'TIPO COTIZACION', 'FECHA EXPEDICION', 'FECHA CHECKIN', 'FECHA CHECKOUT', 'TOTAL', 'TOTAL ABONO', 'SALDO PENDIENTE');
$excelData = implode("\t", array_values($fields)) . "\n";

$headEmpresa = array('', '', '', '', mb_convert_encoding($nombre_hotel, 'UTF-16LE', 'UTF-8'), '', '', '', '', '', '');
$nombreEmpresa = implode("\t", array_values($headEmpresa)) . "\n";

if ($resultado && mysqli_num_rows($resultado) > 0) {
    while ($row = mysqli_fetch_assoc($resultado)) {
        $lineData = array(
            $row['id_master'],
            $row['id_cotizacion'],
            mb_convert_encoding($row['cliente'], 'UTF-16LE', 'UTF-8'),
            $row['reserva'],
            $row['tipo_cotizacion'],
            $row['fecha_expedicion'],
            $row['fecha_checkin'],
            $row['fecha_checkout'],
            $row['total_cotizacion'],
            $row['total_abono'],
            $row['saldo_pendiente']
        );
        array_walk($lineData, 'filterData');
        $excelData .= implode("\t", array_values($lineData)) . "\n";
    }
} else {
    $excelData .= 'No records found...' . "\n";
}

header('Content-Type: application/vnd.ms-excel;charset=UTF-8');
header("Content-Disposition: attachment; filename=\"$fileName\"");
echo $nombreEmpresa . $excelData;

mysqli_stmt_close($stmt);
mysqli_close($con);
