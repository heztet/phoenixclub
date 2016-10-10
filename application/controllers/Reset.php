<?php
class Reset extends CI_Controller {

	// Construct controller
	public function __construct()
	{
		parent::__construct();
		$this->load->model('reset_model');
		$this->load->helper('url_helper');
	}

	// Return all events
	public function index()
	{
		$this->load->view('templates/header', $data);
		$this->load->view('reset/index', $data);
		$this->load->view('templates/footer', $data);
	}

	public function year()
	{
		// Helpers
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$data['title'] = "Reset Year";
		
		try 
		{
			// Check that password is filled out
			$this->form_validation->set_rules('Password', 'Password', 'required');

			// Reset tables if validation succeeds
			if ($this->form_validation->run() === TRUE)
			{
				// Reset
				$result = $this->reset_model->reset_year();

				// Add success/failure modal to $data
				if ($result == 0)
				{
					$data['resetSuccess'] = 1;
					$data['resetFailure'] = 0;
				}
				else {
					$data['resetSuccess'] = 0;
					$data['resetFailure'] = 1;
				}
			}
			// No success/failure 
			else
			{
				$data['resetSuccess'] = 0;
				$data['resetFailure'] = 0;
			}
		}
		catch (Exception $e)
		{
			log_message('error', 'Reset failure exception: '.$e->getMessage());
			$data['resetSuccess'] = 0;
			$data['resetFailure'] = 1;
		}

		$this->load->view('templates/header', $data);
		$this->load->view('reset/year', $data);
		$this->load->view('templates/footer', $data);
	}

	public function semester()
	{
		// Helpers
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$data['title'] = "Reset Semester";
		
		try 
		{
			// Check that password is filled out
			$this->form_validation->set_rules('Password', 'Password', 'required');

			// Reset tables if validation succeeds
			if ($this->form_validation->run() === TRUE)
			{
				// Reset
				$result = $this->reset_model->reset_semester();

				// Add success/failure modal to $data
				if ($result == 0)
				{
					$data['resetSuccess'] = 1;
					$data['resetFailure'] = 0;
				}
				else {
					$data['resetSuccess'] = 0;
					$data['resetFailure'] = 1;
				}
			}
			// No success/failure 
			else
			{
				$data['resetSuccess'] = 0;
				$data['resetFailure'] = 0;
			}
		}
		catch (Exception $e)
		{
			log_message('error', 'Reset failure exception: '.$e->getMessage());
			$data['resetSuccess'] = 0;

			$data['resetFailure'] = 1;
		}
		$this->load->view('templates/header', $data);
		$this->load->view('reset/semester', $data);
		$this->load->view('templates/footer', $data);
	}
}
