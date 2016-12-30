<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Gets values from the globals table
// Each function will return NULL if value isn't found

// Gets BanquetAmount
if ( ! function_exists('get_banquet_amount'))
{
    function get_banquet_amount()
    {
        // Controller instance (to load database and queries)
        $helper =& get_instance();

        // Load database
        $helper->load->database();

        // Get first student by given PUID
        $helper->db->where('Variable', 'BanquetAmount');
        $query = $helper->db->get('globals');
        $value = $query->row(0);
        
        // Return whether student exists
        if (is_object($value))
        {
            return $value;
        }
        else
        {
            return NULL;
        }
    }
}