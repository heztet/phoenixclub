<?php
class Newsletter extends CI_Controller {

	// Construct controller
	public function __construct()
	{
		parent::__construct();
		$this->load->model('newsletter_model');
		$this->load->helper('url_helper');
	}

	// Return all newsletters
	public function index()
	{

		$data['title'] = 'Newsletters';
		$data['newsletters'] = $this->newsletter_model->get_newsletters();

		// Display page
		$this->load->view('templates/header', $data);
		$this->load->view('newsletter/index', $data);
		$this->load->view('templates/footer', $data);
	}
}