<?php
class Pages extends CI_Controller {

	// Construct controller
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pages_model');
		$this->load->helper('url');
	}

    public function view($page = 'home')
    {
		// Check that page exists
		if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
		{
			show_404();
		}
        $data['title'] = ucfirst($page); // Capitalize the first letter

		// Simple header for contact page
		if ($page == 'contact') {
			$data['SimpleHeader'] = 1;
		}

        // Main (home) page has custom headers and footers
        if ($page == 'home')
        {
        	$this->load->view('pages/'.$page, $data);
        }
        else
        {
            // Load header/footer otherwise
        	$this->load->view('templates/header', $data);
        	$this->load->view('pages/'.$page, $data);
        	$this->load->view('templates/footer', $data);
        }
    }

    public function leaderboard($data = NULL)
    {
        $this->load->model('students_model');
        $this->load->model('events_model');

    	$data['title'] = 'Leaderboard';
        $data['SimpleHeader'] = 1;

    	// Get students in order of points descending
    	$data['students'] = $this->pages_model->get_student_leaderboard();

    	// Add year string to each student
		$data['students'] = $this->students_model->append_year_string($data['students']);

		// Get total points and events possible
		$data['EventsPossible'] = $this->events_model->amount_current_events();
		$data['PointsPossible'] = $this->events_model->amount_current_points();

        // Add floor stats
        $data['floors'] = $this->pages_model->get_floor_leaderboard();

    	// Load the page
    	$this->load->view('templates/header', $data);
    	$this->load->view('pages/leaderboard', $data);
    	$this->load->view('templates/footer', $data);
    }

    public function banquet($data = NULL)
    {
        $this->load->model('students_model');

        $data['title'] = 'Banquet';
        $data['SimpleHeader'] = 1;

        // Get students in order of points descending
        log_message('error', 'Im here');
        $data['students'] = $this->pages_model->get_student_banquet();
        log_message('debug', 'Im here too');
        log_message('debug', 'Im here too');
        // Add year string to each student
        $data['students'] = $this->students_model->append_year_string($data['students']);

        // Load the page
        $this->load->view('templates/header', $data);
        $this->load->view('pages/banquet', $data);
        $this->load->view('templates/footer', $data);
    }
}
