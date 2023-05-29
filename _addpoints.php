<?php 
include 'conexion.php';
include 'literal.php';
include 'functions.php';
include 'auth.php';

// [MYSQL] - INSERTS OR UPDATE INTO HVALORACION TABLE - 03/03/2023
if ($auth == 1){

	$p = $_POST["p"]; // Punto Imageen
	$m = $_POST["m"]; // Material
	$x = $_POST["x"]; // Puntuación

	// Verifico si ya se ha emitido una votación por este usuario para este material
    $conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
	// Check connection	error
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
    $sql = "SELECT ID FROM HVALORACION WHERE PUNTO ='$p' AND MATERIAL ='$m' AND USUARIO ='$codigousuario'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

	$date = date('Y-m-d');
	$time = date('h:i:sa');    
    
    if ($result->num_rows == 0){
		$sql = "INSERT INTO HVALORACION (FECHA, HORA, IP, USUARIO, PUNTO, MATERIAL, PUNTUACION) VALUES ('$date', '$time', '$ipaddress', '$codigousuario', '$p', '$m', '$x')";
		$conn->query($sql);

	}else{
		$sql = "UPDATE HVALORACION SET FECHA ='$date', HORA ='$time', IP = '$ipaddress', PUNTUACION ='$x' WHERE PUNTO ='$p' AND MATERIAL ='$m' AND USUARIO ='$codigousuario'";
		$conn->query($sql);
	}
	$conn->close();
}
?>