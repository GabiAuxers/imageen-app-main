
<?php 
include 'conexion.php';
include 'literal.php';
include 'functions.php';
include 'auth.php';

if ($auth == 1){
    $field = $_POST['field'];
    $value = $_POST['value'];
    $ahora = new DateTime();
    $fecha_actualiza = $ahora->format('Y-m-d H:i:s');

    $conn = @new mysqli($db_server, $db_username, $db_userpassword, $db_name);
	if ($conn->connect_error) {
		$additionalInfo = "Fallo en la conexión a la base de datos en la clase _edituser.php línea 14. Comprueba las credenciales de la base de datos y que el servidor esté funcionando correctamente. Error específico: " . $conn->connect_error;
		$errorLogger = new ErrorLogger();
		$errorLogger->logErrorToFile('errors.txt', "Error de conexión a la base de datos", $additionalInfo);
		die("Ha ocurrido un error al intentar conectar a la base de datos.");
	}
    mysqli_set_charset($conn, 'utf8');
    
    if ($field == 'nombre') {
        $stmt = $conn->prepare ("UPDATE USUARIOS SET NOMBRE =?, FECHADATOSPERSO = ? WHERE CODIGO = ? AND TOKEN = ?");
        $stmt->bind_param("ssss", $value, $fecha_actualiza, $codigousuario, $token_usuario);
    } else if ($field == 'email') {
        $stmt = $conn->prepare ("UPDATE USUARIOS SET EMAIL =?, FECHADATOSPERSO = ? WHERE CODIGO = ? AND TOKEN = ?");
        $stmt->bind_param("ssss", $value, $fecha_actualiza, $codigousuario, $token_usuario);
    } else if ($field == 'telefono') {
        $stmt = $conn->prepare ("UPDATE USUARIOS SET TELEFONO =?, FECHADATOSPERSO = ? WHERE CODIGO = ? AND TOKEN = ?");
        $stmt->bind_param("ssss", $value, $fecha_actualiza, $codigousuario, $token_usuario);
    }

    $stmt->execute();
    $stmt->close();
    $conn->close();
}
?>