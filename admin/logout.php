<?php include 'conexion.php';

$codigousuario 	= trim($_COOKIE['usuariot']," ");
$token       	= trim($_COOKIE['tokent']," ");

$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
$sql = "UPDATE ADMIN SET TOKEN ='' WHERE ID = '$codigousuario' AND TOKEN ='$token'";
$conn->query($sql);
$conn->close();	

setcookie("usuariot", "", time(), "/");     
setcookie("tokent", "", time(), "/");  

header ("Location: default.php");   
?>