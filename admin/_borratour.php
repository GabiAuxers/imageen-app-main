<?php include 'conexion.php';

$p = $_POST["p"];

$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
$sql = "DELETE FROM TOUR WHERE CODIGO ='$p&'";
$conn->query($sql);
$conn->close();	

?>
