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