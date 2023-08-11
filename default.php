<?php include 'conexion.php';
include 'literal.php';
include 'functions.php';
include 'auth.php';

if ($auth == 0) {

	include 'head.php';
	include 'firebaseauth.php';
    if (isset($_SERVER['QUERY_STRING'])) {
        $parametros = $_SERVER['QUERY_STRING'];
    } else {
        $parametros = '';
    }  

?>

	<body onload="loginAnonimo(<?= $l ?>,1);">
		<script>
			//Apertura en la aplicacion o en el navegador por defecto desde el navegador de facebook en los dispositivos Android
			if ((navigator.userAgent.includes("Instagram") || navigator.userAgent.includes("FBAN") || navigator.userAgent.includes("FBAV")) && !navigator.userAgent.includes("iPhone") && !navigator.userAgent.includes("iPad")) {
				document.write("<a target=\"_blank\" href=\"https://app.imageen.net?<?=$parametros?>\" download id=\"open-browser-url\">Un momento. Abriendo en tu navegador por defecto...</a>");
				window.stop();
				let input = document.getElementById('open-browser-url');
				if (input) {
					input.click();
				}
				//window.location.href = "./dummy_bytes.php";
			}
		</script>
		<script src="library.js"></script>
	</body>

	</html>

<?php

} else {
	$parametros = $_SERVER['QUERY_STRING'];
	if ($parametros != "") {
		header("Location: contents.php?" . $parametros);
	} else {
		header("Location: contents.php");
	}
}
?>