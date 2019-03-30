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
		$this->db->order_by('id','DESC');
		$query			=	$this->db->get();
		$this->result 	=	$query->result();
	}
	
	public function set($var){
		$tabla		=		DB_PREFIJO."cf_comercial";
		if(isset($var["id"])&& !empty($var["id"])){		 
			$this->db->where('id',$var["id"]);		  
			if($this->db->update($tabla,$var)){
				return true;	
			}else{
				return array("error"=>array(	"message"	=>	"Lo siento, no ha sido modificado",
												"code"		=>	"203"));
			}
		}else{
			if($this->db->insert($tabla,$var)){
				return true;	
			}else{
				return array("error"=>array(	"message"	=>	"Lo siento, no ha sido modificado",
												"code"		=>	"203"));
			}
	 	}

	}

	public function registro($var){
		  $tabla		=		DB_PREFIJO."cf_comercial";
		  $this->db->select("*");
		  $this->db->from($tabla);
		  $this->db->where('id',$var);
		  $query			=	$this->db->get();
		  $this->result 	=	$query->row();
	}

	public function Observaciones($var){
		  $tabla		=		DB_PREFIJO."cf_comercial";
		  $this->db->select("*");
		  $this->db->from($tabla);
		  $this->db->where('id',$var);
		  $query			=	$this->db->get();
		  $this->result["observacion"] 	=	$query->row();
		  $tabla		=		DB_PREFIJO."cf_comercial_incidencias";
		  $this->db->select("observacion,fecha");
		  $this->db->from($tabla);
		  $this->db->where('comercial_id',$this->result["observacion"]->id);
		  $query			=	$this->db->get();
		  $this->result["Incidencias"] 	=	$query->result();
	}

	public function setIncidencia($var){
		$var["fecha"] = date("Y-m-d H:i:s");
		$tabla		=		DB_PREFIJO."cf_comercial_incidencias";
		if($this->db->insert($tabla,$var)){
				return true;	
			}else{
				return array("error"=>array(	"message"	=>	"Lo siento, no ha sido modificado",
												"code"		=>	"203"));
			}
	}

}
?>