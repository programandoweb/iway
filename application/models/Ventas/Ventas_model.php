<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Ventas_model extends CI_Model {
	
	var $fields,$result,$where,$total_rows,$pagination,$search;
	
	public function ReAbrirCiclo($ciclos_id){
		$tabla		=		DB_PREFIJO."cf_ciclos_pagos";
		$this->db->where("ciclos_id", $ciclos_id);
		if($this->db->update($tabla,array("estado"=>0))){
			return true;	
		}else{
			return false;	
		}
	}

	public function set_ConfigSeguridadSocial($var){
		$tabla				=		DB_PREFIJO."cf_seguridadsocial";
		$this->db->select("*");
		$this->db->from($tabla);
		$this->db->where("empresa_id",$this->user->id_empresa);
		$this->db->where("centro_de_costos",$this->user->centro_de_costos);
		$query			=	$this->db->get();
		$data 	=	$query->row();
		if(empty($data)){
			$var['empresa_id'] = $this->user->id_empresa;
			$var['centro_de_costos'] = $this->user->centro_de_costos;
			if($this->db->insert($tabla,$var)){
				logs($this->user,1,$tabla,$this->db->insert_id(),"Configuracion Seguridad social","1",$var);
				return true;
			}else{
				return false;	
			}
		}else{
			$this->db->where("id_cf_SeguridadSocial", $data->id_cf_SeguridadSocial);
			if($this->db->update($tabla,$var)){
				logs($this->user,2,$tabla,$data->centro_de_costos,"Ventas","1",$var);
				return true;	
			}else{
				logs($this->user,2,$tabla,$id[1],"Ventas","0",$var);
				return false;	
			}
		}
	}

	public function get($id_escala){
		$tabla				=		DB_PREFIJO."ve_escala_pagos";
		$this->db->select("*");
		$this->db->from($tabla);
		$this->db->where("id_escala",$id_escala);
		$query			=	$this->db->get();
		$this->result 	=	$query->row();
	}
	
	public function get_escala($id_escala){
		$tabla				=		DB_PREFIJO."ve_escala_pagos t1";
		$this->db->select("*");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."cf_seguridadsocial t2",'t1.centro_de_costos=t2.centro_de_costos', 'left');
		$this->db->where("id_escala",$id_escala);
		$query			=	$this->db->get();
		$this->result 	=	$query->row();
	}
	
	public function get_FormasPagos($id_forma_pago){
		$tabla				=		DB_PREFIJO."ve_forma_pagos";
		$this->db->select("*");
		$this->db->from($tabla);
		$this->db->where("id_forma_pago",$id_forma_pago);
		$query			=	$this->db->get();
		$this->result 	=	$query->row();
	}
	
	public function get_ve_escala_pagos($estado = array("ANY")){
		$tabla				=		DB_PREFIJO."ve_escala_pagos t1";
  		$html_group_open	=		'<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">';
		$html_group_close	=		'</div>';
		$edit_open			=		$html_group_open.'<a class="btn btn-secondary" href="'.base_url($this->uri->segment(1).'/Add_Escala/');
		$edit_close			=		'"><i class="fas fa-edit" aria-hidden="true"></i></a>';
		//$del_open			=		'<a class="btn btn-secondary" confirm="true"  href="'.base_url($this->uri->segment(1)."/".$this->uri->segment(2).'_Del/');
		//$del_close			=		'"><i class="fa fa-trash" aria-hidden="true"></i></a>'.$html_group_close;
		//$this->fields		=		array("nombre_escala"=>"Nombre","meta"=>"Meta","CASE WHEN estado=1 THEN 'Activo' ELSE 'Inactivo' END"=>"Estado"," CONCAT('".$edit_open."',id_escala,'".$edit_close."','".$del_open."',id_escala,'".$del_close."') AS edit"=>"Acción");
		$this->fields		=		array("porcentaje_descuento_dolar"=>"porcentaje_descuento_dolar","bonificacion"=>"bonificacion","salario"=>"salario","id_escala"=>"id_escala","nombre_escala"=>"Nombre","meta"=>"Meta","CASE WHEN estado=1 THEN 'Activo' ELSE 'Inactivo' END"=>"Estado"," CONCAT('".$edit_open."',id_escala,'".$edit_close."') AS edit"=>"Acción");
		foreach ($estado as $k => $v) {

			$this->db->select(array_keys($this->fields));
			$this->db->from($tabla);
			$this->db->where('t1.id_empresa', $this->user->id_empresa);
			if($this->where){
				$this->db->where($this->where[0],$this->where[1]);
			}
			$this->db->where("id_empresa",$this->user->id_empresa);
			if($this->user->type <> "root"){
				$this->db->where("centro_de_costos",$this->user->centro_de_costos);
			}
			$this->db->where("estado",$v);
			if($this->search){
				$this->db->like('nombre_escala', $this->search);			
				$this->db->or_like('estado', $this->search);			
			}
			$this->db->order_by('nombre_escala','ASC');
			$this->db->limit(ELEMENTOS_X_PAGINA,$this->Ventas->pagination);		
			$query			=	$this->db->get();
			if(count($estado) > 1){
				$this->result[$k] 	=	$query->result();
			}else{
				$this->result 	=	$query->result();
			}
		}
		$this->total_rows= $this->total_filas($tabla);
	}
	
	public function get_ve_FormasPagos(){
		$tabla				=		DB_PREFIJO."ve_forma_pagos t1";
  		$html_group_open	=		'<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">';
		$html_group_close	=		'</div>';
		$edit_open			=		$html_group_open.'<a class="lightbox" title="Editar Forma de Pago" data-type="iframe" href="'.base_url($this->uri->segment(1).'/Add_FormasPagos/');
		$edit_close			=		'"><i class="fas fa-edit" aria-hidden="true"></i></a>';
		$this->fields		=		array("nombre_escala"=>"Nombre","dias_pago"=>"Días de Pago","CASE WHEN estado=1 THEN 'Activo' ELSE 'Inactivo' END"=>"Estado"," CONCAT('".$edit_open."',id_forma_pago,'".$edit_close."') AS edit"=>"Acción");
		$this->db->select(array_keys($this->fields));
		$this->db->from($tabla);
		//$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
		if($this->where){
			$this->db->where($this->where[0],$this->where[1]);
		}
		if($this->search){
			$this->db->like('nombre_escala', $this->search);			
			$this->db->or_like('estado', $this->search);			
		}
		$this->db->order_by('nombre_escala','ASC');
		$this->db->limit(ELEMENTOS_X_PAGINA,$this->Ventas->pagination);		
		$query			=	$this->db->get();
		$this->result 	=	$query->result();
		//pre($this->result);
		$this->total_rows= $this->total_filas($tabla);
	}

	public function get_TRM(){
		$tabla				=		DB_PREFIJO."cf_ciclos_pagos t1";
  		$html_group_open	=		'<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">';
		$html_group_close	=		'</div>';
		$edit_open			=		$html_group_open.'<a class="btn btn-secondary lightbox" title="Editar Ciclo de Producción" href="'.base_url($this->uri->segment(1).'/CiclosPagos/');
		$edit_close			=		'"><i class="fa fa-upload" aria-hidden="true"></i></a>';
		$this->fields		=		array("CONCAT('<b>',nombre,'</b>') as nombre"=>"Período","CONCAT(fecha_desde,' <BR> ',fecha_hasta)"=>"Fecha Desde / Hasta","CASE WHEN estado=1 THEN 'Cerrrado' ELSE 'Abierto' END as estado"=>"Estado"," CONCAT('".$edit_open."',ciclos_id,'".$edit_close."') AS edit"=>"Acción","ciclos_id"=>"id","mes"=>"mes","centro_de_costos"=>"centro_de_costos");
		$this->db->select(array_keys($this->fields));
		$this->db->from($tabla);
		$this->db->where("centro_de_costos",$this->user->user_id);
		$this->db->or_where("centro_de_costos",$this->user->centro_de_costos);
		$this->db->group_by(array("centro_de_costos", "mes"));
		$this->db->order_by('fecha_desde','ASC');
		$this->db->limit(ELEMENTOS_X_PAGINA,$this->Ventas->pagination);		
		$query			=	$this->db->get();
		$this->result 	=	$query->result();
		$this->total_rows= $this->total_filas($tabla);
	}

	public function get_all(){
		$tabla				=		DB_PREFIJO."ma_documentos";
  
  		$html_group_open	=		'<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">';
		$html_group_close	=		'</div>';
		$edit_open			=		$html_group_open.'<a class="btn btn-secondary" href="'.base_url($this->uri->segment(1).'/Add/');
		$edit_close			=		'"><i class="fas fa-edit" aria-hidden="true"></i></a>';
		$del_open			=		'<a class="btn btn-secondary" confirm="true"  href="'.base_url($this->uri->segment(1)."/".$this->uri->segment(2).'_Del/');
		$del_close			=		'"><i class="fa fa-trash" aria-hidden="true"></i></a>'.$html_group_close;
		$this->fields		=		array("nombre"=>"Nombre","dias_vencimiento"=>"Días de Vencimiento","CASE WHEN estado=1 THEN 'Activo' ELSE 'Inactivo' END"=>"Estado"," CONCAT('".$edit_open."',id_escala,'".$edit_close."','".$del_open."',id_escala,'".$del_close."') AS edit"=>"Acción");
		$this->db->select(array_keys($this->fields));
		$this->db->from($tabla);
		if($this->where){
			$this->db->where($this->where[0],$this->where[1]);
		}
		if($this->search){
			$this->db->like('nombre', $this->search);			
			$this->db->or_like('descripcion', $this->search);
			$this->db->or_like('estado', $this->search);			
		}
		$this->db->order_by('nombre','ASC');
		$this->db->limit(ELEMENTOS_X_PAGINA,$this->Ventas->pagination);		
		$query			=	$this->db->get();
		$this->result 	=	$query->result();
		$this->total_rows= $this->total_filas($tabla);

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
				logs($this->user,2,$tabla,$id[1],"Ventas","1",$var);
				return true;	
			}else{
				logs($this->user,2,$tabla,$id[1],"Ventas","0",$var);
				return false;	
			}
		}else{
			unset($var['id_escala']);
			if($this->db->insert($tabla,$var)){
				logs($this->user,1,$tabla,$this->db->insert_id(),"Ventas","1",$var);
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
				logs($this->user,2,$tabla,$id[1],"Ventas","1",$var);
				return true;	
			}else{
				logs($this->user,2,$tabla,$id[1],"Ventas","0",$var);
				return false;	
			}
		}else{
			unset($var['id_forma_pago']);
			if($this->db->insert($tabla,$var)){
				logs($this->user,1,$tabla,$this->db->insert_id(),"Ventas","1",$var);
				return true;
			}else{
				return false;	
			}
		}
	}
	
	public function setCiclosPagos($var){
		
		$tabla		=		DB_PREFIJO."cf_ciclos_pagos";
		if(isset($var['redirect'])){
			unset($var['redirect']);	
		}
		//pre($var);		return;
		if(isset($var['ciclos_id'])&& !empty($var['ciclos_id'])){
			$id			=		array("ciclos_id",$var['ciclos_id']);
			$this->db->where($id[0], $id[1]);
			if($this->db->update($tabla,array("TRM_Liquidacion"=>$var['TRM_Liquidacion'],"estado"=>1))){
				/*$usuarios = get_modelos(true);
				foreach ($usuarios as $k => $v) {
					$ get_form_control(base_url());
				}*/
				logs($this->user,2,$tabla,$id[1],"cf_ciclos_pagos","1",$var);
				return true;	
			}else{
				logs($this->user,2,$tabla,$id[1],"cf_ciclos_pagos","0",$var);
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