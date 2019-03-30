<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {
	
  var $util,$user,$ModuloActivo,$path,$listar,$Profesiones,$Breadcrumb,$Uri_Last,$Listado;
  	
	public function __construct(){    	
        parent::__construct();
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
		$this->load->model("Ajax/Ajax_model");
		$this->Ajax			= 	new Ajax_model();
		chequea_session($this->user);
    }
	
	public function index(){
		$this->util->set_title("Apanel - ".SEO_TITLE); 	
		$this->load->view('Template/Header');
		$this->load->view('Template/Footer');	
	}
	
}
?>