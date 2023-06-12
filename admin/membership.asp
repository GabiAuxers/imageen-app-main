<%@ Language="VBScript" CodePage = 65001 %>
<!--#include file="config.asp"-->
<!--#include file="funciones.asp"-->
<!--#include file="auth.asp"-->

<%if nAuth = 1 then
	opc = 5

	if Request.Form("a") = 100 then ' Alta de registro
		cCodigoSuscripcion = DameCodigoItem(3)&dimeClave()
		SET Ob_Conn =Server.CreateObject("ADODB.Connection")
		SET Ob_RS = Server.CreateObject ("ADODB.RecordSet")
		Ob_Conn.Open cStrConn
		Ob_RS.Open "SUSCRIPCIONES", Ob_Conn, 3, 3
		Ob_RS.AddNew
		Ob_RS("CODIGO")		= cCodigoSuscripcion
		Ob_Rs("NOMBRE1")	= clstxt(Request.Form("nombre1"))
		Ob_Rs("NOMBRE2")	= clstxt(Request.Form("nombre2"))
		Ob_Rs("NOMBRE3")	= clstxt(Request.Form("nombre3"))
		Ob_Rs("NOMBRE4")	= clstxt(Request.Form("nombre4"))
		Ob_Rs("VALIDEZ")	= Request.Form("validez")						
		Ob_Rs("PRECIO")		= Request.Form("precio")
		Ob_Rs("ENLACE")		= Request.Form("enlace")
		Ob_RS.Update
		Ob_RS.Close
		Ob_Conn.Close
	end if

	if Request.Form("a") = 1000 then ' Edición de registro
		SET Ob_Conn = Server.CreateObject("ADODB.Connection")
		SET Ob_RS = Server.CreateObject ("ADODB.RecordSet")
		Ob_Conn.Open cStrConn
		Ob_Conn.Execute("UPDATE SUSCRIPCIONES SET NOMBRE1 = '"&clstxt(Request.Form("nombre1x"))&"', NOMBRE2 = '"&clstxt(Request.Form("nombre2x"))&"', NOMBRE3 = '"&clstxt(Request.Form("nombre3x"))&"', NOMBRE4 = '"&clstxt(Request.Form("nombre4x"))&"', VALIDEZ ='"&Request.Form("validezx")&"', PRECIO ='"&Request.Form("preciox")&"', ENLACE ='"&Request.Form("enlacex")&"' WHERE CODIGO = '"&Request.Form("idx")&"'")
		Ob_Conn.Close
	end if%>

	<!DOCTYPE html>
	<html lang="es">
		<head>
			<!--#include file="head.html"-->
			<script>
				function setValues(a,b,c,d,e,f,g,h){
					document.gestformx.idx.value = a;
					document.gestformx.nombre1x.value = b;	
					document.gestformx.nombre2x.value = c;
					document.gestformx.nombre3x.value = d;
					document.gestformx.nombre4x.value = e;															
					document.gestformx.validezx.value = f;
					document.gestformx.preciox.value = g;
					document.gestformx.enlacex.value  = h;										
				}
			</script>	
			<script>			
				function borraItem(v){
					var r = confirm("Por favor, confirme que desea eliminar este registro.");
					if (r == true) {
						var dataString = 'p='+v+'';
						    $.ajax({
		        		    type: "POST",
		    		        url: "_borraItem.asp",
				            data: dataString,
		            		success: function() {           
		            	    	alert("Registro eliminado")
		            	    	location.href = "customers.asp";
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

				<!--#include file="header.asp"-->
				<!--#include file="sidebar.asp"-->

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
										<%nRegistrosT = 0
										Set objConn = Server.CreateObject("ADODB.Connection")
										Set oRs = Server.CreateObject("ADODB.RecordSet")
										objConn.Open(cStrConn)
										cSql = "SELECT CODIGO, NOMBRE1, NOMBRE2, NOMBRE3, NOMBRE4, VALIDEZ, PRECIO, ENLACE FROM SUSCRIPCIONES"
										oRs.CursorType = 1
										oRs.CursorLocation = 3
										oRs.LockType = 1
										oRs.Open cSql, objConn
										nRegistrosT	= oRs.recordcount

										if nRegistrosT > 0 then	
											nRegistros = 0										
											do until oRs.Eof
												cCodigoSuscripcion	= oRs.fields(0).Value
												cNombre1Suscripcion	= oRs.fields(1).Value
												cNombre2Suscripcion	= oRs.fields(2).Value
												cNombre3Suscripcion	= oRs.fields(3).Value																				
												cNombre4Suscripcion	= oRs.fields(4).Value	
												nValidezSuscripcion = oRs.fields(5).Value
												nPrecioSuscripcion  = oRs.fields(6).Value
												cEnlaceSuscripcion  = oRs.fields(7).Value%>																								
												<tr>
													<td><%=cCodigoSuscripcion%></td>
													<td><%=cNombre1Suscripcion%></td>
													<td><%=nValidezSuscripcion%></td>
													<td><%=nPrecioSuscripcion%></td>
													<td><a href="#edit-option" class="btn btn-xs btn-info" data-bs-toggle="modal" title="Gestionar registro" onclick="setValues('<%=cCodigoSuscripcion%>','<%=cNombre1Suscripcion%>','<%=cNombre2Suscripcion%>','<%=cNombre3Suscripcion%>','<%=cNombre4Suscripcion%>','<%=nValidezSuscripcion%>','<%=nPrecioSuscripcion%>','<%=cEnlaceSuscripcion%>')"><i class="fas fa-edit"></i></a>
													</td>
												</tr>
											<%oRs.Movenext     
											LOOP
										else%>
											<tr>
												<td colspan="3">No hay suscripciones</td>
											</tr>			
										<%end if
										oRs.Close 
										Set ObjConn = Nothing%>
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
							<form class="form-horizontal" name="gestform" id="gestform" method="post" action="membership.asp">
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
	                                <label class="col-md-3 control-label mt-2">Enlace pago <span class="text-red">*</span></label>
	                                <div class="col-md-8">
	                                    <input type="text" class="form-control" name="enlace" id="enlace" required/>
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
							<form class="form-horizontal" name="gestformx" id="gestformx" method="post" action="membership.asp">
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
	                                <label class="col-md-3 control-label mt-2">Enlace pago <span class="text-red">*</span></label>
	                                <div class="col-md-8">
	                                    <input type="text" class="form-control" name="enlacex" id="enlacex" required/>
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

			<!--#include file="js.asp"-->
	</html>
<%else
	Response.redirect "default.asp"	
end if%>