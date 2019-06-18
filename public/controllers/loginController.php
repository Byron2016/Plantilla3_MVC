<?php

//V7

class loginController extends Controller                    //V7
{
    public function __construct(){                         //V7
        parent::__construct();                             //V7  
    }

    
    public function index()                           //V7
    {
        Session::set('autenticado', true);            //V7
        //Session::set('level', 'usuario');             //V7
        //Session::set('level', 'admin');               //V7
        //Session::set('level', 'usuario');             //V7
        Session::set('level', 'especial');            //V7
 
        Session::set('var1', 'var1');                 //V7
        Session::set('var2', 'var2');                 //V7
        $this->redireccionar('login/mostrar');        //V7
            
    }  
    
    public function mostrar()                            //V7
    {
        //Para hacer pruebas
        echo 'level: ' . Session::get('level').'<br>';   //V7
        echo 'var1: ' . Session::get('var1').'<br>';     //V7
        echo 'var2: ' . Session::get('var2').'<br>';     //V7
    }
    
    
    public function cerrar()                             //V7
    {
        //Session::destroy();                              //V7
        //Session::destroy(array('var1','var2'));          //V7
        //Session::destroy('var1');                        //V7
        Session::destroy();                              //V7
        $this->redireccionar('login/mostrar');           //V7
        //$this->redireccionar();
    }
    
}

?>