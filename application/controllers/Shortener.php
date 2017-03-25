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
	public function index($add_success = NULL)
	{
		require_login(uri_string());
		$data['username'] = username();
		$data['title'] = "URL Shortener";

		$data['links'] = $this->shortener_model->get_links();

		// Check if redirect from shortener/add
		if (! is_null($add_success))
		{
			$data['success'] = TRUE;
		}

		$this->load->view('templates/header', $data);
		$this->load->view('shortener/index', $data);
		$this->load->view('templates/footer', $data);
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

		$this->form_validation->set_rules('LongLink', 'Link', 'required|prep_url|max_length[534]');
		$this->form_validation->set_rules('ShortLink', 'Shortened link', 'is_unique[phoenix_links.Lookup]|max_length[534]|alpha_dash',
										  array('alpha_dash' => 'Link can only have alpha-numeric characters, dashes, or underscores')
										  );
		
		// Add link
		if ($this->form_validation->run() === TRUE)
		{
			$data['success'] = $this->shortener_model->shorten_link();

			// Successful redirect to shortener index
			if ($data['success'])
			{
				$this->index($add_success = $data['success']);
				return;
			}
		}

		$this->load->view('templates/header', $data);
		$this->load->view('shortener/add', $data);
		$this->load->view('templates/footer', $data);
		return;
	}

	// Handles .../s/go/[id] redirects
	public function go($id = NULL)
	{
		redirect('/');
	}

}