<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Set all floors to zero points
if ( ! function_exists('delete_newsletters'))
{
    function delete_newsletters()
    {
        // Load database
        $helper =& get_instance();
        $helper->load->database();

		$helper->db->where('Id !=', 'NULL');
		$helper->db->delete('phoenix_newsletters');
    }
}