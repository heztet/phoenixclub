<?php
class Shortener_model extends CI_Model {

	// Load database
	public function __construct()
	{
		$this->load->database();
	}

	// Load links from phoenix_links
	// Returns an array of all links if $lookup not specified
	public function get_links($lookup = NULL)
	{
		if (is_null($lookup))
		{
			$this->db->order_by('DateCreated', 'desc');
			$query = $this->db->get('phoenix_links');
			return $query->result_array();
		}

		$this->db->order_by('DateCreated', 'desc');
		$this->db->where('Lookup', $lookup);
		$query = $this->db->get('phoenix_links');
		return $query->row_array();
	}

	public function shorten_link()
	{
		//$this->load->helper('shortener');

		// Get POST inputs
		$link = $this->input->post('LongLink');
		$lookup = $this->input->post('ShortLink');

		// Clean $lookup (check if NULL or empty string)
		if (strlen(trim($lookup)) == 0)
		{
			$lookup = NULL;
		}

		// Insert link into phoenix_links
		$data = array('Link' => $link,
			          'Lookup' => $lookup
			          // DateCreated datetime is CURRENTTIME by default
			          );
		$this->db->insert('phoenix_links', $data);

		// Get last created row with the input link
		$this->db->order_by('DateCreated', 'desc');
		$this->db->where('Link', $link);
		$query = $this->db->get('phoenix_links');

		// Check that the record exists
		if (! is_object($query))
		{
			return FALSE;
		}
		$record = $query->row(0);
		if (! is_object($record))
		{
			return FALSE;
		}

		// Update lookup if NULL
		if (is_null($record->Lookup))
		{
			$data = array('Lookup' => $record->Id);
			$this->db->where('Id', $record->Id);
			$this->db->update('phoenix_links', $data);
		}

		return TRUE;
	}

}