<?php

    function get_item_code($v){
        include "conexion.php";
        $conn = @new mysqli($db_server, $db_username, $db_userpassword, $db_name);
        if ($conn->connect_error) {
            $additionalInfo = "Fallo en la conexión a la base de datos en la clase functions.php - metodo get_item_code - línea 5. Comprueba las credenciales de la base de datos y que el servidor esté funcionando correctamente. Error específico: " . $conn->connect_error;
            $errorLogger = new ErrorLogger();
            $errorLogger->logErrorToFile('errors.txt', "Error de conexión a la base de datos", $additionalInfo);
            die("Ha ocurrido un error al intentar conectar a la base de datos.");
        }
        if ($v == 1){
            $sql1 = "SELECT USUARIO FROM CONTADORES";
            $sql2 = "UPDATE CONTADORES SET USUARIO = USUARIO + 1";            
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

    function get_contents_point($codigo){
        include "conexion.php";
        $conn2 = @new mysqli($db_server, $db_username, $db_userpassword, $db_name);
        if ($conn2->connect_error) {
            $additionalInfo = "Fallo en la conexión a la base de datos en la clase functions.php - metodo get_contents_point - línea 40. Comprueba las credenciales de la base de datos y que el servidor esté funcionando correctamente. Error específico: " . $conn2->connect_error;
            $errorLogger = new ErrorLogger();
            $errorLogger->logErrorToFile('errors.txt', "Error de conexión a la base de datos", $additionalInfo);
            die("Ha ocurrido un error al intentar conectar a la base de datos.");
        }
        $sql2 = "SELECT count(*) FROM MATERIALES WHERE PUNTO = '$codigo'";
        $result2 = mysqli_query($conn2,$sql2); 
        $rowcount = mysqli_num_rows($result2);
        $conn2->close();         
        return $rowcount;
        
    }

    function get_logo_customer($codigo){
        include "conexion.php";
        $conn = @new mysqli($db_server, $db_username, $db_userpassword, $db_name);
        if ($conn->connect_error) {
            $additionalInfo = "Fallo en la conexión a la base de datos en la clase functions.php - metodo get_logo_customer - línea 57. Comprueba las credenciales de la base de datos y que el servidor esté funcionando correctamente. Error específico: " . $conn->connect_error;
            $errorLogger = new ErrorLogger();
            $errorLogger->logErrorToFile('errors.txt', "Error de conexión a la base de datos", $additionalInfo);
            die("Ha ocurrido un error al intentar conectar a la base de datos.");
        }
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

    function get_logo_city($codigo){
        include "conexion.php";
        $conn = @new mysqli($db_server, $db_username, $db_userpassword, $db_name);
        if ($conn->connect_error) {
            $additionalInfo = "Fallo en la conexión a la base de datos en la clase functions.php - metodo get_logo_city - línea 79. Comprueba las credenciales de la base de datos y que el servidor esté funcionando correctamente. Error específico: " . $conn->connect_error;
            $errorLogger = new ErrorLogger(null);
            $errorLogger->logErrorToFile('errors.txt', "Error de conexión a la base de datos", $additionalInfo);
            die("Ha ocurrido un error al intentar conectar a la base de datos.");
        }
        $sql = "SELECT IMAGEN FROM CIUDADES WHERE CODIGO ='$codigo'";
        $result = $conn->query($sql);
        if (!$result) $logo=false;
        else {
            $row = $result->fetch_assoc();
            if ($result->num_rows > 0) {
                $logo = $row["IMAGEN"];   
            }
            else {
                $logo = false;
            }
        }
        $conn->close();
        return $logo;      
    }    

    function give_me_flag($l){

        if ($l == 1){
            $dameBandera = "./imagenes/Spain.svg";
        }else if ($l == 2){
            $dameBandera = "./imagenes/EEUU.svg";
        }else if ($l == 3){
            $dameBandera = "./imagenes/France.svg";
        }else if ($l == 4){
            $dameBandera = "./imagenes/Catala.svg";
        }
        return $dameBandera;

    }   

    function dame_tipo_acceso($a){
    
        if ($a == 1){
            $dame_tipo_acceso ="Free";
        }elseif ($a == 2){
            $dame_tipo_acceso ="Club";
        }elseif ($a == 3){
            $dame_tipo_acceso ="Premium";

        }

        return $dame_tipo_acceso;

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
        }

        return $dame_tipo_material;
    }   

    function debug($v){
        include "conexion.php";
        $conn = @new mysqli($db_server, $db_username, $db_userpassword, $db_name);
        if ($conn->connect_error) {
            $additionalInfo = "Fallo en la conexión a la base de datos en la clase functions.php - metodo debug - línea 149. Comprueba las credenciales de la base de datos y que el servidor esté funcionando correctamente. Error específico: " . $conn->connect_error;
            $errorLogger = new ErrorLogger(null);
            $errorLogger->logErrorToFile('errors.txt', "Error de conexión a la base de datos", $additionalInfo);
            die("Ha ocurrido un error al intentar conectar a la base de datos.");
        }
        $sql = "INSERT INTO DEBUG (texto) VALUES ('$v')";
        $conn->query($sql);
        $conn->close(); 
    }  
   
    function print_log($val) {
        return file_put_contents('php://stderr', print_r($val, TRUE));
    }

    function browser_es_safari() {
        /* detect Mobile Safari */
        $browserAsString = $_SERVER['HTTP_USER_AGENT'];
        if (strstr($browserAsString, " AppleWebKit/") && strstr($browserAsString, " Mobile/")) {
            return true;
        }
        return false;
    }

    function imageen_en_useragent() {
        $browserAsString = $_SERVER['HTTP_USER_AGENT'];
        if (strstr($browserAsString, "Imageen")) {
            return true;
        }
        return false;
    }
    function getDevice() {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
    
        if (strpos($userAgent, 'Movil') !== false) {
            return 'Movil';
        } elseif (strpos($userAgent, 'Tablet') !== false) {
            return 'Tablet';
        } else {
            return 'Ordenador';
        }
    }
?>
