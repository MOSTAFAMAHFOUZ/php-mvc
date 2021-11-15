<?php 

namespace App\Controllers;

use Core\Request;
use Core\Session;
use Core\Response;
use App\Controller;
use Core\Validation;
use Core\DB;

class AuthController extends Controller{


    private $db;

    public function __construct()
    {
        if(\Core\Auth::check()){
            Response::redirect('home/index');
        }
        $this->db = new DB();
    }


    public function login(){
        return $this->view()->render('auth/login');
    }


    public function logged(){
        $request = new Request();
        if($request->post()){
            $email = $request->input('email');
            $password = $request->input('password');
            $validation = new Validation($request->inputs());
            $validation->check([
                'email'=>'required|email',
                'password'=>'required'
            ]);
          
            if(!$validation->getErrors()){
                $check = $this->db->table('users')->where('user_email','=',$email)->getRow();
                if($check){
                    if(password_verify($password,$check->user_password)){
                        Session::set('user_auth',$check);
                        return Response::redirect('user/index');
                    }
                }
                Session::set('errors',['faild'=>'data not correct']);
                return Response::redirect('auth/login');

            }else{
                Session::set('errors',$validation->getErrors());
                return Response::redirect('auth/login');
            }
            
        }
    }



    
}