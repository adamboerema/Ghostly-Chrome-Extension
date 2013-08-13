<?php

	//Include necessary classes
	require('config.php');
	require('lib/api.php');
	require('lib/segment.php');
	
	$publix = new api(DB_USER, DB_PASS, DB_HOST, DB_NAME);
	
	//Url parameter segmenting
	$segment = new segment($_SERVER['REQUEST_URI'], 'api');
	$url = $segment->start();

	/**=============================================================
	 * 
	 * Trigger API
	 * 
	 =============================================================*/
	$publix->$url['action']($url['data']);
	
	

?>