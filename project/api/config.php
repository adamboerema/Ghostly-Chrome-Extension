<?php
	if($_SERVER['ENVIRONMENT'] == 'production'){
		define('DB_HOST', 'localhost');
		define('DB_USER', 'root');
		define('DB_PASS', '');
		define('DB_NAME', 'ghostly'); 
		
		error_reporting(0);
	}
	elseif($_SERVER['ENVIRONMENT'] == 'staging'){
		define('DB_HOST', 'localhost');
		define('DB_USER', 'root');
		define('DB_PASS', '');
		define('DB_NAME', 'extension'); 
		
		error_reporting(0);
	}
	else{
		define('DB_HOST', 'localhost');
        define('DB_USER', 'root');
        define('DB_PASS', '');
        define('DB_NAME', 'extension'); 

		error_reporting(E_ALL);
	}
?>  