
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Category extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('model_category');
    }

    function index(){
        $datos['contenido'] = 'category/index';
        $this->load->view('plantilla',$datos);
    }

    public function listaCategory(){
        $result = $this->model_category->listaCategory();
        //print_r($result);exit;
		echo json_encode($result);
    }
    public function agregarCategory(){
		$result = $this->model_category->agregarCategory();
		$msg['success'] = false;
		$msg['type'] = 'add';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
    }
    public function listaCategoria2(){

        $categorias = $this->model_category->listaCategory();
        $data = array();

        foreach($categorias as $r) {

            $sub_array = array();
            $sub_array[] = $r->catid;
            $sub_array[] = $r->catname;
            $sub_array[] = $r->catdefinition;
            $sub_array[] = $r->catcreatedate ;
            $sub_array[] = $r->catupdatedate ;
            $sub_array[] = '<a href="javascript:;" title="Eliminar" 
                            class="item-delete" style="color:red;" 
                            data="'.$r->catid.'"><i class="fas fa-trash-alt"></i></a>
                            <a href="javascript:;" title="Editar" 
                            class="item-edit" style="color:green;" 
                            data="'.$r->catid.'"><i class="fas fa-edit"></i></a>';
            //$sub_array[] = '<button type="button" name="update" id="'.$r->catid.'" class="btn btn-warning btn-xs">Update</button> <button type="button" name="delete" id="'.$r->catid.'" class="btn btn-danger btn-xs">Delete</button>' ;
            $data[] = $sub_array;
            
       }
       //print_r($data);exit;
       $output = array(                          
              "data" => $data
         );
       echo json_encode($output);       
    }
    
    public function eliminarCategory(){
        $result = $this->model_category->eliminarCategory();
		$msg['success'] = false;
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
    }

    public function editarCategory(){
		$result = $this->model_category->editarCategory();
		echo json_encode($result);
	}

	public function actualizarCategory(){
		$result = $this->model_category->actualizarCategory();
		$msg['success'] = false;
		$msg['type'] = 'update';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}
    
}

