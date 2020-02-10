<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_App {

	public function index()
	{

		$data = array(
			'title' => "Dashboard "
			);
		$this->load->view('Dashboard',$data);
	}

}