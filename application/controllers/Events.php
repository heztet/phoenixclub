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
		try {
			$this->output->enable_profiler(TRUE);
			$data['events'] = $this->events_model->get_events();
			$data['title'] = 'Events list';

			$this->load->view('templates/header', $data);
			$this->load->view('events/index', $data);
			$this->load->view('templates/footer', $data);
		}
		catch(Exception $e) {
			show_error($e->getMessage());
		}
		
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

		$this->load->view('templates/header', $data);
		$this->load->view('events/view', $data);
		$this->load->view('templates/footer', $data);
	}
}