<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File_Parser extends CI_Model {

    function __construct(){
        parent::__construct();
    }
    
    function images_parser(){
	    foreach($_FILES['image'] as $key => $file) :
	        $i = 0;
	        foreach ($file as $item) :
	            $images[$i][$key] = $item;
	            $i++;
	        endforeach;
	    endforeach;
	
	    return $images;
    }

    function components_parser(){
   	    foreach($_FILES['component'] as $key => $file) :
	        $i = 0;
	        foreach ($file as $item) :
	            $components[$i][$key] = $item;
	            $i++;
	        endforeach;
	    endforeach;
	
	    return $components;
    }
    
    function measurements_parser(){
    	foreach($_FILES['measurement'] as $key => $file) :
    		$i = 0;
    		foreach ($file as $item) :
    			$measurements[$i][$key] = $item;
    			$i++;
    		endforeach;
    	endforeach;
    	
    	return $measurements;
    }
    
}