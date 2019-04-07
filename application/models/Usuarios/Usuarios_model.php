<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Usuarios_model extends CI_Model {

	var $fields,$result,$where,$total_rows,$pagination,$search;

	public function SearchUser(){
		$list		=		get("list",false);
		$query	=		get("query");
		$tabla 	= 	"usuarios t1";
		$this->db->select("login");
		$this->db->from($tabla);
		$this->db->where('login',$query);
		if($list){
			$rows=$this->db->get()->result();
			return (!empty($rows)?$rows:"empty");
		}else{
			$row=$this->db->get()->row();
			return (!empty($row)?$row:"empty");
		}
	}

	public function insertConfigMeta($var){
		$var['responsable'] = $this->user->primer_nombre.' '.$this->user->segundo_nombre.' '.$this->user->primer_apellido.' '.$this->user->segundo_apellido;
		$data['centro_de_costos'] = $this->user->centro_de_costos;
		$data['empresa_id'] = $this->user->id_empresa;
		$var['fecha']      = date("Y-m-d H:i:s");
		$var['consecutivo'] = consecutivo($this->user->id_empresa,51);
		$data['data_meta_ideal'] = json_encode($var);
		$tabla = DB_PREFIJO."cf_meta_ideal";
		if($this->db->insert($tabla,$data)){
			$metaIdeal = $var['min_meta_ideal'];
			$this->db->where("id_empresa",$this->user->id_empresa);
			$this->db->where("meta_ideal ",0);
			$this->db->or_where("meta_ideal",'');
			$this->db->or_where("meta_ideal",NULL);
			$this->db->update(DB_PREFIJO.'usuarios',array("meta_ideal"=>$metaIdeal));
			incrementa_consecutivo($this->user->id_empresa,51);
			return true;
		}else{
			return false;
		}
	}

	public function VerUsuariosLogeados(){
		$tabla = DB_PREFIJO."usuarios t1";
		$fecha = "TIMESTAMPDIFF(MINUTE,fecha,NOW()) > ".SESSION_TIME/60;
		$this->db->select("t1.json,t1.user_id,t2.fecha");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."sys_session t2", 't1.user_id=t2.user_id', 'left');
		$query				=	$this->db->get();
		$rows				=	$query->result();
		pre($rows); return;
		return $rows;
	}

	public function Reload(){
		$tabla = DB_PREFIJO."cf_nickname_old t1";
		$this->db->select("*");
		$this->db->from($tabla);
		$this->db->order_by('t1.nickname_id','ASC');
		$query				=	$this->db->get();
		$rows				=	$query->result();
		$inc=0;
		foreach($rows as $k =>$v){
			if(!empty($this->db->select("*")->from(DB_PREFIJO."cf_nickname t1")->where("nickname",$v->nickname)->where("id_plataforma",$v->id_plataforma)->get()->row())){
				//echo 'REPETIDA';
			}else{
				$this->db->insert(DB_PREFIJO."cf_nickname",$v);
				//pre($v);
			}
			$inc++;
		}
		echo '<h3 class="text-center">Tabla Optimizada</h3><h4>'.$inc.' registros en total</h4>';
	}

	public function CrearCuentaBancaria($data,$documento=16){
		$tabla			=	DB_PREFIJO."sys_contratos";
		$tabla2				=	DB_PREFIJO."usuarios";
		$array = explode("-",$data);
		$nro_cuenta = str_replace("%20"," ", $array[3]);
		$tipo_cuenta = str_replace("%20"," ", $array[2]);

		$cambiosCuenta['cambio_cuentas_bancarias'] = json_encode(array(json_encode(array('fecha_creacion'=>date('d-m-Y'),"responsable"=>$this->user->user_id,'entidad_bancaria'=>$array[1],'tipo_cuenta'=>$tipo_cuenta,'nro_cuenta'=>$nro_cuenta))));

		$var['centro_de_costos'] = $this->user->centro_de_costos;
		$var['empresa_id'] = $this->user->id_empresa;
		$var['fecha_creacion'] = date("Y-m-d H:i:s");
		$consecutivo = consecutivo($this->user->id_empresa,$documento,$consecutivo=NULL);
		$var["consecutivo_id"] = $consecutivo;
		$var["user_id"] = $array[0];
		$var['responsable'] = $this->user->user_id;
		if($documento != 16){
			$row = null;
		}else{
			$row	=	$this->db->select("*")->from($tabla)
											->where('user_id',$array[0])
											->get()
											->row();
		}
		if(!empty($row)){
			$response = array("danger","El usuario ya cuenta con una Cuenta");
			return $response;
		}else if($this->db->insert($tabla,$var)){
			incrementa_consecutivo($var['empresa_id'],$documento);

			$this->db->where("user_id", $array[0]);
			if($this->db->update($tabla2,$cambiosCuenta)){
				$response = array("success","Felicitaciones ,La cuenta ha sido generada exitosamente");
			}else{
				$response = array("danger","Ha ocurrido un error durante el proceso por favor contacta al administrador del sitio");
			}
			return $response;
		}else{
			$response = array("danger","La cuenta no ha sido creada");
			return $response;
		}
	}

	public function CrearContrato($id){
		$tabla			=	DB_PREFIJO."sys_contratos";
		$var['centro_de_costos'] = $this->user->centro_de_costos;
		$var['empresa_id'] = $this->user->id_empresa;
		if($this->uri->segment(3) == "Modelos"){
			$tipo_documento = 23;
		}else if($this->uri->segment(3) == "Monitores"){
			$tipo_documento = 24;
		}else{

		}
		$consecutivo = consecutivo($this->user->id_empresa,$tipo_documento);
		$var["consecutivo_id"] = $consecutivo;
		$var["user_id"] = $id;
		$row	=	$this->db->select("*")->from($tabla)
													->where('user_id',$id)
													->get()
													->row();
		if(!empty($row)){
			$response = array("danger","El usuario ya cuenta con un contrato");
			return $response;
		}else if($this->db->insert($tabla,$var)){
			incrementa_consecutivo($var['empresa_id'],$tipo_documento);
			$response = array("success","Felicitaciones ,El contrato ha sido generado exitosamente");
			return $response;
		}else{
			$response = array("danger","El contrato no ha sido generado");
			return $response;
		}
	}

	public function set_Certificado($data){
		$tabla				=	DB_PREFIJO."cf_pdf_certificado_comercial";
		$var['centro_de_costos'] = $this->user->centro_de_costos;
		$var['id_empresa'] 	= $this->user->id_empresa;
		$consecutivo 		= consecutivo($this->user->id_empresa,55);
		$var["consecutivo"] = $consecutivo;
		$var["user_id"] 	= $this->uri->segment(3);
		$data['fecha']		= date('Y-m-d');
		$var["data"] 		= json_encode($data);
		$var['estado']		= 1;
		set_estado("cf_pdf_certificado_comercial",array('id_empresa','centro_de_costos'),array($var['id_empresa'],$var['centro_de_costos']),0);
		if($this->db->insert($tabla,$var)){
			incrementa_consecutivo($this->uri->segment(3),55);
			$response = array("success","Felicitaciones ,La configuracion de su certificado ha sido generada exitosamente");
			return $response;
		}else{
			$response = array("danger","El contrato no ha sido generado");
			return $response;
		}
	}

	public function HonorariosModeloAnular($consecutivo,$modelo_id){
		$tabla			=	DB_PREFIJO."rp_operaciones";
		$var['estatus'] = 	9;
		$this->db->where('consecutivo',$consecutivo);
		$this->db->where('modelo_id',$modelo_id);
		$this->db->where('tipo_documento',13);
		if($this->db->update($tabla,$var)){
			$tabla			=	DB_PREFIJO."rp_honorarios_modelos";
			$this->db->where('consecutivo',$consecutivo);
			$this->db->where('modelo_id',$modelo_id);
			if($this->db->update($tabla,$var)){
				$tabla			=	DB_PREFIJO."rp_descuentos_pagos";
				$this->db->where('nro_documento',$consecutivo);
				$this->db->where('user_id',$modelo_id);
				$this->db->update($tabla,array("estatus"=>9));
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	public function HonorariosModeloPagoAnular($consecutivo,$modelo_id){
		$tabla			=	DB_PREFIJO."rp_operaciones";
		$var['estatus'] = 	9;
		$this->db->where('consecutivo',$consecutivo);
		$this->db->where('modelo_id',$modelo_id);
		$this->db->where('tipo_documento',14);
		if($this->db->delete($tabla)){
			return true;
		}else{
			return false;
		}
	}

	public function getHonorariosModeloAprobados($consecutivo){
		$tabla	=	DB_PREFIJO."rp_honorarios_modelos t1" ;
		$this->db->select("t1.*,t2.estatus,t2.responsable_id");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."rp_operaciones t2", 't1.consecutivo=t2.consecutivo AND t1.modelo_id=t2.modelo_id ', 'left');
		$this->db->where('t1.consecutivo',$consecutivo);
		$this->db->where('t2.tipo_documento',13);
		$this->db->where("t1.empresa_id",$this->user->id_empresa);
		if($this->user->principal==0){
			$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
		}
		$query	=	$this->db->get();
		return	$this->result =	 $query->row();
	}

	public function CalcularHonorarios($modulo,$array_tipo_usuarios){
		$config				=	$this->session->userdata('Configuracion');
		$tabla				=	DB_PREFIJO."usuarios t1" ;
		$this->db->select("*");
		$this->db->from($tabla);
		$type 				= 	$array_tipo_usuarios;
		$this->db->where_in('t1.type', $type);
		$this->db->where('t1.estado',1);
		//$this->db->where('t1.user_id',10);
		$this->db->where("t1.id_empresa",$this->user->id_empresa);
		if($this->user->principal==0){
			$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
		}
		$this->db->order_by('t1.primer_nombre','ASC');
		$query				=	$this->db->get();
		$rows				=	$query->result();
		$activos=
		$pagados=
		$pendientes=
		$aprobados=array();

		if(count($rows)>0){
			foreach($rows as $k => $v){
				$ajuste_a_la_decena					=	0;
				$debito								=	0;
				$credito							=	0;
				$total_monto_cuota					=	0;
				$total_restante						=	0;
				$escala								=	escala($v->id_escala);

				/*INFORMACIÓN DE CABECERA*/
				$ciclo_informacion					=	get_cf_ciclos_pagos_new($v->id_empresa,0);
				$escala_escala_x_user_id			=	get_escala_x_user_id2($v->user_id);
				$ciclos_pagos_end   				=   get_ciclos_pagos_now();
				/* - - - - - - */

				/* -- CALCULO DEL TRM --- */

				if(!empty(valor_trm()->Valor_trm)){
					if(valor_trm()->Valor_trm > 0){
						$valor_trm = valor_trm()->Valor_trm;
					}
				}else{
					$fecha = calculo_fechas($ciclo_informacion->fecha_hasta,$cantidad_dias='+1');
					if( $fecha > date("Y-m-d")){
						$valor_trm								=	trm_vigente(true);
					}else{
						$trm_default								=	@periodotrm($fecha)->monto;
						if(empty($valor_trm)){
							$valor_trm = trm_vigente(true);
						}else{
							$valor_trm = $trm_default;
							if(empty($valor_trm)){
								$valor_trm = trm_vigente(true);
							}
						}
					}
				}
				$trm_now = $valor_trm;
				if(!empty($escala_escala_x_user_id) && !empty($config)){
					if($escala_escala_x_user_id->Descuento == "valor fijo" && @$config->Tipo_Valor != "Manual"){
            			$trm_now = $valor_trm - $escala_escala_x_user_id->Descuento_dolar;
            		}
				}

				/*INFORMACION PERIODO DE PAGO DE LA EMPRESA*/
				$periodo_pagos						=	centrodecostos($v->id_empresa);
				$trm_ciclo							=	trm_ciclo($periodo_pagos->periodo_pagos,get_ciclo_pago($periodo_pagos->periodo_pagos),date("m") - 1);
				/* - - - - - - */

				/*INFORMACION PAGO PERFIL*/
				$DiasTrabajados									=	DiasTrabajados($v->user_id,$ciclo_informacion->fecha_desde);
				if(!empty($DiasTrabajados)){$dias_trabajados	=	$DiasTrabajados->dias_trabajados;}else{$dias_trabajados = 15;}
				$escala											=	get_escala_x_user_id($v->user_id);
				$factorBonificacion								=	number_format(@$escala_escala_x_user_id->factor_bonificacion, 5, '.', '');
				$varmeta										=	predateoFactorBonificacion(@$escala_escala_x_user_id->meta,$dias_trabajados);
				$totalRQ		=	0;
				$totalP			=	0;
				foreach($this->HonorariosModelos($v->user_id) as $v2){
					$user_id						=	$v->user_id;
					$nickname_id					=	$v2->nickname_id;
					@$get_diario						=	get_diario($user_id,$nickname_id,$ciclo_informacion->fecha_desde,$ciclo_informacion->fecha_hasta);
					//pre($get_diario);
					$conversion_token_standar		=	conversion_token_standar(@$get_diario->monto,$v2->equivalencia);
					$totalRQ						=	$totalRQ + $conversion_token_standar;


					$items_factura_x_nickname		=	items_factura_x_nickname($v2->nickname_id);
					if(!empty($items_factura_x_nickname)){
						$items_factura_x_nickname	=	json_decode($items_factura_x_nickname->json);
					}
					if(!empty($items_factura_x_nickname)){
						$produccion					=	$items_factura_x_nickname->monto_global_usd;
					}else{
						$produccion					=	0;
					}
					//pre( $produccion );
					$totalP			=	$totalP + conversion_token_standar(@$produccion,$v2->equivalencia);
					$conversion		=	conversion_token_standar(@$produccion,$v2->equivalencia);
				}


				/*OTROS INGRESOS*/
				$valor_total	= 0;
				$ListOtrosIngresos	=	OtrosIngresos($v->user_id);
				if(count($ListOtrosIngresos)>0){
					foreach($ListOtrosIngresos as $v2){
						$valor_total	= 	$valor_total+$v2->debito;

					}
				}

				/*OTROS DESCUENTOS*/

				$total_monto_cuota	=	0;
				$total_restante		=	0;
				$ListOtrosIngresos	=	Descuentos($v->user_id);
				if(count($ListOtrosIngresos)>0){
					foreach($ListOtrosIngresos as $v2){
						$cantidad_de_cuotas 	= 	CountCuotasDescuentos($v2->descuento_id)->total;
						$monto_cuota			=	$v2->valor / $v2->nro_quincenas;
						$total_monto_cuota		=	$total_monto_cuota + $monto_cuota;
						$restar_a_valor			= 	$cantidad_de_cuotas + 1	* $monto_cuota;
						$restante				=	$v2->valor -  $restar_a_valor;
						$total_restante			=	$total_restante + $restante;
					}
				}

				$escala_salario 			=	calcula_montos_x_dias(@$escala_escala_x_user_id->auxilio_transporte,$dias_trabajados);
				$eps						=	calcula_montos_x_dias(@$escala_escala_x_user_id->eps,$dias_trabajados);
				if($eps>0){
					$total_monto_cuota		= 	$total_monto_cuota+$eps;
				}
				$arl						=	calcula_montos_x_dias(@$escala_escala_x_user_id->arl,$dias_trabajados);
				if($arl>0){
					 $total_monto_cuota		= 	$total_monto_cuota+$arl;
				}

				$bonificacion				=	calcular_bonificacion($varmeta,$totalP,$factorBonificacion,$trm_now);

				if(!empty($escala_escala_x_user_id)){
					$salario		=	calcula_montos_x_dias(@$escala_escala_x_user_id->salario,$dias_trabajados);
					$salario_var	=	(format($salario,false));
				}else{
					$salario_var	=	0;
				}
				$aux				=	calcula_montos_x_dias(@$escala_escala_x_user_id->caja_compensacion,$dias_trabajados);
				$ahorro_prima		=	@$salario + @$escala_salario + @$eps + @$arl + @$aux + @$bonificacion;
				$total_ahorro_prima	=	($ahorro_prima * @$escala_escala_x_user_id->prima)/100;
				if($total_ahorro_prima>0){
					$total_monto_cuota	= 	$total_monto_cuota+$total_ahorro_prima;
				}
				if($aux>0){
					$total_monto_cuota	= 	$total_monto_cuota+$aux;
				}
				$ortros_ingresos 		=	TotalOtrosIngresos($v->user_id);

				$primas					=	round($ahorro_prima, 0) + round($total_ahorro_prima,0);
				$hacia_arriba			=	round($primas, -3);

				$resultado				=	$primas	- $hacia_arriba;

				$totalizacion_general	=	@$salario + @$escala_salario + @$eps + @$arl + @$aux + @$bonificacion + @$ortros_ingresos->valor + @$total_ahorro_prima;


				$total_ingresos			=	$totalizacion_general -	$total_monto_cuota;
				$subtotal				=	$totalizacion_general - $total_monto_cuota;

				if(@$config->ajustar_decena==1 || @$config->porcentaje_retencion>0){
					if(!empty($config->porcentaje_retencion)){
						$porcentaje_retencion	=	$config->porcentaje_retencion / 100;
					}else{
						$porcentaje_retencion	=	0;
					}
				}
				$subtotal  			=  	$subtotal - ($subtotal * @$porcentaje_retencion);

				$subtotal1			=	round($totalizacion_general - $total_monto_cuota, -3 );
				$ajuste_restante	=	$totalizacion_general - $total_monto_cuota;

				if(@$config->ajustar_decena==1){
					$ajuste_a_decena		=	$subtotal - $subtotal1;
					$ajuste_a_la_decena		=	ajuste_a_la_decena($subtotal - $subtotal1);

					$final_ajuste_a_la_decena	=	$ajuste_restante - ajuste_a_la_decena($subtotal - $ajuste_a_decena);

					if($final_ajuste_a_la_decena<0){
						$final_ajuste_a_la_decena	=	str_replace("-","+",$final_ajuste_a_la_decena);
					}else{
						$final_ajuste_a_la_decena	=	"+".$final_ajuste_a_la_decena;
					}
					$ajuste_a_la_decena	=	ajuste_a_la_decena($subtotal);
				}else{
					$ajuste_a_decena	=	$subtotal - $subtotal1;
					$ajuste_a_la_decena	=	$subtotal ;
				}

				//pre($this->user);
				$chequeo	=	chequear_Honorarios_X_ciclo_de_produccion($v->user_id,$this->user->ciclo_produccion_id);

				if(!empty($chequeo)){
					$chequeo2				=	chequear_Honorarios_Pagados_X_ciclo_nro_documento($v->user_id,$chequeo->consecutivo);
					$chequeo3				=	sum_Honorarios_Pagados_X_ciclo_nro_documento($v->user_id,$chequeo->consecutivo);

					if($chequeo->estatus==9){
						/*
						$activos[$k]								=	new stdClass();
						$activos[$k]->escala						=	$escala;
						$activos[$k]->ajuste_a_la_decena			=	$ajuste_a_la_decena;
						$activos[$k]->v								=	$v;	*/
					}



					/*
					if(!empty($chequeo2) && ($chequeo3->credito == $chequeo->debito)){
						$pagados[$k]								=	new stdClass();
						$pagados[$k]->chequeo						=	$chequeo2;
						$pagados[$k]->escala						=	$escala;
						$pagados[$k]->ajuste_a_la_decena			=	$ajuste_a_la_decena;
						$pagados[$k]->v								=	$v;
					}else{
						$aprobados[$k]								=	new stdClass();
						$aprobados[$k]->chequeo						=	$chequeo;
						$aprobados[$k]->escala						=	$escala;
						if(is_object($chequeo2)){
							$aprobados[$k]->ajuste_a_la_decena			=	@$chequeo->debito-@$chequeo2->credito ;
						}else{
							$aprobados[$k]->ajuste_a_la_decena			=	$ajuste_a_la_decena ;
						}
						$aprobados[$k]->v							=	$v;
					}	*/

					$aprobados[$k]								=	new stdClass();
					$aprobados[$k]->chequeo						=	$chequeo;
					$aprobados[$k]->escala						=	$escala;
					if(is_object($chequeo2)){
						$aprobados[$k]->ajuste_a_la_decena			=	@$chequeo->debito-@$chequeo2->credito ;
					}else{
						$aprobados[$k]->ajuste_a_la_decena			=	$ajuste_a_la_decena ;
					}
					$aprobados[$k]->v							=	$v;
					//pre($chequeo);
					//pre($chequeo2);
					//pre($chequeo3);
					//return;
					if(!empty($chequeo2) && ($chequeo3->credito == $chequeo->debito)){
						$aprobados[$k]->estatus						=	"pagados";
					}else{
						$aprobados[$k]->estatus						=	"aprobado";
					}
					if($chequeo->estatus==9){
						$aprobados[$k]->estatus						=	"Anulada";
					}

				}else{
					//pre($v);
					if(isset($escala->nombre_escala)){
						$activos[$k]								=	new stdClass();
						$activos[$k]->escala						=	$escala;
						$activos[$k]->ajuste_a_la_decena			=	$ajuste_a_la_decena;
						$activos[$k]->v								=	$v;
					}else{
						$pendientes[$k]								=	new stdClass();
						$pendientes[$k]->escala						=	$escala;
						$pendientes[$k]->ajuste_a_la_decena			=	$ajuste_a_la_decena;
						$pendientes[$k]->v							=	$v;
					}
				}
			}
		}
		return $this->result 	= 	array("activos"=>$activos,"pendientes"=>$pendientes,"aprobados"=>$aprobados,"pagados"=>$pagados);
	}

	public function AnularDescuentos(){
		$tabla			=	DB_PREFIJO."rp_operaciones";
		$tabla2			=	DB_PREFIJO."rp_descuentos";
		$var['estatus'] = 	9;
		$var['responsable_anular'] = $this->user->user_id;
		$this->db->where('nro_documento',$this->uri->segment(3));
		$this->db->where('empresa_id',$this->user->id_empresa);
		$this->db->where('tipo_documento',12);
		if($this->db->update($tabla,$var)){
		unset($var['responsable_anular']);
		$this->db->where('empresa_id',$this->user->id_empresa);
		$this->db->where('descuento_id',$this->uri->segment(3));
		$this->db->update($tabla2,$var);
			return true;
		}else{
			return false;
		}
	}

	public function DeleteNickname($nickname,$id_empresa){
		$return = true;
		$tabla				=	DB_PREFIJO."rp_tmp" ;
		$this->db->where("nickname", $nickname);
		$this->db->where("id_empresa", $id_empresa);
		if(!$this->db->delete($tabla)){
			$return = false;
		}
		$tabla				=	DB_PREFIJO."cf_nickname";
		$this->db->where("nickname", $nickname);
		$this->db->where("id_empresa", $id_empresa);
		if(!$this->db->delete($tabla)){
			$return = false;
		}
		return $return;
	}

	public function get_descuento($descuento_id){
		$tabla					=	DB_PREFIJO."rp_descuentos t1";
		$this->db->select("	descuento_id,
							primer_nombre,
							segundo_nombre,
							primer_apellido,
							t1.centro_de_costos,
							segundo_apellido,
							concepto,
							observacion,
							nro_quincenas,
							valor,
							t1.user_id,
							t1.empresa_id");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."usuarios t2", 't1.user_id=t2.user_id', 'left');
		$this->db->where("t1.descuento_id",$descuento_id);
		$query					=	$this->db->get();
		return $this->result 	=	$query->row();
	}


	public function get($user_id,$type=''){
		$tabla				=		"usuarios t1";
		//pre($this->user); return;
		if($this->uri->segment($this->uri->total_segments()) == "edit"){
			$this->db->select("t1.*,t2.consecutivo_id");
		}
		$this->db->from($tabla);
		if($this->uri->segment($this->uri->total_segments()) == "edit"){
			$this->db->join(DB_PREFIJO."sys_contratos t2",'t1.user_id = t2.user_id','left');
		}
		$this->db->where("t1.user_id",$user_id);
		$this->db->where("t1.empresa_id",$this->user->empresa_id);
		/*if($this->user->principal==0){
			//$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
		}*/
		if(!empty($type)){
			//$this->db->where("t1.type",$type);
		}
		$query					=	$this->db->get();
		return	$this->result 	=	$query->row();
	}

	public function SetTotalizado($var){
		$tabla				=		DB_PREFIJO."usuarios" ;
		$this->db->where("user_id", $var['modelo']);
		return $this->db->update($tabla,array("json_honorarios"=>json_encode(array("honorarios"=>$var['honorarios']))));
	}

	public function ResumenModelos(){
		$tabla			=		DB_PREFIJO."usuarios t1" ;
		$datos			=		"	t1.user_id,
									t1.primer_nombre,
									t1.segundo_nombre,
									t1.primer_apellido,
									t1.segundo_apellido,
									CONCAT(t1.cod_telefono,' ',t1.telefono) AS contactos,
									CASE WHEN t1.estado=1 THEN 'Activo' ELSE 'Inactivo' END AS estado,
									GROUP_CONCAT(t3.nickname) as list_nicknames,
									GROUP_CONCAT(t3.password) as pass,
									GROUP_CONCAT((SELECT primer_nombre FROM ".DB_PREFIJO."usuarios t4 WHERE t4.user_id = t3.id_plataforma)) as list_plataformas,
									t1.cod_telefono,
									t1.telefono,
									t1.cod_otro_telefono,
									t1.otro_telefono,
									t1.email,
									t1.type,
									t2.abreviacion";
		/*EXTRAIGO PERFILES ACTIVO  E INACTIVOS POR SEPARADOS*/
		$this->db->select($datos)->from($tabla)
			->join(DB_PREFIJO."usuarios t2",'t1.centro_de_costos=t2.user_id','left')
			->join(DB_PREFIJO."cf_nickname t3",'t1.user_id=t3.id_modelo','left')
			->join(DB_PREFIJO."usuarios t4","t4.user_id = t3.id_plataforma",'left')
			->where('t1.type', 'Modelos')->where('t1.estado',1)->where("t1.id_empresa",$this->user->id_empresa)->where("t4.primer_nombre !=","Email");
		if($this->user->principal==0){	$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);	}
		$this->db->group_by('t1.user_id','ASC');
		$this->db->order_by('t1.primer_nombre','ASC');
		$query			=	$this->db->get();
		$rows		 	=	$query->result();

		$this->db->select($datos)->from($tabla)
			->join(DB_PREFIJO."usuarios t2",'t1.centro_de_costos=t2.user_id','left')
			->join(DB_PREFIJO."cf_nickname t3",'t1.user_id=t3.id_modelo','left')
			->join(DB_PREFIJO."usuarios t4","t4.user_id = t3.id_plataforma",'left')
			->where('t1.type', 'Modelos')->where('t1.estado',0)->where("t1.id_empresa",$this->user->id_empresa)->where("t4.primer_nombre !=","Email");
		if($this->user->principal==0){	$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);	}
		$this->db->group_by('t1.user_id','ASC');
		$this->db->order_by('t1.primer_nombre','ASC');
		$query			=	$this->db->get();
		$rows2		 	=	$query->result();

		$this->result	=	array("activos"=>$rows,"inactivos"=>$rows2);
	}

	public function ResumenPaginas(){
		$this->ResumenModelos();
	}

	public function ResumenSeguridadSocial($type = array('Modelos','Administrativos','Monitores')){
		$tabla				=		DB_PREFIJO."usuarios t1";

		$this->db->select(     "t1.centro_de_costos,
								t1.user_id,
								t1.direccion,
								t1.ciudad,
								t1.departamento,
								t1.pais,
								t1.cod_telefono,
								t1.telefono,
								t1.cod_otro_telefono,
								t1.otro_telefono,
								t1.email,
								t1.estado,
								t1.primer_nombre,
								t1.segundo_nombre,
								t1.primer_apellido,
								t1.segundo_apellido,
								t1.eps,
								t1.caja_de_compensacion,
								t1.pension,
								t1.arl,
								t1.type,
								t2.eps,
								t3.abreviacion");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."sys_eps t2","t1.eps=t2.id","left");
		$this->db->join(DB_PREFIJO."usuarios t3","t1.centro_de_costos = t3.user_id","left");
		$this->db->where("t1.id_empresa",$this->user->id_empresa);
		$this->db->where_in("t1.type",$type);
		$query			=	$this->db->get();
		$return			=	array();
		foreach($query->result() as $v){
			$return[$v->type][]		=	$v;
		}
		$this->result = $return;
	}

	public function OtrosIngresos(){
		$tabla				=		DB_PREFIJO."rp_operaciones t1" ;
		$this->db->select("t1.*");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."usuarios t2", 't1.modelo_id 	= 	t2.user_id', 'left');
		//$this->db->where_in('t2.type',array('Asociados', 'Proveedores', 'Modelos'));
		$this->db->where('t2.estado',1);
		$this->db->where('t1.tipo_documento',31);
		$this->db->where("t1.empresa_id",$this->user->id_empresa);
		$this->db->group_by(array("t1.consecutivo"));
		$query			=	$this->db->get();
		$this->result 	=	$query->result();
	}

	public function HonorariosModelos($id_modelo){
		$tabla	=	DB_PREFIJO."cf_nickname t1";
		$this->db->select("*");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."usuarios t2", 't1.id_plataforma 	= 	t2.user_id', 'left');
		$this->db->where('t1.id_modelo',$id_modelo);
		$this->db->where("t1.id_empresa",$this->user->id_empresa);
		$this->db->where("t2.estado",1);
		$this->db->where("t1.estado",1);
		$this->db->where_not_in("t2.moneda_de_pago",array('RSS','Free'));
		$this->db->order_by('t2.primer_nombre','ASC');
		$query			=	$this->db->get();
		return $query->result();
	}

	public function CertificadoLaboral($names=null){
		$tabla				=		DB_PREFIJO."usuarios t1" ;
		$this->db->select("*");
		$this->db->from($tabla);
		if(empty($names)){
			$names 	= 	array('Administrativos', 'Monitores', 'Modelos', 'Asociados');
		}
		$this->db->where_in('t1.type', $names);
		$this->db->where('t1.estado',1);
		$this->db->where("t1.id_empresa",$this->user->id_empresa);
		if($this->user->principal==0){
			$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
		}
		$this->db->order_by('t1.primer_nombre','ASC');
		$query=$this->db->get();
		$row=$query->result();
		/*$return['activos']=array();
		$return['pendientes']=array();
		foreach($row as $k => $v){
			$escala	=	escala($v->id_escala);
			if(isset($escala->nombre_escala)){
				$return['activos'][]	=	$v;
			}else{
				$return['pendientes'][]	=	$v;
			}
		}*/
		$this->result	=	$row;
	}

	public function Cumpleanos(){
		$tabla				=		DB_PREFIJO."usuarios t1";
		$this->db->select("*,MONTH(fecha_nacimiento) mes_nacimiento,DAY(fecha_nacimiento) dia_nacimiento");
		$this->db->from($tabla);
		$names 	= 	array('Asociados', 'Proveedores', 'Modelos', 'CentroCostos');
		$this->db->where_in('type', $names);
		$this->db->where("MONTH(fecha_nacimiento) = '".date('m')."'");
		$this->db->where("t1.id_empresa",$this->user->id_empresa);
		if($this->user->principal==0){
			$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
		}
		if($this->user->mostrar_inactivos==1){
			$this->db->where('t1.estado', 1);
		}else{
			$this->db->where('t1.estado', "ANY");
		}
		$query			=	$this->db->get();
		$this->result 	=	$query->result();
	}

	public function setDiasTrabajados($var){
		$tabla		=		DB_PREFIJO."rp_dias_trabajados";
		if(isset($var['redirect'])){
			unset($var['redirect']);
		}
		$var['id_empresa']			=	(post("id_empresa"))?post("id_empresa"):$this->user->id_empresa;
		//$var['centro_de_costos']	=	(post("centro_de_costos"))?post("centro_de_costos"):$this->user->centro_de_costos;

		if(!empty($var['dias_trabajados_id'])){
			$this->db->where("dias_trabajados_id", $var['dias_trabajados_id']);
			if($this->db->update($tabla,$var)){
				return array("error"=>array(	"callback"	=>	"set_count('".post("user_id")."','".post("dias_trabajados")."')",
												"code"		=>	"200"));
				return true;
			}else{
				return array("error"=>array(	"message"	=>	"Lo siento, no ha sido modificado",
												"code"		=>	"203"));
			}
		}else{
			if($this->db->insert($tabla,$var)){
				return array("error"=>array(	"callback"	=>	"set_count('".post("user_id")."','".post("dias_trabajados")."')",
												"code"		=>	"200"));
				return true;
			}else{
				return array("error"=>array(	"message"	=>	"Lo siento, no ha sido modificado",
												"code"		=>	"203"));
			}
		}
	}

	public function set_Descuentos($var){
		$value			=	@$var['value'];
		$var['centro_de_costos'] = centrodecostos($var['user_id'])->centro_de_costos;
		//$donde_debitar	=	@$var['donde_debitar'].'_id';
		$tabla=DB_PREFIJO."rp_descuentos";
		$this->db->select("descuento_id,empresa_id");
		$this->db->from($tabla);
		$this->db->where("descuento_id",@$var['descuento_id']);
		$query				=	$this->db->get();
		$row				=	$query->row();
		$var['empresa_id']	=	$this->user->id_empresa;
		unset($var["iframe"]);
		if(!empty($row) && ($row->empresa_id == $this->user->id_empresa)){
			$this->db->where("descuento_id",$var['descuento_id']);
			$this->db->update($tabla,$var);
			return true;
		}else if(empty($row)){
			$tipo_documento		=	12;
			if($var['tipo_descuento'] == "Tercero"){
				$codigo_contable	=	134595;
				$codigo_contable_destino	=	281505;
			}else if($var['tipo_descuento'] == "Propio"){
				$codigo_contable	=	134595;
				$codigo_contable_destino	=	425530;
			}else{
				$codigo_contable	=	138020;
			}
			$var['estatus']		=	1;
			$procesador_destino_codigo_contable	= @$var['procesador_destino_codigo_contable'];
			//$procesador_destino_codigo_contable_subfijo	= $var['procesador_destino_codigo_contable_subfijo'];
			unset($var['value'],$var['procesador_destino_codigo_contable'],$var['procesador_destino_codigo_contable_subfijo']);
			$consecutivo					=	consecutivo($this->user->id_empresa,$tipo_documento);
			$var['consecutivo'] 			= $consecutivo;
			$this->db->insert($tabla,$var);
			$ultimo_id = $this->db->insert_id();
			$observacion["url"] = base_url("Usuarios/VerDescuentos/".$ultimo_id."/View#observaciones");
			$observacion["observacion"] = $var['observacion'];
			insertar_Observacion($observacion);

			$nro_documento					=	$ultimo_id;
			$ciclos_pagos_end  				=   get_ciclos_pagos_end();

			$insert							=	new stdClass();
			$insert->responsable_id			=	$this->user->user_id;
			$insert->consecutivo			=	$consecutivo;
			$insert->empresa_id				=	$this->user->id_empresa;
			$insert->fecha					=	date("Y-m-d");
			$insert->estatus				=	1;
			$insert->centro_de_costos		=	$var['centro_de_costos'];
			$insert->nro_documento			=	$nro_documento;
			$insert->tipo_documento			=	$tipo_documento;
			$insert->codigo_contable		=	$codigo_contable;
			$insert->ciclo_produccion_id	=	get_ciclos_pagos_now_x_id(@$ciclos_pagos_end->ciclos_id);
			$insert->nickname_id			=	0;
			//$insert->$donde_debitar			=	$value;
			$insert->modelo_id				=	$var['user_id'];
			$insert->debito					=	$var['valor'];
			$insert->credito				=	0;
			$insert->json					=	json_encode($var);
			//pre($insert);return;
			if(registro_contable($insert)){
				/*if($donde_debitar!='caja_id'){
					$this->db->select("*");
					$this->db->from(DB_PREFIJO."fi_cuentas");
					$this->db->where("id_cuenta",$value);
					$query				=	$this->db->get();
					$cuenta_bancarias	=	$query->row();
					$codigo_contable	=	$cuenta_bancarias->codigo_contable;
				}else{
					$codigo_contable	=	110505;
				}*/

				//$codigo_contable			=	$procesador_destino_codigo_contable;
				//$codigo_contable_subfijo	=	$procesador_destino_codigo_contable_subfijo;
				$var['estatus']		=	1;

				$insert							=	new stdClass();
				$insert->responsable_id			=	$this->user->user_id;
				$insert->consecutivo			=	$consecutivo;
				$insert->empresa_id				=	$this->user->id_empresa;
				$insert->fecha					=	date("Y-m-d");
				$insert->estatus				=	1;
				$insert->centro_de_costos		=	$var['centro_de_costos'];
				$insert->nro_documento			=	$nro_documento;
				$insert->tipo_documento			=	$tipo_documento;
				$insert->codigo_contable		=	$codigo_contable_destino;
				//$insert->codigo_contable_subfijo=	$codigo_contable_subfijo;
				$insert->ciclo_produccion_id	=	get_ciclos_pagos_now_x_id(@$ciclos_pagos_end->ciclos_id);
				$insert->nickname_id			=	0;
				//$insert->$donde_debitar			=	$value;
				$insert->modelo_id				=	$var['user_id'];
				$insert->credito				=	$var['valor'];
				$insert->debito					=	0;
				$insert->json					=	json_encode($var);
				registro_contable($insert);
				incrementa_consecutivo($this->user->id_empresa,$tipo_documento);
			}
			return true;
		}else{

			return false;
		}
	}

	public function setOtrosIngresos(){
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

	public function setOtrosIngresos_OLD($var){
		$tabla		=		DB_PREFIJO."rp_otros_ingresos";
		if(isset($var['redirect'])){
			unset($var['redirect']);
		}
		unset($var["iframe"]);
		$var['id_empresa']			=	(post("id_empresa"))?post("id_empresa"):$this->user->id_empresa;
		$var['centro_de_costos']	=	post("centro_de_costos");

		if($this->db->insert($tabla,$var)){
			$insert_id			=	$this->db->insert_id();
			logs($this->user,1,$tabla,$insert_id,"rp_otros_ingresos","1",$var);
			return $insert_id;
		}else{
			return false;
		}
	}

	public function get_Descuentos($user_id){
		$tabla				=		DB_PREFIJO."usuarios t1";
		$this->db->select("*");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."rp_descuentos t2", 't1.user_id 	= 	t2.user_id', 'left');
		$this->db->where("t1.user_id",$user_id);
		if(!empty($type)){
			$this->db->where("t1.type",$type);
		}
		if($this->user->mostrar_inactivos==0){
			$this->db->where('t1.estado', 1);
		}
		$query			=	$this->db->get();
		$this->result 	=	$query->row();
	}

	public function getNickname($nickname_id){
		$tabla				=		DB_PREFIJO."cf_nickname t1";
		$this->db->select("*");
		$this->db->from($tabla);
		$this->db->where("nickname_id",$nickname_id);
		$query			=	$this->db->get();
		$this->result 	=	$query->row();
	}

	public function getNicknames($id_modelo,$rss=false,$estatus=""){
		$tabla				=		DB_PREFIJO."cf_nickname t1";
		$this->db->select("t1.*,t2.primer_nombre as plataforma,t2.tipo_persona as tipo");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."usuarios t2", 't1.id_plataforma 	= 	t2.user_id', 'left');
		$this->db->where("t1.id_empresa",$this->user->id_empresa);
		//$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
		$this->db->where('t1.id_modelo', $id_modelo);
		if($rss){
			$this->db->where("t2.moneda_de_pago<>","RSS");
		}
		if($estatus!=""){
			$this->db->where("t1.estado",$estatus);
		}
		$this->db->order_by('primer_nombre','ASC');
		$query			=	$this->db->get();
		$this->result 	=	$query->result();
	}

	public function getModelos($type = array("Modelos")){
		$tabla				=		DB_PREFIJO."usuarios t1";
		foreach ($type as $k => $v) {
			$this->db->select("*");
			$this->db->from($tabla);
			$this->db->where("t1.id_empresa",$this->user->id_empresa);
			//$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
			if($this->user->principal<>1){
				$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
			}
			if($this->user->mostrar_inactivos==0){
				$this->db->where('t1.estado', 1);
			}
			$this->db->where_in("type",$v);
			$this->db->where("estado",1);
			$this->db->order_by('primer_nombre','ASC');
			$query			=	$this->db->get();
			if(count($type) > 1){
				$this->result[$v] 	=	$query->result();
			}
		}
		if(count($type) <= 1){
			$this->result 	=	$query->result();
		}
	}

	public function get_FormasPagos(){
		$tabla					=	DB_PREFIJO."ve_forma_pagos";
		$this->db->select("*");
		$this->db->from($tabla);
		$query					=	$this->db->get();
		return $this->result 	=	$query->result();
	}

	public function get_usuarios_descuentos($id=false,$operaciones = false){
		$tabla					=	DB_PREFIJO."rp_descuentos t1";
		if($operaciones){
			$extra = ",t3.*";
		}else{
			$extra = "";
		}
		$this->db->select("	t1.descuento_id,
							t2.primer_nombre,
							t2.segundo_nombre,
							t2.primer_apellido,
							t2.segundo_apellido,
							t1.concepto,
							t1.consecutivo,
							t1.observacion,
							t1.nro_quincenas,
							t1.valor,
							t1.user_id".$extra);
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."usuarios t2", 't1.user_id	=	t2.user_id', 'left');
		if($operaciones){
			$this->db->join(DB_PREFIJO."rp_operaciones t3", 't1.descuento_id=t3.nro_documento', 'left');
			$this->db->where('t3.tipo_documento',12);
			$this->db->where('t3.debito >',0);
		}
		$this->db->where('t1.empresa_id',$this->user->id_empresa);
		if($this->user->principal != 1){
			$this->db->where('t1.centro_de_costos',$this->user->centro_de_costos);
		}
		$this->db->where('t1.estatus',1);
		if($id){
			$this->db->where('t1.user_id',$id);
		}
		$this->db->order_by('user_id','ASC');
		$query					=	$this->db->get();
		if($id){
			return $this->result 	=	$query->row();
		}else{
			return $this->result 	=	$query->result();
		}
	}

	public function get_usuario_descuentos($descuento_id){
		$tabla					=	DB_PREFIJO."rp_descuentos t1";
		$this->db->select("	t3.codigo_contable,
							t3.credito,
							t3.debito,
							t3.fecha,
							t3.responsable_id,
							t3.ciclo_produccion_id,
							t2.primer_nombre,
							t2.segundo_nombre,
							t2.primer_apellido,
							t2.segundo_apellido,
							t1.concepto,
							t1.observacion,
							t1.nro_quincenas,
							t1.valor,
							t1.user_id,
							t1.Proveedor,
							t1.estatus,
							t1.centro_de_costos,
							t1.tipo_descuento");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."usuarios t2", 't1.user_id=t2.user_id', 'left');
		$this->db->join(DB_PREFIJO."rp_operaciones t3", 't1.descuento_id=t3.nro_documento', 'left');
		$this->db->where('t1.descuento_id',$descuento_id);
		$this->db->where('t3.tipo_documento',12);
		//$this->db->where_in('t3.codigo_contable',array(414580,110505));
		$query					=	$this->db->get();
		return $this->result 	=	$query->result();
	}

	public function get_RolesForm($rol_id=''){
		$tabla						=	"sys_roles";
		$this->db->select("*")->from($tabla);
		if(!empty($rol_id)){
			$this->db->where("rol_id",$rol_id);
		}
		$this->roles				=	$this->db->get()->row();
		$tabla						=	"sys_roles_modulos";
		$this->roles_modulos_padre	=	$this->db->select("*")->from($tabla)->where('modulo_padre',0)->get()->result();
		$this->roles_modulos_hijos	=	array();
		$this->roles_modulos_nietos	=	array();
		foreach($this->roles_modulos_padre as $k =>$v){
			$hijos									=	$this->db->select("*")->from($tabla)->where('modulo_padre',$v->id)->get()->result();
			$this->roles_modulos_hijos[$v->id][]	=	$hijos;
			foreach($hijos as $k2 => $v2){
				$this->roles_modulos_nietos[$v2->id]	=	$this->db->select("*")->from($tabla)->where('modulo_padre',$v2->id)->get()->result();
			}
		}
	}

	public function SeguridadSocial($names=array(),$user=null){
		$tabla				=		DB_PREFIJO."usuarios t1";
		$this->db->select("t1.*,t2.*,t3.nombre_escala,t3.estado,t4.Entidad as entidad_bancaria,t4.banco_id,t5.abreviacion as Sucursal,t6.consecutivo_id,t6.id as contrato_id,t6.fecha_creacion,t7.data");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."sys_eps t2", 't1.eps=t2.id', 'left');
		$this->db->join(DB_PREFIJO."ve_escala_pagos t3", 't1.id_escala=t3.id_escala', 'left');
		$this->db->join(DB_PREFIJO."sys_bancos t4", 't1.entidad_bancaria=t4.banco_id', 'left');
		$this->db->join(DB_PREFIJO."usuarios t5", 't1.centro_de_costos=t5.user_id', 'left');
		$this->db->join(DB_PREFIJO."sys_contratos t6", 't1.user_id=t6.user_id', 'left');
		$this->db->join(DB_PREFIJO."ut_form_control t7", 't1.user_id = t7.user_id','left');

		if(!empty($user)){
			$this->db->where_in('t1.user_id', $user);
		}

		if(count($names)==0){
			//$names 				= 		array('Modelos', 'Monitores', 'Administrativos', 'Asociados');
			/*DAVID PIDIO SÓLO MODELOS*/
			$names 				= 		array('Modelos');

		}
		$this->db->where_in('t1.type', $names);
		if($this->user->principal<>1){
			$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
		}

		$this->db->where('t1.estado', 1);

		if($this->user->mostrar_inactivos==0){}
		$this->db->where("t1.id_empresa",$this->user->id_empresa);
		if($this->uri->segment(3) != "cf_meta"){
			$this->db->group_by('user_id');
		}
		$this->db->order_by('primer_nombre','ASC');
		$this->db->limit(ELEMENTOS_X_PAGINA,$this->Usuarios->pagination);
		$query				=	$this->db->get();
		$this->result 		=	$query->result();
		//pre($this->result);
		$this->total_rows	= 	$this->total_filas($tabla);
	}

	public function AllUsersSucursales($names=array(),$user=null){
		$tabla				=		DB_PREFIJO."usuarios t1";
		$this->db->select("	t2.abreviacion,
							t2.n_rooms,
							GROUP_CONCAT(	t1.room_transmision SEPARATOR '|s|') AS room_transmision,
							GROUP_CONCAT(	t1.primer_nombre,
											' ',
											t1.segundo_nombre,
											' ',
											t1.primer_apellido,
											' ',
											t1.segundo_apellido SEPARATOR '|s|') AS nombre_modelo,
							GROUP_CONCAT(	t1.turno_manama SEPARATOR '|s|') AS turno_manama,
							GROUP_CONCAT(	t1.turno_tarde SEPARATOR '|s|') AS turno_tarde,
							GROUP_CONCAT(	t1.turno_noche SEPARATOR '|s|') AS turno_noche,
							GROUP_CONCAT(	t1.turno_intermedio SEPARATOR '|s|') AS turno_intermedio");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."usuarios t2", 't1.centro_de_costos=t2.user_id', 'left');
		if($this->user->principal<>1){
			$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
		}
		$this->db->where("t1.id_empresa",$this->user->id_empresa);
		$this->db->where("t1.type","Modelos");
		$this->db->where("t1.room_transmision",1000000);
		$this->db->where("t1.estado ",1);
		//$this->db->group_by(array("t1.centro_de_costos"));
		$query						=	$this->db->get();
		$this->result['satelite']	=	$query->result();

		$this->db->select("	t2.abreviacion,
							t2.n_rooms,
							t2.turno_manama as manana,
							t2.turno_tarde as tarde,
							t2.turno_noche as noche,
							t2.turno_intermedio as intermedio,
							GROUP_CONCAT(	t1.room_transmision SEPARATOR '|s|') AS room_transmision,
							GROUP_CONCAT(	t1.primer_nombre,
											' ',
											t1.segundo_nombre,
											' ',
											t1.primer_apellido,
											' ',
											t1.segundo_apellido SEPARATOR '|s|') AS nombre_modelo,
							GROUP_CONCAT(	t1.turno_manama SEPARATOR '|s|') AS turno_manama,
							GROUP_CONCAT(	t1.turno_tarde SEPARATOR '|s|') AS turno_tarde,
							GROUP_CONCAT(	t1.turno_noche SEPARATOR '|s|') AS turno_noche,
							GROUP_CONCAT(	t1.turno_intermedio SEPARATOR '|s|') AS turno_intermedio");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."usuarios t2", 't1.centro_de_costos=t2.user_id', 'left');
		if($this->user->principal<>1){
			$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
		}
		$this->db->where("t1.id_empresa",$this->user->id_empresa);
		$this->db->where("t1.type","Modelos");
		$this->db->where("t1.room_transmision !=",1000000);
		$this->db->where("t1.estado ",1);
		$this->db->group_by(array("t1.centro_de_costos"));
		$query						=	$this->db->get();
		$this->result['sede']	=	$query->result();
		$this->total_rows	= 	$this->total_filas($tabla);
	}

	public function ContratoModelo(){
		$tabla				=		DB_PREFIJO."usuarios";
		$this->db->select("*");
		$this->db->from($tabla);
		$this->db->where('user_id',$this->uri->segment(3));
		$query				=	$this->db->get();
		$this->result 		=	$query->result();
		//pre($this->result);
		$this->total_rows	= 	$this->total_filas($tabla);
	}

	public function get_Roles(){
		$tabla				=		"sys_roles";
  		$html_group_open	=		'<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">';
		$html_group_close	=		'</div>';
		$edit_open			=		$html_group_open.'<a class="btns btn-secondarys lightbox" title="Editar usuario" data-type="iframe" href="'.base_url($this->uri->segment(1).'/AddRol/');
		$edit_close			=		'"><i class="fas fa-edit" aria-hidden="true"></i></a>';
		$this->fields		=		array("rol"=>"Roles","CASE WHEN estado=1 THEN 'Activo' ELSE 'Inactivo' END"=>"Estado"," CONCAT('".$edit_open."',rol_id,'".$edit_close."') AS edit"=>"Acción");

		$this->db->select(array_keys($this->fields));
		$this->db->from($tabla);
		$this->db->where('estado', 1);
		$this->db->where("empresa_id",$this->user->empresa_id);
		if($this->search){
			$this->db->like('rol', $this->search);
			$this->db->or_like('estado', $this->search);
		}
		$this->db->order_by('rol','ASC');
		$this->db->limit(ELEMENTOS_X_PAGINA,$this->Usuarios->pagination);
		$query						=	$this->db->get();
		$this->result['activos']	=	$query->result();

		$this->db->select(array_keys($this->fields));
		$this->db->from($tabla);
		$this->db->where('estado', 0);
		if($this->search){
			$this->db->like('rol', $this->search);
			$this->db->or_like('estado', $this->search);
		}
		$this->db->where("empresa_id",$this->user->empresa_id);
		$this->db->order_by('rol','ASC');
		$this->db->limit(ELEMENTOS_X_PAGINA,$this->Usuarios->pagination);
		$query						=	$this->db->get();
		$this->result['inactivos']	=	$query->result();

		$this->total_rows			= 	$this->total_filas($tabla);
	}

	public function get_all2(){
		$tabla=  "mae_cliente_joberp t1";
		$tabla2	="usuarios t2";
	    $tabla3=  "sys_roles t3";
		$this->db->select('t1.*,t2.*, t3.*')->from($tabla)
		->join($tabla2,"t1.id = t2.empresa_id","left")
		->join($tabla3,"t2.rol_id = t3.rol_id","left")
		->where("t2.estado",1);

		if($this->user->rol_id <> 1){
            $this->db->where("t1.empresa_id",$this->user->empresa_id);
        }
		$this->result["Activos"]=$this->db->get()->result();

		$tabla=  "mae_cliente_joberp t1";
		$tabla2	="usuarios t2";
	    $tabla3=  "sys_roles t3";
		$this->db->select('t1.*,t2.*, t3.*')->from($tabla)
		->join($tabla2,"t1.id = t2.empresa_id","left")
		->join($tabla3,"t2.rol_id = t3.rol_id","left")
		->where("t2.estado",0);

		if($this->user->rol_id <> 1){
            $this->db->where("t1.empresa_id",$this->user->empresa_id);
        }
		$this->result["Inactivos"]=$this->db->get()->result();
		}

	public function get_all(){
		$tabla				=		DB_PREFIJO."usuarios t1";
  		$html_group_open	=		'<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">';
		$html_group_close	=		'</div>';
		$edit_open			=		$html_group_open.'<a class="btn-btn-secondary-" title="Editar Usuario" href="'.base_url('Usuarios/Add_Todos/');
		$edit_close			=		'"><i class="fas fa-edit" aria-hidden="true"></i></a>';
		$this->fields		=		array("CASE WHEN t1.type='CentroCostos' && t1.nombre_legal='Principal' THEN t2.nombre_legal
												WHEN t1.type='CentroCostos' && t1.nombre_legal!='Principal' THEN t1.nombre_legal
												ELSE t1.persona_contacto END "=>"Nombre","CASE WHEN t1.estado=1 THEN 'Activo' ELSE 'Inactivo' END"=>"Estado"," CONCAT('".$edit_open."',t1.type,'/',t1.user_id,'".$edit_close."') AS edit"=>"Acción");
		$this->db->select(array_keys($this->fields));
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."usuarios t2", 't1.id_empresa 	= 	t2.user_id', 'left');
		$names 				= 		array('Asociados', 'Proveedores', 'Modelos', 'CentroCostos');
		$this->db->where_in('t1.type', $names);
		if($this->user->mostrar_inactivos==0){
			$this->db->where('t1.estado', 1);
		}
		if($this->search){
			$this->db->like('t1.persona_contacto', $this->search);
			$this->db->or_like('t1.estado', $this->search);
		}
		$this->db->order_by('t1.persona_contacto','ASC');
		$this->db->limit(ELEMENTOS_X_PAGINA,$this->Usuarios->pagination);
		$query			=	$this->db->get();
		$this->result 	=	$query->result();
		$this->total_rows= $this->total_filas($tabla);
	}

	public function get_all_x_type($names,$centro_de_costos="",$case=''){
		$tabla				=		DB_PREFIJO."usuarios t1";
		for($a=0;$a<=1;$a++){
			$html_group_open	=		'<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">';
			$html_group_close	=		'</div>';
			$edit_open			=		$html_group_open.'<a class="btn-btn-secondary- lightbox" title="Editar '.$this->uri->segment(3).'" data-type="iframe" href="'.base_url($this->uri->segment(1).'/Add_Todos/'.$this->uri->segment(3).'/');
			$edit_close			=		'"><i class="fas fa-edit" aria-hidden="true"></i></a>'.$html_group_close;

			$edit_open1			=		$html_group_open.'<a class="btn-btn-secondary- " title="Inactivar '.$this->uri->segment(3).'" href="'.base_url($this->uri->segment(1).'/CambiarEstado/'.$this->uri->segment(3).'/Inactivar/');
			$edit_close1			=		'"><i class="fas fa-toggle-on"></i></a>'.$html_group_close;

			$edit_open2			=		$html_group_open.'<a class="btn-btn-secondary- " title="Activar '.$this->uri->segment(3).'" href="'.base_url($this->uri->segment(1).'/CambiarEstado/'.$this->uri->segment(3).'/Activar/');
			$edit_close2			=		'"><i class="fas fa-toggle-off"></i></a>'.$html_group_close;

			if($this->uri->segment(3)=='Proveedores' || $case=='Proveedores'){
				//$this->fields		=		array("primer_nombre"=>"Nombre","CONCAT(cod_telefono,' ',telefono,' <BR> ',email) AS contactos"=>"Datos de Contacto","CASE WHEN estado=1 THEN 'Activo' ELSE 'Inactivo' END"=>"Estado"," CONCAT('".$edit_open."',user_id,'".$edit_close."') AS edit"=>"Acción");
				$this->fields		=		array("t1.nombre_legal"=>"Nombre","CONCAT(if(t1.cod_telefono is null ,'',t1.cod_telefono),' ',if(t1.telefono is null ,'',t1.telefono),' <BR> ',if(t1.email is null ,'',t1.email)) AS contactos"=>"Datos de Contacto","CASE WHEN t1.estado=1 THEN 'Activo' ELSE 'Inactivo' END"=>"Estado");
				$this->fields		=		array("	CONCAT(t1.nombre_legal,' <b>(',t1.nombre_comercial,')</b>') as nombre_legal"=>"Tercero",
													"CONCAT(if(t1.cod_telefono is null ,'',t1.cod_telefono),' ',if(t1.telefono is null ,'',t1.telefono),' <BR> ',if(t1.email is null ,'',t1.email)) AS contactos"=>"Datos de Contacto",
													"CASE WHEN t1.estado=1 	THEN CONCAT('".$edit_open."',t1.user_id,'".$edit_close." ".$edit_open1."',t1.user_id,'".$edit_close1."')
																			ELSE CONCAT('".$edit_open."',t1.user_id,'".$edit_close." ".$edit_open2."',t1.user_id,'".$edit_close2."')
																			END as accion"=>"Acción");
			}else if($this->uri->segment(3)=='Plataformas' ){
				$this->fields		=		array("t1.primer_nombre"=>"Nombre","CONCAT(t1.tipo_persona)"
																				=>"Tipo de Página",
																				"CONCAT(t1.moneda_de_pago)"
																				=>"Moneda de Pago",
																				"CONCAT(t1.equivalencia)"
																				=>"Equivalencia","CASE WHEN t1.estado=1 THEN 'Activo' ELSE 'Inactivo' END"=>"Estado",
													"CASE WHEN t1.estado=1 	THEN CONCAT('".$edit_open."',t1.user_id,'".$edit_close." ".$edit_open1."',t1.user_id,'".$edit_close1."')
													ELSE CONCAT('".$edit_open."',t1.user_id,'".$edit_close." ".$edit_open2."',t1.user_id,'".$edit_close2."')
																END"=>"Acción","t1.user_id"=>"id");
			}else if($this->uri->segment(3)=='Plataforma' ){
				$html_group_open	=		'<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
												<a class="btn-btn-secondary-" title="Agregar Usuario" href="'.base_url($this->uri->segment(1).'/SetCentroCostos/');
				$html_group_close	=		'	"><i class="fa fa-user-plus" aria-hidden="true"></i></a>';
				$edit_open			=		'	<a class="btn-btn-secondary- lightbox" title="Editar Usuario" data-type="iframe" href="'.base_url($this->uri->segment(1).'/Add_Todos/'.$this->uri->segment(3).'/');
				$edit_close			=		'"><i class="fas fa-edit" aria-hidden="true"></i></a></div>';
				$this->fields		=		array("t1.primer_nombre"=>"Nombre","CONCAT(tipo_persona,' | ',moneda_de_pago,' | ',equivalencia)"=>"Tipo de Página | Moneda de Pago | Equivalencia",
					"CASE WHEN t1.estado=1 	THEN CONCAT('".$edit_open."',t1.user_id,'".$edit_close." ".$edit_open1."',t1.user_id,'".$edit_close1."')
																			ELSE CONCAT('".$edit_open."',t1.user_id,'".$edit_close." ".$edit_open2."',t1.user_id,'".$edit_close2."')
																			END"=>"Acción");
				$names				=		array("Plataformas");
			}else if($this->uri->segment(3)=='CentroCostos' ){
				$html_group_open	=		'<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
												<a class="btn-btn-secondary-" title="Seleccionar sucursal" href="'.base_url($this->uri->segment(1).'/SetCentroCostos/');
				$html_group_close	=		'	"><i class="fa fa-user-plus" aria-hidden="true"></i></a>';
				$edit_open			=		'	<a class="btn-btn-secondary- lightbox" title="Editar Sucursal" data-type="iframe" href="'.base_url($this->uri->segment(1).'/Add_Todos/'.$this->uri->segment(3).'/');
				$edit_close			=		'"><i class="fas fa-edit" aria-hidden="true"></i></a></div>';
				$this->fields		=		array("CONCAT('<b>' ,t2.nombre_legal,' </b>')"=>"Nombre Legal","CONCAT(t1.nombre_legal)"=>"Nombre","t1.abreviacion"=>"Abreviación","CASE WHEN t1.estado=1 THEN 'Activo' ELSE 'Inactivo' END"=>"Estado",
					"CASE WHEN t1.estado=1 	THEN CONCAT('".$html_group_open."',t1.user_id,'".$html_group_close."','".$edit_open."',t1.user_id,'".$edit_close." ".$edit_open1."',t1.user_id,'".$edit_close1."')
																			ELSE CONCAT('".$edit_open."',t1.user_id,'".$edit_close." ".$edit_open2."',t1.user_id,'".$edit_close2."')
																			END"=>"Acción");
			}else if($this->uri->segment(3)=='CentroCostos' || $case=='CentroCostos'){
				$this->fields		=		array("t1.nombre_legal"=>"Nombre","abreviacion"=>"Abreviación","CASE WHEN estado=1 THEN 'Activo' ELSE 'Inactivo' END"=>"Estado","CASE WHEN t1.estado=1 	THEN CONCAT('".$edit_open."',t1.user_id,'".$edit_close." ".$edit_open1."',t1.user_id,'".$edit_close1."')
																			ELSE CONCAT('".$edit_open."',t1.user_id,'".$edit_close." ".$edit_open2."',t1.user_id,'".$edit_close2."')
																			END"=>"Acción");
			}else if($this->uri->segment(3)=='Modelos'){
				$this->fields		=		array("CONCAT(t1.primer_nombre,' ',if(t1.segundo_nombre is null ,'',t1.segundo_nombre) ,' ',t1.primer_apellido,' ',if(t1.segundo_apellido is null ,'',t1.segundo_apellido)) as nombre"=>"Nombre","CONCAT(t1.cod_telefono,' ',t1.telefono,' <BR> ',t1.email) AS contactos"=>"Datos de Contacto","CONCAT('<center>',t1.tipo_modelo,'</center>') as abreviacion"=>"<center>Tipo Modelo</center>",
					"CASE WHEN t1.estado=1 	THEN CONCAT('".$edit_open."',t1.user_id,'".$edit_close." ".$edit_open1."',t1.user_id,'".$edit_close1."')
																			ELSE CONCAT('".$edit_open."',t1.user_id,'".$edit_close." ".$edit_open2."',t1.user_id,'".$edit_close2."')
																			END"=>"Acción");
			}else if($this->uri->segment(3)=='Monitores'){
				$this->fields		=		array("CONCAT(t1.primer_nombre,' ',if(t1.segundo_nombre is null ,'',t1.segundo_nombre) ,' ',t1.primer_apellido,' ',if(t1.segundo_apellido is null ,'',t1.segundo_apellido)) as nombre"=>"Nombre","CONCAT(t1.cod_telefono,' ',t1.telefono,' <BR> ',t1.email) AS contactos"=>"Datos de Contacto","CASE WHEN t1.estado=1 THEN 'Activo' ELSE 'Inactivo' END"=>"Estado",
					"CASE WHEN t1.estado=1 	THEN CONCAT('".$edit_open."',t1.user_id,'".$edit_close." ".$edit_open1."',t1.user_id,'".$edit_close1."')
																			ELSE CONCAT('".$edit_open."',t1.user_id,'".$edit_close." ".$edit_open2."',t1.user_id,'".$edit_close2."')
																			END"=>"Acción");
			}else if($this->uri->segment(3)=='Administrativos'){
				$this->fields		=		array("CONCAT(t1.primer_nombre,' ',if(t1.segundo_nombre is null ,'',t1.segundo_nombre) ,' ',t1.primer_apellido,' ',if(t1.segundo_apellido is null ,'',t1.segundo_apellido)) as nombre"=>"Nombre","CONCAT(t1.cod_telefono,' ',t1.telefono,' <BR> ',t1.email) AS contactos"=>"Datos de Contacto","CASE WHEN t1.estado=1 THEN 'Activo' ELSE 'Inactivo' END"=>"Estado","CASE WHEN t1.estado=1 	THEN CONCAT('".$edit_open."',t1.user_id,'".$edit_close." ".$edit_open1."',t1.user_id,'".$edit_close1."')
																			ELSE CONCAT('".$edit_open."',t1.user_id,'".$edit_close." ".$edit_open2."',t1.user_id,'".$edit_close2."')
																			END"=>"Acción");
			}else{
				$this->fields		=		array("CONCAT(t1.primer_nombre,' ',if(t1.segundo_nombre is null ,'',t1.segundo_nombre) ,' ',t1.primer_apellido,' ',if(t1.segundo_apellido is null ,'',t1.segundo_apellido)) as nombre"=>"Nombre","CONCAT(t1.porcentaje_participacion, '%' )"=>"Participación","CASE WHEN t1.estado=1 THEN 'Activo' ELSE 'Inactivo' END"=>"Estado",
					"CASE WHEN t1.estado=1 	THEN CONCAT('".$edit_open."',t1.user_id,'".$edit_close." ".$edit_open1."',t1.user_id,'".$edit_close1."')
																			ELSE CONCAT('".$edit_open."',t1.user_id,'".$edit_close." ".$edit_open2."',t1.user_id,'".$edit_close2."')
																			END"=>"Acción");
			}
			$this->db->select(array_keys($this->fields));
			$this->db->from($tabla);
			$this->db->join(DB_PREFIJO."usuarios t20", 't1.centro_de_costos=t20.user_id', 'left');

			if($this->uri->segment(3)!='CentroCostos'){
				//echo  $this->user->centro_de_costos;
				//$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
			}

			if($this->user->principal<>1){
				$this->db->where('t1.id_empresa', $this->user->id_empresa);
			}
			if($this->user->mostrar_inactivos==0){
				$this->db->where('t1.estado', 1);
			}

			if($this->uri->segment(3)=='CentroCostos' ){
				$this->db->join(DB_PREFIJO."usuarios t2", 't1.id_empresa 	= 	t2.user_id', 'left');
			}
			if(count($names)>0){
				$this->db->where_in('t1.type', $names);
			}
			if($centro_de_costos!=''){
				$this->db->where('t1.centro_de_costos', $centro_de_costos);
			}

			if($this->user->principal<>1 && $this->uri->segment(3)<>'CentroCostos'){
				$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
			}

			if($this->user->principal<>1 && $this->uri->segment(3)=='Monitores'){
				$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
			}else if($this->user->principal==1 && $this->uri->segment(3)=='Monitores'){
				$this->db->where("t1.id_empresa",$this->user->id_empresa);
			}else if($this->user->principal==1 && $this->uri->segment(3)=='CentroCostos'){
				$this->db->where("t1.id_empresa",$this->user->id_empresa);
			}

			if($this->user->principal<>1 && $this->uri->segment(3)=='Administrativos'){
				$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
			}else if($this->user->principal==1 && $this->uri->segment(3)=='Administrativos'){
				$this->db->where("t1.id_empresa",$this->user->id_empresa);
			}

			if($this->user->principal<>1 && $this->uri->segment(3)=='Proveedores'){
				$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
			}else if($this->user->principal==1 && $this->uri->segment(3)=='Proveedores'){
				$this->db->where("t1.id_empresa",$this->user->id_empresa);
			}

			if($this->user->principal<>1 && $this->uri->segment(3)=='Modelos'){
				$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
			}else if($this->user->principal==1 && $this->uri->segment(3)=='Modelos'){
				$this->db->where("t1.id_empresa",$this->user->id_empresa);
			}


			if($this->user->principal<>1 && $this->uri->segment(3)=='Asociados'){
				$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
			}else if($this->user->principal==1 && $this->uri->segment(3)=='Asociados'){
				$this->db->where("t1.id_empresa",$this->user->id_empresa);
			}

			if($this->search){
				$this->db->like('t1.persona_contacto', $this->search);
				$this->db->or_like('estado', $this->search);
			}
			if($this->uri->segment(3)=='Plataformas' ){
				$this->db->order_by('t1.primer_nombre','ASC');
			}else if($this->uri->segment(3)=='CentroCostos' ){
				//$this->db->order_by('t1.id_empresa','ASC');
				$this->db->order_by('t1.nombre_legal','ASC');
			}else if($this->uri->segment(3)=='Modelos' ){
				$this->db->order_by('t1.primer_nombre','ASC');
			}else if($this->uri->segment(3)=='Monitores' ){
				$this->db->order_by('t1.primer_nombre','ASC');
			}else if($this->uri->segment(3)=='Administrativos' ){
				$this->db->order_by('t1.primer_nombre','ASC');
			}else if($this->uri->segment(3)=='Proveedores' ){
				$this->db->order_by('t1.nombre_legal','ASC');
			}
			else{
				$this->db->order_by('t1.persona_contacto','ASC');
			}
			$this->db->limit(ELEMENTOS_X_PAGINA,$this->Usuarios->pagination);
			$this->db->where("t1.estado",$a);
			$query					=	$this->db->get();
			$this->result[$a] 		=	$query->result();
			$this->total_rows		= $this->total_filas($tabla);
		}
	}

	public function get_all_accionistas($names,$centro_de_costos=""){
		$tabla				=		DB_PREFIJO."usuarios";
  		$html_group_open	=		'<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">';
		$html_group_close	=		'</div>';
		$edit_open			=		$html_group_open.'<a class="btn-btn-secondary-" title="Editar Usuario" href="'.base_url($this->uri->segment(1).'/Add_Todos/Asociados/');
		$edit_close			=		'"><i class="fas fa-edit" aria-hidden="true"></i></a>';
		if($this->uri->segment(3)=='Proveedores' || $this->uri->segment(3)=='Plataformas' ){
			$this->fields		=		array("primer_nombre"=>"Nombre","CASE WHEN estado=1 THEN 'Activo' ELSE 'Inactivo' END"=>"Estado"," CONCAT('".$edit_open."',user_id,'".$edit_close."') AS edit"=>"Acción");
		}else{
			$this->fields		=		array("CONCAT(primer_nombre,' ',primer_apellido) as nombre"=>"Nombre","CONCAT(porcentaje_participacion, '%' )"=>"Participación","CASE WHEN estado=1 THEN 'Activo' ELSE 'Inactivo' END"=>"Estado"," CONCAT('".$edit_open."',user_id,'".$edit_close."') AS edit"=>"Acción");
		}
		$this->db->select(array_keys($this->fields));
		$this->db->from($tabla);

		if($this->user->mostrar_inactivos==0){
			$this->db->where('t1.estado', 1);
		}
		if(count($names)>0){
			$this->db->where_in('type', $names);
		}
		if($centro_de_costos!=''){
			$this->db->where('centro_de_costos', $centro_de_costos);
		}
		if($this->search){
			$this->db->like('persona_contacto', $this->search);
			$this->db->or_like('estado', $this->search);
		}
		$this->db->order_by('persona_contacto','ASC');
		$this->db->limit(ELEMENTOS_X_PAGINA,$this->Usuarios->pagination);
		$query			=	$this->db->get();
		$this->result 	=	$query->result();
		$this->total_rows= $this->total_filas($tabla);
	}

	public function get_sedes($id_esquema=''){
		$this->db->select('t2.*,CONCAT(t1.nombre," (",abreviacion,")") AS nombre_legal,t1.id_esquema as user_id');
		$this->db->from("ma_departamentos t1");
		$this->db->join("usuarios t2", 't1.id_empresa 	= 	t2.user_id', 'left');
		if(!empty($id_esquema)){
			$this->db->where("t1.id_esquema",$id_esquema);
		}
		$query 	= 	$this->db->get();
		return $query->result() ;
	}

	public function get_plataformas(){
		$tabla				=		DB_PREFIJO."usuarios t1";
		$this->db->select('*');
		$this->db->from($tabla);
		$this->db->where("t1.type","Plataformas");
		if($this->user->id_empresa>0){
			//$this->db->where("t1.id_empresa",$this->user->id_empresa);
		}else{
			//$this->db->where("t1.id_empresa","-1");
		}

		$this->db->where('t1.estado', 1);
		/*
		if($this->user->mostrar_inactivos==0){
			$this->db->where('t1.estado', 1);
		}*/

		if($this->user->type=='root' && $this->user->principal==0){
			$this->db->where("t1.id_empresa","-1");
		}

		//$this->db->where("t1.moneda_de_pago<>","RSS");
		$this->db->order_by('t1.primer_nombre','ASC');
		$query				=	$this->db->get();
		foreach($query->result() as $v){
			$this->result[$v->tipo_persona][]	=	$v;
		}
		$this->total_rows	= 	$this->total_filas($tabla);
	}

	public function get_CuentasBancarias($filtro = null){
		$tabla				=		DB_PREFIJO."fi_cuentas t1";
		$this->db->select("*");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."sys_bancos t2", 't1.entidad_bancaria = t2.banco_id', 'left');
		$this->db->where('centro_de_costos', $this->user->centro_de_costos);
		$this->db->where('estado', "1");
		if($filtro){
			$this->db->where('tipo_monedas !=',"COP");
		}
		$this->db->order_by('titular','ASC');
		$query			=	$this->db->get();
		return $this->result 	=	$query->result();
	}

	public function get_AsignarMaster($rel_plataforma_id){
		$tabla				=		DB_PREFIJO."cf_rel_master t1";
		$this->db->select('t1.*');
		$this->db->from($tabla);
		$this->db->where("t1.id_empresa",$this->user->id_empresa);
		$this->db->where("t1.centro_de_costos",$this->user->centro_de_costos);
		$this->db->where("t1.rel_plataforma_id",$rel_plataforma_id);
		$query						=	$this->db->get();
		return $this->result 		=	$query->row();
	}

	public function get_plataformas_rel_master($rss=true){
		$tabla				=		DB_PREFIJO."cf_rel_plataformas t1";
		$this->db->select('t2.*');
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."usuarios t2", 't1.id_plataforma 	= 	t2.user_id', 'left');
		$this->db->where("t1.id_empresa",$this->user->id_empresa);
		//$this->db->where("t1.centro_de_costos",$this->user->centro_de_costos);
		$this->db->where("t2.estado",1);
		if($rss){
			$this->db->where("t2.moneda_de_pago<>","RSS");
		}
		//$this->db->where("t2.primer_nombre<>","Email");
		$this->db->group_by(array("user_id"));
		$this->db->order_by('t2.primer_nombre','ASC');
		$query				=	$this->db->get();
		$this->total_rows	= 	$this->total_filas($tabla);
		return $this->result 		=	$query->result();
	}

	public function get_eps(){
		$tabla				=		DB_PREFIJO."sys_eps t1";
		$this->db->select('t1.*');
		$this->db->from($tabla);
		$this->db->where("t1.estado",1);
		$this->db->order_by('t1.eps','ASC');
		$query				=	$this->db->get();
		$this->total_rows	= 	$this->total_filas($tabla);
		return $this->result 		=	$query->result();
	}

	public function get_sedes_by_empresa($id_empresa=''){
		$this->db->select('CONCAT(t1.nombre," (",abreviacion,")") AS nombre_legal,t1.id_esquema as user_id,t1.*');
		$this->db->from(DB_PREFIJO."ma_departamentos t1");
		$this->db->where("t1.id_empresa",$id_empresa);
		$query 	= 	$this->db->get();
		return $query->result() ;
	}

	public function get_atributos_sedes(){
		$this->db->select('*');
		$this->db->from(DB_PREFIJO."ma_departamentos t1");
		$query 	= 	$this->db->get();
        $result	= $query->result() ;
		$return	=	array();
		foreach($result as $v){
			$return[$v->id_esquema]	=	array("n_rooms"=>$v->n_rooms);
		}
		return json_encode($return);
	}

	public function centroCosto($id_esquema){
		$this->db->select('*');
		$this->db->from(DB_PREFIJO."ma_departamentos t1");
		$this->db->where("t1.id_esquema",$id_esquema);
		$query 	= 	$this->db->get();
		return $query->row() ;
	}

	public function centro_costo_rooms($id_empresa){
		$this->db->select('*');
		$this->db->from("usuarios t1");
		$this->db->where("t1.id_empresa",$id_empresa);
		$this->db->where("t1.type","CentroCostos");
		/*if($this->user->mostrar_inactivos==0){
			$this->db->where('t1.estado', 1);
		}*/
		$query 	= 	$this->db->get();
		return $query->result() ;
	}

	public function get_empresas(){
		$tabla				=		"usuarios t1";
		$this->db->select("*");
		$this->db->from($tabla);
		$this->db->where("type","empresa");
		if($this->user->mostrar_inactivos==0){
			$this->db->where('t1.estado', 1);
		}
		$query			=	$this->db->get();

		return $query->result();
	}

	public function get_empresa($user_id){
		$tabla				=		DB_PREFIJO."usuarios t1";
		$this->db->select("*");
		$this->db->from($tabla);
		$this->db->where("user_id",$user_id);
		if($this->user->mostrar_inactivos==0){
			$this->db->where('t1.estado', 1);
		}
		$query			=	$this->db->get();
		return $this->result 	=	$query->row();
	}

	public function setClave($var){
		$tabla		=	"usuarios";
		if(isset($var['redirect'])){
			unset($var['redirect']);
		}
		$this->db->select("password");
		$this->db->from($tabla);
		$this->db->where("user_id",$this->user->user_id);
		$query			=	$this->db->get();
		//pre($query->row()->password);
		//pre(md5(post("clave_actual")));

		if(desencriptar($query->row()->password) == post("clave_actual")){

			$this->db->where("user_id", $this->user->user_id);
			if($this->db->update($tabla,array("password"=>encriptar(post("clave_nueva"))))){
				//logs($this->user,2,$tabla,$this->user->user_id,"Usuarios","1",array("password"=>md5(post("clave_nueva"))));
				$title 	 = "Cambio de contraseña";
				$message = "Hola ".$this->user->nombre." has ingresado al sistema y solicitado un cambio de contraseña.<br/> Usuario: ".$this->user->username."<br/>Contraseña: ".post("clave_nueva");
				//pre($this->user->email);
				send_mail(array("recipient"=>$this->user->email_user,
								"subject"=>$title,
								"body"=>$this->load->view('Template/Emails/PlantillaEmails',array("title"=>@$title,"message"=>$message),TRUE),
								));

				return array("error"=>array(	"message"	=>	"Exito, la clave ha sido modificada",
												"code"		=>	"200"));
				return true;
			}else{
				logs($this->user,2,$tabla,$this->user->user_id,"Usuarios","0",array("password"=>md5(post("clave_nueva"))));
				return array("error"=>array(	"message"	=>	"Lo siento, la clave no ha sido modificada",
												"code"		=>	"203"));

			}
		}else{
			return array("error"=>array(	"message"	=>	"Lo siento, la clave anterior no coincide con el sistema",
											"code"		=>	"203"));
		}

	}

	public function set($var){
		$tabla		=		"usuarios";
		if(!empty($var["json"])){
			if(!empty($var["json"]['email'])){
				$email		=		$var["json"]["email"];
			}
			if(!empty($var["json"]['dominio'])){
				$dominio	=		$var["json"]["dominio"];
			}
			if(!empty($var["json"]['porcentaje_pago'])){
				$var["user_id"] = $this->uri->segment(3);
			}
		}

		if(isset($var['consecutivo_id'])){
			$cuenta = $var['consecutivo_id'];
			unset($var['consecutivo_id']);
		}
		if(isset($var['redirect'])){
			unset($var['redirect']);
		}

		unset($var["iframe"]);

		if(!empty($var['json'])){
			$u=$this->get($var['user_id']);
			if(!empty($u)){
				$var['json']	=	json_db($u->json,$var['json']);
			}else{
				$var['json']	=	json_encode($var['json']);
			}
		}

		if(isset($var['user_id']) && !empty($var['user_id'])){
			$id			=		array("user_id",$var['user_id']);
			if($this->uri->segment(2)!='CambiarEstado' && $this->uri->segment(2) != "AddCuentasBancarias" && $this->uri->segment(2) != "Add_ActualizarEscala" && $this->uri->segment(2) != "Metas"){
				if(!isset($var['turno_manama'])){
					$var['turno_manama']=0;
				}
				if(!isset($var['turno_tarde'])){
					$var['turno_tarde']=0;
				}
				if(!isset($var['turno_noche'])){
					$var['turno_noche']=0;
				}
				if(!isset($var['turno_intermedio'])){
					$var['turno_intermedio']=0;
				}
			}

			if(!empty($var['entidad_bancaria']) && !empty($var['tipo_cuenta']) && !empty($var['nro_cuenta'])){
				//pre($var['user_id']);
				$oldCuenta = $this->get($var['user_id'])->cambio_cuentas_bancarias;
				if(!empty($oldCuenta)){
					if(!empty($cuenta)){
						$json  = json_decode($oldCuenta);
						$newConsecutivo = count($json);
						$new  = array(json_encode(array('fecha_creacion'=>date('d-m-Y'),"responsable"=>$this->user->user_id,'entidad_bancaria'=>$var['entidad_bancaria'],'tipo_cuenta'=>$var['tipo_cuenta'],'nro_cuenta'=>$var['nro_cuenta'],"consecutivo"=>$newConsecutivo)));
						$var['cambio_cuentas_bancarias'] = json_encode(array_merge($json,$new));
					}
				}else{
					$var['cambio_cuentas_bancarias'] = json_encode(array(json_encode(array('fecha_creacion'=>date('d-m-Y'),"responsable"=>$this->user->user_id,'entidad_bancaria'=>$var['entidad_bancaria'],'tipo_cuenta'=>$var['tipo_cuenta'],'nro_cuenta'=>$var['nro_cuenta']))));
				}
			}
			//pre($var);return;
			if(!empty($var['type'])){
				if($var['type'] == "Modelos" && (empty($var['id_escala'])) && $this->uri->segment(2) == "Add_ActualizarEscala"){
					$var['id_escala'] = $nombre_escala =  json_decode(@get_form_control(base_url("Usuarios/configuracionEscala"),null,1)[0]->data)->Escala_por_defecto;
				}
			}
			if(isset($var['id_responsable'])){
				unset($var['id_responsable']);
			}
			$this->db->where($id[0], $id[1]);
			if($this->db->update($tabla,$var)){
				if($this->uri->segment(2) == "CambiarEstado"){
					$u=$this->get($var['user_id']);
					if(@$u->principal == 1){
						EstadoMiembrosEmpresa($var['user_id'],$var['estado']);
					}
				}
				logs($this->user,2,$tabla,$id[1],"Usuarios","1",$var);
				return $var['user_id'];
			}else{
				logs($this->user,2,$tabla,$id[1],"Usuarios","0",$var);
				return false;
			}
		}else{
			unset($var['user_id']);
			if($var['type'] == "Modelos"){
				$var['id_escala'] = @get_id_escala_por_defecto()->id_escala;
			}
			if($var['type'] == "Proveedores"){
				$var['id_empresa'] = $this->user->id_empresa;
			}
			$var['token']			=	md5(date("H:i:s Y-M-d"));
			if($var['type']!='Proveedores'){
				if($var['type']!='Plataformas'){
					$pass					=	explode("@",$var["email"]);
				}else{
					$pass[0]				=	$var["primer_nombre"];
				}

				$password				=	$pass[0].rand(1000,50000);
				$var['password']		=	md5($password);
				//$var['centro_de_costos']=	$this->user->centro_de_costos; 18/03/2018
				$var['id_empresa']		=	(post("id_empresa"))?post("id_empresa"):$this->user->id_empresa;
			}
			$var['id_responsable'] = $this->user->user_id;
			if($this->db->insert($tabla,$var)){
				$json_decode		=	json_decode($this->user->json);
				$reenvio			=	FALSE;
				if(is_object($json_decode)){
					if(isset($json_decode->reenvio)){
						$reenvio	=	$json_decode->reenvio;
					}
				}
				$insert_id			=	$this->db->insert_id();
				logs($this->user,1,$tabla,$insert_id,"Usuarios","1",$var);
				if($var['type']!='Proveedores' && $var['type']!='Plataformas'){
				/*$cuenta		=	array(	$email.'@'.$dominio,
				"Provisional1",
				"unlimited",
				$dominio,
				$reenvio);
				if($reenvio){
					cpanel_email($cuenta,true);
				}*/
				send_mail(array(
								"recipient"=>$var['email'],
								"subject"=>"Bienvenido a nuestro sistema",
								"body"=>$this->load->view('Template/Emails/bienvenida',array("userPassword"=>@$password,"userType"=>$var['type'],"userEmail"=>$var['email'],"userName"=>$var['primer_nombre'].' '.@$var['segundo_nombre'].' '. $var['primer_apellido'] .' '.@$var['segundo_apellido'],"userUsuario"=>$var['nombre_usuario'],"href"=>site_url("Apanel")),TRUE),
								));
				}
				return $insert_id;
			}else{
				return false;
			}
		}
	}

	public function setRol($var){
		$tabla		=	"sys_roles";
		if(isset($var['redirect'])){
			unset($var['redirect']);
		}
		if(isset($var['rol_id'])&& !empty($var['rol_id'])){
			//pre($var); return;
			$id					=		array("rol_id",$var['rol_id']);
			$var["json"]		=		json_encode($var["roles_search"]);
			/*$var["json_edit"]	=		json_encode($var["roles_edit"]);
			$var["json_add"]	=		json_encode($var["roles_add"]);*/
			unset($var['roles_search'],$var['roles_edit'],$var['roles_add']);
			$this->db->where($id[0], $id[1]);
			$this->db->where("empresa_id",$this->user->empresa_id);
			if($this->db->update($tabla,$var)){
				logs($this->user->user_id,2,$tabla,$id[1],"Usuarios","1",$var);
				return $var['rol_id'];
			}else{
				logs($this->user->user_id,2,$tabla,$id[1],"Usuarios","0",$var);
				return false;
			}
		}else{
			if(isset($var["roles_search"])){
				$var["json"]		=		json_encode($var["roles_search"]);
				unset($var['roles_search']);
			}
			/*if(isset($var["roles_edit"])){
				$var["json_edit"]	=		json_encode($var["roles_edit"]);
				unset($var['roles_edit']);
			}*/
			unset($var['rol_id']);
			$var["empresa_id"] = $this->user->empresa_id;
			if($this->db->insert($tabla,$var)){
				$insert_id			=	$this->db->insert_id();
				logs($this->user->user_id,1,$tabla,$insert_id,"Usuarios","1",$var);
				return $insert_id;
			}else{
				return false;
			}
		}
	}

	public function setAsignarMaster($var){
		$tabla						=		DB_PREFIJO."cf_rel_master";
		$var['centro_de_costos']	=	$this->user->centro_de_costos;
		$var['id_empresa']			=	$this->user->id_empresa;
		if(isset($var['redirect'])){
			unset($var['redirect']);
		}
		if(isset($var['rel_plataforma_id'])&& !empty($var['rel_plataforma_id'])){
			$id					=		array("rel_plataforma_id",$var['rel_plataforma_id']);
			$this->db->where($id[0], $id[1]);
			if($this->db->update($tabla,$var)){
				logs($this->user,2,$tabla,$id[1],$tabla,"1",$var);
				return $var['rel_plataforma_id'];
			}else{
				logs($this->user,2,$tabla,$id[1],$tabla,"0",$var);
				return false;
			}
		}else{
			if($this->db->insert($tabla,$var)){
				$insert_id			=	$this->db->insert_id();
				logs($this->user,1,$tabla,$insert_id,$tabla,"1",$var);
				return $insert_id;
			}else{
				return false;
			}
		}
	}

	public function setPassNickname($var){
		$tabla						=	DB_PREFIJO."cf_nickname";
		$var['centro_de_costos']	=	$this->user->centro_de_costos;
		$var['id_empresa']			=	$this->user->id_empresa;
		$id							=	array("id_modelo",$this->uri->segment(3));
		$usuarios_like_name			=	usuarios_like_name($var['plataforma'])->user_id;
		unset($var['plataforma']);
		$this->db->where($id[0], $id[1]);
		$this->db->where("id_plataforma", $usuarios_like_name);
		if($this->db->update($tabla,$var)){
			logs($this->user,2,$tabla,$id[1],$tabla,"1",$var);
			return $this->uri->segment(3);
		}else{
			logs($this->user,2,$tabla,$id[1],$tabla,"0",$var);
			return false;
		}
	}

	public function getAsignarNickname($nickname_id){
		$tabla						=	DB_PREFIJO."cf_nickname";
		$var['id_empresa']			=	$this->user->id_empresa;
		$this->result =	$this->db->select("*")
									->from($tabla)
									->where('id_empresa',$var['id_empresa'])
									->where('nickname_id',$nickname_id)
									->get()->row();

	}

	public function consultarModelos_x_Master($var){
		$tabla						=	DB_PREFIJO."cf_nickname";
		$var['id_empresa']			=	$this->user->id_empresa;
		$this->result =	$this->db->select("*")
									->from($tabla)
									->where('id_empresa',$var['id_empresa'])
									->where('id_modelo',$var['id_modelo'])
									->where('id_master',$var['master'])
									->where('id_plataforma',$var['plataforma'])
									->where('nickname',$var['usuario'])
									->get()->row();
		echo json_encode($this->result);

	}

	public function getAsignarNicknameNEW($id_modelo){
		$tabla						=	DB_PREFIJO."cf_nickname";
		$var['id_empresa']			=	$this->user->id_empresa;
		$this->result =	$this->db->select("*")
									->from($tabla)
									->where('id_empresa',$var['id_empresa'])
									->where('id_modelo',$id_modelo)
									->get()->row();

	}

	/*public function setAsignarNickname($var){
		$tabla						=	DB_PREFIJO."cf_nickname t1";
		//$nickname					=	nickname_like_name($var['nickname'],$var['plataforma']);
		if(!empty($var['perfil_profesional']) && !empty($var['bloqueo_pais'])){
			$var['opciones_adicionales'] = json_encode(array("fecha_creacion"=>date("Y-m-d"),"responsable"=>$this->user->user_id,"perfil_profesional"=>$var['perfil_profesional'],"dia"=>0));
		}
		unset($var['perfil_profesional']);
		$var['id_empresa']			=	$this->user->id_empresa;
		if(is_numeric($this->uri->segment(3))){
			$var['nickname_id']         = 	$this->uri->segment(3);
		}

		$nickname=$this->db->select("t1.*,t2.primer_nombre")
			->from($tabla)
			->join(DB_PREFIJO."usuarios t2",'t1.id_plataforma=t2.user_id','left')
			//->where('centro_de_costos',$this->user->centro_de_costos)
			->where('t1.id_empresa',$var['id_empresa'])
			//->where('id_modelo',$var['id_modelo'])
			//->where('id_master',$var['id_master'])
			->where('nickname',$var['nickname'])
			->get()->row();

		if(!empty($var['nickname_id']) && !empty($nickname)){
			if(@$nickname->id_modelo==0 && @$nickname->id_master==0 && @$nickname->estado==0){
				$nickname_id=$var['nickname_id'];
				if(isset($var['plataforma'])){
					unset($var['plataforma']);
				}
				unset($var['nickname_id']);
				$this->db->where("nickname_id",$nickname->nickname_id);
				$this->db->update($tabla,$var);

				$tabla1		=	DB_PREFIJO."rp_tmp";
				$this->db->where("nickname",$var['nickname']);
				$this->db->where("id_empresa",$var['id_empresa']);
				$this->db->where("pagina",$nickname->primer_nombre);

				$this->db->update($tabla1,array("centro_de_costos"=>$var['centro_de_costos']));

				logs($this->user,2,$tabla,"nickname_id",$tabla,"1",$var);
				return true;
			}

		if(isset($var['redirect'])){
			unset($var['redirect']);
		}

			if(!empty($nickname)){
				$id	=	array("nickname_id",$nickname->nickname_id);
				$this->db->where($id[0], $id[1]);
				if($this->db->update($tabla,$var)){
					$this->db->where("nickname", $var['nickname']);
					$this->db->where("pagina",@$nickname->primer_nombre);
					$this->db->update(DB_PREFIJO."rp_tmp",array("centro_de_costos"=>$var['centro_de_costos']));
					logs($this->user,2,$tabla,$id[1],$tabla,"1",$var);
					return $var['nickname_id'];
				}else{
					logs($this->user,2,$tabla,$id[1],$tabla,"0",$var);
					return false;
				}

			}

		}else{
			$var['centro_de_costos'] = $this->user->centro_de_costos;
			$var['id_modelo']		 = $this->uri->segment(3);
			if($this->db->insert(DB_PREFIJO."cf_nickname",$var)){
				$insert_id			=	$this->db->insert_id();
				logs($this->user,1,$tabla,$insert_id,$tabla,"1",$var);
				return $insert_id;
			}else{
				return false;
			}
		}
	}*/

	public function setAsignarNickname($var){
		unset($var['rss']);
		$tabla						=	DB_PREFIJO."cf_nickname t1";
		//$nickname					=	nickname_like_name($var['nickname'],$var['plataforma']);
		if(!empty($var['perfil_profesional']) && !empty($var['bloqueo_pais'])){
			$var['opciones_adicionales'] = json_encode(array("fecha_creacion"=>date("Y-m-d"),"responsable"=>$this->user->user_id,"perfil_profesional"=>$var['perfil_profesional'],"dia"=>0));
		}
		unset($var['perfil_profesional']);
		$var['id_empresa']			=	$this->user->id_empresa;

		$nickname=$this->db->select("t1.*,t2.primer_nombre")
							->from($tabla)
							->join(DB_PREFIJO."usuarios t2",'t1.id_plataforma=t2.user_id','left')
							//->where('centro_de_costos',$this->user->centro_de_costos)
							->where('t1.id_empresa',$var['id_empresa'])
							//->where('id_modelo',$var['id_modelo'])
							//->where('id_master',$var['id_master'])
							->where('nickname',$var['nickname'])
							->get()->row();

		if(!empty($nickname)){
			if(@$nickname->id_modelo==0 && @$nickname->id_master==0 && @$nickname->estado==0){
				$nickname_id=$var['nickname_id'];
				if(isset($var['plataforma'])){
					unset($var['plataforma']);
				}
				unset($var['nickname_id']);
				$this->db->where("nickname_id",$nickname->nickname_id);
				$this->db->update($tabla,$var);

				$tabla		=	DB_PREFIJO."rp_tmp";
				$this->db->where("nickname",$var['nickname']);
				$this->db->where("id_empresa",$var['id_empresa']);
				$this->db->where("pagina",$nickname->primer_nombre);

				$this->db->update($tabla,array("centro_de_costos"=>$var['centro_de_costos']));

				logs($this->user,2,$tabla,"nickname_id",$tabla,"1",$var);
				return true;
			}
		}

		if(isset($var['redirect'])){
			unset($var['redirect']);
		}
		if(isset($var['plataforma'])){
			$plataforma=$var['plataforma'];
			unset($var['plataforma']);
		}

		if(isset($var['nickname_id'])	&& 	!empty($var['nickname_id'])){
			$id	=	array("nickname_id",$var['nickname_id']);
			$this->db->where($id[0], $id[1]);
			//pre($var);	return;
			if($this->db->update($tabla,$var)){
				$this->db->where("nickname", $var['nickname']);
				$this->db->where("pagina",@$plataforma);

				$this->db->update(DB_PREFIJO."rp_tmp",array("centro_de_costos"=>$var['centro_de_costos']));
				logs($this->user,2,$tabla,$id[1],$tabla,"1",$var);
				return $var['nickname_id'];
			}else{
				logs($this->user,2,$tabla,$id[1],$tabla,"0",$var);
				return false;
			}
		}else{
			if($this->db->insert(DB_PREFIJO."cf_nickname",$var)){
				$insert_id			=	$this->db->insert_id();
				logs($this->user,1,$tabla,$insert_id,$tabla,"1",$var);
				return $insert_id;
			}else{
				return false;
			}
		}
	}

	public function total_filas($tabla){
		if($this->search){
			$this->db->from($tabla);
			$this->db->like('nombre', $this->search);
			$this->db->like('persona_contacto', $this->search);
			$this->db->or_like('estado', $this->search);
			return $this->db->get()->num_rows();
		}
		return $this->db->get($tabla)->num_rows();
	}

	public function setCliente($var){
		$tabla     =  "usuarios";
		if(isset($var['user_id'])&& !empty($var['user_id'])){
			$var['Fecha'] = date('Y-m-d');
			//pre('hola');return;
			$user_id = $var['user_id'];
			unset($var['nombre']);
			unset($var['user_id']);
			$this->db->where("user_id",$user_id);
            if($this->db->update($tabla, $var)){
                $response = "el cliente ha sido modificada";
            }else{
                $response = "el cliente ha sido modificado, pero el usuario asociado al cliente no";
            }
		}else{
			$email                  =   $var['email_user'];
            $pass                   =   explode("@",$var['email_user']);
            $var['token']           =   md5(date("H:i:s Y-M-d"));
			$password               =   $pass[0].rand(1000,50000);
			$var['type']			=   $this->uri->segment(3);
			$var['fecha'] = date('Y-m-d');
			$var['estado'] = 1;
			$var['empresa_id']=$this->user->empresa_id;
			$var['responsable_id'] = $this->user->user_id;
			unset($var['nombre']);
               // logs($insert2['responsable_id'],2,"mae_clientes_joberp",$insert2['empresa_id'],"Empresas","1",$var);
			$var['password']    =   encriptar($password);
			if($this->db->insert($tabla, $var)){
				send_mail(array(
								"recipient"=>$var['email_user'],
								"subject"=>"Bienvenido a nuestro sistema",
								"body"=>$this->load->view('Template/Emails/bienvenida',array("userPassword"=>@$password,"userType"=>$var['type'],"userEmail"=>$var['email_user'],"userName"=>$var['nombre'],"userUsuario"=>$var['username'],"href"=>site_url("Apanel")),TRUE)
						));
            	$response = "El cliente se ha guardado correctamente";
			}else{
				$response = "Error al guardar";
			}
		}
		return $response;
	}

	public function get_all_clientes(){
		$tabla	=	"usuarios";
		$this->db->select('*')->from($tabla)->where("estado",1)->where("type",$this->uri->segment(3))->where("empresa_id",$this->user->empresa_id);
		if($this->uri->segment(4)){
			$this->db->where("user_id",$this->uri->segment(4));

			return $this->result = $this->db->get()->result();;
		}
        $this->result["Activos"]=$this->db->get()->result();
		$this->db->select('*')->from($tabla)->where("estado",0)->where("type",$this->uri->segment(3))->where("empresa_id",$this->user->empresa_id);
        $this->result["Inactivos"]=$this->db->get()->result();
	}

	public function GetClientes(){

		$tabla	=	"mae_cliente t1";
		$tabla2	=	"usuarios t2";
		$this->db->select('t1.*,t2.*')->from($tabla)->join($tabla2,"t1.id = t2.empresa_id","left")->where("t1.estado",1);
		if($this->uri->segment(4)){
			$this->db->where("id",$this->uri->segment(4));
		}
		if($this->user->rol_id <> 1){
            $this->db->where("id_empresa",$this->user->empresa_id);
        }
        $this->result["Activos"]=$this->db->get()->result();
		$tabla	=	"mae_cliente t1";
		$tabla2	=	"usuarios t2";
		$this->db->select('t1.*,t2.*')->from($tabla)->join($tabla2,"t1.id = t2.empresa_id","left")->where("t1.estado",0);
        if($this->uri->segment(4)){
			$this->db->where("id",$this->uri->segment(4));
		}
		if($this->user->rol_id <> 1){
            $this->db->where("id_empresa",$this->user->empresa_id);
        }
		$this->result["Inactivos"]=$this->db->get()->result();
	}

	public function SetProveedores($var){
		$tabla  =  "mae_proveedores";
		$tabla2     =  "usuarios";
		if(isset($var["id"]) && !empty($var["id"])  && isset($var['user_id'])&& !empty($var['user_id'])){
			$user_id = $var['user_id'];
            unset($var['user_id']);
			$insert2['username'] = $var['username'];
			$insert2['nombre'] = $var['nombre'];
			$insert2['documento'] = $var['documento'];
			$insert2['ciudad_expedicion'] = $var['ciudad_expedicion'];
			$insert2['cargo'] = $var['cargo'];
			//$insert2['user_id'] = $var['user_id'];
			unset($var['username']);
			unset($var['nombre']);
			unset($var['user_id']);
			unset($var['documento']);
			unset($var['ciudad']);
			unset($var['rol_id']);
			unset($var['divisa_oficial']);
			$var['Fecha_registro'] = date('Y-m-d');
			$this->db->where("id", $var["id"]);
			if($this->db->update($tabla, $var)){
				$this->db->where("user_id", $user_id);
                if($this->db->update($tabla2, $insert2)){
                    $response = "el cliente ha sido modificada";
                }else{
                    $response = "el cliente ha sido modificado, pero el usuario asociado al cliente no";
                }

			}
		}else{
			$email                  =   $var['email'];
            $pass                   =   explode("@",$var['email']);
            $insert2['token']           =   md5(date("H:i:s Y-M-d"));
			$password               =   $pass[0].rand(1000,50000);
			$insert2['username'] = $var['username'];
			$insert2['rol_id']   = $var['rol_id'];
			$insert2['nombre'] = $var['nombre'];
			$insert2['ciudad_expedicion'] = $var['ciudad_expedicion'];
			$insert2['cargo'] = $var['cargo'];
			$insert2['documento'] = $var['documento'];
			unset($var['user_id']);
			unset($var['rol_id']);
			unset($var['nombre']);
			unset($var['documento']);
			unset($var['ciudad']);
			unset($var['username']);
			unset($var['divisa_oficial']);
			$var['Fecha_registro'] = date('Y-m-d');
			$var['estado'] = 1;
			$var['id_empresa']=$this->user->empresa_id;
			if($this->db->insert($tabla, $var)){
				$insert2['proveedor_id'] = $this->db->insert_id();
               // logs($insert2['responsable_id'],2,"mae_clientes_joberp",$insert2['empresa_id'],"Empresas","1",$var);
                $insert2['estado'] = 1 ;
				$insert2['password']    =   encriptar($password);
				if($this->db->insert($tabla2, $insert2)){
                	$response = "El cliente se ha guardado correctamente";
				}else{
					$response = "Error al guardar";
				}
			}
		}
		return $response;
	}

	public function GetProveedores(){
		$tabla	=	"mae_proveedores t1";
		$tabla2	=	"usuarios t2";
		$this->db->select('t1.*,t2.*')->from($tabla)->join($tabla2,"t1.id = t2.proveedor_id","left")->where("t1.estado",1);
		if($this->uri->segment(4)){
			$this->db->where("id",$this->uri->segment(4));
		}
		if($this->user->rol_id <> 1){
            $this->db->where("id_empresa",$this->user->empresa_id);
        }

        $this->result["Activos"]=$this->db->get()->result();
		$tabla	=	"mae_proveedores t1";
		$tabla2	=	"usuarios t2";
		$this->db->select('t1.*,t2.*')->from($tabla)->join($tabla2,"t1.id = t2.proveedor_id","left")->where("t1.estado",0);
        if($this->uri->segment(4)){
			$this->db->where("id",$this->uri->segment(4));
		}
		if($this->user->rol_id <> 1){
            $this->db->where("id_empresa",$this->user->empresa_id);
        }
		$this->result["Inactivos"]=$this->db->get()->result();

	}

}
?>
