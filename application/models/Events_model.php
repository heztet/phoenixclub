<?php
class Events_model extends CI_Model {

	// Load database
	public function __construct()
	{
		$this->load->database();
	}

	// Load current events from database
	// Return either all events or specific event (if Id exists)
	public function get_events($Id = FALSE)
	{
		if ($Id == FALSE)
		{
			$this->db->order_by("DateCreated", "desc");
			$this->db->where('IsCurrentYear', 1);
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
			// IsCurrentYear is TRUE by default
			// IsOpen is TRUE by default
			// DateCreated datetime is CURRENTTIME by default
			);
		$this->db->insert('phoenix_events', $data);

		// Get Id in events table
		$this->db->order_by('Id', 'desc');
		$query = $this->db->get('phoenix_events');
		$row = $query->row(0); // Get first row

		/*
		// Update current event table with foreign key
		$data = array(
			'ForeignEventId' => $row->Id
			);
		$this->db->where('Id', 1);
		$this->db->update('phoenix_current_event', $data);
		*/
		return $row->Id;
	}

	// Add student to event
	public function set_student($puid)
	{
		$this->load->helper('url');

		$eventId = $this->input->post('EventId');

		// Get the event's info
		$this->db->order_by('DateCreated', 'desc');
		$this->db->where('Id', $eventId);
		$this->db->where('IsOpen', 1);
		$query = $this->db->get('phoenix_events');
		$event = $query->row(0);
		$points = $event->PointValue;
		$totalStudents = $event->TotalStudents;

		// Check that student hasn't already been added to this event
		$this->db->order_by('Timestamp', 'desc');
		$this->db->where('PUID', $puid);
		$this->db->where('EventId', $eventId);
		$query = $this->db->get('phoenix_records');
		$record = $query->row(0);
		
		// Return -1 if student has already been added to this event
		if (is_object($record))
		{
			return -1;
		}

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
			'TotalStudents' => $totalStudents + 1,
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

	// Close an open event given an id
	// Returns 1 if successful, 0 if not
	public function close_event($id)
	{
		// Check that event exists
		$this->db->where('Id', $id);
		$this->db->where('IsOpen', 1);
		$query = $this->db->get('phoenix_events');
		$event = $query->row(0);

		if (empty($event))
		{
			return 0;
		}
		else
		{
			// Update event IsOpen to 0
			$data = array('IsOpen' => 0);
			$this->db->where('Id', $id);
			$this->db->update('phoenix_events', $data);

			// Check that event is closed
			$this->db->where('Id', $id);
			$this->db->where('IsOpen', 0);
			$query = $this->db->get('phoenix_events');
			$event = $query->row(0);

			if (empty($event))
			{
				return 0;
			}
			else
			{
				return 1;
			}
		}
	}

	// Get the number of current events
	public function amount_current_events()
	{
		$this->db->where('IsCurrentYear', 1);
		$query = $this->db->get('phoenix_events');
		$total = $query->num_rows();
		return $total;
	}

	// Get the sum of points for all current events
	public function amount_current_points()
	{
		$this->db->where('IsCurrentYear', 1);
		$query = $this->db->get('phoenix_events');
		$events = $query->result_array();

		// Sum point values
		$totalPoints = 0;
		foreach ($events as $e)
		{
			$totalPoints = $totalPoints + $e['PointValue'];
		}

		return $totalPoints;
	}

	// Archive all current events
	// Depreciated by resetting through admin/index
	public function archive_events()
	{
		// Get current time
		// Timestamp is in NewYork time
		$now = new DateTime(null, new DateTimeZone('America/New_York'));
		$time = $now->format('Y-m-d H:i:s'); // MySQL datetime format

		// Update events where IsCurrentYear = TRUE
		$data = array(
			'IsCurrentYear' => 0,
			'DateArchived' => $time
			);
		$this->db->where('IsCurrentYear', 1);
		$this->db->update('phoenix_events', $data);

		// Check that no events are current
		$this->db->where('IsCurrentYear', 1);
		$query = $this->db->get('phoenix_events');

		// Return whether query has any results
		if (empty($query))
		{
			return 0;
		}
		else
		{
			return 1;
		}
	}
}