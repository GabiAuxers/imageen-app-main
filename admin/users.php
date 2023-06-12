<?php include 'conexion.php';
include 'functions.php';
include "auth.php";

if ($auth == 1){
	$opc = 4;

	$u = $_GET["u"]; // código usuario
	$v = $_GET["v"]; // verificado
	$s = $_GET["s"]; // suscripción
	$z = $_GET["z"]; // visualización
	$i = $_GET["i"]; // idioma		

	$filtro = "";

	if ($v != ""){ 
		$filtro = " WHERE VERIFICADO = '$v'";
	}
	
	if ($s != ""){
		$filtro = " WHERE SUSCRIPCION ='$s'";
	}

	if ($z != ""){
		$filtro = " WHERE VISUALIZACION ='$z'";
	}

	if ($i != ""){
		$filtro = " WHERE IDIOMA = '$i'";
	}

?>
	<!DOCTYPE html>
	<html lang="es">
		<head>
			<? include "head.html"; ?>
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
				include "sidebar.php" ?>

				<div class="app-sidebar-bg"></div>
				<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a></div>
				<!-- END #sidebar -->
				
				<!-- BEGIN #content -->
				<div id="content" class="app-content">
					
					<!-- BEGIN panel -->
					<div class="panel panel-inverse">
						<div class="panel-heading">
							<h4 class="panel-title">Usuarios</h4>
						</div>
						<div class="panel-body">
							<?if ($u == ""){ ?>	
			           			<div class="table-responsive">
									<table id="data-table-default" class="table table-striped table-bordered align-middle">
										<thead>
											<tr>
												<th>Alta</th>
												<th>Código</th>
												<th>Nombre / Apellidos</th>
												<th>Teléfono</th>
												<th>Email</th>
												<th>Suscripción</th>
												<th>Idioma</th>
												<th>Acciones</th>
											</tr>
										</thead>
										<tbody>		
											<?$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
											mysqli_set_charset($conn, 'utf8');
											$sql ="SELECT CODIGO, NOMBRE, APELLIDOS, TELEFONO, EMAIL, FECHAALTA, HORAALTA, SUSCRIPCION, IDIOMA FROM USUARIOS ".$filtro." ORDER BY ID DESC";
											$result = $conn->query($sql);
											if ($result->num_rows > 0) {?>
												<?while($row = mysqli_fetch_array($result) ) {				
										  			$codigousuario 		= $row[0];
										  			$nombreusuario		= $row[1];
													$apellidosusuario	= $row[2];
													$telefonousuario 	= $row[3];
													$emailusuario   	= $row[4];
										  			$fechaaltausuario	= $row[5];
										  			$horaaltausuario   	= $row[6];
										  			$suscripcionusuario = $row[7];
										  			$idiomausuario 		= $row[8];
										    		?>  
													<tr>
														<td><?=$fechaaltausuario?><br><?=$horaaltausuario?></td>
														<td><?=$codigousuario?></td>
														<td><?=$nombreusuario?> / <?=$apellidosusuario?></td>
														<td><?=$telefonousuario?></td>
														<td><?=$emailusuario?></td>
														<td><?=get_access_type($suscripcionusuario)?></td>
														<td><img src="imagenes/<?=give_me_flag($idiomausuario)?>"></td>
														<td></td>
													</tr>
												<?}
											}else{ ?>
		    									<tr>
													<td colspan="8">No hay registros</td>
												</tr>	
											<?}
											$conn->close();?>															
										</tbody>
									</table>											
								</div>
							<? } ?>	
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

			<? include "js.php" ;?>

		</body>
	</html>
<? }else{ 

	header ("Location: default.php");   

}?>