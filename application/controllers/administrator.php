<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrator extends CI_Controller {

	function __construct(){
	    parent::__construct();
		$this->group->authenticated();
	}
	
	public function index(){
		$data = array(
			'parent' => 'admin',
			'page' => 'admin',
			'title' => 'Admin',
			'admin' => true,
			'publications_count' => $this->publications->awaiting_approval(),
			'vehicles_count' => $this->vehicles->awaiting_approval()
		);
		
		$this->load->view('header', $data);
		$this->load->view('nav', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('footer', $data);
	}

	public function admin_measurements($pk_sub_id = null){
		$data = array(
			'parent' => 'admin',
			'page' => 'Measurements admin',
			'title' => 'Measurements Admin',
			'admin' => true,
			'ApproveVehicles' => $this->vehicles->return_vehicles('','0'),
                        'EditVehicles' => $this->vehicles->return_vehicles('', '2'),
                        'ObsoleteVehicles' => $this->vehicles->return_vehicles('','3'),
			'vehicles' => $this->vehicles->return_vehicles()
                        
		);
		
		if($this->input->post()) :
			$submit = $this->input->post('submit');
			$pk_sub_id = $this->input->post('pk_sub_id');
			$fk_contributor_id = $this->input->post('fk_contributor_id');
			$manu_name = $this->input->post('manu');
			
			switch($submit){
				case 'Approve':
					$this->vehicles->approve($pk_sub_id, $fk_contributor_id);
					redirect('admin/measurements');
					break;
				case 'Reject' :
				case 'Delete' :
					$this->vehicles->reject($pk_sub_id);
					redirect('admin/measurements');
					break;
				case 'Add' :
					$this->manufacturers->admin_create_manu($manu_name);
					redirect('admin/measurements');
					break;
				default :
					return false;
			}

		else :
			$this->load->view('header', $data);
			$this->load->view('nav', $data);
			
			if($pk_sub_id != null) :
				$vehicle = $this->vehicles->return_vehicles($pk_sub_id,'0');
				$data['vehicle'] = $vehicle[0];
				$this->load->view('admin/vehicle', $data);
			else :
				$data['vehicles'] = $this->vehicles->return_vehicles();
				$this->load->view('admin/measurements', $data);
			endif;
			
			$this->load->view('footer', $data);
		endif;
	}


	public function admin_publications(){		
		$data = array(
			'parent' => 'admin',
			'page' => 'publications admin',
			'title' => 'Publications Admin',
			'admin' => true,
			'ApprovePublications' => $this->publications->return_publications_awaiting_approval(),
			'publications' => $this->publications->return_publications()
		);
		
		if($this->input->post()) :
			$submit = $this->input->post('submit');
			$pk_pub_id = $this->input->post('pk_pub_id');
			
			if($submit == 'Approve') :
				$this->publications->approve($pk_pub_id);
				redirect('admin/publications');
			elseif($submit == 'Reject' OR 'Delete') :
				$this->publications->reject($pk_pub_id);
				redirect('admin/publications');
			else :
				return false;
			endif;
		else :		
			$this->load->view('header', $data);
			$this->load->view('nav', $data);
			$this->load->view('admin/publications', $data);
			$this->load->view('footer', $data);
		endif;
	}
	
	public function admin_group(){		
		$data = array(
			'parent' => 'admin',
			'page' => 'group admin',
			'title' => 'Group Admin',
			'admin' => true,
			'supervisors' => $this->group->return_supervisors(),
			'assistants' => $this->group->return_assistants()
		);
		
		if($this->input->post()) :
			$submit = $this->input->post('submit');
			$pk_group_id = $this->input->post('pk_group_id');
			
			if($submit == 'Delete') :
				$this->group->delete_member($pk_group_id);
				redirect('admin/group');
			elseif($submit =='Add') :
				$member = $this->group->add_member($this->input->post());
				redirect('admin/group');
			else :
				return false;		
			endif;
		else :
			$this->load->view('header', $data);
			$this->load->view('nav', $data);
			$this->load->view('admin/group', $data);
			$this->load->view('footer', $data);
		endif;
	}

}