<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

	public $table = 'tb_users';

	public function index()
	{

		/**
		 * Create CSRF CODE
		 */
		$this->session->set_flashdata('csrf_code', substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 32));

		$data = array(
			'title' => 'Auth '
			);
		
		$this->load->view('auth/index',$data);
	}

	public function Process()
	{
		$this->load->model('M_Auth');
		$this->M_Auth->Process();
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url('auth'));
	}
}
