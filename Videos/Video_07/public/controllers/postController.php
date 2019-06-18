<?php
//V5 - V6 - V7

class postController extends Controller //V5
{
    private $_post;                                   //V5 //esta variable usaremos para instanciar el modelo
    public function __construct(){                    //V5
        parent::__construct();                        //V5
        $this->_post = $this->loadModel('post');      //V5
    }
    public function index() //V5
    {
        $this->_view->posts = $this->_post->getPosts();                    //V5
        $this->_view->titulo = 'Post';                                     //V5
        $this->_view->renderizar('index', 'post');                         //V5
    }

    public function nuevo()                                                 //V5
    {
        //Session::acceso('especial');                                        //V7
        //Session::acceso('usuario');                                         //V7
        Session::acceso('especial');                                        //V7

        $this->_view->titulo = 'Nuevo post';                                //V5
        $this->_view->setJs(array('nuevo'));                                //V5
        $this->_view->setJsPublic(array('jquery.validate'));                //V5
        //$this->_view->prueba = $this->getTexto('titulo');                   //V5
        if($this->getInt('guardar') == 1){
            $this->_view->datos = $_POST; //para que se quede lleno. No deberia hacerse así sino hacer funcion que retorne parámetros post. V5 33:21
            
            if(!$this->getTexto('titulo')){                                  //V5
                $this->_view->_error = 'Debe introducir el titulo del post'; //V5
                $this->_view->renderizar('nuevo', 'post');                   //V5
                exit;
            }
            
            if(!$this->getTexto('cuerpo')){                                  //V5
                $this->_view->_error = 'Debe introducir el cuerpo del post'; //V5
                $this->_view->renderizar('nuevo', 'post');                   //V5
                exit;
            }
            /*
            $this->_post->insertarPost(                                      //V5
                    $this->getTexto('titulo'),                               //V5
                    $this->getTexto('cuerpo')                                //V5
                    );
            Se cambia en V6
            */

            $this->_post->insertarPost(                                      //V6
                    $this->getPostParam('titulo'),                           //V6
                    $this->getPostParam('cuerpo')                            //V6
                    );

            $this->redireccionar('post');
        }  
        $this->_view->renderizar('nuevo', 'post'); //V5
    }


    public function editar($id)                                 //V6
    {

        if(!$this->filtrarInt($id)){                            //V6
            $this->redireccionar('post');                       //V6
        }
        //si no existe el post redireccionar.
        if(!$this->_post->getPost($this->filtrarInt($id))){     //V6
            $this->redireccionar('post');                       //V6
        }
        
        $this->_view->titulo = 'Editar Post';                   //V6
        $this->_view->setJs(array('nuevo'));
        $this->_view->setJsPublic(array('jquery.validate'));    //V6
        //si se envio parametro guardar quiere decir que epresione sublim.
        if($this->getInt('guardar') == 1){
            $this->_view->datos = $_POST;                       //V6
            
            if(!$this->getTexto('titulo')){                     //V6
                $this->_view->_error = 'Debe introducir el titulo del post';//V6
                $this->_view->renderizar('editar', 'post');     //V6
                exit;                                           //V6
            }
            
            if(!$this->getTexto('cuerpo')){
                $this->_view->_error = 'Debe introducir el cuerpo del post';//v6
                $this->_view->renderizar('editar', 'post');    //V6
                exit;                                          //V6
            }
            
            $this->_post->editarPost(                          //V6
                    $this->filtrarInt($id),                    //V6
                    $this->getTexto('titulo'),                 //V6
                    $this->getTexto('cuerpo')                  //V6
                    );                                         //V6
            
            $this->redireccionar('post');                      //V6
        }
        
        $this->_view->datos = $this->_post->getPost($this->filtrarInt($id)); //V6 //los datos de la vista lo llenamos con el registro base datos 
        $this->_view->renderizar('editar', 'post');            //V6
    }

    public function eliminar($id)                              //V6
    {
        Session::acceso('admin');                              //V7
        if(!$this->filtrarInt($id)){                           //V6
            $this->redireccionar('post');                      //V6
        }
        
        if(!$this->_post->getPost($this->filtrarInt($id))){    //V6
            $this->redireccionar('post');                      //V6
        }
        
        $this->_post->eliminarPost($this->filtrarInt($id));    //V6
        $this->redireccionar('post');                          //V6
    }
  



}

?>
