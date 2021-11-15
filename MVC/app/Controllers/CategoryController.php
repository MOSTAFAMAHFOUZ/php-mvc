<?php 

namespace App\Controllers;
use Core\DB;
use Core\View;
use Core\Request;
use Core\Session;
use Core\Response;
use App\Controller;
use Core\Validation;
use Exception;

class CategoryController extends Controller{

    private $db;

    public function __construct()
    {
        if(!\Core\Auth::check()){
            Response::redirect('auth/login');
        }
        $this->db = new DB();
    }

    public function index(){
        $data = $this->db->table('categories')->getAll();
        $this->view()->render('categories/index',$data);
    }


    public function create(){
        $this->view()->render('categories/add');
    }


    public function store(){
        $request = new Request();
        if($request->post()){
            $name = $request->input('name');
            $validation = new Validation($request->inputs());
            $validation->check(['name'=>'required|min:3']);
          
            if(!$validation->getErrors()){

                $insert = $this->db->table('categories')->insert(['cat_name'=>$name])->save();
                if($insert){
                    Session::success("data inserted successfully");
                    return Response::redirect('category/index');
                }else{
                    echo $this->db->queryError();
                }

            }
            
        }
    }


    public function show($id){
        $this->view()->render('categories/show');
    }


    public function edit($id){
        $row = $this->db->table('categories')->where('cat_id','=',$id)->getRow();
        $this->view()->render('categories/edit',$row);
    }

    public function update($id){
        $request = new Request();
        if($request->post()){
            $name = $request->input('name');
            $validation = new Validation($request->inputs());
            $validation->check(['name'=>'required|min:3']);
          
            if(!$validation->getErrors()){

                $update = $this->db->table('categories')
                ->where('cat_id','=',$id)->update(['cat_name'=>$name])->save();
                if($update){
                    Session::success("data updated successfully");
                    return Response::redirect('category/index');
                }else{
                    if(!$this->db->queryError()){
                        Session::success("data updated successfully");
                        return Response::redirect('category/index');
                    }
                }

            }
            
        }
    }

    public function delete($id){
        $delete = $this->db->table('categories')->delete($id,'cat_id');
        if($delete){
            Session::success("data deleted successfully");
            return Response::redirect('category/index');
        }else{
            dd($this->db->queryError());
        }
    }
}