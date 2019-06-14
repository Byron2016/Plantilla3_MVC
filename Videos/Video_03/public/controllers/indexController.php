<?php

//v2 - V3

class indexController extends Controller   //v2
{

	public function __construct()          //V3
	{
		parent::__construct();             //V3

	}
    
	public function index()                //v2
	{
        // echo "Hola desde index Controler"; //v2

        $this->_view->titulo = 'portada';  //V3

        //$this->_view->renderizar('index'); //V3
        $this->_view->renderizar('index','inicio'); //V3

	}
}