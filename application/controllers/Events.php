<?php
class Events extends CI_Controller {

	// Construct controller
	public function __construct()
	{
		parent::__construct();
		$this->load->model('events_model');
		$this->load->helper('url_helper');
	}

	// Return all events
	public function index()
	{
		//$this->output->enable_profiler(TRUE);
		$data['events'] = $this->events_model->get_events();
		$data['title'] = 'Events list';

		$this->load->view('templates/header', $data);
		$this->load->view('events/index', $data);
		$this->load->view('templates/footer', $data);
	}

	// Return specific event
	public function view($Id = NULL)
	{

		$data['events_item'] = $this->events_model->get_events($Id);

		if (empty($data['events_item']))
		{
			show_404();
		}

		$data['Title'] = $data['events_item']['Title'];
		$data['events_item']['EventId'] = $Id;

		$this->load->view('templates/header', $data);
		$this->load->view('events/view', $data);
		$this->load->view('templates/footer', $data);
	}

	// Create event
	public function create()
	{
		// Helpers
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['title'] = "Create event";

		// Validate inputs
		$this->form_validation->set_rules('Title', 'Title', 'required');
		$this->form_validation->set_rules('PointValue', 'Points', 'required');

		// Return create view if inputs are invalid
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);
			$this->load->view('events/create');
			$this->load->view('templates/footer');
		}
		// Load new event view
		else
		{
			$result = $this->events_model->set_event();
			$this->view($Id = $result);
		}
	}

	// Add student to event
	public function add($Id = NULL)
	{
		$this->output->enable_profiler(TRUE);
		// Helpers
		$this->load->helper('form');
		$this->load->helper('puid_helper');
		$this->load->helper('student_helper');
		$this->load->library('form_validation');

		// Get event from id
		$data['events_item'] = $this->events_model->get_events($Id);

		// 404 if id not found
		if (empty($data['events_item']))
		{
			show_404();
		}

		$data['title'] = 'Add student to '.$data['events_item']['Title'];
		$data['EventId'] = $Id;

		// Clean PUID input (if it exists)
		if (($this->input->post('PUID')) != NULL)
		{
			$cleanPUID = format_puid($this->input->post('PUID'));
		}
		else
		{
			$cleanPUID = '';
		}

		// Validate inputs
		$this->form_validation->set_rules('EventId', 'Event', 'required');
		$this->form_validation->set_rules('PUID', 'Student ID', 'required');

		// Student view is not loaded by default
		$studentView = FALSE;

		// Add student to records if validation succeeds
		if (($this->form_validation->run() === TRUE) and ($cleanPUID != '-1'))
		{
			$this->events_model->set_student($cleanPUID);

			// Check if student already exists
			$studentView = student_exists($cleanPUID);

			// Clear input data and recover event data
			$data = [];
			$data['events_item'] = $this->events_model->get_events($Id);
			$data['title'] = 'Add student to '.$data['events_item']['Title'];
			$data['EventId'] = $Id;
		}
		// Checks that the input PUID has been submitted and is invalid
		else if ($cleanPUID == '-1')
		{
			echo 'PUID Error!';
		}

		// Loads the add view (for the event) or the add view (for the student)
		if ($studentView) {
			// TODO: load the student view
		}
		else
		{
			$this->load->view('templates/header', $data);
			$this->load->view('events/add', $data);
			$this->load->view('templates/footer');
		}
	}
}