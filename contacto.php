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
                    <img src="assets\img\icons\Atrás.svg" alt="Atrás" style="width: 30px;">
                </a>
            </div>
        </div>
        <div class="col-12 p-3" style="padding-bottom: 10px;">
            <p class="txt-perfil">Contacto</p>
            <p class="txt-parrafo">Si tienes alguna duda o sugerencia no dudes en escribirnos, nos pondremos en contacto
                contigo a la mayor brevedad, estaremos encantados de recibir tu información.</p>
        </div>

        <div class="col-12 p-3" style="text-align: center;">
            <form method="POST" action="?section=mapa&t=3">

                <input type="nombre" class="form-control txt-input" id="nombre" name="nombre" placeholder="Nombre"
                    required><br>
                <input type="email" class="form-control txt-input" id="email" name="email" placeholder="Email"
                    required><br>
                <div class="form-group">
                    <select class="form-control txt-input" id="motivos" name="motivo" required>
                        <option selected disabled>Seleccione un motivo</option>
                        <option value="Dudas generales y sugerencias">Dudas generales y sugerencias</option>
                        <option value="Incidencia técnica">Incidencia técnica</option>
                        <option value="Problemas con el pago">Problemas con el pago</option>
                        <option value="Sugerir corrección histórica">Sugerir corrección histórica</option>
                        <option value="Patrocinio o publicidad en la app">Patrocinio o publicidad en la app</option>
                    </select>
                </div>

                <textarea type="mensaje" class="form-control txt-mensaje" id="mensaje" name="mensaje"
                    placeholder="Mensaje" required
                    style="margin-top: 20px; height: 200px !important; width: 100%;"></textarea>
                    <br>
                    <div class="g-recaptcha" data-sitekey="6LfhfdkmAAAAAIMyqo0GAQfRkfn103si1Iuxy0jB"></div>
                    <div class="alerta-recaptcha" id="error-msg" style="color: red; display: none;">
                    Por favor verifica que no eres un robot.
                    </div>
                    <input type="submit" id="submitBtn" class="btn btn-primary" style="margin-top: 15px;" value="Enviar">
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
        console.log("Captcha correcto");
        // codigo que procesara los datos del formulario una vez se verifica el captcha, por ej base de datos o enviar un correo con los datos del formulario

        // Recoger los datos del formulario
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $motivo = $_POST['motivo'];
        $mensaje = $_POST['mensaje'];

        // Definir a quién se enviará el correo
        $destinatario = "esteban.serrano@auxers.com";

        // Crear el cuerpo del correo
        $cuerpo = "Nombre: $nombre\n";
        $cuerpo .= "Email: $email\n";
        $cuerpo .= "Motivo: $motivo\n";
        $cuerpo .= "Mensaje: $mensaje\n";

        // Enviar el correo
        if (mail($destinatario, $motivo, $cuerpo)) {
            echo 'Mensaje enviado correctamente.';
        } else {
            echo 'Error al enviar el mensaje.';
        }

    } else {
        echo 'You are spammer ! Get out';
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
