<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Documentos extends CI_Controller {
	
	var $util,$user,$ModuloActivo,$path,$listar,$Documentos,$Breadcrumb,$Uri_Last,$Listado;
	
	public function __construct(){    	
        parent::__construct();
		if(!defined('APANEL_DOCUMENTOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(!APANEL_DOCUMENTOS){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}

		$this->util 		= 	new Util_model();
		$this->Breadcrumb 	=	$this->uri->segment_array();
		$this->Uri_Last		=	$this->uri->segment($this->uri->total_rsegments());
		$this->user			=	$this->session->userdata('User');
		$this->ModuloActivo	=	'Documentos';
		$this->Path			=	PATH_VIEW.'/Template/'.$this->ModuloActivo;
		$this->listar		=	new stdClass();

		if(!isset($_SERVER['HTTP_REFERER'])){
			redirect(base_url("Main/ErrorUrl"));
			return;
		}
		
		if(empty($this->user)){
			redirect(base_url("Main"));	return;
		}			

		if(defined('APANEL_DOCUMENTOS')){
			$this->load->model("Documentos/Documentos_model");
			$this->Documentos	= 	new Documentos_model();
		}
		
		chequea_session($this->user);
    }
	
	public function Index(){
		if(!defined('APANEL_DOCUMENTOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		redirect(base_url($this->uri->segment(1)."/Listado"));	return;
	}
	
	public function Listado(){
		if(!defined('APANEL_DOCUMENTOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		
		$this->Documentos->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Documentos->search			=		post("search");
		$this->Documentos->get_all();		
		
		/*DEVOLVEMOS RESULTADOS DEPENDIENDO DEL TIPO DE LLAMADO*/
		if ($this->input->is_ajax_request()) {
			$this->Response 	=			array("result"=>$this->Documentos->result,"code"=>"200");	
			echo answers_json($this->Response);	
		}else{
			$this->listar->view="Documentos/List_Documentos";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			paginator($this->Documentos->total_rows);
			$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
			listados($this->listar->view); 	
		}
	}
	
	public function Add(){
		if(!defined('APANEL_DOCUMENTOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(post()){
			$set	=	$this->Documentos->set(post());			
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
		$this->Documentos->get($possible_id);	
		$this->listar->view	="Documentos/Form_Documentos";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
		$this->Listado	=	$this->load->view('Template/Form',array(),TRUE);
		Form($this->listar->view);	
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
		redirect(base_url('Documentos/Listado'));		
	}
	
}

?>