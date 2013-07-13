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
    
    /* INSERT COMPONENTS IN EDIT MODE */
    function insert_orig_components ($fk_sub_id, $post_id, $post_name ){
        $data= array();
         for($i = 0; $i < count($post_id); $i++) :
            $query=  $this->db->query("select url, file_name from components where pk_component_id= ".$post_id[$i]."");
             if( $query->num_rows() > 0 ) : 
                $row = $query->row_array();
                //bug: what if name is not corrolated with post_name (i.e we have only the third component as the orig component, in this case the first component name is assigned to the third component)
                //solution: know the order
             
                $data['name']=$post_name[$i];
                $data['url']=$row['url'];
                $data['file_name']=$row['file_name'];
                $data['fk_sub_id']=$fk_sub_id;
                $query2 = $this->db->insert('components', $data);
                $insert_id = $this->db->insert_id();
            endif;
         endfor;
        
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