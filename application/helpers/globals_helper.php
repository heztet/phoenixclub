<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Gets values from the globals table
// Each function will return NULL if value isn't found
// Note: globals is the only helper with a plural name in case global_helper is used by the system

// Gets a specified value
if ( ! function_exists('get_global'))
{
    function get_global($column_name = NULL)
    {
        // Load database
        $helper =& get_instance();
        $helper->load->database();

        // Check for no column
        if (is_null($column_name))
        {
            return NULL;
        }

        $helper->db->where('Variable', $column_name);
        $query = $helper->db->get('globals');
        $result = $query->row(0);
        $value = $result->Value;

        // Return whether student exists
        if (!empty($value))
        {
            return $value;
        }
        else
        {
            return NULL;
        }
    }
}