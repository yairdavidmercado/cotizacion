<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include '../conexion.php';
require '../../../vendor/autoload.php';

$conse_tipo_id = $_POST["conse_tipo_id"];
$tipo_persona = $_POST["tipo_persona"];
$tipo_entidad = $_POST["tipo_entidad"];
$id_tercero = $_POST["id_tercero"];
$nombre1 = $_POST["nombre1"];
$nombre2 = $_POST["nombre2"];
$apellido1 = $_POST["apellido1"];
$apellido2 = $_POST["apellido2"];
$email = strtolower($_POST["email"]);
$direccion = $_POST["direccion"];
$fecha_nace = $_POST["day"]."-".$_POST["month"]."-".$_POST["year"];
$sexo = $_POST["sexo"];
$area = $_POST["area"];
$telefono = $_POST["telefono"];
$celular = $_POST["celular"];
$etnia = $_POST["etnia"];
$poblacion = $_POST["poblacion"];
$eps = $_POST["eps"];
$departamento = $_POST["departamento"];
$municipio = $_POST["municipio"];
$pais = $_POST["pais"];
$pass = trim($_POST["password"]);


 $conn = pg_connect("user=".DB_USER." password=".DB_PASS." port=".DB_PORT." dbname=".DB_NAME." host=".DB_HOST);

	try{
		if($conn){
            pg_query("BEGIN") or die("Could not start transaction\n");
		$result = pg_query($conn, "SELECT guardar_tercero('$conse_tipo_id', 
															'$tipo_persona', 
															'$tipo_entidad', 
															'$id_tercero', 
															'$nombre1', 
															'$nombre2', 
															'$apellido1', 
															'$apellido2', 
															'$email', 
															'$direccion', 
															'$fecha_nace', 
															'$sexo', 
															'$area', 
															'$telefono', 
															'$celular', 
															'$etnia', 
															'$poblacion', 
															'$eps', 
															'$pass',
                                                                                          '$departamento',
                                                                                          '$municipio',
                                                                                          '$pais');");											
		$fch = pg_fetch_row($result);


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
            $mail->Subject = 'Activar tu cuenta PQRSDF';
            $message  = "<html><body>";
   
            $message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";
               
            $message .= "<tr><td>";
               
            $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
               
            $message .= "<thead>
            <tr height='80'>
            <th colspan='4' style='background-color:#f5f5f5; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#333; font-size:25px;' >Confirma y Activa tu cuenta</th>
            </tr>
                        </thead>";
               
            $message .= "<tbody>
                  <tr>
                  <td colspan='4' style='padding:15px;'>
                  <img src='http://170.246.112.3:8091/gestion_documental/assets/img/logos.png' alt='Sending HTML eMail using PHPMailer in PHP' title='Sending HTML eMail using PHPMailer in PHP' style='height:auto; width:100%; max-width:100%;' />
                  <p style='font-size:20px;'>Bienvenido a E.S.E VIDASINÚ, Por favor haz click <a href='http://170.246.112.3:8091/gestion_pqrsdf/activar_cuenta.php?id=".$email."'>aqui.</a> para activar tu cuenta.</p>
                  <hr />
                  <p style='font-size:12px;'>Recurda que:</p>
                  <p style='font-size:12px;'>Tu email de acceso es: $email</p>
                  <p style='font-size:12px;'>Si tienes dudas nos puedes contactar <a href='http://www.esevidasinu.gov.co/'www.esevidasinu.gov.co</a></p>
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
            $mail->AddAddress($email);
            $mail->AddAddress('recepcionvu@esevidasinu.gov.co');
            if(!$mail->Send()) {
               pg_query("ROLLBACK") or die("Transaction rollback failed\n");
               $response["numero"] = "Error";
            }else{
                  pg_query("COMMIT") or die("Transaction commit failed\n");
                  $response["numero"] = "Exitoso";
            }
		
		$response["success"] = true;
		$response["message"] = $fch[0];
		echo json_encode($response);
		}
		else{
			$response["success"] = false;
			$response["message"] = "Ocurrio un error en la conexion";
			echo json_encode($response);
		}
	}catch(Exception $e){
		$response["success"] = false;
		$response["message"] = $e->getMessage();
		echo json_encode($response);
	}
	pg_close($conn);

?>

