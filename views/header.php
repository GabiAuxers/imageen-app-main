<?php
require_once 'firebaseauth.php';
//Controlar las fechas, si se acerca navidad el logo cambia.
$navidad = 0;
$fecha = date('d-m-Y');
$fechaComoEntero = strtotime($fecha);
$dia = date("d", $fechaComoEntero);
$mes = date("m", $fechaComoEntero);
if (($mes == 12 && $dia > 19) || ($mes == 1 && $dia < 7)) {
    $navidad = 1;
}
?>
<!--Cabeceras para toda la aplicación-->
<!--Se incluye condición ya que el buscador y las categorias no aparecen en determinadas secciones como el perfil-->
<div class="cabecera" id="mostrarCab">
	<div class="col text-center py-4">
    <!--Código que para dependiendo de la fecha, personalizar la app con un logo customizado a navidad-->
    <!--TODO: Cargar el logotipo según fecha-->
        <?php if ($navidad === 1) : ?>
            <img src="assets\img\logo\" width="125px">
        <?php else : ?>
            <img src="assets\img\logo\Logotipo.svg" width="125px">
        <?php endif; ?>
    </div>
    <!--Módulo de campo de búsqueda y categorias-->
    <?php if ($section === null || $section === "" || $section === "listado" || $section === "mapa") : ?>
    <!--Buscador y resultados-->
    <div id="searchBar"class="col">
        <div class="mx-auto px-3 position-relative">
            <!--TODO: Se deja invisible el icono de filtros ya que por ahoraa no hay funcionalidad-->
            <a class="filter-position d-none"><img src="assets/img/icons/icono-filtros.svg" alt="Icono Filtros"></a>
            <a class="cerrar-position" id="cerrar" style="display: none; cursor:pointer"> <img src="assets/img/icons/Cerrar.svg" alt="Cerrar Busqueda"></a>
            <button class="lupa-position btn p-0 ms-auto me-3" id="lupaBusqueda" type="button">
                <i class="ri-search-line ri-3x"></i>
            </button>
            <!-- Default dropend button -->
            <div class="btn-group dropend categoria-position" id="btnCategoria">
            <button type="button" class="btn btn-categoria dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="assets/img/icons/categoria.svg" width="30px" height="30px" alt="Categorias">
                <p class="textos-cabecera mt-2">CATEGORIAS</p>
            </button>
            <ul class="dropdown-menu dropdown-menu-categorias">
                <!-- Dropdown menu links -->
                <div class="grid-item grid-categorias">
                    <!-- Botones para compartir en las redes sociales -->
                    <a class="text-decoration-none text-dark" href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="<?= getTxt(271, $l) ?>&nbsp;">
                    <img src="assets\img\icons\video-360.svg" width="38px" height="38px" alt="Vídeo 360" class="icono-footer">
                    <p class="textos-cabecera mt-1"><?= getTxt(271, $l) ?>&nbsp;</p>
                    </a>                
                    <a class="text-decoration-none text-dark" href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="<?=getTxt(272, $l) ?>&nbsp;">
                    <img src="assets\img\icons\video-plano.svg" width="38px" height="38px" alt="Vídeo Plano" class="icono-footer">
                    <p class="textos-cabecera mt-1"><?= getTxt(272, $l) ?>&nbsp;</p>
                    </a>
                    <a class="text-decoration-none text-dark" href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="<?=getTxt(273, $l) ?>&nbsp;">
                        <img src="assets\img\icons\presente-pasado.svg" width="38px" height="38px" alt="Presente/Pasado" class="icono-footer">
                        <p class="textos-cabecera mt-1"><?= getTxt(273, $l) ?>&nbsp;</p>
                    </a>
                    <a class="text-decoration-none text-dark" href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="<?=getTxt(268, $l) ?>&nbsp;">
                        <img src="assets\img\icons\tour-imageen.svg" width="38px" height="38px" alt="Tour Imageen" class="icono-footer">
                        <p class="textos-cabecera mt-1" style="text-transform: uppercase;"><?= getTxt(268, $l) ?>&nbsp;</p>
                    </a>
                </div>
            </ul>
            </div>
            <div class="input-group input-group-lg">
                <div class="input-group-prepend mt-4">
					<span class="input-group-text bg-transparent border-0 p-0 custom-search-input"><i class="ri-search-line lupa custom-search-input" display="color:#000000;"></i></span>
                </div>
            </div>
			<input type="text" id="caja-busqueda" class="form-control custom-search-input border-0 p-0 txt-caja-busqueda" placeholder="<?= getTxt(270, $l) ?>" onkeyup="searchtxt(this.value,'<?= $l ?>')">
        </div>
    </div>
    <div class="col">
        <div id="results"></div>
    </div>
    <!--fin Buscador y resultados-->
    <!--Categorías-->
    <div class="d-flex categorias justify-content-center ri-2x">
        <div class="col" id="theader">
            <a class="text-decoration-none text-dark" href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                title="<?= getTxt(271, $l) ?>&nbsp;">
                <img src="assets\img\icons\video-360.svg" width="38px" height="38px" alt="Vídeo 360" class="icono-footer">
                <p class="textos-cabecera mt-2"><?= getTxt(271, $l) ?>&nbsp;</p>
            </a>
        </div>
        <div class="col" id="theader1">
            <a class="text-decoration-none text-dark" href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                title="<?=getTxt(272, $l) ?>&nbsp;">
                <img src="assets\img\icons\video-plano.svg" width="38px" height="38px" alt="Vídeo Plano" class="icono-footer">
                <p class="textos-cabecera mt-2"><?= getTxt(272, $l) ?>&nbsp;</p>
            </a>
        </div>
        <div class="col" id="theader2">
            <a class="text-decoration-none text-dark" href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                title="<?=getTxt(273, $l) ?>&nbsp;">
                <img src="assets\img\icons\presente-pasado.svg" width="38px" height="38px" alt="Presente/Pasado" class="icono-footer">
                <p class="textos-cabecera mt-2"><?= getTxt(273, $l) ?>&nbsp;</p>
            </a>
        </div>
        <div class="col">
            <a class="text-decoration-none text-dark" id="theader3" href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                title="<?=getTxt(268, $l) ?>&nbsp;">
                <img src="assets\img\icons\tour-imageen.svg" width="38px" height="38px" alt="Tour Imageen" class="icono-footer">
                <p class="textos-cabecera mt-2" style="text-transform: uppercase;"><?= getTxt(268, $l) ?>&nbsp;</p>
            </a>
        </div>
    </div>
    <!--fin Categorías-->
    <?php endif; ?>
</div>
<!-- fin cabecera-->
<script async>
$(document).ready(function() {
    var searchVisible = false; // Inicialmente, la barra de búsqueda está oculta
    //Controlamos el icono de la lupa
    $('#lupaBusqueda').on('click', function() {
        if(searchVisible) {
            // Si la barra de búsqueda ya está visible, la ocultamos
            $('#caja-busqueda').hide();
            $('.filter-position').hide();
            searchVisible = false; // Actualizamos la variable de control
        } else {
            // Si la barra de búsqueda está oculta, la mostramos
            $('#caja-busqueda').show();
            $('.filter-position').show(); 
            searchVisible = true; // Actualizamos la variable de control
        }
    });
});
</script>