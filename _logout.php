<?php include 'conexion.php';
include 'literal.php';
include 'auth.php';
session_start();
//session_unset();
session_destroy();
$conn = @new mysqli($db_server, $db_username, $db_userpassword, $db_name);
if ($conn->connect_error) {
	$additionalInfo = "Fallo en la conexión a la base de datos en la clase _logout.php línea 7. Comprueba las credenciales de la base de datos y que el servidor esté funcionando correctamente. Error específico: " . $conn->connect_error;
	$errorLogger = new ErrorLogger();
	$errorLogger->logErrorToFile('errors.txt', "Error de conexión a la base de datos", $additionalInfo);
	die("Ha ocurrido un error al intentar conectar a la base de datos.");
}
$stmt = $conn->prepare ("UPDATE USUARIOS SET TOKEN ='' WHERE CODIGO = ? AND TOKEN =?");
$stmt -> bind_param("ss", $codigousuario, $token);
$stmt->execute();
$stmt->close();

$conn->close();	

setcookie("usuario", "", time() + (86400 * 360), "/");     
setcookie("token", "", time() + (86400 * 360), "/");  
setcookie("lng", "", time() + (86400 * 360), "/"); 
?>

