<?php
	if($_SERVER['ENVIRONMENT'] == 'production'){
		define('DB_HOST', 'localhost');
		define('DB_USER', 'root');
		define('DB_PASS', 'password!@#$');
		define('DB_NAME', 'extension'); 
		
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
		define('DB_PASS', 'password!@#$');
		define('DB_NAME', 'extension'); 
		

		error_reporting(E_ALL);
	}
    
    //Define root
    define('ABSPATH', dirname(__FILE__));
?>  