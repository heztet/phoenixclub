<?php
class Admin extends CI_Controller {

	// Construct controller
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->helper('url_helper');
	}

	// Return all events
	public function index()
	{
		$data['title'] = "Admin";
		
		$this->load->view('templates/header', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer', $data);
	}

	// Archive all events and wipe students to start a new year
	public function reset()
	{
		// Helpers
		$this->load->helper('form');
		$this->load->library('form_validation');

		// Check that password is filled out
		$this->form_validation->set_rules('Password', 'Password', 'required');

		// Reset tables if validation succeeds
		if (($this->form_validation->run() === TRUE) and ($cleanPuid != '-1'))
		{
			// Reset
			$result = $this->admin_model->reset_tables();

			// Add success/failure modal to $data
			if ($result == 0)
			{
				$data['resetSuccess'] = 1;
			}
			else {
				$data['resetFailure'] = 0;
			}
		}
		// No success/failure 
		else
		{
			$data['resetSuccess'] = 0;
			$data['resetFailure'] = 0;
		}

		// Display the admin index again
		$this->load->view('templates/header', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer', $data);
	}
}
