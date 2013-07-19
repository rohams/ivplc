<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manuals extends CI_Model {

    function __construct(){
        parent::__construct();
    }
    
    function upload_manual($fk_sub_id, $manual){    
		$config = array(
			'upload_path' => './uploads/manual/',
			'allowed_types' => 'xlsx|xls|zip|m|txt|rtf|doc|docx',
			'max_size' => '2048',
			'overwrite' => true
		);
	
	    $_FILES = $manual;
	    $error = 'success';
            $config['file_name'] = $fk_sub_id . '_manual';
            $this->upload->initialize($config);
            $i=0;
            if(! $this->upload->do_upload($i)){
                if($_FILES[$i]['error'] != 4) :
                    // for other errors show the error
                    $error = $this->upload->display_errors();
                    return $error;
                else :
                    $upload_data = $this->upload->data();   
                    $data['fk_sub_id']=$fk_sub_id;
                    $data['url']=null;
                    $data['file_name']=null; 
                endif;
            }
            else{
                $upload_data = $this->upload->data();
                $relative_url = str_replace($_SERVER['DOCUMENT_ROOT'], '', $upload_data['full_path']);

                $data = array(
                        'fk_sub_id' => $fk_sub_id,
                        'file_name' => $upload_data['file_name'],
                        'url' => str_replace('/ivplc', '', $relative_url)
                );
            }
            $query = $this->db->insert('manuals', $data);
    }  
    
    
    function update_manual($new_sub_id, $post_orig_manual_id){ 
        
        //check for exisiting manual from previous revision
            $orig_data = array();
            for($i = 0; $i < count($post_orig_manual_id); $i++) :
                $query=  $this->db->query("select file_name, url from manuals where pk_manual_id= ".$post_orig_manual_id[$i]."");
                 if( $query->num_rows() > 0 ) : 
                    $row = $query->row_array(); 
                    $orig_data['url']=$row['url'];
                    $orig_data['file_name'] = $row['file_name'];
                    $orig_data['fk_sub_id'] = $new_sub_id;
                    $query = $this->db->insert('manuals', $orig_data);
                endif;
            endfor;
        }               

        
    
	function return_vehicle_manuals($fk_sub_id){
		$query = $this->db->get_where('manuals', array('fk_sub_id' => $fk_sub_id));
		$manuals = array();

		if( $query->num_rows() > 0 ) :   
			foreach( $query->result_array() as $manual ) :
				$manuals[] = $manual;
			endforeach;

			return $manuals;
		endif;
    }

}