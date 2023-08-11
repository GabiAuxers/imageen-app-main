<?php 
include 'conexion.php';
include 'literal.php';
include 'functions.php';
include 'auth.php';


if (isset($_COOKIE['customer'])) {
    $customer = $_COOKIE['customer'];
} else {
    $customer = "";
}

if ($customer != ""){

    $conn = @new mysqli($db_server, $db_username, $db_userpassword, $db_name);
	if ($conn->connect_error) {
		$additionalInfo = "Fallo en la conexión a la base de datos en la clase _getCustomer.php línea 16. Comprueba las credenciales de la base de datos y que el servidor esté funcionando correctamente. Error específico: " . $conn->connect_error;
		$errorLogger = new ErrorLogger();
		$errorLogger->logErrorToFile('errors.txt', "Error de conexión a la base de datos", $additionalInfo);
        die("Ha ocurrido un error al intentar conectar a la base de datos.");
	}
    mysqli_set_charset($conn, 'utf8');
    $stmt = $conn->prepare ("SELECT LATITUD_INICIO, LONGITUD_INICIO, ZOOM_INICIO FROM CLIENTES WHERE CODIGO =?");
    $stmt->bind_param("s", $customer);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if ($result->num_rows > 0) {
        $latitud_inicio   = $row["LATITUD_INICIO"];
        $longitud_inicio  = $row["LONGITUD_INICIO"];
        $zoom_inicio      = $row["ZOOM_INICIO"];      
    }else{
        $latitud_inicio   = "";
        $longitud_inicio  = "";
        $zoom_inicio      = "";           
    }
    $stmt->close();
    $conn->close();      
}else{
    //$customer         = ""; 
    $latitud_inicio   = "";
    $longitud_inicio  = "";
    $zoom_inicio      = ""; 
}

$data = array('message0' => $customer, "message1" => $latitud_inicio, "message2" => $longitud_inicio, "message3" => $zoom_inicio);
echo json_encode($data);
?>