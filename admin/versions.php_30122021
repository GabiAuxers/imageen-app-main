<?php include 'conexion.php';
include 'functions.php';
include "auth.php";

if ($auth == 1){
	$opc = 2;

	$p = $_GET["p"];
	$m = $_GET["m"];


	if ($_POST["a"] == 100){
		$codigoversion = get_item_code(8).RandomString(4);
		$idioma 	= $_POST["idioma"];
		$carpeta	= $_POST['carpeta'];

		$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
		mysqli_set_charset($conn, 'utf8');			
		$sql = "INSERT INTO VERSIONES (codigo, punto, material, idioma, carpeta) VALUES ('$codigoversion', '$p', '$m', '$idioma', '$carpeta')";
		$conn->query($sql);
		$conn->close();	 		
	}	

	if ($_POST["a"] == 1000){

		$idx        = $_POST["idx"];
		$idiomax 	= $_POST["idiomax"];
		$carpetax 	= $_POST["carpetax"];		

		$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
		mysqli_set_charset($conn, 'utf8');			
		$sql = "UPDATE VERSIONES SET IDIOMA = '$idiomax', CARPETA = '$carpetax' WHERE CODIGO = '$idx'";
		$conn->query($sql);
		$conn->close();	

	}

?>

	<!DOCTYPE html>
	<html lang="es">
		<head>
			<? include "head.html"; ?>
			<script>
				function setValues(a,b,c){
					document.gestformx.idx.value = a;
					document.gestformx.idiomax.value = b;
					document.gestformx.carpetax.value = c;	
				}
			</script>	

			<script>			
				function deleVersion(v,p,m){
					var r = confirm("Por favor, confirme que desea eliminar esta versión.");
					if (r == true) {
						var dataString = 'v='+v;
						    $.ajax({
		        		    type: "POST",
		    		        url: "_borraVersion.php",
				            data: dataString,
		            		success: function() {           
		            	    	alert("Versión eliminada")
		            	    	location.href = "versions.php?p="+p+"&m="+m;
		        	    	}
		    	    	});
					}
				}
			</script>								
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
							<h4 class="panel-title">Versiones del material <?=$m?> del punto <?=get_name_point($p)?></h4>
							<div class="panel-heading-btn">
								<a href="#add-version"  data-bs-toggle="modal" class="btn btn-xs btn-icon btn-success" ><i class="fas fa-plus"></i></a>
							</div> 							
						</div>
						<div class="panel-body">
		           			<div class="table-responsive">
								<table id="data-table-default" class="table table-striped table-bordered align-middle">
									<thead>
										<tr>
											<th>ID</th>
											<th>Idioma</th>
											<th>Carpeta</th>
											<th>Acciones</th>
										</tr>
									</thead>
									<tbody>
										<?$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
										mysqli_set_charset($conn, 'utf8');
										$sql = "SELECT CODIGO, IDIOMA, CARPETA FROM VERSIONES WHERE PUNTO = '$p' AND MATERIAL = '$m'";
										$result = $conn->query($sql);
										if ($result->num_rows > 0) {?>
											<?while($row = mysqli_fetch_array($result) ) {				
									  			$codigoversion 	= $row[0];
									  			$idiomaversion	= $row[1];
									  			$carpetaversion	= $row[2];
									    		?>  
												<tr>
													<td><?=$codigoversion?></td>
													<td><img src="imagenes/<?=give_me_flag($idiomaversion)?>"></td>
													<td><?=$carpetaversion?></td>
													<td><a href="#edit-version" data-bs-toggle="modal" onclick="setValues('<?=$codigoversion?>','<?=$idiomaversion?>','<?=$carpetaversion?>')" class="btn btn-xs btn-info"><i class="fas fa-edit"></i></a>
														<a href="#" onclick="deleVersion('<?=$codigoversion?>','<?=$p?>','<?=$m?>')" class="btn btn-xs btn-red ms-1"><i class="fas fa-trash"></i></a>
													</td>
												</tr>
											<?}
										}else{ ?>
	    									<tr>
												<td colspan="4">No hay registros</td>
											</tr>	
										<?}
										$conn->close();?>
									</tbody>
								</table>
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

			<div class="modal fade" id="add-version">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Alta de versión de material</h4>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" name="gestform" id="gestform" method="post" action="versions.php?p=<?=$p?>&m=<?=$m?>">
								<input type="hidden" name="a" value="100">
	                            <div class="form-group">
                             		<label for="idioma" class="col-md-3 control-label mt-2">Idioma <span class="text-red">*</span></label>
	                                <select class="form-control form-select" id="idioma" name="idioma" required>
							           	<option value="">Sin asignar</option>
										<?$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
										mysqli_set_charset($conn, 'utf8');
										$sql ="SELECT CODIGO, NOMBRE FROM IDIOMAS";
										$result = $conn->query($sql);
										if ($result->num_rows > 0) {	
											while($row = mysqli_fetch_array($result) ) { ?>
												<option value="<?=$row[0]?>"><?=$row[1]?></option>
											<? } 
										}
										$conn->close();?>	
									</select>	                            	
		                            <label class="col-md-3 control-label mt-2">Carpeta <span class="text-red">*</span></label>
		                            <div class="col-md-12">
		                                <input type="text" class="form-control" name="carpeta" id="carpeta" required/>
		                            </div>											
	                            </div>                                               
	                            <div class="modal-footer">
									<a href="javascript:;" class="btn btn-sm btn-white" data-bs-dismiss="modal">Cancelar</a>
									<button type="submit" class="btn btn-sm btn-success">Guardar</button>
								</div>
	                        </form>
						</div>
					</div>
				</div>
			</div>	

			<div class="modal fade" id="edit-version">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Edición de versión de material</h4>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" name="gestformx" id="gestformx" method="post" action="versions.php?p=<?=$p?>&m=<?=$m?>">
 								<input type="hidden" name="a" value="1000">
								<input type="hidden" name="idx" id="idx">
                            	<label for="idiomax" class="col-md-3 control-label mt-2">Idioma <span class="text-red">*</span></label>
		                        <select class="form-control form-select" id="idiomax" name="idiomax" required>
						           	<option value="">Sin asignar</option>
									<?$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
									mysqli_set_charset($conn, 'utf8');
									$sql ="SELECT CODIGO, NOMBRE FROM IDIOMAS";
									$result = $conn->query($sql);
									if ($result->num_rows > 0) {	
										while($row = mysqli_fetch_array($result) ) { ?>
											<option value="<?=$row[0]?>"><?=$row[1]?></option>
										<? } 
									}
									$conn->close();?>	
								</select>								
	                            <div class="form-group">
	                                <label class="col-md-3 control-label mt-2">Carpeta <span class="text-red">*</span></label>
	                                <div class="col-md-12">
	                                    <input type="text" class="form-control" name="carpetax" id="carpetax" required/>
	                                </div>
	                            </div>                                                                                          
	                            <div class="modal-footer">
									<a href="javascript:;" class="btn btn-sm btn-white" data-bs-dismiss="modal">Cancelar</a>
									<button type="submit" class="btn btn-sm btn-success">Guardar</button>
								</div>
	                        </form>
						</div>
					</div>
				</div>
			</div>				

			<? include "js.php" ;?>

		</body>
	</html>
<? }else{ 

	header ("Location: default.php");   

}?>