<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Politicas extends CI_Controller {
	
  var $util,$user,$ModuloActivo,$path,$listar,$Profesiones,$Breadcrumb,$Uri_Last,$Listado;
  	
	public function __construct(){ 	
	    parent::__construct();
		$this->load->model("Util_model");
		$this->util 		= 	new Util_model();
		$this->Breadcrumb 	=	$this->uri->segment_array();
		$this->Uri_Last		=	$this->uri->segment($this->uri->total_rsegments());
		$this->user			=	$this->session->userdata('User');
		$this->ModuloActivo	=	'Politicas';
		$this->Path			=	PATH_VIEW.'/Template/'.$this->ModuloActivo;
		$this->listar		=	new stdClass();

		if(!isset($_SERVER['HTTP_REFERER'])){
			redirect(base_url("Main/ErrorUrl"));
			return;
		}	
		
    }
	function MostrarPoliticas(){
		$this->util->set_title("Politicas - ".SEO_TITLE); 	
		$this->load->view('Template/Header');
		$this->load->view('Template/Apanel/Menu');
		$this->load->view('Template/Politicas');
		$this->load->view('Template/Footer');
	}
	
}
?>