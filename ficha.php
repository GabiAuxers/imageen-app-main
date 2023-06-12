
<?php
//26-05
    //<!--Traemos los datos del listado, del buscador o de info_box.php-->
        $codigo = $_SESSION['codigo'];
        $nombre = $_SESSION['nombre'];
        $descripcionpunto = $_SESSION['descripcion'];

        $conn3 = @new mysqli($db_server, $db_username, $db_userpassword, $db_name);
        if ($conn3->connect_error) {
            $additionalInfo = "Fallo en la conexión a la base de datos en la clase ficha.php línea 9. Comprueba las credenciales de la base de datos y que el servidor esté funcionando correctamente. Error específico: " . $conn->connect_error;
            $errorLogger = new ErrorLogger();
            $errorLogger->logErrorToFile('errors.txt', "Error de conexión a la base de datos", $additionalInfo);
            die("Ha ocurrido un error al intentar conectar a la base de datos.");
        }
    mysqli_set_charset($conn3, 'utf8');
    if ($conn3->connect_error) {
        die("Error al conectar a la base de datos: " . $conn3->connect_error);
    }
    // Consulta para obtener la dirección de la tabla puntos
$sql = "SELECT DIRECCION FROM PUNTOS WHERE CODIGO = '$codigo'";
$result3 = $conn3->query($sql);
if ($result3->num_rows > 0) {
    while ($row3 = $result3->fetch_assoc()) {
        $direccion = $row3["DIRECCION"];
    }
}
?>

<!--Mostramos los datos en la ficha-->
<div class="container content-container" id=ficha>
    <div class="row header">
        <div class="col-12 back-button text-left" style="margin-top: 50px;">
            <a href="contents.php">
                <img src="assets\img\icons\Atrás.svg" alt="Atrás" style="width: 30px;">
            </a>
        </div>
        <div class="col-12 text-left">
            <div class="txt-ficha-titulo d-flex justify-content-between">
                <span class="title"><?php echo $nombre; ?></span>
                <div>
                    <img src="assets\img\icons\Favoritos.svg" width="30px" height="30px" alt="Favoritos">
                </div>
            </div>
            <div class="texto-direccion">
                <?php echo $direccion; ?>
            </div>
            <div class="texto-reviews2">
                <?php echo $descripcionpunto; ?>
            </div>
        </div>
    </div>
</div>
<?php
    if (isset($codigo)) {

        // Consulta para obtener las imágenes y descripciones adicionales de la tabla materiales
        $sql3 = "SELECT PUNTOS.NOMBRE AS NOMBRE_PUNTO, PUNTOS.CIUDAD, PUNTOS.LOCALIZACION, PUNTOS.CLIENTE, PUNTOS.IMAGEN AS IMAGEN_PUNTO, MATERIALES.CODIGO AS CODIGO_MATERIAL, MATERIALES.NOMBRE" . $l . " AS NOMBRE_MATERIAL, MATERIALES.DESCRIPCION" . $l . " AS DESCRIPCION_MATERIAL, MATERIALES.TIPO AS TIPO_MATERIAL, MATERIALES.ACCESO AS ACCESO_MATERIAL, MATERIALES.INSTRUCCIONES" . $l . " AS INSTRUCCION_MATERIAL, MATERIALES.IMAGEN AS IMAGEN_MATERIAL
                FROM MATERIALES
                JOIN PUNTOS ON MATERIALES.PUNTO = PUNTOS.CODIGO
                WHERE MATERIALES.PUNTO = '$codigo' AND PUNTOS.CODIGO = '$codigo'
                ORDER BY MATERIALES.ORDEN";

        $result3 = $conn3->query($sql3);

        if ($result3->num_rows > 0) {
    ?>

<div class="container-fluid pb-4" style="margin-top: 15px;">
    <div class="row" style="margin-top: -24px;">
        <!-- Slider principal -->
        <div class="swiper swiper-ciudades-ficha">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <?php
                            while ($row3 = $result3->fetch_assoc()) {
                                $codigo_material = $row3["CODIGO_MATERIAL"];
                                $nombre_material = str_replace("~", "'", $row3["NOMBRE_MATERIAL"]);
                                $imagen_material = $row3["IMAGEN_MATERIAL"];
                                $descripcion_material = str_replace("~", "'", $row3["DESCRIPCION_MATERIAL"]);
                                $acceso_material = $row3["ACCESO_MATERIAL"];
                                $tipo_material = $row3["TIPO_MATERIAL"];
                                $instrucciones_material = str_replace("~", "'", $row3["INSTRUCCION_MATERIAL"]);
                                $nombre_punto  = $row3["NOMBRE_PUNTO"];
                                // 
                                if ($imagen_material) {
                                    $ruta_imagen = $ruta_admin . "/data/materiales/" . $imagen_material;
                                } else {
                                    $ruta_imagen = $ruta_admin . "/data/puntos/" . $imagen;
                                }

                                $carpeta_destino = "";
                                $carpeta_destino2 = "";
                                $carpeta_spanish = "";
                                $sql2 = "SELECT CODIGO, IDIOMA, CARPETA FROM VERSIONES WHERE PUNTO ='$codigo' AND MATERIAL ='$codigo_material'";
                                $result2 = $conn3->query($sql2);
                                if ($result2->num_rows > 0) {
                                    while ($row2 = mysqli_fetch_array($result2)) {
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

                                if ($carpeta_destino == "") {
                                    if ($carpeta_destino2 != "") {
                                        $carpeta_destino = $carpeta_destino2;
                                    } else {
                                        $carpeta_destino = $carpeta_spanish;
                                    }
                                }
                            ?>

                <div class="swiper-slide col-12 col-md-6 col-lg-4" id="<?= $nombre_punto ?>#<?= $nombre_material ?>">
                    <div class="card-content-center">

                        <img src="<?= $ruta_imagen ?>" class="image-slide" style="filter: brightness(1);">
                        <div class=" nombres-container">
                            <?php echo $nombre_material; ?>
                        </div>

                        <div class="rating-ficha d-flex justify-content-between">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <div class="texto-stars">
                                <a>5.0</a>
                            </div>
                            <img src="assets\img\icons\Descargar.svg" width="30px" height="30px"
                                style="margin-left: 15px;" alt="Compartir">
                        </div>
                        <div class="texto-descripcion-ficha">
                            <?php echo $descripcion_material; ?>
                        </div>
                    </div>

                    <div class="position-absolute" style="margin-top:-140px">
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
                            <button type="button" class="btn boton-rojo-POIs"
                                onclick="openMembership5();"><?= getTxt(176, $l) ?></button>
                            <?php else : ?>
                            <!--<button type="button" class="btn boton-rojo-POIs" onclick="openMembership2();"><?= getTxt(129, $l) ?></button>-->
                            <button type="button" class="btn boton-rojo-POIs"
                                onclick="openMembership7();"><?= getTxt(129, $l) ?></button>
                            <?php endif;  ?>
                            <?php else : ?>
                            <?php if ($acceso_material == 2) : ?>
                            <button type="button" class="btn boton-rojo-POIs"
                                onclick="openMembership5();"><?= getTxt(176, $l) ?></button>
                            <?php else : ?>
                            <!--<button type="button" class="btn boton-rojo-POIs" onclick="openMembership3();"><?= getTxt(129, $l) ?></button>-->
                            <button type="button" class="btn boton-rojo-POIs"
                                onclick="openMembership7();"><?= getTxt(129, $l) ?></button>
                            <?php endif;  ?>
                            <?php endif;  ?>
                        </div>
                        <?php else : ?>
                        <div>
                            <?php if ($acceso_material == 2) : ?>
                            <div class="titulo-POIs" style="font-size:12px">
                                <p><?= getTxt(177, $l) ?></p>
                            </div>
                            <button type="button" class="btn boton-rojo-POIs"
                                onclick="openLogin2();"><?= getTxt(167, $l) ?></button>
                            <?php else : ?>
                            <div class="titulo-POIs" style="font-size:12px">
                                <p><?= getTxt(136, $l) ?></p>
                            </div>
                            <button type="button" class="btn boton-rojo-POIs"
                                onclick="openLogin();"><?= getTxt(167, $l) ?></button>
                            <?php endif;  ?>
                        </div>
                        <?php endif;  ?>
                        <?php else : ?>
                        <i href="#" style="color: rgba(255,255,255,1);"
                            class="ri-play-mini-fill ri-6x position:relative"
                            onclick="addWatch('<?= $codigo ?>','<?= $codigo_material ?>','<?= $codigo_version ?>','<?= $carpeta_destino ?>','<?= $l ?>', '<?= $nombre_usuario ?>', '<?= $instrucciones_material ?>', '<?= $nombre_punto ?>#<?= $nombre_material ?>', '<?= $acceso_material ?>')"></i>
                        <?php endif;  ?>
                    </div>
                </div>
                <?php
                            }
                            ?>
            </div>
            <div class="swiper-pagination bottom-0"></div>
        </div>
    </div>
    <div class="" style="padding-bottom: 20px;">
        <div class="texto-comentarios">
            <a>Comentarios</a>
        </div>
        <div class="input-group input-group-lg" style="padding: 10px;">
            <input type="text" id="caja-comentarios"
                class="form-control custom-searchcom-input border-0 texto-comentarios2"
                placeholder="Deja tu comentario...">
        </div>
    </div>
</div>




<?php
        } else {
        ?>
<p>No se encontraron imágenes y descripciones adicionales.</p>
<?php
        }   // Cerrar la conexión
        $conn3->close();
    } else {
        ?>
<p>El código del punto no está disponible.</p>
<?php
    }
    ?>

<script>
var fichaData = JSON.parse(localStorage.getItem('fichaData'));
var numSlides = document.querySelectorAll('.swiper-slide').length;
var initialSlide;

if (numSlides <= 2) {
    initialSlide = 0;
} else if (numSlides % 2 === 0) {
    initialSlide = numSlides / 2 - 1; // si es par, comienza en la diapositiva de la mitad - 1
} else {
    initialSlide = Math.floor(numSlides / 2); // si es impar, comienza en la diapositiva del medio
}
//Funcion window para la opacidad del slider
$(window).on('load', function() {
    var swipers = [];

    //opacidades del slider
    $('.swiper-ciudades-ficha').each(function(index) {
        $(this).find('.swiper-slide:first .image-slide').css('opacity', '0.2');
        swipers[index] = new Swiper(this, {

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
                },
                slideChange: function() {
                    // Change opacity on slide change
                    $(this.slides).find(".image-slide").css("opacity",
                        "0.5"); // Change all images opacity to 0.5
                    var currentSlide = $(this.slides[this
                        .activeIndex]); // Get current active slide
                    currentSlide.find(".image-slide").css("opacity",
                        "1"); // Change active image opacity to 1
                }
            }
        });
        swipers[index].init();
    });
});
</script>