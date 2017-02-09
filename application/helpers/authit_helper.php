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

function require_login()
{
	$CI =& get_instance();
	$CI->load->library('authit');

	if(!logged_in())
	{
		redirect('auth/login');
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