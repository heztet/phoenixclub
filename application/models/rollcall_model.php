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
		$this->load->helper('url');

		$POINTS_PER_ROLLCALL = 5;

		// Get post data
		$password = $this->input->post('Password');
		$floor = $this->input->post('Floor');
		$side = $this->input->post('Side');

		// Check that the password matches
		$this->db->where('Variable', 'RollcallKey');
		$this->db->where('Value', $password);
		$query = $this->db->get('phoenix_globals');
		$row = $query->row(0);

		// Return error (-1) if password is incorrect
		if (! is_object($row))
		{
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
			'TotalPoints' => $floorPoints + $POINTS_PER_ROLLCALL
			);
		$this->db->where('Floor', $floorString);
		$this->db->update('phoenix_floors', $data);

		// Record update
		$data = array(
			'Floor' => $floorString,
			'PointDelta' => $POINTS_PER_ROLLCALL
			);
		$this->db->insert('phoenix_rollcalls', $data);

		// Success
		return 0;
	}
}