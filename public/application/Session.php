<?php

//V7

class Session                                                //V7
{
    public static function init()                            //V7
    {
        session_start();                                     //V7
    }
    
    public static function destroy($clave = FALSE)           //V7
    {
        if ($clave)                                          //V7
        {
            if (is_array($clave)) {                          //V7
                for ($i=0; $i < count($clave); $i++) {       //V7
                    if (isset($_SESSION[$clave[$i]])) {      //V7
                        unset($_SESSION[$clave[$i]]);        //V7
                    }                                        //V7
                }                                            //V7
            }                                                //V7
            else                                             //V7
            {
                if (isset($_SESSION[$clave])) {              //V7
                    unset($_SESSION[$clave]);                //V7
                }                                            //V7
            }                                                //V7
        }else{
            session_destroy();                               //V7
        }
    }
    public static function set($clave, $valor)               //V7
    {
        if (!empty($clave)) {                                //V7
            $_SESSION[$clave] = $valor;                      //V7
        }
        
    }
    public static function get($clave)                       //V7
    {
        if (isset($_SESSION[$clave])) {                      //V7
            return $_SESSION[$clave];                        //V7
        }
    }

    public static function acceso($level)                         //V7
    {
        if(!Session::get('autenticado')){                         //V7
            header('location:' . BASE_URL . 'error/access/5050'); //V7
            exit;                                                 //V7
        }                                                         //V7
        
        if(Session::getLevel($level) > Session::getLevel(Session::get('level'))){ //V7
            header('location:' . BASE_URL . 'error/access/5050');                 //V7
            exit;                                                                 //V7
        }                                                          //V7
    }

    public static function accesoView($level) //V7
    {
        if(!Session::get('autenticado')){     //V7
            return FALSE;                     //V7
        }
        if(Session::getLevel($level) > Session::getLevel(Session::get('level'))){ //V7 
            return FALSE;                     //V7
        }
        
        return true;                          //V7
    }

    public static function getLevel($level)                              //V7
    {
        //diferentes niveles de acceso en aplicación
        $rol['admin'] = 3;                                               //V7
        $rol['especial'] = 2;                                            //V7
        $rol['usuario'] = 1;                                             //V7
        
        if(!array_key_exists($level, $rol)){                             //V7
            throw new Exception('Error de acceso en session.php funcion getLevel');                                              //V7
        }  else {                                                        //V7
            return $rol[$level];                                         //V7
        }
    }
 
    
}