<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Departamentos_model extends CI_Model {
	
	var $fields,$result,$where,$like,$total_rows,$pagination,$search;

	public function get($id_esquema){
		$tabla				=		DB_PREFIJO."ma_departamentos";
		$this->db->select("t1.*,t2.persona_contacto");
		$this->db->from($tabla." t1");
		$this->db->join(DB_PREFIJO."usuarios t2", 't1.id_empresa=t2.user_id', 'left');
		$this->db->where("id_esquema",$id_esquema);
		$query			=	$this->db->get();
		$this->result 	=	$query->row();
	}
	
	public function get_dep_users($id_esquema){
		$this->db->select('t1.participacion_accionaria,t1.id_esquema_usuario,t2.*,t3.*');
		$this->db->from(DB_PREFIJO."ma_departamentos_usuarios t1");
		$this->db->join(DB_PREFIJO."ma_departamentos t2", 't1.id_esquema 	= 	t2.id_esquema', 'left');
		$this->db->join(DB_PREFIJO."usuarios t3", 't1.user_id 	= 	t3.user_id', 'left');
		$this->db->where("t1.id_esquema",$id_esquema);
		$query 	= 	$this->db->get();
		return $query->result() ;			
	}
	
	public function get_users($type = array('root', 'user'),$centro_de_costos=false){
		$this->db->select('*');
		$this->db->from(DB_PREFIJO."usuarios t1");
		if($centro_de_costos){
			$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
		}
		$this->db->where_in('type', $type);
		$this->db->order_by('primer_nombre','ASC');
		$this->db->order_by('persona_contacto','ASC');
		$query 	= 	$this->db->get();
		return $query->result() ;			
	}

	public function get_all(){
		$tabla				=		DB_PREFIJO."ma_departamentos";
  
  		$html_group_open	=		'<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">';
		$html_group_close	=		'</div>';
		$usuarios_open		=		$html_group_open.'<a class="btn btn-secondary" title="Consultar Accionistas" href="'.base_url('Usuarios/Todos/Asociados-');
		$usuarios_close		=		'"><i class="fa fa-users" aria-hidden="true"></i></a>';
		$edit_open			=		$html_group_open.'<a class="btn btn-secondary" title="Editar Centro de Costo" href="'.base_url($this->uri->segment(1).'/Add/');
		$edit_close			=		'"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
		$this->fields		=		array("CONCAT(nombre, ' <br> <b>' ,nombre_legal,' </b>')"=>"Nombre","t1.abreviacion"=>"Abreviación","CASE WHEN t1.estado=1 THEN 'Activo' ELSE 'Inactivo' END"=>"Estado"," CONCAT('".$usuarios_open."',id_esquema,'".$usuarios_close."','".$edit_open."',id_esquema,'".$edit_close."') AS edit"=>"Acción");
		$this->db->select(array_keys($this->fields));
		$this->db->from($tabla.' t1');
		$this->db->join(DB_PREFIJO."usuarios t2", 't1.id_empresa=t2.user_id', 'left');
		if(!empty($this->like)){
			$this->db->like($this->like[0],$this->like[1]);
		}
		if($this->where){
			$this->db->where($this->where[0],$this->where[1]);
		}
		if($this->search){
			$this->db->like('nombre', $this->search);			
			$this->db->or_like('abreviacion', $this->search);			
			$this->db->or_like('descripcion', $this->search);
			$this->db->or_like('estado', $this->search);			
		}
		$this->db->order_by('nombre_legal','ASC');
		$this->db->limit(ELEMENTOS_X_PAGINA,$this->Departamentos->pagination);		
		$query			=	$this->db->get();
		$this->result 	=	$query->result();
		$this->total_rows= $this->total_filas($tabla);

	}
	
	public function set($var){
		$tabla		=		DB_PREFIJO."ma_departamentos";
		if(isset($var['redirect'])){
			unset($var['redirect']);	
		}
		if(isset($var['id_esquema'])&& !empty($var['id_esquema'])){
			$id			=		array("id_esquema",$var['id_esquema']);
			if(isset($var['abreviacion'])){
				$var['abreviacion']		=	strtoupper($var['abreviacion']);
			}
			$this->db->where($id[0], $id[1]);
			if($this->db->update($tabla,$var)){
				logs($this->user,2,"ma_departamentos",$id[1],"Departamentos","1",$var);
				return true;	
			}else{
				logs($this->user,2,"ma_departamentos",$id[1],"Departamentos","0",$var);
				return false;	
			}
		}else{
			unset($var['id_esquema']);
			if($this->db->insert($tabla,$var)){
				logs($this->user,2,"ma_departamentos",$this->db->insert_id(),"Departamentos","1",$var);
				return true;
			}else{
				return false;	
			}
		}
	}
	
	public function total_filas($tabla){
		if($this->search){
			$this->db->from($tabla);
			$this->db->like('nombre', $this->search);			
			$this->db->or_like('abreviacion', $this->search);			
			$this->db->or_like('descripcion', $this->search);
			$this->db->or_like('estado', $this->search);
			return $this->db->get()->num_rows();			 
		}
		return $this->db->get($tabla)->num_rows();
	}

}
?>