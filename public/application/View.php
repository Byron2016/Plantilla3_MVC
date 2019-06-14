<?php 

//V3
  
class View  //V3
{
	private $controlador; //V3

 	public function __construct(Request $peticion)         //V3
	{
		$this->_controlador = $peticion->getControlador(); //V3
 	}
    public function renderizar($vista, $item = false)      //V3
    {
        $rutaView = ROOT . 'views' . DS . $this->_controlador . DS . $vista . '.phtml'; //V3
        require_once APP_PATH . 'Menu.php';                                      //V3

        $_layoutParams = array(                                                  //V3
            'ruta_css' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/css/', //V3
            'ruta_img' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/img/', //V3
            'ruta_js' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/js/',   //V3
            'menu' => $menu                                                      //V3

        );

        if(is_readable($rutaView)){                        //V3
            include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'header.php'; //V3
            include_once $rutaView;                        //V3
            include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'footer.php'; //V3
            
        } else {
            throw new Exception ('Error application View,renderizar: Error de vista'); //V3
        }
    }
 }

 ?>
