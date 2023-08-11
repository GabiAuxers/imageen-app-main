<?php 
include 'conexion.php';
include 'literal.php';
include 'functions.php';
include 'auth.php';
?>

<div class="row justify-content-center">
	<div class="col-10 col-sm-8 col-md-8 col-lg-4 col-xl-4">
		<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">

			<?php
				$conn = @new mysqli($db_server, $db_username, $db_userpassword, $db_name);
				if ($conn->connect_error) {
					$additionalInfo = "Fallo en la conexión a la base de datos en la clase _loadguide.php línea 13. Comprueba las credenciales de la base de datos y que el servidor esté funcionando correctamente. Error específico: " . $conn->connect_error;
					$errorLogger = new ErrorLogger();
					$errorLogger->logErrorToFile('errors.txt', "Error de conexión a la base de datos", $additionalInfo);
					die("Ha ocurrido un error al intentar conectar a la base de datos.");

				}
				mysqli_set_charset($conn, 'utf8');

				 $stmt = $conn->prepare ("SELECT TITULO$l, DESCRIPCION$l, IMAGEN FROM TOUR");
				 $stmt->execute();
				 $result = $stmt->get_result();
			?>

			<div class="carousel-inner">
				<?php
					$slide = 0;
					while ($row = $result->fetch_assoc()) {
						$slide++;
						$titulo = $row["TITULO$l"];
						$descripcion = $row["DESCRIPCION$l"];
						$imagen = $row["IMAGEN"];
				?>
				<div class="carousel-item mt-40px <?php if ($slide == 1) { ?>active<?php } ?>" data-bs-interval="10000">
					<div class="foto">
						<img src="https://admin.imageen.net/data/tour/<?= $imagen ?>" class="img-fluid rounded" alt="...">
					</div>
					<div class="texto mt-5">
						<h6 class="text-center">(<?= $slide ?>/<?= $result->num_rows ?>)</h6>
						<h3 class="h-40px"><?= $titulo ?></h3>
						<h6><?= $descripcion ?></h6>
					</div>
				</div>
				<?php }  ?>
				<?php
				$stmt->close();
				$conn->close(); ?>
			</div>

			<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
			</button>
			<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
			</button>
		</div>
	</div>
</div>
