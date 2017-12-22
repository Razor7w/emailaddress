<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
//*use PHPMailer\PHPMailer\PHPMailer;
//*use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
//require 'vendor/autoload.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

require_once "php/conexion.php";
$conexion = conexion();
//{Sentencia Sql}//
$sql = "SELECT *
				FROM  usuarios
			  WHERE enviado = 0
				LIMIT 0 , 5";

$result = mysqli_query($conexion , $sql);

//var_dump($result);

$mail = new PHPMailer(true);
for($i = 0; $i <= $result->num_rows; $i++){
	$datos = $result->fetch_array(MYSQLI_ASSOC);
  try {
      require 'sendGrid/config.php';

      //Recipients
      $mail->setFrom('from@example.com', 'Remitente');
      $mail->addAddress($datos['Email'], $datos['Nombre']);

      //Content
      $mail->isHTML(true);
      $mail->Subject = 'Here is the subject';
      $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
      $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

      //$mail->send();
      echo 'El Mensaje se ha enviado<br>';

      mysqli_query($conexion , "UPDATE usuarios SET Enviado=1 WHERE ID='".$datos['ID']."'");

  } catch (Exception $e) {
      echo 'El Mensaje no se ha enviado.<br>';
      echo 'Error en el Envio: ' . $mail->ErrorInfo . '<br>';
  }
}
