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
			'Title' => $this->input->post('Title'),
			'PointValue' => $this->input->post('PointValue')
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
		$this->db->update('phoenix_current_event', $data);
		return $row->Id;
	}

	// Add student to event
	public function set_student($puid)
	{
		$this->load->helper('url');

		// Get the event's info
		$eventId = $this->input->post('EventId');
		$this->db->order_by('DateCreated', 'desc');
		$this->db->where('Id', $eventId);
		$query = $this->db->get('phoenix_events');
		$event = $query->row(0);
		$points = $event->PointValue;
		$totalStudents = $event->TotalStudents;

		// Insert info into record table
		$data = array(
			'PUID' => $puid,
			'EventId' => $eventId,
			'PointDelta' => $points
			);
		$this->db->insert('phoenix_records', $data);

		// Get student totals
		$this->db->where('PUID', $puid);
		$query = $this->db->get('phoenix_students');
		$student = $query->row(0);
		// If student doesn't exist, record the first event (they'll be added later)
		if (is_object($student))
		{
			$totalEvents = $student->TotalEvents;
			$totalPoints = $student->TotalPoints;
		}
		else
		{
			$totalEvents = 0;
			$totalPoints = 0;
		}
		

		// Update student totals
		$data = array(
			'TotalEvents' => $totalEvents + 1,
			'TotalPoints' => $totalPoints + $points
			);
		$this->db->where('PUID', $puid);
		$this->db->update('phoenix_students', $data);

		// Update event totals
		$data = array(
			'TotalStudents' => $totalStudents + 1
			);
		$this->db->where('Id', $eventId);
		$this->db->update('phoenix_events', $data);

		// Return an array of the student's total events and points
		$totals = array(
			'Events' => $totalEvents,
			'Points' => $totalPoints
			);
		return $totals;
	}
}