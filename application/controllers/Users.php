<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends My_App{

	public $table = 'tb_users';

	public function __construct(){
		parent::__construct();

		$this->load->model('_Process_MYSQL');
		$this->load->model('M_Users');
	}

	public function index()
	{

		$data = array(
			'title' => 'Data User ', 
			'identity' => "'users'",
			'datatables' => true,
			'datatables_url' => "'users/datatables'",
			'datatables_data' => "
			[
			{'data': 'checkbox',width:1}, 
			{'data': 'id',width:5}, 
			{'data': 'username',width:100}, 
			{'data': 'password',width:100}, 
			{'data': 'created_date',width:50}, 
			{'data': 'last_login',width:50}, 
			{'data': 'actived',width:10}, 			
			{'data': 'alat',width:10} 
			]
			",#setup for function datatables_serverside
			);

		$this->load->view('users/index',$data);

	}

	function datatables(){

		header('Content-Type: application/json');

		$this->load->library('datatables');

		$this->load->helper('datatables');

		echo $this->M_Users->datatables();
	}

	public function tambah()
	{

		$data = array(
			'title' => 'Tambah User '
			);

		$this->load->view('users/form',$data);
	}

	public function proses_tambah()
	{

		$this->M_Users->tambah();
	}

	public function update($identity)
	{

		$data = array(
			'title' => 'Update User ',
			'data_user' => $this->_Process_MYSQL->get_data($this->table, array('id' => $identity))->row_array()
			);

		$this->load->view('users/form',$data);		
	}

	public function proses_update()
	{

		$this->M_Users->update();
	}	

	public function multiple(){

		$this->M_Users->multiple();

	}	

}