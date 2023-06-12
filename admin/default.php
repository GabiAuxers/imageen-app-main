<?php include 'conexion.php';
include 'functions.php';

$e = $_GET["e"];
$ipaddress 	= $_SERVER['REMOTE_ADDR'];

if ($_POST["usuario"] != "" && $_POST["password"] != ""){

    $usuario = $_POST["usuario"];
    $password = $_POST["password"];
  
	$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);	
	mysqli_set_charset($conn, 'utf8');
	$sql = "SELECT ID, NOMBRE, APELLIDOS FROM ADMIN WHERE EMAIL ='$usuario' AND PASSWORD = '$password'";
	$result = $conn->query($sql);		
	$row = $result->fetch_assoc();
	if ($result->num_rows > 0) {
	  	$codigousuario = $row["ID"];
	    $nombreusuario = $row["NOMBRE"];
	    $apellidosusuario = $row["APELLIDOS"];	
	    $errorlogin = 0;    
	}else{
		$codigousuario  = '999999';
		$nombreusuario = '';
	    $apellidosusuario = '';  	
	    $errorlogin = 10;
	}
	$conn->close();	

    if ($errorlogin == 0){

		$dat = date('Y-m-d');
		$tim = date('h:i:sa');
		$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
		$sql = "INSERT INTO ACCESOS (fecha, hora, ip, nombre, usuario, error) VALUES ('$dat', '$tim', '$ipaddress', '$nombreusuario', '$codigousuario', '$errorlogin')";
		$conn->query($sql);
		$conn->close();	

	    $randstring = "alkjsn8748n5y487ycn8aew"; //RandomString(40);
		setcookie("usuariot", $codigousuario, time() + (86400 * 360), "/");     
		setcookie("tokent", $randstring, time() + (86400 * 360), "/");  

		$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
		$sql = "UPDATE ADMIN SET TOKEN = '$randstring' WHERE ID = '$codigousuario'";
		$conn->query($sql);
		$conn->close();		             

		header ("Location: index.php");

    }elseif ($errorlogin == 10) {

		$dat = date('Y-m-d');
		$tim = date('h:i:sa');
		$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
		$sql = "INSERT INTO ACCESOS (fecha, hora, ip, nombre, usuario, error) VALUES ('$dat', '$tim', '$ipaddress', '$nombreusuario', '$codigousuario', '$errorlogin')";
		$conn->query($sql);
		$conn->close();	    	

		header ("Location: default.php?e=1");         

    }

}else{ ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<?include 'head.html';?>
</head>
<body class='pace-top'>
	<!-- BEGIN #loader -->
	<div id="loader" class="app-loader">
		<span class="spinner"></span>
	</div>
	<!-- END #loader -->

	<!-- BEGIN #app -->
	<div id="app" class="app">
		<!-- BEGIN login -->
		<div class="login login-with-news-feed">
			<!-- BEGIN news-feed -->
			<div class="news-feed">
				<div class="news-image" style="background-image: url(imagenes/puerta_sol.jpg)"></div>
				<div class="news-caption">
					<h4 class="caption-title"><b>Imageen</b></h4>
					<p>Panel de Control v1.0</p>
				</div>
			</div>
			<!-- END news-feed -->
			
			<!-- BEGIN login-container -->
			<div class="login-container">
				<!-- BEGIN login-header -->
				<div class="login-header mb-30px">
					<div class="brand">
						<div class="d-flex align-items-center">
							<b>Imageen</b>
						</div>
						<small>Panel de Control 1.0</small>
					</div>
					<div class="icon">
						<i class="fa fa-sign-in-alt"></i>
					</div>
				</div>
				<!-- END login-header -->
				
				<!-- BEGIN login-content -->
				<div class="login-content">
				<div class="login-content">
					<form action="default.php" method="post" class="margin-bottom-0">					
						<div class="form-floating mb-15px">
							<input type="text" id="usuario" name="usuario" class="form-control form-control-lg" placeholder="Email Address" required />
							<label for="usuario" class="d-flex align-items-center fs-13px text-gray-600">Email</label>
						</div>
						<div class="form-floating mb-15oc">
							<input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password" required />
							<label for="password" class="d-flex align-items-center fs-13px text-gray-600">Contraseña</label>							
						</div>
						<div class="login-buttons mt-20px">
							<button type="submit" class="btn btn-success btn-block btn-lg">Acceder</button>
						</div>
                	    <?if (e == 1){ ?>>
            	            <p style="margin-top:10px;padding:5px;color:#f00;background-color:#fff;border-radius:5px;text-align:center;">Usuario o contraseña errónea</p>            
	                    <? } ?> 						
						<hr />
						<p class="text-center text-grey-darker mb-0">
							&copy; 2021 by Imagen en Realidad Aumentada, S.L. <br>All Rights Reserved 
						</p>
					</form>
				</div>
				</div>
				<!-- END login-content -->
			</div>
			<!-- END login-container -->
		</div>
		<!-- END login -->

		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>

	</div>
	
	<!-- ================== BEGIN core-js ================== -->
	<script src="assets/js/vendor.min.js"></script>
	<script src="assets/js/app.min.js"></script>
	<script src="assets/js/theme/facebook.min.js"></script>
	<!-- ================== END core-js ================== -->
</body>
</html>
<? } ?>