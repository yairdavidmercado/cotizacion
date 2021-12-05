<?php
/*
* iTech Empires:  Export Data from MySQL to CSV Script
* Version: 1.0.0
* Page: Export
*/
session_start();
include '../conexion.php';

// Database Connection
// Connect to MySQL Database
$con = mysqli_connect(DB_HOST,DB_USER, DB_PASS, DB_NAME);

if (mysqli_connect_errno()) {
echo "Failed to connect to MySQL: " . mysqli_connect_error();
exit;
}
$id_hotel = isset($_SESSION['id_hotel']) ? $_SESSION['id_hotel']: "0" ;
$nombre_hotel = isset($_SESSION['nombre_hotel']) ? $_SESSION['nombre_hotel']: "EMPRESA NO ENCONTRADA" ;
$tipo = $_GET["tipo"];
if ($tipo == '1') {
    $tipo = 'DATE(cotizacion.fecha_crea)';
}else if($tipo == '2'){
    $tipo = 'fecha_entrada'; 
}else if($tipo == '3'){
    $tipo = 'fecha_salida'; 
}
$fechaini = $_GET["fechaini"];
$fechafin = $_GET["fechafin"];

// Load the database configuration file 
 
// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 
 
// Excel file name for download 
$fileName = "Relacion_ventas" . date('Y-m-d') . ".xls"; 
 
// Column names 
$fields = array('# RESERVA', 'ACOMODACION', 'FECHA EXPEDICION', 'FECHA LLEGADA', 'FECHA SALIDA', 'TITULAR RESERVA', 'PLAN', 'SENCILLA', 'DOBLE', 'TRIP/CUAD', 'INFANTE', '# NOCHES', 'VALOR A PAGAR'); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 
 
// Fetch records from database 
$query = $con->query('  SELECT (SELECT reserva FROM vaucher  WHERE vaucher.id_cotizacion = cotizacion.id AND vaucher.activo = TRUE LIMIT 1 ) AS n_reserva,
                        (n_child+n_adult_s+n_adult_d+n_adult_t_c) AS pax,
                        DATE(cotizacion.fecha_crea) as fecha_expedicion,
                        fecha_entrada,
                        fecha_salida,
                        (SELECT CONCAT(nombre1, " ", nombre2, " ", apellido1, " ", apellido2) FROM usuarios  WHERE usuarios.id = cotizacion.id_titular LIMIT 1 ) AS titular,
                                                                (SELECT nombre FROM planes WHERE planes.id = cotizacion.id_plan) AS nombre_plan,
                                                                ((SELECT adult_s FROM tarifas WHERE tarifas.id = cotizacion.id_tarifa)*(IF(n_adult_s > 0 , 1, 0))) AS sencilla,
                                                                ((SELECT adult_d FROM tarifas WHERE tarifas.id = cotizacion.id_tarifa)*(IF(n_adult_d > 0 , 1, 0))) AS doble,
                                                                ((SELECT adult_t_c FROM tarifas WHERE tarifas.id = cotizacion.id_tarifa)*(IF(n_adult_t_c > 0 , 1, 0))) AS triple,
                                                                ((SELECT child FROM tarifas WHERE tarifas.id = cotizacion.id_tarifa)*(IF(n_child > 0 , 1, 0))) AS nino,										
                                                                noche,
                                                                ((((SELECT adult_s FROM tarifas WHERE tarifas.id = cotizacion.id_tarifa)*(IF(n_adult_s > 0 , 1, 0)))+
                                                                ((SELECT adult_d FROM tarifas WHERE tarifas.id = cotizacion.id_tarifa)*(IF(n_adult_d > 0 , 1, 0)))+
                                                                ((SELECT adult_t_c FROM tarifas WHERE tarifas.id = cotizacion.id_tarifa)*(IF(n_adult_t_c > 0 , 1, 0)))+
                                                                ((SELECT child FROM tarifas WHERE tarifas.id = cotizacion.id_tarifa)*(IF(n_child > 0 , 1, 0))))*
                                                                (IF(noche = "N/A" , 1, noche))) AS total
                                                                FROM cotizacion
                                                                WHERE id_hotel = '.$id_hotel.' 
                                                                AND (SELECT reserva FROM vaucher  WHERE vaucher.id_cotizacion = cotizacion.id AND vaucher.activo = TRUE LIMIT 1 ) > 0
                                                                AND '.$tipo.' BETWEEN "'.$fechaini.'" AND "'.$fechafin.'";'); 
$headEmpresa = array('', '', '', '', '', '',  mb_convert_encoding($nombre_hotel, 'UTF-16LE', 'UTF-8'), '', '', '', '', '', ''); 
$nombreEmpresa = implode("\t", array_values($headEmpresa)) . "\n";
$nombreTotal = '';
if($query->num_rows > 0){ 
    // Output each row of the data 
    $suma = 0;
    while($row = $query->fetch_assoc()){ 
        $suma = $suma+$row['total'];
        $lineData = array($row['n_reserva'], $row['pax'].'px', $row['fecha_expedicion'], $row['fecha_entrada'], $row['fecha_salida'], mb_convert_encoding($row['titular'], 'UTF-16LE', 'UTF-8'), $row['nombre_plan'], $row['sencilla'], $row['doble'], $row['triple'], $row['nino'], $row['noche'], $row['total']); 
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
    }
    
    $headTotal = array('', '', '', '', '', '', '', '', '', '', '', 'TOTAL:', $suma); 
    $nombreTotal = implode("\t", array_values($headTotal)) . "\n";
}else{ 
    $excelData .= 'No records found...'. "\n"; 
}

// Headers for download 
header("Content-Type: application/vnd.ms-excel;charset=UTF-8"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
 
// Render excel data 
echo $nombreEmpresa.$excelData.$nombreTotal; 
 
?>