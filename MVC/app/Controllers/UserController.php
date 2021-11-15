<?php 

namespace App\Controllers;
use Core\DB;
use Core\Request;
use Core\Session;
use Core\Response;
use App\Controller;
use Core\Validation;

class UserController extends Controller{

    private $db;

    public function __construct()
    {
        if(!\Core\Auth::check()){
            Response::redirect('auth/login');
        }
        $this->db = new DB();
    }

    public function index(){
        $data = $this->db->table('users')->getAll();
        $this->view()->render('users/index',$data);
    }


    public function create(){
        $this->view()->render('users/add');
    }


    public function store(){
        $request = new Request();
        if($request->post()){
            $name = $request->input('name');
            $email = $request->input('email');
            $password = password_hash($request->input('password'),PASSWORD_DEFAULT);
            $validation = new Validation($request->inputs());
            $validation->check([
                'name'=>'required|min:3',
                'email'=>'required|email',
                'password'=>'required|min:6|max:20'
            ]);
          
            if(!$validation->getErrors()){

                $insert = $this->db->table('users')->insert([
                    'user_name'=>$name,
                    'user_email'=>$email,
                    'user_password'=>$password,
                    ])->save();
                if($insert){
                    Session::success("data inserted successfully");
                    return Response::redirect('user/index');
                }else{
                    echo $this->db->queryError();
                }

            }else{
                Session::set('errors',$validation->getErrors());
                return Response::redirect('user/create');
            }
            
        }
    }


    public function show($id){
        $this->view()->render('users/show');
    }


    public function edit($id){
        $row = $this->db->table('users')->where('cat_id','=',$id)->getRow();
        $this->view()->render('users/edit',$row);
    }

    public function update($id){
        $request = new Request();
        if($request->post()){
            $name = $request->input('name');
            $validation = new Validation($request->inputs());
            $validation->check(['name'=>'required|min:3']);
          
            if(!$validation->getErrors()){

                $update = $this->db->table('users')
                ->where('cat_id','=',$id)->update(['cat_name'=>$name])->save();
                if($update){
                    Session::success("data updated successfully");
                    return Response::redirect('user/index');
                }else{
                    if(!$this->db->queryError()){
                        Session::success("data updated successfully");
                        return Response::redirect('user/index');
                    }
                }

            }
            
        }
    }

    public function delete($id){
        $delete = $this->db->table('users')->delete($id,'cat_id');
        if($delete){
            Session::success("data deleted successfully");
            return Response::redirect('user/index');
        }else{
            dd($this->db->queryError());
        }
    }



    public function logout(){
        echo __METHOD__;
    }


}