<?php
class Admin extends CI_Controller {

	// Construct controller
	public function __construct()
	{
		parent::__construct();
		// $this->load->model('admin_model');
		$this->load->helper('url_helper');
	}

	// Return all events
	public function index()
	{
		$data['title'] = "Admin";
		
		$this->load->view('templates/header', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer', $data);
	}
}