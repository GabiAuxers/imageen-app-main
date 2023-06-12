<?php include 'conexion.php';
include 'functions.php';
include "auth.php";

if ($auth == 1){
	$opc = 5;

	$p = $_GET["p"];
	$m = $_GET["m"];


	if ($_POST["a"] == 100){
		$codigosuscripcion = get_item_code(9).RandomString(3);
		$nombre1 	= $_POST["nombre1"];
		$nombre2	= $_POST['nombre2'];
		$nombre3	= $_POST['nombre3'];
		$nombre4	= $_POST['nombre4'];
		$validez 	= $_POST['validez'];
		$precio		= $_POST['precio'];
		$activa		= $_POST['activa'];
		$destacada	= $_POST['destacada'];
		$stripe		= $_POST['stripe'];						

		$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
		mysqli_set_charset($conn, 'utf8');			
		$sql = "INSERT INTO SUSCRIPCIONES (codigo, nombre1, nombre2, nombre3, nombre4, validez, precio, activa, destacada, stripeprice) VALUES ('$codigosuscripcion', '$nombre1', '$nombre2', '$nombre3', '$nombre4', '$validez', '$precio', '$activa', '$destacada', '$stripe')";
		$conn->query($sql);
		$conn->close();	 		
	}	

	if ($_POST["a"] == 1000){

		$idx        = $_POST["idx"];
		$nombre1x 	= $_POST["nombre1x"];
		$nombre2x 	= $_POST["nombre2x"];		
		$nombre3x   = $_POST["nombre3x"];
		$nombre4x   = $_POST["nombre4x"];
		$validezx   = $_POST["validezx"];
		$preciox    = $_POST["preciox"];
		$activax	= $_POST['activax'];
		$destacadax	= $_POST['destacadax'];
		$stripex	= $_POST['stripex'];		

		$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
		mysqli_set_charset($conn, 'utf8');			
		$sql = "UPDATE SUSCRIPCIONES SET NOMBRE1 = '$nombre1x', NOMBRE2 = '$nombre2x', NOMBRE3 ='$nombre3x', NOMBRE4 = '$nombre4x', VALIDEZ ='$validezx', PRECIO = '$preciox', ACTIVA = '$activax', DESTACADA = '$destacadax', STRIPEPRICE = '$stripex' WHERE CODIGO = '$idx'";
		$conn->query($sql);
		$conn->close();	

	}

?>

	<!DOCTYPE html>
	<html lang="es">
		<head>
			<? include "head.html"; ?>
			<script>
				function setValues(a,b,c,d,e,f,g,h,i,j){
					document.gestformx.idx.value = a;
					document.gestformx.nombre1x.value = b;	
					document.gestformx.nombre2x.value = c;
					document.gestformx.nombre3x.value = d;
					document.gestformx.nombre4x.value = e;															
					document.gestformx.validezx.value = f;
					document.gestformx.preciox.value = g;
					document.gestformx.activax.value  = h;
					document.gestformx.destacadax.value  = i;										
					document.gestformx.stripex.value  = j;																		
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
							<h4 class="panel-title">Suscripciones</h4>
							<div class="panel-heading-btn">
								<a href="#add-option"  data-bs-toggle="modal" class="btn btn-xs btn-icon btn-success" ><i class="fas fa-plus"></i></a>
							</div> 											
						</div>
						<div class="panel-body">
		           			<div class="table-responsive">
								<table id="data-table-default" class="table table-striped table-bordered align-middle">
									<thead>
										<tr>
											<th>Código</th>
											<th>Nombre</th>
											<th>Validez</th>
											<th>Precio</th>
											<th>Acciones</th>
										</tr>
									</thead>
									<tbody>
										<?$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
										mysqli_set_charset($conn, 'utf8');
										$sql =  "SELECT CODIGO, NOMBRE1, NOMBRE2, NOMBRE3, NOMBRE4, VALIDEZ, PRECIO, ACTIVA, DESTACADA, STRIPEPRICE FROM SUSCRIPCIONES";
										$result = $conn->query($sql);
										if ($result->num_rows > 0) {?>
											<?while($row = mysqli_fetch_array($result) ) {				
									  			$codigosuscripcion	= $row[0];
									  			$nombre1suscripcion	= $row[1];
									  			$nombre2suscripcion	= $row[2];
									  			$nombre3suscripcion	= $row[3];
									  			$nombre4suscripcion	= $row[4];									  												  		  			
									  			$validezsuscripcion	= $row[5];
									  			$preciosuscripcion  = $row[6];
									  			$activasuscripcion  = $row[7];
												$destacadasuscripcion  = $row[8];
									  			$stripesuscripcion  = $row[9];
									    		?>  
												<tr>
													<? if($activasuscripcion) {?>
														<td><?=$codigosuscripcion?></td>
														<td><?=$nombre1suscripcion?></td>
														<td><?=$validezsuscripcion?></td>
														<td><?=$preciosuscripcion?></td>
													<? } else { ?>
														<td style="text-decoration:line-through;"><?=$codigosuscripcion?></td>
														<td style="text-decoration:line-through;"><?=$nombre1suscripcion?></td>
														<td style="text-decoration:line-through;"><?=$validezsuscripcion?></td>
														<td style="text-decoration:line-through;"><?=$preciosuscripcion?></td>
													<? } ?>
														<td><a href="#edit-option" class="btn btn-xs btn-info" data-bs-toggle="modal" title="Gestionar registro" onclick="setValues('<?=$codigosuscripcion?>','<?=$nombre1suscripcion?>','<?=$nombre2suscripcion?>','<?=$nombre3suscripcion?>','<?=$nombre4suscripcion?>','<?=$validezsuscripcion?>','<?=$preciosuscripcion?>','<?=$activasuscripcion?>','<?=$destacadasuscripcion?>','<?=$stripesuscripcion?>')"><i class="fas fa-edit"></i></a></td>
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

			<div class="modal fade" id="add-option">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Alta de suscripción</h4>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" name="gestform" id="gestform" method="post" action="membership.php">
								<input type="hidden" name="a" value="100">
	                            <div class="form-group">
	                                <label class="col-md-3 control-label mt-2">Nombre suscripción <img src="imagenes/es.png"> <span class="text-red">*</span></label>
	                                <div class="col-md-12">
	                                    <input type="text" class="form-control" name="nombre1" id="nombre1" required/>
	                                </div>
	                                <label class="col-md-3 control-label mt-2">Nombre suscripción <img src="imagenes/en.png"> <span class="text-red">*</span></label>
	                                <div class="col-md-12">
	                                    <input type="text" class="form-control" name="nombre2" id="nombre2" required/>
	                                </div>
	                                <label class="col-md-3 control-label mt-2">Nombre suscripción <img src="imagenes/fr.png"> <span class="text-red">*</span></label>
	                                <div class="col-md-12">
	                                    <input type="text" class="form-control" name="nombre3" id="nombre3" required/>
	                                </div>
	                                <label class="col-md-3 control-label mt-2">Nombre suscripción <img src="imagenes/ca.png"> <span class="text-red">*</span></label>
	                                <div class="col-md-12">
	                                    <input type="text" class="form-control" name="nombre4" id="nombre4" required/>
	                                </div>	  
	                                <label class="col-md-3 control-label mt-2">Validez (días) <span class="text-red">*</span></label>
	                                <div class="col-md-4">
	                                    <input type="text" class="form-control" name="validez" id="validez" required/>
	                                </div>	
	                                <label class="col-md-3 control-label mt-2">Importe <span class="text-red">*</span></label>
	                                <div class="col-md-4">
	                                    <input type="number" class="form-control" name="precio" id="precio" step="0.01" required/>
	                                </div>
	                                <label class="col-md-3 control-label mt-2">Activa <span class="text-red">*</span></label>
	                                <div class="col-md-8">
	                                    <input type="text" class="form-control" name="activa" id="activa" required/>
	                                </div>
									<label class="col-md-3 control-label mt-2">Destacada <span class="text-red">*</span></label>
	                                <div class="col-md-8">
	                                    <input type="text" class="form-control" name="destacada" id="destacada" required/>
	                                </div>	                                                                 	                                	                                
	                                <label class="col-md-3 control-label mt-2">Código Stripe <span class="text-red">*</span></label>
	                                <div class="col-md-8">
	                                    <input type="text" class="form-control" name="stripe" id="stripe" required/>
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

			<div class="modal fade" id="edit-option">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Edición de Cliente</h4>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" name="gestformx" id="gestformx" method="post" action="membership.php">
 								<input type="hidden" name="a" value="1000">
								<input type="hidden" name="idx" id="idx">
	                            <div class="form-group">
	                            <div class="form-group">
	                                <label class="col-md-3 control-label mt-2">Nombre suscripción <img src="imagenes/es.png"> <span class="text-red">*</span></label>
	                                <div class="col-md-12">
	                                    <input type="text" class="form-control" name="nombre1x" id="nombre1x" required/>
	                                </div>
	                                <label class="col-md-3 control-label mt-2">Nombre suscripción <img src="imagenes/en.png"> <span class="text-red">*</span></label>
	                                <div class="col-md-12">
	                                    <input type="text" class="form-control" name="nombre2x" id="nombre2x" required/>
	                                </div>
	                                <label class="col-md-3 control-label mt-2">Nombre suscripción <img src="imagenes/fr.png"> <span class="text-red">*</span></label>
	                                <div class="col-md-12">
	                                    <input type="text" class="form-control" name="nombre3x" id="nombre3x" required/>
	                                </div>
	                                <label class="col-md-3 control-label mt-2">Nombre suscripción <img src="imagenes/ca.png"> <span class="text-red">*</span></label>
	                                <div class="col-md-12">
	                                    <input type="text" class="form-control" name="nombre4x" id="nombre4x" required/>
	                                </div>	    
	                                <label class="col-md-3 control-label mt-2">Validez (días) <span class="text-red">*</span></label>
	                                <div class="col-md-4">
	                                    <input type="text" class="form-control" name="validezx" id="validezx" required/>
	                                </div>	
	                                <label class="col-md-3 control-label mt-2">Importe <span class="text-red">*</span></label>
	                                <div class="col-md-4">
	                                    <input type="number" class="form-control" name="preciox" id="preciox" step="0.01" required/>
	                                </div>
	                                <label class="col-md-3 control-label mt-2">Activa <span class="text-red">*</span></label>
	                                <div class="col-md-8">
	                                    <input type="text" class="form-control" name="activax" id="activax" required/>
	                                </div>
									<label class="col-md-3 control-label mt-2">Destacada <span class="text-red">*</span></label>
	                                <div class="col-md-8">
	                                    <input type="text" class="form-control" name="destacadax" id="destacadax" required/>
	                                </div>		                                                            	                                	                                
	                                <label class="col-md-3 control-label mt-2">Código Stripe <span class="text-red">*</span></label>
	                                <div class="col-md-8">
	                                    <input type="text" class="form-control" name="stripex" id="stripex" required/>
	                                </div>		                                                            	                                	                                		                                                            	                                	                                
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