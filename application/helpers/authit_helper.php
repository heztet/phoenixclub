<?php
/**
 * Authit Authentication Library
 *
 * @package Authentication
 * @category Libraries
 * @author Ron Bailey
 * @version 1.0
 */

function logged_in()
{
	$CI =& get_instance();
	$CI->load->library('authit');
	
	return $CI->authit->logged_in();
}

// Redirects user to login page if not logged in
// Sets cookie for $site_url_redirect for successful login
function require_login($site_url_redirect = NULL)
{
	$CI =& get_instance();
	$CI->load->library('authit');
	$CI->load->helper('cookie');

	$url = 'auth/login';
	if (!is_null($site_url_redirect))
	{
		$cookie = array('name' => 'site_url_redirect',
						'value' => $site_url_redirect,
						'expire' => '600',
						'secure' => TRUE
						);

		$CI->input->set_cookie($cookie);
		//$url = $url.'?site_url_redirect='.$site_url_redirect;
	}

	if(!logged_in())
	{
		redirect($url);
	}
}

function user($key = '')
{
	$CI =& get_instance();
	$CI->load->library('session');
	
	$user = $CI->session->userdata('user');
	if($key && isset($user->$key)) return $user->$key;
	return $user;
}

function username($key = '')
{
	$CI =& get_instance();
	$CI->load->library('session');

	// Return nothing if not logged in
	if (user() == NULL)
	{
		return;
	}

	return (user()->username);
}