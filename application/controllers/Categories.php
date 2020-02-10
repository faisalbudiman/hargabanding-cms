<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends My_App{

	public $table = 'tb_categories';

	public function __construct(){
		parent::__construct();
		
		$this->load->model('_Process_MYSQL');
		$this->load->model('M_Categories');
	}

	public function index()
	{

		$data = array(
			'title' => 'Data Kategori ', 
			'identity' => "'categories'",
			'datatables' => true,
			'datatables_url' => "'categories/datatables'",
			'datatables_data' => "
			[{'data': 'checkbox',width:20},
			{'data': 'id',width:20},
			{'data': 'category_name',width:170},
			{'data': 'category_description',width:100},
			{'data': 'created_date',width:100},
			{'data': 'update_date',width:100},
			{'data': 'actived',width:100},
			{'data': 'alat'} ]
			",#setup for function datatables_serverside
			);

		$this->load->view('categories/index',$data);

	}

	function datatables(){

		header('Content-Type: application/json');

		$this->load->library('datatables');

		$this->load->helper('datatables');

		echo $this->M_Categories->datatables();
	}

	public function tambah()
	{

		$data = array(
			'title' => 'Tambah Kategori '
			);

		$this->load->view('categories/form',$data);
	}

	public function proses_tambah()
	{

		$this->M_Categories->tambah();
	}

	public function update($identity)
	{

		$data = array(
			'title' => 'Update Kategori ',
			'data_category' => $this->_Process_MYSQL->get_data($this->table, array('id' => $identity))->row_array()
			);

		$this->load->view('categories/form',$data);		
	}

	public function proses_update()
	{

		$this->M_Categories->update();
	}	

	public function multiple(){

		$this->M_Categories->multiple();

	}	

}