<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas extends CI_Controller {
	
	var $util,$user,$ModuloActivo,$path,$listar,$Ventas,$Breadcrumb,$Uri_Last,$Listado;
	
	public function __construct(){    	
        parent::__construct();
		if(!defined('APANEL_VENTAS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		
		$this->util 		= 	new Util_model();
		$this->Breadcrumb 	=	$this->uri->segment_array();
		$this->Uri_Last		=	$this->uri->segment($this->uri->total_rsegments());
		$this->user			=	$this->session->userdata('User');
		$this->ModuloActivo	=	'Ventas';
		$this->Path			=	PATH_VIEW.'/Template/'.$this->ModuloActivo;
		$this->listar		=	new stdClass();
		
		if(empty($this->user)){
			redirect(base_url("Main"));	return;
		}			

		if(defined('APANEL_VENTAS')){
			$this->load->model("Ventas/Ventas_model");
			$this->Ventas	= 	new Ventas_model();
		}
		chequea_session($this->user);
    }
	
	public function Index(){
		if(!defined('APANEL_VENTAS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		redirect(base_url($this->uri->segment(1)."/Listado"));	return;
	}
	
	public function Escalas(){
		if(!defined('APANEL_VENTAS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		
		$this->Ventas->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Ventas->search			=		post("search");
		$this->Ventas->get_ve_escala_pagos();		
		
		/*DEVOLVEMOS RESULTADOS DEPENDIENDO DEL TIPO DE LLAMADO*/
		if ($this->input->is_ajax_request()) {
			$this->Response 	=			array("result"=>$this->Ventas->result,"code"=>"200");	
			echo answers_json($this->Response);	
		}else{
			$this->listar->view="Ventas/List_Escalas";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			paginator($this->Ventas->total_rows);
			$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
			listados($this->listar->view); 	
		}
	}
	
	public function FormasPagos(){
		if(!defined('APANEL_VENTAS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		
		$this->Ventas->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Ventas->search			=		post("search");
		$this->Ventas->get_ve_FormasPagos();		
		
		/*DEVOLVEMOS RESULTADOS DEPENDIENDO DEL TIPO DE LLAMADO*/
		if ($this->input->is_ajax_request()) {
			$this->Response 	=			array("result"=>$this->Ventas->result,"code"=>"200");	
			echo answers_json($this->Response);	
		}else{
			$this->listar->view		=	"Ventas/List_FormasPagos";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			paginator($this->Ventas->total_rows);
			$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
			listados($this->listar->view); 	
		}
	}
	
	public function Listado(){
		if(!defined('APANEL_VENTAS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		
		$this->Ventas->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Ventas->search			=		post("search");
		$this->Ventas->get_all();		
		
		/*DEVOLVEMOS RESULTADOS DEPENDIENDO DEL TIPO DE LLAMADO*/
		if ($this->input->is_ajax_request()) {
			$this->Response 	=			array("result"=>$this->Ventas->result,"code"=>"200");	
			echo answers_json($this->Response);	
		}else{
			$this->listar->view="Ventas/List_Ventas";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			paginator($this->Ventas->total_rows);
			$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
			listados($this->listar->view); 	
		}
	}
	
	public function TRM(){
		if(!defined('APANEL_VENTAS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		
		$this->Ventas->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Ventas->search			=		post("search");
		$this->Ventas->get_TRM();		
		
		/*DEVOLVEMOS RESULTADOS DEPENDIENDO DEL TIPO DE LLAMADO*/
		if ($this->input->is_ajax_request()) {
			$this->Response 	=			array("result"=>$this->Ventas->result,"code"=>"200");	
			echo answers_json($this->Response);	
		}else{
			$this->listar->view="Ventas/List_TRM";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			paginator($this->Ventas->total_rows);
			$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
			listados($this->listar->view); 	
		}
	}
	
	public function CerrarTRM(){
		if(!defined('APANEL_VENTAS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(post()){
			$set	=	$this->Ventas->setCiclosPagos(post());
			if($set){	
				echo '<script>parent.location.reload();</script>';
			}
			return;		
		}
		$possible_id		=	$this->uri->segment($this->uri->total_segments());
		$this->Ventas->get($possible_id);	
		$this->listar->view	="Ventas/Form_CerrarTRM";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
		$this->Listado	=	$this->load->view('Template/Form',array(),TRUE);
		FormAjax($this->listar->view);
	}
	
	public function Add(){
		if(!defined('APANEL_VENTAS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(post()){
			$set	=	$this->Ventas->set(post());			
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
				$this->session->set_flashdata('danger', 'Lo siento, presentamos un problema y no pudimos guardar los datos');
				redirect(current_url());
			}
			return;	
		}
		$possible_id		=	$this->uri->segment($this->uri->total_segments());
		$this->Ventas->get($possible_id);
		
		if($this->user->id_empresa==13){	
			$this->listar->view	="Ventas/Form_Ventas_Belle";
		}else{
			$this->listar->view	="Ventas/Form_Ventas";
		}
		
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
		$this->Listado	=	$this->load->view('Template/Form',array(),TRUE);
		Form($this->listar->view);	
	}
	
	public function Add_Escala(){
		if(!defined('APANEL_VENTAS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(post()){
			$set	=	$this->Ventas->set_escala(post());			
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
				$this->session->set_flashdata('danger', 'Lo siento, presentamos un problema y no pudimos guardar los datos');
				redirect(current_url());
			}
			return;	
		}
		$possible_id		=	$this->uri->segment($this->uri->total_segments());
		$this->Ventas->get_escala($possible_id);
		//pre($this->user->sistema_salarial);
		//echo 	$this->user->id_empresa;return;	
		if($this->user->sistema_salarial==1){	
			$this->listar->view	="Ventas/Form_Ventas_Belle";
		}else{
			$this->listar->view	="Ventas/Form_Ventas";
		}
		
		//$this->listar->view	="Ventas/Form_Ventas";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
		$this->Listado	=	$this->load->view('Template/Form',array(),TRUE);
		FormAjax($this->listar->view);	
	}
	
	public function Add_FormasPagos(){
		if(!defined('APANEL_VENTAS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(post()){
			$set	=	$this->Ventas->set_forma_pagos(post());			
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
				if($set){
					$this->session->set_flashdata('info', 'Los datos han sido guardados correctamente');
					echo '<script>parent.location.reload();</script>';return;
				}else{
					$this->session->set_flashdata('danger', 'Lo siento, presentamos un problema y no pudimos guardar los datos');
					redirect(current_url());
				}				
			}
			return;	
		}
		$possible_id		=	$this->uri->segment($this->uri->total_segments());
		$this->Ventas->get_FormasPagos($possible_id);	
		$this->listar->view	="Ventas/Form_FormasPagos";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
		$this->Listado	=	$this->load->view('Template/Form',array(),TRUE);
		FormAjax($this->listar->view);	
	}
	
	public function Listado_Del(){
		if($id 	= 	$this->uri->segment(3)){
			$delete = $this->db->delete(DB_PREFIJO.'ma_documentos', array('id_documento'	=>	$id));
			if($delete){
				$this->session->set_flashdata('success', 'El registro se borró correctamente');			
			}else{
				$this->session->set_flashdata('danger', 'No se pudo borrar el registro');	
			}
		}
		redirect(base_url('Ventas/Listado'));		
	}
	
	public function Export(){
		if(!defined('APANEL_VENTAS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$explode	=	explode("/",post("doc"));
		//print_r($explode);	return; 
		switch($explode[1]){
			case 'FormasPagos':
				$this->Ventas->get_ve_FormasPagos();		
			break;
			case 'Escalas':
				$this->Ventas->get_ve_escala_pagos();		
			break;
			default:
				return;
			break;
		}
		
		$modulo		=	$this->ModuloActivo;
		$ciclo		=	$this->$modulo->fields;
		if(post("excel")){
			listados_export($ciclo,$this->$modulo->result); 	
		}
		if(post("pdf")){
			listados_export_pdf($ciclo,$this->$modulo->result); 	
		}	
	}
	
}

?>