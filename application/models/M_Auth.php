<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class M_Auth extends CI_Model {

	public function process()
	{

		$this->load->model('_Process_MYSQL');

		#define variable from form
		$username = strip_tags($this->input->post('username'));
		$password = strip_tags($this->input->post('password'));
		$csrf_code = $this->input->post('csrf_code');

		if ($csrf_code != '' AND $this->session->userdata('csrf_code') == $csrf_code) {

			#Build Form Data
			$data = array(
				'username' => $username,
				'password' => md5($password),		
			);

			#Read Data from Form
			$read = $this->_Process_MYSQL->get_data($this->table,$data);

			#If Exist
			if ($read->num_rows() > 0) {

				#Read Data From Sql
				$read_data = $read->row();
				$id = $read_data->id;
				$actived = $read_data->actived;

				if ($actived == '0') {
					$this->session->set_flashdata('failed', true);
					$this->session->set_flashdata('failed_message', "Status user tidak aktif");
					redirect(base_url('auth'));
					exit;
				}

				#Build Data
				$data_update = array(
					'id' => $id,
					'last_login' => this_time,
				);

				#Insert Data Log
				if ($this->_Process_MYSQL->update_data($this->table, $data_update, array('id' => $id)) == TRUE) {

					#Create Session Data
					$this->session->set_userdata(array(
						'nama' => $username,
						'status' => "login"
					));

					#Go to Index Page
					redirect(base_url());
					exit;
				}

			}else {
				#if data not exist redirect with notification failed
				$this->session->set_flashdata('failed', true);
				$this->session->set_flashdata('failed_message', "Login Gagal");
				redirect(base_url('auth'));
				exit;
			}

		}else {
			redirect(base_url('auth'));
		}		
	}

}
