<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Empresas extends CI_Controller {
	
	var $util,$user,$ModuloActivo,$path,$listar,$Empresas,$Breadcrumb,$Uri_Last;
	
	public function __construct(){    	
        parent::__construct();
		if(!defined('APANEL_EMPRESAS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(!APANEL_EMPRESAS){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}

		$this->util 		= 	new Util_model();
		$this->Breadcrumb 	=	$this->uri->segment_array();
		$this->Uri_Last		=	$this->uri->segment($this->uri->total_rsegments());
		$this->user			=	$this->session->userdata('User');
		$this->ModuloActivo	=	'Empresas';
		$this->Path			=	PATH_VIEW.'/Template/'.$this->ModuloActivo;
		$this->listar		=	new stdClass();	
		
		if(empty($this->user)){
			redirect(base_url("Main"));	return;
		}		

		if(defined('APANEL_EMPRESAS')){
			$this->load->model("Empresas/Empresas_model");
			$this->Empresas	= 	new Empresas_model();
		}
		chequea_session($this->user);
    }
	
	public function Index(){
		if(!defined('APANEL_EMPRESAS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
	
		if(!isset($_SERVER['HTTP_REFERER'])){
			redirect(base_url("Main/ErrorUrl"));
			return;
		}
		$this->Empresas->getEmpresa();
		$this->listar->view="Empresas/List_Empresas";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		Listados($this->listar->view);
	}

	public function ConfiguracionDocumentos(){
		if(post()){
			$response = $this->Empresas->modificarConsecutivo(post());
			$this->session->set_flashdata($response[0],$response[1]);
			redirect(current_url());
			return;
		}
		$this->Empresas->getDocumentos($this->uri->segment($this->uri->total_segments()));
		$this->listar->view="Empresas/ConfiguracionDocumentos";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		FormAjax($this->listar->view); 
	}
	
	public function Listado(){
		if(!defined('APANEL_EMPRESAS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		
		$this->Empresas->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Empresas->search			=		post("search");
		$this->Empresas->get_all();		
		
		/*DEVOLVEMOS RESULTADOS DEPENDIENDO DEL TIPO DE LLAMADO*/
		if ($this->input->is_ajax_request()) {
			$this->Response 	=			array("result"=>$this->Empresas->result,"code"=>"200");	
			echo answers_json($this->Response);	
		}else{
			$this->listar->view="Empresas/List_Empresas";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			paginator($this->Empresas->total_rows);
			$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
			listados($this->listar->view); 	
		}
	}
	
	public function Ver(){
		if(!defined('APANEL_EMPRESAS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Empresas->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Empresas->search			=		post("search");
	  $this->Empresas->getEmpresa();		
		$this->listar->view				=		"Empresas/List_ver";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		//paginator($this->Empresas->total_rows);
		FormAjax($this->listar->view); 			
	}
	
	public function Add(){
		if(!defined('APANEL_EMPRESAS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(post()){
			//pre(post()); return;
			$set	=	$this->Empresas->set(post());
		   //return;
			if ($this->input->is_ajax_request()){
				if($set){
					$this->Response 		=			array(	"message"	=>	"Los datos han sido guardados correctamente",
																				"code"		=>	"200");
				}else{
					$this->Response 		=			array(	"message"	=>	"Lo siento, presentamos un problema y no pudimos guardar los datos",
																"code"		=>	"203");
				}
				//echo answers_json($this->Response);
			}else{
				if($set){
					$this->session->set_flashdata('success', 'El registro se guardó correctamente');
					echo '<script>parent.location.reload();</script>';return;
				}else{
					$this->session->set_flashdata('danger', 'Lo siento, presentamos un problema y no pudimos guardar los datos');
					redirect(current_url());
				}
			}
			return;	
		}
		$possible_id		=	$this->uri->segment($this->uri->total_segments());
		if($this->uri->segment(3)){
			$this->Empresas->getEmpresa();
		}	
		$this->listar->view	="Empresas/Form_Empresas";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
		//$this->Listado	=	$this->load->view('Template/Form',array(),TRUE);
		FormAjax($this->listar->view);	
	}
	
	public function Sucursales(){
		if(!defined('APANEL_EMPRESAS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(post()){
			$set	=	$this->Empresas->set(post());			
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
		$this->Empresas->get($possible_id);	
		$this->listar->view	="Empresas/Form_Sucursales";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
		$this->Listado	=	$this->load->view('Template/Form',array(),TRUE);
		Form($this->listar->view);	
	}	
	
	public function Listado_Del(){
		if($id 	= 	$this->uri->segment(3)){
			$delete = $this->db->delete(DB_PREFIJO.'usuarios', array('user_id'	=>	$id));
			if($delete){
				$this->session->set_flashdata('success', 'El registro se borró correctamente');			
			}else{
				$this->session->set_flashdata('danger', 'No se pudo borrar el registro');	
			}
		}
		redirect(base_url('Empresas/Listado'));		
	}
	
	public function Export(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Empresas->get_all_export();		
		$this->section		=	"ListaEmpresas";
		$this->listar->view	=	"Usuarios/List_Export";		
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