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

// Cambié esto para que recoja el valor de una solicitud POST
parse_str(file_get_contents("php://input"),$_POST);
$fav_id = $_POST['fav_id'];
$codigomaterial = $_POST['codigo_material'];
$sql = "INSERT INTO favoritos (codigo_usuario, fav_id, codigo_material) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sis", $codigousuario, $fav_id, $codigomaterial);
$stmt->execute();


$conn->close();
?>
