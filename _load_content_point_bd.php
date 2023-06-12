<?php
include 'conexion.php';
include 'literal.php';
include 'functions.php';
include 'auth.php';
//Carga de medio directo gracias a enlace o codigo del material
if ($_SERVER['SERVER_NAME']=="localhost") $ruta_admin="../admin";
else $ruta_admin="https://admin.imageen.net";
$m= $_POST["media"];
$codigo_material= $m;
//Conjunto para obtener los datos necesarios dependiendo del código de material
$conn = @new mysqli($db_server, $db_username, $db_userpassword, $db_name);
if ($conn->connect_error) {
	$additionalInfo = "Fallo en la conexión a la base de datos en la clase _load_content_point_bd.php línea 12. Comprueba las credenciales de la base de datos y que el servidor esté funcionando correctamente. Error específico: " . $conn->connect_error;
	$errorLogger = new ErrorLogger();
	$errorLogger->logErrorToFile('errors.txt', "Error de conexión a la base de datos", $additionalInfo);
	die("Ha ocurrido un error al intentar conectar a la base de datos.");
}
mysqli_set_charset($conn, 'utf8');
$sql = "SELECT CODIGO, CARPETA FROM VERSIONES WHERE MATERIAL='$codigo_material' AND IDIOMA='$l'";
$result = $conn->query($sql);
if ($result->num_rows > 0) { 
	$row = mysqli_fetch_array($result);
	$codigo_version 	= $row["CODIGO"];
	$carpeta_destino	= $row["CARPETA"];
}
$sql2 = "SELECT NOMBRE".$l.", INSTRUCCIONES".$l.",PUNTO FROM MATERIALES WHERE CODIGO='$codigo_material'";
$result = $conn->query($sql2);
if ($result->num_rows > 0) { 
	$row = mysqli_fetch_array($result);
	$nombre_material= str_replace("~","'",$row["NOMBRE".$l]);
	$instrucciones_material = str_replace("~","'",$row["INSTRUCCIONES".$l]);
	$p= $row["PUNTO"];
}
$sql3 ="SELECT NOMBRE FROM PUNTOS WHERE CODIGO = '$p'";
$result = $conn->query($sql3);
if ($result->num_rows > 0) { 
	$row = mysqli_fetch_array($result);
	$nombre_punto=$row["NOMBRE"];
}?>

<script>
addWatch('<?=$p?>','<?=$codigo_material?>','<?=$codigo_version?>','<?=$carpeta_destino?>','<?=$l?>', '<?=$nombre_usuario?>', '<?=$instrucciones_material?>', '<?=$nombre_punto?>#<?=$nombre_material?>', '<?=$acceso_material?>');
</script>		