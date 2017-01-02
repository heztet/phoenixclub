<?php
class Events extends CI_Controller {

	// Construct controller
	public function __construct()
	{
		parent::__construct();
		$this->load->model('events_model');
		$this->load->helper('url');
		$this->load->helper('authit');
	}

	// Return all events
	public function index($success = NULL, $message = NULL)
	{
		require_login();

		$data['events'] = $this->events_model->get_events();

		// Set title
		$currentYear = '2016-2017';
		$data['title'] = 'Events for '.$currentYear;

		// Message if exists
		if ($message != NULL)
		{
			$data['message'] = $message;
		}
		if ($success != NULL)
		{
			$data['success'] = $success;
		}

		$this->load->view('templates/header', $data);
		$this->load->view('events/index', $data);
		$this->load->view('templates/footer', $data);
	}

	// Return specific event
	public function view($Id = NULL)
	{
		require_login();

		$data['events_item'] = $this->events_model->get_events($Id);

		if (empty($data['events_item']))
		{
			show_404();
		}

		$data['Title'] = $data['events_item']['Title'];
		$data['events_item']['EventId'] = $Id;
		$data['events_item']['redirectLink'] = 'events/add/'.$Id;

		$this->load->view('templates/header', $data);
		$this->load->view('events/view', $data);
		$this->load->view('templates/footer', $data);
	}

	// Create event
	public function create()
	{
		require_login();

		// Helpers
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['title'] = "Create event";

		// Validate inputs
		$this->form_validation->set_rules('Title', 'Title', 
										  'required|max_length[60]|is_unique[phoenix_events.Title]',
										  array('required' => 'You need to have a %s'),
										  array('max_length' => '%s can only be 60 characters or less'),
										  array('is_unique' => 'There\'s already an event with that %s'));
		$this->form_validation->set_rules('PointValue', 'Points',
										  'required|greater_than[-1]|less_than[15]',
										  array('required' => 'You need to have a %s'));

		// Return create view if inputs are invalid
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);
			$this->load->view('events/create', $data);
			$this->load->view('templates/footer', $data);
		}
		// Load new event view
		else
		{
			$result = $this->events_model->set_event();
			$this->view($Id = $result);
		}
	}

	// Add student to event
	public function add($Id = NULL, $AddedStudent = NULL)
	{
		require_login();

		// Helpers
		$this->load->helper('form');
		$this->load->helper('puid');
		$this->load->helper('student');
		$this->load->library('form_validation');

		// Get event from id
		$data['events_item'] = $this->events_model->get_events($Id);

		// 404 if id not found
		if (empty($data['events_item']))
		{
			show_404();
		}
		// Error page if event is closed
		else if ($data['events_item']['IsOpen'] == 0)
		{
			show_error("This event is closed");
		}

		$data['title'] = $data['events_item']['Title'];
		$data['EventId'] = $Id;
		$data['CleanPuidError'] = 0;

		// Clean PUID input (if it exists)
		if (($this->input->post('PUID')) != NULL)
		{
			$cleanPUID = format_puid($this->input->post('PUID'));
		}
		else
		{
			$cleanPUID = ''; // No PUID given means load without an error
		}

		// Validate inputs
		$this->form_validation->set_rules('EventId', 'Event', 'required');
		$this->form_validation->set_rules('PUID', 'Student ID', 'required');
		$this->form_validation->set_rules('PointValue', 'Points', 'required');

		// Student view is not loaded by default
		$alreadyStudent = FALSE;

		// Did not add student by default
		$data['AddedStudent'] = 0;
		// Check for AddedStudent argument (redirect from create student)
		if (!is_null($AddedStudent) and ($AddedStudent == 1)) {
			$data['AddedStudent'] = 1;
		}

		// Add student to records if validation succeeds
		if (($this->form_validation->run() === TRUE) and ($cleanPUID != '-1'))
		{
			// Add student and record totals
			$totals = $this->events_model->set_student($cleanPUID);

			// Error out if student has already been added
			if ($totals == -1)
			{
				$data['AlreadyAddedError'] = 1;
			}
			else
			{
				// Check if student already exists
			$alreadyStudent = student_exists($cleanPUID);
			
			// Redirect to add student if student doesn't exist
			if (!$alreadyStudent)
			{
				$data = [];
				$data['Totals'] = $totals;
				redirect('./students/create/'.$cleanPUID.'/'.$Id, $data);
			}

			// Clear input data and recover event data
			$data = [];
			$data['events_item'] = $this->events_model->get_events($Id);
			$data['title'] = 'Add student to '.$data['events_item']['Title'];
			$data['EventId'] = $Id;
			$data['AddedStudent'] = 1;
			}	
		}
		// Checks that the input PUID has been submitted and is invalid
		else if ($cleanPUID == '-1')
		{
			$data['CleanPuidError'] = 1;
		}

		// Loads the add view for the event
		$this->load->view('templates/header', $data);
		$this->load->view('events/add', $data);
		$this->load->view('templates/footer', $data);
	}

	// Close an event to checking in
	public function close($Id = NULL)
	{
		require_login();

		// Check that event exists and is open
		$data['events_item'] = $this->events_model->get_events($Id);		

		// 404 if id not found
		if (empty($data['events_item']))
		{
			show_404();
		}
		// Set messgae if event is closed
		else if ($data['events_item']['IsOpen'] == 0)
		{
			$data['message'] = "This event is already closed";
			$data['success'] = -1;
		}
		// Close event
		else
		{
			$data['title'] = "Close event: ".$data['events_item']['Title'];

			// Close event
			$success = $this->events_model->close_event($Id);

			if ($success)
			{
				$data['message'] = "Event was closed successfully";
				$data['success'] = 1;
			}
			else
			{
				$data['message'] = "There was an issue with closing the event. Please try again.";
				$data['success'] = 0;
			}
		}

		// Load index with message/success
		$this->index($data['success'], $data['message']);
	}

	// Archive all events (set IsCurrentYear to FALSE)
	public function archive()
	{
		require_login();
		
		// Archive
		$success = $this->events_model->archive_events();

		// Set success message
		if ($success)
		{
			$message = "Events were archived successfully";
		}
		else
		{
			$message = "Events could not be archived";
		}

		// Load events index
		// Loads the add view for the event
		$this->index($success, $message);
	}
}