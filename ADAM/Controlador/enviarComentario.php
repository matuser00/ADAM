<?php
/*  Nombre  : enviarComentario.php
 *  Autor   : FIGG - FAT
 *  Fecha   : 10-Diciembre-2013
 * Descripción: Archivo Web que enviar correo
 *
 */

$nombreRemitente        = "Froébel Iván";
$correoRemitente        = "ivan.froebel@goweb.tv";
$comentarioRemitente    = "Hola, como estas?";

//$nombreRemitente        = $_POST['nombre'];
//$correoRemitente        = $_POST['correo'];
//$comentarioRemitente    = $_POST['comentario'];

if($nombreRemitente !="" && $correoRemitente !="" && $comentarioRemitente !="")
{
    $destinatario = "froebel_ivan@live.com.mx";
    $asunto = ".::Contacto Alto Diseño Áldico Mecánico::.";
    $cuerpo = '
    <html>
    <head>
       <title>.::Contacto Alto Diseño Áldico Mecánico::.</title>
    </head>
    <body>
        <p>Mensaje de: <b>'.$nombreRemitente.' </b></p>
        <p><b>Comentario: </b></p>
        <p>'. $comentarioRemitente .'</p>
    </body>
    </html>
    ';

    //para el envío en formato HTML
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";

    //dirección del remitente
    $headers .= "From: $correoRemitente\r\n";

    //dirección de respuesta, si queremos que sea distinta que la del remitente
    $headers .= "Reply-To: $correoRemitente\r\n";

    //ruta del mensaje desde origen a destino
    //$headers .= "Return-path: alejandro.terron@goweb.tv\r\n";

    //direcciones que recibián copia
    //$headers .= "Cc: tomas.martinez@goweb.tv\r\n";

    //direcciones que recibirán copia oculta
    //$headers .= "Bcc: froebel.ivan@facebook.com\r\n";

    if(mail($destinatario,$asunto,$cuerpo,$headers))
    {
        echo "<p><b>El correo ha sido enviado</b></p>";
    }
    else
    {
        echo "<p><b>No se pudo enviar el correo</b></p>";
    }
}
else
{
    echo "<p><b>Faltan datos obligatorios</b></p>";
}
?>