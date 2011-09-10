<?php

class Exams extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('Exam_model', '', true);
		$this->load->helper('url');
		/*
		 * TODO: Verify admin user
		 */
	}

	public function view() {
		$exams = $this->Exam_model->get_all_exams();

		// Views
		$header_data['title'] = "View All Exams";
		$content_data['exams'] = $exams;

		$this->load->view('admin/header', $header_data);
		$this->load->view('admin/view_exams', $content_data);
		$this->load->view('admin/footer');
	}

	public function edit($id) {
		$exam = $this->Exam_model->get_exam($id);
		$exam = (isset($exam[0])) ? $exam[0] : null;
		
		$categories = $this->Exam_model->get_categories($id);

		// Views
		$header_data['title'] = "Exam Details";
		$content_data['exam'] = $exam;
		$content_data['categories'] = $categories;

		$this->load->view('admin/header', $header_data);
		$this->load->view('admin/edit_exam', $content_data);
		$this->load->view('admin/footer');
	}
	
	public function update_exam() {
		$id = $this->input->post('id');
		$data['name'] = $this->input->post('name');
		$data['price'] = $this->input->post('price');
		$data['modification_time'] = date('Y-m-d H-i-s');

		$result = null;
		if(is_numeric($data['price']) && $data['price'] < "0.01" && $data['price'] > "999.99") {
			$result = $this->Exam_model->update_exam($id, $data);
		}

		if ($result === true) {
			redirect("/admin/exams/edit/{$id}?updated", 'location');
		} else {
			redirect("/admin/exams/edit/{$id}?error", 'location');
		}
	}
	
	public function update_category() {
		$id = $this->input->post('id');
		$exam_id = $this->input->post('exam_id');
		$data['name'] = $this->input->post('name');

		$result = null;
		if($this->input->post('update') !== false) {
			$result = $this->Exam_model->update_category($id, $data);
		}
		elseif($this->input->post('create') !== false) {
			$result = $this->Exam_model->create_category($id, $exam_id, $data);
		}
		elseif($this->input->post('delete') !== false) {
			$result = $this->Exam_model->delete_category($id);
		}
		
		if ($result === true) {
			redirect("/admin/exams/edit/{$exam_id}?updated", 'location');
		} else {
			redirect("/admin/exams/edit/{$exam_id}?error", 'location');
		}
	}
}

/* End of file users.php */
/* Location: ./controllers/admin/users.php */