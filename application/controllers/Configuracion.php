<?php

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

		if(!isset($_SERVER['HTTP_REFERER'])){
			redirect(base_url("Main/ErrorUrl"));
			return;
		}			

		if(defined('APANEL_CONFIGURACION')){
			$this->load->model("Configuracion/Configuracion_model");
			$this->Configuracion	= 	new Configuracion_model();
		}
		chequea_session($this->user);
    }
	
	public function sql(){
		$tabla				=	DB_PREFIJO."cont_gastos_operacionales t1";
		$this->db->select("t1.gastos_id, (t1.contabilidad) + 10000 as total");
		$this->db->from($tabla);
		$this->db->like("t1.contabilidad","51");
		$query						=	$this->db->get();
		$rows						=	$query->result();
		foreach($rows as $v){
			if(strlen($v->total)==6 && $v->total<530000){
				$this->db->like("gastos_id",$v->gastos_id);
				$this->db->update($tabla,array("contabilidad2"=>$v->total));
			}
		}
	}

	public function verificaCiclos(){
		$response = consultaCiclo();
		if($response){
			echo json_encode(array(	"code"	=>	200,
									"rows"	=>	$response));	
		}else{
			echo json_encode(array(	"code"	=>	210,
									"rows"	=>	$response));
		}
	}
	
	public function Index(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		redirect(base_url($this->uri->segment(1)."/Listado"));	return;
	}

	public function OpcionesFactura(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		//detect_Sucursal($this->user);
		if(post()){
			$set_Opciones	=	$this->Configuracion->setOpcionesFacturacion(post());	
			if($set_Opciones){
				$this->session->set_flashdata('success', 'Felicitaciones, Las opciones para su factura han sido Cambiadas.');
			}else{
				$this->session->set_flashdata('danger', 'Lo sentimos, ha ocurrido un error al guardar las preferencias para su factura.');
			}
			echo '<script>parent.location.reload();</script>';
			return;
		}
		$this->Configuracion->getOpcionesFacturacion();
		$this->listar->view="Configuracion/Form_OpcionesFactura";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
		FormAjax($this->listar->view); 	
	}

	public function tipoModelo(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		//detect_Sucursal($this->user);
		if(post()){
			$set_tipoModelo	=	set_form_control(post());
			if($set_tipoModelo){
				$this->session->set_flashdata('success', 'La configuracion para tipo de modelos ha sido cambiada');
			}else{
				$this->session->set_flashdata('danger', 'Lo sentimos, ha ocurrido un error al guardar los datos.');
			}
			echo '<script>parent.location.reload();</script>';
			return;
		}
		$this->listar->view="Configuracion/Form_TipoModelo";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
		FormAjax($this->listar->view); 	
	}

	public function ConfiguracionContratos(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		//detect_Sucursal($this->user);
		if(post()){
			if(defined('APANEL_USUARIOS')){
				$this->load->model("Usuarios/Usuarios_model");
				$this->Usuarios	= 	new Usuarios_model();
			}
			$var['json'] = post();
			$set_user	=	$this->Usuarios->set($var);	
			if ($this->input->is_ajax_request()) {	
				if(!isset($set_user['error'])){
					//return $set_user;
					$this->Response 		=			array(	"message"	=>	"Los datos han sido guardados correctamente",
															    "callback"	=>	"reloader_iframe()");
				}else{
					$this->Response 		=			$set_user['error'];
				}
				echo answers_json($this->Response);
			}else{
				if($set_user){	
					echo '<script>parent.location.reload();</script>';
				}else{
					echo '<script>alert("Error");</script>';
				}	
			}
			return;	
		}
		$this->Configuracion->getOpcionesFacturacion();
		$this->listar->view="Configuracion/Form_ConfiguracionContratos";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
		FormAjax($this->listar->view); 	
	}
	
	public function OpcionesHonorariosModelos(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		if(post()){
			$set_Opciones	=	$this->Configuracion->setOpcionesHonorariosModelos(post());	
			if($set_Opciones){
				$tabla		=		DB_PREFIJO."cf_HonorariosModelos";
				$this->db->select('*')->from($tabla);
				$this->db->where('empresa_id',$this->user->id_empresa);
				$query					=	$this->db->get();
				$data					=	$query->row();
				$this->session->set_userdata(array('Configuracion'=>$data));		
				$this->session->set_flashdata('success', 'Felicitaciones, Las opciones para su factura han sido Cambiadas.');
			}else{
				$this->session->set_flashdata('danger', 'Lo sentimos, ha ocurrido un error al guardar las preferencias para su factura.');
			}
			echo '<script>parent.location.reload();</script>';
			return;
		}
		$this->Configuracion->getOpcionesHonorariosModelos();
		$this->listar->view="Configuracion/Form_OpcionesHonorariosModelos";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
		FormAjax($this->listar->view); 	
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
	
	public function Colores(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(post()){
			$set_color		=	$this->Configuracion->setColor(post());	
			
		}
		$this->Configuracion->empresa	=	GetColor($this->user->empresa_id);
		listados("Configuracion/Form_colores"); 
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
			Form("Configuracion/List_Firma"); 	
		}
	}

	public function Add_Logo_Ajax(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
	//	pre(post()); return;
		$set	=	$this->Configuracion->setCropper(post());
		//pre($set); return;	
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
		FormAjax($this->listar->view);
		return; 	
	}
	
	public function Add_Firma(){
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

	public function Subroles(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		
		$this->listar->view="Configuracion/List_Subroles";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view); 	
	}

	public function Plantillas(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		} 
		$this->listar->view="Configuracion/view_Plantillas";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view); 	
	
	}

	public function Notificaciones(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		} 
		$this->listar->view="Configuracion/view_Notificaciones";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view); 	
	}

	public function Preferencias(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->listar->view="Configuracion/view_Preferencias";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view); 

	}

	public function CobrosAutomaticos(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->listar->view="Configuracion/List_CobrosAutomaticos";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view); 
	} 

	public function FormasPago(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Configuracion->GetFormaPagos();
		$this->listar->view="Configuracion/List_FormasPago";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view); 
	}

	public function addFormaPago(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(post()){
			$set=$this->Configuracion->SetFormaPago(post());
			//return;
			if($set){
				$this->session->set_flashdata('success', 'Se guardó correctamente');
				echo '<script>parent.location.reload();</script>';return;
			}
		}
		if($this->uri->segment(3)){
			$this->Configuracion->GetFormaPagos();
		}	
		$this->listar->view	="Configuracion/Form_FormaPago";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
        FormAjax($this->listar->view);
     }
	public function TerminosPago(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->listar->view="Configuracion/List_TerminosPago";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view); 
	}

	public function ListaPrecios(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->listar->view="Configuracion/List_ListaPrecios";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view); 
	}

	public function Parametrizacion(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->listar->view="Configuracion/List_Parametrizacion";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view); 
	}

	public function Colegaje(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->listar->view="Configuracion/List_Colagaje";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view); 
	}

	public function Terminales(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->listar->view="Configuracion/List_Terminales";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view); 
	}

	public function CicloContable(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->listar->view="Configuracion/List_CicloContable";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view); 
	}

	public function Consecutivo(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->listar->view="Configuracion/List_Consecutivo";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view); 
	}

	public function Impuesto(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->listar->view="Configuracion/List_Impuesto";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view); 
	}

	public function Retenciones(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->listar->view="Configuracion/List_Retenciones";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view); 
	}

	public function CapitalSocial(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->listar->view="Configuracion/List_CapitalSocial";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view); 
	}

	public function AjustePatrimonio(){
		if(!defined('APANEL_CONFIGURACION')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->listar->view="Configuracion/List_AjustePatrimonio";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view); 
	}

	
	
}

?>