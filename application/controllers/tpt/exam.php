<?php

class Exam extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('User_model', '', true);
		$this->load->model('Purchased_exam_model', '', true);
		$this->load->model('Exam_model', '', true);
		$this->load->helper('url');
		/*
		 * TODO: Verify admin user
		 */
	}

	public function welcome() {
		$exam_id = 1; /* TODO: make dynamic */

		$exam = $this->Exam_model->get_exam($exam_id);

		// Views
		$header_data['title'] = "Translator Proficiency Test for Bilingual Health Care Professionals";
		$content_data = array();


		$this->load->view('tpt/header', $header_data);
		$this->load->view('tpt/welcome', $content_data);
		$this->load->view('tpt/footer');
	}

	public function error($errno) {
		$errmsg = '';

		switch ($errno) {
			case 1: $errmsg = 'Your e-mail is already in the database. Please use a different e-mail address (for now).';
				break;
		}

		$header_data['title'] = "Whoops!";
		$content_data['errmsg'] = $errmsg;

		$this->load->view('tpt/header', $header_data);
		$this->load->view('tpt/error', $content_data);
		$this->load->view('tpt/footer');
	}

	public function begin() {
		$exam_id = 1;
		$error = null;

		$user['email'] = $this->input->post('email');
		$user['first_name'] = 'Valued';
		$user['last_name'] = 'Client';
		$user['company'] = 'Transcend';
		$user['title'] = 'Test Taker';

		$result = $this->User_model->add_user($user);
		if (!$result) {
			// redirect("/tpt/exam/error/1", 'location');
		}

		$result = $this->Purchased_exam_model->add_purchased_exam($exam_id, $user);

		$this->take();
		/* 		$user['first_name'] =$this->input->post('first_name');
		  $user['last_name'] = $this->input->post('last_name');
		  $user['company'] = $this->input->post('company');
		  $user['title'] = $this->input->post('title');
		 */

		// Insert user
		// Insert purchased exam
		// Set timer
		// Set status
		// Load question 1
	}

	/* Todo:
	 * - make exam id dynamic
	 * - make user id dynamic
	 * - figure out way to shuffle answers w/o revealing '0'
	 */

	public function take() {
		$exam_id = 1;
		$user_id = 2;

		$progress = $this->Purchased_exam_model->get_progress($user_id);

		$progress['subcategory_id']++;

		$exam = $this->Exam_model->get_exam($exam_id);
		$category = $this->Exam_model->get_category($exam_id, $progress['category_id']);
		$subcategory = $this->Exam_model->get_subcategory($exam_id, $progress['category_id'], $progress['subcategory_id']);

		$questions = $this->Exam_model->get_questions_subset($exam_id, $progress['category_id'], $progress['subcategory_id'], $subcategory[0]->select);
		$answers = $this->Exam_model->get_subcategory_answers($exam_id, $progress['category_id'], $progress['subcategory_id'], array_keys($questions));

		// Shuffle answers
		foreach ($answers as &$answer) {
			shuffle($answer);
		}

		// Views
		$header_data['title'] = "View All Exams";
		$content_data['progress'] = $progress;
		$content_data['exam'] = $exam[0];
		$content_data['category'] = $category[0];
		$content_data['subcategory'] = $subcategory[0];
		$content_data['questions'] = $questions;
		$content_data['answers'] = $answers;

		// print '<pre>';
		// print_r($content_data);
		// die;

		$this->load->view('tpt/header', $header_data);
		$this->load->view('tpt/exam', $content_data);
		$this->load->view('tpt/footer');
	}

	public function next() {
		// Go immediately to results
		
		$exam = $this->input->post('exam');
		$progress = $this->input->post('progress');
		

		$header_data['title'] = "Exam Results";
		$content_data['results'] = array();

		$this->load->view('tpt/header', $header_data);
		$this->load->view('tpt/results', $content_data);
		$this->load->view('tpt/footer');
	}

}

/* End of file exam.php */
/* Location: ./controllers/tpt/exam.php */