<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contributors extends CI_Model {

    function __construct(){
        parent::__construct();
    }
    
    
    /* RETURN FUNCTIONS */    
    function return_contributor($pk_contributor_id){
    	$query = $this->db->get_where('contributors', array('pk_contributor_id' => $pk_contributor_id));
		return ($query->num_rows() == 1 ) ? $query->row_array() : false;
    }

	function check_email($email){
		$query = $this->db->get_where('contributors', array('email' => $email));
		return ($query->num_rows() == 1 ) ? $query->row_array() : false;
    }
    
	function check_verified($email){
		$query = $this->db->get_where('contributors', array('email' => $email, 'verified' => '1'));
		return ($query->num_rows() == 1 ) ? $query->row_array() : false;
    }
    
    function return_name($email){
    	$query = $this->db->get_where('contributors', array('email' => $email));
		
		if($query->num_rows() == 1) :
			$contributor = $query->row_array();
			return $contributor['first_name'];
		else :
			return false;
		endif;
    }
    
    
    /* ADD FUNCTIONS */
    function create_contributor($post){
    	$data = array(
			'email' => $post['email'],
			'first_name' => $post['first'],
			'last_name' => $post['last'],
			'affiliation' => $post['affiliation'],
			'city' => $post['city'],
			'country' => $post['country']
		);

		$query = $this->db->get_where('contributors', array('email' => $post['email']));
		if($query->num_rows() == 0) :
			$query = $this->db->insert('contributors', $data);
			return $this->db->insert_id();
		else :
			return false;
		endif;
    }

}