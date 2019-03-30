<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Ajax_model extends CI_Model {
	
	var $fields,$result,$where,$total_rows,$pagination,$search;

	public function get($id_documento){
		
	}
	
	public function donde_debitar($var){
		if($var=='caja'){
			$tabla=DB_PREFIJO."fi_cajas";
			$this->db->select('nombre_caja as title,id_caja as value,codigo_contable,codigo_contable_subfijo')
				->from($tabla)
				->where('id_empresa',$this->user->id_empresa);
			$query			=	$this->db->get();
			return $query->result();			
		}else if($var=='procesador'){
			$tabla=DB_PREFIJO."fi_cuentas t1";
			$this->db->select('CONCAT(Entidad," ",nro_cuenta) as title,id_cuenta as value,codigo_contable,codigo_contable_subfijo')
				->from($tabla)
				->join(DB_PREFIJO."sys_bancos t2",'t1.entidad_bancaria=t2.banco_id','left')
				->where('id_empresa',$this->user->id_empresa)
				->where('tipo_monedas',"Pesos");
			$query			=	$this->db->get();
			return $query->result();			
		}else{
			
		}
	}
	
}
?>