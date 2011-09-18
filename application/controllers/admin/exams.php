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
		$categories = $this->Exam_model->get_categories($id);
		$questions = $this->Exam_model->get_questions($id);

		$exam = (isset($exam[0])) ? $exam[0] : null;

		// Views
		$header_data['title'] = "Exam Details";
		$content_data['exam'] = $exam;
		$content_data['categories'] = $categories;
		$content_data['questions'] = $questions;

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
		if (is_numeric($data['price']) && $data['price'] < "0.01" && $data['price'] > "999.99") {
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
		if ($this->input->post('update') !== false) {
			$result = $this->Exam_model->update_category($id, $data);
		} elseif ($this->input->post('create') !== false) {
			$result = $this->Exam_model->create_category($id, $exam_id, $data);
		} elseif ($this->input->post('delete') !== false) {
			$result = $this->Exam_model->delete_category($id);
		}

		if ($result === true) {
			redirect("/admin/exams/edit/{$exam_id}?updated", 'location');
		} else {
			redirect("/admin/exams/edit/{$exam_id}?error", 'location');
		}
	}

	public function builder() {

		$exam_id = 1;
		$category_id = 0;
		$subcategories = $this->Exam_model->get_subcategories($exam_id, $category_id);
		$questions = $this->Exam_model->get_questions($exam_id, $category_id);
		$answers = $this->Exam_model->get_answers($exam_id, $category_id);
		
		// Views
		$header_data['title'] = "Build Exam";
		$content_data['exams'] = array();
		$content_data['subcategories'] = $subcategories;
		$content_data['questions'] = $questions;
		$content_data['answers'] = $answers;

		$this->load->view('admin/header', $header_data);
		$this->load->view('admin/exam_builder', $content_data);
		$this->load->view('admin/footer');
	}

	public function build() {
		$data = $this->input->post('data');
		$data = json_decode($data, true);

		$subcategories = array();
		$questions = array();
		$answers = array();

		/*
		 * Exam structure
		 * 
		 * exam {
		 * 	subcategory 0 (no category) :
		 * 		name
		 * 		desc
		 * 		questions
		 * 			question 1
		 * 				question
		 * 				answers
		 * 					answer 1
		 * 						answer
		 * 					answer 2
		 * 						answer
		 * 			question 2
		 * 				question
		 * 				answers
		 * 					answer 1 (correct)
		 * 						answer
		 * 					answer 2
		 * 						answer
		 * 					answer 3
		 * 						answer
		 * 	subcategory 1
		 * 		...
		 */

		$exam_id = 1;
		$category_id = 0;

		error_reporting(E_ALL);
		foreach ($data as $sc_k => $sc) {
			$subcategories[] = array(
				'exam_id' => $exam_id,
				'category_id' => $category_id,
				'subcategory_id' => $sc_k,
				'name' => $sc['name'],
				'description' => $sc['description']
			);

			foreach ($sc['questions'] as $q_k => $q) {
				$questions[] = array(
					'exam_id' => $exam_id,
					'category_id' => $category_id,
					'subcategory_id' => $sc_k,
					'question_id' => $q_k,
					'question' => $q['question']
				);

				foreach ($q['answers'] as $a_k => $a) {
					$answers[] = array(
						'exam_id' => $exam_id,
						'category_id' => $category_id,
						'subcategory_id' => $sc_k,
						'question_id' => $q_k,
						'answer_id' => $a_k,
						'answer' => $a
					);
				}
			}
		}
/*
		ob_start();
		print_r($answers);
		$write = ob_get_contents();
		ob_end_flush();
		$write = str_replace("\n", "", $write);
		error_log($write);
*/
		$result = $this->Exam_model->delete_subcategories($exam_id, $category_id);
		$result = $this->Exam_model->add_subcategories($subcategories);
		$result = $this->Exam_model->add_questions($questions);
		$result = $this->Exam_model->add_answers($answers);
	}

}

/* End of file users.php */
/* Location: ./controllers/admin/users.php */