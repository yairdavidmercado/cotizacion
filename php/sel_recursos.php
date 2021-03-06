<?php 
session_start();
 

$codigo = $_POST["codigo"];
$parametro1 = $_POST["parametro1"];
$parametro2 = $_POST["parametro2"]; 
$parametro3 = isset($_POST["parametro3"]) ? $_POST["parametro3"] : "0" ;                
$id_autor = $_SESSION['id'];
$id_perfil = $_SESSION['perfil'];
$id_hotel = isset($_SESSION['id_hotel']) ? $_SESSION['id_hotel']: "" ;
//parametros de conexion a la base de datos del cliente
$condicion = '';
if ($id_perfil !== 'SUPERADMIN') {
	$condicion = "AND id_autor = $id_autor";
}

if ($codigo == 'traer_perfiles') {
	include 'conectCompany.php';  
}else{
	include 'conexion.php';  
}
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
										INNER JOIN ".DB_NAME_GLOBAL.".usuarios ON permiso_hotel.id_usuario = ".DB_NAME_GLOBAL.".usuarios.id 
										WHERE ".DB_NAME_GLOBAL.".usuarios.id = $parametro1 
										AND hoteles.activo = 1 
										AND ".DB_NAME_GLOBAL.".usuarios.activo = 1
										AND permiso_hotel.activo = 1 ORDER BY id DESC");
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
	}else if ($codigo == "traer_titulares") {//titulares
		$result = mysqli_query($conn, 	"SELECT *, 
										(SELECT paisnombre FROM pais WHERE pais.id = id_pais) as pais, 
										(SELECT estadonombre FROM estado WHERE estado.id = id_depto) as depto 
										FROM usuarios WHERE activo = true AND tipo = 'TITULAR' ORDER BY id DESC;");
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
		$result = mysqli_query($conn, 	"SELECT * FROM tarifas WHERE id_hotel = $parametro1 AND noches = $parametro2  AND id_plan = $parametro3 AND activo = true;");
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
										$datos["descripcion"] 	= $row["descripcion"];
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
										$datos["id_terminos"]	= $row["id_terminos"];
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
		$parametro1 = $parametro1 == '' ? 0 : $parametro1;
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
										(SELECT nombre FROM motivos WHERE motivos.id = cotizacion.id_motivo) AS nombre_motivo,
										(SELECT nombre FROM planes WHERE planes.id = cotizacion.id_plan) AS nombre_plan,
										(SELECT descripcion FROM planes WHERE planes.id = cotizacion.id_plan) AS descripcion_plan,
										(SELECT descripcion FROM terminos_condiciones WHERE terminos_condiciones.id = cotizacion.id_terminos) AS terminos,
										(SELECT reserva FROM vaucher  WHERE vaucher.id_cotizacion = cotizacion.id AND vaucher.activo = true LIMIT 1 ) as n_reserva,
										(SELECT COUNT(vaucher.id) FROM vaucher  WHERE vaucher.id_cotizacion = cotizacion.id AND vaucher.activo = true) as total_vaucher,
										(SELECT SUM(vaucher.deposito) FROM vaucher  WHERE vaucher.id_cotizacion = cotizacion.id AND vaucher.activo = true) as deposito,
										(SELECT id FROM vaucher WHERE vaucher.id_cotizacion = cotizacion.id AND vaucher.activo = true order by id desc limit 1) as id_vaucher,
										(SELECT fecha_crea FROM vaucher WHERE vaucher.id_cotizacion = cotizacion.id AND vaucher.activo = true order by id desc limit 1) as vaucher_fecha_crea
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
										$datos['acomodo'] = nl2br($row["acomodo"]);
										$datos['fecha_expedicion'] = $row["fecha_expedicion"];
										$datos['fecha_entrada'] = $row["fecha_entrada"];
										$datos['fecha_salida'] = $row["fecha_salida"];
										$datos['nombre_motivo'] = $row["nombre_motivo"];
										$datos['terminos'] = nl2br($row["terminos"]);
										$datos['nombre_plan'] = $row["nombre_plan"];
										$datos['descripcion_plan'] = $row["descripcion_plan"];
										$datos['total_vaucher'] = $row["total_vaucher"];
										$datos['deposito'] = $row["deposito"];
										$datos['id_vaucher'] = $row["id_vaucher"];
										$datos['n_reserva'] = $row["n_reserva"];
										$datos['vaucher_fecha_crea'] = $row["vaucher_fecha_crea"];

										$id_titular = $row["id_titular"] == "" ? "0": $row["id_titular"];
										$id_tarifa = $row["id_tarifa"] == "" ? "0":  $row["id_tarifa"];
										$id_plan = $row["id_plan"] == "" ? "0": $row["id_plan"];
										
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
	}else if ($codigo == "traer_tabla_cotizacion") {//titulares
		$result = mysqli_query($conn, 	"SELECT cotizacion.*, 
										(SELECT CONCAT(nombre1, ' ', nombre2, ' ', apellido1, ' ', apellido2) FROM usuarios WHERE usuarios.id = cotizacion.id_titular) AS nombre_titular,
										(SELECT cedula FROM usuarios WHERE usuarios.id = cotizacion.id_titular) AS cedula_titular,
										(SELECT nombre FROM motivos WHERE motivos.id = cotizacion.id_motivo) AS nombre_motivo,
										(SELECT nombre FROM planes WHERE planes.id = cotizacion.id_plan) AS nombre_plan
										FROM cotizacion WHERE cotizacion.id_hotel = $id_hotel $condicion");
		$data = array();										
		if(mysqli_num_rows($result) > 0)
		{	
									
									while ($row = mysqli_fetch_array($result)) {
									$datos = array();
										
									$datos['id'] = $row["id"];
									$datos['noche'] = $row["noche"];
									$datos['nombre_titular'] = $row["nombre_titular"];
									$datos['cedula_titular'] = $row["cedula_titular"];
									$datos['fecha_expedicion'] = $row["fecha_expedicion"];
									$datos['fecha_entrada'] = $row["fecha_entrada"];
									$datos['fecha_salida'] = $row["fecha_salida"];
									$datos['nombre_motivo'] = $row["nombre_motivo"];
									$datos['nombre_plan'] = $row["nombre_plan"];
										
										
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
	}else if ($codigo == "traer_paises") {//activos
		$result = mysqli_query($conn, 	"SELECT * FROM pais order by paisnombre ASC");
		if(mysqli_num_rows($result) > 0)
		{	
									$response["resultado"] = array();
									while ($row = mysqli_fetch_array($result)) {
									$datos = array();
										
										$datos["id"] 			= $row["id"];
										$datos["paisnombre"]	= $row["paisnombre"];
										
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
	}else if ($codigo == "traer_deptos") {//activos
		$result = mysqli_query($conn, 	"SELECT * FROM estado WHERE ubicacionpaisid = $parametro1 order by estadonombre ASC");
		if(mysqli_num_rows($result) > 0)
		{	
									$response["resultado"] = array();
									while ($row = mysqli_fetch_array($result)) {
									$datos = array();
										
										$datos["id"] 			= $row["id"];
										$datos["estadonombre"]	= $row["estadonombre"];
										
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
	}else if ($codigo == "traer_terminos") {//activos
		$result = mysqli_query($conn, 	"SELECT * FROM terminos_condiciones WHERE activo = true");
		if(mysqli_num_rows($result) > 0)
		{	
									$response["resultado"] = array();
									while ($row = mysqli_fetch_array($result)) {
									$datos = array();
										
										$datos["id"] 			= $row["id"];
										$datos["titulo"]	= $row["titulo"];
										
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
	}else if ($codigo == "traer_metodo_pago") {//activos
		$result = mysqli_query($conn, 	"SELECT * FROM metodo_pago");
		if(mysqli_num_rows($result) > 0)
		{	
									$response["resultado"] = array();
									while ($row = mysqli_fetch_array($result)) {
									$datos = array();
										
										$datos["id"] 			= $row["id"];
										$datos["nombre"]	= $row["nombre"];
										
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
	}else if ($codigo == "traer_tabla_vaucher") {//titulares
		$result = mysqli_query($conn, 	"SELECT cotizacion.*, 
										(SELECT CONCAT(nombre1, ' ', nombre2, ' ', apellido1, ' ', apellido2) FROM usuarios WHERE usuarios.id = cotizacion.id_titular) AS nombre_titular,
										(SELECT cedula FROM usuarios WHERE usuarios.id = cotizacion.id_titular) AS cedula_titular,
										(SELECT nombre FROM motivos WHERE motivos.id = cotizacion.id_motivo) AS nombre_motivo,
										(SELECT nombre FROM planes WHERE planes.id = cotizacion.id_plan) AS nombre_plan,
										(SELECT reserva FROM vaucher  WHERE vaucher.id_cotizacion = cotizacion.id AND vaucher.activo = true LIMIT 1) as n_voucher,
										(SELECT COUNT(vaucher.id) FROM vaucher  WHERE vaucher.id_cotizacion = cotizacion.id AND vaucher.activo = true) as total_vaucher,
										(SELECT SUM(vaucher.deposito) FROM vaucher  WHERE vaucher.id_cotizacion = cotizacion.id AND vaucher.activo = true) as deposito,
										(SELECT id FROM vaucher WHERE vaucher.id_cotizacion = cotizacion.id AND vaucher.activo = true order by id desc limit 1) as id_vaucher,
										(SELECT fecha_crea FROM vaucher WHERE vaucher.id_cotizacion = cotizacion.id AND vaucher.activo = true order by id desc limit 1) as vaucher_fecha_crea
										FROM cotizacion WHERE cotizacion.id_hotel = $id_hotel $condicion");
		$data = array();										
		if(mysqli_num_rows($result) > 0)
		{	
									
									while ($row = mysqli_fetch_array($result)) {
									$datos = array();
										
									$datos['id'] = $row["id"];
									$datos['noche'] = $row["noche"];
									$datos['nombre_titular'] = $row["nombre_titular"];
									$datos['cedula_titular'] = $row["cedula_titular"];
									$datos['fecha_expedicion'] = $row["fecha_expedicion"];
									$datos['fecha_entrada'] = $row["fecha_entrada"];
									$datos['fecha_salida'] = $row["fecha_salida"];
									$datos['nombre_motivo'] = $row["nombre_motivo"];
									$datos['nombre_plan'] = $row["nombre_plan"];
									$datos['n_voucher'] = $row["n_voucher"];
									$datos['total_vaucher'] = $row["total_vaucher"];
									$datos['deposito'] = $row["deposito"];
									$datos['id_vaucher'] = $row["id_vaucher"];
									$datos['vaucher_fecha_crea'] = $row["vaucher_fecha_crea"];
										
										
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
	}else if ($codigo == "traer_menu_acciones") {//titulares
		$result = mysqli_query($conn, 	"SELECT app_accion.*, app_modulos.nombre AS modulo FROM usuarios 
										INNER JOIN app_perfil ON usuarios.tipo = app_perfil.nombre
										INNER JOIN app_permisos ON app_perfil.id = app_permisos.id_perfil 
										INNER JOIN app_accion ON app_permisos.id_accion = app_accion.id 
										INNER JOIN app_modulos ON app_accion.id_modulo = app_modulos.id 
										WHERE usuarios.id = $id_autor AND app_modulos.nombre = '$parametro1'");
		$data = array();										
		if(mysqli_num_rows($result) > 0)
		{	
									$response["resultado"] = array();
									while ($row = mysqli_fetch_array($result)) {
									$datos = array();
										
									$datos['id'] = $row["id"];
									$datos['nombre'] = $row["nombre"];
										
										
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
	}else if ($codigo == "traer_perfiles") {//titulares
		$result = mysqli_query($conn, 	"SELECT * FROM app_perfil WHERE activo = true");
		$data = array();										
		if(mysqli_num_rows($result) > 0)
		{	
									$response["resultado"] = array();
									while ($row = mysqli_fetch_array($result)) {
									$datos = array();
										
									$datos['id'] = $row["id"];
									$datos['nombre'] = $row["nombre"];
										
										
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