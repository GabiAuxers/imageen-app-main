<?php include 'conexion.php';
include 'auth.php';

// [MYSQL] - UPDATE USUARIOS (VISUALIZACION) TABLE - 03/03/2023
$v  = $_POST["v"]; // Visualización

$conn = @new mysqli($db_server, $db_username, $db_userpassword, $db_name);
if ($conn->connect_error) {
    $additionalInfo = "Fallo en la conexión a la base de datos en la clase _changevisual.php línea 7. Comprueba las credenciales de la base de datos y que el servidor esté funcionando correctamente. Error específico: " . $conn->connect_error;
    $errorLogger = new ErrorLogger();
    $errorLogger->logErrorToFile('errors.txt', "Error de conexión a la base de datos", $additionalInfo);
    die("Ha ocurrido un error al intentar conectar a la base de datos.");
}
$stmt = $conn->prepare ("UPDATE USUARIOS SET VISUALIZACION = ? WHERE CODIGO = ?");
$stmt->bind_param("ss", $v, $codigousuario);
$stmt->execute();
$stmt->close();
$conn->close();

	
?>