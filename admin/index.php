<? include "conexion.php";
include "functions.php";
include "auth.php";

if ($auth == 1){

	$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
	mysqli_set_charset($conn, 'utf8');
	$sql = "SELECT SUSCRIPCION, IDIOMA, VERIFICADO, VISUALIZACION FROM USUARIOS";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {

		$tiposuscripcion1 = 0;										
		$tiposuscripcion2 = 0;
		$tiposuscripcion3 = 0;
		$idioma1 = 0;
		$idioma2 = 0;
		$idioma3 = 0;
		$idioma4 = 0;
		$verificado0 = 0;
		$verificado1 = 0;
		$visualizacionlistado = 0;
		$visualizacionmapa = 0;
		$usuariosregistrados = 0;
		while($row = mysqli_fetch_array($result) ) {			
			++$usuariosregistrados;
			$suscripcion 	= $row["SUSCRIPCION"];
			$idioma 		= $row["IDIOMA"];
			$verificado		= $row["VERIFICADO"];
			$visualizacion 	= $row["VISUALIZACION"];

			if ($suscripcion == 1){
				++$tiposuscripcion1;
			} elseif ($suscripcion == 2){
				++$tiposuscripcion2;			
			} elseif ($suscripcion == 3){
				++$tiposuscripcion3;
			}

			if ($idioma == 1) {
				++$idioma1;
			} elseif ($idioma2 == 2) {
				++$idioma2;
			} elseif ($idioma == 3) {
				++$idioma3;				
			} elseif ($idioma == 4) {
				++$idioma4;
			}

			if ($verificado == 0){
				++$verificado0;
			} elseif ($verificado == 1){	
				++$verificado1;
			}

			if ($visualizacion == 1){
				++$visualizacionmapa;
			} elseif ($visualizacion == 2){
				++$visualizacionlistado;
			}
  		}
	}
	$conn->close();?>	

	<!DOCTYPE html>
	<html lang="es">
		<head>
			<? include "head.html" ?>
		</head>
		<body>
			<!-- BEGIN #loader -->
			<div id="loader" class="app-loader">
				<span class="spinner"></span>
			</div>
			<!-- END #loader -->
			<!-- BEGIN #app -->
			<div id="app" class="app app-header-fixed app-sidebar-fixed">

				<? include "header.php";
				include "sidebar.php"; ?>

				<div class="app-sidebar-bg"></div>
				<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a></div>
				<!-- END #sidebar -->
				
				<!-- BEGIN #content -->
				<div id="content" class="app-content">
					
					<!-- BEGIN panel -->
					<div class="panel panel-inverse">
						<div class="panel-heading">
							<h4 class="panel-title">Dashboard</h4>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-xl-2 col-md-4">
									<div class="widget widget-stats bg-gray">
										<div class="stats-icon"><i class="fa fa-users"></i></div>
										<div class="stats-info">
											<h4 class="text-grayk">USUARIOS REGISTRADOS</h4>
											<p class="text-white"><?=$usuariosregistrados?></p>	
										</div>
										<div class="stats-link">
											<a href="users.php">Ver detalle <i class="fa fa-arrow-alt-circle-right"></i></a>
										</div>
									</div>
								</div>
								<div class="col-xl-2 col-md-4">
									<div class="widget widget-stats bg-gray">
										<div class="stats-icon"><i class="fa fa-users"></i></div>
										<div class="stats-info">
											<h4 class="text-grayk">USUARIOS VERIFICADOS</h4>
											<p class="text-white"><?=$verificado1?></p>	
										</div>
										<div class="stats-link">
											<a href="users.php?v=1">Ver detalle <i class="fa fa-arrow-alt-circle-right"></i></a>
										</div>
									</div>
								</div>	
								<div class="col-xl-2 col-md-4">
									<div class="widget widget-stats bg-gray">
										<div class="stats-icon"><i class="fa fa-users"></i></div>
										<div class="stats-info">
											<h4 class="text-grayk">USUARIOS NO VERIFICADOS</h4>
											<p class="text-white"><?=$verificado0?></p>	
										</div>
										<div class="stats-link">
											<a href="users.php?v=0">Ver detalle <i class="fa fa-arrow-alt-circle-right"></i></a>
										</div>
									</div>
								</div>	
								<div class="col-xl-2 col-md-4">
									<div class="widget widget-stats bg-red">
										<div class="stats-icon"><i class="fa fa-star"></i></div>
										<div class="stats-info">
											<h4 class="text-grayk">PREMIUM</h4>
											<p class="text-white"><?=$tiposuscripcion3?></p>	
										</div>
										<div class="stats-link">
											<a href="users.php?s=3">Ver detalle <i class="fa fa-arrow-alt-circle-right"></i></a>
										</div>
									</div>
								</div>	
								<div class="col-xl-2 col-md-4">
									<div class="widget widget-stats bg-orange">
										<div class="stats-icon"><i class="fa fa-star"></i></div>
										<div class="stats-info">
											<h4 class="text-grayk">CLUB</h4>
											<p class="text-white"><?=$tiposuscripcion2?></p>	
										</div>
										<div class="stats-link">
											<a href="users.php?s=2">Ver detalle <i class="fa fa-arrow-alt-circle-right"></i></a>
										</div>
									</div>
								</div>
								<div class="col-xl-2 col-md-4">
									<div class="widget widget-stats bg-blue">
										<div class="stats-icon"><i class="fa fa-star"></i></div>
										<div class="stats-info">
											<h4 class="text-grayk">FREE</h4>
											<p class="text-white"><?=$tiposuscripcion1?></p>	
										</div>
										<div class="stats-link">
											<a href="users.php?s=1">Ver detalle <i class="fa fa-arrow-alt-circle-right"></i></a>
										</div>
									</div>
								</div>								
							</div>
							<div class="row">
								<div class="col-xl-2 col-md-4">
									<div class="widget widget-stats bg-black-transparent-8">
										<div class="stats-icon"><i class="fa fa-flag"></i></div>
										<div class="stats-info">
											<h4 class="text-white">ESPAÑOL <img src="imagenes/es.png"></h4>
											<p class="text-white"><?=$idioma1?></p>	
										</div>
										<div class="stats-link">
											<a href="users.php?i=1">Ver detalle <i class="fa fa-arrow-alt-circle-right"></i></a>
										</div>
									</div>
								</div>																																				<div class="col-xl-2 col-md-4">
									<div class="widget widget-stats bg-black-transparent-8">
										<div class="stats-icon"><i class="fa fa-flag"></i></div>
										<div class="stats-info">
											<h4 class="text-white">ENGLISH <img src="imagenes/en.png"></h4>
											<p class="text-white"><?=$idioma2?></p>	
										</div>
										<div class="stats-link">
											<a href="users.php?i=2">Ver detalle <i class="fa fa-arrow-alt-circle-right"></i></a>
										</div>
									</div>
								</div>		
								<div class="col-xl-2 col-md-4">
									<div class="widget widget-stats bg-black-transparent-8">
										<div class="stats-icon"><i class="fa fa-flag"></i></div>
										<div class="stats-info">
											<h4 class="text-white">FRANÇAIS <img src="imagenes/fr.png"></h4>
											<p class="text-white"><?=$idioma3?></p>	
										</div>
										<div class="stats-link">
											<a href="users.php?i=3">Ver detalle <i class="fa fa-arrow-alt-circle-right"></i></a>
										</div>
									</div>
								</div>	
								<div class="col-xl-2 col-md-4">
									<div class="widget widget-stats bg-black-transparent-8">
										<div class="stats-icon"><i class="fa fa-flag"></i></div>
										<div class="stats-info">
											<h4 class="text-white">CATALÀ <img src="imagenes/ca.png"></h4>
											<p class="text-white"><?=$idioma4?></p>	
										</div>
										<div class="stats-link">
											<a href="users.php?i=4">Ver detalle <i class="fa fa-arrow-alt-circle-right"></i></a>
										</div>
									</div>
								</div>		
								<div class="col-xl-2 col-md-4">
									<div class="widget widget-stats bg-blue-transparent-4">
										<div class="stats-icon"><i class="fa fa-map-marker-alt"></i></div>
										<div class="stats-info">
											<h4 class="text-white">MAPA</h4>
											<p class="text-white"><?=$visualizacionmapa?></p>	
										</div>
										<div class="stats-link">
											<a href="users.php?z=1">Ver detalle <i class="fa fa-arrow-alt-circle-right"></i></a>
										</div>
									</div>
								</div>	
								<div class="col-xl-2 col-md-4">
									<div class="widget widget-stats bg-blue-transparent-4">
										<div class="stats-icon"><i class="fa fa-list"></i></div>
										<div class="stats-info">
											<h4 class="text-white">LISTADO</h4>
											<p class="text-white"><?=$visualizacionlistado?></p>	
										</div>
										<div class="stats-link">
											<a href="users.php?z=2">Ver detalle <i class="fa fa-arrow-alt-circle-right"></i></a>
										</div>
									</div>
								</div>																																		
							</div>	
						</div>
					</div>
					<!-- END panel -->
				</div>
				<!-- END #content -->
				
				<!-- BEGIN scroll to top btn -->
				<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
				<!-- END scroll to top btn -->
			</div>
			<!-- END #app -->

			<? include "js.php" ?>

		</body>
	</html>
<?
}else{

	header ("Location: default.php");    
}
?>