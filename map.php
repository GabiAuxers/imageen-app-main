<!--Mapa y Vantanas emergentes donde ver una previsualización de cada punto-->
<?php if ($visualizacion_usuario == 1 || $x != "") { ?>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div>
                <a href="contents.php" style="text-decoration:none;color:white;">
                </a>
            </div>
            <div class="col-12" style="height: 70%;">
                <div id="map" style="width: 100%; height: 100%;"></div>
                <div id="info-box" style="display: none;"></div>
            </div>
        </div>
    </div>
<?php } ?>
<script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB97Z4gnECGXzhNx4HKOg1vdVUnw-7cIzA&libraries=geometry,places">
</script>