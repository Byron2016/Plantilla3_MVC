<?php

//V10 - V11

use PHPMailer\PHPMailer\Exception;                                                //V11
use PHPMailer\PHPMailer\PHPMailer;                                                //V11

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

            $this->getLibrary('Exception','PHPMailer/src');                        //V11
			$this->getLibrary('PHPMailer','PHPMailer/src');                        //V11
			$this->getLibrary('SMTP','PHPMailer/src');                             //V11
			$mail = new PHPMailer(TRUE);                                           //V11
			//echo 'Antes de llamar registrar usuario';                              //V11

			$this->_registro->registrarUsuario(                                    //V10
					$this->getSql('nombre'),                                       //V10
					$this->getAlphaNum('usuario'),                                 //V10
					$this->getSql('pass'),                                         //V10
					$this->getPostParam('email')                                   //V10
					);                                                             //V10
			//echo 'Luego de llamar registrar usuario';                              //V11



			$usuario = $this->_registro->verificarUsuario($this->getAlphaNum('usuario')); //V11
			//vuelve a verificar si usaurio existe

			//if (!$this->_registro->verificarUsuario($this->getAlphaNum('usuario')))//V10
			//{
			//	$this->_view->_error = "registroControler: Error al registrar el usuario";//V10
			//	$this->_view->renderizar('index', 'registro');                     //V10
			//	exit;                                                              //V10
			//}

			if (!$usuario)                                                                 //V11 
			{
				$this->_view->_error = "registroControler: Error al registrar el usuario"; //V11
				$this->_view->renderizar('index', 'registro');                             //V11
				exit;                                                                      //V11
			}

			$mail->setLanguage('es');                                                      //V11
			$mail->From = 'yyyyyyyy@yahoo.com'; //$this->getPostParam('email')             //V11
			$mail->FromName = 'Administrador registro usuarios';                           //V11
			$mail->Subject = 'Activación de cuenta de usuario';                            //V11
			$mail->Body = 'Hola <strong>' . $this->getSql('nombre') . '<strong>' .         //V11
						'<p>Se ha registrado en nuevaplantilla201990612_mvc.net/ para activar ' .  //V11
						'su cuenta haga click sobre el siguiente enlace: <br> ' .          //V11
						'<a href="' . BASE_URL . 'registro/activar/' .                     //V11
						$usuario['id'] . '/' . $usuario['codigo'] . '">' .                 //V11
						BASE_URL . 'registro/activar/' .                                   //V11
						$usuario['id'] . '/' . $usuario['codigo'] . '</a>';                //V11
			

			$mail->AltBody = 'Su servidor de correo no soporta html';                      //V11
			$mail->AddAddress($this->getPostParam('email'));                               //V11
			$mail->Send();                                                                 //V11

			$this->_view->datos = false;                                           //V10//para q luego q el usuario se registre los campos se pongan vacios
			//$this->_view->_mensaje = "Registro Completado";                        //V10
			$this->_view->_mensaje = "Registro Completado, revice su email para activar su cuenta. ";                        //V11
		}
		$this->_view->renderizar('index', 'Registro');                             //V10
	}

	public function activar($id, $codigo)                                         //V11
	{
		try {                                                                     //V11
		//echo '<br> Dentro de registroController activar ID: ' . $id .' MODELO ' . $codigo . '<br>';
		if(!$this->filtrarInt($id) || !$this->filtrarInt($codigo)){               //V11
			$this->_view->_error = 'Esta cuenta no existe';                       //V11
			$this->_view->renderizar('activar', 'registro');                      //V11
			exit;                                                                 //V11
 		}

 		$row = $this->_registro->getUsuario(                                      //V11
					  $this->filtrarInt($id),                                     //V11
					  $this->filtrarInt($codigo)                                  //V11
		              );

		if(!$row ){                                                               //V11
			//usuario existe
			$this->_view->_error = 'Esta cuenta no existe';                       //V11
			$this->_view->renderizar('activar', 'registro');                      //V11
			exit;                                                                 //V11
		}
 		if($row['estado'] == 1 ){                                                 //V11
			//usuario existe
			$this->_view->_error = 'Esta cuenta ya ha sido activada';             //V11
			$this->_view->renderizar('activar', 'registro');                      //V11
			exit;                                                                 //V11
		}
		//echo '<br> ANTES DE LLAMAR activarUsuario <br>';
		$this->_registro->activarUsuario(                                         //V11
			$this->filtrarInt($id),                                               //V11
			$this->filtrarInt($codigo)                                            //V11
			);                                                                    //V11

 		$row = $this->_registro->getUsuario(                                      //V11
				$this->filtrarInt($id),                                           //V11
				$this->filtrarInt($codigo)                                        //V11
				);                                                                //V11

 		if($row['estado'] == 0){                                                  //V11
			//
 			$this->_view->_error = 'Error al activar la cuenta, por favor intente más tarde'; //V11
			$this->_view->renderizar('activar', 'registro');                      //V11
			exit;                                                                 //V11
			}                                                                     //V11

 		$this->_view->_mensaje = "Registro Completado, su cuenta ha sido activada"; //V11
 
		$this->_view->renderizar('activar', 'Registro');                           //V11
		}  catch(Exception $e) {                                                   //V11
			echo $e->getMessage();                                                 //V11
		}
 	}
}