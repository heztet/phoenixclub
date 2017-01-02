<?php
class Downloads extends CI_Controller {

	// Construct controller
	public function __construct()
	{
		parent::__construct();
		$this->load->model('downloads_model');
		$this->load->helper('url');
		$this->load->helper('download');
	}

	// Download students that are eligible for banquet
	public function banquet()
	{
		$this->load->dbutil();
		$this->load->helper('file');
		$students = $this->downloads_model->get_banquet_students();
		$students_csv = $this->dbutil->csv_from_result($students);
		write_file('test_csv.csv', $students_csv);
	}
}