<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Formularios extends CI_Controller {
	
	var $util,$user,$ModuloActivo,$path,$Usuarios,$Breadcrumb,$Entrevista;
	
	public function __construct(){    	
        parent::__construct();
		$this->util 		= 	new Util_model();
		$this->user			=	$this->session->userdata('User');
		$this->ModuloActivo	=	'Formularios';
		$this->load->model("Formularios/Formularios_model");
		$this->Formularios	= 	new Formularios_model();
		$this->listar		= 	new stdClass();

		if($this->uri->segment(2) != "Autenticacion" && $this->uri->segment(2) != "Entrevista"){
			if(!isset($_SERVER['HTTP_REFERER'])){
				redirect(base_url("Main/ErrorUrl"));
				return;
			}
		}
	}
	
	public function Index(){
		
	}

	public function ConocimientoAspirante(){
		redirect(base_url("Formularios/ProgramarEntrevistas/add/ConocimientoAspirante"));
	}

	public function cerrar_entrevista(){
		$close = $this->Formularios->cerrar_entrevista();
		if($close){
			$website = centrodecostos($this->user->empresa_id)->website;
			redirect($website);
			return;
		}
	}
	
	public function VerDetalles (){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Formularios->user=$this->user;
		$this->Formularios->getEntrevistas();
		if($this->uri->segment(4)=='excel'){
			if(post()){
				downloadExcel(post(),"Reporte_".$this->uri->segment(2));
				return;
			}
		}	
		if($this->uri->segment(4)=='mail'){
			if(post()){
				html_export_excel(post(),"Reporte_".$this->uri->segment(2));
				return;
			}
		}
		if($this->uri->segment(4)=='PDF'){
				$empresa			=	centrodecostos($this->user->id_empresa);
				ob_start();
				$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
				$html				.=	$this->load->view('Template/PDF/VerDetallesEntrevista',array('empresa'=>$empresa),TRUE);	
				$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
				echo $html;
				$salida 			= 	ob_get_clean();
				//echo $salida;return;
				CertificadoLaboral_pdf($salida);
				return;
		}
		if($this->uri->segment(5)=='excel'){
			if(post()){
				downloadExcel(post(),"Reporte_".$this->uri->segment(2));
				return;
			}
		}	
		if($this->uri->segment(5)=='mail'){
			if(post()){
				html_export_excel(post(),"Reporte_".$this->uri->segment(2));
				return;
			}
		}
		if($this->uri->segment(5)=='PDF'){
				$empresa			=	centrodecostos($this->user->id_empresa);
				ob_start();
				$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
				$html				.=	$this->load->view('Template/PDF/VerDetallesExamen',array('empresa'=>$empresa),TRUE);	
				$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
				echo $html;
				$salida 			= 	ob_get_clean();
				//echo $salida;return;
				CertificadoLaboral_pdf($salida);
				return;
		}
		if($this->uri->segment(4)=='examen'){
			$this->listar->view="Formularios/VerDetallesExamen";
		}else{
			$this->listar->view="Formularios/VerDetalles";
		}
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		FormAjax($this->listar->view); 
	}
	
	public function ProgramarEntrevistas(){
		detect_Sucursal($this->user);
		if(post()){	
			$set_Entrevista		=	$this->Formularios->setEntrevista(post());
			if($set_Entrevista){
				if($this->uri->segment(4) == "ConocimientoAspirante"){
					$this->session->set_flashdata('success', 'Felicitaciones, la invitación ha sido enviada.');
						redirect(base_url("Usuarios/ResumenEntrevistas/detalle"));	
				}else{
					$this->session->set_flashdata('success', 'Felicitaciones, la invitación ha sido enviada.');
					echo '<script>parent.location.reload();</script>';
				}	
			}else{
				$this->session->set_flashdata('danger', 'Lo sentimos, la invitación no fue enviada.');	
				echo '<script>alert("Error");</script>';
			}
			return;
		}
		if($this->uri->segment(3)=='add'){
			$this->Entrevistas	=	$this->Formularios->Get($this->uri->segment(4,0));
			if($this->uri->segment(4) == "ConocimientoAspirante"){
				listados($this->ModuloActivo."/IndexAjax");
			}else{
				FormAjax($this->ModuloActivo."/IndexAjax");
			}
			return;	
		}
		$this->Formularios->get_form_control();
		$this->Entrevistas	=	$this->Formularios->Get(NULL);
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->ModuloActivo."/Index");
	}

	public function detalleAspirante(){
			$this->Formularios->get_form_control();
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			FormAjax($this->ModuloActivo."/Detalle_aspirante");
			return;
	}

	public function aspirante(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(post()){
			$set = $this->Formularios->set_form_control(post());
			if($set){
				$this->session->set_flashdata('success', 'Felicitaciones, El registro ha sido insertado exitosamente.');
				echo '<script>parent.location.reload();</script>';
			}else{
				$this->session->set_flashdata('danger', 'Lo sentimos, no se ha podido insertar el registro.');	
				echo '<script>alert("Error");</script>';
			}
			return;
		}
		if($this->uri->segment(3)){
			$this->Formularios->get_form_control();
		}
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		FormAjax($this->ModuloActivo."/Form_aspirante");
	}
	
	public function Autenticacion(){
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Autenticacion	=	$this->Formularios->Autenticacion($this->uri->segment(3));
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		FrontEnd($this->ModuloActivo."/Index");
	}

	public function CambiarEstado(){
		$set = $this->Formularios->CambiarEstado();
		$url = base_url("Formularios/detalleAspirante/".$this->uri->segment(4).'#observaciones');
		if($set == 2){
			$message = 'Felicitaciones,El aspirante fue aprobado';
			if(ObservationDefault(array("url"=>$url,"observacion"=>$message))){
				$this->session->set_flashdata('success', $message);
			}else{
				$this->session->set_flashdata('danger', $message.", pero la observacion no fue guardada");
			}
		}else if($set == 1){
			$message = 'El aspirante fue reagendado';
			if(ObservationDefault(array("url"=>$url,"observacion"=>$message))){
				$this->session->set_flashdata('success', $message);
			}else{
				$this->session->set_flashdata('danger', $message.", pero la observacion no fue guardada");
			}
		}else if($set == 3){
			$message = 'Felicitaciones,El aspirante fue Rechazado';
			if(ObservationDefault(array("url"=>$url,"observacion"=>$message))){
				$this->session->set_flashdata('success', $message);
			}else{
				$this->session->set_flashdata('danger', $message.", pero la observacion no fue guardada");
			}
		}else if($set == 4){
			$message = 'El aspirante fue cambiado a no asistido';
			if(ObservationDefault(array("url"=>$url,"observacion"=>$message))){
				$this->session->set_flashdata('success', $message);
			}else{
				$this->session->set_flashdata('danger', $message.", pero la observacion no fue guardada");
			}
		}else{
			$message = 'Lo sentimos, este aspirante no pudo ser modificado';	
			if(ObservationDefault(array("url"=>$url,"observacion"=>$message))){
				$this->session->set_flashdata('danger', $message);
			}else{
				$this->session->set_flashdata('danger', $message.", pero la observacion no fue guardada");
			}
		}
		redirect(base_url("Formularios/ProgramarEntrevistas"));	return;
	}
	
	public function Entrevista(){
		$this->user			=	$this->session->userdata('UserEncuesta');
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(post()){	
			if($this->uri->segment(5)){
				$this->Formularios->SetPreguntas(post());
				if($this->uri->segment(5)==19){
					$this->Formularios->SetPrimeraEtapa($this->user->entrevista_id);	
				}	
			}else{
				$this->Formularios->ChequearUsuario(post());	
			}
		}
		
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		FrontEnd($this->ModuloActivo."/Index");
	}
	
	public function Examen(){
		$this->user			=	$this->session->userdata('UserEncuesta');
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(post()){	
			if($this->uri->segment(5)){
				$this->Formularios->SetPreguntas(post());
				if($this->uri->segment(5)==19){
					$this->Formularios->SetPrimeraEtapa($this->user->entrevista_id);	
				}	
			}else if($this->uri->segment(4)!='2' && empty(post("finish"))){
				if($this->Formularios->setExamen(post())){
					redirect(base_url("Formularios/Examen/Examen/finish"));	return;	
				}
			}else if($this->uri->segment(4)=='2' && !empty(post("finish"))){
				if($this->Formularios->setExamen(post())){
					$website = @centrodecostos($this->user->empresa_id)->website;
					$comprobar_website = comprobar_website($website);
					if($comprobar_website){
						//header("location: http://".$website);	return;
					}else{
						redirect(base_url());
					}	
				}
			}else{
				$this->Formularios->SetPreguntas(post());
				
			}
		}else if(!$this->uri->segment(4)){
			if($this->Formularios->SavePreguntas()){
				redirect(base_url("Formularios/Examen/Examen/1"));	
			}
			return;
		}
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		FrontEnd($this->ModuloActivo."/Index");
	}	
	
}
?>