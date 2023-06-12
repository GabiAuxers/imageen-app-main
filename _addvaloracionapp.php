<?php 
include 'conexion.php';
include 'literal.php';
include 'functions.php';
include 'auth.php';
include 'ErrorLogger.php';
// [MYSQL] - INSERTS OR UPDATE INTO HVALORACIONAPP TABLE - 03/03/2023
if ($auth == 1){

	$app 		= $_POST["app"];
	$contenidos = $_POST["contenidos"];
	$precio		= $_POST["precio"];
	$verbatim	= $_POST["verbatim"];

	// Verifico si ya se ha emitido una votación por este usuario
    $conn = @new mysqli($db_server, $db_username, $db_userpassword, $db_name);
	if ($conn->connect_error) {
		$additionalInfo = "Fallo en la conexión a la base de datos en la clase _addvaloracion.php línea 16. Comprueba las credenciales de la base de datos y que el servidor esté funcionando correctamente. Error específico: " . $conn->connect_error;
		$errorLogger = new ErrorLogger();
		$errorLogger->logErrorToFile('errors.txt', "Error de conexión a la base de datos", $additionalInfo);
		die("Ha ocurrido un error al intentar conectar a la base de datos.");
	}
    $sql = "SELECT ID FROM HVALORACIONAPP WHERE USUARIO ='$codigousuario'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

	$date = date('Y-m-d');
	$time = date('h:i:sa');    
    
    if ($result->num_rows == 0){
		$sql = "INSERT INTO HVALORACIONAPP (FECHA, HORA, IP, USUARIO, APP, CONTENIDOS, PRECIO, VERBATIM) VALUES ('$date', '$time', '$ipaddress', '$codigousuario', '$app', '$contenidos', '$precio', '$verbatim')";
		$conn->query($sql);
	}else{
		$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
		$sql = "UPDATE HVALORACION SET FECHA ='$date', HORA ='$time', IP = '$ipaddress', APP ='$app', CONTENIDOS='$contenidos', PRECIO='$precio', VERBATIM='$verbatim' WHERE USUARIO ='$codigousuario'";
		$conn->query($sql);
	}
	$conn->close();			
}
?>