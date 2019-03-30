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
	
	public function PagarHonorarios($var){
		
		$tipo_documento				=	14;
		$ciclo_informacion			=	get_cf_ciclos_pagos_new($this->user->id_empresa,0);
		$periodo_pagos				=	centrodecostos($this->user->id_empresa);
		$ciclopago					=	ciclopago($periodo_pagos->periodo_pagos,$ciclo_informacion->mes,$ciclo_informacion->fecha_desde);
		$consecutivo				=	consecutivo($this->user->id_empresa,$tipo_documento);
		$var['nro_transaccion']		= 	$var["consecutivo"]		=	$consecutivo;
		$var['user_id']				=	$this->user->user_id;
		$var['empresa_id']			=	$this->user->id_empresa;
		$var['centro_de_costos']	=	$this->user->centro_de_costos;
		$modelo_id					=	$var['modelo_id'];
		//pre($var);return;
		
		$caja_id					=	$var['caja_id'];
		$procesador_id				=	$var['procesador_id'];
		$var['caja_id']				=	(@!empty(post('caja_id')))?post('caja_id'):0;
		$var['procesador_id']		=	(@!empty(post('procesador_id')))?post('procesador_id'):0;
		if($var['procesador_id']>0){
			$var['codigo_contable']	=	$procesador_id[$var['procesador_id']]->codigo_contable;
		}else{
			$var['codigo_contable']	=	$caja_id[$var['caja_id']]->codigo_contable;
		}
		$inser_contable				=	array(	"empresa_id"=>$this->user->id_empresa,
												"responsable_id"=>$this->user->user_id,
												"modelo_id"=>$modelo_id,
												"consecutivo"=>$consecutivo,
												"nickname_id"=>0,
												"centro_de_costos"=>$var["centro_de_costos"],
												"codigo_contable"=>"233525",
												"ciclo_produccion_id"=>$ciclopago,
												"tipo_documento"=>$tipo_documento,
												"fecha"=>date("Y-m-d"),
												"caja_id"=>$var['caja_id'],
												"procesador_id"=>$var['procesador_id'],
												"nro_documento"=>$var['nro_transaccion'],
												"pref_nro_documento"=>"NOA",
												"tipo_documento"=>$tipo_documento,
												"credito"=>$var["ajuste_a_la_decena"],
												"debito"=>"0.00",
												"json"=>json_encode($var));
		//registro_contable($inser_contable);
		
		$inser_contable2				=	array(	"empresa_id"=>$this->user->id_empresa,
													"responsable_id"=>$this->user->user_id,
													"modelo_id"=>$modelo_id,
													"consecutivo"=>$consecutivo,
													"nickname_id"=>0,
													"centro_de_costos"=>$var["centro_de_costos"],
													"codigo_contable"=>$var['codigo_contable'],
													"ciclo_produccion_id"=>$ciclopago,
													"tipo_documento"=>$tipo_documento,
													"fecha"=>date("Y-m-d"),
													"caja_id"=>$var['caja_id'],
													"procesador_id"=>$var['procesador_id'],
													"nro_documento"=>$var['nro_transaccion'],
													"pref_nro_documento"=>"NOA",
													"tipo_documento"=>$tipo_documento,
													"debito"=>$var["ajuste_a_la_decena"],
													"credito"=>"0.00",
													"json"=>json_encode($var));
		if(registro_contable($inser_contable) && registro_contable($inser_contable2)){
			incrementa_consecutivo($this->user->id_empresa,$tipo_documento);
			$this->session->unset_userdata("pagos");
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	public function ProcesarHonorarios($var){
		$tipo_documento				=	13;
		$ciclo_informacion			=	get_cf_ciclos_pagos_new($this->user->id_empresa,0);
		$periodo_pagos				=	centrodecostos($this->user->id_empresa);
		$ciclopago					=	ciclopago($periodo_pagos->periodo_pagos,$ciclo_informacion->mes,$ciclo_informacion->fecha_desde);
		$consecutivo				=	consecutivo($this->user->id_empresa,$tipo_documento);
		$var['nro_transaccion']		= 	$var["consecutivo"]		=	$consecutivo;
		$var['user_id']				=	$this->user->user_id;
		$var['empresa_id']			=	$this->user->id_empresa;
		$var['centro_de_costos']	=	$this->user->centro_de_costos;
		$inser_contable				=	array(	"empresa_id"=>$this->user->id_empresa,
												"responsable_id"=>$this->user->user_id,
												"modelo_id"=>$var['modelo_id'],
												"consecutivo"=>$consecutivo,
												"nickname_id"=>0,
												"centro_de_costos"=>$var["centro_de_costos"],
												"codigo_contable"=>"281505",
												"ciclo_produccion_id"=>$ciclopago,
												"tipo_documento"=>$tipo_documento,
												"fecha"=>date("Y-m-d"),
												"nro_documento"=>$var['nro_transaccion'],
												"pref_nro_documento"=>"NOA",
												"tipo_documento"=>$tipo_documento,
												"debito"=>$var["ajuste_a_la_decena"],
												"credito"=>"0.00",
												"json"=>json_encode($var));
		//registro_contable($inser_contable);
		
		
		$inser_contable				=	array(	"empresa_id"=>$this->user->id_empresa,
												"responsable_id"=>$this->user->user_id,
												"modelo_id"=>$var['modelo_id'],
												"consecutivo"=>$consecutivo,
												"nickname_id"=>0,
												"centro_de_costos"=>$var["centro_de_costos"],
												"codigo_contable"=>"233525",
												"ciclo_produccion_id"=>$ciclopago,
												"tipo_documento"=>$tipo_documento,
												"fecha"=>date("Y-m-d"),
												"nro_documento"=>$var['nro_transaccion'],
												"pref_nro_documento"=>"NOA",
												"tipo_documento"=>$tipo_documento,
												"credito"=>$var["ajuste_a_la_decena"],
												"debito"=>"0.00",
												"json"=>json_encode($var));
		//registro_contable($inser_contable);
		incrementa_consecutivo($this->user->id_empresa,$tipo_documento);
		return TRUE;
		//pre($consecutivo);
	}
	
	public function Transferir($var){
	//pre($var);
	$tipo_documento				=	11;
	$consecutivo				=	consecutivo($this->user->id_empresa,$tipo_documento);
	$var["consecutivo"]			=	$consecutivo;
	$var['user_id']				=	$this->user->user_id;
	$var['empresa_id']			=	$this->user->id_empresa;
	$var['centro_de_costos']	=	$this->user->centro_de_costos;
	$inser_contable				=	array(	"empresa_id"=>$this->user->id_empresa,
											"responsable_id"=>$this->user->user_id,
											"consecutivo"=>$consecutivo,
											"procesador_id"=>$var["procesador_id_origen"],
											"centro_de_costos"=>$var["centro_de_costos"],
											"codigo_contable"=>"111010",
											"tipo_documento"=>$tipo_documento,
											"fecha"=>date("Y-m-d"),
											"pref_nro_documento"=>"NOA",
											"tipo_documento"=>$tipo_documento,
											"debito"=>"0.00",
											"credito"=>$var["monto"],
											"json"=>json_encode($var));
		registro_contable($inser_contable);
		$inser_contable				=	array(	"empresa_id"=>$this->user->id_empresa,
											"responsable_id"=>$this->user->user_id,
											"consecutivo"=>$consecutivo,
											"procesador_id"=>$var["procesador_id_destino"],
											"centro_de_costos"=>$var["centro_de_costos"],
											"codigo_contable"=>"111010",
											"tipo_documento"=>$tipo_documento,
											"fecha"=>date("Y-m-d"),
											"pref_nro_documento"=>"NOA",
											"tipo_documento"=>$tipo_documento,
											"credito"=>"0.00",
											"debito"=>$var["monto"],
											"json"=>json_encode($var));
		registro_contable($inser_contable);	
		incrementa_consecutivo($this->user->id_empresa,$tipo_documento);
	}
	
	public function ResumenCajas(){
		return $this->result	=	ResumenCajas(array('110505'),array("6"));
	}
	
	public function ResumenBancos(){
		return $this->result	=	array(	'Nacionales'=>ResumenBancosNew(array("Pesos")),
											'Exterior'=>ResumenBancosNew(array("Euros","USD")),
										);
	}
	
	public function RetirosTRMDetallesContable($id){
		return $this->result	= 	RetirosTRMDetallesContable($id);
	}
	
	public function RetirosTRMDetalles($id){
		return $this->result	= 	RetirosTRMDetalle($id);
	}
	
	public function BancosDetallesContable($id_cuenta){
		return $this->result	= 	BancosDetallesContable($id_cuenta);
	}

	public function BancosDetalles($procesador_id,$codigo_contable,$tipo_documento=6,$transferencias=array()){
		$tabla		=	DB_PREFIJO."rp_operaciones";
		$debitos	=	$this->db->select("*")
									->from($tabla)
									->where('empresa_id',$this->user->id_empresa)
									->where('procesador_id',$procesador_id)
									->where('codigo_contable',$codigo_contable)
									->where('tipo_documento',5)
									->where('estatus',1)
									->get()
									->result();
		//echo $this->db->last_query();
		$creditos	=	$this->db->select("*,debito as credito,0 as debito,debito as debito_nacional,credito as credito_nacional")
									->from($tabla)
									->where('empresa_id',$this->user->id_empresa)
									->where('procesador_id',$procesador_id)
									->where('codigo_contable',$codigo_contable)
									->where('tipo_documento',$tipo_documento)
									->where('estatus',1)
									->get()
									->result();	
									
		//pre($debitos);
											
		if($transferencias)	{						
			$transferencias	=	$this->db->select("*,debito as debito_nacional,credito as credito_nacional")
										->from($tabla)
										->where('empresa_id',$this->user->id_empresa)
										->where('procesador_id',$procesador_id)
										->where('codigo_contable',$codigo_contable)
										->where('tipo_documento',$transferencias)
										->where('estatus',1)
										->get()
										->result();	
		}
		
		$result	=	array();
		foreach($debitos as $k =>$v){
			$result[$v->id]		=	$v;
		}
		foreach($creditos as $k =>$v){
			$result[$v->id]		=	$v;
		}
		foreach($transferencias as $k =>$v){
			$result[$v->id]		=	$v;
		}
		asort($result);
		$this->result = $result;					
	}
	
	public function CajasDetalles($id_cuenta){
		$tabla	=	DB_PREFIJO."rp_operaciones";
		$this->result = $this->db->select("codigo_contable,fecha,tipo_documento,consecutivo,debito as debito_COP,credito as credito_COP")
									->from($tabla)
									->where('empresa_id',$this->user->id_empresa)
									->where('caja_id',$id_cuenta)
									->where('estatus',1)
									->where('codigo_contable','110505')
									->get()
									->result();
	}
	
	public function getRetiro(){
		$tabla	=	DB_PREFIJO."rp_operaciones";
		return $this->result = $this->db->select("fecha,tipo_documento,consecutivo,debito,credito,json")
									->from($tabla)
									->where('empresa_id',$this->user->id_empresa)
									->where('estatus',1)
									->where('procesador_id',0)
									->where('tipo_documento',6)
									->where('codigo_contable','110505')
									->get()
									->result();
		
		
		$tabla		=		DB_PREFIJO."rp_retiroTRM t1";
		$this->db->select("*");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."sys_bancos t2", 't2.banco_id 	= 	t1.banco_id', 'left');
		$query			=	$this->db->get();
		$this->result 	=	$query->result();
	}

	public function setRetiroTrm($var){
		$tipo_documento				=	6;
		$consecutivo				=	consecutivo($this->user->id_empresa,$tipo_documento);
		$var["consecutivo"]			=	$consecutivo;
		$var['user_id']				=	$this->user->user_id;
		$var['empresa_id']			=	$this->user->id_empresa;
		$var['centro_de_costos']	=	$this->user->centro_de_costos;
		//$var["trm"]					=	$var["valor_retiro"] / $var["usd_cargado"];
		$CajaDestino				=	$var['CajaDestino'];
		$ComisionBancaria			=	$var["ComisionBancaria"];
		unset($var['entidad_bancaria'],$var['CajaDestino'],$var["ComisionBancaria"]);	
		//pre($var);		return;
		
			$insert_id	= 	$this->db->insert_id();
			
			$inser_contable	=	array(	"empresa_id"=>$this->user->id_empresa,
										"responsable_id"=>$this->user->user_id,
										"consecutivo"=>$consecutivo,
										"procesador_id"=>$var["procesador_id"],
										"centro_de_costos"=>$var["centro_de_costos"],
										"ciclo_produccion_id"=>$var["ciclo_de_produccion"],
										"codigo_contable"=>"111010",
										"tipo_documento"=>$tipo_documento,
										"fecha"=>$var["fecha_transaccion"],
										"pref_nro_documento"=>"NOA",
										"tipo_documento"=>6,
										"nro_documento"=>$var['nro_transaccion'],
										"debito"=>$var["usd_cargado"],
										"credito"=>"0.00",
										"json"=>json_encode($var));
			registro_contable($inser_contable);	
			$inser_contable	=	array(	"empresa_id"=>$this->user->id_empresa,
										"responsable_id"=>$this->user->user_id,
										"consecutivo"=>$consecutivo,
										"caja_id"=>$CajaDestino,
										"centro_de_costos"=>$var["centro_de_costos"],
										"ciclo_produccion_id"=>$var["ciclo_de_produccion"],
										"codigo_contable"=>"110505",
										"tipo_documento"=>$tipo_documento,
										"fecha"=>$var["fecha_transaccion"],
										"pref_nro_documento"=>"NOA",
										"tipo_documento"=>6,
										"nro_documento"=>$var['nro_transaccion'],
										"debito"=>"0.00",
										"credito"=>$var["valor_retiro"],
										"json"=>json_encode($var));
										
											
			registro_contable($inser_contable);	
			$inser_contable	=	array(	"empresa_id"=>$this->user->id_empresa,
										"responsable_id"=>$this->user->user_id,
										"consecutivo"=>$consecutivo,
										"caja_id"=>$CajaDestino,
										"centro_de_costos"=>$var["centro_de_costos"],
										"ciclo_produccion_id"=>$var["ciclo_de_produccion"],
										"codigo_contable"=>"530515",
										"tipo_documento"=>$tipo_documento,
										"fecha"=>$var["fecha_transaccion"],
										"pref_nro_documento"=>"NOA",
										"tipo_documento"=>6,
										"nro_documento"=>$var['nro_transaccion'],
										"debito"=>"0.00",
										"credito"=>$ComisionBancaria,
										"json"=>json_encode($var));
										
											
			registro_contable($inser_contable);	
			incrementa_consecutivo($this->user->id_empresa,$tipo_documento);
			return true;	
	}
	
	public function setConsignar($var){
		$tipo_documento				=	10;
		$consecutivo				=	consecutivo($this->user->id_empresa,$tipo_documento);
		$var["consecutivo"]			=	$consecutivo;
		$var['user_id']				=	$this->user->user_id;
		$var['empresa_id']			=	$this->user->id_empresa;
		$var['centro_de_costos']	=	$this->user->centro_de_costos;
		$var["fecha_transaccion"]	=	date("Y-m-d");
		$CajaDestino				=	$var['procesador_id'];
		
		$inser_contable	=	array(	"empresa_id"=>$this->user->id_empresa,
									"responsable_id"=>$this->user->user_id,
									"consecutivo"=>$consecutivo,
									"procesador_id"=>$CajaDestino,
									"centro_de_costos"=>$var["centro_de_costos"],
									"ciclo_produccion_id"=>$var["ciclo_de_produccion"],
									"codigo_contable"=>"110505",
									"tipo_documento"=>$tipo_documento,
									"fecha"=>$var["fecha_transaccion"],
									"pref_nro_documento"=>"NOA",
									"caja_id"=>$var["caja_id"],
									"tipo_documento"=>10,
									"nro_documento"=>$var['nro_documento'],
									"debito"=>$var["valor_consignacion"],
									"credito"=>"0.00",
									"json"=>json_encode($var));
		registro_contable($inser_contable);	
		$inser_contable	=	array(	"empresa_id"=>$this->user->id_empresa,
									"responsable_id"=>$this->user->user_id,
									"consecutivo"=>$consecutivo,
									"procesador_id"=>$CajaDestino,
									"centro_de_costos"=>$var["centro_de_costos"],
									"ciclo_produccion_id"=>$var["ciclo_de_produccion"],
									"codigo_contable"=>"111005",
									"tipo_documento"=>$tipo_documento,
									"fecha"=>$var["fecha_transaccion"],
									"pref_nro_documento"=>"NOA",
									"tipo_documento"=>10,
									"nro_documento"=>$var['nro_documento'],
									"debito"=>"0.00",
									"credito"=>$var["valor_consignacion"],
									"json"=>json_encode($var));
		registro_contable($inser_contable);	
		incrementa_consecutivo($this->user->id_empresa,$tipo_documento);
		return true;
	}

}
?>