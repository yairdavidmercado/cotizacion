<?php
session_start(); 
$nit = $_POST["nit"];
$nombre = $_POST["nombre"];
$direccion = $_POST["direccion"];
$telefono = $_POST["telefono"];
$email = $_POST["email"];
$user_id = $_POST["user_id"];
$state = $_POST["state"];

$response = array();
include '/inventario/php/conexion.php';
// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CALL guardar_proveedor('".$nit."', '".$nombre."', '".$direccion."', '".$telefono."','".$telefono."', '".$email."', '".$user_id."');";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $response["success"] = true;
    $response["message"] = "Su caso ha sido registrado con el numero: ".$result[0];
    $response["numero"] = $result[0];
    echo json_encode($response);
	
} else {
    $response["success"] = false;
			$response["message"] = "No se guardó la información.";
			echo json_encode($response);
}
$conn->close();
?>