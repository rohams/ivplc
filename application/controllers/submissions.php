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
				'file' => $this->session->userdata('file'),
                                'error' => ''
			);
			
			if($this->form_validation->run()==FALSE) :
				$this->load->view('header', $data);
				$this->load->view('nav', $data);
				$this->load->view('submissions/vehicle', $data);		
				$this->load->view('footer', $data);
			else :
				if($this->input->post()) :
					$post = $this->input->post();
					$vehicle_sub_id = $this->vehicles->create_vehicle($post);
										
					$img = $this->file_parser->images_parser();
                                        $mnl = $this->file_parser->manual_parser();
					$cmp = $this->file_parser->components_parser();
					$msr = $this->file_parser->measurements_parser();
					
					$img_error = $this->images->upload_images($vehicle_sub_id, $img);
                                        $mnl_error = $this->manuals->upload_manual($vehicle_sub_id, $mnl);
					$comp_error = $this->components->upload_components($vehicle_sub_id, $cmp, $post['component_name']);
                                        $components = $this->components->return_vehicle_components($vehicle_sub_id);
					$meas_error = $this->measures->upload_measurements($vehicle_sub_id, $msr, $components);
					
					if($vehicle_sub_id) :
						$this->session->set_userdata('submitted', 'true');
					else :
						$this->session->set_userdata('submitted', 'false');
					endif;
                                        
                                        if($comp_error!='success') :
						$data['error']='upload component error: '.$comp_error;
                                                $this->vehicles->reject($vehicle_sub_id);
                                                $this->load->view('header', $data);
                                                $this->load->view('nav', $data);
                                                $this->load->view('submissions/vehicle', $data);		
                                                $this->load->view('footer', $data);
                                                
                                        elseif($meas_error!='success') :
						$data['error']='upload measurement error: '.$meas_error;
                                                $this->vehicles->reject($vehicle_sub_id);
                                                $this->load->view('header', $data);
                                                $this->load->view('nav', $data);
                                                $this->load->view('submissions/vehicle', $data);		
                                                $this->load->view('footer', $data);
                                                
                                        elseif($img_error!='success' && $img_error!='') :
						$data['error']='upload image error: '.$img_error;
                                                $this->vehicles->reject($vehicle_sub_id);
                                                $this->load->view('header', $data);
                                                $this->load->view('nav', $data);
                                                $this->load->view('submissions/vehicle', $data);		
                                                $this->load->view('footer', $data);
                                                
                                        elseif($mnl_error!='success' && $mnl_error!='') :
						$data['error']='upload guideline error: '.$img_error;
                                                $this->vehicles->reject($vehicle_sub_id);
                                                $this->load->view('header', $data);
                                                $this->load->view('nav', $data);
                                                $this->load->view('submissions/vehicle', $data);		
                                                $this->load->view('footer', $data);
                                                
					else:
					redirect('submit/chooser');
                                        endif;                              
			
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
		


	public function edit_list(){
	
			
		$contributor= $this->session->userdata('contributor');
		$data = array(
			'parent' => 'submit',
			'UserVehicles' => $this->vehicles->return_user_vehicles($contributor)
			
			);
	
		if($this->input->post()) :
                    $sub_id = $this->input->post('pk_sub_id');
                    redirect('submit/edit/'.$sub_id);
		
		else:
                    $this->load->view('header', $data);
                    $this->load->view('nav', $data);
                    $this->load->view('submissions/edit',$data);	
                    $this->load->view('footer', $data);
		
		endif;
		
	}
	
	public function submit_edit_vehicle($pk_sub_id = null){
	        $this->form_validation->set_rules('manufacturer', 'Manufacturer', 'required');
		$this->form_validation->set_rules('model', 'Model', 'required');
		$this->form_validation->set_rules('year', 'Year', 'required|min_length[4]|numeric');
		$this->form_validation->set_rules('component_name[]', 'Component Name', 'required');
		$this->form_validation->set_rules('agreement', 'Agreement', 'required');
			
		$data = array(
			'parent' => 'submit',
			'vehicle' => $this->vehicles->return_vehicle($pk_sub_id),
			'page' => 'vehicle',
			'title' => 'Edit Vehicle',
			'contributor' => $this->session->userdata('contributor'),
			'manufacturers' => $this->manufacturers->return_manufacturers(),
                        'error' => '',
			'file' => $this->session->userdata('file')
			);
                //In order to expand the upload file list we need to pass this id to script.js
                $data['id'] = count($data['vehicle']['components'])-2;
                if($this->input->post()) :
                        $submit = $this->input->post('submit');
                        $post = $this->input->post();
                        $post['sub_id']=$pk_sub_id;  
                        switch($submit){
				case 'Submit':
                                    if($this->form_validation->run()==FALSE) :
                                        $this->load->view('header', $data);
                                        $this->load->view('nav', $data);
                                        $this->load->view('submissions/editform',$data);		
                                        $this->load->view('footer', $data);
                                    else:
                                        $new_sub_id = $this->vehicles->edit_this_vehicle($post);
                                    	$img = $this->file_parser->images_parser();
                                        $mnl = $this->file_parser->manual_parser();
					$cmp = $this->file_parser->components_parser();
					$msr = $this->file_parser->measurements_parser();
					if(isset($post['orig_image_id'])){
                                            $img_error = $this->images->update_images($pk_sub_id, $new_sub_id, $img, $post['orig_image_id']);
                                        }
                                        else{
                                            $img_error = $this->images->upload_images($new_sub_id, $img);
                                        }
                                        
                                        if(isset($post['orig_manual_id'])){                                           
                                            $mnl_error = $this->manuals->update_manual($new_sub_id, $post['orig_manual_id']);
                                        }
                                        else{
                                            $mnl_error = $this->manuals->upload_manual($new_sub_id, $mnl);
                                        }
                                        
                                        if(isset($post['orig_component_id'])){
                                            $comp_error=$this->components->update_components($pk_sub_id, $new_sub_id, $cmp, $post['orig_component_id'], $post['component_name']);
                                        }
                                        else{
                                            $comp_error = $this->components->upload_components($new_sub_id, $cmp, $post['component_name']);
                                        }
                                        
                                        $components = $this->components->return_vehicle_components($new_sub_id);
                                        if(isset($post['orig_measurement_id'])){                                           
                                            $meas_error = $this->measures->update_measurements($pk_sub_id, $new_sub_id, $msr, $components, $post['orig_measurement_id']);
                                        }
                                        else{
                                            $meas_error = $this->measures->upload_measurements($new_sub_id, $msr, $components);
                                        }
                                        
                                        if($comp_error!='success' && $comp_error!='') :
						$data['error']='upload component error: '.$comp_error;
                                                $this->vehicles->reject($new_sub_id);
                                                $this->load->view('header', $data);
                                                $this->load->view('nav', $data);
                                                $this->load->view('submissions/editform', $data);		
                                                $this->load->view('footer', $data);
                                                
                                        elseif($meas_error!='success' && $meas_error!='') :
						$data['error']='upload measurement error: '.$meas_error;
                                                $this->vehicles->reject($new_sub_id);
                                                $this->load->view('header', $data);
                                                $this->load->view('nav', $data);
                                                $this->load->view('submissions/editform', $data);		
                                                $this->load->view('footer', $data);
                                                
                                                
                                        elseif($img_error!='success' && $img_error!='') :
						$data['error']='upload image error: '.$img_error;
                                                $this->vehicles->reject($new_sub_id);
                                                $this->load->view('header', $data);
                                                $this->load->view('nav', $data);
                                                $this->load->view('submissions/editform', $data);		
                                                $this->load->view('footer', $data);
                                                
                                        elseif($mnl_error!='success' && $mnl_error!='') :
                                            $data['error']='upload guideline error: '.$img_error;
                                            $this->vehicles->reject($new_sub_id);
                                            $this->load->view('header', $data);
                                            $this->load->view('nav', $data);
                                            $this->load->view('submissions/editform', $data);		
                                            $this->load->view('footer', $data);
                                                
					else:
                                                redirect('submit/edit/');
                                        endif;                              
                                    endif;
                                    
					break;
				case 'Cancel' :
                                        redirect('submit/edit/');
					break;
				default :
					return false;
			}

                else:
                    $this->load->view('header', $data);
                    $this->load->view('nav', $data);
                    $this->load->view('submissions/editform',$data);	
                    $this->load->view('footer', $data);
                    
                endif;
		
	}

}

