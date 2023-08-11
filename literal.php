<?php

function getTxt($v1,$v2){

 	include 'conexion.php';
	$conn = new mysqli($db_server, $db_username, $db_userpassword, $db_name);
	mysqli_set_charset($conn, 'utf8');
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

	 "SELECT CODIGO, TEXT_1, TEXT_2, TEXT_3, TEXT_4 FROM STRINGS ORDER BY CODIGO";
	 $stmt = $conn->prepare("SELECT CODIGO, TEXT_1, TEXT_2, TEXT_3, TEXT_4 FROM STRINGS ORDER BY CODIGO");
	 $stmt->execute();
	 $result = $stmt->get_result();

	if ($result->num_rows > 0) {
		$textos = Array();
		$x = 0;
		while( $row = mysqli_fetch_array($result) ) {
			$x++;
		  	$textos[$x][0] = $row["CODIGO"];
		  	$textos[$x][1] = $row["TEXT_1"];
		  	$textos[$x][2] = $row["TEXT_2"];		  	
		  	$textos[$x][3] = $row["TEXT_3"];		  			  	
		  	$textos[$x][4] = $row["TEXT_4"];		  	
		} 
	}
	$stmt->close();
	$conn->close();
	sort($textos);

	foreach ($textos as $values){
		if ($values[0] == $v1){
			echo str_replace("~","'",$values[$v2]);
		}
	}
}

?>

