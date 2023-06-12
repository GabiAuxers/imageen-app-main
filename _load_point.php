
<!--este archivo se encarga de renderizar la información en la ventana modal que se muestra cuando se hace clic en un marcador en el mapa.-->
<?php include 'conexion.php';
include 'literal.php';
include 'functions.php';
include 'auth.php';

if ($_SERVER['SERVER_NAME'] == "localhost") $ruta_admin = "../admin";
else $ruta_admin = "https://admin.imageen.net";

	$p          = isset($_POST["codigo"]) ? $_POST["codigo"] : '';
	$imagen      = isset($_POST["imagen"]) ? $_POST["imagen"] : '';
	$nombre      = isset($_POST["nombre"]) ? $_POST["nombre"] : '';
	$distancia   = isset($_POST["distancia"]) ? $_POST["distancia"] : '';
	$materiales  = isset($_POST["materiales"]) ? $_POST["materiales"] : '';
	$descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : '';
	$icono       = isset($_POST["icono"]) ? $_POST["icono"] : '';
	$cliente     = isset($_POST["cliente"]) ? $_POST["cliente"] : '';
	$tipo        = isset($_POST["tipo"]) ? $_POST["tipo"] : ''; // "cliente" si es un punto de cliente
	$localizacion = isset($_POST["localizacion"]) ? $_POST["localizacion"] : '';
?>

<div class="modal-body p-0 bg-transparent position-relative">
	<div class="frame-punto-imageen">
		<?php if ($imagen) : ?>
			<img src="<?= $ruta_admin ?>/data/puntos/<?= $imagen ?>" class="imagen-punto-imageen">
		<?php endif; ?>
		<button class="aspa-cierre ri-close-line ri-xl border-0 position-absolute top-0 end-0 m-3 rounded-circle px-0 py-1" data-bs-dismiss="modal"></button>
		<img src="<?= $ruta_admin ?>/data/imagenes/<?= $icono ?>" style="margin-top:-45px; display:block; margin-left:auto; margin-right:auto; width:68px;">
		<div class="px-2" style="display: flex; flex-flow: column nowrap; flex-grow: 1; background: white;">
			<div class="titulo-POIs text-dark mb-auto"><?= $nombre ?></div>
			<?php if ($distancia || $materiales) : ?>
				<div class="d-flex flex-row justify-content-evenly mb-auto">
					<?php if ($distancia) : ?>
						<div class="boton-amarillo-POIs"><i class="ri-treasure-map-line ri-xl align-middle"></i> <?= $distancia ?> km</div>
					<?php endif; ?>
					<?php if ($materiales) : ?>
						<div class="boton-amarillo-POIs"><i class="ri-live-line ri-xl align-middle"></i> <?= $materiales ?></div>
					<?php endif; ?>
					<?php if ($tipo == "cliente" && $localizacion) : ?>
						<a href="<?= $localizacion ?>" class="btn boton-azul-POIs"><i class="ri-map-pin-2-line ri-xl align-middle"></i> Google Maps</a>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<div class="texto-POIs text-dark mb-auto"><?= $descripcion ?></div>
			<?php if ($tipo != "cliente") : ?>
				<button onclick="loadContents({'codigo': '<?= $p ?>', 'nombre': '<?= $nombre ?>'})" class="boton-azul-POIs mb-auto align-self-center" style="font-size:14px;"><i class="ri-eye-line ri-xl align-middle"></i> <?= getTxt(99, $l) ?></button>
				<?php if ($cliente != "") : ?>
					<?php $logo_cliente = get_logo_customer($cliente); ?>
					<div class="mt-1 ms-auto me-auto">
						<a href="contents.php?x=<?= $cliente ?>" onclick="closePoint()"><img class="img-fluid" src="https://app.imageen.net/imagenes/<?= $logo_cliente ?>"></a>
					</div>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	</div>
	<button class="aspa-cierre ri-arrow-left-line ri-xl border-0 position-absolute top-0 start-0 m-3 rounded-circle px-0 py-1" data-bs-dismiss="modal"></button>
</div>