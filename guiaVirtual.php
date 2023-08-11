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
                    <div class="position-absolute" style="top: 10px; right: 10px;">
                        <img class="logo-cerrar" src="assets/img/icons/Cerrar.svg" alt="Cerrar">
                    </div>
                    <p class="text-center mt-5 txt-aventura"><?= getTxt(285, $l) ?>&nbsp;</p>
                    <button class="btn-siguiente mt-4 next-slide"><?= getTxt(286, $l) ?>&nbsp;</button>
                </div>
            </div>

            <div class="swiper-slide">
                <div class="container align-items-center">
                    <img src="assets/img/logo/Mapa.svg" alt="Mapa" class="logo2">
                    <div class="position-absolute" style="top: 10px; right: 10px;">
                        <img class="logo-cerrar" src="assets/img/icons/Cerrar.svg" alt="Cerrar">
                    </div>
                    <div style="height: 8rem;">
                        <p class="text-center mt-3 txt-presentacion"><?= getTxt(287, $l) ?>&nbsp;</p>
                        <p class="text-center mt-1 txt-presentacion"><?= getTxt(288, $l) ?>&nbsp;</p>
                    </div>
                    <button class="btn-siguiente mt-4 next-slide"><?= getTxt(286, $l) ?>&nbsp;</button>
                </div>
            </div>

            <div class="swiper-slide">
                <div class="container align-items-center">
                    <img src="assets\img\icons\tour-imageen.svg" alt="Explora categorias con Imageen" class="logo2">
                    <div class="position-absolute" style="top: 10px; right: 10px;">
                        <img class="logo-cerrar" src="assets/img/icons/Cerrar.svg" alt="Cerrar">
                    </div>
                    <div style="height: 8rem;">
                        <p class="text-center mt-3 txt-presentacion"><?= getTxt(289, $l) ?>&nbsp;</p>
                        <p class="text-center mt-1 txt-presentacion"><?= getTxt(290, $l) ?>&nbsp;</p>
                    </div>
                    <button class="btn-siguiente mt-4 next-slide"><?= getTxt(286, $l) ?>&nbsp;</button>
                </div>
            </div>

            <div class="swiper-slide">
                <div class="container align-items-center">
                    <img src="assets/img/logo/Favoritos.svg" alt="Mapa" class="logo2">
                    <div class="position-absolute" style="top: 10px; right: 10px;">
                        <img class="logo-cerrar" src="assets/img/icons/Cerrar.svg" alt="Cerrar">
                    </div>
                    <div style="height: 8rem;">
                        <p class="text-center mt-3 txt-presentacion"><?= getTxt(291, $l) ?>&nbsp;</p>
                        <p class="text-center mt-1 txt-presentacion"><?= getTxt(292, $l) ?>&nbsp;</p>
                    </div>
                    <button class="btn-siguiente mt-4 next-slide"><?= getTxt(286, $l) ?>&nbsp;</button>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container align-items-center">
                    <img src="assets/img/logo/Perfil.svg" alt="Mapa" class="logo2">
                    <div class="position-absolute" style="top: 10px; right: 10px;">
                        <img class="logo-cerrar" src="assets/img/icons/Cerrar.svg" alt="Cerrar">
                    </div>
                    <div style="height: 8rem;">
                        <p class="text-center mt-3 txt-presentacion"><?= getTxt(293, $l) ?>&nbsp;</p>
                        <p class="text-center mt-1 txt-presentacion"><?= getTxt(294, $l) ?>&nbsp;</p>
                    </div>
                    <button class="btn-explorar-guia mt-4"><?= getTxt(295, $l) ?>&nbsp;</button>
                </div>
            </div>

            <!-- Más slides aquí -->

        </div>
        <!-- Swiper Pagination -->
        <div class="swiper-pagination-gv"></div>
    </div>


    <script>
        $(document).ready(function() {
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
                    window.location.href = '?section=infoPerfil&t=3';
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
            window.location.href = 'contents.php?section=mapa&t=3';
        });
    </script>
</body>

<head>