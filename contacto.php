<body>
    <?php
    include 'head.php';
    include 'variables.php';
    include 'js.php';
    include 'footer.php';
    ?>



<!-- El contacto tendra que gestionarse desde admin y alguien tendra que encargarse de los mensajes. Agregar un metodo
    a <input type="submit" class="btn btn-primary" style="margin-top: 15px;" value="Enviar"> para realiar la accion con la base de datos-->
    <div class="container content-container" style="padding-bottom: 20px;">
        <div class="row header">
            <div class="col-12 back-button text-left" style="margin-top: 50px;">
            <a href="?section=<?php echo $_GET['ref']; ?>&t=3">
                    <img src="assets\img\icons\Atrás.svg" alt="Atrás" style="padding-top: 40px;">
                </a>
            </div>
        </div>
        <div class="col-12 p-3" style="padding-bottom: 10px;">
            <p class="txt-perfil" style="padding-top: 80px;"><?=getTxt(47, $l) ?>&nbsp;</p>
            <p class="txt-parrafo"><?=getTxt(307, $l) ?>&nbsp;</p>
        </div>

        <div class="col-12 p-3" style="text-align: center;">
            <form method="POST" action="">
                <input type="nombre" class="form-control txt-input" id="nombre" name="nombre" placeholder="<?=getTxt(29, $l) ?>&nbsp;"
                    required><br>
                <input type="email" class="form-control txt-input" id="email" name="email" placeholder="<?=getTxt(37, $l) ?>&nbsp;"
                    required><br>
                <div class="form-group">
                    <select class="form-control txt-input" id="motivos" name="motivo" required>
                        <option selected disabled><?=getTxt(308, $l) ?>&nbsp;</option>
                        <option value="sugerencias"><?=getTxt(237, $l) ?>&nbsp;</option>
                        <option value="soporte"><?=getTxt(238, $l) ?>&nbsp;</option>
                        <option value="contabilidad"><?=getTxt(239, $l) ?>&nbsp;</option>
                        <option value="correccion"><?=getTxt(240, $l) ?>&nbsp;</option>
                        <option value="publicidad"><?=getTxt(241, $l) ?>&nbsp;</option>
                    </select>
                </div>

                <textarea type="mensaje" class="form-control txt-mensaje" id="mensaje" name="mensaje"
                    placeholder=<?=getTxt(242, $l);?> required
                    style="margin-top: 20px; height: 200px !important; width: 100%;"></textarea>
                    <br>
                    <div class="g-recaptcha" data-sitekey="6LfhfdkmAAAAAIMyqo0GAQfRkfn103si1Iuxy0jB"></div>
                    <div class="alerta-recaptcha" id="error-msg" style="color: red; display: none;">
                    <?=getTxt(309, $l) ?>&nbsp;
                    </div>
                    <input type="submit" name="submit" id="submitBtn" class="btn btn-primary" style="margin-top: 15px;" value=<?=getTxt(112, $l);?>>
            </form>
         </div>  
    </div>

 <?php
if(isset($_POST['g-recaptcha-response'])) {
    $captcha = $_POST['g-recaptcha-response'];
    $secretKey = "6LfhfdkmAAAAAP8404x0T1zANXSRKaXYxmnB13rw";
    $ip = $_SERVER['REMOTE_ADDR'];
    // post request to server
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
    $response = file_get_contents($url);
    $responseKeys = json_decode($response,true);
    // should return JSON with success as true
    if($responseKeys["success"]) {
  
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $mensaje = $_POST['mensaje'];
    $departamento_contactado = $_POST['motivo'];
    
    
    if($departamento_contactado == "sugerencias") {
        $titulo = 'Contacto App sugerencias o dudas: ' . $email;
        $para = 'info@imageen.net';
    }
    else if($departamento_contactado == "soporte") {
        $titulo = 'Contacto App petición de soporte: ' . $email;
        $para = 'support@imageen.freshdesk.com';
    }
    else if($departamento_contactado == "contabilidad") {
        $titulo = 'Contacto App problemas con el pago: ' . $email;
        $para = 'pedro@imageen.net';
    }
    else if($departamento_contactado == "correccion") {
        $titulo = 'Contacto App sugerencia de corrección: ' . $email;
        $para = 'anaabia@imageen.net';
    }
    else {
        $titulo = 'Contacto App patrocinio y publicidad: '. $email;
        $para = 'nuriacanals@imageen.net';
    }
    
    $msjCorreo = 'Nombre: ' . $nombre . ' \ E-Mail: ' . $email . ' \ Mensaje: '. $mensaje;
    setcookie("envio2", $msjCorreo, time() + (86400 * 360), "/"); 
    if ($_POST['submit']) {
        if (mail ($para, $titulo, $msjCorreo)) {
            setcookie("envio", 1, time() + (86400 * 360), "/"); 
            header('Location:' . getenv('HTTP_REFERER'));
        } else {
            setcookie("envio", 2, time() + (86400 * 360), "/"); 
            header('Location:' . getenv('HTTP_REFERER'));
        }
    }
}
}
?>
    <script>
        document.querySelector("form").addEventListener("submit", function(event){
            var recaptcha = document.querySelector('#g-recaptcha-response').value;
            if (!recaptcha) {
                // Si el captcha no está verificado, mostramos el mensaje de error y prevenimos el envío del formulario
                document.getElementById('error-msg').style.display = 'block';
                event.preventDefault();
            }
        });
    </script>  
</body>
