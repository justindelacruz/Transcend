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

	function get_exam($id) {
		$query = $this->db->get_where('exams', array('id' => $id));
		return $query->result();
	}

	function update_exam($id, $data) {
		$this->db->where('id', $id);
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

	function update_category($id, $data) {
		$this->db->where('id', $id);
		$result = $this->db->update('categories', $data);
		return $result;
	}

	function create_category($id, $exam_id, $data) {
		$data['exam_id'] = $exam_id;
		$result = $this->db->insert('categories', $data);
		return $result;
	}

	function delete_category($id, $data) {
		$this->db->where('id', $id);
		$result = $this->db->delete('categories', $data);
		return $result;
	}

	/*
	 * 
	 * Questions 
	 * 
	 */
	function get_questions($exam_id) {
		$query = $this->db->get_where('questions', array('exam_id' => $exam_id));
		return $query->result();
	}
}

/* End of file exam_model.php */
