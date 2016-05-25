<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Returns TRUE if student PUID already exists in student table
// Returns FALSE otherwise
if ( ! function_exists('student_exists'))
{
    function student_exists($puid = '')
    {
        // Controller instance (to load database and queries)
        $helper =& get_instance();

        // Format PUID
        $helper->load->helper('puid_helper');
        $puid = format_puid($puid);

        // Load database
        $helper->load->database();

        // Get first student by given PUID
        $helper->db->order_by('DateCreated', 'desc');
        $helper->db->where('PUID', $puid);
        $query = $helper->db->get('phoenix_students');
        $student = $query->row(0);
        
        // Return whether student exists
        if (($puid != -1) and (is_object($student)) and ($student->PUID != ''))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }   
}