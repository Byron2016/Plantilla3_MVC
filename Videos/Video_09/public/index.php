<?php
	//V1 - V2 - V7 - V9
	define('DS', DIRECTORY_SEPARATOR);                      //V1
	define('ROOT', realpath(dirname(__FILE__)) . DS);       //V1
	define('APP_PATH', ROOT . 'application' . DS);          //V1

    //echo md5('1234'); exit;                                     //V9

    try {                                                       //V2
	    require_once APP_PATH . 'Config.php';                   //V1
	    require_once APP_PATH . 'Request.php';                  //V1
	    require_once APP_PATH . 'Bootstrap.php';                //V1
	    require_once APP_PATH . 'Controller.php';               //V1
	    require_once APP_PATH . 'Model.php';                    //V1
	    require_once APP_PATH . 'View.php';                     //V1
	    require_once APP_PATH . 'Registry.php';                 //V1
	    require_once APP_PATH . 'DataBase.php';                 //V4
	    require_once APP_PATH . 'Session.php';                  //V7

	    //echo $_GET['url'];                                      //V1

	    //echo '<pre>'; print_r(get_required_files());            //V1

	    /*
	    $r = new Request();                                      //v2

	    echo $r->getControlador() . '<br>';                      //V2
	    echo $r->getMetodo() . '<br>';                           //V2
	    print_r($r->getArgs());                                  //V2
	    */

	    Session::init();                                         //V7

	    Bootstrap::run(new Request());                           //V2

 } catch(Exception $e) {                                         //V2
	echo $e->getMessage();                                       //V2
}

?>