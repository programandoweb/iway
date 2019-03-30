<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Reportes_model extends CI_Model {
	
	var $fields,$result,$where,$total_rows,$pagination,$search;

	public function regPres(){
		$tabla				=		DB_PREFIJO."rp_presupuesto";
		$this->db->select("*");
		$this->db->from($tabla);		
		$query						=	$this->db->get();
		$this->result			 	=	$query->result();	
	}
	
	public function setPresupuesto($var){
		unset($var['contabilidad'],$var['contrapartida'],$var['descripcion2'],$var['gastos_id']);
		//pre($var);return;
		$var['user_id']				=	$this->user->user_id;
		$var['id_empresa']			=	$this->user->id_empresa;
		$var['centro_de_costos']	=	$this->user->centro_de_costos;
		$tabla		=		DB_PREFIJO."rp_presupuesto";
		if($this->db->insert($tabla,$var)){
			logs($this->user,1,"rp_presupuesto",$this->db->insert_id(),"Insert Presupuesto","1",$var);
			return true;	
		}else{
			logs($this->user,1,"rp_presupuesto",NULL,"Insert Presupuesto","0",$var);
			return array("error"=>array(	"message"	=>	"Lo siento, no ha sido modificado",
											"code"		=>	"203"));
		}	
	}
	
	public function get_detalle_contable($id){
		return $this->result	= 	detalle_contable($id);
	}
	
	public function RP_Plataformas(){
		$tabla		=	DB_PREFIJO."cf_rel_plataformas t1";
		$this->db->select("	t2.primer_nombre,
							SUM(t3.tokens) as tokens,
							SUM(t3.monto) as monto,
							t1.id_plataforma
							");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."usuarios t2", 't2.user_id=t1.id_plataforma', 'left');
		$this->db->join(DB_PREFIJO."rp_diario t3", 't1.id_plataforma=t3.id_plataforma', 'left');
		$this->db->where("t1.id_empresa",$this->user->id_empresa);
		$this->db->where("t2.estado",1);
		if($this->user->principal<1){
			$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
		}
		$this->db->where_not_in('t2.moneda_de_pago', array('RSS'));
		$this->db->group_by(array("t1.id_plataforma"));
		$this->db->order_by('t2.primer_nombre','ASC');
		$query						=	$this->db->get();
		$this->result["global"] 	=	$query->result();
		
		$tabla		=	DB_PREFIJO."cf_nickname t1";
		$this->db->select("nickname_id,nickname,id_plataforma,id_modelo");
		$this->db->from($tabla);
		$this->db->where("t1.id_empresa",$this->user->id_empresa);
		$query						=	$this->db->get();
		foreach($query->result() as $v){
			$this->result["detallado"][$v->id_plataforma][] 	=	$v;
		}		
		//$this->result["rows"]		=	RP_Plataformas();
	}
	
	public function RP_Modelos(){
		$tabla		=	DB_PREFIJO."cf_rel_plataformas t1";
		$this->db->select("	t2.primer_nombre,
							SUM(t3.tokens) as tokens,
							SUM(t3.monto) as monto,
							t1.id_plataforma
							");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."usuarios t2", 't2.user_id=t1.id_plataforma', 'left');
		$this->db->join(DB_PREFIJO."rp_diario t3", 't1.id_plataforma=t3.id_plataforma', 'left');
		$this->db->where("t1.id_empresa",$this->user->id_empresa);
		$this->db->where("t2.estado",1);
		if($this->user->principal<1){
			$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
		}
		$this->db->where_not_in('t2.moneda_de_pago', array('RSS'));
		$this->db->group_by(array("t1.id_plataforma"));
		$this->db->order_by('t2.primer_nombre','ASC');
		$query						=	$this->db->get();
		$this->result["global"] 	=	$query->result();
		
		$tabla=DB_PREFIJO."rp_diario t1";
		foreach($this->result["global"] as $v){
			$this->db->select("t1.id_plataforma,t1.id_modelo,t1.nickname_id,CONCAT(t2.primer_nombre,' ',t2.primer_apellido) as modelo,SUM(tokens)");
			$this->db->from($tabla);
			$this->db->join(DB_PREFIJO."usuarios t2", 't2.user_id=t1.id_modelo', 'left');
			$this->db->where("t1.id_empresa",$this->user->id_empresa);	
			$this->db->where("t1.id_plataforma",$v->id_plataforma);				
			$this->db->group_by(array("t1.id_plataforma"));
			$query=$this->db->get();
			$this->result["detallado"][$v->id_plataforma]=$query->result();
		}		
	}
	
	public function Add_FacturaAjax($var){
		$tabla=DB_PREFIJO."sys_paginas_webcam t1";
		$this->db->select("	t3.nickname_id,
							t3.nickname,
							t3.id_master,
							t3.id_modelo,
							t2.equivalencia,
							t3.centro_de_costos,
							t4.abreviacion,
							t5.primer_nombre,
							t5.segundo_nombre,
							t5.primer_apellido,
							t5.segundo_apellido,
							t5.identificacion,
							t5.type,
							t5.id_empresa,
							t6.periodo_pagos,
							t7.	nombre_master");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."usuarios t2",'t1.Pagina=t2.primer_nombre','left');
		$this->db->join(DB_PREFIJO."cf_nickname t3",'t2.user_id=t3.id_plataforma','left');
		$this->db->join(DB_PREFIJO."usuarios t4",'t3.centro_de_costos=t4.user_id','left');
		$this->db->join(DB_PREFIJO."usuarios t5",'t3.id_modelo=t5.user_id','left');
		$this->db->join(DB_PREFIJO."usuarios t6",'t4.id_empresa=t6.user_id','left');
		$this->db->join(DB_PREFIJO."cf_rel_master t7",'t3.id_master=t7.rel_plataforma_id','left');		
		$this->db->where('t1.Nombre_legal', $var['nombre_legal']);
		$this->db->where("t5.id_empresa",$this->user->id_empresa);
		$this->db->where("t5.estado",1);
		$query							=	$this->db->get();
		$this->result["rows"]			= 	$query->result();
		$this->result["periodo_new"]	=	$periodo_new	=	get_cf_ciclos_pagos_new($this->user->id_empresa,0);
		return;
		$this->result["ciclo_pago"]		=	ciclopago($this->result['rows'][0]->periodo_pagos,$periodo_new->mes,$periodo_new->fecha_desde);
	}
	
	public function set_RecibirFactura($var){
		//pre($var);return;
		$totalidad_111010		=	0;
		$tipo_documento			=	"Comprobante Bancario";
		$consecutivo			=	consecutivo($var["id_empresa"],$tipo_documento);
		foreach($var['procesador_id'] as $k => $v){			
			$inser_contable	=	array(	"id_empresa"=>$var["id_empresa"],
										"consecutivo"=>$consecutivo,
										"procesador_id"=>$v,
										"centro_de_costos"=>$var["centro_de_costos"],
										"codigo_contable"=>"130510",
										"tipo_documento"=>$tipo_documento,
										"fecha"=>date("Y-m-d"),
										"pref_nro_documento"=>"NOA",
										"cliente_id"=>$var['cliente_id'],
										"nro_documento"=>$var['nro_documento'],
										"tercero"=>	"NOA",
										"tokens"=>"NOA",
										"valor_tokens"=>"NOA",
										"usd"=>"NOA",
										"id_modelo"=>"NOA",
										"porcentaje_modelo"=>"NOA",											
										"trm"=>$var['trm'],
										"debito_COP"=>"0.00",
										"debito"=>"0.00",
										"credito"=> $var["credito"][$k],
										"credito_COP"=> $var["credito"][$k]*$var['trm']);
			registro_contable($inser_contable);	
			$totalidad_111010			=	$totalidad_111010 +	$var["credito"][$k];
		}
		$inser_contable	=	array(	"id_empresa"=>$var["id_empresa"],
										"consecutivo"=>$consecutivo,
										"centro_de_costos"=>$var["centro_de_costos"],
										"codigo_contable"=>"111010",
										"tipo_documento"=>$tipo_documento,
										"fecha"=>date("Y-m-d"),
										"pref_nro_documento"=>"NOA",
										"cliente_id"=>$var['cliente_id'],
										"nro_documento"=>$var['nro_documento'],
										"tercero"=>	"NOA",
										"tokens"=>"NOA",
										"valor_tokens"=>"NOA",
										"usd"=>"NOA",
										"id_modelo"=>"NOA",
										"porcentaje_modelo"=>"NOA",											
										"trm"=>$var['trm'],
										"debito"=>$totalidad_111010,
										"debito_COP"=>$totalidad_111010*$var['trm'],
										"credito"=> "0.00",
										"credito_COP"=> "0.00");
			registro_contable($inser_contable);	
			incrementa_consecutivo($var["id_empresa"],$tipo_documento);
			logs($this->user,1,"rp_operaciones",$var['nro_documento'],$tipo_documento,"1",$inser_contable);
		return true;	
	}

	public function get_UsuariosXMaster(){
		$tabla				=		DB_PREFIJO."cf_rel_plataformas t1";
		$this->db->select("t1.id_plataforma,t2.*");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."usuarios t2", 't1.id_plataforma		=	t2.user_id', 'left');
		$this->db->where_not_in('moneda_de_pago', array('RSS'));
		//$this->db->where_not_in('tipo_persona', array("Free"));		
		$this->db->where("t1.id_empresa",$this->user->id_empresa);
		$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
		$this->db->order_by('t2.primer_nombre','ASC');
		$query						=	$this->db->get();
		$this->result			 	=	$query->result();	
	}

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
	
	public function get_reporte($user){
		/*PROCESAR SEGÚN TIPO DE SUCURSAL*/	
		$sql					=	"	SELECT  t1.id_empresa,
												t1.mes,
												t2.abreviacion,
												t2.nombre_legal,
												t1.periodo_pagos,
												t2.user_id as centro_de_costos
											FROM ".DB_PREFIJO."rp_tmp t1
												LEFT JOIN ".DB_PREFIJO."usuarios t2 ON t1.centro_de_costos=t2.user_id
											 	WHERE t1.id_empresa = '".$this->user->id_empresa."'";
		if($user->principal<>1){											
			$sql				.=	"				AND t1.centro_de_costos = '".$this->user->centro_de_costos."'";
		}
		$sql					.=	"					GROUP BY t1.centro_de_costos
															ORDER BY t1.pagina";	
		
		$query 						= 	$this->db->query($sql);
		$this->result				=	$query->result();
		//pre($this->result);																
	}
	
	public function token_x_bancos($nickname,$id_plataforma){
		$this->db->select("t3.entidad_bancaria,t3.id_cuenta,t3.nro_cuenta");
		$this->db->from(DB_PREFIJO."cf_nickname t1");
		$this->db->join(DB_PREFIJO."cf_rel_master t2", 't1.id_master		=	t2.rel_plataforma_id', 'left');
		$this->db->join(DB_PREFIJO."fi_cuentas t3", 't2.cuenta_id		=	t3.id_cuenta', 'left');
		$this->db->where("t1.id_empresa",$this->user->id_empresa);
		$this->db->where('t1.nickname', $nickname);
		$this->db->where('t1.id_plataforma', $id_plataforma);
		$query						=	$this->db->get();
		return $query->row();
	}
	
	public function MakeFactura($var){
		$tabla				=	DB_PREFIJO."rp_factura";
		$row				=	$this->db->select("nro_documento")
										 ->from($tabla)
										 ->where('id_empresa',$var["id_empresa"])
										 /*->where('centro_de_costos',$var["centro_de_costos"])*/
										 ->order_by('nro_documento','DESC')
										 ->get()
										 ->row();
		
		if(empty($row)){
			$nro_documento	=	1;	
		}else{
			$nro_documento	=	(int)$row->nro_documento + 1;	
		}
		$cliente_id				=	$var["cliente_id"];
		$error					=	false;
		$ciclo_informacion		=	get_cf_ciclos_pagos_new($var["id_empresa"],0);
		$trm					=	periodotrm($ciclo_informacion->fecha_hasta)->monto;
		$format_periodo_pago	=	$var["format_periodo_pago"];
		$post					=	post();
		foreach($post["abreviacion"] as $k => $v){
			if($post["tokens"][$k]>0){
			$insert	=	array(	"nro_documento"=>$nro_documento,
								"id_empresa"=>$var["id_empresa"],
								"centro_de_costos"=>$var["centro_de_costos"],
								"nombre_cliente"=>$var["nombre_cliente"],
								"cliente_id"=>$var["cliente_id"],
								"direccion"=>$var["direccion"],
								"pais"=>$var["pais"],
								"identificacion_empresa"=>$var["identificacion_empresa"],
								"ciclo_de_produccion"=>$format_periodo_pago[0],
								"fecha_emision"=>$var["fecha_emision"],
								"total_num_tokens"=>$var["total_tokens"],
								"tokens"=>$post["tokens"][$k],
								"equivalencia"=>$post["equivalencia"][$k],
								"usd"=>$post["total_dolar_sin_formato"][$k],
								"total_dolar_con_formato"=>$post["total_dolar"][$k],								
								"total_facturado_dolar"=>$var["total_dolares_sin_formato"],
								"trm"=>$trm,
								"sutotal_pesos_facturados"=>"0",
								"total_facturado_pesos"=>"0",
								"iva"=>"0",
								"nickname_id"=>$post["nickname_id"][$k],
								"id_master"=>$post["id_master"][$k],
								"id_modelo"=>$post["id_modelo"][$k]);
			
			
				if(!$this->db->insert($tabla,$insert)){
				$error = true;
				}
			}
		}
		//pre($insert);return;					
		
		if(!$error){
			$lastid 					= 	$nro_documento;
			$total_dolares_sin_formato	=	$var["total_dolares_sin_formato"]/2;
			//return;
			$totalidad_2805				=	0;
			$tipo_documento					=	"Factura Venta";
			$consecutivo					=	consecutivo($this->user->id_empresa,$tipo_documento);
			
			foreach($var['nickname'] as $k => $v){
				if($post["tokens"][$k]>0){
				$escala_x_modelo			=	get_escala_x_user_id($var["id_modelo"][$k]);
				//pre($var["id_modelo"][$k]);return;
				/*CONSULTAR CON DAVID, PUSE VALORES DEFAULT SI UNA MODELO NO TIENE ESCALA DE PAGOS*/
				if(is_object($escala_x_modelo)){
					$porcentaje_descuento_dolar	=	$escala_x_modelo->porcentaje_descuento_dolar;
					$bonificacion				=	$escala_x_modelo->bonificacion;
				}else{
					$porcentaje_descuento_dolar	=	0.90;
					$bonificacion				=	50;
				}
				$porcentaje_x_modelo		=	porcentaje_contable_x_modelo($var["tokens"][$k],$trm,$var["equivalencia"][$k],$porcentaje_descuento_dolar,$bonificacion);
				$porcentaje_estudio			=	1 - $porcentaje_x_modelo;
				$credito					=	round(($var["tokens"][$k]* $var["equivalencia"][$k] * $porcentaje_x_modelo),2);
				//pre($porcentaje_x_modelo);return;
				$resutlado_total_dolar_sin_formato[$k]	=	$var["total_dolar_sin_formato"][$k] /2;
				//print_r($cliente_id);return;
				
				$inser_contable	=	array(	"id_empresa"=>$this->user->id_empresa,
											"consecutivo"=>$consecutivo,
											"centro_de_costos"=>$this->user->centro_de_costos,
											"codigo_contable"=>"281505",
											"tipo_documento"=>$tipo_documento,
											"pref_nro_documento"=>"NOA",
											"cliente_id"=>$cliente_id,
											"nro_documento"=>$lastid,
											"tercero"=>	$var["modelo_primer_nombre"][$k]. ' ' . $var["modelo_segundo_nombre"][$k].' '.$var["modelo_primer_apellido"][$k].' '.$var["modelo_segundo_apellido"][$k],
											"tokens"=>$var["tokens"][$k],
											"valor_tokens"=>$var["equivalencia"][$k],
											"usd"=>$var["total_dolar"][$k],
											"id_modelo"=>$var["id_modelo"][$k],
											"porcentaje_modelo"=>$porcentaje_x_modelo,											
											"trm"=>$trm,
											"debito"=>"0.00",
											"credito"=> $credito,
											"credito_COP"=> $credito * $trm);
				if(registro_contable($inser_contable)){
					return false;	
				}
				$totalidad_2805			=	$totalidad_2805 +	$credito;
				}
			}
			
			
			$credito2					=	$var["total_dolares_sin_formato"] - $totalidad_2805;
			$inser_contable				=	array(	"id_empresa"=>$this->user->id_empresa,
													"consecutivo"=>$consecutivo,
													"centro_de_costos"=>$this->user->centro_de_costos,
													"codigo_contable"=>"414580",
													"tipo_documento"=>$tipo_documento,
													"pref_nro_documento"=>"NOA",
													"cliente_id"=>$cliente_id,
													"nro_documento"=>$lastid,
													"tercero"=>$var["nombre_cliente"],
													"id_modelo"=>NULL,
													"tokens"=>$var["total_tokens"],
													"valor_tokens"=>$var["equivalencia"][0],
													"usd"=>$var["total_dolares"],
													"trm"=>$trm,
													"porcentaje_modelo"=>null,	
													"debito"=>"0.00",
													"debito_COP "=>"0.00",
													"credito"=>($credito2),
													"credito_COP"=>($credito2*$trm));
			registro_contable($inser_contable);
			logs($this->user,1,"rp_operaciones",$lastid,$tipo_documento,"1",$inser_contable);
			
			$inser_contable	=	array(	"id_empresa"=>$this->user->id_empresa,
										"consecutivo"=>$consecutivo,
										"centro_de_costos"=>$this->user->centro_de_costos,
										"codigo_contable"=>"130510",
										"tipo_documento"=>$tipo_documento,
										"pref_nro_documento"=>"NOA",
										"cliente_id"=>$cliente_id,
										"nro_documento"=>$lastid,
										"tercero"=>$var["nombre_cliente"],
										"id_modelo"=>NULL,
										"tokens"=>$var["total_tokens"],
										"valor_tokens"=>$var["equivalencia"][0],
										"usd"=>$var["total_dolares"],
										"trm"=>$trm,
										"porcentaje_modelo"=>null,	
										"debito"=>$var["total_dolares_sin_formato"],
										"debito_COP "=>$var["total_dolares_sin_formato"]*$trm,
										"credito"=>"0.00",
										"credito_COP"=>"0.00");
			registro_contable($inser_contable);
			incrementa_consecutivo($this->user->id_empresa,$tipo_documento);
			
			return true;	
		}else{
			logs($this->user,1,"rp_operaciones",$consecutivo,$tipo_documento,"0",$inser_contable);
			return false;	
		}
	}
	
	public function MakeFactura2($var){
		$var["id_empresa"]	=	$this->user->id_empresa;
		$tabla				=	DB_PREFIJO."rp_factura";
		$row				=	$this->db->select("nro_documento")
										 ->from($tabla)
										 ->where('id_empresa',$this->user->id_empresa)
										 ->order_by('nro_documento','DESC')
										 ->get()
										 ->row();
		
		if(empty($row)){
			$nro_documento	=	1;	
		}else{
			$nro_documento	=	(int)$row->nro_documento + 1;	
		}
		$usds					=	array();
		$cliente_id				=	$var["cliente_id"];
		$error					=	false;
		$ciclo_informacion		=	get_cf_ciclos_pagos_new($var["id_empresa"],0);
		$trm_default			=	periodotrm(date("Y-m-d"))->monto;
		$trm					=	(isset($var["trm"]))?$var["trm"]:$trm_default;
		$format_periodo_pago	=	$var["ciclo_de_produccion"];
		$post					=	post();
		//pre($var);
		$sutotal_pesos_facturados	=	0;
		
		if($var['moneda']!='Pesos'){
			$total_facturado_dolar		=	array_sum($post["valor"])	* $trm ;
			$total_facturado_pesos		=	array_sum($post["valor"]) * $trm ;
		}else{
			$total_facturado_dolar		=	array_sum($post["valor"])	/ $trm ;
			$total_facturado_pesos		=	array_sum($post["valor"]);
		}
		
		$totalidad_233595				=	0;
		$tipo_documento				=	"Factura Gasto";
		$consecutivo				=	consecutivo($this->user->id_empresa,$tipo_documento);
		
		foreach($post["contabilidad"] as $k => $v){
			if($post["contabilidad"][$k]>0){
			
				if($var['moneda']!='Pesos'){
					$usd				=	$post["valor"][$k];
					$post["valor"][$k]	=	$post["valor"][$k] * $trm;	
				}else{
					$usd					=	$post["valor"][$k] / $trm;
				}
				$usds[$k]				=	$usd;	
				$sutotal_pesos_facturados	+=	$post["valor"][$k];
				$var2					=	$var;
				$var2['descripcion']	=	$var['descripcion2'];
				$insert	=	array(	"nro_documento"=>$nro_documento,
									"type"=>2,
									"id_empresa"=>$this->user->id_empresa,
									"centro_de_costos"=>$this->user->centro_de_costos,
									"nombre_cliente"=>$var["nombre_legal"],
									"cliente_id"=>$var["cliente_id"],
									"nro_documento_ext"=>$var["nro_documento_ext"],
									"direccion"=>$var["direccion"],
									"pais"=>$var["pais"],
									"identificacion_empresa"=>$var["identificacion_empresa"],
									"ciclo_de_produccion"=>$format_periodo_pago,
									"fecha_emision"=>$var["fecha_emision"],
									"fecha_vencimiento"=>$var["fecha_vencimiento"],
									"usd"=>$usd,
									"total_dolar_con_formato"=>$usd,								
									"total_facturado_dolar"=>$total_facturado_dolar,
									"trm"=>$trm,
									"items"=>json_encode($var2),
									"sutotal_pesos_facturados"=>$total_facturado_pesos,
									"total_facturado_pesos"=>$total_facturado_pesos
									);
				if(!$this->db->insert($tabla,$insert)){
					$error = true;
				}
				
				$inser_contable	=	array(	"id_empresa"=>$this->user->id_empresa,
											"consecutivo"=>$consecutivo,
											"centro_de_costos"=>$this->user->centro_de_costos,
											"codigo_contable"=>$var['contabilidad'][$k],
											"tipo_documento"=>$tipo_documento,
											"pref_nro_documento"=>"NOA",
											"cliente_id"=>$cliente_id,
											"nro_documento"=>$nro_documento,
											"tercero"=>	$var['nombre_legal'],
											"usd"=>$total_facturado_dolar,
											"trm"=>$trm,
											"debito"=>"0.00",
											"debito_COP"=>"0.00",
											"credito"=>$usd,
											"credito_COP"=>$usd*$trm);
				registro_contable($inser_contable);
				$totalidad_233595		=	$totalidad_233595 +	$usd;				
				
				$inser_contable	=	array(	"id_empresa"=>$this->user->id_empresa,
											"consecutivo"=>$consecutivo,
											"centro_de_costos"=>$this->user->centro_de_costos,
											"codigo_contable"=>$var['contrapartida'][$k],
											"tipo_documento"=>$tipo_documento,
											"pref_nro_documento"=>"NOA",
											"cliente_id"=>$cliente_id,
											"nro_documento"=>$nro_documento,
											"tercero"=>	$var['nombre_legal'],
											"usd"=>$total_facturado_dolar,
											"trm"=>$trm,
											"debito_COP"=>$usd*$trm,
											"debito"=>$usd,
											"credito"=>"0.00",
											"credito_COP"=>"0.00");
				registro_contable($inser_contable);
				logs($this->user,1,"rp_operaciones",$nro_documento,$tipo_documento,"1",$inser_contable);
			}
		}
		return ($error==false)?true:false;
	}
	
	
	public function MakeFacturaOLD($var){
		
		$tabla				=	DB_PREFIJO."rp_factura";
		$row				=	$this->db->select("factura_centro_de_costos")
										 ->from($tabla)
										 ->where('id_empresa',$var["id_empresa"])
										 ->where('centro_de_costos',$var["centro_de_costos"])
										 ->order_by('factura_centro_de_costos','DESC')
										 ->get()
										 ->row();
		
		if(empty($row)){
			$factura_centro_de_costos	=	1;	
		}else{
			$factura_centro_de_costos	=	(int)$row->factura_centro_de_costos + 1;	
		}
		//pre($factura_centro_de_costos);return;
		
		$format_periodo_pago	=	$var["format_periodo_pago"];
		$insert	=	array(	"factura_centro_de_costos"=>$factura_centro_de_costos,
							"id_empresa"=>$var["id_empresa"],
							"centro_de_costos"=>$var["centro_de_costos"],
							"nombre_cliente"=>$var["nombre_cliente"],
							"direccion"=>$var["direccion"],
							"pais"=>$var["pais"],
							"identificacion_empresa"=>$var["identificacion_empresa"],
							"ciclo_de_produccion"=>$format_periodo_pago[0],
							"fecha_emision"=>$var["fecha_emision"],
							"total_num_tokens"=>$var["total_tokens"],
							"total_facturado_dolar"=>$var["total_dolares_sin_formato"],
							"trm"=>$var["trm"],
							"sutotal_pesos_facturados"=>"0",
							"total_facturado_pesos"=>"0",
							"iva"=>"0",
							"bancos"=>json_encode(array(	"dolares_banco"=>(isset($var["dolares_banco"]))?$var["dolares_banco"]:'',
															"cuenta_banco"=>(isset($var["cuenta_banco"]))?$var["cuenta_banco"]:'',
															"total_tokens_x_banco"=>(isset($var["total_tokens_x_banco"]))?$var["total_tokens_x_banco"]:'',
															"total_dolares_x_banco"=>(isset($var["total_dolares_x_banco"]))?$var["total_dolares_x_banco"]:'',
														)),
							"items"=>json_encode(array(	"abreviacion"=>$var["abreviacion"], 
														"format_periodo_pago"=>$var["format_periodo_pago"],
														"nickname"=>$var["nickname"],
														"nickname_id"=>$var["nickname_id"],
														"id_master"=>$var["id_master"],
														"master_nombre"=>$var["master_nombre"],
														"id_modelo"=>$var["id_modelo"],
														"modelo_primer_nombre"=>$var["modelo_primer_nombre"],
														"modelo_segundo_nombre"=>$var["modelo_segundo_nombre"],
														"modelo_primer_apellido"=>$var["modelo_primer_apellido"],
														"modelo_segundo_apellido"=>$var["modelo_segundo_apellido"],
														"modelo_identificacion"=>$var["modelo_identificacion"],
														"total_dolar_sin_formato"=>$var["total_dolar_sin_formato"],
														"equivalencia"=>$var["equivalencia"],
														"tokens"=>$var["tokens"],
														"tokens"=>$var["tokens"],
														"total_dolar"=>$var["total_dolar"])));
		
		//pre($insert);return;
		if($this->db->insert($tabla,$insert)){
			$consecutivo	=	consecutivo($this->user->id_empresa,"comprobante_factura_venta");
			$lastid 		= 	$this->db->insert_id();
			$total_dolares_sin_formato=$var["total_dolares_sin_formato"]/2;
			$inser_contable	=	array(	"id_empresa"=>$this->user->id_empresa,
										"centro_de_costos"=>$this->user->centro_de_costos,
										"consecutivo"=>$consecutivo,
										"codigo_contable"=>"414580",
										"tipo_documento"=>"Factura Venta",
										"pref_nro_documento"=>"NOA",
										"nro_documento"=>$lastid,
										"tercero"=>$var["nombre_cliente"],
										"tokens"=>$var["total_tokens"],
										"valor_tokens"=>$var["equivalencia"][0],
										"usd"=>$var["total_dolares"],
										"trm"=>$var["trm"],
										"debito"=>"0.00",
										"credito"=>$total_dolares_sin_formato
			 							);
			
			registro_contable($inser_contable);
			
			
			foreach($var['nickname'] as $k => $v){
				$resutlado_total_dolar_sin_formato[$k]	=	$var["total_dolar_sin_formato"][$k] /2;
				$inser_contable	=	array(	"id_empresa"=>$this->user->id_empresa,
											"centro_de_costos"=>$this->user->centro_de_costos,
											"consecutivo"=>$consecutivo,
											"codigo_contable"=>"281505",
											"tipo_documento"=>"Factura Venta",
											"pref_nro_documento"=>"NOA",
											"nro_documento"=>$lastid,
											"tercero"=>	$var["modelo_primer_nombre"][$k]. ' ' . $var["modelo_segundo_nombre"][$k].' '.$var["modelo_primer_apellido"][$k].' '.$var["modelo_segundo_apellido"][$k],
											"tokens"=>$var["tokens"][$k],
											"valor_tokens"=>$var["equivalencia"][$k],
											"usd"=>$var["total_dolar"][$k],
											"trm"=>$var["trm"],
											"debito"=>"0.00",
											"credito"=>$resutlado_total_dolar_sin_formato[$k]
											);
				registro_contable($inser_contable);	
				//pre($inser_contable);return;
			}
			$inser_contable	=	array(	"id_empresa"=>$this->user->id_empresa,
										"centro_de_costos"=>$this->user->centro_de_costos,
										"consecutivo"=>$consecutivo,
										"codigo_contable"=>"130510",
										"tipo_documento"=>"Factura Venta",
										"pref_nro_documento"=>"NOA",
										"nro_documento"=>$lastid,
										"tercero"=>$var["nombre_cliente"],
										"tokens"=>$var["total_tokens"],
										"valor_tokens"=>$var["equivalencia"][0],
										"usd"=>$var["total_dolares"],
										"trm"=>$var["trm"],
										"debito"=>$var["total_dolares_sin_formato"],
										"credito"=>"0.00"
			 							);
			registro_contable($inser_contable);
			return true;	
		}else{
			return false;	
		}
	}
	
	public function get_reporte_x_pagina($centro_de_costos){
		/*PROCESAR SEGÚN TIPO DE SUCURSAL*/	
		$sql					=	"	SELECT t1.pagina,t3.Nit,t3.Nombre_legal,t3.Direccion,t3.Ciudad,t3.Departamento,t3.Pais,t3.cliente_id
											FROM ".DB_PREFIJO."rp_tmp t1
												LEFT JOIN ".DB_PREFIJO."usuarios t2 ON t1.centro_de_costos=t2.user_id
												LEFT JOIN ".DB_PREFIJO."sys_paginas_webcam t3 ON t1.pagina = t3.Pagina												
											 	WHERE t1.id_empresa = '".$this->user->id_empresa."'";
		$sql					.=	"				AND t1.centro_de_costos = '".$centro_de_costos."'
														GROUP BY t1.pagina";		
		$sql					.=	"						ORDER BY t1.pagina";	
		
		$query 						= 	$this->db->query($sql);
		return	$query->result();
		//pre($this->result);																
	}
	
	public function get_reporte_x_pagina_detallado($centro_de_costos,$pagina){
		/*PROCESAR SEGÚN TIPO DE SUCURSAL*/	
		$sql					=	"	SELECT SUM(t1.tokens) AS tokens, 
												t1.nickname,
												t1.id_empresa,
												t1.centro_de_costos,
												t1.pagina,
												t1.mes,
												t1.periodo_pagos,
												t1.equivalencia,
												t1.moneda_de_pago,
												t1.tipo_persona,
												t2.abreviacion,
												t3.equivalencia,
												t3.user_id as id_plataforma
											FROM ".DB_PREFIJO."rp_tmp t1
												LEFT JOIN ".DB_PREFIJO."usuarios t2 ON t1.centro_de_costos=t2.user_id
												LEFT JOIN ".DB_PREFIJO."usuarios t3 ON t1.pagina = t3.primer_nombre
											 	WHERE t1.id_empresa = '".$this->user->id_empresa."'";
		$sql					.=	"				AND t1.centro_de_costos = '".$centro_de_costos."'
													AND t1.pagina = '".$pagina."'
														GROUP BY t1.pagina,t1.nickname";		
		$sql					.=	"						ORDER BY t1.pagina";	
		
		$query 						= 	$this->db->query($sql);
		return	$query->result();
		//pre($this->result);																
	}
	
	public function get_registro_contable($centro_de_costos,$pagina){
		/*PROCESAR SEGÚN TIPO DE SUCURSAL*/	
		$sql					=	"	SELECT SUM(t1.tokens) AS tokens, 
												t1.nickname,
												t1.id_empresa,
												t1.centro_de_costos,
												t1.pagina,
												t1.mes,
												t1.periodo_pagos,
												t1.equivalencia,
												t1.moneda_de_pago,
												t1.tipo_persona,
												t2.abreviacion,
												t3.equivalencia,
												t3.user_id as id_plataforma
											FROM ".DB_PREFIJO."rp_tmp t1
												LEFT JOIN ".DB_PREFIJO."usuarios t2 ON t1.centro_de_costos=t2.user_id
												LEFT JOIN ".DB_PREFIJO."usuarios t3 ON t1.pagina = t3.primer_nombre
											 	WHERE t1.id_empresa = '".$this->user->id_empresa."'";
		$sql					.=	"				AND t1.centro_de_costos = '".$centro_de_costos."'
													AND t1.pagina = '".$pagina."'
														GROUP BY t1.pagina,t1.nickname";		
		$sql					.=	"						ORDER BY t1.pagina";	
		
		$query 						= 	$this->db->query($sql);
		return	$query->result();
		//pre($this->result);																
	}

	public function get_diario($desde=false , $hasta=false){
		$tabla				=		DB_PREFIJO."rp_diario t1";
		$this->db->select("*");
		$this->db->from($tabla);
		$this->db->where("t1.id_empresa",$this->user->id_empresa);
		$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
		$this->db->where('t1.id_modelo', $this->user->user_id);
		if($desde && $hasta){
			$this->db->where('t1.fecha BETWEEN "'. date('Y-m-d', strtotime($desde)). '" AND "'. date('Y-m-d', strtotime($hasta)).'"');
		}
		$this->db->group_by(array("fecha"));
		$this->db->order_by('t1.fecha','DESC');
		$this->db->limit(15);	
		$query						=	$this->db->get();
		$this->result			 	=	$query->result();
	}
	
	public function get_quicena(){
		$tabla				=		DB_PREFIJO."cf_ciclos_pagos t1";
		$this->db->select("*");
		$this->db->from($tabla);
		$this->db->where("id_empresa",$this->user->id_empresa);
		//$this->db->or_where("centro_de_costos",$this->user->centro_de_costos);
		$this->db->group_by(array("centro_de_costos", "mes"));
		$this->db->order_by('fecha_desde','ASC');
		$this->db->limit(ELEMENTOS_X_PAGINA,$this->Reportes->pagination);		
		$query			=	$this->db->get();
		$this->result 	=	$query->result();
		$this->total_rows= $this->total_filas($tabla);return;
	}
	
	public function get_detalle($fecha){
		$tabla				=		DB_PREFIJO."rp_diario t1";
		$this->db->select("*");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."usuarios t2", 't1.id_plataforma		=	t2.user_id', 'left');
		$this->db->join(DB_PREFIJO."cf_nickname t3", 't1.nickname_id	=	t3.nickname_id', 'left');
		$this->db->where("t1.id_empresa",$this->user->id_empresa);
		$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
		$this->db->where('t1.id_modelo', $this->user->user_id);
		$this->db->where('t1.fecha', $fecha);
		$this->db->order_by('t1.fecha','DESC');
		$query						=	$this->db->get();
		return $query->result();		
	}
	
	public function get_total_produccion($desde,$hasta){
		$tabla				=		DB_PREFIJO."rp_diario t1";
		$this->db->select("SUM(monto) as Total");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."usuarios t2", 't1.id_plataforma		=	t2.user_id', 'left');
		$this->db->join(DB_PREFIJO."cf_nickname t3", 't1.nickname_id	=	t3.nickname_id', 'left');
		$this->db->where("t1.id_empresa",$this->user->id_empresa);
		$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
		$this->db->where('t1.id_modelo', $this->user->user_id);
		$this->db->where('t1.fecha BETWEEN "'. date('Y-m-d', strtotime($desde)). '" AND "'. date('Y-m-d', strtotime($hasta)).'"');
		$query						=	$this->db->get();
		$total						=	($query->row()->Total)?$query->row()->Total:'--';
		return $total;		
	}
	
	public function get_total_tokens($desde,$hasta){
		$tabla				=		DB_PREFIJO."rp_diario t1";
		$this->db->select("SUM(tokens) as Total");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."usuarios t2", 't1.id_plataforma		=	t2.user_id', 'left');
		$this->db->join(DB_PREFIJO."cf_nickname t3", 't1.nickname_id	=	t3.nickname_id', 'left');
		$this->db->where("t1.id_empresa",$this->user->id_empresa);
		$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
		$this->db->where('t1.id_modelo', $this->user->user_id);
		$this->db->where('t1.fecha BETWEEN "'. date('Y-m-d', strtotime($desde)). '" AND "'. date('Y-m-d', strtotime($hasta)).'"');
		$query						=	$this->db->get();
		$total						=	($query->row()->Total)?$query->row()->Total:'--';
		return $total;		
	}
	
	public function get_quicena_detalle($id_plataforma){
		$tabla				=		DB_PREFIJO."rp_diario t1";
		$this->db->select("*");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."usuarios t2", 't1.id_plataforma		=	t2.user_id', 'left');
		$this->db->join(DB_PREFIJO."cf_nickname t3", 't1.nickname_id	=	t3.nickname_id', 'left');
		$this->db->where("t1.id_empresa",$this->user->id_empresa);
		$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
		$this->db->where('t1.id_modelo', $this->user->user_id);
		$this->db->where('t1.id_plataforma', $id_plataforma);
		$this->db->order_by('t1.fecha','DESC');
		$query						=	$this->db->get();
		return $query->result();		
	}
	
	public function get_facturas($id=NULL){
		$tabla				=		DB_PREFIJO."rp_factura t1";
		$this->db->select("*,t2.Ciudad");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."sys_paginas_webcam t2", 't1.nombre_cliente		=	t2.	Nombre_legal', 'left');
		$this->db->where("t1.type",1);
		$this->db->where("t1.id_empresa",$this->user->id_empresa);
		if($this->user->principal<>1){$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);}
		if($id!=NULL){$this->db->where('t1.nro_documento', $id);}
		$this->db->group_by(array("nro_documento"));
		$this->db->order_by('t1.nro_documento','DESC');
		$query						=	$this->db->get();

		if($id!=NULL){
			$this->result			=	$query->row();	
			$this->result->items	=	Procesador_factura($id);
		}else{
			$this->result				=	$query->result();	
		}
		return $this->result;
	}
	
	public function get_facturas2($id=NULL){
		$tabla				=		DB_PREFIJO."rp_factura t1";
		$this->db->select("*,t2.Ciudad");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."sys_paginas_webcam t2", 't1.nombre_cliente		=	t2.	Nombre_legal', 'left');
		$this->db->where("t1.id_empresa",$this->user->id_empresa);
		$this->db->where("t1.type",2);
		if($this->user->principal<>1){$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);}
		if($id!=NULL){$this->db->where('t1.nro_documento', $id);}
		$this->db->group_by(array("nro_documento"));
		$this->db->order_by('t1.nro_documento','DESC');
		$query						=	$this->db->get();

		if($id!=NULL){
			$this->result			=	$query->row();	
			$this->result->items	=	Procesador_factura($id);
		}else{
			$this->result				=	$query->result();	
			//$this->result->items		=	Procesador_factura($id);
		}
		return $this->result;
	}
	
	public function setInformePlano(){
		ini_set('memory_limit', '1024M');
		set_time_limit(600);
		$tabla						=	DB_PREFIJO."rp_tmp";
		$var						=	post();
		$var['centro_de_costos']	=	$this->user->centro_de_costos;
		$var['id_empresa']			=	$this->user->id_empresa;
		$var['id_modelo']			=	$this->user->user_id;
		$var['fecha_enviado']		=	date("Y-m-d H:i:s");
		$return						=	false;
		if(isset($_FILES['userfile'])&& !empty($_FILES['userfile'])){
			$var['adjunto']	=	upload('userfile',$path='images/uploads/',array("allowed_types"=>'xls|xlsx|xlm',"max_size"=>300000));
		}
		if(!empty($var['adjunto']['error'])){
			print_r($var['adjunto']['error']);
			phpinfo();return;
			return;
		}

		$this->db->where('id_empresa', $this->user->id_empresa);
		//$this->db->where('centro_de_costos', $this->user->centro_de_costos);
		$this->db->where('mes', post("mes"));
		$this->db->where('periodo_pagos', post("periodo_pagos"));
		
		$this->db->delete($tabla);
		
		require_once(PATH_APP.'third_party/PHPExcel/PHPExcel.php');
		require_once(PATH_APP.'third_party/PHPExcel/PHPExcel/Reader/Excel2007.php');
		$file			=	$var['adjunto']['upload_data']['full_path'];
		$objReader 		= 	new PHPExcel_Reader_Excel2007();
		$objPHPExcel 	= 	$objReader->load($file);
		$rows 			= 	$objPHPExcel->getActiveSheet()->getHighestRow();
		
		$sql 			= 	array();
		$letras = array(
			"A","B","C","D"
		);
		
		$fields_table		=		array("Pagina","Nickname","Tokens");
		
		//recorremos el excel y creamos un array para después insertarlo en la base de datos
		$centro_de_costos=array();
		for($i = 2;$i <= $rows; $i++){
		//ahora recorremos los campos del formulario para ir creando el array de forma dinámica
		
			/* lo oculto porque s está probando otra forma de buscar los ceentro de costos*/
			$centro_de_costos[$i]					=	$this->db->select("id_empresa,user_id")
																	->from(DB_PREFIJO.'usuarios')
																	->where('abreviacion',$objPHPExcel->getActiveSheet()->getCell("D".$i)->getCalculatedValue())
																	->get()
																	->row();																	
															
			$sql[$i]["pagina"] 						= 	$objPHPExcel->getActiveSheet()->getCell("A".$i)->getCalculatedValue();
			$sql[$i]["Nickname"] 					= 	$objPHPExcel->getActiveSheet()->getCell("B".$i)->getCalculatedValue();
			$sql[$i]["Tokens"] 						= 	$objPHPExcel->getActiveSheet()->getCell("C".$i)->getCalculatedValue();
			$sql[$i]["id_empresa"]					=	$this->user->id_empresa;
			$nickname								=	nickname_like_name($objPHPExcel->getActiveSheet()->getCell("B".$i)->getCalculatedValue(),$objPHPExcel->getActiveSheet()->getCell("A".$i)->getCalculatedValue());
			
			
			if(empty($nickname)){
				$centro_de_costos_id				=	0;	
			}else{
				$centro_de_costos_id				=	$nickname->centro_de_costos;		
			}
			$sql[$i]["centro_de_costos"]			=	$centro_de_costos_id;
			$sql[$i]["mes"]							=	post("mes");
			$sql[$i]["periodo_pagos"]				=	post("periodo_pagos");
			$sql[$i]["equivalencia"]				=	post("equivalencia");
			$sql[$i]["moneda_de_pago"]				=	post("moneda_de_pago");
			$sql[$i]["tipo_persona"]				=	post("tipo_persona");
			$this->db->insert($tabla,$sql[$i]);
		}   
		
		
		//$this->db->insert_batch($tabla, $sql);
		unlink($file);
		return true;
		//echo '<pre>';	print_r($sql);	echo '</pre>';
		
	}
	
	public function get_ResultadoImport(){
		
		if($this->uri->segment(3)==''){
			$sql					=	"	SELECT SUM(tokens) AS tokens, nickname,id_empresa,centro_de_costos,pagina,mes,periodo_pagos,equivalencia,moneda_de_pago,tipo_persona
												FROM ".DB_PREFIJO."rp_tmp t1
													WHERE id_empresa = '".$this->user->id_empresa."'
														AND t1.centro_de_costos = '".$this->user->centro_de_costos."'
															GROUP BY pagina,nickname
																ORDER BY tokens
												        			LIMIT 500 ";
			$sql					=	"	SELECT SUM(tokens) AS tokens, nickname,id_empresa,t1.centro_de_costos,pagina,mes,periodo_pagos,equivalencia,moneda_de_pago,tipo_persona											
												FROM ".DB_PREFIJO."rp_tmp t1
													WHERE t1.id_empresa = '".$this->user->id_empresa."'
														AND t1.centro_de_costos = '".$this->user->centro_de_costos."'
															GROUP BY pagina,nickname
																ORDER BY pagina
												        			LIMIT 200000 ";	
			if($this->user->principal==1){																	
			$sql					=	"	SELECT SUM(t1.tokens) AS tokens, 
												t1.nickname,
												t1.id_empresa,
												t1.centro_de_costos,
												t1.pagina,
												t1.mes,
												t1.periodo_pagos,
												t1.equivalencia,
												t1.moneda_de_pago,
												t1.tipo_persona,
												t2.abreviacion											
													FROM ".DB_PREFIJO."rp_tmp t1
														LEFT JOIN ".DB_PREFIJO."usuarios t2 ON t1.centro_de_costos=t2.user_id 
															WHERE t1.id_empresa = '".$this->user->id_empresa."'
																GROUP BY t1.pagina,t1.nickname
																	ORDER BY t1.pagina
											        					LIMIT 200000 ";																																		
			}
		}else if($this->uri->segment(3)=='Debug' && $this->uri->segment(4)=='1'){
			$sql					=	"	SELECT 	SUM(t1.tokens) AS tokens,
													t1.nickname,
													t1.id_empresa,
													t1.centro_de_costos,
													t1.pagina,
													t1.mes,
													t1.periodo_pagos,
													t1.equivalencia,
													t1.moneda_de_pago,
													t1.tipo_persona,
													t2.abreviacion												
												FROM ".DB_PREFIJO."rp_tmp t1
													LEFT JOIN ".DB_PREFIJO."usuarios t2 ON t1.centro_de_costos=t2.user_id 
													WHERE t1.id_empresa = '".$this->user->id_empresa."'
														AND t1.centro_de_costos = '".$this->user->centro_de_costos."'
															GROUP BY pagina
																ORDER BY pagina
												        			LIMIT 200000 ";
			if($this->user->principal==1){
			$sql					=	"	SELECT SUM(t1.tokens) AS tokens, 
													t1.nickname,
													t1.id_empresa,
													t1.centro_de_costos,
													t1.pagina,
													t1.mes,
													t1.periodo_pagos,
													t1.equivalencia,
													t1.moneda_de_pago,
													t1.tipo_persona,
													t2.abreviacion	
												FROM ".DB_PREFIJO."rp_tmp t1
													LEFT JOIN ".DB_PREFIJO."usuarios t2 ON t1.centro_de_costos=t2.user_id 
													WHERE t1.id_empresa = '".$this->user->id_empresa."'
														GROUP BY pagina
															ORDER BY pagina
																LIMIT 200000 ";																	
			}
		}else if($this->uri->segment(3)=='Debug' && $this->uri->segment(4)=='2'){
			$sql					=	"	SELECT 	SUM(t1.tokens) AS tokens, 
													t1.nickname,
													t1.id_empresa,
													t1.centro_de_costos,
													t1.pagina,
													t1.mes,
													t1.periodo_pagos,
													t1.equivalencia,
													t1.moneda_de_pago,
													t1.tipo_persona,
													t2.abreviacion
													FROM ".DB_PREFIJO."rp_tmp t1
													LEFT JOIN ".DB_PREFIJO."usuarios t2 ON t1.centro_de_costos=t2.user_id 
														WHERE t1.id_empresa = '".$this->user->id_empresa."'
															AND t1.centro_de_costos = '".$this->user->centro_de_costos."'
																GROUP BY pagina,nickname
																	ORDER BY pagina
												        				LIMIT 200000 ";
			if($this->user->principal==1){
			$sql					=	"	SELECT SUM(t1.tokens) AS tokens, 
													t1.nickname,
													t1.id_empresa,
													t1.centro_de_costos,
													t1.pagina,
													t1.mes,
													t1.periodo_pagos,
													t1.equivalencia,
													t1.moneda_de_pago,
													t1.tipo_persona,
													t2.abreviacion as abreviacion2,
													t4.abreviacion,
													t3.centro_de_costos as centro_de_costos2											
												FROM ".DB_PREFIJO."rp_tmp t1
												LEFT JOIN ".DB_PREFIJO."usuarios t2 ON t1.centro_de_costos=t2.user_id 
												INNER JOIN ".DB_PREFIJO."cf_nickname t3 ON t1.nickname=t3.nickname 
												LEFT JOIN ".DB_PREFIJO."usuarios t4 ON t3.centro_de_costos=t4.user_id 
													WHERE t1.id_empresa = '".$this->user->id_empresa."'
														GROUP BY pagina,nickname
															ORDER BY pagina
											        			LIMIT 200000 ";
			}
		}else if($this->uri->segment(3)=='Debug' && $this->uri->segment(4)=='3'){
			$sql					=	"	SELECT 	SUM(t1.tokens) AS tokens, 
													t1.nickname,
													t1.id_empresa,
													t1.centro_de_costos,
													t1.pagina,
													t1.mes,
													t1.periodo_pagos,
													t1.equivalencia,
													t1.moneda_de_pago,
													t1.tipo_persona,
													t2.abreviacion	
													FROM ".DB_PREFIJO."rp_tmp t1
													LEFT JOIN ".DB_PREFIJO."usuarios t2 ON t1.centro_de_costos=t2.user_id 
														WHERE t1.id_empresa = '".$this->user->id_empresa."'
															AND t1.centro_de_costos = '".$this->user->centro_de_costos."'
																GROUP BY pagina,nickname
																	ORDER BY pagina
												        				LIMIT 200000 ";
			if($this->user->principal==1){
			$sql					=	"	SELECT 	SUM(t1.tokens) AS tokens, 
													t1.nickname,
													t1.id_empresa,
													t1.centro_de_costos,
													t1.pagina,
													t1.mes,
													t1.periodo_pagos,
													t1.equivalencia,
													t1.moneda_de_pago,
													t1.tipo_persona,
													t2.abreviacion	
												FROM ".DB_PREFIJO."rp_tmp t1
													LEFT JOIN ".DB_PREFIJO."usuarios t2 ON t1.centro_de_costos=t2.user_id 
													WHERE t1.id_empresa = '".$this->user->id_empresa."'
														GROUP BY t1.pagina,t1.nickname
															ORDER BY t1.pagina
											        			LIMIT 200000 ";
			}
		}else if($this->uri->segment(3)=='Debug' && $this->uri->segment(4)=='4'){
			$sql					=	"	SELECT SUM(tokens) AS tokens, nickname,id_empresa,t1.centro_de_costos,pagina,mes,periodo_pagos,equivalencia,moneda_de_pago,tipo_persona 
												FROM `".DB_PREFIJO."rp_tmp` 
													WHERE t1.id_empresa = '".$this->user->id_empresa."'
														AND t1.centro_de_costos = '".$this->user->centro_de_costos."'
															GROUP BY pagina,nickname
			    												ORDER BY pagina
        															LIMIT 200000";
			if($this->user->principal==1){																	
			$sql					=	"	SELECT SUM(tokens) AS tokens, 
													nickname,
													id_empresa,
													centro_de_costos,
													pagina,
													mes,
													periodo_pagos,
													equivalencia,
													moneda_de_pago,
													tipo_persona 
												FROM `".DB_PREFIJO."rp_tmp` t1 
													WHERE t1.id_empresa = '".$this->user->id_empresa."'
														GROUP BY pagina,nickname
		    												ORDER BY pagina
       															LIMIT 200000";																	
			}
		}
		
		$query 						= 	$this->db->query($sql);
		$this->result				=	$query->result();
		
		if($this->uri->segment(3)=='Debug' && $this->uri->segment(4)=='1' && 1==3){
			$inser_array=null;
			foreach($this->result as $k => $v){
				$row	=	$this->db->select("user_id")->from(DB_PREFIJO.'usuarios')->where('type','Plataformas')->like('primer_nombre',$v->pagina)->get()->row();
				if(empty($row)){
					
					$inser_array[]	=	array(	"type"				=>	"Plataformas",
												"rol_id"				=>	0,	
												"primer_nombre"		=>	$v->pagina,	
												"equivalencia"		=>	$v->equivalencia,	
												"moneda_de_pago"	=>	$v->moneda_de_pago,	
												"id_empresa"		=>	$this->user->id_empresa,	
												"centro_de_costos"	=>	$this->user->centro_de_costos,
												"tipo_persona"		=>	$v->tipo_persona,
												"nombre_legal"		=>	"PERFIL IMPORTADO",
												"password"			=>	$v->pagina	
											);
				}
			}
			if(is_array($inser_array)){
				$this->db->insert_batch(DB_PREFIJO.'usuarios', $inser_array);
			}
			$row	=	$this->db->select("*")
							->from(DB_PREFIJO.'usuarios')
							->where('type','Plataformas')
							->get()
							->result();
			$insert_array	=	"";
			foreach($row as $k => $v){
				$check			=	$this->db->select("rel_plataforma_id")
										->from(DB_PREFIJO.'cf_rel_plataformas')
										->where('id_empresa',$this->user->id_empresa)
										->where('centro_de_costos',$this->user->centro_de_costos)
										->where('id_plataforma',$v->user_id)
										->get()
										->row();
				if(empty($check)){						
					$inser_array[]	=	array(	"id_empresa"		=>	$this->user->id_empresa,	
												"centro_de_costos"	=>	$this->user->centro_de_costos,
												"id_plataforma"		=>	$v->user_id
											);
				}
			}
			if(is_array($inser_array)){
				$this->db->insert_batch(DB_PREFIJO.'cf_rel_plataformas', $inser_array);
			}				
		}
		
		if($this->uri->segment(3)=='Debug' && $this->uri->segment(4)=='3'){
			
			$inser_array=null;
			foreach($this->result as $k => $v){
				$user	=	$this->db->select("user_id")->from(DB_PREFIJO.'usuarios')->where('type','Plataformas')->like('primer_nombre',$v->pagina)->get()->row();
				$row	=	$this->db->select("*")->from(DB_PREFIJO.'cf_nickname')->like('nickname',$v->nickname)->get()->row();	
				if(empty($row)){
					$inser_array[]	=	array(	"id_empresa"		=>	$this->user->id_empresa,	
												"centro_de_costos"	=>	$this->user->centro_de_costos,
												"id_plataforma"		=>	$user->user_id,
												"id_modelo"			=>	0,
												"id_master"			=>	0,
												"estado"			=>	0,
												"password"			=>	0,
												"nickname"			=>	$v->nickname
											);
				}
				
			}
			//pre($inser_array);return;
			if(is_array($inser_array)){
				$this->db->insert_batch(DB_PREFIJO.'cf_nickname', $inser_array);
			}	
			
		}
		
		if($this->uri->segment(3)=='Debug' && $this->uri->segment(4)=='4'){
			
			$inser_array=null;
			$iinc=0;
			foreach($this->result as $k => $v){
				$row	=	$this->db->select("*")
								->from(DB_PREFIJO.'rp_archivoplano')
								->where('pagina',$v->pagina)
								->where('nickname',$v->nickname)
								->where('id_empresa',$v->id_empresa)
								->where('centro_de_costos',$v->centro_de_costos)
								->where('mes',$v->mes)
								->where('periodo_pagos',$v->periodo_pagos)
								->get()->row();	
				if(empty($row)){
					$inser_array[$iinc]["pagina"] 					= 	$v->pagina;
					$inser_array[$iinc]["nickname"] 				= 	$v->nickname;
					$inser_array[$iinc]["tokens"] 					= 	$v->tokens;
					$inser_array[$iinc]["id_empresa"]				=	$this->user->id_empresa;
					$inser_array[$iinc]["centro_de_costos"]			=	$this->user->centro_de_costos;
					$inser_array[$iinc]["mes"]						=	$v->mes;
					$inser_array[$iinc]["periodo_pagos"]			=	$v->periodo_pagos;
					$inser_array[$iinc]["equivalencia"]				=	$v->equivalencia;
					$inser_array[$iinc]["moneda_de_pago"]			=	$v->moneda_de_pago;
					$inser_array[$iinc]["tipo_persona"]				=	$v->tipo_persona;
				}
				$iinc++;
			}
			//pre($inser_array);return;
			if(is_array($inser_array)){
				//$this->db->insert_batch(DB_PREFIJO.'rp_archivoplano', $inser_array);
			}	
			
		}
	}
	
	public function setNovedad(){
		$tabla						=	DB_PREFIJO."rp_novedades";
		$var						=	post();
		$var['centro_de_costos']	=	$this->user->centro_de_costos;
		$var['id_empresa']			=	$this->user->id_empresa;
		$var['id_modelo']			=	$this->user->user_id;
		$var['fecha_enviado']		=	date("Y-m-d H:i:s");
		$return						=	false;
		//print_r($var);	return;
		if(isset($_FILES['userfile'])){
			$var['adjunto']	=	json_encode(upload(post(),$path='images/uploads/'));
		}
		
		if(isset($var['redirect'])){
			unset($var['redirect']);	
		}
		
		if($this->db->insert($tabla,$var)){
			$return				=	true;
			$insert_id			=	$this->db->insert_id();
			logs($this->user,1,$tabla,$insert_id,$tabla,"1",$var);
		}else{
			$return				=	false;	
		}
		return $return;
	}
	
	public function setAddDiario(){
		$tabla						=	DB_PREFIJO."rp_diario";
		$var['centro_de_costos']	=	$this->user->centro_de_costos;
		$var['id_empresa']			=	$this->user->id_empresa;
		$var['id_modelo']			=	$this->user->user_id;
		$var['fecha']				=	date("Y-m-d");
		$post						=	post();
		$return						=	false;
		
		if(isset($var['redirect'])){
			unset($var['redirect']);	
		}
		
		if(isset($var['reporte_diario_id'])&& !empty($var['reporte_diario_id'])){
			
			$id					=		array("reporte_diario_id",$var['reporte_diario_id']);
			$this->db->where($id[0], $id[1]);
			if($this->db->update($tabla,$var)){
				logs($this->user,2,$tabla,$id[1],$tabla,"1",$var);
				return $var['reporte_diario_id'];	
			}else{
				logs($this->user,2,$tabla,$id[1],$tabla,"0",$var);
				return false;	
			}
		}else{
			$array_sum	=	array_sum($post['monto']);
			foreach(post("nickname_id") as $k => $v){
				if($post['monto'][$k]>0){
				
				$insert		=	array(	"id_empresa"		=>	$var['id_empresa'],
										"centro_de_costos"	=>	$var['centro_de_costos'],
										"id_modelo"			=>	$var['id_modelo'],
										"id_plataforma"		=>	$post['id_plataforma'][$k],
										"nickname_id"		=>	$post['nickname_id'][$k],
										"monto"				=>	$post['monto'][$k],
										"tokens"			=>	$post['tokens'][$k],
										"total"				=>	$array_sum,
										"fecha"				=>	$post['fecha'],
										"estado"			=>	1);
					if($this->db->insert($tabla,$insert)){
						$return				=	true;
						$insert_id			=	$this->db->insert_id();
						logs($this->user,1,$tabla,$insert_id,$tabla,"1",$var);
					}else{
						$return				=	false;	
					}
				}
			}
		}
		return $return;
	}
	
	public function set_cuenta_contable($var){
		$row						=	$this->db->select("SUM(credito) as credito, SUM(debito) as debito,tercero")
										->from(DB_PREFIJO.'rp_operaciones')
										->where('nro_documento',$var['nro_documento'])
										->get()->row();	
		if($row->credito>=$var['credito'] && $row->debito>=$var['debito']){								
			$cliente					=	get_paginas_webcam($var['cliente_id']);
			$inser_contable				=	array(	"id_empresa"=>$var['id_empresa'],
													"centro_de_costos"=>$var['centro_de_costos'],
													"codigo_contable"=>"111010",
													"tipo_documento"=>"Ingreso Bancario",
													"pref_nro_documento"=>"NOA",
													"cliente_id"=>$var['cliente_id'],
													"nro_documento"=>$var['nro_documento'],
													"tercero"=>$cliente->Nombre_legal,
													"id_modelo"=>NULL,
													"tokens"=>NULL,
													"valor_tokens"=>NULL,
													"usd"=>NULL,
													"trm"=>NULL,
													"porcentaje_modelo"=>NULL,	
													"debito"=>$var['debito'],
													"credito"=>0);
			registro_contable($inser_contable);
			$inser_contable				=	array(	"id_empresa"=>$var['id_empresa'],
													"centro_de_costos"=>$var['centro_de_costos'],
													"codigo_contable"=>"111010",
													"tipo_documento"=>"Ingreso Bancario",
													"pref_nro_documento"=>"NOA",
													"cliente_id"=>$var['cliente_id'],
													"nro_documento"=>$var['nro_documento'],
													"tercero"=>$cliente->Nombre_legal,
													"id_modelo"=>NULL,
													"tokens"=>NULL,
													"valor_tokens"=>NULL,
													"usd"=>NULL,
													"trm"=>NULL,
													"porcentaje_modelo"=>NULL,	
													"debito"=>0,
													"credito"=>$var['credito']);
			registro_contable($inser_contable);
		}
		return true;										
		
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