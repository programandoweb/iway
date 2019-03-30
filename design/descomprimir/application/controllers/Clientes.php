<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {
	
  var $util,$user,$ModuloActivo,$path,$listar,$Profesiones,$Breadcrumb,$Uri_Last,$Listado;
  	
	public function __construct(){    	
        parent::__construct();
		if(!defined('APANEL_CLIENTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}

		$this->util 		= 	new Util_model();
		$this->Breadcrumb 	=	$this->uri->segment_array();
		$this->Uri_Last		=	$this->uri->segment($this->uri->total_rsegments());
		$this->user			=	$this->session->userdata('User');
		$this->ModuloActivo	=	'Clientes';
		$this->Path			=	PATH_VIEW.'/Template/'.$this->ModuloActivo;
		$this->listar		=	new stdClass();	
		
		if(empty($this->user)){
			redirect(base_url("Main"));	return;
		}		

		if(defined('APANEL_CLIENTES')){
			$this->load->model("Clientes/Clientes_model");
			$this->Clientes	= 	new Clientes_model();
		}
		chequea_session($this->user);
    }
	
	public function Listar(){
		if(!defined('APANEL_CLIENTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}	
		
		/*DEVOLVEMOS RESULTADOS DEPENDIENDO DEL TIPO DE LLAMADO*/
		if ($this->input->is_ajax_request()) {
			$this->Response 	=			array("result"=>$this->Ventas->result,"code"=>"200");	
			echo answers_json($this->Response);	
		}else{
			$this->Clientes->List_Comercial();
			$this->listar->view="Clientes/List_Clientes";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
			listados($this->listar->view); 	
		}
	}

	public function Add_Cliente(){
		if(!defined('APANEL_CLIENTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}		
		if(post()){
			$set_Cliente		=	$this->Clientes->set(post());
			if($set_Cliente){	
				echo '<script>parent.location.reload();</script>';
			}else{
				echo '<script>alert("Error");</script>';
			}
			return;		
		}else{
			$possible_id		=	$this->uri->segment($this->uri->total_segments());	
		}
		
 		$this->listar->view="Clientes/Form_Clientes";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		FormAjax($this->listar->view);
	}

	public function Up_Cliente(){
		if(!defined('APANEL_CLIENTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}		
		if(post()){
			$set		=	$this->Clientes->set(post());
			if($set){	
				echo '<script>parent.location.reload();</script>';
			}else{
				echo '<script>alert("Error");</script>';
			}
			return;		
		}else{
			$possible_id		=	$this->uri->segment($this->uri->total_segments());	
			$this->Clientes->registro($this->uri->segment(3));
			$this->listar->view="Clientes/Form_Clientes";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
			FormAjax($this->listar->view);
		
		}
	}
	public function VerObservacion(){
		if(!defined('APANEL_CLIENTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}	
		
		/*DEVOLVEMOS RESULTADOS DEPENDIENDO DEL TIPO DE LLAMADO*/
		if ($this->input->is_ajax_request()) {
			$this->Response 	=			array("result"=>$this->Ventas->result,"code"=>"200");	
			echo answers_json($this->Response);	
		}else{
			$this->Clientes->Observaciones($this->uri->segment(3));
			$this->listar->view="Clientes/verObservacion";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
			FormAjax($this->listar->view); 	
		}
	}

	public function AddInsidencia(){
		if(!defined('APANEL_CLIENTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}		
		if(post()){
			$set_Incidencia		=	$this->Clientes->setIncidencia(post());
			if($set_Incidencia){	
				echo '<script>parent.location.reload();</script>';
			}else{
				echo '<script>alert("Error");</script>';
			}
			return;		
		}else{
			$possible_id		=	$this->uri->segment($this->uri->total_segments());	
		}
		
 		$this->listar->view="Clientes/Form_Incidencia";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		FormAjax($this->listar->view);
	}

}

?>