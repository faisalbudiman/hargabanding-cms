<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class M_Product_Choise extends CI_Model {

    public $table = 'tb_product_choise';

    public function __upload_image_path($status = null)
    {


        if (!empty($_FILES['image_path']['name'])) 
        {

            if ($status == 'edit') 
            {

                $read = $this->_Process_MYSQL->get_data($this->table,array('id' => $this->input->post('id')))->row();
                $this->_Process_Upload->__delete($read->image_path);

            }


            $upload_files = $this->_Process_Upload->__upload('image_path');

            if ($upload_files !== 'failed') 
            {
                $image_path = $upload_files;
            }else 
            {
                echo "failed upload image_path, code error";
                exit;
            }
            $image_path = array('image_path' => PATH_IMAGES.$image_path);
            $this->post_data = array_merge($this->post_data,$image_path);
        }   
    }

    function _all_form_input($status = null){

        $this->post_data = array(
            'id_site' => strip_tags($this->input->post('id_site')),
            'product_name' => strip_tags($this->input->post('product_name')),
            'product_link' => strip_tags($this->input->post('product_link')),
            'product_price' => strip_tags($this->input->post('product_price')),
            'store_name' => strip_tags($this->input->post('store_name')),
            'product_rating' => strip_tags($this->input->post('product_rating')),
            'product_origin' => strip_tags($this->input->post('product_origin')),
            'actived' => !empty($this->input->post('actived')) ? $this->input->post('actived') : "inactive",
            );

        if ($status === 'tambah') {
            $this->post_merge = array(
                'created_date' => this_time,
                );
            $this->post_data = array_merge($this->post_data,$this->post_merge);
        }

        if ($status == 'edit') {
            $this->post_merge = array(
                'updated_date' => this_time,
                'id' => $this->input->post('id'),
                );
            $this->post_data = array_merge($this->post_data,$this->post_merge);
        }

        /**
         * Proses Upload
         */
        $this->__upload_image_path($status);           

    }   

    public function tambah()
    {


        #define form input
        $this->_all_form_input('tambah');

        # insert data
        if ($this->_Process_MYSQL->insert_data($this->table, $this->post_data) == TRUE) {
            $this->berhasil('Tambah');
        }else {
            $this->gagal('Tambah');
        }  

    }

    public function update()
    {


        #define form input
        $this->_all_form_input('edit'); 

        #update data
        if ($this->_Process_MYSQL->update_data($this->table, $this->post_data, array('id' => $this->post_data['id'])) == TRUE) {
            $this->berhasil('Update');
        }else {
            $this->gagal('Update');
        }

    }   

    public function multiple()
    {
        #define form input
        $id = explode(',', $this->input->post('id'));
        $action = $this->input->post('action');

        #if action 
        if($action == 'hapus') {

            $read = $this->_Process_MYSQL->get_data_multiple($this->table,$id,'id');
            $read_data = $read->result();

            foreach ($read_data as $data) {
                $this->_Process_Upload->__delete($data->image_path);            
            }

            if ($this->_Process_MYSQL->delete_data_multiple($this->table, $id, 'id') == TRUE) {
                echo true;
            }else {
                echo false;
            }
        }       
    }   

    public function berhasil($text = false)
    {
        $this->session->set_flashdata('success', true);
        $this->session->set_flashdata('success_message', "Berhasil ".$text." Product");
        redirect(base_url('product_choise'));
        exit;
    }

    public function gagal($text = false, $redirect)
    {
        $this->session->set_flashdata('failed', true);
        $this->session->set_flashdata('failed_message', "Gagal ".$text." Product");
        redirect(base_url('product_choise/'.$redirect));
        exit;
    }

    /**
     * Proses Datatables
     */

    public function datatables() {

        $this->datatables->select('
            tb_product_choise.id,
            tb_product_choise.id_site,
            tb_product_choise.product_name,
            tb_product_choise.product_link,
            tb_product_choise.product_price,
            tb_product_choise.store_name,
            tb_product_choise.product_rating,
            tb_product_choise.product_origin,
            tb_product_choise.created_date,
            tb_product_choise.updated_date,
            tb_product_choise.actived,
            tb_product_choise.image_path,
            tb_sites.site_name');

        $this->datatables->from($this->table);
        $this->datatables->join('tb_sites', 'tb_product_choise.id_site = tb_sites.id');
        $this->datatables->add_column('checkbox', '
            <td>
                <div class="custom-checkbox custom-control l-12">
                    <input type="checkbox" id="checkbox-$1" class="custom-control-input" name="id[]" value="$1">
                    <label for="checkbox-$1" class="custom-control-label">&nbsp;</label>
                </div>
            </td>
            ','id');

        $this->datatables->edit_column('image_path','<a href="'.PATH_FILES.'$1" target="_blank">$1</a>','image_path');

        $this->datatables->add_column(
            'alat', 
            '<button type="button" class="btn btn-primary" name="tombol-view"><i class="fa fa-eye"></i></button> 
            <a type="button" class="btn btn-primary" href="'.base_url('product_choise/update/$1').'"><i class="fa fa-edit"></i></a>',
            'id');
        return $this->datatables->generate();
    }   

}
