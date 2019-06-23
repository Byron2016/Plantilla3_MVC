<?php 

//V2 - V3 - V4 - V5 - V6 - V9 - V10

abstract class Controller                     //V2
{
	protected $_view;                         //V3
	
	public function __construct()             //V3
	{		
		$this->_view = new View(new Request); //V3
    }	    

    abstract public function index();         //V2

    protected function loadModel($modelo)          //V4
    {
        $modelo = $modelo . 'Model';                                //V4
        $rutaModelo = ROOT . 'models' . DS . $modelo . '.php';      //V4

        if (is_readable($rutaModelo))                               //V4
        {
            require_once $rutaModelo;                               //V4
            $modelo = new $modelo;                                  //V4
            return $modelo;                                         //V4
        }
        else 
        {
            throw new Exception('Error en application Controler.loadModel: Error de modelo función LoadMOdel'); //V4
        
        }
    }

    protected function getLibrary($libreria,$dirInterno)                            //V4
    {
        $rutaLibreria = ROOT . 'libs' . DS . $dirInterno . DS . $libreria . '.php'; //V4
        
        if (is_readable($rutaLibreria))                                             //V4
        {
            require_once $rutaLibreria;                                             //V4
        }
        else 
        {
            throw new Exception('Error en application Controler.getLibrary: Error de libreria');//V4
        }
        
    }

    protected function getTexto($clave)                                           //V5
    {
        //para evitar sqlinjection
        //toma variable enviada por post, la filtra y la retorna
        if(isset($_POST[$clave]) && !empty($_POST[$clave]))                       //V5
        {
            $_POST[$clave] = htmlspecialchars($_POST[$clave], ENT_QUOTES);        //V5
            return $_POST[$clave];                                                //V5
        }
        
        return '';                                                                //V5
    }

    protected function getInt($clave)                                             //V5
    {
        //para evitar sqlinjection
        //toma variable enviada or post y la filtra y retoran entero
        if(isset($_POST[$clave]) && !empty($_POST[$clave]))                       //V5
        {
            $_POST[$clave] = filter_input(INPUT_POST, $clave, FILTER_VALIDATE_INT);//V5
            return $_POST[$clave];                                                //V5
        }
        
        return 0;                                                                 //V5
    }

    protected function redireccionar($ruta = FALSE)                               //V5
    {
        if($ruta)                                                                 //V5
        {
            header('location:' . BASE_URL . $ruta);                               //V5
            exit();                                                               //V5
        }
        else                                                                      //V5
        {
            header('location:' . BASE_URL);                                       //V5
            exit();                                                               //V5
        }
    }

    protected function filtrarInt($int)        //V6
    {
        //valida el int que llega por url.
        $int = (int) $int;                     //V6
        
        if(is_int($int)){                      //V6
            return $int;                       //V6
        }
        else{                                  //V6
            return 0;                          //V6
        }
    }

    protected function getPostParam($clave)    //V6
    {
        if(isset($_POST[$clave])){             //V6
            return $_POST[$clave];             //V6
        }
    } 

    protected function getSql($clave)                              //V9
    {
        //limpia los stringtags
        //sanitizar password
        if(isset($_POST[$clave]) && !empty($_POST[$clave])){       //V9
            $_POST[$clave] = strip_tags($_POST[$clave]);           //V9
            
            if(!get_magic_quotes_gpc()){                           //V9
                //$_POST[$clave] = mysql_escape_string($_POST[$clave]); //V9
                
            }
            return trim($_POST[$clave]);                           //V9
        }
    }
    
    protected function getAlphaNum($clave)                         //V9
    {
        //solo acepta 0 9 a z y andrescords.
        //sanitizar nombre usuario
        if(isset($_POST[$clave]) && !empty($_POST[$clave])){        //V9 
            $_POST[$clave] = (string) preg_replace('/[^A-Z0-9_]/i', '', $_POST[$clave]); //V9
            return trim($_POST[$clave]);                            //V9
        }
        
    }

    public function validarEmail($email)                //V10
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))  //V10
        {
                return FALSE;                           //V10
        }
        return true;                                   //V10
    }



}

?>