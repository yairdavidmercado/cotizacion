<?php

 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
 include 'conexion.php';
 require '../../vendor/autoload.php';

        $id = $_POST["id"];
         
      $response = [];
		$conn = pg_connect("user=".DB_USER." password=".DB_PASS." port=".DB_PORT." dbname=".DB_NAME." host=".DB_HOST) or die ("Could not connect to server\n");

		try{
			pg_query("BEGIN") or die("Could not start transaction\n");
         $result = pg_query($conn, "UPDATE usuarios_pqrs set active = true, fecha_active = now() WHERE email = '$id';");
			$fch = pg_affected_rows($result);
			if ($fch == 1) {

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
				$mail->Subject = 'Tu cuenta ha sido activada';
				$message  = "<html><body>";
	   
				$message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";
				   
				$message .= "<tr><td>";
				   
				$message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
				   
				$message .= "<thead>
				<tr height='80'>
				<th colspan='4' style='background-color:#f5f5f5; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#333; font-size:25px;' >Recuperación de cuenta</th>
				</tr>
							</thead>";
				   
				$message .= "<tbody>
					  <tr>
					  <td colspan='4' style='padding:15px;'>
					  <img src='http://170.246.112.3:8091/gestion_documental/assets/img/logos.png' alt='Sending HTML eMail using PHPMailer in PHP' title='Sending HTML eMail using PHPMailer in PHP' style='height:auto; width:100%; max-width:100%;' />
					  <p style='font-size:20px;'>Cordial saludo, has activado la cuenta y te damos la bienvenida, Gracias por ser parte de la E.S.E VIDA SINU.</a></p>
					  <hr />
					  <p style='font-size:12px;'>Recurda que:</p>
					  <p style='font-size:12px;'>Si tienes dudas nos puedes contactar <a href='http://www.esevidasinu.gov.co/'>www.esevidasinu.gov.co</a></p>
					  <p style='font-size:12px; font-family:Verdana, Geneva, sans-serif;'>.</p>
					  </td>
					  </tr>
					  
							</tbody>";
				   
				$message .= "</table>";
				   
				$message .= "</td></tr>";
				$message .= "</table>";
				   
				$message .= "</body></html>";
				$mail->MsgHTML($message);
				$mail->SetFrom('respuestavu@esevidasinu.gov.co');
				$mail->AddAddress($id);
				$mail->AddAddress('recepcionvu@esevidasinu.gov.co');
				if(!$mail->Send()) {
				   $response["numero"] = "Error";
				}else{
				   $response["numero"] = "exitoso";
				}

				$response["success"] = true;
				$response["message"] = "Commiting transaction.";
            pg_query("COMMIT") or die("Transaction commit failed\n");
            echo json_encode($response);
			} else {
				$response["success"] = false;
				$response["message"] = "Rolling back transaction.";
            pg_query("ROLLBACK") or die("Transaction rollback failed\n");;
            echo json_encode($response);
			}
		}catch(Exception $e){
			$response["success"] = false;
			$response["message"] = $e->getMessage();
			echo json_encode($response);
		}
		pg_close($conn); 
?>
