<?php
class Reset_model extends CI_Model {

	// Load database
	public function __construct()
	{
		$this->load->database();
	}

	// Reset all floor points
	public function reset_floors()
	{
		// Helpers
		$this->load->helper(array('url',
								  'globals',
								  'floor')
		);

		reset_floor_points();

		// Success
		return 0;
	}

	// Set all students' points to zero and record which students are eligible for the banquet
	public function reset_semester()
	{
		// Helpers
		$this->load->helper(array('url',
								  'globals',
								  'student',
								  'event',
								  'floor')
		);

		// Get minimum amount needed for banquet
		$banquet_min = get_global('BanquetAmount');
		if (empty($banquet_min))
		{
			log_message('error', 'Failed to reset semester: no BanquetAmount in globals');
			return -1;
		}

		banquet_check();
		update_last_semester_points();
		reset_floor_points();
		archive_events();

		// Success
		return 0;
	}

	// Archive all events and wipe student data for upcoming school year
	public function reset_year()
	{
		// Helpers
		$this->load->helper(array('url',
								  'globals',
								  'student',
								  'event',
								  'floor',
								  'document',
								  'record')
		);

		archive_events();
		delete_students();
		reset_floor_points();
		delete_documents();
		delete_records();
		
		// Success
		return 0;
	}
}