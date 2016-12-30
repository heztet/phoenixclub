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

// Sets all students as banquet eligible or not
if ( ! function_exists('banquet_check'))
{
    function banquet_check($min_points = -1)
    {
        // Controller instance (to load database and queries)
        $helper =& get_instance();
        $helper->load->database();

        $sql = 'UPDATE phoenix_students SET BanquetEligible=1 WHERE (BanquetEligible=0 AND TotalPoints>'.$min_points.');';
        $helper->db->query($sql);
    }   
}

// Set all students to zero points
if ( ! function_exists('reset_student_points'))
{
    function reset_student_points()
    {
        // Load database
        $helper =& get_instance();
        $helper->load->database();

        $sql = 'UPDATE phoenix_students SET TotalEvents=0, TotalPoints=0';
        $helper->db->query($sql);
    }
}

// Delete all students
if ( ! function_exists('delete_students'))
{
    function delete_students()
    {
        // Load database
        $helper =& get_instance();
        $helper->load->database();

        $helper->db->where('PUID !=', 'NULL');
        $helper->db->delete('phoenix_students');
    }
}