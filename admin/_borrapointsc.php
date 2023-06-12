<?php include 'conexion.php';
include 'functions.php';

$p = $_POST["p"];

$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);

$sql = "SELECT CLIENTE FROM PUNTOSC WHERE CODIGO = '$p'";
$result = $conn->query($sql);		
$row = $result->fetch_assoc();
if ($result->num_rows > 0) {
    $cliente	    = $row["CLIENTE"];
}

$sql = "DELETE FROM PUNTOSC WHERE CODIGO ='$p'";
$conn->query($sql);
$conn->close();	

escribe_fichero_puntos_imageen();
escribe_fichero_puntos_cliente($cliente);

?>
