<?php

//V5 - v9

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
        $ingresar = TRUE;                                                                               //V9
        $j = 0;                                                                                         //V9
        $menu_def =  array();                                                                           //V9
        for ($i = 0; $i < count($menu_aux); $i++) {                       //V5
            if (($menu_aux[$i]['id_negocio'] == "Login_Autenticado" 
                || $menu_aux[$i]['id_negocio'] == "Login_No_Autenticado") 
                && $ingresar) {                                                                         //V9
                if (Session::get('autenticado')) {                                                      //V9
                    if ($menu_aux[$i]['id_negocio'] == "Login_Autenticado" ) {                          //V9
                        $menu_def[$j]['id'] = $menu_aux[$i]['id_negocio'];                              //V9
                        $menu_def[$j]['titulo'] = $menu_aux[$i]['titulo'];                              //V9
                        $menu_def[$j]['enlace'] = BASE_URL . $menu_aux[$i]['enlace'];                   //V9
                        $menu_def[$j]['image'] = $menu_aux[$i]['image'];                                //V9
                        $menu_def[$j]['logeado'] = $menu_aux[$i]['logeado'];                            //V9
                        $ingresar = FALSE;                                                              //V9
                        $j++;                                                                           //V9
                    }                                                                                   //V9
                } else {                                                                                //V9
                    if ($menu_aux[$i]['id_negocio'] == "Login_No_Autenticado" ) {                       //V9
                        $menu_def[$j]['id'] = "Login_No_Autenticado";                                   //V9
                        $menu_def[$j]['titulo'] = $menu_aux[$i]['titulo'];                              //V9
                        $menu_def[$j]['enlace'] = BASE_URL . $menu_aux[$i]['enlace'];                   //V9
                        $menu_def[$j]['image'] = $menu_aux[$i]['image'];                                //V9
                        $menu_def[$j]['logeado'] = $menu_aux[$i]['logeado'];                            //V9
                        $ingresar = FALSE;                                                              //V9
                        $j++;                                                                           //V9
                    }                                                                                   //V9
                }                                                                                       //V9
            } else {                                                                                    //V9

                //$menu_aux[$i]['id'] = $menu_aux[$i]['id_negocio'];            //V5
                //$menu_aux[$i]['titulo'] = $menu_aux[$i]['titulo'];            //V5
                //$menu_aux[$i]['enlace'] = BASE_URL . $menu_aux[$i]['enlace']; //V5
                //$menu_aux[$i]['image'] = $menu_aux[$i]['image'];              //V5
                //$menu_aux[$i]['logeado'] = $menu_aux[$i]['logeado'];          //V5
                if ($menu_aux[$i]['id_negocio'] <> "Login_Autenticado" 
                    && $menu_aux[$i]['id_negocio'] <> "Login_No_Autenticado") {                         //V9
                    $menu_def[$j]['id'] = $menu_aux[$i]['id_negocio'];                                  //V9
                    $menu_def[$j]['titulo'] = $menu_aux[$i]['titulo'];                                  //V9
                    $menu_def[$j]['enlace'] = BASE_URL . $menu_aux[$i]['enlace'];                       //V9
                    $menu_def[$j]['image'] = $menu_aux[$i]['image'];                                    //V9
                    $menu_def[$j]['logeado'] = $menu_aux[$i]['logeado'];                                //V9
                $j++;                                                                                   //V9   
                }                                                                                       //V9
            }                                                                                           //V9
        }                                                                                               //V9
        $this->_menu = $menu_def;                                                                       //V9
        return($this->_menu);                                                 //V5

    }


}

?>
