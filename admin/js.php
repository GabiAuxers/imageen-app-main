	
  <!-- ================== BEGIN core-js ================== -->
  <script src="assets/js/vendor.min.js"></script>
  <script src="assets/js/app.min.js"></script>
  <script src="assets/js/theme/default.min.js"></script>
  <!-- ================== END core-js ================== -->
  
  <!-- OR without vendor.min.js -->

<script src="assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>  
<script src="assets/cropper/example/js/slim.kickstart.min.js"></script>  


	<script>
	  	$('#data-table-default').DataTable({
	    	responsive: true,
	        "language": {
	        "lengthMenu": " _MENU_ registros",
	        "zeroRecords": "No hay resultados",
	        "info": "Mostrando página _PAGE_ de _PAGES_",
	        "infoEmpty": "No Hay resultados",
	        "infoFiltered": "(filtro de _MAX_ registros)",    	
	        "search": "Buscar",
	       	"paginate": {
	        	"first":      "Inicio",
	        	"last":       "Final",
	        	"next":       "Siguiente",
	        	"previous":   "Anterior",
    		}}
		});
	</script>	