<?php 
include 'conexion.php';
include 'literal.php';
include 'functions.php';
include 'auth.php';

if ($_SERVER['SERVER_NAME']=="localhost") $ruta_admin="../admin";
else $ruta_admin="https://admin.imageen.net";

$p = $_POST["codigo"];

$conn = @new mysqli($db_server, $db_username, $db_userpassword, $db_name);
if ($conn->connect_error) {
	$additionalInfo = "Fallo en la conexión a la base de datos en la clase _load_point_bd.php línea 12. Comprueba las credenciales de la base de datos y que el servidor esté funcionando correctamente. Error específico: " . $conn->connect_error;
	$errorLogger = new ErrorLogger();
	$errorLogger->logErrorToFile('errors.txt', "Error de conexión a la base de datos", $additionalInfo);
	die("Ha ocurrido un error al intentar conectar a la base de datos.");
}
mysqli_set_charset($conn, 'utf8');
$stmt = $conn->prepare("SELECT PUNTOS.NOMBRE, DESCRIPCION".$l.", PUNTOS.CODIGO, IMAGEN, CLIENTE, GALERIA.ICONO, GALERIA.ICONOG, TOKENS.TOKEN
                        FROM PUNTOS
                        JOIN GALERIA ON PUNTOS.ICONO = GALERIA.CODIGO
                        JOIN TOKENS ON PUNTOS.CODIGO = TOKENS.CODIGO
                        WHERE TOKENS.CODIGO = ?");
						
$stmt->bind_param("s", $p);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) { 
	$row = mysqli_fetch_array($result);
	$imagen 	= $row["IMAGEN"];
	$nombre		= $row["NOMBRE"];
	$descripcion = $row["DESCRIPCION".$l];
	$icono 		= $row["ICONOG"];
	$cliente	= $row["CLIENTE"];
	$token 		= $row["TOKEN"];
	echo $token;
}
$stmt->close();
$conn->close();
