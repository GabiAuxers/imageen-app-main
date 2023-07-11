<!doctype html>
<html lang="es">

<head>
    <!-- Facebook Propiedades -->
    <Link rel="canonical" href="https://app.imageen.net" />
    <meta property="og:url" content="https://app.imageen.net" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Con Imageen revive la historia" />
    <meta property="og:description" content="App para poder visualizar monumentos o espacios historicos desde tu dispositivo móvil" />
    <meta property="og:image" content="https://admin.imageen.net/imagenes/LogoFacebook2.png" />
    <meta property="og:locale" content="es_ES" />
    <meta property="fb:app_id" content="467353625276049" />
    <!-- End Facebook Propiedades -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">

<?php 
//Comprobamos si existe el parámetro de la url sectión para controlar el Route
$section = filter_input(INPUT_GET, 'section', FILTER_SANITIZE_STRING);
?>
    
    <?php
        $v = isset($_GET["v"]) && !empty($_GET["v"]) ? $_GET["v"] : "";

        if (($v)) {
            switch ($v) {
                case "1000":
                    $ciudad = "Madrid";
                    break;
                case "1002":
                    $ciudad = "Tarragona";
                    break;
                case "1003":
                    $ciudad = "Mérida";
                    break;
                case "1004":
                    $ciudad = "Cartagena";
                    break;
                case "1032":
                    $ciudad = "Montblanc";
                    break;
                case "1033":
                    $ciudad = "Corrales";
                    break;
                default:
                    $ciudad = null;
                    break;
            }
        } else {
            $ciudad = null; // o asignar otro valor predeterminado
        }

        if (imageen_en_useragent()) {
            $capado_apple = true;
        } else {
            //$capado_apple = false;
            $capado_apple = true;
        }
    ?>
    <?php
        //new PHP Version, modified: 02/03/2023/ -
        if ($ciudad != null) {
            echo "<title>Imagee" . $ciudad . "</title>";
            echo "<link rel=manifest href='./manifests/manifest-'" . $ciudad . ".json>";
        } else {
            echo "<title>Imageen</title>";
            echo "<link rel=manifest href='./manifests/manifest.json'>";
        }
    ?>
    <link rel="canonical" href="https://app.imageen.net">
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./favicon/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./favicon/favicon-36x36.png">
    <link rel="icon" type="image/png" sizes="48x48" href="./favicon/<?= $ciudad ?>/android-icon-48x48.png">
    <link rel="icon" type="image/png" sizes="72x72" href="./favicon/<?= $ciudad ?>/android-icon-72x72.png">
    <link rel="icon" type="image/png" sizes="96x96" href="./favicon/<?= $ciudad ?>/android-icon-96x96.png">
    <link rel="icon" type="image/png" sizes="144x144" href="./favicon/<?= $ciudad ?>/android-icon-144x144.png">
    <link rel="icon" type="image/png" sizes="192x192" href="./favicon/<?= $ciudad ?>/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="./favicon/<?= $ciudad ?>/android-icon-512x512.png">
    <link rel="apple-touch-icon" href="./favicon/<?= $ciudad ?>/apple-icon.png">
    <link rel="apple-touch-icon" sizes="57x57" href="./favicon/<?= $ciudad ?>/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="./favicon/<?= $ciudad ?>/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="./favicon/<?= $ciudad ?>/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="./favicon/<?= $ciudad ?>/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="./favicon/<?= $ciudad ?>/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="./favicon/<?= $ciudad ?>/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="./favicon/<?= $ciudad ?>/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="./favicon/<?= $ciudad ?>/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="./favicon/<?= $ciudad ?>/apple-icon-180x180.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="./favicon/<?= $ciudad ?>/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <meta name="mobile-web-app-capable" content="yes">

    <?php if (isset($v) && $v) { ?>
        <meta name="apple-mobile-web-app-title" content="Imageen <?= $ciudad ?>">
    <?php } else { ?>
        <meta name="apple-mobile-web-app-title" content="Imageen">
    <?php } ?>

    <meta name="apple-mobile-web-app-capable" content="yes">
    <link href="./imagenes/<?= $ciudad ?>/Splash Screen 2048x2732.png" sizes="2048x2732" rel="apple-touch-startup-image">
    <link href="./imagenes/<?= $ciudad ?>/Splash Screen 1668x2224.png" sizes="1668x2224" rel="apple-touch-startup-image">
    <link href="./imagenes/<?= $ciudad ?>/Splash Screen 1536x2048.png" sizes="1536x2048" rel="apple-touch-startup-image">
    <link href="./imagenes/<?= $ciudad ?>/Splash Screen 1242x2208.png" sizes="1242x2208" rel="apple-touch-startup-image">
    <link href="./imagenes/<?= $ciudad ?>/Splash Screen 1125x2436.png" sizes="1125x2436" rel="apple-touch-startup-image">
    <link href="./imagenes/<?= $ciudad ?>/Splash Screen 750x1334.png" sizes="750x1334" rel="apple-touch-startup-image">
    <link href="./imagenes/<?= $ciudad ?>/Splash Screen 640x1136.png" sizes="640x1136" rel="apple-touch-startup-image">

    <!--src library.js-->
    <script src="library.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-CQTX87S8M6"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-CQTX87S8M6');
    </script>

    <!-- Firebase compatibilidad con v8 para auth-->
    <!-- TODO: revisar version Firebase -->
    <script src="https://www.gstatic.com/firebasejs/9.13.0/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.13.0/firebase-analytics-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.13.0/firebase-app-check-compat.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>   
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Biblioteca para detectar la version del navegador -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/UAParser.js/2.0.0-alpha.1/ua-parser.min.js"></script>
    <!-- reCAPTCHA -->
    <script src='https://www.google.com/recaptcha/api.js'></script>


    <script>
        const firebaseConfig = {
            apiKey: "AIzaSyB97Z4gnECGXzhNx4HKOg1vdVUnw-7cIzA",
            authDomain: "imageen-app.firebaseapp.com",
            projectId: "imageen-app",
            storageBucket: "imageen-app.appspot.com",
            messagingSenderId: "948349517057",
            appId: "1:948349517057:web:daf048012d126550c46f00",
            measurementId: "G-MZR2HJJKGM"
        };

        const firebaseApp = firebase.initializeApp(firebaseConfig);
        const analytics = firebase.analytics();
        const appCheck = firebase.appCheck();
    </script>

    <!--<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,600,700" rel="stylesheet">
    <link href="assets/css/vendor.min.css" rel="stylesheet">
    <link href="assets/css/default/app.min.css" rel="stylesheet">
    <link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="assets/plugins/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">	
    <link href="assets/plugins/switchery/dist/switchery.min.css" rel="stylesheet">-->

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Fuentes de Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Remix Icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Swiper -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   

    <!-- Hojas de estilo -->
    <link href="ficha.css" rel="stylesheet">
    <link href="signin.css" rel="stylesheet">
    <link href="custom_contents.css" rel="stylesheet">
    <link href="contents.css" rel="stylesheet">
    <link href="custom.css" rel="stylesheet">
    <link href="infoPerfil.css" rel="stylesheet" />
    <link rel="stylesheet" href="custom.css">
    <link href="infobox.css" rel="stylesheet">
    <link href="login.css" rel="stylesheet">
    <link href="crearCuenta.css" rel="stylesheet">
    <link href="input-generic.css" rel="stylesheet">
    <link href="informacionPersonal.css" rel="stylesheet">
    <link href="configuracion.css" rel="stylesheet">



    <!-- Swiper -->
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <!-- Deshabilitar botón back del navegador-->
    <script>
        window.addEventListener('popstate', () => {
            window.history.go(1);
        });
        window.history.pushState(null, null, window.location.href);
    </script>

    <!-- Facebook Pixel Code -->
    <!-- TODO: revisar el id para firebase -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '730954361279726');
        fbq('track', 'PageView');
    </script>

    <noscript>
        <img height="1" width="1" src="https://www.facebook.com/tr?id=730954361279726&ev=PageView&noscript=1" />
    </noscript>
    <!-- End Facebook Pixel Code -->

    <!-- TikTok Pixel Code -->
    <script>
        ! function(w, d, t) {
            w.TiktokAnalyticsObject = t;
            var ttq = w[t] = w[t] || [];
            ttq.methods = ["page", "track", "identify", "instances", "debug", "on", "off", "once", "ready", "alias",
                "group", "enableCookie", "disableCookie"
            ], ttq.setAndDefer = function(t, e) {
                t[e] = function() {
                    t.push([e].concat(Array.prototype.slice.call(arguments, 0)))
                }
            };
            for (var i = 0; i < ttq.methods.length; i++) ttq.setAndDefer(ttq, ttq.methods[i]);
            ttq.instance = function(t) {
                for (var e = ttq._i[t] || [], n = 0; n < ttq.methods.length; n++) ttq.setAndDefer(e, ttq.methods[n]);
                return e
            }, ttq.load = function(e, n) {
                var i = "https://analytics.tiktok.com/i18n/pixel/events.js";
                ttq._i = ttq._i || {}, ttq._i[e] = [], ttq._i[e]._u = i, ttq._t = ttq._t || {}, ttq._t[e] = +new Date,
                    ttq._o = ttq._o || {}, ttq._o[e] = n || {};
                n = document.createElement("script");
                n.type = "text/javascript", n.async = !0, n.src = i + "?sdkid=" + e + "&lib=" + t;
                e = document.getElementsByTagName("script")[0];
                e.parentNode.insertBefore(n, e)
            };

            ttq.load('CDR3A0JC77U7SE2I6JB0');
            ttq.page();
        }(window, document, 'ttq');
    </script>
    <!-- End TikTok Pixel Code -->

    <!-- Event snippet for Website traffic conversion page -->
    <script>
        gtag('event', 'conversion', {
            'send_to': 'AW-10940344382/FvNgCP3xxc0DEL7Q4eAo'
        });
    </script>
    <!-- End Event snippet añadido por Jairo para el tema de google Adwors que necesita Pedro-->

    <!-- Service worker -->
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/service-worker.js')
                    .then((reg) => {
                        console.log('Service worker registered.', reg);
                    })
                    .catch((error) => {
                        console.log('Service worker not registered.', error);
                    });
            });
        }
    </script>
</head>