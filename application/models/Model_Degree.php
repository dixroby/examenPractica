<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Degree extends CI_Model{
    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function listaDegree(){

        $query = $this->db->query(" SELECT * FROM Degree ");
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	public function agregarDegree(){
		$campos = array(
			'degname'=>$this->input->post('txtnombre'),
            'degcreatedate'=>date('Y-m-d H:i:s'),
            'degupdatedate' =>date('Y-m-d H:i:s')
			);
		$this->db->insert('degree', $campos);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	function eliminarDegree(){
		$id = $this->input->get('degid');
		$this->db->where('degid', $id);
		$this->db->delete('degree');
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function editarDegree(){
		$id = $this->input->get('id');
		$this->db->where('degid', $id);
		$query = $this->db->get('degree');
		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return false;
		}
	}

	public function actualizarDegree(){
		$id = $this->input->post('txtId');
		$field = array(
		'degname'=>$this->input->post('txtnombre'),
        'degupdatedate'=>date('Y-m-d H:i:s')
		);
		$this->db->where('degid', $id);
		$this->db->update('degree', $field);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
}