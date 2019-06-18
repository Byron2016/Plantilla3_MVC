<?php

//V7 - V8

class errorController extends Controller                     //V7
{
	
	public function __construct()                            //V7
	{
		parent::__construct();                               //V7
	}
	public function index()                                  //V7
	{
        $this->_view->titulo = 'Error';                      //V7
        $this->_view->mensaje = $this->_getError();          //V7

        $this->_view->renderizar('index');                   //V7
    }

    public function access($codigo)                          //V7
    {
        $this->_view->titulo = 'Error';                      //V7
        $this->_view->mensaje = $this->_getError($codigo);   //V7

        $this->_view->renderizar('access');                  //V7
    }

    private function _getError($codigo = false)                  //V7
	{
        if($codigo){                                             //V7      
            $codigo = $this->filtrarInt($codigo);                //V7
            if(is_int($codigo))                                  //V7
                $codigo = $codigo;                               //V7
        }else{                                                   //V7
            $codigo = 'default';                                 //V7
        }
           
        $error['default'] = 'Ha ocurrido un error y la pagina no puede mostrarse'; //V7
        $error['5050'] = 'Acceso Restringido';                                     //V7
        $error['8080'] = 'Tiempo de la session agotado'; //V8 //se define para manejar tiempo de sesion

        if(array_key_exists($codigo, $error))                       //V7
        {
            return $error[$codigo];                                 //V7
        }  else {                                                   //V7
            return $error['default'];                               //V7
        }
    }

}
