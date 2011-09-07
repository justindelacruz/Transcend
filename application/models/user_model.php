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
		$query = $this->db->get_where('users u, purchased_exams pe', array('pe.user_id' => $id));
		return $query->result();
	}

	function update_user($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('users', $data);
	}

}

/* End of file user_model.php */
