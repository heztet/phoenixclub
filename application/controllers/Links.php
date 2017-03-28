<?php
class Links extends CI_Controller {
	// Construct controller
	public function __construct()
	{
		parent::__construct();
		$this->load->model('links_model');
		$this->load->helper('url');
		$this->load->helper('authit');
	}

	// List all shortened URLs
	public function index($message = NULL, $message_type = NULL)
	{
		require_login(uri_string());
		$data['username'] = username();
		$data['title'] = "Links";

		$data['links'] = $this->links_model->get_links();

		// Check if redirect from links/add
		if (! is_null($message))
		{
			$data['message'] = $message;
			$data['message_type'] = $message_type;
		}

		$this->load->view('templates/header', $data);
		$this->load->view('links/index', $data);
		$this->load->view('templates/footer', $data);
	}

	// Add a new shortened URL
	public function add()
	{
		require_login(uri_string());
		$data['username'] = username();

		$data['title'] = "Links";

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
			$success = $this->links_model->shorten_link();

			// Successful redirect to links index
			if ($success)
			{
				$message = "Short link added";
				$message_type = "success";
				$this->index($message, $message_type);
				return;
			}
		}

		$this->load->view('templates/header', $data);
		$this->load->view('links/add', $data);
		$this->load->view('templates/footer', $data);
		return;
	}

	public function delete($id = NULL)
	{
		require_login(uri_string());
		$data['username'] = username();

		$link = $this->links_model->get_link_by_id($id);

		if (is_null($link))
		{
			show_404();
		}

		$success = $this->links_model->delete_link($id);

		if ($success) 
		{
			$message = "Link successfully deleted";
			$message_type = "warning";
		}
		else
		{
			$message = "There was a problem deleting the link";
			$message_type = "danger";
		}

		$this->index($message, $message_type);
	}

	// Handles .../s/go/[lookup] redirects
	public function go($lookup = NULL)
	{
		$link = $this->links_model->get_link_by_lookup($lookup);

		if (is_null($link))
		{
			show_404();
		}

		$this->links_model->increment_visit_count($link['Id']);

		redirect($link['Link']);
	}

}