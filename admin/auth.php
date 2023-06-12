<?
$codigousuario 	= trim($_COOKIE['usuariot']," ");
$token       	= trim($_COOKIE['tokent']," ");
$auth = 0;

if ($codigousuario != "" &&  $token != ""){
	$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
	mysqli_set_charset($conn, 'utf8');
	$sql = "SELECT NOMBRE, APELLIDOS FROM ADMIN WHERE ID='$codigousuario' AND TOKEN ='$token'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	if ($result->num_rows > 0) {
	  	$nombre_usuario		= $row["NOMBRE"];
	    $apellidos_usuario	= $row["APELLIDOS"];    	    	    	    	    	    
	    $auth = 1;	
	}else{
		$codigousuario = "";
	    $auth = 0;  	
	}
	$conn->close();	 
}
?>