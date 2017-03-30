<?php
class Documents extends CI_Controller {

	// Construct controller
	public function __construct()
	{
		parent::__construct();
		$this->load->model('documents_model');
		$this->load->helper('url_helper');
		$this->load->helper('authit');
		$this->load->helper('alerts');
	}

	// Return all documents
	public function index()
	{
		$data['username'] = username();
		$data['title'] = 'Minutes, Newsletters, and Other Documents';
		$data['documents'] = $this->documents_model->get_documents();

		// Display page
		$data['alert'] = get_alert();
		$this->load->view('templates/header', $data);
		$this->load->view('documents/index', $data);
		$this->load->view('templates/footer', $data);
	}

	// Redirect to specified document
	public function view($id = NULL)
	{
		$data['username'] = username();
		
		if ($id == NULL)
		{
			show_404();
		}

		$link = $this->documents_model->get_document_link($id);

		if (empty($link))
		{
			show_404();
		}
		
		redirect(prep_url($link), 'refresh');
	}

	// Create document
	public function add()
	{
		require_login(uri_string());
		$data['username'] = username();
		
		// Helpers
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['title'] = "Add a document";

		// Validate inputs
		$this->form_validation->set_rules('Title', 'title', 
										  'required|max_length[60]|is_unique[phoenix_documents.Title]',
										  array('required' => 'You need to have a %s'),
										  array('max_length' => '%s can only be 60 characters or less'),
										  array('is_unique' => 'There\'s already an event with that %s')
										  );
		$this->form_validation->set_rules('Link', 'link', 'required|valid_url',
										  array('required' => 'You need to have a %s'),
										  array('valid_url' => 'You need a valid url for your %s.')
										  );

		// Return to index if inputs are valid
		if ($this->form_validation->run() === TRUE)
		{
			$result = $this->documents_model->set_document();
			set_alert('success', 'Document added!');
			redirect('documents');
		}

		$data['alert'] = get_alert();
		$this->load->view('templates/header', $data);
		$this->load->view('documents/add', $data);
		$this->load->view('templates/footer', $data);
	}
}