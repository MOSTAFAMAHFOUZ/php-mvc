<?php 


namespace Core;

class App{

    private $router;
    
    
    public function resolve(){

        $this->router = new Router();
        $this->router->route();
    }

    
}