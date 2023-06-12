<?php include 'conexion.php';
include 'functions.php';
include "auth.php";

if ($auth == 1){
	
	$tour = $_GET["p"];
	$opc = 6;

	if ($_POST["a"] == 100){

		$codigotour 	= get_item_code(10);
		$titulo1 		= str_replace("'","\'",$_POST["titulo1"]);
		$descripcion1 	= str_replace("'","\'",$_POST["descripcion1"]);
		$titulo2 		= str_replace("'","\'",$_POST["titulo2"]);
		$descripcion2 	= str_replace("'","\'",$_POST["descripcion2"]);
		$titulo3 		= str_replace("'","\'",$_POST["titulo3"]);
		$descripcion3 	= str_replace("'","\'",$_POST["descripcion3"]);
		$titulo4 		= str_replace("'","\'",$_POST["titulo4"]);
		$descripcion4 	= str_replace("'","\'",$_POST["descripcion4"]);	 

		$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
		mysqli_set_charset($conn, 'utf8');		
		$sql = "INSERT INTO TOUR (codigo, titulo1, descripcion1, titulo2, descripcion2, titulo3, descripcion3, titulo4, descripcion4, orden) VALUES ('$codigotour', '$titulo1', '$descripcion1', '$titulo2', '$descripcion2', '$titulo3', '$descripcion3', '$titulo4', '$descripcion4', 9999)";
		$conn->query($sql);
		$conn->close();	    	
	}

	if ($_POST["a"] == 1000){

		$codigox        = $_POST["id"];
		$titulox1 		= str_replace("'","\'",$_POST["titulox1"]);
		$descripcionx1 	= str_replace("'","\'",$_POST["descripcionx1"]);
		$titulox2 		= str_replace("'","\'",$_POST["titulox2"]);
		$descripcionx2 	= str_replace("'","\'",$_POST["descripcionx2"]);
		$titulox3 		= str_replace("'","\'",$_POST["titulox3"]);
		$descripcionx3 	= str_replace("'","\'",$_POST["descripcionx3"]);
		$titulox4 		= str_replace("'","\'",$_POST["titulox4"]);
		$descripcionx4 	= str_replace("'","\'",$_POST["descripcionx4"]);	

		$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
		mysqli_set_charset($conn, 'utf8');		
		$sql = "UPDATE TOUR SET TITULO1 = '$titulox1', DESCRIPCION1 ='$descripcionx1', TITULO2 = '$titulox2', DESCRIPCION2 ='$descripcionx2', TITULO3 = '$titulox3', DESCRIPCION3 ='$descripcionx3', TITULO4 = '$titulox4', DESCRIPCION4 ='$descripcionx4' WHERE CODIGO = '$codigox'";
		$conn->query($sql);
		$conn->close();	
	} ?>

	<!DOCTYPE html>
	<html lang="es">
		<head>
			<? include "head.html"; ?>
			<script>			
				function borraItem(v){
					var r = confirm("Por favor, confirme que desea eliminar este registro.");
					if (r == true) {
						var dataString = 'p='+v+'';
						    $.ajax({
		        		    type: "POST",
		    		        url: "_borraTour.php",
				            data: dataString,
		            		success: function() {           
		            	    	alert("Registro eliminado")
		            	    	location.href = "tour.php";
		        	    	}
		    	    	});
					}
				}
			</script>						
		</head>					
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
							<h4 class="panel-title">Tour formación (dispositivas)</h4>
							<div class="panel-heading-btn">
								<a href="#add-option"  data-bs-toggle="modal" class="btn btn-xs btn-icon btn-success" ><i class="fas fa-plus"></i></a>
							</div> 							
						</div>
						<div class="panel-body">
							<?if ($tour == "" || is_null($tour)){ ?>
			           			<div class="table-responsive">
									<table id="data-table-default" class="table table-striped table-bordered align-middle">
										<thead>
											<tr>
												<th>Código</th>
												<th>Titulo</th>
												<th>Descripción</th>
												<th>Acciones</th>
											</tr>
										</thead>
										<tbody>
											<? $conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
											mysqli_set_charset($conn, 'utf8');
											$sql = "SELECT CODIGO, TITULO1, DESCRIPCION1 FROM TOUR ORDER BY ORDEN";
											$result = $conn->query($sql);
											if ($result->num_rows > 0) {
												while($row = $result->fetch_assoc()) { 
										  			$codigotour 	= $row["CODIGO"];
										  			$titulotour 	= $row["TITULO1"];
										  			$descriptour	= $row["DESCRIPCION1"];
										    		?>  
													<tr>
														<td><?=$codigotour?></td>
														<td><?=$titulotour?></td>
														<td><?=$descriptour?></td>
														<td><a href="tour.php?p=<?=$codigotour?>" class="btn btn-xs btn-info" title="Gestionar registro"><i class="fas fa-edit"></i></a>
													</tr>
												<?}
											} else { ?>
		    									<tr>
													<td colspan="4">No hay registros</td>
												</tr>	
											<? } ?>
 										</tbody>
									</table>
								</div>
							<? } else { 

								$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);	
								mysqli_set_charset($conn, 'utf8');
								$sql = "SELECT CODIGO, TITULO1, DESCRIPCION1, TITULO2, DESCRIPCION2, TITULO3, DESCRIPCION3, TITULO4, DESCRIPCION4, IMAGEN FROM TOUR WHERE CODIGO ='$tour'";
								$result = $conn->query($sql);		
								$row = $result->fetch_assoc();
								if ($result->num_rows > 0) {
									$codigotour	    = $row["CODIGO"];
									$titulo1tour	= $row["TITULO1"];
									$descrip1tour 	= $row["DESCRIPCION1"];
									$titulo2tour	= $row["TITULO2"];
									$descrip2tour 	= $row["DESCRIPCION2"];
									$titulo3tour	= $row["TITULO3"];
									$descrip3tour 	= $row["DESCRIPCION3"];
									$titulo4tour	= $row["TITULO4"];
									$descrip4tour 	= $row["DESCRIPCION4"];
									$imagentour  	= $row["IMAGEN"];
								}
								$conn->close();								
								?>
								<form class="form-horizontal" name="gestformx" id="gestformx" method="post" action="tour.php">
	 								<input type="hidden" name="a" value="1000">
									<input type="hidden" name="id" id="id" value="<?=$codigotour?>">
		                            <div class="form-group">
		                            	<? $clave1 = RandomString(4);
		                            	$clave2 = RandomString(4);
										$nombreimagen = "IMG-".$clave1."-".$clave2."" ;?>
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
				        					data-service="assets/cropper/server/async2.php?id=<?=$codigotour?>&n=<?=$nombreimagen?>" id="my-cropper" style="width:300px;height:200px;">
				        					<?if ($imagentour == "" || is_null($imagentour)) { ?>
			    	    						<input type="file" name="slim[]"/>
			        						<? } else { ?>
			        							<input type="file" name="slim[]"/>
			        							<img class="rounded" src="data/tour/<?=$imagentour?>" alt="" style="width:300px;height:200px;">
			        						<? } ?>
			    						</div>	                            	
		                                <label class="col-md-3 control-label mt-2">Título <img src="imagenes/es.png"> <span class="text-red">*</span></label>
		                                <div class="col-md-12">
		                                    <input type="text" class="form-control" name="titulox1" id="titulox1" required value="<?=$titulo1tour?>"/>
		                                </div>
		                                <label class="col-md-3 control-label mt-2">Descripción <img src="imagenes/es.png"></label>
		                                <div class="col-md-12">
		                                    <textarea class="form-control" name="descripcionx1" id="descripcionx1"/><?=$descrip1tour?></textarea>
		                                </div>	
            							<label class="col-md-3 control-label mt-2">Título <img src="imagenes/en.png"> <span class="text-red">*</span></label>                       
		                                <div class="col-md-12">
		                                    <input type="text" class="form-control" name="titulox2" id="titulox2" required value="<?=$titulo2tour?>"/>
		                                </div>
		                                <label class="col-md-3 control-label mt-2">Descripción <img src="imagenes/en.png"></label>
		                                <div class="col-md-12">
		                                    <textarea class="form-control" name="descripcionx2" id="descripcionx2"/><?=$descrip2tour?></textarea>
		                                </div>	
            							<label class="col-md-3 control-label mt-2">Título <img src="imagenes/fr.png"> <span class="text-red">*</span></label>                      
		                                <div class="col-md-12">
		                                    <input type="text" class="form-control" name="titulox3" id="titulox3" required value="<?=$titulo3tour?>"/>
		                                </div>
		                                <label class="col-md-3 control-label mt-2">Descripción <img src="imagenes/fr.png"></label>
		                                <div class="col-md-12">
		                                    <textarea class="form-control" name="descripcionx3" id="descripcionx3"/><?=$descrip3tour?></textarea>
		                                </div>	
            							<label class="col-md-3 control-label mt-2">Título <img src="imagenes/ca.png"> <span class="text-red">*</span></label>	              
		                                <div class="col-md-12">
		                                    <input type="text" class="form-control" name="titulox4" id="titulox4" required value="<?=$titulo4tour?>"/>
		                                </div>
		                                <label class="col-md-3 control-label mt-2">Descripción <img src="imagenes/ca.png"></label>
		                                <div class="col-md-12">
		                                    <textarea class="form-control" name="descripcionx4" id="descripcionx4"/><?=$descrip4tour?></textarea>
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
				<!-- END scroll to top btn -->
			</div>
			<!-- END #app -->

			<div class="modal fade" id="add-option">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Alta de Tour (Diapositiva)</h4>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" name="gestform" id="gestform" method="post" action="tour.php">
								<input type="hidden" name="a" value="100">
	                            <div class="form-group">
	                                <label class="col-md-3 control-label mt-2">Título <img src="imagenes/es.png"> <span class="text-red">*</span></label>
	                                <div class="col-md-12">
	                                    <input type="text" class="form-control" name="titulo1" id="titulo1" required/>
	                                </div>
	                                <label class="col-md-3 control-label mt-2">Descripción <img src="imagenes/es.png"></label>
	                                <div class="col-md-12">
	                                    <textarea class="form-control" name="descripcion1" id="descripcion1"/></textarea>
	                                </div>
                    				<label class="col-md-3 control-label mt-2">Título <img src="imagenes/en.png"> <span class="text-red">*</span></label>
	                                <div class="col-md-12">
	                                    <input type="text" class="form-control" name="titulo2" id="titulo2" required/>
	                                </div>
	                                <label class="col-md-3 control-label mt-2">Descripción <img src="imagenes/en.png"></label>
	                                <div class="col-md-12">
	                                    <textarea class="form-control" name="descripcion2" id="descripcion2"/></textarea>
	                                </div>
                    				<label class="col-md-3 control-label mt-2">Título <img src="imagenes/fr.png"> <span class="text-red">*</span></label>
	                                <div class="col-md-12">
	                                    <input type="text" class="form-control" name="titulo3" id="titulo3" required/>
	                                </div>
	                                <label class="col-md-3 control-label mt-2">Descripción <img src="imagenes/fr.png"></label>
	                                <div class="col-md-12">
	                                    <textarea class="form-control" name="descripcion3" id="descripcion3"/></textarea>
	                                </div>	                                
          							<label class="col-md-3 control-label mt-2">Título <img src="imagenes/ca.png"> <span class="text-red">*</span></label>
	                                <div class="col-md-12">
	                                    <input type="text" class="form-control" name="titulo4" id="titulo4" required/>
	                                </div>
	                                <label class="col-md-3 control-label mt-2">Descripción <img src="imagenes/ca.png"></label>
	                                <div class="col-md-12">
	                                    <textarea class="form-control" name="descripcion4" id="descripcion4"/></textarea>
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