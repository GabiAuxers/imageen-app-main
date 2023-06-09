<div class="container content-container">
    <div class="col-12 p-3">
        <div class="fila-titulo-perfil">
            <p class="txt-perfil">Perfil</p>
            <div class="banderas-menu">
                <div class="">
                    <!--habra que implementar la funcionalidad de francia y cataluña con el metodo onClick changeLng, mas info en botones.php-->
                    <a href="#" onclick="changeLng(1, 1)"><img
                            class="<?=(($idioma_usuario==1)?'bandera-seleccionada':'bandera');?>"
                            src="./imagenes/Spain.svg"></a>
                    <a href="#" onclick="changeLng(2, 2)"><img
                            class="<?=(($idioma_usuario==2)?'bandera-seleccionada':'bandera');?>"
                            src="./imagenes/EEUU.svg"></a>
                    <a href="#"><img class="<?=(($idioma_usuario==3)?'bandera-seleccionada':'bandera');?>"
                            src="./imagenes/France.svg"></a>
                    <a href="#"><img class="<?=(($idioma_usuario==4)?'bandera-seleccionada':'bandera');?>"
                            src="./imagenes/Catala.svg"></a>
                </div>
            </div>
        </div>
        <div class="profile-content">
            <div class="image-upload">
            <img id="profilePic" src="<?php echo $foto_usuario ?: './imagenes/Avatar barba.png' ?>" alt="Foto de perfil" style="cursor: pointer;" />
                <input type="file" id="fileInput" accept="image/*" style="display: none;">
            </div>
            <div class="txt-nombre-perfil">
                <p><?php echo $nombre_usuario ?></p>
            </div>
        </div>
        <?php if ($provider_usuario != "anonimo") { ?>
        <div class="listado">
            <p class="txt-subtitulos" style="margin-top: 50px;">Configuración de la cuenta</p>
            <ul style="margin-top: 10px;">

                <li>
                    <a class="txt-listado" href="?section=informacionPersonal">
                        <span>Información personal</span>
                    </a>
                    <a href="?section=informacionPersonal">
                        <img src="assets\img\icons\Polygon.svg" style="width: 11px; height: 11px;" />
                    </a>
                </li>

                <li style="margin-top: 10px;">
                    <a class="txt-listado" href="?section=configuracion">
                        <span class="txt-listado">Configuración de la cuenta</span>
                    </a>
                    <a class="txt-listado" href="?section=configuracion">
                        <img src="assets\img\icons\Polygon.svg" style="width: 11px; height: 11px;" />
                    </a>
                </li>
            </ul>
        </div>
        <?php } ?>
        <p class="txt-subtitulos" style="margin-top: 50px;">Legal</p>
        <div class="listado">
            <ul style="margin-top: 10px;">

                <li>
                    <!--Se establece este href para aclarar que volveremos a infoPerfil desde politica de privacidad-->
                    <a class="txt-listado" href="?section=politica&ref=infoPerfil">
                        <span>Política de privacidad</span>
                    </a>
                    <a href="?section=politica&ref=infoPerfil">
                        <img src="assets\img\icons\Polygon.svg" style="width: 11px; height: 11px;" />
                    </a>
                </li>

                <li style="margin-top: 10px;">
                    <a class="txt-listado" href="?section=contacto&ref=infoPerfil">
                        <span>Contacto</span>
                    </a>
                    <a href="?section=contacto&ref=infoPerfil">
                        <img src="assets\img\icons\Polygon.svg" style="width: 11px; height: 11px;" />
                    </a>
                </li>

                <li style="margin-top: 10px;">
                    <a class="txt-listado" href="?section=faq&ref=infoPerfil">
                        <span>Preguntas frecuentes</span>
                    </a>
                    <a href="?section=faq&ref=infoPerfil">
                        <img src="assets\img\icons\Polygon.svg" style="width: 11px; height: 11px;" />
                    </a>
                </li>
            </ul>
        </div>
        <?php if ($provider_usuario == "anonimo") { ?>
        <div style="margin-top: 30px;">

            <a class="txt-iniciarSesion" href="?section=perfil">Iniciar Sesión</a>
        </div>
        <?php } ?>
        <div style="margin-top: 50px;">

            <!--Cerrar la sesion del usuario actual-->
            <?php if ($email_usuario != "imageener@imageen.net") : ?>
            <div class="d-flex" type="button"></button>
                <h6 class="txt-iniciarSesion" onclick="askClose('<?= $l ?>', '<?= $nombre_usuario ?>')">
                    <?= getTxt(55, $l) ?>&nbsp;
                </h6>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Abrir el explorador de archivos al hacer click en la imagen de perfil, habria que implementar la logica para almacenar
las imagenes en base de datos

<script>
    document.getElementById('fileInput').onchange = function() {
        let reader = new FileReader();
        
        // Obtiene el archivo seleccionado
        let file = this.files[0];
        
        // Valida que el archivo es una imagen
        let imageFileTypes = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];  // Tipos de imagen permitidos
        let extension = file.name.split('.').pop().toLowerCase();
        
        if (!imageFileTypes.includes(extension)) {
            alert('Por favor selecciona una imagen válida.');
            return;
        }

        reader.onload = function (e) {
            // Actualiza la vista previa de la imagen de perfil
            document.getElementById('profilePic').src = e.target.result;

            // Crea un nuevo objeto FormData y añade el archivo
            let formData = new FormData();
            formData.append('profilePic', file);

            // Realiza una petición POST al servidor con el archivo
            fetch('auth.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Procesa la respuesta del servidor
                if (data.success) {
                    console.log('Imagen subida con éxito');
                } else {
                    console.log('Hubo un error al subir la imagen');
                }
            })
            .catch(error => {
                // Maneja cualquier error que pueda ocurrir
                console.error('Error:', error);
            });
        };

        // Lee la imagen seleccionada por el usuario
        reader.readAsDataURL(file);
    };
</script>-->
