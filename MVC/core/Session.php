<?php 

namespace Core;

class Session{

    private static $s_status = false;

    // check if session is started or not 
    // if not started yet , generate new session 
    public static function checkSession(){

        if(!self::$s_status){
            if(session_status() === PHP_SESSION_ACTIVE){
                self::$s_status = true;
            }else{
                session_start();
                self::$s_status = true;
            }
        }
        
        return self::$s_status;

    }

    public static function all(){
        return $_SESSION;
    }


    // set new key and value in the session
    public static function set($key,$value){
        if(self::checkSession()){
            $_SESSION[$key] = $value;
        }
    }

    // get data about key from session
    public static function get($key){
        if(self::checkSession() && isset($_SESSION[$key])){
            return $_SESSION[$key];
        }
        return null;
    }

    public static function success($value){
        self::set('success',$value);
    }

    public static function flash($key){
        $val = self::get($key);
        self::unsetSession($key);
        return $val;
    }



    // delete specific key from sessions
    public static function unsetSession($key){
        if(self::checkSession() && isset($_SESSION[$key])){
            unset($_SESSION[$key]);
        }
    }


    // delete all session 
    public static function unsetAll(){
        if(self::checkSession()){
            unset($_SESSION);
        }
    }



    public static function destroy(){
        session_destroy();
        session_unset();
        unset($_SESSION);
    }


    public static function getId()
    {
        if(self::checkSession()){
            return session_id();
        }
        return null;
    }

}

