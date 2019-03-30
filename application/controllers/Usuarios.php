<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller{
	
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

		/*if(!isset($_SERVER['HTTP_REFERER'])){
			redirect(base_url("Main/ErrorUrl"));
			return;
		}*/			

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

	public function welcome(){
		listados('Usuarios/welcome');
	}

	public function FotoPerfil(){
		$response = calidadImagen(30,'foto',"images/uploads/perfilesModelos/".$this->uri->segment(3),array("allowed_types"=>'gif|jpg|png'));
		if($response["upload_data"]){
			$this->session->set_flashdata("success",$response["upload_data"]);
		}else{
			$this->session->set_flashdata("danger",$response["error"]);
		}
		redirect(base_url("Usuarios/Todos/PerfilesModelos"));	return;
	}
	
	public function SearchUser(){
		if(empty($this->user)){
			redirect(base_url("Main"));	return;
		}
	
		if($data=$this->Usuarios->SearchUser(post("username"))){
			$Response	=	array(	"code"		=>	"200",
									"message"	=>	" ya esta registrado en nuestro sistema por favor elija otro");
		}else{
			$Response	=	array(	"code"		=>	"203");
		}
		echo answers_json($Response);	return;	
	}
	
	public function Reload(){
		$this->Entrevistas	=	$this->Usuarios->Reload();
		$this->listar->view="Usuarios/List_ReloadNicknames";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		//formAjax($this->listar->view); 	
	}
	
	public function HonorariosModeloPagoAnular(){
		if($this->Usuarios->HonorariosModeloPagoAnular($this->uri->segment(4),$this->uri->segment(3))){
			redirect(base_url("Usuarios/HonorariosModelos"));	return;	
		}
		//redirect(base_url("Main/modulo_inactivo"));	return;	
	}
	
	public function HonorariosModeloAnular(){
		if($this->Usuarios->HonorariosModeloAnular($this->uri->segment(4),$this->uri->segment(3))){
			redirect(base_url("Usuarios/HonorariosModeloAprobados/".$this->uri->segment(3)."/".$this->uri->segment(4)."/1"));	return;	
		}
		//redirect(base_url("Main/modulo_inactivo"));	return;	
	}

	public function checkemail(){
		$data = checkemail(post());
		if(empty($data)){
			$Response	=	array(	"code"		=>	"203");
		}else{
			$Response	=	array(	"code"		=>	"200");
		}
		echo answers_json($Response);	return;	
	}
	
	public function ResumenModelos(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode						=		explode("-",$this->uri->segment(3));
		$this->Usuarios->ResumenModelos();
		if($this->uri->segment(3)=='PDF'){
			$empresa			=	centrodecostos($this->user->id_empresa); 
			ob_start();
			$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
			$html				.=	$this->load->view('Template/PDF/ResumenModelos',array("empresa"=>$empresa),TRUE);
			$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
			echo $html;
			$salida 			= 	ob_get_clean();
			//echo $salida;
			CertificadoLaboral_pdf($salida);
			return;
		}
		if($this->uri->segment($this->uri->total_segments())=='excel'){
			if(post()){
				downloadExcel(post(),"Reporte_".$this->uri->segment(2));
				return;
			}
		}	
		if($this->uri->segment($this->uri->total_segments())=='mail'){
			if(post()){
				html_export_excel(post(),"Reporte_".$this->uri->segment(2));
				return;
			}
		}
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
		detect_Sucursal($this->user);
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode						=		explode("-",$this->uri->segment(3));
		$this->Usuarios->ResumenPaginas();
		if($this->uri->segment(3)=='PDF'){
			$empresa			=	centrodecostos($this->user->id_empresa); 
			ob_start();
			$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
			$html				.=	$this->load->view('Template/PDF/ResumenPaginas',array("empresa"=>$empresa),TRUE);
			$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
			echo $html;
			$salida 			= 	ob_get_clean();
			//echo $salida;
			CertificadoLaboral_pdf($salida);
			return;
		}
		if($this->uri->segment($this->uri->total_segments())=='excel'){
			if(post()){
				downloadExcel(post(),"Reporte_".$this->uri->segment(2));
				return;
			}
		}	
		if($this->uri->segment($this->uri->total_segments())=='mail'){
			if(post()){
				html_export_excel(post(),"Reporte_".$this->uri->segment(2));
				return;
			}
		}	
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
		detect_Sucursal($this->user);
		if(defined("APANEL_FORMULARIOS")){
			$this->load->model("Formularios/Formularios_model");
			$this->Formularios	= 	new Formularios_model();
			$this->Formularios->user	=	$this->user;
		}
		$this->Formularios->getEntrevistas();
		if($this->uri->segment(3)=='PDF'){
			$user				=	centrodecostos($this->user->user_id);
			$empresa			=	centrodecostos($user->id_empresa);
			$centrodecostos     =   centrodecostos($user->centro_de_costos); 
			ob_start();
			$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
			$html				.=	$this->load->view('Template/PDF/ResumenEntrevistas',array("user"=>$user,"empresa"=>$empresa,"centrodecostos"=>$centrodecostos),TRUE);
			$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
			echo $html;
			$salida 			= 	ob_get_clean();
			//echo $salida;
			CertificadoLaboral_pdf($salida);
			return;
		}
		if($this->uri->segment($this->uri->total_segments())=='excel'){
			if(post()){
				downloadExcel(post(),"Reporte_".$this->uri->segment(2));
				return;
			}
		}	
		if($this->uri->segment($this->uri->total_segments())=='mail'){
			if(post()){
				html_export_excel(post(),"Reporte_".$this->uri->segment(2));
				return;
			}
		}	
		$this->Entrevistas	=	$this->Formularios->Get(NULL);
		$this->listar->view="Usuarios/List_ResumenEntrevistas";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view); 	
	}
	
	public function ResumenSeguridadSocial(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode						=		explode("-",$this->uri->segment(3));
		$this->Usuarios->ResumenSeguridadSocial();
		if($this->uri->segment(3)=='PDF'){
			$empresa			=	centrodecostos($this->user->id_empresa);
			ob_start();
			$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
			$html				.=	$this->load->view('Template/PDF/ResumenSeguridadSocial',array("empresa"=>$empresa),TRUE);
			$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
			echo $html;
			$salida 			= 	ob_get_clean();
			//echo $salida;
			CertificadoLaboral_pdf($salida);
			return;
		}
		if($this->uri->segment($this->uri->total_segments())=='excel'){
			if(post()){
				downloadExcel(post(),"Reporte_".$this->uri->segment(2));
				return;
			}
		}	
		if($this->uri->segment($this->uri->total_segments())=='mail'){
			if(post()){
				html_export_excel(post(),"Reporte_".$this->uri->segment(2));
				return;
			}
		}	
		$this->listar->view="Usuarios/List_ResumenSeguridadSocial";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 	
	}
	
	public function ResumenTerceros(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode						=		explode("-",$this->uri->segment(3));
		$this->Usuarios->ResumenSeguridadSocial(array('Modelos','Administrativos','Monitores','Asociado','Proveedores'));
		if($this->uri->segment(3)=='PDF'){
			$user				=	centrodecostos($this->user->user_id);
			$empresa			=	centrodecostos($user->id_empresa);
			$centrodecostos     =   centrodecostos($user->centro_de_costos); 
			ob_start();
			$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
			$html				.=	$this->load->view('Template/PDF/ResumenTerceros',array("user"=>$user,"empresa"=>$empresa,"centrodecostos"=>$centrodecostos),TRUE);
			$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
			echo $html;
			$salida 			= 	ob_get_clean();
			//echo $salida;
			CertificadoLaboral_pdf($salida);
			return;
		}
		if($this->uri->segment($this->uri->total_segments())=='excel'){
			if(post()){
				downloadExcel(post(),"Reporte_".$this->uri->segment(2));
				return;
			}
		}	
		if($this->uri->segment($this->uri->total_segments())=='mail'){
			if(post()){
				html_export_excel(post(),"Reporte_".$this->uri->segment(2));
				return;
			}
		}	
		$this->listar->view="Usuarios/List_ResumenTerceros";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 	
	}
	
	public function GetEmpresasAjax(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
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

		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$this->Usuarios->get_all_clientes();
		$this->listar->view="Usuarios/List_TodosClientes";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view); 
		return;
	}
	
	public function CuentasBancarias(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		//detect_Sucursal($this->user);
	//	$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
	//	$this->Usuarios->search			=		post("search");
		$explode	=	explode("-",$this->uri->segment(3));
	//	$this->Usuarios->SeguridadSocial(array("Asociados","Modelos","Monitores","Administrativos"),$this->uri->segment(3));
		if($this->uri->segment($this->uri->total_segments())=='NewPDF'){
			$user				=	centrodecostos($this->user->user_id);
			$empresa			=	centrodecostos($this->user->id_empresa);
			$centrodecostos     =   centrodecostos($this->user->centro_de_costos); 
			ob_start();
			$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
			$html				.=	$this->load->view('Template/PDF/CuentasBancarias2',array("user"=>$user,"empresa"=>$empresa,"centrodecostos"=>$centrodecostos),TRUE);
			$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
			echo $html;
			$salida 			= 	ob_get_clean();
			//echo $salida; return;
			CertificadoLaboral_pdf($salida);
			return;
		}
		if($this->uri->segment($this->uri->total_segments())=='PDF'){
			$user				=	centrodecostos($this->user->user_id);
			$empresa			=	centrodecostos($this->user->id_empresa);
			$centrodecostos     =   centrodecostos($this->user->centro_de_costos); 
			ob_start();
			$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
			$html				.=	$this->load->view('Template/PDF/CuentasBancarias',array("user"=>$user,"empresa"=>$empresa,"centrodecostos"=>$centrodecostos),TRUE);
			$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
			echo $html;
			$salida 			= 	ob_get_clean();
			//echo $salida; return;
			CertificadoLaboral_pdf($salida);
			return;
		}
		if($this->uri->segment($this->uri->total_segments())=='Historial'){
			$this->listar->view="Usuarios/Detalle_CuentasBancarias";
		}else{
			$this->listar->view="Usuarios/List_CuentasBancarias";
		}
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
	//	paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);
		if($this->uri->segment($this->uri->total_segments())=='Historial'){
			FormAjax($this->listar->view);
		}else{
   	listados($this->listar->view);
		}	 
	}

	public function Planimetria(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode	=	explode("-",$this->uri->segment(3));
		//$this->Usuarios->SeguridadSocial("Modelos");
		$this->Usuarios->AllUsersSucursales("Modelos");
		if($this->uri->segment($this->uri->total_segments())=='PDF'){
			$user				=	centrodecostos($this->user->user_id);
			$empresa			=	centrodecostos($this->user->id_empresa);
			$centrodecostos     =   centrodecostos($this->user->centro_de_costos); 
			ob_start();
			$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
			$html				.=	$this->load->view('Template/PDF/Planimetria',array("user"=>$user,"empresa"=>$empresa,"centrodecostos"=>$centrodecostos),TRUE);
			$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
			echo $html;
			$salida 			= 	ob_get_clean();
			//echo $salida; return;
			CertificadoLaboral_pdf($salida);
			return;
		}
		$this->listar->view="Usuarios/List_Planimetria";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 	
	}
	
	public function Diasasistidos(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
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
		detect_Sucursal($this->user);
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
		FormAjax($this->listar->view); 
	}
	
	public function CambiarEstado(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$var['user_id'] = $this->uri->segment($this->uri->total_segments());
		//$Response		=	$this->Usuarios->set($var);
		if($this->uri->segment(6)=="Empresa"){
		// pre($var['estado']); return;
		/*	$usuarios		=	GetUsuarios(array(	"Administrativos",
													"Asociados",
													"CentroCostos",
													"Modelos",
													"Monitores",
													),"user_id,json,estado",$this->uri->segment(5));*/
		//	$empresa			=	centrodecostos($this->uri->segment(5));													
		//	$set_json			=	json_db(@$empresa->json,array("estatus_perfiles"=>$usuarios));
			//pre(json_decode($set_json));return;
			$this->db->where("user_id",$this->uri->segment(5));
			$this->db->update("usuarios",array("estado"=>$var['estado']));
			$this->db->reset_query();
			$this->db->where("id",$this->uri->segment(5));
			$this->db->update("mae_cliente_joberp",array("estado"=>$var['estado']));
		}
		
		$this->session->set_flashdata($Response[0],$Response[1]);
		redirect($_SERVER['HTTP_REFERER']);return;
		redirect(base_url("Usuarios/Todos/".$this->uri->segment(3)));
		return;

	}

	public function AddCuentasBancarias(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
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
		if($this->uri->segment($this->uri->total_segments()) == "add"){ 
			$Response = $this->Usuarios->CrearCuentaBancaria($this->uri->segment(3));
			$this->session->set_flashdata($Response[0],$Response[1]);
			redirect(base_url("Usuarios/CuentasBancarias"));
			return;
		}
		$this->Usuarios->get($this->uri->segment(3));
		$this->listar->view="Usuarios/Form_AddCuentasBancarias";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		FormAjax($this->listar->view); 
	}
	
	public function ActualizarEscala(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if($this->uri->segment(3) == "Configuracion"){
			$this->listar->view="Usuarios/Form_ConfigEscala";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			paginator($this->Usuarios->total_rows);
			$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
			FormAjax($this->listar->view); return; 
		}
		detect_Sucursal($this->user);
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode	=	explode("-",$this->uri->segment(3));
		$this->Usuarios->SeguridadSocial("Modelos");
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
		detect_Sucursal($this->user);
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
		detect_Sucursal($this->user);
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		if(post()){
			$set_user		=	$this->Usuarios->set(post());	
			if(post("iframe")=='Add_Todos_Iframe'){
				if(!isset($set_user['error'])){
					$var = post();
					$var['consecutivo'] = consecutivo($this->user->id_empresa,52);
					$var['url'] = current_url();
					$var['responsable'] = nombre($this->user);
					$var['fecha']	= date('Y-m-d H:i:s');
					unset($var["iframe"]);
					if(set_form_control($var,$modulo ="/historialEscala",false)){
						incrementa_consecutivo($this->user->id_empresa,52);
						$this->Response 		=			array(	"message"	=>	"Los datos han sido guardados correctamente",
																"callback"	=>	"reloader_iframe()");
					}else{
						$this->Response 		=			array(	"message"	=>	"La escala fue modificada pero el historial no fue registrado por favor contacte con el administrador del sistema",
																"callback"	=>	"reloader_iframe()");
					}	
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
		if($this->uri->segment(5)){
			$this->listar->view="Usuarios/List_HistoricoActualizarEscala";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			paginator($this->Usuarios->total_rows);
			$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
			FormAjax($this->listar->view); return; 
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
		//detect_Sucursal($this->user);
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode	=	explode("-",$this->uri->segment(3));
		//$this->Usuarios->OtrosIngresos();
		$this->listar->view="Usuarios/List_OtrosIngresos";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		//paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 
	}
	
	public function Cumpleanos(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode	=	explode("-",$this->uri->segment(3));
		$this->Usuarios->Cumpleanos();
		if($this->uri->segment(3)=='PDF'){
			$user				=	centrodecostos($this->user->user_id);
			$empresa			=	centrodecostos($this->user->id_empresa);
			$centrodecostos     =   centrodecostos($this->user->centro_de_costos); 
			ob_start();
			$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
			$html				.=	$this->load->view('Template/PDF/Cumpleanos',array("user"=>$user,"empresa"=>$empresa,"centrodecostos"=>$centrodecostos),TRUE);
			$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
			echo $html;
			$salida 			= 	ob_get_clean();
			//echo $salida; return;
			CertificadoLaboral_pdf($salida);
			return;
		}
		if($this->uri->segment($this->uri->total_segments())=='excel'){
			if(post()){
				downloadExcel(post(),"Reporte_".$this->uri->segment(2));
				return;
			}
		}	
		if($this->uri->segment($this->uri->total_segments())=='mail'){
			if(post()){
				html_export_excel(post(),"Reporte_".$this->uri->segment(2));
				return;
			}
		}	
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
		//pre($this->user);return;
	 //	detect_Sucursal($this->user);
		$explode	=	explode("-",$this->uri->segment(3));
		//$this->Usuarios->get_usuarios_descuentos();
		$this->listar->view="Usuarios/List_Descuentos";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view); 
	}

	public function AnularDescuentos(){
			$set_descuento		=	$this->Usuarios->AnularDescuentos();	
			if($set_descuento){
				$this->session->set_flashdata('success', 'El descuento ha sido anulada');
			}else{
				$this->session->set_flashdata('danger', 'El descuento no pudo ser anulada');
			}
			redirect('Usuarios/VerDescuentos/'.$this->uri->segment(3).'/View');		
	}

	public function VerDescuentos(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$this->Usuarios->get_usuarios_descuentos();
		if($this->uri->segment(4)=='View'){
			$this->Usuarios->get_usuario_descuentos($this->uri->segment(3));
			if($this->uri->segment(5) == "PDF" || $this->uri->segment(6) == "PDF"){
				ob_start();
				$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
				$html				.=	$this->load->view('Template/PDF/VerDescuentos',array(),TRUE);	
				$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
				echo $html;
				$salida 			= 	ob_get_clean();
				//echo $salida; return;
				CertificadoLaboral_pdf($salida);				
			}
			$this->listar->view="Usuarios/ViewDetalleDescuento";
		}else{
			$this->listar->view="Usuarios/ListDetalleDescuento";
		}
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		FormAjax($this->listar->view); 
	}
	
	public function Metas(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		if(post()){
			$set_user		=	$this->Usuarios->set(array("meta_ideal"=>post('meta_ideal'),"user_id"=>post('user_id')));	
			if(!isset($set_user['error'])){
				$var = post();
				$var['consecutivo'] = consecutivo($var['user_id'],53); 
				$var['responsable'] = nombre($this->user);
				$var['fecha']		= date("Y-m-d H:i:s");
				$historial = set_form_control($var,null,false);
				if($historial){
					incrementa_consecutivo($var['user_id'],53);
					$this->Response 		=			array(	"code"		=>	"200",
																"message"	=>	"Su meta ideal ha sido cambiada",
																"callback"  =>  "reloader_page()");
				}else{
					$this->Response 		=			array(	"code"		=>	"200",
															"message"	=>	"Su meta ideal ha sido cambiada pero no se guardo en el historial pr favor consulte con el administrador del sistema");
				}
			}else{
				$this->Response 		=			$set_user['error'];
			}
			echo answers_json($this->Response);	return;					
		}
		if($this->uri->segment(3) == "Configuracion"){
			$this->listar->view="Usuarios/Form_ConfigMetaIdeal";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
			FormAjax($this->listar->view); 
			return;
		}
		if($this->uri->segment(3) == "cf_meta"){
			$this->Usuarios->SeguridadSocial(array('Modelos'),$this->uri->segment(4));
			$this->listar->view="Usuarios/List_Cf_Metas";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
			FormAjax($this->listar->view); return; 
		}
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode	=	explode("-",$this->uri->segment(3));
		$this->Usuarios->SeguridadSocial(array('Modelos'));
		$this->listar->view="Usuarios/List_Metas";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 
	}

	public function configuracionMeta(){
		$insert = $this->Usuarios->insertConfigMeta(post());
		if($insert){
			$this->Response 		=			array(	"code"		=>	"200",
														"message"	=>	"Se ha cambiado el valor minimo para su meta ideal",
														"callback"	=>	"reloader_iframe()");
		}else{
			$this->Response 		=			array(	"code"		=>	"200",
														"message"	=>	"No se ha cambiado el valor minimo para su meta ideal por favor consulte a su administrador",
														"callback"	=>	"reloader_iframe()");
		}
		echo answers_json($this->Response);	return;	 
	}

	public function configuracionEscala(){
		$var = post();
		$var['consecutivo'] = consecutivo($this->user->centro_de_costos,54); 
		$var['responsable'] = nombre($this->user);
		$var['fecha']		= date("Y-m-d H:i:s");
		$set_estado = set_estado_ut_form_control(0);
		if($set_estado){
			$insert = set_form_control($var,'',false);
			if($insert){
				set_escala_user(true);
				incrementa_consecutivo($this->user->centro_de_costos,54);
				$this->Response 		=			array(	"code"		=>	"200",
															"message"	=>	"Se ha cambiado el valor minimo para su meta ideal",
															"callback"	=>	"reloader_iframe()");
			}else{
				$this->Response 		=			array(	"code"		=>	"200",
															"message"	=>	"No se ha cambiado el valor minimo para su meta ideal por favor consulte a su administrador",
															"callback"	=>	"reloader_iframe()");
			}
		}
		echo answers_json($this->Response);	return;	 
	}
	
	public function AddDescuentos(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		if(post()){
			$set		=	$this->Usuarios->set_Descuentos(post());
			if(post("iframe")=='Add_Todos_Iframe'){
				if($set){	
					echo '<script>parent.location.reload();</script>';
				}else{
					echo '<script>alert("Error");</script>';
				}
			}else{
				if($set){	
					echo '<script>parent.location.reload();</script>';
				}else{
					echo '<script>alert("Error");</script>';
				}			
			}
			
		}else{
			$possible_id		=	$this->uri->segment($this->uri->total_segments());	
		}
		$this->Usuarios->get_descuento($this->uri->segment(3));	
		$this->listar->view="Usuarios/Form_Descuentos";
		FormAjax($this->listar->view); 
	}

	public function setCertificado(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		if(post()){
			$set		=	$this->Usuarios->set_Certificado(post());
			$this->session->set_flashdata($set[0], $set[1]);
			echo '<script>parent.location.reload();</script>';
			return;
		}
		if($this->uri->segment($this->uri->total_segments()) == "history"){
			$this->listar->view="Usuarios/list_History_CertificadoComercial";
			FormAjax($this->listar->view);
			return;
		}
		//$this->Usuarios->get_Certificado($this->uri->segment(3));
		$this->listar->view="Usuarios/Form_CertificadoComercial";
		FormAjax($this->listar->view); 
	}
	
	public function SeguridadSocial(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
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
	
	/*public function Asociados(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		//detect_Sucursal($this->user);
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode	=	explode("-",$this->uri->segment(3));
	//	$this->Usuarios->SeguridadSocial();
		$this->listar->view="Usuarios/List_Asociados";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
	//	paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 
	}*/

	public function CrearContrato(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$response = $this->Usuarios->CrearContrato($this->uri->segment(4)); 
		$this->session->set_flashdata($response[0], $response[1]);
		$segment = $this->uri->segment(2);
		redirect(base_url("Usuarios/".$this->uri->segment(3)),true);
		return;
	}
	
	public function Modelos(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode	=	explode("-",$this->uri->segment(3));
		$this->Usuarios->empresa			=	centrodecostos($this->user->id_empresa);
		$this->Usuarios->SeguridadSocial($this->uri->segment(2));
		$this->listar->view="Usuarios/List_Modelos";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 
	}

	public function ContratoModelos(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode	=	explode("-",$this->uri->segment(3));
		$this->Usuarios->ContratoModelo();
		$user				=	centrodecostos($this->uri->segment(3));
		$empresa			=	centrodecostos($user->id_empresa);
		$centrodecostos     =   centrodecostos($user->centro_de_costos); 
		ob_start();
		$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
		$html				.=	$this->load->view('Template/PDF/Contrato_ModelosEditar',array("user"=>$user,"empresa"=>$empresa,"centrodecostos"=>$centrodecostos),TRUE);	
		$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
		echo $html;
		$salida 			= 	ob_get_clean();
		//echo $salida; return;
		CertificadoLaboral_pdf($salida);
		return;
	}

	public function ContratoMonitor(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode	=	explode("-",$this->uri->segment(3));
		$this->Usuarios->ContratoModelo();
		$user				=	centrodecostos($this->uri->segment(3));
		$empresa			=	centrodecostos($user->id_empresa);
		$centrodecostos     =   centrodecostos($user->centro_de_costos); 
		ob_start();
		$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
		$html				.=	$this->load->view('Template/PDF/ContratoMonitor',array("user"=>$user,"empresa"=>$empresa,"centrodecostos"=>$centrodecostos),TRUE);	
		$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
		echo $html;
		$salida 			= 	ob_get_clean();
		//echo $salida; return;
		CertificadoLaboral_pdf($salida);
		return;
	}
	
	public function Monitores(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode	=	explode("-",$this->uri->segment(3));
		$this->Usuarios->empresa			=	centrodecostos($this->user->id_empresa);
		$this->Usuarios->SeguridadSocial($this->uri->segment(2));
		$this->listar->view="Usuarios/List_Monitores";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 
	}
	
	/*public function Administrativos(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		//detect_Sucursal($this->user);
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode	=	explode("-",$this->uri->segment(3));
		//$this->Usuarios->SeguridadSocial();
		$this->listar->view="Usuarios/List_Administrativos";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		//paginator($this->Usuarios->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 
	}*/
	
	public function AddSeguridadSocial(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
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
		detect_Sucursal($this->user);
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
		detect_Sucursal($this->user);
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
		detect_Sucursal($this->user);
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$explode	=	explode("-",$this->uri->segment(3));
		$this->Usuarios->getModelos(array("Modelos","Asociados","Monitores","Administrativos"));
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
		detect_Sucursal($this->user);
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

	public function UsuariosOnline(){
		$logueados = $this->Usuarios->VerUsuariosLogeados();
		if(!isset($logueados['error'])){
			foreach ($logueados as $k => $v) {
				$return[$v->user_id]['json'] 	= json_decode($v->json);
			}
			$this->Response = $return;
		}
		echo answers_json($this->Response);	return;	
	}
	
	public function Listado(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
	//	detect_Sucursal($this->user);
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$this->Usuarios->get_all2();		
		//return;
		/*DEVOLVEMOS RESULTADOS DEPENDIENDO DEL TIPO DE LLAMADO*/
		if ($this->input->is_ajax_request()) {
			$this->Response 	=			array("result"=>$this->Usuarios->result,"code"=>"200");	
			echo answers_json($this->Response);	
		}else{
			$this->listar->view="Usuarios/List_Usuarios2";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			listados($this->listar->view); 	
		}
	}
	
	public function generarPdfCertificadoLaboral(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));return;
		}
		detect_Sucursal($this->user);
		$user				=	centrodecostos($this->uri->segment(3));
		$empresa			=	centrodecostos($user->id_empresa);
		$centrodecostos     =   centrodecostos($user->centro_de_costos);
		//pre($centrodecostos);
		//return;cgh
		ob_start();
		$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
		$html				.=	$this->load->view('Template/PDF/CertificadoLaboral',array("user"=>$user,"empresa"=>$empresa,"centrodecostos"=>$centrodecostos),TRUE);	
		$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
		echo $html;
		$salida 			= 	ob_get_clean();
		//echo $salida;
		if($this->uri->segment($this->uri->total_segments()) == "email"){
			$correo = centrodecostos($this->uri->segment(3));
			$message = '<p>Hola <b>'.nombre($correo).'</b>, te hemos adjuntado una copia de tu certificado</p>
			<p>Gracias por hacer parte de nuestro equipo de trabajo.<p>
			<p>Para saber mas detalles puedes acceder a tu cuenta dando click a este <a href="https://webcamplus.com.co/beta1/Autenticacion">vínculo.</a></p>';
			preparar_pdf($salida,"PlantillaEmails",$correo->email,$asunto = "Certificado comercial ".nombre($correo),$message,"certificado comerciañ","Certificado comercial.pdf");
			$this->session->set_flashdata('success', 'El certificado ha sido enviado');
			redirect(base_url("Usuarios/CertificadoLaboral"));
			return;
		}
		CertificadoLaboral_pdf($salida);
	}
	
	public function generarPdfTratamientoDatos(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));return;
		}
		detect_Sucursal($this->user);
		$user				=	centrodecostos($this->uri->segment(3));
		$empresa			=	centrodecostos($user->id_empresa);
		$centrodecostos     =   centrodecostos($user->centro_de_costos);
		ob_start();
		$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
		$html				.=	$this->load->view('Template/PDF/TratamientoDatos',array("user"=>$user,"empresa"=>$empresa,"centrodecostos"=>$centrodecostos),TRUE);	
		$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
		echo $html;
		$salida 			= 	ob_get_clean();
		//echo $salida;
		CertificadoLaboral_pdf($salida,'Tratamiento de datos');
	}
		
	public function CertificadoLaboral(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
	//	detect_Sucursal($this->user);
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		//$this->Usuarios->CertificadoLaboral();		
		
		/*DEVOLVEMOS RESULTADOS DEPENDIENDO DEL TIPO DE LLAMADO*/
		if ($this->input->is_ajax_request()) {
			$this->Response 	=			array("result"=>$this->Usuarios->result,"code"=>"200");	
			echo answers_json($this->Response);	
		}else{
			$this->listar->view="Usuarios/List_CertificadoLaboral";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		//	paginator($this->Usuarios->total_rows);
			$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
			listados($this->listar->view); 	
		}
	}
	
	public function HonorariosModelo(){  
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
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
			$empresa			=	centrodecostos($this->user->id_empresa);
			$centrodecostos     =   centrodecostos($this->user->centro_de_costos); 
			ob_start();
			$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
			$html				.=	$this->load->view('Template/PDF/HonorariosModelo3',array("empresa"=>$empresa,"centrodecostos"=>$centrodecostos),TRUE);	
			$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
			echo $html;
			$salida 			= 	ob_get_clean();
			//echo $salida; return;
			CertificadoLaboral_pdf($salida);
			return;
		}
		if($this->uri->segment($this->uri->total_segments())=='excel'){
			if(post()){
				downloadExcel(post(),"Reporte_".$this->uri->segment(2));
				return;
			}
		}	
		if($this->uri->segment($this->uri->total_segments())=='mail'){
			if(post()){
				html_export_excel(post(),"Reporte_".$this->uri->segment(2));
				return;
			}
		}

		$this->listar->view	=	"Usuarios/Form_HonorariosModelo";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
		$this->Listado		=	$this->load->view('Template/Form',array(),TRUE);
		FormAjax($this->listar->view);	
	}
	
	public function HonorariosModeloAprobados(){  
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		if(post()){
			$set	=	$this->Usuarios->setAsignarNickname(post());
			if($set){	
				echo '<script>parent.location.reload();</script>';
			}else{
				echo '<script>alert("Error");</script>';
			}
			return;		
		}
		$this->Usuarios->getHonorariosModeloAprobados($this->uri->segment(4));
		if(empty($this->Usuarios->result)){
			$this->HonorariosModelo();
			return;
		}		
		if($this->uri->segment($this->uri->total_segments())=='PDF'){
				$user				=	centrodecostos($this->uri->segment(3));
				$empresa			=	centrodecostos($user->id_empresa);
				$centrodecostos     =   centrodecostos($user->centro_de_costos); 
				ob_start();
				$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
				$html				.=	$this->load->view('Template/PDF/HonorariosModeloAprobados',array("user"=>$user,"empresa"=>$empresa,"centrodecostos"=>$centrodecostos),TRUE);	
				$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
				echo $html;
				$salida 			= 	ob_get_clean();
				//echo $salida; return;
				CertificadoLaboral_pdf($salida);
				return;
			}
		if($this->uri->segment($this->uri->total_segments())=='excel'){
			if(post()){
				downloadExcel(post(),"Reporte_".$this->uri->segment(2));
				return;
			}
		}	
		if($this->uri->segment($this->uri->total_segments())=='mail'){
			if(post()){
				html_export_excel(post(),"Reporte_".$this->uri->segment(2));
				return;
			}
		}
		if($this->uri->segment($this->uri->total_segments()) == "Pagar"){
			$this->listar->view	=	"Usuarios/PagarHonorario";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
			FormAjax($this->listar->view);
			return;
		}
		$this->listar->view	=	"Usuarios/Form_HonorariosModeloAprobados";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
		FormAjax($this->listar->view);	
	}
	
	public function HonorariosModelos(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Usuarios->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Usuarios->search			=		post("search");
		$this->Usuarios->CalcularHonorarios("Usuarios",array('Modelos'));

		/*DEVOLVEMOS RESULTADOS DEPENDIENDO DEL TIPO DE LLAMADO*/
		if ($this->input->is_ajax_request()) {
			$this->Response 	=			array("result"=>$this->Usuarios->result,"code"=>"200");	
			echo answers_json($this->Response);	
		}else{
			$this->listar->view="Usuarios/List_HonorariosModelos";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			listados($this->listar->view); 	
		}
	}
	
	public function retencionFuente(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if($this->uri->segment($this->uri->total_segments()) == "PDF"){
			ob_start();
			$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
			$html				.=	$this->load->view('Template/PDF/List_CumplimientoMetas',"",TRUE);	
			$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
			echo $html;
			$salida 			= 	ob_get_clean();
			//echo $salida;return;
			CertificadoLaboral_pdf($salida);
			return;
		}		
		$this->listar->view				=		"Reportes/retencionFuente";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view);  
	}
	
	public function Roles(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Usuarios->search			=		post("search");
		$this->Usuarios->get_Roles();		
		
		/*DEVOLVEMOS RESULTADOS DEPENDIENDO DEL TIPO DE LLAMADO*/
		if ($this->input->is_ajax_request()) {
			$this->Response 	=			array("result"=>$this->Usuarios->result,"code"=>"200");	
			echo answers_json($this->Response);	
		}else{
			$this->listar->view="Usuarios/List_Roles";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			listados($this->listar->view); 	
		}
	}
	
	public function AddAsignarMaster(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		if(post()){
			if($this->uri->segment($this->uri->total_segments()) == "validar"){
				$validar = get_ListMaster(post('plataforma'));
				$master = array();
				foreach ($validar as $k => $v) {
					$master[] = $v->nombre_master;
				}
				echo answers_json($master);
				return;
			}
			$set	=	$this->Usuarios->setAsignarMaster(post());
			//pre(post()); return;	
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

	public function consultarModelos_x_Master(){
		$this->Usuarios->consultarModelos_x_Master(post());
	}
	
	public function AddAsignarNickname(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		if(post()){
			if(empty(post('id_master')) && !in_array(post('id_plataforma'),json_decode(post('rss')))){
				echo '<script>alert("Error, No puede guardar sin master");</script>';
			}else{
				$set	=	$this->Usuarios->setAsignarNickname(post());
				if($set){	
					echo '<script>parent.location.reload();</script>';
				}else{
					echo '<script>alert("Error");</script>';
				}
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
		detect_Sucursal($this->user);
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
		detect_Sucursal($this->user);
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
		detect_Sucursal($this->user);
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
		//detect_Sucursal($this->user);
	    //pre($this->uri->segment(3)); return;
		if(post()){
		///pre(post()); return;
			$set_user		=	$this->Usuarios->setCliente(post());
		//	pre($set_user); return;
			if($this->input->is_ajax_request()){	
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

		//	$this->Usuarios->get($possible_id,$this->uri->segment(3));
		
		if(!empty($possible_id)){
		//	$this->centro_costo	=	$this->Usuarios->centro_costo_rooms(@$this->Usuarios->result->id_empresa);
		}else{
			$this->centro_costo	=	null;	
		}
		//pre($possible_id); return;
	//	$this->dep_users		=	$this->Usuarios->get_empresas();

	if($this->uri->segment(4)){
		$this->Usuarios->get_all_clientes();
	}	
    $this->listar->view		=	"Usuarios/Form_Clientes";
		$this->util->set_title("Agregar ".$this->uri->segment(3)." - ".SEO_TITLE);	
		$modulo		=	$this->ModuloActivo;
		/*if(empty($this->$modulo->result) && $this->uri->segment(4)!=''){
			redirect(base_url('Usuarios/Todos/'.$this->uri->segment(3)));
			return;
		}*/
 		FormAjax($this->listar->view);	
	}
	
	public function Add_Todos_IFRAME_ADD(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
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
		//detect_Sucursal($this->user);
		if(post()){
			$set_user		=	$this->Usuarios->setClave(post());
		//	pre($set_user);  return;
			if($set_user['error']['code'] == "200" ){
				$this->session->set_flashdata('success', 'La contraceña ha sido modificada');
       	redirect(current_url());
			}else{
				$this->session->set_flashdata('danger', 'La contraceña no ha sido modificada');
				redirect(current_url());
			}
			//echo answers_json($this->Response);
						
		}else{
			$possible_id		=	$this->uri->segment($this->uri->total_segments());	
		}
	 //	pre($possible_id); return;
		//$this->Usuarios->get($possible_id,$this->uri->segment(3));
		
		if(!empty($possible_id)){
		//	$this->centro_costo	=	$this->Usuarios->centro_costo_rooms(@$this->Usuarios->result->id_empresa);
		}else{
			$this->centro_costo	=	null;	
		}
			
		//$this->dep_users		=	$this->Usuarios->get_empresas();
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
		detect_Sucursal($this->user);
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
		$data->json				=	$get->json;
		$data->sistema_salarial		=	$get->sistema_salarial;
		$ciclo_informacion			=	get_cf_ciclos_pagos_new($this->user->id_empresa,0);
		$periodo_pagos				=	centrodecostos($this->user->id_empresa);
		$data->ciclo_produccion_id	=	ciclopago($periodo_pagos->periodo_pagos,$ciclo_informacion->mes,$ciclo_informacion->fecha_desde);
		$tabla		=		DB_PREFIJO."cf_HonorariosModelos";
		$this->db->select('*')->from($tabla);
		$this->db->where('empresa_id',$this->user->id_empresa);
		$query			=	$this->db->get();
		$Configuracion	=	$query->row();
		
		
		$tabla	=	DB_PREFIJO."cf_ciclos_pagos";
		$ciclo	=	$this->db->select("*,DATE_FORMAT(fecha_desde,'%d') as desde,DATE_FORMAT(fecha_hasta,'%d') as hasta")->from($tabla)->where("estado",0)->get()->row();
		
		$this->session->set_userdata(array('User'=>$data,'Configuracion'=>$Configuracion,'CicloDePago'=>array("ciclos_id"=>$ciclo->ciclos_id,"objeto"=>$ciclo)));	
		$this->session->set_flashdata('success', 'El perfil ha sido asignado');
		redirect(base_url("Usuarios/Todos/CentroCostos"));
	}
	
	public function SetTotalizado(){
		$this->Usuarios->SetTotalizado(post());	
	}
	
	public function SetPerfil(){
		detect_Sucursal($this->user);
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
		
		$tabla		=		DB_PREFIJO."cf_HonorariosModelos";
		$this->db->select('*')->from($tabla);
		$this->db->where('empresa_id',$data->id_empresa);
		$query			=	$this->db->get();
		$Configuracion	=	$query->row();
		//pre($data);
		$this->session->set_userdata(array('User'=>$data,'Configuracion'=>$Configuracion));	
		
		$this->session->set_flashdata('success', 'El perfil ha sido asignado');
		redirect(base_url("Usuarios/".$this->uri->segment(4)));
	}
	
	public function ActivarPlataforma(){
		detect_Sucursal($this->user);
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
		redirect(base_url("Usuarios/TodosPlataformas/Plataforma/".$this->uri->segment(5)));
	}
	
	public function ActivarNickName(){
		detect_Sucursal($this->user);
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
		detect_Sucursal($this->user);
		$tabla		=	DB_PREFIJO."rp_operaciones";
		$this->db->where('tipo_documento',$this->uri->segment(3));
		$this->db->where('empresa_id',$this->user->id_empresa);
		$this->db->where('consecutivo',$this->uri->segment(4));
		if($this->db->update($tabla,array("estatus"=>9,"responsable_anular"=>$this->user->user_id))){
			$this->session->set_flashdata('success', 'El ingreso ha sido anulado ');	
		}else{
			$this->session->set_flashdata('danger', 'Problemas al anular Otro Ingreso');
		}
		redirect(base_url("Reportes/VerDetalleGasto2/".$this->uri->segment(4)));
	}
	
	public function DeleteNickname(){
		detect_Sucursal($this->user);
		if($this->Usuarios->DeleteNickname($this->uri->segment(4),$this->user->id_empresa)){
			$this->Response 		=			array(	"message"	=>	"Los datos han sido eliminados correctamente",
														"code"		=>	"200");
		}else{
			$this->Response 		=			array(	"message"	=>	"Lo siento, presentamos un problema y no pudimos eliminados los datos",
														"code"		=>	"203");
		}
		echo answers_json($this->Response);
	}
 public function SetEmpresa()
 {
	  $tabla	=	"mae_cliente_joberp t1";
	  $tabla2	=	"usuarios t2";
	  $data	=	$this->user;
    $data->empresa_id=  $this->uri->segment(3);
    $this->session->set_userdata(array('User'=>$data));
 	  $this->session->set_flashdata('success', 'El perfil ha sido asignado');
		redirect(base_url("Empresas"));
	}

	public function Bonificaciones(){
		if(!isset($_SERVER['HTTP_REFERER'])){
			redirect(base_url("Main/ErrorUrl"));
			return;
			}
			$this->listar->view="Usuarios/List_Bonificaciones";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			Listados($this->listar->view);
	}

	public function Honorarios (){
		if(!isset($_SERVER['HTTP_REFERER'])){
			redirect(base_url("Main/ErrorUrl"));
			return;
			}
			$this->listar->view="Usuarios/List_Honorarios";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			Listados($this->listar->view);
	}

	public function Vinculacion(){
		if(!isset($_SERVER['HTTP_REFERER'])){
			redirect(base_url("Main/ErrorUrl"));
			return;
			}
			if ($this->uri->segment(3)=="directa"){
				$this->listar->view="Usuarios/List_Vinculacion";
	
			}else if ($this->uri->segment(3)=="otros"){
        $this->listar->view="Usuarios/List_VinculacionOtros";
			}
			
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			Listados($this->listar->view);
	}

	public function ProgramarEntrevista(){
		if(!isset($_SERVER['HTTP_REFERER'])){
			redirect(base_url("Main/ErrorUrl"));
			return;
			}
			$this->listar->view="Usuarios/List_ProgramarEntrevista";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			Listados($this->listar->view);
	}

	public function ConocimientoAspirante(){
		if(!isset($_SERVER['HTTP_REFERER'])){
			redirect(base_url("Main/ErrorUrl"));
			return;
			}
			$this->listar->view="Usuarios/List_ProgramarAspirante";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			Listados($this->listar->view);
	}

	public function AdministrarPlataformas(){
		if(!isset($_SERVER['HTTP_REFERER'])){
			redirect(base_url("Main/ErrorUrl"));
			return;
			}
			$this->listar->view="Usuarios/List_AdministrarPlataformas";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			Listados($this->listar->view);
	}

	public function AdministrarUsuarios(){
		if(!isset($_SERVER['HTTP_REFERER'])){
			redirect(base_url("Main/ErrorUrl"));
			return;
			}
			$this->listar->view="Usuarios/List_AdministrarUsuarios";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			Listados($this->listar->view);
	}


	public function Comunicados(){
		if(!isset($_SERVER['HTTP_REFERER'])){
			redirect(base_url("Main/ErrorUrl"));
			return;
			}
			$this->listar->view="Usuarios/List_Comunicados";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			Listados($this->listar->view);
	}

	public function Chat(){
		if(!isset($_SERVER['HTTP_REFERER'])){
			redirect(base_url("Main/ErrorUrl"));
			return;
			}
			$this->listar->view="Usuarios/List_Chat";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			Listados($this->listar->view);
	}

	public function VerClientes(){
		if(!isset($_SERVER['HTTP_REFERER'])){
			redirect(base_url("Main/ErrorUrl"));
			return;
			}
			$this->Usuarios->GetClientes(); 
			$this->listar->view="Usuarios/List_VerClientes";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			FormAjax($this->listar->view);
}

	public function EstadoCliente(){
		if(!isset($_SERVER['HTTP_REFERER'])){
			redirect(base_url("Main/ErrorUrl"));
			return;
			}
	 
		if($this->uri->segment(5) == "Activos"){
			$var['estado'] = 0;
		}else{
			$var['estado'] = 1;
		}
	   //pre($var); return;
		 $this->db->where("id",$this->uri->segment(4));
		 $this->db->update("mae_cliente",array("estado"=>$var['estado']));
		 $this->db->reset_query();
		 $this->session->set_flashdata($Response[0],$Response[1]);
		 redirect($_SERVER['HTTP_REFERER']);return;
	}

public function Vendedores(){
	if(!defined('APANEL_USUARIOS')){
		redirect(base_url("Main/modulo_inactivo"));	return;
	}

	if(!isset($_SERVER['HTTP_REFERER'])){
		redirect(base_url("Main/ErrorUrl"));
		return;
 }
		$this->listar->view="Usuarios/Ver_vendedores";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		Listados($this->listar->view); 
}

public function proveedores(){
	if(!defined('APANEL_USUARIOS')){
		redirect(base_url("Main/modulo_inactivo"));	return;
	}

	if(!isset($_SERVER['HTTP_REFERER'])){
		redirect(base_url("Main/ErrorUrl"));
		return;
 }
    $this->Usuarios->GetProveedores();
    $this->listar->view="Usuarios/List_Proveedores";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		Listados($this->listar->view); 
}

 public function add_proveedores(){
	if(!defined('APANEL_USUARIOS')){
		redirect(base_url("Main/modulo_inactivo"));	return;
	}
	   if(!isset($_SERVER['HTTP_REFERER'])){
	   	redirect(base_url("Main/ErrorUrl"));
	   	return;
		 }
		 if(post()){
		//	pre(post());return;
			$set_proveedores		=	$this->Usuarios->SetProveedores(post());
			if($set_proveedores){	
				echo '<script>parent.location.reload();</script>';
			}else{
				echo '<script>alert("Error");</script>';
			}	
			return;		
		}
		if($this->uri->segment(4)){
			$this->Usuarios->GetProveedores();
		}	
	$this->listar->view		=	"Usuarios/Form_Proveedores";
	$this->util->set_title("Agregar ".$this->uri->segment(3)." - ".SEO_TITLE);	
	$modulo		=	$this->ModuloActivo;
	FormAjax($this->listar->view);	 
	}

  public function VerProveedores(){
		if(!isset($_SERVER['HTTP_REFERER'])){
			redirect(base_url("Main/ErrorUrl"));
			return;
			}
			$this->Usuarios->GetProveedores(); 
			$this->listar->view="Usuarios/List_VerProveedores";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			FormAjax($this->listar->view);
	}

	public function Add_vendedores(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
			 if(!isset($_SERVER['HTTP_REFERER'])){
				 redirect(base_url("Main/ErrorUrl"));
				 return;
			 }
			 if(post()){


			 }
			 $this->listar->view		=	"Usuarios/Form_vendedores";
			 $this->util->set_title("Agregar ".$this->uri->segment(3)." - ".SEO_TITLE);	
			 $modulo		=	$this->ModuloActivo;
			 FormAjax($this->listar->view); 
	}

	public function EstadoProveedores(){
		if(!isset($_SERVER['HTTP_REFERER'])){
			redirect(base_url("Main/ErrorUrl"));
			return;
			}
			if($this->uri->segment(5) == "Activos"){
				$var['estado'] = 0;
			}else{
				$var['estado'] = 1;
			}
      //echo $this->uri->segment(4); return;
			$this->db->where("id",$this->uri->segment(4));
			$this->db->update("mae_proveedores",array("estado"=>$var['estado']));
			$this->db->reset_query();
			$this->session->set_flashdata('Cambio de estado');
			redirect($_SERVER['HTTP_REFERER']);return;
	    }
	
	
}
?>