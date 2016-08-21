<?php
class Admin_model extends CI_Model {

	// Load database
	public function __construct()
	{
		$this->load->database();
	}

	// Archive all events and wipe student data for upcoming school year
	public function reset_tables()
	{
		$this->load->helper('url');

		// Get the password from the post
		$password = $this->input->post('Password');

		// Check that the password matches
		$this->db->where('Variable', 'ResetKey');
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