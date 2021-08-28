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
		if(mysqli_num_rows($result) > 0)
		{	
									$data = array();
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