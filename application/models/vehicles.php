<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vehicles extends CI_Model {

	function __construct(){
		parent::__construct();
	}
	
	
	/* RETURN FUNCTIONS */
	function return_vehicles($pk_vehicle_id = null, $view = null){		
		if($pk_vehicle_id != null) :
			$query = $this->db->where('pk_vehicle_id', $pk_vehicle_id);
		endif;

		if($view == null) :
			$query = $this->db->where('view', '1');
		else :
			$query = $this->db->where('view', '0');
		endif;
		
		$query = $this->db->order_by('model', 'asc');
		$query = $this->db->get('vehicles');
		$vehicles = array();
		
		if( $query->num_rows() > 0 ) :   
			foreach( $query->result_array() as $vehicle ) :
				$car['pk_vehicle_id'] = $vehicle['pk_vehicle_id'];
				$car['manufacturer'] = $this->manufacturers->return_vehicle_manufacturer($vehicle['fk_manufacturer_id']);
				$car['model'] = $vehicle['model'];
				$car['year'] = $vehicle['year'];
				$car['images'] = $this->images->return_vehicle_images($vehicle['pk_vehicle_id']);
				$car['components'] = $this->components->return_vehicle_components_indexed($vehicle['pk_vehicle_id']);
				$car['measurements'] = $this->measures->return_vehicle_measurements($vehicle['pk_vehicle_id']);
				$car['contributor'] = $this->contributors->return_contributor($vehicle['fk_contributor_id']);
				
				$vehicles[] = $car;
			endforeach;
			
			return $vehicles;
		endif;
	}
	
	function return_vehicle($pk_vehicle_id = null){		
		if($pk_vehicle_id != null) :
			$query = $this->db->where('pk_vehicle_id', $pk_vehicle_id);
		endif;
		$query = $this->db->get('vehicles');
		if ($query->num_rows() == 1 ): 
			$vehicle=$query->row_array(); 		
			$car['pk_vehicle_id'] = $vehicle['pk_vehicle_id'];
			$car['manufacturer'] = $vehicle['fk_manufacturer_id'];
			$car['model'] = $vehicle['model'];
			$car['year'] = $vehicle['year'];
			$car['images'] = $this->images->return_vehicle_images($vehicle['pk_vehicle_id']);
			$car['components'] = $this->components->return_vehicle_components_indexed($vehicle['pk_vehicle_id']);
			$car['measurements'] = $this->measures->return_vehicle_measurements($vehicle['pk_vehicle_id']);
			$car['contributor'] = $this->contributors->return_contributor($vehicle['fk_contributor_id']);
			return $car;
		
		else:
		
			return false;
		
		endif;
		
	}

	
	
	
	
	function return_user_vehicles($contributor = null){
		$query = $this->db->where('fk_contributor_id', $contributor);
		$query = $this->db->order_by('submitted', 'desc');
		$query = $this->db->get('vehicles');
		$vehicles = array();
		
		if( $query->num_rows() > 0 ) :   
			foreach( $query->result_array() as $vehicle ) :
				$car['pk_vehicle_id'] = $vehicle['pk_vehicle_id'];
				$car['manufacturer'] = $this->manufacturers->return_vehicle_manufacturer($vehicle['fk_manufacturer_id']);
				$car['model'] = $vehicle['model'];
				$car['year'] = $vehicle['year'];
				$car['submitted'] = $vehicle['submitted'];
				$car['images'] = $this->images->return_vehicle_images($vehicle['pk_vehicle_id']);
				$car['components'] = $this->components->return_vehicle_components_indexed($vehicle['pk_vehicle_id']);
				$car['measurements'] = $this->measures->return_vehicle_measurements($vehicle['pk_vehicle_id']);
				$car['contributor'] = $this->contributors->return_contributor($vehicle['fk_contributor_id']);
				
				$vehicles[] = $car;
			endforeach;
			
			return $vehicles;
		endif;


	}
	
	
	
	/* ADD FUNCTIONS */
	function create_vehicle($post){		  
		$data = array(
			'fk_contributor_id' => $post['fk_contributor_id'],
			'fk_manufacturer_id' => $post['manufacturer'],
			'model' => ucwords($post['model']),
			'year' => $post['year'],
			'submitted' => Date('Y-m-d H:i:s'),
			'agreement'=> '1'
		);
		
		$query = $this->db->insert('vehicles', $data);
		$fk_vehicle_id = $this->db->insert_id();
		return $fk_vehicle_id;
	}


	/* ADMIN FUNCTIONS */	
	function awaiting_approval(){
		$query = $this->db->get_where('vehicles', array('view' => '0'));
		return $query->num_rows();
	}
	
    
    function approve($pk_vehicle_id, $fk_contributor_id){
    	$query = $this->db->where('pk_vehicle_id' , $pk_vehicle_id);
    	$query = $this->db->update('vehicles', array('view'=>'1'));

    	$query = $this->db->where('pk_contributor_id' , $fk_contributor_id);
    	$query = $this->db->update('contributors', array('verified'=>'1'));    	
    }
    
    function reject($pk_vehicle_id){
    	$query = $this->db->delete('vehicles', array('pk_vehicle_id'=>$pk_vehicle_id));
    }
    
    //function edit($pk_vehicle_id,, $fk_contributor_id){
    //	$query = $this->db->delete('vehicles', array('pk_vehicle_id'=>$pk_vehicle_id));
   // }

}