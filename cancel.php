<?php include 'conexion.php';
include 'literal.php';
include 'functions.php';
include 'auth.php';

$url_destino = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$query = $_SERVER["QUERY_STRING"];

include 'head.php';
?>

    <body class="text-center px-3">
        <h3 class="mt-5">¡Oops!</h3>
        <h3><?=getTxt(130,$l)?> :-\</h3>

        <p style="font-family: Poppins; font-weight:normal; margin-top:1em;">
            <?=getTxt(131,$l)?>
        </p>
        <a id="botonIniciarSesion" type="button" class="btn boton-principal p-2 mt-2" href="./contents.php<?=((!empty($_SERVER['QUERY_STRING']))?('?'.$_SERVER['QUERY_STRING']):'')?>">
            <?=getTxt(104,$l)?>
        </a>
    </body>

<?php include 'js.php'; ?>

</html>
