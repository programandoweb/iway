<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Formularios_model extends CI_Model {
	
	var $fields,$result,$where,$total_rows,$pagination,$search,$user;

	public function __construct(){    	
        parent::__construct();
		$this->user			=	$this->session->userdata('User');
	}

	public function get_form_control(){
		$this->db->select("*");
		$this->db->from(DB_PREFIJO."ut_form_control t1");
		$this->db->where("empresa_id",$this->user->id_empresa);
		$this->db->where("nombre_form","aspirante");
		if($this->uri->segment(3)){
			$this->db->where("id_form_contrl",$this->uri->segment(3));
		}
		$this->db->where("estado !=",0);
		$query = $this->db->get();
		$this->result		=	$query->result();
		return;
	}

	public function CambiarEstado(){
		$tabla = DB_PREFIJO."ut_form_control";
		$this->db->where("id_form_contrl",$this->uri->segment(4));
		$var["estado"] = $this->uri->segment(3);
		if($this->db->update($tabla,$var)){
			return $var["estado"];	
		}else{
			return false;	
		}
	} 
	
	public function getEntrevistas(){
		$tabla		=		DB_PREFIJO."entrevista t1";
		$this->db->select("t1.*,t2.abreviacion")->from($tabla);
		$this->db->join(DB_PREFIJO."usuarios t2", 't1.centro_de_costos=t2.user_id', 'left');
		if($this->uri->segment(3) && $this->uri->segment(3) != "detalle" ){
			$this->db->where( "entrevista_id",$this->uri->segment(3));
		}
		$this->db->where("empresa_id",$this->user->id_empresa);
		$this->db->where("json_respuestas!=","");
		$query			=	$this->db->get();
		$this->result 	=	$query->result();
	}

	public function Get($id){
		$tabla		=		DB_PREFIJO."entrevista t1";
		$this->db->select("t1.*,t2.abreviacion")->from($tabla);
		$this->db->join(DB_PREFIJO."usuarios t2", 't1.centro_de_costos=t2.user_id', 'left');
		if($id>0){
			$this->db->where("token",$id);
			$query = $this->db->get();
			return $query->row();
		}else{
			$this->db->where("empresa_id",$this->user->id_empresa);
			$query = $this->db->get();
			return $query->result();
		}		
	}

	public function set_form_control($data){
		//pre($_FILES); return;
		//pre($data); return;
		$tabla				=		DB_PREFIJO."ut_form_control";
		if(!empty($data['id_form_contrl'])){
			$consecutivo = $data['consecutivo'];
			$path = "images/uploads/".$this->uri->segment(2)."/".$this->user->centro_de_costos.'/'.$consecutivo;
			eliminarDir($path);
			if(isset($_FILES)){
				foreach ($_FILES as $k => $v) {
					$prueba = calidadImagen(25,$k,$path,array("allowed_types"=>'gif|jpg|png|jpeg'));
					if(!empty($upload['error'])){
						return $upload['error'];
					}
				}
			}
			$var['data'] = json_encode($data);
			$this->db->where("empresa_id",$this->user->id_empresa);
			$this->db->where("centro_de_costos",$this->user->centro_de_costos);
			$this->db->where("id_form_contrl",$data['id_form_contrl']);
			if($this->db->update($tabla,$var)){
				return true;
			}else{
				return false;
			}
		}else{
			$consecutivo 	= consecutivo($this->user->id_empresa,$this->uri->segment(3));
			$var['consecutivo'] = $consecutivo;
			$data['fecha'] = date("Y-m-d H:i:s");
			$var['data'] = json_encode($data);
			$var['nombre_form'] = $this->uri->segment(2);
			if(isset($data['id_modelo'])){
				$var['user_id'] = $data['id_modelo'];
			}else{
				$var['user_id'] = 0;
			}
			$var['centro_de_costos'] = $this->user->centro_de_costos;
			$var['empresa_id'] = $this->user->id_empresa;
			$var['estado'] = 1;
			$path = "images/uploads/".$this->uri->segment(2)."/".$this->user->centro_de_costos.'/'.$consecutivo;
			if(isset($_FILES)){
				foreach ($_FILES as $k => $v) {
					$prueba = calidadImagen(25,$k,$path,array("allowed_types"=>'gif|jpg|png|jpeg'));
					if(!empty($upload['error'])){
						return $upload['error'];
					}
				}
			}
			if($this->db->insert($tabla,$var)){
				$id_form_control = $this->db->insert_id();
				incrementa_consecutivo($this->user->id_empresa,$this->uri->segment(3));
				if($this->uri->segment(2) == "aspirante"){
					$observacion['observacion'] = $data['ObservacionAspirante'];
					$observacion['url'] = str_replace("www.",'', base_url("Formularios/detalleAspirante/".$id_form_control));
					
					insertar_Observacion($observacion);
				}
				logs($this->user,1,$tabla,$var['user_id'],"ut_form_control",1,$data);
				return true;	
			}else{
				logs($this->user,1,$tabla,$var['user_id'],"ut_form_control",0,$data);
				return false;	
			}
		}
	}
	
	public function setExamen($var){
		$this->user			=	$this->session->userdata('UserEncuesta');
		//pre($var); return;
		$tabla		=		DB_PREFIJO."entrevista t1";
		$Encuesta=$this->session->userdata('Encuesta');
		$this->db->where("entrevista_id",$this->user->entrevista_id);
		//pre(json_encode($var));return;
		if($this->db->update($tabla,array("json_respuestas"=>json_encode($var),"token"=>0))){
			return true;
		}else{
			return false;		
		}		
	}
	
	public function setEntrevista($var){
		
		$tabla		=		DB_PREFIJO."entrevista";
		$this->db->select("*");
		$this->db->from($tabla);
		$this->db->where("nro_piso_cedula",$var['nro_piso_cedula']);
		$this->db->where("email",$var['email']);
		$query	=	$this->db->get();
		$row	=	$query->row();
		$email	=	$var['email'];
		$documento			=	$var['nro_piso_cedula'];
		$var['token'] 		=	$token		=	md5(date("Y-m-d H:i:s"));
		$var['empresa_id'] 	= 	$this->user->id_empresa;
		$var['estatus'] 	= 0;
		$var['fecha'] 	= date("Y-m-d H:i:s");
		//$var['centro_de_costos'] = $this->user->centro_de_costos;
		//pre($var);return;
		if(empty($row)){
			if($this->db->insert($tabla,$var)){
					send_mail(array(
										"recipient"=>$email,
										"subject"=>"Entrevista Aspirante",
										"body"=>$this->load->view('Template/Emails/entrevista',array("Documento"=>$documento,"Email"=>$email,"Token"=>$token,"href"=>site_url("Formularios/Autenticacion/".$token)),TRUE),
										));
					return true;
			}else{
					return false;	
			}
		}else{
			$this->db->where("nro_piso_cedula",$var['nro_piso_cedula']);
			$this->db->where("email",$var['email']);
			if($this->db->update($tabla,$var)){
				send_mail(array(
									"recipient"=>$email,
									"subject"=>"Entrevista Aspirante",
									"body"=>$this->load->view('Template/Emails/entrevista',array("Documento"=>$documento,"Email"=>$email,"Token"=>$token,"href"=>site_url("Formularios/Autenticacion/".$token)),TRUE),
									));
				return true;
			}else{
				return false;	
			}
		}
	}
	
	public function Autenticacion($token){
		$this->session->unset_userdata('Encuesta');
		$tabla		=		DB_PREFIJO."entrevista t1";
		$this->db->select("t1.*,t2.abreviacion")->from($tabla);
		$this->db->join(DB_PREFIJO."usuarios t2", 't1.centro_de_costos=t2.user_id', 'left');
		if($token!=''){
			$this->db->where("t1.token",$token);
			$query = $this->db->get();
			$data=$query->row();
			if(!empty($data)){
				if(!empty($data->json_entrevista)){
					$encuenta		=	array();
					foreach(json_decode($data->json_entrevista) as $k =>$v){
						$encuenta[$k]	=	$v;	
					}
					$this->session->set_userdata(array('Encuesta'=>$encuenta));	
				}
				
				$this->session->set_userdata(array('UserEncuesta'=>$data));	
				redirect(base_url("Formularios/Entrevista/True"));	return;
			}else{
				redirect(base_url());
			}
		}		
	}
	
	public function ChequearUsuario($var){
		$this->user			=	$this->session->userdata('UserEncuesta');
		if($this->user->nro_piso_cedula==$var['nro_piso_cedula']){
			$user				=	$this->user;
			$user->identificado	=	true;
			$user->empresa    	=   centrodecostos($user->empresa_id);
			$this->session->set_userdata(array('UserEncuesta'=>$user));	
			redirect(base_url("Formularios/Entrevista/Legal"));	return;
		}else{
			redirect(base_url());
		}		
	}

	public function cerrar_entrevista(){
		$tabla		=		DB_PREFIJO."entrevista";
		$Encuesta=$this->session->userdata('Encuesta');
		$Encuesta['Finalizada']= "El suario ha finalizado la encuesta";
		$respuestas = "No se han encontrado respuestas debido a que el usuario finalizo la entrevista, antes de llegar a este apartado.";
		$this->db->where("entrevista_id",$this->user->entrevista_id);
		if($this->db->update($tabla,array("json_entrevista"=>json_encode($Encuesta),"json_respuestas"=>json_encode($respuestas)))){
			return true;
		}else{
			return false;		
		}
	}
	
	public function SavePreguntas(){
		$tabla		=		DB_PREFIJO."entrevista t1";
		$Encuesta=$this->session->userdata('Encuesta');
		$this->db->where("entrevista_id",$this->user->entrevista_id);
		if($this->db->update($tabla,array("json_entrevista"=>json_encode($Encuesta)))){
			return true;
		}else{
			return false;		
		}	
	}
	
	public function SetPreguntas($var){
		$Encuesta=$this->session->userdata('Encuesta');
		
		if(isset($Encuesta)){
			$this->session->set_userdata(array('Encuesta'=>array_merge($this->session->userdata('Encuesta'), $var)));	
		}else{
			$this->session->set_userdata(array('Encuesta'=>$var));	
		}
	}
	
	public function SetPrimeraEtapa($entrevista_id){
		$tabla		=		DB_PREFIJO."entrevista t1";
		$Encuesta	=		$this->session->userdata('Encuesta');
		$this->db->where("entrevista_id",$entrevista_id);
		if($this->db->update($tabla,array("json_entrevista"=>json_encode($Encuesta)))){
			return true;
		}else{
			return false;		
		}		
	}		
}
?>
