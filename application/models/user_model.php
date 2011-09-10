<?php

/*
 * Copyright Justin Dela Cruz, for Transcend.net. All Rights Reserved.
 *
 * Description of user_model
 *
 */

class User_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	// Gets all info
	function get_all_users() {
		$query = $this->db->get('users');
		return $query->result();
	}

	function get_user($id) {
		$query = $this->db->get_where('users', array('id' => $id));
		return $query->result();
	}

	function get_exams($id) {
		$query = $this->db->get('purchased_exams pe');
		$this->db->where('pe.user_id = u.id');
		$this->db->where("pe.user_id", "1");
		$result = $query->result();
		return $result;
	}

	function update_user($id, $data) {
		$this->db->where('id', $id);
		$result = $this->db->update('users', $data);
		return $result;
	}

}

/* End of file user_model.php */
