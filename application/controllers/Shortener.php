<?php
class Shortener extends CI_Controller {
	// Construct controller
	public function __construct()
	{
		parent::__construct();
		$this->load->model('shortener_model');
		$this->load->helper('url');
		$this->load->helper('authit');
	}

	// Index does not exist
	public function index()
	{
		show_404();
	}

	// Add a new shortened URL
	public function add()
	{
		require_login(uri_string());
		$data['username'] = username();

		$this->load->view('templates/header', $data);
		$this->load->view('');
		$this->load->view('templates/footer', $data);
	}

	// Handles .../s/go/[id] redirects
	public function go($id = NULL)
	{
		redirect('/');
	}

}