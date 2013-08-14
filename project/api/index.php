<?php

	//Include necessary classes
	require('../config.php');
	require('lib/api.php');
	require('lib/segment.php');
	
	$api = new api(DB_USER, DB_PASS, DB_HOST, DB_NAME);
	
	//Url parameter segmenting
	$segment = new segment($_SERVER['REQUEST_URI'], 'api');
	$url = $segment->start();

	/**=============================================================
	 * 
	 * Trigger API
	 * 
	 =============================================================*/
	//$api->$url['action']($url['data']);
	
	$api->add('http://media-cache-ak0.pinimg.com/236x/09/42/84/09428430d6bb9d7b7fdae0baabb7f999.jpg');

?>