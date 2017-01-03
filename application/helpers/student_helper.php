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

// Sets student(s) as banquet eligible or not
// Checks only clean_puid if given
if ( ! function_exists('banquet_check'))
{
    function banquet_check($clean_puid = NULL)
    {
        // Controller instance (to load database and queries)
        $helper =& get_instance();
        $helper->load->database();
        $helper->load->helper('globals');

        $banquet_min = get_global('BanquetAmount');

        // Build query
        $sql = 'UPDATE phoenix_students SET BanquetEligible=1 WHERE (BanquetEligible=0 AND (TotalPoints + LastSemesterPoints)>='.$banquet_min;

        if ($clean_puid)
        {
            $sql .= ' AND PUID='.$clean_puid;
        }

        $sql .= ');';

        // Run query
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

// Set LastSemesterPoints as TotalPoints
if ( ! function_exists('update_last_semester_points'))
{
    function update_last_semester_points()
    {
        // Load database
        $helper =& get_instance();
        $helper->load->database();

        $sql = 'UPDATE phoenix_students SET LastSemesterPoints=TotalPoints';
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
