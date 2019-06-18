<?php

//V2

 class Bootstrap //V2
{
	public static function run(Request $peticion)                              //V2
	{
		$controller = $peticion->getControlador() . 'Controller';              //V2
		$rutaControlador = ROOT . 'controllers' . DS . $controller  . '.php';  //V2
		// echo $rutaControlador; exit;                                          //V2
		
		$metodo =  $peticion->getMetodo();                                     //V2
		$args = $peticion->getArgs();                                          //V2

		if(is_readable($rutaControlador)){                                     //V2
			//vverificar si archivo existe y es legible
			require_once $rutaControlador;                                     //V2
			$controller = new $controller;                                     //V2

			if(is_callable(array($controller, $metodo))){                      //V2
				$metodo = $peticion->getMetodo();                              //V2
			} else {
				$metodo = DEFAULT_METODO;                                      //V2
			}

			if(isset($args)){                                                  //V2
				call_user_func_array(array($controller, $metodo), $args);
			} else {
				call_user_func(array($controller, $metodo));                   //V2
			}
		} else {
			throw new Exception('Error en application clase Bootstrap.RUN No encontrado: ' . $rutaControlador); //V2
		}
		
	}
}

 ?>