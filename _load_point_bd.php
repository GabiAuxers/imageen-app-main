<?php 
include 'conexion.php';
include 'literal.php';
include 'functions.php';
include 'auth.php';

if ($_SERVER['SERVER_NAME']=="localhost") $ruta_admin="../admin";
else $ruta_admin="https://admin.imageen.net";

$p				= $_POST["codigo"];

$conn = @new mysqli($db_server, $db_username, $db_userpassword, $db_name);
if ($conn->connect_error) {
	$additionalInfo = "Fallo en la conexión a la base de datos en la clase _load_point_bd.php línea 12. Comprueba las credenciales de la base de datos y que el servidor esté funcionando correctamente. Error específico: " . $conn->connect_error;
	$errorLogger = new ErrorLogger();
	$errorLogger->logErrorToFile('errors.txt', "Error de conexión a la base de datos", $additionalInfo);
	die("Ha ocurrido un error al intentar conectar a la base de datos.");

}
mysqli_set_charset($conn, 'utf8');
$sql = "SELECT PUNTOS.NOMBRE, CATEGORIA, DESCRIPCION".$l.", PUNTOS.CODIGO, IMAGEN, CLIENTE, GALERIA.ICONO, GALERIA.ICONOG FROM PUNTOS, GALERIA WHERE PUNTOS.CODIGO = '".$p."' AND PUNTOS.ICONO = GALERIA.CODIGO ";
$result = $conn->query($sql);

if ($result->num_rows > 0) { 
	$row = mysqli_fetch_array($result);
	$imagen 	= $row["IMAGEN"];
	$nombre		= $row["NOMBRE"];
	$descripcion = $row["DESCRIPCION".$l];
	$icono 		= $row["ICONOG"];
	$cliente	= $row["CLIENTE"];

?>
	<div class="modal-body p-0 bg-transparent position-relative">	
		<div class="frame-punto-imageen">
			<?if ($imagen) {?>
				<img src="<?=$ruta_admin?>/data/puntos/<?=$imagen?>" class="imagen-punto-imageen">
			<?}?>
				<button class="aspa-cierre ri-close-line ri-xl border-0 position-absolute top-0 end-0 m-3 rounded-circle px-0 py-1" data-bs-dismiss="modal"></button>
				<img src="<?=$ruta_admin?>/data/imagenes/<?=$icono?>" style="margin-top:-45px; display:block; margin-left:auto; margin-right:auto; width:68px;">
				<div class="px-2" style="display: flex; flex-flow: column nowrap; flex-grow: 1; background: white;">
					<div class="titulo-POIs text-dark mb-auto"><?=$nombre?></div>
					<div class="texto-POIs text-dark mb-auto"><?=$descripcion?></div>
					<button onclick="loadContents({'codigo': '<?=$p?>', 'nombre': '<?=$nombre?>'})" < class="boton-azul-POIs mb-auto align-self-center" style="font-size:14px;"><i class="ri-eye-line ri-xl align-middle"></i>  <?=getTxt(99,$l)?></button>
					<? if ($cliente != ""){ 
						$logo_cliente = get_logo_customer($cliente); ?>
						<div class="mt-1 ms-auto me-auto">
								<a href="contents.php?x=<?=$cliente?>" onclick="closePoint()"><img class="img-fluid" src="https://app.imageen.net/imagenes/<?=$logo_cliente?>"></a> 
						</div>
					<?php } ?>
				</div>
		</div>
		<button class="aspa-cierre ri-arrow-left-line ri-xl border-0 position-absolute top-0 start-0 m-3 rounded-circle px-0 py-1" data-bs-dismiss="modal"></button>
	</div>
<?}
?>