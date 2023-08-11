<!DOCTYPE html>
<html lang="en">
<body>
    <div id="cookiesAlert" class="modal fade">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content bg-primary p-15px text-center">
                <h4 class="text-white">Aviso de Cookies</h4>
                <p class="text-white">Usamos cookies propias y de terceros para mejorar nuestros servicios. Si continúa con
                    la navegación, consideraremos que acepta este uso.</p>
                <hr>
                <h4 class="text-white">Cookies Alert</h4>
                <p class="text-white">We use our own and third-party cookies to improve our services. If you continue
                    browsing, we will consider that you accept this use.</p>
                <a class="btn btn-light btn-sm mt-30px" data-bs-dismiss="modal" onclick="saveCookie()">OK</a>
            </div>
        </div>
    </div>


    <!-- Email - recopilacion de correos -->
    <div class="modal" tabindex="-1" id="emailRecopilacion">
    <div class="modal-dialog">
        <div class="modal-idiomas text-center">
        <div class="modal-body">
            <div class="row mt-20px">
                <div class="text-center"> 
                    <p><h4><?=getTxt(259,$l)?></h4></p>
                    <h6><?=getTxt(260,$l)?></h6>
                    <h6><?=getTxt(261,$l)?></h6>
                    <label for="box-email4" class="input-label form-label"></label>
                    <input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" class="form-control txt-input-ps-5x" id="box-email4" value="<?=getTxt(266,$l)?>" oninput="cambiosCorreo3()">
                    <span id="err-box-email4" class="mt-1" style="display:none; color:red;"><?=getTxt(265,$l)?></span>
                    <button type="button" id="boton-datos-personales4" onclick="checkForm5()" class="row btn boton-principal mx-auto fs-6 mt-3" style="background:#2765A0;"><i class="ri-save-2-fill align-middle fs-3"></i><?=getTxt(264,$l)?></button> 	        	     
                </div>
            </div>	
        </div>
        <div class="modal-footer d-flex justify-content-around">
            <h6><?=getTxt(262,$l)?></h6>
            <a data-bs-dismiss="modal" style=color:#2765A0;><?=getTxt(263,$l)?></a> 
        </div>
        </div>
    </div>
    </div>

    <div class="modal" tabindex="-1" id="confirma-datos-personales">
        <div class="modal-dialog">
            <div class="modal-content text-center">
                <div class="modal-body">
                    <h3><?=getTxt(103,$l)?></h3>
                    <h6><?=getTxt(105,$l)?></h6>
                </div>
                <div class="modal-footer text-center mx-auto">
                    <button type="button" class="btn boton-principal" data-bs-dismiss="modal"
                        onclick="location.reload();"><?=getTxt(104,$l)?></button>
                </div>
            </div>
        </div>
    </div>


    <!-- Popup preguntando sobre la geolocalizacion -->
    <div id="askGeo" class="modal fade">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="align-middle ri-map-pin-fill ri-xl m-2"></i><?= getTxt(24, $l) ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                </div>
                <div class="modal-body">
                    <p><?= getTxt(25, $l) ?></p>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-warning w-100" onclick="getLocation()" style="margin:0 auto;"><i
                            class="align-middle ri-map-pin-fill ri-xl m-2"></i><?= getTxt(26, $l) ?></a>
                    <a class="btn btn-warning mt-10px w-100" onclick="cambiarVisual(2, <?= $l ?>)" style="margin:0 auto;"><i
                            class="align-middle ri-file-list-fill ri-xl m-2"></i><?= getTxt(27, $l) ?></a>
                    <a class="btn btn-warning mt-10px w-100" onclick="goContents(false)" style="margin:0 auto;"><i
                            class="align-middle ri-close-fill ri-xl m-2"></i><?= getTxt(97, $l) ?></a>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN Popup preguntando sobre la geolocalizacion -->

    <!-- mas modales ... -->
    <div id="add2hs-ios" class="modal fade">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content border-3">
                <div class="modal-header">
                    <h5 class="modal-title"><?= getTxt(140, $l) ?></h5>
                </div>
                <div class="modal-body">
                    <h6><?= getTxt(141, $l) ?> ( <img src="imagenes/icono-compartir.png" style="width:15px;" /> )
                        <?= getTxt(142, $l) ?></h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= getTxt(104, $l) ?></button>
                </div>
            </div>
        </div>
    </div>


    <div id="fvarios" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content" id="varios">

            </div>
        </div>
    </div>

    <div id="addpoints" class="modal fade addpoints">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content-valoracion">
                <div class="modal-body">
                <div>
                <img src="assets/img/icons/Cerrar.svg" class="close-button-modal-valoracion text-end" data-bs-dismiss="modal" aria-hidden="true"></i></img>
                </div>
                    <p class="txt-modalvaloracion-titulo"><?= getTxt(82, $l) ?></p>
                    <div class="row mt-4">
                        <div class="d-flex justify-content-between text-center">
                            <div><a id="p1" style="cursor: pointer;"><img id="s1" src="imagenes/star0.png"
                                        class="image-fluid"></a></div>
                            <div><a id="p2" style="cursor: pointer;"><img id="s2" src="imagenes/star0.png"
                                        class="image-fluid"></a></div>
                            <div><a id="p3" style="cursor: pointer;"><img id="s3" src="imagenes/star0.png"
                                        class="image-fluid"></a></div>
                            <div><a id="p4" style="cursor: pointer;"><img id="s4" src="imagenes/star0.png"
                                        class="image-fluid"></a></div>
                            <div><a id="p5" style="cursor: pointer;"><img id="s5" src="imagenes/star0.png"
                                        class="image-fluid"></a></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer-valoracion">
                    <button type="button" class="btn btn-primary-rate" data-bs-dismiss="modal"><?= getTxt(62, $l) ?></button>
                    <a id="puntuar" type="button" class="btn btn-primary-valoracion"
                        data-bs-dismiss="modal"><?= getTxt(96, $l) ?></a>
                </div>
            </div>
        </div>
    </div>

    <!--Nuevo modal para imageen. Para instanciarlo, se deberan colocar los atributos
    data-toggle="modal" data-target="#miModal" en el componente que vaya a desencadenar la accion.
    Para instanciarlo se puede usar jQuery o JavaScript, ejemplo:

    $(document).ready(function() {
    $('#miModal').modal('show');
    }); 

    o bien:

    document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('miModal').modal('show');
    });-->
    <div class="modal-background fade addpoints" id="modalPremium" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="nuevo-modal-content">
                <div class="nuevo-modal-header">
                    <a href="#" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <img class="cerrar-modal" src="assets/img/icons/Cerrar.svg" alt="Cerrar">
                    </a>
                </div>
                <a class="txt-titulo-modal">¡HAZTE PREMIUM!</a>
                <div class="nuevo-modal-body">
                    <p class="txt-nuevo-modal">Disfruta de contenido en exclusiva y descubre todos los secretos.</p>
                </div>
                <div class="nuevo-modal-footer">
                    <button type="button" class="btn-modal-premium">Premium</button>
                </div>
            </div>
        </div>
    </div>
    <!--Fin nuevo modal para imagen-->

    <!--Modal info idioma catalan y frances-->
    <div class="modal" tabindex="-1" id="segundo-idioma-frances">
    <div class="modal-dialog">
        <div class="modal-idiomas text-center">
        <div class="modal-body">
            <h3><?=getTxt(88,3)?></h3>
            <h6><?=getTxt(89,3)?></h6>
        </div>
        <div class="modal-footer d-flex justify-content-around">
            <a href="#" onclick="changeLng(3,1)" ><img class="'bandera-seleccionada':'bandera'" src="./imagenes/Spain.svg" style="width:42px;"></a>
            <a href="#" onclick="changeLng(3,2)" ><img class="'bandera-seleccionada':'bandera'" src="./imagenes/EEUU.svg" style="width:42px;"></a>
        </div>
        </div>
    </div>
    </div>

    <div class="modal" tabindex="-1" id="segundo-idioma-catalan">
    <div class="modal-dialog">
        <div class="modal-idiomas text-center">
        <div class="modal-body">
            <h3><?=getTxt(88,4)?></h3>
            <h6><?=getTxt(89,4)?></h6>
        </div>
        <div class="modal-footer d-flex justify-content-around">
            <a href="#" onclick="changeLng(4,1)" ><img class="'bandera-seleccionada':'bandera'" src="./imagenes/Spain.svg" style="width:42px;"></a>
            <a href="#" onclick="changeLng(4,2)" ><img class="'bandera-seleccionada':'bandera'" src="./imagenes/EEUU.svg" style="width:42px;"></a>
        </div>
        </div>
    </div>
    </div>
    <!-- Fin Modal info idioma catalan y frances-->

    <!--valorar modal-->
    <div id="valoraapp" class="modal fade addpoints">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="close-button" data-bs-dismiss="modal" aria-hidden="true"
                    style="float:right;"><i class="ri-close-fill ri-3x text-danger"></i></button>
                <div class="modal-body">
                    <h5><?= getTxt(106, $l) ?></h5>
                    <h6><?= getTxt(107, $l) ?></h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn boton-secundario"
                        data-bs-dismiss="modal"><?= getTxt(62, $l) ?></button>
                    <button id="puntuar" type="button" data-bs-toggle="offcanvas" data-bs-target="#pagina-valoracion"
                        class="btn boton-principal" data-bs-dismiss="modal"><?= getTxt(123, $l) ?></button>
                </div>
            </div>
        </div>
    </div>
    <!--Fin valorar modal-->

    <!--share modal-->
    <div id="share" class="modal fade addpoints">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <!--<button type="button" class="close-button" data-bs-dismiss="modal" aria-hidden="true" style="float:right;"><i class="ri-close-fill ri-3x text-danger"></i></button>-->
                <div class="modal-body">
                    <div class="mx-auto text-center">
                        <h5><?= getTxt(164, $l) ?></h5>
                    </div>
                    <div class="mx-auto text-center">
                        <button type="button" class="btn boton-principal"
                            data-bs-dismiss="modal"><?= getTxt(162, $l) ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--fin share modal-->


    <div id="pointx" class="modal fade">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" id="content_point" style="background-color: transparent;">

            </div>
        </div>
    </div>
    <!-- FIN mas modales... -->

    <!-- Este código define un off-canvas de Bootstrap con el ID pointx_oc.
    Un off-canvas es un componente que se desliza desde un borde de la ventana y se utiliza 
    para mostrar contenido adicional sin salir de la página actual. En este caso, se deslizará desde la parte inferior de la ventana. -->
    <div id="pointx_oc" class="offcanvas offcanvas-bottom">
        <div class="offcanvas-body" id="content_point_oc">
        </div>
    </div>

    <div id="contentx" class="modal fade">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" id="contents_list" style="background-color: transparent;">

            </div>
        </div>
    </div>

    <div id="v3dvista" class="modal fade">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
            <button type="button" class="btn-out" data-bs-dismiss="modal" onclick="closeVideo(); openPoints();" aria-label="close"><i
    class="ri-close-circle-fill text-danger ri-3x"></i></button>
                <!--TODO: Boton Compartir del aplicativo sustituir por el de 3dVista-->
                <!--<button type="button" class="btn-share" data-bs-dismiss="modal" onclick ="shareMedia();" aria-label="close"><i style="color:rgba(255,255,255,1);" class="ri-share-line ri-3x"></i></button>-->
                <!--TODO: Boton Compartir del aplicativo sustituir por el de 3dVista-->
                <!--<button type="button" class="txt-share" data-bs-dismiss="modal" onclick ="shareMedia();" style="color:rgba(255,255,255,1);" ><h8><?= getTxt(166, $l) ?></h8></button>-->
                <div id="padreiframe" class="embed-responsive embed-responsive-16by9">
                    <!--<iframe id="video" class="embed-responsive-item" style='position:absolute; top:0; left:0; width:100%; height:100%;' name='TOUR NAME' width='100%' height='100%' frameborder='0' allowfullscreen='true' allow='fullscreen; accelerometer; gyroscope; magnetometer; vr; xr; xr-spatial-tracking; autoplay; camera; microphone'></iframe>-->
                </div>
            </div>
        </div>
    </div>



    <!-- MEMBRESIA -->
    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="membership" aria-labelledby="membership-label"
        style="z-index:3000;">
        <div class="offcanvas-header pb-0">
            <button class="aspa-cierre border-0 m-2 rounded-circle px-0" data-bs-dismiss="offcanvas" aria-label="Close"><i
                    class="ri-arrow-left-line ri-xl align-middle"></i></button>
        </div>
        <div class="offcanvas-body pt-0 d-flex flex-column align-items-center">
            <?php if ($suscripcion_usuario == 3) : ?>
            <h3 id="membership-label"><?= getTxt(127, $l) ?></h3>
            <p class="titulo-menu my-4"><?= getTxt(125, $l) ?><?= $fin_suscripcion_usuario ?><?= getTxt(126, $l) ?></p>
            <?php else : ?>
            <h3 id="membership-label"><?= getTxt(61, $l) ?></h3>
            <!--<p class="titulo-menu my-4"><?= getTxt(124, $l) ?></p>-->
            <?php endif; ?>
            <div id="form-checkout" class="col-12 col-sm-10 col-md-8 col-lg-6 mx-auto">
                <?php
        $conn = @new mysqli($db_server, $db_username, $db_userpassword, $db_name);
        if ($conn->connect_error) {
            $additionalInfo = "Fallo en la conexión a la base de datos en la clase modals.php línea 233. Comprueba las credenciales de la base de datos y que el servidor esté funcionando correctamente. Error específico: " . $conn->connect_error;
            $errorLogger = new ErrorLogger();
            $errorLogger->logErrorToFile('errors.txt', "Error de conexión a la base de datos", $additionalInfo);
            die("Ha ocurrido un error al intentar conectar a la base de datos.");
        }
    mysqli_set_charset($conn, 'utf8');
    $stmt = $conn->prepare("SELECT CODIGO, NOMBRE" . $l . ", VALIDEZ, PRECIO, ACTIVA, DESTACADA, STRIPEPRICE FROM SUSCRIPCIONES ORDER BY PRECIO");
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $suscripcion = 0;
        while ($row = mysqli_fetch_array($result)) {
            $suscripcion++;
            $codigosus = $row["CODIGO"];
            $nombresus = $row["NOMBRE" . $l];
            $validezsus = $row["VALIDEZ"];
            $preciosus = $row["PRECIO"];
            $activa = $row["ACTIVA"];
            $destacada = $row["DESTACADA"];
            $stripe_price = $row["STRIPEPRICE"];

            if ($activa) {
                $fecha_actual = date("d-m-Y");
                if (!empty($fin_suscripcion_usuario)) $fecha_actual = $fin_suscripcion_usuario;
                $endsubscription = date("d-m-Y", strtotime($fecha_actual . "+ " . $validezsus . " days"));
                if ($destacada) {
    ?>
                <div class="d-flex flex-row-reverse">
                    <div class="mas-popular"><?= getTxt(144, $l) ?></div>
                </div>
                <?php } ?>
                <?php if (isset($suscripcion) && isset($destacada) && isset($stripe_price) && isset($nombresus) && isset($endsubscription)) : ?>
                <a onclick="clickSuscripcion(<?= $suscripcion ?>)"
                    class="ficha-suscripcion<?= $destacada ? '-seleccionada' : '' ?>" id="ficha-sus-<?= $suscripcion ?>"
                    data-stripe="<?= $stripe_price ?>">
                    <div class="d-flex flex-column">
                        <div>
                            <h6 style="font-weight:bold; color:#2765A0;"><?= $nombresus ?></h6>
                        </div>
                        <div style="font-size:0.9em; color:black;">
                            <?= getTxt(63, $l) ?><span class="ms-1"><?= $endsubscription ?></span>
                            <span style="color:grey;"><br><?= getTxt(145, $l) ?></span>
                        </div>
                    </div>
                </a>
                <?php endif; ?>

                <div class="ms-auto" style="text-align: right; color:black;">
                    <?php if (isset($preciosus)) { ?>
                    <h5><?= $preciosus ?>€</h5>
                    <?php } ?>
                </div>
                <?php }
        }
    }
    $stmt->close();
    $conn->close();
    ?>

                <!--undefined variable $url_checkout  + 7.4.32 php-->
                <div class="mx-auto text-center">
                    <?php $url_checkout = "./create_checkout_session.php" . ((!empty($_SERVER['QUERY_STRING'])) ? ('?' . urlencode($_SERVER['QUERY_STRING'])) : ''); ?>
                    <button class="btn boton-principal m-3 row" id="checkout-button"
                        onclick="goToCheckout('<?= $url_checkout ?>')"><i
                            class="ri-thumb-up-line align-middle fs-3"></i><?= getTxt(165, $l) ?></button>
                </div>

                <p class="titulo-menu my-4"><?= getTxt(168, $l) ?></p>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="membership2" aria-labelledby="membership2-label"
        style="z-index:3000;">
        <div class="offcanvas-header pb-0">
            <button class="aspa-cierre border-0 m-2 rounded-circle px-0" data-bs-dismiss="offcanvas" aria-label="Close"><i
                    class="ri-arrow-left-line ri-xl align-middle"></i></button>
        </div>
        <div class="offcanvas-body pt-0 d-flex flex-column align-items-center">
            <?php if ($suscripcion_usuario == 3) : ?>
            <h3 id="membership2-label"><?= getTxt(127, $l) ?></h3>
            <p class="titulo-menu my-4"><?= getTxt(125, $l) ?><?= $fin_suscripcion_usuario ?><?= getTxt(126, $l) ?></p>
            <?php else : ?>
            <h3 id="membership2-label"><?= getTxt(61, $l) ?></h3>
            <!--<p class="titulo-menu my-4"><?= getTxt(124, $l) ?></p>-->
            <?php endif; ?>
            <div id="form-checkout2" class="col-12 col-sm-10 col-md-8 col-lg-6 mx-auto">
                <?php
                    $conn = @new mysqli($db_server, $db_username, $db_userpassword, $db_name);
                    if ($conn->connect_error) {
                        $additionalInfo = "Fallo en la conexión a la base de datos en la clase modals.php línea 321 Comprueba las credenciales de la base de datos y que el servidor esté funcionando correctamente. Error específico: " . $conn->connect_error;
                        $errorLogger = new ErrorLogger();
                        $errorLogger->logErrorToFile('errors.txt', "Error de conexión a la base de datos", $additionalInfo);
                        die("Ha ocurrido un error al intentar conectar a la base de datos.");
                    }
                mysqli_set_charset($conn, 'utf8');
                "SELECT CODIGO, NOMBRE" . $l . ", VALIDEZ, PRECIO, ACTIVA, DESTACADA, STRIPEPRICE FROM SUSCRIPCIONES ORDER BY PRECIO";
                $stmt2 = $conn->prepare("SELECT CODIGO, NOMBRE" . $l . ", VALIDEZ, PRECIO, ACTIVA, DESTACADA, STRIPEPRICE FROM SUSCRIPCIONES ORDER BY PRECIO");
                $stmt2->execute();
                $result = $stmt2->get_result();

                if ($result->num_rows > 0) {
                    $suscripcion = 0;
                    while ($row = mysqli_fetch_array($result)) {
                        $suscripcion++;
                        $codigosus = $row["CODIGO"];
                        $nombresus = $row["NOMBRE" . $l];
                        $validezsus = $row["VALIDEZ"];
                        $preciosus = $row["PRECIO"];
                        $activa = $row["ACTIVA"];
                        $destacada = $row["DESTACADA"];
                        $stripe_price = $row["STRIPEPRICE"];

                        if ($activa) {
                            $fecha_actual = date("d-m-Y");
                            if (!empty($fin_suscripcion_usuario)) $fecha_actual = $fin_suscripcion_usuario;
                            $endsubscription = date("d-m-Y", strtotime($fecha_actual . "+ " . $validezsus . " days"));
                            if ($destacada) {
                        ?>
                <div class="d-flex flex-row-reverse">
                    <div class="mas-popular"><?= getTxt(144, $l) ?></div>
                </div>
                <?php } ?>
                <?php if (isset($suscripcion) && isset($destacada) && isset($stripe_price) && isset($nombresus) && isset($endsubscription)) : ?>
                <a onclick="clickSuscripcion(<?= $suscripcion ?>)"
                    class="ficha-suscripcion<?= $destacada ? '-seleccionada' : '' ?>" id="ficha-sus-<?= $suscripcion ?>"
                    data-stripe="<?= $stripe_price ?>">
                    <div class="d-flex flex-column">
                        <div>
                            <h6 style="font-weight:bold; color:#2765A0;"><?= $nombresus ?></h6>
                        </div>
                        <div style="font-size:0.9em; color:black;">
                            <?= getTxt(63, $l) ?><span class="ms-1"><?= $endsubscription ?></span>
                            <span style="color:grey;"><br><?= getTxt(145, $l) ?></span>
                        </div>
                    </div>
                </a>
                <?php endif; ?>

                <div class="ms-auto" style="text-align: right; color:black;">
                    <?php if (isset($preciosus)) { ?>
                    <h5><?= $preciosus ?>€</h5>
                    <?php } ?>
                </div>
                <?php }
                    }
                }
                $stmt2->close();
                $conn->close();

                $url_checkout = "./create_checkout_session.php" . ((!empty($_SERVER['QUERY_STRING'])) ? ('?' . urlencode($_SERVER['QUERY_STRING'])) : '');
                ?>
                <div class="mx-auto text-center">
                    <button class="btn boton-principal m-3 row" id="checkout-button"
                        onclick="goToCheckout('<?= $url_checkout ?>')"><i
                            class="ri-thumb-up-line align-middle fs-3"></i><?= getTxt(165, $l) ?></button>
                </div>
                <p class="titulo-menu my-4"><?= getTxt(218, $l) ?></p>
            </div>
        </div>
    </div>

    <!--mas modales...-->
    <div id="instrucciones" class="modal fade">
        <div class="modal-dialog modal-sm">
            <div class="modal-content border-3">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="ri-user-location-line ri-2x"></i><?= getTxt(143, $l) ?></h5>
                </div>
                <div id="instrucciones_texto" class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= getTxt(104, $l) ?></button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    function cambiosCorreo()
{
	if( document.getElementById("box-email2").value != "<?=$email_usuario?>"){
			document.getElementById("boton-datos-personales2").disabled=false;
			document.getElementById("boton-datos-personales2").style.background="#2765A0";
	} else {
		document.getElementById("boton-datos-personales2").disabled=true;
		document.getElementById("boton-datos-personales2").style.background="#A8ABAD";
	}
	document.getElementById("err-box-email2").style.display="none";
}

function cambiosCorreo2()
{
	if( document.getElementById("box-email3").value != "<?=$email_usuario?>"){
			document.getElementById("boton-datos-personales3").disabled=false;
			document.getElementById("boton-datos-personales3").style.background="#2765A0";
	} else {
		document.getElementById("boton-datos-personales3").disabled=true;
		document.getElementById("boton-datos-personales3").style.background="#A8ABAD";
	}
	document.getElementById("err-box-email3").style.display="none";
}

function cambiosCorreo3()
{
	if( document.getElementById("box-email4").value != "<?=$email_usuario?>"){
			document.getElementById("boton-datos-personales4").disabled=false;
			document.getElementById("boton-datos-personales4").style.background="#2765A0";
	} else {
		document.getElementById("boton-datos-personales4").disabled=true;
		document.getElementById("boton-datos-personales4").style.background="#A8ABAD";
	}
	document.getElementById("err-box-email4").style.display="none";
}

$(document).ready(function(){
    $('#emailRecopilacion, #confirma-datos-personales').on('hidden.bs.modal', function () {
        $('#overlay').hide();
    });
});
</script>