<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends CI_Model {

    function __construct(){
        parent::__construct();
    }
    
    /* RETURN FUNCTIONS */
    function return_supervisors(){
		$query = $this->db->order_by('pk_group_id', 'asc');
		$query = $this->db->get_where('group', array('supervisor' => '1'));
		$supervisors = array();
		
		if( $query->num_rows() > 0 ) :   
			foreach( $query->result_array() as $supervisor ) :
				$supervisors[] = $supervisor;
			endforeach;
			
			return $supervisors;
		endif;
    }
    
    function return_assistants(){
		$query = $this->db->order_by('pk_group_id', 'asc');
		$query = $this->db->get_where('group', array('supervisor' => '0'));
		$assistants = array();

		if( $query->num_rows() > 0 ) :   
			foreach( $query->result_array() as $assistant ) :
				$assistants[] = $assistant;
			endforeach;

			return $assistants;
		endif;
	}
	
	
	/* ADD FUNCTIONS */
	function add_member($post){
		if($_FILES['photo']['error'] != 4) :
			$config = array(
				'upload_path' => './uploads/group/',
				'allowed_types' => 'gif|jpg|png',
				'max_size' => '2048',
				'overwrite' => true
			);
		
			$this->upload->initialize($config); 
			$this->upload->do_upload('photo');
			
			$upload_data = $this->upload->data();
			$relative_url = str_replace($_SERVER['DOCUMENT_ROOT'], '', $upload_data['full_path']);
		else :
			$relative_url = null;
		endif;
		
		$data = array (
			'name' => ucwords($post['name']),
			'email' => $post['email'],
			'bio' => $post['bio'],
			'supervisor' => $post['type'],
			'password' => md5($post['password']),
			'url' => str_replace('/ivplc', '', $relative_url)
		);
		$query = $this->db->insert('group', $data);
	}


	/* DELETE FUNCTIONS */
	function delete_member($pk_group_id){
		$query = $this->db->delete('group', array('pk_group_id'=>$pk_group_id));
	}
	
	
	/* AUTHENTICATE FUNCTIONS */
	function authenticate($e,$p){
		$query = $this->db->where('email', $e);
		$query = $this->db->get('group');
		
		$result = 'Your email or password was entered incorrectly.';
		
		if( $query->num_rows == 1 ) :
			foreach($query->result_array() as $member) :
				if( $member['password'] == md5($p)) :
					$result = 'Authenticated';
				endif;
			endforeach;
		endif;
		//$result = md5($p);
		
		return $result;	
	}
	
	function authenticated(){
		$authenticated = $this->session->userdata('authenticated');
		
		if( !isset($authenticated) || $authenticated != true ) :
			$ref = $this->input->server('HTTP_REFERER', TRUE);
			redirect($ref, 'location');
		endif;
	}


}