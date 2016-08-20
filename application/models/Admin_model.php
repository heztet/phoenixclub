<?php
class Events_model extends CI_Model {

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
		$password = format_puid($this->input->post('Password'));

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


		// Delete all students

		// Success
		return 0;
	}
}