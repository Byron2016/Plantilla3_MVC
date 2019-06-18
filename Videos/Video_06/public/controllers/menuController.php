<?php

//V5

class menuController extends Controller                                   //V5
{
    private $_menu;                                                       //V5
    public function __construct(){                                        //V5
        parent::__construct();                                            //V5
        $this->_menu = $this->loadModel('menu');                          //V5
    }

    public function index() {}

    public function getMenu()                                             //V5
    {
        $menu = $this->loadModel('menu');                                 //V5
        $menu_aux = $menu->getMenu();                                     //V5
        for ($i = 0; $i < count($menu_aux); $i++) {                       //V5
            $menu_aux[$i]['id'] = $menu_aux[$i]['id_negocio'];            //V5
            $menu_aux[$i]['titulo'] = $menu_aux[$i]['titulo'];            //V5
            $menu_aux[$i]['enlace'] = BASE_URL . $menu_aux[$i]['enlace']; //V5
            $menu_aux[$i]['image'] = $menu_aux[$i]['image'];              //V5
            $menu_aux[$i]['logeado'] = $menu_aux[$i]['logeado'];          //V5
        }
        $this->_menu = $menu_aux;
        return($this->_menu);                                             //V5
    }


}

?>
