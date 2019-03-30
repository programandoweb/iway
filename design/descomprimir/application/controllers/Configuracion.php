<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuracion extends CI_Controller {
	
	var $util,$user,$ModuloActivo,$path,$listar,$Configuracion,$Breadcrumb,$Uri_Last,$Listado;
	
	public function __construct(){    	
        parent::__construct();
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		
		$this->util 		= 	new Util_model();
		$this->Breadcrumb 	=	$this->uri->segment_array();
		$this->Uri_Last		=	$this->uri->segment($this->uri->total_rsegments());
		$this->user			=	$this->session->userdata('User');
		$this->ModuloActivo	=	'Configuracion';
		$this->Path			=	PATH_VIEW.'/Template/'.$this->ModuloActivo;
		$this->listar		=	new stdClass();
		
		if(empty($this->user)){
			redirect(base_url("Main"));	return;
		}			

		if(defined('APANEL_CONFIGURACION')){
			$this->load->model("Configuracion/Configuracion_model");
			$this->Configuracion	= 	new Configuracion_model();
		}
		chequea_session($this->user);
    }
	
	public function Index(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		redirect(base_url($this->uri->segment(1)."/Listado"));	return;
	}
	
	public function Escalas(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		
		$this->Configuracion->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Configuracion->search			=		post("search");
		$this->Configuracion->get_ve_escala_pagos();		
		
		/*DEVOLVEMOS RESULTADOS DEPENDIENDO DEL TIPO DE LLAMADO*/
		if ($this->input->is_ajax_request()) {
			$this->Response 	=			array("result"=>$this->Configuracion->result,"code"=>"200");	
			echo answers_json($this->Response);	
		}else{
			$this->listar->view="Configuracion/List_Escalas";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			paginator($this->Configuracion->total_rows);
			$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
			listados($this->listar->view); 	
		}
	}
	
	public function SwitchPerfiles(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		if(post()){
			$set	=	$this->Configuracion->SetSwitchPerfiles(post());	
			if($set){
				$this->Response 		=			array(	"message"	=>	"Los datos han sido guardados correctamente",
																			"code"		=>	"200");
			}else{
				$this->Response 		=			array(	"message"	=>	"Lo siento, presentamos un problema y no pudimos guardar los datos",
															"code"		=>	"203");
			}
			echo answers_json($this->Response);
			return;
		}
		$this->listar->view="Configuracion/List_Empresas";
		$this->util->set_title("Switch Perfiles - ".SEO_TITLE);
		paginator($this->Configuracion->total_rows);
		listados("Configuracion/Form_SwitchPerfiles"); 	
	}
	
	public function Logo(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}

		$this->Configuracion->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Configuracion->search			=		post("search");
		$this->Configuracion->get_all_empresas();
				
		/*DEVOLVEMOS RESULTADOS DEPENDIENDO DEL TIPO DE LLAMADO*/
		if ($this->input->is_ajax_request()) {
			$this->Response 	=			array("result"=>$this->Configuracion->result,"code"=>"200");	
			echo answers_json($this->Response);	
		}else{
			$this->listar->view="Configuracion/List_Empresas";
			$this->util->set_title("Subir Logo - ".SEO_TITLE);
			paginator($this->Configuracion->total_rows);
			$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
			listados("Configuracion/List_Logos"); 	
		}
	}
		
	public function Firma(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}

		$this->Configuracion->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Configuracion->search			=		post("search");
		$this->Configuracion->get_all_empresas();
				
		/*DEVOLVEMOS RESULTADOS DEPENDIENDO DEL TIPO DE LLAMADO*/
		if ($this->input->is_ajax_request()) {
			$this->Response 	=			array("result"=>$this->Configuracion->result,"code"=>"200");	
			echo answers_json($this->Response);	
		}else{
			$this->listar->view="Configuracion/List_Empresas";
			$this->util->set_title("Subir Firma - ".SEO_TITLE);
			paginator($this->Configuracion->total_rows);
			$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
			listados($this->listar->view); 	
		}
	}

	public function Add_Logo_Ajax(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$set	=	$this->Configuracion->setCropper(post());
		if(!isset($set['error'])){
			$response = array(
				"status" => 'success',
				"url" => IMG.'uploads/'.$set['upload_data']['file_name'],
				"width" => $set['upload_data']['image_width'],
				"height" => $set['upload_data']['image_height']
			);	
		}else{
			 $response = array(
				"status" => 'error',
				"message" => 'ERROR Return Code: '. $set["error"],
			);	
		}
		
		 print json_encode($response);
	}
	
	public function Save_Logo_Ajax(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$set	=	$this->Configuracion->setCropperSave(post());
		if(!isset($set['error'])){
			$response = array(
				"status" => 'success',
				"url" => $set['url']
			);	
		}else{
			 $response = array(
				"status" => 'error',
				"message" => 'ERROR Return Code: '. $set["error"],
			);	
		}
		
		 print json_encode($response);
	}
	
	public function Add_Logo(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(post()){
			$set	=	$this->Configuracion->setLogo(post());	
			return;		
			if ($this->input->is_ajax_request()) {
				if($set){
					$this->Response 		=			array(	"message"	=>	"Los datos han sido guardados correctamente",
																				"code"		=>	"200");
				}else{
					$this->Response 		=			array(	"message"	=>	"Lo siento, presentamos un problema y no pudimos guardar los datos",
																"code"		=>	"203");
				}
				echo answers_json($this->Response);
			}else{
				if(!isset($set['error'])){
					$this->session->set_flashdata('success', 'Felicitaciones, el logotipo ha cambiado sin inconvenientes.');
				}else{
					$this->session->set_flashdata('danger', 'Lo sentimos, '.$set['error'].'.');	
				}
				echo '<script>parent.location.reload();</script>';
				//header("location:".post("redirect"));
			}
			return;	
		}
		$possible_id		=	$this->uri->segment($this->uri->total_segments());
		$this->Configuracion->get($possible_id);	
		$this->listar->view	="Configuracion/Form_Logo";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
		$this->Listado	=	$this->load->view('Template/Form',array(),TRUE);
		//FormAjax($this->listar->view);	
		listados($this->listar->view); 	
	}
	
	public function Add_Firma(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(post()){
			$set	=	$this->Configuracion->setLogo(post());			
			if ($this->input->is_ajax_request()) {
				if($set){
					$this->Response 		=			array(	"message"	=>	"Los datos han sido guardados correctamente",
																				"code"		=>	"200");
				}else{
					$this->Response 		=			array(	"message"	=>	"Lo siento, presentamos un problema y no pudimos guardar los datos",
																"code"		=>	"203");
				}
				echo answers_json($this->Response);
			}else{
				if(!isset($set['error'])){
					$this->session->set_flashdata('success', 'Felicitaciones, el logotipo ha cambiado sin inconvenientes.');
				}else{
					$this->session->set_flashdata('danger', 'Lo sentimos, '.$set['error'].'.');	
				}
				redirect(post("redirect"));
			}
			return;	
		}
		$possible_id		=	$this->uri->segment($this->uri->total_segments());
		$this->Configuracion->get($possible_id);	
		$this->listar->view	="Configuracion/Form_Firma";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
		$this->Listado	=	$this->load->view('Template/Form',array(),TRUE);
		FormAjax($this->listar->view);	
	}
	
	public function Add_CiclosPagos(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(post()){
			$set	=	$this->Configuracion->setCiclosPagos(post());
			if($set){	
				echo '<script>parent.location.reload();</script>';
			}else{
				echo '<script>alert("Error");</script>';
			}
			return;		
		}
		$possible_id		=	$this->uri->segment($this->uri->total_segments());
		$this->Configuracion->get($possible_id);	
		$this->listar->view	="Configuracion/Form_CiclosPagos";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
		$this->Listado	=	$this->load->view('Template/Form',array(),TRUE);
		FormAjax($this->listar->view);	
	}
	
	public function CiclosPagos(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		
		$this->Configuracion->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Configuracion->search			=		post("search");
		$this->Configuracion->get_CiclosPagos();		
		
		/*DEVOLVEMOS RESULTADOS DEPENDIENDO DEL TIPO DE LLAMADO*/
		if ($this->input->is_ajax_request()) {
			$this->Response 	=			array("result"=>$this->Configuracion->result,"code"=>"200");	
			echo answers_json($this->Response);	
		}else{
			$this->listar->view="Configuracion/List_CiclosPagos";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			paginator($this->Configuracion->total_rows);
			$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
			listados($this->listar->view); 	
		}
	}
	
	public function ModificarImagen(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		if(post()){
			$set	=	$this->Configuracion->ModificarImagen(post());
			if(!isset($set['error'])){
				$this->session->set_flashdata('success', 'Felicitaciones, el logotipo ha cambiado sin inconvenientes.');
			}else{
				$this->session->set_flashdata('danger', 'Lo sentimos, '.$set['error'].'.');	
			}
			redirect(post("redirect"));
			return;	
		}		
		listados("Configuracion/Form_ModificarImagen");
	}
	
	public function CortarImagen(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		if(post()){
			$set	=	$this->Configuracion->UploadCropImagen(post());
			redirect(post("redirect"));
			return;	
		}		
		listados("Configuracion/Form_CortarImagen");
	}
	
}

?>