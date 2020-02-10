<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class M_Users extends CI_Model {

	public $table = 'tb_users';

	function _all_form_input($status = null){

		$this->post_data = array(
			'username' => strip_tags($this->input->post('username')),
			'actived' => !empty($this->input->post('actived')) ? $this->input->post('actived') : "0",
			);

		if ($status === 'tambah') {
			$this->post_merge = array(
				'password' => md5(strip_tags($this->input->post('password'))),
				'created_date' => this_time,
				);
			$this->post_data = array_merge($this->post_data,$this->post_merge);
		}

		if ($status == 'edit') {
			$password_old = $this->input->post('password-old');
			$password = $this->input->post('password');
			if ($password_old == $password) {
				$new_password = $password;
			}else {
				$new_password = md5(strip_tags($password));
			}

			$this->post_merge = array(
				'password' => $new_password,				
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
		$read = $this->_Process_MYSQL->get_data($this->table,array('username' => $this->post_data['username']));

		#if username exist
		if ($read->num_rows() > 0) {

			#read username
			$read_data = $read->row();

			#if username on form data same as username from database
			if ($this->post_data['username'] == $read_data->username) {

				#result invalid because same name
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

			#if username not exist on database, bypassed check user
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

		#check username
		$read = $this->_Process_MYSQL->get_data($this->table,array('username' => $this->post_data['username']));

		#if changed data will be checked exist or no
		if ($read->num_rows() > 0) {

			# read username
			$read_data = $read->row();

			# if username on form data same as username from database
			if ($this->post_data['username'] == $read_data->username and $this->post_data['id'] != $read_data->id) {

				# result invalid because same name
				$this->invalid('update/'.$this->post_data['id']);

			}else {

				#update data
				if ($this->_Process_MYSQL->update_data($this->table, $this->post_data, array('id' => $this->post_data['id'])) == TRUE) {
					$this->berhasil('Update');
				}else {
					$this->gagal('Update','update/'.$this->post_data['id']);
				}

			}

		}else {

			#update data
			if ($this->_Process_MYSQL->update_data($this->table, $this->post_data, array('id' => $this->post_data['id'])) == TRUE) {
				$this->berhasil('Update');
			}else {
				$this->gagal('Update','update/'.$this->post_data['id']);
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
		$this->session->set_flashdata('failed_message', "Username sudah terpakai");
		redirect(base_url('users/'.$redirect));
		exit;
	}	

	public function berhasil($text = false)
	{
		$this->session->set_flashdata('success', true);
		$this->session->set_flashdata('success_message', "Berhasil ".$text." User");
		redirect(base_url('users'));
		exit;
	}

	public function gagal($text = false, $redirect)
	{
		$this->session->set_flashdata('failed', true);
		$this->session->set_flashdata('failed_message', "Gagal ".$text." User");
		redirect(base_url('users/'.$redirect));
		exit;
	}

	/**
	 * Proses Datatables
	 */

	public function datatables() {
		$this->datatables->select('
			id,
			username,
			password,
			last_login,
			created_date, 
			If(actived = "1", "Yes", "No") as actived');
		$this->datatables->from($this->table);
		$this->datatables->add_column('checkbox', '$1','$this->datatables_user(id,username)');
		$this->datatables->add_column(
			'alat', 
			'<button type="button" class="btn btn-primary" name="tombol-view"><i class="fa fa-eye"></i></button> 
			<a type="button" class="btn btn-primary" href="'.base_url('users/update/$1').'"><i class="fa fa-edit"></i></a>',
			'id');
		return $this->datatables->generate();
	}	

}
