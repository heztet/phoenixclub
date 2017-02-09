<?php
class Newsletter extends CI_Controller {

	// Construct controller
	public function __construct()
	{
		parent::__construct();
		$this->load->model('newsletter_model');
		$this->load->helper('url_helper');
		$this->load->helper('authit');

	}

	// Return all newsletters
	public function index()
	{
		$data['username'] = username();

		$data['title'] = 'Minute Notes & Newsletters';
		$data['newsletters'] = $this->newsletter_model->get_newsletters();

		// Display page
		$this->load->view('templates/header', $data);
		$this->load->view('newsletter/index', $data);
		$this->load->view('templates/footer', $data);
	}

	// Redirect to specified newsletter
	public function view($id = NULL)
	{
		if ($id == NULL)
		{
			redirect('newsletter/index', 'refresh');
		}

		$link = $this->newsletter_model->get_newsletter_link($id);

		if (empty($link))
		{
			show_404();
		}
		
		redirect(prep_url($link), 'refresh');
	}

	// Create newsletter
	public function add()
	{
		require_login();
		$data['username'] = username();
		
		// Helpers
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['title'] = "Add newsletter";

		// Validate inputs
		$this->form_validation->set_rules('Title', 'title', 
										  'required|max_length[60]|is_unique[phoenix_newsletters.Title]',
										  array('required' => 'You need to have a %s'),
										  array('max_length' => '%s can only be 60 characters or less'),
										  array('is_unique' => 'There\'s already an event with that %s')
										  );
		$this->form_validation->set_rules('Link', 'link', 'required|valid_url',
										  array('required' => 'You need to have a %s'),
										  array('valid_url' => 'You need a valid url for your %s.')
										  );

		// Return create view if inputs are invalid
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header', $data);
			$this->load->view('newsletter/add', $data);
			$this->load->view('templates/footer', $data);
		}
		// Create newsletter and return to newsletter index
		else
		{
			$result = $this->newsletter_model->set_newsletter();
			$this->index();
		}
	}
}