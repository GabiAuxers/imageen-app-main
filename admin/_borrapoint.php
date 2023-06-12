<?php include 'conexion.php';
include 'functions.php';

$p = $_POST["p"];

$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
$sql1 = "DELETE FROM PUNTOS WHERE CODIGO ='$p'";
$conn->query($sql1);
$sql2 = "DELETE FROM MATERIALES WHERE PUNTO ='$p'";
$conn->query($sql2);
$sql3 = "DELETE FROM VERSIONES WHERE PUNTO ='$p'";
$conn->query($sql3);
$conn->close();

escribe_fichero_puntos_imageen();

?>
