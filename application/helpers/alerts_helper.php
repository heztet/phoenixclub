<?php

// Set a cookie named "display_alert" with attributes "display_type" and "message"
// Fade is optional
// Uses JSON encoding
function set_alert($display_type = NULL, $message = NULL, $fade = TRUE)
{
	$CI =& get_instance();
	$CI->load->helper('cookie');

	// Quit if either argument is empty
	if (empty($display_type) || empty($message))
	{
		return;
	}

	// Set up cookie data in JSON format
	$data = array('type' => $display_type, 
				  'message' => $message,
				  'fade' => $fade
				  );
	$json_data = json_encode($data);

	// Set cookie for user
	$cookie = array('name' => 'display_alert',
					'value' => $json_data,
					'expire' => '60',
					'secure' => TRUE
					);
	set_cookie($cookie);
}

// Get the cookie "display_alert" in array format then deletes it
// Returns NULL if the cookie couldn't be retrieved
function get_alert()
{
	$CI =& get_instance();
	$CI->load->helper('cookie');

	$cookie_json = get_cookie('display_alert');

	if (empty($cookie_json))
	{
		return NULL;
	}

	$cookie_array = json_decode($cookie_json, TRUE); // TRUE specifies to return an array rather than an object

	delete_cookie('display_alert');
	
	return $cookie_array;
}