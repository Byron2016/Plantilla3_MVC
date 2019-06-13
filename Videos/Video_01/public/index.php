<?php
	define('DS', DIRECTORY_SEPARATOR);                      //V1
	define('ROOT', realpath(dirname(__FILE__)) . DS);       //V1
	define('APP_PATH', ROOT . 'application' . DS);          //V1


	require_once APP_PATH . 'Config.php';                   //V1
	require_once APP_PATH . 'Request.php';                  //V1
	require_once APP_PATH . 'Bootstrap.php';                //V1
	require_once APP_PATH . 'Controller.php';               //V1
	require_once APP_PATH . 'Model.php';                    //V1
	require_once APP_PATH . 'View.php';                     //V1
	require_once APP_PATH . 'Registry.php';                 //V1

	echo $_GET['url'];                                      //V1

	echo '<pre>'; print_r(get_required_files());            //V1

?>