<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Finanzas extends CI_Controller {
	
	var $util,$user,$ModuloActivo,$path,$listar,$Finanzas,$Breadcrumb,$Uri_Last,$Listado;
	
	public function __construct(){    	
        parent::__construct();
		if(!defined('APANEL_FINANZAS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		
		$this->util 		= 	new Util_model();
		$this->Breadcrumb 	=	$this->uri->segment_array();
		$this->Uri_Last		=	$this->uri->segment($this->uri->total_rsegments());
		$this->user			=	$this->session->userdata('User');
		$this->ModuloActivo	=	'Finanzas';
		$this->Path			=	PATH_VIEW.'/Template/'.$this->ModuloActivo;
		$this->listar		=	new stdClass();
		
		if(empty($this->user)){
			redirect(base_url("Main"));	return;
		}			

		if(defined('APANEL_FINANZAS')){
			$this->load->model("Finanzas/Finanzas_model");
			$this->Finanzas	= 	new Finanzas_model();
		}
		chequea_session($this->user);
    }
	
	public function Index(){
		if(!defined('APANEL_FINANZAS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		redirect(base_url($this->uri->segment(1)."/Listado"));	return;
	}
	
	public function Cajas(){
		if(!defined('APANEL_FINANZAS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		
		$this->Finanzas->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Finanzas->search			=		post("search");
		$this->Finanzas->get_fi_cajas();	
		
		/*DEVOLVEMOS RESULTADOS DEPENDIENDO DEL TIPO DE LLAMADO*/
		if ($this->input->is_ajax_request()) {
			$this->Response 	=			array("result"=>$this->Finanzas->result,"code"=>"200");	
			echo answers_json($this->Response);	
		}else{
			$this->listar->view="Finanzas/List_Cajas";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			paginator($this->Finanzas->total_rows);
			$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
			listados($this->listar->view); 	
		}
	}
	
	public function Listado(){
		if(!defined('APANEL_FINANZAS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		
		$this->Finanzas->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Finanzas->search			=		post("search");
		$this->Finanzas->get_all();		
		
		/*DEVOLVEMOS RESULTADOS DEPENDIENDO DEL TIPO DE LLAMADO*/
		if ($this->input->is_ajax_request()) {
			$this->Response 	=			array("result"=>$this->Finanzas->result,"code"=>"200");	
			echo answers_json($this->Response);	
		}else{
			$this->listar->view="Finanzas/List_Finanzas";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			paginator($this->Finanzas->total_rows);
			$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
			listados($this->listar->view); 	
		}
	}
	
	public function CuentasBancarias(){
		if(!defined('APANEL_FINANZAS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		
		$this->Finanzas->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Finanzas->search			=		post("search");
		$this->Finanzas->get_fi_cuentas();		
		
		/*DEVOLVEMOS RESULTADOS DEPENDIENDO DEL TIPO DE LLAMADO*/
		if ($this->input->is_ajax_request()) {
			$this->Response 	=			array("result"=>$this->Finanzas->result,"code"=>"200");	
			echo answers_json($this->Response);	
		}else{
			$this->listar->view="Finanzas/List_Todos";
			$this->util->set_title("Cuentas Bancarias - ".SEO_TITLE);
			paginator($this->Finanzas->total_rows);
			$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
			listados($this->listar->view); 	
		}
	}
	
	public function Add_Cajas(){
		if(!defined('APANEL_FINANZAS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(post()){
			$set	=	$this->Finanzas->set_Caja(post());			
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
					echo '<script>parent.location.reload();</script>';
				}else{
					echo '<script>alert("Error");</script>';
				}
			}
			return;	
		}
		$possible_id		=	$this->uri->segment($this->uri->total_segments());
		$this->Finanzas->get_fi_caja($possible_id);	
		$this->load->model("Departamentos/Departamentos_model");
		$this->Departamentos= 	new Departamentos_model();
		$this->users		=	$this->Departamentos->get_users(array('Administrativos','Asociados','Monitores'),true);		
		$this->listar->view	="Finanzas/Form_Add_Cajas";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
		$this->Listado	=	$this->load->view('Template/Form',array(),TRUE);
		FormAjax($this->listar->view);	
	}
	
	public function Add_CuentasBancarias(){
		if(!defined('APANEL_FINANZAS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(post()){
			$set	=	$this->Finanzas->set_CuentasBancarias(post());			
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
					echo '<script>parent.location.reload();</script>';
				}else{
					echo '<script>alert("Error");</script>';
				}
			}
			return;	
		}
		$possible_id		=	$this->uri->segment($this->uri->total_segments());
		$this->Finanzas->get_fi_cuenta($possible_id);	
		$this->load->model("Departamentos/Departamentos_model");
		$this->Departamentos= 	new Departamentos_model();
		$this->users		=	$this->Departamentos->get_users();		
		$this->listar->view	="Finanzas/Form_".$this->uri->segment(2);
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
		$this->Listado	=	$this->load->view('Template/Form',array(),TRUE);
		FormAjax($this->listar->view);	
	}
	
	public function Export(){
		if(!defined('APANEL_FINANZAS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$explode	=	explode("/",post("doc"));
		switch($explode[1]){
			case 'Cajas':
				$this->Finanzas->get_fi_cajas_export();		
			break;
			case 'CuentasBancarias':
				$this->Finanzas->get_fi_cuentas_export();		
			break;
			default:
				//print_r(post());
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