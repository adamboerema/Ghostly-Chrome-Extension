<?php
	require('../config.php');
	require('model.php');
	$model = new Model(DB_USER, DB_PASS, DB_HOST, DB_NAME);
	
	$id = $_POST['id'];
	$vote = $entries = $model->plusVote($id);
	
	if($vote){
		echo 'true';
	} else {
		echo 'false';
	}
?>