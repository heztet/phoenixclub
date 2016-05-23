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
		$this->output->enable_profiler(TRUE);
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
		// Helpers
		$this->load->helper('form');
		$this->load->helper('puid_helper');
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

		// Validate inputs
		$this->form_validation->set_rules('EventId', 'Event', 'required');
		$this->form_validation->set_rules('PUID', 'Student ID', 'required');

		// Return the add view if inputs are invalid
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);
			$this->load->view('events/add', $data);
			$this->load->view('templates/footer');
		}
		// Add student and reload the add view
		else 
		{
			$this->events_model->set_student();
			$this->add($Id = $Id);
		}

		// 
	}
}