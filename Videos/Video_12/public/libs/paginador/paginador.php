<?php

//V12

class Paginador                                                                                   //V12
{
	//private $_registry; //22
	private $_datos; //registros devueltos                                                        //V12
	private $_paginacion; //datos de la paginacion                                                //V12
	protected $_db;//V12
	
	public function __construct() {                                                               //V12
		$this->_datos = array();                                                                  //V12
		$this->_paginacion = array();                                                             //V12
		//$this->_db = new Database(DB_HOST, DB_NAME, DB_PORT, DB_USER, DB_PASS, DB_CHAR); //22
		//$this->_registry = Registry::getInstancia(); //22
		//$this->_db = $this->_registry->_db;  //22
	}                                                                                             //V12

	public function paginar($query, $pagina = false, $limite = false, $paginacion = false)        //V12
	{                                                                                             //V12
		if($limite && is_numeric($limite))                                                        //V12
		{                                                                                         //V12
			$limite = $limite;                                                                    //V12
		} else {                                                                                  //V12
			$limite = 10;                                                                         //V12
		}                                                                                         //V12
		if($pagina && is_numeric($pagina))                                                        //V12
		{                                                                                         //V12
			$pagina = $pagina;                                                                    //V12
			$inicio = ($pagina -1) * $limite;                                                     //V12
		} else {                                                                                  //V12
			$pagina = 1;                                                                          //V12
			$inicio = 0;                                                                          //V12
		}                                                                                         //V12
		$registros = count($query);                                                               //V12
		$total = ceil($registros / $limite);                                                      //V12
		$this->_datos = array_slice($query, $inicio, $limite);                                    //V12
		$paginacion = array();                                                                    //V12
		$paginacion['actual'] = $pagina;                                                          //V12
		$paginacion['total'] = $total;                                                            //V12
		$paginacion['limite'] = $limite;                                                          //V12
		if($pagina > 1){                                                                          //V12
			$paginacion['primero'] = 1;                                                           //V12
			$paginacion['anterior'] = $pagina - 1;                                                //V12
		} else {                                                                                  //V12
			$paginacion['primero'] = '';                                                          //V12
			$paginacion['anterior'] = '';                                                         //V12
		}                                                                                         //V12
		if($pagina < $total){                                                                     //V12
			$paginacion['ultimo'] = $total;                                                       //V12
			$paginacion['siguiente'] = $pagina + 1;                                               //V12
		} else {                                                                                  //V12
			$paginacion['ultimo'] = '';                                                           //V12
			$paginacion['siguiente'] = '';                                                        //V12
		}		                                                                                  //V12
		$this->_paginacion = $paginacion;                                                         //V12
		$this->_rangoPaginacion($paginacion);                                                     //V12
		return $this->_datos;                                                                     //V12
	}                                                                                             //V12

	private function _rangoPaginacion($limite = false)                                            //V12
	{
		if($limite && is_numeric($limite))                                                        //V12
		{                                                                                         //V12
			$limite = $limite;                                                                    //V12
		} else {                                                                                  //V12
			$limite = 10;                                                                         //V12
		}                                                                                         //V12
		$total_paginas = $this->_paginacion['total'];                                             //V12
		$pagina_seleccionada = $this->_paginacion['actual'];                                      //V12
		$rango = ceil($limite / 2);                                                               //V12
		$paginas = array();                                                                       //V12
		$rango_derecho = $total_paginas - $pagina_seleccionada;                                   //V12
		
		if($rango_derecho < $rango)                                                               //V12
		{                                                                                         //V12
			$resto = $rango - $rango_derecho;                                                     //V12
		} else {                                                                                  //V12
			$resto = 0;                                                                           //V12
		}                                                                                         //V12
		$rango_izquierdo = $pagina_seleccionada	- ($rango + $resto);                              //V12
		for ($i = $pagina_seleccionada; $i > $rango_izquierdo; $i--) {                            //V12
			if ($i == 0) {                                                                        //V12
				break;                                                                            //V12
			}                                                                                     //V12
			$paginas[] = $i;                                                                      //V12
		}                                                                                         //V12
		sort($paginas);                                                                           //V12
		if($pagina_seleccionada < $rango){                                                        //V12
			$rango_derecho = $limite;                                                             //V12
		} else {                                                                                  //V12
			$rango_derecho = $pagina_seleccionada + $rango;                                       //V12
		}                                                                                         //V12
		for($i = $pagina_seleccionada + 1; $i <= $rango_derecho; $i++){                           //V12
			if($i > $total_paginas)                                                               //V12
			{                                                                                     //V12
				break;                                                                            //V12
			}                                                                                     //V12
			$paginas[] = $i;                                                                      //V12
		}                                                                                         //V12
		$this->_paginacion['rango'] = $paginas;                                                   //V12
		return $this->_paginacion;                                                                //V12
	}                                                                                             //V12

	//crear vista solo para paginacion
	//para usar misma vista en varias paginaciones
	public function getView($vista, $link = false)                                                //V12
	{                                                                                             //V12
		$rutaView = ROOT . 'views' . DS . '_paginador' . DS . $vista . '.php';                    //V12
		if($link)                                                                                 //V12
			$link = BASE_URL . $link . '/';                                                       //V12
		if(is_readable($rutaView))                                                                //V12
		{                                                                                         //V12
			ob_start(); //apertura el buffer                                                      //V12
			include $rutaView;                                                                    //V12
			$contenido = ob_get_contents();                                                       //V12
			ob_end_clean(); //limpia el buffer que acabamos de extraer                            //V12
			return $contenido;                                                                    //V12
		}                                                                                         //V12
		throw new Exception('Paginador.php, getView Error de paginacion');                        //V12
	}                                                                                             //V12
}