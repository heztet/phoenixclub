<?php
class Downloads_model extends CI_Model {
	// Load database
	public function __construct()
	{
		$this->load->database();
	}

	// Return query of banquet-eligible students (excluding PUID)
	public function get_banquet_students()
	{
		// Get all current students
		$this->db->select('FirstName, LastName, Floor, Side, Year');
		$this->db->order_by('LastName');
		$this->db->where('BanquetEligible', 1);
		$query = $this->db->get('phoenix_students');
		return $query;
	}
}