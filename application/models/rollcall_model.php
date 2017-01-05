<?php
class Rollcall_model extends CI_Model {

	// Load database
	public function __construct()
	{
		$this->load->database();
	}

	// Record rollcall for the floor
	public function record_rollcall()
	{
		$this->load->helper(array('url',
								  'globals'));

		// Get post data
		$floor = $this->input->post('Floor');
		$side = $this->input->post('Side');

		// Check for rollcall points
		$points_per_rollcall = get_global('RollcallAmount');
		if (empty($points_per_rollcall))
		{
			log_message('error', 'Failed to record rollcall: no RollcallAmount in globals');
			return -1;
		}

		// Get floor 
		$floorString = $floor.$side;
		$this->db->where('Floor', $floorString);
		$query = $this->db->get('phoenix_floors');
		$floor = $query->row(0);
		$floorPoints = $floor->TotalPoints;

		// Update floor points
		$data = array(
			'TotalPoints' => $floorPoints + $points_per_rollcall
			);
		$this->db->where('Floor', $floorString);
		$this->db->update('phoenix_floors', $data);

		// Record update
		$data = array(
			'Floor' => $floorString,
			'PointDelta' => $points_per_rollcall
			);
		$this->db->insert('phoenix_rollcalls', $data);

		// Success
		return 0;
	}
}