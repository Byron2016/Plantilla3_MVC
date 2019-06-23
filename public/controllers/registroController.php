<?php

//V10

class registroController extends Controller                                       //V10
{
	private $_registro;                                                           //V10
	public function __construct()                                                 //V10
	{
		parent::__construct();                                                    //V10
		$this->_registro = $this->loadModel('registro');                          //V10
	}
	public function index()                                                       //V10
	{
        //autentificación del usuario
		if (Session::get('autenticado')) {                                        //V10
			//si esta logueado no puede entrar debe cerrar sesion primero         //V10
			$this->redireccionar();                                               //V10
		}
		$this->_view->titulo = 'Registro';                                        //V10
		
		if ($this->getInt('enviar') == 1)                                         //V10 
		{
            $this->_view->datos = $_POST;                                         //V10

			if (!$this->getSql('nombre'))                                         //V10
			{
				$this->_view->_error = "Debe introducir su nombre";               //V10
				$this->_view->renderizar('index', 'registro');                    //V10
				exit;                                                             //V10
            }

			if (!$this->getAlphaNum('usuario'))                                   //V10 
			{
				$this->_view->_error = "Debe introducir su nombre de usuario";    //V10
				$this->_view->renderizar('index', 'registro');                    //V10
				exit;                                                             //V10
            }

			if ($this->_registro->verificarUsuario($this->getAlphaNum('usuario'))) //V10
			{
				$this->_view->_error = "El usuario " . $this->getAlphaNum('usuario') . " ya existe";  //V10
				$this->_view->renderizar('index', 'registro');                     //V10
				exit;                                                              //V10
            }

			if (!$this->validarEmail($this->getPostParam('email')))                //V10 
			{
				$this->_view->_error = "La direccion de email es inv&aacute;ida";  //V10
				$this->_view->renderizar('index', 'registro');                     //V10
				exit;                                                              //V10
            }

			if ($this->_registro->verificarEmail($this->getPostParam('email')))    //V10
			{
				$this->_view->_error = "Esta direccion de correo ya esta registrada";//V10
				$this->_view->renderizar('index', 'registro');                     //V10
				exit;                                                              //V10
            }

			if (!$this->getSql('pass'))                                            //V10
			{
				$this->_view->_error = "Debe introducir un password";              //V10
				$this->_view->renderizar('index', 'registro');                     //V10
				exit;                                                              //V10
            }

			if ($this->getPostParam('pass') != $this->getPostParam('confirmar'))   //V10
			{
				$this->_view->_error = "Los passwords no coinciden";               //V10
				$this->_view->renderizar('index', 'registro');                     //V10
				exit;                                                              //V10
            }

			$this->_registro->registrarUsuario(                                    //V10
					$this->getSql('nombre'),                                       //V10
					$this->getAlphaNum('usuario'),                                 //V10
					$this->getSql('pass'),                                         //V10
					$this->getPostParam('email')                                   //V10
					);                                                             //V10
			//vuelve a verificar si usaurio existe

			if (!$this->_registro->verificarUsuario($this->getAlphaNum('usuario')))//V10
			{
				$this->_view->_error = "registroControler: Error al registrar el usuario";//V10
				$this->_view->renderizar('index', 'registro');                     //V10
				exit;                                                              //V10
			}
			$this->_view->datos = false;                                           //V10//para q luego q el usuario se registre los campos se pongan vacios
			$this->_view->_mensaje = "Registro Completado";                        //V10
		}
		$this->_view->renderizar('index', 'Registro');                             //V10
	}
}