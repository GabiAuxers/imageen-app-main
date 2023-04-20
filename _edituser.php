<?php include 'conexion.php';
include 'literal.php';
include 'functions.php';
include 'auth.php';

// [MYSQL] - UPDATE USUARIOS (NOMBRE, APELLIDOS, EMAIL, TELEFONO, STRIPCLIENTE,
// 							  PERMISOS, FECHADATOSPERSO)  TABLE - 03/03/2023
if ($auth == 1){
	
	$nombre_usuario		=  $_POST["nombre"];
	$apellidos_usuario 	=  $_POST["apellidos"];
	$telefono_usuario	=  $_POST["telefono"];
	if ($email_usuario != $_POST["email"]) {
		$email_usuario		=  $_POST["email"];
		$stripe_id_usuario		= NULL;
	}
	$check_usuario = $_POST["check"];

	$ahora = new DateTime();
	$fecha_actualiza = $ahora->format('Y-m-d H:i:s');

	$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
	mysqli_set_charset($conn, 'utf8');
	$sql = "UPDATE USUARIOS SET NOMBRE ='$nombre_usuario', APELLIDOS ='$apellidos_usuario', EMAIL ='$email_usuario', TELEFONO = '$telefono_usuario', STRIPECLIENTE = '$stripe_id_usuario', PERMISOS = $check_usuario, FECHADATOSPERSO = '$fecha_actualiza' WHERE CODIGO = '$codigousuario' AND TOKEN ='$token_usuario'";
	$conn->query($sql);
	$conn->close();			
}
?>