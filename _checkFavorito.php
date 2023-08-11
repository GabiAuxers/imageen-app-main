<?php
require_once 'conexion.php';

// Conéctate a la base de datos
$conn = @new mysqli($db_server, $db_username, $db_userpassword, $db_name);

// Comprueba la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_COOKIE['usuario'])) {
    $codigousuario = trim($_COOKIE['usuario'], " ");
} else {
    $codigousuario = "";
}

// Recibe fav_id de la solicitud
$fav_id = $_GET['fav_id'];

// Verifica si el artículo es un favorito
$sql = "SELECT * FROM favoritos WHERE codigo_usuario = ? AND fav_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $codigousuario, $fav_id);
$stmt->execute();
$result = $stmt->get_result();

// Si hay un resultado, entonces el artículo es un favorito
if ($result->num_rows > 0) {
    echo json_encode(['isFavorito' => true]);
} else {
    echo json_encode(['isFavorito' => false]);
}

// Cierra la conexión
$conn->close();
?>