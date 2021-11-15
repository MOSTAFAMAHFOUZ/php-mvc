<?php 

namespace Core;

use Exception;

class View{

    public $main;
    public $content;


    public  function render($view,$data=[]){
        $this->main = $this->main();
        $this->content = $this->content($view,$data);
        $allContent = str_replace("{{content}}",$this->content,$this->main);
        echo $allContent;
    }

    public function main(){
        ob_start();
        require_once "../resources/views/main.php";
        return  ob_get_clean();
    }

    public  function content($view,$data=[]){
        if(!file_exists(BASE_PATH."/resources/views/".$view.".php")){
            throw new Exception("this view " . $view . " not exist");
        }
        ob_start();
        require_once '../resources/views/'.$view.".php";
        return ob_get_clean();
    }


}