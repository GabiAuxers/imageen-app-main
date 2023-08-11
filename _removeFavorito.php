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

// Recibe user_id y ciudad_id de la solicitud
$fav_id = $_GET['fav_id'];

// Borra la fila correspondiente en la tabla 'favoritos'
$sql = "DELETE FROM favoritos WHERE codigo_usuario = ? AND fav_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $codigousuario, $fav_id);
$stmt->execute();

echo "Favorito eliminado correctamente.";

// Cierra la conexión
$conn->close();
?>