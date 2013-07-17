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
    
    function measurement_order($orig_sub_id, $component_id){
        $query = $this->db->query("select min(pk_component_id) as min_component_id from components where fk_sub_id= ".$orig_sub_id."");
        $row = $query->row_array();
        $min = $row['min_component_id'];
        $order = $component_id-$min;
        return $order;        
    }
    
    /* This function creates measurements that are submitted through the edit form*/
    function update_measurements($orig_sub_id,$new_sub_id, $components, $post_orig_comp_id, $post_comp_name){ 
        
            $config = array(
                    'upload_path' => './uploads/noise_files/',
                    'allowed_types' => 'xlsx|xls|zip|m|txt|rtf|doc',
                    'max_size' => '2048',
                    'overwrite' => true
            );

	    $_FILES = $components;
            $new_data = array();
            $new_datas = array();
	    $error = 'success';
	    for($i = 0; $i < count($components); $i++) :
			$config['file_name'] = $new_sub_id . '_noise_'. $i;
			$this->upload->initialize($config); 
				
                                    if(! $this->upload->do_upload($i)){
                                        if($_FILES[$i]['error'] != 4 || $this->upload->display_errors() !='') :
                                            // for other errors show the error
                                            $error = $this->upload->display_errors();
                                            return $error;
                                        else :
                                            // It is ok if the user decided not to upload any file
                                            $upload_data = $this->upload->data();   
                                            $new_data['fk_sub_id']=$new_sub_id;
                                            //$new_data['name']=$post_comp_name[$i];
                                            $new_data['file_name']=null;
                                            $new_data['url']=null;
                                            $new_datas[]=$new_data;
                        		endif;
                                    //else the upload was successful
                                    }
                                    else{    
                                        $upload_data = $this->upload->data();
                                        $relative_url = str_replace($_SERVER['DOCUMENT_ROOT'], '', $upload_data['full_path']);                                                                        
                                        $new_data['fk_sub_id']=$new_sub_id;
                                        //$new_data['name']=$post_comp_name[$i];
                                        $new_data['file_name']=$upload_data['file_name'];
                                        $new_data['url']=str_replace('/ivplc', '', $relative_url);
                                        $new_datas[]=$new_data;
                                    }                                                                                                            
		endfor;
		//check for exisiting files from revision 0
                if(isset($post_orig_comp_id)){
                    $orig_data = array();
                    $orig_datas = array();
                    $orders = array();
                    for($i = 0; $i < count($post_orig_comp_id); $i++) :
                        $query=  $this->db->query("select url, file_name from components where pk_component_id= ".$post_orig_comp_id[$i]."");
                         if( $query->num_rows() > 0 ) : 
                            $row = $query->row_array(); 
                            $orig_data['url']=$row['url'];
                            $orig_data['file_name']=$row['file_name'];
                            $orig_data['fk_sub_id']=$new_sub_id;
                            $orig_datas[]=$orig_data;
                            $order=$this->component_order($orig_sub_id, $post_orig_comp_id[$i]);
                            $orders[]= $order;
                        endif;
                    endfor;
                }
                //insert orig and new into components table
                $orig_index =0;
                $new_index =0;
                $orig_count=count($orig_datas);
                if(isset($orders)){
                    $orig_order=$orders[$orig_index];
                }
                for ($i =0; $i <(count($new_datas)+count($orig_datas));$i++):    
                    if($i == $orig_order){
                        $orig_datas[$orig_index]['name']=$post_comp_name[$i];
                        $query = $this->db->insert('components', $orig_datas[$orig_index]);
                        $orig_index++;
                        if($orig_index < $orig_count){
                            $orig_order =$orders[$orig_index];
                        }
                    }
                    else{
                        $new_datas[$new_index]['name']=$post_comp_name[$i];
                        $query = $this->db->insert('components', $new_datas[$new_index]);
                        $new_index++;
                    }                   
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