<?php 
include 'conexion.php';
include 'literal.php';
include 'functions.php';
//require_once 'Logger.php';


session_start();

$datos = json_decode(file_get_contents('php://input'));
$ipaddress = $_SERVER['REMOTE_ADDR'];
$fb_uid = $datos->uid; //Uid Firebase
$l  = $datos->l; // Idioma


$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
mysqli_set_charset($conn, 'utf8');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}



$sql = "SELECT CODIGO, NOMBRE, TELEFONO, FOTO, PROVIDER, EMAIL FROM usuarios WHERE UID = '$fb_uid'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($result->num_rows == 0) { // No existe. Le damos de alta
	$codigo = get_item_code(1);
	$control = RandomString(6);
	$codigousuario = $codigo.strtoupper($control);

	// 2º idioma
	if ($l == 1){
		$l2 = 1;
	}elseif ($l == 2){
		$l2 = 2;
	}elseif ($l == 3){
		$l2 = 1;
	}elseif ($l == 4){
		$l2 = 1;
	}

	$date = date('Y-m-d');
	$time = date('h:i:sa');
	if($fb_uid == "anonimo") {
		$fb_uid .=  $codigousuario;
	}
	$sql = "INSERT INTO USUARIOS (CODIGO, NOMBRE, APELLIDOS, UID, TELEFONO, FOTO, EMAIL, PROVIDER, TOKEN, IPALTA, FECHAALTA, HORAALTA, SUSCRIPCION, IDIOMA, IDIOMA2, VISUALIZACION, PERMISOS)
					VALUES ('$codigousuario', '$datos->nombre', '', '$fb_uid', '$datos->telefono', '$datos->foto', '$datos->email', '$datos->provider', '', '$ipaddress', '$date', '$time', '1', '$l', '$l2', '1', '1')";
	$result=$conn->query($sql);
}
else {
	$codigousuario = $row["CODIGO"];
	if (empty($nombre = $row["NOMBRE"])) $nombre = $datos->nombre;
	if (empty($telefono = $row["TELEFONO"])) $telefono = $datos->telefono;
	if (empty($foto = $row["FOTO"])) $foto = $datos->foto;
	$provider = $datos->provider;
	if (empty($email = $row["EMAIL"])) $email = $datos->email;
	$sql = "UPDATE USUARIOS SET NOMBRE ='$nombre', TELEFONO = '$telefono', FOTO = '$foto', PROVIDER = '$provider', EMAIL = '$email' WHERE CODIGO = '$codigousuario'";
	$result=$conn->query($sql);
}

$randstring = RandomString(40);
setcookie("usuario", $codigousuario, time() + (86400 * 360), "/");     
setcookie("token", $randstring, time() + (86400 * 360), "/");  
setcookie("lng", $l, time() + (86400 * 360), "/"); 

$sql = "UPDATE USUARIOS SET IDIOMA ='$l', TOKEN = '$randstring' WHERE CODIGO = '$codigousuario'";
$conn->query($sql);

$dat = date('Y-m-d');
$tim = date('h:i:sa');
$sql = "INSERT INTO HACCESOS (fecha, hora, ip, usuario) VALUES ('$dat', '$tim', '$ipaddress', '$codigousuario')";
$conn->query($sql);

///////////////////////////////////////////////////////////////////
// Logging instance and bdd connection 24/03/2023
//$logger = new Logger($conn);
$postData = array(
    'uid' => $datos->uid,
    'nombre' => $datos->nombre,
    'telefono' => $datos->telefono,
    'foto' => $datos->foto,
    'email' => $datos->email,
    'provider' => $datos->provider
);

$additionalData = array(
    'codigo_usuario' => $codigousuario
);

////$logger->logRequest($postData, $additionalData);
///////////////////////////////////////////////////////////////////
$conn->close();	

$errorlogin = 0;
echo json_encode(array('message' => $errorlogin));


?>
