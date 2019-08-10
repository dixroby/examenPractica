<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	
	public function index()
	{
		$this->load->view('login'); // aqui va el nombre de modelo tal cual en este caso login
	}
}