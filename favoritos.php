<div class="container content-container" style="padding: 10px;">
<div class="row header">
            <div class="col-12 back-button text-left" style="margin-top: 50px;">
            <a href="?section=<?php echo $_GET['ref']; ?>&t=3">
                    <img src="assets\img\icons\Atrás.svg" alt="Atrás" style="padding-top: 40px;">
                </a>
            </div>
        </div>
    <div class="col-12 p-3">
        <div class="fila-titulo-perfil" style="padding-top: 80px;">
            <p class="txt-perfil"><?= getTxt(276, $l) ?>&nbsp;</p>       
        </div>
    </div>

    <?php
            session_start();
           
    require_once 'conexion.php';
    $fecha_actual = date('Y-m-d'); // Formato: Año-Mes-Día
    if ($_SERVER['SERVER_NAME'] == "localhost") {
        $ruta_admin = "/admin";
    } else {
        $ruta_admin = "https://admin.imageen.net";
    }
    $conn = @new mysqli($db_server, $db_username, $db_userpassword, $db_name);
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    if (isset($_COOKIE['usuario'])) {
        $codigousuario = trim($_COOKIE['usuario'], " ");
    } else {
        $codigousuario = "";
    }

        // Preparar la consulta SQL
        $sql = "SELECT PUNTOS.NOMBRE, PUNTOS.IMAGEN, PUNTOS.FECHANEW, favoritos.CODIGO_MATERIAL as CODIGO
                FROM favoritos 
                INNER JOIN PUNTOS ON favoritos.CODIGO_MATERIAL = PUNTOS.CODIGO 
                WHERE favoritos.CODIGO_USUARIO = ? AND favoritos.ES_FAVORITO = 1";
        // Crear una declaración preparada
        $stmt = $conn->prepare($sql);
        // Enlazar los parámetros
        $stmt->bind_param("s", $codigousuario);
        // Ejecutar la consulta
        $stmt->execute();
        // Obtener los resultados
        $result = $stmt->get_result();


  if($result->num_rows > 0) {
    // Iterar sobre los resultados y crear una tarjeta para cada uno
  
    echo '<div class="gridContainer">';
    while($row = $result->fetch_assoc()) {
        $imagenpunto = $row["IMAGEN"];
        $fechanew = $row["FECHANEW"];
        $fav_id = $row["fav_id"]; 
        $codigo_material = $row["CODIGO"];
        
        // Comienza un nuevo div para cada conjunto de imagen, título y favorito
        echo '<div class="gridItem">';
                echo '<img class="imgs" src="https://admin.imageen.net/data/puntos/' . $imagenpunto . ' " alt="'.$row['NOMBRE'].'">';
                echo '<h5 class="card-title">'.$row['NOMBRE'].'</h5>';
        // Aqui el div
         echo '<div class="tamaño">';
                if($fechanew > $fecha_actual) {
                    echo '<img src="assets\img\icons\icon-new-list.svg" alt="Nuevo punto Imageen">';
                }
                echo '<img id="favorito-' . $fav_id . '" class="favoritos" src="assets/img/icons/Favoritos.svg" style="width: 100% !important;" alt="Favoritos ciudades Imageen" data-codigo="' . $codigo_material . '">';
        echo '</div>';
        // Cierra el div para este conjunto de imagen, título y favorito
        echo '</div>';
    }
    echo '</div>';
    }else{
         echo '<p>' . getTxt(275, $l) . '&nbsp;</p>';
        
    }
    $stmt->close();
    // Cerrar la conexión
    $conn->close();
    ?>
</div>