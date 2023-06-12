<!--All the PHP code of this class was rewritten in  7.4.3 version | 23/03/2023-->
<?php
//require_once was added instead of include
session_start();

require_once "conexion.php";
require_once "literal.php";
require_once "functions.php";
require_once "auth.php";


//new feature 24/03/2023
//require_once "Logger.php";
//require_once "ErrorLogger.php";
if ($_SERVER['SERVER_NAME'] === "localhost") $ruta_admin = "admin/";
else $ruta_admin = "https://admin.imageen.net";

// variable $a - PHP 8.1.16 - 28/03/2023
$a = $row["ACCESO"] ?? null;

//If-else structure modified 23/03/2023

//switch - default implementation
$u = 0;

switch ($suscripcion_usuario) {
    case 1:
        $u = 1;
        break;
    case 2:
        $u = 2;
        break;
    case 3:
        $u = 3;
        break;
    default:
        $u = 0;
}

if ($auth == 1) {

    // empty check changes - Modified - 06/03/2023
    $t = !empty($_GET["t"]) ? $_GET["t"] : ""; // Visualization type (solo puede ser 3 -mapa sin localización- o vacío)
    $v = !empty($_GET["v"]) ? $_GET["v"] : ""; // City
    $x = !empty($_GET["x"]) ? $_GET["x"] : ""; // Customer
    $p = !empty($_GET["p"]) ? $_GET["p"] : ""; // Punto Imageen
    $m = !empty($_GET["m"]) ? $_GET["m"] : ""; // Media Imageen

    $conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);

    //New feature - LOG - implemented on 24/03/2023
    //Log register, in this case we created an instance of the object Logger of the class Logger.php
    //and then, we called the log() mehtod. We used the already $conn connection.

    // $logger = new Logger($conn);
    // $logger->log();

    // TODO: Solucion para si existe m solo
    // Use of the empty method again
    if ($m != "") {
        $m2 = str_replace("maplist", "", $m);
        $sql = "SELECT ACCESO FROM MATERIALES WHERE CODIGO='$m2'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_array($result);
            $a    = $row["ACCESO"];
        } else {
            $a = 0;
        }
    }

    if ($x != "") {
        //$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
        mysqli_set_charset($conn, 'utf8');
        $sql = "SELECT NOMBRE, IMAGEN, TEXTO1, INICIO FROM CLIENTES WHERE CODIGO ='$x'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        if ($result->num_rows > 0) {
            $nombre = $row["NOMBRE"];
            $imagen = $row["IMAGEN"];
            $texto  = $row["TEXTO1"];
            $inicio = $row["INICIO"];
        } else {
            $activo = 0;
            $nombre = "n/a";
            $inicio = 0;
        }
        $conn->close();
    } else {
        $activo = 0;
    }
} else {
    $parametros = $_SERVER['QUERY_STRING'];
    if ($parametros != "") {
        header("Location: default.php?" . $parametros);
    } else {
        header("Location: default.php");
    }
}

?>
