<?php
class Students extends CI_Controller {

	// Construct controller
	public function __construct()
	{
		parent::__construct();
		$this->load->model('students_model');
		$this->load->helper('url');
		$this->load->helper('authit');
	}

	// List all students
	public function index($success = NULL, $message = NULL)
	{
		require_login();
		$data['username'] = username();

		$data['title'] = 'Students';
		$data['students'] = $this->students_model->get_students();

		if ($success != NULL)
		{
			$data['success'] = $success;
		}
		if ($message != NULL)
		{
			$data['message'] = $message;
		}
		//echo print_r($data['students']);

		$this->load->view('templates/header', $data);
		$this->load->view('students/index', $data);
		$this->load->view('templates/footer', $data);
	}

	// Create a student with the given PUID and an optional eventId they checked into
	public function create($puid = NULL, $eventId = NULL)
	{
		require_login();
        $data['username'] = username();
		
		// Helpers
		$this->load->helper('puid');
		$this->load->helper('student');
		$this->load->helper('form');
		$this->load->library('form_validation');

		$cleanPuid = format_puid($puid);
		$alreadyStudent = student_exists($cleanPuid); 

		// Display error if PUID is invalid or student already exists
		if ($cleanPuid == '-1')
		{
			show_error('This PUID is invalid');
		}
		else if ($alreadyStudent)
		{
			show_error('This student has already been added');
		}

		$data['title'] = 'Create student';
		$data['puid'] = $cleanPuid;
		
		// Set totals to 0 if they don't exist
		if (empty($data['Totals']))
		{
			$data['Totals'] = array(
				'Events' => 0,
				'Points' =>0
				);
		}

		// Validate inputs (Note: total events/points are handled in create_student)
		$this->form_validation->set_rules('PUID', 'PUID', 'required');
		$this->form_validation->set_rules('FirstName', 'First name', 'required');
		$this->form_validation->set_rules('LastName', 'Last name', 'required');
		$this->form_validation->set_rules('Email', 'Email', 'valid_email');
		$this->form_validation->set_rules('Year', 'Year', 'required');
		$this->form_validation->set_rules('Floor', 'Floor', 'required');
		$this->form_validation->set_rules('Side', 'Side', 'required|greater_than[-1]|less_than[3]');

		// Create student if validation succeeds
		if (($this->form_validation->run() === TRUE) and ($cleanPuid != '-1'))
		{
			$this->students_model->create_student($eventId);

			// Redirect to event checkin if id is given
			if ($eventId != NULL)
			{
				$data = [];
				$data['AddedStudent'] = 1;
				redirect('/events/add/'.$eventId.'/1');
			}
			// Else redirect to home page
			else
			{
				$data = [];
				$data['AddedStudent'] = 0;
				redirect('/');
			}
		}
		
		// Create view form URL
		$data['formUrl'] = 'students/create/';
		$data['formUrl'] = $data['formUrl'].$cleanPuid;
		if ($eventId != NULL)
		{
			$data['formUrl'] = $data['formUrl'].'/'.$eventId;
		}

		// Display student create form
		$this->load->view('templates/header', $data);
		$this->load->view('students/create', $data);
		$this->load->view('templates/footer', $data);
	}
}