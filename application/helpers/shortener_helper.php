<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Delete all links
if ( ! function_exists('delete_links'))
{
    function delete_links()
    {
        // Load database
        $helper =& get_instance();
        $helper->load->database();

        $helper->db->where('Id !=', 'NULL');
        $helper->db->delete('phoenix_links');
    }
}