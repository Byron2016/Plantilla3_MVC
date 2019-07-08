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
    			//"select id from usuarios where usuario = '$usuario'"//V10
                "select id, codigo from usuarios where usuario = '$usuario'" //V11
    		);                                                      //V10
    	//if ($id->fetch())                                           //V10
    	//{
    	//    return true;                                            //V10
    	//}
    	//return false;                                               //V10
        return $id->fetch();                                          //V11
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
        $random = rand(17825984, 99999999);                                //V11
        //echo "<br>";                                                           //V11
        //$sql = "insert into usuarios values" ;                                 //V11
        //$sql = $sql . "(null,";                                                //V11
        //$sql = $sql . "'$nombre',";                                            //V11
        //$sql = $sql . "'$usuario',";                                           //V11
        //$sql = $sql . "'" . Hash::getHash('sha1', $password, HASH_KEY) . "',"; //V11
        //$sql = $sql . "'$email','" .  ROLL_DEFECTO . "', " . ESTADO_DEFECTO ;  //V11
        //$sql = $sql . ",now(),$random";                                        //V11
        //echo $sql;                                                             //V11
        //echo "<br>";                                                           //V11
        //exit;                                                                  //V11
        
    	$this->_db->prepare(                                                 //V10
    			"insert into usuarios values" .                              //V10
    			//"(null, :nombre, :usuario, :pass, :email,'" .  ROLL_DEFECTO . "', " . ESTADO_DEFECTO . ",now())"                               //V10
                "(null, :nombre, :usuario, :pass, :email,'" .  ROLL_DEFECTO . "', " . ESTADO_DEFECTO . ",now(), :codigo)"                        //V11
    			)                                                            //V10
    			->execute(array(                                             //V10
    				':nombre' => $nombre,                                    //V10
    				':usuario' => $usuario,                                  //V10
    				':pass' => Hash::getHash('sha1', $password, HASH_KEY),   //V10
    				//':email' => $email                                       //V10
                    ':email' => $email,                                      //V11
                    ':codigo' => $random                                     //V11
    				));                                                      //V10
    }

    
    public function getUsuario($id, $codigo)                                     //V11
    {
        $usuario = $this->_db->query(                                            //V11
                "select * from usuarios where id = $id and codigo =  '$codigo'"  //V11
            );                                                                   //V11
        return $usuario->fetch();                                                //V11
    }
    
    public function activarUsuario($id, $codigo)                                 //V11
    {
        $usuario = $this->_db->query(                                            //V11
                "update usuarios set estado = 1 " .                              //V11
                "where id = $id and codigo =  '$codigo'"                         //V11
            );                                                                   //V11
    }
}