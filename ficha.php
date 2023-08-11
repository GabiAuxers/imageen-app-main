<?php
session_start();
require_once 'head.php';
//<!--Traemos los datos del listado, del buscador o de info_box.php-->
// Verificar si el token está presente en la petición GET
$fecha_actual = date('Y-m-d'); // Formato: Año-Mes-Día

$conn = @new mysqli($db_server, $db_username, $db_userpassword, $db_name);
if ($conn->connect_error) {
    $additionalInfo = "Fallo en la conexión a la base de datos en la clase ficha.php línea 9. Comprueba las credenciales de la base de datos y que el servidor esté funcionando correctamente. Error específico: " . $conn->connect_error;
    $errorLogger = new ErrorLogger();
    $errorLogger->logErrorToFile('errors.txt', "Error de conexión a la base de datos", $additionalInfo);
    die("Ha ocurrido un error al intentar conectar a la base de datos.");
}
if (isset($_COOKIE['usuario'])) {
    $codigousuario = trim($_COOKIE['usuario'], " ");
} else {
    $codigousuario = "";
}

if (isset($_GET['token'])) {
    $token_recibido = $_GET['token'];

    $query = "SELECT CODIGO, NOMBRE, DESCRIPCION FROM TOKENS WHERE TOKEN = ? AND fecha_expiracion > NOW()";
    $stmt9 = $conn->prepare($query);
    $stmt9->bind_param('s', $token_recibido);
    $stmt9->execute();
    $result9 = $stmt9->get_result();
    $row9 = $result9->fetch_assoc();

    if ($row9) {
        // Token válido; puedes usar $row['codigo'], $row['nombre'], etc.
        $codigo = $row9['CODIGO'];
        $nombre = $row9['NOMBRE'];
        $descripcion = $row9['DESCRIPCION'];
    } else {
        // Token inválido o expirado
        die('Token invalido.Acceso denegado');
    }
    $stmt9->close();
} else {
    // Aquí puedes manejar el caso en que el token no exista en el parámetro GET.
    // Por ejemplo, podrías recuperar los datos de la sesión.
    $codigo = $_SESSION['codigo'];
    $nombre = $_SESSION['nombre'];
    $descripcionpunto = $_SESSION['descripcion'];
}

// Consulta para obtener la dirección de la tabla puntos
$stmt = $conn->prepare("SELECT PUNTOS.DIRECCION, PUNTOS.FECHANEW, PUNTOS.LOCALIZACION FROM PUNTOS WHERE PUNTOS.CODIGO = ?");
$stmt->bind_param("s", $codigo);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $direccion = $row["DIRECCION"];
        $fechanew = $row["FECHANEW"];
        $localizacion = $row["LOCALIZACION"];
    }
    $enalceLocalizacion = $direccion . " " . $localizacion;
}
$stmt->close();
?>

<!--Mostramos los datos en la ficha-->
<div class="container content-container" id=ficha>
    <div class="row header">
        <div class="col-12 back-button text-left" style="margin-top: 50px;">
            <a href="?section=<?php echo $_GET['ref']; ?>&t=3">
                <img src="assets\img\icons\Atrás.svg" alt="Atrás" style="padding-top: 40px;">
            </a>
        </div>
        <div class="col-12 text-left">
            <div class="txt-ficha-titulo d-flex justify-content-between" style="padding-top: 90px;">
                <span class="title"><?php echo $nombre; ?></span>
                <div>
                    <?php
                    // Comparar las fechas
                    if ($fechanew > $fecha_actual) {
                        echo '<img class="col-6" style="width: 30px; height: 30px;" src="assets\img\icons\icon-new-list.svg" alt="Nuevo punto Imageen">';
                    }
                    echo '<img id="favorito-' .  '" class="favoritos col-6" style="width: 30px; height: 30px;" src="assets/img/icons/Favoritos.svg" alt="Favoritos ciudades Imageen" data-codigo="' . $codigo . '">';
                    ?>
                </div>
            </div>
            <div class="texto-direccion">
                <!-- mostramos la dirección-->
                <?php if (isset($acceso_material) && $acceso_material > 1 && !$capado_apple) : ?>
                    <!--acceso premium sin boton google-->
                <?php else : ?>
                    <div class="d-flex flex-row justify-content-center">
                        <?php if ($localizacion != "") : ?>
                            <a href="<?= $localizacion ?>" class="btn boton-localizacion-POIs m-1" target="_blank">
                                <img src="assets\img\icons\google_maps.svg" style="width: 30px; height: 30px;" alt="Google Maps Icon" />
                                <?php echo $direccion; ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="texto-reviews2">
                <?php echo $descripcion; ?>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($codigo)) {

    $stmt2 = $conn->prepare("SELECT PUNTOS.NOMBRE AS NOMBRE_PUNTO, PUNTOS.CIUDAD, PUNTOS.LOCALIZACION, PUNTOS.CLIENTE, PUNTOS.IMAGEN AS IMAGEN_PUNTO,MATERIALES.CODIGO AS CODIGO_MATERIAL, 
        MATERIALES.NOMBRE" . $l . " AS NOMBRE_MATERIAL, MATERIALES.DESCRIPCION" . $l . " AS DESCRIPCION_MATERIAL,MATERIALES.TIPO AS TIPO_MATERIAL, MATERIALES.ACCESO AS ACCESO_MATERIAL, 
        MATERIALES.INSTRUCCIONES" . $l . " AS INSTRUCCION_MATERIAL,MATERIALES.IMAGEN AS IMAGEN_MATERIAL,VISUALIZACIONES.VISUALIZACIONES FROM MATERIALES
        JOIN PUNTOS ON MATERIALES.PUNTO = PUNTOS.CODIGO LEFT JOIN (SELECT HVISUAL.PUNTO, MATERIALES.CODIGO, COUNT(HVISUAL.ID) as VISUALIZACIONES FROM HVISUAL
        JOIN MATERIALES ON HVISUAL.MATERIAL = MATERIALES.CODIGO WHERE HVISUAL.PUNTO = ? GROUP BY HVISUAL.PUNTO, MATERIALES.CODIGO) 
        AS VISUALIZACIONES ON VISUALIZACIONES.CODIGO = MATERIALES.CODIGO WHERE MATERIALES.PUNTO = ? AND PUNTOS.CODIGO = ? ORDER BY MATERIALES.ORDEN");

    $stmt2->bind_param("sss", $codigo, $codigo, $codigo);
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    if ($result2->num_rows > 0) {
?>
        <div class="container-fluid pb-4" style="margin-top: 15px;">
            <div class="row" style="margin-top: -24px;">
                <!-- Slider principal -->
                <div class="swiper swiper-ciudades-ficha">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <?php

                        while ($row = $result2->fetch_assoc()) {
                            $codigo_material = $row["CODIGO_MATERIAL"];
                            $nombre_material = str_replace("~", "'", $row["NOMBRE_MATERIAL"]);
                            $imagen_material = $row["IMAGEN_MATERIAL"];
                            $descripcion_material = str_replace("~", "'", $row["DESCRIPCION_MATERIAL"]);
                            $acceso_material = $row["ACCESO_MATERIAL"];
                            $tipo_material = $row["TIPO_MATERIAL"];
                            $instrucciones_material = str_replace("~", "'", $row["INSTRUCCION_MATERIAL"]);
                            $nombre_punto  = $row["NOMBRE_PUNTO"];
                            $visualizaciones = $row["VISUALIZACIONES"];
                            // 
                            if ($imagen_material) {
                                $ruta_imagen = $ruta_admin . "/data/materiales/" . $imagen_material;
                            } else {
                                $ruta_imagen = $ruta_admin . "/data/puntos/" . $imagen;
                            }

                            $carpeta_destino = "";
                            $carpeta_destino2 = "";
                            $carpeta_spanish = "";
                            "SELECT CODIGO, IDIOMA, CARPETA FROM VERSIONES WHERE PUNTO ='$codigo' AND MATERIAL ='$codigo_material'";
                            $stmt3 = $conn->prepare("SELECT CODIGO, IDIOMA, CARPETA FROM VERSIONES WHERE PUNTO = ? AND MATERIAL = ?");
                            $stmt3->bind_param("ss", $codigo, $codigo_material);
                            $stmt3->execute();
                            $result3 = $stmt3->get_result();
                            if ($result3->num_rows > 0) {
                                while ($row2 = mysqli_fetch_array($result3)) {
                                    $codigo_version     = $row2["CODIGO"];
                                    $idioma_version        = $row2["IDIOMA"];
                                    $carpeta_version     = $row2["CARPETA"];

                                    if ($idioma_version == 1) {
                                        $carpeta_spanish = $carpeta_version;
                                    }
                                    if ($idioma_version == $idioma_usuario) {
                                        $carpeta_destino = $carpeta_version;
                                    }
                                    if ($idioma_version == $idioma2_usuario) {
                                        $carpeta_destino2 = $carpeta_version;
                                    }
                                }
                            }
                            $stmt3->close();

                            if ($carpeta_destino == "") {
                                if ($carpeta_destino2 != "") {
                                    $carpeta_destino = $carpeta_destino2;
                                } else {
                                    $carpeta_destino = $carpeta_spanish;
                                }
                            }

                            $stmt5 = $conn->prepare("SELECT AVG(PUNTUACION) AS RATING FROM HVALORACION WHERE MATERIAL = ?");

                            $stmt5->bind_param("s", $codigo_material);
                            $stmt5->execute();
                            $result5 = $stmt5->get_result();
                            $row5 = $result5->fetch_assoc();
                            $rating = $row5["RATING"];
                            $stmt5->close();
                        ?>

                            <div class="swiper-slide col-12 col-md-6 col-lg-4" data-codigo="<?= $codigo_material ?>" id="<?= $nombre_punto ?>#<?= $nombre_material ?>">
                                <div class="card-content-center">
                                    <div class="position-relative">
                                        <img src="<?= $ruta_imagen ?>" class="image-slide" style="filter: brightness(1);">
                                        <div class="position-absolute  position-play">
                                            <?php if ($acceso_material > $suscripcion_usuario && !$capado_apple) : ?>
                                                <?php if ($nombre_usuario != "Imageener") : ?>
                                                    <div>
                                                        <?php if ($acceso_material == 2) : ?>
                                                            <div class="titulo-POIs" style="font-size:12px">
                                                                <p><?= getTxt(177, $l) ?></p>
                                                            </div>
                                                        <?php else : ?>
                                                            <div class="titulo-POIs" style="font-size:12px">
                                                                <p><?= getTxt(136, $l) ?></p>
                                                            </div>
                                                        <?php endif;  ?>
                                                        <?php if ($email_usuario != NULL) : ?>
                                                            <?php if ($acceso_material == 2) : ?>
                                                                <button type="button" class="btn boton-rojo-POIs" onclick="openMembership5();"><?= getTxt(176, $l) ?></button>
                                                            <?php else : ?>
                                                                <!--<button type="button" class="btn boton-rojo-POIs" onclick="openMembership2();"><?= getTxt(129, $l) ?></button>-->
                                                                <button type="button" class="btn boton-rojo-POIs" onclick="openMembership7();"><?= getTxt(129, $l) ?></button>
                                                            <?php endif;  ?>
                                                        <?php else : ?>
                                                            <?php if ($acceso_material == 2) : ?>
                                                                <button type="button" class="btn boton-rojo-POIs" onclick="openMembership5();"><?= getTxt(176, $l) ?></button>
                                                            <?php else : ?>
                                                                <!--<button type="button" class="btn boton-rojo-POIs" onclick="openMembership3();"><?= getTxt(129, $l) ?></button>-->
                                                                <button type="button" class="btn boton-rojo-POIs" onclick="openMembership7();"><?= getTxt(129, $l) ?></button>
                                                            <?php endif;  ?>
                                                        <?php endif;  ?>
                                                    </div>
                                                <?php else : ?>
                                                    <div>
                                                        <?php if ($acceso_material == 2) : ?>
                                                            <div class="titulo-POIs" style="font-size:12px">
                                                                <p><?= getTxt(177, $l) ?></p>
                                                            </div>
                                                            <button type="button" class="btn boton-rojo-POIs" onclick="openLogin2();"><?= getTxt(167, $l) ?></button>
                                                        <?php else : ?>
                                                            <div class="titulo-POIs" style="font-size:12px">
                                                                <p><?= getTxt(136, $l) ?></p>
                                                            </div>
                                                            <button type="button" class="btn boton-rojo-POIs" onclick="openLogin();"><?= getTxt(167, $l) ?></button>
                                                        <?php endif;  ?>
                                                    </div>
                                                <?php endif;  ?>
                                            <?php else : ?>
                                                <i href="#" style="color: rgba(255,255,255,1);" class="ri-play-mini-fill ri-6x position:relative" role="button" onclick="addWatch('<?= $codigo ?>','<?= $codigo_material ?>','<?= $codigo_version ?>','<?= $carpeta_destino ?>','<?= $l ?>', '<?= $nombre_usuario ?>', '<?= $instrucciones_material ?>', '<?= $nombre_punto ?>#<?= $nombre_material ?>', '<?= $acceso_material ?>')"></i>
                                            <?php endif;  ?>
                                        </div>
                                    </div>
                                    <div class=" nombres-container">
                                        <p><?php echo $nombre_material; ?></p>
                                    </div>

                                    <div class="rating-ficha d-flex justify-content-between">
                                        <?php
                                        // Separar la calificación en partes enteras y decimales
                                        $entera = floor($rating);
                                        $decimal = $rating - $entera;
                                        ?>
                                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                                            <?php if ($i <= $entera) : ?>
                                                <!-- Renderizar una estrella llena si $i es menor o igual a la parte entera de la calificación -->
                                                <i class="fas fa-star"></i>
                                            <?php elseif ($i == $entera + 1 && $decimal >= 0.5) : ?>
                                                <!-- Renderizar una estrella a la mitad si $i es igual a la parte entera de la calificación más uno y la parte decimal de la calificación es mayor o igual a 0.5 -->
                                                <i class="fas fa-star-half-alt"></i>
                                            <?php else : ?>
                                                <!-- Renderizar una estrella vacía en cualquier otro caso -->
                                                <i class="far fa-star"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <div class="texto-stars">
                                            <a><?= number_format($rating, 1) ?></a>
                                        </div>
                                        <!--Compartir-->
                                        <!-- Contenedor del dropdown -->
                                        <div class="dropup">
                                            <!-- Botón del dropdown -->
                                            <button type="button" class="btn btn-compartir dropdown-toggle" data-bs-toggle="dropdown" style="margin: 0;">
                                                <img src="assets\img\icons\Descargar.svg" width="30px" height="30px" alt="Compartir">
                                            </button>
                                            <? $punto = str_replace(" ", "_", $nombre_punto); ?>
                                            <? $material = str_replace(" ", "_", $nombre_material); ?>
                                            <!-- Menú del dropdown -->
                                            <div class="dropdown-menu">
                                                <div class="grid-item mx-auto text-center" style="padding: 10px;">
                                                    <h6><?= getTxt(161, $l) ?></h6>
                                                </div>
                                                <div class="grid-item grid-menu">

                                                    <!-- Botones para compartir en las redes sociales -->
                                                    <a class="dropdown-item" target="_blank" href="https://www.facebook.com/sharer.php?u=https://app.imageen.net/contents.php?m=<?= $codigo_material ?>%26utm_source=reenv%26utm_medium=reenv%26utm_campaign=reenv_Facebook_<?= $punto ?>_<?= $material ?>"><img src="assets\img\icons\facebook.svg" style="width: 40px; height: 40px;" class="share-icon"> Facebook</a>
                                                    <a class="dropdown-item" target="_blank" href="https://api.whatsapp.com/send?text=Revive%20la%20historia%20con%20Imageen%20https://app.imageen.net/contents.php?m=<?= $codigo_material ?>%26utm_source=reenv%26utm_medium=reenv%26utm_campaign=reenv_WhatsApp_<?= $punto ?>_<?= $material ?>"><img src="assets\img\icons\whatsapp.svg" style="width: 40px; height: 40px;" class="share-icon"> WhatsApp</a>
                                                    <a class="dropdown-item" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=https://app.imageen.net/contents.php?m=<?= $codigo_material ?>%26utm_source=reenv%26utm_medium=reenv%26utm_campaign=reenv_LinkedIn_<?= $punto ?>_<?= $material ?>&title=Revive%20la%20historia%20con%20Imageen"><img src="assets\img\icons\linkedin.svg" style="width: 40px; height: 40px;" class="share-icon"> Linkedin</a>
                                                    <a class="dropdown-item" target="_blank" href="https://twitter.com/intent/tweet?text=Revive la historia con Imageen&url=https://app.imageen.net/contents.php?m=<?= $codigo_material ?>%26utm_source=reenv%26utm_medium=reenv%26utm_campaign=reenv_Twitter_<?= $punto ?>_<?= $material ?>&hashtags=CompartiendoImaggen"><img src="assets\img\icons\twitter.svg" style="width: 40px; height: 40px;" class="share-icon"> Twitter</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="texto-visualizaciones">
                                        <?php
                                        $Vis = getTxt(313, $l);
                                        if ($visualizaciones > 0) {
                                            echo $Vis . ': ' . $visualizaciones;
                                        } else {
                                            echo '0 ' . $Vis;
                                        }
                                        ?>
                                    </div>
                                    <div class="texto-descripcion-ficha">
                                        <p><?php echo $descripcion_material; ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="swiper-pagination bottom-0"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
            <div class="" style="padding-bottom: 20px;">
                <div class="texto-comentarios">
                    <a>Comentarios</a>
                </div>
                <form id="comment-form">
                    <input type="hidden" id="codigoImagen" name="image_code" value="">
                    <div class="input-group input-group-lg" style="padding: 10px;">
                        <input type="text" id="caja-comentarios" name="comment" class="form-control custom-searchcom-input border-0 texto-comentarios2" placeholder="Deja tu comentario...">
                        <button id="enviarComentario" type="submit">Enviar</button>
                    </div>
                </form>
                <!-- Comentarios de la base de datos -->
                <div id="comentarios-section"></div>
            </div>
        </div>
    <?php
    } else {
    ?>
        <p>No se encontraron imágenes y descripciones adicionales.</p>
    <?php
    }   // Cerrar la conexión
    $stmt2->close();
    $conn->close();
} else {
    ?>
    <p>El código del punto no está disponible.</p>
<?php
}
?>

<script>
    //Funcion window para la opacidad del slider
    $(window).on('load', function() {

        var swipers = [];

        function loadComments(currentSlide) {
            var codigoImagen = currentSlide.data('codigo');
            document.getElementById('codigoImagen').value = codigoImagen;
            fetch('_getComentarios.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        image_code: codigoImagen
                    })
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('comentarios-section').innerHTML = data.html;
                });
        }

        //opacidades del slider
        $('.swiper-ciudades-ficha').each(function(index) {
            $(this).find('.swiper-slide:first .image-slide').css('opacity', '0.2');
            swipers[index] = new Swiper(this, {

                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },

                pagination: {
                    el: '.swiper-pagination',
                },

                centeredSlides: true,
                slidesPerView: 1,
                spaceBetween: 10,

                breakpoints: {

                    330: {
                        slidesPerView: 1,
                        spaceBetween: 1
                    },
                    // when window width is >= 480px
                    495: {
                        slidesPerView: 2,
                        spaceBetween: 10
                    },
                    // when window width is >= 640px
                    660: {
                        slidesPerView: 3,
                        spaceBetween: 10
                    },
                    825: {
                        slidesPerView: 4,
                        spaceBetween: 15
                    }
                },

                on: {
                    init: function() {
                        // Set initial opacity
                        $(this.slides).find(".image-slide").css("opacity",
                            "0.5"); // Set all images opacity to 0.5
                        var currentSlide = $(this.slides[this
                            .activeIndex]); // Get current active slide
                        currentSlide.find(".image-slide").css("opacity",
                            "1"); // Set active image opacity to 1
                        loadComments(currentSlide);


                    },
                    slideChange: function() {
                        // Change opacity on slide change
                        $(this.slides).find(".image-slide").css("opacity",
                            "0.5"); // Change all images opacity to 0.5
                        var currentSlide = $(this.slides[this
                            .activeIndex]); // Get current active slide
                        currentSlide.find(".image-slide").css("opacity",
                            "1"); // Change active image opacity to 1
                        loadComments(currentSlide);
                    }
                }
            });
            swipers[index].init();
        });
    });
</script>

<script>
    document.getElementById('comment-form').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);
        fetch('/_guardarComentario.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Comentario guardado exitosamente.');
                } else {
                    alert('Hubo un error al guardar el comentario.');
                }
            });
    });
</script>