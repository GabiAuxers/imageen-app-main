<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Imageen</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Swiper CSS -->
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <!-- Estilos personalizados -->
  <link href="newcss.css" rel="stylesheet">
</head>
<body>
<?php
  $urlRedireccion = "https://www.example.com"; // Reemplaza esta URL con la que deseas redirigir
?>
<div class="container-fluid">
<div class="swiper-container">
  <div class="swiper-wrapper">
    <div class="swiper-slide">
      <div class="container h-100 d-flex flex-column justify-content-center align-items-center">
        <img src="assets/img/logo/Logotipo.svg" alt="Imageen" class="logo">
        <div class="position-absolute" style="top: 10px; right: 10px;">
          <img src="assets/img/icons/Cerrar.svg" alt="Cerrar" class="close-btn">
        </div>
        <p class="text-center mt-3 txt-aventura">¿Estás buscando tu siguiente aventura?</p>
        <button class="btn btn-siguiente next-slide">Siguiente</button>
      </div>
    </div>
	<div class="swiper-slide">
      <div class="container h-100 d-flex flex-column justify-content-center align-items-center">
        <img src="assets/img/logo/Mapa.svg" alt="Mapa" class="logo2">
        <div class="position-absolute" style="top: 10px; right: 10px;">
          <img src="assets/img/icons/Cerrar.svg" alt="Cerrar" class="close-btn">
        </div>
		<p class="text-center mt-3 txt-presentacion">Explora virtualmente la ciudad que quieras con Imageen.</p>
        <p class="text-center mt-3 txt-presentacion">!Haz turismo y tránsportate al pasado!</p>
        <button class="btn btn-siguiente next-slide">Siguiente</button>
      </div>
    </div>
	<div class="swiper-slide">
      <div class="container h-100 d-flex flex-column justify-content-center align-items-center">
        <img src="assets/img/logo/Monumentos.svg" alt="Mapa" class="logo2" style="margin-left: -55px;">
        <div class="position-absolute" style="top: 10px; right: 10px;">
          <img src="assets/img/icons/Cerrar.svg" alt="Cerrar" class="close-btn">
        </div>
		<p class="text-center mt-3 txt-presentacion">Filtra por categoría y encontrarás los lugares perfectos para tí.</p>
        <p class="text-center mt-3 txt-presentacion">!Hay para todos los gustos!</p>
        <button class="btn btn-siguiente next-slide">Siguiente</button>
      </div>
    </div>
	<div class="swiper-slide">
      <div class="container h-100 d-flex flex-column justify-content-center align-items-center">
        <img src="assets/img/logo/Favoritos.svg" alt="Mapa" class="logo2">
        <div class="position-absolute" style="top: 10px; right: 10px;">
          <img src="assets/img/icons/Cerrar.svg" alt="Cerrar" class="close-btn">
        </div>
		<p class="text-center mt-3 txt-presentacion">Guarda en tu lista de favoritos y entra cuando quieras.</p>
        <p class="text-center mt-3 txt-presentacion">!Es perfecto para preparar un viaje!</p>
        <button class="btn btn-siguiente next-slide">Siguiente</button>
      </div>
    </div>
	<div class="swiper-slide">
      <div class="container h-100 d-flex flex-column justify-content-center align-items-center">
        <img src="assets/img/logo/Perfil.svg" alt="Mapa" class="logo2">
        <div class="position-absolute" style="top: 10px; right: 10px;">
          <img src="assets/img/icons/Cerrar.svg" alt="Cerrar" class="close-btn">
        </div>
		<p class="text-center mt-3 txt-presentacion">Si tienes alguna pregunta o sugerencia contáctanos desde la sección de contacto.</p>
        <p class="text-center mt-3 txt-presentacion">!No dudes en escribirnos!</p>
        <button class="btn btn-siguiente next-slide">Siguiente</button>
      </div>
    </div>

    <!-- Más slides aquí -->
	
  </div>
  <!-- Swiper Pagination -->
  <div class="swiper-pagination"></div>
</div>
</div>
  <!-- jQuery, Popper.js y Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
  <!-- Swiper JS -->
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <!-- Scripts personalizados -->
  <script src="scripts.js"></script>

  <script>

	document.addEventListener('DOMContentLoaded', function () {
	// Inicializar swiper
	const swiper = new Swiper('.swiper-container', {
		pagination: {
		el: '.swiper-pagination',
		clickable: true,
		},
	});

  const closeBtn = document.querySelectorAll('.close-btn');
  closeBtn.forEach((img) => {
    img.addEventListener('click', function () {
		window.location.href = 'contents.php';
    });
  });
   // Seleccionar todos los botones 'Siguiente' y agregar controlador de eventos
   const nextSlideButtons = document.querySelectorAll('.next-slide');
  nextSlideButtons.forEach((button) => {
    button.addEventListener('click', function () {
      swiper.slideNext();
    });
  });
});

</script>
</body>
</html>











