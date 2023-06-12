<!DOCTYPE html>
<html>

<head>
    <title>Enviar Consulta</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>




<!-- TODO: Borrar -->
<?php 
$nombre = $_POST['nombre'];
$email = $_POST['email'];
if ($_POST['telefono']=!""){
    $telefono = "("+$_POST['telefono']+")";
}else{
    $telefono = "";
}
$mensaje = $_POST['mensaje'];


if($departamento_contactado == "sugerencias") {
    $titulo = 'Contacto App sugerencias o dudas:'+ $email + $telefono;
    $para = 'info@imageen.net';
}
else if($departamento_contactado == "soporte") {
    $titulo = 'Contacto App petición de soporte'+ $email + $telefono;
    $para = 'soporte@imageen.net';
}
else if($departamento_contactado == "contabilidad") {
    $titulo = 'Contacto App problemas con el pago'+ $email + $telefono;
    $para = 'pedro@imageen.net';
}
else if($departamento_contactado == "correccion") {
    $titulo = 'Contacto App sugerencia de corrección'+ $email + $telefono;
    $para = 'anaabia@imageen.net';
}
else {
    $titulo = 'Contacto App patrocinio y publicidad'+ $email + $telefono;
    $para = 'nuriacanals@imageen.net';
}

//mail($para, $titulo, $mensaje);
//$msjCorreo = "Nombre: $nombre\n E-Mail: $email\n Mensaje:\n $mensaje";

if ($_POST['submit']) {
    if (mail ($para, $titulo, $msjCorreo)) {
        echo 'El mensaje se ha enviado';
    } else {
        echo 'El mensaje no se ha enviado';

        
       
        ?>

<body>
    <a target=\"_blank\" href=\"https://app.imageen.net?<?=$parametros?>\" download id=\"open-browser-url\">Un momento.
        Abriendo en tu navegador por defecto...</a>
    <script>
    //Apertura en la aplicacion o en el navegador por defecto desde el navegador de facebook en los dispositivos Android
    if ((navigator.userAgent.includes("Instagram") || navigator.userAgent.includes("FBAN") || navigator.userAgent
            .includes("FBAV")) && !navigator.userAgent.includes("iPhone") && !navigator.userAgent.includes("iPad")) {
        document.write(
            "<a target=\"_blank\" href=\"https://app.imageen.net?<?=$parametros?>\" download id=\"open-browser-url\">Un momento. Abriendo en tu navegador por defecto...</a>"
            );
        window.stop();
        let input = document.getElementById('open-browser-url');
        if (input) {
            input.click();
        }
        //window.location.href = "./dummy_bytes.php";
    }
    </script>
    <script src="library.js"></script>
    <p>Esta página web es una página HTML válida.</p>
    <input id="ok" name="ok" action="openLogin()" class="row btn boton-principal mx-auto fs-6 mt-3"
        style="background:#2765A0;" value="<?=getTxt(243,$l)?>">
    <div>
        <div class="cabecera" style="z-index:100;">
            <div><img src="./imagenes/logo imageenN.png" width="125px">
                <div class="modal-dialog modal-sm modal-dialog-centered">
                    <div class="modal-content bg-primary p-15px text-center">
                        <h4 class="text-white">Aviso de Cookies</h4>
                        <p class="text-white">Usamos cookies propias y de terceros para mejorar nuestros servicios. Si
                            continúa con la navegación, consideraremos que acepta este uso.</p>
                        <hr>
                        <a class="btn btn-light btn-sm mt-30px" data-bs-dismiss="modal" onclick="saveCookie()">OK</a>
                        <input id="submit" name="submit" type="submit" class="row btn boton-principal mx-auto fs-6 mt-3"
                            style="background:#2765A0;" value="<?=getTxt(243,$l)?>">
                    </div>
                </div>
            </div>
</body>
<?php
    }
}
?>