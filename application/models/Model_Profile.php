<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Profile extends CI_Model{
    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function listaProfile(){ 

        $query = $this->db->query(" SELECT * FROM profile ");		
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	public function agregarProfile(){
		$campos = array(			
			'proname'=>$this->input->post('txtnombre'),
            'prodescription'=>$this->input->post('txtdescripcion'),
            'procreatedate' =>date('Y-m-d H:i:s'),
            'proupdatedate' =>date('Y-m-d H:i:s')
			);
		$this->db->insert('profile', $campos);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	
	function eliminarProfile(){
		$id = $this->input->get('proid'); //viene de la vista
		$this->db->where('proid', $id);
		$this->db->delete('profile'); 
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function editarProfile(){
		$id = $this->input->post('id');
		$this->db->where('proid', $id);
		$query = $this->db->get('profile'); // esta retorna solo una fila, trabaja con la fila anterior
		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return false;
		}
	}

	public function actualizarProfile(){
		$id = $this->input->post('txtId');
		$field = array(
		'proname'=>$this->input->post('txtnombre'),
		'prodescription'=>$this->input->post('txtdescripcion'),
		'proupdatedate'=>date('Y-m-d H:i:s')
		);
		$this->db->where('proid', $id);
		$this->db->update('profile', $field);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	
}