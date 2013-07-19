<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File_Parser extends CI_Model {

    function __construct(){
        parent::__construct();
    }
    
    function images_parser(){
        if(isset($_FILES['image'])){
	    foreach($_FILES['image'] as $key => $file) :
	        $i = 0;
	        foreach ($file as $item) :
	            $images[$i][$key] = $item;
	            $i++;
	        endforeach;
	    endforeach;
	
	    return $images;
        }
    }
    
    function manual_parser(){
        if(isset($_FILES['manual'])){
             foreach($_FILES['manual'] as $key => $file) :
	        $i = 0;
	        foreach ($file as $item) :
	            $manuals[$i][$key] = $item;
	            $i++;
	        endforeach;
	    endforeach;
	
	    return $manuals;
        }
    }

    function components_parser(){
        if(isset($_FILES['component'])){
   	    foreach($_FILES['component'] as $key => $file) :
	        $i = 0;
	        foreach ($file as $item) :
	            $components[$i][$key] = $item;
	            $i++;
	        endforeach;
	    endforeach;
	
	    return $components;
        }
    }
    
    function measurements_parser(){
        if(isset($_FILES['measurement'])){
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
    
}