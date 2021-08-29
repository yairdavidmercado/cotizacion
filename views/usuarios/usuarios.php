<?php 
SESSION_START();
 include '../../php/conexion.php';  

$codigo = $_POST["codigo"];
$parametro1 = $_POST["parametro1"];
$parametro2 = $_POST["parametro2"];                

//parametros de conexion a la base de datos del cliente

$conn = mysqli_connect(DB_HOST,DB_USER, DB_PASS, DB_NAME); 
if (!$conn) {
	die('No pudo conectarse: ' . mysqli_error());
}

if ($conn) {
	if ($codigo == "trael_usuarios") {
		$result = mysqli_query($conn, 	"SELECT *, 
										(SELECT paisnombre FROM pais WHERE pais.id = id_pais) as pais, 
										(SELECT estadonombre FROM estado WHERE estado.id = id_depto) as depto 
										FROM usuarios WHERE activo = true ;");
		if(mysqli_num_rows($result) > 0)
		{	
									$data = array();
									while ($row = mysqli_fetch_array($result)) {
									$datos = array();
										
									$datos["id"] 			= $row["id"];
									$datos["cedula"]		= $row["cedula"];
									$datos["nombre1"]		= $row["nombre1"];
									$datos["nombre2"]		= $row["nombre2"];
									$datos["apellido1"]		= $row["apellido1"];
									$datos["apellido2"]		= $row["apellido2"];
									$datos["tipo"]			= $row["tipo"];
									$datos["pais"] 			= $row["pais"];
									$datos["depto"] 		= $row["depto"];
									$datos["ciudad"] 		= $row["ciudad"];
									$datos["telefono"] 		= $row["telefono"];
									$datos["email"] 		= $row["email"];
									$datos["direccion"] 	= $row["direccion"];
									$datos["fecha_crea"] 	= $row["fecha_crea"];
										
										// push single product into final response array
									array_push($data, $datos);
									}
									$response = array("draw" => 1,
								    "recordsTotal" => 0,
								    "recordsFiltered" => 0,
									"data" => $data);
									//$response["success"] = true;
									echo json_encode($response);

		}else{
				$response["success"] = false;
				$response["message"] = "No se encontraron registros";
				// echo no users JSON
				echo json_encode($response);
		}
	}else if ($codigo == "hoteles_asociados") {//activos
		$result = mysqli_query($conn, 	"SELECT hoteles.*,
										(SELECT paisnombre FROM pais WHERE pais.id = hoteles.id_pais) AS pais,
										(SELECT estadonombre FROM estado WHERE estado.id = hoteles.id_depto) AS depto
										FROM permiso_hotel 
										INNER JOIN hoteles ON permiso_hotel.id_hotel = hoteles.id 
										INNER JOIN usuarios ON permiso_hotel.id_usuario = usuarios.id 
										WHERE usuarios.id = $parametro1");
		if(mysqli_num_rows($result) > 0)
		{	
									$response["resultado"] = array();
									while ($row = mysqli_fetch_array($result)) {
									$datos = array();
										
										$datos["id"] 			= $row["id"];
										$datos["nit"]			= $row["nit"];
										$datos["nombre"]		= $row["nombre"];
										$datos["pais"] 			= $row["pais"];
										$datos["depto"] 		= $row["depto"];
										$datos["ciudad"] 		= $row["ciudad"];
										$datos["telefono"] 		= $row["telefono"];
										$datos["email"] 		= $row["email"];
										$datos["direccion"] 	= $row["direccion"];
										$datos["id_terminos"] 	= $row["id_terminos"];
										$datos["avatar"] 		= $row["avatar"];
										
										// push single product into final response array
										array_push($response["resultado"], $datos);
									}
									$response["success"] = true;
									echo json_encode($response);

		}else{
				$response["success"] = false;
				$response["message"] = "No se encontraron registros";
				// echo no users JSON
				echo json_encode($response);
		}
	}else if ($codigo == "hoteles_por_asociar") {//activos
		$result = mysqli_query($conn, 	"SELECT * FROM hoteles WHERE id NOT IN (SELECT hoteles.id
										FROM permiso_hotel 
										INNER JOIN hoteles ON permiso_hotel.id_hotel = hoteles.id 
										INNER JOIN usuarios ON permiso_hotel.id_usuario = usuarios.id 
										WHERE usuarios.id = $parametro1)");
		if(mysqli_num_rows($result) > 0)
		{	
									$response["resultado"] = array();
									while ($row = mysqli_fetch_array($result)) {
									$datos = array();
										
										$datos["id"] 			= $row["id"];
										$datos["nit"]			= $row["nit"];
										$datos["nombre"]		= $row["nombre"];
										$datos["avatar"] 		= $row["avatar"];
										
										// push single product into final response array
										array_push($response["resultado"], $datos);
									}
									$response["success"] = true;
									echo json_encode($response);

		}else{
				$response["success"] = false;
				$response["message"] = "No se encontraron registros";
				// echo no users JSON
				echo json_encode($response);
		}
	}else if ($codigo == "moverto_asociados") {//activos
		$result = mysqli_query($conn, 	"INSERT INTO permiso_hotel (id_usuario, id_hotel) 
										VALUES ($parametro2, $parametro1)");
									mysqli_query($conn, $result);
									if (mysqli_insert_id($conn) > 0) {
										$response["success"] = true;
										$response["id"] = mysqli_insert_id($conn);
										$response["message"] = "Commiting transaction.";
									echo json_encode($response);
									} else {
										$response["success"] = false;
										$response["id"] = mysqli_insert_id($conn);
										$response["message"] = "Rolling back transaction.";
									echo json_encode($response);
									}
	}else if ($codigo == "moverto_sin_asociar") {//activos
		$result = mysqli_query($conn, 	"DELETE FROM permiso_hotel WHERE id_usuario = $parametro2 AND id_hotel = $parametro1");
									mysqli_query($conn, $result);
									$response["success"] = true;
										$response["id"] = mysqli_insert_id($conn);
										$response["message"] = "Commiting transaction.";
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