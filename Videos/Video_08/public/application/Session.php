<?php

//V7 - V8

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

        Session::tiempo();                                        //V8
        
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

    public static function accesoEstricto(array $level, $noAdmin = FALSE) //V8
    {
        if(!Session::get('autenticado')){                                 //V8
            header('location:' . BASE_URL . 'error/access/5050');         //V8
            exit;                                                         //V8
        }
        Session::tiempo();                             //V8
     
        if($noAdmin == false){                                            //V8
            if(Session::get('level') == 'admin'){                         //V8
                return;                                                   //V8
            }
        }
        
        if(count($level)){                                                //V8
            if(in_array(Session::get('level'), $level)){                  //V8
                return;                                                   //V8
            }
        }
        
        header('location:' . BASE_URL . 'error/access/5050');             //V8
        
    }

    public static function accesoViewEstricto(array $level, $noAdmin = FALSE) //V8
    {
        if(!Session::get('autenticado')){                                     //V8
            return false;                                                     //V8
        }
        
        if($noAdmin == false){                                                //V8
            if(Session::get('level') == 'admin'){                             //V8
                return true;                                                  //V8
            }
        }
        
        if(count($level)){                                                    //V8
            if(in_array(Session::get('level'), $level)){                      //V8
                return true;                                                  //V8
            }
        }
        
        return false;                                                         //V8
    }

    public static function tiempo()                                  //V8
    {
        if((!Session::get('tiempo')) || (!defined('SESSION_TIME'))){ //V8
            throw new Exception('Error Session/Tiempo: No se ha definido el timpo de sesion');                                                   //V8
        }
        if(SESSION_TIME == 0){                                       //V8
            //tiempo de session indefinido
            return;                                                  //V8
        }
        
        if((time() - Session::get('tiempo')) > (SESSION_TIME * 60)){ //V8
            Session::destroy();                                      //V8
            header('location:' . BASE_URL . 'error/access/8080');    //V8
        }
        else{                                                        //V8
            Session::set('tiempo', time());                          //V8 //reinicia tiempo de sesion y coloca el tiempo actual
        }
    }
 
    
}