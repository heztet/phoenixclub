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
}