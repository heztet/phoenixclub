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
}