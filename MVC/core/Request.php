<?php 

namespace Core;
use Core\DB;
class Request{

    private $inputs = [];

    public function __construct()
    {
        $this->inputs();
    }


    public static function url($url=''){
        if($url!=''){
            return $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']."/".$url;
        }
        return $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME'];
    }


    public static function getMethod(){
        return $_SERVER['REQUEST_METHOD'];
    }



    // check if method post
    public function post(){
        if(self::getMethod() == 'POST'){
            return true;
        }
        return false;
    }


    public  function get(){
        if(self::getMethod() == 'GET'){
            return true;
        }
        return false;
    }

    public  function inputs(){
        if(self::getMethod() == 'GET'){
            foreach($_GET as $name => $value){
                $this->inputs[$name] = $this->santize($value);
            }
        }
        elseif(self::getMethod() == 'POST'){
            foreach($_POST as $name => $value){
                $this->inputs[$name] = $this->santize($value);
            }
        }
        return $this->inputs;
    }


    // get input 
    public function input($name){
        if(array_key_exists($name,$this->inputs)){
            return $this->inputs[$name];
        }
        return null;
    }

    // sinitize input before use 
    public  function santize($input){
        $input = trim(htmlspecialchars(htmlentities($input)));
        return $input;
    }


    public static function vd($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}

