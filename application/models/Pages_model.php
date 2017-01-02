<?php
class Pages_model extends CI_Model {

	// Load database
	public function __construct()
	{
		$this->load->database();
	}

	// Return array of leading students (by TotalPoints DESC)
	public function get_student_leaderboard()
	{
		// Get all current students
		$this->db->order_by('TotalPoints', 'desc');
		$query = $this->db->get('phoenix_students');
		$allStudents = $query->result_array();

		// Return all students or specific number
		return $allStudents;
	}

	// Return array of all floors (by TotalPoints DESC)
	public function get_floor_leaderboard()
	{
		$this->db->order_by('TotalPoints', 'desc');
		$query = $this->db->get('phoenix_floors');
		return $query->result_array();
	}
	
	// Return array of banquet-eligible students
	public function get_banquet_students()
	{
		$this->load->helper('student');
		banquet_check();

		// Get all current students
		$this->db->order_by('LastName');
		$this->db->where('BanquetEligible', 1);
		$query = $this->db->get('phoenix_students');
		$students = $query->result_array();
		return $students;
	}
}
