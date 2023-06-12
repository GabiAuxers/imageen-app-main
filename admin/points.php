<?php include 'conexion.php';
include 'functions.php';
include "auth.php";

if ($auth == 1){

	$p = $_GET["p"];

	$opc = 2;

	if ($_POST["a"] == 100){

		$codigopunto  = get_item_code(3).RandomString(4);
		$nombre 	  = str_replace("'","\'",$_POST["nombre"]);
		$descripcion1 = str_replace("'","\'",$_POST["descripcion1"]);		
		$descripcion2 = str_replace("'","\'",$_POST["descripcion2"]);	
		$descripcion3 = str_replace("'","\'",$_POST["descripcion3"]);	
		$descripcion4 = str_replace("'","\'",$_POST["descripcion4"]);							
		$ciudad 	  = str_replace("'","\'",$_POST["ciudad"]);	
		$localizacion = str_replace("'","\'",$_POST["localizacion"]);	
		$cliente      = 0;			
		$categoria    = 0;	
		$longitud     = $_POST["longitud"];			
		$latitud      = $_POST["latitud"];	
		$icono        = $_POST["icono"];		
		$busqueda     = str_replace("'","\'",$_POST["busqueda"]);	

		$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
		mysqli_set_charset($conn, 'utf8');			
		$sql = "INSERT INTO PUNTOS (codigo, nombre, descripcion1, descripcion2, descripcion3, descripcion4, ciudad, localizacion, cliente, categoria, longitud, latitud, busqueda, icono) VALUES ('$codigopunto', '$nombre', '$descripcion1', '$descripcion2', '$descripcion3', '$descripcion4', '$ciudad', '$localizacion', '$cliente', '$categoria', '$longitud', '$latitud', '$busqueda', '$icono')";
		$conn->query($sql);
		$conn->close();
		escribe_fichero_puntos_imageen();
	}

	if ($_POST["a"] == 1000){

		$id      		= $_POST["id"];
		$nombrex 		= str_replace("'","\'",$_POST["nombrex"]);
		$descripcionx1 	= str_replace("'","\'",$_POST["descripcionx1"]);		
		$descripcionx2 	= str_replace("'","\'",$_POST["descripcionx2"]);	
		$descripcionx3 	= str_replace("'","\'",$_POST["descripcionx3"]);	
		$descripcionx4 	= str_replace("'","\'",$_POST["descripcionx4"]);							
		$ciudadx 	   	= str_replace("'","\'",$_POST["ciudadx"]);	
		$localizacionx 	= str_replace("'","\'",$_POST["localizacionx"]);	
		$clientex      	= str_replace("'","\'",$_POST["clientex"]);		
		$longitudx     	= str_replace("'","\'",$_POST["longitudx"]);			
		$latitudx      	= str_replace("'","\'",$_POST["latitudx"]);			
		$busquedax     	= str_replace("'","\'",$_POST["busquedax"]);	
		$iconox         = $_POST["iconox"];		

		$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
		mysqli_set_charset($conn, 'utf8');			
		$sql = "UPDATE PUNTOS SET NOMBRE = '$nombrex', DESCRIPCION1 = '$descripcionx1', DESCRIPCION2 = '$descripcionx2', DESCRIPCION3 ='$descripcionx3', DESCRIPCION4 ='$descripcionx4', CIUDAD = '$ciudadx', LOCALIZACION ='$localizacionx', CLIENTE = '$clientex', LONGITUD = '$longitudx', LATITUD ='$latitudx', BUSQUEDA ='$busquedax', ICONO ='$iconox' WHERE CODIGO = '$id'";
		$conn->query($sql);
		$conn->close();
		escribe_fichero_puntos_imageen();			
	}
	?>

	<!DOCTYPE html>
	<html lang="es">
		<head>
			<? include "head.html"; ?>

			<script>			
				function borraPoint(v,c){
					var r = confirm("Por favor, confirma que deseas eliminar este punto Imageen. ATENCIÓN: se eliminarán también todos los materiales asociados y todas las versiones de cada material. Los archivos del servidor con los contenidos del punto deberán ser eliminados manualmente.");
					if (r == true) {
						var dataString = 'p='+v+'';
						    $.ajax({
		        		    type: "POST",
		    		        url: "_borraPoint.php",
				            data: dataString,
		            		success: function() {           
		            	    	alert("Punto eliminado");
		            	    	location.href = "points.asp?c="+c;
		        	    	}
		    	    	});
					}
				}
			</script>							
		</head>
		<body>

			<div id="loader" class="app-loader">
				<span class="spinner"></span>
			</div>

			<div id="app" class="app app-header-fixed app-sidebar-fixed">

				<? include "header.php";
				include "sidebar.php" ?>
				
				<div class="app-sidebar-bg"></div>
				<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a></div>

				<div id="content" class="app-content">
					
					<div class="panel panel-inverse">
						<div class="panel-heading">
							<h4 class="panel-title">Puntos Imageen</h4>
							<div class="panel-heading-btn">
								<a href="#add-option"  data-bs-toggle="modal" class="btn btn-xs btn-icon btn-success" ><i class="fas fa-plus"></i></a>
							</div> 							
						</div>
						<div class="panel-body">
							<?if ($p == "") {?>
			           			<div class="table-responsive">
									<table id="data-table-default" class="table table-striped table-bordered align-middle">
										<thead>
											<tr>
												<th>Código</th>
												<th>Nombre del punto</th>
												<th>Ciudad</th>
												<th>PM</th>
												<th>Acciones</th>
											</tr>
										</thead>
										<tbody>

											<?$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
											mysqli_set_charset($conn, 'utf8');
											$sql = "SELECT PUNTOS.CODIGO, PUNTOS.NOMBRE, PUNTOS.DESCRIPCION1, PUNTOS.DESCRIPCION2, PUNTOS.DESCRIPCION3, PUNTOS.DESCRIPCION4, PUNTOS.CIUDAD, PUNTOS.CLIENTE, PUNTOS.CATEGORIA, PUNTOS.LONGITUD, PUNTOS.LATITUD, CIUDADES.NOMBRE, PUNTOS.LOCALIZACION FROM PUNTOS, CIUDADES WHERE CIUDADES.CODIGO = PUNTOS.CIUDAD";
											$result = $conn->query($sql);
											if ($result->num_rows > 0) {?>
												<?while($row = mysqli_fetch_array($result) ) {				
										  			$codigopunto 		= $row[0];
										  			$nombrepunto 		= $row[1];
										  			$descripcionpunto1	= $row[2];
										  			$descripcionpunto2	= $row[3];
										  			$descripcionpunto3	= $row[4];
										  			$descripcionpunto4	= $row[5];				  															  			
										  			$ciudadpunto		= $row[6];
										    		$clientepunto   	= $row[7];
										    		$categoriapunto     = $row[8];
										    		$longitudpunto 		= $row[9];
										    		$latitudpunto 		= $row[10];
										    		$nombreciudad       = $row[11];
										    		$mlocalizacion      = $row[12];
													$puntuacionmedia 	= get_average_points($codigopunto);
										    		?>  
													<tr>
														<td><?=$codigopunto?></td>
														<td><?=$nombrepunto?></td>
														<td><?=$nombreciudad?></td>
														<td><?=$puntuacionmedia?></td>
														<td><a href="points.php?p=<?=$codigopunto?>" class="btn btn-xs btn-info" title="Gestionar registro"><i class="fas fa-edit"></i></a><a href="materials.php?p=<?=$codigopunto?>" class="btn btn-info btn-xs ms-1"><i class="fas fa-video"></i></a>
														</td>
													</tr>
												<?}
											}else{ ?>
		    									<tr>
													<td colspan="5">No hay registros</td>
												</tr>	
											<?}
											$conn->close();?>	
										</tbody>
									</table>
								</div>

							<? } else {

								$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);	
								mysqli_set_charset($conn, 'utf8');
								$sql = "SELECT PUNTOS.CODIGO as codigo, PUNTOS.NOMBRE as nombre, PUNTOS.DESCRIPCION1 as descripcion1, PUNTOS.DESCRIPCION2 as descripcion2, PUNTOS.DESCRIPCION3 as descripcion3, PUNTOS.DESCRIPCION4 as descripcion4, PUNTOS.CIUDAD as ciudad, PUNTOS.CLIENTE as cliente, PUNTOS.CATEGORIA as categoria, PUNTOS.LONGITUD as longitud, PUNTOS.LATITUD as latitud, CIUDADES.NOMBRE as nombreciudad, PUNTOS.IMAGEN as imagen, PUNTOS.LOCALIZACION as localizacion, PUNTOS.BUSQUEDA as busqueda, PUNTOS.ICONO as icono FROM PUNTOS, CIUDADES WHERE CIUDADES.CODIGO = PUNTOS.CIUDAD AND PUNTOS.CODIGO ='$p'";
								$result = $conn->query($sql);		
								$row = $result->fetch_assoc();
								if ($result->num_rows > 0) {
									$codigopunto	= $row["codigo"];
									$nombrepunto	= $row["nombre"];
									$descrippunto1 	= $row["descripcion1"];
									$descrippunto2 	= $row["descripcion2"];
									$descrippunto3 	= $row["descripcion3"];
									$descrippunto4 	= $row["descripcion4"];
									$ciudadpunto	= $row["ciudad"];
									$clientepunto	= $row["cliente"];
									$categoriapunto	= $row["categoria"];
									$longitudpunto 	= $row["longitud"];
									$latitudpunto  	= $row["latitud"];
									$nombreciudad   = $row["nombreciudad"];
									$imagenpunto    = $row["imagen"];
									$localizacion   = $row["localizacion"];
									$busqueda       = $row["busqueda"];
									$iconopunto     = $row["icono"];
								}
								$conn->close(); ?>


								<form class="form-horizontal" name="gestformx" id="gestformx" method="post" action="points.php">
	 								<input type="hidden" name="a" value="1000">
									<input type="hidden" name="id" id="id" value="<?=$codigopunto?>">
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
			        					data-service="assets/cropper/server/async.php?id=<?=$codigopunto?>&n=<?=$nombreimagen?>" id="my-cropper" style="width:300px;height:200px;">
			        					<?if ($imagenpunto == "" || is_null($imagenpunto)) { ?>
		    	    						<input type="file" name="slim[]"/>
		        						<?}else{?>
		        							<input type="file" name="slim[]"/>
		        							<img class="rounded" src="data/puntos/<?=$imagenpunto?>" alt="" style="width:300px;height:200px;">
		        						<?}?>
		    						</div>	  

	                                <label class="col-md-3 control-label mt-2">Nombre <span class="text-red">*</span></label>
	                                <div class="col-md-12">
	                                    <input type="text" class="form-control" name="nombrex" id="nombrex" required value="<?=$nombrepunto?>"/>
	                                </div>
	                                <label class="col-md-3 control-label mt-2">Descripción <img src="imagenes/es.png"></label>
	                                <div class="col-md-12">
	                                    <textarea class="form-control" name="descripcionx1" id="descripcionx1"/><?=$descrippunto1?></textarea>
	                                </div>	
                                	<label class="col-md-3 control-label mt-2">Descripción <img src="imagenes/en.png"></label>
	                                <div class="col-md-12">
	                                    <textarea class="form-control" name="descripcionx2" id="descripcionx2"/><?=$descrippunto2?></textarea>
	                                </div>	
                                	<label class="col-md-3 control-label mt-2">Descripción <img src="imagenes/fr.png"></label>
	                                <div class="col-md-12">
	                                    <textarea class="form-control" name="descripcionx3" id="descripcionx3"/><?=$descrippunto3?></textarea>
	                                </div>	
                                	<label class="col-md-3 control-label mt-2">Descripción <img src="imagenes/ca.png"></label>
	                                <div class="col-md-12">
	                                    <textarea class="form-control" name="descripcionx4" id="descripcionx4"/><?=$descrippunto4?></textarea>
	                                </div>	
	                                <label class="col-md-3 control-label mt-2">Localización</label>
	                                <div class="col-md-12">
	                                    <textarea class="form-control" name="localizacionx" id="localizacionx"/><?=$localizacion?></textarea>
	                                </div>		                                		                                		                                                
	                                <label for="ciudadx" class="col-md-3 control-label mt-2">Ciudad <span class="text-red">*</span></label>
	                              	<div class="col-md-4">
		                                <select class="form-control form-select" id="ciudadx" name="ciudadx" required>
								           	<option value="">Sin asignar</option>
											<?$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
											mysqli_set_charset($conn, 'utf8');
											$sql ="SELECT CODIGO, NOMBRE FROM CIUDADES";
											$result = $conn->query($sql);
											if ($result->num_rows > 0) {	
												while($row = mysqli_fetch_array($result) ) { ?>
													<option value="<?=$row[0]?>" <?if ($row[0] == $ciudadpunto) { ?>selected <? } ?>><?=$row[1]?></option>
												<? } 
											}
											$conn->close();?>	
										</select>	
									</div>
	                                <label for="clientex" class="col-md-3 control-label mt-2">Patrocinado por </span></label>
		 	                        <div class="col-md-4">	                                
		                                <select class="form-control form-select" id="clientex" name="clientex">
								           	<option value="">Sin patrocinio</option>
											<?$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
											mysqli_set_charset($conn, 'utf8');
											$sql ="SELECT CODIGO, NOMBRE FROM CLIENTES";
											$result = $conn->query($sql);
											if ($result->num_rows > 0) {	
												while($row = mysqli_fetch_array($result) ) { ?>
													<option value="<?=$row[0]?>" <?if ($row[0] == $clientepunto) { ?>selected <? } ?>><?=$row[1]?></option>
												<? } 
											}
											$conn->close();?>											
										</select>											
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
													<option value="<?=$row[0]?>" <?if ($row[0] == $iconopunto) { ?>selected <? } ?>><?=$row[1]?></option>
												<? } 
											}
											$conn->close();?>											
										</select>	
									</div>
	                                <label class="col-md-3 control-label mt-2">Latitud <span class="text-red">*</span></label>
	                                <div class="col-md-12">
	                                    <input type="text" class="form-control" name="latitudx" id="latitudx" required value="<?=$latitudpunto?>"/>	                     
	                                </div>				
	                                <label class="col-md-3 control-label mt-2">Longitud <span class="text-red">*</span></label>
	                                <div class="col-md-12">
	                                    <input type="text" class="form-control" name="longitudx" id="longitudx" required value="<?=$longitudpunto?>"/>	                     
	                                </div>	
                                	<label class="col-md-3 control-label mt-2">Texto búsqueda <span class="text-red">*</span></label>		                                
	                                <div class="col-md-12">
	                                    <textarea class="form-control" name="busquedax" id="busquedax"/><?=$busqueda?></textarea>
	                                </div>			                                
	                            </div>                                                                                          
	                            <div class="modal-footer">
	                            	<a class="btn btn-sm btn-danger pull-left" onclick="borraPoint('<?=$p?>')"><i class="fa fa-close"></i>  Eliminar este registro</a>
									<a href="javascript:;" class="btn btn-sm btn-white" data-bs-dismiss="modal">Cancelar</a>
									<button type="submit" class="btn btn-sm btn-success">Guardar</button>
								</div>
	                        </form>

						<? } ?>

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
							<h4 class="modal-title">Alta de Punto</h4>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" name="gestform" id="gestform" method="post" action="points.php">
								<input type="hidden" name="a" value="100">
	                            <div class="form-group">
	                                <label class="col-md-3 control-label mt-2">Nombre <span class="text-red">*</span></label>
	                                <div class="col-md-12">
	                                    <input type="text" class="form-control" name="nombre" id="nombre" required/>
	                                </div>
	                                <label class="col-md-3 control-label mt-2">Descripción <img src="imagenes/es.png"></label>
	                                <div class="col-md-12">
	                                    <textarea class="form-control" name="descripcion1" id="descripcion1"/></textarea>
	                                </div>
	                                <label class="col-md-3 control-label mt-2">Descripción <img src="imagenes/en.png"></label>
	                                <div class="col-md-12">
	                                    <textarea class="form-control" name="descripcion2" id="descripcion2"/></textarea>
	                                </div>	
	                                <label class="col-md-3 control-label mt-2">Descripción <img src="imagenes/fr.png"></label>
	                                <div class="col-md-12">
	                                    <textarea class="form-control" name="descripcion3" id="descripcion3"/></textarea>
	                                </div>	
	                                <label class="col-md-3 control-label mt-2">Descripción <img src="imagenes/ca.png"></label>
	                                <div class="col-md-12">
	                                    <textarea class="form-control" name="descripcion4" id="descripcion4"/></textarea>
	                                </div>		       
		                            <label class="col-md-3 control-label mt-2">Localización</label>	                                
		                            <div class="col-md-12">
		                                <textarea class="form-control" name="localizacion" id="localizacion"/><?=$localizacion?></textarea>
		                            </div>		                                                         	                                	                                	
	                                <label for="ciudad" class="col-md-3 control-label mt-2">Ciudad <span class="text-red">*</span></label>
	                                <select class="form-control form-select" id="ciudad" name="ciudad" required>
							           	<option value="">Sin asignar</option>
										<?$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
										mysqli_set_charset($conn, 'utf8');
										$sql ="SELECT CODIGO, NOMBRE FROM CIUDADES";
										$result = $conn->query($sql);
										//$row = $result->fetch_assoc();
										if ($result->num_rows > 0) {	
											while($row = mysqli_fetch_array($result) ) { ?>
												<option value="<?=$row[0]?>"><?=$row[1]?></option>
											<? } 
										}?>
									</select>	
	                                <label for="clientex" class="col-md-3 control-label mt-2">Patrocinado por </span></label>
	                                <select class="form-control form-select" id="clientex" name="clientex">
							           	<option value="">Sin patrocinio</option>
										<?$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
										mysqli_set_charset($conn, 'utf8');
										$sql ="SELECT CODIGO, NOMBRE FROM CLIENTES";
										$result = $conn->query($sql);
										if ($result->num_rows > 0) {	
											while($row = mysqli_fetch_array($result) ) { ?>
												<option value="<?=$row[0]?>"><?=$row[1]?></option>
											<? } 
										}
										$conn->close();?>											
									</select>									
	 	                            <label for="icono" class="col-md-3 control-label mt-2">Icono </span></label>
	                                <select class="form-control form-select" id="icono" name="icono" required>
							           	<option value="">Seleccionar</option>
										<?$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
										mysqli_set_charset($conn, 'utf8');
										$sql ="SELECT CODIGO, NOMBRE FROM GALERIA";
										$result = $conn->query($sql);
										if ($result->num_rows > 0) {	
											while($row = mysqli_fetch_array($result) ) { ?>
												<option value="<?=$row[0]?>"><?=$row[1]?></option>
											<? } 
										}
										$conn->close();?>											
									</select>									
	                                <label class="col-md-3 control-label mt-2">Latitud <span class="text-red">*</span></label>
	                                <div class="col-md-12">
	                                    <input type="text" class="form-control" name="latitud" id="latitud" required/>	                                    
	                                </div>				
	                                <label class="col-md-3 control-label mt-2">Longitud <span class="text-red">*</span></label>
	                                <div class="col-md-12">
	                                    <input type="text" class="form-control" name="longitud" id="longitud" required/>	                                    
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