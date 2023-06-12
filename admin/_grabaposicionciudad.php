<?php include 'conexion.php';

$order1 = $_POST["order1"] .",";
$array = explode(',',$order1,-1);
$orden = 0;

foreach ($array as $value) {
	$orden = $orden + 100;
	$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
	$sql = "UPDATE CIUDADES SET ORDEN ='$orden' WHERE CODIGO = '$value'";
	$conn->query($sql);
	$conn->close();	
}
?>