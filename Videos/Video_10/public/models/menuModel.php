<?php

//V5

class menuModel extends Model                             //V5
{
    public function __construct() {                       //V5
        parent::__construct();                            //V5
    }
    

    public function getMenu()                             //V5
    {
        $menu = $this->_db->query("select * from menu where activo = TRUE");  //V5
        return $menu->fetchall();                         //V5
    }

    
 
}
?>