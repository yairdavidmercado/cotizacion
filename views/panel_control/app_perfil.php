<?php 
SESSION_START();
 include '../../php/conexion.php';  

$codigo = $_POST["codigo"];
$parametro1 = $_POST["parametro1"];
$parametro2 = $_POST["parametro2"];
$perfil = $_SESSION['perfil'];                

//parametros de conexion a la base de datos del cliente

$conn = mysqli_connect(DB_HOST,DB_USER, DB_PASS, DB_NAME); 
if (!$conn) {
	die('No pudo conectarse: ' . mysqli_error());
}

if ($conn) {
	if ($codigo == "traer_app_perfil") {
		$result = mysqli_query($conn, 	"SELECT * FROM app_perfil WHERE activo = true;");
		$data = array();
		if(mysqli_num_rows($result) > 0)
		{	
									
									while ($row = mysqli_fetch_array($result)) {
									$datos = array();
										
									$datos["id"] 			= $row["id"];
									$datos["nombre"]		= $row["nombre"];
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
			$response = array("draw" => 1,
			"recordsTotal" => 0,
			"recordsFiltered" => 0,
			"data" => $data);
			//$response["success"] = true;
			echo json_encode($response);
		}
	}else if ($codigo == "traer_app_perfil_id") {
		$result = mysqli_query($conn, 	"SELECT * FROM app_perfil WHERE id = $parametro1;");
		$data = array();
		if(mysqli_num_rows($result) > 0)
		{	
									$response["resultado"] = array();
									while ($row = mysqli_fetch_array($result)) {
									$datos = array();
										
									$datos["id"] 			= $row["id"];
									$datos["nombre"]		= $row["nombre"];
									$datos["fecha_crea"] 	= $row["fecha_crea"];
										
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
	}else if ($codigo == "traer_conf_perfiles") {
		$result = mysqli_query($conn, 	"SELECT * FROM app_modulos ORDER BY orden ASC;");
		$ids_modulos = '';
		$response["modulos"] = array();
		if(mysqli_num_rows($result) > 0)
		{	
									while ($row = mysqli_fetch_array($result)) {
									$datos = array();
									$ids_modulos 			.= $row["id"].",";
									$datos["id"] 			= $row["id"];
									$datos["nombre"]		= $row["nombre"];
									$datos["url"] 			= $row["url"];
									$datos["tipo"] 			= $row["tipo"];
										
										// push single product into final response array
										array_push($response["modulos"], $datos);
									}
									//$response["success"] = true;
									//echo json_encode($response);

		}
		$ids_modulos = substr($ids_modulos, 0, -1);
		//echo $ids_modulos;
		$result2 = mysqli_query($conn, 	"SELECT * FROM app_accion WHERE id_modulo in ($ids_modulos)");
		$ids_acciones = '';
		$response["acciones"] = array();
		if(mysqli_num_rows($result2) > 0)
		{	
									while ($row = mysqli_fetch_array($result2)) {
									$datos = array();
									$ids_acciones 			.= $row["id"].",";
									$datos["id"] 			= $row["id"];
									$datos["accion"]		= $row["accion"];
									$datos["id_modulo"] 	= $row["id_modulo"];
										
										// push single product into final response array
										array_push($response["acciones"], $datos);
									}

		}

		$ids_acciones = substr($ids_acciones, 0, -1);
		$result3 = mysqli_query($conn, 	"SELECT * FROM app_permisos WHERE id_accion in ($ids_acciones) AND id_perfil = (SELECT id FROM app_perfil WHERE nombre = '$perfil' )");
		$response["permisos"] = array();
		if(mysqli_num_rows($result3) > 0)
		{	
									while ($row = mysqli_fetch_array($result3)) {
									$datos = array();
										
									$datos["id"] 			= $row["id"];
									$datos["id_accion"]		= $row["id_accion"];
									$datos["id_perfil"] 	= $row["id_perfil"];
										
										// push single product into final response array
										array_push($response["permisos"], $datos);
									}

		}

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