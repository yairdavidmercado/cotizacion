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
	if ($codigo == "traer_metodo_pago") {
		$result = mysqli_query($conn, 	"SELECT * FROM metodo_pago WHERE activo = true;");
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
	}else if ($codigo == "traer_metodo_pago_id") {
		$result = mysqli_query($conn, 	"SELECT * FROM metodo_pago WHERE id = $parametro1;");
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