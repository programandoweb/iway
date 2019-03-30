<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {
	
	var $util,$user,$ModuloActivo,$path,$listar,$Reportes,$Breadcrumb,$Uri_Last,$Listado;
	
	public function __construct(){    	
        parent::__construct();
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		
		$this->util 		= 	new Util_model();
		$this->Breadcrumb 	=	$this->uri->segment_array();
		$this->Uri_Last		=	$this->uri->segment($this->uri->total_rsegments());
		$this->user			=	$this->session->userdata('User');
		$this->CicloDePago	=	$this->session->userdata('CicloDePago');
		$this->ModuloActivo	=	'Reportes';
		$this->Path			=	PATH_VIEW.'/Template/'.$this->ModuloActivo;
		$this->listar		=	new stdClass();
		
		if(empty($this->user)){
			redirect(base_url("Main"));	return;
		}			

		if(defined('APANEL_REPORTES')){
			$this->load->model("Reportes/Reportes_model");
			$this->Reportes	= 	new Reportes_model();
		}
		chequea_session($this->user);
    }
	
	public function Index(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		redirect(base_url($this->uri->segment(1)."/Listado"));	return;
	}
	
	public function Compras(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);		
		$this->Reportes->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Reportes->search			=		post("search");
		$explode	=	explode("-",$this->uri->segment(2));
		$this->Reportes->regPres(array('Modelos'));
		$this->listar->view="Reportes/List_Presupuesto";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Reportes->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 
	}

	public function Add_Compras(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		if(post()){
			$set		=	$this->Reportes->setAddDiario(post());
			if($set){	
				echo '<script>parent.location.reload();</script>';
			}else{
				echo '<script>alert("Error");</script>';
			}
			return;		
		}
		$this->listar->view				=		"Reportes/Form_Add_Compra";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		FormAjax($this->listar->view); 	
	}
	
	public function Nominas(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		if(post()){
			$set		=	$this->Reportes->setPresupuesto(post());	
			if(!isset($set['error'])){
				$this->Response 		=			array(	"code"		=>	"200");
			}else{
				$this->Response 		=			$set['error'];
			}
			echo answers_json($this->Response);	return;					
		}
		
		$this->Reportes->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Reportes->search			=		post("search");
		$explode	=	explode("-",$this->uri->segment(2));
		$this->Reportes->regPres(array('Modelos'));
		if($this->uri->segment(3)=='PDF'){
				//$row				=	$this->Reportes->get_facturas($this->uri->segment(3));
				//$user				=	centrodecostos($row->centro_de_costos);
				//$empresa			=	centrodecostos($user->id_empresa);
				ob_start();
				$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
				$html				.=	$this->load->view('Template/PDF/Nominas',"",TRUE);	
				$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
				echo $html;
				$salida 			= 	ob_get_clean();
				//echo $salida;return;
				CertificadoLaboral_pdf($salida);
				return;
		}
		$this->listar->view="Reportes/List_Presupuesto";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Reportes->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 
	}

	public function Presupuesto(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		if(post()){
			$set		=	$this->Reportes->setPresupuesto(post());	
			if(!isset($set['error'])){
				$this->Response 		=			array(	"code"		=>	"200");
			}else{
				$this->Response 		=			$set['error'];
			}
			echo answers_json($this->Response);	return;					
		}
		$this->Reportes->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Reportes->search			=		post("search");
		$explode	=	explode("-",$this->uri->segment(2));
		$this->Reportes->regPres(array('Modelos'));
		if($this->uri->segment(4)=='PDF'){
				$empresa			=	centrodecostos($this->user->id_empresa);
				ob_start();
				$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
				$html				.=	$this->load->view('Template/PDF/Presupuesto',array('empresa'=>$empresa),TRUE);	
				$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
				echo $html;
				$salida 			= 	ob_get_clean();
				//echo $salida;return;
				pdf_A5($salida,array(0,0,608,530));
				return;
		}
		if($this->uri->segment(3)){
			$this->listar->view="Reportes/Detalle_Presupuesto";
		}else{
			$this->listar->view="Reportes/List_Presupuesto";
		}
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Reportes->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);
		if($this->uri->segment(3)){
			FormAjax($this->listar->view);
		}else{
			listados($this->listar->view);
		} 
	}
	
	public function VerDetalleGasto(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Reportes->get_facturas2();	
		$this->Reportes->result['registro_contable']	=	$this->Reportes->get_contable($this->uri->segment(3),array(),array("8"));
		if($this->uri->segment(4)=='PDF'){
				$empresa			=	centrodecostos($this->user->id_empresa);
				ob_start();
				$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
				$html				.=	$this->load->view('Template/PDF/VerDetalleGasto',array('empresa'=>$empresa),TRUE);	
				$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
				echo $html;
				$salida 			= 	ob_get_clean();
				//echo $salida;return;
				pdf_A5($salida,array(0,0,608,530));
				return;
		}			
		$this->listar->view				=		"Reportes/List_VerDetalleGasto";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		FormAjax($this->listar->view); 
	}
	
	public function FacturaComprar(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Reportes->get_facturas2();			
		$this->listar->view				=		"Reportes/List_FacturaComprar";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Reportes->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 	
	}
	
	public function FacturaVentas(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Reportes->get_facturas_new();			
		$this->listar->view				=		"Reportes/List_FacturaVentas";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view); 	
	}
	
	public function PorModelos(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Reportes->RP_Modelos();	
		if($this->uri->segment(3)=='PDF'){
				$empresa			=	centrodecostos($this->user->id_empresa);
				ob_start();
				$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
				$html				.=	$this->load->view('Template/PDF/PorModelos',array('empresa'=>$empresa),TRUE);	
				$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
				echo $html;
				$salida 			= 	ob_get_clean();
				//echo $salida;return;
				CertificadoLaboral_pdf($salida);
				return;
		}		
		$this->listar->view				=		"Reportes/List_PorModelos";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view); 	
	}
	
	public function PorPeriodos(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Reportes->RP_Modelos();	
		if($this->uri->segment(3)=='PDF'){
				$empresa			=	centrodecostos($this->user->id_empresa);
				ob_start();
				$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
				$html				.=	$this->load->view('Template/PDF/PorPeriodos',array('empresa'=>$empresa),TRUE);	
				$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
				echo $html;
				$salida 			= 	ob_get_clean();
				//echo $salida;return;
				CertificadoLaboral_pdf($salida);
				return;
		}		
		$this->listar->view				=		"Reportes/List_PorPeriodos";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Reportes->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 	
	}
	
	public function PorMonitor(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Reportes->RP_Modelos();	
		if($this->uri->segment(3)=='PDF'){
				$empresa			=	centrodecostos($this->user->id_empresa);
				ob_start();
				$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
				$html				.=	$this->load->view('Template/PDF/PorMonitor',array('empresa'=>$empresa),TRUE);	
				$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
				echo $html;
				$salida 			= 	ob_get_clean();
				//echo $salida;return;
				CertificadoLaboral_pdf($salida);
				return;
		}		
		$this->listar->view				=		"Reportes/List_PorMonitor";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Reportes->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 	
	}
	
	public function PorPaginas(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Reportes->RP_Plataformas();
		if($this->uri->segment(3)=='PDF'){
				//$row				=	$this->Reportes->get_facturas($this->uri->segment(3));
				//$user				=	centrodecostos($row->centro_de_costos);
				$empresa			=	centrodecostos($this->user->id_empresa);
				ob_start();
				$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
				$html				.=	$this->load->view('Template/PDF/PorPaginas',array('empresa'=>$empresa),TRUE);	
				$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
				echo $html;
				$salida 			= 	ob_get_clean();
				//echo $salida;return;
				CertificadoLaboral_pdf($salida);
				return;
		}			
		$this->listar->view				=		"Reportes/List_PorPaginas";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view); 	
	}
	
	public function UsuariosXMaster(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Reportes->get_UsuariosXMaster();
		if($this->uri->segment(3)=='PDF'){
				$datos 	= 	$this->Reportes->get_UsuariosXMaster(); 	
			    pre($datos); return;
				//$row				=	$this->Reportes->get_facturas($this->uri->segment(3));
				//$user				=	centrodecostos($row->centro_de_costos);
				//$empresa			=	centrodecostos($user->id_empresa);
				ob_start();
				$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
				$html				.=	$this->load->view('Template/PDF/UsuariosXMaster',array(),TRUE);	
				$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
				echo $html;
				$salida 			= 	ob_get_clean();
				//echo $salida;return;
				CertificadoLaboral_pdf($salida);
				return;
		}					
		$this->listar->view				=		"Reportes/List_UsuariosXMaster";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Reportes->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 	
	}
	
	public function VerFactura(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		if($this->uri->segment(4)){
			if(post() && !$this->uri->segment(4)){
				$set	=	$this->Reportes->set_cuenta_contable(post());
				if($set){	
					echo '<script>parent.location.reload();</script>';
				}else{
					echo '<script>alert("Error");</script>';
				}
				return;
			}
			if($this->uri->segment(4)=='PDF'){
				$row				=	$this->Reportes->get_facturas($this->uri->segment(3));
				$user				=	centrodecostos($row->centro_de_costos);
				$empresa			=	centrodecostos($user->id_empresa);
				ob_start();
				$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
				$html				.=	$this->load->view('Template/PDF/Factura2',array("user"=>$user,"empresa"=>$empresa,"row"=>$row),TRUE);	
				$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
				echo $html;
				$salida 			= 	ob_get_clean();
				//echo $salida; return;
				CertificadoLaboral_pdf($salida);
				return;
			}else if($this->uri->segment(4)=='sinmarco'){
				$this->Reportes->get_facturas($this->uri->segment(3));			
				FormAjax("Reportes/List_VerFactura");
			}else if($this->uri->segment(4)=='anular'){	
				if(estatus(9,'rp_operaciones','',$this->uri->segment(3))){	
					
				}else{
					
				}
				redirect(base_url("Reportes/FacturaVentas"));	return;
			}else if($this->uri->segment(4)=='detalle_contable'){
				$this->Reportes->factura						=	$this->Reportes->get_facturas($this->uri->segment(5));
				$this->Reportes->result['detalle_ingreso']		=	$this->Reportes->get_detalle_contable($this->uri->segment(3),array("111010"),array("5"));
				$this->Reportes->result['registro_contable']	=	$this->Reportes->get_contable($this->uri->segment(3),array("130510","111010"),array("5"));
				$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
				if($this->uri->segment($this->uri->total_segments())=='PDF'){
					$empresa			=	centrodecostos($this->user->id_empresa);
					ob_start();
					$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
					$html				.=	$this->load->view('Template/PDF/detalle_contable',array("empresa"=>$empresa),TRUE);	
					$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
					echo $html;
					$salida 			= 	ob_get_clean();
					//echo $salida; return;
					pdf_A5($salida,array(0,0,600,540));
					//CertificadoLaboral_pdf($salida);
					return;
				}	
				FormAjax("Reportes/Form_detalle_contable");				
			}else{
				if(post()){
					$set	=	$this->Reportes->set_RecibirFactura(post());
					if($set){	
						echo '<script>parent.location.reload();</script>';
					}else{
						echo '<script>alert("Error");</script>';
					}
					return;
				}
				$this->Reportes->get_facturas($this->uri->segment(3));	
				FormAjax("Reportes/Form_Recibir");	
			}			
			return;	
		}else{
			$this->Reportes->get_facturas($this->uri->segment(3));			
			$this->listar->view				=		"Reportes/List_VerFactura";
		}
		
		listados($this->listar->view); 	
	}
	
	public function ResultadoImport(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		if($this->uri->segment(3)=='Clear'){
			$this->db->truncate(DB_PREFIJO."rp_operaciones");
			$this->db->truncate(DB_PREFIJO."rp_operaciones_json");
			$this->db->truncate(DB_PREFIJO."rp_tmp");
			$this->db->truncate(DB_PREFIJO."sys_consecutivo");
			$this->db->truncate(DB_PREFIJO."sys_logs");
			$this->db->truncate(DB_PREFIJO."rp_retiroTRM");
			redirect(base_url("Reportes/InformePlano"));	return;
		}
		
		$this->Reportes->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Reportes->search			=		post("search");
		if($this->uri->segment(4)<4){
			$this->Reportes->get_ResultadoImport();	
			$this->listar->view				=		"Reportes/List_ResultadoImport";	
		}elseif($this->uri->segment(4)==4){
			$this->Reportes->get_reporte($this->user);
			$this->listar->view				=		"Reportes/List_ResultadoImportPaso4";	
		}else{
			return;
		}
		
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Reportes->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 
			
	}
	
	public function InformePlano(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		if(post()){
			$set	=	$this->Reportes->setInformePlano(post());
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
					$this->session->set_flashdata('success', 'Felicitaciones, el archivo plano ha cambiado sin inconvenientes. '.$set);
				}else{
					$this->session->set_flashdata('danger', 'Lo sentimos, '.$set['error'].'.');	
				}
				redirect(base_url("Reportes/ResultadoImport"));
			}
			return;	
		}
		$possible_id		=	$this->uri->segment($this->uri->total_segments());
		$this->listar->view	="Reportes/Form_Upload";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
		$this->Listado	=	$this->load->view('Template/Form',array(),TRUE);
		Form($this->listar->view);
	}
	
	public function MakeFactura2(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$set	=	$this->Reportes->MakeFactura2(post());
		if($set){
			/*if($this->uri->total_segments());==base_url("Reportes/Add_Factura2");){
				redirect(base_url("Reportes/Add_Factura2"));
			}else{
				echo '<script>parent.location.reload();</script>';
			}*/
			echo '<script>parent.location.reload();</script>';
		}else{
			echo '<script>alert("Error");</script>';
		}
	}
	
	public function MakeFactura(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		//pre(post());return;
		if($this->Reportes->MakeFactura(post())){
			$this->Response 		=			array(	"message"	=>	"Los datos han sido guardados correctamente",
														"callback"	=>	"reloader_iframe()");
		}else{
			$this->Response 		=			array(	"message"	=>	"No se pudo guardar los datos",
														"code"		=>	"203");
		}
		echo answers_json($this->Response);			return;	
	}
	
	public function Diarios(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Reportes->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Reportes->search			=		post("search");
		$this->Reportes->get_diario();		
		$this->listar->view				=		"Reportes/List_Reportes";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view); 	
	}
	
	public function Novedades(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Reportes->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Reportes->search			=		post("search");
		$this->Reportes->get_Novedades();		
		$this->listar->view				=		"Reportes/List_Novedades";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Reportes->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 	
	}

	public function DiasTrabajados(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Reportes->get_DiasTrabajados();
		if($this->uri->segment(3)=='PDF'){
				$empresa			=	centrodecostos($this->user->id_empresa);
				ob_start();
				$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
				$html				.=	$this->load->view('Template/PDF/DiasTrabajados',array('empresa'=>$empresa),TRUE);	
				$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
				echo $html;
				$salida 			= 	ob_get_clean();
				//echo $salida;return;
				CertificadoLaboral_pdf($salida);
				return;
		}		
		$this->listar->view				=		"Reportes/List_DiasTrabajados";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Reportes->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 	
	}
	
	public function Quincenales(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Reportes->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Reportes->search			=		post("search");
		$this->Reportes->get_quicena();		
		$this->listar->view				=		"Reportes/List_ReportesQ";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Reportes->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 	
	}
	
	public function DetalleQuincenales(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Reportes->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Reportes->search			=		post("search");
		$this->Reportes->get_diario($this->uri->segment(3),$this->uri->segment(4));		
		$this->listar->view				=		"Reportes/List_ReportesQDetalle";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Reportes->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		FormAjax($this->listar->view); 	
	}
	
	public function Add_Factura(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		if($this->uri->segment(3)=='Ajax'){
			//pre(post("nombre_legal"));return;	
			$response	=	$this->Reportes->Add_FacturaAjax(post());
			echo $this->load->view('Template/Reportes/Ajax_Add_Factura',array(),TRUE);	
			return;
		}
		if(post()){
			$set		=	$this->Reportes->setAddDiario(post());
			if($set){	
				echo '<script>parent.location.reload();</script>';
			}else{
				echo '<script>alert("Error");</script>';
			}
			return;		
		}
		$this->listar->view				=		"Reportes/Form_Add_Factura";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		FormAjax($this->listar->view); 	
	}

	public function Add_Presupuesto(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		if($this->uri->segment(3)=='Ajax'){
			//pre(post("nombre_legal"));return;	
			$response	=	$this->Reportes->Add_FacturaAjax(post());
			echo $this->load->view('Template/Reportes/Ajax_Add_Presupuesto',array(),TRUE);	
			return;
		}
		if(post()){
			$set		=	$this->Reportes->setPresupuesto(post());
			if($set){	
				echo '<script>parent.location.reload();</script>';
			}else{
				echo '<script>alert("Error");</script>';
			}
			return;		
		}
		$this->listar->view				=		"Reportes/Form_Add_presupuesto";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		FormAjax($this->listar->view); 	
	}
	
	public function Add_Factura2(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		if($this->uri->segment(3)=='Ajax'){
			//pre(post("nombre_legal"));return;	
			$response	=	$this->Reportes->Add_FacturaAjax(post());
			echo $this->load->view('Template/Reportes/Ajax_Add_Factura',array(),TRUE);	
			return;
		}
		if(post()){
			$set		=	$this->Reportes->setAddDiario(post());
			return;
			if($set){	
				echo '<script>parent.location.reload();</script>';
			}else{
				echo '<script>alert("Error");</script>';
			}
			return;		
		}
		$this->listar->view				=		"Reportes/Form_Add_Factura2";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		FormAjax($this->listar->view); 	
	}
	
	public function Add_Diario(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(post()){
			$set	=	$this->Reportes->setAddDiario(post());
			if($set){
			$this->session->set_flashdata('success', 'Felicitaciones, Su reporte ha sido guardado. '.$set);	
				echo '<script>parent.location.reload();</script>';
			}else{
				echo '<script>alert("Error");</script>';
			}
			return;		
		}
		$this->Reportes->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Reportes->search			=		post("search");
		$this->load->model("Usuarios/Usuarios_model");
		$this->Usuarios					= 		new Usuarios_model();
		$this->Usuarios->getNicknames($this->user->user_id,true,1);
		$this->listar->view				=		"Reportes/List_getNicknames";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Reportes->total_rows);
		FormAjax($this->listar->view); 	
	}
	
	public function Add_Novedad(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		if(post()){
			$set	=	$this->Reportes->setNovedad(post());
			if($set){
			$Response 				=			array(	"message"	=>	"",
														"callback"	=>	"reloader_iframe()");
			}else{
			$Response 				=			array(	"message"	=>	"Error, no se puedo registrar pagos.",
														"code"		=>	"203");
			}
			echo json_encode($Response);
			return;		
		}
		$this->Reportes->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Reportes->search			=		post("search");
		$this->load->model("Usuarios/Usuarios_model");
		$this->Usuarios					= 		new Usuarios_model();
		$this->Usuarios->getNicknames($this->user->user_id,true);
		$this->listar->view				=		"Reportes/Form_Novedad";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Reportes->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		FormAjax($this->listar->view); 	
	}
	
	public function ResultadoImportDeleteItem(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$set	=	$this->Reportes->setResultadoImportDeleteItem();
		if($set){	
			redirect(base_url("Reportes/ResultadoImport"));	
		}else{
			echo '<script>alert("Error");</script>';
			redirect(base_url("Reportes/ResultadoImport"));
		}
		return;		
	}
	
	public function ResultadoImportDeleteNickName(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$set	=	$this->Reportes->setResultadoImportDeleteNickName();
		if($set){	
			redirect(base_url("Reportes/ResultadoImport"));	
		}else{
			echo '<script>alert("Error");</script>';
			redirect(base_url("Reportes/ResultadoImport"));
		}
		return;		
	}
	
	public function Observaciones(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		if(!isset($this->user)){
			$this->Response 		=			array(	"code"			=>	"203",
														"message"		=>	"No estás autorizado para estar aquí.");
		}else{
			$set		=	$this->Reportes->setObservaciones(post());	
			if(!isset($set['error'])){
				$this->Response 		=			array(	"code"		=>	"200",
															"message"		=>	"Grabado correctamente");
			}else{
				$this->Response 		=			$set['error'];
			}
		}
		echo answers_json($this->Response);		
	}
	
	public function SetPeriodo(){
		detect_Sucursal($this->user);
		$tabla	=	DB_PREFIJO."cf_ciclos_pagos";
		$rows	=	$this->db->select("*,DATE_FORMAT(fecha_desde,'%d') as desde,DATE_FORMAT(fecha_hasta,'%d') as hasta")->from($tabla)->where("ciclos_id",post("ciclos_id"))->get()->row();
		
		$this->session->set_userdata(array('CicloDePago'=>array("ciclos_id"=>post("ciclos_id"),"objeto"=>$rows)));	
		$Response 				=			array(	"message"	=>	"",
													"callback"	=>	"reloader_iframe()");
		
		echo json_encode($Response);
	}
	
}

?>