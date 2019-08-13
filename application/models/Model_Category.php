<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Category extends CI_Model{
    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function listaCategory(){

        $query = $this->db->query(" SELECT * FROM category ");
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	public function agregarCategory(){
		$campos = array(
			'catname'=>$this->input->post('txtnombre'),
			'catdefinition'=>$this->input->post('txtdescripcion'),
            'catcreatedate'=>date('Y-m-d H:i:s'),
            'catupdatedate' =>date('Y-m-d H:i:s')
			);
		$this->db->insert('Category', $campos);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	function eliminarCategory(){
		$id = $this->input->get('catid');
		$this->db->where('catid', $id);
		$this->db->delete('category');
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function editarCategory(){
		$id = $this->input->get('id');
		$this->db->where('catid', $id);
		$query = $this->db->get('category');
		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return false;
		}
	}

	public function actualizarCategory(){
		$id = $this->input->post('txtId');
		$field = array(
		'catname'=>$this->input->post('txtnombre'),
		'catdefinition'=>$this->input->post('txtdescripcion'),
		'catupdatedate'=>date('Y-m-d H:i:s')
		);
		$this->db->where('catid', $id);
		$this->db->update('category', $field);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
}