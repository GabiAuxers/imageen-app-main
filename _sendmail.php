<?php include 'literal.php';
include 'functions.php';
include 'auth.php';

$nombre = $_POST['nombre'];
$email = $_POST['email'];
if ($_POST['telefono']=!""){
    $telefono = +$_POST['telefono'];
}else{
    $telefono = 'Sin teléfono';
}
$mensaje = $_POST['mensaje'];


if($departamento_contactado == "sugerencias") {
    $titulo = 'Contacto App sugerencias o dudas:'+ $email + '\ ' + $telefono;
    $para = 'info@imageen.net';
}
else if($departamento_contactado == "soporte") {
    $titulo = 'Contacto App petición de soporte'+ $email + '\ ' + $telefono;
    $para = 'soporte@imageen.net';
}
else if($departamento_contactado == "contabilidad") {
    $titulo = 'Contacto App problemas con el pago'+ $email + '\ ' + $telefono;
    $para = 'pedro@imageen.net';
}
else if($departamento_contactado == "correccion") {
    $titulo = 'Contacto App sugerencia de corrección'+ $email + '\ ' + $telefono;
    $para = 'anaabia@imageen.net';
}
else {
    $titulo = 'Contacto App patrocinio y publicidad'+ $email + '\ ' + $telefono;
    $para = 'nuriacanals@imageen.net';
}

$r='From: noreply@imageen.net';
$u='noreply@imageen.net';
$p='LGpJ1T/9!3^9';

$msjCorreo = 'Nombre: ' + $nombre + '\ E-Mail: ' + $email + '\ Telefono: ' + $telefono + '\ Mensaje: '+ $mensaje;
setcookie("envio2", $msjCorreo, time() + (86400 * 360), "/"); 
if ($_POST['submit']) {
    if (mail ($para, $titulo, $msjCorreo,$r,'',$u,$p)) {
        setcookie("envio", 1, time() + (86400 * 360), "/"); 
		header('Location:' . getenv('HTTP_REFERER'));
    } else {
        setcookie("envio", 2, time() + (86400 * 360), "/"); 
		header('Location:' . getenv('HTTP_REFERER'));
    }
}
?>
