<?php

function get_item_code($v){
    include "conexion.php";
    $conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
    if ($v == 1){
        $sql1 = "SELECT USUARIO FROM CONTADORES";
        $sql2 = "UPDATE CONTADORES SET USUARIO = USUARIO + 1";  
    }elseif ($v == 2){
        $sql1 = "SELECT CIUDAD FROM CONTADORES";
        $sql2 = "UPDATE CONTADORES SET CIUDAD = CIUDAD + 1";
    }elseif ($v == 3){
        $sql1 = "SELECT PUNTO FROM CONTADORES";
        $sql2 = "UPDATE CONTADORES SET PUNTO = PUNTO + 1";             
    }elseif ($v == 4){            
        $sql1 = "SELECT LITERAL FROM CONTADORES";
        $sql2 = "UPDATE CONTADORES SET LITERAL = LITERAL + 1"; 
    }elseif ($v == 5){ 
        $sql1 = "SELECT MATERIAL FROM CONTADORES";
        $sql2 = "UPDATE CONTADORES SET MATERIAL = MATERIAL + 1";
    }elseif ($v == 6){             
        $sql1 = "SELECT CLIENTE FROM CONTADORES";
        $sql2 = "UPDATE CONTADORES SET CLIENTE = CLIENTE + 1";
    }elseif ($v == 7){                         
        $sql1   = "SELECT PUNTOC FROM CONTADORES";
        $sql2   = "UPDATE CONTADORES SET PUNTOC = PUNTOC + 1";
    }elseif ($v == 8){   
        $sql1   = "SELECT VERSION FROM CONTADORES";
        $sql2   = "UPDATE CONTADORES SET VERSION = VERSION + 1";
    }elseif ($v == 9){   
        $sql1   = "SELECT SUSCRIPCION FROM CONTADORES";
        $sql2   = "UPDATE CONTADORES SET SUSCRIPCION = SUSCRIPCION + 1";
    }elseif ($v == 10){               
        $sql1   = "SELECT TOUR FROM CONTADORES";
        $sql2   = "UPDATE CONTADORES SET TOUR = TOUR + 1";  
    }elseif ($v == 11){               
        $sql1   = "SELECT ICONO FROM CONTADORES";
        $sql2   = "UPDATE CONTADORES SET ICONO = ICONO + 1";                      
    }
    
    // Leo
    $result = mysqli_query($conn,$sql1); 
    $fila = mysqli_fetch_row($result);
    $dato = $fila[0]; 
    $conn->close();         

    // Actualizo
    $conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
    $conn->query($sql2);
    $conn->close();         

    return $dato;
}

function RandomString($v){

    $bytes = random_bytes($v);
    return bin2hex($bytes);

}

function get_logo_customer($codigo){
    include "conexion.php";
    $conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
    mysqli_set_charset($conn, 'utf8');
    $sql = "SELECT LOGO FROM CLIENTES WHERE CODIGO ='$codigo' LIMIT 1";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($result->num_rows > 0) {
        $logo = $row["LOGO"];   
    }else{
        $logo = "n/a";
    }
    $conn->close();
    return $logo;
        
}

function get_customer_name($codigo){
    include "conexion.php";
    $conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
    mysqli_set_charset($conn, 'utf8');        
    $sql = "SELECT NOMBRE FROM CLIENTES WHERE CODIGO ='$codigo' LIMIT 1";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($result->num_rows > 0) {
        $namec = $row["NOMBRE"];   
    }else{
        $namec = "n/a";
    }
    $conn->close();
    return $namec;
        
}

function get_option($o){

    include "conexion.php";
    $conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
    mysqli_set_charset($conn, 'utf8');   
    $sql = "SELECT OPCION".$o." FROM PARAMETROS";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($result->num_rows > 0) {
        $valor = $row["OPCION".$o.""];   
    }else{
        $valor = 0;
    }
    $conn->close();
    return $valor;

}

function get_material_type($v){
    if ($v == 1){
        $get_material_type = "Video plano";
    }elseif ($v == 2) {
        $get_material_type = "Vídeo 360";
    }elseif ($v == 3) {
        $get_material_type = "Pasado/Presente";
    }elseif ($v == 4) {
        $get_material_type = "Audio";
    } elseif ($v == 5){
        $get_material_type = "Tour Imageen";
    }elseif ($v == 6){
        $get_material_type = "Wiki Imageen";
    }

    return $get_material_type;
}

function get_access_type($v){
    if ($v == 1) {
        $get_access_type ="<span class='badge bg-blue mt-10px fs-13px'>FREE</span>";
    }elseif ($v == 2){
        $get_access_type ="<span class='badge bg-orange mt-10px fs-13px'>CLUB</span>";
    }elseif ($v == 3){
        $get_access_type ="<span class='badge bg-red mt-10px fs-13px'>PREMIUM</span>";
    }   
    return $get_access_type;           
}

function get_name_point($p) {
    include "conexion.php";
    $conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
    mysqli_set_charset($conn, 'utf8');           
    $sql = "SELECT NOMBRE FROM PUNTOS WHERE CODIGO ='$p'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($result->num_rows > 0) {
        $valor = $row["NOMBRE"];   
    }else{
        $valor = "n/l";
    }
    $conn->close();
    return $valor;        
}

function give_me_flag($l){

    if ($l == 1){
        $dameBandera = "es.png";
    }else if ($l == 2){
        $dameBandera = "en.png";
    }else if ($l == 3){
        $dameBandera = "fr.png";
    }else if ($l == 4){
        $dameBandera = "ca.png";
    }
    return $dameBandera;

}   

function dame_tipo_material($v,$l){

    if ($v == 1){
        $dame_tipo_material = getTxt(49,$l);
    }elseif ($v == 2){
        $dame_tipo_material = getTxt(50,$l);
    }elseif ($v == 3){
        $dame_tipo_material = getTxt(51,$l);
    }elseif ($v == 4){
        $dame_tipo_material = getTxt(52,$l);
    }elseif ($v == 5){
        $dame_tipo_material = getTxt(268,$l);
    }elseif ($v == 6){
        $dame_tipo_material = getTxt(269,$l);
    }

    return $dame_tipo_material;
}   

function debug($v){
    include "conexion.php";
    $connx = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
    $sqlx = "INSERT INTO DEBUG (texto) VALUES ('$v')";
    $connx->query($sqlx);
    $connx->close(); 
}  

function get_average_points($p){
    include "conexion.php";
    $puntos = 0;
    $votos = 0;
    $connz = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
    $sqlz = "SELECT PUNTUACION FROM HVALORACION WHERE PUNTO = '$p'";
    $resultz = $connz->query($sqlz);
    if ($resultz->num_rows > 0) {
        while($rowz = $resultz->fetch_assoc()) { 
            $votos = $votos + 1;
            $puntos = $puntos + $rowz["PUNTUACION"];
        } 
    }
    $connz->close();
    if ($puntos > 0){
        $get_average_points = round($puntos / $votos,2);
    }else{
        $get_average_points = 0;    
    }

    return $get_average_points;
}


function get_average_material($m){
    include "conexion.php";
    $puntos = 0;
    $votos = 0;
    $connz = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
    $sqlz = "SELECT PUNTUACION FROM HVALORACION WHERE MATERIAL = '$m'";
    $resultz = $connz->query($sqlz);
    if ($resultz->num_rows > 0) {
        while($rowz = $resultz->fetch_assoc()) { 
            $votos = $votos + 1;
            $puntos = $puntos + $rowz["PUNTUACION"];
        } 
    }
    $connz->close();
    if ($puntos > 0){
        $get_average_points = round($puntos / $votos,2);
    }else{
        $get_average_points = 0;    
    }

    return $get_average_points;
}    


function escribe_fichero_puntos_imageen() {
    include "conexion.php";
    $conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
    mysqli_set_charset($conn, 'utf8');

    // Crea ficheros XML con puntos Imageen para cada lenguaje
    for ($l=1; $l<=4; $l++) {
        $file = fopen("./ficheros/puntosImageen".$l.".xml","w");
        fwrite($file,"var data = { 'points': [");
        $sql = "SELECT PUNTOS.NOMBRE, PUNTOS.LATITUD, PUNTOS.LONGITUD, PUNTOS.CATEGORIA, PUNTOS.DESCRIPCION".$l.", PUNTOS.CLIENTE, PUNTOS.CODIGO, PUNTOS.IMAGEN, GALERIA.ICONO AS ARCHIVO, GALERIA.ICONOG AS ARCHIVO2 FROM PUNTOS, CIUDADES, GALERIA WHERE PUNTOS.CIUDAD = CIUDADES.CODIGO AND CIUDADES.ESTADO = 1 AND PUNTOS.ICONO = GALERIA.CODIGO";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $nombre 		= $row["NOMBRE"];
                $latitud		= $row["LATITUD"];
                $longitud  		= $row["LONGITUD"];	    
                $categoria 		= $row["CATEGORIA"];
                $descripcion 	= $row["DESCRIPCION".$l.""];
                $cliente		= $row["CLIENTE"];
                $codigo 		= $row["CODIGO"];
                $imagen 		= $row["IMAGEN"];
                $icono          = $row["ARCHIVO"];
                $iconog			= $row["ARCHIVO2"];
                if ($iconog == NULL) $iconog = $icono;

                $conn2 = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
                $sql2 = "SELECT ID FROM MATERIALES WHERE PUNTO = '$codigo'";
                $result2 = mysqli_query($conn2,$sql2); 
                $rowcount = mysqli_num_rows($result2);
                $conn2->close();         

                if ($latitud != "" && $longitud != ""){			
                    fwrite($file,"{'tipo':'0', 'nombre': '".str_replace("'","~",$nombre)."', 'latitud':".trim(str_replace(",",".",$latitud)).", 'longitud':".trim(str_replace(",",".",$longitud)).", 'categoria':'".$categoria."', 'link':'', 'cliente':'".$cliente."', 'icono':'".$icono."', 'iconog':'".$iconog."', 'direccion':'', 'descripcion':'".str_replace("'","~",$descripcion)."','codigo':'".$codigo."','imagen':'".$imagen."','idioma':'".$l."','contenidos':'".$rowcount."'},");
                }
            }
        }	

        // Add customer points in Imageen map
        $sql = "SELECT PUNTOSC.NOMBRE, PUNTOSC.LATITUD, PUNTOSC.LONGITUD, PUNTOSC.LINK, PUNTOSC.DIRECCION, PUNTOSC.DESCRIPCION, PUNTOSC.CODIGO, PUNTOSC.IMAGEN, GALERIA.ICONO AS ARCHIVO, GALERIA.ICONOG AS ARCHIVO2 FROM PUNTOSC, GALERIA WHERE PRINCIPAL = 1 AND PUNTOSC.ICONO = GALERIA.CODIGO";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $puntos = 0;
            while($row = $result->fetch_assoc()) {
                $puntos ++;
                $nombre 		= $row["NOMBRE"];
                $latitud		= $row["LATITUD"];
                $longitud  		= $row["LONGITUD"];	    
                $link	 		= $row["LINK"];
                $icono 			= $row["ARCHIVO"];
                $iconog			= $row["ARCHIVO2"];
                if ($iconog == NULL) $iconog = $icono;
                $direccion      = $row["DIRECCION"];
                $descripcion 	= $row["DESCRIPCION"];
                $codigo 		= $row["CODIGO"];    
                $imagen 		= $row["IMAGEN"];

                if ($latitud != "" && $longitud != ""){	
                    if ($puntos < $result->num_rows) {							
                        fwrite($file,"{'tipo':'1', 'nombre': '".str_replace("'","~",$nombre)."', 'latitud':".trim(str_replace(",",".",$latitud)).", 'longitud':".trim(str_replace(",",".",$longitud)).", 'categoria':'".$categoria."', 'link':'".$link."', 'icono':'".$icono."', 'iconog':'".$iconog."', 'direccion':'".str_replace("'","~",$direccion)."', 'descripcion':'".str_replace("'","~",$descripcion)."','codigo':'".$codigo."','imagen':'".$imagen."','idioma':'".$l."','contenidos':'0'},");
                    }else{
                        fwrite($file,"{'tipo':'1', 'nombre': '".str_replace("'","~",$nombre)."', 'latitud':".trim(str_replace(",",".",$latitud)).", 'longitud':".trim(str_replace(",",".",$longitud)).", 'categoria':'".$categoria."', 'link':'".$link."', 'icono':'".$icono."', 'iconog':'".$iconog."', 'direccion':'".str_replace("'","~",$direccion)."', 'descripcion':'".str_replace("'","~",$descripcion)."','codigo':'".$codigo."','imagen':'".$imagen."','idioma':'".$l."','contenidos':'0'}");						
                    }
                }
            }
        }	
        fwrite($file,"]}"); 
        fclose($file);
    }
    $conn->close();	
}

function escribe_fichero_puntos_cliente($c) {
    include "conexion.php";
    $conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
    mysqli_set_charset($conn, 'utf8');
    // Insert only customer points
    $file = fopen("./ficheros/puntos".$c.".xml","w");
    fwrite($file,"var data = { 'points': [");
    $sql = "SELECT PUNTOSC.NOMBRE, PUNTOSC.LATITUD, PUNTOSC.LONGITUD, PUNTOSC.LINK, PUNTOSC.DIRECCION, PUNTOSC.DESCRIPCION, PUNTOSC.CODIGO, PUNTOSC.IMAGEN, GALERIA.ICONO AS ARCHIVO, GALERIA.ICONOG AS ARCHIVO2 FROM PUNTOSC, GALERIA WHERE CLIENTE ='$c' AND PUNTOSC.ICONO = GALERIA.CODIGO";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $puntos = 0;
        while($row = $result->fetch_assoc()) {
            $puntos ++;
            $nombre 		= $row["NOMBRE"];
            $latitud		= $row["LATITUD"];
            $longitud  		= $row["LONGITUD"];	    
            $link	 		= $row["LINK"];
            $icono 			= $row["ARCHIVO"];
            $iconog			= $row["ARCHIVO2"];
            $direccion      = $row["DIRECCION"];
            $descripcion 	= '' ; //$row["DESCRIPCION"];
            $codigo 		= $row["CODIGO"];       
            $imagen 		= $row["IMAGEN"];
            if ($iconog==NULL) $iconog = $icono;

            if ($latitud != "" && $longitud != ""){	
                if ($puntos < $result->num_rows) {							
                    fwrite($file,"{'tipo':'1', 'nombre': '".str_replace("'","~",$nombre)."', 'latitud':".trim(str_replace(",",".",$latitud)).", 'longitud':".trim(str_replace(",",".",$longitud)).", 'categoria':'".$categoria."', 'link':'".$link."', 'icono':'".$icono."', 'iconog':'".$iconog."','direccion':'".str_replace("'","~",$direccion)."','descripcion':'".str_replace("'","~",$descripcion)."','codigo':'".$codigo."','imagen':'".$imagen."','idioma':'".$l."','contenidos':'0'},");
                }else{
                    fwrite($file,"{'tipo':'1', 'nombre': '".str_replace("'","~",$nombre)."', 'latitud':".trim(str_replace(",",".",$latitud)).", 'longitud':".trim(str_replace(",",".",$longitud)).", 'categoria':'".$categoria."', 'link':'".$link."', 'icono':'".$icono."', 'iconog':'".$iconog."','direccion':'".str_replace("'","~",$direccion)."','descripcion':'".str_replace("'","~",$descripcion)."', 'codigo':'".$codigo."','imagen':'".$imagen."','idioma':'".$l."','contenidos':'0'}");						
                }
            }
        }
    }	
    fwrite($file,"]}"); 		
    fclose($file);	
    $conn->close();	 
}

?>