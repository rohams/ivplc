<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Images extends CI_Model {

    function __construct(){
        parent::__construct();
    }
    
    function upload_images($fk_sub_id, $images){    
		$config = array(
			'upload_path' => './uploads/car_images/',
			'allowed_types' => 'gif|jpg|png',
			'max_size' => '2048',
			'overwrite' => true
		);
	
	    $_FILES = $images;
	    $error = 'success';
	    for($i = 0; $i < count($images); $i++) :
			$config['file_name'] = $fk_sub_id . '_image_'.$i;
			$this->upload->initialize($config); 
                        if(! $this->upload->do_upload($i)){
                            if($_FILES[$i]['error'] != 4) :
                                // for other errors show the error
                                $error = $this->upload->display_errors();
                                return $error;
                            else :
                                $upload_data = $this->upload->data();   
                                $data['fk_sub_id']=$fk_sub_id;
                                $new_data['url']=null;                                                                 
                            endif;
                        }
                        else{
                            $upload_data = $this->upload->data();
                            $relative_url = str_replace($_SERVER['DOCUMENT_ROOT'], '', $upload_data['full_path']);

                            $resize = array(
                                    'image_library' => 'gd2',
                                    'source_image' => str_replace('/ivplc', '', $relative_url),
                                    'maintain_ratio' => TRUE,
                                    'width' => '920'
                            );

                            $this->image_lib->initialize($resize);
                            $this->image_lib->resize();

                            $data = array(
                                    'fk_sub_id' => $fk_sub_id,
                                    'url' => str_replace('/ivplc', '', $relative_url)
                            );
                        }
			$query = $this->db->insert('images', $data);
		endfor;
    }  

    
       function image_order($orig_sub_id, $image_id){
        $query = $this->db->query("select min(pk_image_id) as min_image_id from images where fk_sub_id= ".$orig_sub_id."");
        $row = $query->row_array();
        $min = $row['min_image_id'];
        $order = $image_id-$min;
        return $order;        
    }
    
    /* This function creates components that are submitted through the edit form*/
    function update_images($orig_sub_id,$new_sub_id, $images, $post_orig_image_id){ 
        
            $config = array(
                    'upload_path' => './uploads/car_images/',
                    'allowed_types' => 'gif|jpg|png',
                    'max_size' => '2048',
                    'overwrite' => true
            );

	    $_FILES = $images;
            $new_data = array();
            $new_datas = array();
	    $error = 'success';
	    for($i = 0; $i < count($images); $i++) :
			$config['file_name'] = $new_sub_id . '_noise_'. $i;
			$this->upload->initialize($config); 
				
                                    if(! $this->upload->do_upload($i)){
                                        if($_FILES[$i]['error'] != 4) :
                                            $error = $this->upload->display_errors();
                                            return $error;
                                        else :
                                            $upload_data = $this->upload->data();   
                                            $new_data['fk_sub_id']=$new_sub_id;
                                            $new_data['url']=null;
                                            $new_datas[]=$new_data;
                        		endif;
                                    }
                                    else{    
                                        $upload_data = $this->upload->data();
                                        $relative_url = str_replace($_SERVER['DOCUMENT_ROOT'], '', $upload_data['full_path']);                                                                        
                                        $new_data['fk_sub_id']=$new_sub_id;
                                        $new_data['url']=str_replace('/ivplc', '', $relative_url);
                                        $new_datas[]=$new_data;
                                    }                                                                                                            
		endfor;
                

		//check for exisiting files from previous revision
                if(isset($post_orig_image_id)){
                    $orig_data = array();
                    $orig_datas = array();
                    $orders = array();
                    for($i = 0; $i < count($post_orig_image_id); $i++) :
                        $query=  $this->db->query("select url from images where pk_image_id= ".$post_orig_image_id[$i]."");
                         if( $query->num_rows() > 0 ) : 
                            $row = $query->row_array(); 
                            $orig_data['url']=$row['url'];
                            $orig_data['fk_sub_id']=$new_sub_id;
                            $orig_datas[]=$orig_data;
                            $order=$this->image_order($orig_sub_id, $post_orig_image_id[$i]);
                            $orders[]= $order;
                        endif;
                    endfor;
                }
                //insert orig and new into images table
                $orig_index =0;
                $new_index =0;
                $orig_count=count($orig_datas);
                if(isset($orders)){
                    $orig_order=$orders[$orig_index];
                }
                for ($i =0; $i <(count($new_datas)+count($orig_datas));$i++):    
                    if($i == $orig_order){
                        $query = $this->db->insert('images', $orig_datas[$orig_index]);
                        $orig_index++;
                        if($orig_index < $orig_count){
                            $orig_order =$orders[$orig_index];
                        }
                    }
                    else{
                        $query = $this->db->insert('images', $new_datas[$new_index]);
                        $new_index++;
                    }                   
                endfor;                
            return $error;
    }
    
    
    
    
	function return_vehicle_images($fk_sub_id){
		$query = $this->db->get_where('images', array('fk_sub_id' => $fk_sub_id));
		$images = array();

		if( $query->num_rows() > 0 ) :   
			foreach( $query->result_array() as $image ) :
				$images[] = $image;
			endforeach;

			return $images;
		endif;
    }

}