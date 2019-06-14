<?php 

//V2 - V3

abstract class Controller                     //V2
{
	protected $_view;                         //V3
	
	public function __construct()             //V3
	{		
		$this->_view = new View(new Request); //V3
    }	    

    abstract public function index();         //V2
}

?>