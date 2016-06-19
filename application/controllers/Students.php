<?php
class Students extends CI_Controller {

	// Construct controller
	public function __construct()
	{
		parent::__construct();
		$this->load->model('students_model');
		$this->load->helper('url_helper');
	}

	// Return all students
	public function index()
	{
		// Get all students and format their year
		$data['students'] = $this->students_model->get_students();
		$data['students'] = $this->students_model->append_year_string($data['students']);
		$data['title'] = 'Students';

		$this->load->view('templates/header', $data);
		$this->load->view('students/index', $data);
		$this->load->view('templates/footer', $data);
	}

	// Return specific student
	public function view($puid = NULL)
	{
		// Retrieve student and format their year
		$data['students_item'] = $this->students_model->get_students($puid);
		
		if (empty($data['students_item']))
		{
			show_404();
		}

		$data['StudentName'] = $data['students_item']['FirstName'].' '.$data['students_item']['LastName'];

		$this->load->view('templates/header', $data);
		$this->load->view('students/view', $data);
		$this->load->view('templates/footer', $data);
	}

	public function create($puid = NULL, $eventId = NULL)
	{
		// Helpers
		$this->load->helper('puid_helper');
		$this->load->helper('student_helper');
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
		$this->form_validation->set_rules('Year', 'Year', 'required');
		$this->form_validation->set_rules('Floor', 'Floor', 'required');
		$this->form_validation->set_rules('Side', 'Side', 'required');

		// Create student if if validation succeeds
		if (($this->form_validation->run() === TRUE) and ($cleanPuid != '-1'))
		{
			$this->students_model->create_student($eventId);

			// Redirect to event checkin if id is given
			if ($eventId != NULL)
			{
				$data = [];
				$data['AddedStudent'] = 1;
				redirect('/events/add/'.$eventId);
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