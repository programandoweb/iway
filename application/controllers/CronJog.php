<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CronJog extends CI_Controller {
	
  	var $u_agent,$CronJog_model;
	public function __construct(){    	
        parent::__construct();
		$u_agent = $_SERVER['HTTP_USER_AGENT'];
		if(preg_match('/Mozilla/i',$u_agent)){
			//redirect(base_url("Main/modulo_inactivo"));	return;
			$this->load->model("CronJog/CronJog_model");
			$this->CronJog_model	= 	new CronJog_model();
		}else if(preg_match('/curl/i',$u_agent)){
			$this->u_agent	=	$u_agent;
			$this->load->model("CronJog/CronJog_model");
			$this->CronJog_model	= 	new CronJog_model();
		} 
	}
  	
	public function index(){
		
	}
	
	public function PeriodoPrueba(){
		//pre($this->CronJog_model);
		$this->CronJog_model->PeriodoPrueba();
	}
	
}
?>