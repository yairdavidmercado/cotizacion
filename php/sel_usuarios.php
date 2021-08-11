<?php 
SESSION_START();
 include 'conexion.php';  

$parametro1 = $_POST["parametro1"];
$parametro2 = $_POST["parametro2"];                

//parametros de conexion a la base de datos del cliente

$conn = mysqli_connect(DB_HOST,DB_USER, DB_PASS, DB_NAME); 
if (!$conn) {
	die('No pudo conectarse: ' . mysqli_error());
}

if ($conn) {
	$result = mysqli_query($conn, 	"CALL validar_login('$parametro1', '$parametro2');");
	if(mysqli_num_rows($result) > 0)
	{	
								$response["resultado"] = array();
								while ($row = mysqli_fetch_array($result)) {
								$datos = array();
									
									$_SESSION["id"] 			= $row["id"];
									$_SESSION["nombre1"]		= $row["nombre1"];
									$_SESSION["nombre2"]		= $row["nombre2"];
									$_SESSION["apellido1"]		= $row["apellido1"];
									$_SESSION["apellido2"]		= $row["apellido2"];
									$_SESSION["perfil"] 		= $row["tipo"];
									$_SESSION["codigo"] 		= $row["codigo"];
									$_SESSION["cedula"] 		= $row["cedula"];
									
									// push single product into final response array
									//array_push($response["resultado"], $datos);
								}
								$response["success"] = true;
								echo json_encode($response);

	}else{
			$response["success"] = false;
			$response["message"] = "No se encontraron registros";
			// echo no users JSON
			echo json_encode($response);
	}
}
else{
	$response["success"] = false;
	$response["message"] = "No se pudo establecer conexion con el servidor";
	// echo no users JSON
	echo json_encode($response);
}
mysqli_close($conn);
?>