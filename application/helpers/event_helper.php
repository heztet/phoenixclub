<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Archive current events
if ( ! function_exists('archive_events'))
{
    function archive_events()
    {
        // Load database
        $helper =& get_instance();
        $helper->load->database();

        $now = new DateTime(null, new DateTimeZone('America/New_York'));
        $time = $now->format('Y-m-d H:i:s'); // MySQL datetime format
        $sql = 'UPDATE phoenix_events SET IsCurrentYear=0, DateArchived="'.$time.'", IsOpen=0 WHERE IsCurrentYear=1';
        $helper->db->query($sql);
    }
}