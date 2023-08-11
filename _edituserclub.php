<?php include 'conexion.php';
include 'literal.php';
include 'functions.php';
include 'auth.php';

// [MYSQL] - UPDATE USUARIOS (SUSCRIPCION, FECHADATOSPERSO) TABLE - 03/03/2023
if ($auth == 1){
	
	$tipoclub		=  $_POST["club"];

	$ahora = new DateTime();
	$fecha_actualiza = $ahora->format('Y-m-d H:i:s');

	$conn = @new mysqli($db_server, $db_username, $db_userpassword, $db_name);
	if ($conn->connect_error) {
		$additionalInfo = "Fallo en la conexión a la base de datos en la clase _edituserclub.php línea 14. Comprueba las credenciales de la base de datos y que el servidor esté funcionando correctamente. Error específico: " . $conn->connect_error;
		$errorLogger = new ErrorLogger();
		$errorLogger->logErrorToFile('errors.txt', "Error de conexión a la base de datos", $additionalInfo);
		die("Ha ocurrido un error al intentar conectar a la base de datos.");	}
	mysqli_set_charset($conn, 'utf8');
	$stmt = $conn->prepare ("UPDATE USUARIOS SET SUSCRIPCION = ?, FECHADATOSPERSO = ? WHERE CODIGO = ? AND TOKEN = ?");
	$stmt->bind_param("ssss", $tipoclub, $fecha_actualiza, $codigousuario, $token_usuario);
	$stmt->execute();
	$stmt->close();
	$conn->close();		
}
?>