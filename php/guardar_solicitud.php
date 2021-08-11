<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	include 'conexion.php';
	require '../../vendor/autoload.php';

	session_start();
	$google_url = "https://www.google.com/recaptcha/api/siteverify";
	$str = $_POST['g-recaptcha-response'];
	$secret = '6LcW7vIUAAAAADSkN6FTLPLW0lhEAA7H2bkIDe1j';
	$ip = $_SERVER['REMOTE_ADDR'];
	$url = $google_url."?secret=".$secret."&response=".$str."&remoteip=".$ip;
	$response = [];
	//INICIAMOS cURL
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_TIMEOUT, 10);
	curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
	$res = curl_exec($curl);
	curl_close($curl);
	 
	$resp = json_decode($res, true);
	 
	//CHEQUEAMOS EL RESULTADO
	if($resp['success']) {

		// connect and login to FTP server
		$ftp_server = "190.121.135.236";
		$ftp_username   = "anonymous";
		$ftp_password   =  "anonymous@example.com";
		$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
		$login = ftp_login($ftp_conn, $ftp_username, $ftp_password);
		$namefile = $_FILES["soporte_adjunto"]["name"]; 
		$file = $_FILES["soporte_adjunto"]["tmp_name"]; 
		$path_info = pathinfo($namefile);
		$nuevo_nombre = uniqid().".".$path_info['extension'];
		$remote_file_path = "/imagenes/pqrsdf/documents/".$nuevo_nombre;
		ftp_pasv($ftp_conn, true);
		// upload file 
		if (ftp_put($ftp_conn, $remote_file_path , $file, FTP_BINARY)){
			
				$idUser						= $_SESSION['idUser'];
				$razon						= $_SESSION['nameUser'];
				$conse						= $_SESSION['conse'];
				$email						= $_SESSION['email'];
				$telefono					= $_SESSION["Telefono"];
				$celular					= $_SESSION["Celular"];
				$direccion					= $_SESSION["Direccion"];
				$fecha_nace					= $_SESSION["Fecha_nace"];
				$tipo_id					= $_SESSION["Tipo_id"];
				$etnia						= $_SESSION["Etnia"];
				$poblacion					= $_SESSION["Poblacion"];
				$eps						= $_SESSION["Eps"];
				$sexo						= $_SESSION["Sexo"];
				$tipo_solicitud				= $_POST["tipo_solicitud"];
				$sede 						= $_POST["sede"];
				$area 						= $_POST["area"];
				$fecha_suceso 				= $_POST["fecha_suceso"];
				$asunto 					= $_POST["asunto"];
				$descripcion 				= $_POST["descripcion"];
				$url 						= $remote_file_path;
			
				$notificacion 				= $_POST["notificar"];

				$tipo_notificacion 			= "";
				$text_notificacion 			= "";

				if ($notificacion == 'SI') {
					$tipo_notificacion 			= $_POST["tipo_notificacion"];
					$text_notificacion 			= $_POST["text_notificacion"];
				}

			$conn = pg_connect("user=".DB_USER." password=".DB_PASS." port=".DB_PORT." dbname=".DB_NAME." host=".DB_HOST) or die ("Could not connect to server\n");

			try{
				pg_query("BEGIN") or die("Could not start transaction\n");
				$result3 = pg_query($conn, "SELECT nombre_tramite FROM tipo_tramite WHERE id_tramite = $tipo_solicitud;");
				$fch3 = pg_fetch_row($result3);
				$result2 = pg_query($conn, "SELECT NOW()::date;");
				$fch2 = pg_fetch_row($result2);
				$result = pg_query($conn, "SELECT guardar_pqrs('$idUser', '$tipo_solicitud', '$sede', '$area', '$fecha_suceso', '$asunto', '$descripcion', '$url', '$conse', '$notificacion', '$tipo_notificacion', '$text_notificacion');");
				$fch = pg_fetch_row($result);
				$strArr = explode(",", $fch[0]);
				//echo $fch[0]; 
				if ($fch[0] !== '0,0') {

					$mail = new PHPMailer();
					$mail->From = 'recepcionvu@esevidasinu.gov.co';
					$mail->FromName = 'E.S.E VIDA SINU';
					$mail->IsHTML(true);
					$mail->CharSet = 'utf-8';
					$mail->IsSMTP();
					$mail->Host = "smtp.office365.com";
					$mail->Port = 587;
					$mail->SMTPSecure = "";
					$mail->SMTPAuth = true;
					$mail->Username = 'respuestavu@esevidasinu.gov.co';
					$mail->Password = 'Vida2017';
					//$mail->SMTPDebug  = 3;
					//$mail->Debugoutput = function($str, $level) {echo "debug level $level; message: $str";}; //$mail->Debugoutput = 'echo';
					$mail->Subject = 'Su solicitud se ha enviado con éxito';
					
					$message = "<!DOCTYPE html>
								<html lang='en'>
								<head>
									<meta charset='UTF-8'>
									<meta name='viewport' content='width=device-width, initial-scale=1.0'>
									<title>Document</title>
								</head>
								<style>
									#customers {
									font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif;
									border-collapse: collapse;
									width: 100%;
									}
									
									#customers td, #customers th {
									border: 1px solid #ddd;
									padding: 8px;
									}
									
									#customers tr:hover {background-color: #ddd;}
									
									#customers th {
									padding-top: 12px;
									padding-bottom: 12px;
									text-align: left;
									background-color: #4CAF50;
									color: white;
									}
								</style>
								<body>
								<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>
									<tr>
										<td>
											<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>
												<thead>
													<tr height='80'>
														<th colspan='4' style='background-color:#f5f5f5; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#333; font-size:25px;' >Su solicitud se ha enviado con éxito</th>
													</tr>
												</thead>
												<tbody>
													<tr>
													<td colspan='4' style='padding:10px;'>
													<img src='http://170.246.112.3:8091/gestion_documental/assets/img/logos.png' style='height:auto; width:30%; max-width:30%;' />
													<p style='font-size:10px;float:right;width:65%;height:auto'><b>La solicitud de su PQRSF fue recibida con éxito y próximamente será procesada, para el seguimiento en línea de su PQRSF, puede hacerlo a través de nuestra página web, llamando a nuestras líneas o en este <a href='http://170.246.112.3:8091/gestion_documental/home.php'>ENLACE</a> con la siguiente información:</b></a></p>
													<table border='1' style='margin-top:50px' id='customers'>
														<tr>
															<td>CÓDIGO DE VERIFICACIÓN</td>
															<td>".$strArr[0]."</td>
														</tr>
														<tr>
															<td>RADICADO</td>
															<td>".$strArr[1]."</td>
														</tr>
														<tr>
															<td>FECHA DE RADICACIÓN</td>
															<td>".$fch2[0]."</td>
														</tr>
														<tr>
															<td>TIPO DE SOLICITUD</td>
															<td>".$fch3[0]."</td>
														</tr>
													</table>
													<p style='font-size:12px;'>La solicitud recibida fue la siguiente:</p>
													<p style='font-size:12px;'><b>Nombre: </b>$razon </p>
													<p style='font-size:12px;'><b>Tipo de indentificación:$tipo_id </b> </p>
													<p style='font-size:12px;'><b>Identificación: </b>$idUser</p>
													<p style='font-size:12px;'><b>Teléfono fijo: </b>$telefono </p>
													<p style='font-size:12px;'><b>Celular: </b>$celular </p>
													<p style='font-size:12px;'><b>Dirección: </b>$direccion </p>
													<p style='font-size:12px;'><b>Medio de respuesta: </b>Correo electrónico</p>
													<p style='font-size:12px;'><b>Asunto: </b>$asunto </p>
													<p style='font-size:12px;'><b>Descripción:$descripcion </b> </p>
													<p style='font-size:12px;'><b>Soporte: </b>$nuevo_nombre </p>
													<p style='font-size:14px;text-align:center'><b>Por favor, NO responda a este mensaje, es un envío automático</b></b></p>
													<p style='font-size:12px; font-family:Verdana, Geneva, sans-serif;'>.</p>
													</td>
													</tr>    
												</tbody>
											</table>
										</td>
									</tr>
								</table>
							</body>
						</html>";
					
					$mail->MsgHTML($message);
					$mail->SetFrom('respuestavu@esevidasinu.gov.co');
					$mail->AddAddress($email);
					$mail->AddAddress('recepcionvu@esevidasinu.gov.co');
					if(!$mail->Send()) {
					$response["numero"] = "Error";
					}else{
					$response["numero"] = "exitoso";
					}

					$response["numero"] = $fch[0];
					$response["success"] = true;
					$response["message"] = "Commiting transaction.";
					pg_query("COMMIT") or die("Transaction commit failed\n");
					echo json_encode($response);
				} else {
					$response["numero"] = $fch[0];
					$response["success"] = false;
					$response["message"] = "Rolling back transaction.";
					pg_query("ROLLBACK") or die("Transaction rollback failed\n");
					echo json_encode($response);
				}
			}catch(Exception $e){
				$response["success"] = false;
				$response["message"] = $e->getMessage();
				echo json_encode($response);
			}
			pg_close($conn); 

		} else {
			$response["message"] = "could not connect as";
		}

		// close connection
		ftp_close($ftp_conn);

	} else {
		$response["success"] = false;
		$response["message"] = "Por favor verifica que no seas un robot.";
		echo json_encode($response);
		//Captcha incorrecto
	}

?>