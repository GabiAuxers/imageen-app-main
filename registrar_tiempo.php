<?php
include 'conexion.php'; // Incluye el archivo de configuración de la base de datos
include 'literal.php';
include 'functions.php';
session_start(); // Inicia la sesión
$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);

$data = json_decode(file_get_contents('php://input'), true);
$minutesSpent = $data['minutesSpent'];
$secondsSpent = $data['secondsSpent'];
$timeSpent = $data['timeSpent'];


//funcion para obtener el dispositivo, puede que no detecte todos los dispositivos correctamente ya que la funcion
//es muy basica, para una informacion mas precisa: biblioteca de detección de dispositivos como Mobile_Detect.
//Funcion incluida en functions.php
$dispositivo = getDevice();

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

if (isset($timeSpent) && $codigousuario != "" &&  $token != "") {
    $sessionId = session_id(); // Obtenemos el ID de la sesión

    // Consulta los datos del usuario
    $query_user = "SELECT UID, NOMBRE FROM usuarios WHERE CODIGO = ?";
    $stmt_user = $conn->prepare($query_user);
    if ($stmt_user) {
        $stmt_user->bind_param("s", $codigousuario); 
        $stmt_user->execute();
        $result_user = $stmt_user->get_result();
        $user_data = $result_user->fetch_assoc();
        $fb_uid = $user_data['UID'];
        $provider_usuario = $user_data['NOMBRE'];

                // Obtiene los datos de la tabla hvisual
                $query = "SELECT PUNTO, MATERIAL, VERSION FROM hvisual WHERE USUARIO = ? ORDER BY id DESC LIMIT 1";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $codigousuario);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $punto = $row['PUNTO'];
                    $material = $row['MATERIAL'];
                    $version = $row['VERSION'];
              //obtener el nombre de cada punto
                    $query_punto = "SELECT NOMBRE FROM puntos WHERE CODIGO = ?";
                    $stmt_punto = $conn->prepare($query_punto);
                    $stmt_punto->bind_param("s", $punto);
                    $stmt_punto->execute();
                    $result_punto = $stmt_punto->get_result();
                    $row_punto = $result_punto->fetch_assoc();
                    $nombre_punto = $row_punto['NOMBRE'];
       //valoracion por defecto a 0, la actualizacion de valoracion se realiza en el archivo _addpoints.php
        $valoracion = 0;
        $query = "INSERT INTO visualizaciones (SESSION_ID, TIEMPO_TOTAL, FECHA_HORA, MINUTOS, SEGUNDOS, CODIGO, UID, NOMBRE, DISPOSITIVO, PUNTO, MATERIAL, VERSION, NOMBRE_PUNTO, VALORACION) VALUES (?, ?, NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        if ($stmt) {
            
            $stmt->bind_param("siiissssssssi", $sessionId, $timeSpent, $minutesSpent, $secondsSpent, $codigousuario, $fb_uid, $provider_usuario, $dispositivo, $punto, $material, $version, $nombre_punto, $valoracion);
            $stmt->execute();
            if ($stmt->error) {
                echo json_encode(array("error" => "Error al ejecutar la consulta: " . $stmt->error));
            } else {
                echo json_encode(array("message" => "Datos recibidos: " . $timeSpent));
            }
            $stmt->close();
        } else {
            echo json_encode(array("error" => "Error al registrar el tiempo de visualización del video."));
        }
    } else {
        echo json_encode(array("error" => "Error: no se encontraron datos en hvisual para el usuario " . $codigousuario));
    }
} else {
    echo json_encode(array("error" => "Error al buscar datos del usuario."));
}
                       
}
?>

