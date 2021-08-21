<?php 
SESSION_START(); 
if (!isset($_SESSION['id'])) {
    header ("Location:/cotizacion/index.php"); 
}
$parametro1 = $_POST["parametro1"];
$parametro2 = $_POST["parametro2"];

$_SESSION["id_hotel"] = $parametro1;
$_SESSION["nombre_hotel"] = $parametro2;
$response["resultado"] = array();
$response["success"] = true;
echo json_encode($response);
?>