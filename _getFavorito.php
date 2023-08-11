<?php
require_once 'conexion.php';

$conn = @new mysqli($db_server, $db_username, $db_userpassword, $db_name);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_COOKIE['usuario'])) {
    $codigousuario = trim($_COOKIE['usuario'], " ");
} else {
    $codigousuario = "";
}

$sql = "SELECT CODIGO_MATERIAL FROM favoritos WHERE CODIGO_USUARIO = ? AND ES_FAVORITO = 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $codigousuario);
$stmt->execute();
$result = $stmt->get_result();

$codigosFavoritos = [];
while($row = $result->fetch_assoc()) {
    $codigosFavoritos[] = $row['CODIGO_MATERIAL'];
}

echo json_encode(['codigosFavoritos' => $codigosFavoritos]);

$conn->close();
?>
