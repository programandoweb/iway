<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Profesiones_model extends CI_Model {
	
	var $fields,$result,$where,$total_rows,$pagination,$search;

	public function get($id_profesion){
		$tabla				=		DB_PREFIJO."ma_profesiones";
		$this->db->select("*");
		$this->db->from($tabla);
		$this->db->where("id_profesion",$id_profesion);
		$query			=	$this->db->get();
		$this->result 	=	$query->row();
	}

	public function get_all(){
		$tabla				=		DB_PREFIJO."ma_profesiones";
  
  		$html_group_open	=		'<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">';
		$html_group_close	=		'</div>';
		$edit_open			=		$html_group_open.'<a class="btn btn-secondary" href="'.base_url($this->uri->segment(1).'/Add/');
		$edit_close			=		'"><i class="fas fa-edit" aria-hidden="true"></i></a>';
		$del_open			=		'<a class="btn btn-secondary" confirm="true" href="'.base_url($this->uri->segment(1)."/".$this->uri->segment(2).'_Del/');
		$del_close			=		'"><i class="fa fa-trash" aria-hidden="true"></i></a>'.$html_group_close;
		$this->fields		=		array("nombre"=>"Nombre","CASE WHEN estado=1 THEN 'Activo' ELSE 'Inactivo' END"=>"Estado"," CONCAT('".$edit_open."',id_profesion,'".$edit_close."','".$del_open."',id_profesion,'".$del_close."') AS edit"=>"Acción");
		$this->db->select(array_keys($this->fields));
		$this->db->from($tabla);
		if($this->where){
			$this->db->where($this->where[0],$this->where[1]);
		}
		if($this->search){
			$this->db->like('codigo', $this->search);			
			$this->db->or_like('nombre', $this->search);			
			$this->db->or_like('descripcion', $this->search);
			$this->db->or_like('estado', $this->search);			
		}
		$this->db->order_by('nombre','ASC');
		$this->db->limit(ELEMENTOS_X_PAGINA,$this->Profesiones->pagination);		
		$query			=	$this->db->get();
		$this->result 	=	$query->result();
		$this->total_rows= $this->total_filas($tabla);

	}
	
	public function set($var){
		$tabla		=		DB_PREFIJO."ma_profesiones";
		if(isset($var['redirect'])){
			unset($var['redirect']);	
		}
		if(isset($var['id_profesion']) && !empty($var['id_profesion'])){
			$id			=		array("id_profesion",$var['id_profesion']);
			$this->db->where($id[0], $id[1]);
			if($this->db->update($tabla,$var)){
				return true;	
			}else{
				return false;	
			}
		}else{
			unset($var['id_profesion']);
			if($this->db->insert($tabla,$var)){
				return true;
			}else{
				return false;	
			}
		}
	}

	public function total_filas($tabla){
		if($this->search){
			$this->db->from($tabla);
			$this->db->like('codigo', $this->search);			
			$this->db->or_like('nombre', $this->search);			
			$this->db->or_like('descripcion', $this->search);
			$this->db->or_like('estado', $this->search);
			return $this->db->get()->num_rows();			 
		}
		return $this->db->get($tabla)->num_rows();
	}

}
?>