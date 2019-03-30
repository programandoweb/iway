<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class CronJog_model extends CI_Model {
	
	var $result;

	function PeriodoPrueba(){
		$usuarios	=	GetUsuarios(array("empresa"),"user_id,json");
		foreach($usuarios as $k => $v){
			$json	=	json_decode($v->json);
			if(isset($json->DemoTimeHasta)){
				if($json->DemoTimeHasta<=date("Y-m-d")){
					$usuarios		=	GetUsuarios(array(	"Administrativos",
															"Asociados",
															"CentroCostos",
															"Modelos",
															"Monitores",
															),"user_id,json,estado",$v->user_id);
					$set_json			=	json_db(@$v->json,array(array("estatus_perfiles",$usuarios)));
					$this->db->where("user_id",$v->user_id);
					$this->db->update(DB_PREFIJO."usuarios",array("estado"=>0,"json"=>$set_json));
					$this->db->where("id_empresa",$v->user_id);
					$this->db->update(DB_PREFIJO."usuarios",array("estado"=>0));
				}else{
					//echo 'No Cambios<br/>';	
				}
			} 
		}
	}

}
?>