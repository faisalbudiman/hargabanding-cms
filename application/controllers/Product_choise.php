<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Product_Choise extends My_App{

	public $table = 'tb_product_choise';

	public function __construct(){
		parent::__construct();
		
		$this->load->model('_Process_Upload');
		$this->load->model('_Process_MYSQL');
		$this->load->model('M_Product_Choise');
	}

	public function index()
	{

		$data = array(
			'title' => 'Data Pilihan Produk ', 
			'identity' => "'product_choise'",
			'datatables' => true,
			'datatables_url' => "'product_choise/datatables'",
			'datatables_data' => "
			[
			{'data': 'checkbox',width:20},
			{'data': 'id',width:20},
			{'data': 'site_name',width:20},
			{'data': 'product_name',width:10},
			{'data': 'product_link',width:20},
			{'data': 'product_price',width:20},
			{'data': 'store_name',width:20},
			{'data': 'product_rating',width:20},
			{'data': 'product_origin',width:20},
			{'data': 'created_date',width:20},
			{'data': 'updated_date',width:20},
			{'data': 'actived',width:20},   
			{'data': 'image_path',width:20},                        
			{'data': 'alat',width:100},
			]",
			);

		$this->load->view('product_choise/index',$data);

	}

	function datatables(){

		header('Content-Type: application/json');

		$this->load->library('datatables');

		echo $this->M_Product_Choise->datatables();
	}

	public function tambah()
	{

		$data = array(
			'title' => 'Tambah Pilihan Produk ',
			'data_site' => $this->_Process_MYSQL->read_data('tb_sites','id','DESC','site_actived != 0')->result(),
			);

		$this->load->view('product_choise/form',$data);
	}

	public function proses_tambah()
	{

		$this->M_Product_Choise->tambah();
	}

	public function update($identity)
	{

		$data = array(
			'title' => 'Update Pilihan Produk ',
			'data_site' => $this->_Process_MYSQL->read_data('tb_sites','id','DESC','site_actived != 0')->result(),
			'data_product_choise' => $this->_Process_MYSQL->get_data($this->table, array('id' => $identity))->row_array(),
			);

		$this->load->view('product_choise/form',$data);		
	}

	public function proses_update()
	{

		$this->M_Product_Choise->update();
	}	

	public function multiple(){

		$this->M_Product_Choise->multiple();

	}	

}
