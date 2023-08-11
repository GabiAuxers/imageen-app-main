<?php
require_once "variables.php";
require_once 'conexion.php';

$conn = @new mysqli($db_server, $db_username, $db_userpassword, $db_name);
if ($conn->connect_error) {
	$additionalInfo = "Fallo en la conexión a la base de datos en la clase _load_point_bd.php línea 12. Comprueba las credenciales de la base de datos y que el servidor esté funcionando correctamente. Error específico: " . $conn->connect_error;
	$errorLogger = new ErrorLogger();
	$errorLogger->logErrorToFile('errors.txt', "Error de conexión a la base de datos", $additionalInfo);
	die("Ha ocurrido un error al intentar conectar a la base de datos.");

}
mysqli_set_charset($conn, 'utf8');
if (isset($_GET['p'])) {
    $p = $_GET['p'];
  
    $stmt = $conn->prepare("SELECT TOKENS.TOKEN FROM TOKENS WHERE TOKENS.CODIGO = ?");
    $stmt->bind_param("s", $p);
    $stmt->execute();
    $result = $stmt->get_result();
  
    if ($result->num_rows > 0) { 
      $row = mysqli_fetch_array($result);
      $token = $row["TOKEN"];
      header("Location: contents.php?section=ficha&ref=mapa&token=$token");
    }
    $stmt->close();
    $conn->close();
  }
//require_once was added instead of include
require_once 'head.php';
//incluimos los scripts de la aplicacion
if ($_SERVER['SERVER_NAME'] === "localhost") $ruta_admin = "admin/";
else $ruta_admin = "https://admin.imageen.net";   
?>

<!-- Modularizacion del la etiqueta body, cargamos en funcion de la visualizacion del usuario y los contenidos. -->
<?php
// Decidir la función onload
$onLoadFunction = ($t == 3) ? "onLoadContents(3, false, '$p', '$m', '$u', '$a');" : (($x != "" || $visualizacion_usuario == 1) ? "onLoadContents(1, false, '$p', '$m', '$u', '$a');" : "onLoadContents(2, false, '$p', '$m', '$u', '$a');");

// Incluir los scripts
if ($x != "") {
    echo '<script src="' . htmlspecialchars($ruta_admin . '/ficheros/puntos' . $x . '.xml') . '"></script>';
} else {
    echo '<script src="' . htmlspecialchars($ruta_admin . '/ficheros/puntosImageen' . $l . '.xml') . '"></script>';
}
?>

<body onload="<?= $onLoadFunction ?>">
  <div id="overlay"></div>
  <div id="overlay2"></div>
</body>

<!--Cargaamos spinner-->
<div id="spinner" class="spinner">
    <div class="spinner-content">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden"></span>
        </div>
        <div class="col-">
            <p>Estamoos cargando nuestros contenidos, la espera merece la pena ;)</p>
        </div>
    </div>
</div>
<!--Cargamos como vista parcial la cabecera-->
<?php @include('views/header.php')?>
    <div id="main">
        <!--Implementamos un Routeo para integrar vistas parciales-->
        <?php
            switch ($section) {
                //Vista Listado
                case "listado":
                    @include('list.php');
                    break;
                //Vista perfil con Firebase
                case "infoPerfil":
                    @include('infoPerfil.php');
                    break;
                case "politica":
                    @include('politica.php');
                     break;
                case "contacto":
                     @include('contacto.php');
                     break;
                case "perfil":
                     @include('perfil.php');
                     break;
                case "login":
                    @include('login.php');
                    break;
                case "guiaVirtual":
                    @include('guiaVirtual.php');
                    break;
                case "informacionPersonal":
                     @include('informacionPersonal.php');
                     break;
                case "faq":
                    @include('faq.php');
                    break;
                case "configuracion":
                    @include('configuracion.php');
                    break;
                case "ficha":
                    @include('ficha.php');
                    break;
                case "favoritos":
                     @include('favoritos.php');
                    break;
                //Como controlamos por parametro sectión, siempre que no venga siempre cargará el mapa (inicio)
                default:
                    @include('map.php');
                    break;
            }
        ?>
    </div>
    <?php
        require_once 'js.php';
        //Cargamos footer
        require_once 'footer.php';
    ?>
        <?php
         require_once 'modals.php';
         ?>
</body>

<script async>
    window.addEventListener('load', function() {
        // Oculta el spinner aquí
        setTimeout(function() {
            $("#spinner").hide(); // Ocultar el spinner
            $('body').css('overflow', 'auto');
        }, 0);
    });
    $(document).ready(function() {
    function searchtxt(val, l) {
        if (val.length > 0) {
            // Realiza la búsqueda y genera los resultados
            //...
            // Oculta el mapa, el pie de página y las categorías
            $('#map').hide();
            $('#footer-container').hide();
            $('#theader').hide();  // Ocultamos las categorías
			$('#theader1').hide();
			$('#theader2').hide();
			$('#theader3').hide();
            // Muestra el fondo negro
            $('#overlay2').show();
			$("body").css("overflow-y", "hidden");
			$("#cerrar").show();
        }else{
			$('#cerrar').hide();
		}
    }

    // Escucha el evento de ingreso de teclas en la caja de búsqueda
    $('#caja-busqueda, #cerrar').on('keyup click', function() {
		const searchValue = $(this).val();
        searchtxt(searchValue, '<?= $l ?>');
        // Verifica si la caja de búsqueda está vacía
        // Si está vacía, muestra el mapa, el pie de página, las categorías y oculta el fondo negro
        if (searchValue.length === 0) {
            $('#map').show();
            $('#footer-container').show();
            $('#theader').show();  // Mostramos las categorías
			$('#theader1').show();
			$('#theader2').show();
			$('#theader3').show();
            $('#overlay2').hide();
			$("body").css("overflow-y", "auto");
			$('#caja-busqueda').val('');
			$("#results").empty();	
        }
    });
});
</script>


