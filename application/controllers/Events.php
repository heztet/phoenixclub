<?php
class Events extends CI_Controller {

	// Construct controller
	public function __construct()
	{
		parent::__construct();
		$this->load->model('events_model');
		$this->load->helper('url');
		$this->load->helper('authit');
		$this->load->helper('alerts');
	}

	// Return all events
	public function index()
	{
		require_login(uri_string());
		$data['username'] = username();
		$data['title'] = 'Events';

		$data['events'] = $this->events_model->get_events();

		$data['alert'] = get_alert();
		$this->load->view('templates/header', $data);
		$this->load->view('events/index', $data);
		$this->load->view('templates/footer', $data);
	}

	// Return specific event
	public function view($Id = NULL)
	{
		require_login(uri_string());
		$data['username'] = username();
		$data['title'] = 'View event';

		// Check that the event exists
		$data['events_item'] = $this->events_model->get_events($Id);
		if (empty($data['events_item']))
		{
			show_404();
		}

		// Populate view data with event
		$data['title'] = $data['title'].': '.$data['events_item']['Title'];
		$data['events_item']['EventId'] = $Id;
		$data['events_item']['redirectLink'] = 'events/add/'.$Id;

		// Load students
		$this->load->model('students_model');
		$data['students'] = $this->students_model->get_students_for_event($Id);

		$data['alert'] = get_alert();
		$this->load->view('templates/header', $data);
		$this->load->view('events/view', $data);
		$this->load->view('templates/footer', $data);
	}

	// Create event
	public function create()
	{
		require_login(uri_string());
		$data['username'] = username();
		$data['title'] = 'Create an event';

		// Helpers
		$this->load->helper('form');
		$this->load->library('form_validation');

		// Validate inputs
		$this->form_validation->set_rules('Title', 'Title', 
										  'required|trim|max_length[60]',
										  array('required' => 'You need to have a %s for the event'),
										  array('max_length' => '%s can only be 60 characters or less'),
										  array('is_unique' => 'There\'s already an event with that %s')
										  );
		$this->form_validation->set_rules('PointValue', 'Points',
										  'required|greater_than[-1]|less_than[15]',
										  array('required' => 'You need to have a point value for the event'),
										  array('greater_than' => '%s must be greater than -1'),
										  array('less_than' => '%s must be less than 15')
										  );

		// Create and load new event view if inputs are valid
		if ($this->form_validation->run() === TRUE)
		{
			$event_id = $this->events_model->set_event();
			set_alert('success', 'Event created successfully');
			redirect('events/view/'.$event_id);
		}

		$data['alert'] = get_alert();
		$this->load->view('templates/header', $data);
		$this->load->view('events/create', $data);
		$this->load->view('templates/footer', $data);
	}

	// Add student to event
	public function add($Id = NULL)
	{
		require_login(uri_string());
		$data['username'] = username();
		$data['title'] = 'Add students to event';

		// Helpers
		$this->load->helper('form');
		$this->load->helper('puid');
		$this->load->helper('student');
		$this->load->library('form_validation');

		// Check that event exists
		$data['events_item'] = $this->events_model->get_events($Id);
		if (empty($data['events_item']))
		{
			show_404();
		}
		// Check that event isn't closed
		else if ($data['events_item']['IsOpen'] == 0)
		{
			show_error("This event is closed");
		}

		$data['title'] = $data['title'].': '.$data['events_item']['Title'];
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
		$this->form_validation->set_rules('EventId', 'Event', 'required',
										  array('required' => 'There was an error adding students. Please try again.'));
		$this->form_validation->set_rules('PUID', 'Student ID', 'required',
			                              array('required' => 'You must include a PUID'));
		$this->form_validation->set_rules('PointValue', 'Points', 'required',
										  array('required' => 'There was an error adding students. Please try again.'));

		// Student view is not loaded by default
		$alreadyStudent = FALSE;

		// Add student to records if validation succeeds
		if (($this->form_validation->run() === TRUE) and ($cleanPUID != '-1'))
		{
			// Add student and record totals
			$totals = $this->events_model->set_student($cleanPUID);

			// Error out if student has already been added
			if ($totals == -1)
			{
				set_alert('danger', 'That student has already been added to this event');
				redirect(uri_string());
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
				set_alert('success', 'Student added successfully');
				redirect(uri_string());
			}	
		}
		// Checks that the input PUID has been submitted and is invalid
		else if ($cleanPUID == '-1')
		{
			set_alert('danger', 'Invalid PUID');
			redirect(uri_string());
		}

		$data['alert'] = get_alert();
		$this->load->view('templates/header', $data);
		$this->load->view('events/add', $data);
		$this->load->view('templates/footer', $data);
	}

	// Close an event to checking in
	public function close($Id = NULL)
	{
		require_login(uri_string());
		$data['username'] = username();

		// Check that event exists and is open
		$data['events_item'] = $this->events_model->get_events($Id);		

		// 404 if id not found
		if (empty($data['events_item']))
		{
			show_404();
		}
		
		// Set messgae if event is closed
		if ($data['events_item']['IsOpen'] == 0)
		{
			set_alert('warning', 'That event is already closed');
		}
		// Close event
		else
		{
			// Close event
			$success = $this->events_model->close_event($Id);

			if ($success)
			{
				set_alert('success', 'Event closed successfully');
			}
			else
			{
				set_alert('danger', 'Error: the event could not be closed');
			}
		}

		redirect('events');
	}

	/* Archiving from the controller should no longer be necessary
	// Archive all events (set IsCurrentYear to FALSE)
	public function archive()
	{
		require_login(uri_string());
		$data['username'] = username();
		
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
	*/
}