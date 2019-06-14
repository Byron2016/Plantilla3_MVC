<?php

//V4

class DataBase extends  PDO                                              //V4
{
	public function __construct()                                    //V4
	{
                $var = 'mysql:host=' . DB_HOST .                         //V4
                ';dbname=' . DB_NAME.                                    //V4
                ';port=' . DB_PORT.','.DB_USER.','. DB_PASS;             //V4
                //echo $var;
        
        parent::__construct(                                             //V4
                'mysql:host=' . DB_HOST .                                //V4
                ';dbname=' . DB_NAME.                                    //V4
                ';port=' . DB_PORT,                                      //V4
                DB_USER,                                                 //V4
                DB_PASS,                                                 //V4
                array(                                                   //V4
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . DB_CHAR   //V4
                ));
        
        }

} 