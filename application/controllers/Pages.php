<?php
class Pages extends CI_Controller {

	// Construct controller
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pages_model');
		$this->load->helper('url');
        $this->load->helper('authit');
	}

    public function view($page = 'home')
    {
        $data['username'] = username();
        
        // Check for 'database'
        if ($page == 'database')
        {
            require_login();
            $this->load->database();
            redirect($this->db->website);
        }
        // Check for 'rsvp' within timeframe
        elseif (($page == 'rsvp') and (time() <= strtotime("8 May 2017")))
        {
            redirect('http://google.com');
        }
		// Check that page exists
		elseif ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
		{
			show_404();
		}

        $data['title'] = ucfirst($page); // Capitalize the first letter

        // Main (home) page has custom headers and footers
        if ($page == 'home')
        {
        	$this->load->view('pages/'.$page, $data);
        }
        // Load header/footer otherwise
        else
        {
        	$this->load->view('templates/header', $data);
        	$this->load->view('pages/'.$page, $data);
        	$this->load->view('templates/footer', $data);
        }
    }

    public function leaderboard($data = NULL)
    {
        $data['username'] = username();

        $this->load->model('students_model');
        $this->load->model('events_model');

    	$data['title'] = 'Leaderboard';

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
        require_login(uri_string());
        $data['username'] = username();

        $data['title'] = 'Banquet';
        
        $this->load->model('students_model');
        $this->load->helper('student');

        // Get students in order of points descending
        $data['students'] = $this->pages_model->get_banquet_students();
        // Add year string to each student
        $data['students'] = $this->students_model->append_year_string($data['students']);

        // Load the page
        $this->load->view('templates/header', $data);
        $this->load->view('pages/banquet', $data);
        $this->load->view('templates/footer', $data);
    }
}
