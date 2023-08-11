<!--Botones -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="menu-derecho">
    <div class="offcanvas-header p-0">
        <button type="button" class="btn p-0 ri-close-line ri-2x text-black ms-auto" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div
            style="position: absolute; margin-left: -45px; width:95px; height: 95px; border-radius:50%; background: white;">
            <?php if ($navidad === 1) : ?>
            <img style="position: absolute; border-radius: 50%; width:80%; margin-top:10%; margin-left:10%;"
                src="<?= empty($foto_usuario) ? "./imagenes/Avatar barbaN.png" : $foto_usuario ?>">
            <?php else : ?>
            <img style="position: absolute; border-radius: 50%; width:80%; margin-top:10%; margin-left:10%;"
                src="<?= empty($foto_usuario) ? "./imagenes/Avatar barba.png" : $foto_usuario ?>">
            <?php endif; ?>
        </div>
        <!--Usuario real o no logueado-->
        <h5 style="margin-left: 50px; margin-top: 15px;">
            <?php if ($navidad === 1) : ?>
            <?= getTxt(217, $l) ?>
            <?php else : ?>
            <?= getTxt(172, $l) ?>
            <?php endif; ?>
            <br><?= empty($nombre_usuario) ? "Imageener" : $nombre_usuario ?>
            <?php if ($suscripcion_usuario > 1) : ?><i type="button" style="decoration-none; color: #F1A40E;"
                class="ri-shield-star-fill" data-bs-toggle="offcanvas" data-bs-target="#datos-personales"
                aria-controls="datos-personales"></i><?php endif; ?>
            <?php if ($email_usuario != "imageener@imageen.net") : ?><i type="button"
                style="decoration-none; color: #2765A0;" class="ri-pencil-fill" data-bs-toggle="offcanvas"
                data-bs-target="#datos-personales" aria-controls="datos-personales"></i><?php endif; ?>
        </h5>

        <div class="d-flex mb-4 me-2 align-items-center" style="margin-left: 50px;">
            <h6 class="titulo-menu"><br></h6>
            <?php if ($email_usuario != "imageener@imageen.net") : ?>
            <div class="d-flex" type="button"></button>
                <h6 class="titulo-menu" onclick="askClose('<?= $l ?>', '<?= $nombre_usuario ?>')">
                    <?= getTxt(55, $l) ?>&nbsp;<h5 class="ri-logout-box-r-line" style="color: #2765A0"></h5>
                </h6>
            </div>
            <?php else : ?>
            <div class="d-flex" type="button" data-bs-toggle="offcanvas" data-bs-target="#login" aria-controls="login">
                </button>
                <h6 class="titulo-menu"><?= getTxt(1, $l) ?>&nbsp;<h5 class="ri-login-box-line" style="color: #2765A0">
                    </h5>
                </h6>
            </div>
            <?php endif; ?>


        </div>
        <div style="background: #E5E5E5;">
            <div class="form-check form-control-lg form-switch p-3 d-flex">
                <label class="form-check-label" for="modo-listado-checkbox">
                    <h6 class="titulo-menu"><?= getTxt(74, $l) ?></h6>
                </label>
                <input class="form-check-input ms-auto mt-0" type="checkbox" role="switch" id="modo-listado-checkbox"
                    onchange="cambiarSwitch(2, <?= $l ?>);" <?= $visualizacion_usuario == 2 ? 'checked' : '' ?>>
            </div>
            <div class="form-check form-control-lg form-switch p-3 d-flex">
                <label class="form-check-label" for="modo-mapa-checkbox">
                    <h6 class="titulo-menu"><?= getTxt(75, $l) ?></h6>
                </label>
                <input class="form-check-input ms-auto mt-0" type="checkbox" role="switch" id="modo-mapa-checkbox"
                    onchange="cambiarSwitch(1, <?= $l ?>);" <?= $visualizacion_usuario == 1 ? 'checked' : '' ?>>
            </div>
        </div>



        <div class="p-3 pt-4">
            <!--Botón del menú Perfil-->
            <?php if ($email_usuario != "imageener@imageen.net") : ?>
            <a href="#" style="text-decoration: none;">
                <div class="d-flex" type="button" data-bs-toggle="offcanvas" data-bs-target="#datos-personales"
                    aria-controls="datos-personales"></button>
                    <h6 class="titulo-menu"><?= getTxt(59, $l) ?></h6>
                    <i class="ri-arrow-right-s-line ri-2x ms-auto" style="color: #2765A0;"></i>
                </div>
                <hr />
            </a>
            <?php endif; ?>

            <!--Botón del menú Ayudanos a mejorar-->
            <a href="#" style="text-decoration: none;">
                <div class="d-flex" type="button" data-bs-toggle="offcanvas" data-bs-target="#pagina-valoracion"
                    aria-controls="pagina-valoracion"></button>
                    <h6 class="titulo-menu"><?= getTxt(106, $l) ?></h6>
                    <i class="ri-arrow-right-s-line ri-2x ms-auto" style="color: #2765A0;"></i>
                </div>
            </a>

            <hr />
            <!--Botón del menú Instalar app Imageen-->
            <a href="#" style="text-decoration: none;">
                <div class="d-flex" type="button" data-bs-toggle="offcanvas" data-bs-target="#descarga-la-app"
                    aria-controls="descarga-la-app"></button>
                    <h6 class="titulo-menu"><?=getTxt(44,$l)?></h6>
                    <i class="ri-arrow-right-s-line ri-2x ms-auto" style="color: #2765A0;"></i>
                </div>
            </a>
            <hr />
            <!--Botón del menú Selfi-->
            <!--TODO: Prueba para el Botón del menú Selfi
			<a href"#" style="text-decoration: none;">
				<div class="d-flex" type="button" data-bs-toggle="offcanvas" data-bs-target="#descarga-la-app" aria-controls="descarga-la-app"></button>
					<h6 class="titulo-menu"><?=getTxt(221,$l)?></h6>
					<i class="ri-arrow-right-s-line ri-2x ms-auto" style="color: #2765A0;"></i>
				</div>
			</a>
			<hr/>
			-->
            <!--Botón del menú para publicidad Imageen-->
            <a href="#" style="text-decoration: none;">
                <div class="d-flex" type="button" data-bs-toggle="offcanvas" data-bs-target="#publicidades"
                    aria-controls="publicidades"></button>
                    <h6 class="titulo-menu"><?=getTxt(45,$l)?></h6>
                    <i class="ri-arrow-right-s-line ri-2x ms-auto" style="color: #2765A0;"></i>
                </div>
            </a>
            <hr />

            <!--Botón del menú Contacto-->
            <a href="#" display="text-decoration: none;">
                <div class="d-flex" type="button" data-bs-toggle="offcanvas" data-bs-target="#contacta-con-nosotros"
                    aria-controls="contacta-con-nosotros"></button>
                    <h6 class="titulo-menu"><?=getTxt(47,$l)?></h6>
                    <i class="ri-arrow-right-s-line ri-2x ms-auto" style="color: #2765A0;"></i>
                </div>
            </a>
            <hr />
            <!--Botón del menú quieres más-->
            <?php if ($email_usuario == "imageener@imageen.net" || $email_usuario == null) : ?>
            <a href="#" style="text-decoration: none;">
                <div class="d-flex" type="button" data-bs-toggle="offcanvas" onclick="emailPopUp();"></button>
                    <h6 class="titulo-menu"><?= getTxt(152, $l) ?></h6>
                    <i class="ri-arrow-right-s-line ri-2x ms-auto" style="color: #2765A0;"></i>
                </div>
                <hr />
            </a>
            <?php endif; ?>

            <!--Botón del menú FAQ Imageen-->
            <a href="#" style="text-decoration: none;">
                <div class="d-flex" type="button" data-bs-toggle="offcanvas" data-bs-target="#pagina-FAQ"
                    aria-controls="pagina-FAQ"></button>
                    <h6 class="titulo-menu"><?=getTxt(229,$l)?></h6>
                    <i class="ri-arrow-right-s-line ri-2x ms-auto" style="color: #2765A0;"></i>
                </div>
            </a>
            <hr />
            <!--Botón del menú Política de privacidad-->
            <a href="#" display="text-decoration: none;">
                <div class="d-flex" type="button" data-bs-toggle="offcanvas" data-bs-target="#politica-de-privacidad"
                    aria-controls="politica de privacidad"></button>
                    <h6 class="titulo-menu"><?=getTxt(43,$l)?></h6>
                    <i class="ri-arrow-right-s-line ri-2x ms-auto" style="color: #2765A0;"></i>
                </div>
            </a>
        </div>
        <div class="banderas-menu d-flex flex-column">
            <div class="d-flex mt-auto mb-3 justify-content-evenly">
                <a href="#" onclick="changeLng(1, 1)"><img
                        class="<?=(($idioma_usuario==1)?'bandera-seleccionada':'bandera');?>"
                        src="./imagenes/Spain.svg"></a>
                <a href="#" onclick="changeLng(2, 2)"><img
                        class="<?=(($idioma_usuario==2)?'bandera-seleccionada':'bandera');?>"
                        src="./imagenes/EEUU.svg"></a>
                <a href="#" data-bs-dismiss="offcanvas" data-bs-toggle="modal"
                    data-bs-target="#segundo-idioma-frances"><img
                        class="<?=(($idioma_usuario==3)?'bandera-seleccionada':'bandera');?>"
                        src="./imagenes/France.svg"></a>
                <a href="#" data-bs-dismiss="offcanvas" data-bs-toggle="modal"
                    data-bs-target="#segundo-idioma-catalan"><img
                        class="<?=(($idioma_usuario==4)?'bandera-seleccionada':'bandera');?>"
                        src="./imagenes/Catala.svg"></a>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="segundo-idioma-frances">
    <div class="modal-dialog">
        <div class="modal-content text-center">
            <div class="modal-body">
                <h3><?=getTxt(88,3)?></h3>
                <h6><?=getTxt(89,3)?></h6>
            </div>
            <div class="modal-footer d-flex justify-content-around">
                <a href="#" onclick="changeLng(3, 1)"><img class="bandera" src="./imagenes/Spain.svg"></a>
                <a href="#" onclick="changeLng(3, 2)"><img class="bandera" src="./imagenes/EEUU.svg"></a>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="segundo-idioma-catalan">
    <div class="modal-dialog">
        <div class="modal-content text-center">
            <div class="modal-body">
                <h3><?=getTxt(88,4)?></h3>
                <h6><?=getTxt(89,4)?></h6>
            </div>
            <div class="modal-footer d-flex justify-content-around">
                <a href="#" onclick="changeLng(4, 1)"><img class="bandera" src="./imagenes/Spain.svg"></a>
                <a href="#" onclick="changeLng(4, 2)"><img class="bandera" src="./imagenes/EEUU.svg"></a>
            </div>
        </div>
    </div>
</div>


<div class="offcanvas offcanvas-bottom pagina-info" tabindex="-1" id="descarga-la-app"
    aria-labelledby="descarga-la-app-label">
    <div class="offcanvas-header pb-0">
        <button class="aspa-cierre border-0 m-2 rounded-circle px-0" data-bs-dismiss="offcanvas" aria-label="Close"><i
                class="ri-arrow-left-line ri-xl align-middle"></i></button>
    </div>
    <div class="offcanvas-body pt-0 d-flex flex-column align-items-center">
        <h3 id="descarga-la-app-label"><?=getTxt(44,$l)?></h3>
        <img src="./imagenes/Gladiadores.png" class="m-4">
        <p><?=getTxt(118,$l)?></p>
        <p><?=getTxt(119,$l)?>
            <!-- ( <i class="ri-download-cloud-2-line"> </i> )<?//=getTxt(120,$l)?>-->
        </p>
        <!-- TODO: Introducir enlace a la página web de instrucciones o modificar la general de la app-->
        <p><?=getTxt(121,$l)?>
            <!-- <img src="imagenes/icono-compartir.png" style="width:15px;"><?//=getTxt(122,$l)?>>-->
        </p>
        <p><?=getTxt(231,$l)?></p>
        <button type="button" id="formulario-contacto" data-bs-toggle="offcanvas"
            data-bs-target="#contacta-con-nosotros" aria-controls="contacta-con-nosotros"
            class="row btn boton-principal mx-auto fs-6 mt-3" style="background:#2765A0;"><i
                class="ri-mail-star-line align-middle fs-3"></i><?=getTxt(245,$l)?></button>

    </div>
</div>

<div class="offcanvas offcanvas-bottom pagina-info" tabindex="-1" id="publicidades"
    aria-labelledby="publicidades-label">
    <div class="offcanvas-header pb-0">
        <button class="aspa-cierre border-0 m-2 rounded-circle px-0" data-bs-dismiss="offcanvas" aria-label="Close"><i
                class="ri-arrow-left-line ri-xl align-middle"></i></button>
    </div>
    <div class="offcanvas-body pt-0 d-flex flex-column align-items-center">
        <h3 id="publicidades"><?= getTxt(45, $l) ?></h3>
        <?php if ($navidad == 1) : ?>
        <img src="./imagenes/DiosesN.png" class="m-4">
        <?php else : ?>
        <img src="./imagenes/Dioses.png" class="m-4">
        <?php endif; ?>
        <p><?= getTxt(92, $l) ?></p>
        <p><?= getTxt(244, $l) ?></p>
        <button type="button" id="formulario-contacto" data-bs-toggle="offcanvas"
            data-bs-target="#contacta-con-nosotros" aria-controls="contacta-con-nosotros"
            class="row btn boton-principal mx-auto fs-6 mt-3" style="background:#2765A0;"><i
                class="ri-mail-star-line align-middle fs-3"></i><?= getTxt(245, $l) ?></button>
    </div>

</div>

<!--Apartado para mostrar el Soporte y Faq-->
<div class="offcanvas offcanvas-bottom pagina-info" tabindex="-1" id="pagina-FAQ" aria-labelledby="pagina-FAQ-label">
    <div class="offcanvas-header pb-0">
        <button class="aspa-cierre border-0 m-2 rounded-circle px-0" data-bs-dismiss="offcanvas" aria-label="Close"><i
                class="ri-arrow-left-line ri-xl align-middle"></i></button>
    </div>
    <div class="offcanvas-body pt-0 d-flex flex-column align-items-center">
        <h3 id="pagina-FAQ-label"><?= getTxt(228, $l) ?> <?= getTxt(229, $l) ?></h3>
        <?php if ($navidad == 1) : ?>
        <img src="./imagenes/ParejaN.png" class="m-4">
        <?php else : ?>
        <img src="./imagenes/Pareja.png" class="m-4">
        <?php endif; ?>


        <!--TODO: Alimentar Apartado Preguntas soporte-->
        <div class="faq-container">
            <details>
                <summary><?=getTxt(251,$l)?></summary>
                <p><?=getTxt(252,$l)?><br>
                    <?=getTxt(254,$l)?><br>
                    <?=getTxt(255,$l)?><br>
                    <?=getTxt(256,$l)?></p>
            </details>
            <details>
                <summary><?=getTxt(246,$l)?></summary>
                <p><?=getTxt(250,$l)?></p>
                <p>
                    <a href="https://www.imageen.net/faq/Limpieza%20de%20cache%20en%20Android%20v1.1.pdf"
                        target="_blank" title="<?=getTxt(247,$l)?>"><?=getTxt(247,$l)?></a></td><br>
                    <a href="https://www.imageen.net/faq/Limpieza%20de%20cache%20en%20iOS%20v1.1.pdf" target="_blank"
                        title="<?=getTxt(248,$l)?>"><?=getTxt(248,$l)?></a></td><br>
                    <a href="https://www.imageen.net/faq/Limpieza%20de%20cache%20en%20PC%20o%20Mac%20v1.1.pdf"
                        target="_blank" title="<?=getTxt(249,$l)?>"><?=getTxt(249,$l)?></a></td><br>
                </p>
            </details>
        </div>
        <!--Apartado Preguntas soporte-->
        <p><?=getTxt(231,$l)?></p>
        <button type="button" id="formulario-contacto" data-bs-toggle="offcanvas"
            data-bs-target="#contacta-con-nosotros" aria-controls="contacta-con-nosotros"
            class="row btn boton-principal mx-auto fs-6 mt-3" style="background:#2765A0;"><i
                class="ri-mail-star-line align-middle fs-3"></i><?=getTxt(245,$l)?></button>
        <!--Enlace a contacto soporte-->
    </div>
</div>

<div class="offcanvas offcanvas-bottom pagina-info" tabindex="-1" id="pagina-valoracion"
    aria-labelledby="pagina-valoracion-label" style="z-index:3000;">
    <div class="offcanvas-header pb-0">
        <button class="aspa-cierre border-0 m-2 rounded-circle px-0" data-bs-dismiss="offcanvas" aria-label="Close"><i
                class="ri-arrow-left-line ri-xl align-middle"></i></button>
    </div>
    <div class="offcanvas-body pt-0 d-flex flex-column align-items-center">
        <h3 id="pagina-valoracion-label"><?=getTxt(106,$l)?></h3>
        <?php if ($navidad == 1) : ?>
        <img src="./imagenes/ParejaN.png" class="m-4">
        <?php else : ?>
        <img src="./imagenes/Pareja.png" class="m-4">
        <?php endif; ?>

        <h6 class="mt-2"><?=getTxt(107,$l)?>:</h6>
        <form class="mb-3 p-3 d-flex flex-column">
            <div class="row row-cols-1 row-cols-md-2">
                <div class="col mb-3 d-flex">
                    <div class="w-100">
                        <label for="rango-app" class="form-label"><?=getTxt(108,$l)?></label>
                        <input type="range" class="form-range" min="0" max="10" id="rango-app" value=""
                            oninput="cambioSliderApp();">
                    </div>
                    <div id="valor-slider-app" class="align-self-end ms-4 fs-4">5</div>
                </div>
                <div class="col mb-3 d-flex">
                    <div class="w-100">
                        <label for="rango-contenidos" class="form-label"><?=getTxt(109,$l)?></label>
                        <input type="range" class="form-range" min="0" max="10" id="rango-contenidos"
                            oninput="cambioSliderContenidos();">
                    </div>
                    <div id="valor-slider-contenidos" class="align-self-end ms-4 fs-4">5</div>
                </div>
                <div class="col mb-3 d-flex">
                    <div class="w-100">
                        <label for="rango-precio" class="form-label"><?=getTxt(110,$l)?></label>
                        <input type="range" class="form-range" min="0" max="10" id="rango-precio"
                            oninput="cambioSliderPrecio();">
                    </div>
                    <div id="valor-slider-precio" class="align-self-end ms-4 fs-4">5€</div>
                </div>
                <div class="col mb-3 d-flex">
                    <div class="w-100">
                        <label for="texto-verbatim" class="form-label"><?=getTxt(111,$l)?></label>
                        <textarea class="form-control" id="texto-verbatim" rows="4"></textarea>
                    </div>
                </div>
            </div>
            <button type="button" id="boton-pagina-valoracion" onclick="checkFormValoracion()"
                class="row btn boton-principal mx-auto fs-6 mt-3" style="background:#A8ABAD;"><i
                    class="ri-mail-send-fill align-middle fs-3"></i><?=getTxt(112,$l)?></button>
        </form>
    </div>
</div>

<!--Apartado login-->
<div class="offcanvas offcanvas-bottom pagina-info" tabindex="-1" id="login" aria-labelledby="login-label"
    style="z-index:3001;">
    <script>
    try {
        ui.start('#firebaseui-auth-container', uiConfig);
    } catch (error) {
        console.error(error);
    }
    </script>
    <div class="offcanvas-header pb-0">
        <button class="aspa-cierre border-0 m-2 rounded-circle px-0" data-bs-dismiss="offcanvas" aria-label="Close"><i
                class="ri-arrow-left-line ri-xl align-middle"></i></button>
    </div>
    <div class="offcanvas-body pt-0 d-flex flex-column align-items-center">
        <h3 id="login-label"><?= getTxt(1, $l) ?></h3>
        <!--<?php if ($navidad == 1) : ?>
        <img src="./imagenes/ParejaN.png" class="m-4">
        <?php else : ?>
        <img src="./imagenes/Pareja.png" class="m-4">
        <?php endif; ?>-->

        <div class="loginDeck vstack">
            <div id="firebaseui-auth-container"></div>
            <div id="loader">Loading...</div>
            
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-bottom pagina-info" tabindex="-1" id="contacta-con-nosotros"
    aria-labelledby="contacta-con-nosotros-label">
    <div class="offcanvas-header pb-0">
        <button class="aspa-cierre border-0 m-2 rounded-circle px-0" data-bs-dismiss="offcanvas" aria-label="Close"><i
                class="ri-arrow-left-line ri-xl align-middle"></i></button>
    </div>
    <div class="offcanvas-body pt-0 d-flex flex-column align-items-center">
        <h3 id="contacta-con-nosotros-label"><?= getTxt(47, $l) ?></h3>
        <?php if ($navidad == 1) : ?>
        <img src="./imagenes/TransporteN.png" class="m-4">
        <?php else : ?>
        <img src="./imagenes/Transporte.png" class="m-4">
        <?php endif; ?>

        <!-- <p><?=getTxt(94,$l)?></p> -->
        <p><?=getTxt(115,$l)?></p>
        <p><?=getTxt(116,$l)?></p>
        <!-- Formulario de contacto -->
        <form method="post" action="_sendmail.php">
            <label class="input-label form-label" for="nombre"><?=getTxt(233,$l)?></label>
            <input class="input-caja form-control" id="nombre" name="nombre" placeholder="Nombre completo" required>
            <br>
            <label fclass="input-label form-label" or="email"><?=getTxt(234,$l)?></label>
            <input class="input-caja form-control" id="email" name="email" type="email" placeholder="ejemplo@email.com"
                required>
            <br>
            <label class="input-label form-label" for="telefono"><?=getTxt(235,$l)?></label>
            <input class="input-caja form-control" id="telefono" name="telefono" type="telefono"
                placeholder="666111222">
            <br>
            <label class="input-label form-label" for="departamento"><?=getTxt(236,$l)?></label>
            <br>
            <select class="input-label form-label" id="departamento" name="departamento_contactado" required>
                <option value="sugerencias"><?=getTxt(237,$l)?></option>
                <option value="soporte"><?=getTxt(238,$l)?></option>
                <option value="contabilidad"><?=getTxt(239,$l)?></option>
                <option value="correccion"><?=getTxt(240,$l)?></option>
                <option value="patrocinio"><?=getTxt(241,$l)?></option>
            </select>
            <br>
            <br>
            <label class="input-label form-label" for="mensaje"><?=getTxt(242,$l)?></label>
            <br>
            <textarea class="input-caja form-control" id="mensaje" name="mensaje" rows="3" required></textarea>
            <input id="submit" name="submit" type="submit" class="row btn boton-principal mx-auto fs-6 mt-3"
                style="background:#2765A0;" value="<?=getTxt(243,$l)?>">
        </form>
        <br>
        <p><?=getTxt(232,$l)?> <?=getTxt(117,$l)?></p>
    </div>
</div>

<!--Apartado para mostrar el tema de la privacidad-->
<div class="offcanvas offcanvas-bottom pagina-info" tabindex="-1" id="politica-de-privacidad"
    aria-labelledby="politica-de-privacidad-label">
    <div class="offcanvas-header pb-0">
        <button class="aspa-cierre border-0 m-2 rounded-circle px-0" data-bs-dismiss="offcanvas" aria-label="Close"><i
                class="ri-arrow-left-line ri-xl align-middle"></i></button>
    </div>
    <div class="offcanvas-body pt-0 d-flex flex-column align-items-center">
        <h3 id="politica-de-privacidad-label"><?=getTxt(43,$l)?></h3>
        <img src="./imagenes/Pergamino.png" class="m-4">
        <p><?=getTxt(182,$l)?> <?=getTxt(183,$l)?> <?=getTxt(184,$l)?></p>
        <p><?=getTxt(185,$l)?><br>
            <?=getTxt(186,$l)?><br>
            <?=getTxt(187,$l)?><br>
            <?=getTxt(188,$l)?></p>
        <p><?=getTxt(189,$l)?> <?=getTxt(190,$l)?> <?=getTxt(210,$l)?></p>
        <p><?=getTxt(191,$l)?> <?=getTxt(192,$l)?> <?=getTxt(193,$l)?></p>
        <p><?=getTxt(194,$l)?></p>
        <p><?=getTxt(195,$l)?></p>
        <p><?=getTxt(196,$l)?> <?=getTxt(197,$l)?> <?=getTxt(198,$l)?> <?=getTxt(199,$l)?> <?=getTxt(200,$l)?></p>
        <p><?=getTxt(201,$l)?></p>
        <p><?=getTxt(202,$l)?></p>
        <p><?=getTxt(203,$l)?> <?=getTxt(204,$l)?></p>
        <p><?=getTxt(205,$l)?> <?=getTxt(206,$l)?> <?=getTxt(207,$l)?> </p>
        <p><?=getTxt(208,$l)?> <?=getTxt(209,$l)?><br></p>
    </div>
</div>


<div class="offcanvas offcanvas-bottom pagina-info" tabindex="-1" id="datos-personales"
    aria-labelledby="datos-personales-label" style="z-index:3000;">
    <div class="offcanvas-header pb-0">
        <button class="aspa-cierre border-0 m-2 rounded-circle px-0" data-bs-dismiss="offcanvas" aria-label="Close"><i
                class="ri-arrow-left-line ri-xl align-middle"></i></button>
    </div>
    <div class="offcanvas-body pt-0 d-flex flex-column align-items-center">
        <h3 id="datos-personales-label"><?= empty($nombre_usuario) ? "Imageener" : $nombre_usuario ?></h3>
        <?php if ($navidad == 1) : ?>
        <img style="border-radius: 50%; width:7em;"
            src="<?= empty($foto_usuario) ? "./imagenes/Avatar barbaN.png" : $foto_usuario ?>">
        <?php else : ?>
        <img style="border-radius: 50%; width:7em;"
            src="<?= empty($foto_usuario) ? "./imagenes/Avatar barba.png" : $foto_usuario ?>">
        <?php endif; ?>

        <?php if (!$capado_apple) : ?>
        <div class="mb-3 mt-3 text-center">
            <?php if ($suscripcion_usuario == 3) : ?>
            <?php if ($email_usuario != NULL) : ?>
            <a href="#" class="text-decoration-none" onclick="openMembership();">
                <p class="input-label mb-2"><?= getTxt(32, $l) ?>: <?= dame_tipo_acceso($suscripcion_usuario) ?></p>
            </a>
            <a href="#" class="input-label text-decoration-none"
                onclick="openMembership();"><?= getTxt(128, $l) ?><?= $fin_suscripcion_usuario ?></a>
            <?php else : ?>
            <a href="#" class="text-decoration-none" onclick="openMembership3();">
                <p class="input-label mb-2"><?= getTxt(32, $l) ?>: <?= dame_tipo_acceso($suscripcion_usuario) ?></p>
            </a>
            <a href="#" class="input-label text-decoration-none"
                onclick="openMembership3();"><?= getTxt(128, $l) ?><?= $fin_suscripcion_usuario ?></a>
            <?php endif; ?>
            <?php else : ?>
            <?php if ($email_usuario != NULL) : ?>
            <a href="#" class="text-decoration-none" onclick="openMembership7();">
                <p class="input-label mb-2"><?= getTxt(32, $l) ?>: <?= dame_tipo_acceso($suscripcion_usuario) ?></p>
            </a>
            <a href="#" class="input-label" onclick="openMembership7();"><?= getTxt(129, $l) ?></a>
            <?php else : ?>
            <a href="#" class="text-decoration-none" onclick="openMembership7();">
                <p class="input-label mb-2"><?= getTxt(32, $l) ?>: <?= dame_tipo_acceso($suscripcion_usuario) ?></p>
            </a>
            <a href="#" class="input-label" onclick="openMembership7();"><?= getTxt(129, $l) ?></a>
            <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php else : ?>
        <div class="mb-3 mt-3 text-center">
            <a href="#" class="text-decoration-none">
                <p class="input-label mb-2"><?= getTxt(32, $l) ?>: <?= dame_tipo_acceso($suscripcion_usuario) ?> <i
                        class="ri-shield-star-fill"></i></p>
            </a>
            <?php if ($suscripcion_usuario != 1) : ?>
            <a href="#"
                class="input-label text-decoration-none"><?= getTxt(128, $l) ?><?= $fin_suscripcion_usuario ?></a>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <form class="mb-3 p-3 d-flex flex-column">
            <div class="row row-cols-1 row-cols-md-2">
                <div class="col mb-3">
                    <label for="box-nombre" class="input-label form-label"><?=getTxt(29,$l)?></label>
                    <input type="text" class="input-caja form-control" id="box-nombre" value="<?=$nombre_usuario?>"
                        oninput="cambiosDatos()">
                    <span id="err-box-nombre" class="mt-1" style="display:none; color:red;"><?=getTxt(13,$l)?></span>
                </div>
                <div class="col mb-3">
                    <label for="box-apellidos" class="input-label form-label"><?=getTxt(36,$l)?></label>
                    <input type="text" class="input-caja form-control" id="box-apellidos"
                        value="<?=$apellidos_usuario?>" oninput="cambiosDatos()">
                    <span id="err-box-apellidos" class="mt-1" style="display:none; color:red;"><?=getTxt(13,$l)?></span>
                </div>
                <div class="col mb-3">
                    <label for="box-email" class="input-label form-label"><?=getTxt(37,$l)?></label>
                    <input type="email" class="input-caja form-control" id="box-email" value="<?=$email_usuario?>"
                        oninput="cambiosDatos()">
                    <span id="err-box-email" class="mt-1" style="display:none; color:red;"><?=getTxt(265,$l)?></span>
                </div>
                <div class="col mb-3">
                    <label for="box-telefono" class="input-label form-label"><?=getTxt(4,$l)?></label>
                    <input type="tel" class="input-caja form-control" id="box-telefono" value="<?=$telefono_usuario?>"
                        oninput="cambiosDatos()">
                    <span id="err-box-telefono" class="mt-1" style="display:none; color:red;"><?=getTxt(13,$l)?></span>
                </div>
                <div class="col mb-3 form-check ms-2">
                    <input class="form-check-input" type="checkbox" <?=$check_usuario?'checked':'unchecked'?>
                        id="check-permisos" oninput="cambiosDatos()">
                    <label class="form-check-label input-label" for="check-permisos">
                        <?=getTxt(139,$l)?>
                    </label>
                </div>
            </div>
            <button type="button" id="boton-datos-personales" onclick="checkForm()"
                class="row btn boton-principal mx-auto fs-6 mt-3" style="background:#A8ABAD;"><i
                    class="ri-save-2-fill align-middle fs-3"></i><?=getTxt(35,$l)?></button>
        </form>
        <h6 class="titulo-menu" data-bs-dismiss="offcanvas" onclick="askClose('<?=$l?>','<?=$nombre_usuario?>')">
            <?=getTxt(55,$l)?>&nbsp;<h5 style="color: #2765A0"></h5>
        </h6>
        <h6 class="titulo-menu" data-bs-dismiss="offcanvas" onclick="askCloseUser('<?=$l?>','<?=$nombre_usuario?>')">
            <?=getTxt(267,$l)?>&nbsp;<h5 style="color: #2765A0"></h5>
        </h6>
    </div>
</div>

<div class="offcanvas offcanvas-bottom pagina-info" tabindex="-1" id="datos-personales2"
    aria-labelledby="datos-personales2-label" style="z-index:3000;">
    <div class="offcanvas-header pb-0">
        <button class="aspa-cierre border-0 m-2 rounded-circle px-0" data-bs-dismiss="offcanvas" aria-label="Close"><i
                class="ri-arrow-left-line ri-xl align-middle"></i></button>
    </div>
    <div class="offcanvas-body pt-0 d-flex flex-column align-items-center">
        <h3 id="datos-personales2-label"><?=getTxt(151,$l)?></h3>
        <img src="./imagenes/Pergamino.png" class="m-4">
        <form class="mb-3 p-3 d-flex flex-column">
            <p>
            <h5 id="datos-personales2-label"><?=getTxt(169,$l)?></h5>
            </p>
            <div class="row row-cols-1 row-cols-md-2">
                <div class="col mb-3">
                    <label for="box-email2" class="input-label form-label"><?=getTxt(37,$l)?></label>
                    <input type="email" class="input-caja form-control" id="box-email2" value="<?=$email_usuario?>"
                        oninput="cambiosCorreo()">
                    <span id="err-box-email2" class="mt-1" style="display:none; color:red;"><?=getTxt(265,$l)?></span>
                </div>
            </div>
            <button type="button" id="boton-datos-personales2" onclick="checkForm2()"
                class="row btn boton-principal mx-auto fs-6 mt-3" style="background:#A8ABAD;"><i
                    class="ri-save-2-fill align-middle fs-3"></i><?=getTxt(35,$l)?></button>
            <p>
            <h6 id="datos-personales2-label"><?=getTxt(170,$l)?> "<?=getTxt(139,$l)?>" <?=getTxt(171,$l)?></h6>
            </p>
        </form>
    </div>
</div>

<div id="emailRecopilacion" class="modal fade addpoints">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row mt-20px">
                    <div class="text-center">
                        <p>
                        <h4><?=getTxt(259,$l)?></h4>
                        </p>
                        <h6><?=getTxt(260,$l)?></h6>
                        <h6><?=getTxt(261,$l)?></h6>
                        <label for="box-email4" class="input-label form-label"></label>
                        <input type="email" class="input-caja form-control" id="box-email4" value="<?=getTxt(266,$l)?>"
                            oninput="cambiosCorreo3()">
                        <span id="err-box-email4" class="mt-1"
                            style="display:none; color:red;"><?=getTxt(265,$l)?></span>
                        <button type="button" id="boton-datos-personales4" onclick="checkForm5()"
                            class="row btn boton-principal mx-auto fs-6 mt-3" style="background:#2765A0;"><i
                                class="ri-save-2-fill align-middle fs-3"></i><?=getTxt(264,$l)?></button>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">
            </div>
            <div class="text-center">
                <h6><?=getTxt(262,$l)?></h6>
                <a data-bs-dismiss="modal" style=color:#2765A0;><?=getTxt(263,$l)?></a>
            </div>
        </div>
    </div>
</div>


<div class="offcanvas offcanvas-bottom pagina-info" tabindex="-1" id="datos-personales3"
    aria-labelledby="datos-personales3-label" style="z-index:3000;">
    <div class="offcanvas-header pb-0">
        <button class="aspa-cierre border-0 m-2 rounded-circle px-0" data-bs-dismiss="offcanvas" aria-label="Close"><i
                class="ri-arrow-left-line ri-xl align-middle"></i></button>
    </div>
    <div class="offcanvas-body pt-0 d-flex flex-column align-items-center">
        <h3 id="datos-personales3-label"><?=getTxt(151,$l)?></h3>
        <img src="./imagenes/Pergamino.png" class="m-4">
        <form class="mb-3 p-3 d-flex flex-column">
            <p>
            <h5 id="datos-personales3-label"><?=getTxt(169,$l)?></h5>
            </p>
            <div class="row row-cols-1 row-cols-md-2">
                <div class="col mb-3">
                    <label for="box-email3" class="input-label form-label"><?=getTxt(37,$l)?></label>
                    <input type="email" class="input-caja form-control" id="box-email3" value="<?=$email_usuario?>"
                        oninput="cambiosCorreo2()">
                    <span id="err-box-email3" class="mt-1" style="display:none; color:red;"><?=getTxt(265,$l)?></span>
                </div>
            </div>
            <button type="button" id="boton-datos-personales3" onclick="checkForm4()"
                class="row btn boton-principal mx-auto fs-6 mt-3" style="background:#A8ABAD;"><i
                    class="ri-save-2-fill align-middle fs-3"></i><?=getTxt(35,$l)?></button>
            <p>
            <h6 id="datos-personales3-label"><?=getTxt(170,$l)?> "<?=getTxt(139,$l)?>" <?=getTxt(171,$l)?></h6>
            </p>
        </form>
    </div>
</div>


<div class="offcanvas offcanvas-bottom pagina-info" tabindex="-1" id="miembro-club" aria-labelledby="miembro-club-label"
    style="z-index:3000;">
    <div class="offcanvas-header pb-0">
        <button class="aspa-cierre border-0 m-2 rounded-circle px-0" data-bs-dismiss="offcanvas" aria-label="Close"><i
                class="ri-arrow-left-line ri-xl align-middle"></i></button>
    </div>
    <div class="offcanvas-body pt-0 d-flex flex-column align-items-center">
        <h3 id="miembro-club-label"><?=getTxt(177,$l)?></h3>
        <img src="./imagenes/Pergamino.png" class="m-4">

        <p>
        <h5 id="miembro-club-label"><?=getTxt(178,$l)?></h5>
        </p>
        <div class="row row-cols-1 row-cols-md-2">
            <label for="box-club" class="input-label form-label"><?=getTxt(179,$l)?></label>
            <input type="text" class="input-caja form-control" id="box-club" oninput="cambiosDatos()">
            <span id="err-box-club" class="mt-1" style="display:none; color:red;"><?=getTxt(174,$l)?></span>
        </div>
        <button type="button" id="boton-miembro-club" onclick="checkForm3()"
            class="row btn boton-principal mx-auto fs-6 mt-3" style="background:#2765A0;"><i
                class="ri-vip-crown-fill align-middle fs-3"></i><?=getTxt(181,$l)?></button>
        <p>
        <h5 id="miembro-club-label"><?=getTxt(226,$l)?></h5>
        </p>
        <button type="button" id="boton-miembro-club2" onclick="openMembership7();"
            class="row btn boton-principal mx-auto fs-6 mt-3" style="background:#FFAE00;"><i
                class="ri-vip-fill align-middle fs-3"></i><?=getTxt(129,$l)?></button>
        <p>
        <h6 id="miembro-club-label"><?=getTxt(180,$l)?></h6>
        </p>
    </div>
</div>

<div class="offcanvas offcanvas-bottom pagina-info" tabindex="-1" id="oferta-cupon" aria-labelledby="oferta-cupon-label"
    style="z-index:3000;">
    <div class="offcanvas-header pb-0">
        <button class="aspa-cierre border-0 m-2 rounded-circle px-0" data-bs-dismiss="offcanvas" aria-label="Close"><i
                class="ri-arrow-left-line ri-xl align-middle"></i></button>
    </div>
    <div class="offcanvas-body pt-0 d-flex flex-column align-items-center">
        <h3 id="oferta-cupon-label"><?=getTxt(211,$l)?></h3>
        <img src="./imagenes/codigodescuento.png" class="m-4">
        <p>
        <h5 id="oferta-cupon-label"><?=getTxt(219,$l)?></h5>
        </p>
        <?php if ($email_usuario != NULL) : ?>
        <button type="button" id="boton-oferta-cupon" onclick="openMembership8();"
            class="row btn boton-principal mx-auto fs-6 mt-3" style="background:#2765A0;"><i
                class="ri-gift-fill align-middle fs-3"></i><?= getTxt(215, $l) ?></button>
        <?php else : ?>
        <button type="button" id="boton-oferta-cupon" onclick="openMembership9();"
            class="row btn boton-principal mx-auto fs-6 mt-3" style="background:#2765A0;"><i
                class="ri-gift-fill align-middle fs-3"></i><?= getTxt(215, $l) ?></button>
        <?php endif; ?>

        <button type="button" id="boton-oferta-cupon2" data-bs-dismiss="offcanvas"
            class="row btn boton-principal mx-auto fs-6 mt-3" style="background:#A8ABAD;"><i
                class="ri-door-open-fill align-middle fs-3"></i><?=getTxt(216,$l)?></button><br>
        <br>
        <p><label for="box-cuponb" class="input-label form-label align-items-center"><?=getTxt(220,$l)?>
                <?=getTxt(214,$l)?></label></p>
    </div>
</div>

<!--TODO: Posible muestra del descuento pero sin estar logueado-->
<div class="offcanvas offcanvas-bottom pagina-info" tabindex="-1" id="oferta-cuponb"
    aria-labelledby="oferta-cuponb-label" style="z-index:3000;">
    <div class="offcanvas-header pb-0">
        <button class="aspa-cierre border-0 m-2 rounded-circle px-0" data-bs-dismiss="offcanvas" aria-label="Close"><i
                class="ri-arrow-left-line ri-xl align-middle"></i></button>
    </div>
    <div class="offcanvas-body pt-0 d-flex flex-column align-items-center">
        <h3 id="oferta-cuponb-label"><?=getTxt(211,$l)?></h3>
        <img src="./imagenes/codigodescuento.png" class="m-4">
        <p>
        <h5 id="oferta-cuponb-label"><?=getTxt(219,$l)?></h5>
        </p>
        <?php if($email_usuario!=NULL) : ?>
        <button type="button" id="boton-oferta-cuponb" onclick="openLogin();"
            class="row btn boton-principal mx-auto fs-6 mt-3" style="background:#2765A0;"><i
                class="ri-gift-fill align-middle fs-3"></i><?=getTxt(215,$l)?></button>
        <?php else : ?>
        <button type="button" id="boton-oferta-cuponb" onclick="openLogin();"
            class="row btn boton-principal mx-auto fs-6 mt-3" style="background:#2765A0;"><i
                class="ri-gift-fill align-middle fs-3"></i><?=getTxt(215,$l)?></button>
        <?php endif; ?>
        <button type="button" id="boton-oferta-cuponb2" data-bs-dismiss="offcanvas"
            class="row btn boton-principal mx-auto fs-6 mt-3" style="background:#A8ABAD;"><i
                class="ri-door-open-fill align-middle fs-3"></i><?=getTxt(216,$l)?></button><br>
        <br>
        <p><label for="box-cuponb" class="input-label form-label align-items-center"><?=getTxt(220,$l)?>
                <?=getTxt(214,$l)?></label></p>
    </div>
</div>

<!--Ventana al acceder directamente a contenido premium-->
<div class="offcanvas offcanvas-bottom pagina-info" tabindex="-1" id="acceso-no-autorizado"
    aria-labelledby="acceso-no-autorizado-label" style="z-index:2999;">
    <div class="offcanvas-header pb-0">
        <button class="aspa-cierre border-0 m-2 rounded-circle px-0" data-bs-dismiss="offcanvas" aria-label="Close"><i
                class="ri-arrow-left-line ri-xl align-middle"></i></button>
    </div>
    <div class="offcanvas-body pt-0 d-flex flex-column align-items-center">
        <h3 id="acceso-no-autorizado-label"><?=getTxt(222,$l)?></h3>
        <img src="./imagenes/Pergamino.png" class="m-4">
        <p>
        <h5 id="acceso-no-autorizado-label"><?=getTxt(223,$l)?></h5>
        </p>
        <?php if($email_usuario!=NULL && $email_usuario!="imageener@imageen.net") : ?>
        <button type="button" id="boton-acceso-no-autorizado" onclick="openMembership7();"
            class="row btn boton-principal mx-auto fs-6 mt-3" style="background:#2765A0;"><i
                class="ri-vip-fill align-middle fs-3"></i><?=getTxt(129,$l)?></button>
        <?php else : ?>
        <button type="button" id="boton-acceso-no-autorizado" onclick="openLogin();"
            class="row btn boton-principal mx-auto fs-6 mt-3" style="background:#2765A0;"><i
                class="ri-vip-fill align-middle fs-3"></i><?=getTxt(225,$l)?></button>
        <?php endif; ?>
        <button type="button" id="boton-acceso-no-autorizado" class="row btn boton-principal mx-auto fs-6 mt-3"
            style="background:#A8ABAD;" data-bs-dismiss="offcanvas"><i
                class="ri-door-open-fill align-middle fs-3"></i><?=getTxt(224,$l)?></button>
    </div>
</div>

<div class="offcanvas offcanvas-bottom pagina-info" tabindex="-1" id="acceso-no-autorizado-club"
    aria-labelledby="acceso-no-autorizado-club-label" style="z-index:2999;">
    <div class="offcanvas-header pb-0">
        <button class="aspa-cierre border-0 m-2 rounded-circle px-0" data-bs-dismiss="offcanvas" aria-label="Close"><i
                class="ri-arrow-left-line ri-xl align-middle"></i></button>
    </div>
    <div class="offcanvas-body pt-0 d-flex flex-column align-items-center">
        <h3 id="acceso-no-autorizado-club-label"><?=getTxt(222,$l)?></h3>
        <img src="./imagenes/Pergamino.png" class="m-4">
        <p>
        <h5 id="acceso-no-autorizado-club-label"><?=getTxt(223,$l)?></h5>
        </p>
        <?php if($email_usuario!=NULL && $email_usuario!="imageener@imageen.net") : ?>
        <button type="button" id="boton-acceso-no-autorizado-club" onclick="openMembership7();"
            class="row btn boton-principal mx-auto fs-6 mt-3" style="background:#2765A0;"><i
                class="ri-vip-fill align-middle fs-3"></i><?=getTxt(129,$l)?></button>
        <?php else : ?>
        <button type="button" id="boton-acceso-no-autorizado-club" onclick="openLogin2();"
            class="row btn boton-principal mx-auto fs-6 mt-3" style="background:#2765A0;"><i
                class="ri-vip-fill align-middle fs-3"></i><?=getTxt(225,$l)?></button>
        <?php endif; ?>
        <button type="button" id="boton-acceso-no-autorizado-club" class="row btn boton-principal mx-auto fs-6 mt-3"
            style="background:#A8ABAD;" data-bs-dismiss="offcanvas"><i
                class="ri-door-open-fill align-middle fs-3"></i><?=getTxt(224,$l)?></button>
    </div>
</div>

<div class="offcanvas offcanvas-bottom pagina-info" tabindex="-1" id="miembro-club-check"
    aria-labelledby="miembro-club-check-label" style="z-index:3000;">
    <div class="offcanvas-header pb-0">
        <button class="aspa-cierre border-0 m-2 rounded-circle px-0" data-bs-dismiss="offcanvas" aria-label="Close"><i
                class="ri-arrow-left-line ri-xl align-middle"></i></button>
    </div>
    <div class="offcanvas-body pt-0 d-flex flex-column align-items-center">
        <h3 id="miembro-club-check-label"><?=getTxt(132,$l)?></h3>
        <img src="./imagenes/Pergamino.png" class="m-4">
        <form class="mb-3 p-3 d-flex flex-column">
            <p>
            <h5 id="miembro-club-check-label"><?=getTxt(175,$l)?></h5>
            </p>
            <div class="row row-cols-1 row-cols-md-2">
            </div>
            <a id="boton-miembro-club" type="button" class="row btn boton-principal mx-auto fs-6 mt-3"
                href="./contents.php"><?=getTxt(134,$l)?></a>
        </form>
    </div>
</div>

<div class="offcanvas offcanvas-bottom pagina-info" tabindex="-1" id="incorrectSend"
    aria-labelledby="incorrectSend-label" style="z-index:3000;">
    <div class="offcanvas-header pb-0">
        <button class="aspa-cierre border-0 m-2 rounded-circle px-0" data-bs-dismiss="offcanvas" aria-label="Close"><i
                class="ri-arrow-left-line ri-xl align-middle"></i></button>
    </div>
    <div class="offcanvas-body pt-0 d-flex flex-column align-items-center">
        <h3 id="incorrectSend-label"><?=getTxt(132,$l)?></h3>
        <img src="./imagenes/ParejaN.png" class="m-4">
        <form class="mb-3 p-3 d-flex flex-column">
            <p>
            <h5 id="incorrectSend-label"><?=getTxt(257,$l)?></h5>
            </p>
            <div class="row row-cols-1 row-cols-md-2">
            </div>
            <a id="boton-incorrectSend" type="button" class="row btn boton-principal mx-auto fs-6 mt-3"
                data-bs-dismiss="offcanvas" aria-label="Close"><?=getTxt(134,$l)?></a>
        </form>
    </div>
</div>

<div class="offcanvas offcanvas-bottom pagina-info" tabindex="-1" id="correctSend" aria-labelledby="correctSend-label"
    style="z-index:3000;">
    <div class="offcanvas-header pb-0">
        <button class="aspa-cierre border-0 m-2 rounded-circle px-0" data-bs-dismiss="offcanvas" aria-label="Close"><i
                class="ri-arrow-left-line ri-xl align-middle"></i></button>
    </div>
    <div class="offcanvas-body pt-0 d-flex flex-column align-items-center">
        <h3 id="correctSend-label"><?=getTxt(132,$l)?></h3>
        <img src="./imagenes/ParejaN.png" class="m-4">
        <form class="mb-3 p-3 d-flex flex-column">
            <p>
            <h5 id="correctSend-label"><?=getTxt(258,$l)?></h5>
            </p>
            <div class="row row-cols-1 row-cols-md-2">
            </div>
            <a id="boton-correctSend" type="button" class="row btn boton-principal mx-auto fs-6 mt-3"
                href="./contents.php"><?=getTxt(134,$l)?></a>
        </form>
    </div>
</div>

<script>
function cambioSliderApp() {
    document.getElementById("valor-slider-app").innerHTML = document.getElementById("rango-app").value;
    document.getElementById("boton-pagina-valoracion").disabled = false;
    document.getElementById("boton-pagina-valoracion").style.background = "#2765A0";
}

function cambioSliderContenidos() {
    document.getElementById("valor-slider-contenidos").innerHTML = document.getElementById("rango-contenidos").value;
    document.getElementById("boton-pagina-valoracion").disabled = false;
    document.getElementById("boton-pagina-valoracion").style.background = "#2765A0";
}

function cambioSliderPrecio() {
    document.getElementById("valor-slider-precio").innerHTML = document.getElementById("rango-precio").value + "€";
    document.getElementById("boton-pagina-valoracion").disabled = false;
    document.getElementById("boton-pagina-valoracion").style.background = "#2765A0";
}

function cambiosDatos() {
    if (document.getElementById("box-nombre").value != "<?=$nombre_usuario?>" ||
        document.getElementById("box-apellidos").value != "<?=$apellidos_usuario?>" ||
        document.getElementById("box-email").value != "<?=$email_usuario?>" ||
        document.getElementById("box-telefono").value != "<?=$telefono_usuario?>" ||
        document.getElementById("check-permisos").checked != Boolean(<?=$check_usuario?>)) {
        document.getElementById("boton-datos-personales").disabled = false;
        document.getElementById("boton-datos-personales").style.background = "#2765A0";
    } else {
        document.getElementById("boton-datos-personales").disabled = true;
        document.getElementById("boton-datos-personales").style.background = "#A8ABAD";
    }
    document.getElementById("err-box-nombre").style.display = "none";
    document.getElementById("err-box-apellidos").style.display = "none";
    document.getElementById("err-box-email").style.display = "none";
    document.getElementById("err-box-telefono").style.display = "none";
}

function cambiosCorreo() {
    if (document.getElementById("box-email2").value != "<?=$email_usuario?>") {
        document.getElementById("boton-datos-personales2").disabled = false;
        document.getElementById("boton-datos-personales2").style.background = "#2765A0";
    } else {
        document.getElementById("boton-datos-personales2").disabled = true;
        document.getElementById("boton-datos-personales2").style.background = "#A8ABAD";
    }
    document.getElementById("err-box-email2").style.display = "none";
}

function cambiosCorreo2() {
    if (document.getElementById("box-email3").value != "<?=$email_usuario?>") {
        document.getElementById("boton-datos-personales3").disabled = false;
        document.getElementById("boton-datos-personales3").style.background = "#2765A0";
    } else {
        document.getElementById("boton-datos-personales3").disabled = true;
        document.getElementById("boton-datos-personales3").style.background = "#A8ABAD";
    }
    document.getElementById("err-box-email3").style.display = "none";
}

function cambiosCorreo3() {
    if (document.getElementById("box-email4").value != "<?=$email_usuario?>") {
        document.getElementById("boton-datos-personales4").disabled = false;
        document.getElementById("boton-datos-personales4").style.background = "#2765A0";
    } else {
        document.getElementById("boton-datos-personales4").disabled = true;
        document.getElementById("boton-datos-personales4").style.background = "#A8ABAD";
    }
    document.getElementById("err-box-email4").style.display = "none";
}

function cambiosSuscripcion() {
    if (document.getElementById("box-club").value != "<?=$email_usuario?>") {
        document.getElementById("boton-miembro-club").disabled = false;
        document.getElementById("boton-miembro-club").style.background = "#2765A0";
    } else {
        document.getElementById("boton-miembro-club").disabled = true;
        document.getElementById("boton-miembro-club").style.background = "#A8ABAD";
        document.getElementById("boton-miembro-club2").style.background = "#2765A0";
    }
    document.getElementById("err-box-club").style.display = "none";
}
</script>



<div class="modal" tabindex="-1" id="confirma-pagina-valoracion">
    <div class="modal-dialog">
        <div class="modal-content text-center">
            <div class="modal-body">
                <h3><?=getTxt(113,$l)?></h3>
                <h6><?=getTxt(114,$l)?></h6>
            </div>
            <div class="modal-footer text-center mx-auto">
                <button type="button" class="btn boton-principal" data-bs-dismiss="modal"><?=getTxt(104,$l)?></button>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="pide-datos-personales">
    <div class="modal-dialog">
        <div class="modal-content text-center">
            <div class="modal-body">
                <h3><?=getTxt(137,$l)?></h3>
                <h6><?=getTxt(138,$l)?></h6>
            </div>
            <div class="modal-footer text-center mx-auto">
                <button type="button" class="btn boton-principal" data-bs-dismiss="modal"
                    onclick="abreDatosPersonales();"><?=getTxt(104,$l)?></button>
            </div>
        </div>
    </div>
</div>

<!-- Old search bar 
<div class="offcanvas offcanvas-top" style="height: min-content; border-bottom-left-radius: 5rem 1rem; border-bottom-right-radius: 17rem 7rem;" tabindex="-1" id="pagina-buscador" aria-labelledby="pagina-buscador-label">
	<div class="offcanvas-header pb-0">
		<div class="input-group input-group-lg">
			<input type="text" id="caja-busqueda" class="form-control border-0 border-bottom p-0" placeholder="<?=getTxt(64,$l)?>" onkeyup="searchtxt(this.value,'<?=$l?>')">
			<i class="border-bottom ri-search-line ri-2x text-black text-opacity-75 p-0 me-3" display="color:#646363;"></i>
		</div>
		<button type="button" class="btn p-0 ri-close-line ri-2x text-black"  display="color:#646363;" data-bs-dismiss="offcanvas"></button>
	</div>
	<div class="offcanvas-body d-flex flex-column align-items-start">
		<div id="results">
			<h6 class="text-muted"><?=getTxt(100,$l)?></h6>
		</div>		    		
	</div>
</div>
-->

<div class="offcanvas offcanvas-bottom h-100" tabindex="-1" id="guia-tutorial">
    <div class="offcanvas-header pb-0">
        <button type="button" class="btn p-0 ri-close-line ri-2x text-black" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <div id="guia-tutorial-frame" class="offcanvas-body pt-0 d-flex flex-column align-items-center">

    </div>
</div>