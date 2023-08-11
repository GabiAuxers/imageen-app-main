<?php include 'conexion.php';
include 'literal.php';
include 'functions.php';
include 'auth.php';

$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
$sql = "DELETE FROM USUARIOS WHERE CODIGO = '$codigousuario'";
$conn->query($sql);
$conn->close();	

setcookie("usuario", "", time() + (86400 * 360), "/");     
setcookie("token", "", time() + (86400 * 360), "/");  
setcookie("lng", "", time() + (86400 * 360), "/"); 
setcookie("cliente", "", time() + (86400 * 360), "/"); 
setcookie("cliente2", "", time() + (86400 * 360), "/"); 
setcookie("envio", "", time() + (86400 * 360), "/"); 
?>

