<!--Esta clase hace los post de los datos a _edituser.php y alli se hacen los inserts o updates a la BDD en base a field y value-->
<div class="container content-container" style="padding: 10px;">
    <div class="col-12 back-button text-left" style="margin-top: 50px;">
        <a href="?section=infoPerfil&t=3">
            <img src="assets\img\icons\Atrás.svg" alt="Atrás" style="padding-top: 40px; width: 44px;">
        </a>
    </div>
    <div class="col-12 p-3">
        <div class="fila-titulo-perfil mb-3" style="padding-top: 120px;">
            <p class="txt-perfil"><?=getTxt(281, $l) ?>&nbsp;</p>       
        </div>
        
        <div class="listado-info">
            <p class="title-infopersonal"><?=getTxt(296, $l) ?>&nbsp;</p>
            <div class="alineacion-elementos">
                <div>
                    <p class="info-texto"><?php echo $nombre_usuario ?></p>
                    <input type="text" class="info-input" value="<?php echo $nombre_usuario ?>" style="display: none;">
                </div>
                <p class="txt-editar" onclick="toggleEdit(this)"><?=getTxt(299, $l) ?>&nbsp;</p>
                <p class="txt-guardar" data-field="nombre" onclick="toggleSave(this)" style="display: none;"><?=getTxt(300, $l) ?>&nbsp;</p>
            </div>

            <div class="mt-2">
                <p class="title-infopersonal"><?=getTxt(37, $l) ?>&nbsp;o</p>
                <div class="alineacion-elementos">
                    <div>
                        <p class="info-texto"><?php echo $email_usuario ?></p>
                        <input type="text" class="info-input" value="<?php echo $email_usuario ?>"
                            style="display: none;">
                    </div>
                    <p class="txt-editar" onclick="toggleEdit(this)"><?=getTxt(299, $l) ?>&nbsp;</p>
                    <p class="txt-guardar" data-field="email" onclick="toggleSave(this)"
                        style="display: none;"><?=getTxt(300, $l) ?>&nbsp;</p>
                </div>
            </div>

            <div class="mt-2">
                <p class="title-infopersonal"><?=getTxt(297, $l) ?>&nbsp;</p>
                <div class="alineacion-elementos">
                    <div>
                        <p class="info-texto"><?php echo $telefono_usuario ?></p>
                        <input type="text" class="info-input" value="<?php echo $telefono_usuario ?>"
                            style="display: none;">
                    </div>
                    <p class="txt-editar" onclick="toggleEdit(this)"><?=getTxt(299, $l) ?>&nbsp;</p>
                    <p class="txt-guardar" data-field="telefono" onclick="toggleSave(this)"
                        style="display: none;"><?=getTxt(300, $l) ?>&nbsp;</p>
                </div>
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
        url: '_edituser.php',
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