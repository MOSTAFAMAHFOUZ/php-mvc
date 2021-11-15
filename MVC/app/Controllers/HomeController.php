<?php 

namespace App\Controllers;

use Core\Request;
use Core\Response;
use App\Controller;

class HomeController extends Controller{

    public function index(){
        if(!\Core\Auth::check()){
            Response::redirect('auth/login');
        }
        $this->view()->render('index');
    }
}