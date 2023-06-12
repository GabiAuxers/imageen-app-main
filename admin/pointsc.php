<?php include 'conexion.php';
include 'functions.php';
include "auth.php";

if ($auth == 1){
	$opc = 3;

	$c = $_GET["c"]; // cliente
	$p = $_GET["p"]; // punto

	if ($_POST["a"] == 100){
		$codigopuntoc 		= get_item_code(7).RandomString(4);
		$nombrepuntoc 		= str_replace("'","\'",$_POST["nombre"]); 
		$direccionpuntoc 	= str_replace("'","\'",$_POST["direccion"]);		
		$descripcionpuntoc 	= str_replace("'","\'",$_POST["descripcion"]);
		$latitudpuntoc      = $_POST["latitud"];
		$longitudpuntoc     = $_POST["longitud"];
		$linkpuntoc         = $_POST["link"];
		$iconopuntoc        = $_POST["icono"];

		$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
		mysqli_set_charset($conn, 'utf8');			
		$sql = "INSERT INTO PUNTOSC (codigo, nombre, direccion, descripcion, cliente, latitud, longitud, link, icono, principal) VALUES ('$codigopuntoc', '$nombrepuntoc', '$direccionpuntoc', '$descripcionpuntoc', '$c', '$latitudpuntoc', '$longitudpuntoc', '$linkpuntoc', '$iconopuntoc', 0)";
		$conn->query($sql);
		$conn->close();
		escribe_fichero_puntos_imageen();
		escribe_fichero_puntos_cliente($c);
	}	

	if ($_POST["a"] == 1000){

		$nombrex     	= str_replace("'","\'",$_POST["nombrex"]);
		$direccionx 	= str_replace("'","\'",$_POST["direccionx"]);		
		$descripcionx 	= str_replace("'","\'",$_POST["descripcionx"]);
		$iconox 		= $_POST["iconox"];		
		$latitudx  		= $_POST["latitudx"];
		$longitudx  	= $_POST["longitudx"];
		$linkx      	= $_POST["linkx"];

		if ($_POST["opcion1"] == 1){
			$opcion1 = 1;
		}else{
			$opcion1 = 0;
		}

		$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
		mysqli_set_charset($conn, 'utf8');			
		$sql = "UPDATE PUNTOSC SET NOMBRE = '$nombrex', DIRECCION = '$direccionx', DESCRIPCION = '$descripcionx', ICONO = '$iconox', LATITUD = '$latitudx', LONGITUD = '$longitudx', LINK = '$linkx', PRINCIPAL = '$opcion1' WHERE CODIGO = '$p'";
		$conn->query($sql);
		$conn->close();	
		escribe_fichero_puntos_imageen();
		escribe_fichero_puntos_cliente($c);
	}
?>

	<!DOCTYPE html>
	<html lang="es">
		<head>
			<? include "head.html"; ?>	
			<script>			
				function borraPointsc(v,c){
					var r = confirm("Por favor, confirma que deseas eliminar este registro.");
					if (r == true) {
						var dataString = 'p='+v+'';
						    $.ajax({
		        		    type: "POST",
		    		        url: "_borraPointsc.asp",
				            data: dataString,
		            		success: function() {           
		            	    	alert("Registro eliminado")
		            	    	location.href = "pointsc.asp?c="+c;
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
							<h4 class="panel-title">Puntos del cliente <?=get_customer_name($c)?></h4>
							<div class="panel-heading-btn">
								<a href="#add-option"  data-bs-toggle="modal" class="btn btn-xs btn-icon btn-success" ><i class="fas fa-plus"></i></a>
							</div> 							
						</div>
						<div class="panel-body">
							<?if ($p == ""){ ?>
			           			<div class="table-responsive">
									<table id="data-table-default" class="table table-striped table-bordered align-middle">
										<thead>
											<tr>
												<th>ID</th>
												<th>Nombre</th>
												<th>Descripción</th>
												<th>Latitud</th>
												<th>Longitud</th>
												<th>Acciones</th>
											</tr>
										</thead>
										<tbody>

											<?$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
											mysqli_set_charset($conn, 'utf8');
											$sql ="SELECT CODIGO, NOMBRE, DESCRIPCION, ICONO, LATITUD, LONGITUD, LINK FROM PUNTOSC WHERE CLIENTE = '$c'";
											$result = $conn->query($sql);
											if ($result->num_rows > 0) {?>
												<?while($row = mysqli_fetch_array($result) ) {				
										  			$codigopuntoc 		= $row[0];
										  			$nombrepuntoc		= $row[1];
										  			$descripcionpuntoc	= $row[2];
										  			$iconopuntoc      	= $row[3];
										  			$latitudpuntoc 		= $row[4];
										  			$longitudpuntoc 	= $row[5];
										  			$linkpuntoc   		= $row[6];
										    		?>  
													<tr>
														<td><?=$codigopuntoc?></td>
														<td><?=$nombrepuntoc?></td>
														<td><?=$descripcionpuntoc?></td>
														<td><?=$latitudpuntoc?></td>
														<td><?=$longitudpuntoc?></td>
														<td><a href="pointsc.php?c=<?=$c?>&p=<?=$codigopuntoc?>" class="btn btn-xs btn-info" title="Gestionar registro"><i class="fas fa-edit"></i></a>
														</td>
													</tr>
											<?}	}else{ ?>
		    									<tr>
													<td colspan="6">No hay registros</td>
												</tr>	
											<?}
											$conn->close();?>
									</table>
								</div>

							<? }else{

								$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);	
								mysqli_set_charset($conn, 'utf8');
								$sql = "SELECT CODIGO, NOMBRE, DIRECCION, DESCRIPCION, LATITUD, LONGITUD, LINK, ICONO, IMAGEN, PRINCIPAL FROM PUNTOSC WHERE CODIGO = '$p'";
								$result = $conn->query($sql);		
								$row = $result->fetch_assoc();
								if ($result->num_rows > 0) {
									$codigopuntocx	    = $row["CODIGO"];									
									$nombrepuntocx		= $row["NOMBRE"];
									$direccionpuntocx   = $row["DIRECCION"];
									$descripcionpuntocx = $row["DESCRIPCION"];
									$latitudpuntocx		= $row["LATITUD"];
									$longitudpuntocx 	= $row["LONGITUD"];
									$linkpuntocx    	= $row["LINK"];
									$iconopuntocx    	= $row["ICONO"];
									$imagenpuntocx  	= $row["IMAGEN"];
									$principalpuntocx 	= $row["PRINCIPAL"];
								}
								$conn->close();

								echo "P";
								echo $codigopuntocx; ?>	
						
								
								<form class="form-horizontal" name="gestformx" id="gestformx" method="post" action="pointsc.php?c=<?=$c?>&p=<?=$p?>">
									<input type="hidden" name="a" value="1000">
									<input type="hidden" id="idx" name="idx" value="<?=$codigopuntocx?>">
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
			         						data-size="450,300"
			    							data-ratio="3:2"
				        					data-service="assets/cropper/server/async4.php?id=<?=$codigopuntocx?>&n=<?=$nombreimagen?>" id="my-cropper" style="width:300px;height:200px;">
				        					<?if ($imagenpuntocx == "" || is_Null($imagenpuntocx)) { ?>
			    	    						<input type="file" name="slim[]"/>
			        						<?} else {?>
			        							<input type="file" name="slim[]"/>
			        							<img class="rounded" src="data/puntos/<?=$imagenpuntocx?>" alt="" style="width:300px;height:200px;">
			        						<? } ?>	
		        						</div>	                            	
		                                <label class="col-md-3 control-label mt-2">Nombre <span class="text-red">*</span></label>
		                                <div class="col-md-12">
		                                    <input type="text" class="form-control" name="nombrex" id="nombrex" value="<?=$nombrepuntocx?>" required/>
		                                </div>
		                                <label class="col-md-3 control-label mt-2">Dirección</label>
		                                <div class="col-md-12">
		                                    <textarea class="form-control" name="direccionx" id="direccionx"/><?=$direccionpuntocx?></textarea>
		                                </div>			                                
		                                <label class="col-md-3 control-label mt-2">Descripción</label>
		                                <div class="col-md-12">
		                                    <textarea class="form-control" name="descripcionx" id="descripcionx"/><?=$descripcionpuntocx?></textarea>
		                                </div>	
		                                <label class="col-md-3 control-label mt-2">Latitud <span class="text-red">*</span></label>
		                                <div class="col-md-12">
		                                    <input type="text" class="form-control" name="latitudx" id="latitudx" value="<?=$latitudpuntocx?>"required/>	                                    
		                                </div>				
		                                <label class="col-md-3 control-label mt-2">Longitud <span class="text-red">*</span></label>
		                                <div class="col-md-12">
		                                    <input type="text" class="form-control" name="longitudx" id="longitudx" value="<?=$longitudpuntocx?>"required/>	                 
		                                </div>	
		 	                            <label for="iconox" class="col-md-3 control-label mt-2">Icono </span></label>
		 	                            <div class="col-md-4">
			                                <select class="form-control form-select" id="iconox" name="iconox" required>
									           	<option value="">Seleccionar</option>
												<?$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
												mysqli_set_charset($conn, 'utf8');
												$sql ="SELECT CODIGO, NOMBRE FROM GALERIA";
												$result = $conn->query($sql);
												if ($result->num_rows > 0) {	
													while($row = mysqli_fetch_array($result) ) { ?>
														<option value="<?=$row[0]?>" <?if ($row[0] == $iconopuntocx) { ?>selected <? } ?>><?=$row[1]?></option>
													<? } 
												}
												$conn->close();?>											
											</select>		                                	
										</div>
		                                <label class="col-md-3 control-label mt-2">Link<span class="text-red">*</span></label>
		                                <div class="col-md-12">
		                                    <input type="text" class="form-control" name="linkx" id="linkx" value="<?=$linkpuntocx?>" required/>                                    
		                                </div>	
		                                <div class="col-md-12 mt-10px">
											<div class="form-check form-switch mb-2 mt-2">
												<input class="form-check-input" type="checkbox" id="opcion1" name="opcion1" value="1" <?if ($principalpuntocx == 1){ ?>checked<? } ?>>
												<label class="form-check-label" for="opcion1"><p>Ver en mapa Imageen</p></label>
											</div>		
										</div>	                                			
		                            </div>                                               
		                            <div class="modal-footer">
		                            	<a class="btn btn-sm btn-danger pull-left" onclick="borraPointsc($('#idx').val(),'<?=$c?>')"><i class="fa fa-close"></i>  Eliminar este registro</a>
										<a href="javascript:;" class="btn btn-sm btn-white">Cancelar</a>
										<button type="submit" class="btn btn-sm btn-success">Guardar</button>
									</div>
		                        </form>

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

			<div class="modal fade" id="add-option">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Alta de Punto de cliente</h4>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" name="gestform" id="gestform" method="post" action="pointsc.php?c=<?=$c?>">
								<input type="hidden" name="a" value="100">
	                            <div class="form-group">
	                                <label class="col-md-3 control-label mt-2">Nombre <span class="text-red">*</span></label>
	                                <div class="col-md-12">
	                                    <input type="text" class="form-control" name="nombre" id="nombre" required/>
	                                </div>
	                                <label class="col-md-3 control-label mt-2">Dirección</label>
	                                <div class="col-md-12">
	                                    <textarea class="form-control" name="direccion" id="direccion"/></textarea>
	                                </div>		                                
	                                <label class="col-md-3 control-label mt-2">Descripción</label>
	                                <div class="col-md-12">
	                                    <textarea class="form-control" name="descripcion" id="descripcion"/></textarea>
	                                </div>	
	                                <label class="col-md-3 control-label mt-2">Latitud <span class="text-red">*</span></label>
	                                <div class="col-md-12">
	                                    <input type="text" class="form-control" name="latitud" id="latitud" required/>	                                    
	                                </div>				
	                                <label class="col-md-3 control-label mt-2">Longitud <span class="text-red">*</span></label>
	                                <div class="col-md-12">
	                                    <input type="text" class="form-control" name="longitud" id="longitud" required/>	                                    
	                                </div>		
	                                <label for="tipo" class="col-md-3 control-label mt-2">Icono <span class="text-red">*</span></label>
	                                <select class="form-control form-select" id="icono" name="icono" required>
							           	<option value="">Seleccionar</option> 
										<option value="1">Icono 1</option> 
										<option value="2">Icono 2</option> 		
										<option value="3">Icono 3</option> 												           	
										<option value="4">Icono 4</option> 										
									</select>
	                                <label class="col-md-3 control-label mt-2">Link<span class="text-red">*</span></label>
	                                <div class="col-md-12">
	                                    <input type="text" class="form-control" name="link" id="link" required/>	                                    
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