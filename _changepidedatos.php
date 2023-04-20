<?php include 'conexion.php';
include 'auth.php';

// [MYSQL] - UPDATE USUARIOS (FECHAPIDEDATOS) TABLE - 03/03/2023
$ahora = new DateTime();
$fecha_actualiza = $ahora->format('Y-m-d H:i:s');

$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
$sql = "UPDATE USUARIOS SET FECHAPIDEDATOS = '$fecha_actualiza' WHERE CODIGO = '$codigousuario'";
$conn->query($sql);
$conn->close();		
?>