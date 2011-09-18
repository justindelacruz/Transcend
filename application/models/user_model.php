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

	function get_exams($user_id) {
		$this->db->where('user_id', $user_id);
		$query = $this->db->get('purchased_exams pe');
		
		$result = $query->result();
		return $result;
	}

	function get_user_id($email) {
		$result = $this->db->get_where('users', array('email' => $email));
		if ($result->num_rows() == 0) {
			return false;
		}

		return $result->row()->id;
	}

	/*
	 * @Returns:	mysql result	email doesn't exist
	 * 				null			email already exists
	 */

	function add_user($data) {

		$userExists = $this->get_user_id($data['email']);

		$result = null;

		if (!$userExists) {
			$result = $this->db->insert('users', $data);
		}

		return $result;
	}

	function update_user($id, $data) {
		$this->db->where('id', $id);
		$result = $this->db->update('users', $data);
		return $result;
	}
}

/* End of file user_model.php */
