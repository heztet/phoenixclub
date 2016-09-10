<?php
class Rollcall extends CI_Controller {
	// Construct controller
	public function __construct()
	{
		parent::__construct();
		$this->load->model('rollcall_model');
		$this->load->helper('url_helper');
	}

	public function index()
	{
		// Helpers
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['title'] = 'Rollcall';

		try 
		{
			// Check that password is filled out
			$this->form_validation->set_rules('Password', 'Password', 'required');

			// Reset tables if validation succeeds
			if ($this->form_validation->run() === TRUE)
			{
				// Reset
				$result = $this->rollcall_model->record_rollcall();

				// Add success/failure modal to $data
				if ($result == 0)
				{
					$data['rollSuccess'] = 1;
					$data['rollFailure'] = 0;
				}
				else {
					$data['rollSuccess'] = 0;
					$data['rollFailure'] = 1;
				}
			}
			// No success/failure 
			else
			{
				$data['rollSuccess'] = 0;
				$data['rollFailure'] = 0;
			}
		}
		catch (Exception $e)
		{
			log_message('error', 'Rollcall failure exception: '.$e->getMessage());
			$data['rollSuccess'] = 0;
			$data['rollFailure'] = 1;
		}

		$this->load->view('templates/header', $data);
		$this->load->view('rollcall/index', $data);
		$this->load->view('templates/footer', $data);
	}

}