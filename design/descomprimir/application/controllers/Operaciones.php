<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Operaciones extends CI_Controller {
	
	var $util,$user,$ModuloActivo,$path,$listar,$Operaciones,$Breadcrumb,$Uri_Last,$Listado;
	
	public function __construct(){    	
        parent::__construct();
		if(!defined('APANEL_OPERACIONES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(!APANEL_OPERACIONES){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}

		$this->util 		= 	new Util_model();
		$this->Breadcrumb 	=	$this->uri->segment_array();
		$this->Uri_Last		=	$this->uri->segment($this->uri->total_rsegments());
		$this->user			=	$this->session->userdata('User');
		$this->ModuloActivo	=	'Operaciones';
		$this->Path			=	PATH_VIEW.'/Template/'.$this->ModuloActivo;
		$this->listar		=	new stdClass();			

		if(empty($this->user)){
			redirect(base_url("Main"));	return;
		}
		
		if(defined('APANEL_OPERACIONES')){
			$this->load->model("Operaciones/Operaciones_model");
			$this->Operaciones	= 	new Operaciones_model();
		}
		chequea_session($this->user);
    }
	
	public function Index(){
		if(!defined('APANEL_OPERACIONES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		redirect(base_url($this->uri->segment(1)."/Listado"));	return;
	}
	
	public function Retiros(){
		/*if(!defined('ADD_CLIENTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}*/
		$this->Operaciones->getRetiro();
 		$this->listar->view="Operaciones/List_Retiros_Trm";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
		listados($this->listar->view);
	}

	public function Add_Retiro_Trm(){
		if(!defined('APANEL_OPERACIONES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}		
		if(post()){
			$set_Retiro		=	$this->Operaciones->setRetiroTrm(post());
			//return;
			if($set_Retiro){	
				echo '<script>parent.location.reload();</script>';
			}else{
				echo '<script>alert("Error");</script>';
			}
			return;		
		}else{
			$id		=	$this->uri->segment($this->uri->total_segments());	
		}
		
 		$this->listar->view="Operaciones/Form_Retiro_Trm";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
		FormAjax($this->listar->view);
	}

	public function Cajas(){
		if(!defined('APANEL_OPERACIONES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Operaciones->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Operaciones->search			=		post("search");
		$explode							=		explode("-",$this->uri->segment(3));
		$this->Operaciones->ResumenCajas();
		$this->listar->view="Operaciones/List_ResumenCajas";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view); 	
	}
	
	public function Bancos(){
		if(!defined('APANEL_OPERACIONES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Operaciones->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Operaciones->search			=		post("search");
		$explode							=		explode("-",$this->uri->segment(3));
		$this->Operaciones->ResumenBancos();
		$this->listar->view="Operaciones/List_ResumenBancos";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Operaciones->total_rows);
		listados($this->listar->view); 	
	}
	
	public function DetallesCajas(){
		if(!defined('APANEL_OPERACIONES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Operaciones->CajasDetalles($this->uri->segment(3));
		$this->listar->view="Operaciones/List_CajasDetalles";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Operaciones->total_rows);
		FormAjax($this->listar->view);		
	}

	public function BancosDetallesContable(){
		if(!defined('APANEL_OPERACIONES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Operaciones->BancosDetalles($this->uri->segment(3));
		$this->listar->view="Operaciones/List_BancosDetalles";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Operaciones->total_rows);
		FormAjax($this->listar->view);		
	}
	
	public function RetirosTRMDetalles(){
		if(!defined('APANEL_OPERACIONES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Operaciones->RetirosTRMDetalles($this->uri->segment(3));
		if($this->uri->segment(4)=='PDF'){
				$user				=	centrodecostos($this->uri->segment(3));
				$empresa			=	centrodecostos($user->id_empresa);
				$datos 				=   $this->Operaciones->RetirosTRMDetalles($this->uri->segment(3));
				ob_start();
				$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
				$html				.=	$this->load->view('Template/PDF/RetirosTRMDetalles',array("user"=>$user,"empresa"=>$empresa,"datos"=>$datos),TRUE);	
				$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
				echo $html;
				$salida 			= 	ob_get_clean();
				//echo $salida;
				CertificadoLaboral_pdf($salida);
				return;
			}
		$this->listar->view="Operaciones/RetirosTRMDetalles";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Operaciones->total_rows);
		FormAjax($this->listar->view);
	}
}
?>