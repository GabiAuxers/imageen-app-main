<?php 
include 'dao/conexion.php';
include 'literal.php';
include 'functions.php';
include 'auth.php';

// Added variables - 06/03/2023
$a	= (isset($row["ACCESO"]));


if ($_SERVER['SERVER_NAME']=="localhost") $ruta_admin="../admin";
else $ruta_admin="https://admin.imageen.net";

$u = 0;
switch ($suscripcion_usuario) {
    case 1:
        $u = 1;
        break;
    case 2:
        $u = 2;
        break;
    case 3:
        $u = 3;
        break;
}

if ($auth == 1){	

	//Isset Changes - Modified - 06/03/2023
	$t = isset($_GET["t"]); // Visualization type (solo puede ser 3 -mapa sin localización- o vacío)
	$v = isset($_GET["v"]); // City
	$x = isset($_GET["x"]); // Customer
	$p = isset($_GET["p"]); // Punto Imageen
	$m = isset($_GET["m"]); // Media Imageen
	//
	$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
	//TODO: Solucion para si existe m solo
	if ($m != ""){
		$m2 = str_replace("maplist", "", $m);
		$sql = "SELECT ACCESO FROM MATERIALES WHERE CODIGO='$m2'";
			$result = $conn->query($sql);
		if ($result->num_rows > 0) { 
			$row = mysqli_fetch_array($result);
			//Isset Changes - Modified - 06/03/2023
			$a	= (isset($row["ACCESO"]));
		}else{
			$a = 0;
		}
	}
	
	if ($x != ""){
		//$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
		mysqli_set_charset($conn, 'utf8');
		$sql = "SELECT NOMBRE, IMAGEN, TEXTO1, INICIO FROM CLIENTES WHERE CODIGO ='$x'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		if ($result->num_rows > 0) {
		  	$nombre = $row["NOMBRE"];
		    $imagen = $row["IMAGEN"];
		    $texto  = $row["TEXTO1"];	    
		    $inicio = $row["INICIO"];
		}else{
			$activo = 0;
			$nombre = "n/a";
		    $inicio = 0;  	
		}
		$conn->close();				
	}else{
		$activo = 0;		
	}

}else{
	$parametros = $_SERVER['QUERY_STRING'];
	if ($parametros != "") {
		header ("Location: default.php?".$parametros);
	}
	else {
 		header ("Location: default.php");
	}	
}

include 'head.php';
//include 'firebaseauth.php';
?>

<? if ($x!="" || $visualizacion_usuario == 1) {
	if ($x!="") echo '<script src="'.$ruta_admin.'/ficheros/puntos'.$x.'.xml"></script>';
	else echo '<script src="'.$ruta_admin.'/ficheros/puntosImageen'.$l.'.xml"></script>';
	if ($t==3) {?>
		<body onload="onLoadContents(3, false, '<?=$p?>', '<?=$m?>', '<?=$u?>', '<?=$a?>');">
	<? } else { ?>
		<body onload="onLoadContents(1, false, '<?=$p?>','<?=$m?>', '<?=$u?>', '<?=$a?>');">
	<?}
}
else { ?>
	<body onload="onLoadContents(2, false, '<?=$p?>', '<?=$m?>', '<?=$u?>', '<?=$a?>');">
<? } ?>
		<div id="main">	
			<?if ($visualizacion_usuario == 1 || $x != ""){
				if ($x != "") { ?>
					<div class="container-fluid p-0">
						<div class="bg-dark text-white text-center"><a href="contents.php" style="text-decoration:none;color:white;"><span class="me-2 fs-16px">Cerrar para volver a Imageen</span><i class="ri-close-fill fs-22px me-3"></i></a></div>	
						<div id="map"></div>
					</div>	
				<? }else{ ?>
					<div id="map"></div>
				<? }
			}else{ ?>  
				<div class="m-4">&nbsp;</div>

				<?$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
				mysqli_set_charset($conn, 'utf8');
				$sql = "SELECT CODIGO, NOMBRE FROM CIUDADES WHERE ESTADO = 1 ORDER BY ORDEN ";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					$num_ciudad = 0;
					while($row = mysqli_fetch_array($result) ) {	
						if ($num_ciudad==0 && isset($v)) {
							$codigociudadciclo	= $v;
							$nombreciudadciclo 	= $ciudad;
							mysqli_data_seek($result, 0);
						}
						else {
							if ($v == $row["CODIGO"]) continue;
							$codigociudadciclo	= $row["CODIGO"];
							$nombreciudadciclo 	= $row["NOMBRE"];
						}
						$num_ciudad++; ?>

						<div class="mt-5 text-center">
							<h3><b><?=$nombreciudadciclo?></b></h3>
						</div>

						<?$conn2 = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
						mysqli_set_charset($conn2, 'utf8');
						$sql2 = "SELECT PUNTOS.NOMBRE, CATEGORIA, DESCRIPCION".$l.", PUNTOS.CODIGO, IMAGEN, CLIENTE, GALERIA.ICONO, GALERIA.ICONOG FROM PUNTOS, GALERIA WHERE CIUDAD = '".$codigociudadciclo."' AND (PUNTOS.ICONO = GALERIA.CODIGO)";
						$result2 = $conn2->query($sql2);
						if ($result2->num_rows > 0) {
							$puntos = 0;?>	
							<div class="swiper swiper-ciudades pb-4">
								<div class="swiper-wrapper"> 														
									<?while($row2 = mysqli_fetch_array($result2) ) {	
										$puntos++;		
										$titulopunto 		= $row2["NOMBRE"];
										$categoriapunto		= $row2["CATEGORIA"];
										$descripcionpunto 	= $row2["DESCRIPCION".$l.""];
										$codigopunto  		= $row2["CODIGO"];
										$imagenpunto 		= $row2["IMAGEN"];
										$clientepunto		= $row2["CLIENTE"];
										$icono				= $row2["ICONO"];
										$iconog				= $row2["ICONOG"];
										if ($iconog == NULL) $iconog = $icono;?> 
										<div class="swiper-slide">
											<img class="rounded-10" src="https://admin.imageen.net/data/puntos/<?=$imagenpunto?>">
											<div class="titulo-POIs fs-4 position-absolute top-0 mt-3 px-1 text-start bg-black-transparent-2"><?=$titulopunto?></div>
											<div class="position-absolute bottom-0" style="width:100%;">
												<i style="color: rgba(255,255,255,0.75);" class="ri-play-mini-line ri-3x"></i>
											</div>
											<!--Bypass ventana punto-->
											<?if ($clientepunto== ""){?>	
												<a class="position-absolute w-100 h-100" role="button" href="#contentx" onclick="loadContents({'codigo': '<?=$codigopunto?>', 'nombre': '<?=$titulopunto?>'})"></a>
											<?}else{?>
												<a class="position-absolute w-100 h-100" role="button" href="#pointx" data-bs-toggle="modal" onclick="loadPoint({'codigo': '<?=$codigopunto?>', 'imagen': '<?=$imagenpunto?>', 'cliente': '<?=$clientepunto?>', 'nombre': '<?=$titulopunto?>', 'descripcion': '<?=$descripcionpunto?>', 'icono': '<?=$iconog?>'})"></a>
											<? } ?>
										</div>
									<? } ?>
								</div>
								<div class="swiper-pagination bottom-0"></div>	
							</div>
							<?if ($num_ciudad == $result->num_rows){ ?>
								<div class="row" style="margin-top:120px;">
									<div class="col"></div>
								</div>			
							<? } 
						}else{ ?>
							<div class="row text-center">
								<div class="col-12">
									<p class="fs-14px"><?=getTxt(54,$l)?></p>
								</div>
							</div>
						<? }
						$conn2->close();
					}	  
				}else{ ?>
					<p>No hay ciudades</p>
				<? } 
				$conn->close();?>  
			<? } 
			if ($x== ""){			
				include 'buttons.php';
			}
			include 'js.php';
			include 'footer.php';?>
		</div>

		<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB97Z4gnECGXzhNx4HKOg1vdVUnw-7cIzA&libraries=geometry,places"></script>
		<script>
			
			$(document).ready(function(){
				swiperCiudades = new Swiper('.swiper-ciudades', {
					// Optional parameters
					//direction: 'vertical',
					//loop: true,
				
					// If we need pagination
					pagination: {
						el: '.swiper-pagination',
					},
					effect: 'coverflow',

					centeredSlides: true,
					centeredSlidesBounds: false,

					slidesPerView: 1.25,
					spacebetween: 5,

					breakpoints: {
						// when window width is >= 320px
						330: {
						slidesPerView: 1.5,
						spaceBetween: 5
						},
						// when window width is >= 480px
						495: {
						slidesPerView: 2,
						spaceBetween: 10
						},
						// when window width is >= 640px
						660: {
						slidesPerView: 3,
						spaceBetween: 10
						},
						825: {
						slidesPerView: 4,
						spaceBetween: 15
						}
					}
				
				});
			});
		</script>	 

	</body>
</html>


   

 
