<!doctype html>
<html lang="es">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="guiaVirtual.css" rel="stylesheet">

<body>
    <div class="swiper-container-gv" style="overflow: hidden;">
        <div class="swiper-wrapper ">

            <div class="swiper-slide">
                <div class="container align-items-center">
                    <img src="assets/img/logo/Logotipo.svg" alt="Imageen" class="logo">
                    <div class="position-absolute" style="top: 10px; right: 10px;">
                        <img class="logo-cerrar" src="assets/img/icons/Cerrar.svg" alt="Cerrar">
                    </div>
                    <p class="text-center mt-5 txt-aventura">¿Estás buscando tu siguiente aventura?</p>
                    <button class="btn-siguiente mt-4 next-slide">Siguiente</button>
                </div>
            </div>

            <div class="swiper-slide">
                <div class="container align-items-center">
                    <img src="assets/img/logo/Mapa.svg" alt="Mapa" class="logo2">
                    <div class="position-absolute" style="top: 10px; right: 10px;">
                        <img class="logo-cerrar" src="assets/img/icons/Cerrar.svg" alt="Cerrar">
                    </div>
                    <div>
                        <p class="text-center mt-3 txt-presentacion">Explora virtualmente la ciudad que quieras con
                            Imageen.</p>
                        <p class="text-center mt-1 txt-presentacion">!Haz turismo y tránsportate al pasado!</p>
                    </div>
                    <button class="btn-siguiente mt-4 next-slide">Siguiente</button>
                </div>
            </div>

            <div class="swiper-slide">
                <div class="container align-items-center">
                    <img src="assets/img/logo/Monumentos.svg" alt="Mapa" class="logo2" style="margin-left: -18px;">
                    <div class="position-absolute" style="top: 10px; right: 10px;">
                        <img class="logo-cerrar" src="assets/img/icons/Cerrar.svg" alt="Cerrar">
                    </div>
                    <div>
                        <p class="text-center mt-3 txt-presentacion">Filtra por categoría y encontrarás los lugares
                            perfectos para tí.</p>
                        <p class="text-center mt-1 txt-presentacion">!Hay para todos los gustos!</p>
                    </div>
                    <button class="btn-siguiente mt-4 next-slide">Siguiente</button>
                </div>
            </div>

            <div class="swiper-slide">
                <div class="container align-items-center">
                    <img src="assets/img/logo/Favoritos.svg" alt="Mapa" class="logo2">
                    <div class="position-absolute" style="top: 10px; right: 10px;">
                        <img class="logo-cerrar" src="assets/img/icons/Cerrar.svg" alt="Cerrar">
                    </div>
                    <div>
                        <p class="text-center mt-3 txt-presentacion">Guarda en tu lista de favoritos y entra cuando
                            quieras.</p>
                        <p class="text-center mt-1 txt-presentacion">!Es perfecto para preparar un viaje!</p>
                    </div>
                    <button class="btn-siguiente mt-4 next-slide">Siguiente</button>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container align-items-center">
                    <img src="assets/img/logo/Perfil.svg" alt="Mapa" class="logo2">
                    <div class="position-absolute" style="top: 10px; right: 10px;">
                        <img class="logo-cerrar" src="assets/img/icons/Cerrar.svg" alt="Cerrar">
                    </div>
                    <div>
                        <p class="text-center mt-3 txt-presentacion">Si tienes alguna pregunta o sugerencia contáctanos
                            desde la sección de contacto.</p>
                        <p class="text-center mt-1 txt-presentacion">!No dudes en escribirnos!</p>
                    </div>
                    <button class="btn-explorar-guia mt-4">Explorar</button>
                </div>
            </div>

            <!-- Más slides aquí -->

        </div>
        <!-- Swiper Pagination -->
        <div class="swiper-pagination-gv"></div>
    </div>


    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar swiper
        const swiper = new Swiper('.swiper-container-gv', {
            pagination: {
                el: '.swiper-pagination-gv',
                clickable: true,
            },
        });

        const closeBtn = document.querySelectorAll('.logo-cerrar');
        closeBtn.forEach((img) => {
            img.addEventListener('click', function() {
                window.location.href = '?section=perfil';
            });
        });
        // Seleccionar todos los botones 'Siguiente' y agregar controlador de eventos
        const nextSlideButtons = document.querySelectorAll('.next-slide');
        nextSlideButtons.forEach((button) => {
            button.addEventListener('click', function() {
                swiper.slideNext();
            });
        });
    });
    document.querySelector('.btn-explorar-guia').addEventListener('click', function() {
        window.location.href = 'contents.php?section=mapa';
    });
    </script>
</body>

<head>