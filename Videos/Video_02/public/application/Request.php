<?php 

//V2

class Request                                                                 //V2
{
	private $_controlador;                                                    //V2
	private $_metodo;                                                         //V2
	private $_argumentos;                                                     //V2

    
	public function __construct()                                             //V2
	{
		if(isset($_GET['url'])){                                              //V2
			$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);       //V2
			$url = explode('/', $url);                                        //V2
			$url = array_filter($url);                                        //V2 //todos los elementos que no sean válidos en arreglo los elimina.

			$this->_controlador = strtolower(array_shift($url));              //V2
			$this->_metodo = strtolower(array_shift($url));                   //V2
			$this->_argumentos = $url;                                        //V2

		}
		if(!$this->_controlador){                                             //V2
			$this->_controlador = DEFAULT_CONTROLLER;                         //V2
		}
		if(!$this->_metodo){                                                  //V2
			$this->_metodo = DEFAULT_METODO;                                  //V2
		}
		if(!isset($this->_argumentos)){                                       //V2
			$this->_argumentos = array();                                     //V2
		}
    }
		
	public function getControlador()                                          //V2
	{
		return $this->_controlador;                                           //V2
    } 
    
	public function getMetodo()                                               //V2
	{
		return $this->_metodo;                                                //V2
    }
    
	public function getArgs()                                                 //V2
	{
		return $this->_argumentos;                                            //V2
	}
}


 ?>