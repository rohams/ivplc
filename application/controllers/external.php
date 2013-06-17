<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class External extends CI_Controller {

	function __construct(){
	    parent::__construct();
	}
	
	public function index(){
		$data = array(
			'parent' => 'admin',
			'page' => 'admin-index',
			'title' => 'Admin Index'
		);
		
		$this->load->view('header', $data);
		$this->load->view('nav', $data);
		$this->load->view('external/index', $data);
		$this->load->view('footer', $data);
	}
	
	public function group(){		
		$data = array(
			'parent' => 'admin',
			'page' => 'admin-group',
			'title' => 'Admin Group',
			'supervisors' => $this->group->return_supervisors(),
			'assistants' => $this->group->return_assistants()
		);
		
		$this->load->view('header', $data);
		$this->load->view('nav', $data);
		$this->load->view('external/group', $data);
		$this->load->view('footer', $data);
	}
	
	public function publications(){
		$data = array(
			'parent' => 'admin',
			'page' => 'admin-publications',
			'title' => 'Admin Publications',
			'publications' => $this->publications->return_publications()
		);
		
		$this->load->view('header', $data);
		$this->load->view('nav', $data);
		$this->load->view('external/publications', $data);
		$this->load->view('footer', $data);
	}
	
	/* AUTHENTICATE */
	public function login(){
		if($this->input->post()) :
			$data = array(
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password')
			);		
			
			$query = $this->group->authenticate($data['email'], $data['password']);
			
			if( $query == 'Authenticated' ) :
				$this->session->set_userdata(array('authenticated' => true));
				redirect('/admin');
			else:
			    echo $query;
				//redirect('/external/group');
			endif;
		else :		
			$data = array(
				'parent' => 'admin',
				'page' => 'admin-login',
				'title' => 'Admin Login',
				'supervisors' => $this->group->return_supervisors(),
				'assistants' => $this->group->return_assistants()
			);
			
			$this->load->view('header', $data);
			$this->load->view('nav', $data);
			$this->load->view('external/login', $data);
			$this->load->view('footer', $data);
		endif;
	}

	
}