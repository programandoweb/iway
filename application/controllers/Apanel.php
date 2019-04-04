<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Apanel extends CI_Controller {
	
  var $util,$user,$ModuloActivo,$path,$listar,$Profesiones,$Breadcrumb,$Uri_Last,$Listado;
  	
	public function __construct(){    	
        parent::__construct();
		if(!defined('APANEL')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}

		$this->util 		= 	new Util_model();
		$this->Breadcrumb 	=	$this->uri->segment_array();
		$this->Uri_Last		=	$this->uri->segment($this->uri->total_rsegments());
		$this->user			=	$this->session->userdata('User');
		$this->ModuloActivo	=	'Apanel';
		$this->Path			=	PATH_VIEW.'/Template/'.$this->ModuloActivo;
		$this->listar		=	new stdClass();	

		if(empty($this->user)){
			redirect(base_url("Main"));	return;
		}		

		if(defined('APANEL_PROFESIONES')){
			$this->load->model("Profesiones/Profesiones_model");
			$this->Profesiones	= 	new Profesiones_model();
		}
		chequea_session($this->user);
    }
	
	public function index(){
		$this->util->set_title("Apanel - ".SEO_TITLE); 	
		$this->load->view('Template/Header');
		$this->load->view('Template/Flash');
		if(file_exists($this->Path.'/Menu.php')){
			$this->load->view('Template/Apanel/Menu');			
		}
		$this->load->view('Template/Apanel/Home');
		#$this->load->view('Template/Welcome');
		$this->load->view('Template/Footer');
	}
	
}
?>