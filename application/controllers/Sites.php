<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sites extends My_App{

	public $table = 'tb_sites';

	public function __construct(){
		parent::__construct();
		
		$this->load->model('_Process_Upload');
		$this->load->model('_Process_MYSQL');
		$this->load->model('M_Sites');
	}

	public function index()
	{

		$data = array(
			'title' => 'Data Site ', 
			'identity' => "'sites'",
			'datatables' => true,
			'datatables_url' => "'sites/datatables'",
			'datatables_data' => "
			[{'data': 'checkbox',width:20},
			{'data': 'id',width:20},
			{'data': 'sort_priority',width:20},
			{'data': 'site_name',width:10},
			{'data': 'site_actived',width:20},
			{'data': 'link_site',width:20},
			{'data': 'protocol',width:20},
			{'data': 'link_promo',width:20},
			{'data': 'termurah_id',width:20},
			{'data': 'image_path',width:20},
			{'data': 'square_path',width:20},
			{'data': 'alat',width:100} ]
			",#setup for function datatables_serverside
			);

		$this->load->view('sites/index',$data);

	}

	function datatables(){

		header('Content-Type: application/json');

		$this->load->library('datatables');

		echo $this->M_Sites->datatables();
	}

	public function tambah()
	{

		$data = array(
			'title' => 'Tambah Site ',
			);

		$this->load->view('sites/form',$data);
	}

	public function proses_tambah()
	{

		$this->M_Sites->tambah();
	}

	public function update($identity)
	{

		$data = array(
			'title' => 'Update Site ',
			'data_sites' => $this->_Process_MYSQL->get_data($this->table, array('id' => $identity))->row_array(),
			);

		$this->load->view('sites/form',$data);		
	}

	public function proses_update()
	{

		$this->M_Sites->update();
	}	

	public function multiple(){

		$this->M_Sites->multiple();

	}	

}
