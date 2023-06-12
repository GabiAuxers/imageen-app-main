<?php include 'conexion.php';
include 'auth.php';

// [MYSQL] - UPDATE USUARIOS (IDIOMA AND IDIOMA2) TABLE - 03/03/2023
$l  = $_POST["l"]; // Idioma
$l2  = $_POST["l2"]; // Idioma

setcookie("lng", $l, time() + (86400 * 360), "/"); 
$conn = @new mysqli($db_server, $db_username, $db_userpassword, $db_name);
if ($conn->connect_error) {
    $additionalInfo = "Fallo en la conexión a la base de datos en la clase _changelng.php línea 9. Comprueba las credenciales de la base de datos y que el servidor esté funcionando correctamente. Error específico: " . $conn->connect_error;
    $errorLogger = new ErrorLogger();
    $errorLogger->logErrorToFile('errors.txt', "Error de conexión a la base de datos", $additionalInfo);
    die("Ha ocurrido un error al intentar conectar a la base de datos.");
}
$sql = "UPDATE USUARIOS SET IDIOMA ='$l', IDIOMA2 ='$l2' WHERE CODIGO = '$codigousuario'";
$conn->query($sql);
$conn->close();		
?>