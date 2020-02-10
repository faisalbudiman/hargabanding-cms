<?php defined('BASEPATH') OR exit('No direct script access allowed');

class My_App extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();


		#check session login
		if (empty($this->session->userdata('status'))) {
			redirect(base_url('auth'));
		}
    }

}
