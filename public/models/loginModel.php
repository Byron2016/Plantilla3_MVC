<?php

//V9

class loginModel extends Model                            //V9
{
    public function __construct() {                       //V9
        parent::__construct();                            //V9
    }
    
    public function getUsuario($usuario, $password){      //V9
        //V9
        $datos = $this->_db->query(                       //V9
            "select * from usuarios " .                   //V9
            "where usuario = '$usuario' " .               //V9
            "and pass = '" . md5($password) . "'"         //V9
            );                                            //V9
        /*
        $datos = $this->_db->query(//V9
                "select * from usuarios " . //V9
                "where usuario = '$usuario' " .//V9
                "and pass = '" . Hash::getHash('md5',$password,HASH_KEY) . "'"//V9
                );//V9
        */
        return $datos->fetch();                           //V9
    }
    
    
}
?>