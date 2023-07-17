<?php
//26-05
//Iniciamos la sesion para posteriormente guardar los datos
session_start();
?>
<?php
include 'conexion.php';
include 'literal.php';
include 'functions.php';
include 'auth.php';

    //datos enviados a través de un formulario usando el metodo POST
    $codigo      = isset($_POST["codigo"]) ? $_POST["codigo"] : '';
    $nombre      = isset($_POST["nombre"]) ? $_POST["nombre"] : '';
    $descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : '';
    $direccion = isset($_POST["direccion"]) ? $_POST["direccion"] : '';


    //Guardamos los datos en sesion para usarlos posteriormente en la ficha
    $_SESSION['codigo'] = $codigo;
    $_SESSION['nombre'] = $nombre;
    $_SESSION['descripcion'] = $descripcion;

$l = $_GET["l"];
$txt = $_GET["t"];

if (strlen($txt) >= 3) {

    $conn = @new mysqli($db_server, $db_username, $db_userpassword, $db_name);
    if ($conn->connect_error) {
        $additionalInfo = "Fallo en la conexión a la base de datos en la clase _search_contents.php línea 29. Comprueba las credenciales de la base de datos y que el servidor esté funcionando correctamente. Error específico: " . $conn->connect_error;
        $errorLogger = new ErrorLogger();
        $errorLogger->logErrorToFile('errors.txt', "Error de conexión a la base de datos", $additionalInfo);
        die("Ha ocurrido un error al intentar conectar a la base de datos.");
    }
    mysqli_set_charset($conn, 'utf8');
    $sql = "SELECT PUNTOS.NOMBRE, CATEGORIA, DESCRIPCION" . $l . ", PUNTOS.CODIGO, IMAGEN, CLIENTE, GALERIA.ICONO, GALERIA.ICONOG FROM PUNTOS, GALERIA WHERE ( BUSQUEDA LIKE '%" . $txt . "%' OR PUNTOS.NOMBRE LIKE '%" . $txt . "%' OR DESCRIPCION" . $l . " LIKE '%" . $txt . "%') AND (PUNTOS.ICONO = GALERIA.CODIGO) ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        if ($result->num_rows > 1) {
            ?>
     
     <div class="card-custom mt-3">
            <span class="resultado-busqueda text-center"><?=$result->num_rows . " "?><?=getTxt(101, $l) . " \"" . $txt . "\""?></span>
    </div>                 
                   
<?php
} else {
            ?>
<br>
<div class="card-custom mt-3">
         <span class="resultado-busqueda text-center"><?=(getTxt(102, $l) . " \"" . $txt . "\"")?></span>
 </div>
                    
<?php
}
        ?>
<div class="container-flulid" style="padding: 10px">
    <div>
        <?php
        while ($row = mysqli_fetch_array($result)) {
            $nombre = $row["NOMBRE"];
            $categoria_punto = $row["CATEGORIA"];
            $descripcion = $row["DESCRIPCION" . $l];
            $codigo = $row["CODIGO"];
            $imagen_punto = $row["IMAGEN"];
            $cliente_punto = $row["CLIENTE"];
            $icono = $row["ICONO"];
            $iconog = $row["ICONOG"];
            if ($iconog == null) {
                $iconog = $icono;
            }

            ?>
        <!--Bypass ventana punto-->
        <?php
        if ($cliente_punto == "") {
                ?>
        <a href="#contentx" class="text-decoration-none text-dark"
            onclick=" showFicha({'codigo': '<?=$codigo?>', 'descripcion': '<?=$descripcion?>', 'nombre': '<?=$nombre?>'})">

            <?php } else {?>
            <a href="#pointx" class="text-decoration-none text-dark" 
                onclick="loadPoint({'codigo': '<?=$codigo?>', 'imagen': '<?=$imagen_punto?>', 'cliente': '<?=$cliente_punto?>', 'nombre': '<?=$titulo_punto?>', 'descripcion': '<?=$descripcion_punto?>', 'icono': '<?=$iconog?>'})"
                >
                <?php }?>
                <div class="col" >
                    <div class="card-buscador h-100 mt-2">
                        <div class="card-body">
                            <h5 class="titulo-card text-center"><?=$nombre?></h5>
                            <div class="row mt-2">
                                <div class="col-6">
                                    <img src="https://admin.imageen.net/data/puntos/<?=$imagen_punto?>"
                                        class="img-fluid rounded shadow"
                                        style="object-fit: cover; height: 100%; transition: all 0.3s ease;"
                                        onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.3)';"
                                        onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24)';"
                                        alt="<?=$nombre?>">
                                </div>
                                <div class="col-6">
                                    <p class="card-text"><?=substr($descripcion, 0, 75)?>...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <?php 
        }
        ?>
    </div>
</div>
<?php } else {?>
<!-- Texto No se encontraron resultados-->
<br>
<div class="card-custom mt-3">
    <span class="resultado-busqueda text-center"><?=getTxt(66, $l)?></span>
</div>
                  
<?php }
    $conn->close();
} else {?>

<!--texto: Por ejemplo, Felipe 2  - eliminado.	<h6 class="text-muted"><?=getTxt(100, $l)?></h6>-->

<?php }?>