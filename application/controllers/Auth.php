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
		$this->load->model('authit_model');
	}

	public function index()
	{
		require_login();
		$data['username'] = username();
		
		redirect('auth/dash');
	}

	public function login()
	{
		if(logged_in())
		{
			redirect('auth/dash');
		}

		// Verify post data
		$this->load->library('form_validation');
		$this->load->helper('form');
		$data['error'] = false;

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		// Check log in credentials
		if($this->form_validation->run()){
			if($this->authit->login(set_value('username'), set_value('password'))){
				// Redirect to your logged in landing page here
				redirect('auth/dash');
			}
			else {
				$data['error'] = 'Your username and/or password is incorrect.';
			}
		}

		$this->load->view('templates/header', $data);
		$this->load->view('auth/login', $data);
		$this->load->view('templates/footer', $data);
	}

	public function logout()
	{
		require_login();
		$data['username'] = username();

		// Redirect to your logged out landing page here
		$this->authit->logout('/');
	}

	// Dashboard that loads after successful login
	public function dash()
	{
		require_login();
		$data['username'] = username();

		$data['title'] = 'Dashboard';
		$data['buttons'] = array('View events' => 'events',
							     'Create an event' => 'events/create',
							     'Record a rollcall winner' => 'rollcall',
							     'Add a document' => 'documents/add',
							     'View leaderboard' => 'leaderboard',
							     'Reset for next year or semester' => 'reset'
						   );
		$data['links'] = array('events' => 'List of all events',
							   'events/create' => 'Create a new event',
							   'documents' => 'List of all documents',
							   'documents/add' => 'Add a new documents',
							   'banquet' => 'List of students eligible for the banquet',
							   'leaderboard' => 'Leaderboard of floors and students',
							   'reset' => 'Reset floors, semester, or year points',
							   'rollcall' => 'Record who won a rollcall and add points to that floor',
							   'students' => 'List of students to add points (upcoming)',
							   'downloads/students' => 'Download student data as CSV',
							   'downloads/banquet' => 'Download banquet-eligible students as CSV',
							   'database' => 'Go to the database'
						 );

		
		$this->load->view('templates/header', $data);
		$this->load->view('auth/dash', $data);
		$this->load->view('templates/footer', $data);
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
