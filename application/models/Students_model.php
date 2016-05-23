<?php
class Students_model extends CI_Model {

	// Load database
	public function __construct()
	{
		$this->load->database();
	}

	// Return either all students or specific student (if PUID is given)
	public function get_students($puid = FALSE)
	{
		if ($puid == FALSE)
		{
			$this->db->order_by('LastName');
			$query = $this->db->get('phoenix_students');
			return $query->result_array();
		}

		$this->db->order_by('DateCreated', 'desc');
		$this->db->where('PUID', $puid);
		$query = $this->db->get('phoenix_students');
		return $query->row_array();
	}
}