<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class M_Promos extends CI_Model {

    public $table = 'tb_promos';

    public function __upload_image_item($status = null)
    {


        if (!empty($_FILES['image_item']['name'])) 
        {

            if ($status == 'edit') 
            {

                $read = $this->_Process_MYSQL->get_data($this->table,array('id' => $this->input->post('id')))->row();
                $this->_Process_Upload->__delete($read->image_item);

            }


            $upload_files = $this->_Process_Upload->__upload('image_item');

            if ($upload_files !== 'failed') 
            {
                $image_item = $upload_files;
            }else 
            {
                echo "failed upload image_item, code error";
                exit;
            }
            $image_item = array('image_item' => PATH_IMAGES.$image_item);
            $this->post_data = array_merge($this->post_data,$image_item);
        }   
    }

    function _all_form_input($status = null){

        $this->post_data = array(
            'id_site' => strip_tags($this->input->post('id_site')),
            'link_path' => strip_tags($this->input->post('link_path')),
            'last_updated' => strip_tags($this->input->post('last_updated')),
            'headers' => strip_tags($this->input->post('headers')),
            'selector_url' => '',
            'selector_image' => '',
            'selector_title' => '',         
            'selector_periode' => '',
            'selector_kode' => '',
            'type' => strip_tags($this->input->post('type')),
            'url_item' => strip_tags($this->input->post('url_item')),
            'title_item' => strip_tags($this->input->post('title_item')),
            'periode_item' => $this->input->post('periode_item'),           
            'kode_item' => $this->input->post('kode_item'),
            'banner' => !empty($this->input->post('banner')) ? $this->input->post('banner') : "false",
            'actived' => !empty($this->input->post('actived')) ? $this->input->post('actived') : "inactive",
        );

        if ($status == 'edit') {
            $this->post_merge = array(
                'last_updated' => this_time,                
                'id' => $this->input->post('id'),
            );
            $this->post_data = array_merge($this->post_data,$this->post_merge);
        }

        /**
         * Proses Upload
         */
        $this->__upload_image_item($status);        

    }   

    public function tambah()
    {


        #define form input
        $this->_all_form_input();

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
                $this->_Process_Upload->__delete($data->image_item);            
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
        $this->session->set_flashdata('success_message', "Berhasil ".$text." Promo");
        redirect(base_url('promos'));
        exit;
    }

    public function gagal($text = false, $redirect)
    {
        $this->session->set_flashdata('failed', true);
        $this->session->set_flashdata('failed_message', "Gagal ".$text." Promo");
        redirect(base_url('promos/'.$redirect));
        exit;
    }

    /**
     * Proses Datatables
     */

    public function datatables() {

        $this->datatables->select('
            tb_promos.id,
            tb_promos.id_site,
            tb_promos.link_path,
            tb_promos.last_updated,
            tb_promos.headers,
            tb_promos.selector_url,
            tb_promos.selector_image,
            tb_promos.selector_title,
            tb_promos.selector_periode,
            tb_promos.selector_kode,
            tb_promos.type,
            tb_promos.url_item,
            tb_promos.image_item,
            tb_promos.title_item,
            tb_promos.periode_item,
            tb_promos.kode_item,
            tb_promos.banner,
            tb_promos.actived,
            tb_sites.site_name');

        $this->datatables->from($this->table);
        $this->datatables->join('tb_sites', 'tb_promos.id_site = tb_sites.id');

        $this->datatables->edit_column('image_item','<a href="'.PATH_FILES.'$1" target="_blank">$1</a>','image_item');
        $this->datatables->add_column('checkbox', '
            <td>
                <div class="custom-checkbox custom-control l-12">
                    <input type="checkbox" id="checkbox-$1" class="custom-control-input" name="id[]" value="$1">
                    <label for="checkbox-$1" class="custom-control-label">&nbsp;</label>
                </div>
            </td>
            ','id');

        $this->datatables->add_column(
            'alat', 
            '<button type="button" class="btn btn-primary" name="tombol-view"><i class="fa fa-eye"></i></button> 
            <a type="button" class="btn btn-primary" href="'.base_url('promos/update/$1').'"><i class="fa fa-edit"></i></a>',
            'id');
        return $this->datatables->generate();
    }   

}
