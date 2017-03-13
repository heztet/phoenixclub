<?php
class Downloads_model extends CI_Model {
	/* NOTE: Many of these functions can be found in other models, but
	         the downloadable versions have specific "cleaned up" 
	         column names and ordering
	*/

	// Load database
	public function __construct()
	{
		$this->load->database();
	}

	// Return query of all students (excluding PUID)
	public function get_all_students()
	{
		// Get all current students
		$this->db->select('FirstName AS "First Name", LastName AS "Last Name", Email, Phone AS "Phone Number", Floor, Side, YearString AS "Year", IF(BanquetEligible, "True", "False") AS "Eligible for Banquet?", LastSemesterPoints AS "Last Semester Points", TotalEvents AS "Total Events", TotalPoints AS "Total Points"');
		$this->db->join('phoenix_year_conversion', 'phoenix_students.Year = phoenix_year_conversion.YearNumber');
		$this->db->order_by('LastName');
		$query = $this->db->get('phoenix_students');
		return $query;
	}

	// Return query of banquet-eligible students (excluding PUID)
	public function get_banquet_students()
	{
		$this->load->helper('student');
		banquet_check();
		
		// Get all current students
		$this->db->select('FirstName AS "First Name", LastName AS "Last Name", Email, Phone AS "Phone Number", Floor, Side, YearString AS "Year", IF(BanquetEligible, "True", "False") AS "Eligible for Banquet?", LastSemesterPoints AS "Last Semester Points", TotalEvents AS "Total Events", TotalPoints AS "Total Points"');
		$this->db->join('phoenix_year_conversion', 'phoenix_students.Year = phoenix_year_conversion.YearNumber');
		$this->db->order_by('LastName');
		$this->db->where('BanquetEligible', 1);
		$query = $this->db->get('phoenix_students');
		return $query;
	}

	// Return query of all events
	public function get_all_events()
	{
		$this->db->select('Id, Title, PointValue AS "Points", DateCreated AS "Date Opened", TotalStudents AS "Total Students", "IsOpen" AS "Open?"');
		$this->db->order_by('DateCreated', 'desc');
		$this->db->where('IsCurrentYear', 1);
		$query = $this->db->get('phoenix_events');
		return $query;
	}

	// Return query of students for a specified event
	public function get_students_for_event($id)
	{
		$this->db->select('FirstName AS "First Name", LastName AS "Last Name", Email, Phone AS "Phone Number", Floor, Side, YearString AS "Year", IF(BanquetEligible, "True", "False") AS "Eligible for Banquet?", LastSemesterPoints AS "Last Semester Points", TotalEvents AS "Total Events", TotalPoints AS "Total Points"');
		$this->db->join('phoenix_records', 'phoenix_records.PUID = phoenix_students.PUID');
		$this->db->join('phoenix_year_conversion', 'phoenix_students.Year = phoenix_year_conversion.YearNumber');
		$this->db->where('phoenix_records.EventId', $id);
		$this->db->order_by('LastName');
		$query = $this->db->get('phoenix_students');
		return $query;
	}
}
