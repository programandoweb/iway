<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	
  var $util,$user,$Response;
	
	public function __construct(){    	
        parent::__construct();
		$this->util 		= 	new Util_model();		
		$this->user			=	$this->session->userdata('User');
    }
	
	public function index(){
		$this->util->set_title(SEO_TITLE); 	
		$this->load->view('Template/Header');			
		if(!empty($this->user)){
			if(MODULO_X_DEFAULT){
				redirect(base_url(MODULO_X_DEFAULT));	
			}else{			
				$this->load->view('Template/Welcome');
			}
		}else{
			redirect(base_url("Autenticacion"));
		}
		$this->load->view('Template/Footer');	
	}
	
	public function modulo_inactivo(){
		$this->util->set_title("Módulo Inactivo - ".SEO_TITLE);
		$this->load->view('Template/Header');
		$this->load->view('Template/Flash');  	
		$this->load->view('Template/Inactivo');
		$this->load->view('Template/Footer');
		return;	
	}

	public function ErrorUrl(){
		$this->util->set_title("Módulo Inactivo - ".SEO_TITLE);
		$this->load->view('Template/Header');
		$this->load->view('Template/Flash');  	
		$this->load->view('Template/ErrorUrl');
		$this->load->view('Template/Footer');
		return;	
	}
	
	public function Error_NoSucursal(){
		$this->util->set_title("Módulo Inactivo - ".SEO_TITLE);
		$this->load->view('Template/Header');
		$this->load->view('Template/Flash');  	
		$this->load->view('Template/Error_NoSucursal');
		$this->load->view('Template/Footer');
		return;	
	}
	
	public function error_404(){
		if (!$this->input->is_ajax_request()) {
			$this->util->set_title("Error 404 - ".SEO_TITLE); 	
			$this->load->view('Template/Header');			
			$this->load->view('Template/Error_404');
			$this->load->view('Template/Footer');
		}else{
			$this->Response 		=			array(	"message"	=>	"Lo siento, la página o módulo no existe",
														"code"		=>	"203");
			echo answers_json($this->Response);															
		}
	}
	
}
?>