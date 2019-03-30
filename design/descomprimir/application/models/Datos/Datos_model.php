<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Datos_model extends CI_Model {
	
	var $fields,$result,$where,$total_rows,$pagination,$search;

	public function get_Novedades($desde=false , $hasta=false){
		$tabla				=		DB_PREFIJO."rp_novedades t1";
		$this->db->select("*");
		$this->db->from($tabla);
		$this->db->where("t1.id_empresa",$this->user->id_empresa);
		$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
		$this->db->where('t1.id_modelo', $this->user->user_id);
		if($desde && $hasta){
			$this->db->where('t1.fecha BETWEEN "'. date('Y-m-d', strtotime($desde)). '" AND "'. date('Y-m-d', strtotime($hasta)).'"');
		}
		$this->db->order_by('t1.fecha_enviado','DESC');
		$this->db->limit(15);	
		$query						=	$this->db->get();
		$this->result			 	=	$query->result();
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
		$this->db->limit(ELEMENTOS_X_PAGINA,$this->Datos->pagination);		
		$query			=	$this->db->get();
		$this->result 	=	$query->result();
		$this->total_rows= $this->total_filas($tabla);
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