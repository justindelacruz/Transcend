<?php

class Main extends CI_Controller {

	public function __construct() {
		parent::__construct();
		/*
		 * TODO: Verify admin user
		 */
	}

	public function index() {
	
		// Views
		$header_data['title'] = "View All Exams";
		$content_data = array();

		$this->load->view('admin/header', $header_data);
		$this->load->view('admin/index', $content_data);
		$this->load->view('admin/footer');
	}
}

/* End of file admin.php */
/* Location: ./controllers/admin.php */