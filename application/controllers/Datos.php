<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Datos extends CI_Controller {
	
	var $util,$user,$ModuloActivo,$path,$listar,$Datos,$Breadcrumb,$Uri_Last,$Listado;
	
	public function __construct(){    	
        parent::__construct();
		if(!defined('APANEL_DATOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		
		$this->util 		= 	new Util_model();
		$this->Breadcrumb 	=	$this->uri->segment_array();
		$this->Uri_Last		=	$this->uri->segment($this->uri->total_rsegments());
		$this->user			=	$this->session->userdata('User');
		$this->ModuloActivo	=	'Datos';
		$this->Path			=	PATH_VIEW.'/Template/'.$this->ModuloActivo;
		$this->listar		=	new stdClass();

		if(!isset($_SERVER['HTTP_REFERER'])){
			redirect(base_url("Main/ErrorUrl"));
			return;
		}
		
		if(empty($this->user)){
			redirect(base_url("Main"));	return;
		}			

		if(defined('APANEL_DATOS')){
			$this->load->model("Datos/Datos_model");
			$this->Datos	= 	new Datos_model();
		}
		chequea_session($this->user);
    }
	
	public function Index(){
		if(!defined('APANEL_DATOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		redirect(base_url($this->uri->segment(1)."/Listado"));	return;
	}
	
	public function Webs(){
		$this->Datos->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Datos->search			=		post("search");
		$this->Datos->get_TRM();	
		$this->listar->view="Datos/List_Paginas";
		$this->util->set_title($this->ModuloActivo	." - ". SEO_TITLE);
		paginator($this->Datos->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 
	}
	
	public function Resultado(){
		$this->Datos->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Datos->search			=		post("search");
		$this->Datos->get_TRM();	
		$this->listar->view="Datos/List_Paginas";
		$this->util->set_title($this->ModuloActivo	." - ". SEO_TITLE);
		paginator($this->Datos->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 
	}
		
}

?>