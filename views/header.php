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
<div class="cabecera">
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
    <div class="col">
        <div class="mx-auto px-3 position-relative">
        <a class="filter-position"><img src="assets/img/icons/icono-filtros.svg" alt="Icono Filtros"></a>
            <div class="input-group input-group-lg">
                <div class="input-group-prepend mt-4">
					<span class="input-group-text bg-transparent border-0 p-0 custom-search-input"><i class="ri-search-line lupa  custom-search-input" display="color:#000000;"></i>
                </span>
                </div>
            </div>
			<input type="text" id="caja-busqueda" class="form-control custom-search-input border-0 p-0 txt-caja-busqueda" placeholder="Encuentra tu aventura" onkeyup="searchtxt(this.value,'<?= $l ?>')">
        </div>
    </div>
    <div class="col">
        <div id="results"></div>
    </div>
    <!--fin Buscador y resultados-->
    <!--Categorías-->
    <div class="d-flex justify-content-center mt-3 ri-2x">
        <div class="col">
            <a class="text-decoration-none text-dark" href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                title="Monumentos">
                <img src="assets\img\icons\video-360.svg" width="38px" height="38px" alt="Vídeo 360" class="icono-footer">
                <p class="textos-cabecera mt-2">VIDEOS 360</p>
            </a>
        </div>
        <div class="col">
            <a class="text-decoration-none text-dark" href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                title="Museos">
                <img src="assets\img\icons\video-plano.svg" width="38px" height="38px" alt="Vídeo Plano" class="icono-footer">
                <p class="textos-cabecera mt-2">VIDEO PLANO</p>
            </a>
        </div>
        <div class="col">
            <a class="text-decoration-none text-dark" href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                title="Historia">
                <img src="assets\img\icons\presente-pasado.svg" width="38px" height="38px" alt="Presente/Pasado" class="icono-footer">
                <p class="textos-cabecera mt-2">PRESENTE - PASADO</p>
            </a>
        </div>
        <div class="col">
            <a class="text-decoration-none text-dark" href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                title="Parques">
                <img src="assets\img\icons\tour-imageen.svg" width="38px" height="38px" alt="Tour Imageen" class="icono-footer">
                <p class="textos-cabecera mt-2">TOUR IMAGEEN</p>
            </a>
        </div>
    </div>
    <!--fin Categorías-->
    <?php endif; ?>
</div>
<!-- fin cabecera-->