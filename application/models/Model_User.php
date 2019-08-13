<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_User extends CI_Model{
    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function listaUser(){

        $query = $this->db->query(" SELECT * FROM user ");
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	public function agregarUser(){
		$campos = array(
			'firstname'=>$this->input->post('txtnombre'),
			'lastname'=>$this->input->post('txtlastname'),
			'email'=>$this->input->post('email'),
			'password'=>$this->input->post('pass'),
			'perfilId'=>$this->input->post('perfil')
			);
		$this->db->insert('user', $campos);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	function eliminarUser(){
		$id = $this->input->get('catid');
		$this->db->where('userId', $id);
		$this->db->delete('user');
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function editarUser(){
		$id = $this->input->get('id');
		$this->db->where('userId', $id);
		$query = $this->db->get('user');
		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return false;
		}
	}

	public function actualizarUser(){
		$id = $this->input->post('txtId');
		$field = array(
		'firstname'=>$this->input->post('txtnombre'),
		'lastname'=>$this->input->post('txtlastname'),
		'email'=>$this->input->post('email'),
		'password'=>$this->input->post('pass'),
		'perfilId'=>$this->input->post('txtlastname')
		);
		$this->db->where('userId', $id);
		$this->db->update('user', $field);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
}