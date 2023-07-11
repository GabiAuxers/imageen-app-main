<body>
    <?php
    require_once 'footer.php';
    ?>

    <div class="container content-container">
        <div class="row header">
            <div class="col-12 back-button text-left" style="margin-top: 50px;">
                <a href="?section=infoPerfil">
                    <img src="assets\img\icons\Atrás.svg" alt="Atrás" style="width: 30px;">
                </a>
            </div>
        </div>

        <div class="col-12 p-3">
            <p class="txt-subtitulos">Perfil</p>
            <div class="listado">
                <ul style="margin-top: 10px;">
                    <li>
                       
                    <a class="txt-listado" href="?section=login">
                            <span>Iniciar Sesión</span>
                        </a>

                        <a href="?section=login">
                            <img src="assets\img\icons\Polygon.svg" style="width: 11px; height: 11px;" />
                        </a>

                    </li>
                    <li style="margin-top: 10px;">
                        <a class="txt-listado" href="?section=guiaVirtual">
                            <span>Guía Imageen</span>
                        </a>
                        <a href="?section=guiaVirtual">
                            <img src="assets\img\icons\Polygon.svg" style="width: 11px; height: 11px;" />
                        </a>
                    </li>
                </ul>
            </div>

            <p class="txt-subtitulos" style="margin-top: 50px;">Legal</p>
            <div class="listado">
                <ul style="margin-top: 10px;">
                    <li>
                        <!--Se establece este href para aclarar que volveremos a perfil desde politica de privacidad-->
                        <a class="txt-listado" href="?section=politica&ref=perfil">
                            <span>Política de privacidad</span>
                        </a>
                        <a href="?section=politica&ref=perfil">
                            <img src="assets\img\icons\Polygon.svg" style="width: 11px; height: 11px;" />
                        </a>
                    </li>
                    <li style="margin-top: 10px;">
                        <a class="txt-listado" href="?section=contacto&ref=perfil">
                            <span>Contacto</span>
                        </a>
                        <a href="?section=contacto&ref=perfil">
                            <img src="assets\img\icons\Polygon.svg" style="width: 11px; height: 11px;" />
                        </a>
                    </li>
                    <li style="margin-top: 10px;">
                        <a class="txt-listado" href="?section=faq&ref=perfil">
                            <span>Preguntas frecuentes</span>
                        </a>
                        <a href="?section=faq&ref=perfil">
                            <img src="assets\img\icons\Polygon.svg" style="width: 11px; height: 11px;" />
                        </a>
                    </li>
                </ul>
            </div>


        </div>
    </div>
</body>