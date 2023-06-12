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
    $sql = "SELECT LATITUD_INICIO, LONGITUD_INICIO, ZOOM_INICIO FROM CLIENTES WHERE CODIGO ='$customer'" ;
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($result->num_rows > 0) {
        $latitud_inicio   = $row["LATITUD_INICIO"];
        $longitud_inicio  = $row["LONGITUD_INICIO"];
        $zoom_inicio      = $row["ZOOM_INICIO"];      
    }else{
        $latitud_inicio   = "40.4342397922468";
        $longitud_inicio  = "-3.6748230030173556";
        $zoom_inicio      = "5";            
    }
    $conn->close();      
}else{
    //$customer         = ""; 
    $latitud_inicio   = "37.3s342397922468";
    $longitud_inicio  = "-3.6748230030173556";
    $zoom_inicio      = "6"; 
}

$data = array('message0' => $customer, "message1" => $latitud_inicio, "message2" => $longitud_inicio, "message3" => $zoom_inicio);
echo json_encode($data);
?>