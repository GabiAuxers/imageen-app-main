<?php
//26-05
require_once 'ErrorLogger.php';
//Iniciamos la sesion para posteriormente guardar los datos
session_start();
?>

<?php
    if ($_SERVER['SERVER_NAME'] == "localhost") {
        $ruta_admin = "/admin";
    } else {
        $ruta_admin = "https://admin.imageen.net";
    }
    //datos enviados a través de un formulario usando el metodo POST
    $codigo      = isset($_POST["codigo"]) ? $_POST["codigo"] : '';
    $nombre      = isset($_POST["nombre"]) ? $_POST["nombre"] : '';
    $descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : '';
    $direccion = isset($_POST["direccion"]) ? $_POST["direccion"] : '';


    //Guardamos los datos en sesion para usarlos posteriormente en la ficha
    $_SESSION['codigo'] = $codigo;
    $_SESSION['nombre'] = $nombre;
    $_SESSION['descripcion'] = $descripcion;

    // Obtener la fecha actual
    $fecha_actual = date('Y-m-d'); // Formato: Año-Mes-Día
    ?>
<?php
                   $conn = @new mysqli($db_server, $db_username, $db_userpassword, $db_name);
                    //controlamos los errores de conexion
                    if ($conn->connect_error) {
                        $additionalInfo = "Fallo en la conexión a la base de datos en la clase list.php línea 27. Comprueba las credenciales de la base de datos y que el servidor esté funcionando correctamente. Error específico: " . $conn->connect_error;
                        $errorLogger = new ErrorLogger();
                        $errorLogger->logErrorToFile('errors.txt', "Error de conexión a la base de datos", $additionalInfo);
                        die("Ha ocurrido un error al intentar conectar a la base de datos.");
                    }
                    mysqli_set_charset($conn, 'utf8');
                    $sql = "SELECT CODIGO, NOMBRE FROM CIUDADES WHERE ESTADO = 1 ORDER BY ORDEN ";
                    $result = $conn->query($sql);
    
                    if ($result->num_rows > 0) {
                        $num_ciudad = 0;
                        $formIndex = 0;
                        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                            if ($num_ciudad == 0 && isset($v)) {
                                $codigociudadciclo    = $v;
                                $nombreciudadciclo     = $ciudad;
                                mysqli_data_seek($result, 0);
                            } else {
                                if ($v == $row["CODIGO"]) continue;
                                $codigociudadciclo    = $row["CODIGO"];
                                $nombreciudadciclo     = $row["NOMBRE"];
                            }
                            $num_ciudad++; ?>

<!--Variable $nombreciudadciclo changes for undefined errors -->
<div class="mt-2 text-center titulo-ciudades">
    <a><?php echo isset($nombreciudadciclo) ? $nombreciudadciclo : ""; ?></a>
</div>

<?php
                            $conn2 = @new mysqli($db_server, $db_username, $db_userpassword, $db_name);
                            if ($conn2->connect_error) {
                                $additionalInfo = "Fallo en la conexión a la base de datos en la clase list.php línea 61. Comprueba las credenciales de la base de datos y que el servidor esté funcionando correctamente. Error específico: " . $conn2->connect_error;
                                $errorLogger = new ErrorLogger();
                                $errorLogger->logErrorToFile('errors.txt', "Error de conexión a la base de datos", $additionalInfo);
                                die("Ha ocurrido un error al intentar conectar a la base de datos.");
                            }
                            mysqli_set_charset($conn2, 'utf8');
                            $sql2 = "SELECT PUNTOS.NOMBRE, CATEGORIA, DESCRIPCION" . $l . ", PUNTOS.FECHANEW, PUNTOS.CODIGO, IMAGEN, CLIENTE, GALERIA.ICONO, GALERIA.ICONOG FROM PUNTOS, GALERIA WHERE CIUDAD = '" . $codigociudadciclo . "' AND (PUNTOS.ICONO = GALERIA.CODIGO)";
                            $result2 = $conn2->query($sql2);
                            if (!$result2) {
                                $errorLogger->logError("Error al ejecutar la consulta SQL", $conn2->error);
                            }
                            if ($result2->num_rows > 0) {
                                $puntos = 0; ?>
<div class="container-fluid pb-4" style="margin-top: 10px;">
    <div class="row">
        <div class="swiper swiper-ciudades pb-5">
            <div class="swiper-wrapper">
                <?php
                                 // Crear un contador de formularios
                                                while ($row2 = $result2->fetch_array(MYSQLI_ASSOC)) {
                                                    $puntos++;
                                                    $formID = "myForm" . $formIndex;
                                                    $nombre        = $row2["NOMBRE"];
                                                    $categoriapunto        = $row2["CATEGORIA"];
                                                    $descripcion     = $row2["DESCRIPCION" . $l . ""];
                                                    $fechanew        = $row2["FECHANEW"];
                                                    $codigo        = $row2["CODIGO"];
                                                    $imagenpunto         = $row2["IMAGEN"];
                                                    $clientepunto        = $row2["CLIENTE"];
                                                    $icono                = $row2["ICONO"];
                                                    $iconog                = $row2["ICONOG"];
                                                    if ($iconog == NULL) $iconog = $icono; 
                                                     // Crear un ID único para cada formulario
                                                    ?>
                <!--Bootstrap class, swiper-slide for carrusel and roundend images -->
                <div class="swiper-slide">

                    <!-- Se añade el atributo loaded para hacer una transicion y evitar asi el redimensionado incorrecto de imagenes #contents.css-->
                    <div>
                        <img class="img-list image-transition"
                            src="https://admin.imageen.net/data/puntos/<?= $imagenpunto ?>">

                            <div class="nombres-container2">
    <div class="col-9">
        <?= $nombre; ?>
    </div>

    <div class="img-container col-3 tamaño">
        <?php
            // Comparar las fechas
            if($fechanew > $fecha_actual) {
                echo '<img class="col-6" src="assets\img\icons\icon-new-list.svg" alt="Nuevo punto Imageen">';
            }
            echo '<img class="col-6" src="assets\img\icons\Favoritos.svg" alt="Favoritos ciudades Imageen">';  
        ?>                                                    
    </div>
</div>

                    </div>

                    <!--Bypass ventana punto-->
                    <?php if ($clientepunto == "") { ?>
                    <div class="position-absolute top-1">
                        <i style="color: rgba(255,255,255,1);" class="ri-play-mini-fill ri-6x"></i>
                    </div>

                    <a class="position-absolute h-50 w-50" role="button" href="#contentx"
                        class="text-decoration-none text-dark"
                        onclick=" showListado({'codigo': '<?=$codigo?>', 'descripcion': '<?=$descripcion?>', 'nombre': '<?=$nombre?>'})"></a>

                    <?php 
                                  
                                } else { ?>

                    <a role="button" href="#pointx" data-bs-toggle="modal"
                        onclick="loadPoint({'codigo': '<?= $codigo ?>', 'imagen': '<?= $imagenpunto ?>', 'cliente': '<?= $clientepunto ?>', 'nombre': '<?= $nombre ?>', 'descripcion': '<?= $descripcionpunto ?>', 'icono': '<?= $iconog ?>'})"></a>
                    <?php } ?>
                </div>

                <?php
                            $formIndex++; } ?>
            </div>
            <div class="swiper-pagination col-12" style="margin-top: -20px;"></div>
        </div>
    </div>
</div>

<?php }
                            $conn2->close();
                        }
                    } else { ?>
<p>No hay ciudades</p>
<?php }
                    $conn->close(); ?>
<?php ?>

<script>
//Funcion window para la opacidad del slider
$(window).on('load', function() {
    var swipers = [];

    //opacidades del slider
    $('.swiper-ciudades').each(function(index) {
        swipers[index] = new Swiper(this, {

            pagination: {
                el: '.swiper-pagination',
            },

            centeredSlides: true,
            slidesPerView: 'auto',
            spaceBetween: 10,

            breakpoints: {
                // when window width is >= 320px
                330: {
                    slidesPerView: 1.5,
                    spaceBetween: 15
                },
                // when window width is >= 480px
                495: {
                    slidesPerView: 2,
                    spaceBetween: 15
                },
                // when window width is >= 640px
                660: {
                    slidesPerView: 3,
                    spaceBetween: 15
                },
                825: {
                    slidesPerView: 4,
                    spaceBetween: 15
                }
            },

            on: {
                init: function() {
                    // Set initial opacity
                    $(this.slides).find(".img-list").css("opacity",
                    "0.4"); // Set all images opacity to 0.5
                    var currentSlide = $(this.slides[this
                    .activeIndex]); // Get current active slide
                    currentSlide.find(".img-list").css("opacity",
                    "1"); // Set active image opacity to 1
                },
                slideChange: function() {
                    // Change opacity on slide change
                    $(this.slides).find(".img-list").css("opacity",
                    "0.4"); // Change all images opacity to 0.5
                    var currentSlide = $(this.slides[this
                    .activeIndex]); // Get current active slide
                    currentSlide.find(".img-list").css("opacity",
                    "1"); // Change active image opacity to 1
                }
            }
        });
        swipers[index].init();
    });
});
</script>