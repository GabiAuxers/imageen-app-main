<?php include 'conexion.php';
include 'functions.php';
include "auth.php";

if ($auth == 1){

	$opc = 101;
	$v =  $_GET["v"];
	$id = $_GET["id"];

	if ($_POST["p"] == 100) {

		$codigotxt  = get_item_code(4);
		$text1  = $_POST["idioma1"];		
		$text2  = $_POST["idioma2"];		
		$text3  = $_POST["idioma3"];		
		$text4  = $_POST["idioma4"];		

		$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
		mysqli_set_charset($conn, 'utf8');			
		$sql = "INSERT INTO STRINGS (codigo, text_1, text_2, text_3, text_4) VALUES ('$codigotxt', '$text1', '$text2', '$text3', '$text4')";
		$conn->query($sql);
		$conn->close();	 
    }

    if ($_POST["p"] == 200) {	

		$id		 = $_POST["id"];
		$text1x  = $_POST["idioma1x"];		
		$text2x  = $_POST["idioma2x"];		
		$text3x  = $_POST["idioma3x"];		
		$text4x  = $_POST["idioma4x"];

		$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
		mysqli_set_charset($conn, 'utf8');			
		$sql = "UPDATE STRINGS SET TEXT_1 = '$text1x', TEXT_2 = '$text2x', TEXT_3 = '$text3x', TEXT_4 = '$text4x' WHERE CODIGO = '$id'";
		$conn->query($sql);
		$conn->close();		
	} ?>
	

	<!DOCTYPE html>
	<html lang="es">
		<head>
			
			<? include "head.html";?>

			<script>
				function abreModal(){
					$("#edit-txt").modal('show');										
				}	
			</script>				
		</head>

		<body <?if ($v == 1) {?>onLoad="abreModal();"<? } ?>>

			<div id="loader" class="app-loader">
				<span class="spinner"></span>
			</div>

			<div id="app" class="app app-header-fixed app-sidebar-fixed">

				<? include "header.php";?>
				<? include "sidebar.php";?>

				<div class="app-sidebar-bg"></div>
				<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a></div>

				<div id="content" class="app-content">
					
					<div class="panel panel-inverse">
						<div class="panel-heading">
							<h4 class="panel-title">Listado</h4>	
							<div class="pull-right m-r-10 m-b-0">
								<a href="#alta-txt" data-bs-toggle="modal" class="btn btn-green btn-xs"><i class="fas fa-plus m-r-5"></i></a>
							</div>
						</div>					 				

						<div class="panel-body">

							<div class="row">
		           				<div class="table-responsive">
									<table id="data-table-default" class="table table-striped table-bordered align-middle">
										<thead>
											<tr>
		                                    	<th>Index</th>
											  	<th style="width:20%;">ES <img src="imagenes/es.png" style="width:20px;margin-left:30px;"></th>
											  	<th style="width:20%;">EN <img src="imagenes/en.png" style="width:20px;margin-left:30px;"></th>
	  											<th style="width:20%;">FR <img src="imagenes/fr.png" style="width:20px;margin-left:30px;"></th>		
	  											<th style="width:20%;">CA <img src="imagenes/ca.png" style="width:20px;margin-left:30px;"></th>	  			
		                                      	<th>Acciones</th>
										  	</tr>
									  	</thead>   
									  	<tbody>
											<?$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
											mysqli_set_charset($conn, 'utf8');
											$sql = "SELECT CODIGO, TEXT_1, TEXT_2, TEXT_3, TEXT_4 FROM strings ORDER BY TEXT_1";
											$result = $conn->query($sql);
											if ($result->num_rows > 0) {?>
												<?while($row = mysqli_fetch_array($result) ) {				
										  			$idtxt	= $row[0];
										  			$text1	= $row[1];
										  			$text2	= $row[2];
										  			$text3	= $row[3];
										  			$text4	= $row[4];
										    		?>  
													<tr>      
		                                            	<td><strong><?=$idtxt?></strong></td>                                            
														<td><?=$text1?></td>
		                                        	    <td><?=$text2?></td>
		                                        	    <td><?=$text3?></td>
		                                        	    <td><?=$text4?></td>		                                        	    		                             
		                                                <td>
															<a href="translate.php?v=1&id=<?=$idtxt?>" class="btn btn-info btn-xs">
																<i class="fas fa-edit"></i>
															</a>
														</td>
													</tr>
												<?}
											}else{ ?>
		    									<tr>
													<td colspan="5">No hay registros</td>
												</tr>	
											<?}

											$conn->close();?>										  		
                           
										</tr>
									  </tbody>
								  </table>            
								</div>
							</div>
						</div><!--/col-->
					
					</div><!--/row-->
				</div>

				<div class="modal fade" id="alta-txt">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Alta texto/traducciones</h4>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<form name="altatXT" method="post" action="translate.php">
									<input type="hidden" name="p" value="100">					
									<p class="m-b-0 m-t-5">ES</p>
									<textarea class="form-control form-control-sm" type="text" name="idioma1" required/></textarea>
									<p class="m-b-0 m-t-5">EN</p>
									<textarea class="form-control form-control-sm" type="text" name="idioma2"/></textarea>	
									<p class="m-b-0 m-t-5">FR</p>
									<textarea class="form-control form-control-sm" type="text" name="idioma3"/></textarea>															
									<p class="m-b-0 m-t-5">CA</p>
									<textarea class="form-control form-control-sm" type="text" name="idioma4"/></textarea>																			
									<div class="modal-footer">
										<a href="javascript:;" class="btn btn-white" data-bs-dismiss="modal">Cerrar</a>
										<button type="submit" class="btn btn-success">Guardar</button>
									</div>																																			
								</form>
							</div>
						</div>
					</div>
				</div>			


					<div class="modal fade" id="edit-txt">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">Editar texto/traducciones</h4>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<?if ($v == 1) {

							        include "conexion.php";
							        $conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
							        mysqli_set_charset($conn, 'utf8');	
							        $sql = "SELECT	CODIGO, TEXT_1, TEXT_2, TEXT_3, TEXT_4 FROM STRINGS WHERE CODIGO ='$id'";
							        $result = $conn->query($sql);
							        $row = $result->fetch_assoc();
							        if ($result->num_rows > 0) {
							        	$codigo = $row["CODIGO"];
							            $text1  = $row["TEXT_1"];   
							            $text2  = $row["TEXT_2"];
							            $text3  = $row["TEXT_3"];
							            $text4  = $row["TEXT_4"];
							        }
							        $conn->close();
								} ?>

								<div class="modal-body">
									<form name="altatxt" method="post" action="translate.php">
										<input type="hidden" name="p" value="200">
										<input type="hidden" id="id" name="id" value="<?=$codigo?>">						
										<p class="m-b-0 m-t-5">ES</p>
										<textarea class="form-control form-control-sm" id="idioma1x" name="idioma1x" required/><?=$text1?></textarea>
										<p class="m-b-0 m-t-5">EN</p>
										<textarea class="form-control form-control-sm" id="idioma2x" name="idioma2x"/><?=$text2?></textarea>					
										<p class="m-b-0 m-t-5">FR</p>
										<textarea class="form-control form-control-sm" id="idioma3x" name="idioma3x"/><?=$text3?></textarea>									
										<p class="m-b-0 m-t-5">CA</p>
										<textarea class="form-control form-control-sm" id="idioma4x" name="idioma4x"/><?=$text4?></textarea>																		
										<div class="modal-footer">
											<a href="javascript:;" class="btn btn-white" data-bs-dismiss="modal">Cerrar</a>
											<button type="submit" class="btn btn-success">Guardar</button>
										</div>																																			
									</form>
								</div>
							</div>
						</div>
					</div>	
				
				<!-- BEGIN scroll to top btn -->
				<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
				<!-- END scroll to top btn -->
			</div>
			<!-- END #app -->

			<? include "js.php";?>

		</body>
	</html>
<? }else{ 

	header ("Location: default.php");   

}?>