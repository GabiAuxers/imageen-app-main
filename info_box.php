<?php
//26-05
//Iniciamos la sesion para posteriormente guardar los datos
session_start();
?>

<?php
    error_log("info_box.php called with GET parameters: " . json_encode($_GET));

    require_once 'conexion.php';
    require_once 'literal.php';
    require_once 'functions.php';
    require_once 'auth.php';

    if ($_SERVER['SERVER_NAME'] == "localhost:8000") {
        $ruta_admin = "/admin";
    } else {
        $ruta_admin = "https://admin.imageen.net";
    }
    //datos enviados a través de un formulario usando el metodo POST
    $codigo      = isset($_POST["codigo"]) ? $_POST["codigo"] : '';
    $nombre      = isset($_POST["nombre"]) ? $_POST["nombre"] : '';
    $descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : '';

    //Guardamos los datos en sesion para usarlos posteriormente en la ficha
    $_SESSION['codigo'] = $codigo;
    $_SESSION['nombre'] = $nombre;
    $_SESSION['descripcion'] = $descripcion;

    $conn = @new mysqli($db_server, $db_username, $db_userpassword, $db_name);
    if ($conn->connect_error) {
        $additionalInfo = "Fallo en la conexión a la base de datos en la clase info_box.php línea 30. Comprueba las credenciales de la base de datos y que el servidor esté funcionando correctamente. Error específico: " . $conn->connect_error;
        $errorLogger = new ErrorLogger(null);
        $errorLogger->logErrorToFile('errors.txt', "Error de conexión a la base de datos", $additionalInfo);
        die("Ha ocurrido un error al intentar conectar a la base de datos.");
    }
    mysqli_set_charset($conn, 'utf8');
    // Consulta para obtener la dirección de la tabla puntos

     $stmt = $conn-> prepare("SELECT PUNTOS.DIRECCION  FROM PUNTOS  WHERE PUNTOS.CODIGO = ?");
     if ($stmt === false) {
        die("Error: " . $conn->error);
    }
     $stmt->bind_param("s", $codigo);
        $stmt->execute();
        $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            //guardarmos la direccion correspondiente a la fila DIRECCION de la tabla puntos
            $direccion = $row["DIRECCION"];
        }
    }
    $stmt->close();
    ?>

<div>
    <div class="fila-titulo">
        <div class="title-infobox">
            <a><?php echo $nombre; ?></a>
        </div>
        <a href="#">
            <img src="assets\img\icons\Cerrar.svg" width="50px" height="50px" style="margin-top: -10px;" alt="Cerrar popup"
                onclick="ocultarInfoBox()">
        </a>
    </div>

    <!--mostramos la direccion-->
    <div class="subtitle-infobox">
        <p><?php echo $direccion; ?></p>
    </div>
    <div class="info-box-content">
        <?php

            if (isset($codigo)) {
                // Crear conexión a la base de datos

                // Consulta para obtener las imágenes y descripciones adicionales de la tabla materiales
                $stmt2 = $conn->prepare("SELECT PUNTOS.NOMBRE AS NOMBRE_PUNTO, PUNTOS.CIUDAD, PUNTOS.LOCALIZACION, PUNTOS.CLIENTE, PUNTOS.IMAGEN AS IMAGEN_PUNTO, MATERIALES.CODIGO AS CODIGO_MATERIAL, MATERIALES.NOMBRE" . $l . " AS NOMBRE_MATERIAL, MATERIALES.DESCRIPCION" . $l . " AS DESCRIPCION_MATERIAL, MATERIALES.TIPO AS TIPO_MATERIAL, MATERIALES.ACCESO AS ACCESO_MATERIAL, MATERIALES.INSTRUCCIONES" . $l . " AS INSTRUCCION_MATERIAL, MATERIALES.IMAGEN AS IMAGEN_MATERIAL FROM MATERIALES JOIN PUNTOS ON MATERIALES.PUNTO = PUNTOS.CODIGO WHERE MATERIALES.PUNTO = ? AND PUNTOS.CODIGO = ? ORDER BY MATERIALES.ORDEN");
                $stmt2->bind_param("ss", $codigo, $codigo);
                $stmt2->execute();
                $result2 = $stmt2->get_result();
                if ($result2->num_rows > 0) {
                    $formIndex = 0;
            ?>

        <div class="slider-container2">
            <!-- Slider principal -->
            <div class="swiper-container">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper-infobox">
                    <?php
                                while ($row = $result2->fetch_assoc()) {
                                    $formID = "myForm" . $formIndex;
                                    $codigo_material = $row["CODIGO_MATERIAL"];
                                    $nombre_material = str_replace("~", "'", $row["NOMBRE_MATERIAL"]);
                                    $imagen_material = $row["IMAGEN_MATERIAL"];
                                    $descripcion_material = str_replace("~", "'", $row["DESCRIPCION_MATERIAL"]);
                                    $acceso_material = $row["ACCESO_MATERIAL"];
                                    $tipo_material = $row["TIPO_MATERIAL"];
                                    $instrucciones_material = str_replace("~", "'", $row["INSTRUCCION_MATERIAL"]);
                                    $nombre_punto  = $row["NOMBRE_PUNTO"];
                                    // 
                                    if ($imagen_material) {
                                        $ruta_imagen = $ruta_admin . "/data/materiales/" . $imagen_material;
                                    } else {
                                        $ruta_imagen = $ruta_admin . "/data/puntos/" . $imagen;
                                    }
                                    $carpeta_destino = "";
                                    $carpeta_destino2 = "";
                                    $carpeta_spanish = "";

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
                                    $stmt4 = $conn->prepare("SELECT AVG(PUNTUACION) AS RATING FROM HVALORACION WHERE MATERIAL = ?");
                            
                                    $stmt4->bind_param("s", $codigo_material);
                                    $stmt4->execute();
                                    $result4 = $stmt4->get_result();
                                    $row4 = $result4->fetch_assoc();
                                    $rating = $row4["RATING"];
                                    $stmt4->close();
                                ?>
                    <div class="swiper-slide2 col-12 col-md-6 col-lg-4"
                        id="<?= $nombre_punto ?>#<?= $nombre_material ?>">
                        <div class="content-container-infobox">
                            <div class="d-flex align-items-center justify-content-center">
                                <img src="<?= $ruta_imagen ?>">
                                <div class="position-absolute">
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
                                        class="ri-play-mini-fill ri-4x position:relative"
                                        onclick="addWatch('<?= $codigo ?>','<?= $codigo_material ?>','<?= $codigo_version ?>','<?= $carpeta_destino ?>','<?= $l ?>', '<?= $nombre_usuario ?>', '<?= $instrucciones_material ?>', '<?= $nombre_punto ?>#<?= $nombre_material ?>', '<?= $acceso_material ?>')"></i>
                                    <?php endif;  ?>
                                </div>
                            </div>
                            <div class="nombres-container-infobox">
                                <!--Guardamos en una nueva variable el nombre del tipo de material con la funcion dame_tipo_material
                            pasandole como parametros el tipo de material y el literal del idioma-->
                                <?php  echo $nombre_tipo_material = dame_tipo_material($tipo_material, $l);?>
                            </div>
                            <div class="rating2">
                            <?php
                            // Separar la calificación en partes enteras y decimales
                            $entera = floor($rating);
                            $decimal = $rating - $entera;
                            ?>
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <?php if($i <= $entera): ?>
                                <!-- Renderizar una estrella llena si $i es menor o igual a la parte entera de la calificación -->
                                <i class="fas fa-star"></i>
                                <?php elseif($i == $entera + 1 && $decimal >= 0.5): ?>
                                <!-- Renderizar una estrella a la mitad si $i es igual a la parte entera de la calificación más uno y la parte decimal de la calificación es mayor o igual a 0.5 -->
                                <i class="fas fa-star-half-alt"></i>
                                <?php else: ?>
                                <!-- Renderizar una estrella vacía en cualquier otro caso -->
                                <i class="far fa-star"></i>
                                <?php endif; ?>
                            <?php endfor; ?>
                            <div class="texto-stars">
                                <a><?=number_format($rating, 1)?></a>
                            </div>

                            </div>
                            <!--Comentarios, aqui deberia de ir la un href para que lleve a la seccion de comentarios
                                o al contenido de ficha donde estan estos.-->
                                <div class="texto-comentarios-infobox">
                                <p>20 <?= getTxt(312, $l) ?></p>
                            </div>
                        </div>

                    </div>


                    <?php
                               $formIndex++; }

                                ?>
                </div>

                <!-- Añade los elementos de paginación -->
                <div class="swiper-pagination"></div>

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


    </div>
        <div class="fila-explorar">
            <a href="?section=ficha&t=3">
                <button class="btn btn-explorar"><?= getTxt(295, $l) ?></button>
            </a>
            <div class="img-group">
                <?php
                    echo '<img id="favorito-' . $formIndex . '" class="favoritos" src="assets/img/icons/Favoritos.svg" width="30px" height="30px" alt="Favoritos ciudades Imageen" data-codigo="' . $codigo . '">';         
                ?>
                <img src="assets\img\icons\Descargar.svg" width="30px" height="30px" alt="Compartir">
                
        </div>
    </div>
</div>


<script async>
document.addEventListener('DOMContentLoaded', function() {
    var swiper = new Swiper('.swiper-slide2', {
        loop: false,
        slidesPerView: 1,
        spaceBetween: 10,
        // Centrar la imagen en el slider
        centeredSlides: true,

        // Espacio entre las imágenes (opcional, en caso de que quieras agregar espacio)
        spaceBetween: 10,

        navigation: {

        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        // Agregar estas opciones en la configuración de Swiper
        observer: true,
        observeParents: true,
        observeSlideChildren: true,
    });
});

$(document).ready(function() {
    const favoritos = document.querySelectorAll('.favoritos');
    
    // Comprueba el estado de favorito al cargar la página
    fetch(`_getFavorito.php`)  // Nota: He cambiado el nombre del archivo PHP
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            favoritos.forEach((favorito) => {
                let codigo = favorito.dataset.codigo;
                if (data.codigosFavoritos.includes(codigo)) {
                    favorito.src = "assets/img/icons/Favoritos_relleno.svg";
                } else {
                    favorito.src = "assets/img/icons/Favoritos.svg";
                }
            });
        })
        .catch(e => console.log('There has been a problem with your fetch operation: ' + e.message));

    favoritos.forEach((favorito) => {
        let codigo = favorito.dataset.codigo;

        favorito.addEventListener('click', function () {
            // Cambia la imagen inmediatamente cuando se hace clic en ella
            if (favorito.src.includes('Favoritos_relleno')) {
                favorito.src = "assets/img/icons/Favoritos.svg";
            } else {
                favorito.src = "assets/img/icons/Favoritos_relleno.svg";
            }
            // Hacer la petición fetch
            fetch(`_toggleFavorito.php?codigo_material=${codigo}`)
                .then(response => response.json())
                .then(data => {
                    // Si la petición fetch indica que el estado no cambió, cambiar la imagen de nuevo
                    if (!data.ES_FAVORITO && favorito.src.includes('Favoritos_relleno')) {
                        favorito.src = "assets/img/icons/Favoritos.svg";
                    } else if (data.ES_FAVORITO && favorito.src.includes('Favoritos')) {
                        favorito.src = "assets/img/icons/Favoritos_relleno.svg";
                    }
                });
        });
    });
});
</script>
