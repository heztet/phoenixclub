<?php
class Events_model extends CI_Model {

	// Load database
	public function __construct()
	{
		$this->load->database();
	}

	// Load events from database
	// Return either all events or specific event (if Id exists)
	public function get_events($Id = FALSE)
	{
		if ($Id == FALSE)
		{
			$query = $this->db->get('phoenix_events');
			return $query->result_array();
		}

		$query = $this->db->get_where('phoenix_events', array('Id' => $Id));
		return $query->row_array();
	}
}