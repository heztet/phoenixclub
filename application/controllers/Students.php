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
		$data['students'] = $this->students_model->get_students();
		$data['title'] = 'Students list';

		$this->load->view('templates/header', $data);
		$this->load->view('students/index', $data);
		$this->load->view('templates/footer', $data);
	}

	// Return specific student
	public function view($puid = NULL)
	{
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

	public function add($puid = NULL)
	{
		// Helpers
		$this->load->helper('puid_helper');
		$this->load->helper('student_helper');

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

		$data['title'] = 'Add student';
		$data['puid'] = $cleanPuid;
		// Display student add form
		$this->load->view('templates/header', $data);
		$this->load->view('students/add', $data);
		$this->load->view('templates/footer', $data);
	}
}