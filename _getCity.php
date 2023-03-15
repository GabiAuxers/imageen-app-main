<?php 
include 'conexion.php';
include 'literal.php';
include 'functions.php';
include 'auth.php';

$v = $_GET["v"]; // Ciudad

if ($v != ""){

    $conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
    mysqli_set_charset($conn, 'utf8');
    $sql = "SELECT LATITUD, LONGITUD FROM CIUDADES WHERE CODIGO ='$v'" ;
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($result->num_rows > 0) {
        $latitud   = $row["LATITUD"];
        $longitud  = $row["LONGITUD"];     
    }else{
        $latitud   = "";
        $longitud  = "";
    }
    $conn->close();      
}else{
    $latitud   = "";
    $longitud  = "";
}

$data = array('message0' => $v, "message1" => $latitud, "message2" => $longitud);
echo json_encode($data);
?>