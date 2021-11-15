<?php 


if(!function_exists('url')){

    function url($url=''){
        return \Core\Request::url($url);
    }
}



//  sessions 
if(!function_exists('session')){

    function session($key){
        return \Core\Session::get($key);
    }
}

if(!function_exists('flash')){

    function flash($key){
        return \Core\Session::flash($key);
    }
}