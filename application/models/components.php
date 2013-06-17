<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Components extends CI_Model {

    function __construct(){
        parent::__construct();
    }
    
    /* CREATE COMPONENTS*/
    function upload_components($fk_vehicle_id, $components, $post){    
		$config = array(
			'upload_path' => './uploads/noise_files/',
			'allowed_types' => 'xlsx|xls|zip|m|txt|rtf|doc',
			'max_size' => '2048',
			'overwrite' => true
		);
	
	    $_FILES = $components;
	    
	    for($i = 0; $i < count($components); $i++) :
			$config['file_name'] = $fk_vehicle_id . '_noise_'. $i;
			$this->upload->initialize($config); 
			
			if($_FILES[$i]['error'] != 4) :
				$this->upload->do_upload($i);
			
				$upload_data = $this->upload->data();
				$relative_url = str_replace($_SERVER['DOCUMENT_ROOT'], '', $upload_data['full_path']);
			else :
				$relative_url = null;
			endif;
			
			$data = array(
				'fk_vehicle_id' => $fk_vehicle_id,
				'name' => $post[$i],
				'url' => str_replace('/ivplc', '', $relative_url)
			);
			
			$query = $this->db->insert('components', $data);
		endfor;
		
		return $this->return_vehicle_components($fk_vehicle_id);
    }
    
    
    /* RETURN WITH VEHICLE */
    function return_vehicle_components($fk_vehicle_id){
		$query = $this->db->get_where('components', array('fk_vehicle_id'=>$fk_vehicle_id));
		$components = array();
		
		if( $query->num_rows() > 0 ) :   
			foreach( $query->result_array() as $component ) :
				$components[] = $component;
			endforeach;
			
			return $components;
		endif;
    }
    
    function return_vehicle_components_indexed($fk_vehicle_id){
		$query = $this->db->get_where('components', array('fk_vehicle_id'=>$fk_vehicle_id));
		$components = array();
		
		if( $query->num_rows() > 0 ) :   
			foreach( $query->result_array() as $component ) :
				$components[$component['pk_component_id']] = $component;
			endforeach;
			
			return $components;
		endif;
    }

}