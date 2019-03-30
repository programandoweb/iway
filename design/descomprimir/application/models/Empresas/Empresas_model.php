<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Empresas_model extends CI_Model {
	
	var $fields,$result,$where,$total_rows,$pagination,$search;

	public function get($user_id){
		$tabla				=		DB_PREFIJO."usuarios";
		$this->db->select("*");
		$this->db->from($tabla);
		$this->db->where("user_id",$user_id);
		$query			=	$this->db->get();
		$this->result 	=	$query->row();
	}

	public function get_all(){
		$tabla				=		DB_PREFIJO."usuarios t1";
  		$html_group_open	=		'<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">';
		$html_group_close	=		'</div>';
		$sucursales_open	=		$html_group_open.'<a class="btn btn-secondary" title="Ver Sucursales" href="'.base_url('Usuarios/Todos/CentroCostos');
		$sucursales_close	=		'"><i class="fa fa-building" aria-hidden="true"></i></a>';
		$edit_open			=		$html_group_open.'<a class="btn btn-secondary" title="Editar Empresa" href="'.base_url($this->uri->segment(1).'/Add/');
		$edit_close			=		'"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
		$this->fields		=		array(""=>""," CONCAT('".$sucursales_open."',t1.codigo_interno,'".$sucursales_close."','".$edit_open."',t1.user_id,'".$edit_close."') AS edit"=>"Acción");
		$this->db->select("	
							CONCAT('<b>',t1.nombre_comercial,'</b> <br> ', t1.nombre_legal) as nombre_legal,
							CONCAT(t1.cod_telefono,' ',t1.telefono,' <BR> ',t2.email) AS contactos,
							CASE WHEN t1.estado=1 THEN 'Activo' ELSE 'Inactivo' END as estado,
							t1.user_id,
							t2.user_id as centro_de_costos
						");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."usuarios t2", 't2.id_empresa 	= 	t1.user_id', 'left');
		$this->db->where("t1.type","empresa");
		if($this->search){
			$this->db->like('t1.nombre_legal', $this->search);			
			$this->db->or_like('t1.nombre_comercial', $this->search);
			$this->db->or_like('t1.estado', $this->search);			
		}
			$this->db->group_by(array("t1.user_id"));
		$this->db->order_by('t1.nombre_legal','ASC');
		$this->db->limit(ELEMENTOS_X_PAGINA,$this->Empresas->pagination);		
		$query			=	$this->db->get();
		$this->result 	=	$query->result();
		$this->total_rows= $this->total_filas($tabla);

	}
	
	public function get_all_export(){
		$tabla				=		DB_PREFIJO."usuarios t1";
  		$html_group_open	=		'<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">';
		$html_group_close	=		'</div>';
		$sucursales_open	=		$html_group_open.'<a class="btn btn-secondary" title="Ver Sucursales" href="'.base_url('Usuarios/Todos/CentroCostos');
		$sucursales_close	=		'"><i class="fa fa-building" aria-hidden="true"></i></a>';
		$edit_open			=		$html_group_open.'<a class="btn btn-secondary" title="Editar Empresa" href="'.base_url($this->uri->segment(1).'/Add/');
		$edit_close			=		'"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
		$this->fields		=		array("CONCAT(t1.nombre_comercial,' ', t1.nombre_legal) as nombre_legal"=>"Nombre Legal / Comercial","CONCAT(t1.cod_telefono,' ',t1.telefono,' ',t1.email) AS contactos"=>"Datos de Contacto","CASE WHEN t1.estado=1 THEN 'Activo' ELSE 'Inactivo' END as estado"=>"Estado"," CONCAT('".$sucursales_open."',t1.codigo_interno,'".$sucursales_close."','".$edit_open."',t1.user_id,'".$edit_close."') AS edit"=>"Acción");
		$this->db->select(array_keys($this->fields));
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."usuarios t2", 't1.id_empresa 	= 	t2.user_id', 'left');
		$this->db->where("type","t1.empresa");
		if($this->search){
			$this->db->like('nombre_legal', $this->search);			
			$this->db->or_like('nombre_comercial', $this->search);
			$this->db->or_like('estado', $this->search);			
		}
		$this->db->order_by('nombre_legal','ASC');
		$this->db->limit(ELEMENTOS_X_PAGINA,$this->Empresas->pagination);		
		$query			=	$this->db->get();
		$this->result 	=	$query->result();
		$this->total_rows= $this->total_filas($tabla);

	}
	
	public function set($var){
		$tabla		=		DB_PREFIJO."usuarios";
		if(isset($var['redirect'])){
			unset($var['redirect']);	
		}
		if(isset($var['user_id'])&& !empty($var['user_id'])){
			$id			=		array("user_id",$var['user_id']);
			$this->db->where($id[0], $id[1]);
			if($this->db->update($tabla,$var)){
				$this->db->where("id_empresa", $id[1]);
				$this->db->update(DB_PREFIJO."ma_departamentos",array("estado"=>$var['estado']));
				logs($this->user,2,"usuarios",$var['user_id'],"Empresas","1",$var);
				return true;	
			}else{
				logs($this->user,2,"usuarios",$var['user_id'],"Empresas","0",$var);
				return false;	
			}
		}else{
			$email					=	$var['email'];
			$pass					=	explode("@",$var['email']);
			unset($var['user_id'],$var['email']);
			$var['token']			=	md5(date("H:i:s Y-M-d"));
			$password				=	$pass[0].rand(1000,50000);
			$var['password']		=	md5($password);
			
			if($this->db->insert($tabla,$var)){
				$insert_id			=	$this->db->insert_id();
				logs($this->user,1,"usuarios",$insert_id,"Empresas","1",$var);
				$this->db->insert(DB_PREFIJO."usuarios",array(	
																"id_empresa"=>$insert_id,
																"nombre_legal"=>"Principal",
																"nombre_comercial"=>"",
																"type"=>"CentroCostos",
																"abreviacion"=>"DEF",
																"n_rooms"=>8,
																"direccion"=>$var['direccion'],
																"ciudad"=>$var['ciudad'],
																"principal"=>1,
																"rol_id"=>$var['rol_id'],
																"departamento"=>$var['departamento'],
																"email"=>$email,
																"password"=>$var['password'],
																"codigo_postal"=>$var['codigo_postal'],
																"pais"=>$var['pais'],
																"cod_telefono"=>$var['cod_telefono'],
																"telefono"=>$var['telefono'],
																"cod_otro_telefono"=>$var['cod_otro_telefono'],
																"otro_telefono"=>$var['otro_telefono'],
																"estado"=>"1"
															));
				send_mail(array(
									"recipient"=>$email,
									"subject"=>"Bienvenido a nuestro sistema",
									"body"=>$this->load->view('Template/Emails/bienvenida',array("userPassword"=>$password,"userEmail"=>$email,"userName"=>$email,"href"=>site_url("Apanel")),TRUE),
									));
				return true;
			}else{
				return false;	
			}
		}
	}

	public function total_filas($tabla){
		if($this->search){
			$this->db->from($tabla);
			$this->db->like('nombre_legal', $this->search);			
			$this->db->or_like('nombre_comercial', $this->search);
			$this->db->or_like('estado', $this->search);
			return $this->db->get()->num_rows();			 
		}
		return $this->db->get($tabla)->num_rows();
	}

}
?>