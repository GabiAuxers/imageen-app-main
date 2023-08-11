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

$codigo_material = $_GET['codigo_material'];

$sql = "SELECT ES_FAVORITO FROM favoritos WHERE CODIGO_USUARIO = ? AND CODIGO_MATERIAL = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $codigousuario, $codigo_material);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row['ES_FAVORITO']) {
        $sql = "UPDATE favoritos SET ES_FAVORITO = 0 WHERE CODIGO_USUARIO = ? AND CODIGO_MATERIAL = ?";
        $nuevoEstado = false;
    } else {
        $sql = "UPDATE favoritos SET ES_FAVORITO = 1 WHERE CODIGO_USUARIO = ? AND CODIGO_MATERIAL = ?";
        $nuevoEstado = true;
    }
} else {
    $sql = "INSERT INTO favoritos (CODIGO_USUARIO, ES_FAVORITO, CODIGO_MATERIAL) VALUES (?, 1, ?)";
    $nuevoEstado = true;
}

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $codigousuario, $codigo_material);
$stmt->execute();

echo json_encode(['ES_FAVORITO' => $nuevoEstado]);

$conn->close();
?>
