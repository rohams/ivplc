<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Publications extends CI_Model {

    function __construct(){
        parent::__construct();
    }
    
    /* RETURN FUNCTIONS */
	function return_publications(){
		$query = $this->db->get_where('publications', array('view' => '1'));
		$publications = array();
		
		if( $query->num_rows() > 0 ) :   
			foreach( $query->result_array() as $pub ) :
				$pub['contributor'] = $this->contributors->return_contributor($pub['fk_contributor_id']);
				$pub['authors'] = $this->return_authors($pub['pk_pub_id']);
				$publications[] = $pub;
			endforeach;
			
			return $publications;
		endif;
    }
    
    function return_authors($pub_id){
    	$query = $this->db->order_by('pk_author_id', 'asc');
    	$query = $this->db->get_where('authors', array('fk_pub_id' => $pub_id));    	
    	$authors = array();
    	
		if( $query->num_rows() > 0 ) :   
			foreach( $query->result_array() as $author ) :
				$authors[] = $author['first_name'] . '. ' . $author['last_name'];
			endforeach;
			
			return $authors;
		endif;
    }
    
    function return_publications_awaiting_approval(){
    	$query = $this->db->get_where('publications', array('view' => '0'));
		$publications = array();
		
		if( $query->num_rows() > 0 ) :   
			foreach( $query->result_array() as $pub ) :
				$pub['contributor'] = $this->contributors->return_contributor($pub['fk_contributor_id']);
				$pub['authors'] = $this->return_authors($pub['pk_pub_id']);
				$publications[] = $pub;
			endforeach;
			
			return $publications;
		else :
			return false;
		endif;
    }
    
	
	/* ADD FUNCTIONS */
    function create_publication($post){
    	$data = array(
    		'fk_contributor_id' => $post['fk_contributor_id'],
    		'title' => ucwords($post['title']),
    		'affiliation' => ucwords($post['affiliation']),
    		'date' => $post['date'],
    		'url' => $post['url'],
    		'submitted' => Date('Y-m-d H:i:s'),
    		'agreement' => '1'
    	);
    	
    	$query = $this->db->insert('publications', $data);
    	$fk_pub_id = $this->db->insert_id();
		return $fk_pub_id;
    }
    
    function create_authors($post, $fk_pub_id){
    	$first_name = $post['author_first'];
    	$last_name = $post['author_last'];
    	
		for($i = 0; $i < count($first_name); $i++) :
		    $data = array(
	    		'fk_pub_id' => $fk_pub_id,
	    		'first_name' => $first_name[$i],
	    		'last_name' => $last_name[$i]
	    	);
	    	
	    	$query = $this->db->insert('authors', $data);
		endfor;
    }
	
	
	/* ADMIN FUNCTIONS */
    function awaiting_approval(){
    	$query = $this->db->get_where('publications', array('view' => '0'));
		return $query->num_rows();
    }
    
    function approve($pk_pub_id){
    	$query = $this->db->where('pk_pub_id' , $pk_pub_id);
    	$query = $this->db->update('publications', array('view'=>'1'));
    }
    
    function reject($pk_pub_id){
    	$query = $this->db->delete('publications', array('pk_pub_id'=>$pk_pub_id));
    }

}