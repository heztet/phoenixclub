<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('test_method'))
{
	// Formats a PUID with one leading zero
	// Returns '-1' if input string is blank or not a number
    function format_puid($dirty = NULL)
    {
        $clean = '-1';
    	// Exit if blank or NaN
    	if (($dirty === '') or (!is_numeric($dirty)) or ($dirty === NULL))
    	{
    		return '-1';
    	}
    	// Exit if length is incorrect
    	else if ((strlen($dirty) < 8) or (strlen($dirty) > 10))
    	{
    		return '-1';
    	}

    	// Add a zero
        if (strlen($dirty) === 8) {
        	$clean = '0'.$dirty;
        }
        // Remove a zero
        else if (strlen($dirty) === 10) {
            // Check that first two digits are a zero
            if (substr($dirty, 0, 2) == '00')
            {
                $clean = substr($dirty, 1, 10);  
            }
            else
            {
                return '-1';
            }    	
        }
        // No formatting required
        else {
        	$clean = $dirty;
        }

        return $clean;
    }   
}