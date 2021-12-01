<?php 
SESSION_START();
 include 'conectCompany.php';  


$codigo = $_POST["codigo"];
$parametro1 = $_POST["parametro1"];
$parametro2 = $_POST["parametro2"];                

//parametros de conexion a la base de datos del cliente

$conn = mysqli_connect(DB_HOST,DB_USER, DB_PASS, DB_NAME); 
if (!$conn) {
	die('No pudo conectarse: ' . mysqli_error());
}

if ($conn) {
	if ($codigo == "sel_empresas") {
		$result = mysqli_query($conn, 	"SELECT * FROM empresas WHERE activo = true;");
		$data = array();												
		if(mysqli_num_rows($result) > 0)
		{	
									$response["resultado"] = array();
									while ($row = mysqli_fetch_array($result)) {
									$datos = array();
										
									$datos["id"] 		    = $row["id"];
                                    $datos["nombre"] 	    = $row["nombre"];
									$datos["dbname"] 	    = $row["dbname"];
                                    $datos["avatar"] 	    = $row["avatar"];
                                    $datos["descripcion"] 	= $row["descripcion"];
										
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
	}else if ($codigo == "loginCompany") {
        $response["resultado"] = array();
		$_SESSION["dbname"] = $parametro1;
        $response["success"] = true;
        $response["message"] = "La base de datos seleccinada es: ".$_SESSION["dbname"];
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