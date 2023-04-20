<?php include 'conexion.php';
include 'auth.php';

// [MYSQL] - UPDATE USUARIOS (IDIOMA AND IDIOMA2) TABLE - 03/03/2023
$l  = $_POST["l"]; // Idioma
$l2  = $_POST["l2"]; // Idioma

setcookie("lng", $l, time() + (86400 * 360), "/"); 
$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
$sql = "UPDATE USUARIOS SET IDIOMA ='$l', IDIOMA2 ='$l2' WHERE CODIGO = '$codigousuario'";
$conn->query($sql);
$conn->close();		
?>