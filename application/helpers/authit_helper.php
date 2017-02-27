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
// Takes $site_redirect_url to redirect to after a successful login
function require_login($site_url_redirect = NULL)
{
	$CI =& get_instance();
	$CI->load->library('authit');

	$url = 'auth/login';
	if (!is_null($site_url_redirect))
	{
		$url = $url.'?site_url_redirect='.$site_url_redirect;
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