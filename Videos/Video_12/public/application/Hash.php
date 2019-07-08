<?php

//V10

class Hash                                                   //V10
{
    public static function getHash($algoritmo, $data, $key)  //V10
    {
        $hash = hash_init($algoritmo, HASH_HMAC, $key);      //V10
        hash_update($hash, $data);                           //V10
        return hash_final($hash);                            //V10
    }
}

 ?>