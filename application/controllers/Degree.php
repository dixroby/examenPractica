
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Degree extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('model_degree');
    }

    function index(){
        $datos['contenido'] = 'degree/index';
        $this->load->view('plantilla',$datos);
    }

    public function listaDegree(){
        $result = $this->model_degree->listaDegree();
        //print_r($result);exit;
		echo json_encode($result);
    }
    public function agregarDegree(){
		$result = $this->model_degree->agregarDegree();
		$msg['success'] = false;
		$msg['type'] = 'add';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
    }
    public function listaCategoria2(){

        $categorias = $this->model_degree->listaDegree();
        $data = array();

        foreach($categorias as $r) {

            $sub_array = array();
            $sub_array[] = $r->degid;
            $sub_array[] = $r->degname;
            $sub_array[] = $r->degcreatedate;
            $sub_array[] = $r->degupdatedate;
            $sub_array[] = '<a href="javascript:;" title="Eliminar" 
                            class="item-delete" style="color:red;" 
                            data="'.$r->degid.'"><i class="fas fa-trash-alt"></i></a>
                            <a href="javascript:;" title="Editar" 
                            class="item-edit" style="color:green;" 
                            data="'.$r->degid.'"><i class="fas fa-edit"></i></a>';
            //$sub_array[] = '<button type="button" name="update" id="'.$r->catid.'" class="btn btn-warning btn-xs">Update</button> <button type="button" name="delete" id="'.$r->catid.'" class="btn btn-danger btn-xs">Delete</button>' ;
            $data[] = $sub_array;
            
       }
       //print_r($data);exit;
       $output = array(                          
              "data" => $data
         );
       echo json_encode($output);       
    }
    
    public function eliminarDegree(){
        $result = $this->model_degree->eliminarDegree();
		$msg['success'] = false;
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
    }

    public function editarDegree(){
		$result = $this->model_degree->editarDegree();
		echo json_encode($result);
	}

	public function actualizarDegree(){
		$result = $this->model_degree->actualizarDegree();
		$msg['success'] = false;
		$msg['type'] = 'update';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}
    
}

