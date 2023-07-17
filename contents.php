<?php
//require_once was added instead of include
require_once "variables.php";
require_once 'head.php';
require_once 'conexion.php';
//incluimos los scripts de la aplicacion
require_once 'ScriptsApp.php';
?>
<!-- Modularizacion del la etiqueta body, cargamos en funcion de la visualizacion del usuario y los contenidos. -->
<?php 
if ($x != "" || $visualizacion_usuario == 1) {
    if ($x != "") {
        echo '<script src="' . htmlspecialchars($ruta_admin . '/ficheros/puntos' . $x . '.xml') . '"></script>';
    } else {
        echo '<script src="' . htmlspecialchars($ruta_admin . '/ficheros/puntosImageen' . $l . '.xml') . '"></script>';
    }
    if ($t == 3) { ?>
        <body onload="onLoadContents(3, false, '<?= $p ?>', '<?= $m ?>', '<?= $u ?>', '<?= $a ?>');">
        <div id="overlay"></div>
    <?php } else { ?>
        <body onload="onLoadContents(1, false, '<?= $p ?>','<?= $m ?>', '<?= $u ?>', '<?= $a ?>');">
        <div id="overlay"></div>
        <?php }
    } else { ?>
        <body onload="onLoadContents(2, false, '<?= $p ?>', '<?= $m ?>', '<?= $u ?>', '<?= $a ?>');">
        <div id="overlay"></div>
<?php } ?>
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
                //Como controlamos por parametro sectión, siempre que no venga siempre cargará el mapa (inicio)
                default:
                    @include('map.php');
                    break;
            }
        ?>
    </div>
    <?php

        include 'js.php';
        //Cargamos footer
        include 'modals.php';
        include 'sesiones.php';
        include 'footer.php';
    ?>
</body>