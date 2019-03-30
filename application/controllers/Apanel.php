<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Apanel extends CI_Controller {
	
  var $util,$user,$ModuloActivo,$path,$listar,$Profesiones,$Breadcrumb,$Uri_Last,$Listado;
  	
	public function __construct(){    	
        parent::__construct();
		if(!defined('APANEL')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}

		$this->util 		= 	new Util_model();
		$this->Breadcrumb 	=	$this->uri->segment_array();
		$this->Uri_Last		=	$this->uri->segment($this->uri->total_rsegments());
		$this->user			=	$this->session->userdata('User');
		$this->ModuloActivo	=	'Apanel';
		$this->Path			=	PATH_VIEW.'/Template/'.$this->ModuloActivo;
		$this->listar		=	new stdClass();	

		if(empty($this->user)){
			redirect(base_url("Main"));	return;
		}		

		if(defined('APANEL_PROFESIONES')){
			$this->load->model("Profesiones/Profesiones_model");
			$this->Profesiones	= 	new Profesiones_model();
		}

		chequea_session($this->user);
    }
	
	public function index(){
		$this->util->set_title("Apanel - ".SEO_TITLE); 	
		$this->load->view('Template/Header');
		$this->load->view('Template/Flash');
		if(file_exists($this->Path.'/Menu.php')){
			$this->load->view('Template/Apanel/Menu');			
		}
		/* if(defined('APANEL_REPORTES')){
			$this->load->model("Reportes/Reportes_model");
			$this->Reportes				= 	new Reportes_model();
			$this->load->model("Usuarios/Usuarios_model");
			$this->Usuarios	= 	new Usuarios_model();
			$descuentos = $this->Usuarios->get_usuarios_descuentos(false,true);
			$item = new stdClass;
			$array_descuentos = array();
			foreach($descuentos as $k => $v){
				$item->tipo_documento    = $v->tipo_documento;
                $item->total             = $v->valor;
                $item->fecha             = $v->fecha;
                $item->nombre_cliente    = $v->primer_nombre.' '.@$v->segundo_nombre.' '.$v->primer_apellido.' '.@$segundo_apellido;
                $item->consecutivo       = $v->consecutivo;
                $item->abreviacion       = centrodecostos($v->centro_de_costos)->abreviacion;
                $item->estatus           = $v->estatus;
                $item->modelo_id         = $v->modelo_id;
                $array_descuentos[] = $item;
			}
			$array_me_deben = array_merge($this->Reportes->get_facturas_new()['pendiente'],$array_descuentos);
			$this->Reportes->medeben	=	$array_me_deben;
			$this->Reportes->debo		=	$this->Reportes->get_facturas2(NULL,array(13,8,31),1);	
			$this->load->model("Operaciones/Operaciones_model");
			$this->Operaciones	= 	new Operaciones_model();
			$this->Operaciones->ResumenBancos();
			$this->Operaciones->bancos=$this->Operaciones->ResumenBancos();
		}*/
		$this->load->view('Template/Apanel/Home');
		#$this->load->view('Template/Welcome');
		$this->load->view('Template/Footer');
	}
	
}
?>