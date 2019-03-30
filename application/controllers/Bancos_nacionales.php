<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bancos_nacionales extends CI_Controller {

	public function __construct(){    	
        parent::__construct();
        $this->util 		= 	new Util_model();
		$this->Breadcrumb 	=	$this->uri->segment_array();
		$this->Uri_Last		=	$this->uri->segment($this->uri->total_rsegments());
		$this->user			=	$this->session->userdata('User');
		$this->ModuloActivo	=	'Bancos nacionales';
		$this->Path			=	PATH_VIEW.'/Template/'.$this->ModuloActivo;
		$this->listar		=	new stdClass();	
		if(empty($this->user)){
			redirect(base_url("Main"));	return;
		}
		chequea_session($this->user);		
    } 


  public function index(){
    if(!isset($_SERVER['HTTP_REFERER'])){
        redirect(base_url("Main/ErrorUrl"));
        return;
          }
          
        $this->listar->view="Bancos_nacionales/List_Bancos";
        $this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
        Listados($this->listar->view);	
  }

}

