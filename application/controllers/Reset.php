<?php
class Reset extends CI_Controller {

	// Construct controller
	public function __construct()
	{
		parent::__construct();
		$this->load->model('reset_model');
		$this->load->helper('url');
		$this->load->helper('authit');
		$this->load->helper('alerts');
	}

	// Return all events
	public function index()
	{
		require_login(uri_string());
        $data['username'] = username();
		$data['title'] = "Reset Tools";

		$data['alert'] = get_alert();
		$this->load->view('templates/header', $data);
		$this->load->view('reset/index', $data);
		$this->load->view('templates/footer', $data);
	}

	// Reset point values
	public function floors()
	{
		require_login(uri_string());
        $data['username'] = username();		
		
		try 
		{
			// Reset
			$result = $this->reset_model->reset_floors();

			// Add success/failure modal to $data
			if ($result == 0)
			{
				set_alert('success', 'Floors points reset');
			}
			else {
				set_alert('danger', 'There was a problem resetting floor points');
			}
		}
		catch (Exception $e)
		{
			log_message('error', 'Reset failure: '.$e->getMessage());
		}

		// Go back to index
		redirect('reset');
	}

	// Reset semester points
	public function semester()
	{
		require_login(uri_string());
        $data['username'] = username();
        $data['title'] = 'Reset semester';

		try
		{
			// Reset
			$result = $this->reset_model->reset_semester();

			// Add success/failure modal to $data
			if ($result == 0)
			{
				set_alert('success', 'Reset for the semester');
			}
			else
			{
				set_alert('danger', 'There was a problem resetting for the semester');
			}
		}
		catch (Exception $e)
		{
			log_message('error', 'Reset failure: '.$e->getMessage());
		}

		// Go back to index
		redirect('reset');
	}

	// Reset year points/students
	public function year()
	{
		require_login(uri_string());
        $data['username'] = username();
		$data['title'] = "Reset Year";
		
		try 
		{
			// Reset
			$result = $this->reset_model->reset_year();

			// Add success/failure modal to $data
			if ($result == 0)
			{
				set_alert('success', 'Reset for the year');
			}
			else {
				set_alert('danger', 'There was a problem resetting for the year');
			}
		}
		catch (Exception $e)
		{
			log_message('error', 'Reset failure: '.$e->getMessage());
		}

		// Go back to index
		redirect('reset');
	}
}
