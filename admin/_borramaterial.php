<?php include 'conexion.php';

$m = $_POST["m"];

$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
$sql = "DELETE FROM MATERIALES WHERE CODIGO ='$m'";
$conn->query($sql);
$sql2 = "DELETE FROM VERSIONES WHERE MATERIAL ='$m'";
$conn->query($sql2);
$conn->close();	

?>


