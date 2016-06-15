<?php
class Students_model extends CI_Model {

	// Load database
	public function __construct()
	{
		$this->load->database();
	}

	// Return either all students or specific student (if PUID is given)
	public function get_students($puid = FALSE)
	{
		if ($puid == FALSE)
		{
			$this->db->order_by('LastName');
			$query = $this->db->get('phoenix_students');
			return $query->result_array();
		}

		$this->db->order_by('DateCreated', 'desc');
		$this->db->where('PUID', $puid);
		$query = $this->db->get('phoenix_students');
		return $query->row_array();
	}

	// Add student to student table
	public function create_student($eventId = NULL)
	{
		// Helpers
		$this->load->helper('url');
		$this->load->helper('puid_helper');

		// Get all post inputs
		$puid = format_puid($this->input->post('PUID'));

		$FirstName = $this->input->post('FirstName');
		$LastName = $this->input->post('LastName');
		$Year = $this->input->post('Year');
		$Floor = $this->input->post('Floor');
		$SideNum = $this->input->post('Side');
		switch ($SideNum)
		{
			case 1:
				$Side = 'E';
				break;
			case 2:
				$Side = 'W';
				break;
			default:
				$Side = 'X';
		}
		
		// Combine floor and side
		$FloorStr = $Floor.$Side;

		// Set totals to 0 if not in post
		if (empty($this->input->post('TotalEvents')))
		{
			$TotalEvents = 0;
		}
		if (empty($this->input->post('TotalPoints')))
		{
			$TotalPoints = 0;
		}

		// Update totals (for when the student is created during event checkin)
		// if event exists
		if ($eventId != NULL)
		{
			$TotalEvents = $TotalEvents + 1;

			// Get this event's point value (if it exists)
			$this->db->order_by('DateCreated', 'desc');
			$this->db->where('Id', $eventId);
			$query = $this->db->get('phoenix_events');
			$event = $query->row(0);

			$TotalPoints = $TotalPoints + $event->PointValue;
		}

		// Insert student into students table
		$data = array(
			'PUID' => $puid,
			'FirstName' => $FirstName,
			'LastName' => $LastName,
			'Floor' => $FloorStr,
			'Year' => $Year,
			'TotalEvents' => $TotalEvents,
			'TotalPoints' => $TotalPoints
			);
		$this->db->insert('phoenix_students', $data);
	}
}