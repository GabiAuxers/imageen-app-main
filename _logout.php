<?php include 'conexion.php';
include 'literal.php';
include 'auth.php';

$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
$sql = "UPDATE USUARIOS SET TOKEN ='' WHERE CODIGO = '$codigousuario' AND TOKEN ='$token'";
$conn->query($sql);
$conn->close();	

setcookie("usuario", "", time() + (86400 * 360), "/");     
setcookie("token", "", time() + (86400 * 360), "/");  
setcookie("lng", "", time() + (86400 * 360), "/"); 
?>

