<?php 
SESSION_START(); 
if (!isset($_SESSION['id'])) {
    header ("Location:/cotizacion/index.php"); 
}
$parametro1 = $_POST["parametro1"];
$parametro2 = $_POST["parametro2"];
$parametro3 = $_POST["parametro3"];
$parametro4 = $_POST["parametro4"];
$parametro5 = $_POST["parametro5"];
$parametro6 = $_POST["parametro6"];
$parametro7 = $_POST["parametro7"];
$parametro8 = $_POST["parametro8"];
$parametro9 = $_POST["parametro9"];

$_SESSION["id_hotel"] = $parametro1;
$_SESSION["nombre_hotel"] = $parametro2;
$_SESSION["id_terminos"] = $parametro3;
$_SESSION["direccion_hotel"] = $parametro4;
$_SESSION["telefono_hotel"] = $parametro5;
$_SESSION["pais_hotel"] = $parametro6;
$_SESSION["depto_hotel"] = $parametro7;
$_SESSION["email_hotel"] = $parametro8;
$_SESSION["avatar_hotel"] = $parametro9;
$response["resultado"] = array();
$response["success"] = true;
echo json_encode($response);
?>