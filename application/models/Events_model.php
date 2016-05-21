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
			$this->db->order_by("DateCreated", "desc");
			$query = $this->db->get('phoenix_events');
			return $query->result_array();
		}

		$this->db->order_by("DateCreated", "desc");
		$this->db->where('Id', $Id);
		$query = $this->db->get('phoenix_events');
		return $query->row_array();
	}

	// Write new event to database
	public function set_event()
	{
		$this->load->helper('url');

		// Set up row data and insert into events table
		$data = array(
			'Title' => $this->input->post('Title')
			);
		$this->db->insert('phoenix_events', $data);

		// Get Id in events table
		$this->db->order_by('Id', 'desc');
		$query = $this->db->get('phoenix_events');
		$row = $query->row(0); // Get first row

		// Update current event table with foreign key
		$data = array(
			'ForeignEventId' => $row->Id
			);
		$this->db->where('Id', 1);
		return $this->db->update('phoenix_current_event', $data);
	}
}