<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Example Auth controller using Authit
 *
 * @package Authentication
 * @category Libraries
 * @author Ron Bailey
 * @version 1.0
 */

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('authit');
		$this->load->helper('authit');
		$this->config->load('authit');
		
		$this->load->helper('url');
	}
	
	public function index()
	{
		if(!logged_in()) redirect('auth/login');
		 
		// Redirect to your logged in landing page here
		redirect('auth/dash');
	}
	
	public function login()
	{
		if(logged_in()) redirect('auth/dash');
		 
		$this->load->library('form_validation');
		$this->load->helper('form');
		$data['error'] = false;
		 
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if($this->form_validation->run()){
			if($this->authit->login(set_value('username'), set_value('password'))){
				// Redirect to your logged in landing page here
				redirect('auth/dash');
			} else {
				$data['error'] = 'Your username and/or password is incorrect.';
			}
		}
		
		$this->load->view('auth/login', $data);
	}
	
	public function logout()
	{
		if(!logged_in()) redirect('auth/login');

		// Redirect to your logged out landing page here
		$this->authit->logout('/');
	}
	
	public function dash()
	{
		if(!logged_in()) redirect('auth/login');
		
		echo 'Hi, '. user('username') .'. You have successfully  logged in. <a href="'. site_url('auth/logout') .'">Logout</a>';
	}
	
	/**
	 * CI Form Validation callback that checks a given email exists in the db
	 *
	 * @param string $email the submitted email
	 * @return boolean returns false on error
	 */
	public function username_exists($username)
	{
		$this->load->model('authit_model');
		 
		if($this->authit_model->get_user_by_username($username)){
			return true;
		} else {
			$this->form_validation->set_message('username_exists', 'We couldn\'t find that username in our system.');
			return false;
		}
	}
}