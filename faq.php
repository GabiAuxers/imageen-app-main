<body>
    <?php
    require_once 'auth.php';
    require_once 'variables.php';
    require_once 'head.php';
    require_once 'js.php';
    require_once 'footer.php';
    ?>

    <div class="container content-container">
        <div class="row header">
            <div class="col-12 back-button text-left" style="margin-top: 50px;">
             <!--Se establece este href para volver a atras a la pagina desde la que la llamamos, por ejemplo si lo llamamos desde perfil
            al volver hacia atras ira al perfil y si lo hacemos desde infoPerfil ira a infoPerfil.-->
                <a href="?section=<?php echo $_GET['ref']; ?>">
                    <img src="assets\img\icons\Atrás.svg" alt="Atrás" style="width: 30px;">
                </a>
            </div>
        </div>

        </div>
        <div class="col-12 p-3 ">
            <p class="txt-perfil">Preguntas Frecuentes</p>
            <div class="listado2">
                <ul style="margin-top: 10px;">
                    <li>
                        <details>
                            <summary>¿Cómo puedo ver el contenido?</summary>
                            <p>Solo necesitas un dispositivo que pueda correr con soltura contenidos multimedia y 3d,
                                con una conexión decente a Internet e instalar la app o entrar en app.imageen.net desde
                                tu navegador.<br><br>
                                Los contenidos que menos recursos necesitan son los videos planos, guias virtuales o
                                presente/pasado pueden no reproducirse en ciertos dispositivos.<br><br>
                                La descarga de los contenidos para una visualización correcta esta supeditada al ancho
                                de banda de tu conexión.<br><br>
                                Recomendamos encarecidamente que pruebes a visualizar distintos tipos de contenidos para
                                probar la compatibilidad de tu dispositivo antes de suscribirte para probar la
                                compatibilidad.</p>
                        </details>
                    </li>

                    <li style="margin-top: 10px;">
                        <details>
                            <summary>¿Qué hacer si no carga el vídeo?</summary>
                            <p>En algunos casos los contenidos pueden verse afectados por una carga excesiva de la cache
                                de tu
                                navegador, esto se soluciona limpiando la cache.</p>
                            <p>
                                <a href="https://www.imageen.net/faq/Limpieza%20de%20cache%20en%20Android%20v1.1.pdf"
                                    target="_blank"
                                    title="Instrucciones: Como limpiar la cache en Android">Instrucciones: Como
                                    limpiar la cache en Android</a><br>
                                <a href="https://www.imageen.net/faq/Limpieza%20de%20cache%20en%20iOS%20v1.1.pdf"
                                    target="_blank" title="Instrucciones: Como limpiar la cache en iOS">Instrucciones:
                                    Como limpiar la cache en
                                    iOS</a><br>
                                <a href="https://www.imageen.net/faq/Limpieza%20de%20cache%20en%20PC%20o%20Mac%20v1.1.pdf"
                                    target="_blank"
                                    title="Instrucciones: Como limpiar la cache en google chrome en un Mac o PC">Instrucciones:
                                    Como
                                    limpiar la cache en google chrome en un Mac o PC</a><br>
                            </p>
                        </details>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>