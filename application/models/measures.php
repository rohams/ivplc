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
	
        
    /* UPDATE MEASURMENTS*/
    
    function measurement_order($orig_sub_id, $measurement_id){
        $query = $this->db->query("select fk_componentA_id, fk_componentB_id from measurements where pk_measurement_id= ".$measurement_id."");
        $row = $query->row_array();
        $compA = $row['fk_componentA_id'];
        $compB = $row['fk_componentB_id'];
        $comp1 = $this->components->component_order($orig_sub_id, $compA);
        $comp2 = $this->components->component_order($orig_sub_id, $compB); 
        return array ($comp1, $comp2);        
    }
    
    /* This function creates measurements that are submitted through the edit form*/
    function update_measurements($orig_sub_id,$new_sub_id, $measurements, $components, $post_orig_measurement_id){ 
        
            $config = array(
                    'upload_path' => './uploads/transfer_functions/',
                    'allowed_types' => 'xlsx|xls|zip|m|txt|rtf|doc',
                    'max_size' => '2048',
                    'overwrite' => true
            );

	    $_FILES = $measurements;
            $new_data = array();
            $new_datas = array();
	    $error = 'success';
            $measurementCount = 0;
            
	    for($i = 0; $i < count($components); $i++) :
                for($j = $i + 1; $j < count($components); $j++) :
			$config['file_name'] = $new_sub_id . '_transfer_'. $components[$i]['pk_component_id'] . '_' . $components[$j]['pk_component_id'];
			$this->upload->initialize($config); 
				if(isset($_FILES[$measurementCount])){
                                    if(! $this->upload->do_upload($measurementCount)){
                                        if($_FILES[$measurementCount]['error'] != 4) :
                                            // for other errors show the error
                                            $error = $this->upload->display_errors();
                                            return $error;
                                        else :
                                            // It is ok if the user decided not to upload any file
                                            $relative_url = null;
                                            $measurementCount++;   
                        		endif;
                                    //else the upload was successful
                                    }
                                    else{
                                        $measurementCount++;
                                        $upload_data = $this->upload->data();
                                        $relative_url = str_replace($_SERVER['DOCUMENT_ROOT'], '', $upload_data['full_path']);                                                                        
                                    }
                                    $new_data['fk_sub_id']=$new_sub_id;
                                    $new_data['fk_componentA_id'] = $components[$i]['pk_component_id'];
                                    $new_data['fk_componentB_id'] = $components[$j]['pk_component_id'];
                                    $new_data['file_name']=$upload_data['file_name'];
                                    $new_data['url']=$relative_url;
                                    $new_datas[]=$new_data;
                            }
                    endfor;
                endfor;
                                
		//check for exisiting files from revision 0
                if(isset($post_orig_measurement_id)){
                    $orig_data = array();
                    $orig_datas = array();
                    $order = array();
                    $orders = array();
                    for($i = 0; $i < count($post_orig_measurement_id); $i++) :
                        $query=  $this->db->query("select url, file_name from measurements where pk_measurement_id= ".$post_orig_measurement_id[$i]."");
                         if( $query->num_rows() > 0 ) : 
                            $row = $query->row_array();
                            list ($comp1, $comp2)=$this->measurement_order($orig_sub_id, $post_orig_measurement_id[$i]);
                            $order['comp1'] = $comp1;
                            $order['comp2'] = $comp2;
                            $orders[]= $order;
                            $orig_data['url']=$row['url'];
                            $orig_data['file_name']=$row['file_name'];
                            $orig_data['fk_sub_id']=$new_sub_id;
                            $orig_data['fk_componentA_id'] = $components[$comp1]['pk_component_id'];
                            $orig_data['fk_componentB_id'] = $components[$comp2]['pk_component_id'];
                            $orig_datas[]=$orig_data;

                        endif;
                    endfor;
                }
                //insert orig and new into components table
                $orig_index =0;
                $new_index =0;
                $orig_count=count($orig_datas);
                if(isset($orders)){
                    $orig_order1=$orders[$orig_index]['comp1'];
                    $orig_order2=$orders[$orig_index]['comp2'];
                }
                 for($i = 0; $i < count($components); $i++) :
                    for($j = $i + 1; $j < count($components); $j++) :
                        if(($i == $orig_order1) and ($j == $orig_order2)){
                            $query = $this->db->insert('measurements', $orig_datas[$orig_index]);
                            $orig_index++;
                            if($orig_index < $orig_count){
                                $orig_order1=$orders[$orig_index]['comp1'];
                                $orig_order2=$orders[$orig_index]['comp2'];
                            }
                        }
                        else{                           
                            $query = $this->db->insert('measurements', $new_datas[$new_index]);
                            $new_index++;
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