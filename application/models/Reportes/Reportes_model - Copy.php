<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reportes_model extends CI_Model {
	
	var $fields,$result,$where,$total_rows,$pagination,$search;

	public function setObservaciones(){
		$tabla				=		DB_PREFIJO."sys_observaciones";
		$this->db->select("observacion_id");
		$this->db->from($tabla);		
		$this->db->where("url",post("url"));
		$query=$this->db->get();
		$row=$query->row();	
		if(empty($row)){
			if($this->db->insert($tabla,array("url"=>post("url"),"observacion"=>post("observacion")))){	
				return true;
			}else{
				return array("error"=>array("message"=>"Lo siento, no ha sido modificado",
											"code"=>"203"));				
			}
		}else{
			$this->db->where("observacion_id",$row->observacion_id);	
			if($this->db->update($tabla,array("observacion"=>post("observacion")))){	
				return true;
			}else{
				return array("error"=>array("message"=>"Lo siento, no ha sido modificado",
											"code"=>"203"));				
			}			
		}
	}
	
	public function regPres(){
		$tabla				=		DB_PREFIJO."rp_presupuesto";
		$this->db->select("*");
		$this->db->from($tabla);
		if($this->uri->segment(3)){
			$this->db->where("id_presupuesto",$this->uri->segment(3));
		}		
		$query						=	$this->db->get();
		$this->result			 	=	$query->result();	
	}
	
	public function setPresupuesto($var){
		unset($var['contabilidad'],$var['contrapartida'],$var['descripcion2'],$var['gastos_id']);
		//pre($var);return;
		$var['user_id']				=	$this->user->user_id;
		$var['id_empresa']			=	$this->user->id_empresa;
		//$var['centro_de_costos']	=	$this->user->centro_de_costos;
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
	
	public function get_detalle_contable($id,$incluir,$tipo_documento){
		return $this->result	= 	detalle_contable($id,$incluir,$tipo_documento);
	}
	
	public function get_contable($id,$incluir,$tipo_documento){
		return detalle_contable($id,$incluir,$tipo_documento);
	}
	
	public function RP_Plataformas___($ciclo_produccion_id=''){
		$tabla		=	DB_PREFIJO."usuarios t1";
		$this->db->select("t1.primer_nombre,t1.user_id as plataforma_id");
		$this->db->from($tabla);
		$this->db->where("t1.type","Plataformas");
		$query	=	$this->db->get();
		$return	=	array();
		foreach($query->result() as $k => $v){
			$this->db->select("t2.primer_nombre,t2.primer_apellido,t2.user_id as modelo_id");
			$this->db->from(DB_PREFIJO."rp_operaciones t1");
			$this->db->join(DB_PREFIJO."usuarios t2", 't1.modelo_id=t2.user_id', 'left');
			$this->db->where("t1.empresa_id",$this->user->id_empresa);
			$this->db->where("t1.empresa_id",$this->user->id_empresa);
			if($ciclo_produccion_id!=''){
				$this->db->where("t1.ciclo_produccion_id",$ciclo_produccion_id);
			}
			$this->db->group_by("t1.modelo_id");
			$query	=	$this->db->get();
			$row	=	$query->result();
			foreach($row as $v2){
				if(!empty($v2->primer_nombre) && !empty($v2->primer_apellido)){
					$this->db->select("*");
					$this->db->from(DB_PREFIJO."rp_operaciones t1");
					$this->db->where("t1.empresa_id",$this->user->id_empresa);
					$this->db->where("t1.modelo_id",$v2->modelo_id);
					$query	=	$this->db->get();
					foreach($query->result() as $v3){
						$return[$v->primer_nombre][$v2->modelo_id][]	=	$v3;
					}
				}
			}
		}	
		$this->result	=	$return;
	}
	
	public function RP_Plataformas($ciclo_produccion_id=''){
		$tabla		=	DB_PREFIJO."usuarios t1";
		$this->db->select("t1.primer_nombre,t1.user_id as plataforma_id,t1.user_id");
		$this->db->from($tabla);
		$this->db->where("t1.type","Plataformas");
		$query	=	$this->db->get();
		$modelos=	$return	=	array();
		foreach($query->result() as $k => $v){
			$this->db->select("t2.primer_nombre,t2.primer_apellido,t2.user_id as modelo_id");
			$this->db->from(DB_PREFIJO."rp_operaciones t1");
			$this->db->join(DB_PREFIJO."usuarios t2", 't1.modelo_id=t2.user_id', 'left');
			$this->db->where("t1.empresa_id",$this->user->id_empresa);
			$this->db->where("t1.plataforma_id",$v->user_id);
			if($ciclo_produccion_id!=''){
				$this->db->where("t1.ciclo_produccion_id",$ciclo_produccion_id);
			}
			$this->db->group_by("t1.modelo_id");
			$query	=	$this->db->get();
			$row	=	$query->result();
			foreach($row as $v2){
				$modelos[$v->primer_nombre][$v2->modelo_id]	=	$v2	;
				if(!empty($v2->primer_nombre) && !empty($v2->primer_apellido)){
					$this->db->select("t1.*,t2.primer_nombre,t2.primer_apellido,t2.user_id as modelo_id,DAY(t1.fecha) as dia");
					$this->db->from(DB_PREFIJO."rp_operaciones t1");
					$this->db->join(DB_PREFIJO."usuarios t2", 't1.modelo_id=t2.user_id', 'left');
					$this->db->where("t1.empresa_id",$this->user->id_empresa);
					$this->db->where("t1.modelo_id",$v2->modelo_id);
					//$this->db->group_by("t1.modelo_id");
					$query	=	$this->db->get();
					foreach($query->result() as $v3){
						$return[$v->primer_nombre][$v2->modelo_id][]	=	$v3;
					}
				}
			}
		}	
		$this->result	=	array("data"=>$return,"modelos"=>$modelos);
	}
	
	public function RP_Modelos(){
		$trm		= 	get_cf_ciclos_pagos_new($this->user->id_empresa,0);	
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
			$this->db->select("	t1.id_plataforma,
								t1.id_modelo,
								t1.nickname_id,
								CONCAT(t2.primer_nombre,' ',t2.primer_apellido) as modelo,
								sum(tokens) as tokens,
								fecha");
			$this->db->from($tabla);
			$this->db->join(DB_PREFIJO."usuarios t2", 't2.user_id=t1.id_modelo', 'left');
			$this->db->where("t1.id_empresa",$this->user->id_empresa);	
			$this->db->where("t1.id_plataforma",$v->id_plataforma);	
			/*$this->db->where("t1.fecha>=",date("Y-m-").$trm->desde);				
			$this->db->where("t1.fecha<=",date("Y-m-").$trm->hasta);				*/
			$this->db->group_by(array("t1.id_modelo"));
			$query	=	$this->db->get();
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
							t2.moneda_de_pago,
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
							t7.nombre_master,
							t7.cuenta_id,
							t7.id_plataforma,
							t8.codigo_contable,
							t8.codigo_contable_subfijo");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."usuarios t2",'t1.Pagina=t2.primer_nombre','left');
		$this->db->join(DB_PREFIJO."cf_nickname t3",'t2.user_id=t3.id_plataforma','left');
		$this->db->join(DB_PREFIJO."usuarios t4",'t3.centro_de_costos=t4.user_id','left');
		$this->db->join(DB_PREFIJO."usuarios t5",'t3.id_modelo=t5.user_id','left');
		$this->db->join(DB_PREFIJO."usuarios t6",'t4.id_empresa=t6.user_id','left');
		$this->db->join(DB_PREFIJO."cf_rel_master t7",'t3.id_master=t7.rel_plataforma_id','left');
		$this->db->join(DB_PREFIJO."fi_cuentas t8",'t7.cuenta_id=t8.id_cuenta','left');		
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
		$totalidad_111010		=	0;
		$tipo_documento			=	5;
		$var["empresa_id"]		=	$this->user->id_empresa;
		$responsable_id			=	$this->user->user_id;
		$var['nro_documento']	=	$var['consecutivo'];
		$var['trm']				=	periodotrm(date("Y-m-d"));
		$consecutivo			=	consecutivo($var["empresa_id"],$tipo_documento);		
		$json					=	json_encode(post());
		
		foreach($var['procesador_id'] as $k => $v){
			if(str_replace(",",".",$var["credito"][$k])>0){			
				$inser_contable	=	array(	"responsable_id"=>$responsable_id,
											"consecutivo"=>$consecutivo,
											"empresa_id"=>$var["empresa_id"],
											"centro_de_costos"=>$var["centro_de_costos"],
											"nro_documento"=>$var['nro_documento'],
											"pref_nro_documento"=>"NOA",
											"tipo_documento"=>5,
											"codigo_contable"=>"130510",
											"ciclo_produccion_id"=>$var['ciclo_de_produccion'],
											"fecha"=>date("Y-m-d"),
											"procesador_id"=>$var["procesador_id"][$k],										
											"json"=>$json,
											"debito"=>"0.00",
											"credito"=> str_replace(",",".",$var["credito"][$k]));
				
				$this->db->insert(DB_PREFIJO."rp_operaciones",$inser_contable);
				//registro_contable($inser_contable);	
				$totalidad_111010			=	$totalidad_111010 +	str_replace(",",".",$var["credito"][$k]);
				
				$inser_contable	=	array(		"responsable_id"=>$responsable_id,
												"consecutivo"=>$consecutivo,
												"empresa_id"=>$var["empresa_id"],
												"centro_de_costos"=>$var["centro_de_costos"],
												"nro_documento"=>$var['nro_documento'],
												"pref_nro_documento"=>"NOA",
												"tipo_documento"=>5,
												"codigo_contable"=>$var['procesador_codigo_contable'][$k],
												"codigo_contable_subfijo"=>$var['procesador_codigo_contable_subfijo'][$k],
												"ciclo_produccion_id"=>$var['ciclo_de_produccion'],
												"fecha"=>date("Y-m-d"),
												"procesador_id"=>$v,										
												"json"=>$json,
												"debito"=>str_replace(",",".",$var["credito"][$k]),
												"credito"=> "0.00");
					registro_contable($inser_contable);	
			}
		}
		incrementa_consecutivo($var["empresa_id"],$tipo_documento);
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
		//$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
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
												t1.Pagina as pagina,
												t1.periodo_pagos,
												t1.centro_de_costos
											FROM ".DB_PREFIJO."rp_tmp t1
											 	WHERE t1.id_empresa = '".$this->user->id_empresa."'";
		if($user->principal<>1){											
			$sql				.=	"				AND t1.centro_de_costos = '".$this->user->centro_de_costos."'";
		}
		$sql					.=	"					GROUP BY t1.centro_de_costos
															ORDER BY t1.reporte_archivo_plano_id";	
		
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
	
	public function MakeFactura2($var){	
		$ciclo_informacion=get_cf_ciclos_pagos_new($this->user->id_empresa,0);
		$tipo_documento=8;
		$campos_tabla["empresa_id"]=$this->user->id_empresa;
		$campos_tabla["fecha"]=date("Y-m-d");
		$campos_tabla["estatus"]=1;
		$campos_tabla["ciclo_produccion_id"]=get_ciclos_pagos_now_x_id($ciclo_informacion->ciclos_id);
		$campos_tabla["trm"]=(isset($var['trm'])?$var['trm']:0);
		$consecutivo=consecutivo($this->user->id_empresa,$tipo_documento,$consecutivo=NULL);
		$campos_tabla["consecutivo"]=$consecutivo;
		$insert_531510	=	array();
		$insert_233595	=	array();
		$insert_json	=	array();
		$insert_json['factura']	=	$campos_tabla;
		$insert_json['nombre_cliente']=$var['nombre_legal'];
		$insert_json['cliente_id']=$var['cliente_id'];
		$insert_json['direccion']=$var['direccion'];
		$insert_json['pais']=$var['pais'];
		$insert_json['identificacion_empresa']=$var['identificacion_empresa'];
		$insert_json['fecha_emision']=$var['fecha_emision'];
		$insert_json['trm']=$campos_tabla["trm"];
		$insert_json['ciclo_produccion_id']=$campos_tabla["ciclo_produccion_id"];
		
		foreach($var['valor'] as $k => $v){
			if($var['valor'][$k]>0){
				$insert_531510[$k] 								=	new stdClass();	
				$insert_531510[$k] ->responsable_id				=	$this->user->user_id;
				$insert_531510[$k] ->consecutivo				=	$campos_tabla["consecutivo"];
				$insert_531510[$k] ->empresa_id					=	$campos_tabla["empresa_id"];
				$insert_531510[$k] ->fecha						=	$campos_tabla["fecha"];
				$insert_531510[$k] ->estatus					=	$campos_tabla["estatus"];
				$insert_531510[$k] ->centro_de_costos			=	$this->user->centro_de_costos;
				$insert_531510[$k] ->nro_documento				=	$campos_tabla["consecutivo"];
				$insert_531510[$k] ->tipo_documento				=	$tipo_documento;
				$insert_531510[$k] ->codigo_contable			=	$var['contabilidad'][$k];
				$insert_531510[$k] ->ciclo_produccion_id		=	$campos_tabla["ciclo_produccion_id"];
				$insert_531510[$k] ->fecha						=	$campos_tabla["fecha"];
				$insert_531510[$k] ->nickname_id				=	0;
				$insert_531510[$k] ->procesador_id				=	0;
				$insert_531510[$k] ->plataforma_id				=	0;
				$insert_531510[$k] ->master_id					=	0;
				$insert_531510[$k] ->modelo_id					=	0;
				$insert_531510[$k] ->cliente_id					=	$var['cliente_id'];			
				$insert_531510[$k] ->debito						=	$var['valor'][$k];
				$insert_531510[$k] ->credito					=	0;
				$insert_531510[$k] ->json						=	json_encode( $var	);
				
				
				
				$insert_233595[$k] 								=	new stdClass();	
				$insert_233595[$k] ->responsable_id				=	$this->user->user_id;
				$insert_233595[$k] ->consecutivo				=	$campos_tabla["consecutivo"];
				$insert_233595[$k] ->empresa_id					=	$campos_tabla["empresa_id"];
				$insert_233595[$k] ->fecha						=	$campos_tabla["fecha"];
				$insert_233595[$k] ->estatus					=	$campos_tabla["estatus"];
				$insert_233595[$k] ->centro_de_costos			=	$this->user->centro_de_costos;
				$insert_233595[$k] ->nro_documento				=	$campos_tabla["consecutivo"];
				$insert_233595[$k] ->tipo_documento				=	$tipo_documento;
				$insert_233595[$k] ->codigo_contable			=	$var['contrapartida'][$k];;
				$insert_233595[$k] ->ciclo_produccion_id		=	$campos_tabla["ciclo_produccion_id"];
				$insert_233595[$k] ->fecha						=	$campos_tabla["fecha"];
				$insert_233595[$k] ->nickname_id				=	0;
				$insert_233595[$k] ->procesador_id				=	0;
				$insert_233595[$k] ->plataforma_id				=	0;
				$insert_233595[$k] ->master_id					=	0;
				$insert_233595[$k] ->modelo_id					=	0;
				$insert_233595[$k] ->cliente_id					=	$var['cliente_id'];			
				$insert_233595[$k] ->debito						=	0;
				$insert_233595[$k] ->credito					=	$var['valor'][$k];
				$insert_233595[$k] ->json						=	json_encode( $var	);
			}
		}
		$tabla	=	DB_PREFIJO."rp_operaciones";
		if($this->db->insert_batch($tabla, $insert_531510) && $this->db->insert_batch($tabla, $insert_233595)){
			incrementa_consecutivo($this->user->id_empresa,$tipo_documento);
			return true;			
		}else{
			return false;			
		}
	}
	
	public function MakeFactura_X_Centro_de_Costos($var){
		$tipo_documento	=	1;
		$campos_tabla["empresa_id"]=$this->user->id_empresa;
		$campos_tabla["fecha"]=date("Y-m-d");
		$campos_tabla["estatus"]=1;
		$campos_tabla["ciclo_produccion_id"]=$var['ciclo_produccion_id'];
		$campos_tabla["trm"]=$var['trm'];
		$campos_tabla["responsable_id"]=$this->user->user_id;
		$insert			=	array();
		$insert_281505	=	array();
		$insert_414580	=	array();
		$insert_json	=	array();
		$insert_json['factura']	= $campos_tabla;
		$insert_json['nombre_cliente']=$var['nombre_cliente'];
		$insert_json['cliente_id']=$var['cliente_id'];
		$insert_json['direccion']=$var['direccion'];
		$insert_json['pais']=$var['pais'];
		$insert_json['identificacion_empresa']=$var['identificacion_empresa'];
		$insert_json['fecha_emision']=$var['fecha_emision'];
		$insert_json['trm']=$var['trm'];
		$insert_json['ciclo_produccion_id']=$var['ciclo_produccion_id'];
		if(isset($var['dolares_banco'])){
			$insert_json['bancos']=$var['dolares_banco'];
		}
		if(isset($var['cuenta_banco'])){
			$insert_json['bancos_cuenta']=$var['cuenta_banco'];
		}
		if(isset($var['total_tokens_x_banco'])){
			$insert_json['bancos_total_tokens']=$var['total_tokens_x_banco'];
		}
		if(isset($var['total_dolares_x_banco'])){
			$insert_json['bancos_total_dolares']=$var['total_dolares_x_banco'];
		}
		$centro_de_costos=array();

		/*ASOCIO CENTROS DE COSTOS CON SUS ABREVIATURAS*/
		foreach($var['centro_de_costos'] as $k => $v){
			$escala_x_modelo				=	get_escala_x_user_id($var['id_modelo'][$k]);
			if(is_object($escala_x_modelo)){
				$porcentaje_descuento_dolar	=	$escala_x_modelo->porcentaje_descuento_dolar;
				$bonificacion				=	$escala_x_modelo->bonificacion;
			}else{
				$porcentaje_descuento_dolar	=	0.90;
				$bonificacion				=	50;
			}
			if($var['tokens'][$k]>0){
				if(!isset($documento_id[$v])){
					$documento_id[$v]=consecutivo($this->user->id_empresa,$tipo_documento,$consecutivo=NULL);
					incrementa_consecutivo($this->user->id_empresa,1);					
				}
				
				$porcentaje_x_modelo						=	porcentaje_contable_x_modelo($var['tokens'][$k],$campos_tabla["trm"],$var['equivalencia'][$k],$porcentaje_descuento_dolar,$bonificacion);
				$porcentaje_estudio							=	1 - $porcentaje_x_modelo;
				$total_valor_modelo							=	$var['tokens'][$k]* $var['equivalencia'][$k]* $porcentaje_x_modelo;
				
				
				$insert[$v][$k]								=	new stdClass();	
				$insert[$v][$k]->centro_de_costos			=	$var['centro_de_costos'][$k];
				$insert[$v][$k]->responsable_id				=	$campos_tabla["responsable_id"];
				$insert[$v][$k]->consecutivo				=	$documento_id[$v];
				$insert[$v][$k]->empresa_id					=	$campos_tabla["empresa_id"];
				$insert[$v][$k]->fecha						=	$campos_tabla["fecha"];
				$insert[$v][$k]->estatus					=	$campos_tabla["estatus"];
				$insert[$v][$k]->nro_documento				=	$var['centro_de_costos'][$k];
				$insert[$v][$k]->tipo_documento				=	$tipo_documento;
				$insert[$v][$k]->codigo_contable			=	'414580';
				$insert[$v][$k]->ciclo_produccion_id		=	get_ciclos_pagos_now_x_id($campos_tabla["ciclo_produccion_id"]);
				$insert[$v][$k]->fecha						=	$campos_tabla["fecha"];
				$insert[$v][$k]->nickname_id				=	$var['nickname_id'][$k];
				$insert[$v][$k]->procesador_id				=	$var['procesador_id'][$k];
				$insert[$v][$k]->plataforma_id				=	$var['plataforma_id'][$k];
				$insert[$v][$k]->master_id					=	$var['id_master'][$k];
				$insert[$v][$k]->modelo_id					=	$var['id_modelo'][$k];
				$insert[$v][$k]->cliente_id					=	$var['cliente_id'];			
				$insert[$v][$k]->debito						=	0;
				$insert[$v][$k]->credito					=	$total_valor_modelo;
				$insert[$v][$k]->json						=	json_encode(array(	
																				"monto_global_usd"=>$var['tokens'][$k]* $var['equivalencia'][$k],
																				"tokens"=>$var['tokens'][$k],
																				"nickname"=>$var['nickname'][$k],
																				"equivalencia"=>$var['equivalencia'][$k],
																				"tercero"=>$var['nombre_cliente']
																				)
																		);
				$tabla	=	DB_PREFIJO."rp_operaciones";
				$this->db->insert($tabla,$insert[$v][$k]);
				
				$insert[$v][$k]								=	new stdClass();	
				$insert[$v][$k]->centro_de_costos			=	$var['centro_de_costos'][$k];
				$insert[$v][$k]->responsable_id				=	$campos_tabla["responsable_id"];
				$insert[$v][$k]->consecutivo				=	$documento_id[$v];
				$insert[$v][$k]->empresa_id					=	$campos_tabla["empresa_id"];
				$insert[$v][$k]->fecha						=	$campos_tabla["fecha"];
				$insert[$v][$k]->estatus					=	$campos_tabla["estatus"];
				$insert[$v][$k]->nro_documento				=	$var['centro_de_costos'][$k];
				$insert[$v][$k]->tipo_documento				=	$tipo_documento;
				$insert[$v][$k]->codigo_contable			=	'414580';
				$insert[$v][$k]->ciclo_produccion_id		=	get_ciclos_pagos_now_x_id($campos_tabla["ciclo_produccion_id"]);
				$insert[$v][$k]->fecha						=	$campos_tabla["fecha"];
				$insert[$v][$k]->nickname_id				=	$var['nickname_id'][$k];
				$insert[$v][$k]->procesador_id				=	$var['procesador_id'][$k];
				$insert[$v][$k]->plataforma_id				=	$var['plataforma_id'][$k];
				$insert[$v][$k]->master_id					=	$var['id_master'][$k];
				$insert[$v][$k]->modelo_id					=	$var['id_modelo'][$k];
				$insert[$v][$k]->cliente_id					=	$var['cliente_id'];			
				$insert[$v][$k]->debito						=	0;
				$insert[$v][$k]->credito					=	($var['tokens'][$k]* $var['equivalencia'][$k]) - $total_valor_modelo;
				$insert[$v][$k]->json						=	json_encode(array(	
																				"monto_global_usd"=>$var['tokens'][$k]* $var['equivalencia'][$k],
																				"tokens"=>$var['tokens'][$k],
																				"nickname"=>$var['nickname'][$k],
																				"equivalencia"=>$var['equivalencia'][$k],
																				"tercero"=>$var['nombre_cliente']
																				)
																		);
				$tabla	=	DB_PREFIJO."rp_operaciones";
				$this->db->insert($tabla,$insert[$v][$k]);
				
				
				
				$insert[$v][$k]								=	new stdClass();	
				$insert[$v][$k]->centro_de_costos			=	$var['centro_de_costos'][$k];
				$insert[$v][$k]->responsable_id				=	$campos_tabla["responsable_id"];
				$insert[$v][$k]->consecutivo				=	$documento_id[$v];
				$insert[$v][$k]->empresa_id					=	$campos_tabla["empresa_id"];
				$insert[$v][$k]->fecha						=	$campos_tabla["fecha"];
				$insert[$v][$k]->estatus					=	$campos_tabla["estatus"];
				$insert[$v][$k]->nro_documento				=	$var['centro_de_costos'][$k];
				$insert[$v][$k]->tipo_documento				=	$tipo_documento;
				$insert[$v][$k]->codigo_contable			=	'130510';
				$insert[$v][$k]->ciclo_produccion_id		=	get_ciclos_pagos_now_x_id($campos_tabla["ciclo_produccion_id"]);
				$insert[$v][$k]->fecha						=	$campos_tabla["fecha"];
				$insert[$v][$k]->nickname_id				=	$var['nickname_id'][$k];
				$insert[$v][$k]->procesador_id				=	$var['procesador_id'][$k];
				$insert[$v][$k]->plataforma_id				=	$var['plataforma_id'][$k];
				$insert[$v][$k]->master_id					=	$var['id_master'][$k];
				$insert[$v][$k]->modelo_id					=	$var['id_modelo'][$k];
				$insert[$v][$k]->cliente_id					=	$var['cliente_id'];			
				$insert[$v][$k]->debito						=	$var['tokens'][$k]* $var['equivalencia'][$k];
				$insert[$v][$k]->credito					=	0;
				$insert[$v][$k]->json						=	json_encode(array(	
																				"monto_global_usd"=>$var['tokens'][$k]* $var['equivalencia'][$k],
																				"tokens"=>$var['tokens'][$k],
																				"nickname"=>$var['nickname'][$k],
																				"equivalencia"=>$var['equivalencia'][$k],
																				"tercero"=>$var['nombre_cliente']
																				)
																		);
				$tabla	=	DB_PREFIJO."rp_operaciones";
				$this->db->insert($tabla,$insert[$v][$k]);
				
				$tabla	=	DB_PREFIJO."rp_operaciones_json";
				$this->db->insert($tabla,array("consecutivo"=>$documento_id[$v],"json"=>json_encode($insert)));
			}
		}
		/*YA PROCESADO NO BORRAR*/
		return true;
	}
	
	public function MakeFactura($var){
		if(!isset($var['factura_grande'])){
			return $this->MakeFactura_X_Centro_de_Costos($var);return;
		}
		
		$tipo_documento	=	1;
		$campos_tabla["empresa_id"]=$this->user->id_empresa;
		$campos_tabla["fecha"]=date("Y-m-d");
		$campos_tabla["estatus"]=1;
		$campos_tabla["ciclo_produccion_id"]=$var['ciclo_produccion_id'];
		$campos_tabla["trm"]=$var['trm'];
		$campos_tabla["responsable_id"]=$this->user->user_id;
		$consecutivo	=	consecutivo($this->user->id_empresa,$tipo_documento,$consecutivo=NULL);
		$campos_tabla["consecutivo"]=$consecutivo;
		$insert			=	array();
		$insert_281505	=	array();
		$insert_414580	=	array();
		$insert_json	=	array();
		$insert_json['factura']	=	$campos_tabla;
		$insert_json['nombre_cliente']=$var['nombre_cliente'];
		$insert_json['cliente_id']=$var['cliente_id'];
		$insert_json['direccion']=$var['direccion'];
		$insert_json['pais']=$var['pais'];
		$insert_json['identificacion_empresa']=$var['identificacion_empresa'];
		$insert_json['fecha_emision']=$var['fecha_emision'];
		$insert_json['trm']=$var['trm'];
		$insert_json['ciclo_produccion_id']=$var['ciclo_produccion_id'];
		if(isset($var['dolares_banco'])){
			$insert_json['bancos']=$var['dolares_banco'];
		}
		if(isset($var['cuenta_banco'])){
			$insert_json['bancos_cuenta']=$var['cuenta_banco'];
		}
		if(isset($var['total_tokens_x_banco'])){
			$insert_json['bancos_total_tokens']=$var['total_tokens_x_banco'];
		}
		if(isset($var['total_dolares_x_banco'])){
			$insert_json['bancos_total_dolares']=$var['total_dolares_x_banco'];
		}
		
		
		/*MODELO CODICO CONTABLE 130510*/
		foreach($var['centro_de_costos'] as $k => $v){
			if($var['tokens'][$k]>0){
				$escala_x_modelo			=	get_escala_x_user_id($var['id_modelo'][$k]);
				if(is_object($escala_x_modelo)){
					$porcentaje_descuento_dolar	=	$escala_x_modelo->porcentaje_descuento_dolar;
					$bonificacion				=	$escala_x_modelo->bonificacion;
				}else{
					$porcentaje_descuento_dolar	=	0.90;
					$bonificacion				=	50;
				}
				
				
				$porcentaje_x_modelo					=	porcentaje_contable_x_modelo($var['tokens'][$k],$campos_tabla["trm"],$var['equivalencia'][$k],$porcentaje_descuento_dolar,$bonificacion);
				$porcentaje_estudio						=	1 - $porcentaje_x_modelo;
				$total_valor_modelo						=	$var['tokens'][$k]* $var['equivalencia'][$k]* $porcentaje_x_modelo;
				
				$insert_json['items'][$k]['tokens']=$var['tokens'][$k];
				$insert_json['items'][$k]['nickname']=$var['nickname'][$k];
				$insert_json['items'][$k]['master_nombre']=$var['master_nombre'][$k];
											
				
				$insert[$k]								=	new stdClass();	
				$insert[$k]->responsable_id				=	$campos_tabla["responsable_id"];
				$insert[$k]->consecutivo				=	$campos_tabla["consecutivo"];
				$insert[$k]->empresa_id					=	$campos_tabla["empresa_id"];
				$insert[$k]->fecha						=	$campos_tabla["fecha"];
				$insert[$k]->estatus					=	$campos_tabla["estatus"];
				$insert[$k]->centro_de_costos			=	$var['centro_de_costos'][$k];
				$insert[$k]->nro_documento				=	$campos_tabla["consecutivo"];
				$insert[$k]->tipo_documento				=	$tipo_documento;
				$insert[$k]->codigo_contable			=	'414580';
				$insert[$k]->ciclo_produccion_id		=	get_ciclos_pagos_now_x_id($campos_tabla["ciclo_produccion_id"]);
				$insert[$k]->fecha						=	$campos_tabla["fecha"];
				$insert[$k]->nickname_id				=	$var['nickname_id'][$k];
				$insert[$k]->procesador_id				=	$var['procesador_id'][$k];
				$insert[$k]->plataforma_id				=	$var['plataforma_id'][$k];
				$insert[$k]->master_id					=	$var['id_master'][$k];
				$insert[$k]->modelo_id					=	$var['id_modelo'][$k];
				$insert[$k]->cliente_id					=	$var['cliente_id'];			
				$insert[$k]->debito						=	0;
				$insert[$k]->credito					=	$total_valor_modelo;
				$insert[$k]->json						=	json_encode(array(	
																				"monto_global_usd"=>$var['tokens'][$k]* $var['equivalencia'][$k],
																				"tokens"=>$var['tokens'][$k],
																				"nickname"=>$var['nickname'][$k],
																				"equivalencia"=>$var['equivalencia'][$k],
																				"tercero"=>$var['nombre_cliente']
																				)
																		);
				
				$insert_281505[$k]						=	new stdClass();	
				$insert_281505[$k]->responsable_id		=	$campos_tabla["responsable_id"];
				$insert_281505[$k]->consecutivo			=	$campos_tabla["consecutivo"];
				$insert_281505[$k]->empresa_id			=	$campos_tabla["empresa_id"];
				$insert_281505[$k]->fecha				=	$campos_tabla["fecha"];
				$insert_281505[$k]->estatus				=	$campos_tabla["estatus"];
				$insert_281505[$k]->centro_de_costos	=	$var['centro_de_costos'][$k];
				$insert_281505[$k]->nro_documento		=	$campos_tabla["consecutivo"];
				$insert_281505[$k]->tipo_documento		=	$tipo_documento;
				$insert_281505[$k]->codigo_contable		=	'414580';
				$insert_281505[$k]->ciclo_produccion_id	=	get_ciclos_pagos_now_x_id($campos_tabla["ciclo_produccion_id"]);
				$insert_281505[$k]->fecha				=	$campos_tabla["fecha"];
				$insert_281505[$k]->nickname_id			=	$var['nickname_id'][$k];
				$insert_281505[$k]->procesador_id		=	$var['procesador_id'][$k];
				$insert_281505[$k]->plataforma_id		=	$var['plataforma_id'][$k];
				$insert_281505[$k]->master_id			=	$var['id_master'][$k];
				$insert_281505[$k]->modelo_id			=	$var['id_modelo'][$k];
				$insert_281505[$k]->cliente_id			=	$var['cliente_id'];
				$insert_281505[$k]->debito				=	0;
				$insert_281505[$k]->credito				=	($var['tokens'][$k]* $var['equivalencia'][$k]) - $total_valor_modelo;
				$insert_281505[$k]->json				=	json_encode(array(	
																				"monto_global_usd"=>$var['tokens'][$k]* $var['equivalencia'][$k],
																				"tokens"=>$var['tokens'][$k],
																				"nickname"=>$var['nickname'][$k],
																				"equivalencia"=>$var['equivalencia'][$k],
																				"tercero"=>$var['nombre_cliente']
																				)
																		);
				
				$insert_414580[$k]						=	new stdClass();	
				$insert_414580[$k]->responsable_id		=	$campos_tabla["responsable_id"];
				$insert_414580[$k]->consecutivo			=	$campos_tabla["consecutivo"];
				$insert_414580[$k]->empresa_id			=	$campos_tabla["empresa_id"];
				$insert_414580[$k]->fecha				=	$campos_tabla["fecha"];
				$insert_414580[$k]->estatus				=	$campos_tabla["estatus"];
				$insert_414580[$k]->centro_de_costos	=	$var['centro_de_costos'][$k];
				$insert_414580[$k]->nro_documento		=	$campos_tabla["consecutivo"];
				$insert_414580[$k]->tipo_documento		=	$tipo_documento;
				$insert_414580[$k]->codigo_contable		=	'130510';
				$insert_414580[$k]->ciclo_produccion_id	=	get_ciclos_pagos_now_x_id($campos_tabla["ciclo_produccion_id"]);
				$insert_414580[$k]->fecha				=	$campos_tabla["fecha"];
				$insert_414580[$k]->nickname_id			=	$var['nickname_id'][$k];
				$insert_414580[$k]->procesador_id		=	$var['procesador_id'][$k];
				$insert_414580[$k]->plataforma_id		=	$var['plataforma_id'][$k];
				$insert_414580[$k]->master_id			=	$var['id_master'][$k];
				$insert_414580[$k]->modelo_id			=	$var['id_modelo'][$k];
				$insert_414580[$k]->cliente_id			=	$var['cliente_id'];
				$insert_414580[$k]->debito				=	$var['tokens'][$k]* $var['equivalencia'][$k];
				$insert_414580[$k]->credito				=	0;
				$insert_414580[$k]->json				=	json_encode(array(	
																				"monto_global_usd"=>$var['tokens'][$k]* $var['equivalencia'][$k],
																				"tokens"=>$var['tokens'][$k],
																				"nickname"=>$var['nickname'][$k],
																				"equivalencia"=>$var['equivalencia'][$k],
																				"tercero"=>$var['nombre_cliente']
																				)
																		);
			}
		}
		
		$tabla	=	DB_PREFIJO."rp_operaciones";
		if($this->db->insert_batch($tabla, $insert)){
			if($this->db->insert_batch($tabla, $insert_281505)){
				if($this->db->insert_batch($tabla, $insert_414580)){
					if(!empty(post("borrame"))){
						foreach(post("borrame") as $v33){
							$this->db->where('reporte_archivo_plano_id', $v33);
							$this->db->delete(DB_PREFIJO."rp_tmp");
						}
					}
					$tabla	=	DB_PREFIJO."rp_operaciones_json";
					$this->db->insert($tabla, array("consecutivo"=>$consecutivo,"json"=>json_encode($insert_json)));
					logs($this->user,1,"rp_operaciones",$campos_tabla["consecutivo"],"Factura de Ventas","1",$insert_414580);
					incrementa_consecutivo($this->user->id_empresa,1);
					return true;
				}else{
					$this->db->where('consecutivo', $campos_tabla["consecutivo"]);
					$this->db->delete($tabla);
					return false;
				}	
			}else{
				$this->db->where('consecutivo', $campos_tabla["consecutivo"]);
				$this->db->delete($tabla);
				return false;	
			}
		}else{
			$this->db->where('consecutivo', $campos_tabla["consecutivo"]);
			$this->db->delete($tabla);
			return false;	
		}		
	}
	public function MakeFactura2OLD($var){
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
		$tipo_documento					=	2;
		$consecutivo					=	consecutivo($this->user->id_empresa,$tipo_documento);
		
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
											"codigo_contable"=>"414580",
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
		$sql					=	"	SELECT 	t1.pagina,
												t3.Nit,
												t3.Nombre_legal,
												t3.Direccion,
												t3.Ciudad,
												t3.Departamento,
												t3.Pais,
												t4.user_id as cliente_id,
												t1.centro_de_costos
											FROM ".DB_PREFIJO."rp_tmp t1
												LEFT JOIN ".DB_PREFIJO."usuarios t2 ON t1.centro_de_costos=t2.user_id
												LEFT JOIN ".DB_PREFIJO."sys_paginas_webcam t3 ON t1.pagina = t3.Pagina
												LEFT JOIN ".DB_PREFIJO."usuarios t4 ON t3.Pagina = t4.primer_nombre												
											 	WHERE t1.id_empresa = '".$this->user->id_empresa."'";
		$sql					.=	"				AND t1.centro_de_costos = '".$centro_de_costos."'
													AND t4.user_id != 'NULL'
														GROUP BY t1.pagina";		
		$sql					.=	"						ORDER BY t1.pagina";	
		
		$query 						= 	$this->db->query($sql);
		
		
		
		return	$query->result();
		//pre($this->result);																
	}
	
	public function get_reporte_x_pagina_detallado($centro_de_costos,$pagina){
		/*PROCESAR SEGÚN TIPO DE SUCURSAL*/	
		$tabla				=		DB_PREFIJO."rp_tmp t1";
		$this->db->select("	t1.reporte_archivo_plano_id,
							t1.tokens,
							t1.nickname,
							t1.id_empresa,
							t1.centro_de_costos,
							t1.pagina,
							t1.mes,
							t1.periodo_pagos,
							t2.id_plataforma,
							t4.abreviacion,
							t3.equivalencia");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."cf_nickname t2", 't1.nickname=t2.nickname', 'left');
		$this->db->join(DB_PREFIJO."usuarios t3", 't2.id_plataforma=t3.user_id', 'left');
		$this->db->join(DB_PREFIJO."usuarios t4", 't1.centro_de_costos=t4.user_id', 'left');
		$this->db->join(DB_PREFIJO."usuarios t5", 't2.id_modelo=t5.user_id', 'left');
		$this->db->where("t1.id_empresa",$this->user->id_empresa);
		$this->db->where("t1.centro_de_costos",$centro_de_costos);
		$this->db->like("t3.primer_nombre",$pagina);
		//$this->db->group_by(array("t3.primer_nombre","t1.nickname"));
		$query						=	$this->db->get();
		return	$query->result();
		
		return;
		
		$sql					=	"	SELECT  t1.tokens, 
												t1.nickname,
												t1.id_empresa,
												t1.centro_de_costos,
												t1.pagina,
												t1.mes,
												t1.periodo_pagos,
												t2.abreviacion,
												t3.equivalencia,
												t3.user_id as id_plataforma
											FROM ".DB_PREFIJO."rp_tmp t1
												LEFT JOIN ".DB_PREFIJO."cf_nickname t2 ON t1.centro_de_costos=t2.user_id
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
		if($this->user->type=='Modelos'){
			$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
			$this->db->where('t1.id_modelo', $this->user->user_id);
		}
		if($desde && $hasta){
			$this->db->where('t1.fecha BETWEEN "'. date('Y-m-d', strtotime($desde)). '" AND "'. date('Y-m-d', strtotime($hasta)).'"');
		}
		$this->db->group_by(array("fecha"));
		$this->db->order_by('t1.fecha','DESC');
		//$this->db->limit(15);	
		$query		=	$this->db->get();
		$return		=	array();
		return $this->result=$query->result();
		foreach($query->result() as $k => $v){
			$return		=	$v;
		}
		return $this->result=$return;
	}

	public function get_DiasTrabajados(){
		$tabla				=		DB_PREFIJO."usuarios t1";
		$this->db->select("t1.primer_nombre,t1.segundo_nombre,t1.primer_apellido,t1.segundo_apellido,t2.fecha");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."rp_diario t2","t1.user_id	=	t2.id_modelo","left");
		$this->db->where("t1.id_empresa",$this->user->id_empresa);
		//$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
		$this->db->where('t1.type',"Modelos" );
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
		if($this->user->type=='Modelos'){
			$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
			$this->db->where('t1.id_modelo', $this->user->user_id);
		}
		
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
	
	public function get_Form_Recibir($id=NULL){
		$tabla	=	DB_PREFIJO."rp_operaciones t1";
		$this->db->select(" t1.credito,
							fecha,
							t2.Nombre_legal as nombre_cliente,
							t2.*,
							t1.consecutivo,
							t3.abreviacion,
							t4.nombre as ciclo_de_produccion");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."sys_paginas_webcam t2", 't1.cliente_id=t2.cliente_id', 'left');
		$this->db->join(DB_PREFIJO."usuarios t3",'t1.centro_de_costos=t3.user_id','left');
		$this->db->join(DB_PREFIJO."cf_ciclos_pagos t4",'t1.ciclo_produccion_id=t4.ciclos_id','left');
		$this->db->where("t1.estatus",1);
		$this->db->where_in(array("130510","414580"));
		$this->db->group_by(array("consecutivo"));
		$query	= 	$this->db->get();
		$this->result	=	$query->row();	
	}
	
	public function get_detalle_contable_facturas($id=NULL,$tipo_documento=NULL,$codigo_contable=array("130510","414580")){
		$tabla	=	DB_PREFIJO."rp_operaciones t1";
		$this->db->select(" t1.credito,
							fecha,
							t2.Nombre_legal as nombre_cliente,
							t2.*,
							t1.consecutivo,
							t3.abreviacion,
							t1.centro_de_costos,
							t1.ciclo_produccion_id as ciclo_de_produccion");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."sys_paginas_webcam t2", 't1.cliente_id=t2.cliente_id', 'left');
		$this->db->join(DB_PREFIJO."usuarios t3",'t1.centro_de_costos=t3.user_id','left');
		$this->db->join(DB_PREFIJO."cf_ciclos_pagos t4",'t1.ciclo_produccion_id=t4.ciclos_id','left');
		$this->db->where("t1.estatus",1);
		if($id<>NULL){
			$this->db->where("t1.consecutivo",$id);
		}
		if($tipo_documento<>NULL){
			$this->db->where("t1.tipo_documento",$tipo_documento);
		}
		$this->db->where_in($codigo_contable);
		$this->db->group_by(array("consecutivo"));
		$query	= 	$this->db->get();
		$this->result	=	$query->row();	
	}
	
	public function get_facturas($id=NULL){
		$tabla	=	DB_PREFIJO."rp_operaciones t1";
		$this->db->select(" t1.id,
							t1.credito,
							t1.estatus,
							fecha,
							t2.Nombre_legal as nombre_cliente,
							t2.*,
							t1.consecutivo,
							t3.abreviacion,
							t1.centro_de_costos,
							t1.ciclo_produccion_id as ciclo_de_produccion,
							t5.nombre_legal as nombre_cliente");
		$this->db->from($tabla);
		
		$this->db->join(DB_PREFIJO."usuarios t3",'t1.centro_de_costos=t3.user_id','left');
		$this->db->join(DB_PREFIJO."cf_ciclos_pagos t4",'t1.ciclo_produccion_id=t4.ciclos_id','left');
		$this->db->join(DB_PREFIJO."usuarios t5",'t1.cliente_id=t5.user_id','left');
		$this->db->join(DB_PREFIJO."sys_paginas_webcam t2", 't5.primer_nombre=t2.pagina', 'left');
		$this->db->where("t1.consecutivo",$id);
		//$this->db->where("t1.estatus",1);
		$this->db->where_in(array("130510","414580"));
		$this->db->group_by(array("consecutivo"));
		$query	= 	$this->db->get();
		return $this->result	=	$query->row();	
	}
	
	public function get_facturas_new(){
		$return=array();
		$tabla	=	DB_PREFIJO."rp_operaciones t1";
		$this->db->select("SUM(t1.credito) as total,
							fecha,
							t2.nombre_legal as nombre_cliente,
							t1.consecutivo,
							t3.abreviacion,
							t1.estatus");
		$this->db->from($tabla);
		//$this->db->join(DB_PREFIJO."sys_paginas_webcam t2", 't1.cliente_id=t2.cliente_id', 'left');
		$this->db->join(DB_PREFIJO."usuarios t2",'t1.cliente_id=t2.user_id','left');
		$this->db->join(DB_PREFIJO."usuarios t3",'t1.centro_de_costos=t3.user_id','left');
		$this->db->where("t1.empresa_id",$this->user->id_empresa);
		$this->db->where("t1.tipo_documento",1);
//		$this->db->where_in(array("130510","414580"));
		$this->db->group_by(array("consecutivo"));
		$query	= 	$this->db->get();
		$this->result["activos"]	=	$return["total"]		=	$query->result();
		
		$return["pendiente"] 	=	array();
		$return["pagadas"] 		=	array();
		$return["anuladas"]		=	array();
		
		foreach($return["total"] as $k =>$v){
			$this->db->select("SUM(t1.credito) as total,
									fecha,
									t2.Nombre_legal as nombre_cliente,
									t1.consecutivo,
									t3.abreviacion,
									t1.estatus");
			$this->db->from($tabla);
			$this->db->join(DB_PREFIJO."sys_paginas_webcam t2", 't1.cliente_id=t2.cliente_id', 'left');
			$this->db->join(DB_PREFIJO."usuarios t3",'t1.centro_de_costos=t3.user_id','left');
			//$this->db->where("t1.estatus",1);
			$this->db->where("t1.tipo_documento",5);
			$this->db->where("t1.nro_documento",$v->consecutivo);
			$this->db->where("t1.codigo_contable","130510");
			$this->db->group_by(array("nickname_id"));
			$query	= 	$this->db->get();
			$row	=	$query->row();
	
			if(!empty($row)){
				if(@$row->total	==	$v->total && $v->estatus==1){
					$return["pagadas"][]	=	$v;			
				}else if(@$row->total<$v->total && $v->estatus==1){
					$return["pendiente"][]	=	$v;			
				}elseif($v->estatus==9){
					$return["anuladas"][]		=	$v;			
				}
			}else{
				if($v->estatus==9){
					$return["anuladas"][]	=	$v;			
				}else{
					$return["pendiente"][]	=	$v;			
				}
			}
		}
		return $this->result	=	$return;
	}
	
	public function get_facturas2OLD($id=NULL){
		$tabla	=	DB_PREFIJO."rp_operaciones t1";
		$this->db->select(" t1.id,
							t1.credito,
							t1.estatus,
							fecha,
							t2.Nombre_legal as nombre_cliente,
							t2.*,
							t1.consecutivo,
							t3.abreviacion,
							t1.centro_de_costos,
							t1.ciclo_produccion_id as ciclo_de_produccion,
							t5.nombre_legal as nombre_cliente");
		$this->db->from($tabla);
		
		$this->db->join(DB_PREFIJO."usuarios t3",'t1.centro_de_costos=t3.user_id','left');
		$this->db->join(DB_PREFIJO."cf_ciclos_pagos t4",'t1.ciclo_produccion_id=t4.ciclos_id','left');
		$this->db->join(DB_PREFIJO."usuarios t5",'t1.cliente_id=t5.user_id','left');
		$this->db->join(DB_PREFIJO."sys_paginas_webcam t2", 't5.primer_nombre=t2.pagina', 'left');
		$this->db->where("t1.consecutivo",$id);
		//$this->db->where("t1.estatus",1);
		$this->db->where_in(array("130510","414580"));
		$this->db->group_by(array("consecutivo"));
		$query	= 	$this->db->get();
		return $this->result	=	$query->row();	
	}
	
	public function get_facturas2($id=NULL){
		$tabla	=	DB_PREFIJO."rp_operaciones t1";
		$this->db->select(" SUM(t1.debito) as debito,
							SUM(t1.credito) as credito,
							SUM(t1.debito) as debito_COP,
							SUM(t1.credito) as credito_COP,
							t1.id,
							t1.codigo_contable,
							t1.tipo_documento,
							t1.empresa_id,
							t1.nro_documento,
							t1.credito,
							t1.estatus,
							fecha,
							t2.Nombre_legal as nombre_cliente,
							t2.*,
							t1.consecutivo,
							t3.abreviacion,
							t1.centro_de_costos,
							t1.ciclo_produccion_id as ciclo_de_produccion,
							t5.nombre_legal as nombre_cliente,
							t5.identificacion as Nit");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."usuarios t3",'t1.centro_de_costos=t3.user_id','left');
		$this->db->join(DB_PREFIJO."cf_ciclos_pagos t4",'t1.ciclo_produccion_id=t4.ciclos_id','left');
		$this->db->join(DB_PREFIJO."usuarios t5",'t1.cliente_id=t5.user_id','left');
		$this->db->join(DB_PREFIJO."sys_paginas_webcam t2", 't5.primer_nombre=t2.pagina', 'left');
		//$this->db->where("t1.consecutivo",$id);
		//$this->db->where("t1.estatus",1);
		$this->db->where("t1.tipo_documento",8);
		$this->db->where_in(array("531510","233595"));
		$this->db->group_by(array("consecutivo"));
		$query	= 	$this->db->get();
		return $this->result	=	$query->result();	
	}
	
	public function setInformePlano(){
		$this->setInformePlano_Optimizado();return;
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

		$this->db->where('id_empresa>', 0);
		//$this->db->where('centro_de_costos', $this->user->centro_de_costos);
		//$this->db->where('mes', post("mes"));
		//$this->db->where('periodo_pagos', post("periodo_pagos"));
		
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
			
			$inser_array=null;
			$user	=	$this->db	->select("user_id")
									->from(DB_PREFIJO.'usuarios')
									->where('type','Plataformas')
									->like('primer_nombre',$sql[$i]["pagina"])->get()->row();
									
			$row	=	$this->db->select("*")
									->from(DB_PREFIJO.'cf_nickname t1')
									->join(DB_PREFIJO."usuarios t2",'t1.id_plataforma=t2.user_id','left')
									->like('nickname',$sql[$i]["Nickname"])
									->like('primer_nombre',$sql[$i]["pagina"])
									->get()->row();	
												
			return;									
			if(empty($row)){
				
				$inser_array	=	array(	"id_empresa"		=>	$this->user->id_empresa,	
											"centro_de_costos"	=>	$this->user->centro_de_costos,
											"id_plataforma"		=>	$user->user_id,
											"id_modelo"			=>	0,
											"id_master"			=>	0,
											"estado"			=>	0,
											"password"			=>	0,
											"nickname"			=>	$v->nickname
										);
				$this->db->insert(DB_PREFIJO.'cf_nickname', $inser_array);										
			}
			$this->db->insert($tabla,$sql[$i]);
		}   
		
		
		//$this->db->insert_batch($tabla, $sql);
		unlink($file);
		return true;
		//echo '<pre>';	print_r($sql);	echo '</pre>';
		
	}
	
	public function setInformePlano_Optimizado(){
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
		//$this->db->where('mes', post("mes"));
		//$this->db->where('periodo_pagos', post("periodo_pagos"));
		
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
		$rows_excel=array();
		$centro_de_costos=array();
		$time_start = microtime(true); 
		for($i = 2;$i <= $rows; $i++){
			$centro_de_costos[$i]					=	$this->db->select("id_empresa,user_id")
																	->from(DB_PREFIJO.'usuarios')
																	->where('abreviacion',$objPHPExcel->getActiveSheet()->getCell("D".$i)->getCalculatedValue())
																	->get()
																	->row();																	
			$nickname								=	nickname_like_name($objPHPExcel->getActiveSheet()->getCell("B".$i)->getCalculatedValue(),$objPHPExcel->getActiveSheet()->getCell("A".$i)->getCalculatedValue());
			if(empty($nickname)){$centro_de_costos_id=0;	
			}else{$centro_de_costos_id=$nickname->centro_de_costos;}
			@$rows_excel[$objPHPExcel->getActiveSheet()->getCell("A".$i)->getCalculatedValue()][$objPHPExcel->getActiveSheet()->getCell("B".$i)->getCalculatedValue()]["tokens"]+=$objPHPExcel->getActiveSheet()->getCell("C".$i)->getCalculatedValue();
			@$rows_excel[$objPHPExcel->getActiveSheet()->getCell("A".$i)->getCalculatedValue()][$objPHPExcel->getActiveSheet()->getCell("B".$i)->getCalculatedValue()]["centro_de_costos"]=$centro_de_costos_id;
			@$rows_excel[$objPHPExcel->getActiveSheet()->getCell("A".$i)->getCalculatedValue()][$objPHPExcel->getActiveSheet()->getCell("B".$i)->getCalculatedValue()]["id_empresa"]=$this->user->id_empresa;
			@$rows_excel[$objPHPExcel->getActiveSheet()->getCell("A".$i)->getCalculatedValue()][$objPHPExcel->getActiveSheet()->getCell("B".$i)->getCalculatedValue()]["mes"]=post("mes");
			@$rows_excel[$objPHPExcel->getActiveSheet()->getCell("A".$i)->getCalculatedValue()][$objPHPExcel->getActiveSheet()->getCell("B".$i)->getCalculatedValue()]["periodo_pagos"]=post("periodo_pagos");
		} 
		$time_end 		= 	microtime(true);
		$execution_time = 	($time_end - $time_start)/60;  
		//pre($rows_excel);
		
		$sql_insertOptimizado	=	array();
		foreach($rows_excel as $k	=> $v){
			$sql_insertOptimizado["pagina"]	=	$k;
			foreach($v as $k2=> $v2){
				$sql_insertOptimizado["nickname"]	=	$k2;
				foreach($v2 as $k3 => $v3){
					$sql_insertOptimizado[$k3]	=	$v3;
				}
				
					$inser_array=null;
					$user	=	$this->db	->select("user_id")
											->from(DB_PREFIJO.'usuarios')
											->where('type','Plataformas')
											->like('primer_nombre',$sql_insertOptimizado["pagina"])->get()->row();
											
					$row	=	$this->db->select("*")
									->from(DB_PREFIJO.'cf_nickname t1')
									->join(DB_PREFIJO."usuarios t2",'t1.id_plataforma=t2.user_id','left')
									->like('nickname',$sql_insertOptimizado["nickname"])
									->like('primer_nombre',$sql_insertOptimizado["pagina"])
									->get()->row();
					
					$plataforma	=	$this->db->select("*")
									->from(DB_PREFIJO.'usuarios t1')
									->like('primer_nombre',$sql_insertOptimizado["pagina"])
									->get()->row();
					
					if(empty($row)){
						$inser_array	=	array(	"id_empresa"		=>	$this->user->id_empresa,	
													"centro_de_costos"	=>	0,
													"id_plataforma"		=>	$plataforma->user_id,
													"id_modelo"			=>	0,
													"id_master"			=>	0,
													"estado"			=>	0,
													"password"			=>	0,
													"nickname"			=>	$sql_insertOptimizado["nickname"]
												);
						$this->db->insert(DB_PREFIJO.'cf_nickname', $inser_array);										
					}
				$this->db->insert($tabla,$sql_insertOptimizado);	
			}			
		}
		//pre($execution_time);
		unlink($file);
		return $execution_time;
	}
	
	public function setResultadoImportDeleteItem(){
		$this->db->where('reporte_archivo_plano_id', $this->uri->segment(3));
		$this->db->delete(DB_PREFIJO."rp_tmp");	
		return true;
	}
	
	public function setResultadoImportDeleteNickName(){
		$this->db->where('nickname_id', $this->uri->segment(3));
		$this->db->update(DB_PREFIJO."cf_nickname",array("id_modelo"=>0,"id_master"=>0,"centro_de_costos"=>0,"estado"=>0));	
		return true;
	}
	
	public function get_ResultadoImport(){
		$tabla				=		DB_PREFIJO."rp_tmp t1";
		$this->db->select("t2.user_id as plataforma_id");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."usuarios t2",'t1.pagina=t2.primer_nombre','left');	
		$query=$this->db->get();
		$row=$query->row();
		//pre($row);return;
		
		if($this->uri->segment(3)==''){
			$tabla				=		DB_PREFIJO."rp_tmp t1";
			$this->db->select("SUM(t1.tokens) AS tokens, 
									t1.nickname,
									t1.reporte_archivo_plano_id,
									t1.id_empresa,
									t1.centro_de_costos,
									t1.pagina,
									t1.mes,
									t1.periodo_pagos,
									t2.abreviacion as sucursal,
									'".$row->plataforma_id."' as plataforma_id");
			$this->db->from($tabla);
			$this->db->join(DB_PREFIJO."usuarios t2",'t1.centro_de_costos=t2.user_id','left');	
			$this->db->group_by(array("nickname"));
			$query=$this->db->get();
			$this->result=$query->result();								
			return;
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