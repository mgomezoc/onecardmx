<?php
$to = 'mgomez@onecard.mx';
$subject = 'Test';
$message = 'Hola mundo';
$headers = 'From: web@onecard.mx' . "\r\n" .
    'Reply-To: 0013zkr@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

if (mail($to, $subject, $message, $headers)) {
    echo 'El correo se ha enviado exitosamente!!!.';
} else {
    echo 'Ha ocurrido un error al enviar el correo.';
}


echo phpinfo();
