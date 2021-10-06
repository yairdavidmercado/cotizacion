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
	if ($codigo == "traer_productos") {
		$result = mysqli_query($conn, 	"SELECT *, CASE id_hotel WHEN 0 THEN 'GENERAL' ELSE 'LOCAL' END AS tipo_guardado
										FROM productos WHERE 
										(id_hotel = $parametro1 OR id_hotel = 0) AND
										activo = TRUE;");
		$data = array();
		if(mysqli_num_rows($result) > 0)
		{	

									while ($row = mysqli_fetch_array($result)) {
									$datos = array();
									
									$datos["id"]			= $row["id"];
									$datos["nombre"]		= $row["nombre"];
									$datos["tipo"] 			= $row["tipo"];
									$datos["tipo_guardado"] = $row["tipo_guardado"];
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
	}else if ($codigo == "traer_productos_id") {
		$result = mysqli_query($conn, 	"SELECT *, id_hotel AS tipo_guardado
										FROM productos WHERE 
										(id_hotel = $parametro1 OR id_hotel = 0) AND
										id = $parametro2;");
		$data = array();
		if(mysqli_num_rows($result) > 0)
		{	
									$response["resultado"] = array();
									while ($row = mysqli_fetch_array($result)) {
									$datos = array();
									
									$datos["id"]			= $row["id"];
									$datos["nombre"]		= $row["nombre"];
									$datos["tipo"] 			= $row["tipo"];
									$datos["tipo_guardado"] = $row["tipo_guardado"];
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
	}else if ($codigo == "traer_check_productos") {
		$result = mysqli_query($conn, 	"SELECT *, CASE id_hotel WHEN 0 THEN 'GENERAL' ELSE 'LOCAL' END AS tipo_guardado
										FROM productos WHERE 
										(id_hotel = $parametro1 OR id_hotel = 0) AND
										activo = TRUE;");
		if(mysqli_num_rows($result) > 0)
		{	
									$response["resultado"] = array();
									while ($row = mysqli_fetch_array($result)) {
									$datos = array();
									
									$datos["id"]			= $row["id"];
									$datos["nombre"]		= $row["nombre"];
									$datos["tipo"] 			= $row["tipo"];
									$datos["tipo_guardado"] = $row["tipo_guardado"];
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
	}else if ($codigo == "traer_planes") {
		$result = mysqli_query($conn, 	"SELECT *, 
										(SELECT count(id) FROM tipo_plan WHERE planes.id = tipo_plan.id_plan AND tipo_plan.activo = true) cantidad_productos
										FROM planes WHERE planes.id_hotel = $parametro1 AND planes.activo = TRUE;");
		$data = array();
		if(mysqli_num_rows($result) > 0)
		{	
									
									while ($row = mysqli_fetch_array($result)) {
									$datos = array();
									
									$datos["id"]					= $row["id"];
									$datos["nombre"]				= $row["nombre"];
									$datos["descripcion"]			= $row["descripcion"];
									$datos["cantidad_productos"] 	= $row["cantidad_productos"];
									$datos["fecha_crea"] 			= $row["fecha_crea"];
										
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
	}else if ($codigo == "traer_planes_id") {
		$result = mysqli_query($conn, 	"SELECT *
										FROM planes WHERE planes.id_hotel = $parametro1 AND planes.id = $parametro2;");
		$data = array();
		if(mysqli_num_rows($result) > 0)
		{	
									$response["resultado"] = array();
									while ($row = mysqli_fetch_array($result)) {
									$datos = array();
									
									$datos["id"]					= $row["id"];
									$datos["nombre"]				= $row["nombre"];
									$datos["descripcion"]			= $row["descripcion"];
									$datos["fecha_crea"] 			= $row["fecha_crea"];
										
										// push single product into final response array
										array_push($response["resultado"], $datos);
									}
									$id_plan = $response["resultado"][0]["id"];
									$info_productos = mysqli_query($conn, "SELECT *,
																			(SELECT COUNT(id_producto) FROM tipo_plan WHERE id_producto = productos.id AND tipo_plan.id_plan = $id_plan) AS checked
																			FROM productos WHERE id_hotel = $parametro1 OR id_hotel = 0");
										$datos_productos = array();
										if(mysqli_num_rows($info_productos) > 0)
										{							$response["info_productos"] = array();
																	while ($row = mysqli_fetch_array($info_productos)) {

																		$datos_productos["id"] 			= $row["id"];
																		$datos_productos["nombre"]		= $row["nombre"];
																		$datos_productos["tipo"]			= $row["tipo"];
																		$datos_productos["checked"]			= $row["checked"];
																		
																		// push single product into final response array
																		array_push($response["info_productos"], $datos_productos);
																	}

										}
									$response["success"] = true;
									echo json_encode($response);

		}else{
			$response["success"] = true;
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