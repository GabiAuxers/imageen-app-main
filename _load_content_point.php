<?php
include 'conexion.php';
include 'literal.php';
include 'functions.php';
include 'auth.php';

if ($_SERVER['SERVER_NAME']=="localhost") $ruta_admin="../admin";
else $ruta_admin="https://admin.imageen.net";

$p				= $_POST["codigo"];

$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
mysqli_set_charset($conn, 'utf8');
$sql = "SELECT NOMBRE, CIUDAD, LOCALIZACION, CLIENTE, IMAGEN FROM PUNTOS WHERE CODIGO ='$p'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if ($result->num_rows > 0) {
  	$nombre_punto 	= $row["NOMBRE"];
    $nombre_ciudad	= $row["CIUDAD"];
    $localizacion   = $row["LOCALIZACION"];	    
    $cliente        = $row["CLIENTE"];
	$imagen			= $row["IMAGEN"];	
}

$sql = "SELECT CODIGO, NOMBRE".$l.", DESCRIPCION".$l.", TIPO, ACCESO, INSTRUCCIONES".$l.", IMAGEN FROM MATERIALES WHERE PUNTO ='$p' ORDER BY ORDEN";
$result = $conn->query($sql);

if ($result->num_rows > 0) { ?>

	<div class="modal-body p-0 bg-white">	
		<!-- Slider principal -->
		<div class="swiper swiper-mat-main">
			<!-- Additional required wrapper -->
			<div class="swiper-wrapper">

				<?
				while($row = mysqli_fetch_array($result) ) {	
					$codigo_material		= $row["CODIGO"];
					$nombre_material		= str_replace("~","'",$row["NOMBRE".$l]);
					$descripcion_material 	= str_replace("~","'",$row["DESCRIPCION".$l]);
					$tipo_material 			= $row["TIPO"];
					$acceso_material        = $row["ACCESO"];
					$instrucciones_material = str_replace("~","'",$row["INSTRUCCIONES".$l]); 
					$imagen_material		= $row["IMAGEN"];
					
					if ($imagen_material) {
						$ruta_imagen = $ruta_admin."/data/materiales/".$imagen_material;
					}
					else {
						$ruta_imagen = $ruta_admin."/data/puntos/".$imagen;
					}

					// Aquí se selecciona la version del mismo idioma que el usuario tiene definido en su perfil
					$carpeta_destino = "";	
					$carpeta_destino2 = "";
					$carpeta_spanish = "";
					$sql2 = "SELECT CODIGO, IDIOMA, CARPETA FROM VERSIONES WHERE PUNTO ='$p' AND MATERIAL ='$codigo_material'";
					$result2 = $conn->query($sql2);
					if ($result2->num_rows > 0) { 
						while($row2 = mysqli_fetch_array($result2) ) {	
							$codigo_version 	= $row2["CODIGO"];
							$idioma_version		= $row2["IDIOMA"];
							$carpeta_version 	= $row2["CARPETA"];

							if ($idioma_version == 1){
								$carpeta_spanish = $carpeta_version;
							}	
							if ($idioma_version == $idioma_usuario){
								$carpeta_destino = $carpeta_version;
							}
							if ($idioma_version == $idioma2_usuario){
								$carpeta_destino2 = $carpeta_version;
							}					
						} 
					} 
					
					if ($carpeta_destino == ""){
						if ($carpeta_destino2 != ""){
							$carpeta_destino = $carpeta_destino2;
						}else{
							$carpeta_destino = $carpeta_spanish;
						}
					}?>

					<!-- Slides -->
					<div class="swiper-slide" id="<?=$nombre_punto?>#<?=$nombre_material?>">
						<img src="<?=$ruta_imagen?>" height="100%" width="auto" style="filter: brightness(0.75);">
						<?if ($cliente== ""){?>	
							<button class="aspa-cierre ri-arrow-left-line ri-xl border-0 position-absolute top-0 start-0 m-3 rounded-circle px-0 py-1" data-bs-dismiss="modal"></button>
						<?}else{?>
							<button class="aspa-cierre ri-arrow-left-line ri-xl border-0 position-absolute top-0 start-0 m-3 rounded-circle px-0 py-1" data-bs-dismiss="modal"></button>
						<?php } ?>
						<div class="titulo-POIs position-absolute top-0 start-0 mt-3 ms-5 text-start"><?=$nombre_material?><br><span style="font-size:16px"><?=$nombre_punto?></span></div>
						<div class="position-absolute top-40 start-50 translate-middle">
							<? if ($acceso_material>$suscripcion_usuario && !$capado_apple) {?>
								<?if ($nombre_usuario!="Imageener"){?>
									<div>
										<? if ($acceso_material==2) {?>
											<div class="titulo-POIs" style="font-size:12px"><p><?=getTxt(177,$l)?></p></div>
										<?}else{?>	
											<div class="titulo-POIs" style="font-size:12px"><p><?=getTxt(136,$l)?></p></div>
										<? } ?>
										<?if ($email_usuario!=NULL){?>
											<? if ($acceso_material==2) {?>
												<button type="button" class="btn boton-rojo-POIs" onclick="openMembership5();"><?=getTxt(176,$l)?></button>
											<?}else{?>	
												<!--<button type="button" class="btn boton-rojo-POIs" onclick="openMembership2();"><?=getTxt(129,$l)?></button>-->
												<button type="button" class="btn boton-rojo-POIs" onclick="openMembership7();"><?=getTxt(129,$l)?></button>
											<? } ?>
										<?}else{?>
											<? if ($acceso_material==2) {?>
												<button type="button" class="btn boton-rojo-POIs" onclick="openMembership5();"><?=getTxt(176,$l)?></button>
											<?}else{?>
												<!--<button type="button" class="btn boton-rojo-POIs" onclick="openMembership3();"><?=getTxt(129,$l)?></button>-->
												<button type="button" class="btn boton-rojo-POIs" onclick="openMembership7();"><?=getTxt(129,$l)?></button>
											<? } ?>
										<? } ?>
									</div>
								<?}else{?>
									<div>
										<? if ($acceso_material==2) {?>
											<div class="titulo-POIs" style="font-size:12px"><p><?=getTxt(177,$l)?></p></div>
											<button type="button" class="btn boton-rojo-POIs" onclick="openLogin2();"><?=getTxt(167,$l)?></button>
										<?}else{?>	
											<div class="titulo-POIs" style="font-size:12px"><p><?=getTxt(136,$l)?></p></div>
											<button type="button" class="btn boton-rojo-POIs" onclick="openLogin();"><?=getTxt(167,$l)?></button>
										<? } ?>
									</div>
								<? } ?>
							<? } else {?>
								<i href="#" style="color: rgba(255,255,255,0.75);" class="ri-play-mini-line ri-7x" onclick="addWatch('<?=$p?>','<?=$codigo_material?>','<?=$codigo_version?>','<?=$carpeta_destino?>','<?=$l?>', '<?=$nombre_usuario?>', '<?=$instrucciones_material?>', '<?=$nombre_punto?>#<?=$nombre_material?>', '<?=$acceso_material?>')"></i>
							<? } ?>
						</div>
						<div class="position-absolute bottom-0 w-100">
							<? if ($acceso_material>1 && !$capado_apple) {
								//acceso premium sin boton google
							} else { ?>
							<div class="d-flex flex-row justify-content-center">
								<?if ($localizacion != ""){?>
									<a href="<?=$localizacion?>" class="btn boton-azul-POIs m-1"><i class="ri-map-pin-2-line ri-xl align-middle"></i> Google Maps</a>
								<? } ?>
							</div>
							<? } ?>
							<?$punto=str_replace(" ","_",$nombre_punto);?>
							<?$material=str_replace(" ","_",$nombre_material);?>
							<? if ($acceso_material>1 && !$capado_apple) {?>
								<div class="d-flex flex-row justify-content-center">
									<div class="btn boton-azul-POIs m-1">
										<div class="mx-auto text-center">
											<!--Inicio Evitado de compartir codigo material premium
											<a href="https://www.facebook.com/sharer.php?u=https://app.imageen.net/contents.php?%26utm_source=reenv%26utm_medium=reenv%26utm_campaign=reenv_Facebook_<?=$punto?>_<?=$material?>_Premium" style="text-decoration:none; color:rgba(255,255,255,1);" class="ri-facebook-circle-fill ri-2x" target="_blank"> </a>
											<a href="https://api.whatsapp.com/send?text=Revive%20la%20historia%20con%20Imageen%20https://app.imageen.net/contents.php?%26utm_source=reenv%26utm_medium=reenv%26utm_campaign=reenv_WhatsApp_Premium<?=$punto?>_<?=$material?>_Premium" style="text-decoration:none; color:rgba(255,255,255,1);" class="ri-whatsapp-fill ri-2x"></a>
											<a href="https://www.linkedin.com/shareArticle?mini=true&url=https://app.imageen.net/contents.php?%26utm_source=reenv%26utm_medium=reenv%26utm_campaign=reenv_LinkedIn_<?=$punto?>_<?=$material?>_Premium&title=Revive%20la%20historia%20con%20Imageen&title=Revive%20la%20historia%20con%20Imageen" style="text-decoration:none; color: rgba(255,255,255,1);" class="ri-linkedin-box-fill ri-2x"></a>
											<a href="https://twitter.com/intent/tweet?text=Revive la historia con Imageen&url=https://app.imageen.net/contents.php?%26utm_source=reenv%26utm_medium=reenv%26utm_campaign=reenv_Twitter_<?=$punto?>_<?=$material?>&hashtags=CompartiendoImaggen_Premium" style="text-decoration:none; color: rgba(255,255,255,1);" class="ri-twitter-fill ri-2x"></a>
											Fin Evitado de compartir codigo material premium-->
											<h6><?=getTxt(161,$l)?></h6>
											<a href="https://www.facebook.com/sharer.php?u=https://app.imageen.net/contents.php?m=<?=$codigo_material?>%26utm_source=reenv%26utm_medium=reenv%26utm_campaign=reenv_Facebook_<?=$punto?>_<?=$material?>" style="text-decoration:none; color:rgba(255,255,255,1);" class="ri-facebook-circle-fill ri-2x"></a>
											<a href="https://api.whatsapp.com/send?text=Revive%20la%20historia%20con%20Imageen%20https://app.imageen.net/contents.php?m=<?=$codigo_material?>%26utm_source=reenv%26utm_medium=reenv%26utm_campaign=reenv_WhatsApp_<?=$punto?>_<?=$material?>" style="text-decoration:none; color:rgba(255,255,255,1);" class="ri-whatsapp-fill ri-2x"></a>
											<a href="https://www.linkedin.com/shareArticle?mini=true&url=https://app.imageen.net/contents.php?m=<?=$codigo_material?>%26utm_source=reenv%26utm_medium=reenv%26utm_campaign=reenv_LinkedIn_<?=$punto?>_<?=$material?>&title=Revive%20la%20historia%20con%20Imageen" style="text-decoration:none; color: rgba(255,255,255,1);" class="ri-linkedin-box-fill ri-2x"></a>
											<a href="https://twitter.com/intent/tweet?text=Revive la historia con Imageen&url=https://app.imageen.net/contents.php?m=<?=$codigo_material?>%26utm_source=reenv%26utm_medium=reenv%26utm_campaign=reenv_Twitter_<?=$punto?>_<?=$material?>&hashtags=CompartiendoImaggen" style="text-decoration:none; color: rgba(255,255,255,1);" class="ri-twitter-fill ri-2x"></a>
											<!--TODO: Prueba de copiado
											<button type="button" class="btn boton-azul-POIs m-1" onclick="copiarPortapapeles();">Copiar texto</button>
											<button onclick="myFunction()">Copy text</button>-->
											<?if ($localizacion != ""){?>	
												<a href="<?=$localizacion?>" style="text-decoration:none; color: rgba(255,255,255,1);" class="ri-map-pin-fill ri-2x"></a>
											<? } ?>
										</div >
									</div>
								</div>
							<? } else { ?>
								<div class="d-flex flex-row justify-content-center">
									<div class="btn boton-azul-POIs m-1">
										<div class="mx-auto text-center">
										<h6><?=getTxt(161,$l)?></h6>
											<a href="https://www.facebook.com/sharer.php?u=https://app.imageen.net/contents.php?m=<?=$codigo_material?>%26utm_source=reenv%26utm_medium=reenv%26utm_campaign=reenv_Facebook_<?=$punto?>_<?=$material?>" style="text-decoration:none; color:rgba(255,255,255,1);" class="ri-facebook-circle-fill ri-2x"></a>
											<a href="https://api.whatsapp.com/send?text=Revive%20la%20historia%20con%20Imageen%20https://app.imageen.net/contents.php?m=<?=$codigo_material?>%26utm_source=reenv%26utm_medium=reenv%26utm_campaign=reenv_WhatsApp_<?=$punto?>_<?=$material?>" style="text-decoration:none; color:rgba(255,255,255,1);" class="ri-whatsapp-fill ri-2x"></a>
											<a href="https://www.linkedin.com/shareArticle?mini=true&url=https://app.imageen.net/contents.php?m=<?=$codigo_material?>%26utm_source=reenv%26utm_medium=reenv%26utm_campaign=reenv_LinkedIn_<?=$punto?>_<?=$material?>&title=Revive%20la%20historia%20con%20Imageen" style="text-decoration:none; color: rgba(255,255,255,1);" class="ri-linkedin-box-fill ri-2x"></a>
											<a href="https://twitter.com/intent/tweet?text=Revive la historia con Imageen&url=https://app.imageen.net/contents.php?m=<?=$codigo_material?>%26utm_source=reenv%26utm_medium=reenv%26utm_campaign=reenv_Twitter_<?=$punto?>_<?=$material?>&hashtags=CompartiendoImaggen" style="text-decoration:none; color: rgba(255,255,255,1);" class="ri-twitter-fill ri-2x"></a>		
											<!--<?if ($localizacion != ""){?>	
												<a href="<?//=$localizacion?>" style="text-decoration:none; color: rgba(255,255,255,1);" class="ri-map-pin-fill ri-2x"></a>
											<? } ?>-->
										</div >
									</div>
								</div>	
							<? } ?>
							<div class="texto-POIs m-2 text-start"><?=$descripcion_material?></div>
							<div class="texto-tipo-acceso-POIs d-flex">
								<i class="ri-live-line ri-xl align-middle me-1"></i>
								<div><?=dame_tipo_material($tipo_material,$l);?></div>
								<div class="ms-auto"><?=dame_tipo_acceso($acceso_material);?></div>
							</div>
						</div>
					</div>
				<? } ?>
			</div>
		</div>
		<div>
			<div class="p-1 ms-2" style="font-family: Poppins; font-weight: bold; font-size: 10px;"><?=getTxt(173,$l)?> <?=$nombre_punto?></div>
			<div class="swiper swiper-mat-thum ms-2">
				<!-- Additional required wrapper -->
				<div class="swiper-wrapper">
					<?
					mysqli_data_seek($result, 0);
					while($row = mysqli_fetch_array($result) ) {	
						$nombre_material		= str_replace("~","'",$row["NOMBRE".$l]);
						$imagen_material		= $row["IMAGEN"];
						
						if ($imagen_material) {
							$ruta_imagen = $ruta_admin."/data/materiales/".$imagen_material;
						}
						else {
							$ruta_imagen = $ruta_admin."/data/puntos/".$imagen;
						} ?>

						<!-- Slides -->
						<div class="swiper-slide flex-column justify-content-start">
							<div class="position-relative" style="height: 70%;">
								<img src="<?=$ruta_imagen?>" style="border-radius:5px;">
								<i style="color: rgba(255,255,255,0.75);" class="ri-play-mini-line ri-2x position-absolute top-50 translate-middle"></i>
							</div>
							<div style="font-family: Poppins; font-size: 10px;"><?=$nombre_material?></div>
						</div>
					<? } ?>

				</div>

			</div>
		</div>

	</div>

<?}
$conn->close();?>


<script>

function myFunction() {

// Copy the text inside the text field
navigator.clipboard.writeText("holasino");

}

swiper = new Swiper('.swiper-mat-thum', {
        spaceBetween: 10,
        slidesPerView: 3.5,
        freeMode: true,
        watchSlidesProgress: true,
});

swiper2 = new Swiper('.swiper-mat-main', {
	// Optional parameters
	//direction: 'vertical',
	//loop: true,
  
	// If we need pagination
	pagination: {
	  el: '.swiper-pagination',
	},
  
	thumbs: {
          swiper: swiper,
    },
  });


gtag('event', 'page_view', {'page_title': swiper2.slides[swiper2.realIndex].id, 'page_location': '/loadContent/'+swiper2.slides[swiper2.realIndex].id});


swiper2.on('slideChange', function(){
	gtag('event', 'page_view', {'page_title': swiper2.slides[swiper2.realIndex].id, 'page_location': '/loadContent/'+swiper2.slides[swiper2.realIndex].id});

});

</script>		
