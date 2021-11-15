<?php 

namespace Core;

class Response{

    public static function redirect($url=''){
        if($url == ''){
            header('location:'.url());
        }else{
            header('location:'.url()."/".$url);
        }
        exit;
    }

}

