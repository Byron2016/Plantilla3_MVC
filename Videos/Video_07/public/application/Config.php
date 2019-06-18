<?php 

//v2 - v3 - V4 -V6

	ini_set('display_errors', 1);
	
	define('BASE_URL', 'http://nuevaplantilla201990612_mvc.net/');  //v3
	define('DEFAULT_CONTROLLER', 'index'); //v2 //controlador por defecto de la aplicación en caso de no enviarse en aplicación.
	define('DEFAULT_METODO', 'index');     //v2
	//define('DEFAULT_LAYOUT', 'default');   //v3
	define('DEFAULT_LAYOUT', 'layout1');   //v3

	define('APP_NAME', 'NOMBRE DE LA APLICACIÓN');      //v3
	define('APP_SLOGAN', 'SLOGAN DE LA APLICACIÓN');    //v3
	define('APP_COMPANY', 'COMPAÑÍA DE LA APLICACIÓN');	//v3

//parametros para base de datos:
    define('DB_HOST', 'localhost');                    //v4
    define('DB_USER', 'homestead');                    //v4
    define('DB_PASS', 'secret');                       //v4
    define('DB_NAME', 'ba_zzz_2019');                  //v4
    define('DB_CHAR', 'utf8');                         //v4
    define('DB_PORT', '3306');                         //v4
 ?>