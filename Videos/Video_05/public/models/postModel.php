<?php

//V4 - V5

class postModel extends Model //V4
{
    public function __construct() {                       //V4
        parent::__construct();                            //V4
    }
    
    public function getPostsPrueba()                      //V4
    {
        //simula base de datos
        $post = array(                                    //V4
            'id' => 1,                                    //V4
            'titulo' => 'Titulo Post',                    //V4
            'cuerpo' => 'Cuerpo Post'                     //V4
        );
        return $post;                                     //V4
    }

    public function getPosts()                            //V4
    {
        $post = $this->_db->query("select * from posts"); //V4
        return $post->fetchall();                         //V4
    }

    public function insertarPost($titulo, $cuerpo)                                  //V5
    {
        $this->_db->prepare("INSERT INTO posts VALUES (null, :titulo, :cuerpo)")    //V5
                ->execute(                                                          //V5
                        array(                                                      //V5
                           ':titulo' => $titulo,                                    //V5
                           ':cuerpo' => $cuerpo                                     //V5
                        ));
    }

    
 
}
?>