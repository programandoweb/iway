<?php

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

		if(!isset($_SERVER['HTTP_REFERER'])){
			redirect(base_url("Main/ErrorUrl"));
			return;
		}			

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
	
	public function ProcesarHonorarios(){
		$set						=	$this->Operaciones->ProcesarHonorarios($this->session->userdata("pagos"));
		if($this->uri->segment(4)=='front'){
			if($set){	
				redirect(base_url("Usuarios/HonorariosModelos"));
			}else{
				echo '<script>alert("Error");</script>';
			}	
			return false;
		}
		if($set){
			header('refresh:1;url="'.base_url("Usuarios/HonorariosModelos#aprobados").'"');	
			echo '<script>parent.location.reload();</script>';
		}else{
			echo '<script>alert("Error");</script>';
		}
		return;	
	}
	
	public function PagarHonorarios(){
		$set						=	$this->Operaciones->PagarHonorarios(post());
		if($set){
			$this->session->set_flashdata("success","El pago ha sido generado");
		}else{
			$this->session->set_flashdata("danger","El pago no pudo ser realizado por favor consulte al administrador del sistema.");
		}
		redirect(post('redirect'));
		return;	
	}
	
	public function Transferir(){
		if(post()){
			$set_Retiro		=	$this->Operaciones->Transferir(post());
			if($this->uri->segment($this->uri->total_segments()) == "Cajas"){
				redirect(base_url("Operaciones/Cajas"));
			}else{
				if($this->uri->segment(3) == "Exterior"){
					redirect(base_url("Operaciones/Bancos/Exterior"));
				}else{
					redirect(base_url("Operaciones/Bancos"));
				}
			}	
			return;		
		}		
	}

	public function AnularComprobanteCaja(){
		$tipo_documento = $this->uri->segment(4);
		$fin = str_replace("-","/",$this->uri->segment(5));
		$redirect = "Operaciones/ComprobanteCaja/".$this->uri->segment(3).'/'.$this->uri->segment(4);
		$anular = cambiar_estado("rp_operaciones",array("tipo_documento"=>$tipo_documento,"consecutivo"=>$this->uri->segment(3)),array("estatus"=>9,"responsable_anular"=>$this->user->user_id));
		if($anular){
			$this->session->set_flashdata("success","La transferencia ha sido anulada");
		}else{
			$this->session->set_flashdata("success","La transferencia no pudo ser anulada por favor contacte al administrador del sistema");
		}
		redirect($redirect."/iframe");
		return;
	}

	public function Anular_operacion_honorarios(){
		$anular = cambiar_estado("rp_operaciones",array("tipo_documento"=>14,"consecutivo"=>$this->uri->segment(4)),array("estatus"=>9,"responsable_anular"=>$this->user->user_id));
		if($anular){
			$this->session->set_flashdata("success","La transferencia ha sido anulada");
		}else{
			$this->session->set_flashdata("success","La transferencia no pudo ser anulada por favor contacte al administrador del sistema");
		}
		redirect("Operaciones/PagosHonorario/".$this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/iframe");
		return;		
	}


	public function Anular_transferencia(){
		if(!empty($this->uri->segment(4))){
			$tipo_documento = $this->uri->segment(4);
			$redirect = "Operaciones/DetallesCajas/";
		}else{
			$tipo_documento = 11;
			$redirect = "Operaciones/Transferencia/";
		}
		$anular = cambiar_estado("rp_operaciones",array("tipo_documento"=>$tipo_documento,"consecutivo"=>$this->uri->segment(3)),array("estatus"=>9,"responsable_anular"=>$this->user->user_id));
		if($anular){
			$this->session->set_flashdata("success","La transferencia ha sido anulada");
		}else{
			$this->session->set_flashdata("success","La transferencia no pudo ser anulada por favor contacte al administrador del sistema");
		}
		redirect($redirect.$this->uri->segment($this->uri->total_segments())."/iframe");
		return;
	}

	public function Transferencia(){
		if(!defined('APANEL_OPERACIONES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Operaciones->get_transferencia();
		if($this->uri->segment(5) == "PDF"){
			$empresa			=	centrodecostos($this->user->id_empresa);
			ob_start();
			$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
			$html				.=	$this->load->view('Template/PDF/Transferencia',array('empresa'=>$empresa),TRUE);	
			$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
			echo $html;
			$salida 			= 	ob_get_clean();
			//echo $salida; return;
			CertificadoLaboral_pdf($salida);
			return;
		}
 		$this->listar->view="Operaciones/List_transferencia_interbancaria";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
		FormAjax($this->listar->view);
	}

	public function transferencia_nacionales(){
		if(!defined('APANEL_OPERACIONES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(is_numeric($this->uri->segment(4))){
			$this->Operaciones->result  = pago_gasto($this->uri->segment(3),array("Activo","Pasivo"),$this->uri->segment(4),$this->uri->segment(5)); 
		}else{
			$this->Operaciones->result  = pago_gasto($this->uri->segment(3),array("Activo","Pasivo"));
		}
		if($this->uri->segment($this->uri->total_segments()) == "PDF"){
			$empresa			=	centrodecostos($this->user->id_empresa);
			ob_start();
			$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
			$html				.=	$this->load->view('Template/PDF/Transferencia_nacionales',array('empresa'=>$empresa),TRUE);	
			$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
			echo $html;
			$salida 			= 	ob_get_clean();
			//echo $salida; return;
			CertificadoLaboral_pdf($salida);
			return;
		}
 		$this->listar->view="Operaciones/List_transferencia_bancos_nacionales";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
		FormAjax($this->listar->view);
	}

	public function PagosHonorario(){
		if(!defined('APANEL_OPERACIONES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Operaciones->PagosHonorario(); 
		if($this->uri->segment(7) == "PDF"){
			$empresa			=	centrodecostos($this->user->id_empresa);
			ob_start();
			$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
			$html				.=	$this->load->view('Template/PDF/PagosHonorario',array('empresa'=>$empresa),TRUE);	
			$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
			echo $html;
			$salida 			= 	ob_get_clean();
			//echo $salida; return;
			CertificadoLaboral_pdf($salida);
			return;
		}
 		$this->listar->view="Operaciones/List_pagoHonorarios";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
		FormAjax($this->listar->view);
	}

	public function ComprobanteCaja(){
		if(!defined('APANEL_OPERACIONES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Operaciones->result = comprobante_caja($this->uri->segment(3),$this->uri->segment(4)); 
		if($this->uri->segment(5) == "PDF"){
			$empresa			=	centrodecostos($this->user->id_empresa);
			ob_start();
			$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
			$html				.=	$this->load->view('Template/PDF/ComprobanteCaja',array('empresa'=>$empresa),TRUE);	
			$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
			echo $html;
			$salida 			= 	ob_get_clean();
			//echo $salida; return;
			CertificadoLaboral_pdf($salida);
			return;
		}
 		$this->listar->view="Operaciones/List_ComprobanteCaja";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
		FormAjax($this->listar->view);
	}
	
	public function Retiros(){
		if(!defined('APANEL_OPERACIONES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Operaciones->getRetiro();
 		$this->listar->view="Operaciones/List_Retiros_Trm";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
		listados($this->listar->view);
	}

	public function VerAnulados(){
		if(!defined('APANEL_OPERACIONES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Operaciones->result = VerAnulados();
 		$this->listar->view="Operaciones/List_VerAnulados";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
		listados($this->listar->view);
	}

	public function Cambiarestado(){
		$where = array(	"empresa_id"=>$this->user->id_empresa,
					   	"centro_de_costos"=>$this->user->centro_de_costos,
					   	"consecutivo"=>$this->uri->segment(3),
						"tipo_documento"=>$this->uri->segment(4));
		$set = cambiar_estado("rp_operaciones",$where,array("estatus"=>$this->uri->segment(5),"responsable_anular"=>$this->user->user_id));
		if($set){
			$this->session->set_flashdata("success","El estado de su monetizacion ha cambiado");
		}else{
			$this->session->set_flashdata("danger","El estado de su monetizacion no ha cambiado por favor contacte al administrador de sistema");
		}
			redirect(base_url("Operaciones/RetirosTRMDetallesContable/".$this->uri->segment(3)."/iframe"));
		return;	
	}

	public function Add_Retiro_Trm(){
		if(!defined('APANEL_OPERACIONES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}		
		detect_Sucursal($this->user);
		if(post()){
			$set_Retiro		=	$this->Operaciones->setRetiroTrm(post());
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

	public function Consignar(){
		if(!defined('APANEL_OPERACIONES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		if(post()){
			$set_Consignar		=	$this->Operaciones->setConsignar(post());
			if($set_Consignar){	
				echo '<script>parent.location.reload();</script>';
			}else{
				echo '<script>alert("Error");</script>';
			}
			return;		
		}
		$this->Operaciones->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Operaciones->search			=		post("search");
		$explode							=		explode("-",$this->uri->segment(3));
		$this->listar->view					=		"Operaciones/Form_Consignar";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		FormAjax($this->listar->view); 	
	}
	
	public function Cajas(){
		if(!defined('APANEL_OPERACIONES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		//detect_Sucursal($this->user);
		$this->Operaciones->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Operaciones->search			=		post("search");
		$explode							=		explode("-",$this->uri->segment(3));
		//$this->Operaciones->ResumenCajas();
		$this->listar->view="Operaciones/List_ResumenCajas";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		Listados($this->listar->view); 	
	}
	
	public function Bancos(){
		if(!defined('APANEL_OPERACIONES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		//detect_Sucursal($this->user);
		$this->Operaciones->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Operaciones->search			=		post("search");
		$explode							=		explode("-",$this->uri->segment(3));
	//	$this->Operaciones->ResumenBancos();
		if($this->uri->segment(3) == "Exterior"){
			$this->listar->view="Operaciones/List_ResumenBancosExterior";
		}else{
			$this->listar->view="Operaciones/List_ResumenBancos";	
		}
		
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
	//	paginator($this->Operaciones->total_rows);
		listados($this->listar->view); 	
	}
	
	public function DetallesCajas(){
		if(!defined('APANEL_OPERACIONES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Operaciones->CajasDetalles($this->uri->segment(3));
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
		if($this->uri->segment(5)=='PDF'){
			$empresa			=	centrodecostos($this->user->id_empresa);
			ob_start();
			$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
			$html				.=	$this->load->view('Template/PDF/DetallesCajas',array('empresa'=>$empresa),TRUE);	
			$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
			echo $html;
			$salida 			= 	ob_get_clean();
			//echo $salida; return;
			CertificadoLaboral_pdf($salida);
			return;
		}	
		$this->listar->view="Operaciones/List_CajasDetalles";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Operaciones->total_rows);
		FormAjax($this->listar->view);		
	}

	public function BancosDetallesContable(){
		if(!defined('APANEL_OPERACIONES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Operaciones->BancosDetalles($this->uri->segment(3),$this->uri->segment(4),$this->uri->segment(5),$this->uri->segment(6,array()));
		if($this->uri->segment(8)=='excel'){
			if(post()){
				downloadExcel(post(),"Reporte_".$this->uri->segment(2));
				return;
			}
		}	
		if($this->uri->segment(8)=='mail'){
			if(post()){
				html_export_excel(post(),"Reporte_".$this->uri->segment(2));
				return;
			}
		}
		if($this->uri->segment(8)=='PDF'){
				$empresa			=	centrodecostos($this->user->id_empresa);
				ob_start();
				$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
				$html				.=	$this->load->view('Template/PDF/BancosDetallesContable',array("empresa"=>$empresa),TRUE);	
				$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
				echo $html;
				$salida 			= 	ob_get_clean();
				//echo $salida; return;
				CertificadoLaboral_pdf($salida);
				return;
			}
		$this->listar->view="Operaciones/List_BancosDetalles";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Operaciones->total_rows);
		FormAjax($this->listar->view);		
	}
	
	public function RetirosTRMDetalles(){
		if(!defined('APANEL_OPERACIONES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Operaciones->RetirosTRMDetalles($this->uri->segment(3));
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
				$html				.=	$this->load->view('Template/PDF/RetirosTRMDetalles',array("empresa"=>$empresa),TRUE);	
				$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
				echo $html;
				$salida 			= 	ob_get_clean();
				//echo $salida; return;
				CertificadoLaboral_pdf($salida);
				return;
			}
		$this->listar->view="Operaciones/RetirosTRMDetalles";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Operaciones->total_rows);
		FormAjax($this->listar->view);
	}
	
	public function RetirosTRMDetallesContable(){
		if(!defined('APANEL_OPERACIONES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		detect_Sucursal($this->user);
		$this->Operaciones->RetirosTRMDetallesContable($this->uri->segment(3));
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
		if($this->uri->segment(4)=='PDF'){
			$empresa			=	centrodecostos($this->user->id_empresa);
			ob_start();
			$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
			$html				.=	$this->load->view('Template/PDF/RetirosTRMDetallesContable',array("empresa"=>$empresa),TRUE);	
			$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
			echo $html;
			$salida 			= 	ob_get_clean();
			//echo $salida; return;
			CertificadoLaboral_pdf($salida);
			return;
		}
		$this->listar->view="Operaciones/RetirosTRMDetallesContable";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		paginator($this->Operaciones->total_rows);
		FormAjax($this->listar->view);
	}

	 public function Orden(){
		if(!isset($_SERVER['HTTP_REFERER'])){
			redirect(base_url("Main/ErrorUrl"));
			return;
			}
			
			if ($this->uri->segment(3)=='atencion'){
				$this->listar->view="Operaciones/List_ResumenOrden";
			}else if ($this->uri->segment(3)=='compra'){
				$this->listar->view="Operaciones/List_ResumenOrdenCompra";
			}	
	    $this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			Listados($this->listar->view);	
	
		}
		
		public function Devoluciones(){
			if(!isset($_SERVER['HTTP_REFERER'])){
				redirect(base_url("Main/ErrorUrl"));
				return;
				}
			 	if ($this->uri->segment(3)=='compras'){
					$this->listar->view="Operaciones/List_ResumenDevolucionesCompras";
				 }else{
					$this->listar->view="Operaciones/List_ResumenDevoluciones";
				 }
			
				$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
				Listados($this->listar->view);	
		
			}

			public function Remisiones(){
				if(!isset($_SERVER['HTTP_REFERER'])){
					redirect(base_url("Main/ErrorUrl"));
					return;
					}
					
					$this->listar->view="Operaciones/List_ResumenRemisiones";
					$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
					Listados($this->listar->view);	
			
				}

				public function Pedidos(){
					if(!isset($_SERVER['HTTP_REFERER'])){
						redirect(base_url("Main/ErrorUrl"));
						return;
						}
						$this->listar->view="Operaciones/List_ResumenPedidos";
						$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
						Listados($this->listar->view);	
				
				}

				public function Ventas(){
					if(!isset($_SERVER['HTTP_REFERER'])){
						redirect(base_url("Main/ErrorUrl"));
						return;
						}
						$this->listar->view="Operaciones/List_ResumenVentas";
						$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
						Listados($this->listar->view);	
				
				}

				public function Gastos(){
					if(!isset($_SERVER['HTTP_REFERER'])){
						redirect(base_url("Main/ErrorUrl"));
						return;
						}
						$this->listar->view="Operaciones/List_ResumenGastosVarios";
						$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
						Listados($this->listar->view);	
				}

				public function Iva(){
					if(!isset($_SERVER['HTTP_REFERER'])){
						redirect(base_url("Main/ErrorUrl"));
						return;
						}
						$this->listar->view="Operaciones/List_ResumenIva";
						$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
						Listados($this->listar->view);
				}

				public function Declaracion(){
					if(!isset($_SERVER['HTTP_REFERER'])){
						redirect(base_url("Main/ErrorUrl"));
						return;
						}
						$this->listar->view="Operaciones/List_ResumenDeclaracionRen";
						$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
						Listados($this->listar->view);
				}

				public function Impuesto(){
					if(!isset($_SERVER['HTTP_REFERER'])){
						redirect(base_url("Main/ErrorUrl"));
						return;
						}
						$this->listar->view="Operaciones/List_ResumenImpuestoCree";
						$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
						Listados($this->listar->view);
				}

				public function Industria(){
					if(!isset($_SERVER['HTTP_REFERER'])){
						redirect(base_url("Main/ErrorUrl"));
						return;
						}
						$this->listar->view="Operaciones/List_ResumenIndustria";
						$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
						Listados($this->listar->view);  
				}

				public function Ajuste(){
					if(!isset($_SERVER['HTTP_REFERER'])){
						redirect(base_url("Main/ErrorUrl"));
						return;
						}
						$this->listar->view="Operaciones/List_ResumenAjuste";
						$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
						Listados($this->listar->view);  
				}

				public function proviciones(){
					if(!isset($_SERVER['HTTP_REFERER'])){
						redirect(base_url("Main/ErrorUrl"));
						return;
						}
						$this->listar->view="Operaciones/List_ResumenProviciones";
						$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
						Listados($this->listar->view);  
				}
}
?>