<?php
class Reset extends CI_Controller {

	// Construct controller
	public function __construct()
	{
		parent::__construct();
		$this->load->model('reset_model');
		$this->load->helper('url');
		$this->load->helper('authit');
	}

	// Return all events
	public function index($success = NULL)
	{
		require_login();
        $data['username'] = username();

		$data['title'] = "Reset Tools";

		if ((!is_null($success)) and ($success))
		{
			$data['resetSuccess'] = 1;
			$data['resetFailure'] = 0;
		}
		elseif ((!is_null($success)) and (!$success))
		{
			$data['resetSuccess'] = 0;
			$data['resetFailure'] = 1;			
		}

		$this->load->view('templates/header', $data);
		$this->load->view('reset/index', $data);
		$this->load->view('templates/footer', $data);
	}

	// Reset point values
	public function floors()
	{
		require_login();
        $data['username'] = username();		
		
		try 
		{
			// Reset
			$result = $this->reset_model->reset_floors();

			// Add success/failure modal to $data
			if ($result == 0)
			{
				$success = TRUE;
			}
			else {
				$success = FALSE;
			}
		}
		catch (Exception $e)
		{
			log_message('error', 'Reset failure: '.$e->getMessage());
			$success = FALSE;
		}

		// Go back to index
		redirect('reset/index/'.$success);
	}

	// Reset semester points
	public function semester()
	{
		require_login();
        $data['username'] = username();

		try
		{
			// Reset
			$result = $this->reset_model->reset_semester();

			// Add success/failure modal to $data
			if ($result == 0)
			{
				$success = TRUE;
			}
			else
			{
				$success = FALSE;
			}
		}
		catch (Exception $e)
		{
			log_message('error', 'Reset failure: '.$e->getMessage());
			$success = FALSE;
		}

		// Go back to index
		redirect('reset/index/'.$success);
	}

	// Reset year points/students
	public function year()
	{
		require_login();
        $data['username'] = username();
		
		$data['title'] = "Reset Year";
		
		try 
		{
			// Reset
			$result = $this->reset_model->reset_year();

			// Add success/failure modal to $data
			if ($result == 0)
			{
				$success = TRUE;
			}
			else {
				$success = FALSE;
			}
		}
		catch (Exception $e)
		{
			log_message('error', 'Reset failure: '.$e->getMessage());
			$success = FALSE;
		}

		// Go back to index
		redirect('reset/index/'.$success);
	}
}
