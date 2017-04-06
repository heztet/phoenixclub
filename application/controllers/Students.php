<?php
class Students extends CI_Controller {

	// Construct controller
	public function __construct()
	{
		parent::__construct();
		$this->load->model('students_model');
		$this->load->helper('url');
		$this->load->helper('authit');
		$this->load->helper('alerts');
	}

	// List all students
	public function index()
	{
		require_login(uri_string());
		$data['username'] = username();
		$data['title'] = 'Students';

		$data['students'] = $this->students_model->get_students();

		$data['alert'] = get_alert();
		$this->load->view('templates/header', $data);
		$this->load->view('students/index', $data);
		$this->load->view('templates/footer', $data);
	}


	// Create a student with the given PUID and an optional eventId they checked into
	public function create($puid = NULL, $eventId = NULL)
	{
		require_login(uri_string());
        $data['username'] = username();
        $data['title'] = 'Create student';
		
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
		$this->form_validation->set_rules('PUID', 'PUID', 'required',
										  array('required' => 'You must have a %s'));
		$this->form_validation->set_rules('FirstName', 'first name', 'trim|required',
										  array('required' => 'You must have a %s'));
		$this->form_validation->set_rules('LastName', 'last name', 'trim|required',
										  array('required' => 'You must have a %s'));
		$this->form_validation->set_rules('Email', 'email address', 'trim|valid_email',
										  array('required' => 'You must have an %s'));
		$this->form_validation->set_rules('Phone', 'phone number', 'required|regex_match[/^[0-9]{10}$/]', // 10 digit number
										  array('required' => 'You must have a %s',
										  	    'regex_match' => 'Phone number must be a 10 digit number (no hyphens, spaces, or parentheses)')); 
		$this->form_validation->set_rules('Year', 'year', 'required',
										  array('required' => 'You must have a %s'));
		$this->form_validation->set_rules('Floor', 'floor', 'required',
										  array('required' => 'You must have a %s'));
		$this->form_validation->set_rules('Side', 'side', 'required|greater_than[-1]|less_than[3]',
										  array('required' => 'You must have a %s'));

		// Create student if validation succeeds
		if (($this->form_validation->run() === TRUE) and ($cleanPuid != '-1'))
		{
			$this->students_model->create_student($eventId);
			
			// Redirect to event checkin if id is given
			if ($eventId != NULL)
			{
				set_alert('success', 'Student created successfully and added to event');
				redirect('/events/add/'.$eventId);
			}
			// Else redirect to home page
			else
			{
				set_alert('success', 'Student created successfully');
				redirect('students');
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
		$data['alert'] = get_alert();
		$this->load->view('templates/header', $data);
		$this->load->view('students/create', $data);
		$this->load->view('templates/footer', $data);
	}
}