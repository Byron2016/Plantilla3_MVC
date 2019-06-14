<?php

//V3

class holaController extends Controller                //V3
{
	public function __construct(){                     //V3
		parent::__construct();                         //V3
    }
    
	public function index()                            //V3
	{

		$this->_view->titulo = 'Hola';                 //V3
		$this->_view->renderizar('index', 'hola');     //V3
	}
}