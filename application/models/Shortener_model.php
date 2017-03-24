<?php
class Shortener_model extends CI_Model {

	// Load database
	public function __construct()
	{
		$this->load->database();
	}

	public function shorten_link()
	{
		$this->load->helper('shortener');

		$long_link = $this->input->post('LongLink');
		$short_link = $this->input->post('ShortLink');
	}

}