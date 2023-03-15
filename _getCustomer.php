<?php 
include 'conexion.php';
include 'literal.php';
include 'functions.php';
include 'auth.php';


$customer = $_COOKIE['customer'];

if ($customer != ""){

    $conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
    mysqli_set_charset($conn, 'utf8');
    $sql = "SELECT LATITUD_INICIO, LONGITUD_INICIO, ZOOM_INICIO FROM CLIENTES WHERE CODIGO ='$customer'" ;
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($result->num_rows > 0) {
        $latitud_inicio   = $row["LATITUD_INICIO"];
        $longitud_inicio  = $row["LONGITUD_INICIO"];
        $zoom_inicio      = $row["ZOOM_INICIO"];      
    }else{
        $latitud_inicio   = "";
        $longitud_inicio  = "";
        $zoom_inicio      = "";           
    }
    $conn->close();      
}else{
    //$customer         = ""; 
    $latitud_inicio   = "";
    $longitud_inicio  = "";
    $zoom_inicio      = ""; 
}

$data = array('message0' => $customer, "message1" => $latitud_inicio, "message2" => $longitud_inicio, "message3" => $zoom_inicio);
echo json_encode($data);
?>