<?php 
include 'conexion.php';
include 'literal.php';
include 'functions.php';
include 'auth.php';

$v = $_GET["v"]; // Ciudad

if ($v != ""){

    $conn = @new mysqli($db_server, $db_username, $db_userpassword, $db_name);
	if ($conn->connect_error) {
		$additionalInfo = "Fallo en la conexión a la base de datos en la clase _getCity.php línea 11. Comprueba las credenciales de la base de datos y que el servidor esté funcionando correctamente. Error específico: " . $conn->connect_error;
		$errorLogger = new ErrorLogger();
		$errorLogger->logErrorToFile('errors.txt', "Error de conexión a la base de datos", $additionalInfo);
        die("Ha ocurrido un error al intentar conectar a la base de datos.");
    	}
    mysqli_set_charset($conn, 'utf8');
     $stmt = $conn->prepare ("SELECT LATITUD, LONGITUD FROM CIUDADES WHERE CODIGO =?");
     $stmt->bind_param("s", $v);
     $stmt->execute();
     $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $latitud   = $row["LATITUD"];
        $longitud  = $row["LONGITUD"];     
    }else{
        $latitud   = "";
        $longitud  = "";
    }
    $stmt->close();
    $conn->close();      
}else{
    $latitud   = "";
    $longitud  = "";
}

$data = array('message0' => $v, "message1" => $latitud, "message2" => $longitud);
echo json_encode($data);
?>