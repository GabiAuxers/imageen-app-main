<?php 
include 'conexion.php';
include 'literal.php';
include 'functions.php';


session_start();

$datos = json_decode(file_get_contents('php://input'));
$ipaddress = $_SERVER['REMOTE_ADDR'];
$fb_uid = $datos->uid; //Uid Firebase
$l  = $datos->l; // Idioma
$sistema_operativo = $datos->sistema_operativo;
$dispositivo_movil = $datos->dispositivo_movil;


$conn = @new mysqli($db_server, $db_username, $db_userpassword, $db_name);
if ($conn->connect_error) {
	$additionalInfo = "Fallo en la conexión a la base de datos en la clase _login.php línea 16. Comprueba las credenciales de la base de datos y que el servidor esté funcionando correctamente. Error específico: " . $conn->connect_error;
	$errorLogger = new ErrorLogger();
	$errorLogger->logErrorToFile('errors.txt', "Error de conexión a la base de datos", $additionalInfo);
	die("Ha ocurrido un error al intentar conectar a la base de datos.");
}
mysqli_set_charset($conn, 'utf8');

$stmt = $conn->prepare ("SELECT CODIGO, NOMBRE, TELEFONO, FOTO, PROVIDER, EMAIL FROM USUARIOS WHERE UID = ?");
$stmt->bind_param("s", $fb_uid);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($result->num_rows == 0) { // No existe. Le damos de alta
	$codigo = get_item_code(1);
	$control = RandomString(6);
	$codigousuario = $codigo.strtoupper($control);
	$_SESSION['codigo_usuario'] = $row['CODIGO'];
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

	$stmt2 = $conn->prepare("INSERT INTO USUARIOS (CODIGO, NOMBRE, APELLIDOS, UID, TELEFONO, FOTO, EMAIL, PROVIDER, TOKEN, IPALTA, FECHAALTA, HORAALTA, SUSCRIPCION, IDIOMA, IDIOMA2, VISUALIZACION, PERMISOS, VERSION_SISTEMA_OPERATIVO, DISPOSITIVO_MOVIL) 
	VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	$empty_string = "";
	$one = '1';
	$stmt2->bind_param("sssssssssssssssssss",
	$codigousuario, $datos->nombre, $empty_string, $fb_uid, $datos->telefono,
	$datos->foto, $datos->email, $datos->provider, $empty_string,
	$ipaddress, $date, $time, $one, $l, $l2, $one, $one,
	$sistema_operativo, $dispositivo_movil
);
	$result2 = $stmt2->execute();
	$stmt2->close();
}

else {
	$codigousuario = $row["CODIGO"];
	if (empty($nombre = $row["NOMBRE"])) $nombre = $datos->nombre;
	if (empty($telefono = $row["TELEFONO"])) $telefono = $datos->telefono;
	if (empty($foto = $row["FOTO"])) $foto = $datos->foto;
	$provider = $datos->provider;
	if (empty($email = $row["EMAIL"])) $email = $datos->email;
	 "UPDATE USUARIOS SET NOMBRE ='$nombre', TELEFONO = '$telefono', FOTO = '$foto', PROVIDER = '$provider', EMAIL = '$email' WHERE CODIGO = '$codigousuario'";
	$stmt3 = $conn->prepare("UPDATE USUARIOS SET NOMBRE =?, TELEFONO =?, FOTO =?, PROVIDER =?, EMAIL =? WHERE CODIGO =?");
	$stmt3->bind_param("ssssss", $nombre, $telefono, $foto, $provider, $email, $codigousuario);
	$result3 = $stmt3->execute();
	$stmt3->close();
}
$stmt->close();


$randstring = RandomString(40);
setcookie("usuario", $codigousuario, time() + (86400 * 360), "/");     
setcookie("token", $randstring, time() + (86400 * 360), "/");  
setcookie("lng", $l, time() + (86400 * 360), "/"); 


$stmt4 = $conn->prepare("UPDATE USUARIOS SET IDIOMA =?, TOKEN =? WHERE CODIGO = ?");
$stmt4->bind_param("sss", $l, $randstring, $codigousuario);
$stmt4->execute();
$stmt4->close();

$dat = date('Y-m-d');
$tim = date('h:i:sa');

$stmt5 = $conn->prepare("INSERT INTO HACCESOS (fecha, hora, ip, usuario) VALUES (?, ?, ?, ?)");
$stmt5->bind_param("ssss", $dat, $tim, $ipaddress, $codigousuario);
$stmt5->execute();
$stmt5->close();

$conn->close();	




?>
