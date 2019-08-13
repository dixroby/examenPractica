
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('model_user');
    }

    function index(){
        $datos['contenido'] = 'user/index';
        $this->load->view('plantilla',$datos);
    }

    public function listaUser(){
        $result = $this->model_user->listaUser();
        //print_r($result);exit;
		echo json_encode($result);
    }
    public function agregarUser(){
		$result = $this->model_user->agregarUser();
		$msg['success'] = false;
		$msg['type'] = 'add';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
    }
    public function listaUser2(){

        $categorias = $this->model_user->listaUser();
        $data = array();

        foreach($categorias as $r) {

            $sub_array = array();
            $sub_array[] = $r->firstname;
            $sub_array[] = $r->lastname;
            $sub_array[] = $r->email;
            $sub_array[] = $r->password;
            $sub_array[] = $r->perfilId;
            $sub_array[] = '<a href="javascript:;" title="Eliminar" 
                            class="item-delete" style="color:red;" 
                            data="'.$r->userId.'"><i class="fas fa-trash-alt"></i></a>
                            <a href="javascript:;" title="Editar" 
                            class="item-edit" style="color:green;" 
                            data="'.$r->userId.'"><i class="fas fa-edit"></i></a>';
            //$sub_array[] = '<button type="button" name="update" id="'.$r->catid.'" class="btn btn-warning btn-xs">Update</button> <button type="button" name="delete" id="'.$r->catid.'" class="btn btn-danger btn-xs">Delete</button>' ;
            $data[] = $sub_array;
            
       }
       //print_r($data);exit;
       $output = array(                          
              "data" => $data
         );
       echo json_encode($output);       
    }
    
    public function eliminarUser(){
        $result = $this->model_user->eliminarCategoria();
		$msg['success'] = false;
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
    }

    public function editarUser(){
		$result = $this->model_user->editarcategoria();
		echo json_encode($result);
	}

	public function actualizarUser(){
		$result = $this->model_user->actualizarcategoria();
		$msg['success'] = false;
		$msg['type'] = 'update';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}
    
}

