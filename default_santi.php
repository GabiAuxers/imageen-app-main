<?php include 'dao/conexion.php';
include 'literal.php';
include 'functions.php';
include 'auth.php';

if ($auth == 0) {

	include 'head.php';
	$parametros = $_SERVER['QUERY_STRING'];


?>

	<body onload="loginAnonimo(<?= $l ?>,1);">
		<script>
			if ((navigator.userAgent.includes("Instagram") || navigator.userAgent.includes("FBAN") || navigator.userAgent.includes("FBAV")) && !navigator.userAgent.includes("iPhone") && !navigator.userAgent.includes("iPad")) {
				document.write("<a target=\"_blank\" href=\"https://app.imageen.net?<?=$parametros?>\" download id=\"open-browser-url\">Un momento. Redirigiendo al navegador...</a>");
				window.stop();
				let input = document.getElementById('open-browser-url');
				if (input) {
					input.click();
				}
				//window.location.href = "./dummy_bytes.php";
			}
			if ((navigator.userAgent.includes("Instagram") || navigator.userAgent.includes("FBAN") || navigator.userAgent.includes("FBAV")) && (navigator.userAgent.includes("iPhone") || navigator.userAgent.includes("iPad"))) {				
				//location.reload();
				if( isset( $_COOKIE['facebook']) ) { 
					//echo "<p>La cookie ha sido creada</p>"; 
				} else { 
					setcookie("facebook", 1, time() + (86400 * 360), "/"); 
					location.reload();//refrescamos la página
				}
			}
		</script>
		<script src="library.js"></script>
	</body>

	</html>

<?php

} else {
	if ($parametros != "") {
		header("Location: contents.php?" . $parametros);
	} else {
		header("Location: contents.php");
	}
}
?>