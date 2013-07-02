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
	    
	    for($i = 0; $i < count($images); $i++) :
			$config['file_name'] = $fk_sub_id . '_image_'.$i;
			$this->upload->initialize($config); 
			$this->upload->do_upload($i);
		
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
			
			$query = $this->db->insert('images', $data);
		endfor;
    }  

	function return_vehicle_images($fk_sub_id){
		$query = $this->db->get_where('images', array('fk_sub_id' => $fk_sub_id));
		$images = array();

		if( $query->num_rows() > 0 ) :   
			foreach( $query->result_array() as $image ) :
				$images[] = $image['url'];
			endforeach;

			return $images;
		endif;
    }

}