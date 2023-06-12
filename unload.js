window.addEventListener('beforeunload', function (e) {
    navigator.sendBeacon('/ruta/a/tu/script.php', '');
});