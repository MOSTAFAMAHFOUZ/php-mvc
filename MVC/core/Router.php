<?php 

namespace Core;

use Exception;

class Router{

    private $url;
    private $controller = "HomeController";
    private $method = "index";
    private $params = [];

    public function route()
    { 
        $this->getUrl();
        $this->getController();
        $this->getMethod();
        $this->getParams();
        $this->dispatch();
    }

    // get url parameters and explode values
    public function getUrl(){
        $url = $_SERVER['REQUEST_URI'];
        $this->url = $this->indexValues($url);
    }


    // rearrenge data in array 
    public function indexValues($url){
        $url = explode('/',$url);
        unset($url[0]);
        if(end($url) == ""){
            array_pop($url);  
        }
        $url = array_values($url);
        return $url;
    }



    // check from controller
    public function getController(){

        if(isset($this->url[0])){
            $this->controller = ucwords($this->url[0])."Controller";
        }
        $controllerPath = __DIR__."/../app/Controllers/";
        if(file_exists($controllerPath.$this->controller.".php")){
            require_once($controllerPath.$this->controller.".php");
            $this->controller = "\\App\Controllers\\".$this->controller;
            if(class_exists($this->controller)){
                $this->unsetUrlElement();
                return true;
            }
            throw new Exception("controller {$this->controller} dose not exist ");
        }
        // fire exception
        throw new Exception("controller {$this->controller} dose not exist ");
    }


    // check from method
    public function getMethod(){
        if(isset($this->url[0])){
            $this->method = $this->url[0];
            if(method_exists($this->controller,$this->method)){

                $this->unsetUrlElement();
            }else{
                throw new Exception("Method {$this->method} not allawed ");
            }
        }else{
            $this->method = "index";
        }
        // arrange array
        $this->url = array_values($this->url);
    }

    public function unsetUrlElement(){
        unset($this->url[0]);
        $this->url = array_values($this->url);
    }


    // get all parameters in the url
    public function getParams(){
        if(count($this->url)){
            $this->params = $this->url;
        }
    }

    // fire controller and method
    public function dispatch(){
        call_user_func_array([new $this->controller,$this->method],$this->params);
    }
}

