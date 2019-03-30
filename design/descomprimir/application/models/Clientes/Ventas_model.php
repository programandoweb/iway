<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Clientes_model extends CI_Model {
	
	var $fields,$result,$where,$total_rows,$pagination,$search;

	public function List_Comercial(){
		$tabla				=		DB_PREFIJO."cf_comercial";
		$this->db->select("*");
		$this->db->from($tabla);
		$query			=	$this->db->get();
		$this->result 	=	$query->result();
	}
	
	public function set($var){
		
	}

}
?>