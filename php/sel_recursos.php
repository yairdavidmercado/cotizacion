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
		$id_hotel_param = intval($parametro1);
		$id_tipo_plan_param = intval($parametro2);
		$filtro_tipo_plan = '';
		if ($id_tipo_plan_param > 0) {
			$filtro_tipo_plan = " AND id_tipo_plan = $id_tipo_plan_param ";
		}
		$result = mysqli_query($conn, 	"SELECT * FROM planes WHERE id_hotel = $id_hotel_param AND activo = true $filtro_tipo_plan;");
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
		$parametro1 = intval($parametro1);
		
		// Determinar si el ID recibido corresponde a un master o a un detalle
		$id_principal = 0;
		$check_master = mysqli_query($conn, "SELECT id FROM cotizacion_master WHERE id = $parametro1 LIMIT 1");
		if ($check_master && mysqli_num_rows($check_master) > 0) {
			$id_principal = $parametro1;
		} else {
			// Primero obtener el id_principal de la cotización solicitada
			$query_principal = mysqli_query($conn, "SELECT id_principal FROM cotizacion WHERE id = $parametro1");
			if ($row_principal = mysqli_fetch_array($query_principal)) {
				$id_principal = intval($row_principal['id_principal']);
			}
		}
		
		error_log("traer_cotizacion - ID solicitado: $parametro1, id_principal encontrado: $id_principal");
		
		// Si no hay id_principal, significa que es una cotización antigua sin migrar
		// En este caso, intentamos encontrar otras cotizaciones con el mismo titular y fechas similares
		// o simplemente retornamos solo esa cotización
		if ($id_principal <= 0) {
			error_log("traer_cotizacion - Cotización sin id_principal, intentando encontrar por ID directo");
			// Intentar obtener la cotización directamente
			$test_query = mysqli_query($conn, "SELECT id, id_titular, id_principal FROM cotizacion WHERE id = $parametro1");
			if ($test_row = mysqli_fetch_array($test_query)) {
				error_log("traer_cotizacion - Cotización encontrada: ID=" . $test_row['id'] . ", id_titular=" . $test_row['id_titular'] . ", id_principal=" . $test_row['id_principal']);
			} else {
				error_log("traer_cotizacion - NO se encontró la cotización con ID $parametro1");
			}
		}
		
		// Ahora buscar TODAS las cotizaciones con el mismo id_principal
		$where_clause = $id_principal > 0 ? "cotizacion.id_principal = $id_principal" : "cotizacion.id = $parametro1";
		
		error_log("traer_cotizacion - WHERE clause: $where_clause");
		
		$result = mysqli_query($conn, 	"SELECT cotizacion.*, 
										COALESCE(cotizacion_master.id_titular, cotizacion.id_titular) as id_titular,
										COALESCE(cotizacion_master.id_hotel, cotizacion.id_hotel) as id_hotel,
										COALESCE(cotizacion_master.cod_vendedor, cotizacion.cod_vendedor) as cod_vendedor,
										COALESCE(cotizacion_master.estado, 1) as estado,
										COALESCE(cotizacion_master.id_autor, cotizacion.id_autor) as id_autor,
										COALESCE(cotizacion_master.created_at, cotizacion.fecha_expedicion) as created_at,
										COALESCE(cotizacion_master.update_at, cotizacion.fecha_crea) as update_at,
										(SELECT nombre FROM motivos WHERE motivos.id = cotizacion.id_motivo) AS nombre_motivo,
										(SELECT nombre FROM planes WHERE planes.id = cotizacion.id_plan) AS nombre_plan,
										(SELECT descripcion FROM planes WHERE planes.id = cotizacion.id_plan) AS descripcion_plan,
										(SELECT descripcion FROM terminos_condiciones WHERE terminos_condiciones.id = cotizacion.id_terminos) AS terminos,
										(SELECT reserva FROM vaucher WHERE vaucher.id_cotizacion = cotizacion.id AND vaucher.activo = true LIMIT 1 ) as n_reserva,
										(SELECT noches FROM tarifas WHERE tarifas.id = cotizacion.id_tarifa LIMIT 1 ) as tipo_servicio,
										(SELECT COUNT(vaucher.id) FROM vaucher  WHERE vaucher.id_cotizacion = cotizacion.id AND vaucher.activo = true) as total_vaucher,
										(SELECT SUM(vaucher.deposito) FROM vaucher  WHERE vaucher.id_cotizacion = cotizacion.id AND vaucher.activo = true) as deposito,
										(SELECT id FROM vaucher WHERE vaucher.id_cotizacion = cotizacion.id AND vaucher.activo = true order by id desc limit 1) as id_vaucher,
										(SELECT fecha_crea FROM vaucher WHERE vaucher.id_cotizacion = cotizacion.id AND vaucher.activo = true order by id desc limit 1) as vaucher_fecha_crea
										FROM cotizacion 
										LEFT JOIN cotizacion_master ON cotizacion.id_principal = cotizacion_master.id
										WHERE $where_clause
										ORDER BY cotizacion.tipo_cotizacion ASC;");
		
		$num_rows = mysqli_num_rows($result);
		error_log("traer_cotizacion - Total cotizaciones encontradas: $num_rows");
		
		if($num_rows > 0)
		{	
									$response["resultado"] = array();
									$id_titular_comun = 0; // Para obtener info del titular una sola vez
									
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
										$datos['tipo_servicio'] = $row["tipo_servicio"];
										$datos['tipo_cotizacion'] = $row["tipo_cotizacion"];
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

										if ($id_titular_comun == 0) {
											$id_titular_comun = $row["id_titular"] == "" ? 0 : (int)$row["id_titular"];
										}
										
										$id_tarifa = $row["id_tarifa"] == "" ? "0":  $row["id_tarifa"];
										$id_plan = $row["id_plan"] == "" ? "0": $row["id_plan"];
										
										// Obtener info_tarifa para esta cotización
										$info_tarifa_query = mysqli_query($conn, "SELECT * FROM tarifas WHERE id = $id_tarifa;");
										$datos['info_tarifa'] = array();
										if ($row_tarifa = mysqli_fetch_array($info_tarifa_query)) {
											$datos['info_tarifa'] = array(
												"id" => $row_tarifa["id"],
												"nombre" => $row_tarifa["nombre"],
												"child" => $row_tarifa["child"],
												"adult_s" => $row_tarifa["adult_s"],
												"adult_d" => $row_tarifa["adult_d"],
												"adult_t_c" => $row_tarifa["adult_t_c"],
												"noches" => $row_tarifa["noches"]
											);
										}
										
										// Obtener info_planes para esta cotización
										$info_planes_query = mysqli_query($conn, "SELECT productos.* FROM tipo_plan 
																			INNER JOIN productos ON tipo_plan.id_producto = productos.id 
																			WHERE id_plan = $id_plan;");
										$datos['info_planes'] = array();
										while ($row_plan = mysqli_fetch_array($info_planes_query)) {
											$datos['info_planes'][] = array(
												"id" => $row_plan["id"],
												"nombre" => $row_plan["nombre"],
												"tipo" => $row_plan["tipo"]
											);
										}
										
										// push single product into final response array
										array_push($response["resultado"], $datos);
									}

										// Info del titular (común para todas las cotizaciones)
										$info_titular = mysqli_query($conn, "SELECT *, 
																			(SELECT paisnombre FROM pais WHERE pais.id = id_pais) as pais, 
																			(SELECT estadonombre FROM estado WHERE estado.id = id_depto) as depto 
																			FROM usuarios WHERE id = $id_titular_comun ;");
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
										
									$response["id_principal"] = $id_principal > 0 ? $id_principal : $parametro1;
									$response["success"] = true;
									echo json_encode($response);

		}else{
				$response["success"] = false;
				$response["message"] = "No se encontraron registros";
				// echo no users JSON
				echo json_encode($response);
		}
	}else if ($codigo == "traer_abonos_voucher") {//abonos reales por cotizacion master
		$parametro1 = intval($parametro1);
		$id_principal = 0;

		$check_master = mysqli_query($conn, "SELECT id FROM cotizacion_master WHERE id = $parametro1 LIMIT 1");
		if ($check_master && mysqli_num_rows($check_master) > 0) {
			$id_principal = $parametro1;
		} else {
			$query_principal = mysqli_query($conn, "SELECT id_principal FROM cotizacion WHERE id = $parametro1 LIMIT 1");
			if ($query_principal && ($row_principal = mysqli_fetch_array($query_principal))) {
				$id_principal = intval($row_principal['id_principal']);
			}
		}

		$where_cotizacion = $id_principal > 0 ? "c.id_principal = $id_principal" : "c.id = $parametro1";

		$id_master = $id_principal > 0 ? $id_principal : $parametro1;
		$info_query = mysqli_query($conn, "SELECT 
									cm.id,
									cm.created_at,
									(SELECT CONCAT_WS(' ', u.nombre1, u.nombre2, u.apellido1, u.apellido2)
									 FROM usuarios u
									 WHERE u.id = cm.id_titular
									 LIMIT 1) AS nombre_titular,
									(SELECT CONCAT_WS(' ', ug.nombre1, ug.nombre2, ug.apellido1, ug.apellido2)
									 FROM ".DB_NAME_GLOBAL.".usuarios ug
									 WHERE ug.id = cm.id_autor
									 LIMIT 1) AS nombre_autor,
									COALESCE((
										SELECT SUM(
											(
												COALESCE(c.n_child,0) * COALESCE(t.child,0) +
												COALESCE(c.n_adult_s,0) * COALESCE(t.adult_s,0) +
												COALESCE(c.n_adult_d,0) * COALESCE(t.adult_d,0) +
												COALESCE(c.n_adult_t_c,0) * COALESCE(t.adult_t_c,0)
											) *
											(CASE
												WHEN c.noche IS NULL OR c.noche = 0 OR c.noche = 'N/A' THEN 1
												WHEN c.noche REGEXP '^[0-9]+$' THEN CAST(c.noche AS UNSIGNED)
												ELSE 1
											END)
										)
										FROM cotizacion c
										LEFT JOIN tarifas t ON t.id = c.id_tarifa
										WHERE c.id_principal = cm.id AND c.activo = 1
									), 0) AS total_cotizacion,
									COALESCE((
										SELECT SUM(v2.deposito)
										FROM vaucher v2
										INNER JOIN cotizacion c2 ON c2.id = v2.id_cotizacion
										WHERE c2.id_principal = cm.id AND c2.activo = 1 AND v2.activo = 1
									), 0) AS total_abono
								FROM cotizacion_master cm
								WHERE cm.id = $id_master
								LIMIT 1");

		$response["info"] = array(
			"id" => $id_master,
			"created_at" => "",
			"nombre_titular" => "",
			"nombre_autor" => "",
			"total_cotizacion" => 0,
			"total_abono" => 0,
			"saldo_total" => 0
		);

		if ($info_query && mysqli_num_rows($info_query) > 0) {
			$info_row = mysqli_fetch_array($info_query);
			$total_cotizacion_info = floatval($info_row['total_cotizacion']);
			$total_abono_info = floatval($info_row['total_abono']);

			$response["info"] = array(
				"id" => $info_row['id'],
				"created_at" => $info_row['created_at'],
				"nombre_titular" => $info_row['nombre_titular'],
				"nombre_autor" => $info_row['nombre_autor'],
				"total_cotizacion" => $total_cotizacion_info,
				"total_abono" => $total_abono_info,
				"saldo_total" => ($total_cotizacion_info - $total_abono_info)
			);
		}

		$result = mysqli_query($conn, "SELECT 
									v.id AS id_vaucher,
									v.id_cotizacion,
									v.reserva,
									v.deposito,
									v.id_metodo_pago,
									v.fecha_crea,
									c.id_principal,
									c.tipo_cotizacion,
									c.id_titular
								FROM vaucher v
								INNER JOIN cotizacion c ON c.id = v.id_cotizacion
								WHERE $where_cotizacion
								AND c.activo = 1
								AND v.activo = 1
								ORDER BY v.id DESC");

		$cotizaciones_result = mysqli_query($conn, "SELECT
									c.id,
									c.tipo_cotizacion,
									COALESCE(COUNT(v.id), 0) AS total_abonos,
									COALESCE(SUM(v.deposito), 0) AS total_abonado,
									(SELECT CONCAT_WS(' ', u.nombre1, u.nombre2, u.apellido1, u.apellido2)
									 FROM usuarios u
									 WHERE u.id = c.id_titular
									 LIMIT 1) AS titular
								FROM cotizacion c
								LEFT JOIN vaucher v ON v.id_cotizacion = c.id AND v.activo = 1
								WHERE $where_cotizacion
								AND c.activo = 1
								GROUP BY c.id, c.tipo_cotizacion, c.id_titular
								ORDER BY c.id ASC");

		$response['cotizaciones'] = array();
		if ($cotizaciones_result) {
			while ($row_cot = mysqli_fetch_array($cotizaciones_result)) {
				$tipo_label = 'Cotización';
				if ($row_cot['tipo_cotizacion'] == '1') {
					$tipo_label = 'Alojamiento';
				} else if ($row_cot['tipo_cotizacion'] == '2') {
					$tipo_label = 'Tour';
				} else if ($row_cot['tipo_cotizacion'] == '3') {
					$tipo_label = 'Alquiler';
				}

				$response['cotizaciones'][] = array(
					'id' => $row_cot['id'],
					'tipo_cotizacion' => $row_cot['tipo_cotizacion'],
					'tipo_label' => $tipo_label,
					'label' => '#' . $row_cot['id'] . ' - ' . $tipo_label,
					'titular' => $row_cot['titular'],
					'total_abonos' => intval($row_cot['total_abonos']),
					'total_abonado' => floatval($row_cot['total_abonado'])
				);
			}
		}

		if ($result && mysqli_num_rows($result) > 0)
		{
			$response["resultado"] = array();
			$total_abonos = 0;

			while ($row = mysqli_fetch_array($result)) {
				$datos = array();
				$datos['id_vaucher'] = $row['id_vaucher'];
				$datos['id_cotizacion'] = $row['id_cotizacion'];
				$datos['reserva'] = $row['reserva'];
				$datos['deposito'] = $row['deposito'];
				$datos['id_metodo_pago'] = $row['id_metodo_pago'];
				$datos['fecha_crea'] = $row['fecha_crea'];
				$datos['id_principal'] = $row['id_principal'];
				$datos['tipo_cotizacion'] = $row['tipo_cotizacion'];
				$datos['id_titular'] = $row['id_titular'];

				$total_abonos += floatval($row['deposito']);
				array_push($response["resultado"], $datos);
			}

			$response['total_abonos'] = $total_abonos;
			$response['total_abono'] = $total_abonos;
			$response['id_principal'] = $id_principal > 0 ? $id_principal : $parametro1;
			$response["success"] = true;
			echo json_encode($response);
		}else{
			$response["success"] = true;
			$response["message"] = "No se encontraron abonos";
			$response['resultado'] = array();
			$response['total_abonos'] = 0;
			$response['total_abono'] = 0;
			$response['id_principal'] = $id_principal > 0 ? $id_principal : $parametro1;
			echo json_encode($response);
		}
	}else if ($codigo == "traer_tabla_cotizacion") {//titulares
		$condicion_master = '';
		if ($id_perfil !== 'SUPERADMIN') {
			$condicion_master = "AND cm.id_autor = $id_autor";
		}
		$result = mysqli_query($conn, 	"SELECT 
								cm.id,
								cm.id_titular,
								cm.id_hotel,
								cm.cod_vendedor,
								cm.estado,
								cm.id_autor,
								cm.id_autor_at,
								cm.created_at,
								cm.update_at,
								(SELECT GROUP_CONCAT(DISTINCT CASE 
									WHEN c.tipo_cotizacion = 1 THEN 'Alojamiento'
									WHEN c.tipo_cotizacion = 2 THEN 'Tours'
									WHEN c.tipo_cotizacion = 3 THEN 'Alquiler'
									ELSE NULL
								END ORDER BY c.tipo_cotizacion ASC SEPARATOR ', ')
								FROM cotizacion c
								WHERE c.id_principal = cm.id AND c.activo = 1) AS tipos_cotizacion,
								(SELECT CONCAT_WS(' ', nombre1, nombre2, apellido1, apellido2) 
									FROM usuarios 
									WHERE usuarios.id = cm.id_titular 
									LIMIT 1) AS nombre_titular,
								(SELECT CONCAT_WS(' ', nombre1, nombre2, apellido1, apellido2) 
									FROM ".DB_NAME_GLOBAL.".usuarios 
									WHERE ".DB_NAME_GLOBAL.".usuarios.id = cm.id_autor 
									LIMIT 1) AS nombre_autor
								FROM cotizacion_master cm
								WHERE cm.id_hotel = $id_hotel $condicion_master
								ORDER BY cm.created_at DESC");
		$data = array();									
		if(mysqli_num_rows($result) > 0)
		{	
									
									while ($row = mysqli_fetch_array($result)) {
									$datos = array();
									
									$datos['id'] = $row["id"];
									$datos['cod_vendedor'] = $row["cod_vendedor"];
							$datos['id_titular'] = $row["id_titular"];
							$datos['nombre_titular'] = $row["nombre_titular"];
									$datos['estado'] = $row["estado"];
									$datos['id_autor'] = $row["id_autor"];
							$datos['nombre_autor'] = $row["nombre_autor"];
									$datos['created_at'] = $row["created_at"];
									$datos['update_at'] = $row["update_at"];
									$datos['tipos_cotizacion'] = $row["tipos_cotizacion"];
									
									array_push($data, $datos);
								}
								$response = array("draw" => 1,
							    "recordsTotal" => 0,
							    "recordsFiltered" => 0,
								"data" => $data);
								echo json_encode($response);

		}else{
			$response = array("draw" => 1,
			"recordsTotal" => 0,
			"recordsFiltered" => 0,
			"data" => $data);
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
	}else if ($codigo == "traer_tabla_voucher") {//titulares
		$condicion_master = '';
		if ($id_perfil !== 'SUPERADMIN') {
			$condicion_master = "AND cm.id_autor = $id_autor";
		}
		$result = mysqli_query($conn, 	
								"SELECT 
								cm.id,
								cm.id_titular,
								cm.id_hotel,
								cm.cod_vendedor,
								cm.estado,
								cm.id_autor,
								cm.id_autor_at,
								cm.created_at,
								cm.update_at,

								(
									SELECT CONCAT_WS(' ', u.nombre1, u.nombre2, u.apellido1, u.apellido2)
									FROM usuarios u
									WHERE u.id = cm.id_titular
									LIMIT 1
								) AS nombre_titular,

								(
									SELECT CONCAT_WS(' ', ug.nombre1, ug.nombre2, ug.apellido1, ug.apellido2)
									FROM ".DB_NAME_GLOBAL.".usuarios ug
									WHERE ug.id = cm.id_autor
									LIMIT 1
								) AS nombre_autor,
								ct.total_cotizaciones,
								COALESCE(ct.total_general, 0) AS total,
								COALESCE(vt.total_abono, 0) AS total_abono,
								(COALESCE(ct.total_general, 0) - COALESCE(vt.total_abono, 0)) AS saldo_total

							FROM cotizacion_master cm

							LEFT JOIN (
								SELECT 
									c.id_principal,
									COUNT(c.id) AS total_cotizaciones,
									SUM(
										(
											COALESCE(c.n_child, 0)    * COALESCE(t.child, 0) +
											COALESCE(c.n_adult_s, 0)  * COALESCE(t.adult_s, 0) +
											COALESCE(c.n_adult_d, 0)  * COALESCE(t.adult_d, 0) +
											COALESCE(c.n_adult_t_c, 0)* COALESCE(t.adult_t_c, 0)
										) *
										(
											CASE
												WHEN c.noche IS NULL OR c.noche = 0 OR c.noche = 'N/A' THEN 1
												WHEN c.noche REGEXP '^[0-9]+$' THEN CAST(c.noche AS UNSIGNED)
												ELSE 1
											END
										)
									) AS total_general
								FROM cotizacion c
								LEFT JOIN tarifas t 
									ON t.id = c.id_tarifa
								WHERE c.activo = 1
								GROUP BY c.id_principal
							) ct ON ct.id_principal = cm.id

							LEFT JOIN (
								SELECT 
									c.id_principal,
									SUM(COALESCE(v.deposito, 0)) AS total_abono
								FROM cotizacion c
								INNER JOIN vaucher v 
									ON v.id_cotizacion = c.id
								AND v.activo = 1
								WHERE c.activo = 1
								GROUP BY c.id_principal
							) vt ON vt.id_principal = cm.id

							WHERE cm.id_hotel = $id_hotel $condicion_master
							ORDER BY cm.created_at DESC;");
		$data = array();									
		if(mysqli_num_rows($result) > 0)
		{	
									
									while ($row = mysqli_fetch_array($result)) {
									$datos = array();
									
									$datos['id'] = $row["id"];
									$datos['cod_vendedor'] = $row["cod_vendedor"];
									$datos['id_titular'] = $row["id_titular"];
									$datos['nombre_titular'] = $row["nombre_titular"];
									$datos['estado'] = $row["estado"];
									$datos['id_autor'] = $row["id_autor"];
									$datos['nombre_autor'] = $row["nombre_autor"];
									$datos['created_at'] = $row["created_at"];
									$datos['update_at'] = $row["update_at"];
									$datos['total'] = $row["total"];
									$datos['total_abono'] = $row["total_abono"];
									$datos['saldo_total'] = $row["saldo_total"];
									$datos['total_cotizaciones'] = $row["total_cotizaciones"];
									array_push($data, $datos);
								}
								$response = array("draw" => 1,
							    "recordsTotal" => count($data),
							    "recordsFiltered" => count($data),
								"data" => $data);
								echo json_encode($response);

		}else{
			$response = array("draw" => 1,
			"recordsTotal" => 0,
			"recordsFiltered" => 0,
			"data" => $data);
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