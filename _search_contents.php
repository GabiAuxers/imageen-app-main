<?php
include 'conexion.php';
include 'literal.php';
include 'functions.php';
include 'auth.php';

$l = $_GET["l"];
$txt = $_GET["t"];

if (strlen($txt) >= 4) {

    $conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
    mysqli_set_charset($conn, 'utf8');
    $sql = "SELECT PUNTOS.NOMBRE, CATEGORIA, DESCRIPCION" . $l . ", PUNTOS.CODIGO, IMAGEN, CLIENTE, GALERIA.ICONO, GALERIA.ICONOG FROM PUNTOS, GALERIA WHERE ( BUSQUEDA LIKE '%" . $txt . "%' OR PUNTOS.NOMBRE LIKE '%" . $txt . "%' OR DESCRIPCION" . $l . " LIKE '%" . $txt . "%') AND (PUNTOS.ICONO = GALERIA.CODIGO) ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        if ($result->num_rows > 1) {
            ?>
			<h6 class="mt-1"><?=$result->num_rows . " "?><?=getTxt(101, $l) . " \"" . $txt . "\""?></h6>
<?php
} else {
            ?>
			<h6 class="mt-1"><?=(getTxt(102, $l) . " \"" . $txt . "\"")?></h6>
<?php
}
        ?>
			<div class="container-flulid">
 				<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4">
<?php
while ($row = mysqli_fetch_array($result)) {
            $titulo_punto = $row["NOMBRE"];
            $categoria_punto = $row["CATEGORIA"];
            $descripcion_punto = $row["DESCRIPCION" . $l];
            $codigo_punto = $row["CODIGO"];
            $imagen_punto = $row["IMAGEN"];
            $cliente_punto = $row["CLIENTE"];
            $icono = $row["ICONO"];
            $iconog = $row["ICONOG"];
            if ($iconog == null) {
                $iconog = $icono;
            }

            ?>
				<!--Bypass ventana punto-->
				<?php
if ($cliente_punto == "") {
                ?>
					<a href="#contentx" class="text-decoration-none text-dark" onclick="loadContents({'codigo': '<?=$codigo_punto?>', 'nombre': '<?=$titulo_punto?>'})">
				<?php } else {?>
					<a href="#pointx" class="text-decoration-none text-dark" data-bs-dismiss="offcanvas" onclick="loadPoint({'codigo': '<?=$codigo_punto?>', 'imagen': '<?=$imagen_punto?>', 'cliente': '<?=$cliente_punto?>', 'nombre': '<?=$titulo_punto?>', 'descripcion': '<?=$descripcion_punto?>', 'icono': '<?=$iconog?>'})" data-bs-toggle="modal">
				<?php }?>
						<div class="col">
							<div class="m-1 align-items-center row rounded gx-2 p-2" style="background: #EEEEEE;">
							<h5 class="m-1 text-center"><?=$titulo_punto?></h5>
							<div class="col-4"><img class="align-self-center img-fluid rounded" src="https://admin.imageen.net/data/puntos/<?=$imagen_punto?>"></div>
							<div class="col-8"> <h6><?=substr($descripcion_punto, 0, 75)?>...</h6></div>
						</div>
					</div>
				</a>
			<?php }?>
			</div>
		</div>
	<?php } else {?>
		<h6 class="mt-1"><?=getTxt(66, $l)?></h6>
	<?php }
    $conn->close();
} else {?>
	<h6 class="text-muted"><?=getTxt(100, $l)?></h6>

	<?php }?>

