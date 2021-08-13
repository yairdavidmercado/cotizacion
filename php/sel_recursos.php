<?php 
 include 'conexion.php';  

$codigo = $_POST["codigo"];
$parametro1 = $_POST["parametro1"];
$parametro2 = $_POST["parametro2"];                

//parametros de conexion a la base de datos del cliente

$conn = mysqli_connect(DB_HOST,DB_USER, DB_PASS, DB_NAME); 
if (!$conn) {
	die('No pudo conectarse: ' . mysqli_error());
}

if ($conn) {
	if ($codigo == "traer_hotel") {//activos
		$result = mysqli_query($conn, 	"SELECT *, 
										(SELECT paisnombre FROM pais WHERE pais.id = id_pais) as pais, 
										(SELECT estadonombre FROM estado WHERE estado.id = id_depto) as depto 
										FROM hoteles WHERE activo = true;");
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
	}else if ($codigo == "traer_titulares") {//titulares
		$result = mysqli_query($conn, 	"SELECT *, 
										(SELECT paisnombre FROM pais WHERE pais.id = id_pais) as pais, 
										(SELECT estadonombre FROM estado WHERE estado.id = id_depto) as depto 
										FROM usuarios WHERE activo = true;");
		if(mysqli_num_rows($result) > 0)
		{	
									$response["resultado"] = array();
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
	}else if ($codigo == "traer_tarifas") {//titulares
		$result = mysqli_query($conn, 	"SELECT * FROM tarifas WHERE id_hotel = $parametro1 AND noches = $parametro2 AND activo = true;");
		if(mysqli_num_rows($result) > 0)
		{	
									$response["resultado"] = array();
									while ($row = mysqli_fetch_array($result)) {
									$datos = array();
										
										$datos["id"] 			= $row["id"];
										$datos["nombre"]		= $row["nombre"];
										$datos["child"]			= $row["child"];
										$datos["adult_s"] 		= $row["adult_s"];
										$datos["adult_d"] 		= $row["adult_d"];
										$datos["adult_t_c"] 	= $row["adult_t_c"];
										$datos["noches"] 		= $row["noches"];
										
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
	}else if ($codigo == "traer_motivos") {//titulares
		$result = mysqli_query($conn, 	"SELECT * FROM motivos WHERE activo = true;");
		if(mysqli_num_rows($result) > 0)
		{	
									$response["resultado"] = array();
									while ($row = mysqli_fetch_array($result)) {
									$datos = array();
										
										$datos["id"] 			= $row["id"];
										$datos["nombre"]		= $row["nombre"];
										
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