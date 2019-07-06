<?php
include "model/model_infrefill.php";
$get = new model_infrefill();

if(!empty($_POST)){
	$action = $_POST['action'];
	$data = array();

	if($_POST['action'] == "data"){
	header('Content-Type: application/json');
		$d = $get->get_cartridge();
		$data = array();
		while ($z = $get->fetch($d)){
			$data[] = $z;
		}

		echo json_encode($data);
	}
	else{
		echo "none";
	}
}
?>