<?php
include 'conexion.php'; // Incluye el archivo de configuración de la base de datos
$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);

$ip = $_SERVER['REMOTE_ADDR'];// Obtiene la IP del usuario


//habra que establecer la opcion de tener un numero de eventos en la aplicacion y gestionarlo en base a vuestra logica
$num_eventos      =  isset($_POST["ubicacion_geografica"]) ? $_POST["ubicacion_geografica"] : '';


if (isset($_COOKIE['usuario'])) {
    $codigousuario = trim($_COOKIE['usuario'], " ");
} else {
    $codigousuario = "";
}

if (isset($_COOKIE['token'])) {
    $token = trim($_COOKIE['token'], " ");
} else {
    $token = "";
}

if ($codigousuario != "" &&  $token != "") {
    $sessionId = session_id(); // Obtenemos el ID de la sesión
     // Capturamos el momento en que la sesión comienza
     if (!isset($_SESSION['start_time'])) {
        $_SESSION['start_time'] = time();
    }


        // Actualiza tu consulta SQL para insertar los minutos y segundos
        $query = "INSERT INTO sesiones_usuarios (CODIGO_USUARIO, CODIGO_SESION, FECHA_HORA_SESION, NUMERO_EVENTOS) VALUES (?, ?, NOW(), ?)";
        $stmt = $conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param("ssi", $codigousuario, $sessionId, $num_eventos);
            $stmt->execute();
            if ($stmt->error) {
                echo json_encode(array("error" => "Error al ejecutar la consulta -ref sesiones "));
            } 
            $stmt->close();
        } else {
            echo json_encode(array("error" => "Error al registrar el insert into sesiones ."));
        }
    } else {
    echo json_encode(array("error" => "Error al buscar datos del usuario."));
}
session_destroy();

$conn->close();
?>
