<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Autenticacion_model extends CI_Model {
	
	var $user;
	
	public function setrecovertoken(){
		$data	=	user_x_token(post("token"));
		if(!empty($data)){
			$query	=	$this->db->where('user_id', $data->user_id)->update(DB_PREFIJO."usuarios", array("token"=>"NULL","password"=>md5(post("clave_nueva"))));	
			if($query){
				logs($data,2,"usuarios",$data->user_id,"Autenticacion");
				$this->session->set_flashdata('success', 'La activación ha sido exitosa, ya puede iniciar sesión.');
				return true;
			}else{
				logs($data,2,"usuarios",$data->user_id,"Autenticacion","0");
				$this->session->set_flashdata('danger', 'No pudo activarse esta cuenta.');
				return false;
			}			
			return true;	
		}
		pre($data);
	}
	
	public function login($var){
		$data	=	$this->db->select('*')->from(DB_PREFIJO."usuarios")->where('email',$var["email"])->where('type<>','empresa')->get()->row();
		//print_r($data);		
		if(!empty($data)){
			if($data->password==md5($var['password'])){
				if($data->estado==0){
					return array("error"=>"Esta cuenta se encuentra inactiva, consulte con el administrador");
					return;	
				}
				
				if($data->abreviacion!=''){
					$data->centro_de_costos			=		$data->user_id;
					$data->persona_contacto			=		$data->nombre_legal;
					$data2	=	$this->db->select('*')->from(DB_PREFIJO."usuarios")->where('user_id',$data->id_empresa)->get()->row();
					//pre($data2);
					$data->sistema_salarial			=		$data2->sistema_salarial;	
					$data->periodo_pagos			=		$data2->periodo_pagos;		
				}
				$session	=	$this->db->select('*')->from(DB_PREFIJO."sys_session")->where('user_id',$data->user_id)->get()->row();

				if(empty($session)){
					logs($data,4,"usuarios",$data->user_id,"Autenticacion");
					unset($data->password);
					if($data->type=='root'){
						$data->menu		=	menu();	
					}else{
						$data->menu		=	menu_usuarios($data->rol_id);
					}
					if($session		=	ini_session($data)){
						$this->set_session_login($session);
						return true;
					}else{
						return false;				
					}
				}else{
					if($user_new	=	tiempo_session($data)){
						$this->set_session_login($user_new);
						return true;	
					}else{
						return array("error"=>"Ya existe otra sesión abierta con este usuario<br><a class='btn btn-default' href='".base_url("Autenticacion/Destroy/".$session->session_id)."'>Cerrar Sesiones abiertas</a>");	
					}
				}		
			}else{
				return false;	
			}	
		}else{
			return false;	
		}
	}
	
	public function get_user_by_email($var){
		$ci 	=& 	get_instance();
		return $ci->db->select('*')->from(DB_PREFIJO."usuarios")->where('email',$var["email"])->get()->row();
	}
	
	public function set_user_by_token($token){
		$row		=	$this->db->select('*')->from(DB_PREFIJO."usuarios")->where('token',$token)->get()->row();
		if(!empty($row)){
			$query	=	$this->db->where('user_id', $row->user_id)->update(DB_PREFIJO."usuarios", array("token"=>"NULL"));	
			if($query){
				logs($row,2,"usuarios",$row->user_id,"Autenticacion");
				$this->session->set_flashdata('success', 'La activación ha sido exitosa, ya puede iniciar sesión.');
				return true;
			}else{
				logs($row,2,"usuarios",$row->user_id,"Autenticacion","0");
				$this->session->set_flashdata('danger', 'No pudo activarse esta cuenta.');
				return false;
			}			
			return true;
		}else{
			$this->session->set_flashdata('danger', 'Token obsoleto o inválido.');
			return false;	
		}
	}
		
	public function set_user($var,$me=FALSE){
		if(isset($var['redirect'])){
			unset($var["redirect"]);
		}
		if(isset($var['id'])){
			$var['password']	=	md5($var['password']);
		}
		if(!isset($var['id'])){
			$var['password']	=	$var['token']	=	md5(date("Y-m-d H:i:s"));
			if(!isset($var['login'])){	
				$explode_login	=	explode("@",$var['email']);
				$var['login']	= 	$explode_login[0];
			}
			$var['fecha_registro']	= 	date("Y-m-d");
			$query	=	$this->db->insert(DB_PREFIJO."usuarios", $var);
			logs($this->db->insert_id(),1,"usuarios",$this->db->insert_id(),"Autenticacion","1");
		}else{
			$query	=	$this->db->where('id', $var["id"])->update(DB_PREFIJO."usuarios", $var);
			logs($var["id"],1,"usuarios",$var["id"],"Autenticacion","1");
		}
		if($me){
			$this->set_session_login($var);
		}
		if($query){
			$this->user		=	$var;
			$this->session->set_flashdata('success', 'La información se guardo correctamente.');
			return true;
		}else{
			$this->session->set_flashdata('danger', 'La información no se pudo guardar.');
			return false;
		}
	}
	
	private function set_session_login($data){
		$this->session->set_flashdata('success', 'La información se guardo correctamente.');
		$this->session->set_userdata(array('User'=>$data));	
	}
	
}
?>