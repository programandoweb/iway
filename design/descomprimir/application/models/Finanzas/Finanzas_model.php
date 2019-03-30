<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Finanzas_model extends CI_Model {
	
	var $fields,$result,$where,$total_rows,$pagination,$search;

	public function get($id_escala){
		$tabla				=		DB_PREFIJO."ve_escala_pagos";
		$this->db->select("*");
		$this->db->from($tabla);
		$this->db->where("id_escala",$id_escala);
		$query			=	$this->db->get();
		$this->result 	=	$query->row();
	}
	
	public function get_fi_cuenta($id_cuenta){
		$tabla				=		DB_PREFIJO."fi_cuentas t1";
		$this->db->select("*");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."sys_bancos t2", 't1.entidad_bancaria=t2.banco_id', 'left');
		$this->db->where("id_cuenta",$id_cuenta);
		$query			=	$this->db->get();
		$this->result 	=	$query->row();
	}
	
	public function get_fi_caja($id_caja){
		$tabla				=		DB_PREFIJO."fi_cajas";
		$this->db->select("*");
		$this->db->from($tabla);
		$this->db->where("id_caja",$id_caja);
		$query			=	$this->db->get();
		$this->result 	=	$query->row();
	}
			
	public function get_fi_cuentas(){
	
		$tabla				=		DB_PREFIJO."fi_cuentas";
  		$html_group_open	=		'<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">';
		$html_group_close	=		'</div>';
		$edit_open			=		$html_group_open.'<a class="btn btn-secondary lightbox" title="Editar Cuenta" data-type="iframe" href="'.base_url($this->uri->segment(1).'/Add_CuentasBancarias/');
		$edit_close			=		'"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
		$this->fields		=		array("CONCAT('<B>',Entidad,'</B><BR>',titular)"=>"Titular","CONCAT(tipo_cuenta,'<BR>',tipo_monedas,'<BR>',modo_cuenta,'<BR>',nro_cuenta)"=>"Datos de la Cuenta","CASE WHEN t1.estado=1 THEN 'Activo' ELSE 'Inactivo' END"=>"Estado"," CONCAT('".$edit_open."',id_cuenta,'".$edit_close."') AS edit"=>"Acción");
		$this->db->select(array_keys($this->fields));
		$this->db->from($tabla.' t1');
		$this->db->join(DB_PREFIJO."sys_bancos t2", 't1.entidad_bancaria=t2.banco_id', 'left');
		$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
		if($this->where){
			$this->db->where($this->where[0],$this->where[1]);
		}
		if($this->search){
			$this->db->like('titular', $this->search);			
			$this->db->or_like('estado', $this->search);			
		}
		$this->db->order_by('titular','ASC');
		$this->db->limit(ELEMENTOS_X_PAGINA,$this->Finanzas->pagination);		
		$query			=	$this->db->get();
		$this->result 	=	$query->result();
		$this->total_rows= $this->total_filas($tabla);
	}
	
	public function get_fi_cuentas_export(){
	
		$tabla				=		DB_PREFIJO."fi_cuentas";
  		$html_group_open	=		'<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">';
		$html_group_close	=		'</div>';
		$edit_open			=		$html_group_open.'<a class="btn btn-secondary" href="'.base_url($this->uri->segment(1).'/Add_CuentasBancarias/');
		$edit_close			=		'"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
		$this->fields		=		array("CONCAT(entidad_bancaria,' |',titular)"=>"Titular","CONCAT(tipo_cuenta,' | ',tipo_monedas,' | ',modo_cuenta,' | ',nro_cuenta)"=>"Datos de la Cuenta","CASE WHEN t1.estado=1 THEN 'Activo' ELSE 'Inactivo' END"=>"Estado"," CONCAT('".$edit_open."',id_cuenta,'".$edit_close."') AS edit"=>"Acción");
		$this->db->select(array_keys($this->fields));
		$this->db->from($tabla.' t1');
		if($this->where){
			$this->db->where($this->where[0],$this->where[1]);
		}
		if($this->search){
			$this->db->like('titular', $this->search);			
			$this->db->or_like('estado', $this->search);			
		}
		$this->db->order_by('titular','ASC');
		$this->db->limit(ELEMENTOS_X_PAGINA,$this->Finanzas->pagination);		
		$query			=	$this->db->get();
		$this->result 	=	$query->result();
		$this->total_rows= $this->total_filas($tabla);
	}
	
	public function get_fi_cajas(){
	
		$tabla				=		DB_PREFIJO."fi_cajas";
  		$html_group_open	=		'<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">';
		$html_group_close	=		'</div>';
		$edit_open			=		$html_group_open.'<a class="btn btn-secondary lightbox" title="Editar Caja" data-type="iframe" href="'.base_url($this->uri->segment(1).'/Add_Cajas/');
		$edit_close			=		'"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
		$this->fields		=		array("nombre_caja"=>"Nombre","CASE WHEN t1.estado=1 THEN 'Activo' ELSE 'Inactivo' END"=>"Estado"," CONCAT('".$edit_open."',id_caja,'".$edit_close."') AS edit"=>"Acción");
		$this->db->select(array_keys($this->fields));
		$this->db->from($tabla.' t1');
		$this->db->join(DB_PREFIJO."usuarios t2", 't1.id_responsable=t2.user_id', 'left');
		$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
		if($this->where){
			$this->db->where($this->where[0],$this->where[1]);
		}
		if($this->search){
			$this->db->like('nombre_caja', $this->search);			
			$this->db->or_like('estado', $this->search);			
		}
		$this->db->order_by('nombre_caja','ASC');
		$this->db->limit(ELEMENTOS_X_PAGINA,$this->Finanzas->pagination);		
		$query			=	$this->db->get();
		$this->result 	=	$query->result();
		$this->total_rows= $this->total_filas($tabla);
	}
	
	public function get_fi_cajas_export(){
	
		$tabla				=		DB_PREFIJO."fi_cajas";
  		$html_group_open	=		'<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">';
		$html_group_close	=		'</div>';
		$edit_open			=		$html_group_open.'<a class="btn btn-secondary" href="'.base_url($this->uri->segment(1).'/Add_Cajas/');
		$edit_close			=		'"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
		$this->fields		=		array("nombre_caja"=>"Nombre","persona_contacto"=>"Responsable","CASE WHEN t1.estado=1 THEN 'Activo' ELSE 'Inactivo' END"=>"Estado"," CONCAT('".$edit_open."',id_caja,'".$edit_close."') AS edit"=>"Acción");
		$this->db->select(array_keys($this->fields));
		$this->db->from($tabla.' t1');
		$this->db->join(DB_PREFIJO."usuarios t2", 't1.id_responsable=t2.user_id', 'left');
		if($this->where){
			$this->db->where($this->where[0],$this->where[1]);
		}
		if($this->search){
			$this->db->like('nombre_caja', $this->search);			
			$this->db->or_like('estado', $this->search);			
		}
		$this->db->order_by('nombre_caja','ASC');
		$this->db->limit(ELEMENTOS_X_PAGINA,$this->Finanzas->pagination);		
		$query			=	$this->db->get();
		$this->result 	=	$query->result();
		$this->total_rows= $this->total_filas($tabla);
	}
	
	public function set_Caja($var){
		$tabla		=		DB_PREFIJO."fi_cajas";
		if(isset($var['redirect'])){
			unset($var['redirect']);	
		}
		if(isset($var['id_caja'])&& !empty($var['id_caja'])){
			$id			=		array("id_caja",$var['id_caja']);
			$this->db->where($id[0], $id[1]);
			if($this->db->update($tabla,$var)){
				logs($this->user,2,$tabla,$id[1],"Finanzas","1",$var);
				return true;	
			}else{
				logs($this->user,2,$tabla,$id[1],"Finanzas","0",$var);
				return false;	
			}
		}else{
			unset($var['id_caja']);
			if($this->db->insert($tabla,$var)){
				logs($this->user,1,$tabla,$this->db->insert_id(),"Finanzas","1",$var);
				return true;
			}else{
				return false;	
			}
		}
	}
	
	public function set_CuentasBancarias($var){
		$tabla		=		DB_PREFIJO."fi_cuentas";
		if(isset($var['redirect'])){
			unset($var['redirect']);	
		}
		if(isset($var['id_cuenta'])&& !empty($var['id_cuenta'])){
			$id			=		array("id_cuenta",$var['id_cuenta']);
			$this->db->where($id[0], $id[1]);
			if($this->db->update($tabla,$var)){
				logs($this->user,2,$tabla,$id[1],"Finanzas","1",$var);
				return true;	
			}else{
				logs($this->user,2,$tabla,$id[1],"Finanzas","0",$var);
				return false;	
			}
		}else{
			unset($var['id_cuenta']);
			if($this->db->insert($tabla,$var)){
				logs($this->user,1,$tabla,$this->db->insert_id(),"Finanzas","1",$var);
				return true;
			}else{
				return false;	
			}
		}
	}
	
	public function set_escala($var){
		$tabla		=		DB_PREFIJO."ve_escala_pagos";
		if(isset($var['redirect'])){
			unset($var['redirect']);	
		}
		if(isset($var['id_escala'])&& !empty($var['id_escala'])){
			$id			=		array("id_escala",$var['id_escala']);
			$this->db->where($id[0], $id[1]);
			if($this->db->update($tabla,$var)){
				logs($this->user,2,$tabla,$id[1],"Finanzas","1",$var);
				return true;	
			}else{
				logs($this->user,2,$tabla,$id[1],"Finanzas","0",$var);
				return false;	
			}
		}else{
			unset($var['id_escala']);
			if($this->db->insert($tabla,$var)){
				logs($this->user,1,$tabla,$this->db->insert_id(),"Finanzas","1",$var);
				return true;
			}else{
				return false;	
			}
		}
	}
	
	public function set_forma_pagos($var){
		$tabla		=		DB_PREFIJO."ve_forma_pagos";
		if(isset($var['redirect'])){
			unset($var['redirect']);	
		}
		if(isset($var['id_forma_pago'])&& !empty($var['id_forma_pago'])){
			$id			=		array("id_forma_pago",$var['id_forma_pago']);
			$this->db->where($id[0], $id[1]);
			if($this->db->update($tabla,$var)){
				logs($this->user,2,$tabla,$id[1],"Finanzas","1",$var);
				return true;	
			}else{
				logs($this->user,2,$tabla,$id[1],"Finanzas","0",$var);
				return false;	
			}
		}else{
			unset($var['id_forma_pago']);
			if($this->db->insert($tabla,$var)){
				logs($this->user,1,$tabla,$this->db->insert_id(),"Finanzas","1",$var);
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
			$this->db->or_like('descripcion', $this->search);
			$this->db->or_like('estado', $this->search);
			return $this->db->get()->num_rows();			 
		}
		return $this->db->get($tabla)->num_rows();
	}

}
?>