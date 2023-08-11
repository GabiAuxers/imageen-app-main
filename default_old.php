<?php include 'dao/conexion.php';
include 'literal.php';
include 'functions.php';
include 'auth.php';

$l = $_GET["l"];
$v = $_GET["v"];


if ($auth == 0) {

	if ($l == ""){
		$l= 1;
	}
	include 'head.php';
	include 'firebaseauth.php';

	if (!$capado_apple) {
		$imagen_splash = './imagenes/romano.png';
		$romano1_class = 'romano1';
		$romano2_class = 'romano2';
	}
	else {
		$imagen_splash = './imagenes/pelea.png';
		$romano1_class = 'pelea1';
		$romano2_class = 'pelea2';
	}

?>

  	<body onload="onLoadDefault();">
	  	<script>
            if((navigator.userAgent.includes("Instagram") || navigator.userAgent.includes("FBAN") || navigator.userAgent.includes("FBAV")) && !navigator.userAgent.includes("iPhone") && !navigator.userAgent.includes("iPad")){
				document.write("<a target=\"_blank\" href=\"https://app.imageen.net\" download id=\"open-browser-url\">Un momento. Redirigiendo al navegador...</a>");
				window.stop();
				let input = document.getElementById('open-browser-url');
				if (input) {
					input.click();
				}
                //window.location.href = "./dummy_bytes.php";
            }
        </script>    
		<main class="imageen-wpa">	

			<div id="pantallaInicial1">	

				<?  $strLogoCiudad = NULL;
					if ($v != '' || !is_null($v)) $strLogoCiudad = get_logo_city($v);
					if ($strLogoCiudad) { ?>
					<div>
						<img src="./imagenes/logo inicial.png" style="width: 50%; margin: auto; padding-bottom: 2vh; display: block; max-width: 170px;">
					</div>
					<div>
						<img src="https://admin.imageen.net/data/ciudades/<?=$strLogoCiudad?>" style="width:33%; margin:auto; padding-bottom: 2vh; display:block; max-width:113px;">
					</div>
				<?	}  else { ?>
					<div>
						<img src="./imagenes/logo inicial.png" style="width: 50%; margin: auto; padding-bottom: 6vh; display: block; max-width: 170px;">
					</div>
				<?	} ?>

				<div class="<?=$romano1_class?>">
					<img src="<?=$imagen_splash?>" style="width: 100%; display: block; max-width: 300px;">
				</div>
				<div class="entradaDeck d-flex flex-column justify-content-evenly text-center">
					<div>
						<button id="botonIniciarSesion" type="button" class="btn boton-principal p-2"  style="margin-top: 7vh;">
							<span id="spinnerBotonIniciarSesion" style="display:none;" class="spinner-border spinner-border-sm"></span>
							<span id="textoBotonIniciarSesion"><?=getTxt(1,$l)?></span>
						</button>
					</div>
					<div id="banderaSeleccionada" style="display: flex; justify-content: center; margin-top: 7vh;">
							<img src='<?=give_me_flag($l)?>' width=42px class="bandera-seleccionada">
							<img src="imagenes/arrow-down-s-line.svg" width=initial>	
					</div>
					<div class="row" id="menuBanderas" style="display: none; justify-content: center; margin-top: 4vh;">
						<div class="caja-banderas position-relative" style="display:flex; align-items: center; justify-content: space-evenly">
							<a href="default.php?l=1&v=<?=$v?>"> <img src='<?=give_me_flag(1)?>'  class="<?=(($l==1)?'bandera-seleccionada':'bandera');?>"></a>
							<a href="default.php?l=2&v=<?=$v?>"> <img src='<?=give_me_flag(2)?>'  class="<?=(($l==2)?'bandera-seleccionada':'bandera');?>"></a>
							<a href="default.php?l=3&v=<?=$v?>"> <img src='<?=give_me_flag(3)?>'  class="<?=(($l==3)?'bandera-seleccionada':'bandera');?>"></a>	
							<a href="default.php?l=4&v=<?=$v?>"> <img src='<?=give_me_flag(4)?>'  class="<?=(($l==4)?'bandera-seleccionada':'bandera');?>"></a>
							<span id="botonCierraBanderas" class="position-absolute top-0 start-100 translate-middle rounded-circle bg-white">
    							<img src="imagenes/close-line.svg">
 							</span>
						</div>
					</div>
				</div>
			</div>

			
			<div id="pantallaInicial2" style="display:none">	
				<div>
					<img src="./imagenes/logo inicial.png" style="width: 35%; margin: auto; display: block; max-width: 120px;">
				</div>
				<div class="<?=$romano2_class?>">
					<img src="<?=$imagen_splash?>" style="width: 66%; display: block; max-width: 200px;">
				</div>
				<div class="loginDeck vstack">	

					<div class="text-center mt-4">
						<span class="texto-titulo font-weight-bold"><?=getTxt(1,$l)?></span>
					</div>	

					<div id="firebaseui-auth-container"></div>
					<div id="loader">Loading...</div>
				</div>
			</div>

		</main> 

		<? include 'js.php';
		   include 'footer.php';?>

		<script>
			$('#botonIniciarSesion').click(function(){
				ui.start('#firebaseui-auth-container', uiConfig);
				$('#pantallaInicial1').fadeOut();
				$('#pantallaInicial2').fadeIn();
				$('#divLogin').show();
			});

			$('#botonCierraBanderas').click(function(){
				$('#menuBanderas').hide();
				$('#banderaSeleccionada').show();
			});

			$('#banderaSeleccionada').click(function(){
				$('#menuBanderas').show();
				$('#banderaSeleccionada').hide();
			});

		</script>
  	</body>
</html>

<?php
}
else{
	$parametros = $_SERVER['QUERY_STRING'];
	if ($parametros != "") {
		header ("Location: contents.php?".$parametros);
	}
	else {
 		header ("Location: contents.php");
	}
}

?>	
