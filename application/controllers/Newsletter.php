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
}