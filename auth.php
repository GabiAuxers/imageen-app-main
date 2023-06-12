<?php 
include 'conexion.php';
include 'ErrorLogger.php';

// Undefine variable lng - Fix  - 23/03/2023
if (isset($_COOKIE['lng'])) {
    $idioma = $_COOKIE['lng'];
} else {
    $idioma = "";
}

if ($idioma == ""){
    $l = isset($_GET["l"]) ? $_GET["l"] : '';
}

if (!isset($l) || $l == "") {
    $l = $idioma;
}
// Undefine variable lng - Fix  - 23/03/2023
if ($l == "") {
	$idioma = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
	switch($idioma){
		case "es":
			$l = 1;
			break;
		case "en":
			$l = 2;
			break;
		case "fr":
			$l = 3;
			break;
		case "ca":
			$l = 4;
			break;
		default:
			$l = 1;
	}
}

if (isset($_COOKIE['usuario'])) {
    $codigousuario = trim($_COOKIE['usuario'], " ");
} else {
    $codigousuario = "";
}

if (isset($_COOKIE['token'])) {
    $token = trim($_COOKIE['token'], " ");
} else {
    $token = "";
}

$ipaddress 		= $_SERVER['REMOTE_ADDR'];
$auth = 0;

if ($codigousuario != "" &&  $token != ""){
	$conn = @new mysqli($db_server, $db_username, $db_userpassword, $db_name);
	if ($conn->connect_error) {
		$additionalInfo = "Fallo en la conexión a la base de datos en la clase auth.php línea 56. Comprueba las credenciales de la base de datos y que el servidor esté funcionando correctamente. Error específico: " . $conn->connect_error;
		$errorLogger = new ErrorLogger();
		$errorLogger->logErrorToFile('errors.txt', "Error de conexión a la base de datos", $additionalInfo);
		die("Ha ocurrido un error al intentar conectar a la base de datos.");
	}
	mysqli_set_charset($conn, 'utf8');
	$sql = "SELECT NOMBRE, APELLIDOS, TELEFONO, EMAIL, FOTO, TOKEN, PROVIDER, SUSCRIPCION, FINSUSCRIPCION, STRIPECLIENTE, PERMISOS, VISUALIZACION, FECHAPIDEDATOS, IDIOMA, IDIOMA2 FROM USUARIOS WHERE CODIGO='$codigousuario' AND TOKEN ='$token'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	if ($result->num_rows > 0) {
	  	$nombre_usuario			= $row["NOMBRE"];
	    $apellidos_usuario		= $row["APELLIDOS"];
	    $telefono_usuario		= $row["TELEFONO"];
	    $email_usuario  		= $row["EMAIL"];
		$foto_usuario			= $row["FOTO"];
	    $token_usuario  		= $row["TOKEN"];
		$provider_usuario		= $row["PROVIDER"];
	    $suscripcion_usuario 	= $row["SUSCRIPCION"];
		$fin_suscripcion_usuario = $row["FINSUSCRIPCION"];
		$stripe_id_usuario		= $row["STRIPECLIENTE"];
		$check_usuario			= $row["PERMISOS"];
	    $visualizacion_usuario  = $row["VISUALIZACION"];
		$pidedatos_usuario		= $row["FECHAPIDEDATOS"];
	    $idioma_usuario  		= $row["IDIOMA"];
	    $idioma2_usuario  		= $row["IDIOMA2"];	    	    	    	    	    	    
	    $auth = 1;
		// Control para recarga de web después de un login en contenido de pago
		if (isset($_COOKIE['cliente'])) {
			$cliente = $_COOKIE['cliente'];
			// use $cliente variable as needed
		  } 
		//$cliente = $_COOKIE['cliente'];

		$cliente = '';
		if ($cliente == "1" && $nombre_usuario!= "Imageener") { 
			if ($email_usuario!=NULL){
				setcookie("cliente", "2", time() + (86400 * 360), "/"); 
			}else{
				setcookie("cliente", "3", time() + (86400 * 360), "/"); 
			}
		}else{
			if ($cliente == "4" && $nombre_usuario!= "Imageener" && $suscripcion_usuario== "1"){
				setcookie("cliente", "5", time() + (86400 * 360), "/"); 
			}else{
				setcookie("cliente", "0", time() + (86400 * 360), "/"); 
			}
		}

		// Miramos a ver si ha caducado el Premium
		if (!empty($fin_suscripcion_usuario)) {
			$ahora = new DateTime();
			$fecha_fin = new DateTime($fin_suscripcion_usuario);
			if ($ahora > $fecha_fin) {
				$fin_suscripcion_usuario	= NULL;
				$suscripcion_usuario 		= 1;
				$sql = "UPDATE USUARIOS SET SUSCRIPCION ='1', FINSUSCRIPCION = NULL WHERE CODIGO='$codigousuario'";
				print_log("\nSQL: ".$sql);
				$result = $conn->query($sql);
				if($result) {
					print_log("\nÉxito");
				}
				else {
					print_log("\nError SQL: ".$conn->error);
				}     
			}
		}
	}else{
		$codigousuario = "";
	    $auth = 0;  	
	}
	$conn->close();	 	
}
?>
