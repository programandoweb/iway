<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {
	
	var $util,$user,$ModuloActivo,$path,$listar,$Usuarios,$Breadcrumb,$Uri_Last,$Listado;
	
	public function __construct(){    	
        parent::__construct();
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(!APANEL_USUARIOS){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}

		$this->util 		= 	new Util_model();
		$this->Breadcrumb 	=	$this->uri->segment_array();
		$this->Uri_Last		=	$this->uri->segment($this->uri->total_rsegments());
		$this->user			=	$this->session->userdata('User');
		$this->ModuloActivo	=	'Usuarios';
		$this->Path			=	PATH_VIEW.'/Template/'.$this->ModuloActivo;
		$this->listar		=	new stdClass();			

		if(empty($this->user)){
			redirect(base_url("Main"));	return;
		}
		
		if(defined('APANEL_USUARIOS')){
			$this->load->model("Usuarios/Usuarios_model");
			$this->Usuarios	= 	new Usuarios_model();
		}
		chequea_session($this->user);
    }
	
	public function Index(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		redirect(base_url($this->uri->segment(1)."/Listado"));	return;
	}
	
	public function ResumenModelos(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode						=		explode("-",$this->uri->segment(3));
		$this->Usuarios->ResumenModelos();
		$this->listar->view="Usuarios/List_ResumenModelos";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 	
	}
	
	public function ResumenPaginas(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode						=		explode("-",$this->uri->segment(3));
		$this->Usuarios->ResumenPaginas();
		$this->listar->view="Usuarios/List_ResumenPaginas";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 	
	}

	public function ResumenEntrevistas(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode						=		explode("-",$this->uri->segment(3));
		$this->Usuarios->ResumenPaginas();
		$this->listar->view="Usuarios/List_ResumenEntrevistas";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 	
	}
	
	public function ResumenSeguridadSocial(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode						=		explode("-",$this->uri->segment(3));
		$this->Usuarios->ResumenPaginas();
		$this->listar->view="Usuarios/List_ResumenPaginas";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 	
	}
	
	public function GetEmpresasAjax(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Usuarios->get_empresa(post("id"));
		$this->dep_users		=	$this->Usuarios->get_sedes_by_empresa(post("id"));
		$this->atributos_sedes	=	$this->Usuarios->get_atributos_sedes();
		if ($this->input->is_ajax_request()) {
			$this->load->view('Template/Usuarios/Form_EmpresasAjax');
		}else{
			//redirect(base_url());return;
		}
	}
	
	public function Todos(){
		
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		
		$explode	=	explode("-",$this->uri->segment(3));
		if(count($explode)>1){
			$this->Usuarios->get_all_accionistas(null,$explode[1]);
			$this->centrodecostos	=	$this->Usuarios->centroCosto($explode[1]);
			$this->listar->view="Usuarios/List_Accionistas";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			paginator($this->Usuarios->total_rows);
			$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
			listados($this->listar->view); 
		}else if($this->uri->segment(3)=='CentroCostos'){
			$this->Usuarios->get_all_x_type(array($this->uri->segment(3)));
			$this->listar->view="Usuarios/List_CentroCostos";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			paginator($this->Usuarios->total_rows);
			$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
			listados($this->listar->view); 
		}else{
			$this->Usuarios->get_all_x_type(array($this->uri->segment(3)));
			$this->listar->view="Usuarios/List_Todos";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			paginator($this->Usuarios->total_rows);
			$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
			listados($this->listar->view); 
		}
	}
	
	public function CuentasBancarias(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode	=	explode("-",$this->uri->segment(3));
		$this->Usuarios->SeguridadSocial(array("Asociados","Modelos","Monitores","Administrativos"));
		$this->listar->view="Usuarios/List_CuentasBancarias";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 
	}
	
	public function Diasasistidos(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		
		if(post()){
			$set_user		=	$this->Usuarios->setDiasTrabajados(post());	
			if(!isset($set_user['error'])){
				$this->Response 		=			array(	"code"		=>	"200");
			}else{
				$this->Response 		=			$set_user['error'];
			}
			echo answers_json($this->Response);	return;					
		}
		
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode	=	explode("-",$this->uri->segment(3));
		$this->Usuarios->SeguridadSocial(array("Asociados","Modelos","Monitores","Administrativos"));
		$this->listar->view="Usuarios/List_DiasTrabajados";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 
	}
	
	public function AddOtrosIngresos(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		if(post()){
			$set_user		=	$this->Usuarios->setOtrosIngresos(post());	
			if(post("iframe")=='Add_Todos_Iframe'){
				if(!isset($set_user['error'])){	
					$this->Response 		=			array(	"message"	=>	"Los datos han sido guardados correctamente",
																"callback"	=>	"reloader_iframe()");
				}else{
					$this->Response 		=			array(	"message"	=>	"No se pudo guardar los datos",
																"code"		=>	"203");
				}
				echo answers_json($this->Response);			return;	
			}else{
				if(!isset($set_user['error'])){
					$this->Response 		=			array(	"message"	=>	"Los datos han sido guardados correctamente",
																				"code"		=>	"200");
				}else{
					$this->Response 		=			$set_user['error'];
				}
				echo answers_json($this->Response);			return;					
			}
			
		}else{
			$possible_id		=	$this->uri->segment($this->uri->total_segments());	
		}
		$this->Usuarios->get($this->uri->segment(3));
		$this->listar->view="Usuarios/Form_AddOtrosIngresos";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		FormAjax($this->listar->view); 
	}
	
	
	public function AddCuentasBancarias(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		if(post()){
			$set_user		=	$this->Usuarios->set(post());	
			if(post("iframe")=='Add_Todos_Iframe'){
				if(!isset($set_user['error'])){	
					$this->Response 		=			array(	"message"	=>	"Los datos han sido guardados correctamente",
																"callback"	=>	"reloader_iframe()");
				}else{
					$this->Response 		=			array(	"message"	=>	"No se pudo guardar los datos",
																"code"		=>	"203");
				}
				echo answers_json($this->Response);			return;	
			}else{
				if(!isset($set_user['error'])){
					$this->Response 		=			array(	"message"	=>	"Los datos han sido guardados correctamente",
																				"code"		=>	"200");
				}else{
					$this->Response 		=			$set_user['error'];
				}
				echo answers_json($this->Response);			return;					
			}
			
		}else{
			$possible_id		=	$this->uri->segment($this->uri->total_segments());	
		}
		$this->Usuarios->get($this->uri->segment(3));
		$this->listar->view="Usuarios/Form_AddCuentasBancarias";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		FormAjax($this->listar->view); 
	}
	
	public function ActualizarEscala(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode	=	explode("-",$this->uri->segment(3));
		$this->Usuarios->SeguridadSocial();
		$this->listar->view="Usuarios/List_ActualizarEscala";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 
	}
	
	public function TratamientoDatos(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode	=	explode("-",$this->uri->segment(3));
		$this->Usuarios->SeguridadSocial();
		$this->listar->view="Usuarios/List_TratamientoDatos";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 
	}
	
	public function Add_ActualizarEscala(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		if(post()){
			$set_user		=	$this->Usuarios->set(post());	
			if(post("iframe")=='Add_Todos_Iframe'){
				if(!isset($set_user['error'])){	
					$this->Response 		=			array(	"message"	=>	"Los datos han sido guardados correctamente",
																"callback"	=>	"reloader_iframe()");
				}else{
					$this->Response 		=			array(	"message"	=>	"No se pudo guardar los datos",
																"code"		=>	"203");
				}
				echo answers_json($this->Response);			return;	
			}else{
				if(!isset($set_user['error'])){
					$this->Response 		=			array(	"message"	=>	"Los datos han sido guardados correctamente",
																				"code"		=>	"200");
				}else{
					$this->Response 		=			$set_user['error'];
				}
				echo answers_json($this->Response);			return;					
			}
			
		}else{
			$possible_id		=	$this->uri->segment($this->uri->total_segments());	
		}
		$this->Usuarios->get($this->uri->segment(3));
		$this->listar->view="Usuarios/Form_Add_ActualizarEscala";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		FormAjax($this->listar->view); 
	}
	
	public function OtrosIngresos(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode	=	explode("-",$this->uri->segment(3));
		$this->Usuarios->OtrosIngresos();
		$this->listar->view="Usuarios/List_OtrosIngresos";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 
	}
	
	public function Cumpleanos(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode	=	explode("-",$this->uri->segment(3));
		$this->Usuarios->Cumpleanos();
		$this->listar->view="Usuarios/List_Cumpleanos";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 
	}
	
	public function Descuentos(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode	=	explode("-",$this->uri->segment(3));
		$this->Usuarios->SeguridadSocial();
		$this->listar->view="Usuarios/List_Descuentos";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 
	}
	
	public function Metas(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(post()){
			$set_user		=	$this->Usuarios->set(post());	
			if(!isset($set_user['error'])){
				$this->Response 		=			array(	"code"		=>	"200");
			}else{
				$this->Response 		=			$set_user['error'];
			}
			echo answers_json($this->Response);	return;					
		}
		
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode	=	explode("-",$this->uri->segment(3));
		$this->Usuarios->SeguridadSocial(array('Modelos'));
		$this->listar->view="Usuarios/List_Metas";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 
	}
	
	public function AddDescuentos(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		if(post()){
			$set_user		=	$this->Usuarios->set_Descuentos(post());	
			if(post("iframe")=='Add_Todos_Iframe'){
				if(!isset($set_user['error'])){	
					$this->Response 		=			array(	"message"	=>	"Los datos han sido guardados correctamente",
																"callback"	=>	"reloader_iframe()");
				}else{
					$this->Response 		=			array(	"message"	=>	"No se pudo guardar los datos",
																"code"		=>	"203");
				}
				echo answers_json($this->Response);			return;	
			}else{
				if(!isset($set_user['error'])){
					$this->Response 		=			array(	"message"	=>	"Los datos han sido guardados correctamente",
																				"code"		=>	"200");
				}else{
					$this->Response 		=			$set_user['error'];
				}
				echo answers_json($this->Response);			return;					
			}
			
		}else{
			$possible_id		=	$this->uri->segment($this->uri->total_segments());	
		}
		$this->Usuarios->get($this->uri->segment(3));
		$this->listar->view="Usuarios/Form_Descuentos";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		FormAjax($this->listar->view); 
	}
	
	public function SeguridadSocial(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode	=	explode("-",$this->uri->segment(3));
		$this->Usuarios->SeguridadSocial();
		$this->listar->view="Usuarios/List_SeguridadSocial";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 
	}
	
	public function Asociados(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode	=	explode("-",$this->uri->segment(3));
		$this->Usuarios->SeguridadSocial();
		$this->listar->view="Usuarios/List_Asociados";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 
	}
	
	public function Modelos(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode	=	explode("-",$this->uri->segment(3));
		$this->Usuarios->SeguridadSocial();
		$this->listar->view="Usuarios/List_Modelos";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 
	}
	
	public function Monitores(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode	=	explode("-",$this->uri->segment(3));
		$this->Usuarios->SeguridadSocial();
		$this->listar->view="Usuarios/List_Monitores";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 
	}
	
	public function Administrativos(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode	=	explode("-",$this->uri->segment(3));
		$this->Usuarios->SeguridadSocial();
		$this->listar->view="Usuarios/List_Administrativos";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 
	}
	
	public function AddSeguridadSocial(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		if(post()){
			$set_user		=	$this->Usuarios->set(post());	
			if(post("iframe")=='Add_Todos_Iframe'){
				if(!isset($set_user['error'])){	
					$this->Response 		=			array(	"message"	=>	"Los datos han sido guardados correctamente",
																"callback"	=>	"reloader_iframe()");
				}else{
					$this->Response 		=			array(	"message"	=>	"No se pudo guardar los datos",
																"code"		=>	"203");
				}
				echo answers_json($this->Response);			return;	
			}else{
				if(!isset($set_user['error'])){
					$this->Response 		=			array(	"message"	=>	"Los datos han sido guardados correctamente",
																				"code"		=>	"200");
				}else{
					$this->Response 		=			$set_user['error'];
				}
				echo answers_json($this->Response);			return;					
			}
			
		}else{
			$possible_id		=	$this->uri->segment($this->uri->total_segments());	
		}
		$this->Usuarios->get($this->uri->segment(3));
		$this->listar->view="Usuarios/Form_AddSeguridadSocial";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		FormAjax($this->listar->view); 
	}
	
	public function TodosPlataformas(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode	=	explode("-",$this->uri->segment(3));
		$this->Usuarios->get_plataformas();
		$this->listar->view="Usuarios/List_Plataformas";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 
	}
	
	public function AsignarMaster(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode	=	explode("-",$this->uri->segment(3));
		$this->Usuarios->get_plataformas_rel_master();
		$this->listar->view="Usuarios/List_AsignarMaster";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 
	}
	
	public function AsignarNickname(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode	=	explode("-",$this->uri->segment(3));
		$this->Usuarios->getModelos();
		$this->listar->view="Usuarios/List_AsignarNickname";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 
	}
	
	public function verNickname(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		
		if(post()){
			$set	=	$this->Usuarios->setPassNickname(post());
			if(!isset($set['error'])){
				$this->Response 		=			array(	"code"		=>	"200");
			}else{
				$this->Response 		=			$set_user['error'];
			}
			echo answers_json($this->Response);	return;		
		}
		
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$this->Usuarios->getNicknames($this->uri->segment(3));
		$this->listar->view="Usuarios/List_getNicknames";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		FormAjax($this->listar->view); 
	}
	
	public function Listado(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$this->Usuarios->get_all2();		
		
		/*DEVOLVEMOS RESULTADOS DEPENDIENDO DEL TIPO DE LLAMADO*/
		if ($this->input->is_ajax_request()) {
			$this->Response 	=			array("result"=>$this->Usuarios->result,"code"=>"200");	
			echo answers_json($this->Response);	
		}else{
			$this->listar->view="Usuarios/List_Usuarios2";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			paginator($this->Usuarios->total_rows);
			$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
			listados($this->listar->view); 	
		}
	}
	
	public function generarPdfCertificadoLaboral(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$user				=	centrodecostos($this->uri->segment(3));
		$empresa			=	centrodecostos($user->id_empresa);
		ob_start();
		$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
		$html				.=	$this->load->view('Template/PDF/CertificadoLaboral',array("user"=>$user,"empresa"=>$empresa),TRUE);	
		$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
		echo $html;
		$salida 			= 	ob_get_clean();
		//echo $salida;
		CertificadoLaboral_pdf($salida);
	}
	
	public function generarPdfTratamientoDatos(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$user				=	centrodecostos($this->uri->segment(3));
		$empresa			=	centrodecostos($user->id_empresa);
		ob_start();
		$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
		$html				.=	$this->load->view('Template/PDF/TratamientoDatos',array("user"=>$user,"empresa"=>$empresa),TRUE);	
		$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
		echo $html;
		$salida 			= 	ob_get_clean();
		//echo $salida;
		CertificadoLaboral_pdf($salida);
	}
		
	public function CertificadoLaboral(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$this->Usuarios->CertificadoLaboral();		
		
		/*DEVOLVEMOS RESULTADOS DEPENDIENDO DEL TIPO DE LLAMADO*/
		if ($this->input->is_ajax_request()) {
			$this->Response 	=			array("result"=>$this->Usuarios->result,"code"=>"200");	
			echo answers_json($this->Response);	
		}else{
			$this->listar->view="Usuarios/List_CertificadoLaboral";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			paginator($this->Usuarios->total_rows);
			$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
			listados($this->listar->view); 	
		}
	}
	
	public function HonorariosModelo(){  
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(post()){
			$set	=	$this->Usuarios->setAsignarNickname(post());
			if($set){	
				echo '<script>parent.location.reload();</script>';
			}else{
				echo '<script>alert("Error");</script>';
			}
			return;		
		}
		$possible_id		=	$this->uri->segment(3);
		$this->Usuarios->get($possible_id);
		if($this->uri->segment(4)=='PDF'){
				$user				=	centrodecostos($this->uri->segment(3));
				$empresa			=	centrodecostos($user->id_empresa); 
				ob_start();
				$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
				$html				.=	$this->load->view('Template/PDF/HonorariosModelo',array("user"=>$user,"empresa"=>$empresa),TRUE);	
				$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
				echo $html;
				$salida 			= 	ob_get_clean();
				//echo $salida;
				CertificadoLaboral_pdf($salida);
				return;
			}

		$this->listar->view	=	"Usuarios/Form_HonorariosModelo";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
		$this->Listado		=	$this->load->view('Template/Form',array(),TRUE);
		FormAjax($this->listar->view);	
	}
	
	public function HonorariosModelos(){

		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$this->Usuarios->CertificadoLaboral(array('Modelos'));	
		
		/*DEVOLVEMOS RESULTADOS DEPENDIENDO DEL TIPO DE LLAMADO*/
		if ($this->input->is_ajax_request()) {
			$this->Response 	=			array("result"=>$this->Usuarios->result,"code"=>"200");	
			echo answers_json($this->Response);	
		}else{
			$this->listar->view="Usuarios/List_HonorariosModelos";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			paginator($this->Usuarios->total_rows);
			$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
			listados($this->listar->view); 	
		}
	}
	
	public function Roles(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$this->Usuarios->get_Roles();		
		
		/*DEVOLVEMOS RESULTADOS DEPENDIENDO DEL TIPO DE LLAMADO*/
		if ($this->input->is_ajax_request()) {
			$this->Response 	=			array("result"=>$this->Usuarios->result,"code"=>"200");	
			echo answers_json($this->Response);	
		}else{
			$this->listar->view="Usuarios/List_Roles";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			paginator($this->Usuarios->total_rows);
			$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
			listados($this->listar->view); 	
		}
	}
	
	public function AddAsignarMaster(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(post()){
			$set	=	$this->Usuarios->setAsignarMaster(post());			
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
		$this->Usuarios->get_AsignarMaster($possible_id);	
		$this->listar->view	="Usuarios/Form_AsignarMaster";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
		$this->Listado	=	$this->load->view('Template/Form',array(),TRUE);
		FormAjax($this->listar->view);	
	}
	
	public function AddAsignarNickname(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(post()){
			$set	=	$this->Usuarios->setAsignarNickname(post());
			//return;
			if($set){	
				echo '<script>parent.location.reload();</script>';
			}else{
				echo '<script>alert("Error");</script>';
			}
			return;		
		}
		if($this->uri->segment(4)!='new'){
			$this->Usuarios->getAsignarNickname($this->uri->segment(3));	
		}else{
			$this->Usuarios->getAsignarNickname("new");		
		}
		
		$this->listar->view	="Usuarios/Form_AddAsignarNickname";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
		$this->Listado	=	$this->load->view('Template/Form',array(),TRUE);
		FormAjax($this->listar->view);	
	}
	
	public function AddAsignarNicknameEdit(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(post()){
			$set	=	$this->Usuarios->setAsignarNickname(post());
			if($set){	
				echo '<script>parent.location.reload();</script>';
			}else{
				echo '<script>alert("Error");</script>';
			}
			return;		
		}
		$possible_id		=	$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->getNickname($this->uri->segment(3));	
		if($this->uri->segment(4)==''){
			$this->listar->view	="Usuarios/Form_AddAsignarNicknameEdit";
		}else{
			$this->listar->view	="Usuarios/Form_AddAsignarNicknameEdit".$this->uri->segment(4);
		}
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
		$this->Listado	=	$this->load->view('Template/Form',array(),TRUE);
		FormAjax($this->listar->view);	
	}
	
	public function Add(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(post()){
			$set	=	$this->Usuarios->set(post());			
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
		$this->Usuarios->get($possible_id);	
		$this->listar->view	="Usuarios/Form_Usuarios";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
		$this->Listado	=	$this->load->view('Template/Form',array(),TRUE);
		Form($this->listar->view);	
	}
	
	public function AddRol(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(post()){
			$set	=	$this->Usuarios->setRol(post());			
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
		$this->Usuarios->get_RolesForm($possible_id);
		$this->roles					=	$this->Usuarios->roles;	
		$this->roles_modulos_padre		=	$this->Usuarios->roles_modulos_padre;	
		$this->roles_modulos_hijos		=	$this->Usuarios->roles_modulos_hijos;
		$this->roles_modulos_nietos		=	$this->Usuarios->roles_modulos_nietos;	
		$this->listar->view	="Usuarios/Form_Roles";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
		$this->Listado	=	$this->load->view('Template/Form',array(),TRUE);
		FormAjax($this->listar->view);	
	}
	
	public function Add_Todos_Iframe(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(post()){
			$set_user		=	$this->Usuarios->set(post());	
			if(post("iframe")=='Add_Todos_Iframe'){
				if(!isset($set_user['error'])){	
					$this->Response 		=			array(	"message"	=>	"Los datos han sido guardados correctamente",
																"callback"	=>	"reloader_iframe()");
				}else{
					$this->Response 		=			array(	"message"	=>	"No se pudo guardar los datos",
																"code"		=>	"203");
				}
				echo answers_json($this->Response);			return;	
			}else{
				if(!isset($set_user['error'])){
					$this->Response 		=			array(	"message"	=>	"Los datos han sido guardados correctamente",
																				"code"		=>	"200");
				}else{
					$this->Response 		=			$set_user['error'];
				}
				echo answers_json($this->Response);			return;					
			}
			
		}else{
			$possible_id		=	$this->uri->segment($this->uri->total_segments());	
		}
		$this->Usuarios->get($possible_id,$this->uri->segment(3));
		
		if(!empty($possible_id)){
			$this->centro_costo	=	$this->Usuarios->centro_costo_rooms(@$this->Usuarios->result->id_empresa);
		}else{
			$this->centro_costo	=	null;	
		}
			
		$this->dep_users		=	$this->Usuarios->get_empresas();
		$this->listar->view		=	"Usuarios/Form_".$this->uri->segment(3);
		$this->util->set_title("Agregar ".$this->uri->segment(3)." - ".SEO_TITLE);	
		$modulo		=	$this->ModuloActivo;
		if(empty($this->$modulo->result) && $this->uri->segment(4)!=''){
			redirect(base_url('Usuarios/Todos/'.$this->uri->segment(3)));
			return;
		}
 		FormAjax($this->listar->view);	
	}
	
	public function Add_Todos(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(post()){
			$set_user		=	$this->Usuarios->set(post());
			if ($this->input->is_ajax_request()) {	
				if(!isset($set_user['error'])){
					$this->Response 		=			array(	"message"	=>	"Los datos han sido guardados correctamente",
																				"code"		=>	"200");
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
		}else{
			$possible_id		=	$this->uri->segment($this->uri->total_segments());	
		}
		$this->Usuarios->get($possible_id,$this->uri->segment(3));
		
		if(!empty($possible_id)){
			$this->centro_costo	=	$this->Usuarios->centro_costo_rooms(@$this->Usuarios->result->id_empresa);
		}else{
			$this->centro_costo	=	null;	
		}
			
		$this->dep_users		=	$this->Usuarios->get_empresas();
		$this->listar->view		=	"Usuarios/Form_".$this->uri->segment(3);
		$this->util->set_title("Agregar ".$this->uri->segment(3)." - ".SEO_TITLE);	
		$modulo		=	$this->ModuloActivo;
		if(empty($this->$modulo->result) && $this->uri->segment(4)!=''){
			redirect(base_url('Usuarios/Todos/'.$this->uri->segment(3)));
			return;
		}
 		FormAjax($this->listar->view);	
	}
	
	public function Add_Todos_IFRAME_ADD(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(post()){
			$set_user		=	$this->Usuarios->set(post());
			redirect(base_url($this->uri->segment(4).'/'.$this->uri->segment(5)));
			return;					
		}	
		$this->listar->view		=	"Usuarios/Form_".$this->uri->segment(3);
		$modulo					=	$this->ModuloActivo;
		FormAjax($this->listar->view);	
	}
	
	public function ModificarClave(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(post()){
			$set_user		=	$this->Usuarios->setClave(post());	
			if(!isset($set_user['error'])){
				$this->Response 		=			$set_user;
			}else{
				$this->Response 		=			$set_user['error'];
			}
			echo answers_json($this->Response);
			return;					
		}else{
			$possible_id		=	$this->uri->segment($this->uri->total_segments());	
		}
		$this->Usuarios->get($possible_id,$this->uri->segment(3));
		
		if(!empty($possible_id)){
			$this->centro_costo	=	$this->Usuarios->centro_costo_rooms(@$this->Usuarios->result->id_empresa);
		}else{
			$this->centro_costo	=	null;	
		}
			
		$this->dep_users		=	$this->Usuarios->get_empresas();
		$this->listar->view		=	"Usuarios/Form_ModificarClave";
		$this->util->set_title("Agregar ".$this->uri->segment(3)." - ".SEO_TITLE);	
		$modulo		=	$this->ModuloActivo;
		if(empty($this->$modulo->result) && $this->uri->segment(4)!=''){
			redirect(base_url('Usuarios/Todos/'.$this->uri->segment(3)));
			return;
		}
 		Form($this->listar->view);	
	}
	
	public function Export(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$explode	=	explode("/",post("doc"));
		
		if(isset($explode[2])){
			switch($explode[2]){
				case 'Asociados':
					$this->Usuarios->get_all_x_type(array("Asociados"));		
					$this->section		=	"ListaAsociados";
					$this->listar->view	=	"Usuarios/List_Export";		
				break;
				case 'CentroCostos':
					$this->Usuarios->get_all_x_type(array($explode[2]),"",$explode[2]);			
					$this->section		=	"ListaAsociados";
					$this->listar->view	=	"Usuarios/List_Export";		
				break;
				case 'Proveedores':
					$this->Usuarios->get_all_x_type(array($explode[2]),"",$explode[2]);		
					$this->section		=	"ListaProveedores";
					$this->listar->view	=	"Usuarios/List_Export";		
				break;
				default:
				return;
					$this->Usuarios->get_all_x_type(array($explode[2]));		
					$this->section		=	"Lista".$explode[2];
					$this->listar->view	=	"Usuarios/List_Export";		
				break;
			}
		}else if(isset($explode[1]) && !isset($explode[2])){
			switch($explode[1]){
				case 'Roles':
					$this->Usuarios->get_Roles();		
				break;
			}
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
	
	public function SetCentroCostos(){
		$data					=	$this->user;
		$data->centro_de_costos	=	$this->uri->segment(3);
		$get					=	$this->db->select("t2.*,t1.principal,t2.sistema_salarial")
										->from(DB_PREFIJO."usuarios t1")
										->join(DB_PREFIJO."usuarios t2", 't1.id_empresa	=	t2.user_id', 'left')
										->where('t1.user_id',$data->centro_de_costos)
										->get()
										->row();
		$data->id_empresa		=	$get->user_id;										
		$data->periodo_pagos	=	$get->periodo_pagos;
		$data->principal		=	$get->principal;
		$data->sistema_salarial	=	$get->sistema_salarial;
										
		$this->session->set_userdata(array('User'=>$data));		
		$this->session->set_flashdata('success', 'El perfil ha sido asignado');
		redirect(base_url("Usuarios/Todos/CentroCostos"));
	}
	
	public function SetTotalizado(){
		$this->Usuarios->SetTotalizado(post());	
	}
	
	public function SetPerfil(){
		$type					=	$this->user->type;
		$session_id				=	$this->user->session_id;
		$data					=	$this->user;
		$data->user_id			=	$this->uri->segment(3);
		$get					=	$this->db->select("t1.*")
										->from(DB_PREFIJO."usuarios t1")
										->where('t1.user_id',$data->user_id)
										->get()
										->row();
		$data					=	$get;					
		$data->type				=	$type;
		$data->session_id		=	$session_id;					
		$this->session->set_userdata(array('User'=>$data));		
		$this->session->set_flashdata('success', 'El perfil ha sido asignado');
		redirect(base_url("Usuarios/".$this->uri->segment(4)));
	}
	
	public function ActivarPlataforma(){
		$tabla		=	DB_PREFIJO."cf_rel_plataformas";
		$get		=	$this->db->select("rel_plataforma_id")
							->from($tabla)
							->where('id_plataforma',$this->uri->segment(3))
							->where('id_empresa',$this->user->id_empresa)
							->get()
							->row();
		if($this->uri->segment(4)==1 && empty($get)){
			if($this->db->insert($tabla,array(	"id_plataforma"=>$this->uri->segment(3),
												"id_empresa"=>$this->user->id_empresa
												))){
				$this->session->set_flashdata('success', 'Plataforma Asignada sin problemas');				
			}else{
				$this->session->set_flashdata('danger', 'Error asignando Plataforma');		
			}
		}else{
			$this->db->where('id_plataforma',$this->uri->segment(3));
			$this->db->where('id_empresa',$this->user->id_empresa);
			if($this->db->delete($tabla)){
				$this->session->set_flashdata('success', 'Plataforma eliminada sin problemas');	
			}else{
				$this->session->set_flashdata('danger', 'Problemas al eliminan Plataforma');
			}
		}	
		redirect(base_url("Usuarios/TodosPlataformas/Plataforma"));
	}
	
	public function ActivarNickName(){
		$tabla		=	DB_PREFIJO."cf_nickname";
		$get		=	$this->db->select("nickname_id,estado")
							->from($tabla)
							->where('nickname_id',$this->uri->segment(3))
							->where('id_empresa',$this->user->id_empresa)
							//->where('centro_de_costos',$this->user->centro_de_costos)
							->get()
							->row();
		if($this->uri->segment(4)==1 && empty($get)){
			if($this->db->insert($tabla,array(	"nickname_id"=>$this->uri->segment(3),
												"id_empresa"=>$this->user->id_empresa
												))){
				$this->session->set_flashdata('success', 'Nickname Activado');				
			}else{
				$this->session->set_flashdata('danger', 'Error Activando Nickname');		
			}
		}else{
			$this->db->where('nickname_id',$this->uri->segment(3));
			$this->db->where('id_empresa',$this->user->id_empresa);
			if($this->db->update($tabla,array("estado"=>($get->estado==1)?0:1))){
				$this->session->set_flashdata('success', 'Nickname desactivado sin problemas');	
			}else{
				$this->session->set_flashdata('danger', 'Problemas al desactivar Nickname');
			}
		}	
		redirect(base_url("Usuarios/verNickname/".$this->uri->segment(5)."/edit"));
	}
	
	public function CancelarOtrosIngresos(){
		$tabla		=	DB_PREFIJO."rp_otros_ingresos";
		$this->db->where('user_id',$this->uri->segment(3));
		$this->db->where('id_empresa',$this->user->id_empresa);
		$this->db->where('descuento_id',$this->uri->segment(4));
		if($this->db->update($tabla,array("estado"=>9))){
			$this->session->set_flashdata('success', 'El ingreso ha sido desactivado ');	
		}else{
			$this->session->set_flashdata('danger', 'Problemas al desactivar Otro Ingreso');
		}
		redirect(base_url("Usuarios/OtrosIngresos"));
	}
	
	public function DeleteNickname(){
		if($this->Usuarios->DeleteNickname($this->uri->segment(4),$this->user->id_empresa)){
			$this->Response 		=			array(	"message"	=>	"Los datos han sido eliminados correctamente",
														"code"		=>	"200");
		}else{
			$this->Response 		=			array(	"message"	=>	"Lo siento, presentamos un problema y no pudimos eliminados los datos",
														"code"		=>	"203");
		}
		echo answers_json($this->Response);
	}
}

?>