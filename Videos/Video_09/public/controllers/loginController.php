<?php

//V7 - V9

class loginController extends Controller                    //V7
{
    private $_login;                                       //V9
    public function __construct(){                         //V7
        parent::__construct();                             //V7  
        $this->_login = $this->loadModel('login');         //V9
    }

    
    public function index()                           //V7
    {
        //Session::set('autenticado', true);            //V7
        //Session::set('level', 'usuario');             //V7
        //Session::set('level', 'admin');               //V7
        //Session::set('level', 'usuario');             //V7
        //Session::set('level', 'especial');            //V7
        //Session::set('level', 'admin');               //V8
        //Session::set('level', 'usuario');             //V8
        //Session::set('tiempo', time());               //V8

        //Session::set('var1', 'var1');                 //V7
        //Session::set('var2', 'var2');                 //V7
        //$this->redireccionar('login/mostrar');        //V7

        $this->_view->titulo = 'Iniciar Sesion';        //V9
        
        if($this->getInt('enviar') == 1)                //V9
        {
            $this->_view->datos = $_POST;               //V9 //para q se mantenga el nombre d usuario
            
            if(!$this->getAlphaNum('usuario')){                                //V9
                $this->_view->_error = 'Debe introducir su nombre de usuario'; //V9
                $this->_view->renderizar('index','login');                     //V9
                exit;                                                          //V9
            }
            
            if(!$this->getSql('pass')){                                        //V9
                $this->_view->_error = 'Debe introducir su password';          //V9
                $this->_view->renderizar('index','login');                     //V9
                exit;                                                          //V9
            }
            
            $row = $this->_login->getUsuario(                                  //V9
                    $this->getAlphaNum('usuario'),                             //V9
                    $this->getSql('pass')                                      //V9
                    );                                                         //V9
            
            if(!$row){                                                         //V9
                $this->_view->_error = 'Usuario y/o password incorrectos';     //V9
                $this->_view->renderizar('index','login');                     //V9
                exit;                                                          //V9
            }
            
            if($row['estado'] != 1)                                            //V9
            {
                $this->_view->_error = 'Este usuario no esta habilitado';      //V9
                $this->_view->renderizar('index','login');                     //V9
                exit;                                                          //V9
            }
                    
            Session::set('autenticado', true);          //V7
            Session::set('level', $row['role']);        //V9 
            Session::set('usuario', $row['usuario']);   //V9
            Session::set('id_usuario', $row['id']);     //V9
            Session::set('tiempo', time());             //V8
            print_r($_SESSION);                         //V9
            
            $this->redireccionar();                     //V9
            
        }
        
        $this->_view->renderizar('index','login');      //V9
    
    }  
    
    public function mostrar()                            //V7
    {
        //Para hacer pruebas
        echo 'level: ' . Session::get('level').'<br>';   //V7
        echo 'var1: ' . Session::get('var1').'<br>';     //V7
        echo 'var2: ' . Session::get('var2').'<br>';     //V7
        echo 'autenticado: ' . Session::get('autenticado').'<br>';     //V9
    }
    
    
    public function cerrar()                             //V7
    {
        //Session::destroy();                              //V7
        //Session::destroy(array('var1','var2'));          //V7
        //Session::destroy('var1');                        //V7
        Session::destroy();                              //V7
        //$this->redireccionar('login/mostrar');           //V7
        $this->redireccionar();                          //V9
    }
    
}

?>