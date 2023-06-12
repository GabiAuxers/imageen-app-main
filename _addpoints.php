<?php 
include 'conexion.php';
include 'literal.php';
include 'functions.php';
include 'auth.php';

// [MYSQL] - INSERTS OR UPDATE INTO HVALORACION TABLE - 03/03/2023
if ($auth == 1){

    $p = $_POST["p"]; // Punto Imageen
    $m = $_POST["m"]; // Material
    $x = intval($_POST["x"]); // Puntuación

    // Verifico si ya se ha emitido una votación por este usuario para este material
    $conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
    // Check connection	error
	if ($conn->connect_error) {
		$additionalInfo = "Fallo en la conexión a la base de datos en la clase _addpoints.php línea 15. Comprueba las credenciales de la base de datos y que el servidor esté funcionando correctamente. Error específico: " . $conn->connect_error;
		$errorLogger = new ErrorLogger();
		$errorLogger->logErrorToFile('errors.txt', "Error de conexión a la base de datos", $additionalInfo);
		die("Ha ocurrido un error al intentar conectar a la base de datos.");
	}

    $stmt = $conn->prepare("SELECT USUARIO FROM HVALORACION WHERE PUNTO = ? AND MATERIAL = ?");
    $stmt->bind_param("ss", $p, $m);
    $stmt->execute();

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $date = date('Y-m-d');
    $time = date('h:i:sa');    

    if ($result->num_rows == 0){
        $stmt = $conn->prepare("INSERT INTO visualizaciones (VALORACION) VALUES (?)");
        $stmt->bind_param("i",$x);
        $stmt->execute();
        
    }else{
        $stmt = $conn->prepare("UPDATE visualizaciones SET VALORACION = ? WHERE PUNTO = ? AND MATERIAL = ? AND CODIGO = ?");
        $stmt->bind_param("isss",$x, $p, $m, $codigousuario);
        $stmt->execute();
    }

    $stmt->close();
    $conn->close();
}
?>

?>