<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class M_Categories extends CI_Model {

	public $table = 'tb_categories';

	function _all_form_input($status = null){

		$this->post_data = array(
			'category_name' => strip_tags($this->input->post('category_name')),
			'category_description' => strip_tags($this->input->post('category_description')),
			'actived' => !empty($this->input->post('actived')) ? $this->input->post('actived') : "",
			);

		if ($status === 'tambah') {
			$this->post_merge = array(
				'created_date' => this_time,
				'update_date' => '0000-00-00 00:00:00',			
				);
			$this->post_data = array_merge($this->post_data,$this->post_merge);
		}

		if ($status == 'edit') {
			$this->post_merge = array(
				'update_date' => this_time,
				'id' => $this->input->post('id'),
				);
			$this->post_data = array_merge($this->post_data,$this->post_merge);
		}

	}	

	public function tambah()
	{


		#define form input
		$this->_all_form_input('tambah');

		#Read Data from Form
		$read = $this->_Process_MYSQL->get_data($this->table,array('category_name' => $this->post_data['category_name']));

		#if category_name exist
		if ($read->num_rows() > 0) {

			#read category_name
			$read_data = $read->row();

			#if category_name on form data same as category_name from database
			if ($this->post_data['category_name'] == $read_data->category_name) {

				$this->invalid('tambah');

			}else {

				#insert data to database
				if ($this->_Process_MYSQL->insert_data($this->table, $this->post_data) == TRUE) {
					$this->berhasil('Menambahkan');
				}else {
					$this->gagal('Menambahkan');
				}	

			}
		}else {

			#if category_name not exist on database, bypassed check user
			if ($this->_Process_MYSQL->insert_data($this->table, $this->post_data) == TRUE) {
				$this->berhasil('Menambahkan');
			}else {
				$this->gagal('Menambahkan');
			}	

		}

	}

	public function update()
	{


		#define form input
		$this->_all_form_input('edit');	

		#check category_name
		$read = $this->_Process_MYSQL->get_data($this->table,array('category_name' => $this->post_data['category_name']));

		#if changed data will be checked exist or no
		if ($read->num_rows() > 0) {

			# read category_name
			$read_data = $read->row();

			# if category_name on form data same as category_name from database
			if ($this->post_data['category_name'] == $read_data->category_name and $this->post_data['id'] != $read_data->id) {

				# result invalidm because same name
				$this->invalid('update/'.$this->post_data['id']);

			}else {

				#update data
				if ($this->_Process_MYSQL->update_data($this->table, $this->post_data, array('id' => $this->post_data['id'])) == TRUE) {
					$this->berhasil('Update');
				}else {
					$this->gagal('Update');
				}

			}

		}else {

			#update data
			if ($this->_Process_MYSQL->update_data($this->table, $this->post_data, array('id' => $this->post_data['id'])) == TRUE) {
				$this->berhasil('Update');
			}else {
				$this->gagal('Update');
			}
		}

	}	

	public function multiple()
	{
		#define form input
		$id = explode(',', $this->input->post('id'));
		$action = $this->input->post('action');

		#if action 
		if($action == 'hapus') {
			if ($this->_Process_MYSQL->delete_data_multiple($this->table, $id, 'id') == TRUE) {
				echo true;
			}else {
				echo false;
			}
		}		
	}	

	public function invalid($redirect)
	{
		$this->session->set_flashdata('failed', true);
		$this->session->set_flashdata('failed_message', "Nama Kategori sudah terpakai");
		redirect(base_url('categories/'.$redirect));
		exit;
	}	

	public function berhasil($text = false)
	{
		$this->session->set_flashdata('success', true);
		$this->session->set_flashdata('success_message', "Berhasil ".$text." Kategori");
		redirect(base_url('categories'));
		exit;
	}

	public function gagal($text = false, $redirect)
	{
		$this->session->set_flashdata('failed', true);
		$this->session->set_flashdata('failed_message', "Gagal ".$text." Kategori");
		redirect(base_url('categories/'.$redirect));
		exit;
	}

	/**
	 * Proses Datatables
	 */

	public function datatables() {
		$this->datatables->select('id,category_name,category_description,created_date,update_date,If(actived = "1", "Yes", "No") as actived');
		$this->datatables->from($this->table);
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
			<a type="button" class="btn btn-primary" href="'.base_url('categories/update/$1').'"><i class="fa fa-edit"></i></a>',
			'id');
		return $this->datatables->generate();
	}	

}
