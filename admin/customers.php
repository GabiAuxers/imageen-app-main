<?php include 'conexion.php';
include 'functions.php';
include "auth.php";

if ($auth == 1){
	
	$opc = 3;
	
	$c = $_GET["c"];


	if ($_POST["a"] == 100){

		$codigopunto  = get_item_code(6);
		$nombre = str_replace("'","\'",$_POST["nombre"]);

		$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
		mysqli_set_charset($conn, 'utf8');		
		$sql = "INSERT INTO CLIENTES (codigo, nombre, inicio, global) VALUES ('$codigopunto', '$nombre', 0, 0)";
		$conn->query($sql);
		$conn->close();	 
	}

	if ($_POST["a"] == 1000) {

		if ($_POST["iniciox"] != "") {
			$inicio = 1;
		}else{
			$inicio = 0;
		}
	
		if ($_POST["globalx"] != "") {
			$global = 1;
		}else{
			$global = 0;
		}

		$id      	= $_POST["id"];
		$nombrex 	= str_replace("'","\'",$_POST["nombrex"]);
		$texto1x 	= str_replace("'","\'",$_POST["texto1x"]);
		$texto2x 	= str_replace("'","\'",$_POST["texto2x"]);
		$texto3x 	= str_replace("'","\'",$_POST["texto3x"]);
		$texto4x 	= str_replace("'","\'",$_POST["texto4x"]);
		$latitudx  	= $_POST["latitudx"];	
		$longitudx 	= $_POST["longitudx"];			
		$zoomx   	= $_POST["zoomx"];		
		
		$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
		mysqli_set_charset($conn, 'utf8');		
		$sql = "UPDATE CLIENTES SET NOMBRE = '$nombrex', TEXTO1 = '$texto1x', TEXTO2 = '$texto2x', TEXTO3 ='$texto3x', TEXTO4 ='$texto4x', LONGITUD_INICIO = '$longitudx', LATITUD_INICIO ='$latitudx', ZOOM_INICIO ='$zoomx', GLOBAL = '$global', INICIO ='$inicio' WHERE CODIGO = '$id'";
		$conn->query($sql);
		$conn->close();	

	} ?>

	<!DOCTYPE html>
	<html lang="es">
		<head>
			<? include "head.html"; ?>

			<script>			
				function borraItem(v){
					var r = confirm("Por favor, confirme que desea eliminar este registro. ATENCIÓN. si borra un cliente eso puede afectar al funcionamiento de la aplicación. Verifique que este cliente no tiene información vinculada (puntos, etc)");
					if (r == true) {
						var dataString = 'v='+v+'';
						    $.ajax({
		        		    type: "POST",
		    		        url: "_borraCustomer.php",
				            data: dataString,
		            		success: function() {           
		            	    	alert("Cliente eliminado");
		            	    	location.href = "customers.php";
		        	    	}
		    	    	});
					}
				}
			</script>	
			<script>
				function openFields(v){
					nEstado = document.getElementById("iniciox").checked;
					if (nEstado){
						v = 1;
					}else{
						v = 0;
					}
					if (v==0){
						document.getElementById("campos_inicio").style.display = "none";
					}else{
						document.getElementById("campos_inicio").style.display = "";
					}
				}	
			</script>					
		</head>

		<body>

			<div id="loader" class="app-loader">
				<span class="spinner"></span>
			</div>

			<div id="app" class="app app-header-fixed app-sidebar-fixed">

				<? include "header.php"; ?>
				<? include "sidebar.php"; ?>

				<div class="app-sidebar-bg"></div>
				<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a></div>

				<div id="content" class="app-content">

					<div class="panel panel-inverse">
						<div class="panel-heading">
							<h4 class="panel-title">Clientes</h4>
							<div class="panel-heading-btn">
								<a href="#add-option"  data-bs-toggle="modal" class="btn btn-xs btn-icon btn-success" ><i class="fas fa-plus"></i></a>
							</div> 											
						</div>
						<div class="panel-body">		
							<?if ($c == "" || is_null($c)) { ?>	
			           			<div class="table-responsive">
									<table id="data-table-default" class="table table-striped table-bordered align-middle">
										<thead>
											<tr>
												<th>Código</th>
												<th>Cliente</th>
												<th>Acciones</th>
											</tr>
										</thead>
										<tbody>

											<?$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
											mysqli_set_charset($conn, 'utf8');
											$sql = "SELECT CODIGO, NOMBRE FROM CLIENTES";
											$result = $conn->query($sql);
											if ($result->num_rows > 0) {
												while($row = $result->fetch_assoc()) { 
										  			$codigocliente	= $row["CODIGO"];
										  			$nombrecliente	= $row["NOMBRE"];
										    		?>  
													<tr>
														<td><?=$codigocliente?></td>
														<td><?=$nombrecliente?></td>
														<td><a href="customers.php?c=<?=$codigocliente?>" class="btn btn-xs btn-info" title="Gestionar registro"><i class="fas fa-edit"></i></a><a href="pointsc.php?c=<?=$codigocliente?>" class="btn btn-info btn-xs ms-1"><i class="fas fa-map-marker-alt"></i></a>
														</td>
													</tr>
												<?}
											}else{ ?>
		    									<tr>
													<td colspan="3">No hay registros</td>
												</tr>	
											<?}
											$conn->close();?>
										</tbody>
									</table>
								</div>

							<? } else { 

								$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);	
								mysqli_set_charset($conn, 'utf8');
								$sql =  "SELECT CODIGO, NOMBRE, INICIO, LATITUD_INICIO, LONGITUD_INICIO, ZOOM_INICIO, IMAGEN, TEXTO1, TEXTO2, TEXTO3, TEXTO4, GLOBAL FROM CLIENTES WHERE CODIGO = '$c'";
								$result = $conn->query($sql);		
								$row = $result->fetch_assoc();
								if ($result->num_rows > 0) {
									$codigocliente	= $row["CODIGO"];
									$nombrecliente	= $row["NOMBRE"];
									$inicio         = $row["INICIO"];
									$latitud_inicio	= $row["LATITUD_INICIO"];
									$longitud_inicio= $row["LONGITUD_INICIO"];
									$zoom_inicio 	= $row["ZOMM_INICIO"];
									$imagen 	 	= $row["IMAGEN"];
									$texto1			= $row["TEXTO1"];
									$texto2			= $row["TEXTO2"];
									$texto3			= $row["TEXTO3"];
									$texto4			= $row["TEXTO4"];
									$global  		= $row["GLOBAL"];
								}
								$conn->close();?>								

								<form class="form-horizontal" name="gestformx" id="gestformx" method="post" action="customers.php">
	 								<input type="hidden" name="a" value="1000">
									<input type="hidden" name="id" id="id" value="<?=$codigocliente?>">
		                            <div class="form-group">		                            	
		                                <label class="col-md-3 control-label mt-2">Nombre <span class="text-red">*</span></label>
		                                <div class="col-md-12">
		                                    <input type="text" class="form-control" name="nombrex" id="nombrex" value="<?=$nombrecliente?>" required/>
		                                </div>
										<div class="form-check form-switch mb-2 mt-2">
											<input class="form-check-input" type="checkbox" name="globalx" id="globalx" value="1" <?if ($global == 1){ ?>checked<? } ?>>
											<label class="form-check-label" for="globalx">Incluir sus puntos en la app global</label>
										</div>		                                
										<div class="form-check form-switch mb-2 mt-2">
											<input class="form-check-input" type="checkbox" name="iniciox" id="iniciox" value="1" onclick="openFields(this.value)" <?if ($inicio == 1) { ?>checked<? } ?>>
											<label class="form-check-label" for="iniciox">Inicio personalizado (PWA)</label>
										</div>	
										<div id="campos_inicio" style="<?if ($inicio == 1) { ?>display:block;<? } else { ?>display:none;<? } ?>">
										    <? $clave1 = RandomString(4);
		                            		$clave2 = RandomString(4);
											$nombreimagen = "IMG-".$clave1."-".$clave2."" ;?>
											<div class="slim" style="width:300px;margin:0 auto;"      
								  				data-label="Click aquí para insertar una imagen"
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
				         						data-size="600,600"
				    							data-ratio="1:1"
					        					data-service="assets/cropper/server/async3.php?id=<?$codigocliente?>&n=<?=$nombreimagen?>" id="my-cropper" style="width:300px;height:300px;">
					        					<?if ($imagen == "" || is_null($imagen)) { ?>
				    	    						<input type="file" name="slim[]"/>
				        						<? } else { ?>
				        							<input type="file" name="slim[]"/>
				        							<img class="rounded" src="data/clientes/<?=$imagen?>" alt="" style="width:300px;height:300px;">
				        						<? } ?>
				    						</div>	
		                                	<label class="col-md-3 control-label mt-2">Texto sobre imagen <img src="imagenes/es.png"> <span class="text-red">*</span></label>
		                                	<div class="col-md-6">
		                                    	<input type="text" class="form-control" name="texto1x" id="texto1x" value="<?=$texto1?>" maxlength="100"/>
		                                	</div>

		                                	<label class="col-md-3 control-label mt-2">Texto sobre imagen <img src="imagenes/en.png"> <span class="text-red">*</span></label>
		                                	<div class="col-md-6">
		                                    	<input type="text" class="form-control" name="texto2x" id="texto2x" value="<?=$texto2?>" maxlength="100"/>
		                                	</div>

		                                	<label class="col-md-3 control-label mt-2">Texto sobre imagen <img src="imagenes/fr.png"> <span class="text-red">*</span></label>
		                                	<div class="col-md-6">
		                                    	<input type="text" class="form-control" name="texto3x" id="texto3x" value="<?=$texto3?>" maxlength="100"/>
		                                	</div>

		                                	<label class="col-md-3 control-label mt-2">Texto sobre imagen <img src="imagenes/ca.png"> <span class="text-red">*</span></label>
		                                	<div class="col-md-6">
		                                    	<input type="text" class="form-control" name="texto4x" id="texto4x" value="<?=$texto4?>" maxlength="100"/>
		                                	</div>	

		                                	<label class="col-md-3 control-label mt-2">Latitud de inicio <span class="text-red">*</span></label>
		                                	<div class="col-md-6">
		                                    	<input type="text" class="form-control" name="latitudx" id="latitudx" value="<?=$latitud_inicio?>" maxlength="40"/>
		                                	</div>

		                                	<label class="col-md-3 control-label mt-2">Longitud de inicio <span class="text-red">*</span></label>
		                                	<div class="col-md-6">
		                                    	<input type="text" class="form-control" name="longitudx" id="longitudx" value="<?=$longitud_inicio?>" maxlength="40"/>
		                                	</div>			                                			                                		                                	

			                                <label for="zommx" class="col-md-3 control-label mt-2">Zoom de inicio <span class="text-red">*</span></label>
			                                <select class="form-control form-select" id="zoomx" name="zoomx" required>
			                                	<?for ($x = 1; $x <= 20; $x++) { ?>
    												<option value="<?=$x?>" <?if ($zoom_inicio == $x) { ?>selected<? } ?>>Nivel <?=$x?></option> 
												<? } ?>	
											</select>	

		                                	<label class="col-md-3 control-label mt-2">Enlace a su PWA</label>
		                                	<div class="col-md-6">
		                                    	<input type="text" class="form-control" value="https://app.imageen.net/default.php?x=<?=$codigocliente?>" disabled/>
		                                	</div>												                                			                                			                                	
										</div>	                                

		                            </div>      

		                            <div class="modal-footer">
		                            	<a class="btn btn-sm btn-danger pull-left" onclick="borraItem($('#id').val())"><i class="fa fa-close"></i>  Eliminar este registro</a>
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
							<h4 class="modal-title">Alta de Cliente</h4>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" name="gestform" id="gestform" method="post" action="customers.php">
								<input type="hidden" name="a" value="100">
	                            <div class="form-group">
	                                <label class="col-md-3 control-label mt-2">Nombre <span class="text-red">*</span></label>
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

		</body>
	</html>

<? } else { 

	header ("Location: default.php");   
	
}
?>