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

    $stmt = $conn->prepare("SELECT PUNTOS.NOMBRE, CATEGORIA, DESCRIPCION".$l.", PUNTOS.CODIGO, IMAGEN, CLIENTE, GALERIA.ICONO, GALERIA.ICONOG FROM PUNTOS, GALERIA WHERE ( BUSQUEDA LIKE '%".$txt."%' OR PUNTOS.NOMBRE LIKE '%".$txt."%' OR DESCRIPCION".$l." LIKE '%".$txt."%') AND (PUNTOS.ICONO = GALERIA.CODIGO) ");
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        if ($result->num_rows > 1) {
            ?>

<div>
    <span class="resultado-busqueda text-center"><?=$result->num_rows . " "?><?=getTxt(101, $l) . " \"" . $txt . "\""?></span>
</div>

<?php
}else {
            ?>
<br>
<div class="mt-3">
    <span class="resultado-busqueda text-center"><?=(getTxt(102, $l) . " \"" . $txt . "\"")?></span>
</div>

<?php
}
        ?>
<div class="container-flulid" style="padding: 10px">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4">
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
                
                $query = "SELECT PUNTOS.CODIGO, TOKENS.NOMBRE, TOKENS.DESCRIPCION, TOKENS.TOKEN FROM PUNTOS 
                JOIN TOKENS ON PUNTOS.CODIGO = TOKENS.CODIGO
                 WHERE TOKENS.CODIGO = ?";
                

                $stmt9 = $conn->prepare($query);
                $stmt9->bind_param('s', $codigo);
                $stmt9->execute();
                $result9 = $stmt9->get_result();
                $row9 = $result9->fetch_assoc();
        
                if ($row9) {
                $token = $row9['TOKEN'];
        
        } else {
            // Token inválido o expirado
            die('Token invalido. Acceso denegado');
        }
        $stmt9->close();
            
                

            ?>
        <!--Bypass ventana punto-->
        <?php
        if ($cliente_punto == "") {
                ?>
        <a href="?section=ficha&t=3&ref=listado&token=<?=$token?>" class="text-decoration-none text-dark"
            onclick=" showFicha({'codigo': '<?=$codigo?>', 'descripcion': '<?=$descripcion?>', 'nombre': '<?=$nombre?>'})">

            <?php } else {?>
            <a href="?section=ficha&t=3&ref=listado&token=<?=$token?>" class="text-decoration-none text-dark"
                onclick="loadPoint({'codigo': '<?=$codigo?>', 'imagen': '<?=$imagen_punto?>', 'cliente': '<?=$cliente_punto?>', 'nombre': '<?=$titulo_punto?>', 'descripcion': '<?=$descripcion_punto?>', 'icono': '<?=$iconog?>'})">
                <?php }?>
                <div class="col">
                    <div class="m-1 align-items-center row rounded gx-2 p-2" style="background: #EEEEEE;">
                        <h5 class="m-1 text-left"><?=$nombre?></h5>
                        <div class="col-4"><img class="align-self-center img-fluid rounded"
                                src="https://admin.imageen.net/data/puntos/<?=$imagen_punto?>"></div>
                        <div class="col-8">
                            <p class="card-text"><?=substr($descripcion,0,75)?>...</p>
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
<div class="cardmt-3">
    <span class="resultado-busqueda text-center"><?=getTxt(66, $l)?></span>
</div>

<?php }
    $stmt->close();
    $conn->close();
} else {?>

<!--texto: Por ejemplo, Felipe 2  - eliminado.	<h6 class="text-muted"><?=getTxt(100, $l)?></h6>-->

<?php }?>