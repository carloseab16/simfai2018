<?php
//Librerías para el envío de mail
include_once('class.phpmailer.php');
include_once('class.smtp.php');

//Recibir todos los parámetros del formulario
$para = $_POST['email'];
$asunto = $_POST['asunto'];
$mensaje = $_POST['mensaje'];
$archivo = $_FILES['hugo'];

//Este bloque es importante
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Host = "smtp.gmail.com";
$mail->Port = 587;

//Nuestra cuenta
$mail->Username ='modelizacion.numerica.unsa@gmail.com';
$mail->Password = 'modelizacionnumerica';

//Agregar destinatario
$mail->AddAddress($para);
$mail->Subject = $asunto;
$mail->Body = $mensaje;
//Para adjuntar archivo
$mail->AddAttachment($archivo['tmp_name'], $archivo['name']);
$mail->MsgHTML($mensaje);

//Avisar si fue enviado o no y dirigir al index
if($mail->Send())
{
	echo'<script type="text/javascript">
			alert("Enviado Correctamente");
			window.location="http://localhost/maillocal/index.php"
		 </script>';
}
else{
	echo'<script type="text/javascript">
			alert("NO ENVIADO, intentar de nuevo");
			window.location="http://localhost/maillocal/index.php"
		 </script>';
}
?>

