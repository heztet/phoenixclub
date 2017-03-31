<?php
class Documents_model extends CI_Model {

	// Load database
	public function __construct()
	{
		$this->load->database();
	}

	// Return either all documents or a specific one
	public function get_documents($id = NULL)
	{
		if ($id == NULL)
		{
			$this->db->order_by('DateCreated', 'desc');
			$query = $this->db->get('phoenix_documents');
			return $query->result_array();
		}

		$this->db->order_by('DateCreated', 'desc');
		$this->db->where('Id', $id);
		$query = $this->db->get('phoenix_documents');
		$document = $query->row_array();
		return $document;
	}

	// Return the URL for a document by ID
	public function get_document_link($id = NULL)
	{
		if ($id == NULL)
		{
			return NULL;
		}

		$this->db->order_by('DateCreated', 'desc');
		$this->db->where('Id', $id);
		$query = $this->db->get('phoenix_document');
		$row = $query->row();
		return $row->Link;
	}

	// Create a document
	public function set_document() {
		// Helpers
		$this->load->helper('url');
		$this->load->helper('form');

		// Get post inputs
		$title = $this->input->post('Title');
		$link = $this->input->post('Link');
		$cleanLink = prep_url($link);

		// Insert document
		$data = array(
			'Title' => $title,
			'Link' => $link
			);
		$this->db->insert('phoenix_documents', $data);
	}

	// Delete a document with the given id
	// Returns TRUE or FALSE depending on success
	public function delete_document($id = NULL)
	{
		if (empty($id))
		{
			return NULL;
		}

		log_message('debug', '$id = '.$id);

		$this->db->where('Id', $id);
		$query = $this->db->get('phoenix_documents');

		if (!is_object($query))
		{
			return FALSE;
		}

		$document = $query->row();

		$this->db->where('Id', $document->Id);
		$this->db->delete('phoenix_documents');
		return TRUE;
	}
}