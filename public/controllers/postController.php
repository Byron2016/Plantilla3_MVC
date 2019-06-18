<?php
//V5

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
            
            $this->_post->insertarPost(                                      //V5
                    $this->getTexto('titulo'),                               //V5
                    $this->getTexto('cuerpo')                                //V5
                    );

            $this->redireccionar('post');
        }  
        $this->_view->renderizar('nuevo', 'post'); //V5
    }
}

?>
