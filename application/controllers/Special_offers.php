<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Special_Offers extends My_App{

    public $table = 'tb_special_offers';

    public function __construct(){
        parent::__construct();
        
        $this->load->model('_Process_Upload');
        $this->load->model('_Process_MYSQL');
        $this->load->model('M_Special_Offers');
    }

    public function index()
    {

        $data = array(
            'title' => 'Data Special Offers ', 
            'identity' => "'special_offers'",
            'datatables' => true,
            'datatables_url' => "'special_offers/datatables'",
            'datatables_data' => "
            [
            {'data': 'checkbox',width:20}, 
            {'data': 'id'},
            {'data': 'site_name'},
            {'data': 'product_name'},
            {'data': 'product_link'},
            {'data': 'product_price'},
            {'data': 'disc_price'},
            {'data': 'store_name'},
            {'data': 'product_rating'},
            {'data': 'product_origin'},
            {'data': 'created_date'},
            {'data': 'update_date'},
            {'data': 'actived'},
            {'data': 'image_path'},                     
            {'data': 'alat',width:100},
            ]",
            );

        $this->load->view('special_offers/index',$data);

    }

    function datatables(){

        header('Content-Type: application/json');

        $this->load->library('datatables');

        echo $this->M_Special_Offers->datatables();
    }

    public function tambah()
    {

        $data = array(
            'title' => 'Tambah Special Offers ',
            'data_site' => $this->_Process_MYSQL->read_data('tb_sites','id','DESC','site_actived != 0')->result(),
            );

        $this->load->view('special_offers/form',$data);
    }

    public function proses_tambah()
    {

        $this->M_Special_Offers->tambah();
    }

    public function update($identity)
    {

        $data = array(
            'title' => 'Update Special Offers ',
            'data_site' => $this->_Process_MYSQL->read_data('tb_sites','id','DESC','site_actived != 0')->result(),
            'data_special_offers' => $this->_Process_MYSQL->get_data($this->table, array('id' => $identity))->row_array(),
            );

        $this->load->view('special_offers/form',$data);     
    }

    public function proses_update()
    {

        $this->M_Special_Offers->update();
    }   

    public function multiple(){

        $this->M_Special_Offers->multiple();

    }   

}
