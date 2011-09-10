<?php

/*
 * Copyright Justin Dela Cruz, for Transcend.net. All Rights Reserved.
 */

class Purchased_exams_model extends CI_Model {

	function __construct() {
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
		$query = $this->db->get_where('purchased_exams', array('user_id' => $_userid));
		return $query->result();
	}

	function update_purchased_exam($id, $data) {
		$this->db->where('id', $id);
		return $this->db->update('purchased_exams', $data);
	}

}

/* End of file purchased_exams.php */
