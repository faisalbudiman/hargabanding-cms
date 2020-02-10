<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class M_Sites extends CI_Model {

	public $table = 'tb_sites';

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

	public function __upload_square_path($status = null)
	{

		if (!empty($_FILES['square_path']['name'])) 
		{

			if ($status == 'edit') 
			{

				$read = $this->_Process_MYSQL->get_data($this->table,array('id' => $this->input->post('id')))->row();
				$this->_Process_Upload->__delete($read->square_path);
			}

			$upload_files = $this->_Process_Upload->__upload('square_path');
			if ($upload_files !== 'failed') 
			{
				$square_path = $upload_files;
			}else 
			{
				echo "failed upload square_path, code error";
				exit;
			}
			$square_path = array('square_path' => PATH_IMAGES.$square_path);
			$this->post_data = array_merge($this->post_data,$square_path);
		}			
		
	}	

	function _all_form_input($status = null){

		$this->post_data = array(
			'sort_priority' => strip_tags($this->input->post('sort_priority')),
			'site_name' => strip_tags($this->input->post('site_name')),
			'link_promo' => strip_tags($this->input->post('link_promo')),
			'link_site' => strip_tags($this->input->post('link_site')),
			'protocol' => $this->input->post('protocol'),
			'site_actived' => !empty($this->input->post('site_actived')) ? $this->input->post('site_actived') : "",
			'termurah_id' => strip_tags($this->input->post('termurah_id')),      
			);		

		if ($status == 'edit') {
			$this->post_merge = array(
				'id' => $this->input->post('id'),
				);
			$this->post_data = array_merge($this->post_data,$this->post_merge);
		}

		/**
		 * Proses Upload
		 */
		$this->__upload_image_path($status);
		$this->__upload_square_path($status);

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
				$this->_Process_Upload->__delete($data->image_path);
				$this->_Process_Upload->__delete($data->square_path);				
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
		$this->session->set_flashdata('success_message', "Berhasil ".$text." Site");
		redirect(base_url('sites'));
		exit;
	}

	public function gagal($text = false, $redirect)
	{
		$this->session->set_flashdata('failed', true);
		$this->session->set_flashdata('failed_message', "Gagal ".$text." Site");
		redirect(base_url('sites/'.$redirect));
		exit;
	}

	/**
	 * Proses Datatables
	 */

	public function datatables() {

		$this->datatables->select('id,sort_priority,site_name,link_site,protocol,link_promo, If(site_actived = "1", "Yes", "No") as site_actived, image_path, square_path, termurah_id');
		$this->datatables->from($this->table);
		$this->datatables->add_column('checkbox', '
			<td>
				<div class="custom-checkbox custom-control l-12">
					<input type="checkbox" id="checkbox-$1" class="custom-control-input" name="id[]" value="$1">
					<label for="checkbox-$1" class="custom-control-label">&nbsp;</label>
				</div>
			</td>
			','id');
		$this->datatables->edit_column('image_path','<a href="'.PATH_FILES.'$1" target="_blank">$1</a>','image_path');
		$this->datatables->edit_column('square_path','<a href="'.PATH_FILES.'$1" target="_blank">$1</a>','square_path');

		$this->datatables->add_column(
			'alat', 
			'<button type="button" class="btn btn-primary" name="tombol-view"><i class="fa fa-eye"></i></button> 
			<a type="button" class="btn btn-primary" href="'.base_url('sites/update/$1').'"><i class="fa fa-edit"></i></a>',
			'id');
		return $this->datatables->generate();
	}	

}
