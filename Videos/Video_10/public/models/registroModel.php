<?php

//V10 - V11

class registroModel extends Model                                   //V10
{
     public function __construc()                                   //V10
    {
    	parent::__construc();                                       //V10
    }
    public function verificarUsuario($usuario)                      //V10
    {
		//si usuario ya existe en base de datos no deja que se vuelva a registrar //V10
    	$id = $this->_db->query(                                    //V10
    			"select id from usuarios where usuario = '$usuario'"//V10
    		);                                                      //V10
    	if ($id->fetch())                                           //V10
    	{
    		return true;                                            //V10
    	}
    	return false;                                               //V10
	}
	
    public function verificarEmail($email)                          //V10
    {
    	$id = $this->_db->query(                                    //V10
    			"select id from usuarios where email = '$email'"    //V10
    		);
    	if ($id->fetch())                                           //V10
    	{
    		return true;                                            //V10
    	}
    	return false;                                               //V10
	}
	
    public function registrarUsuario($nombre, $usuario, $password, $email)   //V10
    {
        $random = rand(1782598471, 9999999999);                              //V11
    	$this->_db->prepare(                                                 //V10
    			"insert into usuarios values" .                              //V10
    			//"(null, :nombre, :usuario, :pass, :email,'" .  ROLL_DEFECTO . "', " . ESTADO_DEFECTO . ",now())"                               //V10
                "(null, :nombre, :usuario, :pass, :email,'" .  ROLL_DEFECTO . "', " . ESTADO_DEFECTO . ",now()), :codigo"                               //V11
    			)                                                            //V10
    			->execute(array(                                             //V10
    				':nombre' => $nombre,                                    //V10
    				':usuario' => $usuario,                                  //V10
    				':pass' => Hash::getHash('sha1', $password, HASH_KEY),   //V10
    				//':email' => $email                                       //V10
                    ':codigo' => $random                                     //V11
    				));                                                      //V10
    }
}