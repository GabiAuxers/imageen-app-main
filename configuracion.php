<!--En esta clase se envian los datos de la configuracion de la cuenta a la base de datos mediante un formulario-->
<div class="container content-container" style="padding: 10px;">
    <div class="col-12 back-button text-left" style="margin-top: 50px;">
        <a href="?section=infoPerfil&t=3">
            <img src="assets\img\icons\Atrás.svg" alt="Atrás" style="width: 30px;">
        </a>
    </div>
    <div class="col-12 p-3">
        <div class="fila-titulo-perfil mb-3">
            <p class="txt-perfil">Configuración de Cuenta</p>
        </div>

        <div class="listado-info mt-3">
            <p class="title-infopersonal">Cambiar Contraseña</p>
            <div class="alineacion-elementos">
                <div>
                    <!--aqui habria que hacer un echo y traer la variable de la base de datos, en este caso en la tabla usuarios no esta 
                    establecido un campo de password, en vez de poner asdf pondriamos algo como en info-texto y en value: ?php echo $password ?>
                  Es exactamente el mismo procedimiento que en informacionPersonal.php-->
                    <p class="info-texto">asdf</p>
                    <input type="password" class="info-input" value="asdf" style="display: none;">
                </div>
                <p class="txt-editar" onclick="toggleEdit(this)">Editar</p>
                <p class="txt-guardar" onclick="toggleEdit(this)" style="display: none;">Guardar</p>
            </div>


            <div class="listado-info mt-3">
                <p class="title-infopersonal">Suscripción</p>
                <div class="alineacion-elementos">
                    <div>
                        <!--Este código PHP imprimirá la clase 'texto-oscuro' para "Standar" y 'texto-claro'
                       para "Premium" si $suscripcion es igual a 1. Si $suscripcion no es igual a 1,
                        imprimirá 'texto-claro' para "Standar" y 'texto-oscuro' para "Premium".-->
                        <p class="info-texto">
                            <span
                                class="<?php echo ($suscripcion_usuario == 1) ? 'texto-oscuro' : 'texto-claro'; ?>">Standar</span>
                            |
                            <span
                                class="<?php echo ($suscripcion_usuario == 1) ? 'texto-claro' : 'texto-oscuro'; ?>">Premium</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="listado-info mt-4">
                <!--Incluir aquí con href el enlace a la página de pago. Si es premium dira cancelpar premium, sino dira hacerme premium-->
                <a class="title-premium">
                    <?php echo ($suscripcion_usuario == 1) ? 'Hacerme premium' : 'Cancelar premium'; ?>
                </a>
            </div>
        </div>
    </div>
</div>
<script>
function toggleEdit(element) {
    var parent = element.parentNode;
    var infoTexto = parent.querySelector('.info-texto');
    var infoInput = parent.querySelector('.info-input');
    var editarLink = parent.querySelector('.txt-editar');
    var guardarLink = parent.querySelector('.txt-guardar');

    if (element.classList.contains('txt-editar')) {
        infoTexto.style.display = 'none';
        infoInput.style.display = 'inline-block';
        editarLink.style.display = 'none';
        guardarLink.style.display = 'inline-block';
    } else if (element.classList.contains('txt-guardar')) {
        var nuevoValor = infoInput.value;
        infoTexto.innerText = nuevoValor;
        infoTexto.style.display = 'inline-block';
        infoInput.style.display = 'none';
        editarLink.style.display = 'inline-block';
        guardarLink.style.display = 'none';
    }
}

function toggleSave(element) {
    var parent = element.parentNode;
    var infoTexto = parent.querySelector('.info-texto');
    var infoInput = parent.querySelector('.info-input');
    var editarLink = parent.querySelector('.txt-editar');
    var guardarLink = parent.querySelector('.txt-guardar');

    // Obtén el campo que se está actualizando
    var field = element.getAttribute('data-field');

    // Continúa con el resto del código...
    var nuevoValor = infoInput.value;
    infoTexto.innerText = nuevoValor;
    infoTexto.style.display = 'inline-block';
    infoInput.style.display = 'none';
    editarLink.style.display = 'inline-block';
    guardarLink.style.display = 'none';

    $.ajax({
        url: '_edituserpassword.php',
        type: 'POST',
        data: {
            field: field,
            value: nuevoValor
        },
        success: function(response) {
            // Aquí puedes manejar la respuesta de _edituser.php.
            console.log(response);

            // Si la respuesta del servidor indica que la actualización fue exitosa, recarga los datos.
            if (response.success) {
                window.location.reload();
            }
        }
    });
}
</script>