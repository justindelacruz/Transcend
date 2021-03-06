<?php

/*
 * Copyright Justin Dela Cruz, for Transcend.net. All Rights Reserved.
 *
 * Description of exam_model
 *
 */

class Exam_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	// Gets all info
	function get_all_exams() {
		$query = $this->db->get('exams');
		return $query->result();
	}

	function get_exam($exam_id) {
		$query = $this->db->get_where('exams', array('exam_id' => $exam_id));
		return $query->result();
	}

	function update_exam($exam_id, $data) {
		$this->db->where('exam_id', $exam_id);
		$result = $this->db->update('exams', $data);
		return $result;
	}

	/*
	 * 
	 * Categories
	 * 
	 */

	function get_categories($exam_id) {
		$query = $this->db->get_where('categories', array('exam_id' => $exam_id));
		return $query->result();
	}

	function get_category($exam_id, $category_id) {
		$query = $this->db->get_where('categories', array('exam_id' => $exam_id, 'category_id' => $category_id));
		return $query->result();
	}

	function update_category($category_id, $data) {
		$this->db->where('category_id', $id);
		$result = $this->db->update('categories', $data);
		return $result;
	}

	function create_category($id, $exam_id, $data) {
		$data['exam_id'] = $exam_id;
		$result = $this->db->insert('categories', $data);
		return $result;
	}

	function delete_category($id) {
		$this->db->where('id', $id);
		$result = $this->db->delete('categories');
		return $result;
	}

	/*
	 * Subcategories
	 */

	function get_subcategories($exam_id, $category_id) {
		$query = $this->db->get_where('subcategories', array(
			'exam_id' => $exam_id,
			'category_id' => $category_id)
		);
		return $query->result();
	}

	function get_subcategory($exam_id, $category_id, $subcategory_id) {
		$query = $this->db->get_where('subcategories', array(
			'exam_id' => $exam_id,
			'category_id' => $category_id,
			'subcategory_id' => $subcategory_id
				)
		);
		return $query->result();
	}

	function delete_subcategories($exam_id, $category_id) {
		$this->db->where('exam_id', $exam_id);
		$this->db->where('category_id', $category_id);
		$result = $this->db->delete('subcategories');
		return $result;
	}

	function add_subcategories($data) {
		$this->db->insert_batch('subcategories', $data); /* cascade-deletes questions and answers */
	}

	/*
	 * Questions  
	 */

	function get_questions($exam_id, $category_id) {

		$this->db->where(array(
			'exam_id' => $exam_id,
			'category_id' => $category_id
				)
		);
		$query = $this->db->get('questions');

		$parsed = array();
		foreach ($query->result() as $question) {
			$parsed[$question->question_id] = $question;
		}

		return $parsed;
	}

	function get_questions_subset($exam_id, $category_id, $subcategory_id, $limit) {
		$this->db->where(array(
			'exam_id' => $exam_id,
			'category_id' => $category_id,
			'subcategory_id' => $subcategory_id
				)
		);
		$this->db->limit($limit);
		$this->db->order_by("id", "random"); 
		$query = $this->db->get('questions');

		$parsed = array();
		foreach ($query->result() as $question) {
			$parsed[$question->question_id] = $question;
		}

		return $parsed;
	}

	function get_question($exam_id, $category_id, $question_id) {
		$query = $this->db->get_where('questions', array(
			'exam_id' => $exam_id,
			'category_id' => $category_id,
			'question_id' => $question_id
				)
		);
		return $query->result();
	}

	function add_questions($data) {
		$this->db->insert_batch('questions', $data); /* cascade-deletes questions and answers */
	}

	/*
	 * Answers
	 */

	function get_answers($exam_id, $category_id) {
		$query = $this->db->get_where('answers', array(
			'exam_id' => $exam_id,
			'category_id' => $category_id)
		);
		return $query->result();
	}

	function get_subcategory_answers($exam_id, $category_id, $subcategory_id, $question_ids) {
		$this->db->where(array(
			'exam_id' => $exam_id,
			'category_id' => $category_id,
			'subcategory_id' => $subcategory_id
				)
		);
		$this->db->where_in('question_id', $question_ids);
		$query = $this->db->get('answers');

		$parsed = array();
		foreach ($query->result() as $answer) {
			$parsed[$answer->question_id][$answer->answer_id] = $answer;
		}
		return $parsed;
	}

	function add_answers($data) {
		$this->db->insert_batch('answers', $data); /* cascade-deletes questions and answers */
	}

}

/* End of file exam_model.php */
