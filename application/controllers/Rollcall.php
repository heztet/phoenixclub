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
		$data['title'] = 'Rollcall';

		$this->load->view('templates/header', $data);
		$this->load->view('rollcall/index', $data);
		$this->load->view('templates/footer', $data);
	}

}