<?php 


namespace Core;
use Core\Session;

class Auth{
    
    public static function check(){
        if(Session::get('user_auth')){
            return true;
        }
        return false;
    }

    public static function user(){
        if(Session::get('user_auth')){
            return Session::get('user_auth');
        }
        return false;
    }

}