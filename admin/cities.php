<?php include 'conexion.php';
include 'functions.php';
include "auth.php";


if ($auth == 1){

	$opc = 102;

	$p = $_GET["p"]; //ciudad	

	if ($_POST["a"] == 100){

		$codigociudad  = get_item_code(2);
		$nombre = $_POST["nombre"];

		$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
		mysqli_set_charset($conn, 'utf8');		
		$sql = "INSERT INTO CIUDADES (codigo, nombre, estado, orden) VALUES ('$codigociudad', '$nombre', 1, 9999)";
		$conn->query($sql);
		$conn->close();	 	
		escribe_fichero_puntos_imageen();	
	}

	if ($_POST["a"] == 1000) {

		if ($_POST["estadox"] != "") {
			$estado = 1;
		}else{
			$estado = 0;
		}

		$id      	= $_POST["id"];
		$nombrex 	= $_POST["nombrex"];
		
		$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
		mysqli_set_charset($conn, 'utf8');		
		$sql = "UPDATE CIUDADES SET NOMBRE = '$nombrex', ESTADO = '$estado' WHERE CODIGO = '$id'";
		$conn->query($sql);
		$conn->close();	
		escribe_fichero_puntos_imageen();	

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
							<h4 class="panel-title">Ciudades</h4>
							<div class="panel-heading-btn">
								<a href="#add-option"  data-bs-toggle="modal" class="btn btn-xs btn-icon btn-success" ><i class="fas fa-plus"></i></a>
							</div>  							
						</div>
						<div class="panel-body">
							<?if ($p == "" || is_null($p)){ ?>							
			           			<div class="table-responsive">
									<table class="table" class="table table-striped table-bordered table-td-valign-middle">
										<thead>
											<tr>
												<th>Código</th>
												<th>Ciudad</th>
												<th>Estado</th>
												<th>Acciones</th>
											</tr>
										</thead>
										<tbody id="sortable1">
											<?$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
											mysqli_set_charset($conn, 'utf8');
											$sql = "SELECT CODIGO, NOMBRE, ESTADO FROM CIUDADES ORDER BY ORDEN";
											$result = $conn->query($sql);
											if ($result->num_rows > 0) {
												while($row = $result->fetch_assoc()) { 
										  			$codigociudad  = $row["CODIGO"];
										  			$nombreciudad  = $row["NOMBRE"];
										  			$estadociudad  = $row["ESTADO"];
													if ($estadociudad == 1){
													 	$cestado = "<span class='badge bg-success'>Activa</span>";
													}else{
														$cestado = "<span class='badge bg-danger'>No activa</span>";
													}?>  
													<tr id="<?=$codigociudad?>">
														<td><?=$codigociudad?></td>
														<td><?=$nombreciudad?></td>
														<td><?=$cestado?></td>
														<td><a href="cities.php?p=<?=$codigociudad?>" class="btn btn-xs btn-info" title="Gestionar registro"><i class="fas fa-edit"></i></a>
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
								$sql = "SELECT CODIGO, NOMBRE, ESTADO, IMAGEN FROM CIUDADES WHERE CODIGO = '$p'";
								$result = $conn->query($sql);		
								$row = $result->fetch_assoc();
								if ($result->num_rows > 0) {
									$codigociudadx	= $row["CODIGO"];									
									$nombreciudadx	= $row["NOMBRE"];
									$estadociudadx 	= $row["ESTADO"];
									$imagenciudadx	= $row["IMAGEN"];
								}
								$conn->close();

								echo "P";
								echo $codigociudadx; ?> 

								<form class="form-horizontal" name="gestformx" id="gestformx" method="post" action="cities.php">
									<input type="hidden" name="a" value="1000">
									<input type="hidden" name="id" id="id" value="<?=$codigociudadx?>">
			                           <div class="form-group">
			                           	<?$nombreimagen = "IMG-".RandomString(8).""?>
										<div class="slim" style="width:300px;margin:0 auto;"      
											data-label="Click aquí para insertar tu foto"
											data-push = "true"
											data-did-remove="imageRemoved"
											data-button-confirm-label="Confirmar"
				    						data-button-confirm-title="Confirmar"
				         					data-button-cancel-label="Cancelar"
				        					data-button-cancel-title="Cancelar"
				         					data-button-edit-label="Editar"
				         					data-button-edit-title="Editar"
				         					data-button-rotate-label="Girar"
							   				data-button-rotate-title="Girar"
				    						data-button-remove-label="Eliminar"
				         					data-button-remove-title="Eliminar" 
				         					data-size="900,600"
					        				data-service="assets/cropper/server/async5.php?id=<?=$codigociudadx?>&n=<?=$nombreimagen?>" id="my-cropper" style="width:300px;height:200px;">
					        				<?if ($imagenciudadx == "" || is_Null($imagenciudadx)) { ?>
				    	    					<input type="file" name="slim[]"/>
				        					<?} else {?>
				        						<input type="file" name="slim[]"/>
				        						<img class="rounded" src="data/ciudades/<?=$imagenciudadx?>" alt="" style="width:300px;height:200px;">
				        					<? } ?>	
			        					</div>	 		                            	
			                            <label class="col-md-3 control-label">Nombre <span class="text-red">*</span></label>
			                            <div class="col-md-12">
			                                <input type="text" class="form-control" name="nombrex" id="nombrex" value ="<?=$nombreciudadx?>" required/>
			                            </div>
										<div class="form-check form-switch mt-2">
											<input class="form-check-input" type="checkbox" id="estadox" name="estadox" value ="1" <?if ($estadociudadx == 1){ ?> checked <? } ?>>
											<label class="form-check-label" for="estadociudadx">Visible en APP</label>
										</div>                               
			                        </div>                                               
			                        <div class="modal-footer">
										<a href="javascript:;" class="btn btn-sm btn-white" data-bs-dismiss="modal">Cancelar</a>
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
							<h4 class="modal-title">Alta de Ciudad</h4>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" name="gestform" id="gestform" method="post" action="cities.php">
								<input type="hidden" name="a" value="100">
	                            <div class="form-group">
	                                <label class="col-md-3 control-label">Nombre <span class="text-red">*</span></label>
	                                <div class="col-md-12">
	                                    <input type="text" class="form-control" name="nombre" id="nombre" required/>
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
	

			<? include "js.php"; ?>

			<script>
				$(document).ready(function() {				
		    		$( "#sortable1" ).sortable({
		      		connectWith: ".connectedSortable",
		        		update : function () {
							var order1 = $('#sortable1').sortable('toArray').toString(); 
		          			console.log(order1);         			        			         			
							post_data = {'order1':order1};
							$.post('_grabaPosicionCiudad.php', post_data, function(response){},'json');
						}
		   			}).disableSelection();	
		   		})
		   	</script>		

		</body>
	</html>
<? } else { 
	header ("Location: default.php");   	
}
?>