<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class M_Link_Categories extends CI_Model {

	public $table = 'tb_link_categories';

	function _all_form_input($status = null){

		$this->post_data = array(
			'id_category' => strip_tags($this->input->post('id_category')),
			'id_site' => strip_tags($this->input->post('id_site')),
			'link_category' => strip_tags($this->input->post('link_category')),
			'active' => !empty($this->input->post('active')) ? $this->input->post('active') : "",
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

	}	

	public function tambah()
	{


		#define form input
		$this->_all_form_input('tambah');

		#if category_name not exist on database, bypassed check user
		if ($this->_Process_MYSQL->insert_data($this->table, $this->post_data) == TRUE) {
			$this->berhasil('Menambahkan');
		}else {
			$this->gagal('Menambahkan');
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
		$this->session->set_flashdata('success_message', "Berhasil ".$text." Link Kategori");
		redirect(base_url('link_categories'));
		exit;
	}

	public function gagal($text = false, $redirect)
	{
		$this->session->set_flashdata('failed', true);
		$this->session->set_flashdata('failed_message', "Gagal ".$text." Link Kategori");
		redirect(base_url('link_categories/'.$redirect));
		exit;
	}

	/**
	 * Proses Datatables
	 */

	public function datatables() {

		$this->datatables->select('
			tb_link_categories.id, 
			tb_link_categories.id_category, 
			tb_link_categories.id_site, 
			tb_link_categories.link_category, 
			If(tb_link_categories.active = "1", "Yes", "No") as active, 
			tb_link_categories.created_date, 
			tb_link_categories.updated_date, 
			tb_categories.category_name, 
			tb_sites.site_name');

		$this->datatables->from($this->table);
		$this->datatables->join('tb_categories', 'tb_link_categories.id_category = tb_categories.id');
		$this->datatables->join('tb_sites', 'tb_link_categories.id_site = tb_sites.id');

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
			<a type="button" class="btn btn-primary" href="'.base_url('link_categories/update/$1').'"><i class="fa fa-edit"></i></a>',
			'id');
		return $this->datatables->generate();
	}	

}
