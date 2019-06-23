<?php

//V9 - V10

class loginModel extends Model                            //V9
{
    public function __construct() {                       //V9
        parent::__construct();                            //V9
    }
    
    public function getUsuario($usuario, $password){      //V9
        /*
        $datos = $this->_db->query(                       //V9
            "select * from usuarios " .                   //V9
            "where usuario = '$usuario' " .               //V9
            "and pass = '" . md5($password) . "'"         //V9
            );                                            //V9
        */
        
        $datos = $this->_db->query(                                              //V10
                "select * from usuarios " .                                      //V10
                "where usuario = '$usuario' " .                                  //V10
                "and pass = '" . Hash::getHash('sha1',$password,HASH_KEY) . "'"  //V10
                );                                                               //V10

        return $datos->fetch();                           //V9
    }
    
    
}
?>