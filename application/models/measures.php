<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Measures extends CI_Model {

    function __construct(){
        parent::__construct();
    }
    
    /* CREATE MEAUSREMENTS*/
    function upload_measurements($fk_sub_id, $measurements, $components){
		$config = array(
			'upload_path' => './uploads/transfer_functions/',
			'allowed_types' => 'xlsx|xls|zip|m|txt|rtf|doc',
			'max_size' => '2048',
			'overwrite' => true
		);
	
	    $_FILES = $measurements;
	    $measurementCount = 0;
            $error='success';

		for($i = 0; $i < count($components); $i++) :
			for($j = $i + 1; $j < count($components); $j++) :
				$config['file_name'] = $fk_sub_id . '_transfer_'. $components[$i]['pk_component_id'] . '_' . $components[$j]['pk_component_id'];
				$this->upload->initialize($config);
                                    if(isset($_FILES[$measurementCount])){
					if(! $this->upload->do_upload($measurementCount)){
                                                //It is ok if the user decided not to upload any file, for other errors show the error
                                                if($_FILES[$measurementCount]['error'] != 4) :
                                                    $error = $this->upload->display_errors();
                                                    return $error;                                            
                                                else :
                                                    $relative_url = null;
                                                    $measurementCount++;
                                                    $file_name = null;
                                                endif;
                                            }
                                            else{
                                                $measurementCount++;

                                                $upload_data = $this->upload->data();
                                                $relative_url = str_replace($_SERVER['DOCUMENT_ROOT'], '', $upload_data['full_path']);
                                                $file_name = $upload_data['file_name'];
                                            }
                                            
                                                $data = array(
                                                        'fk_sub_id' => $fk_sub_id,
                                                        'fk_componentA_id' => $components[$i]['pk_component_id'],
                                                        'fk_componentB_id' => $components[$j]['pk_component_id'],
                                                        'url' => str_replace('/ivplc', '', $relative_url),
                                                        'file_name' => $file_name,
                                                );                                        
                                                $query = $this->db->insert('measurements', $data);
                                        }
			endfor;
		endfor;
                return $error;
	}
	
	/* RETURN MEASUREMENTS */
    function return_vehicle_measurements($fk_sub_id){
		$query = $this->db->get_where('measurements', array('fk_sub_id'=>$fk_sub_id));
		$measurements = array();
		
		if( $query->num_rows() > 0 ) :   
			foreach( $query->result_array() as $measurement ) :
				$measurements[$measurement['pk_measurement_id']] = $measurement;
			endforeach;
			
			return $measurements;
		endif;
    }
    
    function return_vehicle_measurements_no_index($fk_sub_id){
                $query = $this->db->get_where('measurements', array('fk_sub_id'=>$fk_sub_id));
		$measurements = array();
		
		if( $query->num_rows() > 0 ) :   
			foreach( $query->result_array() as $measurement ) :
				$measurements[] = $measurement;
			endforeach;		
			
                        return $measurements;
		endif;
    }

	
}