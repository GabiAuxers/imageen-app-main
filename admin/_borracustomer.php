<?php include 'conexion.php';

$v = $_POST["v"];

$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
$sql1 = "DELETE FROM CLIENTES WHERE CODIGO ='$v'";
$conn->query($sql1);
$conn->close();	

?>
