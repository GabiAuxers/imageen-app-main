<?php
//26-05
ini_set('session.cookie_secure', 1);
session_start([
    'cookie_samesite' => 'Lax',
]);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
require_once 'ErrorLogger.php';

if ($_SERVER['SERVER_NAME'] == "localhost") {
    $ruta_admin = "/admin";
} else {
    $ruta_admin = "https://admin.imageen.net";
}

// Obtener la fecha actual
$fecha_actual = date('Y-m-d H:i:s'); // Formato: Año-Mes-Día

if (isset($_COOKIE['usuario'])) {
    $codigousuario = trim($_COOKIE['usuario'], " ");
} else {
    $codigousuario = "";
}
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
$stmt = $conn->prepare("SELECT CODIGO, NOMBRE FROM CIUDADES WHERE ESTADO = 1 ORDER BY ORDEN ");
$stmt->execute();
$result = $stmt->get_result();

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
        <div class="text-center titulo-ciudades fade-in">
            <a><?php echo isset($nombreciudadciclo) ? $nombreciudadciclo : ""; ?></a>
        </div>

        <?php
        $stmt2 = $conn->prepare("SELECT PUNTOS.NOMBRE, CATEGORIA, DESCRIPCION" . $l . ", PUNTOS.FECHANEW, PUNTOS.CODIGO, IMAGEN, CLIENTE, GALERIA.ICONO, GALERIA.ICONOG FROM PUNTOS, GALERIA WHERE CIUDAD = ? AND (PUNTOS.ICONO = GALERIA.CODIGO)");
        $stmt2->bind_param("s", $codigociudadciclo);
        $stmt2->execute();
        $result2 = $stmt2->get_result();

        if (!$result2) {
            $errorLogger->logError("Error al ejecutar la consulta SQL", $conn->error);
        }
        if ($result2->num_rows > 0) {
            $puntos = 0; ?>
            <div class="container-fluid" id="hola">
                <div class="row ">
                    <div class="swiper swiper-ciudades pb-5 ">
                        <div class="swiper-wrapper ">
                            <?php
                            // Crear un contador de formularios
                            while ($row2 = $result2->fetch_array(MYSQLI_ASSOC)) {
                                $puntos++;
                                $nombre        = $row2["NOMBRE"];
                                $categoriapunto        = $row2["CATEGORIA"];
                                $descripcion     = $row2["DESCRIPCION" . $l . ""];
                                $fechanew        = $row2["FECHANEW"];
                                $codigo        = $row2["CODIGO"];
                                $formID = "myForm" . $formIndex;
                                $imagenpunto         = $row2["IMAGEN"];
                                $clientepunto        = $row2["CLIENTE"];
                                $icono                = $row2["ICONO"];
                                $iconog                = $row2["ICONOG"];
                                if ($iconog == NULL) $iconog = $icono;

                                $query = "SELECT PUNTOS.CODIGO, TOKENS.NOMBRE, TOKENS.DESCRIPCION, TOKENS.TOKEN FROM PUNTOS 
                                                    JOIN TOKENS ON PUNTOS.CODIGO = TOKENS.CODIGO
                                                     WHERE TOKENS.CODIGO = ?";
                                $stmt9 = $conn->prepare($query);
                                $stmt9->bind_param('s', $codigo);
                                $stmt9->execute();
                                $result9 = $stmt9->get_result();
                                $row9 = $result9->fetch_assoc();
                                if ($result9->num_rows > 0) {
                                    $token = $row9['TOKEN'];
                                } else {
                                    $token = "";
                                }
                                $stmt9->close();
                            ?>

                                <!--Bootstrap class, swiper-slide for carrusel and roundend images -->
                                <div class="swiper-slide">
                                    <!-- Se añade el atributo loaded para hacer una transicion y evitar asi el redimensionado incorrecto de imagenes #contents.css-->
                                    <div>
                                        <img class="img-list fade-in" src="https://admin.imageen.net/data/puntos/<?= $imagenpunto ?>">
                                        <div class="nombres-container2">
                                            <div class="col-9 fade-in">
                                                <?= $nombre; ?>
                                            </div>
                                            <div class="img-container col-3 tamaño fade-in">
                                                <?php
                                                // Comparar las fechas
                                                if ($fechanew > $fecha_actual) {
                                                    echo '<img class="col-6" src="assets\img\icons\icon-new-list.svg" alt="Nuevo punto Imageen">';
                                                }
                                                echo '<img id="favorito-' . $formIndex . '" class="favoritos col-6" src="assets/img/icons/Favoritos.svg" alt="Favoritos ciudades Imageen" data-codigo="' . $codigo . '">';
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Bypass ventana punto-->
                                    <?php if ($clientepunto == "") { ?>
                                        <div class="position-absolute top-1">
                                            <i style="color: rgba(255,255,255,1);" class="ri-play-mini-fill ri-6x"></i>
                                        </div>
                                        <a class="position-absolute h-50 w-50" role="button" href="?section=ficha&t=3&ref=listado&token=<?= $token ?>" class="text-decoration-none text-dark" onclick=" showListado({'codigo': '<?= $codigo ?>', 'descripcion': '<?= $descripcion ?>', 'nombre': '<?= $nombre ?>'})"></a>
                                    <?php
                                    } else { ?>
                                        <a role="button" href="?section=ficha&t=3&ref=listado&token=<?= $token ?>" onclick="loadPoint({'codigo': '<?= $codigo ?>', 'imagen': '<?= $imagenpunto ?>', 'cliente': '<?= $clientepunto ?>', 'nombre': '<?= $nombre ?>', 'descripcion': '<?= $descripcionpunto ?>', 'icono': '<?= $iconog ?>'})"></a>
                                    <?php } ?>
                                </div>
                            <?php
                                $formIndex++;
                            }
                            ?>
                        </div>
                        <div class="swiper-pagination col-12" style="margin-top: -20px;"></div>
                    </div>
                </div>
            </div>

    <?php }
        $stmt2->close();
    }
} else { ?>
    <p>No hay ciudades</p>
<?php }
$stmt->close();
$conn->close(); ?>
<?php ?>

<script async>
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

    window.onload = function() {
        const elements = document.querySelectorAll('.fade-in');
        elements.forEach((element) => {
            element.classList.add('visible');
        });
    };
</script>