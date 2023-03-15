<?php 
include 'conexion.php';
include 'literal.php';
include 'functions.php';
include 'auth.php';
?>

	<div class="row justify-content-center">
		<div class="col-10 col-sm-8 col-md-8 col-lg-4 col-xl-4">
			<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">

				<?$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
				mysqli_set_charset($conn, 'utf8');
				$sql = "SELECT TITULO".$l.", DESCRIPCION".$l.", IMAGEN FROM TOUR";
				$result = $conn->query($sql);?>

				<div class="carousel-inner">							
					<?$slide = 0;
					while ($row = mysqli_fetch_array($result) ) {				
						$slide++;
			  			$titulo 		= $row["TITULO".$l];
			    		$descripcion	= $row["DESCRIPCION".$l];
			    		$imagen  		= $row["IMAGEN"];?>  
					    <div class="carousel-item mt-40px <?if ($slide == 1){?>active<? } ?>" data-bs-interval="10000">
					    	<div class="foto">
						      	<img src="https://admin.imageen.net/data/tour/<?=$imagen?>" class="img-fluid rounded" alt="...">
					  		</div>
					  		<div class="texto mt-5"> 						    	
					  			<h6 class="text-center">(<?=$slide?>/<?=$result->num_rows;?>)</h6>	
						        <h3 class="h-40px"><?=$titulo?></h3>
						        <h6><?=$descripcion?></h6>
					  		</div>
					    </div>
					<?}?>
				</div>	    
				<?$conn->close();?>	 				
				
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
			