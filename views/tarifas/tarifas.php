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
	if ($codigo == "traer_tarifas") {
		$result = mysqli_query($conn, 	"SELECT *, (SELECT nombre FROM planes WHERE planes.id = tarifas.id_plan) as nombre_plan 
										FROM tarifas WHERE id_hotel = $parametro1 AND activo = true;");
		if(mysqli_num_rows($result) > 0)
		{	
									$data = array();
									while ($row = mysqli_fetch_array($result)) {
									$datos = array();
										
									$datos["id"] 			= $row["id"];
									$datos["nombre"]		= $row["nombre"];
									$datos["child"]			= $row["child"];
									$datos["adult_s"] 		= $row["adult_s"];
									$datos["adult_d"] 		= $row["adult_d"];
									$datos["adult_t_c"] 	= $row["adult_t_c"];
									$datos["descripcion"] 	= $row["descripcion"];
									$datos["nombre_plan"] 	= $row["nombre_plan"];
									$datos["fecha_crea"] 	= $row["fecha_crea"];
									$datos["noches"] 		= $row["noches"];
										
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
	}else if($codigo == "2"){

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