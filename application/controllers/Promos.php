<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Promos extends My_App{

	public $table = 'tb_promos';

	public function __construct(){
		parent::__construct();
		
		$this->load->model('_Process_Upload');
		$this->load->model('_Process_MYSQL');
		$this->load->model('M_Promos');
	}

	public function index()
	{

		$data = array(
			'title' => 'Data Promo ', 
			'identity' => "'promos'",
			'datatables' => true,
			'datatables_url' => "'promos/datatables'",
			'datatables_data' => "
			[{'data': 'checkbox',width:20},
			{'data': 'id',width:20},
			{'data': 'site_name',width:20},
			{'data': 'link_path',width:10},
			{'data': 'last_updated',width:20},
			{'data': 'headers',width:20},
			{'data': 'selector_url',width:20},
			{'data': 'selector_image',width:20},
			{'data': 'selector_title',width:20},
			{'data': 'selector_periode',width:20},
			{'data': 'selector_kode',width:20},
			{'data': 'type',width:20},
			{'data': 'url_item',width:20},
			{'data': 'image_item',width:20},            
			{'data': 'title_item',width:20},    
			{'data': 'periode_item',width:20},
			{'data': 'kode_item',width:20},
			{'data': 'banner',width:20},            
			{'data': 'actived',width:20},                       
			{'data': 'alat',width:100} ]
			",#setup for function datatables_serverside
			);

		$this->load->view('promos/index',$data);

	}

	function datatables(){

		header('Content-Type: application/json');

		$this->load->library('datatables');

		echo $this->M_Promos->datatables();
	}

	public function tambah()
	{

		$data = array(
			'title' => 'Tambah Promo ',
			'data_site' => $this->_Process_MYSQL->read_data('tb_sites','id','DESC','site_actived != 0')->result(),
			);

		$this->load->view('promos/form',$data);
	}

	public function proses_tambah()
	{

		$this->M_Promos->tambah();
	}

	public function update($identity)
	{

		$data = array(
			'title' => 'Update Promo ',
			'data_site' => $this->_Process_MYSQL->read_data('tb_sites','id','DESC','site_actived != 0')->result(),
			'data_promos' => $this->_Process_MYSQL->get_data($this->table, array('id' => $identity))->row_array(),
			);

		$this->load->view('promos/form',$data);		
	}

	public function proses_update()
	{

		$this->M_Promos->update();
	}	

	public function multiple(){

		$this->M_Promos->multiple();

	}	

}
