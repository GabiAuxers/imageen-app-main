		<!-- BEGIN #sidebar -->
		<div id="sidebar" class="app-sidebar">
			<!-- BEGIN scrollbar -->
			<div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
				<!-- BEGIN menu -->
				<div class="menu">


					<div class="menu-header">Menú de opciones</div>
					<div class="menu-item <?if ($opc == 1){?> active <?}?>">
						<a href="index.php" class="menu-link">
							<div class="menu-icon">
								<i class="fa fa-th-large"></i>
							</div>
							<div class="menu-text">Dashboard</div>
						</a>
					</div>
					<div class="menu-item mt-1 <?if ($opc == 2){?> active <?}?>">
						<a href="points.php" class="menu-link">
							<div class="menu-icon">
								<i class="fas fa-map-marker-alt"></i>
							</div>
							<div class="menu-text">Puntos Imageen</div>
						</a>
					</div>
					<div class="menu-item mt-1 <?if ($opc == 3){?> active <?}?>">
						<a href="customers.php" class="menu-link">
							<div class="menu-icon">
								<i class="fas fa-briefcase"></i>
							</div>
							<div class="menu-text">Clientes</div>
						</a>
					</div>					
					<div class="menu-item mt-1 <?if ($opc == 4){?> active <?}?>">
						<a href="users.php" class="menu-link">
							<div class="menu-icon">
								<i class="fas fa-users"></i>
							</div>
							<div class="menu-text">Usuarios</div>
						</a>
					</div>	
					<div class="menu-item mt-1 <?if ($opc == 5){?> active <?}?>">
						<a href="membership.php" class="menu-link">
							<div class="menu-icon">
								<i class="fas fa-shopping-cart"></i>
							</div>
							<div class="menu-text">Suscripciones</div>
						</a>
					</div>		

					<div class="menu-item mt-1 <?if ($opc == 6){?> active <?}?>">
						<a href="tour.php" class="menu-link">
							<div class="menu-icon">
								<i class="fas fa-graduation-cap"></i>
							</div>
							<div class="menu-text">Tour formación</div>
						</a>
					</div>																				

					<!-- <div class="menu-item mt-1 <?if ($opc == 7){?> active <?}?>">
						<a href="custom.php" class="menu-link">
							<div class="menu-icon">
								<i class="fas fa-cog"></i>
							</div>
							<div class="menu-text">Personalizacion</div>
						</a>
					</div>		-->
					
					<div class="menu-item has-sub <?if ($opc > 100 && $opc < 200){?> active <?}?>">
						<a href="javascript:;" class="menu-link">
							<div class="menu-icon">
								<i class="fa fa-align-left"></i>
							</div>
							<div class="menu-text">Tablas maestras</div>
							<div class="menu-caret"></div>
						</a>
						<div class="menu-submenu">
							<div class="menu-item <?if ($opc == 101){?> active <?}?>">
								<a href="translate.php" class="menu-link">
									<div class="menu-text">Traducciones</div>
								</a>
							</div>	
							<div class="menu-item <?if ($opc == 102){?> active <?}?>">
								<a href="cities.php" class="menu-link">
									<div class="menu-text">Ciudades</div>
								</a>
							</div>
							<div class="menu-item <?if ($opc == 103){?> active <?}?>">
								<a href="gallery.php" class="menu-link">
									<div class="menu-text">Iconos</div>
								</a>
							</div>															
						</div>
					</div>
					
					<!-- BEGIN minify-button -->
					<div class="menu-item d-flex">
						<a href="javascript:;" class="app-sidebar-minify-btn ms-auto" data-toggle="app-sidebar-minify"><i class="fa fa-angle-double-left"></i></a>
					</div>
					<!-- END minify-button -->
					
				</div>
				<!-- END menu -->
			</div>
			<!-- END scrollbar -->
		</div>