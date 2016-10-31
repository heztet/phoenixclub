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
		// Helpers
		$this->load->helper('puid_helper');

		$puid = format_puid($puid);

		// Return -1 for invalid puid
		if ($puid == -1)
		{
			return -1;
		}

		if ($puid == FALSE)
		{
			$this->db->order_by('LastName');
			$query = $this->db->get('phoenix_students');
			return $query->result_array();
		}

		$this->db->order_by('DateCreated', 'desc');
		$this->db->where('PUID', $puid);
		$query = $this->db->get('phoenix_students');
		$students = $query->row_array();

		// Add year string to each student
		$students = $this->append_year_string($students);
		
		return $students;
	}

	// Add student to student table
	public function create_student($eventId = NULL)
	{
		// Helpers
		$this->load->helper('url');
		$this->load->helper('puid_helper');
		$this->load->helper('form');

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
				$Side = 'Err';
		}

		// Set totals to 0 if not in post
		if (! ($this->input->post('TotalEvents')))
		{
			$TotalEvents = 0;
			$FloorDelta = 0;
		}
		if (! ($this->input->post('TotalPoints')))
		{
			$TotalPoints = 0;
			$FloorDelta = 0;
		}

		// Update student point totals and event's totals if event exists
		// (for when the student is created during event checkin)
		if ($eventId != NULL)
		{
			$TotalEvents = $TotalEvents + 1;

			// Get this event
			$this->db->order_by('DateCreated', 'desc');
			$this->db->where('Id', $eventId);
			$query = $this->db->get('phoenix_events');
			$event = $query->row(0);

			// Calculate student's points
			$TotalPoints = $TotalPoints + $event->PointValue;

			$FloorDelta = $event->PointValue;
		}

		// Insert student into students table
		$data = array(
			'PUID' => $puid,
			'FirstName' => $FirstName,
			'LastName' => $LastName,
			'Floor' => $Floor,
			'Side' => $Side,
			'Year' => $Year,
			'TotalEvents' => $TotalEvents,
			'TotalPoints' => $TotalPoints
			);
		$this->db->insert('phoenix_students', $data);

		// Get floor points
		$floorString = $Floor.$Side;
		$this->db->where('Floor', $floorString);
		$query = $this->db->get('phoenix_floors');
		$floor = $query->row(0);
		$floorPoints = $floor->TotalPoints;

		// Update floor points
		$data = array(
			'TotalPoints' => $floorPoints + $FloorDelta
			);
		$this->db->where('Floor', $floorString);
		$this->db->update('phoenix_floors', $data);
	}

	// Adds each student's year as a string
	// If the argument is called $arr, the YearString is called as $arr[x][0]['YearString']
	public function append_year_string($studentArr = array())
	{
		$newArr = array();

		// Check if only one student
		if (! empty($studentArr['PUID']))
		{
			// Copy the input student
			$newArr = $studentArr;
			$yearInt = $studentArr['Year'];

			switch ($yearInt)
			{
				case 1:
					$yearStr = 'Freshman';
					break;
				case 2:
					$yearStr = 'Sophomore';
					break;
				case 3:
					$yearStr = 'Junior';
					break;
				case 4:
					$yearStr = 'Senior';
					break;
				default:
					$yearStr = '#Error#';
			}

			$yearArr = array('YearString' => $yearStr);

			// Append to the student's array copy
			array_push($newArr, $yearArr);
		}
		// Otherwise loop through all students
		else
		{
			foreach ($studentArr as $student)
			{

				// Get year int/string
				$yearInt = $student['Year'];

				switch ($yearInt)
				{
					case 1:
						$yearStr = 'Freshman';
						break;
					case 2:
						$yearStr = 'Sophomore';
						break;
					case 3:
						$yearStr = 'Junior';
						break;
					case 4:
						$yearStr = 'Senior';
						break;
					default:
						$yearStr = '#Error#';
				}

				$yearArr = array('YearString' => $yearStr);

				// Append to the student's array
				array_push($student, $yearArr);
				// Append to overall array
				array_push($newArr, $student);
			}
		}
		
		return $newArr;
	}

	// Archive all current students
	public function archive_students()
	{
		// Get current time
		// Timestamp is in NewYork time
		$now = new DateTime(null, new DateTimeZone('America/New_York'));
		$time = $now->format('Y-m-d H:i:s'); // MySQL datetime format

		// Update students where IsCurrent = TRUE
		$data = array(
			'IsCurrent' => 0,
			'DateArchived' => $time
			);
		$this->db->where('IsCurrent', 1);
		$this->db->update('phoenix_students', $data);

		// Check that no students are current
		$this->db->where('IsCurrent', 1);
		$query = $this->db->get('phoenix_students');

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