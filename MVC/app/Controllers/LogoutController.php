<?php 

namespace App\Controllers;

use Core\Request;
use Core\Session;
use Core\Response;
use App\Controller;
use Core\Validation;
use Core\DB;

class LogoutController extends Controller{


    private $db;

    public function __construct()
    {
        if(!\Core\Auth::check()){
            Response::redirect('auth/login');
        }
        $this->db = new DB();
    }

    public function index(){
        Session::destroy();
        Response::redirect('auth/login');
    }


    
}