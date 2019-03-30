<?php

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
		$ciclopago					=	$var['ciclo_produccion'];
		$consecutivo				=	consecutivo($this->user->id_empresa,$tipo_documento);
		$var['nro_transaccion']		= 	$var["consecutivo"]		=	$consecutivo;
		$var['user_id']				=	$this->user->user_id;
		$var['empresa_id']			=	$this->user->id_empresa;
		$var['centro_de_costos']	=	$this->user->centro_de_costos;
		$modelo_id					=	$this->uri->segment(3);
		$var['caja_id']				=	(@!empty(post('caja_id')))?post('caja_id'):0;
		$var['procesador_id']		=	(@!empty(post('procesador_id')))?post('procesador_id'):0;
		if($var['Tipo_transaccion'] == "Transferencia"){
			$procesador = explode("/-/",$var['Banco_destino']);
			$procesador_id				=	$procesador[3];
			$var['codigo_contable']		=	$procesador[1];
		}else{
			if(($var['procesador_id'])){
				$procesador_id				=	$var['procesador_id'];
				$var['codigo_contable']	=	$procesador_id[$var['procesador_id']]->codigo_contable;
			}else{
				$caja = explode("/-/",$var['caja_id']);
				$caja_id					=	$caja[0];
				$var['codigo_contable']		=	$caja[1];
			}
		}
		$inser_contable				=	array(	"empresa_id"=>$this->user->id_empresa,
												"responsable_id"=>$this->user->user_id,
												"modelo_id"=>$modelo_id,
												"consecutivo"=>$consecutivo,
												"nickname_id"=>0,
												"centro_de_costos"=>$var["centro_de_costos"],
												"codigo_contable"=>"284001",
												"ciclo_produccion_id"=>$ciclopago,
												"tipo_documento"=>$tipo_documento,
												"fecha"=>date("Y-m-d"),
												"caja_id"=>@$caja_id,
												"procesador_id"=>@$procesador_id,
												"nro_documento"=> $var['nro_documento'] ,
												"pref_nro_documento"=>"NOA",
												"tipo_documento"=>$tipo_documento,
												"credito"=>"0.00",
												"debito"=>$var['monto'],
												"json"=>json_encode($var));
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
													"procesador_id"=>@$procesador_id,
													"nro_documento"=> $var['nro_documento'] ,
													"pref_nro_documento"=>"NOA",
													"tipo_documento"=>$tipo_documento,
													"debito"=>"0.00",
													"credito"=>$var['monto'],
													"json"=>json_encode($var));
		if( registro_contable($inser_contable2) && registro_contable($inser_contable)){
			incrementa_consecutivo($this->user->id_empresa,$tipo_documento);
			$this->session->unset_userdata("pagos");
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	public function PagosHonorario(){
		$this->result = getMovimientosGeneral($this->uri->segment(3),$this->uri->segment(4),14,NULL,NULL,$this->uri->segment(5),NULL,array("1","9"));
	}
	
	public function ProcesarHonorarios($var){
		$detalle = $this->session->userdata('rp_honorarios_modelos');
		$tipo_documento				=	13;
		$tipo_documento_descuento   =   56;
		//selecciona fecha desde y fecha hasta de cf_ciclos_pagos donde estado = 0
		$ciclo_informacion			=	get_cf_ciclos_pagos_new($this->user->id_empresa,0);
		//toma datos de la empresa variable seccion usuario
		$periodo_pagos				=	centrodecostos($this->user->id_empresa);
		// toma el periodo de pago de la empresa
		$ciclopago					=	ciclopago($periodo_pagos->periodo_pagos,$ciclo_informacion->mes,$ciclo_informacion->fecha_desde);
		$consecutivo				=	consecutivo($this->user->id_empresa,$tipo_documento);
		$consecutivo_descuento		=	consecutivo($this->user->id_empresa,$tipo_documento_descuento);
		$var['nro_transaccion']		= 	$var["consecutivo"]		=	$consecutivo;
		$var['user_id']				=	$this->user->user_id;
		$var['empresa_id']			=	$this->user->id_empresa;
		$var['centro_de_costos']	=	$this->user->centro_de_costos;
		
		$array_honorario			=	array();
		
		$monto_cuota_descuento	=	0;
		/*DESCUENTOS*/
		if(!empty($detalle['ajuste_a_la_decena_subtotal'])){
			if($detalle['ajuste_a_la_decena_prefijo'] == "-"){
				$registro_contabilidad_credito["429581"]	 = str_replace(".","",$detalle['ajuste_a_la_decena_subtotal']);
			}else{
				$registro_contabilidad_debito["429581"]	 = str_replace(".","",$detalle['ajuste_a_la_decena_subtotal']);
			}
		}	

		if($periodo_pagos->sistema_salarial == 1){
			if(!empty($detalle['salario_var'])){
				$registro_contabilidad_debito["529581"] = str_replace(".","",$detalle['salario_var']);
			}
			if(!empty($detalle['escala_salario'])){
				$registro_contabilidad_debito["529582"] = str_replace(".","",$detalle['escala_salario']);
			}
			if(!empty($detalle['aux_bonificacion'])){
				$registro_contabilidad_debito["529590"] = str_replace(".","",$detalle['aux_bonificacion']);
			}
			if(!empty($detalle['aux_eps'])){
				$registro_contabilidad_debito["529583"] = $eps = str_replace(".","",$detalle['aux_eps']);
			}
			if(!empty($detalle['aux_arl'])){
				$registro_contabilidad_debito["529584"] = $arl = str_replace(".","",$detalle['aux_arl']);
			}
			if(!empty($detalle['aux_aux'])){
				$registro_contabilidad_debito["529585"] = $aux = str_replace(".","",$detalle['aux_aux']);
			}
			if(!empty($detalle['total_ahorro_prima'])){
				$registro_contabilidad_debito["529586"] = str_replace(".","",$detalle['total_ahorro_prima']);
			}

			// Recorre los registros que van al debito.
	
			foreach ($registro_contabilidad_debito as $k1 => $v1) {
				$inser_contable[$k1]				=	array(	"empresa_id"=>$this->user->id_empresa,
														"responsable_id"=>$this->user->user_id,
														"modelo_id"=>$var['modelo_id'],
														"consecutivo"=>$consecutivo,
														"nickname_id"=>0,
														"centro_de_costos"=>$var["centro_de_costos"],
														"codigo_contable"=>$k1,
														"ciclo_produccion_id"=>$ciclopago,
														"tipo_documento"=>$tipo_documento,
														"fecha"=>date("Y-m-d"),
														"nro_documento"=>$var['nro_transaccion'],
														"pref_nro_documento"=>"NOA",
														"credito"=>"0.00",
														"debito"=>$v1,
														"json"=>json_encode($var));
				registro_contable($inser_contable[$k1]);	
			}

			$registro_contabilidad_credito["otros_ingresos"] = $detalle['ListOtrosIngresos'];
			$registro_contabilidad_credito["descuentos"] = $detalle['Descuentos'];
			$registro_contabilidad_credito["236510"]	 = str_replace(".","",$detalle['total_ingresosXporcentaje_retencion']);
			$registro_contabilidad_credito["236010"]	 = str_replace(".","",$detalle['total_ahorro_prima']);
			$registro_contabilidad_credito["281505"]	 = @$eps + @$arl + @$aux;
			$registro_contabilidad_credito["284001"]	 =  $var['pago_global'];
			
			// Recorre los registros que van al credito 

			foreach ($registro_contabilidad_credito as $k2 => $v2){ 
				if($k2 == "otros_ingresos" || $k2 == "descuentos" || count($v2) > 1 ){
					foreach ($v2 as $k3 => $v3){
						if($k2 == "otros_ingresos"){
							$json = json_decode($v3->json);
							foreach($json->contrapartida as $k4 => $v4){
								$inser_contable[$k4]				=	array(	"empresa_id"=>$this->user->id_empresa,
																	"responsable_id"=>$this->user->user_id,
																	"modelo_id"=>$var['modelo_id'],
																	"consecutivo"=>$consecutivo,
																	"nickname_id"=>0,
																	"codigo_contable"=>$v4,
																	"debito"=>$json->valor[$k4],
																	"centro_de_costos"=>$var["centro_de_costos"],
																	"ciclo_produccion_id"=>$ciclopago,
																	"tipo_documento"=>$tipo_documento,
																	"fecha"=>date("Y-m-d"),
																	"nro_documento"=>$var['nro_transaccion'],
																	"pref_nro_documento"=>"NOA",
																	"credito"=>"0.00",
																	"json"=>json_encode($var));
								registro_contable($inser_contable[$k4]);
							}
						}else{
							$inser_contable[$k3]				=	array(	"empresa_id"=>$this->user->id_empresa,
																"responsable_id"=>$this->user->user_id,
																"modelo_id"=>$var['modelo_id'],
																"consecutivo"=>$consecutivo,
																"nickname_id"=>0,
																"codigo_contable"=>$v3->codigo_contable,
																"credito"=>$v3->debito/$v3->nro_quincenas,
																"centro_de_costos"=>$var["centro_de_costos"],
																"ciclo_produccion_id"=>$ciclopago,
																"tipo_documento"=>$tipo_documento,
																"fecha"=>date("Y-m-d"),
																"nro_documento"=>$v3->nro_documento,
																"pref_nro_documento"=>"NOA",
																"debito"=>"0.00",
																"json"=>json_encode($var));
							registro_contable($inser_contable[$k3]);

							$insert_cuota[$k3] 						=  array("id_empresa"=>$this->user->id_empresa,
																"centro_de_costos"=>$var["centro_de_costos"],
																"user_id"=>$var['modelo_id'],
																"nro_documento"=>$consecutivo,
																"nro_cuota"=>$detalle['cantidad_de_cuotas'][$k3],
																"descuento_id"=>$v3->descuento_id,
																"ciclo_de_produccion"=>$ciclopago,
																"consecutivo"=>$consecutivo_descuento,
																"cuota"=>str_replace(".","",$detalle['monto_cuota'][$k3]),
																"Pendiente"=>str_replace(".","",$detalle['restante'][$k3]),
																"estatus"=>1);
							insertar_descuentos_pagos($insert_cuota[$k3]);
						}
						
					}

				}else{
					$inser_contable[$k2]				=	array(	"empresa_id"=>$this->user->id_empresa,
															"responsable_id"=>$this->user->user_id,
															"modelo_id"=>$var['modelo_id'],
															"consecutivo"=>$consecutivo,
															"nickname_id"=>0,
															"centro_de_costos"=>$var["centro_de_costos"],
															"codigo_contable"=>$k2,
															"ciclo_produccion_id"=>$ciclopago,
															"tipo_documento"=>$tipo_documento,
															"fecha"=>date("Y-m-d"),
															"nro_documento"=>$var['nro_transaccion'],
															"pref_nro_documento"=>"NOA",
															"credito"=>$v2,
															"debito"=>"0.00",
															"json"=>json_encode($var));
					registro_contable($inser_contable[$k2]);
				}
			}
		}else{
			if(!empty($detalle['salario_var'])){
				$registro_contabilidad_debito["529581"] = str_replace(".","",$detalle['salario_var']);
			}
			if(!empty($detalle['escala_salario'])){
				$registro_contabilidad_debito["529582"] = str_replace(".","",$detalle['escala_salario']);
			}
			if(!empty($detalle['aux_bonificacion'])){
				$registro_contabilidad_debito["529590"] = str_replace(".","",$detalle['aux_bonificacion']);
			}
			if(!empty($detalle['aux_eps'])){
				$registro_contabilidad_debito["529583"] = $eps = str_replace(".","",$detalle['aux_eps']);
			}
			if(!empty($detalle['aux_arl'])){
				$registro_contabilidad_debito["529584"] = $arl = str_replace(".","",$detalle['aux_arl']);
			}
			if(!empty($detalle['aux_aux'])){
				$registro_contabilidad_debito["529585"] = $aux = str_replace(".","",$detalle['aux_aux']);
			}
			if(!empty($detalle['total_ahorro_prima'])){
				$registro_contabilidad_debito["529586"] = str_replace(".","",$detalle['total_ahorro_prima']);
			}

			// Recorre los registros que van al debito.
	
			foreach ($registro_contabilidad_debito as $k1 => $v1) {
				$inser_contable[$k1]				=	array(	"empresa_id"=>$this->user->id_empresa,
														"responsable_id"=>$this->user->user_id,
														"modelo_id"=>$var['modelo_id'],
														"consecutivo"=>$consecutivo,
														"nickname_id"=>0,
														"centro_de_costos"=>$var["centro_de_costos"],
														"codigo_contable"=>$k1,
														"ciclo_produccion_id"=>$ciclopago,
														"tipo_documento"=>$tipo_documento,
														"fecha"=>date("Y-m-d"),
														"nro_documento"=>$var['nro_transaccion'],
														"pref_nro_documento"=>"NOA",
														"credito"=>"0.00",
														"debito"=>$v1,
														"json"=>json_encode($var));
				registro_contable($inser_contable[$k1]);	
			}

			$registro_contabilidad_credito["otros_ingresos"] = $detalle['ListOtrosIngresos'];
			$registro_contabilidad_credito["descuentos"] = $detalle['Descuentos'];
			$registro_contabilidad_credito["236510"]	 = str_replace(".","",$detalle['total_ingresosXporcentaje_retencion']);
			$registro_contabilidad_credito["236010"]	 = str_replace(".","",$detalle['total_ahorro_prima']);
			$registro_contabilidad_credito["281505"]	 = @$eps + @$arl + @$aux;
			$registro_contabilidad_credito["284001"]	 = str_replace(".","",$detalle['pago_global']);
			
			// Recorre los registros que van al credito 

			foreach ($registro_contabilidad_credito as $k2 => $v2){ 
				if($k2 == "otros_ingresos" || $k2 == "descuentos" || count($v2) > 1 ){
					foreach ($v2 as $k3 => $v3){
						if($k2 == "otros_ingresos"){
							$json = json_decode($v3->json);
							foreach($json->contrapartida as $k4 => $v4){
								$inser_contable[$k4]				=	array(	"empresa_id"=>$this->user->id_empresa,
																	"responsable_id"=>$this->user->user_id,
																	"modelo_id"=>$var['modelo_id'],
																	"consecutivo"=>$consecutivo,
																	"nickname_id"=>0,
																	"codigo_contable"=>$v4,
																	"debito"=>$json->valor[$k4],
																	"centro_de_costos"=>$var["centro_de_costos"],
																	"ciclo_produccion_id"=>$ciclopago,
																	"tipo_documento"=>$tipo_documento,
																	"fecha"=>date("Y-m-d"),
																	"nro_documento"=>$v3->consecutivo,
																	"pref_nro_documento"=>"NOA",
																	"credito"=>"0.00",
																	"json"=>json_encode($var));
								registro_contable($inser_contable[$k4]);
							}
						}else{
							$inser_contable[$k3]				=	array(	"empresa_id"=>$this->user->id_empresa,
																"responsable_id"=>$this->user->user_id,
																"modelo_id"=>$var['modelo_id'],
																"consecutivo"=>$consecutivo,
																"nickname_id"=>0,
																"codigo_contable"=>$v3->codigo_contable,
																"credito"=>$v3->debito/$v3->nro_quincenas,
																"centro_de_costos"=>$var["centro_de_costos"],
																"ciclo_produccion_id"=>$ciclopago,
																"tipo_documento"=>$tipo_documento,
																"fecha"=>date("Y-m-d"),
																"nro_documento"=>$v3->nro_documento,
																"pref_nro_documento"=>"NOA",
																"debito"=>"0.00",
																"json"=>json_encode($var));
							registro_contable($inser_contable[$k3]);

							$insert_cuota[$k3] 						=  array("id_empresa"=>$this->user->id_empresa,
																"centro_de_costos"=>$var["centro_de_costos"],
																"user_id"=>$var['modelo_id'],
																"nro_documento"=>$consecutivo,
																"nro_cuota"=>$detalle['cantidad_de_cuotas'][$k3],
																"descuento_id"=>$v3->descuento_id,
																"ciclo_de_produccion"=>$ciclopago,
																"consecutivo"=>$consecutivo_descuento,
																"cuota"=>str_replace(".","",$detalle['monto_cuota'][$k3]),
																"Pendiente"=>str_replace(".","",$detalle['restante'][$k3]),
																"estatus"=>1);
							insertar_descuentos_pagos($insert_cuota[$k3]);
						}
						
					}

				}else{
					$inser_contable[$k2]				=	array(	"empresa_id"=>$this->user->id_empresa,
															"responsable_id"=>$this->user->user_id,
															"modelo_id"=>$var['modelo_id'],
															"consecutivo"=>$consecutivo,
															"nickname_id"=>0,
															"centro_de_costos"=>$var["centro_de_costos"],
															"codigo_contable"=>$k2,
															"ciclo_produccion_id"=>$ciclopago,
															"tipo_documento"=>$tipo_documento,
															"fecha"=>date("Y-m-d"),
															"nro_documento"=>$var['nro_transaccion'],
															"pref_nro_documento"=>"NOA",
															"credito"=>$v2,
															"debito"=>"0.00",
															"json"=>json_encode($var));
					registro_contable($inser_contable[$k2]);
				}
			}
			/*if(!empty($var['descuentos_array'])){
			
				foreach($var['descuentos_array'] as $k => $v){
				
					$array_honorario["descuentos_array"]	=	
					$insert_contable_descuentos				=	array(	"empresa_id"=>$this->user->id_empresa,
																	"responsable_id"=>$this->user->user_id,
																	"modelo_id"=>$v->modelo_id,
																	"consecutivo"=>$consecutivo,
																	"nickname_id"=>0,
																	"centro_de_costos"=>$v->centro_de_costos,
																	"codigo_contable"=>$v->codigo_contable,
																	"ciclo_produccion_id"=>$ciclopago,
																	"fecha"=>date("Y-m-d"),
																	"procesador_id"=>$v->procesador_id,																
																	"nro_documento"=>$v->nro_documento,
																	"pref_nro_documento"=>"NOA",
																	"tipo_documento"=>12,
																	"debito"=>"0.00",
																	"credito"=>$v->monto_cuota,
																	"json"=>json_encode($v));
						$monto_cuota_descuento	+=		$v->monto_cuota;											
						registro_contable($insert_contable_descuentos);
					}
				}

			$array_honorario["281505"]	=
			$inser_contable				=	array(	"empresa_id"=>$this->user->id_empresa,
													"responsable_id"=>$this->user->user_id,
													"modelo_id"=>$var['modelo_id'],
													"consecutivo"=>$consecutivo,
													"nickname_id"=>0,
													"centro_de_costos"=>$var["centro_de_costos"],
													"codigo_contable"=>"414580",
													"ciclo_produccion_id"=>$ciclopago,
													"tipo_documento"=>$tipo_documento,
													"fecha"=>date("Y-m-d"),
													"nro_documento"=>$var['nro_transaccion'],
													"pref_nro_documento"=>"NOA",
													"tipo_documento"=>$tipo_documento,
													"debito"=>$var["pago_global"],
													"credito"=>"0.00",
													"json"=>json_encode($var));
			registro_contable($inser_contable);
			
			$array_honorario["233525"]	=
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
													"credito"=>$var["pago_global"] - $monto_cuota_descuento,
													"debito"=>"0.00",
													"json"=>json_encode($var));
			registro_contable($inser_contable);*/		
		}
		incrementa_consecutivo($this->user->id_empresa,$tipo_documento);
		rp_honorarios_modelos($var['modelo_id'],$consecutivo,$ciclopago,date("Y-m-d"),json_encode($this->session->userdata("rp_honorarios_modelos")),1);
		return TRUE;
		//pre($consecutivo);
	}
	
	public function Transferir($var){
		if($this->uri->segment(3) == "Cajas"){
			$tipo_documento				=	9;
		}else{
			$tipo_documento				=	11;
		}
		$consecutivo				=	consecutivo($this->user->id_empresa,$tipo_documento);
		$var["consecutivo"]			=	$consecutivo;
		$var['user_id']				=	$this->user->user_id;
		$var['empresa_id']			=	$this->user->id_empresa;
		$var['centro_de_costos']	=	$this->user->centro_de_costos;
		$inser_contable				=	array(	"empresa_id"=>$this->user->id_empresa,
												"responsable_id"=>$this->user->user_id,
												"consecutivo"=>$consecutivo,
												"procesador_id"=>@$var["procesador_id_origen"],
												"centro_de_costos"=>$var["centro_de_costos"],
												"codigo_contable"=>$var["procesador_origen_codigo_contable"],
												"codigo_contable_subfijo"=>$var["procesador_origen_codigo_contable_subfijo"],
												"ciclo_produccion_id"=>@$this->user->ciclo_produccion_id,
												"tipo_documento"=>$tipo_documento,
												"fecha"=>date("Y-m-d"),
												"pref_nro_documento"=>"NOA",
												"tipo_documento"=>$tipo_documento,
												"debito"=>"0.00",
												"credito"=>$var["monto"],
												"json"=>json_encode($var));
		if(isset($var['id_caja_origen'])){
			$inser_contable['caja_id'] = $var['id_caja_origen'];
		}

		registro_contable($inser_contable);
		$inser_contable				=	array(	"empresa_id"=>$this->user->id_empresa,
											"responsable_id"=>$this->user->user_id,
											"consecutivo"=>$consecutivo,
											"procesador_id"=>@$var["procesador_id_destino"],
											"centro_de_costos"=>$var["centro_de_costos"],
											"ciclo_produccion_id"=>@$this->user->ciclo_produccion_id,
											"codigo_contable"=>$var["procesador_destino_codigo_contable"],
											"codigo_contable_subfijo"=>$var["procesador_destino_codigo_contable_subfijo"],
											"tipo_documento"=>$tipo_documento,
											"fecha"=>date("Y-m-d"),
											"pref_nro_documento"=>"NOA",
											"tipo_documento"=>$tipo_documento,
											"credito"=>"0.00",
											"debito"=>$var["monto"],
											"json"=>json_encode($var));
		if(isset($var['transferir_a'])){
			if($var['transferir_a'] == "Caja"){
				if(isset($var['procesador_id_destino'])){
					$inser_contable['caja_id'] = $var['procesador_id_destino'];
					unset($inser_contable['procesador_id']);
				}
				if(isset($var['id_caja_destino'])){
					$inser_contable['caja_id'] = $var['id_caja_destino'];
				}
			}else{
				if(isset($var['id_caja_destino'])){
					$inser_contable['procesador_id'] = $var['id_caja_destino'];
				}

			}
		}

		registro_contable($inser_contable);	
		incrementa_consecutivo($this->user->id_empresa,$tipo_documento);
	}

	public function get_transferencia(){
		$tabla		=	DB_PREFIJO."rp_operaciones";
		$this->result	=	$this->db->select("*")
									->from($tabla)
									->where('empresa_id',$this->user->id_empresa)
									->where('consecutivo',$this->uri->segment(3))
									->where('tipo_documento',11)
									//->where('estatus',1)
									->get()
									->result();
		return;
	}
	
	public function ResumenCajas(){
		return $this->result	=	ResumenCajas(array('110510','110505'),array("6","14","11"),1);
	}
	
	public function ResumenBancos(){
		return $this->result	=	array(	'Nacionales'=>ResumenBancosNew(array("Pesos","COP")),
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

	public function BancosDetalles($procesador_id,$contable,$documento=6,$transferencias=array()){
		$codigo_contable = explode("-",$contable);
		$tipo_documento  = explode("-",$documento);
		$tabla		=	DB_PREFIJO."rp_operaciones";
		$debitos	=	$this->db->select("*")
									->from($tabla)
									->where('empresa_id',$this->user->id_empresa)
									->where('procesador_id',$procesador_id)
									->where_in('codigo_contable',$codigo_contable)
									->where_in('tipo_documento',5)
									->where('estatus',1)
									->get()
									->result();
		//echo $this->db->last_query();
		$creditos	=	$this->db->select("*,debito as credito,0 as debito,debito as debito_nacional,credito as credito_nacional")
									->from($tabla)
									->where('empresa_id',$this->user->id_empresa)
									->where('procesador_id',$procesador_id)
									->where_in('codigo_contable',$codigo_contable)
									->where_in('tipo_documento',$tipo_documento)
									->where('estatus',1)
									->get()
									->result();						
		//pre($debitos);
											
		if($transferencias)	{						
			$transferencias	=	$this->db->select("*,debito as debito_nacional,credito as credito_nacional")
										->from($tabla)
										->where('empresa_id',$this->user->id_empresa)
										->where('procesador_id',$procesador_id)
										->where_in('codigo_contable',$codigo_contable)
										->where_in('tipo_documento',$transferencias)
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
		$tabla	=	DB_PREFIJO."rp_operaciones t1";
		$this->result = $this->db->select("t1.codigo_contable,t1.nro_documento,fecha,tipo_documento,consecutivo,debito as debito_COP,credito as credito_COP,t2.nombre_caja,t1.json,t1.estatus")
									->from($tabla)
									->join(DB_PREFIJO."fi_cajas t2", 't2.id_caja 	= 	t1.caja_id', 'left')
									->where('t1.empresa_id',$this->user->id_empresa)
									->where('t1.caja_id',$id_cuenta)
									->where('t1.estatus',1)
									->where('t1.codigo_contable',$this->uri->segment(4))
									//->group_by("tipo_documento")
									->get()
									->result();
	}
	
	public function getRetiro(){
		$tabla	=	DB_PREFIJO."rp_operaciones";
		return $this->result = $this->db->select("fecha,tipo_documento,consecutivo,debito,credito,json,estatus,ciclo_produccion_id")
									->from($tabla)
									->where('empresa_id',$this->user->id_empresa)
									//->where('estatus',1)
									->where('tipo_documento',6)
									->where_in('codigo_contable',array('110505','111005','110510'))
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
		if(!empty($var['Banco_destino'])){
			$array_banco_destino        = 	explode("/-/",$var['Banco_destino']);
			$codigo_contable 			=   $array_banco_destino[1];
			$procesador_id				=	$array_banco_destino[3];
		}else{
			$array_banco_destino        = 	explode("/-/",$var['CajaDestino']);
			$codigo_contable 			=   $array_banco_destino[1];
		}
		unset($var['entidad_bancaria'],$var["ComisionBancaria"]);	
		
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
										"debito"=>"0.00",
										"credito"=>$var["usd_cargado"],
										"json"=>json_encode($var));
			registro_contable($inser_contable);	
			$inser_contable	=	array(	"empresa_id"=>$this->user->id_empresa,
										"responsable_id"=>$this->user->user_id,
										"consecutivo"=>$consecutivo,
										"caja_id"=>$CajaDestino,
										"procesador_id"=>@$procesador_id,
										"centro_de_costos"=>$var["centro_de_costos"],
										"ciclo_produccion_id"=>$var["ciclo_de_produccion"],

										"codigo_contable"=>$codigo_contable,
										"tipo_documento"=>$tipo_documento,
										"fecha"=>$var["fecha_transaccion"],
										"pref_nro_documento"=>"NOA",
										"tipo_documento"=>6,
										"nro_documento"=>$var['nro_transaccion'],
										"debito"=>$var["valor_retiro"],
										"credito"=>"0.00",
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
										"debito"=>$ComisionBancaria,
										"credito"=>"0.00",
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
		$Banco_destino = explode("-",$var['procesador_id']);
		$CajaDestino				=	$Banco_destino[0];
		$codigo_destino   			=   $Banco_destino[1];
		
		$inser_contable	=	array(	"empresa_id"=>$this->user->id_empresa,
									"responsable_id"=>$this->user->user_id,
									"consecutivo"=>$consecutivo,
									"procesador_id"=>$CajaDestino,
									"centro_de_costos"=>$var["centro_de_costos"],
									"ciclo_produccion_id"=>$var["ciclo_de_produccion"],
									"codigo_contable"=>$this->uri->segment(5),
									"tipo_documento"=>$tipo_documento,
									"fecha"=>$var["fecha_transaccion"],
									"pref_nro_documento"=>"NOA",
									"caja_id"=>$var["caja_id"],
									"tipo_documento"=>10,
									"nro_documento"=>$var['nro_documento'],
									"debito"=>"0.00",
									"credito"=>$var["valor_consignacion"],
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
									"debito"=>$var["valor_consignacion"],
									"credito"=>"0.00",
									"json"=>json_encode($var));
		registro_contable($inser_contable);	
		incrementa_consecutivo($this->user->id_empresa,$tipo_documento);
		return true;
	}

}
?>