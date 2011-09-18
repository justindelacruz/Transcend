<?php

/*
 * Copyright Justin Dela Cruz, for Transcend.net. All Rights Reserved.
 */

class Purchased_exam_model extends CI_Model {

	function __construct() {

		$this->load->model('User_model', '', true);

		parent::__construct();
	}

	// Gets all info
	function get_purchased_exams() {
		$query = $this->db->get('purchased_exams');
		return $query->result();
	}

	function get_purchased_exam($id) {
		$query = $this->db->get_where('purchased_exams', array('id' => $id));
		return $query->result();
	}

	function get_user_purchased_exams($user_id) {
		$query = $this->db->get_where('purchased_exams', array('user_id' => $user_id));
		return $query;
	}

	function update_purchased_exam($id, $data) {
		$this->db->where('id', $id);
		return $this->db->update('purchased_exams', $data);
	}

	function add_purchased_exam($exam_id, $data) {
		$user_id = $this->User_model->get_user_id($data['email']);

		$d = array(
			'user_id' => $user_id,
			'exam_id' => $exam_id,
			'category_id' => 0,
			'subcategory_id' => 0,
			'question_id' => 0,
			'status' => 'incomplete',
			'price' => "0.00"
		);

		$result = $this->db->insert('purchased_exams', $d);

		return $result;
	}

	function get_progress($user_id) {
		$purchased_exam = $this->get_user_purchased_exams($user_id);

		if ($purchased_exam->num_rows() > 0) {
			$pe = $purchased_exam->row_array();
			$result['category_id'] = $pe['category_id'];
			$result['subcategory_id'] = $pe['subcategory_id'];
			$result['question_id'] = $pe['question_id'];
		}

		return $result;
	}

}

/* End of file purchased_exam_model.php */
