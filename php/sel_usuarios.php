<?php 
SESSION_START();
 include 'conectCompany.php';  


$codigo = $_POST["codigo"];
$parametro1 = $_POST["parametro1"];
$parametro2 = $_POST["parametro2"];                

//parametros de conexion a la base de datos del cliente

$conn = mysqli_connect(DB_HOST,DB_USER, DB_PASS, DB_NAME); 
if (!$conn) {
	die('No pudo conectarse: ' . mysqli_connect_error());
}

if ($conn) {
	if ($codigo == "login") {
		$result = mysqli_query($conn, 	"SELECT *, 
										(SELECT dbname FROM empresas WHERE empresas.id = usuarios.id_empresa) as dbname,
										(SELECT id FROM empresas WHERE empresas.id = usuarios.id_empresa) as id_db  
										FROM usuarios WHERE ( codigo = '$parametro1') AND pass =  MD5('$parametro2');");
		if(mysqli_num_rows($result) > 0)
		{	
									$response["resultado"] = array();
									while ($row = mysqli_fetch_array($result)) {
									$datos = array();
										
										$_SESSION["id"] 			= $row["id"];
										$_SESSION["nombre1"]		= $row["nombre1"];
										$_SESSION["nombre2"]		= $row["nombre2"];
										$_SESSION["apellido1"]		= $row["apellido1"];
										$_SESSION["apellido2"]		= $row["apellido2"];
										$_SESSION["perfil"] 		= $row["tipo"];
										$_SESSION["codigo"] 		= $row["codigo"];
										$_SESSION["cedula"] 		= $row["cedula"];
										$_SESSION["dbname"] 		= $row["dbname"];
										$_SESSION["id_db"] 			= $row["id_db"];
										
										// push single product into final response array
										//array_push($response["resultado"], $datos);
									}
									$response["success"] = true;
									echo json_encode($response);
									//creando menu
									$id_autor = $_SESSION["id"];
									$result1 = mysqli_query($conn, 	"SELECT app_modulos.id, app_modulos.nombre, app_modulos.tipo, app_modulos.url, app_modulos.orden FROM usuarios 
																	INNER JOIN app_perfil ON usuarios.tipo = app_perfil.nombre
																	INNER JOIN app_permisos ON app_perfil.id = app_permisos.id_perfil 
																	INNER JOIN app_accion ON app_permisos.id_accion = app_accion.id 
																	INNER JOIN app_modulos ON app_accion.id_modulo = app_modulos.id 
																	WHERE usuarios.id = $id_autor GROUP BY 1, 2, 3, 4, 5 ORDER BY 5 ASC ");
									$data = array();										
									if(mysqli_num_rows($result1) > 0)
									{	
																$response1["resultado"] = array();
																while ($row = mysqli_fetch_array($result1)) {
																$datos = array();
																	
																$datos['id'] = $row["id"];
																$datos['nombre'] = $row["nombre"];
																$datos['url'] = $row["url"];
																$datos['tipo'] = $row["tipo"];
																	
																	
																// push single product into final response array
																array_push($response1["resultado"], $datos);
																}
																$response1["success"] = true;
																$_SESSION['menu_general'] = $response1;
																//echo json_encode($response1);

									}else{
										$response1["success"] = false;
										$_SESSION['menu_general'] = $response1;
										// echo no users JSON
										//echo json_encode($response1);
									}

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