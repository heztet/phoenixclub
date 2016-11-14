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
		$totalStudents = $query->num_rows();

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

	// Return either all students eligible for banquet
	public function get__banquet_students()
	{
		$this->db->order_by('DateCreated', 'desc');
		$this->db->where('PUID', $puid);
		$this->db->where('BanquetEligible', 1);
		$query = $this->db->get('phoenix_students');
		$students = $query->row_array();

		// Add year string to each student
		$students = $this->append_year_string($students);
		
		return $students;
	}
}