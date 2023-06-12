<body>
    <?php
    include 'head.php';
    include 'variables.php';
    include 'js.php';
    include 'footer.php';
    
    ?>
<!-- El contacto tendra que gestionarse desde admin y alguien tendra que encargarse de los mensajes. Agregar un metodo
    a <input type="submit" class="btn btn-primary" style="margin-top: 15px;" value="Enviar"> para realiar la accion con la base de datos-->
    <div class="container content-container" style="padding-bottom: 100px;">
        <div class="row header">

            <div class="col-12 back-button text-left" style="margin-top: 50px;">
            <a href="?section=<?php echo $_GET['ref']; ?>">
                    <img src="assets\img\icons\Atrás.svg" alt="Atrás" style="width: 30px;">
                </a>
            </div>
        </div>
        <div class="col-12 p-3" style="padding-bottom: 10px;">
            <p class="txt-perfil">Contacto</p>
            <p class="txt-parrafo">Si tienes alguna duda o sugerencia no dudes en escribirnos, nos pondremos en contacto
                contigo a la mayor brevedad, estaremos encantados de recibir tu información.</p>
        </div>

        <div class="col-12 p-3" style="text-align: center;">
            <form method="POST" action="login.php">
                <input type="nombre" class="form-control txt-input" id="nombre" name="nombre" placeholder="Nombre"
                    required><br>
                <input type="email" class="form-control txt-input" id="email" name="email" placeholder="Email"
                    required><br>
                <div class="form-group">
                    <select class="form-control txt-input" id="motivos" name="motivo" required>
                        <option selected disabled>Seleccione un motivo</option>
                        <option value="Dudas generales y sugerencias">Dudas generales y sugerencias</option>
                        <option value="Incidencia técnica">Incidencia técnica</option>
                        <option value="Problemas con el pago">Problemas con el pago</option>
                        <option value="Sugerir corrección histórica">Sugerir corrección histórica</option>
                        <option value="Patrocinio o publicidad en la app">Patrocinio o publicidad en la app</option>
                    </select>
                </div>

                <textarea type="mensaje" class="form-control txt-mensaje" id="mensaje" name="mensaje"
                    placeholder="Mensaje" required
                    style="margin-top: 20px; height: 200px !important; width: 100%;"></textarea>
                <input type="submit" class="btn btn-primary" style="margin-top: 15px;" value="Enviar">
            </form>

        </div>
    </div>
</body>