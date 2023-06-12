<?php include 'conexion.php';

$v = $_POST["v"];

$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
$sql = "DELETE FROM VERSIONES WHERE CODIGO ='$v'";
$conn->query($sql);
$conn->close();	

?>


