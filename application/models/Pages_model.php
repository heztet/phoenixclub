<?php
class Pages_model extends CI_Model {

	// Load database
	public function __construct()
	{
		$this->load->database();
	}

	// Return array of leading students (by TotalPoints DESC)
	public function get_student_leaderboard($numStudents = NULL)
	{
		$this->db->order_by('TotalPoints', 'desc');
		$this->db->where('IsCurrent', 1);
		$query = $this->db->get('phoenix_students');
		$allStudents = $query->result_array();
		$totalStudents = $query->num_rows();


		// Return all students or specific number
		if ($numStudents == NULL)
		{
			return $allStudents;
		}
		else
		{
			// Append students until limit is met
			$result = array();

			for ($count = 0; ($count < $numStudents) AND ($count < $totalStudents); $count++)
			{
				array_push($result, $allStudents[$count]);
			}

			return $result;
		}
	}
}