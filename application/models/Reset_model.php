<?php
class Reset_model extends CI_Model {

	// Load database
	public function __construct()
	{
		$this->load->database();
	}

	// Reset all floor points
	public function reset_floors()
	{
		$this->load->helper('url');

		// Get the password from the post
		$password = $this->input->post('Password');

		// Check that the password matches
		$this->db->where('Variable', 'ResetFloorsKey');
		$this->db->where('Value', $password);
		$query = $this->db->get('phoenix_globals');
		$row = $query->row(0);

		// Return error (-1) if password is incorrect
		if (! is_object($row))
		{
			return -1;
		}

		// Set all floors to zero points
		$this->db->where('PUID !=', 'NULL');
		$this->db->delete('phoenix_students');

		$sql = 'UPDATE phoenix_floors SET TotalPoints=0 WHERE (Floor Is Not Null);';
		log_message('debug', 'db sql: '.$sql);
		$this->db->query($sql);

		// Success
		return 0;
	}

	// Set all students' points to zero and record which students are eligible for the banquet
	public function reset_semester()
	{
		$BANQUET_MIN = 5;

		$this->load->helper('url');

		// Get the password from the post
		$password = $this->input->post('Password');

		// Check that the password matches
		$this->db->where('Variable', 'ResetSemesterKey');
		$this->db->where('Value', $password);
		$query = $this->db->get('phoenix_globals');
		$row = $query->row(0);

		// Return error (-1) if password is incorrect
		if (! is_object($row))
		{
			return -1;
		}

		// Set BanquetEligible
		$sql = 'UPDATE phoenix_students SET BanquetEligible=1 WHERE (BanquetEligible=0 AND TotalPoints>'.$BANQUET_MIN.')';
		log_message('debug', 'db sql: '.$sql);
		$this->db->query($sql);

		// Set TotalEvents/TotalPoints to 0 for students
		$sql = 'UPDATE phoenix_students SET TotalEvents=0, TotalPoints=0';
		log_message('debug', 'db sql: '.$sql);
		$this->db->query($sql);

		// Reset floor points
		$sql = 'UPDATE phoenix_floors SET TotalPoints=0';
		log_message('debug', 'db sql: '.$sql);
		$this->db->query($sql);

		// Success
		return 0;
	}

	// Archive all events and wipe student data for upcoming school year
	public function reset_year()
	{
		$this->load->helper('url');

		// Get the password from the post
		$password = $this->input->post('Password');

		// Check that the password matches
		$this->db->where('Variable', 'ResetYearKey');
		$this->db->where('Value', $password);
		$query = $this->db->get('phoenix_globals');
		$row = $query->row(0);

		// Return error (-1) if password is incorrect
		if (! is_object($row))
		{
			return -1;
		}

		// Archive all current events
		// Set sql statement
		$now = new DateTime(null, new DateTimeZone('America/New_York'));
		$time = $now->format('Y-m-d H:i:s'); // MySQL datetime format
		$sql = 'UPDATE phoenix_events SET IsCurrentYear=0, DateArchived="'.$time.'", IsOpen=0 WHERE IsCurrentYear=1';
		log_message('debug', 'db sql: '.$sql);
		$this->db->query($sql);

		// Delete all students
		$this->db->where('PUID !=', 'NULL');
		$this->db->delete('phoenix_students');

		// Success
		return 0;
	}
}