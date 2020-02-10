<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Link_Categories extends My_App{

	public $table = 'tb_link_categories';

	public function __construct(){
		parent::__construct();
		
		$this->load->model('_Process_MYSQL');
		$this->load->model('M_Link_Categories');
	}

	public function index()
	{

		$data = array(
			'title' => 'Data Link Kategori ', 
			'identity' => "'link_categories'",
			'datatables' => true,
			'datatables_url' => "'link_categories/datatables'",
			'datatables_data' => "
			[{'data': 'checkbox',width:1},
			{'data': 'id',width:20},
			{'data': 'category_name',width:170},
			{'data': 'site_name',width:100},
			{'data': 'link_category',width:100},
			{'data': 'active',width:100},
			{'data': 'created_date',width:100},
			{'data': 'updated_date',width:100},
			{'data': 'alat', width:'100'} ]
			",#setup for function datatables_serverside
			);

		$this->load->view('link_categories/index',$data);

	}

	function datatables(){

		header('Content-Type: application/json');

		$this->load->library('datatables');

		echo $this->M_Link_Categories->datatables();
	}

	public function tambah()
	{

		$data = array(
			'title' => 'Tambah Link Kategori ',
			'data_kategori' => $this->_Process_MYSQL->read_data('tb_categories','id','DESC','actived != 0')->result(),
			'data_site' => $this->_Process_MYSQL->read_data('tb_sites','id','DESC','site_actived != 0')->result(),
			);

		$this->load->view('link_categories/form',$data);
	}

	public function proses_tambah()
	{

		$this->M_Link_Categories->tambah();
	}

	public function update($identity)
	{

		$data = array(
			'title' => 'Update Link Kategori ',
			'data_link_category' => $this->_Process_MYSQL->get_data($this->table, array('id' => $identity))->row_array(),
			'data_kategori' => $this->_Process_MYSQL->read_data('tb_categories','id','DESC','actived != 0')->result(),
			'data_site' => $this->_Process_MYSQL->read_data('tb_sites','id','DESC','site_actived != 0')->result(),
			);

		$this->load->view('link_categories/form',$data);		
	}

	public function proses_update()
	{

		$this->M_Link_Categories->update();
	}	

	public function multiple(){

		$this->M_Link_Categories->multiple();

	}	

}