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
	}

	// Download all students (excluding PUID)
	public function students()
	{
		require_login();

		$students = $this->downloads_model->get_all_students();
		$students_csv = $this->dbutil->csv_from_result($students);
		force_download('all_students.csv', $students_csv);
	}

	// Download students that are eligible for banquet (excluding PUID)
	public function banquet()
	{
		require_login();

		$students = $this->downloads_model->get_banquet_students();
		$students_csv = $this->dbutil->csv_from_result($students);
		force_download('banquet_eligible_students.csv', $students_csv);
	}
}