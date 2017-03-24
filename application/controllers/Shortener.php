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

	// List all shortened URLs
	public function index()
	{
		show_404();
	}

	// Add a new shortened URL
	public function add()
	{
		require_login(uri_string());
		$data['username'] = username();

		$data['title'] = "URL Shortener";

		// Helpers
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('LongLink', 'Link', 'required|prep_url|alpha_dash|max_length[534]',
										  array('alpha_dash' => 'Link can only have alpha-numeric characters, dashes, or underscores'));
		$this->form_validation->set_rules('ShortLink', 'Shortened link', 'is_unique[phoenix_links.Key]|max_length[534]');
		
		if ($this->form_validation->run() === TRUE)
		{
			$success = 
		}

		$this->load->view('templates/header', $data);
		$this->load->view('shortener/add');
		$this->load->view('templates/footer', $data);
	}

	// Handles .../s/go/[id] redirects
	public function go($id = NULL)
	{
		redirect('/');
	}

}