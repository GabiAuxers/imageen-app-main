<?php include 'conexion.php';
include 'functions.php';
include "auth.php";

if ($auth == 1){
	$opc = 2;

	$p = $_GET["p"];
	$m = $_GET["m"];

	if ($_POST["a"] == 100){
		$codigomaterial = get_item_code(5).RandomString(3);
		$nombre1 	    = str_replace("'","\'",$_POST["nombre1"]);
		$descripcion1   = str_replace("'","\'",$_POST['descripcion1']);
		$nombre2 	    = str_replace("'","\'",$_POST["nombre2"]);
		$descripcion2   = str_replace("'","\'",$_POST['descripcion2']);
		$nombre3 	    = str_replace("'","\'",$_POST["nombre3"]);
		$descripcion3   = str_replace("'","\'",$_POST['descripcion3']);
		$nombre4 	    = str_replace("'","\'",$_POST["nombre4"]);
		$descripcion4   = str_replace("'","\'",$_POST['descripcion4']);		
		$instrucciones1 = str_replace("'","\'",$_POST['instrucciones1']);
		$instrucciones2 = str_replace("'","\'",$_POST['instrucciones2']);
		$instrucciones3 = str_replace("'","\'",$_POST['instrucciones3']);
		$instrucciones4 = str_replace("'","\'",$_POST['instrucciones4']);				
		$tipo 			= $_POST['tipo'];
		$punto			= $_POST['punto'];
		$acceso			= $_POST['acceso'];		
		$orden			= 9999;

		$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
		mysqli_set_charset($conn, 'utf8');			
		$sql = "INSERT INTO MATERIALES (codigo, nombre1, descripcion1, nombre2, descripcion2, nombre3, descripcion3, nombre4, descripcion4, instrucciones1, instrucciones2, instrucciones3, instrucciones4, tipo, punto, acceso, orden) VALUES ('$codigomaterial', '$nombre1', '$descripcion1', '$nombre2', '$descripcion2', '$nombre3', '$descripcion3', '$nombre4', '$descripcion4', '$instrucciones1', '$instrucciones2', '$instrucciones3', '$instrucciones4', '$tipo', '$punto', '$acceso', '$orden')";
		$conn->query($sql);
		$conn->close();	 		
	}

	if ($_POST["a"] == 1000){

		$nombrex1 		= str_replace("'","\'",$_POST["nombrex1"]);
		$descripcionx1 	= str_replace("'","\'",$_POST["descripcionx1"]);		
		$nombrex2 		= str_replace("'","\'",$_POST["nombrex2"]);
		$descripcionx2 	= str_replace("'","\'",$_POST["descripcionx2"]);	
		$nombrex3 		= str_replace("'","\'",$_POST["nombrex3"]);
		$descripcionx3 	= str_replace("'","\'",$_POST["descripcionx3"]);	
		$nombrex4 		= str_replace("'","\'",$_POST["nombrex4"]);		
		$descripcionx4 	= str_replace("'","\'",$_POST["descripcionx4"]);							
		$instruccionesx1= str_replace("'","\'",$_POST["instruccionesx1"]);
		$instruccionesx2= str_replace("'","\'",$_POST["instruccionesx2"]);		
		$instruccionesx3= str_replace("'","\'",$_POST["instruccionesx3"]);
		$instruccionesx4= str_replace("'","\'",$_POST["instruccionesx4"]);
		$tipox   	   	= $_POST["tipox"];	
		$accesox    	= $_POST["accesox"];	

		$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
		mysqli_set_charset($conn, 'utf8');			
		$sql = "UPDATE MATERIALES SET NOMBRE1 = '$nombrex1', DESCRIPCION1 = '$descripcionx1', NOMBRE2 = '$nombrex2', DESCRIPCION2 = '$descripcionx2', NOMBRE3 = '$nombrex3',DESCRIPCION3 ='$descripcionx3', NOMBRE4 = '$nombrex4', DESCRIPCION4 ='$descripcionx4', INSTRUCCIONES1 = '$instruccionesx1',  INSTRUCCIONES2 = '$instruccionesx2',  INSTRUCCIONES3 = '$instruccionesx3',  INSTRUCCIONES4 = '$instruccionesx4', TIPO ='$tipox', ACCESO = '$accesox' WHERE CODIGO = '$m'";
		$conn->query($sql);
		$conn->close();	

		header ("Location: materials.php?p=$p");   

	}

?>

	<!DOCTYPE html>
	<html lang="es">
		<head>
			<? include "head.html"; ?>	
			<script>			
				function borraMaterial(p,m){
					var r = confirm("Por favor, confirma que deseas eliminar este material. ATENCIÓN: se eliminarán también todas sus versiones. Los archivos del servidor con los contenidos del punto deberán ser eliminados manualmente.");
					if (r == true) {
						var dataString = 'm='+m+'';
						    $.ajax({
		        		    type: "POST",
		    		        url: "_borraMaterial.php",
				            data: dataString,
		            		success: function() {           
		            	    	alert("Material eliminado")
		            	    	location.href = "materials.php?p="+p;
		        	    	}
		    	    	});
					}
				}
			</script>		

			<style>
		 		#sortable1 { list-style-type: none; border-color:#ffffff;background-color:#ffffff;}
		  		#sortable1 li { margin: 5px 5px 5px 5px; padding: 5px; font-size: 1.2em;}   		
			</style>	

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
							<h4 class="panel-title">Materiales del punto <?=$p?> <?=get_name_point($p)?></h4>
							<div class="panel-heading-btn">
								<a href="#add-option"  data-bs-toggle="modal" class="btn btn-xs btn-icon btn-success" ><i class="fas fa-plus"></i></a>
							</div> 							
						</div>
						<div class="panel-body">
							<?if ($m == "") { ?>
			           			<div class="table-responsive">
									<table id="data-table-default" class="table table-striped table-bordered align-middle">
										<thead>
											<tr>
												<th style="display: none;"></th>
												<th>ID</th>
												<th>Nombre</th>
												<th>Descripción</th>
												<th>Tipo</th>
												<th>PM</th>
												<th>Acceso</th>
												<th>Acciones</th>
											</tr>
										</thead>
										<tbody id="sortable1">

											<?$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
											mysqli_set_charset($conn, 'utf8');
											$sql = "SELECT CODIGO, NOMBRE1, DESCRIPCION1, TIPO, ACCESO, ORDEN FROM MATERIALES WHERE PUNTO = '$p' ORDER BY ORDEN";
											$result = $conn->query($sql);
											if ($result->num_rows > 0) {?>
												<?while($row = mysqli_fetch_array($result) ) {				
										  			$codigomaterial 	= $row[0];
										  			$nombrematerial		= $row[1];
										  			$descripmaterial	= $row[2];
										  			$tipomaterial   	= $row[3];
										  			$accesomaterial 	= $row[4];
										  			$ordenmaterial		= $row[5];				  															  			
	
										  			$ctipomaterial      = get_material_type($tipomaterial);
										  			$ctipoacceso        = get_access_type($accesomaterial);
													$puntuacionmedia 	= get_average_material($codigomaterial);
										    		?>  
													<tr id="<?=$codigomaterial?>">
														<td><?=$codigomaterial?></td>
														<td><?=$nombrematerial?></td>
														<td><?=$descripmaterial?></td>
														<td><?=$ctipomaterial?></td>
														<td><?=$puntuacionmedia?></td>
														<td><?=$ctipoacceso?></td>
														<td><a href="materials.php?p=<?=$p?>&m=<?=$codigomaterial?>" class="btn btn-xs btn-info"><i class="fas fa-edit"></i></a>
															<a href="versions.php?p=<?=$p?>&m=<?=$codigomaterial?>" class="btn btn-xs btn-green ms-1"><i class="fas fa-flag"></i></a>
														</td>
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

							<? } else {

								$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);	
								mysqli_set_charset($conn, 'utf8');
								$sql = "SELECT CODIGO, NOMBRE1, DESCRIPCION1, NOMBRE2, DESCRIPCION2, NOMBRE3, DESCRIPCION3, NOMBRE4, DESCRIPCION4, TIPO, ACCESO, INSTRUCCIONES1, INSTRUCCIONES2, INSTRUCCIONES3, INSTRUCCIONES4, PUNTO, IMAGEN FROM MATERIALES WHERE CODIGO = '$m'";
								$result = $conn->query($sql);		
								$row = $result->fetch_assoc();
								if ($result->num_rows > 0) {
									$codigomaterial	    = $row["CODIGO"];									
									$nombrematerial1	= $row["NOMBRE1"];
									$descripmaterial1 	= $row["DESCRIPCION1"];
									$nombrematerial2	= $row["NOMBRE2"];
									$descripmaterial2 	= $row["DESCRIPCION2"];
									$nombrematerial3	= $row["NOMBRE3"];
									$descripmaterial3 	= $row["DESCRIPCION3"];
									$nombrematerial4	= $row["NOMBRE4"];
									$descripmaterial4 	= $row["DESCRIPCION4"];
									$instrucciones1     = $row["INSTRUCCIONES1"];
									$instrucciones2     = $row["INSTRUCCIONES2"];
									$instrucciones3     = $row["INSTRUCCIONES3"];
									$instrucciones4     = $row["INSTRUCCIONES4"];																									
									$tipomaterial		= $row["TIPO"];
									$accesomaterial		= $row["ACCESO"];
									$punto				= $row["PUNTO"];
									$imagenmaterial    	= $row["IMAGEN"];
								}
								$conn->close();

								echo "P";
								echo $codigomaterial; ?>					

								<form class="form-horizontal" name="gestformx" id="gestformx" method="post" action="materials.php?p=<?=$p?>&m=<?=$codigomaterial?>">
									<input type="hidden" name="a" value="1000">
									<input type="hidden" name="id">
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
											data-ratio="3:2"
											data-service="assets/cropper/server/async6.php?id=<?=$codigomaterial?>&n=<?=$nombreimagen?>" id="my-cropper" style="width:300px;height:200px;">
											<?if ($imagenmaterial == "" || is_null($imagenmaterial)) { ?>
												<input type="file" name="slim[]"/>
											<?}else{?>
												<input type="file" name="slim[]"/>
												<img class="rounded" src="data/materiales/<?=$imagenmaterial?>" alt="" style="width:300px;height:200px;">
											<?}?>
										</div>	  


										<label class="col-md-3 control-label mt-2">Nombre <img src="imagenes/es.png"> <span class="text-red">*</span></label>
		                                <div class="col-md-12">
		                                    <input type="text" class="form-control" name="nombrex1" id="nombrex1" value="<?=$nombrematerial1?>" required/>
		                                </div>
		                                <label class="col-md-3 control-label mt-2">Descripción  <img src="imagenes/es.png"> </label>
		                                <div class="col-md-12">
		                                    <textarea class="form-control" name="descripcionx1" id="descripcionx1"/><?=$descripmaterial1?></textarea>
		                                </div>	
		                                <label class="col-md-3 control-label mt-2">Instrucciones específicas  <img src="imagenes/es.png"> </label>
		                                <div class="col-md-12">
		                                    <textarea class="form-control" name="instruccionesx1" id="instrucciones1"/><?=$instrucciones1?></textarea>
		                                </div>		                                
		                                <label class="col-md-3 control-label mt-2">Nombre  <img src="imagenes/en.png"> <span class="text-red">*</span></label>
		                                <div class="col-md-12">
		                                    <input type="text" class="form-control" name="nombrex2" id="nombrex2" value="<?=$nombrematerial1?>" />
		                                </div>
		                                <label class="col-md-3 control-label mt-2">Descripción  <img src="imagenes/en.png"> </label>
		                                <div class="col-md-12">
		                                    <textarea class="form-control" name="descripcionx2" id="descripcionx2"/><?=$descripmaterial2?></textarea>
		                                </div>	
		                                <label class="col-md-3 control-label mt-2">Instrucciones específicas  <img src="imagenes/en.png"> </label>
		                                <div class="col-md-12">
		                                    <textarea class="form-control" name="instruccionesx2" id="instrucciones2"/><?=$instrucciones2?></textarea>
		                                </div>			                                
		                                <label class="col-md-3 control-label mt-2">Nombre  <img src="imagenes/fr.png"> <span class="text-red">*</span></label>
		                                <div class="col-md-12">
		                                    <input type="text" class="form-control" name="nombrex3" id="nombrex3" value="<?=$nombrematerial3?>" />
		                                </div>
		                                <label class="col-md-3 control-label mt-2">Descripción  <img src="imagenes/fr.png"> </label>
		                                <div class="col-md-12">
		                                    <textarea class="form-control" name="descripcionx3" id="descripcionx3"/><?=$descripmaterial3?></textarea>
		                                </div>	
		                                <label class="col-md-3 control-label mt-2">Instrucciones específicas  <img src="imagenes/fr.png"> </label>
		                                <div class="col-md-12">
		                                    <textarea class="form-control" name="instruccionesx3" id="instrucciones3"/><?=$instrucciones3?></textarea>
		                                </div>			                                
		                                <label class="col-md-3 control-label mt-2">Nombre  <img src="imagenes/ca.png"> <span class="text-red">*</span></label>
		                                <div class="col-md-12">
		                                    <input type="text" class="form-control" name="nombrex4" id="nombrex4" value="<?=$nombrematerial4?>" />
		                                </div>
		                                <label class="col-md-3 control-label mt-2">Descripción <img src="imagenes/ca.png"> </label>
		                                <div class="col-md-12">
		                                    <textarea class="form-control" name="descripcionx4" id="descripcionx4"/><?=$descripmaterial4?></textarea>
		                                </div>			
		                                <label class="col-md-3 control-label mt-2">Instrucciones específicas  <img src="imagenes/ca.png"> </label>
		                                <div class="col-md-12">
		                                    <textarea class="form-control" name="instruccionesx4" id="instrucciones4"/><?=$instrucciones4?></textarea>
		                                </div>			                                                                		                                		                                	
		                                <label for="tipox" class="col-md-3 control-label mt-2">Tipo material <span class="text-red">*</span></label>
		                                <select class="form-control form-select" id="tipox" name="tipox" required>
								           	<option value="">Seleccionar</option> 
											<option value="1" <?if ($tipomaterial == "1") { ?>selected<? } ?>>Vídeo plano</option> 
											<option value="2" <?if ($tipomaterial == "2") { ?>selected<? } ?>>Vídeo 360</option> 		
											<option value="3" <?if ($tipomaterial == "3") { ?>selected<? } ?>>Pasado/presente</option> 										
											<option value="4" <?if ($tipomaterial == "4") { ?>selected<? } ?>>Audio</option> 	
											<option value="5" <?if ($tipomaterial == "5") { ?>selected<? } ?>>Tour Imageen</option> 	
											<option value="6" <?if ($tipomaterial == "6") { ?>selected<? } ?>>Wiki Imageen</option> 										
										</select>
	                               		<label for="accesox" class="col-md-3 control-label mt-2">Acceso <span class="text-red">*</span></label>
			                            <select class="form-control form-select" id="accesox" name="accesox" required>
									       	<option value="">Seleccionar</option> 
											<option value="1" <?if ($accesomaterial == 1) { ?>selected<? } ?>>FREE</option> 		
											<option value="2" <?if ($accesomaterial == 2) { ?>selected<? } ?>>CLUB</option> 												    
											<option value="3" <?if ($accesomaterial == 3) { ?>selected<? } ?>>PREMIUM</option> 										
										</select>													
		                            </div>                                               
		                            <div class="modal-footer">
	                            		<a class="btn btn-sm btn-danger pull-left" onclick="borraMaterial('<?=$codigopunto?>','<?=$codigomaterial?>')"><i class="fa fa-close"></i>  Eliminar este material</a>                  	
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
							<h4 class="modal-title">Alta de Material</h4>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" name="gestform" id="gestform" method="post" action="materials.php?p=<?=$p?>">
								<input type="hidden" name="a" value="100">
								<input type="hidden" name="punto" value="<?=$p?>">
	                            <div class="form-group">
		                                <label class="col-md-3 control-label mt-2">Nombre <img src="imagenes/es.png"> <span class="text-red">*</span></label>
		                                <div class="col-md-12">
		                                    <input type="text" class="form-control" name="nombre1" id="nombre1" required/>
		                                </div>
		                                <label class="col-md-3 control-label mt-2">Descripción  <img src="imagenes/es.png"> </label>
		                                <div class="col-md-12">
		                                    <textarea class="form-control" name="descripcion1" id="descripcion1"/></textarea>
		                                </div>	
		                                <label class="col-md-3 control-label mt-2">Instrucciones específicas  <img src="imagenes/es.png"> </label>
		                                <div class="col-md-12">
		                                    <textarea class="form-control" name="instrucciones1" id="instrucciones1"/></textarea>
		                                </div>			                                
		                                <label class="col-md-3 control-label mt-2">Nombre  <img src="imagenes/en.png"> <span class="text-red">*</span></label>
		                                <div class="col-md-12">
		                                    <input type="text" class="form-control" name="nombre2" id="nombre2" required/>
		                                </div>
		                                <label class="col-md-3 control-label mt-2">Descripción  <img src="imagenes/en.png"> </label>
		                                <div class="col-md-12">
		                                    <textarea class="form-control" name="descripcion2" id="descripcion2"/></textarea>
		                                </div>	
		                                <label class="col-md-3 control-label mt-2">Instrucciones específicas  <img src="imagenes/en.png"> </label>
		                                <div class="col-md-12">
		                                    <textarea class="form-control" name="instrucciones2" id="instrucciones2"/></textarea>
		                                </div>			                                
		                                <label class="col-md-3 control-label mt-2">Nombre  <img src="imagenes/fr.png"> <span class="text-red">*</span></label>
		                                <div class="col-md-12">
		                                    <input type="text" class="form-control" name="nombre3" id="nombre3" required/>
		                                </div>
		                                <label class="col-md-3 control-label mt-2">Descripción  <img src="imagenes/fr.png"> </label>
		                                <div class="col-md-12">
		                                    <textarea class="form-control" name="descripcion3" id="descripcion3"/></textarea>
		                                </div>	
		                                <label class="col-md-3 control-label mt-2">Instrucciones específicas  <img src="imagenes/fr.png"> </label>
		                                <div class="col-md-12">
		                                    <textarea class="form-control" name="instrucciones3" id="instrucciones3"/></textarea>
		                                </div>			                                
		                                <label class="col-md-3 control-label mt-2">Nombre  <img src="imagenes/ca.png"> <span class="text-red">*</span></label>
		                                <div class="col-md-12">
		                                    <input type="text" class="form-control" name="nombre4" id="nombre4" required/>
		                                </div>
		                                <label class="col-md-3 control-label mt-2">Descripción <img src="imagenes/ca.png"> </label>
		                                <div class="col-md-12">
		                                    <textarea class="form-control" name="descripcion4" id="descripcion4"/></textarea>
		                                </div>
		                                <label class="col-md-3 control-label mt-2">Instrucciones específicas  <img src="imagenes/ca.png"> </label>
		                                <div class="col-md-12">
		                                    <textarea class="form-control" name="instrucciones4" id="instrucciones4"/></textarea>
		                                </div>			                                
	            	
	                                <label for="tipo" class="col-md-3 control-label mt-2">Tipo material <span class="text-red">*</span></label>
	                                <select class="form-control form-select" id="tipo" name="tipo" required>
							           	<option value="">Seleccionar</option> 
										<option value="1">Vídeo plano</option> 
										<option value="2">Vídeo 360</option> 		
										<option value="3">Presente/pasado</option> 												           	
										<option value="4">Audio</option> 
										<option value="5">Tour Imageen</option> 
										<option value="6">Wiki Imageen</option> 												
									</select>
                               		<label for="acceso" class="col-md-3 control-label mt-2">Acceso <span class="text-red">*</span></label>
		                            <select class="form-control form-select" id="acceso" name="acceso" required>
								       	<option value="">Seleccionar</option> 
										<option value="1">FREE</option> 		
										<option value="2">CLUB</option> 												    
										<option value="3">PREMIUM</option> 										
									</select>												
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

			<script>
				$(document).ready(function() {				
		    		$( "#sortable1" ).sortable({
		      		connectWith: ".connectedSortable",
		        		update : function () {
							var order1 = $('#sortable1').sortable('toArray').toString(); 
		          			console.log(order1);         			        			         			
							post_data = {'order1':order1};
							$.post('_grabaPosicionMaterial.php', post_data, function(response){},'json');
						}
		   			}).disableSelection();	
		   		})
		   	</script>		

		</body>
	</html>
<? }else{ 

	header ("Location: default.php");   

}?>