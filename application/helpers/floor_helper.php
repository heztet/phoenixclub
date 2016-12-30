<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Set all floors to zero points
if ( ! function_exists('reset_floor_points'))
{
    function reset_floor_points()
    {
        // Load database
        $helper =& get_instance();
        $helper->load->database();

        $sql = 'UPDATE phoenix_floors SET TotalPoints=0 WHERE (Floor Is Not Null);';
        $helper->db->query($sql);
    }
}