<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Operaciones_model extends CI_Model {
	
	var $fields,$result,$where,$total_rows,$pagination,$search;
	
	public function get_detalle_contable($id){
		return $this->result	= 	detalle_contable($id);
	}
	
	public function ResumenCajas(){
		return $this->result	=	ResumenCajas(array('110505'),array("TRM Retiro"));
	}
	
	public function ResumenBancos(){
		return $this->result	=	array(	'Nacionales'=>ResumenBancos(array('110505'),array("TRM Retiro"),array("Pesos")),
											'Exterior'=>ResumenBancos(array('130510'),array("Comprobante Bancario"),array("Euros","USD")),
										);
	}
	
	public function RetirosTRMDetalles($id){
		return $this->result	= 	RetirosTRMDetalle($id);
	}
	
	public function BancosDetallesContable($id_cuenta){
		return $this->result	= 	BancosDetallesContable($id_cuenta);
	}

	public function BancosDetalles($id_cuenta){
		$tabla	=	DB_PREFIJO."rp_operaciones";
		$this->result = $this->db->select("fecha,tipo_documento,consecutivo,tercero,debito,credito")
									->from($tabla)
									->where('id_empresa',$this->user->id_empresa)
									->where('procesador_id',$id_cuenta)
									->where('estatus',1)
									->get()
									->result();
	}
	
	public function CajasDetalles($id_cuenta){
		$tabla	=	DB_PREFIJO."rp_operaciones";
		$this->result = $this->db->select("fecha,tipo_documento,consecutivo,tercero,debito,credito,debito_COP,credito_COP")
									->from($tabla)
									->where('id_empresa',$this->user->id_empresa)
									->where('procesador_id',$id_cuenta)
									->where('estatus',1)
									->where('codigo_contable','110505')
									->get()
									->result();
	}
	
	public function getRetiro(){
			$tabla		=		DB_PREFIJO."rp_retiroTRM t1";
			$this->db->select("*");
			$this->db->from($tabla);
			$this->db->join(DB_PREFIJO."sys_bancos t2", 't2.banco_id 	= 	t1.banco_id', 'left');
			$query			=	$this->db->get();
$this->result 	=	$query->result();
	}

	public function setRetiroTrm($var){
		$tipo_documento				=	"TRM Retiro";
		$consecutivo				=	consecutivo($this->user->id_empresa,$tipo_documento);
		$consecutivo				=	$consecutivo +	1;
		$var["consecutivo"]			=	$consecutivo;
		$var['user_id']				=	$this->user->user_id;
		$var['id_empresa']			=	$this->user->id_empresa;
		$var['centro_de_costos']	=	$this->user->centro_de_costos;
		$var["trm"]					=	$var["valor_retiro"] / $var["usd_cargado"];
		unset($var['entidad_bancaria']);	
		//pre($var);		return;
		$tabla	=	DB_PREFIJO."rp_retiroTRM";
		if($this->db->insert($tabla,$var)){
			$insert_id	= 	$this->db->insert_id();
			
			$inser_contable	=	array(	"id_empresa"=>$this->user->id_empresa,
										"consecutivo"=>$consecutivo,
										"procesador_id"=>$var["id_cuenta"],
										"centro_de_costos"=>$var["centro_de_costos"],
										"codigo_contable"=>"111010",
										"tipo_documento"=>$tipo_documento,
										"fecha"=>$var["fecha_transaccion"],
										"pref_nro_documento"=>"NOA",
										"nro_documento"=>$var['nro_transaccion'],
										"tercero"=>	"NOA",
										"tokens"=>"NOA",
										"valor_tokens"=>"NOA",
										"id_modelo"=>"NOA",
										"porcentaje_modelo"=>"NOA",											
										"trm"=>$var["trm"],
										"debito"=>$var["usd_cargado"],
										"debito_COP"=>$var["usd_cargado"] * $var["trm"],
										"usd"=>$var["usd_cargado"],
										"credito"=>"0.00",
										"credito_COP"=>"0.00");
			registro_contable($inser_contable);	
			
			
			$inser_contable	=	array(	"id_empresa"=>$this->user->id_empresa,
										"consecutivo"=>$consecutivo,
										"procesador_id"=>$var["id_caja"],
										"centro_de_costos"=>$var["centro_de_costos"],
										"codigo_contable"=>"110505",
										"tipo_documento"=>$tipo_documento,
										"fecha"=>$var["fecha_transaccion"],
										"pref_nro_documento"=>"NOA",
										"nro_documento"=>$var['nro_transaccion'],
										"tercero"=>	"NOA",
										"tokens"=>"NOA",
										"valor_tokens"=>"NOA",
										"id_modelo"=>"NOA",
										"porcentaje_modelo"=>"NOA",											
										"trm"=>$var["trm"],
										"debito"=>"0.00",
										"debito_COP"=>"0.00",
										"usd"=>$var["usd_cargado"],
										"credito"=>$var["usd_cargado"],
										"credito_COP"=>$var["usd_cargado"] * $var["trm"]);
			registro_contable($inser_contable);	
			incrementa_consecutivo($this->user->id_empresa,$tipo_documento);
			return true;	
		}else{
			return array("error"=>array(	"message"	=>	"Lo siento, no ha sido modificado",
											"code"		=>	"203"));
		}
	}

}
?>