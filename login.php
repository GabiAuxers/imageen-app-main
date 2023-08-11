
<body>
<?php
    require_once 'variables.php';
    require_once 'literal.php';
    require_once 'functions.php';
    require_once 'auth.php';
    require_once 'head.php';
    require_once 'js.php';
    require_once 'firebaseauth.php';
    ?>


<div class="offcanvas offcanvas-bottom pagina-info show" tabindex="-1" id="login" aria-labelledby="login-label" style="z-index: 3001; visibility: visible;" aria-modal="true" role="dialog">
	<script>
        
		try {
			ui.start('#firebaseui-auth-container', uiConfig);
           
		}
		catch (error) {
			console.error(error);
		}
	</script>
	<div class="offcanvas-body pt-0 d-flex flex-column align-items-center">
    <div class="d-flex justify-content-center align-items-center">
            <div class="logo-wrapper text-center">
                <?php if ($navidad === 1) : ?>
                    <img src="assets\img\logo\Logotipo.svg" width="125px">
                <?php else : ?>
                    <img src="assets\img\logo\Logotipo.svg" width="125px" height="125px">
                <?php endif; ?>
            </div>
        </div>
        <a href="?section=infoPerfil&t=3" class="close-icon">
            <img src="assets\img\icons\Cerrar.svg" width="50px" height="50px" alt="Cerrar">
        </a>
					
			<div class="loginDeck vstack" style="margin-top: -80px;">
			<div id="firebaseui-auth-container" lang="es">
            <!-- Firebase rellena este contenedor solo-->
           
            </div>

            <div class="firebaseui-card-footer firebaseui-provider-sign-in-footer">
                <!-- Firebase rellena las politicas solo-->
        </div>
    </div>
</div>
			<div id="loader" style="display: none;">Loading...</div>	
		</div>
	</div>
</div>
</body>

