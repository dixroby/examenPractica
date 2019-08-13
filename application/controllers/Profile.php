<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('model_profile');
    }

    function index(){
        $datos['contenido'] = 'profile/index';         
        $this->load->view('plantilla',$datos);
    }

    public function listaProfile(){
        $result = $this->model_profile->listaProfile();
        //print_r($result);exit;
        echo json_encode($result);
    }
    public function agregarProfile(){
        $result = $this->model_profile->agregarProfile();
        $msg['exitoso'] = false;
        $msg['type'] = 'add';
        if($result){
            $msg['exitoso'] = true;
        }
        echo json_encode($msg);
    }
    public function listaProfile2(){

        $profiles = $this->model_profile->listaProfile();
        $data = array();

        foreach($profiles as $r) {
            // el jsdatatable necesita que envies en uno solo lo que quieres que se muestre
            // es por ello de llevar los botones aqui
            $sub_array = array();
            $sub_array[] = $r-> proid;
            $sub_array[] = $r-> proname;
            $sub_array[] = $r-> prodescription ;
            $sub_array[] = $r-> procreatedate;
            $sub_array[] = $r-> proupdatedate;
            $sub_array[] = '<a href="javascript:;" title="Eliminar" 
                            class="item-delete" style="color:red;" 
                            data="'. $r -> proid.'"><i class="fas fa-trash-alt"></i></a>
                            <a href="javascript:;" title="Editar" 
                            class="item-edit" style="color:green;" 
                            data="'. $r -> proid.'"><i class="fas fa-edit"></i></a>';
            //$sub_array[] = '<button type="button" name="update" id="'.$r->catid.'" class="btn btn-warning btn-xs">Update</button> <button type="button" name="delete" id="'.$r->catid.'" class="btn btn-danger btn-xs">Delete</button>' ;
            $data[] = $sub_array;
            
       }
       //print_r($data);exit; 
       $output = array(                          
              "data" => $data
         );
       echo json_encode($output);       
    }
    
    public function eliminarProfile(){
        $result = $this->model_profile->eliminarProfile();
        $msg['exitoso'] = false; // esto viene del modelo 
        if($result){
            $msg['exitoso'] = true;
        }
        echo json_encode($msg);
    }

    public function editarProfile(){
        $result = $this->model_profile->editarProfile();
        echo json_encode($result); 
    }

    public function actualizarProfile(){
        $result = $this->model_profile->actualizarProfile();
        $msg['exitoso'] = false;
        $msg['type'] = 'update';
        if($result){
            $msg['exitoso'] = true;
        }
        echo json_encode($msg); // no se imprime, solo envia a javascript de formea oculta en formato json
    }

}