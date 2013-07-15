<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Components extends CI_Model {

    function __construct(){
        parent::__construct();
    }
    
    /* CREATE COMPONENTS*/
    function upload_components($fk_sub_id, $components, $post){    
		$config = array(
			'upload_path' => './uploads/noise_files/',
			'allowed_types' => 'xlsx|xls|zip|m|txt|rtf|doc',
			'max_size' => '2048',
			'overwrite' => true
		);
	
	    $_FILES = $components;
	    $error = 'success';
	    for($i = 0; $i < count($components); $i++) :
			$config['file_name'] = $fk_sub_id . '_noise_'. $i;
			$this->upload->initialize($config); 
				
                                    if(! $this->upload->do_upload($i)){
                                        if($_FILES[$i]['error'] != 4) :
                                            // for other errors show the error
                                            $error = $this->upload->display_errors();
                                            return $error;
                                        else :
                                            // It is ok if the user decided not to upload any file
                                            $relative_url = null;
                                            $upload_data = $this->upload->data();
                                            $data = array(
                                                'fk_sub_id' => $fk_sub_id,
                                                'name' => $post[$i],
                                                'url' => str_replace('/ivplc', '', $relative_url)
                                        );
                        		endif;
                                        
                                    }
                                    else{    
                                        $upload_data = $this->upload->data();
                                        $relative_url = str_replace($_SERVER['DOCUMENT_ROOT'], '', $upload_data['full_path']);                                                                        
                                        $data = array(
                                                'fk_sub_id' => $fk_sub_id,
                                                'name' => $post[$i],
                                                'file_name' => $upload_data['file_name'],
                                                'url' => str_replace('/ivplc', '', $relative_url)
                                        );
                                    }
                                    $query = $this->db->insert('components', $data);
                                    
                                       
                                    
		endfor;
		
		return $error;
    }
    
    /* UPDATE COMPONENTS*/
    
    function component_order($orig_sub_id, $component_id){
        $query = $this->db->query("select min(pk_component_id) as min_component_id from components where fk_sub_id= ".$orig_sub_id."");
        $row = $query->row_array();
        $min = $row['min_component_id'];
        $order = $component_id-$min;
        return $order;        
    }
    
    /* This function creates components that are submitted through the edit form*/
    function update_components($orig_sub_id,$new_sub_id, $components, $post_orig_comp_id, $post_comp_name){ 
        
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
                                        if($_FILES[$i]['error'] != 4) :
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
    
    
    
    /* RETURN WITH VEHICLE */
    function return_vehicle_components($fk_sub_id){
		$query = $this->db->get_where('components', array('fk_sub_id'=>$fk_sub_id));
		$components = array();
		
		if( $query->num_rows() > 0 ) :   
			foreach( $query->result_array() as $component ) :
				$components[] = $component;
			endforeach;
			
			return $components;
		endif;
    }
    
    function return_vehicle_components_indexed($fk_sub_id){
		$query = $this->db->get_where('components', array('fk_sub_id'=>$fk_sub_id));
		$components = array();
		
		if( $query->num_rows() > 0 ) :   
			foreach( $query->result_array() as $component ) :
				$components[$component['pk_component_id']] = $component;
			endforeach;
			
			return $components;
		endif;
    }

}