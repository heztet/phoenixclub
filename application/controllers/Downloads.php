<?php
class Downloads extends CI_Controller {

	// Construct controller
	public function __construct()
	{
		parent::__construct();
		$this->load->model('downloads_model');
		$this->load->helper('url');
		$this->load->helper('download');
		$this->load->dbutil();
		$this->load->helper('authit');
		$this->load->helper('alerts');
	}

	public function index() {
		require_login(uri_string());
		$data['username'] = username();

		$data['title'] = 'Downloads';
		$data['buttons'] = array('Download all students' => 'downloads/students',
							     'Download banquet eligible students' => 'downloads/banquet',
							     'Download all events' => 'downloads/events'
						   );

		$data['alert'] = get_alert();
		$this->load->view('templates/header', $data);
		$this->load->view('downloads/index', $data);
		$this->load->view('templates/footer', $data);
	}

	// Download all students (excluding PUID)
	public function students()
	{
		require_login(uri_string());
		$data['username'] = username();

		$students = $this->downloads_model->get_all_students();
		$students_csv = $this->dbutil->csv_from_result($students);
		force_download('all_students.csv', $students_csv);
	}

	// Download students that are eligible for banquet (excluding PUID)
	public function banquet()
	{
		require_login(uri_string());
		$data['username'] = username();

		$students = $this->downloads_model->get_banquet_students();
		$students_csv = $this->dbutil->csv_from_result($students);
		force_download('banquet_eligible_students.csv', $students_csv);
	}

	// Download all events
	// If $id is given, download student data for that event
	public function events($id = NULL)
	{
		require_login(uri_string());
		$data['username'] = username();

		if (is_null($id))
		{
			$data = $this->downloads_model->get_all_events();
			$filename = 'events.csv';
		}
		else 
		{
			$data = $this->downloads_model->get_students_for_event($id);

			$this->load->helper('event');
			$event_name= get_event_title($id);
			$filename = 'Students from '.$event_name.'.csv';
			$filename = str_replace(' ', '_', $filename);	 
		}

		$data_csv = $this->dbutil->csv_from_result($data);
		force_download($filename, $data_csv);
	}
}