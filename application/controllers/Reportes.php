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

		if($this->uri->segment(2) != "EstadoResultados"){
			if(!isset($_SERVER['HTTP_REFERER'])){
				redirect(base_url("Main/ErrorUrl"));
				return;
			}
		}
		
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
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 
	}

	public function CumplimientosMonitores(){
		
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->load->model("Usuarios/Usuarios_model");
		$this->Usuarios	= 	new Usuarios_model();
		detect_Sucursal($this->user);
		$this->Usuarios->get_all_x_type(array("Monitores"));
		$this->listar->view="Reportes/ReporteMonitores";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view); 
		return;
	}

	public function consultarEstadoResultados(){
		$response = $this->Reportes->consultarEstadoResultados(post('calculo_desde'),post('cantidad_a_mostrar'));
	}

	public function consultarEstadoResultados2(){
		$response = $this->Reportes->consultarEstadoResultados2(post('calculo_desde'),post('cantidad_a_mostrar'));
	}

	public function EstadoResultados(){
		
		if(!defined('APANEL_USUARIOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->listar->view="Reportes/EstadoResultados";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view); 
		return;
	}

	public function detalleReporteMonitor(){
		$this->Reportes->result = get_reporteModelos_x_Monitor($this->uri->segment(3),$this->uri->segment(4));
		if($this->uri->segment($this->uri->total_segments()) == "PDF"){
			ob_start();
			$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
			$html				.=	$this->load->view('Template/PDF/ReporteMonitor',"",TRUE);	
			$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
			echo $html;
			$salida 			= 	ob_get_clean();
			//echo $salida;return;
			CertificadoLaboral_pdf($salida);
			return;
		}
		$this->listar->view="Reportes/detalleReporteMonitor";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		FormAjax($this->listar->view); 
		return;
	}

	public function Formato(){
		descargarArchivo("Formato_archivo_plano.xlsx","images/dowloads/");
		redirect(base_url("Reportes/InformePlano"));
		return;	
	}

	public function Transferencia(){
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
		$this->listar->view				=		"Reportes/List_DetalleTransferencia";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		FormAjax($this->listar->view);	
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

	public function CumplimientosMetas(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Reportes->CumplimientosMetas();
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
		$this->listar->view				=		"Reportes/List_CumplimientoMetas";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view);  
	}
	
	public function Nominas(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		//detect_Sucursal($this->user);
		if(post()){
			if($this->uri->segment($this->uri->total_segments())=='excel'){
					downloadExcel(post(),"Reporte ".$this->uri->segment(2));
					return;
			}	
			if($this->uri->segment($this->uri->total_segments())=='mail'){
					html_export_excel(post(),"Reporte ".$this->uri->segment(2));
					return;
			}
			$set		=	$this->Reportes->setPresupuesto(post());	
			if(!isset($set['error'])){
				$this->Response 		=			array(	"code"		=>	"200");
			}else{
				$this->Response 		=			$set['error'];
			}
			echo answers_json($this->Response);	return;					
		}
		
	//	$this->Reportes->pagination		=		$this->uri->segment($this->uri->total_segments());
	//	$this->Reportes->search			=		post("search");
		$explode	=	explode("-",$this->uri->segment(2));
	//	$this->Reportes->regPres(array('Modelos'));
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
		
	//	$this->load->model("Usuarios/Usuarios_model");
		//$this->Usuarios		= 	new Usuarios_model();
		//$this->Usuarios->CalcularHonorarios("Usuarios",array("Asociados"));				
		$this->listar->view	=	"Reportes/List_Presupuesto";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 
	}
	
	public function TRMHistorico(){
		detect_Sucursal($this->user);
		$this->Reportes->GetTRMHistorico();
		if($this->uri->segment(3)=='PDF'){
			//$row				=	$this->Reportes->get_facturas($this->uri->segment(3));
			//$user				=	centrodecostos($row->centro_de_costos);
			$empresa			=	centrodecostos($this->user->id_empresa);
			ob_start();
			$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
			$html				.=	$this->load->view('Template/PDF/TRMHistorico',array('empresa'=>$empresa),TRUE);	
			$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
			echo $html;
			$salida 			= 	ob_get_clean();
			//echo $salida;return;
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
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados("Reportes/List_TRMHistorico"); 
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
		if($this->uri->segment($this->uri->total_segments())=='excel'){
			if(post()){
				downloadExcel(post(),"Reporte ".$this->uri->segment(2));
				return;
			}
		}	
		if($this->uri->segment($this->uri->total_segments())=='mail'){
			if(post()){
				html_export_excel(post(),"Reporte ".$this->uri->segment(2));
				return;
			}
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
		$this->Reportes->get_facturas2($this->uri->segment(3,0),8);	
		$this->Reportes->result['registro_contable']	=	$this->Reportes->get_contable($this->uri->segment(3),array(),array("8"));
		if($this->uri->segment(4)=='PDF' || $this->uri->segment($this->uri->total_segments())=='mail'){
				$empresa			=	centrodecostos($this->user->id_empresa);
				ob_start();
				$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
				$html				.=	$this->load->view('Template/PDF/VerDetalleGasto2',array('empresa'=>$empresa),TRUE);	
				$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
				echo $html;
				$salida 			= 	ob_get_clean();
				if($this->uri->segment($this->uri->total_segments())=='mail'){
					$pdf = pdf_A5($salida,array(0,0,608,530),true);
					$htmlfile = tempnam(sys_get_temp_dir(), 'pdf'); 
					file_put_contents($htmlfile,$pdf);
					$email = array("recipient"=>post('email'),"subject"=>"Buenas tardes, te hacemos envio del documento que nos has solicitado Reporte gasto","adjunto"=>$htmlfile,"body"=>$this->load->view('Template/Emails/excel',array(),TRUE));
					send_mail($email);
					return;	
				}
				//echo $salida;return;
				CertificadoLaboral_pdf($salida);
				return;
		}
		if($this->uri->segment($this->uri->total_segments())=='excel'){
			if(post()){
				downloadExcel(post(),"Reporte_".$this->uri->segment(2));
				return;
			}
		}	
		/*if($this->uri->segment($this->uri->total_segments())=='mail'){
			if(post()){
				pre(post('email')); return;
				$email = array("recipient"=>post('email'),"subject"=>"Buenas tardes, te hacemos envio del documento que nos has solicitado ".$filename,"adjunto"=>pdf_A5($salida,array(0,0,608,530)),"body"=>$ci->load->view('Template/Emails/excel',array(),TRUE));
				send_mail(array(
										"recipient"=>$pdf["email"],
										"subject"=>"Buenas tardes, te hacemos envio del documento que nos has solicitado ".$filename,
										"adjunto"=>$excelFile,
										"body"=>$ci->load->view('Template/Emails/excel',array(),TRUE),
										));	
				//html_export_excel(array("adjunto"=>pdf_A5($salida,array(0,0,608,530)),post()),"Reporte_".$this->uri->segment(2));
				return;
			}
		}*/
		if($this->uri->segment($this->uri->total_segments()) == "Pagar"){
			if(post()){
				$anular = $this->Reportes->PagarGasto(post());
				if($anular){
					$this->session->set_flashdata('success', 'El gasto ha sido  Pagado');
				}else{
					$this->session->set_flashdata('danger', 'Lo sentimos, el gasto no ha sido anulado, por favor contacte al administrador del sistema');	
				}
				redirect(base_url("Reportes/VerDetalleGasto/".$this->uri->segment(3)));
				return;
			}
			$this->listar->view				=		"Reportes/Form_PagarGasto";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			FormAjax($this->listar->view);
			return;			
		}			
		$this->listar->view				=		"Reportes/List_VerDetalleGasto";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		FormAjax($this->listar->view); 
	}
	
	
	public function VerDetalleGasto2(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Reportes->get_facturas2($this->uri->segment(3,0),31);	
		$this->Reportes->result['registro_contable']	=	$this->Reportes->get_contable($this->uri->segment(3),array(),array("8"));
		if($this->uri->segment(5)=='PDF' || $this->uri->segment($this->uri->total_segments())=='mail'){
				$empresa			=	centrodecostos($this->user->id_empresa);
				ob_start();
				$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
				if($this->uri->segment($this->uri->total_segments()) == "OtrosIngresos"){
					$html				.=	$this->load->view('Template/PDF/OtrosIngresos',array('empresa'=>$empresa),TRUE);					
				}else{
					$html				.=	$this->load->view('Template/PDF/VerDetalleGasto',array('empresa'=>$empresa),TRUE);
				}	
				$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
				echo $html;
				$salida 			= 	ob_get_clean();
				//echo $salida; return;
				if($this->uri->segment($this->uri->total_segments())=='mail'){
					$pdf = pdf_A5($salida,array(0,0,608,530),true);
					$htmlfile = tempnam(sys_get_temp_dir(), 'pdf'); 
					file_put_contents($htmlfile,$pdf);
					$email = array("recipient"=>post('email'),"subject"=>"Buenas tardes, te hacemos envio del documento que nos has solicitado Reporte gasto","adjunto"=>$htmlfile,"body"=>$this->load->view('Template/Emails/excel',array(),TRUE));
					send_mail($email);
					return;	
				}
				//echo $salida;return;
				CertificadoLaboral_pdf($salida);
				return;
		}
		if($this->uri->segment($this->uri->total_segments())=='excel'){
			if(post()){
				downloadExcel(post(),"Reporte_".$this->uri->segment(2));
				return;
			}
		}	
		/*if($this->uri->segment($this->uri->total_segments())=='mail'){
			if(post()){
				pre(post('email')); return;
				$email = array("recipient"=>post('email'),"subject"=>"Buenas tardes, te hacemos envio del documento que nos has solicitado ".$filename,"adjunto"=>pdf_A5($salida,array(0,0,608,530)),"body"=>$ci->load->view('Template/Emails/excel',array(),TRUE));
				send_mail(array(
										"recipient"=>$pdf["email"],
										"subject"=>"Buenas tardes, te hacemos envio del documento que nos has solicitado ".$filename,
										"adjunto"=>$excelFile,
										"body"=>$ci->load->view('Template/Emails/excel',array(),TRUE),
										));	
				//html_export_excel(array("adjunto"=>pdf_A5($salida,array(0,0,608,530)),post()),"Reporte_".$this->uri->segment(2));
				return;
			}
		}*/		
		$this->listar->view				=		"Reportes/List_VerDetalleGasto2";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		FormAjax($this->listar->view); 
	}
	
	public function FacturaComprar(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Reportes->result = get_Operacion(array("6","8"),array("Gastos"),array("1","2","3","4","5","6","7","8"));		
		$this->listar->view				=		"Reportes/List_FacturaComprar";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
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
		if($this->uri->segment(3)=='excel'){
			if(post()){
				downloadExcel(post(),"Reporte_".$this->uri->segment(2));
				return;
			}
		}	
		if($this->uri->segment(3)=='mail'){
			if(post()){
				html_export_excel(post(),"Reporte_".$this->uri->segment(2));
				return;
			}
		}
		$this->Reportes->RP_Modelos();
				if($this->uri->segment(3)=='PDF'){
				$empresa			=	centrodecostos($this->user->id_empresa);
				ob_start();
				$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
				$html				.=	$this->load->view('Template/PDF/PorModelos',array('empresa'=>$empresa),TRUE);	
				$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
				echo $html;
				$salida 			= 	ob_get_clean();
				CertificadoLaboral_pdf($salida);
				return;
		}	
		$this->listar->view				=		"Reportes/List_PorModelos";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view);
	}
	
	public function PorModelosDetalle(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Reportes->RP_Modelos($this->uri->segment(3),$this->uri->segment(4),$this->uri->segment(5));
		$this->listar->view				=		"Reportes/List_PorModelosQ";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		formAjax($this->listar->view);
	}
	
	public function PorPeriodos(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Reportes->RP_Plataformas();	
		if($this->uri->segment(3)=='PDF'){
				$empresa			=	centrodecostos($this->user->id_empresa);
				ob_start();
				$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
				$html				.=	$this->load->view('Template/PDF/PorPaginas',array('empresa'=>$empresa),TRUE);	
				$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
				echo $html;
				$salida 			= 	ob_get_clean();
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
		$this->listar->view				=		"Reportes/List_PorPeriodos";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
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
				$empresa			=	centrodecostos($this->user->id_empresa);
				ob_start();
				$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
				$html				.=	$this->load->view('Template/PDF/PorPaginas',array('empresa'=>$empresa),TRUE);	
				$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
				echo $html;
				$salida 			= 	ob_get_clean();
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
		$this->listar->view				=		"Reportes/List_PorPlataformas";
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
				//$row				=	$this->Reportes->get_facturas($this->uri->segment(3));
				//$user				=	centrodecostos($row->centro_de_costos);
				$empresa			=	centrodecostos($this->user->id_empresa);
				ob_start();
				$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
				$html				.=	$this->load->view('Template/PDF/UsuariosXMaster',array("empresa"=>$empresa),TRUE);	
				$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
				echo $html;
				$salida 			= 	ob_get_clean();
				//echo $salida;return;
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
		if($this->uri->segment(4) && $this->uri->segment(4) != "iframe"){
			if(post() && !$this->uri->segment(4)){
				$set	=	$this->Reportes->set_cuenta_contable(post());
				if($set){	
					echo '<script>parent.location.reload();</script>';
				}else{
					echo '<script>alert("Error");</script>';
				}
				return;
			}
			if($this->uri->segment($this->uri->total_segments())=='excel'){
				if(post()){
					downloadExcel(post(),"Reporte_".$this->uri->segment(2).'_'.post("filename").".xlsx");
					return;
				}
			}	
			if($this->uri->segment($this->uri->total_segments())=='mail'){
				if(post()){
					html_export_excel(post(),"Reporte_".$this->uri->segment(2));
					return;
				}
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
				if(estatus(array("estatus"=>9,"responsable_anular"=>$this->user->user_id),'rp_operaciones','',$this->uri->segment(3))){
					redirect(base_url("Reportes/VerFactura/".$this->uri->segment(3)."/sinmarco"));
				}else{
					
				}
				//redirect(base_url("Reportes/FacturaVentas"));	
				return;
			}else if($this->uri->segment(4)=='anulargasto'){	
				if(estatus(array("estatus"=>9,"responsable_anular"=>$this->user->user_id),'rp_operaciones','',$this->uri->segment(3),8)){
					$this->session->set_flashdata('success', 'El gasto ha sido  anulado');	
				}else{
					$this->session->set_flashdata('success', 'El gasto ha sido no ha sido anulado, por favor contacte al administrador de sistemas');
				}
				echo '<script>parent.location.reload();</script>';	return;
			}else if($this->uri->segment(4)=='anular_detalle_contable'){
				$this->Reportes->anular_detalle_contable($this->uri->segment(3));
				echo '<script>window.history.back();</script>';
				//redirect(base_url("Reportes/VerFactura/".$this->uri->segment(5)."/sinmarco#relacionpagos"));
				return false; 
			}else if($this->uri->segment(4)=='detalle_contable'){
				$this->Reportes->factura						=	$this->Reportes->get_facturas($this->uri->segment(5));
				$this->Reportes->result['detalle_ingreso']		=	$this->Reportes->get_detalle_contable($this->uri->segment(3),array("111010"),array("5"));
				$this->Reportes->result['registro_contable']	=	$this->Reportes->get_contable($this->uri->segment(3),array("130510","111010"),array("5"));
				$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
				if($this->uri->segment($this->uri->total_segments())=='mail'){
					if(post()){
						html_export_excel(post(),"Reporte ".$this->uri->segment(2));
						return;
					}
				 	$empresa			=	centrodecostos($this->user->id_empresa);
					$html				=	$this->load->view('Template/PDF/HeaderExcel',array(),TRUE);
					$html				.=	$this->load->view('Template/PDF/detalle_contable',array("empresa"=>$empresa),TRUE);	
					$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
					echo $html;
					//html_export_excel($html,"Reporte_Por_Modelos");
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
				if($this->uri->segment($this->uri->total_segments())=='PDF'){
					$empresa			=	centrodecostos($this->user->id_empresa);
					ob_start();
					$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
					$html				.=	$this->load->view('Template/PDF/detalle_contable',array("empresa"=>$empresa),TRUE);	
					$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
					echo $html;
					$salida 			= 	ob_get_clean();
					//echo $salida; return;
					CertificadoLaboral_pdf($salida);
					return;
				}	
				FormAjax("Reportes/Form_detalle_contable");				
			}else{
				if(post()){
					$set	=	$this->Reportes->set_RecibirFactura(post());
					if($set){
						redirect(post("redirect"));
						/*echo '<script>parent.location.reload();</script>';*/
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
		if($this->uri->segment(4) == 'iframe'){
			FormAjax($this->listar->view);
		}else{
			listados($this->listar->view);
		} 	
	}
	
	public function ResultadoImport(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		if($this->uri->segment(3)=='Clear'){
			$this->db->truncate(DB_PREFIJO."rp_honorarios_modelos");
			$this->db->truncate(DB_PREFIJO."rp_descuentos");
			$this->db->truncate(DB_PREFIJO."rp_otros_ingresos");
			$this->db->truncate(DB_PREFIJO."rp_dias_trabajados");
			$this->db->truncate(DB_PREFIJO."rp_operaciones");
			$this->db->truncate(DB_PREFIJO."rp_operaciones_json");
			$this->db->truncate(DB_PREFIJO."rp_tmp");
			$this->db->truncate(DB_PREFIJO."sys_consecutivo");
			$this->db->truncate(DB_PREFIJO."sys_logs");
			$this->db->truncate(DB_PREFIJO."rp_retiroTRM");
			$this->db->truncate(DB_PREFIJO."sys_observaciones");
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
		$this->load->model("Operaciones/Operaciones_model");
		$this->Operaciones				= 	new Operaciones_model();
		$this->Reportes->TRM_Promedio	=	TRM_Promedio($this->Operaciones->getRetiro());
		$possible_id					=	$this->uri->segment($this->uri->total_segments());
		$this->listar->view				=	"Reportes/Form_Upload"; 
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
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
	
	public function MakeFactura3(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$set	=	$this->Reportes->MakeFactura3(post());
		if($set){
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
		/*if(date("d")<15){
			$this->Reportes->get_diario(date("Y-m-01"),date("Y-m-15"));		
		}else{
			$this->Reportes->get_diario(date("Y-m-16"),date("Y-m-31"));		
		}*/
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
		if($this->uri->segment(3)){
			if($this->uri->segment(4)=='PDF'){
				$empresa			=	centrodecostos($this->user->id_empresa);
				ob_start();
				$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
				$html				.=	$this->load->view('Template/PDF/Novedades',array('empresa'=>$empresa),TRUE);	
				$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
				echo $html;
				$salida 			= 	ob_get_clean();
				//echo $salida;return;
				pdf_A5($salida,array(0,0,608,530));
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
			$this->listar->view				=		"Reportes/Detalle_Novedad";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
			FormAjax($this->listar->view);
			return;
		}		
		$this->listar->view				=		"Reportes/List_Novedades";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Reportes->total_rows);
		$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
		listados($this->listar->view); 	
	}

	public function download(){
		descargarArchivo($this->uri->segment($this->uri->total_segments()));
		return;
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
		$this->listar->view				=		"Reportes/List_DiasTrabajados";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view); 	
	}
	
	public function Quincenales(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(post()){
			$set	=	$this->Reportes->setQuincenales(post());
			if($set){	
				echo '<script>parent.location.reload();</script>';
			}else{
				echo '<script>alert("Error");</script>';
			}
			return;
		}
		
		detect_Sucursal($this->user);
		$this->Reportes->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Reportes->search			=		post("search");
		$this->Reportes->get_quicena();	
		$this->listar->view				=		"Reportes/List_ReportesQ";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
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
		$this->Reportes->get_diario($this->uri->segment(3),$this->uri->segment(4),$this->uri->segment(5));
		if($this->uri->segment($this->uri->total_segments()) == "PDF"){
			$centrodecostos 	=   centrodecostos($this->user->centro_de_costos);
			$empresa			=	centrodecostos($this->user->id_empresa);
			ob_start();
			$html				=	$this->load->view('Template/PDF/Header',array(),TRUE); 
			$html				.=	$this->load->view('Template/PDF/EnvioReporteDiario',array("empresa"=>$empresa,"centrodecostos"=>$centrodecostos),TRUE);	
			$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
			echo $html;
			$salida 			= 	ob_get_clean();
			//echo $salida;return;
			CertificadoLaboral_pdf($salida);
			//pre($this->user); return;
			//enviar_pdf($salida,$this->user->email,"Envio Informe".date("Y-m-d H:i:s"),$this->load->view('Template/PDF/EnvioReporteDiario',array(),TRUE));	
			return;
		}		
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

	public function AnularReporte(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$response = $this->Reportes->AnularReporte();
		if($response){
			$this->session->set_flashdata('success', 'Su reporte fue anulado');
		}else{
			$this->session->set_flashdata('danger', 'Este reporte no pudo ser anulado, por favor contacte al administrador');
		}
		redirect(base_url("Reportes/Diarios"));
		return;
	}
	
	public function Add_Diario(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(post()){
			$set	=	$this->Reportes->setAddDiario(post());
			if($set != false){
				$this->Reportes->get_diario(date("Y-m-d"),date("Y-m-d"),1);	
				//pre($this->Reportes->result); return;
				$centrodecostos 	= centrodecostos($this->user->centro_de_costos);
				$empresa			=	centrodecostos($this->user->id_empresa);
				ob_start();
				$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
				$html				.=	$this->load->view('Template/PDF/EnvioReporteDiario',array("empresa"=>$empresa,"centrodecostos"=>$centrodecostos),TRUE);	
				$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
				echo $html;
				$salida 			= 	ob_get_clean();
				//echo $salida;return;
				//CertificadoLaboral_pdf($salida);return;

				$response = enviar_pdf($salida,$this->user->email,"Informe Produccion Diario ".date("Y-m-d H:i:s"),$this->load->view('Template/Emails/PlantillaEmails',array($title=>"Reporte diario","message"=>"Hola <b>".$this->user->primer_nombre."</b>, te hemos adjuntado una copia del documento que nos has solicitado, gracias por hacer parte de nuestro equipo de trabajo.
					<p>Para saber mas detalles puedes acceder a tu cuenta dando click a este <a href='".base_url()."'>vinculo.</a></p>"),TRUE),"Informe Produccion Diario ".date('Y-m-d H:i:s').".pdf");
				if($response['error'] == false){
					$this->session->set_flashdata('success', 'Tu reporte fue fue procesado correctamente hemos enviado una copia de tu proceso a tu correo electronico');
				}else{
					$this->session->set_flashdata('danger', 'Tu reporte fue procesado pero'.$response['error']);
				}
	
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
			if($this->input->is_ajax_request()){
				if(!isset($set['error'])){
					$this->Response 		=			array(	"code"		=>	"200",
																"message"		=>	"Grabado correctamente");
				}else{
					$this->Response 		=			$set['error'];
				}
			}else{
				if(!isset($set['error'])){
					if(!empty(post('correos'))){
						if(empty(post('templatePdf'))){
							$segment = explode("/",post('url'));
							$templatePdf = $segment[5];
						}else{
							$templatePdf = post('templatePdf');
						}
						$url = explode("#",post('url'));
						if(get_form_control($url[0].'/configEmail')){
							$configEmail = json_decode(get_form_control($url[0].'/configEmail')[0]->data);
						
						//pre($configEmail); return;
							if($configEmail->enviarPDF == "Si"){
								$this->Reportes->result = get_form_control($templatePdf,$this->uri->segment(3));
								$centrodecostos 	= 	centrodecostos($this->user->centro_de_costos);
								$empresa			=	centrodecostos($this->user->id_empresa);
								ob_start();
								$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
								$html				.=	$this->load->view('Template/PDF/'.$templatePdf,array("empresa"=>$empresa,"centrodecostos"=>$centrodecostos,"url"=>post('url')),TRUE);	
								$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
								echo $html;
								$salida 			= 	ob_get_clean();
							}
							//echo $salida;return;
							//CertificadoLaboral_pdf($salida);return;
							//($salida,$template = "PlantillaEmails",$correo = null,$message = "Bienvenido Gracias por hacer parte de nuestro equipo de trabajo",$title = "Envio Email",$adjunto = false) 		
							preparar_pdf($salida,'/'.$templatePdf,"PlantillaEmails",$configEmail->email_especifico,$configEmail->Asunto,$configEmail->message,$configEmail->Asunto,$configEmail->namePdf);

							return;
						}
					}
					$this->session->set_flashdata('success', 'La observación ha sido guardada correctamente. ');
				}else{
					$this->session->set_flashdata('danger', 'Lo sentimos, '.$set['error'].'.');	
				}
				redirect(post("url"));	
				return;
			}
		}
		echo answers_json($this->Response);	
		return;	
	}
	
	public function SetPeriodo(){
		detect_Sucursal($this->user);
		$tabla	=	DB_PREFIJO."cf_ciclos_pagos";
		$rows	=	$this->db->select("*,DATE_FORMAT(fecha_desde,'%d') as desde,DATE_FORMAT(fecha_hasta,'%d') as hasta")->from($tabla)->where("ciclos_id",post("ciclos_id"))->get()->row();
		$rows = "HOla a todos";
		$this->session->set_userdata(array('CicloDePago'=>array("ciclos_id"=>post("ciclos_id"),"objeto"=>$rows)));	
		$Response 				=			array(	"message"	=>	"",
													"callback"	=>	"reloader_iframe()");
		
		echo json_encode($Response);
	}
	
	public function DeleteItemImport(){
		$tabla				=		DB_PREFIJO."rp_tmp";
		$this->db->where('centro_de_costos', $this->uri->segment(3));
		$this->db->delete($tabla);	
		redirect(base_url("Reportes/ResultadoImport/Debug/4"));
	}

	public function FacturaCompras(){
		if(!defined('APANEL_REPORTES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		//detect_Sucursal($this->user);
		//$this->Reportes->get_facturas_new();			
	 	$this->listar->view				=		"Reportes/List_FacturaCompras";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view);	
	}
	
}

?>