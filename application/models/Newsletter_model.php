<?php
class Newsletter_model extends CI_Model {

	// Load database
	public function __construct()
	{
		$this->load->database();
	}

	// Return either all newsletters or a specific one
	public function get_newsletters($id = NULL)
	{
		if ($id == NULL)
		{
			$this->db->order_by('DateCreated', 'desc');
			$query = $this->db->get('phoenix_newsletters');
			return $query->result_array();
		}

		$this->db->order_by('DateCreated', 'desc');
		$this->db->where('Id', $id);
		$query = $this->db->get('phoenix_newsletters');
		$newsletter = $query->row_array();
		return $newsletter;
	}

	public function get_newsletter_link($id = NULL)
	{
		if ($id == NULL)
		{
			return NULL;
		}

		$this->db->order_by('DateCreated', 'desc');
		$this->db->where('Id', $id);
		$query = $this->db->get('phoenix_newsletters');
		$row = $query->row();
		return $row->Link;
	}

	// TODO
	public function destroy_newsletters()
	{

	}
}