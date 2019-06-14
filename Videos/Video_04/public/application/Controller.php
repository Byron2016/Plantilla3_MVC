<?php 

//V2 - V3 - V4

abstract class Controller                     //V2
{
	protected $_view;                         //V3
	
	public function __construct()             //V3
	{		
		$this->_view = new View(new Request); //V3
    }	    

    abstract public function index();         //V2

    protected function loadModel($modelo)          //V4
    {
        $modelo = $modelo . 'Model';                                //V4
        $rutaModelo = ROOT . 'models' . DS . $modelo . '.php';      //V4

        if (is_readable($rutaModelo))                               //V4
        {
            require_once $rutaModelo;                               //V4
            $modelo = new $modelo;                                  //V4
            return $modelo;                                         //V4
        }
        else 
        {
            throw new Exception('Error en application Controler.loadModel: Error de modelo función LoadMOdel'); //V4
        
        }
    }

    protected function getLibrary($libreria,$dirInterno)                            //V4
    {
        $rutaLibreria = ROOT . 'libs' . DS . $dirInterno . DS . $libreria . '.php'; //V4
        
        if (is_readable($rutaLibreria))                                             //V4
        {
            require_once $rutaLibreria;                                             //V4
        }
        else 
        {
            throw new Exception('Error en application Controler.getLibrary: Error de libreria');//V4
        }
        
    }
}

?>