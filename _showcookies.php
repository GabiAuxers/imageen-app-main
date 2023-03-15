<?php

$cookie_value = $_COOKIE['legal'];

if ($cookie_value == 1){
	$retorno = 1;
}else{	
	$retorno = 0;
}

echo json_encode(array('retorno' => $retorno));

?>