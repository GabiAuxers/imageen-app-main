
<body>
    <?php
    require_once 'literal.php';
    require_once 'functions.php';
    require_once 'auth.php';
    require_once 'variables.php';
    require_once 'head.php';
    require_once 'js.php';
    ?>


    <!--Mostramos los datos en la ficha-->
    <div class="container content-container">
        <div class="d-flex justify-content-center align-items-center">
            <div class="logo-wrapper text-center">
                <?php if ($navidad === 1) : ?>
                    <img src="assets\img\logo\Logotipo.svg" width="125px">
                <?php else : ?>
                    <img src="assets\img\logo\Logotipo.svg" width="125px" height="125px">
                <?php endif; ?>
            </div>
        </div>
        <a href="login.php" class="close-icon">
            <img src="assets\img\icons\Cerrar.svg" width="50px" height="50px" alt="Cerrar">
        </a>


        <div class="col-12" style="text-align: center;">
            <form method="POST" action="login.php">
                <input type="email" class="form-control txt-input" id="email" name="email" placeholder="Email" required><br>
                <input type="password" class="form-control txt-input" id="password" name="password" placeholder="Contraseña" required><br>
                <input type="password" class="form-control txt-input" id="password" name="password" placeholder="Contraseña" required><br>
                <div class="form-check">
                    <input class="form-check-input " type="checkbox" id="privacyPolicy" required>
                    <label class="form-check-label" for="privacyPolicy">
                        Aceptar política de privacidad
                    </label>
                </div>
                <input type="submit" class="btn btn-secondary" style="margin-top: 15px;" value="Continuar">
            </form>
            <div style="margin-top: 10px;">
                <a>O</a>
            </div>
            <div>
                <a href="" class="btn-email btn-custom" style="margin-top: 10px;">Continuar con email</a>
                <a href="" class="btn-facebook btn-custom" style="margin-top: 10px;">Continuar con Facebook</a>
                <a href="" class="btn-google btn-custom" style="margin-top: 10px;">Continuar con Google</a>


            </div>
        </div>

    </div>
    </div>
</body>
