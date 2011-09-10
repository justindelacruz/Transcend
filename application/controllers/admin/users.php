<?php

class Purchased_exams extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->model('User_model', '', true);
		$this->load->helper('url');
		/*
		 * TODO: Verify admin user
		 */
	}

	public function view() {
		$users = $this->User_model->get_all_users();
		
		// Views
		$header_data['title'] = "View All Users";
		$content_data['users'] = $users;
		
		$this->load->view('admin/header',$header_data);
		$this->load->view('admin/view_users', $content_data);
		$this->load->view('admin/footer');
	}
	
	public function edit($id) {
		$user = $this->User_model->get_user($id);
		$exams = $this->User_model->get_exams($id);
		
		$user = (isset($user[0])) ? $user[0] : null;
		
		// Views
		$header_data['title'] = "User Details";
		$content_data['user'] = $user;
		$content_data['exams'] = $exams;
		
		$this->load->view('admin/header',$header_data);
		$this->load->view('admin/edit_user', $content_data);
		$this->load->view('admin/footer');
		
	}
	
	public function update() {
		$id = $this->input->post('id');
		$data['first_name'] = $this->input->post('first_name');
		$data['last_name'] = $this->input->post('last_name');
		$data['email'] = $this->input->post('email');
		$data['company'] = $this->input->post('company');
		$data['title'] = $this->input->post('title');
		
		$exams = $this->User_model->update_user($id, $data);
		
		redirect("/admin/users/edit/{$id}?updated", 'location');
	}

	public function comments() {
		echo 'Look at this!';
	}

}

/* End of file users.php */
/* Location: ./controllers/admin/users.php */