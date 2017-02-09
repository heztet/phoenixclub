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

// Return event title
if ( ! function_exists('get_event_title'))
{
    function get_event_title($id)
    {
        if (is_null($id))
        {
            return "";
        }

        // Load database
        $helper =& get_instance();
        $helper->load->database();

        $helper->db->where('Id', $id);
        $query = $helper->db->get('phoenix_events');
        
        if ((!isset($query)) || (!isset($query->row(0)->Title)))
        {
            return "";
        }

        return $query->row(0)->Title;
    }
}