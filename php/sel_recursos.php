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
	}else if ($codigo == "card_hotel") {//activos
		$result = mysqli_query($conn, 	"SELECT hoteles.*,
										(SELECT paisnombre FROM pais WHERE pais.id = hoteles.id_pais) AS pais,
										(SELECT estadonombre FROM estado WHERE estado.id = hoteles.id_depto) AS depto
										FROM permiso_hotel 
										INNER JOIN hoteles ON permiso_hotel.id_hotel = hoteles.id 
										INNER JOIN usuarios ON permiso_hotel.id_usuario = usuarios.id 
										WHERE usuarios.id = $parametro1 
										AND hoteles.activo = 1 
										AND usuarios.activo = 1
										AND permiso_hotel.activo = 1");
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
										FROM usuarios WHERE activo = true AND tipo = 'TITULAR';");
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
	}else if ($codigo == "traer_planes") {//titulares
		$result = mysqli_query($conn, 	"SELECT * FROM planes WHERE id_hotel = $parametro1 AND activo = true;");
		if(mysqli_num_rows($result) > 0)
		{	
									$response["resultado"] = array();
									while ($row = mysqli_fetch_array($result)) {
									$datos = array();
										
										$datos["id"] 			= $row["id"];
										$datos["nombre"]		= $row["nombre"];
										$datos["descripcion"]	= $row["descripcion"];
										
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
	}else if ($codigo == "traer_productos") {//titulares
		$result = mysqli_query($conn, 	"SELECT productos.* FROM tipo_plan 
										INNER JOIN productos ON tipo_plan.id_producto = productos.id 
										WHERE id_plan = $parametro1 
										AND productos.activo = TRUE 
										AND tipo_plan.activo = TRUE;");
		if(mysqli_num_rows($result) > 0)
		{	
									$response["resultado"] = array();
									while ($row = mysqli_fetch_array($result)) {
									$datos = array();
										
										$datos["id"] 			= $row["id"];
										$datos["nombre"]		= $row["nombre"];
										$datos["tipo"]			= $row["tipo"];
										
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
	}else if ($codigo == "traer_cotizacion") {//titulares
		$id_titular = '';
		$id_tarifa = '';
		$id_plan = '';
		$result = mysqli_query($conn, 	"SELECT cotizacion.*, 
										(SELECT nombre FROM motivos WHERE motivos.id = cotizacion.id_motivo) AS nombre_motivo
										FROM cotizacion 
										WHERE id = $parametro1;");
		if(mysqli_num_rows($result) > 0)
		{	
									$response["resultado"] = array();
									while ($row = mysqli_fetch_array($result)) {
									$datos = array();

										$datos['id'] = $row["id"];
										$datos['cod_vendedor'] = $row["cod_vendedor"];
										$datos['n_infante'] = $row["n_infante"];
										$datos['n_child'] = $row["n_child"];
										$datos['n_adult_s'] = $row["n_adult_s"];
										$datos['n_adult_d'] = $row["n_adult_d"];
										$datos['n_adult_t_c'] = $row["n_adult_t_c"];
										$datos['id_hotel'] = $row["id_hotel"];
										$datos['id_titular'] = $row["id_titular"];
										$datos['id_tarifa'] = $row["id_tarifa"];
										$datos['id_plan'] = $row["id_plan"];
										$datos['id_motivo'] = $row["id_motivo"];
										$datos['noche'] = $row["noche"];
										$datos['acomodo'] = $row["acomodo"];
										$datos['fecha_expedicion'] = $row["fecha_expedicion"];
										$datos['fecha_entrada'] = $row["fecha_entrada"];
										$datos['fecha_salida'] = $row["fecha_salida"];
										$datos['nombre_motivo'] = $row["nombre_motivo"];

										$id_titular = $row["id_titular"];
										$id_tarifa = $row["id_tarifa"];
										$id_plan = $row["id_plan"];
										
										// push single product into final response array
										array_push($response["resultado"], $datos);
									}

										$info_titular = mysqli_query($conn, "SELECT *, 
																			(SELECT paisnombre FROM pais WHERE pais.id = id_pais) as pais, 
																			(SELECT estadonombre FROM estado WHERE estado.id = id_depto) as depto 
																			FROM usuarios WHERE id = $id_titular ;");
										$datos_titular = array();
										if(mysqli_num_rows($info_titular) > 0)
										{							$response["info_titular"] = array();
																	while ($row = mysqli_fetch_array($info_titular)) {

																		$datos_titular["id"] 			= $row["id"];
																		$datos_titular["cedula"]		= $row["cedula"];
																		$datos_titular["nombre1"]		= $row["nombre1"];
																		$datos_titular["nombre2"]		= $row["nombre2"];
																		$datos_titular["apellido1"]		= $row["apellido1"];
																		$datos_titular["apellido2"]		= $row["apellido2"];
																		$datos_titular["tipo"]			= $row["tipo"];
																		$datos_titular["pais"] 			= $row["pais"];
																		$datos_titular["depto"] 		= $row["depto"];
																		$datos_titular["ciudad"] 		= $row["ciudad"];
																		$datos_titular["telefono"] 		= $row["telefono"];
																		$datos_titular["email"] 		= $row["email"];
																		$datos_titular["direccion"] 	= $row["direccion"];
																		
																		// push single product into final response array
																		array_push($response["info_titular"], $datos_titular);
																	}

										}

										$info_tarifa = mysqli_query($conn, "SELECT * FROM tarifas WHERE id = $id_tarifa;");
										$datos_tarifa = array();
										if(mysqli_num_rows($info_tarifa) > 0)
										{							$response["info_tarifa"] = array();
																	while ($row = mysqli_fetch_array($info_tarifa)) {

																		$datos_tarifa["id"] 			= $row["id"];
																		$datos_tarifa["nombre"]		= $row["nombre"];
																		$datos_tarifa["child"]			= $row["child"];
																		$datos_tarifa["adult_s"] 		= $row["adult_s"];
																		$datos_tarifa["adult_d"] 		= $row["adult_d"];
																		$datos_tarifa["adult_t_c"] 	= $row["adult_t_c"];
																		$datos_tarifa["noches"] 		= $row["noches"];
																		
																		// push single product into final response array
																		array_push($response["info_tarifa"], $datos_tarifa);
																	}

										}

										$info_planes = mysqli_query($conn, "SELECT productos.* FROM tipo_plan 
																			INNER JOIN productos ON tipo_plan.id_producto = productos.id 
																			WHERE id_plan = $id_plan;");
										$datos_planes = array();
										if(mysqli_num_rows($info_planes) > 0)
										{							$response["info_planes"] = array();
																	while ($row = mysqli_fetch_array($info_planes)) {

																		$datos_planes["id"] 			= $row["id"];
																		$datos_planes["nombre"]		= $row["nombre"];
																		$datos_planes["tipo"]			= $row["tipo"];
																		
																		// push single product into final response array
																		array_push($response["info_planes"], $datos_planes);
																	}

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