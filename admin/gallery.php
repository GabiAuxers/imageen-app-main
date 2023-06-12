<?php include 'conexion.php';
include 'functions.php';
include "auth.php";


if ($auth == 1){

	$opc = 103;

	$i = $_GET["i"]; //icono

	if ($_POST["a"] == 100){

		$codigoicono  = get_item_code(11);
		$nombre = str_replace("'","\'",$_POST["nombre"]);
		$icono = str_replace("'","\'",$_POST["icono"]);		

		$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
		mysqli_set_charset($conn, 'utf8');		
		$sql = "INSERT INTO GALERIA (codigo, nombre, icono) VALUES ('$codigoicono', '$nombre', '$icono')";
		$conn->query($sql);
		$conn->close();	 	
	}

	if ($_POST["a"] == 1000) {

		$id      	= $_POST["id"];
		$nombrex 	= str_replace("'","\'",$_POST["nombrex"]);
		$iconox 	= str_replace("'","\'",$_POST["iconox"]);
		
		$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
		mysqli_set_charset($conn, 'utf8');		
		$sql = "UPDATE GALERIA SET NOMBRE = '$nombrex', ICONO = '$iconox' WHERE CODIGO = '$id'";
		$conn->query($sql);
		$conn->close();	

	} ?>	

	<!DOCTYPE html>
	<html lang="es">
		<head>
			<? include "head.html"; ?>	

			<style>
		 		#sortable1 { list-style-type: none; border-color:#ffffff;background-color:#ffffff;}
		  		#sortable1 li { margin: 5px 5px 5px 5px; padding: 5px; font-size: 1.2em;}   		
			</style>

		</head>
		<body>

			<div id="loader" class="app-loader">
				<span class="spinner"></span>
			</div>

			<div id="app" class="app app-header-fixed app-sidebar-fixed">

				<? include "header.php";
				include "sidebar.php"; ?>

				<div class="app-sidebar-bg"></div>
				<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a></div>

				<div id="content" class="app-content">

					<div class="panel panel-inverse">
						<div class="panel-heading">
							<h4 class="panel-title">Gestión iconos</h4>
							<div class="panel-heading-btn">
								<a href="#add-option"  data-bs-toggle="modal" class="btn btn-xs btn-icon btn-success" ><i class="fas fa-plus"></i></a>
							</div>  							
						</div>
						<div class="panel-body">
							<?if ($i == "" || is_null($i)){ ?>							
			           			<div class="table-responsive">
									<table class="table" class="table table-striped table-bordered table-td-valign-middle">
										<thead>
											<tr>
												<th>Código</th>
												<th>Nombre</th>
												<th>Acciones</th>
											</tr>
										</thead>
										<tbody>
											<?$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
											mysqli_set_charset($conn, 'utf8');
											$sql = "SELECT CODIGO, NOMBRE FROM GALERIA";
											$result = $conn->query($sql);
											if ($result->num_rows > 0) {
												while($row = $result->fetch_assoc()) { 
										  			$codigoicono   = $row["CODIGO"];
										  			$nombreicono   = $row["NOMBRE"];?>  
													<tr>
														<td><?=$codigoicono?></td>
														<td><?=$nombreicono?></td>
														<td><a href="gallery.php?i=<?=$codigoicono?>" class="btn btn-xs btn-info" title="Gestionar icono"><i class="fas fa-edit"></i></a>
														</td>
													</tr>
												<?}
											}else{ ?>
		    									<tr>
													<td colspan="3">No hay registros</td>
												</tr>	
											<? }
											$conn->close(); ?>
										</tbody>
									</table>
								</div>	

							<? } else {

								$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);	
								mysqli_set_charset($conn, 'utf8');
								$sql = "SELECT CODIGO, NOMBRE, ICONO FROM GALERIA WHERE CODIGO = '$i'";
								$result = $conn->query($sql);		
								$row = $result->fetch_assoc();
								if ($result->num_rows > 0) {
									$codigoiconox	= $row["CODIGO"];									
									$nombreiconox	= $row["NOMBRE"];
									$imageniconox	= $row["ICONO"];
								}
								$conn->close(); ?> 

								<form class="form-horizontal" name="gestformx" id="gestformx" method="post" action="gallery.php">
									<input type="hidden" name="a" value="1000">
									<input type="hidden" name="id" id="id" value="<?=$codigoiconox?>">
			                           <div class="form-group"> 		                            	
			                            <label class="col-md-3 control-label">Nombre <span class="text-red">*</span></label>
			                            <div class="col-md-4">
			                                <input type="text" class="form-control" name="nombrex" id="nombrex" value ="<?=$nombreiconox?>" required/>
			                            </div>
			                            <label class="col-md-3 control-label mt-2">Archivo <span class="text-red">*</span></label>
			                            <div class="col-md-4">
			                                <input type="text" class="form-control" name="iconox" id="iconox" value ="<?=$imageniconox?>" required/>
			                            </div>			                                                          
			                        </div>                                               
			                        <div class="modal-footer">
										<a href="gallery.php" class="btn btn-sm btn-white" data-bs-dismiss="modal">Cancelar</a>
										<button type="submit" class="btn btn-sm btn-success">Guardar</button>
									</div>
			                    </form>		

		                	<? } ?>
						</div>
					</div>
				</div>

				<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>

			</div>

			<div class="modal fade" id="add-option">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Alta de Icono</h4>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" name="gestform" id="gestform" method="post" action="gallery.php">
								<input type="hidden" name="a" value="100">
	                            <div class="form-group">
	                                <label class="col-md-3 control-label">Nombre <span class="text-red">*</span></label>
	                                <div class="col-md-12">
	                                    <input type="text" class="form-control" name="nombre" id="nombre" required/>
	                                </div>
	                                <label class="col-md-3 control-label">Archivo <span class="text-red">*</span></label>
	                                <div class="col-md-12">
	                                    <input type="text" class="form-control" name="icono" id="icono" required/>
	                                </div>	                                
	                            </div>                                               
	                            <div class="modal-footer">
									<a href="gallery.php" class="btn btn-sm btn-white" data-bs-dismiss="modal">Cancelar</a>
									<button type="submit" class="btn btn-sm btn-success">Guardar</button>
								</div>
	                        </form>
						</div>
					</div>
				</div>
			</div>	
	

			<? include "js.php"; ?>

		</body>
	</html>
<? } else { 
	header ("Location: default.php");   	
}
?>