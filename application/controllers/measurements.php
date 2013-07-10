<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Measurements extends CI_Controller {

	function __construct(){
	    parent::__construct();
	}
	
	public function index($pk_vehicle_id = null){
		$data = array(
			'parent' => 'measurements',
			'page' => 'measurements',
			'title' => 'Measurements',
			'manufacturers' => $this->manufacturers->return_manufacturers('',true)
		);
		
		$this->load->view('header', $data);
		$this->load->view('nav', $data);
		
		if($pk_vehicle_id != null) :
			$vehicle = $this->vehicles->return_vehicles($pk_vehicle_id);
			$data['vehicle'] = $vehicle[0];
			$this->load->view('measurements/vehicle', $data);
		else :
			$data['vehicles'] = $this->vehicles->return_vehicles();
			$this->load->view('measurements/index', $data);
		endif;
		
		$this->load->view('footer', $data);
	}
	
}