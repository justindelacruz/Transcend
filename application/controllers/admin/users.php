<?php

class Users extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('User_model', '', true);
		$this->load->model('Purchased_exam_model', '', true);
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

		$this->load->view('admin/header', $header_data);
		$this->load->view('admin/view_users', $content_data);
		$this->load->view('admin/footer');
	}

	public function edit($id) {
		$user = $this->User_model->get_user($id);
		$user = (isset($user[0])) ? $user[0] : null;

		$exams = $this->User_model->get_exams($id);

		// Views
		$header_data['title'] = "User Details";
		$content_data['user'] = $user;
		$content_data['exams'] = $exams;

		$this->load->view('admin/header', $header_data);
		$this->load->view('admin/edit_user', $content_data);
		$this->load->view('admin/footer');
	}

	public function update_user() {
		$id = $this->input->post('id');
		$data['first_name'] = $this->input->post('first_name');
		$data['last_name'] = $this->input->post('last_name');
		$data['email'] = $this->input->post('email');
		$data['company'] = $this->input->post('company');
		$data['title'] = $this->input->post('title');

		$result = $this->User_model->update_user($id, $data);

		if ($result === true) {
			redirect("/admin/users/edit/{$id}?updated", 'location');
		} else {
			redirect("/admin/users/edit/{$id}?error", 'location');
		}
	}

	public function update_purchased_exam() {
		$purchase_id = $this->input->post('id');
		$data['user_id'] = $this->input->post('user_id');
		$data['exam_id'] = $this->input->post('exam_id');
		//$data['current_question'] = $this->input->post('current_question');
		$data['expiration_time'] = $this->input->post('expiration_time');

		$result = $this->Purchased_exam_model->update_purchased_exam($purchase_id, $data);

		if ($result === true) {
			redirect("/admin/users/edit/{$data['user_id']}?updated", 'location');
		} else {
			redirect("/admin/users/edit/{$data['user_id']}?error", 'location');
		}
	}

}

/* End of file users.php */
/* Location: ./controllers/admin/users.php */