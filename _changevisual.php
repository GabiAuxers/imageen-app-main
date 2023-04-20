<?php include 'conexion.php';
include 'auth.php';

// [MYSQL] - UPDATE USUARIOS (VISUALIZACION) TABLE - 03/03/2023
$v  = $_POST["v"]; // Visualización

$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
$sql = "UPDATE USUARIOS SET VISUALIZACION = '$v' WHERE CODIGO = '$codigousuario'";
$conn->query($sql);
$conn->close();		
?>