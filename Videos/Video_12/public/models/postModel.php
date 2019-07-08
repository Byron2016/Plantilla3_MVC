<?php

//V4 - V5 - V6 - V12

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

    public function getPost($id)                                         //V6
    {
        $id = (int) $id;                                                 //V6
        $post = $this->_db->query("select * from posts where id = $id"); //V6
        return $post->fetch();                                           //V6
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

    public function editarPost($id, $titulo, $cuerpo)                                             //V6
    {
        $id = (int) $id;                                                                          //V6
        
        $this->_db->prepare("UPDATE posts SET titulo = :titulo, cuerpo = :cuerpo WHERE id = :id") //V6
                ->execute(                                                                        //V6
                        array(                                                                    //V6
                           ':id' => $id,                                                          //V6
                           ':titulo' => $titulo,                                                  //V6
                           ':cuerpo' => $cuerpo                                                   //V6
                        ));                                                                       //V6
    }

    public function eliminarPost($id)                              //V6
    {
        $id = (int) $id;                                           //V6
        $this->_db->query("DELETE FROM posts WHERE id = $id");     //V6
    }

    public function insertarPrueba($nombre)                                               //V12
    {                                                                                     //V12
        $this->_db->prepare("INSERT INTO prueba VALUES (null, :nombre)")                  //V12
                ->execute(                                                                //V12
                        array(                                                            //V12
                           ':nombre' => $nombre                                           //V12
                        ));                                                               //V12
    }                                                                                     //V12

    public function getPrueba()                                                           //V12
    {                                                                                     //V12
        $post = $this->_db->query("select * from prueba");                                //V12
        return $post->fetchAll();                                                         //V12
    }                                                                                     //V12


 
}
?>