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
		// Get all current students
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

	// Return array of all floors (by TotalPoints DESC)
	public function get_floor_leaderboard()
	{
		$result = array();

		foreach (range(1, 8) as $floorNum)
		{
			$this->db->select_sum('TotalPoints');
			$this->db->where('Floor', $floorNum);
			$query = $this->db->get('phoenix_students');
			$floor = $query->result();

			if (is_object($floor))
			{
				$floorArray = array(
					'Floor' => $floorNum,
					'TotalPoints' => $floor[0]
				);
				array_push($result, $floorArray);
			}
		}

		return $result;
	}

	// Return array of both sides (by TotalPoints DESC)
	public function get_side_leaderboard()
	{
		$result = array();
		// 'E' side
		$this->db->select_sum('TotalPoints');
		$this->db->where('Side', 'E');
		$query = $this->db->get('phoenix_students');
		$side = $query->result();

		if (is_object($side))
		{
			$sideArray = array(
				'Side' => 'E',
				'TotalPoints' => $floor[0]
			);
			array_push($result, $floorArray);
		}

		// 'W' side
		$this->db->select_sum('TotalPoints');
		$this->db->where('Side', 'W');
		$query = $this->db->get('phoenix_students');
		$side = $query->result();

		if (is_object($side))
		{
			$sideArray = array(
				'Side' => 'W',
				'TotalPoints' => $side[0]
			);
			array_push($result, $sideArray);
		}

		return $result;
	}
}