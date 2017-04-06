<?php
class Links extends CI_Controller {
	// Construct controller
	public function __construct()
	{
		parent::__construct();
		$this->load->model('links_model');
		$this->load->helper('url');
		$this->load->helper('authit');
		$this->load->helper('alerts');
	}

	// List all shortened URLs
	public function index()
	{
		require_login(uri_string());
		$data['username'] = username();
		$data['title'] = 'Links';

		$data['links'] = $this->links_model->get_links();

		$data['alert'] = get_alert();
		$this->load->view('templates/header', $data);
		$this->load->view('links/index', $data);
		$this->load->view('templates/footer', $data);
	}


	// Add a new shortened URL and redirect to index
	public function add()
	{
		require_login(uri_string());
		$data['username'] = username();
		$data['title'] = 'Add a link';

		// Helpers
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('LongLink', 'Link', 'required|trim|prep_url|max_length[534]');
		$this->form_validation->set_rules('ShortLink', 'Shortened link', 'is_unique[phoenix_links.Lookup]|trim|max_length[534]|alpha_dash',
										  array('alpha_dash' => 'Link can only have alpha-numeric characters, dashes, or underscores')
										  );
		
		// Add link
		if ($this->form_validation->run() === TRUE)
		{
			$success = $this->links_model->shorten_link();

			// Successful redirect to links index
			if ($success)
			{
				set_alert('success', 'Successfully added link');
				redirect('links');
			}
		}

		$data['alert'] = get_alert();
		$this->load->view('templates/header', $data);
		$this->load->view('links/add', $data);
		$this->load->view('templates/footer', $data);
		return;
	}

	public function edit($id = NULL)
	{
		require_login(uri_string());
		$data['username'] = username();
		$data['title'] = 'Edit link';

		$data['link'] = $this->links_model->get_link_by_id($id);

		if (is_null($data['link']))
		{
			show_404();
		}

		// Helpers
		$this->load->helper('form');
		$this->load->library('form_validation');

		// Form rules
		$this->form_validation->set_rules('LongLink', 'Link', 'required|trim|prep_url|max_length[534]');
		$this->form_validation->set_rules('ShortLink', 'Shortened link', 'max_length[534]|trim|alpha_dash|callback_validate_shortlink['.$this->input->post('LinkId').']',
										  array('alpha_dash' => 'Link can only have alpha-numeric characters, dashes, or underscores',
										  	    'validate_shortlink' => 'That shortened link was taken. Please choose another one')
										  );

		// Form is validated
		if ($this->form_validation->run() === TRUE) 
		{
			// Attempt to update link
			$success = $this->links_model->update_link();

			// Check if update was successful
			if ($success)
			{
				set_alert('success', 'Link was successfully updated');
			}
			else
			{
				set_alert('danger', 'Link could not be updated');
			}
			
			redirect(uri_string());  // Redirect to force cookie
		}

		$data['alert'] = get_alert();
		$this->load->view('templates/header', $data);
		$this->load->view('links/edit', $data);
		$this->load->view('templates/footer', $data);
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
			set_alert('warning', 'Link successfully deleted');
		}
		else
		{
			set_alert('danger', 'There was a problem deleting the link');
		}

		redirect('links');
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


	// Check that the input lookup is either availiable or taken by a link with the input link id
	public function validate_shortlink($lookup, $id)
	{
		$link = $this->links_model->get_link_by_lookup($lookup);

		if (empty($link) || ($link['Id'] == $id))
		{
			return TRUE;
		}
		
		return FALSE;
	}
}