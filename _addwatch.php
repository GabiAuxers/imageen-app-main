<?php 
include 'conexion.php';
include 'literal.php';
include 'functions.php';
include 'auth.php';

// [MYSQL] - INSERTS INTO HVISUAL TABLE - 03/03/2023
$p = $_POST["p"]; // Punto Imageen
$m = $_POST["m"]; // Material
$v = $_POST["v"]; // Versión

$date = date('Y-m-d');
$time = date('h:i:sa');

$conn = @new mysqli($db_server, $db_username, $db_userpassword, $db_name);
if ($conn->connect_error) {
    $additionalInfo = "Fallo en la conexión a la base de datos en la clase _addwatch.php línea 15. Comprueba las credenciales de la base de datos y que el servidor esté funcionando correctamente. Error específico: " . $conn->connect_error;
    $errorLogger = new ErrorLogger();
    $errorLogger->logErrorToFile('errors.txt', "Error de conexión a la base de datos", $additionalInfo);
    die("Ha ocurrido un error al intentar conectar a la base de datos.");
}
$sql = "INSERT INTO HVISUAL (FECHA, HORA, IP, USUARIO, PUNTO, MATERIAL, VERSION) VALUES ('$date', '$time', '$ipaddress', '$codigousuario', '$p', '$m', '$v')";
$conn->query($sql);
$conn->close();	
?>