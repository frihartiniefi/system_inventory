<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('isLogin') != 1) {
			redirect('auth/login','refresh');
		}
	}

	public function index()
	{
		$this->load->view('include/header');
		$this->load->view('include/sidebar');
		$this->load->view('dashboard');
		$this->load->view('include/footer');
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */ ?>