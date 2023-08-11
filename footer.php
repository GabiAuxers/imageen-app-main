<!--footer-->
<div class="footer" id="footer-container">

	<div class="d-flex col-12 justify-content-center ri-3x">
		<!-- Enlace a patrocinador Rodilla 
		<? if ($v == "" || $v == 1000) { ?>
				<div class="col"><a href="https://www.rodilla.es" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= getTxt(147, $l) ?>"><img src="imagenes/rodilla.png"></a></div>					
		<? } ?>-->
		<!-- Ver tutoriales y ayuda -- <div class="col"><a class="text-decoration-none text-dark" href="#" onclick="loadGuide();" data-bs-toggle="offcanvas" data-bs-target="#guia-tutorial" aria-controls="guia-tutorial" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= getTxt(148, $l) ?>"><i class="ri-question-line"></i></a></div>-->
		<?php 
		if (!isset($visualizacion_usuario)) {
			$visualizacion_usuario = ""; // or assign a default value
		}
		if ($visualizacion_usuario === 2) : ?>
			<a class="text-decoration-none text-dark" id="enlace-cambiar-visual" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= getTxt(149, $l) ?>"></i></a>
		<?php else : ?>
			<div class="col">
				<a class="text-decoration-none text-dark icono-seleccionado d-flex justify-content-center align-items-center" id="icono-mapa" href="?section=mapa" title="<?= getTxt(149, $l) ?>">
					<?php if($section === "mapa" || $section === null){?>
					<?php ?>
						<img src="assets\img\icons\Mapa_Click.svg" width="40px" height="40px" alt="Mapa Imageen" class="icono-footer">
					<?php } else { ?>
						<img src="assets\img\icons\Mapa.svg" width="40px" height="40px" alt="Mapa Imageen" class="icono-footer">
					<?php };?>
				</a>
			</div>
			<div class="col">
				<a class="text-decoration-none text-dark d-flex justify-content-center align-items-center" id="icono-listado" href="?section=listado&t=3" title="<?= getTxt(150, $l) ?>">
					<?php if($section === "listado"){?>
					<?php ?>
						<img src="assets\img\icons\Listado_Click.svg" width="40px" height="40px" alt="Listado ciudades Imageen" class="icono-footer">
					<?php } else { ?>
						<img src="assets\img\icons\Listado.svg" width="40px" height="40px" alt="Listado ciudades Imageen" class="icono-footer">
					<?php };?>
				</a>
			</div>

			<div class="col">
				<a class="text-decoration-none text-dark d-flex justify-content-center align-items-center" id="icono-favoritos"   title="<?= getTxt(276, $l) ?>" href="?section=favoritos&t=3">
					<?php if($section === "favoritos"){?>
					<?php ?>
						<img src="assets\img\icons\Favoritos_Click.svg" width="40px" height="40px" alt="Favoritos ciudades Imageen" class="icono-footer" >
					<?php } else { ?>
						<img src="assets\img\icons\Favoritos.svg" width="40px" height="40px" alt="Favoritos ciudades Imageen" class="icono-footer">
					<?php };?>
				</a>
			</div>

			<div class="col">
				<a class="text-decoration-none text-dark d-flex justify-content-center align-items-center" id="icono-perfil" href="?section=infoPerfil&t=3" title="<?= getTxt(277, $l) ?>">
					<?php if($section === "infoPerfil"){?>
					<?php ?>
						<img src="assets\img\icons\Perfil_Click.svg" width="40px" height="40px" alt="Perfil usuario Imageen" class="icono-footer">
					<?php } else { ?>
						<img src="assets\img\icons\Perfil.svg" width="40px" height="40px" alt="Perfil usuario Imageen" class="icono-footer">
					<?php };?>
				</a>
			</div>
		<?php endif; ?>
		<!-- <div class="col"><a  class="text-decoration-none text-dark" href="#" data-bs-toggle="offcanvas" data-bs-target="#datos-personales" aria-controls="datos-personales" data-bs-toggle="tooltip" data-toggle="modal" data-target="#modalPremium" data-bs-placement="top" title="<?= getTxt(151, $l) ?>"><i class="ri-account-circle-line"></i><div class="flag-user"><img id="flag" src="<?= give_me_flag($l); ?>" class="align-top"></div></a></div>-->
	</div>
</div>

</script>
<!-- end footer-->
