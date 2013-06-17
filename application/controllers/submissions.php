<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Submissions extends CI_Controller {

	function __construct(){
	    parent::__construct();
	}
	
	public function index(){
		$data = array(
			'parent' => 'submit',
			'page' => 'submit',
			'title' => 'Submit'
		);
		
		if($this->input->post()) :
			$email = $this->input->post('email');
			$this->session->set_userdata('email', $email);
			
			$contributor = $this->contributors->check_email($email);
			$verified = $this->contributors->check_verified($email);
			
			if($contributor) :
				if($verified) : 
					$this->session->set_userdata('contributor', $contributor['pk_contributor_id']);
					$this->session->set_userdata('verified', 'true');
					redirect('submit/chooser');  //verified contributor
				else :			
					$this->session->set_userdata('contributor', $contributor['pk_contributor_id']);
					$this->session->set_userdata('verified', 'false');
					redirect('submit/vehicle');  //unverified contributor
				endif;
			else :				
				$this->session->set_userdata('email', $email);
				redirect('submit/personal');     //new contributor
			endif;
		endif;
		
		$this->load->view('header', $data);
		$this->load->view('nav', $data);
		$this->load->view('submissions/index', $data);
		$this->load->view('footer', $data);
	}
	
	public function submit_personal(){
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('first', 'First Name', 'required|min_length[2]');
		$this->form_validation->set_rules('last', 'Last Name', 'required');
		$this->form_validation->set_rules('affiliation', 'Affiliation', 'required');
		$this->form_validation->set_rules('city', 'City', 'min_length[2]|alpha_dash');
		$this->form_validation->set_rules('country', 'Country', 'min_length[2]|alpha_dash');
			
		$data = array(
			'parent' => 'submit',
			'page' => 'personal',
			'title' => 'Submit Personal',
			'email' => $this->session->userdata('email')
		);
		
		if($this->form_validation->run() == FALSE) :
			$this->load->view('header', $data);
			$this->load->view('nav', $data);
			$this->load->view('submissions/personal', $data);
			$this->load->view('footer', $data);
		else :
			if($this->input->post()) :
				$contributor = $this->contributors->create_contributor($this->input->post());
				
				if($contributor) :
					$this->session->set_userdata('contributor', $contributor);
					redirect('submit/vehicle');
				endif;
			endif;
		endif;
	}
	
	public function submit_chooser(){
		if($this->session->userdata('verified')) :	
			$data = array(
				'parent' => 'submit',
				'page' => 'chooser',
				'title' => 'Submit Chooser',
				'contributor' => $this->session->userdata('contributor'),
				'name' => $this->contributors->return_name($this->session->userdata('email'))
			);
			
			if($this->session->userdata('submitted') == 'true') :
				//$data['message'] = 'Thank you for your submission, please allow 5 to 7 days for approval.</br>Would you like to submit something else?';
				$data['message'] = '';
			elseif($this->session->userdata('submitted') == 'false') :
				$data['message'] = 'Error in submission. Please try again.';
			endif;

			$this->load->view('header', $data);
			$this->load->view('nav', $data);
			$this->load->view('submissions/chooser', $data);		
			$this->load->view('footer', $data);
		else :
			redirect('submit');
		endif;
	}
	
	public function submit_vehicle(){		
		$this->form_validation->set_rules('manufacturer', 'Manufacturer', 'required');
		$this->form_validation->set_rules('model', 'Model', 'required');
		$this->form_validation->set_rules('year', 'Year', 'required|min_length[4]|numeric');
		$this->form_validation->set_rules('component_name[]', 'Component Name', 'required');
		$this->form_validation->set_rules('agreement', 'Agreement', 'required');
		
		
		if($this->session->userdata('contributor')) :
			$data = array(
				'parent' => 'submit',
				'page' => 'vehicle',
				'title' => 'Submit Vehicle',
				'contributor' => $this->session->userdata('contributor'),
				'manufacturers' => $this->manufacturers->return_manufacturers(),
				'file' => $this->session->userdata('file')
			);
			
			if($this->form_validation->run()==FALSE) :
				$this->load->view('header', $data);
				$this->load->view('nav', $data);
				$this->load->view('submissions/vehicle', $data);		
				$this->load->view('footer', $data);
			else :
				if($this->input->post()) :
					$post = $this->input->post();
					$vehicle = $this->vehicles->create_vehicle($post);
										
					$img = $this->file_parser->images_parser();
					$cmp = $this->file_parser->components_parser();
					$msr = $this->file_parser->measurements_parser();
					
					$images = $this->images->upload_images($vehicle, $img);
					$components = $this->components->upload_components($vehicle, $cmp, $post['component_name']);
					$measurements = $this->measures->upload_measurements($vehicle, $msr, $components);
					
					if($vehicle) :
						$this->session->set_userdata('submitted', 'true');
					else :
						$this->session->set_userdata('submitted', 'false');
					endif;
					
					redirect('submit/chooser');
				endif;
			endif;
		else :
			redirect('submit');
		endif;
	}
	
	public function submit_publication(){		
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('affiliation', 'Publisher', 'min_length[2]|');
		$this->form_validation->set_rules('date', 'Publication year', 'min_length[4]|numeric');
		$this->form_validation->set_rules('url', 'URL', 'required|prep_url');
		$this->form_validation->set_rules('author_first[]', 'First Initial', 'required');
		$this->form_validation->set_rules('author_last[]', 'Last Name', 'required|alpha_dash');
		$this->form_validation->set_rules('agreement', 'Agreement', 'required');	
		
		if($this->session->userdata('verified')) :
			$data = array(
				'parent' => 'submit',
				'page' => 'publications',
				'title' => 'Submit Publication',
				'contributor' => $this->session->userdata('contributor')
			);
			
			if($this->form_validation->run()==FALSE) :
				$this->load->view('header', $data);
				$this->load->view('nav', $data);
				$this->load->view('submissions/publication', $data);		
				$this->load->view('footer', $data);
			else :
				if($this->input->post()) :
					$post = $this->input->post();
					$publication = $this->publications->create_publication($post);
					$authors = $this->publications->create_authors($post, $publication);
					
					if($publication) :
						$this->session->set_userdata('submitted', 'true');
					else :
						$this->session->set_userdata('submitted', 'false');
					endif;
					
					redirect('submit/chooser');
				endif;
			endif;
		else :
			redirect('submit');
		endif;
	}
		
}