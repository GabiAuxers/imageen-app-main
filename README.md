**ULTIMA VERSION DE IMAGEEN**

# Documentación del Proyecto

Este archivo de documentación describe los cambios recientes y actualizaciones en nuestro proyecto, incluyendo la refactorización del código, la creación de nuevas clases y la actualización a PHP 8.1.

## Tabla de Contenidos

- [Documentación del Proyecto](#documentación-del-proyecto)
  - [Tabla de Contenidos](#tabla-de-contenidos)
  - [Actualización a PHP 8.1](#actualización-a-php-81)
  - [Refactorización del Código](#refactorización-del-código)
    - [Cambio de Clases](#cambio-de-clases)
    - [Creación de Nuevas Clases](#creación-de-nuevas-clases)
  - [Routeo de la App](#routeo-de-la-app)
  - [Creación de Modales](#creación-de-modales)
  - [BUGS](#bugs)
  - [Cambios en Estructuras de CSS](#cambios-en-estructuras-de-css)
  - [Base de Datos](#base-de-datos)
  - [Instalación y Despliegue](#instalación-y-despliegue)
  - [Recursos Necesarios](#recursos-necesarios)
  - [CDN y Librerias](#cdn-y-librerias)
  

## Actualización a PHP 8.1

* [x] - Declaracion de variables, inicializacion de las mismas, uso de funcion ISSET.
* [x] - Cambio de etiquetas en todo el codigo.
* [x] - Cambio en sintaxis mysql (funciones nuevas)
  
## Refactorización del Código

- Se ha cambiado la estructura principal de la aplicacion y dado el estado de la misma se opto por un modelo llamado *Front controller*
- Para ello se opto por dejar la clase **contents.php** como la clase raiz de la aplicacion, la cual se encarga de routear las demas clases y de visualiar los contenidos de la misma. (se ha modularizado la clase, para que sea mas facil de leer y entender).
- Ahora contents esta limpia de codigo y solo se encarga de routear las demas clases.
- Tenemos otra clase donde se encuentra la carga del mapa de contents, la cual se llama **map.php**, ademas de otra llamada **variables.php** (anteriormente formaba parte de **contents.php**), donde se encuentran unas variables necesaria para la carga de algunos datos.
- En ella se carga tanto el mapa como el mensaje de informacion al hacer click en cada punto del mapa. (**infobox**)
- Se han creado tanto funciones en library.js como scripts en el transcurso de la aplicacion.

--Routeo=> lo podemos encontrar en **head.php**: 
```
<?php 
//Comprobamos si existe el parámetro de la url sectión para controlar el Route
$section = filter_input(INPUT_GET, 'section', FILTER_SANITIZE_STRING);
?>
```
A partir de aqui, ahora casi todas las clases seran llamadas ?section=nombreDeLaClase.

- Se han corregido errores de cargas incorrectas en la aplicacion, mejorado las conexiones a la base de datos y reducido
los tiempos de carga.
- Las nuevas consultas han sido creadas con sentencias preparadas para evitar ataques de inyeccion MySQL.

### Cambio de Clases

1. *head.php*: Variable $section. 
   1. Incorporacion de stylesheets y scripts, casi todos los CSS de la aplicacion se encuentran aqui.
2. *header.php*: La cabecera de toda la aplicacion se encuentra aqui. Tanto con las categorias como sin ellas como el logo de navidad.
3. *footer.php*: El pie de pagina de toda la aplicacion se encuentra ahora aqui. 
4. *_edituser.php*: Ahora luce diferente, debido a la actualizacion de campos concretos de la informacion de *infoPerfil.php* del usuario. En cualquier caso, para cambiarla, bastaria con ir al backup del proyecto y copiar el codigo de la anterior version.
5. *library.js*: contiene varias funciones asi como peticiones AJAX y jQuery nuevas.
6. Se han modificado las clases *contents.php*, *variables.php*, *home.php* para que se adapten al nuevo modelo de construccion de la aplicacion.
7. Se han retocado CSS antiguos.
8. *_addpoints*: Se ha modificado la consulta para actualizar e insertar ahora los datos de la puntuacion en el campo valoracion de la tabla **visualizaciones**.

A lo largo de la aplicacion se veran controles de errores de la base de datos, los cuales se han implementado para que la aplicacion no se rompa en caso de que haya un error en la base de datos. --inclusion de nuevas clases para ello--.

### Creación de Nuevas Clases

* [x] - *ErrorLogger*: Clase para el control de errores de la aplicacion.
* [x] - *Header*: Clase para la cabecera de la aplicacion.
* [x] - *Footer*: Clase para el pie de pagina de la aplicacion.
* [x] - *Map*: Clase para el mapa de la aplicacion.
* [x] - *Infobox*: Clase para la informacion de cada punto del mapa.
* [x] - *Login*: Clase para el login de la aplicacion.
* [x] - *crearCuenta*: Clase para la creacion de cuentas de la aplicacion. (no se ha implementado en la aplicacion debido a que se ha querido seguir utilizando firebase, por lo que no hay creacion de cuentas, pero dejamos la pantalla por si alguna vez quereis implementarla).
* [x] - *Perfil*: Clase para el perfil de la aplicacion.
* [x] - *InfoPerfil*: Clase para la informacion del perfil de la aplicacion.
* [x] - *InformacionPersonal*: Clase para la informacion personal del perfil de la aplicacion.
* [x] - *FAQ*: Clase para las preguntas frecuentes de la aplicacion.
* [x] - *Contacto*: Clase para el contacto de la aplicacion.
* [x] - *Politica de Privacidad*: Clase para la politica de privacidad de la aplicacion.
* [x] - *Guia Virtual*: Clase para la guia virtual de la aplicacion.
* [x] - *ScriptsApp*: Clase para los scripts de la aplicacion. --solo existe un script, viendo el modelo de construccion podeis pensar en mover todos los scripts aqui--.
* [x] - *List*: Clase para mostrar el listado de los contenidos. 
* [x] - *Registrar_Tiempo*: Clase para registrar el tiempo de los videos que cada usuario visualiza.
* [x] - *Configuracion.php*: Clase para la configuracion de la cuenta del usuario logueado.
Ademas, nuevos archivos CSS en toda la aplicacion.

## Routeo de la App

(Contenido)

## Creación de Modales

Se ha creado un nuevo modal para utilizar (actualmente es de contenido premium) en la aplicacion, el cual se encuentra en **modals.php** - linea 112.
Este modal ahora mismo se visualiza al hacer click sobre el corazon de favoritos del footer, esta funcionalidad habra que cambiarla segun las necesidades.
Es decir, si queremos que los textos de este modal cambien, habra que cambiarlos directamente, al igual que la posicion, establecerla donde se quiera.

```php
<!--Nuevo modal para imageen. Para instanciarlo, se deberan colocar los atributos
data-toggle="modal" data-target="#miModal" en el componente que vaya a desencadenar la accion.
Para instanciarlo se puede usar jQuery o JavaScript, ejemplo:

 $(document).ready(function() {
  $('#miModal').modal('show');
}); 

o bien:

document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('miModal').modal('show');
});-->
<div class="modal-background fade addpoints" id="modalPremium" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="nuevo-modal-content">
            <div class="nuevo-modal-header">
                <a href="#" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <img class="cerrar-modal" src="assets/img/icons/Cerrar.svg" alt="Cerrar">
                </a>
            </div>
            <a class="txt-titulo-modal">¡HAZTE PREMIUM!</a>
            <div class="nuevo-modal-body">
                <p class="txt-nuevo-modal">Disfruta de contenido en exclusiva y descubre todos los secretos.</p>
            </div>
            <div class="nuevo-modal-footer">
                <button type="button" class="btn-modal-premium">Premium</button>
            </div>
        </div>
    </div>
</div>
<!--Fin nuevo modal para imagen-->
```

## BUGS

1. - Se ha corregido el listado para que no muestre un modal fade cuando algun punto no cargue correctamente.
2. - Se ha corregido el error visual del listado que al principio hacia un zoom in y luego un zoom out.
3. - Ahora se puede deslizar sobre el slider en Madrid sin que se pare la aplicacion.
4. - Organizacion de las clases, includes, para que la aplicacion cargue de una manera mas optima.

## Cambios en Estructuras de CSS

(Contenido)

## Base de Datos


   *Explicacion de la trazabilidad* 

   En la base de datos se ha añadido una nueva tabla llamada **visualizaciones** (en php el archivo se llama registrar_tiempo) para registrar el tiempo que cada usuario visualiza un video. En esta tabla se debera de implementar el campo Ha finalizado cuando se implemente en la base de datos la duracion de los videos, y en base a la duracion total de los videos - el tiempo que ha visualizado el usuario, se determinara si ha finalizado o no el contenido.

   Se ha añadido una nueva tabla **sesiones_usuarios**.

   Respecto a las tabla de **usuarios**, se han añadido los campos: *VERSION_SISTEMA_OPERATIVO* y *DISPOSITIVO_MOVIL* para registrar el tipo de sistema operativo y en funcion de ello, determinar si es un movil o si no lo es. Si lo esta visualizando desde la web o la aplicacion, por como
   se tiene construida la aplicacion es muy complejo de implementar, por lo que no se ha hecho, si en el futuro se cambia la estructura de la aplicacion, se podria implementar.

   La tabla con el maestro de los contenidos, deberia de hacerse desde el admin, por lo que no se ha implementado, aqui los campos que deberia de tener:
    a.	Nombre
    b.	Código contenido
    c.	Versión
    d.	Activa (Si/no)
    e.	Punto geográfico
    f.	Ciudad
    g.	Es 360
    h.	Tiene modelado
    i.	Tiene avatar
    j.	Duración
    k.	Fecha de creación
    l.	Fecha última actualización.
    
  Se ha creado una tabla llamada **sesiones_usuarios** para registrar las sesiones de los usuarios, donde tendreis que ver que utilidad le podeis dar al campo Numero de eventos.

  En cuanto a los demas campos de trazabilidad, estos se pueden obtener directamente de google analitics, y para ser mas claros:
  
  - De la tabla **usuarios**: Numero de suscripciones.
  - De la tabla **sesiones_usuarios**: Pais de la sesion, Region de la sesion, Duracion de la sesion. 
  - De la tabla **maestros_contenidos** (a implementar en admin): Punto geografico, Ciudad, Duracion.

  Se ha creado una tabla **error_logs** cuyo archivo php es: *Error_Logger* para registrar los errores que se producen en la aplicacion, para que podais tener un control de los errores que se producen en la aplicacion. *NOTA IMPORTANTE*: Si la conexión a la base de datos falla, entonces se podra utilizar esa conexión para escribir en la base de datos, ya que no se ha podido establecer. En otras palabras, hará que falle también el intento de registrar el error en la base de datos. Por ello, se crea un archivo .txt automatico en el directorio raíz de la aplicación, llamado errors.txt, donde se registrarán los errores que se produzcan en la aplicación.

A continuacion se incorporan los scripts de las tablas creadas:

```sql
    CREATE TABLE `visualizaciones` (
    `SESSION_ID` varchar(255) DEFAULT NULL,
    `TIEMPO_TOTAL` int(11) DEFAULT NULL,
    `FECHA_HORA` datetime DEFAULT NULL,
    `MINUTOS` int(11) DEFAULT NULL,
    `SEGUNDOS` int(11) DEFAULT NULL,
    `CODIGO` varchar(255) DEFAULT NULL,
    `UID` varchar(255) DEFAULT NULL,
    `NOMBRE` varchar(255) DEFAULT NULL,
    `DISPOSITIVO` varchar(255) DEFAULT NULL,
    `PUNTO` varchar(255) DEFAULT NULL,
    `MATERIAL` varchar(255) DEFAULT NULL,
    `VERSION` varchar(255) DEFAULT NULL,
    `NOMBRE_PUNTO` varchar(255) DEFAULT NULL,
    `VALORACION` int(11) DEFAULT 0
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
    
    DATO: Se ha añadido VALORACION para registrar la valoracion que cada usuario hace de cada punto. El tiempo_total esta en segundos para que, si quereis sacar en un futuro el tiempo promedio que los usuarios visualizan cada contenido, sea mas facil de calcular.


    CREATE TABLE `error_logs` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `timestamp` datetime DEFAULT NULL,
    `error_message` text DEFAULT NULL,
    `additional_info` text DEFAULT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci


    CREATE TABLE `sesiones_usuarios` (
    `CODIGO_USUARIO` varchar(255) NOT NULL,
    `CODIGO_SESION` varchar(255) NOT NULL,
    `FECHA_HORA_SESION` datetime NOT NULL,
    `NUMERO_EVENTOS` int(11) DEFAULT NULL,
    PRIMARY KEY (`CODIGO_SESION`,`FECHA_HORA_SESION`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci

La tabla usuarios se aprovecho entera y solo se agregaron los dos campos mencionados anteriormente:

    CREATE TABLE `usuarios` (
    `ID` int(11) NOT NULL AUTO_INCREMENT,
    `CODIGO` varchar(20) NOT NULL,
    `UID` varchar(28) NOT NULL,
    `NOMBRE` varchar(50) NOT NULL,
    `APELLIDOS` varchar(50) DEFAULT NULL,
    `TELEFONO` varchar(15) NOT NULL,
    `EMAIL` varchar(100) DEFAULT NULL,
    `FOTO` varchar(100) DEFAULT NULL,
    `TOKEN` varchar(100) DEFAULT NULL,
    `PROVIDER` varchar(100) DEFAULT NULL,
    `IPALTA` varchar(20) DEFAULT NULL,
    `FECHAALTA` date DEFAULT NULL,
    `HORAALTA` varchar(25) DEFAULT NULL,
    `SUSCRIPCION` int(1) DEFAULT NULL,
    `FINSUSCRIPCION` datetime DEFAULT NULL,
    `STRIPECLIENTE` varchar(30) DEFAULT NULL,
    `PERMISOS` tinyint(1) NOT NULL DEFAULT 0,
    `FECHADATOSPERSO` datetime DEFAULT NULL,
    `FECHAPIDEDATOS` datetime DEFAULT NULL,
    `IDIOMA` varchar(1) DEFAULT NULL,
    `IDIOMA2` varchar(1) DEFAULT NULL,
    `VISUALIZACION` int(1) DEFAULT 1,
    `VERSION_SISTEMA_OPERATIVO` varchar(255) DEFAULT NULL,
    `DISPOSITIVO_MOVIL` varchar(3) DEFAULT NULL,
    PRIMARY KEY (`ID`),
    UNIQUE KEY `CODIGO` (`CODIGO`)
    ) ENGINE=InnoDB AUTO_INCREMENT=695281 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci

```

 *Consideraciones a tener en cuenta* 

 Vuestro sistema de llamadas, actualizaciones e inserccion de datos es un poco arcaico. Esto quiere decir que es posible que vuestra base de datos sea susceptible a ataques de inyeccion SQL.

 Las nuevas clases creadas para la trazabilidad de la base de datos ha sido realizada con consultas preparadas, para garantizar una seguridad mayor.
 Se modifico una clase extra *_addvpoints* que os proporcionamos para que podais ver como funciona:

    ```php
        $stmt = $conn->prepare("SELECT USUARIO FROM HVALORACION WHERE PUNTO = ? AND MATERIAL = ?");
        $stmt->bind_param("ss", $p, $m);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $date = date('Y-m-d');
        $time = date('h:i:sa');    

        if ($result->num_rows == 0){
            $stmt = $conn->prepare("INSERT INTO visualizaciones (VALORACION) VALUES (?)");
            $stmt->bind_param("i",$x);
            $stmt->execute();
            
        }else{
            $stmt = $conn->prepare("UPDATE visualizaciones SET VALORACION = ? WHERE PUNTO = ? AND MATERIAL = ? AND CODIGO = ?");
            $stmt->bind_param("isss",$x, $p, $m, $codigousuario);
            $stmt->execute();
        }

        $stmt->close();
        $conn->close();
    ```

    Los pasos a seguir son muy sencillos, en lugar de hacer una sentencia e introducir los campos en VALUES directamente, en su lugar se introducen interrogaciones y posteriormente con bind_param se pasan como argumentos, entre comillas el tipo de dato, si son integer se pasara una i, si son strings una s, asi sucesivamente,y despues, se agregan las variables en el mismo orden en el que se han puesto los campos.
    En el codigo en las nuevas clases se podra observar el patron de esta nueva funcionalidad.

 *Simplificación en Llamadas a la Base de Datos*

    Se ha simplificado la llamada a la base de datos, de tal forma que ahora se llama a la base de datos de la siguiente forma:

    ```php
            $sql3 = "SELECT PUNTOS.NOMBRE AS NOMBRE_PUNTO, PUNTOS.CIUDAD, PUNTOS.LOCALIZACION, PUNTOS.CLIENTE, PUNTOS.IMAGEN AS IMAGEN_PUNTO, MATERIALES.CODIGO AS CODIGO_MATERIAL, MATERIALES.NOMBRE" . $l . " AS NOMBRE_MATERIAL, MATERIALES.DESCRIPCION" . $l . " AS DESCRIPCION_MATERIAL, MATERIALES.TIPO AS TIPO_MATERIAL, MATERIALES.ACCESO AS ACCESO_MATERIAL, MATERIALES.INSTRUCCIONES" . $l . " AS INSTRUCCION_MATERIAL, MATERIALES.IMAGEN AS IMAGEN_MATERIAL
                    FROM MATERIALES
                    JOIN PUNTOS ON MATERIALES.PUNTO = PUNTOS.CODIGO
                    WHERE MATERIALES.PUNTO = '$codigo' AND PUNTOS.CODIGO = '$codigo'
                    ORDER BY MATERIALES.ORDEN";
    ```
    Sugiero aplicar el mismo patron de consulta en el resto de la aplicacion cuando sea posible, poco a poco, para amenizar la carga.
    (joins).

 *Control de los errores*

    ```php
    $conn = @new mysqli($db_server, $db_username, $db_userpassword, $db_name);
    if ($conn->connect_error) {
        $additionalInfo = "Fallo en la conexión a la base de datos en la clase _login.php línea 16. Comprueba las credenciales de la base de datos y que el servidor esté funcionando correctamente. Error específico: " . $conn->connect_error;
        $errorLogger = new ErrorLogger();
        $errorLogger->logErrorToFile('errors.txt', "Error de conexión a la base de datos", $additionalInfo);
        die("Ha ocurrido un error al intentar conectar a la base de datos.");
        
    }
    ```
    En el caso de que haya un error en la conexion a la base de datos, se creara un objeto de la clase ErrorLogger, que se encargara de registrar el error en un archivo de texto, en este caso, el archivo errors.txt, que se encuentra en la carpeta raiz del proyecto.
    Ademas, se usa @ en la conexion para suprimir warnings y se utiliza un die para mostrar en pantalla un texto amigable de cara al usuario y sin sacar mas datos a la luz.

## Instalación y Despliegue

    Para instalar y desplegar este proyecto en tu propio entorno de desarrollo local, es necesario tener instalados los dos proyectos (Imageen y Admin), hecho esto, sigue estos pasos:


    1. Descomprime o instala el proyecto con GitHub en el directorio HTDOCS.
    2. Instala las dependencias: `composer install` (o el comando apropiado para el proyecto)
    3. Configura tu entorno: 
        1. Navega al directorio del proyecto Imageen: `cd (nombre del directorio)` con cmd modo administrador
        2. Una vez dentro de el, crea un enlace simbolico entre ambos proyectos: mklink /D "nombreDelProyecto" C:\xampp\htdocs\admin
    4. Inicia el servidor de desarrollo local: `php -S localhost:8000` (o el comando apropiado para tu proyecto)

    Una vez que hayas completado estos pasos, deberías poder abrir un navegador web y navegar a `http://localhost:8000` para ver el proyecto en funcionamiento. (Es posible que tengas que poner /contents.php para inicializarlo)

## Recursos Necesarios

    Para instalar y trabajar con este proyecto, necesitarás los siguientes recursos:

    - PHP 8.1 o superior + XAMPP
    - Git
    - Proyecto secundario Admin para obtener ficheros e imagenes adicionales

## CDN y Librerias

    ```php
        <!-- Biblioteca para inclusion de Firebase y Firebase Analytics -->
        <script src="https://www.gstatic.com/firebasejs/9.13.0/firebase-app-compat.js"></script>
        <script src="https://www.gstatic.com/firebasejs/9.13.0/firebase-analytics-compat.js"></script>
        <script src="https://www.gstatic.com/firebasejs/9.13.0/firebase-app-check-compat.js"></script>
        <!-- Biblioteca para utilizar jQuery, para manipulación del Document Object Model (DOM), el manejo de eventos, animaciones y las interacciones AJAX, facilitando el desarrollo de aplicaciones web interactivas y dinámicas  -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <!-- Biblioteca para utilizar Bootstrap, un framework CSS que facilita la creación de interfaces web con CSS y JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <!-- Biblioteca para detectar la version del navegador -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/UAParser.js/2.0.0-alpha.1/ua-parser.min.js"></script>
        ```

