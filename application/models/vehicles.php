<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vehicles extends CI_Model {

	function __construct(){
		parent::__construct();
	}
	
	
	/* RETURN FUNCTIONS */
	function return_vehicles($pk_sub_id = null, $view = null){		
		if($pk_sub_id != null) :
			$query = $this->db->where('pk_sub_id', $pk_sub_id);
		endif;

		if($view == null) :
			$query = $this->db->where('view', '1');
                elseif ($view == 2) :
                        $query = $this->db->where('view', '2');
                elseif ($view == 3) :
                        $query = $this->db->where('view', '3');
                else :
			$query = $this->db->where('view', '0');
		endif;
		
		$query = $this->db->order_by('model', 'asc');
		$query = $this->db->get('vehicles');
		$vehicles = array();
		
		if( $query->num_rows() > 0 ) :   
			foreach( $query->result_array() as $vehicle ) :
				$car['pk_sub_id'] = $vehicle['pk_sub_id'];
				$car['manufacturer'] = $this->manufacturers->return_vehicle_manufacturer($vehicle['fk_manufacturer_id']);
				$car['model'] = $vehicle['model'];
				$car['year'] = $vehicle['year'];
                                $car['submitted'] = $vehicle['submitted'];
                                $car['revision'] = $vehicle['revision'];
				$car['images'] = $this->images->return_vehicle_images($vehicle['pk_sub_id']);
				$car['components'] = $this->components->return_vehicle_components_indexed($vehicle['pk_sub_id']);
				$car['measurements'] = $this->measures->return_vehicle_measurements($vehicle['pk_sub_id']);
				$car['contributor'] = $this->contributors->return_contributor($vehicle['fk_contributor_id']);
				
				$vehicles[] = $car;
			endforeach;
			
			return $vehicles;
		endif;
	}
	
        
        
	function return_vehicle($pk_sub_id = null){		
		if($pk_sub_id != null) :
			$query = $this->db->where('pk_sub_id', $pk_sub_id);
		endif;
		$query = $this->db->get('vehicles');
		if ($query->num_rows() == 1 ): 
			$vehicle=$query->row_array(); 		
			$car['pk_sub_id'] = $vehicle['pk_sub_id'];
			$car['manufacturer'] = $vehicle['fk_manufacturer_id'];
			$car['model'] = $vehicle['model'];
			$car['year'] = $vehicle['year'];
			$car['images'] = $this->images->return_vehicle_images($vehicle['pk_sub_id']);
			$car['components'] = $this->components->return_vehicle_components_indexed($vehicle['pk_sub_id']);
			$car['measurements'] = $this->measures->return_vehicle_measurements($vehicle['pk_sub_id']);
			$car['contributor'] = $this->contributors->return_contributor($vehicle['fk_contributor_id']);
			return $car;
		
		else:
		
			return false;
		
		endif;
		
	}

	
	
	
	
	function return_user_vehicles($contributor = null){
                $query = $this->db->query("select 
                    vehicle_id, max(revision) as revision
                    from vehicles where fk_contributor_id=".$contributor." group by vehicle_id order by submitted desc");
                $row = $query->row_array(); 
		$vehicles = array();
                if( $query->num_rows() > 0 ) :   
			foreach( $query->result() as $results ) :
                                $vehicle_id = $results->vehicle_id;
                                $revision = $results->revision;
                                $query2 = $this->db->query("select 
                    pk_sub_id, vehicle_id, revision, fk_manufacturer_id, model, year, submitted
                    from vehicles where vehicle_id= ".$vehicle_id." and revision= ".$revision."");
		
                                $vehicle = $query2->row_array();
                                $car['pk_sub_id'] = $vehicle['pk_sub_id'];
				$car['vehicle_id'] = $vehicle['vehicle_id'];
                                $car['revision'] = $vehicle['revision'];
				$car['manufacturer'] = $this->manufacturers->return_vehicle_manufacturer($vehicle['fk_manufacturer_id']);
				$car['model'] = $vehicle['model'];
				$car['year'] = $vehicle['year'];
				$car['submitted'] = $vehicle['submitted'];
				$car['images'] = $this->images->return_vehicle_images($vehicle['pk_sub_id']);
				$car['components'] = $this->components->return_vehicle_components_indexed($vehicle['pk_sub_id']);
				$car['measurements'] = $this->measures->return_vehicle_measurements($vehicle['pk_sub_id']);
				$car['contributor'] = $contributor;
				
				$vehicles[] = $car;
                         endforeach;
			
			return $vehicles;
		endif;


	}
	
	
	
	/* ADD FUNCTIONS */
	function create_vehicle($post){	
                $this->db->select_max('vehicle_id');
                $query1 = $this->db->get('vehicles');
                $row = $query1->row_array(); 
                $new_v_id= $row['vehicle_id'] +1;
		$data = array(
                        'vehicle_id' => $new_v_id,
			'fk_contributor_id' => $post['fk_contributor_id'],
			'fk_manufacturer_id' => $post['manufacturer'],
			'model' => ucwords($post['model']),
			'year' => $post['year'],
			'submitted' => Date('Y-m-d H:i:s'),
			'agreement'=> '1'
		);
		
		$query = $this->db->insert('vehicles', $data);
		$vehicle_id = $this->db->insert_id();
		return $vehicle_id;
	}

	/* EDIT FUNCTIONS */
	
		function edit_this_vehicle($post){		  
		$data = array(
			'fk_contributor_id' => $post['fk_contributor_id'],
			'fk_manufacturer_id' => $post['manufacturer'],
			'model' => ucwords($post['model']),
			'year' => $post['year'],
			'submitted' => Date('Y-m-d H:i:s'),
                        'view'=> '2',
			'agreement'=> '1',
		);
		
		$query=$this->db->query("select revision, vehicle_id from vehicles where pk_sub_id= ".$post['sub_id']."");
		$row = $query->row_array();
		$data['revision']=$row['revision']+1;
                $data['vehicle_id']=$row['vehicle_id'];
		$query2 = $this->db->insert('vehicles', $data);
                $vehicle_id = $this->db->insert_id();
		return $vehicle_id;
	}

	/* ADMIN FUNCTIONS */	
	function awaiting_approval(){
		$query = $this->db->get_where('vehicles', array('view' => '0'));
		return $query->num_rows();
	}
	
    
    function approve($pk_sub_id, $fk_contributor_id){
        $query = $this->db->where('pk_sub_id' , $pk_sub_id);
        $query = $this->db->select('vehicle_id');
        $query = $this->db->get('vehicles');
        $row = $query->row_array();
        $v_id= $row['vehicle_id'];
        $query = $query = $this->db->where('vehicle_id' , $v_id);
    	$query = $this->db->update('vehicles', array('view'=>'3'));
        
        $query = $this->db->where('pk_sub_id' , $pk_sub_id);
    	$query = $this->db->update('vehicles', array('view'=>'1'));

    	$query = $this->db->where('pk_contributor_id' , $fk_contributor_id);
    	$query = $this->db->update('contributors', array('verified'=>'1'));    	
    }
    
    function reject($pk_sub_id){
    	$query = $this->db->delete('vehicles', array('pk_sub_id'=>$pk_sub_id));
    }
    
    //function edit($pk_vehicle_id,, $fk_contributor_id){
    //	$query = $this->db->delete('vehicles', array('pk_vehicle_id'=>$pk_vehicle_id));
   // }

}