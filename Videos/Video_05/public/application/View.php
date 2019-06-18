<?php 

//V3 - V5
  
class View  //V3
{
	private $_controlador; //V3
    private $_js;          //V5
    private $_jsPublic;    //V5

 	public function __construct(Request $peticion)         //V3
	{
		$this->_controlador = $peticion->getControlador(); //V3
        $this->_js = array();                              //v5
        $this->_jsPublic = array();                        //v5
 	}
    public function renderizar($vista, $item = false)      //V3
    {
        $rutaView = ROOT . 'views' . DS . $this->_controlador . DS . $vista . '.phtml'; //V3
        //require_once APP_PATH . 'Menu.php'; 
        require_once ROOT . 'controllers' . DS . 'menuController' . '.php';      //V5
        $menu_n = new menuController;                                            //V5
        $menu = $menu_n->getMenu();                                              //V5

        $js = array();                                                           //V5
        $jsPublic = array();                                                     //V5
        if (count($this->_js)) {                                                 //V5
           $js = $this->_js;                                                     //V5
        }
        if (count($this->_jsPublic)) {                                           //V5
           $jsPublic = $this->_jsPublic;                                         //V5
        }
        $_layoutParams = array(                                                  //V3
            'ruta_css' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/css/', //V3
            'ruta_img' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/img/', //V3
            'ruta_js' => BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '/js/',   //V3
            'menu' => $menu,                                                     //V3
            'js' => $js,                                                         //V5
            'jsPublic' => $jsPublic                                              //V5
            
        );

        if(is_readable($rutaView)){                        //V3
            include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'header.php'; //V3
            include_once $rutaView;                        //V3
            include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'footer.php'; //V3
            
        } else {
            throw new Exception ('Error application View,renderizar: Error de vista'); //V3
        }
    }

    public function setJs(array $js)                                                                    //V5
    {
        //para enviar js que deseamos incluir en una vista
        if(is_array($js) && count($js))                                                                 //V5
        {
            for ($i=0; $i < count($js); $i++)                                                           //V5
            {
                $this->_js[] = BASE_URL . 'views/' . $this->_controlador . '/js/' .  $js[$i] . '.js';   //V5
                
            }
        } else{
            throw new Exception('Error application View: SetJS Error de js');                           //V5
        }
    }

    public function setJsPublic(array $js)                                                              //V5
    {
        //para enviar js que deseamos incluir en una vista
        if(is_array($js) && count($js))                                                                 //V5
        {
            for ($i=0; $i < count($js); $i++)                                                           //V5
            {
                $this->_js[] = BASE_URL . 'public/' .  'js/' .  $js[$i] . '.js';                        //V5
                
            }
        } else{
            throw new Exception('Error application View: setJsPublic Error de js');                     //V5
        }
    }



 }

 ?>
