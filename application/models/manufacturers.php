<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manufacturers extends CI_Model {

    function __construct(){
        parent::__construct();
    }
    
    
    /* RETURN FUNCTIONS */
	function return_manufacturers($pk_manufacturer_id = null, $populated = null){
		if($populated != null) :
			$query = $this->db->select('*');
			$query = $this->db->from('vehicles');
			$query = $this->db->where('view','1');
			$query = $this->db->join('manufacturers', 'manufacturers.pk_manufacturer_id = vehicles.fk_manufacturer_id', 'inner');
	    	$query = $this->db->order_by('name', 'asc');
			$query = $this->db->get();
		else :
			if($pk_manufacturer_id) :
				$query = $this->db->where('pk_manufacturer_id', $pk_manufacturer_id);
			endif;
			
	    	$query = $this->db->order_by('name', 'asc');
			$query = $this->db->get('manufacturers');
		endif;
		
		$manufacturers = array();
		
		if( $query->num_rows() > 0 ) :
			foreach( $query->result_array() as $manufacturer ) :
				$manufacturers[$manufacturer['pk_manufacturer_id']] = $manufacturer['name'];
			endforeach;
			
			return $manufacturers;
		endif;
    }
    
    function return_vehicle_manufacturer($pk_manufacturer_id){
		$query = $this->db->where('pk_manufacturer_id', $pk_manufacturer_id);
    	$query = $this->db->order_by('name', 'asc');
		$query = $this->db->get('manufacturers');
		
		$manufacturers = array();
		
		if( $query->num_rows() == 1 ) :
			$manufacturer = $query->row_array();
			return $manufacturer['name'];
		endif;
    }
    
    function admin_create_manu($manu_name){
   		 $data = array('name' => $manu_name);
    	
 		$query = $this->db->insert('manufacturers', $data);
    }
    
}