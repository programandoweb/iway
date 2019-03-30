<?php

defined('BASEPATH') OR exit('No direct script access allowed');

	function GetUsuarios($type,$select="*",$id_empresa=false,$estado="ANY"){
		$ci 	=& 	get_instance();
		$tabla						=	DB_PREFIJO."usuarios";
		$ci->db->select($select);
		$ci->db->from($tabla);
		$ci->db->where_in("type",$type);
		if($estado!=="ANY"){
			$ci->db->where("estado",$estado);
		}
		if($id_empresa){
			$ci->db->where("id_empresa",$id_empresa);	
		}
		return	$ci->db->get()->result();
	}

	function get_cicloabierto(){
		$ci 	=& 	get_instance();
		$tabla						=	DB_PREFIJO.'cf_ciclos_pagos';
		$ci->db->select("ciclo_produccion_id");
		$ci->db->from($tabla);
		$ci->db->where("id_empresa",$ci->user->id_empresa);
		$ci->db->where("centro_de_costos",$ci->user->centro_de_costos);
		$ci->db->where("estado",0);
		$ci->db->limit(1);
		return	$ci->db->get()->row();
	}

	function Get_data_table($table,$select = '*',$where){
		$ci 	=& 	get_instance();
		$tabla						=	DB_PREFIJO.$table;
		$ci->db->select($select);
		$ci->db->from($tabla);
		foreach ($where as $k => $v) {
			$ci->db->where($k,$v);
		}
		return	$ci->db->get()->result();
	}

	function get_liquidaciontrm($ciclo_produccion_id){
		$ci 	=& 	get_instance();
		$tabla						=	DB_PREFIJO.'cf_ciclos_pagos';
		$ci->db->select("TRM_Liquidacion");
		$ci->db->from($tabla);
		$ci->db->where("id_empresa",$ci->user->id_empresa);
		$ci->db->where("centro_de_costos",$ci->user->centro_de_costos);
		$ci->db->where("estado",1);
		$ci->db->where("ciclo_produccion_id",$ciclo_produccion_id);
		return	$ci->db->get()->row();
	}

	function get_estadoResultados($codigo_contable,$ciclo){
		$ci 	=& 	get_instance();
		$tabla						=	DB_PREFIJO."rp_operaciones";
		$ci->db->select("SUM(credito) as credito,SUM(debito) as debito");
		$ci->db->from($tabla);
		$ci->db->where("empresa_id",$ci->user->id_empresa);
		$ci->db->where("centro_de_costos",$ci->user->centro_de_costos);
		$ci->db->where("codigo_contable",$codigo_contable);
		$ci->db->where("ciclo_produccion_id",$ciclo);
		$ci->db->where("estatus !=",9);
		return $ci->db->get()->row();
	}

	function get_reporteModelos_x_Monitor($monitor_id,$centro_de_costos,$total = null){
		$ci 	=& 	get_instance();
		$tabla						=	DB_PREFIJO."usuarios t1";
		$ci->db->select("t1.*,t2.nombre_escala,t2.meta");
		$ci->db->from($tabla);
		$ci->db->join(DB_PREFIJO."ve_escala_pagos t2", 't1.id_escala=t2.id_escala', 'left');
		$ci->db->where("t1.centro_de_costos",$centro_de_costos);
		$ci->db->where("t1.monitor",$monitor_id);
		$ci->db->where("t1.estado",1);
		$rows = $ci->db->get()->result();
		if(empty($total)){
			return	$rows;
		}else{
			$modelos = array();
			$var["ultimo_dia"] = 0;
			$var["meta_real"]  = 0;
			$var["meta_ideal"] = 0;
			foreach ($rows as $k => $v) {
				$var["ultimo_dia"] += get_ultimo_dia($v->user_id)->tokens;
				$modelos[] = $v->user_id;
				$var["meta_real"]  += $v->meta;
				$var["meta_ideal"] += $v->meta_ideal;

			}
			$ciclos_pagos = get_cf_ciclos_pagos(date("m"),$centro_de_costos);
            foreach($ciclos_pagos as $k1 => $v1){
                if($v1->fecha_desde < date("Y-m-d") && $v1->fecha_hasta > date("Y-m-d")){
					$tabla						=	DB_PREFIJO."rp_diario";
					$ci->db->select("SUM(tokens) as monto");
					$ci->db->from($tabla);
					$ci->db->where("centro_de_costos",$centro_de_costos);
					$ci->db->where_in("id_modelo",$modelos);
					$ci->db->where("estado",1);
					$ci->db->group_by("centro_de_costos");
					$result = $ci->db->get()->result();
					$var["me_falta"] = $var["meta_real"] - $result[0]->monto;
					$var["cumplimiento"] = ($result[0]->monto / $var["meta_real"])*100;
					$result["operaciones"] = $var;
					return $result;
				}
			}
		}
	}

	function get_Operacion($tipo_documento = array("6","8"),$grupo = array("Gastos"),$estado=1,$where = null,$group_by = null,$Operacion = array('','','','')){
		// Operacion debe declararce como un array con 4 campos string bacios en caso de no nesesitarlo ''
		$ci = get_instance();
		$tabla	=	DB_PREFIJO."rp_operaciones t1";
		$ci->db->select(" ".$Operacion[0]."(t1.debito) as debito,
						  ".$Operacion[1]."(t1.credito) as credito,
						  ".$Operacion[2]."(t1.debito) as debito_COP,
						  ".$Operacion[3]."(t1.credito) as credito_COP,
							t1.id,
							t1.codigo_contable,
							t1.tipo_documento,
							t1.empresa_id,
							t1.nro_documento,
							t1.credito,
							t1.estatus,
							t1.modelo_id,
							t1.json,
							fecha,
							t7.Nombre_legal as nombre_cliente,
							t7.*,
							t1.consecutivo,
							t3.abreviacion,
							t1.centro_de_costos,
							t1.ciclo_produccion_id as ciclo_de_produccion,
							t5.nombre_legal as nombre_cliente,
							t5.identificacion as Nit,
							t6.primer_nombre,
							t6.segundo_nombre,
							t6.primer_apellido,
							t6.segundo_apellido,
							t6.type");
		$ci->db->from($tabla);
		$ci->db->join(DB_PREFIJO."sys_contabilidad t2", 't1.codigo_contable=t2.codigo', 'left');
		$ci->db->join(DB_PREFIJO."usuarios t3",'t1.centro_de_costos=t3.user_id','left');
		$ci->db->join(DB_PREFIJO."cf_ciclos_pagos t4",'t1.ciclo_produccion_id=t4.ciclos_id','left');
		$ci->db->join(DB_PREFIJO."usuarios t5",'t1.cliente_id=t5.user_id','left');
		$ci->db->join(DB_PREFIJO."usuarios t6",'t1.modelo_id = t6.user_id OR t1.cliente_id = t6.user_id','left');
		$ci->db->join(DB_PREFIJO."sys_paginas_webcam t7", 't5.primer_nombre=t7.pagina', 'left');
		$ci->db->where_in("t1.estatus",$estado);
		if(!empty($where)){
			foreach ($where as $key => $value){
				$ci->db->where($key,$value);
			}
		}
		$ci->db->where_in("t1.tipo_documento",$tipo_documento);
		$ci->db->where_in("t2.grupo",$grupo);
		$ci->db->where("t1.empresa_id",$ci->user->id_empresa);
		if($ci->user->type <> "root"){
			$ci->db->where_in('t1.centro_de_costos',$ci->user->centro_de_costos);
		}

		if(!empty($group_by)){
			$ci->db->group_by($group_by);
		}		
		$query	= 	$ci->db->get();
		return $result	=	$query->result();	
	}

	function VerAnulados(){
		// Operacion debe declararce como un array con 4 campos string bacios en caso de no nesesitarlo ''
		$ci = get_instance();
		$tabla	=	DB_PREFIJO."rp_operaciones t1";
		$ci->db->select(" SUM(t1.debito) as debito,
						  SUM(t1.credito) as credito,
							t1.id,
							t1.codigo_contable,
							t1.tipo_documento,
							t1.empresa_id,
							t1.nro_documento,
							t1.credito,
							t1.estatus,
							t1.modelo_id,
							t1.json,
							t1.nro_documento,
							t1.responsable_id,
							t1.responsable_anular,
							t1.consecutivo,
							t1.fecha,
							t7.Nombre_legal as nombre_cliente,
							t7.*,
							t3.abreviacion,
							t1.centro_de_costos,
							t1.ciclo_produccion_id as ciclo_de_produccion,
							t5.nombre_legal as nombre_cliente,
							t5.identificacion as Nit,
							t6.primer_nombre,
							t6.segundo_nombre,
							t6.primer_apellido,
							t6.segundo_apellido,
							t6.type");
		$ci->db->from($tabla);
		$ci->db->join(DB_PREFIJO."sys_contabilidad t2", 't1.codigo_contable=t2.codigo', 'left');
		$ci->db->join(DB_PREFIJO."usuarios t3",'t1.centro_de_costos=t3.user_id','left');
		$ci->db->join(DB_PREFIJO."cf_ciclos_pagos t4",'t1.ciclo_produccion_id=t4.ciclos_id','left');
		$ci->db->join(DB_PREFIJO."usuarios t5",'t1.cliente_id=t5.user_id','left');
		$ci->db->join(DB_PREFIJO."usuarios t6",'t1.modelo_id = t6.user_id OR t1.cliente_id = t6.user_id','left');
		$ci->db->join(DB_PREFIJO."sys_paginas_webcam t7", 't5.primer_nombre=t7.pagina', 'left');
		$ci->db->where_in("t1.estatus",array(9,0));
		if($ci->user->type <> "root"){
			$ci->db->where_in("t1.empresa_id",array($ci->user->id_empresa));
		}
		$ci->db->group_by("t1.consecutivo");
		$query	= 	$ci->db->get();
		return $result	=	$query->result();	
	}

	function pago_gasto($nro_documento,$grupo = 'Activo',$consecutivo = null,$tipo_documento = null){
		$ci = get_instance();
		$tabla	=	DB_PREFIJO."rp_operaciones t1";
		$ci->db->select(" 	(t1.debito) as debito,
						  	(t1.credito) as credito,
						    (t1.debito) as debito_COP,
						    (t1.credito) as credito_COP,
							t1.id,
							t1.ciclo_produccion_id,
							t1.responsable_anular,
							t1.codigo_contable,
							t1.tipo_documento,
							t1.empresa_id,
							t1.nro_documento,
							t1.credito,
							t1.caja_id,
							t1.procesador_id,
							t1.estatus,
							t1.modelo_id,
							t1.json,
							fecha,
							t7.Nombre_legal as nombre_cliente,
							t7.*,
							t1.consecutivo,
							t3.abreviacion,
							t1.centro_de_costos,
							t1.ciclo_produccion_id as ciclo_de_produccion,
							t5.nombre_legal as nombre_cliente,
							t5.identificacion as Nit,
							t6.primer_nombre,
							t6.segundo_nombre,
							t6.primer_apellido,
							t6.segundo_apellido,
							t6.type");
		$ci->db->from($tabla);
		$ci->db->join(DB_PREFIJO."sys_contabilidad t2", 't1.codigo_contable=t2.codigo', 'left');
		$ci->db->join(DB_PREFIJO."usuarios t3",'t1.centro_de_costos=t3.user_id','left');
		$ci->db->join(DB_PREFIJO."cf_ciclos_pagos t4",'t1.ciclo_produccion_id=t4.ciclos_id','left');
		$ci->db->join(DB_PREFIJO."usuarios t5",'t1.cliente_id=t5.user_id','left');
		$ci->db->join(DB_PREFIJO."usuarios t6",'t1.modelo_id = t6.user_id OR t1.cliente_id = t6.user_id','left');
		$ci->db->join(DB_PREFIJO."sys_paginas_webcam t7", 't5.primer_nombre=t7.pagina', 'left');
		$ci->db->where("t1.nro_documento",$nro_documento);
		if(!empty($consecutivo)){
			$ci->db->where("t1.consecutivo",$consecutivo);
		}
		if(!empty($tipo_documento)){
			$ci->db->where("t1.tipo_documento",$tipo_documento);
		}else{
			$ci->db->where_in("t1.tipo_documento",array("16","18"));
		}
		$ci->db->where("t1.empresa_id",$ci->user->id_empresa);
				if($ci->user->type <> "root"){
			$ci->db->where_in('t1.centro_de_costos',$ci->user->centro_de_costos);
		}
		$ci->db->where("t1.estatus !=",9);
		$ci->db->where_in("t2.grupo",$grupo);	
		$query	= 	$ci->db->get();
		return $result	=	$query->result();	
	}

	function comprobante_caja($consecutivo,$tipo_documento){
		$ci = get_instance();
		$tabla	=	DB_PREFIJO."rp_operaciones t1";
		$ci->db->select(" 	(t1.debito) as debito,
						  	(t1.credito) as credito,
						    (t1.debito) as debito_COP,
						    (t1.credito) as credito_COP,
							t1.id,
							t1.codigo_contable,
							t1.tipo_documento,
							t1.empresa_id,
							t1.nro_documento,
							t1.credito,
							t1.estatus,
							t1.modelo_id,
							t1.json,
							fecha,
							t7.Nombre_legal as nombre_cliente,
							t7.*,
							t1.consecutivo,
							t3.abreviacion,
							t1.centro_de_costos,
							t1.ciclo_produccion_id as ciclo_de_produccion,
							t5.nombre_legal as nombre_cliente,
							t5.identificacion as Nit,
							t6.primer_nombre,
							t6.segundo_nombre,
							t6.primer_apellido,
							t6.segundo_apellido,
							t6.type");
		$ci->db->from($tabla);
		$ci->db->join(DB_PREFIJO."sys_contabilidad t2", 't1.codigo_contable=t2.codigo', 'left');
		$ci->db->join(DB_PREFIJO."usuarios t3",'t1.centro_de_costos=t3.user_id','left');
		$ci->db->join(DB_PREFIJO."cf_ciclos_pagos t4",'t1.ciclo_produccion_id=t4.ciclos_id','left');
		$ci->db->join(DB_PREFIJO."usuarios t5",'t1.cliente_id=t5.user_id','left');
		$ci->db->join(DB_PREFIJO."usuarios t6",'t1.modelo_id = t6.user_id OR t1.cliente_id = t6.user_id','left');
		$ci->db->join(DB_PREFIJO."sys_paginas_webcam t7", 't5.primer_nombre=t7.pagina', 'left');
		$ci->db->where("t1.consecutivo",$consecutivo);
		$ci->db->where("t1.tipo_documento",$tipo_documento);
		//$ci->db->where("t1.estatus !=",9);
		$query	= 	$ci->db->get();
		return $result	=	$query->result();	
	}   

	function SetCentrodeCostosLogin($data){
		$ci = get_instance();
		$get					=	$ci->db->select("t2.*,t1.principal,t2.sistema_salarial")
										->from(DB_PREFIJO."usuarios t1")
										->join(DB_PREFIJO."usuarios t2", 't1.id_empresa	=	t2.user_id', 'left')
										->where('t1.user_id',$data->centro_de_costos)
										->get()
										->row();												
		$data->periodo_pagos	=	$get->periodo_pagos;
		$data->principal		=	$get->principal;
		$data->json				=	$get->json;
		$data->sistema_salarial		=	$get->sistema_salarial;
		$ciclo_informacion			=	get_cf_ciclos_pagos_new($data->id_empresa,0);
		$periodo_pagos				=	centrodecostos($data->id_empresa);
		if(!empty($ciclo_informacion) && !empty($periodo_pagos)){
			$data->ciclo_produccion_id	=	ciclopago($periodo_pagos->periodo_pagos,$ciclo_informacion->mes,$ciclo_informacion->fecha_desde);
		}
		$tabla		=		DB_PREFIJO."cf_HonorariosModelos";
		$ci->db->select('*')->from($tabla);
		$ci->db->where('empresa_id',$data->id_empresa);
		$query			=	$ci->db->get();
		$Configuracion	=	$query->row();
		
		
		$tabla	=	DB_PREFIJO."cf_ciclos_pagos";
		$ciclo	=	$ci->db->select("*,DATE_FORMAT(fecha_desde,'%d') as desde,DATE_FORMAT(fecha_hasta,'%d') as hasta")->from($tabla)->where("estado",0)->get()->row();
		
		$ci->session->set_userdata(array('User'=>$data,'Configuracion'=>@$Configuracion,'CicloDePago'=>array("ciclos_id"=>@$ciclo->ciclos_id,"objeto"=>@$ciclo)));
	}

	function get_proveedor($var){
		$ci 	=& 	get_instance();
		$tabla						=	DB_PREFIJO."usuarios";
		$ci->db->select('user_id');
		$ci->db->from($tabla);
		$ci->db->where("type",'Proveedores');
		$ci->db->where("estado",1);
		$ci->db->like('nombre_legal',$var['proveedor'],'before');
		$result = $ci->db->get()->row();
		if(empty($result)){
			return false;
		}else{
			return true;
		}
	}

	function valor_trm($valor = "Valor_trm"){
		$ci 	=& 	get_instance();
		$tabla						=	DB_PREFIJO."cf_HonorariosModelos";
		$ci->db->select($valor);
		$ci->db->from($tabla);
		$ci->db->where("empresa_id",$ci->user->id_empresa);
		$result = $ci->db->get()->row();
		return $result;
	}

	function insertar_Observacion($observacion){
		// Se debe pasar la url(Current_url) $observacion['url'] y la observacion $observacion['observacion'];
		$ci = get_instance();
		$tabla = 	DB_PREFIJO."sys_observaciones";
		$observacion['user_id'] 	= $ci->user->user_id;
		$observacion['fecha']		= date("Y-m-d h:i:s");
		$observacion['empresa_id']	= $ci->user->id_empresa;
		$observacion['centro_de_costos'] = $ci->user->centro_de_costos;
		if($ci->db->insert($tabla,$observacion)){
			return true;
		}else{
			return false;
		}
	}

	function get_ConfigSeguridadSocial($select){
		$ci 	=& 	get_instance();
		$tabla						=	DB_PREFIJO."cf_seguridadsocial";
		$ci->db->select($select);
		$ci->db->from($tabla);
		$ci->db->where("centro_de_costos",$ci->user->centro_de_costos);
		$ci->db->where("empresa_id",$ci->user->id_empresa);
		return $ci->db->get()->row();
	}

	/*function AutocompleteBancos($row,$name,$placeholder='',$require=false,$moneda = array("Pesos","COP")){

		if(empty($row)){
			$row=new stdClass();		
			$row->$name='';
		}else if(is_string($row)){
			$row=new stdClass();		
			$row->$name= $row;
		}
		$ci 	=& 	get_instance(); 
		$rows = ResumenBancosNew($moneda);
		$html	=	'';
		$html	.=	'<input type="text" data-proveedor="'.base_url("Ventas/ConfirmarProveedor").'" class="form-control"  placeholder="'.$placeholder.'" id="content'.$name.'" maxlength="150"  value="'.$row->$name.'"';
		$html	.=	($require)? 'require="require"':'""';
		$html	.=	'/>';
		$html	.=	'<input type="hidden" name="'.$name.'" id="'.$name.'" require="require" />';
		$html	.= 	'	<script>
							$(function(){
								var projects = [';
									foreach($rows as $k => $v){
										$html	.= 	'{
														value: "'.$v->user_id.'",
														label: "'.$v->nombre_legal.'"
													},';
									}
								 
		$html	.= 	'			];
								$( "#content'.$name.'" ).autocomplete({
									minLength: 0,
									source: projects,
									focus: function( event, ui ) {
										$( "#content'.$name.'" ).val( ui.item.label );
										$( "#'.$name.'" ).val( ui.item.value );
											return false;
									},
									select: function( event, ui ) {
										$("#content'.$name.'" ).val( ui.item.label );
										$( "#'.$name.'" ).val( ui.item.value );
										return false;
									}
								});
							});
						</script>
					';
		return $html;
	}*/

	function MakeProveedores($row,$name,$placeholder='',$require=false,$select = "Proveedores",$nom = null){

		if(empty($row)){
			$row=new stdClass();		
			$row->$name='';
		}else if(is_string($row)){
			$row=new stdClass();		
			$row->$name= $row;
		}
		$ci 	=& 	get_instance(); 
		$rows = GetUsuarios($select,"nombre_legal,user_id,primer_nombre,segundo_nombre,primer_apellido,segundo_apellido,type",$ci->user->id_empresa,1);
		$html	=	'';
		$html	.=	'<input type="text" class="form-control"  placeholder="'.$placeholder.'" id="content'.$name.'" maxlength="150"  value="'.$row->$name.'"';
		$html	.=	($require)? 'require="require"':'""';
		$html	.=	'/>';
		$html	.=	'<input type="hidden" name="'.$name.'" id="'.$name.'" require="require" />';
		$html	.= 	'	<script>
							$(function(){
								var projects = [';
									foreach($rows as $k => $v){
										if(empty($v->nombre_legal)){
											$nombre = @$v->primer_nombre.' '.@$v->segundo_nombre.' '.@$v->primer_apellido.' '.@$v->segundo_apellido;
											if(!empty($nom)){
												$nom1 = $nombre;
											}else{
												$nom1 = $v->user_id;
											}
										}else{
											$nombre = $v->nombre_legal;
											if(!empty($nom)){
												$nom1 = $nombre;
											}else{
												$nom1 = $v->user_id;
											}
										}
										$html	.= 	'{
														value: "'.$nom1.'",
														label: "'.$nombre.'"
													},';
									}
								 
		$html	.= 	'			];
								$( "#content'.$name.'" ).autocomplete({
									minLength: 0,
									source: projects,
									focus: function( event, ui ) {
										$( "#content'.$name.'" ).val( ui.item.label );
										$( "#'.$name.'" ).val( ui.item.value );
											return false;
									},
									select: function( event, ui ) {
										$("#content'.$name.'" ).val( ui.item.label );
										$( "#'.$name.'" ).val( ui.item.value );
										return false;
									}
								});
							});
						</script>
					';
		return $html;
	}

	function get_cf_meta_ideal($centro_de_costos){
		$ci 	=& 	get_instance();
		$tabla						=	DB_PREFIJO."cf_meta_ideal";
		$ci->db->select("*");
		$ci->db->from($tabla);
		$ci->db->where_in("centro_de_costos",$centro_de_costos);
		return	$ci->db->get()->result();
	}

	function get_NotificacionEmail($url= null){
		$ci 	=& 	get_instance();
		$tabla=DB_PREFIJO."ut_emails";
		$ci->db->select("*");
		$ci->db->from($tabla);
		$ci->db->where("empresa_id",$ci->user->id_empresa);
		$ci->db->where("centro_de_costos",$ci->user->centro_de_costos);
		$ci->db->where("estado",1);
		if(empty($url)){
			$ci->db->where("Modulo",current_url());
		}else{
			$ci->db->where("Modulo",$url);
		}
		$query=$ci->db->get();
		$result=$query->result();
		return $result;
	}

	function eliminarDir($carpeta){
		foreach(glob($carpeta . "/*") as $archivos_carpeta){
             //echo $archivos_carpeta;
             $ci = get_instance();
 
            if (is_dir($archivos_carpeta)){
                if($ci->eliminarDir($archivos_carpeta)){
                	return true;
                }else{
                	return false;
                }
			}else{
				if(unlink($archivos_carpeta)){
				  	return true;
                }else{
                	return false;
                }
			}
		}
 
		return;
	}

	function GetFormControl($id_form_control,$key = 'id_form_contrl'){
		$ci 	=& 	get_instance();
		$tabla						=	DB_PREFIJO."ut_form_control";
		$ci->db->select('*');
		$ci->db->from($tabla);
		$ci->db->where($key,$id_form_control);
		return	$ci->db->get()->result();
	}

	function checkemail($email = array()){
		$key = key($email);
		$ci 	=& 	get_instance();
		$tabla						=	DB_PREFIJO."usuarios";
		$ci->db->select("email");
		$ci->db->from($tabla);
		$ci->db->where($key,$email[$key]);
		return	$ci->db->get()->result();
	}

	function makeTipoServicio($name,$estado,$extra = array("class"=>"form-control")){
		$options = array( ""=>"Seleccione",
						"Directo"=>"Directo",
						"Proveedor"=>"Proveedor");
		return form_dropdown($name, $options, $estado,$extra);	
	}

	function MakeSelect($name,$estado,$extra = array("class"=>"form-control"),$data,$key = false){
		$options = array();
		if(!empty($data)){
			if(is_array($data)){
				foreach ($data as $k => $v){
					if($key){
						$options[$v] = $v;
					}else{
						$options[$k] = $v;
					}
				}
			}
		}
		return form_dropdown($name, $options, $estado,$extra);	
	}

	function MakeBanco($name,$estado,$extra = array("class"=>"form-control"),$data,$key = false){
		$options = array(""=>"Seleccione");
		if(is_array($data)){
			foreach ($data as $k => $v) {
				if($key){
					$options[$v->entidad_bancaria.'/-/'.$v->modo_cuenta.'/-/'.$v->nro_cuenta.'/-/'.$v->id_cuenta] = entidadbancaria($v->entidad_bancaria).' ('.$v->nro_cuenta.')';
				}else{
					$options[$k] = $v;
				}
			}
		}
		echo form_dropdown($name, $options, $estado,$extra);	
	}

	function makeTipoCaja($name,$estado,$extra = array("class"=>"form-control")){
		$options = array( ""=>"Seleccione",
						"Caja menor"=>"Caja menor",
						"Caja moneda extranjera" => "Caja moneda extranjera");
		return form_dropdown($name, $options, $estado,$extra);	
	}

	function MakeTipoUsuarios(){
		$options = array(
			""				=>	"Seleccione",
			"Administrativos"	=>	"Administrativos",
			"Asociados"		=>	"Asociados",			
			"Modelos"		=>	"Modelos",
			"Monitores"		=>	"Monitores",
			"Proveedores"	=>	"Proveedores",
			);
		return form_dropdown("aplicar_al_perfil", $options, null,array("id"=>"aplicar_al_perfil","class"=>"form-control"));
	}

	/*function getMonthDays($Month, $Year){
	   //Si la extensión que mencioné está instalada, usamos esa.
	   if( is_callable("cal_days_in_month")){
	      return cal_days_in_month(CAL_GREGORIAN, $Month, $Year);
	   }else{
	      //Lo hacemos a mi manera.
	      return date("d",mktime(0,0,0,$Month+1,0,$Year));
	   }
	}*/ 

	function RP_X_Master_X_Procesador($procesador_id,$master_id,$ciclo_produccion_id){
		$tabla	=	DB_PREFIJO."rp_operaciones t1";
		$ci 	=& 	get_instance();	
		$ci->db->select("plataforma_id,json")->from($tabla);
		$ci->db->where("t1.empresa_id",$ci->user->id_empresa);
		$ci->db->where("t1.tipo_documento",1);
		$ci->db->where("t1.procesador_id",$procesador_id);
		//$ci->db->where("t1.master_id",$master_id);
		//$ci->db->where("t1.estatus",1);
		$ci->db->where("t1.codigo_contable",414580);
		$ci->db->where("t1.ciclo_produccion_id",$ciclo_produccion_id);
		$rows	= 	$ci->db->get()->result();
		return $rows;
	}
	
	function GetMastersXProcesadores($cuenta_id){
		$ci 	=& 		get_instance();
		$tabla	=	DB_PREFIJO."cf_rel_master t1";
		$ci 	=& 	get_instance();	
		$ci->db->select("t1.*,t2.primer_nombre")->from($tabla);
		$ci->db->join(DB_PREFIJO."usuarios t2", 't1.id_plataforma=t2.user_id', 'left');
		$ci->db->where("t1.id_empresa",$ci->user->id_empresa);
		$ci->db->where("t1.cuenta_id",$cuenta_id);
		$ci->db->where("t1.estado",1);
		return $ci->db->get()->result();
	}
	
	function GetProcesadores($id_cuenta=null){
		$ci 	=& 		get_instance();
		$tabla	=		DB_PREFIJO."fi_cuentas t1";
		$ci->db->select("*,t2.Entidad");
		$ci->db->from($tabla);
		$ci->db->join(DB_PREFIJO."sys_bancos t2", 't1.entidad_bancaria=t2.banco_id', 'left');
		$ci->db->where("t1.id_empresa",$ci->user->id_empresa);
		$ci->db->where("t1.id_cuenta",$id_cuenta);
		$query					=	$ci->db->get();
		return $query->result();
	}
	
	function GetNicknames(){
		$ci 					=& 		get_instance();
		$tabla					=		DB_PREFIJO."cf_nickname t1";
		$ci->db->select("t1.id_master,t2.*");
		$ci->db->from($tabla);
		$ci->db->join(DB_PREFIJO."usuarios t2", 't1.id_modelo=t2.user_id', 'left');
		$ci->db->where("t1.id_empresa",$ci->user->id_empresa);
		$query					=	$ci->db->get();
		$rows					=	$query->result();
		$return		=	array();
		foreach($rows as $k => $v){
			$return[$v->id_master][]	=	$v;	
		}
		return $return;

	}
	
	function GetMastersXPlataformas(){
		$ci 					=& 		get_instance();
		$tabla					=		DB_PREFIJO."cf_rel_master t1";
		$ci->db->select("*");
		$ci->db->from($tabla);
		$ci->db->where("t1.id_empresa",$ci->user->id_empresa);
		$ci->db->order_by('t1.nombre_master','ASC');
		$query					=	$ci->db->get();
		$rows			=	$query->result();
		$return			=	array();
		foreach($rows as $k => $v){
			$return[$v->id_plataforma][]	=	$v;	
		}
		return $return;
	}

	function MakePlataformasnew($name,$estado=null,$extra=array()){
		$ci 					=& 		get_instance();
		$tabla					=		DB_PREFIJO."usuarios";
		$ci->db->select("primer_nombre");
		$ci->db->from($tabla);
		$ci->db->where("id_empresa",$ci->user->id_empresa);
		$ci->db->where("type","Plataformas");
		$ci->db->order_by('primer_nombre','ASC');
		$query					=	$ci->db->get();
		$rows			=	$query->result();
		$options			=	array(""=>"Seleccione");
		foreach($rows as $k => $v){
			$options[$v->primer_nombre]	=	$v->primer_nombre;	
		}
		return form_dropdown($name, $options, $estado,$extra);	
	}

	function GetTercerosXTurnos($modelos=false){
		if(!$modelos){
			$modelos	=	get_modelos();
		}
		$return 	=	array();

		foreach($modelos as $k => $v){
			if($v->turno_manama>0){
				$return["turno_manama"][]		=	$v;
			}
			if($v->turno_tarde>0){
				$return["turno_tarde"][]		=	$v;
			}
			if($v->turno_noche>0){
				$return["turno_noche"][]		=	$v;
			}
			if($v->turno_intermedio>0){
				$return["turno_intermedio"][]	=	$v;
			}
			if($v->turno_manama==0 && $v->turno_tarde==0 && $v->turno_noche==0 && $v->turno_intermedio==0 ){
				$return["turno_default"][]		=	$v;
			}
		}
		return $return;	
	}
	
	function GetTurnos(){
		return array(	"turno_manama"=>"Turno Mañana",
						"turno_tarde"=>"Turno Tarde",
						"turno_noche"=>"Turno Noche",
						"turno_intermedio"=>"Intermedio",
						"turno_default"=>"No Asignado",
				);
	}

	function GetRooms(){
		return array(	1	=>	"Room 1",
						2	=>	"Room 2",
						3	=>	"Room 3",
						4	=>	"Room 4",
						5	=>	"Room 5",
						6	=>	"Room 6",
						7	=>	"Room 7",
						8	=>	"Room 8",
						9	=>	"Room 9",
						10	=>	"Room 10",
						11	=>	"Room 11",
						1000000	=>	"Satélite"						
				);
	}

	function RP_X_Master($modelo_id,$plataforma_id,$ciclo_produccion_id){
		$tabla	=	DB_PREFIJO."rp_operaciones t1";
		$ci 	=& 	get_instance();	
		$ci->db->select("plataforma_id,
							SUM(t1.credito) AS  credito , 
							SUM(t1.debito) AS  debito,json")->from($tabla);
		$ci->db->where("t1.empresa_id",$ci->user->id_empresa);
		$ci->db->where("t1.tipo_documento",1);
		$ci->db->where("t1.plataforma_id",$plataforma_id);
		$ci->db->where("t1.modelo_id",$modelo_id);
		$ci->db->where("t1.estatus",1);
		$ci->db->where("t1.codigo_contable",414580);
		$ci->db->where("t1.ciclo_produccion_id",$ciclo_produccion_id);
		$rows	= 	$ci->db->get()->row();
		return $rows;
	}

	function RP_X_Plataforma($plataforma_id,$ciclo_produccion_id){
		$tabla	=	DB_PREFIJO."rp_operaciones t1";
		$ci 	=& 	get_instance();	
		$ci->db->select("plataforma_id,
							SUM(t1.credito) AS  credito , 
							SUM(t1.debito) AS  debito")->from($tabla);
		$ci->db->where("t1.empresa_id",$ci->user->id_empresa);
		$ci->db->where("t1.tipo_documento",1);
		$ci->db->where("t1.plataforma_id",$plataforma_id);
		$ci->db->where("t1.estatus",1);
		$ci->db->where("t1.codigo_contable",414580);
		$ci->db->where("t1.ciclo_produccion_id",$ciclo_produccion_id);
		//$ci->db->group_by('t1.modelo_id','ASC');
		$rows	= 	$ci->db->get()->row();
		return $rows;
	}

	function GetPlataformas(){
		$ci 	=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."usuarios t1";
		return $ci->db->select("t1.*,t2.id_plataforma AS plataforma_id,t3.abreviacion")
						->from($tabla)
						->join(DB_PREFIJO."cf_nickname t2", 't1.user_id=t2.id_plataforma', 'left')
						->join(DB_PREFIJO."usuarios t3", 't2.centro_de_costos=t3.user_id', 'left')
						->where('t3.id_empresa',$ci->user->id_empresa)
						->group_by('t2.id_plataforma','ASC')
						->get()
						->result();
						
		$tabla	=	DB_PREFIJO."sys_paginas_webcam t1";
		return $ci->db->select("t1.*,t2.estado,t4.abreviacion,t2.user_id as plataforma_id")
						->from($tabla)
						->join(DB_PREFIJO."usuarios t2", 't1.Nombre_legal=t2.nombre_legal', 'left')
						->join(DB_PREFIJO."cf_nickname t3", 't2.user_id=t3.id_plataforma', 'left')
						->join(DB_PREFIJO."usuarios t4", 't3.centro_de_costos=t4.user_id', 'left')
						->where('t3.id_empresa',$ci->user->id_empresa)
						->group_by('t3.id_plataforma','ASC')
						->get()
						->result();
	}

	function RPTRMpromedio($ciclo_produccion_id,$mes,$ciclo){
		$ci 	=& 	get_instance();
		$tabla	=	DB_PREFIJO."rp_operaciones";
		$ci->db->select('json')->from($tabla);
		$ci->db->where('empresa_id',$ci->user->id_empresa);
		$ci->db->where('estatus',1);
		$ci->db->where('ciclo_produccion_id',$ciclo_produccion_id);
		//$ci->db->where_in('codigo_contable',array(110505));
		$ci->db->where_in('tipo_documento',array(6));
		$query			=	$ci->db->get();
		$row			=	$query->result();
		$return			=	0;
		if(!empty($row)){
			$count		=	0;
			foreach($row as $k => $v){
				//$return		=	json_decode($v->json)->trm;
				$return			+=	round(json_decode($v->json)->trm,2);
				$count++;
			}
			$return		=	$return / $count;
		}else{
			$tabla	=	DB_PREFIJO."sys_trm";
			//$ci->db->select('((SUM(monto) / 30) * 0.96) AS monto')->from($tabla);
			$ci->db->select('((AVG(monto)) * 0.96) AS monto')->from($tabla);
			if($ciclo=="Q1"){
				$ci->db->where('fecha>=',date("Y-".$mes."-01"));
				$ci->db->where('fecha<=',date("Y-".$mes."-15"));
			}else if($ciclo=="Q2"){
				$ci->db->where('fecha>=',date("Y-".$mes."-01"));
				$ci->db->where('fecha<=',date("Y-".$mes."-31"));
			}
			$query			=	$ci->db->get();
			$row			=	$query->row();
			$return			=	$row->monto;
		}
		return $return;
	}

	function get_sucursales(){
		$ci 	=& 	get_instance();
		$tabla	=	DB_PREFIJO."usuarios";
		$rows	=	$ci->db	->select("*")
						->from($tabla)
						->where('type',"CentroCostos")
						->where('id_empresa',$ci->user->id_empresa)
						->get()
						->result();	
		$return	=	array();
		foreach($rows as $k => $v){
			$return[(int)$v->user_id]	=	$v;
		}				
		return $return;
	}
	
	function get_modelos($custom=false){
		$ci 	=& 	get_instance();
		$tabla	=	DB_PREFIJO."usuarios";
		$rows	= 	$ci->db	->select("*")
							->from($tabla)
							->where('type',"Modelos")
							->where('id_empresa',$ci->user->id_empresa)
							->order_by('primer_nombre','ASC')
							->get()
							->result();	
		if(!$custom){					
			return $rows;
		}else{
			$custom_array		=	array();
			foreach($rows as $k =>$v){
				$custom_array["x_usuario"][$v->user_id]							=	$v;
				if(!empty($v->centro_de_costos)){
					$custom_array["x_centro_de_costos"][$v->centro_de_costos][]	=	$v;
				}
				if(!empty($v->room_transmision)){
					$custom_array["x_rooms"][$v->room_transmision][]			=	$v;
				}
			}	
			$custom_array["all"]	=	$rows;
			return $custom_array;
		}		
	}

	function checkFacturaPagada($consecutivo){
		$ci = get_instance();
		$tabla		=		DB_PREFIJO."rp_operaciones";
		$ci->db->select('SUM(credito) as total,consecutivo')->from($tabla);
		$ci->db->where('empresa_id',$ci->user->id_empresa);
		$ci->db->where('consecutivo',$consecutivo);
		//$ci->db->where('estatus',1);
		$ci->db->where_in('codigo_contable',array(414580));
		$ci->db->where_in('tipo_documento',array(1));
		$query			=	$ci->db->get();
		$row_facturado	=	$query->row();
		
		if(!empty($row_facturado)){
			$ci->db->select('SUM(debito) as total')->from($tabla);
			$ci->db->where('estatus',1);
			$ci->db->where('empresa_id',$ci->user->id_empresa);
			$ci->db->where('nro_documento',$row_facturado->consecutivo);
			$ci->db->where_in('codigo_contable',array(111010));
			$ci->db->where_in('tipo_documento',array(5));
			$query			=	$ci->db->get();
			$row_pagado		=	$query->row();
		}
		
		if(round($row_pagado->total,2)==round($row_facturado->total,2)){
			return true;	
		}else{
			return false;	
		}
	}

	function getOpcionesFacturacion(){
		$ci = get_instance();
		$tabla		=		DB_PREFIJO."cf_opciones";
		$ci->db->select('*')->from($tabla);
		$ci->db->where('empresa_id',$ci->user->id_empresa);
		$ci->db->where('resolucionFac',"OpcionesFacturacion");
		$query			=	$ci->db->get();
		$Opciones 	=	$query->row();
		return $Opciones;
	}

	function check_RQ($user_id,$desde,$hasta){
		$ci					=&	get_instance();
		$tabla				=	DB_PREFIJO."rp_diario_aprobados t1";
		$ci->db->select("*");
		$ci->db->from($tabla);
		$ci->db->where("t1.id_empresa",$ci->user->id_empresa);
		$ci->db->where('t1.centro_de_costos', $ci->user->centro_de_costos);
		$ci->db->where('t1.id_modelo', $user_id);
		$ci->db->where('t1.fecha_desde', $desde);
		$ci->db->where('t1.fecha_hasta', $hasta);
		$query						=	$ci->db->get();
		return $query->row();
	}

	function select_dias($name,$estado=null,$for=array("inicio"=>1,"fin"=>15),$extra=array("class"=>"form-control"),$fecha = "Selecione"){
		$options = array(""=>$fecha);
		for($a=$for["inicio"];$a<=$for["fin"];$a++){
			$options[$a]	=	$a;
		}
		return form_dropdown($name, $options, $estado,$extra);	
	}

	function get_total_tokens($user_id,$desde,$hasta){
		$ci					=&	get_instance();
		$tabla				=	DB_PREFIJO."rp_diario t1";
		$ci->db->select("SUM(tokens) as Total");
		$ci->db->from($tabla);
		$ci->db->join(DB_PREFIJO."usuarios t2", 't1.id_plataforma		=	t2.user_id', 'left');
		$ci->db->join(DB_PREFIJO."cf_nickname t3", 't1.nickname_id	=	t3.nickname_id', 'left');
		$ci->db->where("t1.id_empresa",$ci->user->id_empresa);
		$ci->db->where('t1.centro_de_costos', $ci->user->centro_de_costos);
		$ci->db->where('t1.id_modelo', $user_id);
		$ci->db->where('t1.fecha BETWEEN "'. date('Y-m-d', strtotime($desde)). '" AND "'. date('Y-m-d', strtotime($hasta)).'"');
		$query						=	$ci->db->get();
		return $query->row()->Total;
	}

	function get_ultimo_dia($user_id){
		$ci					=&	get_instance();
		$tabla				=	DB_PREFIJO."rp_diario t1";
		$ci->db->select("tokens,MAX(fecha) as fecha");
		$ci->db->from($tabla);
		$ci->db->join(DB_PREFIJO."usuarios t2", 't1.id_plataforma		=	t2.user_id', 'left');
		$ci->db->join(DB_PREFIJO."cf_nickname t3", 't1.nickname_id	=	t3.nickname_id', 'left');
		$ci->db->where("t1.id_empresa",$ci->user->id_empresa);
		$ci->db->where('t1.centro_de_costos', $ci->user->centro_de_costos);
		$ci->db->where('t1.id_modelo', $user_id);
		$query						=	$ci->db->get();
		return $query->row();
	}

	function estatusDB($var){
		if($var==1){
			return 'Pendiente';	
		}else if($var==9){
			return 'Anulado';	
		}else{
			return 'StandBy';
		}
	}

	function EstadoMiembrosEmpresa($id_empresa,$estado=0){
		$tabla		=		DB_PREFIJO."usuarios";
		$ci = get_instance();
		$ci->db->where("centro_de_costos", $id_empresa);
		$ci->db->update($tabla,array("estado"=>$estado));
	}

	function MakeEscalaNum($name,$num,$estado=null,$extra=array("require"=>"require")){
		$options = array(
			""		=>	"Seleccione");
			for($i=1;$i<=$num;$i++){
				$options[$i] = $i;
			}
		return form_dropdown($name, $options, $estado,$extra);
	}		
	
	function MakeRoom($name,$row){
		$sucursal = centrodecostos($row);
			$html = '<select class="form-control " name="'.$name.'"><option value="" selected="selected">Seleccione</option>';
			for($i=1;$i<=$sucursal->n_rooms;$i++){
				$html .= '<option class ="room'.$i.' act" value = "Room'.$i.'">Room'.$i.'</option>';
			}
			$html .= '</select>';
			return $html;
	}

	function Control_Sesion($data,$tipo){
		$ci = get_instance();
		if($tipo=="ini"){
			$json 				=	json_db(@$data->json,array("InicioSession"=>date('Y-m-d H:i:s'),"FinSession"=>" "));
		}else{
			$json 				=	json_db(@$data->json,array("FinSession"=>date('Y-m-d H:i:s')));
		}		
		$tabla				=	DB_PREFIJO."usuarios";
		$ci->db->where("user_id", $data->user_id);
		$ci->db->update($tabla,array("json"=>$json));
	}

	
	function object_to_array($json){
		$array_dominios		=	array();
		foreach($json as $k => $v){
			$array_dominios[$v->domain]	=	$v->domain;
		}	
		return $array_dominios;
	}



	function json_db($json,$add=false){
		$j		=	json_decode($json);
		if($add==false){
			return json_encode($j);	
		}else if($add=="decode"){
			return $j;	
		}
		//pre($j);
		if(!is_object($j)){
			$j	=	new stdClass;
		}
		if(is_array($add)){
			foreach($add as $k => $v){
				$j->$k		=	$v;
			}
		}
		return json_encode($j);
	}

	function Operaciones($campos=array()){
		$ci=&get_instance();
		$tabla		=	"rp_operaciones t1";
		$ci->db->select("	sum(t1.debito) as debito,
							sum(t1.credito) as credito,
							t2.primer_nombre,
							t2.segundo_nombre,
							t2.primer_apellido,
							t2.segundo_apellido,
							t2.type
							")
							->from(DB_PREFIJO.$tabla)
							->join(DB_PREFIJO."usuarios t2", 't1.modelo_id=t2.user_id', 'left')
							;
		if(is_array($campos)){
			foreach($campos as $k=>$v){
				$ci->db->where($k,$v);	
			}
		}
		return $ci->db->get()->row();
	}

	function getOpcionesContrato(){
		$tabla		=		DB_PREFIJO."usuarios";
		$ci=&get_instance();
		$ci->db->select('*')->from($tabla);
		$ci->db->where('id_empresa',$ci->user->id_empresa);
		$ci->db->where('user_id',$ci->uri->segment(3));
		$query			=	$ci->db->get();
		$opcionesContrato 	=	$query->row();
		return $opcionesContrato;
	}

	function cpanel($domain=false){
		include(PATH_APP.'third_party/xmlapi-php-master/xmlapi.php');
		$cpanelusr 	= 	'dpatinoz';
		$cpanelpass = 	'Andres2018..';
		$xmlapi 	= 	new xmlapi('p3plvcpnl29130.prod.phx3.secureserver.net');
		$xmlapi->set_port( 2083 );
		$xmlapi->password_auth($cpanelusr,$cpanelpass);
		$xmlapi->set_output('json');
		$xmlapi->set_debug(1);	
		
		$get_domain_list 	= 	$xmlapi->api2_query(
			@cP_user, 'DomainLookup', 'getbasedomains'       //--> todos los dominios
		);
		$domains	=	json_decode($get_domain_list)->cpanelresult->data;
		if($domain){
			return $domains;	
		}
		$return 	=	array();		
		foreach($domains as $v){
			$get_email_list 	= 	$xmlapi->api2_query(
				@cP_user, 'Email', 'listpopswithdisk',
				array( 'domain' => $v->domain )
			);
			foreach(json_decode($get_email_list)->cpanelresult->data as $v2){
				//$return[$v->domain][]	=		$v2;
				$return[]=$v2;
			}
		}
		return $return;
	}
	
	function cpanel_email($var,$addforward=false){
		//pre($var);	return;
		include(PATH_APP.'third_party/xmlapi-php-master/xmlapi.php');
		$cpanelusr 	= 	'dpatinoz';
		$cpanelpass = 	'Andres2018..';
		$xmlapi 	= 	new xmlapi('p3plvcpnl29130.prod.phx3.secureserver.net');
		$xmlapi->set_port( 2083 );
		$xmlapi->password_auth($cpanelusr,$cpanelpass);
		$xmlapi->set_output('json');
		$xmlapi->set_debug(1);
		
		$args 		= 	array();

		$result 			= 	$xmlapi->api1_query($cpanelusr, 'Email', 'addpop', array($var[0], $var[1], $var[2], $var[3]) );
		$result_forward 	= 	$xmlapi->api2_query($cpanelusr, 'Email', 'addforward', array("domain" => $var[3], "email" => $var[0], "fwdopt" => 'fwd', "fwdemail" => "masterdecuentas@bellecolombia.com.co") );
		
		//pre($result_forward);return;
		/*
		$addpop		=	$xmlapi->addpop($cpanelusr,$var); 
		if($addforward){
			$call_f 				= 	array("domain"=>$var[3], "email"=>$var[0],"fwdopt"=>"fwd", "fwdemail"=>"mastercuentas@bellecolombia.com.co");
			$add_mail_forwarder 	= 	$xmlapi->api2_query(
				'Email', 'addforward', 
				$call_f
			);
		}*/
		
		return $result;
	}
	
	function __setlocale($fecha	=false){
		$dias 	= array("","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Domingo");
		$meses 	= array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		if(!$fecha){
			return $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
		}else{
			$fechasegmentada=explode("-",$fecha);
			$mes	=	(int)$fechasegmentada[1];
			return $dias[date("N", strtotime($fecha))]." ".$fechasegmentada[2]." de ".$meses[$mes]. " del ".$fechasegmentada[0] ;
		}
	}

	function contrato($user_id){
		$ci 		=& 	get_instance();
		$tabla		=	"sys_contratos";
		return $ci->db	->select("consecutivo_id")
								->from(DB_PREFIJO.$tabla)
								->where("user_id",$user_id)	
								//->where("id_empresa",$ci->user->id_empresa)
								->get()
								->row();		
	}

		function FormaDePago($id_forma_pago){
		$ci 		=& 	get_instance();
		$tabla		=	"ve_forma_pagos";
		return $ci->db	->select("nombre_escala")
								->from(DB_PREFIJO.$tabla)
								->where("id_forma_pago",$id_forma_pago)	
								//->where("id_empresa",$ci->user->id_empresa)
								->get()
								->row();		
	}

	function comentarios_Novedades(){
		$ci 		=& 	get_instance();
		$tabla		=	"rp_novedades t1";
		return $ci->db	->select("t1.*,t2.primer_nombre,t2.segundo_nombre,t2.primer_apellido,t2.segundo_apellido")
								->from(DB_PREFIJO.$tabla)
								->join(DB_PREFIJO."usuarios t2", 't1.id_modelo=t2.user_id', 'left')
								->where("t1.parent_id",$ci->uri->segment(3))	
								//->where("id_empresa",$ci->user->id_empresa)
								->get()
								->result();		
	}
	
	function paginas(){
		$ci 		=& 	get_instance();
		$tabla		=	"usuarios";
		return $ci->db	->select('*')
								->from(DB_PREFIJO.$tabla)
								//->where("id_empresa",$ci->user->id_empresa)
								->where("type","Plataformas")
								->get()
								->result();		
	}

	function get_rp_honorarios_modelos($modelo_id,$consecutivo=0){
		$ci 		=& 	get_instance();
		if($consecutivo){
			return $ci->db->select('*') ->from(DB_PREFIJO."rp_honorarios_modelos")
										->where('modelo_id',$modelo_id)
										->where('consecutivo',$consecutivo)
										->get()
										->row();	
		}else{
			return $ci->db->select('*') ->from(DB_PREFIJO."rp_honorarios_modelos")
										->where('modelo_id',$modelo_id)
										->get()
										->result();
		}
	}
	
	function get_rp_honorarios_modelos_aprobados(){
		$ci 		=& 	get_instance();
		return $ci->db->select('*,t1.json as data_json') ->from(DB_PREFIJO."rp_honorarios_modelos t1")
									->join(DB_PREFIJO."rp_operaciones t2", 't1.modelo_id = t2.modelo_id AND t1.consecutivo = t2.consecutivo', 'left')
									->join(DB_PREFIJO."usuarios t3", 't1.modelo_id=t3.user_id', 'left')
									->where('t1.empresa_id',$ci->user->id_empresa)
									->where('t1.estatus',1)
									->where('t2.tipo_documento',13)
									->group_by(array("t1.consecutivo"))
									->get()
									->result();
	}

	function rp_honorarios_modelos($modelo_id,$consecutivo,$ciclo_produccion_id,$fecha,$json,$estatus=1){
		$ci 		=& 	get_instance();
		$tabla		=	DB_PREFIJO."rp_honorarios_modelos";
		$insert		=	array(	"modelo_id"=>$modelo_id,
								"empresa_id"=>$ci->user->id_empresa,
								"consecutivo"=>$consecutivo,
								"ciclo_produccion_id"=>$ciclo_produccion_id,
								"fecha"=>$fecha,
								"json"=>$json,
								"estatus"=>$estatus);
		$ci->db->insert($tabla,$insert);		
	}

	function ObservationDefault($insert){
		$ci 		=	& 	get_instance();
		if(empty($insert)){
			$insert		=	array("url"=>current_url(),"observacion"=>"Se solicita apertura de cuenta");
		}
		$insert["user_id"] = $ci->user->user_id;
		$insert["centro_de_costos"] = $ci->user->centro_de_costos;
		$insert["fecha"] = date("Y-m-d H:i:s"); 
		$insert["empresa_id"] = $ci->user->id_empresa;
		$tabla		=	DB_PREFIJO."sys_observaciones";
		if($ci->db->insert($tabla,$insert)){
			return true;
		}else{
			return false;
		}
	}
	
	function trm($var){
		$ci 				=& 	get_instance();
		
		if($var->TRM_Liquidacion>0){
			$trm		=	$var->TRM_Liquidacion;	
		}else{
			$trm		=	$ci->db->select('( SUM(monto) / COUNT(monto) ) * 0.90 AS total ')
									->from(DB_PREFIJO."sys_trm")
									//->where('fecha',$fecha)
									->get()->row()->total;		
		}		
		return $trm;
	}

	function listBoxSubFijoCodigoContable($data,$campo,$value,$prefijo='',$excepcion='',$codigo_contable = "codigo_contable",$opciones_transf = false){
		if($opciones_transf){
			$transferir_a = array("default"=>"Destino","Caja"=>"Caja","Bancos_nacionales"=>"Bancos nacionales");
			$options   = form_dropdown("transferir_a", $transferir_a, null,array("class"=>"form-control mb-2 destino"));
			$options	.=	'<select id="caja'.$prefijo.'" data-rel="'.$prefijo.'" name="procesador_id_destino" class="form-control pro mb-2 caja_destino" required="required" style="display:none;">';
				$options	.=	'<option value="default">Caja Destino</option>';
				foreach(ResumenCajas(array('110510','110505'),array("6","14"),1) as $v){
					$options	.=	'<option data-cc="'.$v->codigo_contable.'" data-ccsf="'.$v->codigo_contable_subfijo.'" value="'.$v->id_caja.'">';
						$options	.=	$v->nombre_caja;
					$options	.=	'</option>';
				}
			$options	.=	'</select>';
			$offset = "170px";
		}else{
			$options = '';
			$offset = "130px";
		}

		$html	=	$options.'<select id="cuenta'.$prefijo.'" data-rel="'.$prefijo.'" name="procesador_id_destino" class="form-control mb-2 pro cuenta_destino" required="required">';
			$html	.=	'<option value="default">Cuenta Destino</option>';
			foreach($data as $v){
				if($v->id_cuenta<>$excepcion){
					$html	.=	'<option data-cc="'.$v->$codigo_contable.'" data-ccsf="'.$v->codigo_contable_subfijo.'" value="'.$v->$value.'">';
						$html	.=	$v->$campo;
					$html	.=	'</option>';
				}
			}
		$html	.=	'</select>';
		$html	.=	'<input type="hidden" name="procesador_destino_codigo_contable" class="procesador_destino_codigo_contable"/>';
		$html	.=	'<input type="hidden" name="procesador_destino_codigo_contable_subfijo" class="procesador_destino_codigo_contable_subfijo"/>';
		$html	.=	'<button class="btn orange" type="submit" disabled="disabled">Procesar</button>';	
		$html	.=	'<script>';
		$html	.=	'$(document).ready(function(){';
			$html	.=	"var content 	= 	'<div id=\"contenedor_dinamico\"></div>';";
			$html	.=	"$('.popovers').popover({";
				$html	.=	"html:true,";
				$html	.=	'offset:"'.$offset.' 16px",';
				$html	.=	"content: content,";
			$html	.=	"}).click(function(){";
				$html	.=	"var content	=	$('#content'+$(this).data(\"procesador_id\"));";
					$html	.=	"$('#contenedor_dinamico').html(content.html());";
						$html   .= "$('#contenedor_dinamico').find('form .destino').change(function(){
							if($(this).val() == 'Caja'){
								$(this).parent('form').find('.caja_destino').show().removeAttr('disabled');
								$(this).parent('form').find('.cuenta_destino').hide().attr('disabled','disabled');
							}else{
								$(this).parent('form').find('.cuenta_destino').show().removeAttr('disabled');
								$(this).parent('form').find('.caja_destino').hide().attr('disabled','disabled');
							}
						});";
					$html	.=	"$('#contenedor_dinamico').find('form .pro').change(function(){
							if($(this).val() == 'default'){
								$(this).parent('form').find('button').attr('disabled','disabled');
							}else{
								$(this).parent('form').find('button').removeAttr('disabled');
							}";
					$html	.=	"$('#contenedor_dinamico').find('form input.procesador_destino_codigo_contable').val($(':selected', this).data('cc'));";
					$html	.=	"$('#contenedor_dinamico').find('form input.procesador_destino_codigo_contable_subfijo').val($(':selected', this).data('ccsf'));";
				$html	.=	"});";
			$html	.=	"});";
			$html	.=	"$(document).keyup(function (event) {";
				$html	.=	"if (event.which === 27) {";

					$html	.=	"$('.popovers').popover('hide');";
				$html	.=	"}";
			$html	.=	"});";
		$html 	.=	"});";
	$html	.=	"</script>";
	
	return $html;
}

function listBoxSubFijoCodigoContable2($data,$prefijo='',$excepcion=''){
		$html	=	'<select id="caja'.$prefijo.'" data-rel="'.$prefijo.'" name="id_caja_destino" class="form-control mb-2 caja_destino" required="required">';
			$html	.=	'<option value="0">Caja destino</option>';
			foreach($data as $v){
				if($v->id_caja<>$excepcion){
					$html	.=	'<option data-cc="'.$v->codigo_contable.'" data-ccsf="'.$v->codigo_contable_subfijo.'" value="'.$v->id_caja.'">';
						$html	.=	$v->nombre_caja;
					$html	.=	'</option>';
				}
			}
		$html	.=	'</select>';
		$html	.=	'<input type="hidden" name="procesador_destino_codigo_contable" class="procesador_destino_codigo_contable"/>';
		$html	.=	'<input type="hidden" name="procesador_destino_codigo_contable_subfijo" class="procesador_destino_codigo_contable_subfijo"/>';
		$html	.=	'<button class="btn orange" type="submit" disabled="disabled">Procesar</button>';	
		$html	.=	'<script>';
		$html	.=	'$(document).ready(function(){';
			$html	.=	"var content 	= 	'<div id=\"contenedor_dinamico\"></div>';";
			$html	.=	"$('.popovers').popover({";
				$html	.=	"html:true,";
				$html	.=	'offset:"170px 16px",';
				$html	.=	"content: content,";
			$html	.=	"}).click(function(){";
				$html	.=	"var content	=	$('#content'+$(this).data(\"procesador_id\"));";
					$html	.=	"$('#contenedor_dinamico').html(content.html());";
					$html	.=	"$('#contenedor_dinamico').find('form select').change(function(){
							if($(this).val() != 0){
								$(this).parent('form').find('button').removeAttr('disabled');
							}else{
								$(this).parent('form').find('button').attr('disabled','disabled');
							}";
					$html	.=	"$('#contenedor_dinamico').find('form input.procesador_destino_codigo_contable').val($(':selected', this).data('cc'));";
					$html	.=	"$('#contenedor_dinamico').find('form input.procesador_destino_codigo_contable_subfijo').val($(':selected', this).data('ccsf'));";
				$html	.=	"});";
			$html	.=	"});";

			$html	.=	"$(document).keyup(function (event) {";
				$html	.=	"if (event.which === 27) {";

					$html	.=	"$('.popovers').popover('hide');";
				$html	.=	"}";
			$html	.=	"});";
		$html 	.=	"});";
	$html	.=	"</script>";
	
	return $html;
}

function mes($mes=null){
	$array_meses	=	array("Seleccione","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");	
	if($mes){
		return $array_meses[$mes];
	}else{
		return $array_meses;	
	}
	
}

function setSubfijoContable($tabla='fi_cuentas',$codigo_contable,$extra=array()){
	$campo		=	key($extra);
	$cantidad_subfijos=0;
	$ci=&get_instance();
	$ci->db	->select('count(codigo_contable) as total')
						->from(DB_PREFIJO.$tabla)
						->where("id_empresa",$ci->user->id_empresa)
						->where("codigo_contable_subfijo>",0);
	$ci->db->where('codigo_contable',$codigo_contable);
	$row1=$ci->db->get()->row();
	$cantidad_subfijos	=	($row1->total==0)?"05":	 5 * ($row1->total + 1);
	//pre($cantidad_subfijos);
	$ci->db	->select($campo.',codigo_contable_subfijo')
						->from(DB_PREFIJO.$tabla)
						->where('id_empresa',$ci->user->id_empresa);
	foreach($extra as $k =>$v){ 
		$ci->db	->where($k,$v);	
	}
	$ci->db->where('codigo_contable',$codigo_contable);
	$row2	=	$ci->db->get()->row();
	
	if(!empty($row2)){
		if($row2->codigo_contable_subfijo=='' || $row2->codigo_contable_subfijo==0){
			$ci->db->where($campo,$row2->$campo);			
			$ci->db->update(DB_PREFIJO.$tabla,array("codigo_contable_subfijo"=>$cantidad_subfijos));
		}	
	}
}

function chequear_Honorarios_X_ciclo_de_produccion($modelo_id,$ciclo_produccion_id){
	$ci=&get_instance();
	return $ci->db	->select('*')
									->from(DB_PREFIJO."rp_operaciones")
									->where('modelo_id',$modelo_id)
									->where("empresa_id",$ci->user->id_empresa)
									->where('tipo_documento',13)
									->where('ciclo_produccion_id',$ciclo_produccion_id)
									->where('estatus !=',9)
									->get()
									->row();	
}

function chequear_Honorarios_Pagados_X_ciclo_nro_documento($modelo_id,$nro_documento){
	$ci=&get_instance();
	return $ci->db	->select('*')
									->from(DB_PREFIJO."rp_operaciones")
									->where('modelo_id',$modelo_id)
									->where("empresa_id",$ci->user->id_empresa)
									->where('tipo_documento',14)
									->where('nro_documento',$nro_documento)
									->get()
									->row();	
}

function sum_Honorarios_Pagados_X_ciclo_nro_documento($modelo_id,$nro_documento,$tipo_documento = 14){
	$ci=&get_instance();
	return $ci->db	->select('SUM(credito) as credito,SUM(debito) as debito,fecha')
									->from(DB_PREFIJO."rp_operaciones")
									->where('modelo_id',$modelo_id)
									->where("empresa_id",$ci->user->id_empresa)
									->where('tipo_documento',$tipo_documento)
									->where('nro_documento',$nro_documento)
									->get()
									->row();	
}

function chequear_Honorarios_Pagados_X_ciclo_de_produccion($modelo_id,$ciclo_produccion_id){
	$ci=&get_instance();
	return $ci->db	->select('*')
									->from(DB_PREFIJO."rp_operaciones")
									->where('modelo_id',$modelo_id)
									->where("empresa_id",$ci->user->id_empresa)
									->where('tipo_documento',14)
									->where('ciclo_produccion_id',$ciclo_produccion_id)
									->get()
									->row();	
}

function  ajuste_a_la_decena($numero){
	for($a=0;$a<$numero;$a=$a+5000){}
	$new	=	substr($a,-4,1);
	if($new==5){
		$a	=	$a-5000;
	}
	return $a;	
}

function TRM_Promedio($rows,$dias=6){
	$ci=&get_instance();
	
	//$trm_historico		=	$ci->db->select('monto')->from(DB_PREFIJO."sys_trm")->where('DATEDIFF(NOW(),fecha)<',$dias)->get()->result();
	$fecha=$row				=	$ci	->db->select('ciclos_id,fecha_desde,fecha_hasta')
								->from(DB_PREFIJO."cf_ciclos_pagos")
								->where('estado',0)
								->order_by('fecha_desde','DESC')
								->get()
								->row();
	
	//pre($fecha);

	if(empty($row)){
		return;	
	}								
	$trmList=$trm_historico		=	$ci->db->select('monto,fecha')
										->from(DB_PREFIJO."sys_trm")
										->where('fecha>=',$row->fecha_desde)
										->where('fecha<=',$row->fecha_hasta)
										->get()
										->result();								
//	pre($trm_historico);																
	if(empty($trm_historico)){
		$trm_historico		=	$ci->db->select('monto,fecha')->from(DB_PREFIJO."sys_trm")->where('DATEDIFF(NOW(),fecha)<',$dias)->get()->result();		
	}
	$suma				=	0;
	$cant_dias			=	count($trm_historico);
	foreach($trm_historico as $v){
		$suma += $v->monto;
	}
	$return =	($suma/$cant_dias) * 0.954;
	return array("monto"=>$return,"fecha"=>$fecha,"trm_historico"=>$trmList);
}

function json_response($response=null,$message = null, $code = 200){
    // clear the old headers
    header_remove();
    // set the actual code
    http_response_code($code);
    // set the header to make sure cache is forced
    header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
    // treat this as json
    header('Content-Type: application/json');
    $status = array(
        200 => '200 OK',
        400 => '400 Bad Request',
        422 => 'Unprocessable Entity',
        500 => '500 Internal Server Error'
        );
    // ok, validation error, or failure
    header('Status: '.$status[$code]);
    // return the encoded json
    return json_encode(array(
        'status' => $code < 300, // success or not?
        'message' => $message,
		'response' => $response
        ));
}

function prioridad_x_dias($fecha_hasta,$format=true){
	$dias	=	(strtotime(date("Y-m-d H:i:s"))-strtotime($fecha_hasta))/86400;;
	$dias 	=	abs($dias); $dias = floor($dias);		
	$return	=	$dias;
	if($format){
		if($dias<=7 && $dias<=5){
			$return		=	'Baja';					
		}else if($dias<=4 && $dias<=2){
			$return		=	'Media';					
		}else if($dias<=1){
			$return		=	'Alta';					
		}
	}
	return $return;    	
}

function getColor($user_id){
		$tabla				=		DB_PREFIJO."usuarios";
		$ci=&get_instance();
		$ci->db->select('segundo_apellido');
		$ci->db->from($tabla);
		$ci->db->where("user_id",$user_id);
		$query=$ci->db->get();
		return $query->row()->segundo_apellido;		
	}

function getOpcionesFacturaDB($empresa_id){
		$tabla				=		DB_PREFIJO."cf_opciones";
		$ci=&get_instance();
		$ci->db->select("*");
		$ci->db->from($tabla);
		$ci->db->where("empresa_id",$empresa_id);
		$query			=	$ci->db->get();
		$row			=	$query->row();
		if(!empty($row)){
			$return 		=	array("config_id"=>$row->config_id);
			if(!empty($row->json)){
				foreach(json_decode($row->json) as $k	=> $v){
					$return[$k]	=	$v;
				}
			}
			return (object)$return;
		}else{
			return null;	
		}
}

function getOpcionesFactura($consecutivo){
		$tabla				=		DB_PREFIJO."rp_operaciones_json";
		$ci=&get_instance();
		$ci->db->select("json");
		$ci->db->from($tabla);
		$ci->db->where("consecutivo",$consecutivo);
		$query			=	$ci->db->get();
		return $query->row();
}

function TaskBar($items=array()){
	$ci=&get_instance();
	$iconos	= array();
	$iconos['title']			=	new stdClass();
	$iconos['title']->url		=	current_url();
	$iconos['title']->icono		=	(isset($items['name']['icono']))?$items['name']['icono']:'<i class="fas fa-angle-right"></i>';
	$iconos['title']->title		=	'';
	
	$title	=	'';
	if(isset($items['name'])){
		if(is_array($items['name'])){
			if(isset($items['name']['title']) && isset($items['name']['url'])){
				$title	.=	$iconos['title']->icono.' '.$items['name']['title'];
			}else{				
				$title	.=	$iconos['title']->icono.' '.$items['name']['title'];
			}
			unset($items['name']);
		}
	}
	
	$iconos['back']				=	new stdClass();
	if($ci->agent->referrer() && @$items['back']==TRUE){
		$iconos['back']->url	=	$ci->agent->referrer();	
	}else{
		$iconos['back']->url	=	"ocultar";		
	}
	$iconos['back']->icono		=	'<i class="fas fa-chevron-circle-left"></i>';
	$iconos['back']->title		=	'Volver Atrás';
		
	$iconos['impresion']			=	new stdClass();
	if(is_numeric($ci->uri->segment(3))){
		$iconos['impresion']->url	=	$ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$ci->uri->segment(3).'/print';	
	}else{
		$iconos['impresion']->url	=	$ci->uri->segment(1).'/'.$ci->uri->segment(2).'/print';	
	}

	$iconos['impresion']->icono		=	'<i class="fas fa-print"></i>';
	$iconos['impresion']->title		=	'Imprimir Documento';
	
	$iconos['import']				=	new stdClass();
	if(is_numeric($ci->uri->segment(3))){
		$iconos['import']->url	=	$ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$ci->uri->segment(3).'/import';	
	}else{
		$iconos['import']->url	=	$ci->uri->segment(1).'/'.$ci->uri->segment(2).'/import';	
	}
	$iconos['import']->icono		=	'<i class="fas fa-upload"></i>';
	$iconos['import']->title		=	'Importar Documento';
	
	$iconos['check']				=	new stdClass();
	if(is_numeric($ci->uri->segment(3))){
		$iconos['check']->url	=	$ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$ci->uri->segment(3).'/check';	
	}else{
		$iconos['check']->url	=	$ci->uri->segment(1).'/'.$ci->uri->segment(2).'/check';	
	}
	$iconos['check']->icono		=	'<i class="fas fa-check"></i>';
	$iconos['check']->title		=	'Verificar Documento';
	
	$iconos['config']				=	new stdClass();
	if(is_numeric($ci->uri->segment(3))){
		$iconos['config']->url	=	$ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$ci->uri->segment(3).'/config';	
	}else{
		$iconos['config']->url	=	$ci->uri->segment(1).'/'.$ci->uri->segment(2).'/config';	
	}
	if(empty($items['config']['icono'])){
		$iconos['config']->icono		=	'<i class="fas fa-check"></i>';
	}else{
		$iconos['config']->icono		=	$items['config']['icono'];
	}
	$iconos['config']->title		=	'Configuración';
	$iconos['config']->size			=	'modal-lg';	
	$iconos['config']->height		=	450;	
	
	$iconos['inbox']				=	new stdClass();
	if(is_numeric($ci->uri->segment(3))){
		$iconos['inbox']->url		=	$ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$ci->uri->segment(3).'/recibir';	
	}else{
		$iconos['inbox']->url		=	$ci->uri->segment(1).'/'.$ci->uri->segment(2).'/recibir';
	}
	$iconos['inbox']->icono		=	'<i class="fas fa-inbox"></i>';
	$iconos['inbox']->title		=	'Recibir Pagos';
	
	$iconos['anular']			=	new stdClass();
	if(is_numeric($ci->uri->segment(3))){
		$iconos['anular']->url	=	$ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$ci->uri->segment(3).'/anular';	
	}else{
		$iconos['anular']->url	=	$ci->uri->segment(1).'/'.$ci->uri->segment(2).'/anular';
	}	
	$iconos['anular']->icono	=	'<i class="fas fa-ban"></i>';
	$iconos['anular']->title	=	'Anular Pagos';
	
	$iconos['pago']			=	new stdClass();
	if(is_numeric($ci->uri->segment(3))){
		$iconos['pago']->url	=	$ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$ci->uri->segment(3).'/pago';	
	}else{
		$iconos['pago']->url	=	$ci->uri->segment(1).'/'.$ci->uri->segment(2).'/pago';
	}	
	$iconos['pago']->icono	=	'<i class="fas fa-dollar"></i>';
	$iconos['pago']->title	=	'Pagar';
	
	$iconos['pdf']				=	new stdClass();
	if(is_numeric($ci->uri->segment(3))){
		$iconos['pdf']->url		=	$ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$ci->uri->segment(3).'/PDF';	
	}else{
		$iconos['pdf']->url		=	$ci->uri->segment(1).'/'.$ci->uri->segment(2).'/PDF';
	}
	$iconos['pdf']->icono		=	'<i class="fas fa-file-pdf"></i>';
	$iconos['pdf']->title		=	'Documento en PDF';

	$iconos['excel']				=	new stdClass();
	if(is_numeric($ci->uri->segment(3))){
		$iconos['excel']->url	=	$ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$ci->uri->segment(3).'/excel';	
	}else{
		$iconos['excel']->url	=	$ci->uri->segment(1).'/'.$ci->uri->segment(2).'/excel';
	}
	$iconos['excel']->icono		=	'<i class="fa fa-file-excel" aria-hidden="true"></i>';
	$iconos['excel']->title		=	'Descargar Excel';	
	
	$iconos['mail']				=	new stdClass();
	if(is_numeric($ci->uri->segment(3))){
		$iconos['mail']->url	=	$ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$ci->uri->segment(3).'/mail';	
	}else{
		$iconos['mail']->url	=	$ci->uri->segment(1).'/'.$ci->uri->segment(2).'/mail';
	}
	$iconos['mail']->icono		=	'<i class="far fa-envelope"></i>';
	$iconos['mail']->title		=	'Enviar por Email';	
	
	$iconos['pageleft']			=	new stdClass();
	if(is_numeric($ci->uri->segment(3))){
		if($ci->uri->segment(3)>1){
			$left						=	$ci->uri->segment(3)- 1;
			$iconos['pageleft']->url	=	$ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$left.'/'.$ci->uri->segment(4);	
			$iconos['pageleft']->icono	=	'<i class="fas fa-caret-square-left"></i>';
			$iconos['pageleft']->title	=	'Documento anterior';

		}else{
			$iconos['pageleft']->url	=	"ocultar";	
			$iconos['pageleft']->icono	=	'<i class="fas fa-caret-square-left"></i>';
			$iconos['pageleft']->title	=	'Documento anterior';
		}
	}else{
		$iconos['pageleft']->url	=	$ci->uri->segment(1).'/'.$ci->uri->segment(2);
	}
	
	
	$iconos['pageright']			=	new stdClass();
	if(is_numeric($ci->uri->segment(3))){
		$right	=	$ci->uri->segment(3)+1;
		$iconos['pageright']->url	=	$ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$right.'/'.$ci->uri->segment(4);	
	}else{
		$iconos['pageright']->url	=	$ci->uri->segment(1).'/'.$ci->uri->segment(2);
	}
	$iconos['pageright']->icono	=	'<i class="fas fa-caret-square-right"></i>';
	$iconos['pageright']->title	=	'Documento siguiente';
	
	$iconos['add']				=	new stdClass();
	if(is_numeric($ci->uri->segment(3))){
		$iconos['add']->url	=	$ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$ci->uri->segment(3).'/add';	
	}else{
		$iconos['add']->url	=	$ci->uri->segment(1).'/'.$ci->uri->segment(2).'/add';
	}
	$iconos['add']->icono		=	'<i class="fa fa-plus"></i>';
	$iconos['add']->title		=	'Agregar Documento';	
	    $return						=	'<div class="row filters">';
			$return						.=	'<div class="col-md-12">';
				$return						.=	'<nav id="submenu" class="navbar navbar-toggleable-md navbar-light bg-faded nav-short p-2">';
					$return						.=	'<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">';
						$return						.=	'<span class="navbar-toggler-icon"></span>';
					$return						.=	'</button>';
					$return						.=	'<a class="navbar-brand">';
						$return						.=	'<h4 class="font-weight-700 text-uppercase orange ">';
							$return						.=	$title;
						$return						.=	'</h4>';
					$return						.=	'</a>';
					$return						.=	'<div class="collapse navbar-collapse" id="navbarNavDropdown">';
						$return						.=	'<div class="btn-group  ml-auto" role="group" aria-label="Small button group">';
							foreach($items as $k => $v){
								if(is_array($v) && $v){
									if(isset($v['title'])){
										$title_link	=	$v['title'];											
									}else{
										$title_link	=	$iconos[$k]->title;
									}
									if(isset($v['url'])){
										$url_link	=	$v['url'];	
									}else{
										$url_link	=	$iconos[$k]->url;
									}
									if(isset($v['lightbox'])){
										$atributos	=	'class="nav-link lightbox '.$k.' " data-type="iframe"';
									}else if(isset($v['confirm'])){
										$atributos	=	'class="nav-link confirm" confirm="true" data-title="Deseas anular esta factura?"  data-message="Para continuar pulsa aceptar."';	
									}else if(isset($v['popup'])){
										$atributos	=	'class="nav-link popup" popup="true" data-title="Popup"';	
									}else{
										$atributos	=	'class="nav-link '.$k.'"';
									}
									if(isset($v['atributo'])){
										$atributos	=	'class="nav-link" '.$v['atributo'];
									}
									if(isset($v['target'])){
										$atributos	.=	'class="nav-link " target="_blank"';
									}
									if(isset($v['id'])){
										$atributos	.=	'id="'.$v['id'].'"';
										$contenedor  =	'<div id="Opciones_excel" style="display:none;">
														  <form action="'.current_url().'/mail" method="post">
														  	<table width="100%">
														  		<tr>
														  			<td>
														  				<input id="email" type="email" name="email" placeholder="correo electronico" class="form-control" required="1" />
														  			</td>
														  			<td style="text-align: right;">
																		<button id="enviar" class="btn btn-primary" type="button" disabled>Enviar</button>
														  			</td>
														  		</tr>
														  	</table>
														  </form>
														</div>';
									}
									if(isset($v['size'])){
										$atributos	.=	' data-size="'.$v['size'].'" ';
									}
									if(isset($v['size'])){
										$atributos	.=	' data-height="'.$v['height'].'" ';
									}
									$return						.=	'<a '.$atributos.' title="'.$title_link.'" href="'.$url_link.'" >';					
										if(isset($v['icono'])){
											$return						.=	$v['icono'];
										}else{
											$return						.=	$iconos[$k]->icono;
										}
									$return						.=	'</a>';									
								}else{
									if($iconos[$k]->title=='Imprimir Documento'){
										$atributos	=	'class="nav-link "';
									}else if($iconos[$k]->title=='Documento en PDF'){
										$atributos	=	'class="nav-link " target="_blank" ';
									}else{
										if($v==='lightbox'){
											$atributos	=	'class="nav-link lightbox '.$k.'" data-type="iframe"';
										}else{
											$atributos	=	'class="nav-link '.$k.'"';
										}
									}	
									if($iconos[$k]->url!='ocultar'){
										$return						.=	'<a '.$atributos.' class="'.$k.'" title="'.$iconos[$k]->title.'" href="'.$iconos[$k]->url.'" >';					
											$return						.=	$iconos[$k]->icono;
										$return						.=	'</a>';
									}
								}
							}
						$return						.=	'</div>';
					$return						.=	'</div>';
				$return						.=	'</nav>';					
			$return						.=	'</div>';
		$return						.=	'</div>';
	$return 					.=	@$contenedor;
	if(isset($items['config']['atributo'])){
		$row        =   get_NotificacionEmail(base_url("Utilidades/CorreoNotificacion/SolicitudPlataformas"));
		$hidden     =   array("Modulo"=>$ci->uri->segment(1));
	$return .= '<div class="modal fade" id="OpcionesEmail">
					<div class="modal-dialog modal-lg">
					  	<div class="modal-content">
					    	<div class="modal-header">
					      		<h4 class="modal-title">Configuración envio email</h4>
					      		<button type="button" class="close cerrar" data-dismiss="modal">&times;</button>
					    	</div>
					    	<div class="modal-body" id="form">
					        	<form action="'.base_url('Utilidades/ConfigEmail').'" method="post" accept-charset="utf-8">
									<div class="row">
										<div class="col-md-7">
											<div class="container">
												<div class="form-group">
													<div class="input-group mt-3">
														<div class="row col-md-12">
														  	<input type="email" id="correos_notificacion" class="form-control" placeholder="Email" >
														  	<div id="submit" class="btn btn-primary ml-4" style="cursor:pointer">Agregar</div>
														  	<div class="alert alert-danger col-md-12 mt-2" id="message" role="alert" style="display:none;">
															</div>
															<div class="col-md-12 mt-1">
														        <table class="display table table-hover" ordercol=1 order="asc">
														        	<tr>
																		<th>Correo</th>
																		<th>Accion</th>
														        	</tr>
														            <tbody id="correo">';
														                    if(!empty($row)){       
														                        foreach ($row as $k => $v) {
														    $return .=' <tr>
														                    <td>'.$v->correo.'</td>
														                    <td class="text-center">
														                        <a href="'.base_url("Utilidades/deleteItem/".$v->id_email).'">
														                            <i class="fas fa-trash"></i>
														                        </a>
														                    </td>
														                </tr>';
														                        }
														                    }          
														$return .= 	'</tbody>
														        </table>
														    </div>  
														</div>                   
														<script type="text/javascript" charset="utf-8" async defer>
															$(document).ready(function(){
																function isValidEmailAddress(emailAddress) {
																	var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
																	return pattern.test(emailAddress);
																  }
																  
																$("#id_modelo").attr("name","nombre_modelo");
														        $("#submit").click(function() {
																	var valido= true;
																	var correo = $("#correos_notificacion").val();
																    console.log(correo);
																	if ((valido)&&(correo == "")){
																		valido = false;
																		$("#message").fadeIn();
																		$("#message").html("El campo no puede estar vacío");
													   
																	}
																     
															        if ((valido)&&(!isValidEmailAddress(correo) )){
																		valido = false;
																		$("#message").fadeIn();
																		$("#message").html("correo no valido");
													   
																	}
																	if (valido){
                                                                    	$.post("'.base_url("Utilidades/CorreoNotificacion/SolicitudPlataformas").'",{correo:correo}, function($data){
																			console.log($data);
																			var $json = JSON.parse($data);
																			if($json.message){
																				$("#message").fadeIn();
																				$("#message").html($json.message);
																			}
																			if($json.correo){
																				eval(agregar_correo_tabla($json));
																			}
																			console.log($json);
																			$("#Usuario").val($json.nickname);
																		}); //fin post
																	}
																
														        });
															});
														</script>

													</div>';
													/*<div class="input-group mt-3">
														<input type="text" name="Asunto" value="'.@$items['config']['Asunto'].'" id="Asunto" placeholder="Asunto" class="form-control inputconfigEmail" require="1">
														<div class="form-control cont" style="display:none;">
														</div>
													</div>
													<div class="input-group mt-3 row">
														<label for="enviarPdf" class="col-md-6">
															<b>Adjuntar PDF</b>
														</label>
														<div class="col-md-3 col-xs-6">
															<label for="enviarPdf" style="vertical-align: top;">
																<b>Si </b>
															</label>
															<label class="custom-control custom-checkbox"><input type="radio" name="enviarPDF" value="Si" id="enviarPDF" class="custom-control-input enviarPDF inputconfigEmail">
                                                                <span class="custom-control-indicator"></span>
                                                            </label>	
														</div>
														<div class="col-md-3 col-xs-6">
															<label for="enviarPdf" style="vertical-align: top;">
																<b>No </b>
															</label>
																<label class="custom-control custom-checkbox"><input type="radio" name="enviarPDF" value="No" id="enviarPDF" class="custom-control-input enviarPDF inputconfigEmail">
																<span class="custom-control-indicator"></span>
															</label>
														</div>
													</div>
													<div class="input-group mt-3" id="pdf" style="display:none;">	
														<input type="text" name="namePdf" value="'.@$items['config']['namePdf'].'" id="namePdf" placeholder="Nombre PDF" class="form-control inputconfigEmail">
														<div class="form-control cont" style="display:none;">
														</div>
													</div>
													<div class="form-group">
														<label for="message">
															<b>Mensaje del correo</b>
														</label>
														<textarea name="message" class="form-control inputconfigEmail" require=true;>
															'.@$items['config']['message'].'
														</textarea>
														<div class="form-control cont" style="display:none;">
														</div>
													</div>
													<div class="form-group text-center">
						                                <button type="submit" class="btn btn-primary">Guardar</button>
						                            </div>
												</div>
											</div>
										</div>
										<div class="col-md-5">
											<div class="container row">
												'.OpcionesConfigEmail($items['config']['data']).'
											</div>
										</div>*/
							$return .='			</div>
											</div>
										</div>
									</div>
								</form>
							</div>
				        	<div class="modal-footer">
				          		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				        	</div>
				      	</div>
				    </div>
				</div>';
	}
	return $return;
	
}

function saltoLinea($str) {
  return str_replace(array("\r\n", "\r", "\n"), "<br />", $str);
}   
 
function Observaciones($url){
	$ci=&get_instance();
	$tabla=DB_PREFIJO."sys_observaciones t1";
	$ci->db->select("*");
	$ci->db->from($tabla);
	$ci->db->join(DB_PREFIJO."usuarios t2", 't1.user_id 	= 	t2.user_id', 'left');
	$ci->db->like("url",$url);
	$ci->db->where("empresa_id",$ci->user->id_empresa);
	$ci->db->order_by('fecha','DESC');
	$query=$ci->db->get();
	return $query->result();
	if(!empty($result)){
		$html = '<div class="col-md-8 m-5" id="RespuestasObservaciones">';
		foreach ($result as $k => $v) {
			$html .=	'<div class="m-5" style="box-shadow: 8px 9px 25px 1px #BDBDBD; padding:25px;border-radius: 4px;">';
				$html .=    '<div class="row">';
	            	$html .=    '<div class="col-md-3 text-right">';
	                	$html .=	'<img class="rounded-circle" src="'.img_logo('$v->user_id').'" style="width:60px;height:60px;" />';
	                $html .=    '</div>';
	                $html .=    '<div class="col-md-5">';
	                    $html .=    '<h6 class="text-info">'.$v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido.'</h6>';
	                        $html .=    '<p class="text-muted">'.$v->fecha.'</p>';
	                    $html .= '</div>';
	                $html .='</div>';
	            $html .=    '<div class="col-md-10 offset-md-2 mt-2 oscuro">'.$v->observacion.'</div>';
	        $html .= '</div>';      
		}
		$html .= '</div>';
		return $html;
	}else{
		return null;	
	}
}

function Notificacion($obj){
	$notificaciones	=	json_decode($obj->campo_id);
	$ci=&get_instance();
	$tabla=DB_PREFIJO.$obj->tabla_notificacion;
	$ci->db->select("*");
	$ci->db->from($tabla);
	$ci->db->where($notificaciones->name,$notificaciones->value);
	$query=$ci->db->get();
	return $query->row();
}
 
function inicioReloj($token){
	$ci=&get_instance();
	$tabla=DB_PREFIJO."entrevista";
	$ci->db->select("fecha");
	$ci->db->from($tabla);
	$ci->db->where("token",$token);
	$query=$ci->db->get();
	return $query->row();
}

function getMovimientosGeneral($nro_documento=NULL,$consecutivo=NULL,$tipo_documento=NULL,$codigo_contable=NULL,$ciclo_produccion_id=NULL,$modelo_id=NULL,$grupo = NULL,$estatus = array(1)){
	$ci 	=& 	get_instance();
	$tabla	=	DB_PREFIJO."rp_operaciones t1";
	$ci->db->select("t1.codigo_contable, 
						SUM(t1.credito) as credito,
						SUM(t1.debito) as debito,
						fecha,
						t1.procesador_id as banco_pago,
						t1.tipo_documento,
						t1.consecutivo as documento,
						t1.nro_documento,
						t1.json as data,
						t1.estatus as operacion,
						t1.ciclo_produccion_id,
						t2.primer_nombre,
						t2.primer_apellido,
						t3.*,
						t4.*");
	$ci->db->from($tabla);
	$ci->db->join(DB_PREFIJO."usuarios t2", 't1.responsable_id 	= 	t2.user_id', 'left');
	$ci->db->join(DB_PREFIJO."sys_contabilidad t3",'t1.codigo_contable=t3.codigo','left');
	$ci->db->join(DB_PREFIJO."rp_descuentos t4",'t1.nro_documento=t4.descuento_id','left');			
	$ci->db->where("t1.empresa_id",$ci->user->id_empresa);
	$ci->db->where_in("t1.estatus",$estatus);	
	if($nro_documento!=NULL){$ci->db->where("t1.nro_documento",$nro_documento);}
	if($consecutivo!=NULL){$ci->db->where("t1.consecutivo",$consecutivo);}
	
	if($modelo_id!=NULL){
		if(is_array($modelo_id)){
			$ci->db->where_in("t1.modelo_id",$modelo_id);
		}else{
			$ci->db->where("t1.modelo_id",$modelo_id);
		}
	}

	if($grupo!=NULL){
		if(is_array($modelo_id)){
			$ci->db->where_in("t3.grupo",$grupo);
		}else{
			$ci->db->where("t3.grupo",$grupo);
		}
	}
	
	if($tipo_documento!=NULL){
		if(is_array($tipo_documento)){
			$ci->db->where_in("t1.tipo_documento",$tipo_documento);
		}else{
			$ci->db->where("t1.tipo_documento",$tipo_documento);
		}
	}
	
	if($codigo_contable!=NULL){
		if(is_array($codigo_contable)){
			$ci->db->where_in("t1.codigo_contable",$codigo_contable);
		}else{
			$ci->db->where("t1.codigo_contable",$codigo_contable);
		}
	}
	
	if($ciclo_produccion_id!=NULL){
		if(is_array($ciclo_produccion_id)){
			$ci->db->where_in("t1.ciclo_produccion_id",$ciclo_produccion_id);
		}else{
			$ci->db->where("t1.ciclo_produccion_id",$ciclo_produccion_id);
		}
	}

	$ci->db->group_by(array("t1.codigo_contable","t1.consecutivo"));
	$ci->db->order_by('t1.id','ASC');
	return $ci->db->get()->result();	
}

function getMovimientos($nro_documento,$cuenta_contable){
	$ci 	=& 	get_instance();
	$tabla	=	DB_PREFIJO."rp_operaciones t1";
	$ci 	=& 	get_instance();	
	$ci->db->select("t1.estatus,t1.codigo_contable, SUM(t1.credito) as credito,SUM(t1.debito) as debito,fecha,tipo_documento,consecutivo,primer_nombre,primer_apellido,responsable_id");
	$ci->db->from($tabla);
	$ci->db->join(DB_PREFIJO."usuarios t2", 't1.responsable_id 	= 	t2.user_id', 'left');
	$ci->db->where("t1.empresa_id",$ci->user->id_empresa);
	$ci->db->where("t1.debito >",0);
	$ci->db->where("t1.nro_documento",$nro_documento);
	$ci->db->where_in("t1.tipo_documento",array(1,5));

	if(is_array($cuenta_contable)){
		$ci->db->where_in("t1.codigo_contable",$cuenta_contable);	
	}else if(!is_array($cuenta_contable) && !empty($cuenta_contable)){
		$ci->db->where("t1.codigo_contable",$cuenta_contable);	
	}
	$ci->db->group_by(array("t1.codigo_contable","t1.consecutivo"));
	$ci->db->order_by('t1.id','ASC');
	return $ci->db->get()->result();	
}

function getlogs($tabla_afectada,$registro_afectado_id){
	$ci 	=& 	get_instance();
	$tabla	=	DB_PREFIJO."sys_logs t1";
	$ci->db->select("	t1.fecha,
						t1.tipo_transaccion,
						t1.modulo_donde_produjo_cambio,
						t1.registro_afectado_id,
						t1.json,
						t2.primer_nombre,
						t2.segundo_nombre,
						t2.primer_apellido,
						t2.segundo_apellido,
						t2.type");
	$ci->db->from($tabla);
	$ci->db->join(DB_PREFIJO."usuarios t2", 't1.user_id 	= 	t2.user_id', 'left');
	$ci->db->where('t1.tabla_afectada',$tabla_afectada);
	$ci->db->where('t1.registro_afectado_id',$registro_afectado_id);
	return $ci->db->get()->result();	
}

function items_procesadores_contable($consecutivo,$where=array(),$codigo_contable=array()){
	$tabla	=	DB_PREFIJO."rp_operaciones t1";
	$ci 	=& 	get_instance();	
	$ci->db->select("SUM(credito) as credito, t2.*,t1.procesador_id");
	$ci->db->from($tabla);
	$ci->db->where("t1.empresa_id",$ci->user->id_empresa);
	$ci->db->where("t1.consecutivo",$consecutivo);	
	foreach($where as $k	=> 	$v2){
		$ci->db->where("t1.".$k,$v2);
	}
	if(!empty($codigo_contable)){
		$ci->db->where_in("t1.codigo_contable",$codigo_contable);
	}
	$ci->db->join(DB_PREFIJO."fi_cuentas t2",'t1.procesador_id=t2.id_cuenta','left');
	$ci->db->group_by(array('t1.procesador_id'));
	return $ci->db->get()->result();
}

function operaciones_bancos_detalle($consecutivo,$procesador_id,$codigo_contable,$tipo_documento){
	$ci=&get_instance();
	$tabla=DB_PREFIJO."rp_operaciones t1";
	$ci->db->select("SUM(credito) as credito");
	$ci->db->from($tabla);
	$ci->db->where("t1.empresa_id",$ci->user->id_empresa);
	$ci->db->where("t1.nro_documento",$consecutivo);
	$ci->db->where("t1.procesador_id",$procesador_id);	
	$ci->db->where("t1.codigo_contable",$codigo_contable);
	$ci->db->where("t1.tipo_documento",$tipo_documento);
	$ci->db->where("t1.estatus",1);
	$query=$ci->db->get();
	return $query->row();
}

function operaciones_bancos_130510($procesador_id){
	$ci=&get_instance();
	$tabla=DB_PREFIJO."rp_operaciones t1";
	$ci->db->select("SUM(credito) as credito, SUM(debito) as debito");
	$ci->db->from($tabla);
	$ci->db->where("t1.empresa_id",$ci->user->id_empresa);
	$ci->db->where("t1.procesador_id",$procesador_id);	
	$ci->db->where_in("t1.codigo_contable",array(414580,112520,111010));
	$ci->db->where_in("t1.tipo_documento",array(5,11));
	$ci->db->where("t1.estatus",1);
	$query=$ci->db->get();
	return $query->row();
}

function operaciones_bancos_111010($procesador_id,$in=array(6)){
	$ci=&get_instance();
	$tabla=DB_PREFIJO."rp_operaciones t1";
	$ci->db->select("SUM(debito) as debito,SUM(credito) as credito");
	$ci->db->from($tabla);
	$ci->db->where("t1.empresa_id",$ci->user->id_empresa);
	$ci->db->where("t1.procesador_id",$procesador_id);	
	$ci->db->where("t1.codigo_contable",111010);
	$ci->db->where_in("t1.tipo_documento",$in);
	$ci->db->where("t1.estatus",1);
	$query=$ci->db->get();
	return $query->row();
}

function operaciones_bancos_111005_credito($procesador_id){
	$ci=&get_instance();
	$tabla=DB_PREFIJO."rp_operaciones t1";
	$ci->db->select("SUM(credito) as monto");
	$ci->db->from($tabla);
	$ci->db->where("t1.empresa_id",$ci->user->id_empresa);
	$ci->db->where("t1.procesador_id",$procesador_id);	
	$ci->db->where("t1.codigo_contable",111005);
	$ci->db->where("t1.tipo_documento",10);
	$ci->db->where("t1.estatus",1);
	$query=$ci->db->get();
	return $query->row()->monto;
}

function operaciones_bancos_111010_debito($procesador_id){
	$ci=&get_instance();
	$tabla=DB_PREFIJO."rp_operaciones t1";
	$ci->db->select("SUM(credito) as monto_debito");
	$ci->db->from($tabla);
	$ci->db->where("t1.empresa_id",$ci->user->id_empresa);
	$ci->db->where("t1.procesador_id",$procesador_id);	
	$ci->db->where("t1.codigo_contable",111010);
	$ci->db->where("t1.tipo_documento",6);
	$ci->db->where("t1.estatus",1);
	$query=$ci->db->get();
	return $query->row()->monto_debito;
}

function operaciones_bancos_prueba($procesador_id = array(),$codigo = 111010,$caja_id = null,$tipo_documento = null){
	$ci=&get_instance();
	$tabla=DB_PREFIJO."rp_operaciones";
	$ci->db->select("SUM(credito) as monto_credito,SUM(debito) as monto_debito");
	$ci->db->from($tabla);
	$ci->db->where("empresa_id",$ci->user->id_empresa);
	if(!empty($procesador_id)){
		$ci->db->where("procesador_id",$procesador_id);
	}
	if(!empty($caja_id)){
		$ci->db->where("caja_id",$caja_id);
	}
	if(!empty($tipo_documento)){
		$ci->db->where("tipo_documento",$tipo_documento);
	}
	$ci->db->where("codigo_contable",$codigo);
	$ci->db->where("estatus",1);
	$query=$ci->db->get();
	$monto = $query->row();
	$saldo = ($monto->monto_debito - $monto->monto_credito);
	return $saldo;
}

function operaciones_bancos_110505($procesador_id){
	$ci=&get_instance();
	$tabla=DB_PREFIJO."rp_operaciones t1";
	$ci->db->select("SUM(debito) as debito");
	$ci->db->from($tabla);
	$ci->db->where("t1.empresa_id",$ci->user->id_empresa);
	$ci->db->where("t1.procesador_id",$procesador_id);	
	$ci->db->where("t1.codigo_contable",110505);
	$ci->db->where("t1.tipo_documento",6);
	$ci->db->where("t1.estatus",1);
	$query=$ci->db->get();
	return $query->row()->debito;
}

function operaciones_bancos($procesador_id){
	$ci=&get_instance();
	$tabla=DB_PREFIJO."rp_operaciones t1";
	$ci->db->select("SUM(credito) as credito");
	$ci->db->from($tabla);
	$ci->db->where("t1.empresa_id",$ci->user->id_empresa);
	$ci->db->where("t1.procesador_id",$procesador_id);	
	$ci->db->where("t1.codigo_contable",414580);
	$ci->db->where("t1.tipo_documento",1);
	$ci->db->where("t1.estatus",1);
	$query=$ci->db->get();
	return $query->row();
}

function get_operaciones_json($consecutivo){
	return;
	$ci=&get_instance();
	$tabla=DB_PREFIJO."rp_operaciones_json t1";
	$ci->db->select("*");
	$ci->db->from($tabla);
	$ci->db->where("t1.consecutivo",$consecutivo);
	$query=$ci->db->get();
	return json_decode($query->row()->json);
}

function get_procesador_id($plataforma_id){
	$ci=&get_instance();
	$tabla=DB_PREFIJO."cf_rel_master t1";
	$ci->db->select("*");
	$ci->db->from($tabla);
	$ci->db->where("t1.id_empresa",$ci->user->id_empresa);
	$ci->db->where("t1.id_plataforma",$plataforma_id);	
	$query=$ci->db->get();
	return $query->row();
}

function nombre_x_cuenta($obj){
	if(is_object($obj)){
		if($obj->credito>0){
			return 	$obj->credito;
		}else{
			return 	$obj->debito;
		}		
	}
}

function debito_credito($obj){
	if(is_object($obj)){
		if($obj->credito>0){
			return 	$obj->credito;
		}else{
			return 	$obj->debito;
		}		
	}
}

function verificaEstadoSolicitudPlataformas($estado){
	if($estado == 1){
		$response = 'En proceso';
	}else if($estado == 2){
		$response = 'Creado';
	}else if($estado == 3){
		$response = 'Aprobado';
	}else if($estado == 0){
		$response = 'Rechazada';
	}else{
		$response = 'Activo';
	}
	return $response;
}

function tipo_documento($tipo_documento,$id_documento = false){
	if(is_numeric($tipo_documento)){
		$ci 	=& 	get_instance();
		$tabla		=		DB_PREFIJO."ma_documentos t1";
		$ci->db->select("nombre,id_documento");
		$ci->db->from($tabla);
		$ci->db->where("t1.documento_id",$tipo_documento);
		$query			=	$ci->db->get();
		$row			=	@$query->row();
		if(!empty($row)){
			if($id_documento){
				$return			=	$row->id_documento;	
			}else{
				$return			=	$row->nombre;
			}
		}else{
			$return			=	$tipo_documento;	
		}
		return $return;
	}else{
		return $tipo_documento;
	}
}

function entidadbancariaNew($entidad_bancaria){
	if(is_numeric($entidad_bancaria)){
		pre(get_banco($entidad_bancaria));
	}	
}

function total_contable($consecutivo,$codigo_contable){
	$ci 	=& 	get_instance();
	$tabla	=	DB_PREFIJO."rp_operaciones t1";
	$ci->db->select("SUM(t1.credito) as credito,SUM(t1.debito) as debito");
	$ci->db->from($tabla);
	$ci->db->where("t1.consecutivo",$consecutivo);
	$ci->db->where("t1.codigo_contable",$codigo_contable);
	$query					=	$ci->db->get();
	return $query->row();
}

function search_nickname($nickname_id,$pagina){
	$ci 	=& 	get_instance();
	$tabla	=	DB_PREFIJO."cf_nickname t1";
	$ci->db->select("	t1.*,
						CONCAT(t3.primer_nombre,' ',t3.primer_apellido) AS modelo,
						t3.user_id as modelo_id,
						t4.nombre_master  as master,
						t5.abreviacion as sucursal
						");
	$ci->db->from($tabla);
	$ci->db->join(DB_PREFIJO."usuarios t2", 't1.id_plataforma=t2.user_id', 'left');
	$ci->db->join(DB_PREFIJO."usuarios t3", 't1.id_modelo=t3.user_id', 'left');
	$ci->db->join(DB_PREFIJO."cf_rel_master t4", 't1.id_master=t4.rel_plataforma_id', 'left');
	$ci->db->join(DB_PREFIJO."usuarios t5", 't1.centro_de_costos=t5.user_id', 'left');
	$ci->db->where("t1.id_plataforma ",$pagina);
	$ci->db->where("t1.nickname",$nickname_id);
	$query	=	$ci->db->get();
	return $row	= 	$query->row();
	if(empty($row->modelo)){
		$ci->db->select("	t1.*,
							CONCAT(t3.primer_nombre,' ',t3.primer_apellido) AS modelo,
							t3.user_id as modelo_id,
							t4.nombre_master  as master,
							t5.abreviacion as sucursal");
		$ci->db->from($tabla);
		$ci->db->join(DB_PREFIJO."usuarios t3", 't1.id_modelo=t3.user_id', 'left');
		$ci->db->join(DB_PREFIJO."cf_rel_master t4", 't1.id_master=t4.rel_plataforma_id', 'left');
		$ci->db->join(DB_PREFIJO."usuarios t5", 't1.centro_de_costos=t5.user_id', 'left');
		$ci->db->where("t1.nickname",$nickname_id);
		$ci->db->where("t1.estado",0);
		$query	=	$ci->db->get();
		return $query->row();	
	}else{
		return $row;
	}
}

function get_detalle_item_factura($v,$codigo_contable=array(),$where=array()){
	$tabla	=	DB_PREFIJO."rp_operaciones t1";
	$ci 	=& 	get_instance();	
	$ci->db->select("*")->from($tabla)->where("t1.consecutivo",$v->nro_documento)->where_in("t1.codigo_contable",$codigo_contable);
	foreach($where as $v2){
		$ci->db->where("t1.".$v2,$v->$v2);
	}
	return $ci->db->get()->row();
}

function OperacionesBancos(){
	$tabla	=	DB_PREFIJO."rp_operaciones t1";
	$ci 	=& 	get_instance();	
	$ci->db->select("	t1.id,
						SUM(t1.credito) AS  credito,
						t1.json,
						t1.codigo_contable,
						t2.abreviacion,
						t5.nro_cuenta,
						t1.procesador_id")->from($tabla);
	$ci->db->join(DB_PREFIJO."usuarios t2", 't1.centro_de_costos=t2.user_id', 'left');
	$ci->db->join(DB_PREFIJO."fi_cuentas t5",'t1.procesador_id=t5.id_cuenta','left');						
	$ci->db->where("t1.estatus",1);
	$ci->db->where("t1.tipo_documento",5);
	$ci->db->where("t1.codigo_contable","130510");
	$ci->db->group_by('t1.procesador_id','ASC');
	
	return $ci->db->get()->result();							
}

function comprobar_honorarios_pagos($ciclo_produccion_id,$modelo_id){
	$tabla	=	DB_PREFIJO."rp_honorarios_modelos t1";
	$ci 	=& 	get_instance();	
	$ci->db->select("json")->from($tabla);
	$ci->db->where("t1.modelo_id",$modelo_id);
	$ci->db->where("t1.ciclo_produccion_id",$ciclo_produccion_id);
	return	$ci->db->get()->result();	
}

function detalles_gastos_contable($consecutivo,$group_by = false){
	$tabla	=	DB_PREFIJO."rp_operaciones t1";
	$ci 	=& 	get_instance();	
	$ci->db->select("	t1.id,
						t1.modelo_id,
						t1.ciclo_produccion_id,
						SUM(t1.credito) as total_credito,
						SUM(t1.debito) as total_debito,
						t1.credito,
						t1.debito,
						t1.json,
						t1.codigo_contable")->from($tabla);
	$ci->db->where("t1.consecutivo",$consecutivo);
	$ci->db->where("t1.empresa_id",$ci->user->id_empresa);
	$ci->db->where("t1.tipo_documento",31);
	if($group_by){
		$ci->db->group_by("t1.codigo_contable");
	}
	$rows	= 	$ci->db->get()->result();

	return $rows;
}

function items_factura_contable($id,$codigo_contable=array(),$where=array()){
	$tabla	=	DB_PREFIJO."rp_operaciones t1";
	$ci 	=& 	get_instance();	
	$ci->db->select("	t1.id,
						t1.responsable_id,
						t1.modelo_id,
						t1.ciclo_produccion_id,
						t2.abreviacion,
						t3.primer_nombre,
						t3.segundo_nombre,
						t3.primer_apellido,
						t3.segundo_apellido,
						t3.type,
						t3.primer_nombre as primer_nombre_modelo,
						t3.primer_apellido as primer_apellido_modelo,
						SUM(t1.credito) AS  credito,
						t1.json,
						t5.nro_cuenta,
						t5.id_cuenta,
						t1.codigo_contable")->from($tabla);
	if($id!=NULL){
		$ci->db->where("t1.consecutivo",$id);	
	}
	if(!empty($codigo_contable)){
		$ci->db->where_in("t1.codigo_contable",$codigo_contable);
	}
	foreach($where as $k	=> 	$v2){
		$ci->db->where("t1.".$k,$v2);
	}
	$ci->db->where("t1.empresa_id",$ci->user->id_empresa);
	$ci->db->join(DB_PREFIJO."usuarios t2", 't1.centro_de_costos=t2.user_id', 'left');
	$ci->db->join(DB_PREFIJO."usuarios t3", 't1.modelo_id=t3.user_id', 'left');
	$ci->db->join(DB_PREFIJO."cf_rel_master t4",'t1.master_id=t4.rel_plataforma_id','left');
	$ci->db->join(DB_PREFIJO."fi_cuentas t5",'t4.cuenta_id=t5.id_cuenta','left');
	$ci->db->group_by('t1.nickname_id','ASC');
	$rows	= 	$ci->db->get()->result();

	foreach($rows as $k => $v){
		//pre($v);
		if(!empty($v->id_cuenta)){
			$insert		=	array(	"procesador_id"=>$v->id_cuenta);
			$ci->db->where('id', $v->id);
			$ci->db->update($tabla,$insert);
		}
	}
	return $rows;
}

function RP_X_Modelos($modelo_id,$ciclo_produccion_id){
	$tabla	=	DB_PREFIJO."rp_operaciones t1";
	$ci 	=& 	get_instance();	
	$ci->db->select("modelo_id,
						SUM(t1.credito) AS  credito , 
						SUM(t1.debito) AS  debito,
						json")->from($tabla);
	$ci->db->where("t1.empresa_id",$ci->user->id_empresa);
	$ci->db->where("t1.tipo_documento",1);
	$ci->db->where("t1.modelo_id",$modelo_id);
	$ci->db->where("t1.estatus",1);
	$ci->db->where("t1.codigo_contable",414580);
	$ci->db->where("t1.ciclo_produccion_id",$ciclo_produccion_id);
	$ci->db->group_by('t1.modelo_id','ASC');
	$rows	= 	$ci->db->get()->row();
	return $rows;
}

function set_centro_de_costos_tmp($v){
	$tabla	=	DB_PREFIJO."rp_tmp";
	$ci 	=& 	get_instance();	
	$insert	=	array(	"centro_de_costos"=>$v->centro_de_costos);
	$ci->db->where('reporte_archivo_plano_id', $v->reporte_archivo_plano_id);
	$ci->db->update($tabla,$insert);
}

function entidadbancaria($entidad_bancaria,$select = "Entidad"){
	if(is_numeric($entidad_bancaria)){
		$ci 	=& 	get_instance();
		$tabla		=		DB_PREFIJO."sys_bancos t1";
		$ci->db->select($select);
		$ci->db->from($tabla);
		$ci->db->where("t1.banco_id",$entidad_bancaria);
		$query			=	$ci->db->get();
		if($select == "Entidad"){
			return $query->row()->Entidad;
		}else{
			return $query->row();
		}
	}else{
		return $entidad_bancaria;
	}
}

function get_banco($cuenta_id){
	$ci 					=& 		get_instance();
	$tabla					=		DB_PREFIJO."fi_cuentas t1";
	return 	$ci->db->select("*")
					->from($tabla)
					->join(DB_PREFIJO."sys_bancos t2", 't1.entidad_bancaria = t2.banco_id', 'left')
					->where("t1.id_empresa",$ci->user->id_empresa)
					->where("t1.centro_de_costos",$ci->user->centro_de_costos)
					->where("t1.id_cuenta",$cuenta_id)	
					->order_by('t1.entidad_bancaria','ASC')
					->get()
					->row();
}

function Cajas($row,$name,$placeholder='',$require=false){

	if(empty($row)){
		$row=new stdClass();		
		$row->$name='';
	}
	$ci 	=& 	get_instance(); 
	$tabla	=	DB_PREFIJO."fi_cajas";
	$rows	=	$ci->db->select("nombre_caja,id_caja")->from($tabla)->get()->result();
	$html	=	'';
	if(count($rows)<2){
		$html	.=	$rows[0]->nombre_caja;		
		$html	.=	'<input type="hidden" name="'.$name.'" id="'.$name.'" require="require" value="'.$rows[0]->id_caja.'" />';
		return $html;	
	}
	$html	.=	'<input type="text" class="form-control firstLetterText"  placeholder="'.$placeholder.'" id="content'.$name.'" maxlength="150"  value="'.$row->$name.'"';
	$html	.=	($require)? 'require="require"':'""';
	$html	.=	'/>';
	$html	.=	'<input type="hidden" name="'.$name.'" id="'.$name.'" require="require" />';
	$html	.= 	'	<script>
						$(function(){
							var projects = [';
								foreach($rows as $k => $v){
									$html	.= 	'{
													value: "'.$v->id_caja.'",
													label: "'.$v->nombre_caja.'"
												},';
								}
							 
	$html	.= 	'			];
							$( "#content'.$name.'" ).autocomplete({
								minLength: 0,
								source: projects,
								focus: function( event, ui ) {
									$( "#content'.$name.'" ).val( ui.item.label );
									$( "#'.$name.'" ).val( ui.item.value );
										return false;
								},
								select: function( event, ui ) {
									$("#content'.$name.'" ).val( ui.item.label );
									$( "#'.$name.'" ).val( ui.item.value );
									return false;
								}
							});
						});
					</script>
				';
	return $html;
}

function SiNo($var){
		if($var==0){
			$v  = "No";
		}else if($var==1){
			$v  = "Si";
		}else if($var==2){
			$v  = "N.A";
		}
		return ($v);
	}

function img_profile($user_id){
	$ci 	=& 	get_instance(); 
	return image("uploads/perfiles/".$user_id.'/profile.jpg'); 	
}

function me_img_profile(){
	$ci 	=& 	get_instance(); 
	return image("uploads/perfiles/".$ci->user->user_id.'/profile.jpg'); 	
}

function img_logo($empresa_id){ 
	return image("uploads/perfiles/".$empresa_id.'/logo.jpg'); 	
}

function img_firma($firma){
	return image("uploads/".$firma); 	
}

function ceros($numero){
$width 	= 3;
return str_pad((string)$numero, $width, "0", STR_PAD_LEFT); 


	
	
if(strlen($numero) >= 4){
	return $numero;
} 
// Si no se necesita decimales cambiar esta linea 
$decimales = explode(".",$numero); 
//Si no se necesita los decimales cambiar $decimales[0] por $numero 
$diferencia = 3 - strlen($decimales[0]);
$numero_con_ceros = 0;
	for($i = 0 ; $i < $diferencia; $i++) { 
	        $numero_con_ceros .= 0; 
	} 
$numero_con_ceros .= $numero; 
return $numero_con_ceros; 
}

function correo($row,$name,$placeholder='',$require=false){
		if(empty($row)){
			$row=new stdClass();		
			$row->$name='';
		}
		$ci 	=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."cf_comercial";
		$rows	=	$ci->db->select("email")->from($tabla)->get()->result();
		
		$html	=	'';
		$html	.=	'<input type="text" class="form-control firstLetterText" name="'.$name.'" id="'.$name.'" placeholder="'.$placeholder.'" maxlength="150"  value="'.$row->$name.'"';
		$html	.=	($require)? 'require="require"':'""';
		$html	.=	'/>';
		$html	.= 	'	<script>
							$(function(){
								var projects = [';
									foreach($rows as $k => $v){
										$html	.= 	'{
														value: "'.$v->email.'",
														label: "'.$v->email.'"
													},';
									}
								 
		$html	.= 	'			];
								$( "#'.$name.'" ).autocomplete({
									minLength: 0,
									source: projects,
									focus: function( event, ui ) {
										$( "#'.$name.'" ).val( ui.item.value );
											return false;
									},
									select: function( event, ui ) {
										$( "#'.$name.'" ).val( ui.item.value );
										return false;
									}
								});
							});
						</script>
					';
		return $html;
	}

	function ciudad($row,$name,$placeholder='',$require=false){
		if(empty($row)){
			$row=new stdClass();		
			$row->$name='';
		}
		
		$html	=	'';
		$html	.=	'<input type="text" class="form-control firstLetterText" name="'.$name.'" id="'.$name.'" placeholder="'.$placeholder.'" maxlength="150"  value="'.$row->$name.'"';
		$html	.=	($require)? 'require="require"':'""';
		$html	.=	'/>';
		$html	.= 	'	<script>
							$(function(){
								var projects = [';
									foreach(get_municipios() as $k => $v){
										$html	.= 	'{
														value: "'.$v->codigo.'",
														label: "'.$v->union.'",
														departamento:"'.$v->departamento.'",
														codigo_postal: "Nulo",
														pais: "Colombia"
													},';
									}
								 
		$html	.= 	'			];
								$( "#ciudad" ).autocomplete({
									minLength: 0,
									source: projects,
									change: function (event, ui){
										console.log(ui.item)
									if (ui.item===null) { 
											this.value = ""; 
											$( "#ciudad" ).val( "" );
											$( "#contenedor_ciudad" ).val( "" );
											$( "#departamento" ).val( "" );
											$( "#pais" ).val( "" );
											$( "#codigo_postal" ).val( "" );
											alert("Por favor seleccione una ciudad válida del listado")	;										
											$( "#ciudad" ).focus();
										}
									},
									focus: function( event, ui ) {
										$( "#project" ).val( ui.item.label );
											return false;
									},
									select: function( event, ui ) {
										if(!ui.item){
											
											alert(5)
										}
										$( "#ciudad" ).val( ui.item.label );
										$( "#contenedor_ciudad" ).val( ui.item.label );
										$( "#departamento" ).val( ui.item.departamento );
										/*$( "#codigo_postal" ).val( ui.item.codigo_postal );*/
										$( "#pais" ).val( ui.item.pais );
										return false;
									}
								});
							});
						</script>
					';
		return $html;
	}

function Clientes($row,$name,$placeholder='',$require=false){
		if(empty($row)){
			$row=new stdClass();		
			$row->$name='';
		}
		$ci 	=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."cf_comercial";
		$rows	=	$ci->db->select("empresa")->from($tabla)->get()->result();
		
		$html	=	'';
		$html	.=	'<input type="text" class="form-control firstLetterText" name="'.$name.'" id="'.$name.'" placeholder="'.$placeholder.'" maxlength="150"  value="'.$row->$name.'"';
		$html	.=	($require)? 'require="require"':'""';
		$html	.=	'/>';
		$html	.= 	'	<script>
							$(function(){
								var projects = [';
									foreach($rows as $k => $v){
										$html	.= 	'{
														value: "'.$v->empresa.'",
														label: "'.$v->empresa.'"
													},';
									}
								 
		$html	.= 	'			];
								$( "#'.$name.'" ).autocomplete({
									minLength: 0,
									source: projects,
									focus: function( event, ui ) {
										$( "#'.$name.'" ).val( ui.item.value );
											return false;
									},
									select: function( event, ui ) {
										$( "#'.$name.'" ).val( ui.item.value );
										return false;
									}
								});
							});
						</script>
					';
		return $html;
	}

	function post($var=""){
		$ci 	=& 	get_instance(); 
		if($var==''){
			return $ci->input->post();	
		}else{
			return $ci->input->post($var, TRUE);
		}
	}
	
	function BancosDetallesContable($id_cuenta,$tipo_documento=array("Comprobante Bancario")){
		$ci 	=& 	get_instance();		
		$tabla	=	DB_PREFIJO."rp_operaciones t1";
		return $ci->db->select("Pagina,Nombre_legal,tipo_documento,consecutivo,codigo_contable,debito,credito,entidad_bancaria,nro_cuenta,fecha,procesador_id,tipo_cuenta,t2.id_cuenta")
									->from($tabla)
									->join(DB_PREFIJO."fi_cuentas t2", 't1.procesador_id = t2.id_cuenta', 'left')
									->join(DB_PREFIJO."sys_paginas_webcam t3", 't1.cliente_id = t3.cliente_id', 'left')
									->where('t1.id_empresa',$ci->user->id_empresa)
									->where('t2.id_cuenta',$id_cuenta)
									->where('t1.credito>',0)
									->where('t1.estatus',1)
									->where_in("t1.tipo_documento",$tipo_documento)
									->get()
									->result();
	}

	function ResumenBancosNew($tipo_monedas){
		$ci 	=& 	get_instance();		
		$tabla	=	DB_PREFIJO."fi_cuentas";
		$result	=	$ci->db->select("*")->from($tabla)
								->where('id_empresa',$ci->user->id_empresa)
								->where('estado',1)
								->where_in("tipo_monedas",$tipo_monedas)
								->get()
								->result();
		$return=array();

		foreach($result as $v){
			$return[$v->id_cuenta]	=	$v;	
		}						
		return $return;								
	}
	
	function ResumenBancos($incluir=array('130510',"111010"),$tipo_documento=array("Comprobante Bancario"),$tipo_monedas=array("Euros","USD","Pesos")){
		$ci 	=& 	get_instance();		
		$tabla	=	DB_PREFIJO."fi_cuentas t1";
		return $ci->db->select("sum(credito) - sum(debito) as total,
									consecutivo,
									codigo_contable,
									debito,
									credito,
									entidad_bancaria,
									nro_cuenta,
									fecha,
									procesador_id,
									tipo_cuenta,
									t1.id_cuenta")
								->from($tabla)
								->join(DB_PREFIJO."rp_operaciones t2", 't2.procesador_id = t1.id_cuenta', 'left')
								->where('t1.id_empresa',$ci->user->id_empresa)
								->where('t2.estatus',1)
								->where_in("t1.tipo_monedas",$tipo_monedas)
								->where_in("t2.codigo_contable",$incluir)
								->group_by('t1.nro_cuenta','ASC')
								->get()
								->result();
	}
	
	function RetirosTRMDetalles($consecutivo,$incluir=array('130510'),$tipo_documento=array("TRM Retiro")){
		$ci 	=& 	get_instance();		
		$tabla	=	DB_PREFIJO."rp_operaciones";
		return $ci->db->select("sum(credito) as total,consecutivo,codigo_contable,debito,credito,fecha,procesador_id")
									->from($tabla)
									->where('id_empresa',$ci->user->id_empresa)
									->where('consecutivo',$consecutivo)
									->where_in("codigo_contable",$incluir)
									->where_in("tipo_documento",$tipo_documento)
									->get()
									->result();
	}
	
	function RetirosTRMDetallesContable($consecutivo){
		$ci 	=& 	get_instance();		
		$tabla				=	DB_PREFIJO."rp_operaciones t1";		
		$cuenta_contable	=	$ci->db->select("*")->from($tabla)
													->where('t1.empresa_id',$ci->user->id_empresa)
													->where('consecutivo',$consecutivo)
													->where_in("t1.codigo_contable",array("111005","110505","110510","110515"))
													->where('t1.tipo_documento',10)
													->get()
													->result();	
		return $cuenta_contable;																								
	}
	
	function RetirosTRMDetalle($consecutivo){
		$ci 	=& 	get_instance();		
		$tabla				=	DB_PREFIJO."rp_operaciones t1";		
		$cuenta_contable	=	$ci->db->select("*")->from($tabla)
													->where('t1.empresa_id',$ci->user->id_empresa)
													->where('consecutivo',$consecutivo)
													->where_in("t1.codigo_contable",array("111010","110505","530515","111005","110510"))
													->where('t1.tipo_documento',6)
													->get()
													->result();	
		return $cuenta_contable;																								
	}
	
	function retiros_caja($caja_id){
		$tabla				=	DB_PREFIJO."rp_operaciones t1";		
		$ci 	=& 	get_instance();		
		return $ci->db->select(" IFNULL(SUM(debito), 0) as total,
								 IFNULL(SUM(debito), 0) as total_COP,
								consecutivo,
								codigo_contable,
								debito,
								credito,
								fecha,
								procesador_id,
								caja_id")
								->from($tabla)
								->where('t1.empresa_id',$ci->user->id_empresa)
								->where('t1.caja_id',$caja_id)
								->where("t1.codigo_contable",110505)
								->where_in("t1.tipo_documento",array(6,10))
								->get()
								->row();
	}
	
	function Debo($campo_busqueda=array(),$tipo_documento=array(2,8,14),$codigo_contable=array("110510")){
		$ci 	=& 	get_instance();	
		$tabla	=	DB_PREFIJO."rp_operaciones t1";
		$ci	->db->select("*")
			->from($tabla)
			->where('t1.empresa_id',$ci->user->id_empresa);
		foreach($campo_busqueda as $k	=> 	$v){
			$ci->db->where('t1.'.$k,$v);
		}	
		$ci->db->where_in("t1.tipo_documento",$tipo_documento);
		$ci->db->where_in("t1.codigo_contable",$codigo_contable);
		$rows	=	$ci->db->get()->result();
		$return	=	0;
		foreach($rows as $k =>$v){
			$return+=$v->credito;
			//pre($v->credito);	
		}
		return $return;
	}
	
	function ResumenCajas($incluir=array('110505'),$tipo_documento=array("TRM Retiro"),$estado="todas"){
		$ci 	=& 	get_instance();	
		$tabla	=	DB_PREFIJO."fi_cajas t1";
		$ci->db->select("*")->from($tabla)->where('t1.id_empresa',$ci->user->id_empresa);
		if($estado == 0 || $estado == 1 ){
			$ci->db->where('t1.estado',$estado);
		}
		$rows	=	$ci->db->get()->result();										
		$return	=	array();				
		$tabla	=	DB_PREFIJO."rp_operaciones t1";			
		foreach($rows as $k =>$v){

			$return[$v->id_caja] =	$ci->db->select("'".$v->nombre_caja."' AS nombre_caja, 
														IFNULL(SUM(credito), 0) as total,
														IFNULL(SUM(credito), 0) as total_COP,
														consecutivo,
													    codigo_contable,
														
														debito,
														credito,
														fecha,
														procesador_id,
														caja_id")
														->from($tabla)
														->where('t1.empresa_id',$ci->user->id_empresa)
														->where('t1.caja_id',$v->id_caja)
														->where_in("t1.codigo_contable",$incluir)
														->where_in("t1.tipo_documento",$tipo_documento)
														->get()
														->row();
			$return[$v->id_caja]->codigo_contable	=	$v->codigo_contable;
			$return[$v->id_caja]->codigo_contable_subfijo = $v->codigo_contable_subfijo;
			$return[$v->id_caja]->real_nombre_caja = $v->nombre_caja;
			$return[$v->id_caja]->id_caja = $v->id_caja;
			$return[$v->id_caja]->tipo_caja=  $v->Tipo_de_Caja;				
		}							
		return $return;
		
	}

	function DocumentoHonorarios($documento_id){
		$ci 	=& 	get_instance();		
		$tabla	=	DB_PREFIJO."ma_documentos";
		return $ci->db->select("*")
							->from($tabla)
							->where('documento_id',$documento_id)
							->get()
							->row();
	}
	
	function ResumenCaja($id_caja){
		$ci 	=& 	get_instance();		
		$tabla	=	DB_PREFIJO."rp_operaciones t1";
		return $ci->db->select("	IFNULL(SUM(credito), 0) as total,
									IFNULL(SUM(credito), 0) as total_COP,
									consecutivo,
									codigo_contable,
									debito,
									credito,
									fecha,
									procesador_id,
									caja_id")
							->from($tabla)
							->where('t1.empresa_id',$ci->user->id_empresa)
							->where('t1.caja_id',$id_caja)
							->get()
							->row();

	}
	
	function RP_HonorariosModelo($id_modelo,$ciclo_informacion,$escala_escala_x_user_id){
		$ci 	=& 	get_instance();
		$tabla	=	DB_PREFIJO."cf_nickname t1";
		$ci->db->select("*");
		$ci->db->from($tabla);
		$ci->db->join(DB_PREFIJO."usuarios t2", 't1.id_plataforma 	= 	t2.user_id', 'left');
		$ci->db->where('t1.id_modelo',$id_modelo);
		$ci->db->where("t1.id_empresa",$ci->user->id_empresa);
		$ci->db->where("t2.estado",1);
		$ci->db->where("t1.estado",1);
		$ci->db->where_not_in("t2.moneda_de_pago",array('RSS','Free'));
		$ci->db->order_by('t2.primer_nombre','ASC');
		$query			=	$ci->db->get();
		$return			=	array();
		$totalP=$totalRQ=	0;
		$trm_now=periodotrm($ciclo_informacion->fecha_hasta)->monto;

		foreach($query->result() as $k => $v){
			$return[$k]					=	$v;
			$nickname_id				=	$v->nickname_id;
			$return[$k]->get_diario		=	get_diario($id_modelo,$nickname_id,$ciclo_informacion->fecha_desde,$ciclo_informacion->fecha_hasta);
			$conversion_token_standar	=	conversion_token_standar(@$get_diario->monto,$v->equivalencia);
			$return[$k]->totalRQ		=	$conversion_token_standar;
			$totalRQ					=	$totalRQ	+	$conversion_token_standar;
			$items_factura_x_nickname	=	items_factura_x_nickname($v->nickname_id);
			if(is_object($items_factura_x_nickname)){
				$return[$k]->produccion	=	$items_factura_x_nickname->tokens;											
			}else{
				$return[$k]->produccion	=	0;
			}
			$return[$k]->totalP						=	conversion_token_standar(@$return[$k]->produccion,$v->equivalencia);
			$totalP									=	$totalP		+	$return[$k]->totalP;
			$return[$k]->conversion					=	conversion_token_standar(@$return[$k]->produccion,$v->equivalencia);
			if(!empty($return[$k]->get_diario)){
				$return[$k]->conversion_total		=	$return[$k]->conversion - $conversion_token_standar;
			}else{
				$return[$k]->conversion_total		=	$return[$k]->conversion;
			}
		}
		return array(	"rows"=>$return,
						"totales"=>array(	"totalRQ"=>$totalRQ,
											"totalP"=>$totalP,
											"totalP_menos_totalRQ"=>($totalP-$totalRQ)
										)
					);
	}
	
	function RP_Plataformas(){
		$ci 	=& 	get_instance();
		$tabla	=	DB_PREFIJO."cf_rel_plataformas t1";
		$ci->db->select("*");
		$ci->db->from($tabla);
		$ci->db->join(DB_PREFIJO."usuarios t2", 't2.user_id	=	t1.id_plataforma', 'left');
		$ci->db->where('t1.id_empresa',$ci->user->id_empresa);
		$ci->db->group_by('t2.nombre_legal','ASC');
		return 	$rows	=	$ci->db->get()->result();
	}
	
	function RP_OtrosIngresos($id_modelo){
		$OtrosIngresos=OtrosIngresos($id_modelo);
		$TotalOtrosIngresos=TotalOtrosIngresos($id_modelo);
		return array("rows"=>$OtrosIngresos,"Totales"=>array("TotalOtrosIngresos"=>$TotalOtrosIngresos->valor));
	}
	
	function RP_Descuentos($id_modelo){
		$modelo						=	centrodecostos($id_modelo);
		$ciclo_informacion			=	get_cf_ciclos_pagos_new($modelo->id_empresa,0);
		$DiasTrabajados				=	DiasTrabajados($modelo->user_id,$ciclo_informacion->fecha_desde);
		if(!empty($DiasTrabajados)){$dias_trabajados=$DiasTrabajados->dias_trabajados;}else{$dias_trabajados=15;}
		$escala_escala_x_user_id	=	get_escala_x_user_id2($modelo->user_id);
		
		$ListOtrosIngresos			=	Descuentos($id_modelo);
		$total_cuotas=0;
		$total_cuotas=array();
		$rows=array();
		$incremento=0;
		foreach($ListOtrosIngresos as $v){
			$rows[]					=	$v;
			$cantidad_de_cuotas 	= 	CountCuotasDescuentos($v->descuento_id)->total;
			$rows[]->total_cuotas	=	$total_cuotas	=	($cantidad_de_cuotas + 1) .'/'.$v->nro_quincenas;
			$incremento++;
		}
		$eps								=	calcula_montos_x_dias($escala_escala_x_user_id->eps,$dias_trabajados);
		if($eps>0){
			$rows[$incremento]		 		= 	new stdClass();
			$rows[$incremento]->concepto	=	'Pack Seguridad Social';
			$rows[$incremento]->observacion	=	'Auxilio EPS';
			$rows[$incremento]->total_cuotas=	'1/1';
			$rows[$incremento]->restante	=	0;
			$incremento++;
		}
		$arl								=	calcula_montos_x_dias($escala_escala_x_user_id->arl,$dias_trabajados);
		if($arl>0){
			$rows[$incremento] 				= 	new stdClass();
			$rows[$incremento]->concepto	=	'Pack Seguridad Social';
			$rows[$incremento]->observacion	=	'Auxilio A.R.L';
			$rows[$incremento]->total_cuotas=	'1/1';
			$rows[$incremento]->restante	=	0;
			$incremento++;
		}
		
		$varmeta							=	predateoFactorBonificacion($escala_escala_x_user_id->meta,$dias_trabajados);
		
		$bonificacion						=	calcular_bonificacion($varmeta,$totalP,$factorBonificacion,$trm_now);
		if(!empty($escala_escala_x_user_id)){
			$salario						=	calcula_montos_x_dias(@$escala_escala_x_user_id->salario,$dias_trabajados);
			$salario_var					=	(format($salario,false));
		}else{
			$salario_var	=	0;	
		}
		$aux				=	calcula_montos_x_dias($escala_escala_x_user_id->caja_compensacion,$dias_trabajados);
		$ahorro_prima		=	$salario + $escala_salario + $eps + $arl + $aux + $bonificacion;
		$total_ahorro_prima	=	($ahorro_prima * $escala_escala_x_user_id->prima)/100;
		if($prima>0){
			$rows[$incremento]				= 	new stdClass();
			$rows[$incremento]->concepto	=	'Pack Seguridad Social';
			$rows[$incremento]->observacion	=	'Prima Semestral';
			$rows[$incremento]->total_cuotas=	'1/1';
			$rows[$incremento]->restante	=	0;
			$incremento++;
		}
		return array("rows"=>$rows,"Totales"=>array("total_cuotas"=>$total_cuotas));
	}
	
	function HonorariosModelo($id_modelo,$ciclo_informacion,$escala_escala_x_user_id){
		$ci 	=& 	get_instance();
		$tabla	=	DB_PREFIJO."cf_nickname t1";
		$ci->db->select("*");
		$ci->db->from($tabla);
		$ci->db->join(DB_PREFIJO."usuarios t2", 't1.id_plataforma 	= 	t2.user_id', 'left');
		$ci->db->where('t1.id_modelo',$id_modelo);
		$ci->db->where("t1.id_empresa",$ci->user->id_empresa);
		$ci->db->where("t2.estado",1);
		$ci->db->where("t1.estado",1);
		$ci->db->where_not_in("t2.moneda_de_pago",array('RSS','Free'));
		$ci->db->order_by('t2.primer_nombre','ASC');
		$query			=	$ci->db->get();
		$return			=	array();
		$totalP=$totalRQ=	0;

		foreach($query->result() as $k => $v){
			$return[$k]					=	$v;
			$nickname_id				=	$v->nickname_id;
			$return[$k]->get_diario		=	get_diario($id_modelo,$nickname_id,$ciclo_informacion->fecha_desde,$ciclo_informacion->fecha_hasta);
			
			$conversion_token_standar	=	conversion_token_standar(@$get_diario->monto,$v->equivalencia);
			
			$return[$k]->totalRQ		=	$conversion_token_standar;
			$totalRQ					=	$totalRQ	+	$conversion_token_standar;
			
			
			
			$items_factura_x_nickname	=	items_factura_x_nickname($v->nickname_id);
			if(is_object($items_factura_x_nickname)){
				$return[$k]->produccion	=	$items_factura_x_nickname->tokens;											
			}else{
				$return[$k]->produccion	=	0;
			}
			$return[$k]->totalP						=	conversion_token_standar(@$return[$k]->produccion,$v->equivalencia);
			
			$totalP									=	$totalP		+	$return[$k]->totalP;
			
			$return[$k]->conversion					=	conversion_token_standar(@$return[$k]->produccion,$v->equivalencia);
			
			if(!empty($return[$k]->get_diario)){
				$return[$k]->conversion_total		=	$return[$k]->conversion - $conversion_token_standar;
			}else{
				$return[$k]->conversion_total		=	$return[$k]->conversion;
			}
			
		}
		$DiasTrabajados				=	DiasTrabajados($id_modelo,$ciclo_informacion->fecha_desde);
		if(!empty($DiasTrabajados)){
			$dias_trabajados		=	$DiasTrabajados->dias_trabajados;
		}else{
			$dias_trabajados 		= 	15;	
		}
		
		/*CALCULAR OTROS INGRESOS*/
		$OtrosIngresos=array();
		$TotalOtrosIngresos=0;
		$ListOtrosIngresos=OtrosIngresos($id_modelo);
		if(count($ListOtrosIngresos)>0){
			foreach($ListOtrosIngresos as $k=>$v){
				$OtrosIngresos[$k]	=	$v;
				$TotalOtrosIngresos	=	$TotalOtrosIngresos+$v->valor;	
			}
		}
		
		/*CALCULAR DESCUENTOS*/
		$OtrosDescuentos=array();
		$TotalOtrosDescuentos=0;
		$ListOtrosDescuentos	=	Descuentos($id_modelo);
		if(count($ListOtrosDescuentos)>0){
			foreach($ListOtrosDescuentos as $k	=>	$v){
				$OtrosDescuentos[$k]=$v;
				$TotalOtrosDescuentos=$TotalOtrosDescuentos+$v->valor;
				$cantidad_de_cuotas=CountCuotasDescuentos($v->descuento_id)->total;
				$OtrosDescuentos[$k]->cantidad_de_cuotas	=	($cantidad_de_cuotas + 1).'/'.$v->nro_quincenas;
			}
		}
		
		/*CALCULAR EPS*/
		$escala_salario 	=		calcula_montos_x_dias($escala_escala_x_user_id->auxilio_transporte,$dias_trabajados);
		$eps				=		calcula_montos_x_dias($escala_escala_x_user_id->eps,$dias_trabajados);
		
		return array("OtrosDescuentos"=>$OtrosDescuentos,"OtrosIngresos"=>$OtrosIngresos,"rows"=>$return,"totales"=>array("TotalOtrosDescuentos"=>$TotalOtrosDescuentos,"TotalOtrosIngresos"=>$TotalOtrosIngresos,"totalP"=>$totalP,"totalRQ"=>$totalRQ,"totalP_menos_totalRQ"=>($totalP-$totalRQ)));		
	}

	function nickname_id($nickname_id){
		
		$ci 	=& 	get_instance();
		$tabla	=	DB_PREFIJO."cf_nickname";
		$ci->db->select("nickname");
		$ci->db->from($tabla);
		$ci->db->where('nickname_id',$nickname_id);
		$row	= 	$ci->db->get()->row();
		return $row;
	}
	
	function html_logs($tabla_afectada,$registro_afectado_id){
		
		$ci 	=& 	get_instance();
		$tabla	=	DB_PREFIJO."sys_logs t1";
		$ci->db->select("	t1.fecha,
							t1.tipo_transaccion,
							t1.modulo_donde_produjo_cambio,
							t1.registro_afectado_id,
							t1.json,
							t2.primer_nombre,
							t2.segundo_nombre,
							t2.primer_apellido,
							t2.segundo_apellido,
							t2.type");
		$ci->db->from($tabla);
		$ci->db->join(DB_PREFIJO."usuarios t2", 't1.user_id 	= 	t2.user_id', 'left');
		$ci->db->where('t1.tabla_afectada',$tabla_afectada);
		$ci->db->where('t1.registro_afectado_id',$registro_afectado_id);
		$rows	= 	$ci->db->get()->result();
		
		//pre($rows);return;
		
		$html	=	'<div class="row filters">';
        	$html	.=	'<div class="col-md-12">';
		    	#$html	.=	'<h4 class="font-weight-700 text-uppercase orange">';
				#	$html	.=	'Movimientos';
				#$html	.=	'</h4>';
				$html	.=	'	<table class="table table-hover">
									<thead>
										<tr>
											<th>Fecha</th>
											<th class="text-center">Operación</th>
											<th class="text-center">Documento</th>
											<th class="text-left">Responsable</th>
											<th class="text-right">Débito</th>
											<th class="text-right">Crédito</th>
										</tr>
									</thead>
									<tbody>';
				foreach($rows as $k =>$v){
					//pre($v);	
					$json	=	json_decode($v->json);				
					//pre($json);
					$print	=	array();
					$suma	=	0;
					foreach($json as $k2 => $v2){
						@$print[$v2->consecutivo]			=	@$v2;
						if(@$v2->codigo_contable=='414580'){
							$suma+=$v2->credito;
							$print[$v2->consecutivo]->credito	=	$suma;							
						}else{
							$suma+=@$v2->debito;
							@$print[$v2->consecutivo]->debito	=	$suma;
						}
					}
					//pre($print);return;
					foreach($print as $k2 => $v2){
						$html	.=	'			<tr>
													<td>'.$v->fecha.'</td>
													<td class="text-center">'.@$v->modulo_donde_produjo_cambio.'</td>
													<td class="text-center">'.@$v2->consecutivo.'</td>
													<td>'.nombre(@$v).'</td>
													<td class="text-right">'.@$v2->credito.'</td>';
						if(@$v2->codigo_contable=='414580'){
							$html	.=	'				<td class="text-right">'.format(@$v2->credito,true).'</td>';	
						}else{
							$html	.=	'				<td class="text-right">'.format(@$v2->debito,true).'</td>';	
						}
						$html	.=	'				</tr>';
					}
				}
				$html	.=	'		</tbody>
								</table>';
			$html	.=	'</div>';
		$html	.=	'</div>';
		return $html;	
	}

	function MakeTipoModelo($name,$data,$estado=null,$extra=array()){
		$options = array( ""   =>	"Seleccione");
		if(count($data) > 0){
			foreach ($data as $k => $v) {
				$options[$v] = $v;
			}
		}

		return form_dropdown($name, $options, $estado,$extra);
	}

	function MakePrioridad($name,$estado=null,$extra=array()){
		$options = array(
			""		=>	"Seleccione",
			'1'         => 'Alta',
			'4'       => 'Moderada',
			'7'       => 'Baja'
		);
		return form_dropdown($name, $options, $estado,$extra);
	}

	function verPrioridad($val){
		if($val == 1){
			$prioridad = "Alta";
		}elseif($val == 4){
			$prioridad = "Moderada";
		}else{
			$prioridad = "Baja";
		}
		return $prioridad;
	}
	
	function MakeSeleccionEmpresas(){
		$ci 				=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."usuarios t1";
		$rows	=	$ci->db->select("t2.*,t2.user_id as empresa_id,t1.nombre_comercial")
							->from($tabla)
							->join(DB_PREFIJO."usuarios t2", 't1.user_id 	= 	t2.id_empresa', 'left')
							->where("t1.type","empresa")
							->where("t2.nombre_legal","Principal")
							->get()
							->result();
		$options = array(""	=>	"Empresas");
		$html='';
		foreach ($rows as $key => $v) {
			$html .=	'<a class="btn btn-secondary btn-sm" href="'.base_url("Usuarios/SetCentroCostos/".$v->empresa_id).'">'.$v->nombre_comercial.'</a>';
		}
		return $html;
	}
	
	function MakePeriodosPago(){
		$ci 				=& 	get_instance(); 
		$CicloDePago		=	$ci->session->userdata('CicloDePago');
		$estado				=	(!empty($CicloDePago['objeto']))?$CicloDePago['objeto']->ciclos_id:'';
		$tabla	=	DB_PREFIJO."cf_ciclos_pagos";
		$rows	=	$ci->db->select("*")->from($tabla)->get()->result();
		$options = array(""	=>	"Ciclo de Pago");
		foreach ($rows as $key => $v) {
			$options[$v->ciclos_id] = substr($v->nombre,0,1).substr($v->nombre,-1).date('-m-Y', strtotime($v->fecha_desde));
		}
		$html	=	form_open(base_url("Reportes/SetPeriodo"),array("ajax"=>"true"));
		$html	.=	'<input type="hidden" require="true"  value="1" />';
		$html	.=	form_dropdown("ciclos_id", $options,$estado,array("class"=>"form-control","id"=>"change_ciclos_id"));
		$html	.=	form_close();
		return $html;
	}

	function MakeCajas($name,$estado=null,$extra=array()){
		$ci 	=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."fi_cajas";
		$rows	=	$ci->db->select("nombre_caja,id_caja,codigo_contable")
						->from($tabla)
						->where('id_empresa',$ci->user->id_empresa)
						->where('estado',1)
						->get()->result();
		$options = array(""		=>	"Seleccione");
		foreach ($rows as $key => $v) {
			$options[$v->id_caja.'/-/'.$v->codigo_contable] = $v->nombre_caja;
		}
		return form_dropdown($name, $options, $estado,$extra);
	}

	function getCaja($caja_id){ 
		$ci = get_instance();		
		$tabla	=	DB_PREFIJO."fi_cajas";
		$row	=	$ci->db->select("nombre_caja")
						->from($tabla)
						->where('id_empresa',$ci->user->id_empresa)
						->where('id_caja',$caja_id)
						->get()->row()->nombre_caja;
		if(!empty($row)){
			return $row;
		}else{
			return null;
		}
	}
	
	function entidad_bancaria($var){
		if(!empty($var->entidad_bancaria)){
			return $var->entidad_bancaria.' <b>('.$var->nro_cuenta.')</b>';
		}else{
			return false;	
		}
	}
	
	function detalle_contable($consecutivo,$incluir=array('130510','111010'),$tipo_documento=array("Comprobante Bancario")){
		$ci 	=& 	get_instance();
		$tabla	=	DB_PREFIJO."rp_operaciones t1";
		$ci->db->select("t1.json,t1.consecutivo,t1.responsable_id,t1.codigo_contable,t1.debito,t1.credito,entidad_bancaria,nro_cuenta,fecha,estatus");
		$ci->db->from($tabla);
		$ci->db->join(DB_PREFIJO."fi_cuentas t2", 't1.procesador_id 	= 	t2.id_cuenta', 'left');
		$ci->db->where('t1.empresa_id',$ci->user->id_empresa);
		$ci->db->where('t1.consecutivo',$consecutivo);
		if(!empty($incluir)){
			$ci->db->where_in("t1.codigo_contable",$incluir);
		}
		$ci->db->where_in("t1.tipo_documento",$tipo_documento);
		return $ci->db->get()->result();												
	}
	
	function recalculo_factura($id_empresa,$nro_documento){
		$ci 	=& 	get_instance();
		$tabla	=	DB_PREFIJO."rp_operaciones";
		return $row	=	$ci->db->select("SUM(credito) as total_facturado_dolar,estatus")->from($tabla)
														->where('empresa_id',$id_empresa)
														->where('nro_documento',$nro_documento)
														//->where('estatus',1)
														->where('codigo_contable',"130510")
														->get()
														->row();
	}
	
	function consecutivo($empresa_id,$type,$consecutivo=NULL){
		$ci 	=& 	get_instance();
		$tabla	=	DB_PREFIJO."sys_consecutivo";
		$row	=	$ci->db->select("id,consecutivo")->from($tabla)
													->where('empresa_id',$empresa_id)
													->where('type',$type)
													->get()
													->row();
		$insert_id			=	($consecutivo==NULL)?1:$consecutivo;	
		$insert				=	array(	"empresa_id"=>$empresa_id,
										"consecutivo"=>$insert_id,
										"type"=>$type);
																			
		if(empty($row)){
			//$ci->db->insert($tabla,$insert);
			//$insert_id 			= 	$ci->db->insert_id();
			$insert_id 			= 	1;
		}else{
			$insert_id			=	$row->consecutivo + 1;
		}
		return $insert_id;
	}

	function consecutivo_x_usuario($user_id,$type,$consecutivo=NULL){
		$ci 	=& 	get_instance();
		$tabla	=	DB_PREFIJO."sys_consecutivo";
		$row	=	$ci->db->select("id,consecutivo")->from($tabla)
													->where('empresa_id',$ci->user->id_empresa)
													->where('centro_de_costos',$ci->user->centro_de_costos)
													->where('user_id',$user_id)
													->where('type',$type)
													->get()
													->row();
		$insert_id			=	($consecutivo==NULL)?1:$consecutivo;	
		$insert				=	array(	"empresa_id"=>$ci->user->id_empresa,
										"consecutivo"=>$insert_id,
										"type"=>$type);
																			
		if(empty($row)){
			//$ci->db->insert($tabla,$insert);
			//$insert_id 			= 	$ci->db->insert_id();
			$insert_id 			= 	1;
		}else{
			$insert_id			=	$row->consecutivo + 1;
		}
		return $insert_id;
	}

	function incrementa_consecutivo_x_usuario($user_id,$type){
		$ci 	=& 	get_instance();
		$tabla	=	DB_PREFIJO."sys_consecutivo";
		$row	=	$ci->db->select("id,consecutivo")->from($tabla)
													->where('empresa_id',$ci->user->id_empresa)
													->where('centro_de_costos',$ci->user->centro_de_costos)
													->where('user_id',$user_id)
													->where('type',$type)
													->get()
													->row();
		//pre($row);return;
		if(!empty($row)){
			$insert_id	=	(int)$row->consecutivo	+  1;
		}else{
			$insert_id	=	1;
		}
		$insert		=	array(	"empresa_id"=>$ci->user->id_empresa,
								"centro_de_costos" => $ci->user->centro_de_costos,
								"user_id" => $user_id,
								"consecutivo"=>$insert_id,
								"type"=>$type);
		if(!empty($row)){								
			$ci->db->where('id', $row->id);
			$ci->db->update($tabla,$insert);
		}else{
			$ci->db->insert($tabla,$insert);
		}
		return $insert_id;
	}
	
	function incrementa_consecutivo($empresa_id,$type){
		$ci 	=& 	get_instance();
		$tabla	=	DB_PREFIJO."sys_consecutivo";
		$row	=	$ci->db->select("id,consecutivo")->from($tabla)
													->where('empresa_id',$empresa_id)
													->where('type',$type)
													->get()
													->row();
		//pre($row);return;
		if(!empty($row)){
			$insert_id	=	(int)$row->consecutivo	+  1;
		}else{
			$insert_id	=	1;
		}
		$insert		=	array(	"empresa_id"=>$empresa_id,
								"consecutivo"=>$insert_id,
								"type"=>$type);
		if(!empty($row)){								
			$ci->db->where('id', $row->id);
			$ci->db->update($tabla,$insert);
		}else{
			$ci->db->insert($tabla,$insert);
		}
		return $insert_id;
	}
	
	function detect_Sucursal($user){
		if(empty($user)){
			redirect(base_url("autenticacion/salir"));	exit;
		}
		if(empty($user->centro_de_costos) || $user->centro_de_costos==0){
			redirect(base_url("Main/Error_NoSucursal"));	exit;
		}
	}
	
	function  search_cuenta_bancaria($entidad_bancaria,$nro_cuenta){
		$ci 	=& 	get_instance();
		$tabla	=	DB_PREFIJO."fi_cuentas";
		return $ci->db->select("id_cuenta")
							->from($tabla)
							->where('entidad_bancaria',$entidad_bancaria)
							->like('nro_cuenta',$nro_cuenta)
							->get()
							->row();
	}
	
	function get_codigo_contable($codigo_contable){
		$ci 	=& 	get_instance();
		$tabla	=	DB_PREFIJO."sys_contabilidad";
		if($return = $ci->db->select("codigo,cuenta_contable")->from($tabla)->where('codigo',$codigo_contable)->get()->row()){
			return $return;
		}else{
			$return 					=	new stdClass;
			$return->codigo				=	$codigo_contable;
			$return->cuenta_contable	=	"No Disponible (<b>".$codigo_contable."</b>)";
			return $return;
		}
	}
	
	function get_monto_codigo_contable_x_factura($nro_documento){
		$ci 	=& 	get_instance();
		$tabla	=	DB_PREFIJO."rp_operaciones";
		return $ci->db->select("SUM(credito) as credito")->from($tabla)->where('nro_documento',$nro_documento)->where('codigo_contable',"130510")->where('estatus',"1")->get()->row();		 		
	}
	
	function get_contable_x_factura($nro_documento){
		$ci 	=& 	get_instance();
		$tabla	=	DB_PREFIJO."rp_operaciones";
		return $ci->db->select("SUM(credito) as credito")->from($tabla)->where('nro_documento',$nro_documento)->where('codigo_contable',"130510")->get()->row();		 		
	}
	
	function lunes($prioridad){
		/*PRIORIDAD DEBE SER LA CANTIDAD DE DÍAS SEGÚN PRIORIDAD*/
		$daynum = date("N", strtotime("monday"));
		if($daynum<2){
			$desde	=	calculo_fechas(date("Y-m-d"),'+'.$daynum);
			$hasta	=	calculo_fechas($desde,'+'.$prioridad);
		}else{
			$desde	=	date("Y-m-d");
			$hasta	=	calculo_fechas($desde,'+'.$prioridad);
		}
		return array("fecha_desde"=>$desde,"fecha_hasta"=>$hasta);
	}
	
	function makeReporteDiario($name,$estado=null,$extra=null,$me=false){
		
		$ayer	=	calculo_fechas(date("Y-m-d"),'-1');
		$hoy	=	date("Y-m-d");
		$options=	array(	$ayer=>"Ayer (".$ayer.")",
							$hoy=>"Hoy (".$hoy.")",
							);
		
		if($me){
			$hora_entero	=	(int)date("H");
			if($me->turno_noche==0){
				unset($options[$ayer]);
				$extra["disabled"]=true;
			}else if($me->turno_noche==1 && $hora_entero>8){
				unset($options[$ayer]);
				$extra["disabled"]=true;
			}
		}
		
		//echo date("H");
							
		foreach($options as $k=> $v){
			$ci 	=& 	get_instance();
			$tabla	=	DB_PREFIJO."rp_diario";
			$row	=	$ci->db	->select("reporte_diario_id")
								->from($tabla)
								->where('id_empresa',$ci->user->id_empresa)
								->where('id_modelo',$ci->user->user_id)
								->where('fecha',$k)
								->where('estado !=',9)
								->get()
								->row();
			if(empty($row)){					
				$option[$k] = $v;	
			}
		}
		$input = '<input id="validar" type="hidden" value="1">';
		if(empty($option)){
			$option[''] = "No hay fechas para reportar";
			$input = '<input id="validar" type="hidden" value="0">';
		}
		return form_dropdown($name, $option, $estado,$extra).$input;
	}
	
	function calculo_fechas($fecha_desde,$cantidad_dias='+5'){
		$fecha=$fecha_desde;
		$nuevafecha=strtotime ( $cantidad_dias.' day' , strtotime ( $fecha ) ) ;
		$nuevafecha=date( 'Y-m-d' , $nuevafecha );
		return $nuevafecha;	
	}
	
	function calculo_meses($fecha_desde,$cantidad_meses='+5',$view='Y-m-d'){
		$fecha		=	$fecha_desde;
		$nuevafecha	=	strtotime ( $cantidad_meses.' month' , strtotime ( $fecha ) ) ;
		$nuevafecha	=	date( $view , $nuevafecha );
		return $nuevafecha;	
	}
	
	function submenu($title,$title2,$size='md'){
		$ci 	=& 	get_instance(); 
		$back	=	$ci->uri->segment(3) - 1;
		$next	=	$ci->uri->segment(3) + 1;
		$back_btn='';
		if($back){
			$back_btn	=	'<a class="nav-link" href="'.site_url($ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$back).'">
								<i class="fas fa-caret-square-left"></i>
							</a>';
		}
		$next_btn		=	'<a class="nav-link" href="'.site_url($ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$next).'">
								<i class="fas fa-caret-square-right"></i>
							</a>';
		
		
		
		$html	=	'<nav class="navbar navbar-toggleable-'.$size.' navbar-light bg-faded nav-short p-2">
						<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<a class="navbar-brand">
							<h4 class="font-weight-700 text-uppercase orange">
                    			'.$title.'
							</h4>
						</a>
						<div class="collapse navbar-collapse" id="navbarNavDropdown">
							<div class="btn-group  ml-auto" role="group" aria-label="Small button group">
								<a class="nav-link lightbox" data-type="iframe" title="'.$title2.'" href="'.site_url($ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$ci->uri->segment(3).'/recibir').'" >
									<i class="fas fa-inbox"></i>
								</a>
								<a class="nav-link" title="'.$title2.'" href="'.site_url($ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$ci->uri->segment(3).'/imprimir').'">
									<i class="fas fa-print"></i>
								</a>
								<a class="nav-link" title="Anular Factura" data-title="Deseas anular esta factura?" data-message="Para continual pulsa aceptar." href="'.site_url($ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$ci->uri->segment(3).'/anular/'.$ci->uri->segment(5)).'">
									<i class="fas fa-ban"></i>
								</a>
								<a class="nav-link " target="_blank" href="'.site_url($ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$ci->uri->segment(3).'/PDF/'.$ci->uri->segment(5)).'">
									<i class="fas fa-file-pdf"></i>
								</a>
								<a class="nav-link " href="'.site_url($ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$ci->uri->segment(3).'/Correo').'">
									<i class="far fa-envelope"></i>
								</a>
								'.$back_btn.'
								'.$next_btn.'
							</div>
						</div>
					</nav>';	
			return $html;					
	}
	
	function submenuOLD($title,$title2,$size='md'){
		$ci 	=& 	get_instance(); 
		$html	=	'<nav class="navbar navbar-toggleable-'.$size.' navbar-light bg-faded">
						<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<a class="navbar-brand">
							<h4 class="font-weight-700 text-uppercase orange">
                    			'.$title.'
							</h4>
						</a>
						<div class="collapse navbar-collapse" id="navbarNavDropdown">
							<ul class="navbar-nav ml-auto">
								<li class="nav-item active recibir">
									<a class="nav-link lightbox"  data-type="iframe" title="'.$title2.'" href="'.site_url($ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$ci->uri->segment(3).'/recibir').'">Recibir <span class="sr-only">(current)</span></a>
								</li>
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Opciones
									</a>
									<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
										<a class="dropdown-item" href="'.site_url($ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$ci->uri->segment(3).'/imprimir').'">Imprimir</a>
										<a class="dropdown-item"  data-title="Deseas anular esta factura?" data-message="Para continual pulsa aceptar." href="'.site_url($ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$ci->uri->segment(3).'/anular/'.$ci->uri->segment(5)).'">Anular</a>
										<a class="dropdown-item" target="_blank" href="'.site_url($ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$ci->uri->segment(3).'/PDF/'.$ci->uri->segment(5)).'">PDF</a>
										<a class="dropdown-item" href="'.site_url($ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$ci->uri->segment(3).'/Correo').'">Correo</a>
									</div>
								</li>
							</ul>
						</div>
					</nav>';	
			return $html;					
	}
	
	function CountCuotasDescuentos($descuento_id){
		$ci 	=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."rp_descuentos_pagos";
		return $ci->db->select("MAX(nro_cuota) as total,Pendiente")->from($tabla)->where('descuento_id',$descuento_id)->where('estatus',1)->get()->row();
	}
	
	function Descuentos($user_id){
		$ci 	=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."rp_descuentos t1";
		return $ci->db->select("t1.*,t2.*")
						->from($tabla)
						->join(DB_PREFIJO."rp_operaciones t2", 't1.descuento_id=t2.nro_documento', 'left')
						->where('t1.user_id',$user_id)	
						->where('t2.tipo_documento',12)
						->where('t2.estatus',1)	
						->group_by(array("descuento_id"))
						->get()
						->result();
	}
	
	function TotalOtrosIngresos($user_id){
		$ci 	=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."rp_otros_ingresos";
		return $ci->db->select("SUM(valor) as valor")->from($tabla)->where('user_id',$user_id)->where('estado',1)->get()->row();
	}
	
	/*function OtrosIngresos($user_id){
		$ci 	=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."rp_otros_ingresos";
		return $ci->db->select("*")->from($tabla)->where('user_id',$user_id)->where('estado',1)->get()->result();
	}*/

	function OtrosIngresos($user_id,$ciclo = null){
		$ci = get_instance();
		$tabla				=		DB_PREFIJO."rp_operaciones t1" ;
		$ci->db->select("t1.*");
		$ci->db->from($tabla);
		$ci->db->join(DB_PREFIJO."usuarios t2", 't1.modelo_id 	= 	t2.user_id', 'left');
		//$ci->db->where_in('t2.type',array('Asociados', 'Proveedores', 'Modelos'));
		$ci->db->where('t1.estatus',1);
		$ci->db->where('t1.tipo_documento',31);
		$ci->db->where("t1.empresa_id",$ci->user->id_empresa);
		$ci->db->where("t1.modelo_id",$user_id);
		if(!empty($ciclo)){
			$ci->db->where("t1.ciclo_produccion_id",$ciclo);
		}
		$ci->db->group_by(array("t1.consecutivo"));
		$query			=	$ci->db->get();
		$result 	=	$query->result();
		return $result;
	}
	
	function conversion_token_standar($cantidad,$equivalencia){
		return	$cantidad / 0.05;
		return ($cantidad * str_replace(",",".",$equivalencia)) / 0.05 ;
		
	}
	
	function contar_dias($fecha_ayer){
		$datetime1 	= 	new DateTime($fecha_ayer);
		$datetime2 	= 	new DateTime(date("Y-m-d"));
		$interval 	= 	$datetime1->diff($datetime2);
		echo $interval->format('%R%a días');	
	}
	
	function contar_dias_entre_fecha_x_prioridad($fecha_hasta,$mostrar_prioridad=true){
		$datetime1 	= 	new DateTime(date("Y-m-d"));
		$datetime2 	= 	new DateTime($fecha_hasta);
		$interval 	= 	$datetime1->diff($datetime2);
		if($mostrar_prioridad){
			$prioridades	=	array(1=>"Alta",4=>"Moderada",7=>"Baja");	
			if($interval->format('%a')<=1){
				return $prioridades[1];	
			}else if($interval->format('%a')>1 && $interval->format('%a')<=4){
				return $prioridades[4];
			}else if($interval->format('%a')>4 && $interval->format('%a')<=7){
				return $prioridades[7];
			}
			//echo $interval->format('%a');			
		}else{
			return $interval->format('%a');
		}	
	}
	
	function calcular_bonificacion($meta,$totalP,$factor_bonificacion,$trm){
		if($meta<=$totalP){
			$diferencia		=	$totalP - $meta;
			return $diferencia * $factor_bonificacion * $trm;
		}else{
			return 0;
		}
	}

	function predateoFactorBonificacion($meta,$diastrabajados){
		return $meta/15*$diastrabajados;	
	}
	
	function get_diario($user_id,$nickname_id,$desde=false , $hasta=false){
		$ci 	=& 	get_instance();
		$tabla				=		DB_PREFIJO."rp_diario t1";
		$ci->db->select("sum(monto) as monto");
		$ci->db->from($tabla);
		$ci->db->where("t1.id_empresa",$ci->user->id_empresa);
		$ci->db->where("t1.id_modelo",$user_id);
		$ci->db->where("t1.nickname_id",$nickname_id);
		$ci->db->where("t1.estado",1);
		if($ci->user->principal<>1){
			$ci->db->where('t1.centro_de_costos', $ci->user->centro_de_costos);
		}
		//$ci->db->where('t1.id_modelo', $ci->user->user_id);
		if($desde && $hasta){
			$ci->db->where('t1.fecha BETWEEN "'. date('Y-m-d', strtotime($desde)). '" AND "'. date('Y-m-d', strtotime($hasta)).'"');
		}
		$ci->db->group_by(array("fecha"));
		$ci->db->order_by('t1.fecha','DESC');
		$query						=	$ci->db->get();
		return $query->row();
	}
	
	function miles_k($monto){
		if($monto>1000){
			return ($monto/1000) . 'k';	
		}else{
			return $monto;
		}
	}
	
	function get_reporte_quincenal($user_id,$nickname_id,$desde=false , $hasta=false){
		$ci 	=& 	get_instance();
		$tabla				=		DB_PREFIJO."rp_diario t1";
		$ci->db->select("monto,tokens,total,fecha,DATE_FORMAT(fecha, '%d') as dia ");
		$ci->db->from($tabla);
		$ci->db->where("t1.id_empresa",$ci->user->id_empresa);
		$ci->db->where("t1.id_modelo",$user_id);
		$ci->db->where("t1.nickname_id",$nickname_id);
		if($ci->user->principal<>1){
			$ci->db->where('t1.centro_de_costos', $ci->user->centro_de_costos);
		}
		if($desde && $hasta){
			$ci->db->where('t1.fecha BETWEEN "'. date('Y-m-d', strtotime($desde)). '" AND "'. date('Y-m-d', strtotime($hasta)).'"');
		}
		$ci->db->group_by(array("fecha"));
		$ci->db->order_by('t1.fecha','ASC');
		$query						=	$ci->db->get();
		$return		=	array();
		foreach($query->result() as $v){
			$return[$v->dia]	=	$v;
		}
		return $return;
	}
	
	function get_reporte_quincenal_x_modelo($id_modelo,$id_plataforma,$desde=false , $hasta=false){
		$ci 	=& 	get_instance();
		$tabla				=		DB_PREFIJO."rp_diario t1";
		$ci->db->select("monto,tokens,total,fecha,DATE_FORMAT(fecha, '%d') as dia ");
		$ci->db->from($tabla);
		$ci->db->where("t1.id_empresa",$ci->user->id_empresa);
		$ci->db->where("t1.id_modelo",$id_modelo);
		$ci->db->where("t1.id_plataforma",$id_plataforma);
		if($desde && $hasta){
			$ci->db->where('t1.fecha BETWEEN "'. date('Y-m-d', strtotime($desde)). '" AND "'. date('Y-m-d', strtotime($hasta)).'"');
		}
		$ci->db->group_by(array("fecha"));
		$ci->db->order_by('t1.fecha','ASC');
		$query						=	$ci->db->get();
		$return		=	array();
		foreach($query->result() as $v){
			$return[$v->dia]	=	$v;
		}
		return $return;
	}
	
	function porcentaje_contable_x_modelo($tokens,$trm,$equivalencia,$dctoDolar,$bonificacion){
		$trm_constantef1	=	$trm 	* 	1;
		$formula1			=	$tokens * 	$equivalencia * $trm_constantef1;
		$trm_constantef2	=	$trm 	* 	((1 - ($dctoDolar/100))) * ($bonificacion / 100);
		$formula2			=	$tokens * 	$equivalencia * $trm_constantef2;
		$formula3			=	$formula2 / $formula1;
		//pre($formula3);
		return $formula3;
	}
	
	function registro_contable($var){
		$ci 	=& 	get_instance();
		$tabla	=	DB_PREFIJO."rp_operaciones"; 
		if($ci->db->insert($tabla,$var)){
			return true;
		}else{
			return false;	
		}
	}

	function insertar_descuentos_pagos($var){
		$ci 	=& 	get_instance();
		$tabla	=	DB_PREFIJO."rp_descuentos_pagos"; 
		if($ci->db->insert($tabla,$var)){
			return true;
		}else{
			return false;	
		}
	}
	
	function get_registro_contable_credito_debito($nro_documento,$credito_debito='credito',$procesador_id=NULL,$codigo_contable=NULL,$tipo_documento=NULL){
		if($procesador_id!=NULL){
			$procesador_id = "AND t1.procesador_id = '".$procesador_id."'";
		}else{
			$procesador_id='';	
		}
		if($codigo_contable!=NULL){
			$codigo_contable = "AND t1.codigo_contable = '".$codigo_contable."'";
		}else{
			$codigo_contable='';	
		}
		if($tipo_documento!=NULL){
			$tipo_documento = "AND t1.tipo_documento = '".$tipo_documento."'";
		}else{
			$tipo_documento='';	
		}
		
		$ci 	=& 	get_instance();
		$tabla	=	DB_PREFIJO."rp_operaciones t1"; 
		$sql					=	"	SELECT  SUM(t1.$credito_debito) as $credito_debito
											FROM ".$tabla."
												LEFT JOIN ".DB_PREFIJO."sys_contabilidad t2 ON t1.codigo_contable=t2.codigo 
											 	WHERE t1.empresa_id = '".$ci->user->id_empresa."'
													AND t1.nro_documento = '".$nro_documento."'
														$procesador_id
															$codigo_contable
																$tipo_documento
																	ORDER BY t1.id";		
		$query 						= 	$ci->db->query($sql);
		return	$query->row()->$credito_debito;
	}
	
	function get_registro_contable_honorarios($consecutivo){
		$tabla	=	DB_PREFIJO."rp_operaciones t1";
		$ci 	=& 	get_instance();	
		$ci->db->select("t1.codigo_contable,
						SUM(t1.debito) as debito,
						SUM(t1.credito) as credito,t2.*")
			->from($tabla)
			->join(DB_PREFIJO."sys_contabilidad t2",'t1.codigo_contable=t2.codigo','left')
			->where("t1.consecutivo",$consecutivo)
			->where("t1.tipo_documento",1)
			->group_by('t1.codigo_contable','ASC')
			->order_by('codigo_contable','DESC');
		return $ci->db->get()->result();		
	}
	
	
	function getMovimientosDescuentos($consecutivo){
		$tabla	=	DB_PREFIJO."rp_operaciones t1";
		$ci 	=& 	get_instance();	
		$ci->db->select("t1.codigo_contable,
						SUM(t1.debito) as debito,
						SUM(t1.credito) as credito,t2.*")
			->from($tabla)
			->join(DB_PREFIJO."sys_contabilidad t2",'t1.codigo_contable=t2.codigo','left')
			->where("t1.nro_documento",$consecutivo)
			->where("t1.tipo_documento",12)
			->group_by(array('t1.codigo_contable','t1.nro_documento'))
			->order_by('codigo_contable','DESC');
		return $ci->db->get()->result();		
	}
	
	function get_registro_contable_honorarios_new($modelo_id,$consecutivo){
		$tabla	=	DB_PREFIJO."rp_operaciones t1";
		$ci 	=& 	get_instance();	
		$ci->db->select("t1.codigo_contable,
						t1.tipo_documento,
						t1.debito as debito,
						t1.credito as credito,t2.*")
			->from($tabla)
			->join(DB_PREFIJO."sys_contabilidad t2",'t1.codigo_contable=t2.codigo','left')
			->where("t1.modelo_id",$modelo_id)
			->where("t1.consecutivo",$consecutivo)			
			->where_in("t1.tipo_documento",array(13,14,31));
			//->group_by('t1.codigo_contable','ASC')
			$ci->db->order_by('t1.debito','ASC');
		return $ci->db->get()->result();		
	}
	
	function get_registro_contable_new($consecutivo){
		$tabla	=	DB_PREFIJO."rp_operaciones t1";
		$ci 	=& 	get_instance();	
		$ci->db->select("t1.codigo_contable,
						SUM(t1.debito) as debito,
						SUM(t1.credito) as credito,t2.*,t3.moneda_de_pago")
			->from($tabla)
			->join(DB_PREFIJO."sys_contabilidad t2",'t1.codigo_contable=t2.codigo','left')
			->join(DB_PREFIJO."usuarios t3",'t1.plataforma_id=t3.user_id','left')
			->where("t1.empresa_id",$ci->user->id_empresa)
			->where("t1.consecutivo",$consecutivo)
			->where("t1.tipo_documento",1)
			->group_by('t1.codigo_contable','ASC')
			->order_by('codigo_contable','DESC');
		return $ci->db->get()->result();		
	}
	
	function get_registro_contable($nro_documento,$pref_nro_documento='NOA',$incluir=NULL,$excluir=NULL,$group='t1.codigo_contable,t1.tipo_documento'){
		$ext	=	'';
		if($group!=NULL){
			$group	=	" GROUP BY $group " ;
		}
		$ext	=	'';
		if($incluir!=NULL){
			$ext	=	' AND tipo_documento IN ('.$incluir.') ';
		}
		
		if($excluir!=NULL){
			$ext	=	' AND codigo_contable NOT IN ('.$excluir.') ';
		}
		
		$ci 	=& 	get_instance();
		$tabla	=	DB_PREFIJO."rp_operaciones t1"; 
		$sql					=	"	SELECT 	t1.id,
												SUM(t1.credito) AS credito,
												SUM(t1.debito) AS debito,
												codigo_contable,
												fecha,
												consecutivo,
												tipo_documento,
												cuenta_contable
											FROM ".$tabla."
												LEFT JOIN ".DB_PREFIJO."sys_contabilidad t2 ON t1.codigo_contable=t2.codigo 
											 	WHERE t1.empresa_id = '".$ci->user->id_empresa."'
													AND t1.pref_nro_documento = '".$pref_nro_documento."'
														AND t1.nro_documento = '".$nro_documento."'
															AND t1.estatus = '1'
																$ext
																	$group
																		ORDER BY t1.id";		
		$query 						= 	$ci->db->query($sql);
		return	$query->result();
	}
	
	function centro_de_costos(){
		$ci 	=& 	get_instance(); 
		if(!@$ci->user->id_empresa){
			echo '<h3 class="text-center">Seleccione una Sucursal</h3>';
			return false;
		}else{
			return true;
		}	
	}
	
	function rol($row){
		$ci 	=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."sys_roles";
		return $ci->db->select("rol")->from($tabla)->where('rol_id',$row->rol_id)->get()->row();
	}
	
	function master($row, $estado = null,$extra=array("class"=>"form-control")){
		if(empty($row)){
			$row=new stdClass();		
			$row->entidad_bancaria='';
		}
		$ci 	=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."cf_rel_master";
		$rows	=	$ci->db->select("*")->from($tabla)->where("id_empresa",$ci->user->id_empresa)->where('id_plataforma',@$row->id_plataforma)->get()->result();
		$actual	=	$ci->db->select("*")->from($tabla)->where("id_empresa",$ci->user->id_empresa)->where('rel_plataforma_id',@$row->id_master)->get()->row();
		
		$html	=	'';
		$html	.=	'	<input type="text" class="form-control validar" id="id_master" placeholder="Master" maxlength="200" value="'.@$actual->nombre_master.'"/>';		
		$html	.=	'	<input type="hidden" name="id_master"  id="id_master_oculto"  value="'.$row->id_master.'"/>';		
		$html	.= 	'	<script>
							$(function(){
								var projects = [';
									foreach($rows as $k => $v){
										$html	.= 	'{
														value: "'.$v->rel_plataforma_id.'",
														label: "'.$v->nombre_master.'"
													},';
									}
								 
		$html	.= 	'			];
								$( "#id_master" ).autocomplete({
									minLength: 0,
									source: projects,
									focus: function( event, ui ) {
										$( "#id_master_oculto" ).val( ui.item.value );
										$( "#id_master" ).val( ui.item.label );
											return false;
									},
									select: function( event, ui ) {
										$( "#id_master_oculto" ).val( ui.item.value );
										$( "#id_master" ).val( ui.item.label );
										return false;
									}
								});
							});
						</script>
					';
		return $html;	
	}
	
	function get_modelo($user_id){
		$ci 	=& 	get_instance();
		$tabla	=	DB_PREFIJO."usuarios";
		return $ci->db->select("*")->from($tabla)->where('type',"Modelos")->where('user_id',$user_id)->get()->row();	
	}
	
	function modelo($row, $estado = null,$extra=array("class"=>"form-control","name"=>"id_modelo","placeholder"=>"Tercero")){
		if(empty($row)){
			$row=new stdClass();		
			$row->entidad_bancaria='';
		}
		$ci 	=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."usuarios";
		$rows	=	$ci->db->select("*")->from($tabla)->where('id_empresa',$ci->user->id_empresa)->where('type',"Modelos")->where('estado',1)->order_by('primer_nombre','ASC')->get()->result();
		$actual	=	$ci->db->select("*")->from($tabla)->where('user_id',@$row->user_id)->get()->row();
		$html	=	'';
		$nombre_set		=	(@$actual->primer_nombre!='' || @$actual->primer_apellido!='')?@$actual->primer_nombre.' '.@$actual->primer_apellido:'';
		$html	.=	'<input type="text" class="form-control validar" id="id_modelo" require placeholder="'.$extra['placeholder'].'" maxlength="200" value="'.$nombre_set.'"/>';		
		if(empty($extra["name"])){
			$extra["name"]	=	'id_modelo';
		}
		$html	.=	'	<input type="hidden" name="'.$extra["name"].'"  id="id_modelo_oculto"  value="'.@$row->id_modelo.'"/>';
		$html	.=	'	<input type="hidden" name="centro_de_costos"  id="centro_de_costos"  value="'.@$row->centro_de_costos.'"/>';		
		$html	.= 	'	<script>
							$(function(){
								var projects = [';
									foreach($rows as $k => $v){
										$html	.= 	'{
														centro_de_costos: "'.$v->centro_de_costos.'",
														value: "'.$v->user_id.'",
														label: "'.$v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido.'"
													},';
									}
								 
		$html	.= 	'			];
								$( "#id_modelo" ).autocomplete({
									minLength: 0,
									source: projects,
									focus: function( event, ui ) {
										$( "#centro_de_costos" ).val( ui.item.centro_de_costos );
										$( "#id_modelo_oculto" ).val( ui.item.value );
										$( "#id_modelo" ).val( ui.item.label );
											return false;
									},
									select: function( event, ui ) {
										$( "#centro_de_costos" ).val( ui.item.centro_de_costos );
										$( "#id_modelo_oculto" ).val( ui.item.value );
										$( "#id_modelo" ).val( ui.item.label );
										return false;
									}
								});
							});
						</script>
					';
		return $html;	
	}
	
	function gastos($row, $estado = null,$extra=array("class"=>"form-control","name"=>"gastos_id")){
		if(empty($row)){
			$row=new stdClass();		
			$row->gastos_id='';
		}
		
		$ci 	=& 	get_instance(); 
		$tabla	=		DB_PREFIJO."cont_gastos_operacionales";
		$rows	=	$ci->db->select("*")->from($tabla)->order_by('descripcion','ASC')->get()->result();
		
		$html	=	'';
		$html	.=	'	<input type="text" class="form-control" id="id_modelo"  placeholder="Gasto" maxlength="200" value="'.@$row->descripcion.'"/>';		
		if(empty($extra["name"])){
			$extra["name"]	=	'id_modelo';
		}
		$html	.=	'	<input type="hidden" name="'.$extra["name"].'"  id="get_concepto_gastos"  value="'.@$row->get_concepto_gastos.'"/>';		
		$html	.= 	'	<script>
							$(function(){
								var projects = [';
									foreach($rows as $k => $v){
										$html	.= 	'{
														value: "'.$v->gastos_id.'",
														label: "'.$v->descripcion.'"
													},';
									}
								 
		$html	.= 	'			];
								$( "#id_modelo" ).autocomplete({
									minLength: 0,
									source: projects,
									focus: function( event, ui ) {
										$( "#get_concepto_gastos" ).val( ui.item.value );
										$( "#id_modelo" ).val( ui.item.label );
											return false;
									},
									select: function( event, ui ) {
										$( "#get_concepto_gastos" ).val( ui.item.value );
										$( "#id_modelo" ).val( ui.item.label );
										return false;
									}
								});
							});
						</script>
					';
		return $html;	
	}
	
	function bancos($row, $estado = null,$extra=array("class"=>"form-control"),$name='entidad_bancaria'){
		if(empty($row)){
			$row=new stdClass();		
			$row->entidad_bancaria='';
		}
		$ci 	=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."sys_bancos t1";
		$rows	=	$ci->db->select("*")->from($tabla)->join(DB_PREFIJO."fi_cuentas t2", 't1.banco_id	= t2.entidad_bancaria', 'left')->group_by("t1.banco_id")->order_by('Entidad','ASC')->get()->result();
		$html	=	'';
		$html	.=	'	<input type="text" class="form-control" id="content_entidad_bancaria"  placeholder="Entidad Bancaria" maxlength="200"  value="'.@entidadbancaria($row->entidad_bancaria).'"  />';		
		if($name!='entidad_bancaria'){
			$html	.=	'	<input type="hidden" name="'.$name.'"  id="'.$name.'"  value="'.$row->entidad_bancaria.'" />';		
		}else{
			$html	.=	'	<input type="hidden" name="'.$name.'"  id="'.$name.'" value="'.$row->entidad_bancaria.'" />';
		}
		$html	.= 	'	<script>
							$(function(){
								var projects = [';
									foreach($rows as $k => $v){
										$html	.= 	'{
														value: "'.$v->banco_id.'",
														label: "'.$v->Entidad.'"
													},';
									}
								 
		$html	.= 	'			];
								$( "#content_entidad_bancaria" ).autocomplete({
									minLength: 0,
									source: projects,
									focus: function( event, ui ) {
										$( "#content_entidad_bancaria" ).val( ui.item.label );
										$( "#'.$name.'" ).val( ui.item.value );
											return false;
									},
									select: function( event, ui ) {
										$( "#content_entidad_bancaria" ).val( ui.item.label );
										$( "#content_entidad_bancaria" ).keyup(function(){
											$(this).val(ui.item.label);
										});
										$( "#'.$name.'" ).val( ui.item.value );

										return false;
									}
								});
							});
						</script>
					';
		return $html;	
	}
	
	function get_paginas_webcam($cliente_id){
		$ci 	=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."sys_paginas_webcam";
		return $ci->db->select("*")
						->from($tabla)
						->where('cliente_id',$cliente_id)
						->get()->row();
	}
	
	function Autocpmlete_CuentasBancarias2($row, $estado = null,$name='procesador_id',$tipo_cuenta="Crédito prepagada"){
		if(empty($row)){
			$row=new stdClass();		
			$row->entidad_bancaria='';
		}
		$ci 	=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."fi_cuentas t1" ;
		/*
		$rows	=	$ci->db->select("CONCAT(t2.Entidad,'(',nro_cuenta,')') as entidad_bancaria,t1.id_cuenta")
							->from($tabla)
							->join(DB_PREFIJO."sys_bancos t2", 't1.entidad_bancaria 	= 	t2.banco_id', 'left')
							->where('estado',"1")
							->where('tipo_cuenta',$tipo_cuenta)
							->where('id_empresa',$ci->user->id_empresa)
							->order_by('entidad_bancaria','ASC')->get()->result();*/
		
	
		$rows	=	$ci->db->select("CONCAT(t2.Entidad,'(',nro_cuenta,')') as entidad_bancaria,t1.id_cuenta")
							->from($tabla)
							->join(DB_PREFIJO."sys_bancos t2", 't1.entidad_bancaria 	= 	t2.banco_id', 'left')
							->where('estado',1)
							->where('tipo_monedas', "USD")
							->where('id_empresa',$ci->user->id_empresa)
							->order_by('entidad_bancaria','ASC')->get()->result();					

		$array_js	=	array();
							
		$html	=	'<select class="form-control" name="'.$name.'" id="'.$name.'">';
			$html	.=	'<option value="0" data-monto="0">Seleccione</option>';
			foreach($rows as $k	=> $v){
				$monto_item = operaciones_bancos_prueba($v->id_cuenta);
				if($monto_item>0 || $monto_item>0){
					$html	.=	'<option value="'.$v->id_cuenta.'" data-monto="'.$monto_item.'">'.$v->entidad_bancaria.'</option>';
				}
			}
		$html	.=	'</select>';	
		echo $html;
		return;					
	}

	function Autocpmlete_CuentasBancarias($row, $estado = null,$extra=array("class"=>"form-control"),$subfuncion='',$name='id_cuenta',$moneda){
		
		if(empty($row)){
			$row=new stdClass();		
			$row->entidad_bancaria='';
		} 
		$rows = ResumenBancosNew($moneda);
		$html	=	'';
		$html	.=	'	<input type="text" data-funcion="'.$subfuncion.'" class="form-control" id="id_cuenta_TEXT'.$name.'"  placeholder="Cuenta Bancaria" maxlength="200" value="'.@$row->entidad_bancaria.'" require   />';
		$html	.=	'	<input type="hidden" name="'.$name.'" id="'.$name.'"  require   />';		
		$html	.= 	'	<script>
							$(function(){
								var projects = [';
									foreach($rows as $k => $v){
										$html	.= 	'{
														value: "'.$v->id_cuenta.'-'.$v->codigo_contable.'",
														label: "'.entidadbancaria($v->entidad_bancaria).'('.$v->nro_cuenta.')"
													},';
									}
								 
		$html	.= 	'			];
								$( "#id_cuenta_TEXT'.$name.'" ).autocomplete({
									minLength: 0,
									source: projects,
									focus: function( event, ui ) {
										$( "#id_cuenta_TEXT'.$name.'" ).val( ui.item.label );
										$( "#'.$name.'" ).val( ui.item.value );
										return false;
									},
									select: function( event, ui ) {
										$( "#id_cuenta_TEXT'.$name.'" ).val( ui.item.label ).attr("readonly","readonly");
										$( "#'.$name.'" ).val( ui.item.value );
										banco = true;
										return false;
									}
								});
							});
						</script>
					';
		return $html;	
	}

	function Autocomlete_Usuarios($row,$type = array("Modelos","Monitores","Administrativos"),$centrodecostos = '',$extra=array("class"=>"form-control"),$name='user_id'){
		
		if(empty($row)){
			$row=new stdClass();		
			$row->primer_nombre='';
		}
		$ci 	=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."usuarios" ;
		$ci->db->select("user_id,primer_nombre,segundo_nombre,primer_apellido,segundo_apellido,centro_de_costos");
							$ci->db->from($tabla);
							$ci->db->where('estado',"1");
							$ci->db->where_in('type',$type);
							$ci->db->where('id_empresa',$ci->user->id_empresa);
							if($centrodecostos != ''){
								$ci->db->where('centro_de_costos',$centrodecostos);
							}
							$ci->db->order_by('primer_nombre','ASC');
							$rows	=	$ci->db->get()->result();
		$html	=	'';
		$html	.=	'	<input type="text" class="form-control" id="Usuarios_'.$name.'" placeholder="Nombre Completo" maxlength="200" require="require" ';
		if(!empty($row->$name)){ $html .= 'value = "'.@nombre(centrodecostos($row->$name)).'"';}
		$html	.=	'/><input type="hidden" name="'.$name.'" id="'.$name.'"  require="require" value = "'.@$row->$name.'"  />';
		if($name == 'user_id'){
			$html	.=	'	<input type="hidden" name="centro_de_costos" id="centro_de_costos"  require="require"   />';
		}		
		$html	.= 	'	<script>
							$(function(){
								var projects = [';
									foreach($rows as $k => $v){
										$html	.= 	'{
														value: "'.$v->user_id.'",
														label: "'.$v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido.'",
														centro_de_costos:"'.$v->centro_de_costos.'",
													},';
									}
								 
		$html	.= 	'			];
								$( "#Usuarios_'.$name.'" ).autocomplete({
									minLength: 0,
									source: projects,
									focus: function( event, ui ) {
										$( "#Usuarios_'.$name.'" ).val( ui.item.label );
										$( "#'.$name.'" ).val( ui.item.value );
										$( "#centro_de_costos" ).val( ui.item.centro_de_costos );
										return false;
									},
									select: function( event, ui ) {
										$( "#Usuarios_'.$name.'" ).val( ui.item.label );
										$( "#'.$name.'" ).val( ui.item.value );
										$( "#centro_de_costos" ).val( ui.item.centro_de_costos );
										return false;
									}
								});
							});
						</script>
					';
		return $html;	
	}
	
	function proveedores($row, $estado = null,$extra=array("class"=>"form-control"),$subfuncion='',$terceros=true){
		if(empty($row)){
			$row=new stdClass();		
			$row->entidad_bancaria='';
		}
		$ci 	=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."usuarios";
		$ci->db->select("*")
							->from($tabla);
							/*->where('type',"Proveedores")*/
					if(empty($terceros)){		
						$ci->db->where_in("type",array("Asociados","Proveedores","Monitores","Administrativos"));
					}else{
						$ci->db->where_in("type",$terceros);
					}
					//$ci->db	->where('primer_nombre!=',"");
					$ci->db	->where('estado',1);
					$ci->db	->where('id_empresa',$ci->user->id_empresa);
		$rows	=	$ci->db	->order_by('primer_nombre','ASC')->get()->result();						
		$html	=	'';
		$html	.=	'	<input type="text" data-funcion="'.$subfuncion.'" class="form-control" name="nombre_legal"  id="nombre_legal"  placeholder="Nombre Legal" maxlength="200" value="'.@$row->nombre_legal.'" require   />';		
		$html	.=	'	<input type="hidden" id="direccion" name="direccion" require="require" />';
		$html	.=	'	<input type="hidden" id="pais" name="pais" require="require" />';
		$html	.=	'	<input type="hidden" id="identificacion_empresa" name="identificacion_empresa" require="require" />';
		$html	.=	'	<input type="hidden" id="cliente_id" name="cliente_id" require="require" />';
		$html	.= 	'	<script>
							$(function(){
								$( "#direccion" ).attr("readonly","readonly");
								$( "#ciudad" ).attr("readonly","readonly");
								$( "#departamento" ).attr("readonly","readonly");
								$( "#pais" ).attr("readonly","readonly");
								$( "#codigo_postal" ).attr("readonly","readonly");
								$( "#Nit" ).attr("readonly","readonly");
								$( "#identificacion_empresa" ).attr("readonly","readonly");
								var projects = [';
									foreach($rows as $k => $v){
										$nombre_legal	=	(!empty($v->nombre_legal))?$v->nombre_legal:$v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido;
										$html	.= 	'{
														value: "'.$nombre_legal.'",
														label: "'.$nombre_legal.'",
														identificacion: "'.$v->identificacion.'",
														direccion: "'.$v->direccion.'",
														Val: "'.$v->nombre_legal.'",
														ciudad: "'.$v->ciudad.'",
														departamento:"'.$v->departamento.'",
														codigo_postal:"'.$v->codigo_postal.'",
														identificacion_empresa:"'.$v->identificacion.'",
														cliente_id:"'.$v->user_id.'",
														pais:"'.$v->pais.'",
													},';
									}
								 
		$html	.= 	'			];
								$( "#nombre_legal" ).autocomplete({
									minLength: 0,
									source: projects,
									focus: function( event, ui ) {
										/*
										var funcion 	=	$(this).data("funcion");
										if(funcion){
											eval(funcion+"()");
										}*/
										$( "#nombre_legal" ).val( ui.item.value );
										$( "#direccion" ).val( ui.item.direccion );
										$( "#contenedor_ciudad" ).val( ui.item.ciudad );
										$( "#ciudad" ).val( ui.item.Ciudad );
										$( "#departamento" ).val( ui.item.departamento );
										$( "#pais" ).val( ui.item.pais );
										$( "#codigo_postal" ).val( ui.item.codigo_postal );
										$( "#identificacion_empresa" ).val( ui.item.identificacion_empresa );
										$( "#cliente_id" ).val( ui.item.cliente_id );
										return false;
									},
									select: function( event, ui ) {
										var funcion 	=	$(this).data("funcion");
										if(funcion){
											eval(funcion+"()");
										}
										$( "#nombre_legal" ).val( ui.item.value );
										$( "#direccion" ).val( ui.item.direccion );
										$( "#contenedor_ciudad" ).val( ui.item.ciudad );
										$( "#ciudad" ).val( ui.item.Ciudad );
										$( "#departamento" ).val( ui.item.departamento );
										$( "#pais" ).val( ui.item.pais );
										$( "#codigo_postal" ).val( ui.item.codigo_postal );
										$( "#identificacion_empresa" ).val( ui.item.identificacion_empresa );
										$( "#cliente_id" ).val( ui.item.cliente_id );
										return false;
									}
								});
							});
						</script>
					';
		return $html;	
	}
	
	function paginas_webcam($row, $estado = null,$extra=array("class"=>"form-control"),$subfuncion=''){
		if(empty($row)){
			$row=new stdClass();		
			$row->entidad_bancaria='';
		}
		$ci 	=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."sys_paginas_webcam t1" ;
		$rows	=	$ci->db->select("*")
							->from($tabla)
							->join(DB_PREFIJO."usuarios t2",'t1.Pagina 	= 	t2.primer_nombre', 'left')
							->join(DB_PREFIJO."cf_rel_plataformas t3",'t2.user_id	= 	t3.id_plataforma', 'left')
							->join(DB_PREFIJO."cf_nickname t4","t2.user_id = t4.id_plataforma","left")
							->where("t4.id_empresa",$ci->user->id_empresa)
							->where("t1.Pagina!=","RSS")
							->where("t4.estado",1)
							->group_by("t1.cliente_id")
							->order_by('t1.Nombre_legal','ASC')->get()->result();
		$html	=	'';
		$html	.=	'	<input type="text" data-funcion="'.$subfuncion.'" class="form-control" name="nombre_legal"  id="nombre_legal"  placeholder="Nombre Legal" maxlength="200" value="'.@$row->nombre_legal.'" require   />';		
		$html	.= 	'	<script>
							$(function(){
								$( "#direccion" ).attr("readonly","readonly");
								$( "#ciudad" ).attr("readonly","readonly");
								$( "#departamento" ).attr("readonly","readonly");
								$( "#pais" ).attr("readonly","readonly");
								$( "#codigo_postal" ).attr("readonly","readonly");
								$( "#Nit" ).attr("readonly","readonly");
								$( "#identificacion_empresa" ).attr("readonly","readonly");
								var projects = [';
									foreach($rows as $k => $v){
										$html	.= 	'{
														value: "'.$v->Nombre_legal.'",
														label: "'.$v->Nombre_legal.'",
														Nit: "'.$v->Nit.'",
														Direccion: "'.$v->Direccion.'",
														Val: "'.$v->Nombre_legal.'",
														Ciudad: "'.$v->Ciudad.'",
														Departamento:"'.$v->Departamento.'",
														Codigo_Postal:"'.$v->Codigo_Postal.'",
														identificacion_empresa:"'.$v->Nit.'",
														Pais:"'.$v->Pais.'",
													},';
									}
								 
		$html	.= 	'			];
								$( "#nombre_legal" ).autocomplete({
									minLength: 0,
									source: projects,
									focus: function( event, ui ) {
										/*
										var funcion 	=	$(this).data("funcion");
										if(funcion){
											eval(funcion+"()");
										}*/
										$( "#nombre_legal" ).val( ui.item.value );
										$( "#direccion" ).val( ui.item.Direccion );
										$( "#contenedor_ciudad" ).val( ui.item.Ciudad );
										$( "#ciudad" ).val( ui.item.Ciudad );
										$( "#departamento" ).val( ui.item.Departamento );
										$( "#pais" ).val( ui.item.Pais );
										$( "#codigo_postal" ).val( ui.item.Codigo_Postal );
										$( "#identificacion_empresa" ).val( ui.item.identificacion_empresa );
										return false;
									},
									select: function( event, ui ) {
										var funcion 	=	$(this).data("funcion");
										if(funcion){
											eval(funcion+"()");
										}
										$( "#nombre_legal" ).val( ui.item.value );
										$( "#direccion" ).val( ui.item.Direccion );
										$( "#contenedor_ciudad" ).val( ui.item.Ciudad );
										$( "#ciudad" ).val( ui.item.Ciudad );
										$( "#departamento" ).val( ui.item.Departamento );
										$( "#pais" ).val( ui.item.Pais );
										$( "#codigo_postal" ).val( ui.item.Codigo_Postal );
										$( "#identificacion_empresa" ).val( ui.item.identificacion_empresa );
										return false;
									}
								});
							});
						</script>
					';
		return $html;	
	}
	
	function autocomplete_gastos_operacionales($row, $estado = null,$extra=array("class"=>"form-control"),$subfuncion=''){
		if(empty($row)){
			$row=new stdClass();		
			$row->entidad_bancaria='';
		}
		$ci 	=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."cont_gastos_operacionales";
		$rows	=	$ci->db->select("*")->from($tabla)->order_by('descripcion','ASC')->get()->result();
		$html	=	'';
		$html	.=	'	<input type="text" data-funcion="'.$subfuncion.'" class="form-control" id="descripcion"  placeholder="Concepto de Gasto" value="'.@$row->descripcion.'"/>';
		$html	.=	'	<input type="hidden"class="form-control" name="contabilidad[]" id="contabilidad" />';		
		$html	.=	'	<input type="hidden" class="form-control" name="contrapartida[]" id="contrapartida" />';	
		$html	.=	'	<input type="hidden" class="form-control" name="descripcion2[]" id="descripcion2" />';
		$html	.=	'	<input type="hidden" class="form-control" name="gastos_id[]" id="gastos_id" />';		
		$html	.= 	'	<script>
							$(function(){
								var projects = [';
									foreach($rows as $k => $v){
										$html	.= 	'{
														value: "'.$v->descripcion.'",
														label: "'.$v->descripcion.'",
														contabilidad: "'.$v->contabilidad2.'",
														contrapartida: "'.$v->contrapartida.'",
														gastos_id: "'.$v->gastos_id.'"
													},';
									}
								 
		$html	.= 	'			];
								$( "#descripcion" ).autocomplete({
									minLength: 0,
									source: projects,
									focus: function( event, ui ) {
										var funcion 	=	$(this).data("funcion");
										if(funcion){
											eval(funcion+"(ui.item)");
										}
										$( "#descripcion" ).val( ui.item.value );
										$( "#descripcion2" ).val( ui.item.value );
										$( "#contabilidad" ).val( ui.item.contabilidad );
										$( "#contrapartida" ).val( ui.item.contrapartida );
										$( "#gastos_id" ).val( ui.item.gastos_id );
										return false;
									},
									select: function( event, ui ) {
										var funcion 	=	$(this).data("funcion");
										if(funcion){
											eval(funcion+"(ui.item)");
										}
										$( "#descripcion" ).val( ui.item.value );
										$( "#descripcion2" ).val( ui.item.value );
										$( "#contabilidad" ).val( ui.item.contabilidad );
										$( "#contrapartida" ).val( ui.item.contrapartida );
										$( "#gastos_id" ).val( ui.item.gastos_id );
										return false;
									},
									change: function (event, ui) {
										if(!ui.item){
											$(event.target).val("");
											alert("Concepto no válido");
										}
									}
								});
							});
						</script>
					';
		return $html;	
	}
	
	function autocomplete_otros_ingresos($row, $estado = null,$extra=array("class"=>"form-control"),$subfuncion=''){
		if(empty($row)){
			$row=new stdClass();		
			$row->entidad_bancaria='';
		}
		$ci 	=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."cont_gastos_operacionales";
		$rows	=	$ci->db->select("*")->from($tabla)->order_by('descripcion','ASC')->get()->result();
		$html	=	'';
		$html	.=	'	<input type="text" data-funcion="'.$subfuncion.'" class="form-control" id="descripcion"  placeholder="Concepto de Gasto" value="'.@$row->descripcion.'"/>';
		$html	.=	'	<input type="hidden"class="form-control" name="contabilidad[]" id="contabilidad" />';		
		$html	.=	'	<input type="hidden" class="form-control" name="contrapartida[]" id="contrapartida" />';	
		$html	.=	'	<input type="hidden" class="form-control" name="descripcion2[]" id="descripcion2" />';
		$html	.=	'	<input type="hidden" class="form-control" name="gastos_id[]" id="gastos_id" />';		
		$html	.= 	'	<script>
							$(function(){
								var projects = [';
									foreach($rows as $k => $v){
										$html	.= 	'{
														value: "'.$v->descripcion.'",
														label: "'.$v->descripcion.'",
														contabilidad: "'.$v->contabilidad.'",
														contrapartida: "'.$v->contrapartida.'",
														gastos_id: "'.$v->gastos_id.'"
													},';
									}
								 
		$html	.= 	'			];
								$( "#descripcion" ).autocomplete({
									minLength: 0,
									source: projects,
									focus: function( event, ui ) {
										var funcion 	=	$(this).data("funcion");
										if(funcion){
											eval(funcion+"(ui.item)");
										}
										$( "#descripcion" ).val( ui.item.value );
										$( "#descripcion2" ).val( ui.item.value );
										$( "#contabilidad" ).val( ui.item.contabilidad );
										$( "#contrapartida" ).val( ui.item.contrapartida );
										$( "#gastos_id" ).val( ui.item.gastos_id );
										return false;
									},
									select: function( event, ui ) {
										var funcion 	=	$(this).data("funcion");
										if(funcion){
											eval(funcion+"(ui.item)");
										}
										$( "#descripcion" ).val( ui.item.value );
										$( "#descripcion2" ).val( ui.item.value );
										$( "#contabilidad" ).val( ui.item.contabilidad );
										$( "#contrapartida" ).val( ui.item.contrapartida );
										$( "#gastos_id" ).val( ui.item.gastos_id );
										return false;
									},
									change: function (event, ui) {
										if(!ui.item){
											$(event.target).val("");
											alert("Concepto no válido");
										}
									}
								});
							});
						</script>
					';
		return $html;	
	}
	
	function autocomplete_concepto($name,$row, $estado = null,$extra=array("class"=>"form-control")){
		if(empty($row)){
			$row=new stdClass();		
			$row->entidad_bancaria='';
		}
		$ci 	=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."cont_gastos_operacionales";
		$rows	=	$ci->db->select("*")->from($tabla)->order_by('descripcion','ASC')->get()->result();
		$html	=	'';
		$html	.=	'	<input type="text" class="form-control" id="descripcion"  placeholder="Concepto de Gasto" value="'.@$row->descripcion.'"/>';
		$html	.=	'	<input type="hidden" class="form-control" name="'.$name.'" id="'.$name.'" />';
		$html	.= 	'	<script>
							$(function(){
								var projects = [';
									foreach($rows as $k => $v){
										$html	.= 	'{
														value: "'.$v->descripcion.'",
														label: "'.$v->descripcion.'",
														contabilidad: "'.$v->contabilidad.'"														
													},';
									}
								 
		$html	.= 	'			];
								$( "#descripcion" ).autocomplete({
									minLength: 0,
									source: projects,
									focus: function( event, ui ) {
										$( "#descripcion" ).val( ui.item.label );
										$( "#'.$name.'" ).val( ui.item.value );
										return false;
									},
									select: function( event, ui ) {
										$( "#descripcion" ).val( ui.item.label );
										$( "#'.$name.'" ).val( ui.item.value );
										return false;
									},
									change: function (event, ui) {
										if(!ui.item){
											$(event.target).val("");
											alert("Concepto no válido");
										}
									}
								});
							});
						</script>
					';
		return $html;	
	}
	
	function nombre($row){
		switch($row->type){
			case 'Modelos':
				return $row->primer_nombre.' '.$row->segundo_nombre.' '. $row->primer_apellido .' '.$row->segundo_apellido;
			break;
			case 'Monitores':
				return $row->primer_nombre.' '.$row->segundo_nombre.' '. $row->primer_apellido .' '.$row->segundo_apellido;
			break;
			case 'Administrativos':
				return $row->primer_nombre.' '.$row->segundo_nombre.' '. $row->primer_apellido .' '.$row->segundo_apellido;
			break;
			case 'Asociados':
				return $row->primer_nombre.' '.$row->segundo_nombre.' '. $row->primer_apellido .' '.$row->segundo_apellido;
			break;
			case 'empresa':
				return $row->nombre_legal;
			break;
			case 'Proveedores':
				return $row->nombre_legal;
			break;
			case 'Plataformas':
				return $row->primer_nombre;
			break;
			case 'CentroCostos':
				return $row->nombre_legal;
			break;
			default:
				return $row->primer_nombre.' '.$row->segundo_nombre.' '. $row->primer_apellido .' '.$row->segundo_apellido;
			break;
		}
	}
	
	function estado($row){
		if(is_object($row)){
			if($row->estado==0){
				return 'Inactivo';	
			}else{
				return 'Activo';	
			}	
		}elseif(is_array($row)){
			if($row['estado']==0){
				return 'Inactivo';	
			}else{
				return 'Activo';	
			}
		}else{
			if($row==0){
				return 'Inactivo';	
			}else{
				return 'Activo';	
			}
		}
	}

	function estatus_operaciones($row){
		if(is_object($row)){
			if($row->estatus==0){
				return 'Anulado';	
			}else{
				return 'Procesado';	
			}	
		}elseif(is_array($row)){
			if($row['estado']==0){
				return 'Anulado';	
			}else{
				return 'Procesado';	
			}
		}else{
			if($row==0){
				return 'Anulado';	
			}else{
				return 'Procesado';	
			}
		}
	}
	
	function expedicion($row,$name,$placeholder='',$require=false){
		if(empty($row)){
			$row=new stdClass();		
			$row->$name='';
		}
		$ci 	=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."sys_municipios";
		$rows	=	$ci->db->select("*")->from($tabla)->get()->result();
		
		$html	=	'';
		$html	.=	'<input type="text" class="form-control" name="'.$name.'" id="'.$name.'" placeholder="'.$placeholder.'" maxlength="150"  value="'.$row->$name.'"';
		$html	.=	($require)? 'require="require"':'""';
		$html	.=	'/>';
		$html	.= 	'	<script>
							$(function(){
								var projects = [';
									foreach($rows as $k => $v){
										$html	.= 	'{
														value: "'.$v->union.'",
														label: "'.$v->union.'"
													},';
									}
								 
		$html	.= 	'			];
								$( "#'.$name.'" ).autocomplete({
									minLength: 0,
									source: projects,
									change: function (event, ui){
									if (ui.item===null) { 
											this.value = ""; 
											alert("Por favor seleccione una ciudad válida del listado")	;										
										}
									},
									focus: function( event, ui ) {
										$( "#'.$name.'" ).val( ui.item.value );
										return false;
									},
									select: function( event, ui ) {
										$( "#'.$name.'" ).val( ui.item.value );
										return false;
									}
								});
							});
						</script>
					';
		return $html;
	}
	
	function lugar($name,$ciudad=''){
		$html	=	'';
		$html	.=	'<input type="text" class="form-control" id="ciudad'.$name.'" placeholder="Ciudad" maxlength="50"  value="'.$ciudad.'"  />';
		$html	.=	'<input type="hidden" name="'.$name.'" id="contenedor_ciudad'.$name.'" maxlength="50"  value="'.$ciudad.'"  />';
		$html	.=	'';
		$html	.=	'';
		$html	.= 	'	<script>
							$(function(){
								var projects = [';
									foreach(get_municipios() as $k => $v){
										$html	.= 	'{
														value: "'.$v->codigo.'",
														label: "'.$v->union.'",
														departamento:"'.$v->departamento.'",
														codigo_postal: "Nulo",
														pais: "Colombia"
													},';
									}
								 
		$html	.= 	'			];
								$( "#ciudad'.$name.'" ).autocomplete({
									minLength: 0,
									source: projects,
									focus: function( event, ui ) {
										$( "#ciudad'.$name.'" ).val( ui.item.label );
										$( "#contenedor_ciudad'.$name.'" ).val( ui.item.label );
											return false;
									},
									select: function( event, ui ) {
										$( "#ciudad'.$name.'" ).val( ui.item.label );
										$( "#contenedor_ciudad'.$name.'" ).val( ui.item.label );
										return false;
									}
								});
							});
						</script>
					';
		return $html;
	}
	
	function get_municipios(){
		$ci 	=& 	get_instance();
		$tabla	=	DB_PREFIJO."sys_municipios";
		return $ci->db->select("*")->from($tabla)->get()->result();	
	}
	
	function pre($var){
		echo '<pre>';	
			print_r($var);
		echo '</pre>';	
	}
	
	function get_CiclosPagos($centro_de_costos=NULL){
		$ci 	=& 	get_instance();
		if($centro_de_costos!=NULL){
			
		}else{
			$centro_de_costos		=	$ci->user->centro_de_costos;	
		}		
		$tabla	=	DB_PREFIJO."usuarios";
		return $ci->db->select("periodo_pagos")->from($tabla)->where('centro_de_costos',$centro_de_costos)->get()->row();	
	}
	
	function get_periodo_pagos($user_id=NULL){
		$ci 	=& 	get_instance();
		$tabla	=	DB_PREFIJO."usuarios";
		return $ci->db->select("periodo_pagos")->from($tabla)->where('user_id',$user_id)->get()->row();	
	}
	
	function format_periodo_pago($tipo_periodo,$periodo,$mes){
		$siglas			=	($tipo_periodo==2)?$semana="Q":$semana="S";
		$mes			=	($mes<10)?"0".$mes:$mes;
		$anio			=	date("Y");
		return $siglas.$periodo.'-'.$mes.'-'.$anio;
	}
	
	function MakePlataformas($name,$estado=null,$extra=array(),$options){
		$option 		= 	array(""=>"Seleccione");
		foreach($options as $v){
			$option[$v->user_id] 	= 	$v->primer_nombre ;	
		}
		if(!isset($extra['id'])){
			$extra['id']	=	$name;
		}
		return form_dropdown($name, $option, $estado,$extra);
	}
	
	function MakeEPS($name,$estado=null,$extra=array(),$options){
		$option 		= 	array(""=>"Seleccione");
		foreach($options as $v){
			$option[$v->id] 	= 	$v->eps;	
		}
		if(!isset($extra['id'])){
			$extra['id']	=	$name;
		}
		return form_dropdown($name, $option, $estado,$extra);
	}
	
	function MakeCuentasBancarias($name,$estado=null,$extra=array(),$options){
		$option 		= 	array(""=>"Seleccione");
		if(!empty($options)){
			foreach($options as $v){
				$option[$v->id_cuenta] 	= 	$v->Entidad.' ('.$v->nro_cuenta.')' ;	
			}
		}else{
			$option 		= 	array(""=>"No hay asociadas a este Centro de Costos");
		}
		return form_dropdown($name, $option, $estado,$extra);
	}
	
	function get_cf_ciclos_pagos($mes,$centro_de_costos){
		$ci 	=& 	get_instance();
		$tabla	=	DB_PREFIJO."cf_ciclos_pagos";
		return $ci->db->select("*,DATE_FORMAT(fecha_hasta,'%Y') as year")
					->from($tabla)
					->where('mes',$mes)
					//->where('estado',0)
					->where('centro_de_costos',$centro_de_costos)->get()->result();	
	}

	function get_production_current(){
		$ci 	=& 	get_instance();
		$ciclo  =   get_cf_ciclos_pagos_new($ci->user->id_empresa);
		//pre($ciclo); return;
		$tabla					=		DB_PREFIJO."rp_diario";
		$ci->db->select("SUM(tokens) as total_ciclo_actual");
		$ci->db->from($tabla);
		$ci->db->where("id_modelo",$ci->user->user_id);
		$ci->db->where("fecha >=",$ciclo->fecha_desde);
		$ci->db->or_where("fecha <=",$ciclo->fecha_hasta);
		$query					=	$ci->db->get();
		return $rows			=	$query->row();
	}
	
	function get_cf_ciclos_pagos_new($id_empresa,$estado=0){
		$ci 	=& 	get_instance();
		$tabla	=	DB_PREFIJO."cf_ciclos_pagos";
		return $ci->db->select("*,DATE_FORMAT(fecha_desde,'%d') as desde,DATE_FORMAT(fecha_hasta,'%d') as hasta,DATE_FORMAT(fecha_hasta,'%Y') as year")->from($tabla)->where('id_empresa',$id_empresa)->where('estado',$estado)->order_by("ciclos_id","ASC")->get()->row();	
		if(isset($ci->CicloDePago["objeto"]->fecha_desde)){
			return $ci->CicloDePago["objeto"];
		}else{
			
			return $ci->db->select("*,DATE_FORMAT(fecha_desde,'%d') as desde,DATE_FORMAT(fecha_hasta,'%d') as hasta")->from($tabla)->where('id_empresa',$id_empresa)->where('estado',$estado)->order_by("ciclos_id","ASC")->get()->row();	
		}
	}

	function get_ListMaster($id_plataforma=""){
		$ci 					=& 		get_instance();
		$tabla					=		DB_PREFIJO."cf_rel_master t1";
		$ci->db->select("t1.*,t3.nro_cuenta");
		$ci->db->from($tabla);
		$ci->db->join(DB_PREFIJO."sys_bancos t2", 't1.cuenta_id 	= 	t2.banco_id', 'left');
		$ci->db->join(DB_PREFIJO."fi_cuentas t3", 't2.banco_id 	= 	t3.id_cuenta', 'left');
		$ci->db->where("t1.id_empresa",$ci->user->id_empresa);
		$ci->db->where("t1.centro_de_costos",$ci->user->centro_de_costos);
		if(!empty($id_plataforma)){
			$ci->db->where("t1.id_plataforma",$id_plataforma);
		}
		$ci->db->order_by('t1.nombre_master','ASC');
		$query					=	$ci->db->get();
		return $var			=	$query->result();
	}
	
	function get_Nickname($id_plataforma,$rel_plataforma_id,$estado=1){
		$ci 					=& 		get_instance();
		$tabla					=		DB_PREFIJO."cf_nickname t1";
		$ci->db->select("*");
		$ci->db->from($tabla);
		$ci->db->join(DB_PREFIJO."usuarios t2", 't1.id_modelo 	= 	t2.user_id', 'left');
		$ci->db->where("t1.id_empresa",$ci->user->id_empresa);
		//$ci->db->where("t1.centro_de_costos",$ci->user->centro_de_costos);
		$ci->db->where("t1.id_plataforma",$id_plataforma);	
		$ci->db->where("t1.id_master",$rel_plataforma_id);		
		$ci->db->order_by('t1.nickname','ASC');
		$query					=	$ci->db->get();
		return $rows			=	$query->result();
	}
	
	function get_Cuenta($cuenta_id){
		$ci 					=& 		get_instance();
		$tabla					=		DB_PREFIJO."fi_cuentas t1";
		$ci->db->select("*");
		$ci->db->from($tabla);
		$ci->db->where("t1.id_empresa",$ci->user->id_empresa);
		$ci->db->where("t1.centro_de_costos",$ci->user->centro_de_costos);
		$ci->db->where("t1.id_cuenta",$cuenta_id);	
		$ci->db->order_by('t1.entidad_bancaria','ASC');
		$query					=	$ci->db->get();
		return $rows			=	$query->row();
	}
	
	function get_Cuenta_X_Master($id_master){
		$ci 					=& 		get_instance();
		$tabla					=		DB_PREFIJO."cf_rel_master t1";
		$ci->db->select("*");
		$ci->db->from($tabla);
		$ci->db->join(DB_PREFIJO."fi_cuentas t2", 't1.cuenta_id 	= 	t2.id_cuenta', 'left');
		$ci->db->where("t1.id_empresa",$ci->user->id_empresa);
		$ci->db->where("t1.centro_de_costos",$ci->user->centro_de_costos);
		$ci->db->where("t1.rel_plataforma_id",$id_master);	
		$query					=	$ci->db->get();
		return $rows			=	$query->row();
	}

	function MakeRetefuente($estado){
		$ci 					=& 		get_instance();
		$tabla					=		DB_PREFIJO."sys_retefuente t1";
		$ci->db->select("*");
		$ci->db->from($tabla);
		//$ci->db->join(DB_PREFIJO."fi_cuentas t2", 't1.cuenta_id 	= 	t2.id_cuenta', 'left');	
		$query					=	$ci->db->get();
		$rows			=	$query->result();
		$html	=	'<select id="retefuente" name="retefuente" class="form-control">
		<option selected="selected" data-porcentaje="0" value="">No aplica Retención en la Fuente</option>';
		foreach($rows as $k=> $v){
			$html	.=	'<option data-porcentaje ="'.$v->Porcentaje.'" value="'.$v->Concepto.'/-/'.$v->retefuente_id.'/-/'.$v->Codigo_contable.'" >'.$v->Concepto.'</option>';	
		}
		$html	.=	'</select>';
		return $html;
	}
	
	function get_ciclos_pagos_now(){
		$ci 	=& 	get_instance();
		$tabla	=	DB_PREFIJO."cf_ciclos_pagos";
		$row	=	$ci->db->select("*")->from($tabla)->where('fecha_desde<=',date("Y-m-d"))->where('fecha_hasta>=',date("Y-m-d"))->where('id_empresa',$ci->user->id_empresa)->get()->row();	
		$tipo	=	$ci->user;
		if(empty($row)){
			return;	
		}
		//echo '<pre>';//print_r($ci->user->periodo_pagos);	print_r($row->nombre);	echo '</pre>';
		$explode	=	explode("#",$row->nombre);
		$N			=	$explode[1];
		$QS			=	($ci->user->periodo_pagos==4)?'S':'Q';
		return $QS.$N.'-'.date("m").'-'.date("Y");
		/*Q1|S1 - MM - YY*/		
	}
	
	function get_ciclos_pagos_now_x_id($ciclos_id){
		
		$ci 	=& 	get_instance();
		$tabla	=	DB_PREFIJO."cf_ciclos_pagos";
		$row	=	$ci->db->select("*, MONTH(fecha_desde) as mes2, DATE_FORMAT(fecha_desde, '%m') as mes, YEAR(fecha_desde) as anio")->from($tabla)->where('ciclos_id',$ciclos_id)->where('id_empresa',$ci->user->id_empresa)->get()->row();	
		$tipo	=	$ci->user;
		if(empty($row)){
			return;	
		}
		//echo '<pre>';//print_r($ci->user->periodo_pagos);	print_r($row->nombre);	echo '</pre>';
		$explode	=	explode("#",$row->nombre);
		$N			=	$explode[1];
		$QS			=	($ci->user->periodo_pagos==4)?'S':'Q';
		return $QS.$N.'-'.$row->mes.'-'.$row->anio;
		/*Q1|S1 - MM - YY*/		
	}
	
	function get_ciclos_pagos_end(){
		$ci 	=& 	get_instance();
		$tabla	=	DB_PREFIJO."cf_ciclos_pagos";
		$row	=	$ci->db->select("*")->from($tabla)->where('fecha_desde<=',date("Y-m-d"))->where('fecha_hasta>=',date("Y-m-d"))->where('id_empresa',$ci->user->id_empresa)->get()->row();	
		return @$row;
	}
	
	function MakeCiclos($periodos){
		$options = array();
		for($a=1;$a<=($periodos);$a++){
			if($periodos==2){$semana="Q";}else if($periodos==4){$semana="S";}
			$options[$a]	=	$semana.$a;
		}
		return form_dropdown("periodo_pagos", $options, null ,array("class"=>"form-control"));		
	}
	
	function btn_export($url	=	''){
		$ci 	=& 	get_instance(); 
		if($url!=''){
			$url	=		$url;
		}else{
			$url	=		$ci->uri->segment(1)."/Export";
		}
		?>
        <div class="btn-group" role="group">
            <?php
                $hidden 	= 	array("doc"=>uri_string());
                echo form_open(base_url($url),array('aja' => 'true'),$hidden);	
            ?> 
                <button  type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-download" aria-hidden="true"></i>
                    Exportar
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <input type="hidden" value="1" require/>
                    <button class="dropdown-item" type="submit" value="1" name="excel">
                        Excel
                    </button>
                    <button class="dropdown-item" type="submit" value="1" name="pdf">
                        PDF
                    </button>
                </div>
            <?php echo form_close();?>                            
        </div>
        <?php	
	}
	
	function menu($rol_id=NULL){
		$ci 	=& 	get_instance();
		$tabla						=	DB_PREFIJO."sys_roles";
		$ci->db->select("*")->from($tabla);
		if(!empty($rol_id)){
			$ci->db->where("rol_id",$rol_id);
		}
		$roles						=	$ci->roles					=	$ci->db->get()->row();
		$menu_search				=	json_decode(@$roles->json);			
		$menu_edit					=	json_decode($roles->json_edit);			
		if(is_array($menu_search)&& is_array($menu_edit)){
			$in							=	array_merge($menu_search,$menu_edit);
		}else if(is_array($menu_search)&& !is_array($menu_edit)){
			$in							=	$menu_search;
		}else if(!is_array($menu_search)&& is_array($menu_edit)){
			$in							=	$menu_edit;
		}else{
			$in							=	array();
		}
		$tabla						=	DB_PREFIJO."sys_roles_modulos";
		$roles_modulos_padre	=	$ci->db->select("*")->from($tabla)->where('modulo_padre',0)->order_by('order','ASC')->get()->result();
		$roles_modulos_hijos	=	array();
		$roles_modulos_nietos	=	array();
		foreach($roles_modulos_padre as $k =>$v){
			$hijos									=	$ci->db->select("*")->from($tabla)->where('modulo_padre',$v->id)->order_by('order','ASC')->get()->result();
			$roles_modulos_hijos[$v->id][]	=	$hijos;
			foreach($hijos as $k2 => $v2){	
				$roles_modulos_nietos[$v2->id]	=	$ci->db->select("*")->from($tabla)->where('modulo_padre',$v2->id)->order_by('order','ASC')->get()->result();
			}			
		}
		return array(	"roles_modulos_padre"	=>	$roles_modulos_padre,
						"roles_modulos_hijos"	=>	$roles_modulos_hijos,
						"roles_modulos_nietos"	=>	$roles_modulos_nietos,
						"roles_modulos_permitidos"	=>	$in,
						"modulo_search"				=>	$menu_search,
						"modulo_edit"				=>	$menu_edit);	
	}
	
	function menu_usuarios($rol_id=NULL){
		$ci 	=& 	get_instance();
		$tabla						=	DB_PREFIJO."sys_roles";
		$ci->db->select("*")->from($tabla);
		if(!empty($rol_id)){
			$ci->db->where("rol_id",$rol_id);
		}
		$roles						=	$ci->roles					=	$ci->db->get()->row();
		$menu_search				=	json_decode($roles->json);			
		$menu_edit					=	json_decode($roles->json_edit);			
		//print_r($menu_edit);return false; 
		if(is_array($menu_search)&& is_array($menu_edit)){
			$in							=	array_merge($menu_search,$menu_edit);
		}else if(is_array($menu_search)&& !is_array($menu_edit)){
			$in							=	$menu_search;
		}else if(!is_array($menu_search)&& is_array($menu_edit)){
			$in							=	$menu_edit;
		}else{
			$in							=	array();
		}
		
		$tabla						=	DB_PREFIJO."sys_roles_modulos";
		$roles_modulos_padre	=	$ci->db->select("*")->from($tabla)->where('modulo_padre',0)->order_by('order','ASC')->get()->result();
		$roles_modulos_hijos	=	array();
		$roles_modulos_nietos	=	array();
		foreach($roles_modulos_padre as $k =>$v){
			$hijos									=	$ci->db->select("*")->from($tabla)->where('modulo_padre',$v->id)->get()->result();
			$roles_modulos_hijos[$v->id][]			=	$hijos;
			foreach($hijos as $k2 => $v2){
				$roles_modulos_nietos[$v2->id]		=	$ci->db->select("*")->from($tabla)->where('modulo_padre',$v2->id)->get()->result();
			}			
		}
		return array(	"roles_modulos_padre"		=>	$roles_modulos_padre,
						"roles_modulos_hijos"		=>	$roles_modulos_hijos,
						"roles_modulos_nietos"		=>	$roles_modulos_nietos,
						"roles_modulos_permitidos"	=>	$in,
						"modulo_search"				=>	$menu_search,
						"modulo_edit"				=>	$menu_edit);	
	}
	
	function answers_json($array){
		return json_encode($array);
	}	
	
	function send_mail($vars,$return=false){
		if($return){
			echo $vars["body"];
			return;	
		}
		$ci 	=& 	get_instance();
		$config = array(    
			'protocol' 		=> 	PROTOCOL,
			'smtp_host' 	=> 	SMTP_HOST,
			'smtp_port' 	=> 	SMTP_PORT,
			'smtp_user' 	=> 	SMTP_USER,
			'smtp_pass' 	=> 	SMTP_PASS,
			'smtp_timeout' 	=> 	SMTP_TIMEOUT,
			'mailtype'		=> 	MAILTYPE,
			'charset' 		=> 	CHARSET
		);	
		$ci->load->library('email', $config);
		$ci->email->set_newline("\r\n");
		$ci->email->from(FROM_EMAIL, FROM_NAME);
		$ci->email->to($vars["recipient"]);
		$ci->email->subject($vars["subject"]);
		if(isset($vars["adjunto"])){
			$ci->email->attach($vars["adjunto"]);
		}
		$ci->email->message($vars["body"]); 
		if($ci->email->send()){
			//pre($vars); return;
			return array("error"	=>	false);	
		}else{
			return array("error"	=>	true, "debugger"=>$ci->email->print_debugger() );
		}
	}
	
	function set_template_mail($var=array()){
		$ci 	=& 	get_instance();
		$view	=	PATH_VIEW.'/Template/Emails/'.$var['view'].'.php';
		if(file_exists($view)){
			return $ci->load->view('Template/Emails/'.$var['view'],$var['data'],TRUE);	
		}else{
			return false;	
		}
	}
	
	function paginator($total_rows=0){
		$ci 	=& 	get_instance();
		$config['base_url'] 		= 	base_url($ci->uri->segment(1).'/'.$ci->uri->segment(2));
		$config['total_rows'] 		= 	$total_rows;
		$config['per_page'] 		= 	ELEMENTOS_X_PAGINA;
		$config['full_tag_open'] 	= 	'<div class="pagging text-center"><nav><ul class="pagination">';
		$config['full_tag_close'] 	= 	'</ul></nav></div>';
		$config['num_tag_open'] 	= 	'<li class="page-item"><span class="page-link">';
		$config['num_tag_close'] 	= 	'</span></li>';
		$config['cur_tag_open'] 	= 	'<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close'] 	= 	'<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open'] 	= 	'<li class="page-item"><span class="page-link">';
		$config['next_tagl_close'] 	= 	'<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open'] 	= 	'<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close'] 	= 	'</span></li>';
		$config['first_link'] 		= 	'Primera Página';
		$config['first_tag_open'] 	= 	'<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = 	'</span></li>';
		$config['last_link'] 		= 	'Última Página';
		$config['last_tag_open'] 	= 	'<li class="page-item"><span class="page-link">';
		$config['last_tagl_close'] 	= 	'</span></li>';
		$ci->pagination->initialize($config);
	}
	
	function session_flash(){
		$ci 	=& 	get_instance();
		if($error = $ci->session->flashdata('error')){				
			echo '<div class="alert alert-danger">';
			echo $error; 
			echo '<i class="glyphicon glyphicon-alert"></i></div>';
		}elseif($info = $ci->session->flashdata('info')){
			echo '<div class="alert alert-info">';
			echo $info; 
			echo '<i class="glyphicon  glyphicon-ok"></i></div>';
		}else if($success = $ci->session->flashdata('success')){
			echo '<div class="alert alert-success">';
			echo $success; 
			echo '<i class="glyphicon  glyphicon-ok"></i></div>';			
		}else if($success = $ci->session->flashdata('danger')){
			echo '<div class="alert alert-danger">';
			echo $success; 
			echo '<i class="glyphicon  glyphicon-ok"></i></div>';			
		}
	}
	
	function listados($view){
		$ci 	=& 	get_instance();
		$ci->load->view('Template/Header');
		$ci->load->view('Template/Flash');
		$ci->load->view('Template/Apanel/Menu');
		$ci->load->view('Template/Breadcrumb');
		$ci->load->view('Template/'.$view);
		$ci->load->view('Template/Footer');	
	}
	
	function FrontEnd($view){
		$ci 	=& 	get_instance();
		$ci->load->view('Template/FrontEndHeader');
		$ci->load->view('Template/Flash');
		$ci->load->view('Template/'.$view);
		$ci->load->view('Template/Footer');	
	}
	
	function listados_export($fields,$rows,$width=40){
		if (PHP_SAPI == 'cli'){die('This example should only be run from a Web Browser');}
		
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('Europe/London');

		
		include(PATH_APP.'third_party/PHPExcel/PHPExcel.php');
		
		$objPHPExcel = new PHPExcel();
		
		$objPHPExcel->getProperties()->setCreator("Programandoweb")
							 ->setLastModifiedBy("Lcdo. Jorge Mendez")
							 ->setTitle("Office 2007 Realziado en Colombia por Venezolano")
							 ->setSubject("Office 2007 Realziado en Colombia por Venezolano")
							 ->setDescription("Documento exportado para WebcamPlus.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");
		// Add some data
		
		//print_r($fields);return;
		
		$columnas	=	range('A', 'Z');
		$inc		=	0;
		foreach($fields as $k => $v){
			if($v!='Acción'){
				$objPHPExcel->getActiveSheet()->getColumnDimension($columnas[$inc])->setWidth($width);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columnas[$inc]."1", strip_tags($v));
				$inc++;
			}
		}
		
		
		foreach($rows as $k => $v){
			$inc		=	0;
			foreach($v as $k2 => $v2){
				if($k2!='edit'){
					//print_r($v2);
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columnas[$inc].($k + 2), $v2);
					$inc++;
				}
			}
						
		}			

		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('Simple');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		// Redirect output to a client's web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="export.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
		
	}

	function export_excel($data){
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('Europe/London');

		if (PHP_SAPI == 'cli')
			die('This example should only be run from a Web Browser');

		/** Include PHPExcel */
		include(PATH_APP.'third_party/PHPExcel/PHPExcel.php');


		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		// Set document properties
		$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
									 ->setLastModifiedBy("Maarten Balliauw")
									 ->setTitle("Office 2007 XLSX Test Document")
									 ->setSubject("Office 2007 XLSX Test Document")
									 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
									 ->setKeywords("office 2007 openxml php")
									 ->setCategory("Test result file");

		$tablas = count($data);							 
		$columnas	=	range('A', 'Z');							 
		for ($i=0; $i <= ($tablas)-1 ; $i++) {
			foreach ($data[$i] as $k => $v) {
				$indice = $i + 1;
				$objPHPExcel->setActiveSheetIndex(0)
		            ->setCellValue($columnas[$k].$indice, $v);
			}
		}


		$objPHPExcel->getActiveSheet()->setTitle('Simple');


		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);


		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="01simple.xlsx"');
		header('Cache-Control: max-age=0');

		header('Cache-Control: max-age=1');


		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); 
		header ('Cache-Control: cache, must-revalidate'); 
		header ('Pragma: public'); 

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
	}

	function html_export_excel($html,$filename){
	$ci 	=& 	get_instance(); 

	define('TMP_FILES', PATH_APP."temp/");
	$basePath = PATH_APP.'third_party/PHPExcel/';
	include ($basePath . 'PHPExcel.php');
	include ($basePath . 'PHPExcel/IOFactory.php');

			if( !ini_get('date.timezone') ) {
			    date_default_timezone_set('GMT');
			}

			$htmlfile = tempnam(sys_get_temp_dir(), 'html'); // se creo un nuevo html dentro de una carpeta temporal

			file_put_contents($htmlfile,$html['html']); //Se introduce el contenido de el html

			$objReader = new PHPExcel_Reader_HTML; // Se instancia un nuevo lector
			$objPHPExcel = $objReader->load($htmlfile); // Se pasa el archivo al lector
			// Se dan las propiedades al documento
			$objPHPExcel->getProperties()->setCreator("Andres Felipe Castañeda");
			$objPHPExcel->getProperties()->setLastModifiedBy("Andres Felipe Castañeda");
			$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Documento");
			$objPHPExcel->getProperties()->setSubject("XLSX Reporte");
			$objPHPExcel->getProperties()->setDescription("XLSX Reporte");
	    
		//Se le da tamaño a las celdas.
		foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {

		    $objPHPExcel->setActiveSheetIndex($objPHPExcel->getIndex($worksheet));

		    $sheet = $objPHPExcel->getActiveSheet();
		    $cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
		    $cellIterator->setIterateOnlyExistingCells(true);
		    /** @var PHPExcel_Cell $cell */
		    foreach ($cellIterator as $cell){
		        $sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
		    }
		}
	    
		        $excelFile = tempnam(sys_get_temp_dir(), '.xlsx'); // se crea el excel en la carpeta temporal.
		    
			// Creamos el objeto PHPexcel.
		 	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save($excelFile);

			//pre($html['email']); return; // guardamos el documento.

			send_mail(array(
										"recipient"=>$html["email"],
										"subject"=>"Buenas tardes, te hacemos envio del documento que nos has solicitado ".$filename,
										"adjunto"=>$excelFile,
										"body"=>$ci->load->view('Template/Emails/excel',array(),TRUE),
										));

			unlink($htmlfile); // borramos el documento.
			unlink($excelFile);
			
			if(file_exists($excelFile)) {
				return $filename . '.xlsx';
			}

			return true;
	}

    function downloadExcel($html,$filename) {

    	//pre($html['html']); return;

    	$basePath = PATH_APP.'third_party/PHPExcel/';
		include ($basePath . 'PHPExcel.php');
		include ($basePath . 'PHPExcel/IOFactory.php');

    	$ci 	=& 	get_instance();
    	$html['html'] .= '<h3>Fecha de descarga '.date("Y-m-d H:i").'<h3>'; 

		// save $table inside temporary file that will be deleted later
		$tmpfile = tempnam(sys_get_temp_dir(), 'html');
		file_put_contents($tmpfile, $html['html']);


		// insert $table into $objPHPExcel's Active Sheet through $excelHTMLReader
		$objPHPExcel     = new PHPExcel();
		$excelHTMLReader = PHPExcel_IOFactory::createReader('HTML');
		$excelHTMLReader->loadIntoExisting($tmpfile, $objPHPExcel);
		$objPHPExcel->getActiveSheet()->setTitle($filename); // Change sheet's title if you want

		foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {

		    $objPHPExcel->setActiveSheetIndex($objPHPExcel->getIndex($worksheet));

		    $sheet = $objPHPExcel->getActiveSheet();
		    $cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
		    $cellIterator->setIterateOnlyExistingCells(true);
		    /** @var PHPExcel_Cell $cell */
		    foreach ($cellIterator as $cell){
		        $sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
		    }
		}

		unlink($tmpfile); // delete temporary file because it isn't needed anymore

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); // header for .xlxs file
		header('Content-Disposition: attachment;filename='.$filename); // specify the download file name
		header('Cache-Control: max-age=0');

		// Creates a writer to output the $objPHPExcel's content
		$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$writer->save('php://output');
		exit;
	}

	function items_factura_x_nickname($nickname_id,$estatus=false){
		$ci 	=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."rp_operaciones t1";
		$ci->db->select("t1.*");
		$ci->db->from($tabla);
		$ci->db->where("t1.nickname_id",$nickname_id);
		if($estatus){
			$ci->db->where("t1.estatus",$estatus);
		}
		$query			=	$ci->db->get();
		return	$query->row();
	}
	
	function items_factura($nro_documento){
		$ci 	=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."rp_factura t1";
		$ci->db->select("t1.*,t1.equivalencia as equi,t2.abreviacion,t3.primer_nombre as primer_nombre_modelo,t3.primer_apellido as primer_apellido_modelo,t4.nickname,t5.moneda_de_pago as moneda_de_pago");
		$ci->db->from($tabla);
		$ci->db->join(DB_PREFIJO."usuarios t2", 't1.centro_de_costos 	= 	t2.user_id', 'left');
		$ci->db->join(DB_PREFIJO."usuarios t3", 't1.id_modelo 			= 	t3.user_id', 'left');
		$ci->db->join(DB_PREFIJO."cf_nickname t4", 't1.nickname_id 		= 	t4.nickname_id', 'left');
		$ci->db->join(DB_PREFIJO."usuarios t5", 't4.id_plataforma 		= 	t5.user_id', 'left');
		$ci->db->where("t1.nro_documento",$nro_documento);
		$query			=	$ci->db->get();
		return	$query->result();
	}
	
	function Procesador_factura($nro_documento){
		$ci 	=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."rp_factura t1";
		$ci->db->select("SUM(usd) AS usd, entidad_bancaria,nro_cuenta,t4.id_cuenta");
		$ci->db->from($tabla);
		$ci->db->join(DB_PREFIJO."cf_nickname t2", 't1.nickname_id=t2.nickname_id', 'left');
		$ci->db->join(DB_PREFIJO."cf_rel_master t3", 't2.id_master=t3.rel_plataforma_id', 'left');
		$ci->db->join(DB_PREFIJO."fi_cuentas t4", 't3.cuenta_id=t4.id_cuenta', 'left');
		$ci->db->where("t1.nro_documento",$nro_documento);
		$ci->db->group_by(array("t4.nro_cuenta"));
		$query			=	$ci->db->get();
		return $query->result();
	}
	
	function get_factura($id_empresa,$centro_de_costos,$periodo_de_pago,$nombre_cliente){
		$ci 	=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."rp_factura";
		$ci->db->select("*");
		$ci->db->from($tabla);
		$ci->db->where("id_empresa",$id_empresa);
		$ci->db->where("centro_de_costos",$centro_de_costos);
		//$ci->db->where("fecha_emision",$periodo_de_pago);
		$ci->db->where("nombre_cliente",$nombre_cliente);
		$query			=	$ci->db->get();
		$row			=	$query->row();
		if(empty($row)){
			return false;
		}else{
			return $row;	
		}
	}
	
	
	function listados_export_pdf($fields,$rows,$width=40){
		if (PHP_SAPI == 'cli'){die('This example should only be run from a Web Browser');}
		include(PATH_APP.'third_party/PHPExcel/PHPExcel.php');
		
		/*require_once (PATH_APP.'third_party/PHPExcel/PHPExcel/IOFactory.php');
		include_once (PATH_APP.'third_party/PHPExcel/PHPExcel/Writer/Excel2007.php');
		include_once (PATH_APP.'third_party/PHPExcel/PHPExcel/Writer/PDF.php');
		include_once (PATH_APP.'third_party/PHPExcel/PHPExcel/Writer/PDF/DomPDF.php');*/
		
		$rendererName 			= 	PHPExcel_Settings::PDF_RENDERER_DOMPDF;
		$rendererLibrary 		= 	'domPDF0.6.0beta3';
		$rendererLibraryPath 	= 	PATH_APP.'third_party/'.$rendererLibrary;
		
		
		$objPHPExcel = new PHPExcel();


		// Set document properties
		$objPHPExcel->getProperties()->setCreator("Programandoweb")
							 ->setLastModifiedBy("Lcdo. Jorge Mendez")
							 ->setTitle("Office 2007 Realziado en Colombia por Venezolano")
							 ->setSubject("Office 2007 Realziado en Colombia por Venezolano")
							 ->setDescription("Documento exportado para WebcamPlus.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");
		
		
		$columnas	=	range('A', 'Z');
		$inc		=	0;
		foreach($fields as $k => $v){
			if($v!='Acción'){
				$objPHPExcel->getActiveSheet()->getStyle($columnas[$inc]."1")->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle($columnas[$inc]."1")->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FF8000'))));
				$objPHPExcel->getActiveSheet()->getColumnDimension($columnas[$inc])->setWidth($width);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columnas[$inc]."1", strip_tags($v));
				$inc++;
			}
		}
		
		$rows_count		=	0;
		foreach($rows as $k => $v){
			if($rows_count==1){
				$gris	=	true;
				$rows_count=0;	
			}else{
				$gris	=	false;
				$rows_count++;		
			}
			$inc		=	0;
			foreach($v as $k2 => $v2){
				if($k2!='edit'){
					if($gris){
						$objPHPExcel->getActiveSheet()->getStyle($columnas[$inc].($k + 2))->applyFromArray(array('fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'F2F2F2'))));
					}
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($columnas[$inc].($k + 2), $v2);
					$inc++;
				}
			}
					
		}			

		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('Simple');
		$objPHPExcel->getActiveSheet()->setShowGridLines(FALSE);	
		
		$objPHPExcel->setActiveSheetIndex(0);	
		if (!PHPExcel_Settings::setPdfRenderer(
		  $rendererName,
		  $rendererLibraryPath
		 )) {
		 die(
		  'NOTICE: Please set the $rendererName and $rendererLibraryPath values' .
		  '<br />' .
		  'at the top of this script as appropriate for your directory structure'
		 );
		}
		
		// Redirect output to a client's web browser (PDF)
		header('Content-Type: application/pdf');
		header('Content-Disposition: attachment;filename="01simple.pdf"');
		header('Cache-Control: max-age=0');
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
		$objWriter->save('php://output');
		exit;  
	}
	
	function CertificadoLaboral_pdf($html,$title=null){
		if (PHP_SAPI == 'cli'){die('This example should only be run from a Web Browser');}
		include(PATH_APP.'third_party/PHPExcel/PHPExcel.php');

		if(empty($title)){
			$ci = get_instance();
			$title = $ci->uri->segment(2);
			if($title == "generarPdfTratamientoDatos"){
				$title = centrodecostos($ci->uri->segment(3))->type;
			}
		}

		$rendererLibrary 		= 	'domPDF0.6.0beta3';
		$rendererLibraryPath 	= 	PATH_APP.'third_party/'.$rendererLibrary;
		require_once($rendererLibraryPath."/dompdf_config.inc.php");

		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->render();
		//$canvas = $ci->dompdf->get_canvas(); 
		//$canvas->page_text(5, 5, "Página {PAGE_NUM} de {PAGE_COUNT}",$ci->config->get('dompdf.defines.DOMPDF_DEFAULT_FONT'),8,array(0, 0, 0));
		$dompdf->stream($title.".pdf", array("Attachment" => false));
	}

	function preparar_pdf($salida,$template,$correo = null,$asunto = "Bienvenido Gracias por hacer parte de nuestro equipo de trabajo",$message,$title = "Envio Email",$filename = "Archivo.pdf"){
		$ci = get_instance();
		if($correo){
				$response = enviar_pdf($salida,$correo,$asunto,$ci->load->view('Template/Emails/'.$template,array("title"=>$title,"message"=>$message),TRUE),$filename,$templatePdf);
		}else{
			$correos = get_NotificacionEmail();
			foreach ($correos as $k => $v) {
				$response = enviar_pdf($salida,$v->correo,$asunto,$ci->load->view('Template/Emails'.$template,array("title"=>$title,"message"=>$message),TRUE),$filename,$templatePdf);
			}
		}
		return $response;
	}

	function enviar_pdf($html="",$correo="",$asunto="",$body="",$filename = "produccion.pdf",$directorio = ''){
		$ci = get_instance();
		if(!empty($html)){

		}
		$rendererLibrary 		= 	'domPDF0.6.0beta3';
		$rendererLibraryPath 	= 	PATH_APP.'third_party/'.$rendererLibrary;
		require_once($rendererLibraryPath."/dompdf_config.inc.php");
		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->render();
		//$dompdf->stream("sample.pdf", array("Attachment" => false));
		$output = $dompdf->output();
		if(empty($correo)){
			return array("error"=>"No tienes correo electronico para enviar una copia de tu reporte por favor introduce una cuenta de correo electronico");
		}else{
		$carpeta = 	PATH_APP."reportes/".@$directorio;
		if(!file_exists($carpeta)){
			mkdir($carpeta,745);
			fopen($carpeta.$filename,"w");
		}
		file_put_contents($carpeta.$filename,  $dompdf->output());
			$var['recipient'] = $correo;
			$var['subject'] = $asunto;
			if($html){
				$var['adjunto'] = $carpeta.$filename;
			}
			$var['body'] = $body;
			$response = send_mail($var);
			return $response;
		}
	}

	function pdf_A5($html,$medidas=array(),$save = false){ 
		if (PHP_SAPI == 'cli'){die('This example should only be run from a Web Browser');}
		include(PATH_APP.'third_party/PHPExcel/PHPExcel.php');
		
		$rendererLibrary 		= 	'domPDF0.6.0beta3';
		$rendererLibraryPath 	= 	PATH_APP.'third_party/'.$rendererLibrary;
		require_once($rendererLibraryPath."/dompdf_config.inc.php");
		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		if($medidas){
			$dompdf->set_paper($medidas);
		}
		$dompdf->render();
		if($save){
			$output = $dompdf->output();
			return $output;
		}else{
			$dompdf->stream("sample.pdf", array("Attachment" => false));
		} 
	}
	
	function Form($view){
		$ci 	=& 	get_instance();
		$ci->load->view('Template/Header');
		$ci->load->view('Template/Flash');
		$ci->load->view('Template/Apanel/Menu');
		$ci->load->view('Template/Breadcrumb');
		$ci->load->view('Template/'.$view);
		$ci->load->view('Template/Footer');	
	}
	
	function FormAjax($view){
		$ci 	=& 	get_instance();
		$ci->load->view('Template/Header');
		$ci->load->view('Template/Flash');
		$ci->load->view('Template/'.$view);
		$ci->load->view('Template/Footer');	
	}
	
	function MakeSiNo($name,$estado=null,$extra=array()){
		$options = array(
			""		 =>	"Seleccione",
			 1       => 'Si',
			 0       => 'No',
			 2   => 'N.A.',
		);
		return form_dropdown($name, $options, $estado,$extra);
	}

	function MakeTipoDeCaja($name,$estado=null,$extra=array()){
		$options = array(
			""		         		     =>	"Seleccione",
			'Caja general 110505'        => 'Caja general 110505',
			'Cajas menores 110510'       => 'Cajas menores 110510',
			'Moneda extranjera 110515'   => 'Moneda extranjera 110515',
			'Caja punto de venta 110520' => 'Caja punto de venta 110520',

		);
		return form_dropdown($name, $options, $estado,$extra);
	}

	function MakeTipoCuenta($name,$estado=null,$extra=array()){
		$options = array(
			"0"=>"Seleccione",
			'111010'=> 'Cuenta corriente internacional',
			'111005'=> 'Cuenta corriente nacional',
			'111010'=> 'Cuenta de ahorros internacional',
			'111005'=> 'Cuenta de ahorros nacional',
			'112520'=> 'Monedero virtual (Ewallet) internacional',
			'112515'=> 'Monedero virtual (Ewallet) nacional',
			'112015'=> 'Organismos cooperativos financieros',
			'112510'=> 'Rotativo moneda internacional',
			'112505'=> 'Rotativo moneda nacional',
			'111010'=> 'Tarjeta de credito prepagada'

		);
		return form_dropdown($name, $options, $estado,$extra);
	}

	function MakeCicloMestrual($name,$estado=null,$extra=array()){
		$options = array(
			""		=>	"Seleccione",
			'Regular'         => 'Regular',
			'Irregular'       => 'Irregular'
		);
		return form_dropdown($name, $options, $estado,$extra);
	}
	
	function MakePeriodoMestruacion($name,$estado=null,$extra=array()){
		$options = array(
			""		=>	"Seleccione",
			"Inicio de mes"		=>	"Inicio de mes",
			"Mediados de mes"	=>	"Mediados de mes",
			"Finales de mes"	=> 	"Finales de mes"
		);
		return form_dropdown($name, $options, $estado,$extra);
	}

	function MakeDescuento($name,$estado=null,$extra=array()){
		$options = array(
			'Fijo'         => 'Fijo',
			'Porcentual'       	=> 'Porcentual'
		);
		return form_dropdown($name, $options, $estado,$extra);
	}

	function MakeTipoDescuento($name,$estado=null,$extra=array()){
		$options = array(
			''				=> 'Seleccione',
			'Propio'         => 'Propio',
		);
		return form_dropdown($name, $options, $estado,$extra);
	}
	
	function MakeColicos($name,$estado=null,$extra=array()){
		$options = array(
			""		=>	"Seleccione",
			"De uno (1) a tres (3) días" 	=> 	"De uno (1) a tres (3) días",
			"De tres (3) a ocho (8) días"   => 	"De tres (3) a ocho (8) días",
			"Más de ocho (8) días"			=>	"Más de ocho (8) días"
		);
		return form_dropdown($name, $options, $estado,$extra);
	}
	
	function MakeDuracionPeriodo($name,$estado=null,$extra=array()){
		$options = array(
			""		=>	"Seleccione",
			"Ausentes"		=>	"Ausentes",
			"Presentes"	=> 	"Presentes"
		);
		return form_dropdown($name, $options, $estado,$extra);
	}
	function MakeEstado($name,$estado=null,$extra=array()){
		$options = array(
			'1'         => 'Activo',
			'0'       => 'Inactivo'
		);
		return form_dropdown($name, $options, $estado,$extra);
	}
	
	function MakeGasto($name,$estado=null,$extra=array()){
		$options = array(
			'Fijo'         => 'Fijo',
			'Variable'       	=> 'Variable'
		);
		return form_dropdown($name, $options, $estado,$extra);
	}
	
	function MakeTipoPersona($name,$estado=null,$extra=array()){
		$options = array(
			'PERSONA NATURAL'         	=> 'Persona Natural',
			'PERSONA JURÍDICA'       	=> 'Persona Jurídica'
		);
		return form_dropdown($name, $options, $estado,$extra);
	}
	
	function MakeAsunto($estado=null,$extra=array()){
		$options = array(		
			'Revisión pago honorarios'         						=> 'Revisión pago honorarios',
			'Llegada tarde a instalaciones de transmisión'       	=> 'Llegada tarde a instalaciones de transmisión',
			'Permiso de ausencia justificada'       				=> 'Permiso de ausencia justificada',
			'Cambio de turno provisional'							=> 'Cambio de turno provisional',
			'Cambio de turno permanente'							=> 'Cambio de turno permanente',
			'Cambio día de descanso (transmisión día domingo)'		=> 'Cambio día de descanso (transmisión día domingo)',
			'Transmisión provisional desde casa'					=> 'Transmisión provisional desde casa',
			'Transmisión permanente desde casa'						=> 'Transmisión permanente desde casa',
			'Creación nueva página'									=> 'Creación nueva página',
			'Capacitación adicional en página y/o estrategias de crecimiento'=> 'Capacitación adicional en página y/o estrategias de crecimiento',
			'Cambio de room'										=> 'Cambio de room',
			'Room en mal estado'									=> 'Room en mal estado',
			'Queja, reclamo o inconformidad'						=> 'Queja, reclamo o inconformidad',
			'Recomendación de mejora'								=> 'Recomendación de mejora',
			'Otro'													=> 'Otro'
		);
		return form_dropdown("asunto", $options, $estado,$extra);
	}
	
	function MakeTipoEmpresa($name,$estado=null,$extra=array()){
		$options = array(
			'Regimen Simplificado'    	=> 'Régimen Simplificado',
			'Regimen Común'       		=> 'Regimen Común'
		);
		return form_dropdown($name, $options, $estado,$extra);
	}
	
	function MakeTipoIdentificacion($name,$estado,$extra=array()){
		$options = array(
			''=> 'Seleccione',
			'NIT'=>'NIT',
			'CÉDULA CIUDADANÍA'=>'Cédula Ciudadanía',
			'PASAPORTE'=>'Pasaporte'
		);
		return form_dropdown($name, $options, $estado,$extra);
	}
	
	function MakeEstadoCivil($name,$estado=null,$extra=array()){
		$options = array(
			''=> 'Seleccione',
			'Soltero (a)'		=>	'Soltero (a)',
			'Casado (a)'		=>	'Casado (a)',
			'Divorciado (a)'	=>	'Divorciado (a)',
			'Viudo (a)' 		=>	'Viudo (a)',
			'Unión Libre' 		=>	'Unión Libre'
		);
		return form_dropdown($name, $options, $estado,$extra);
	}

	function MakePelo($name,$estado=null,$extra=array()){
		$options = array(
			''=> 'Seleccione',
			'Negro'		=>	'Negro',
			'Castaño'	=>	'Castaño',
			'Castaño'	=>	'Castaño',
			'Rojo'		=>	'Rojo',
			'Cenizo'	=>	'Cenizo',
			'Rubio' 	=>	'Rubio',
			'Otro' 		=>	'Otro'
		);
		return form_dropdown($name, $options, $estado,$extra);
	}

	function MakeLargoPelo($name,$estado=null,$extra=array()){
		$options = array(
			''=> 'Seleccione',
			'Corto'		=>	'Corto',
			'Mediano'	=>	'Mediano',
			'Largo'	=>	'Largo'
		);
		return form_dropdown($name, $options, $estado,$extra);
	}

	function Accesorios($name,$estado=null,$extra=array()){
		$options = array(
			''=> 'Seleccione',
			'Pequeños'	=>	'Pequeños',
			'Medianos'	=>	'Medianos',
			'Grandes'	=>	'Grandes',
			'N.A.'		=>	'N.A.'
		);
		return form_dropdown($name, $options, $estado,$extra);
	}

	function TamAccesorios($name,$estado=null,$extra=array()){
		$options = array(
			''=> 'Seleccione',
			'Cortas - Sin pintar'	=>	'Cortas - Sin pintar',
			'Cortas - Decoradas adecuadamente'	=>	'Cortas - Decoradas adecuadamente',
			'Largas - Sin pintar'	=>	'Largas - Sin pintar',
			'Largas - Decoradas adecuadamente'		=>	'Largas - Decoradas adecuadamente'
		);
		return form_dropdown($name, $options, $estado,$extra);
	}

	function set_estado($tab,$field,$id,$estado){
		$tabla		=		DB_PREFIJO.$tab;
		$ci = get_instance();
		if(is_string($field)){
			$ci->db->where($field, $id);
		}else{
			foreach ($field as $k => $v) {
				$ci->db->where($v, $id[$k]);
			}
		}
		if($ci->db->update($tabla,array("estado"=>$estado))){
			return true;
		}else{
			return false;
		}
	}


	function set_escala_user($vacios = null){
		$tabla		=		DB_PREFIJO."usuarios";
		$id_por_defecto = get_id_escala_por_defecto();
		$ci = get_instance();
		if(empty($vacios)){
			$ci->db->where("id_escala", $ci->uri->segment(3));
		}else{
			$ci->db->where("id_escala", '');
			$ci->db->or_where("id_escala", 0);
			$ci->db->or_where("id_escala", NULL);
		}
		$ci->db->where("centro_de_costos", $ci->user->centro_de_costos);
		$ci->db->where("id_empresa", $ci->user->id_empresa);
		$ci->db->where("type", "Modelos");
		if($ci->db->update($tabla,array("id_escala"=>$id_por_defecto->id_escala))){
			return true;
		}else{
			return false;
		}
	}

	function get_id_escala_por_defecto(){
		$ci 	= get_instance();
		$nombre_escala =  json_decode(@get_form_control(base_url("Usuarios/configuracionEscala"),null,1)[0]->data)->Escala_por_defecto;
		$tabla 	= DB_PREFIJO."ve_escala_pagos";
		$ci->db->select("id_escala");
		$ci->db->from($tabla);
		$ci->db->where("nombre_escala",$nombre_escala);
		$query			=	$ci->db->get();
		return $query->row();
	}

	function MakeNivelAcademico($name,$estado=null,$extra=array()){
		$options = array(
			''=> 'Seleccione',
			"Ninguno" 			=> "Ninguno",
			"Bachiller"			=> "Bachiller",
			"Técnico"			=> "Técnico",
			"Tecnólogo"			=> "Tecnólogo",
			"Profesional"		=> "Profesional"
			
		);
		return form_dropdown($name, $options, $estado,$extra);
	}

	function DescuentoDolar($name,$estado=null,$extra=array()){
		$options = array(
			''=> 'Seleccione',
			'Porcentual' 	 => 'Porcentual',
			'valor fijo' => 'valor fijo');
		return form_dropdown($name, $options, $estado,$extra);
	}

	function MakeHora($name,$estado=null,$extra=array()){
		$options = array();
		for ($i=0; $i < 13 ; $i++) {
			if($i < 10){
				$options[.0.$i] = '0'.$i;
			}else{
				$options[$i] = $i;
			}  
				
		}
		return form_dropdown($name, $options,$estado,$extra);
	}

	function MakeMinutos($name,$estado=null,$extra=array()){
		$options = array();
		for ($i=0; $i < 60 ; $i++) {
			if($i < 10){
				$options[.0.$i] = '0'.$i;
			}else{
				$options[$i] = $i;
			}  
				
		}
		return form_dropdown($name, $options,$estado,$extra);
	}

	function MakeEstrato($name,$estado=null,$extra=array()){
		$options = array(
			''=> 'Seleccione',
			'1'=>'Uno (1)',
			'2'=>'Dos (2)',
			'3'=>'Tres (3)',
			'4'=>'Cuatro (4)',
			'5'=>'Cinco (5)'
		);
		return form_dropdown($name, $options, $estado,$extra);
	}

	function MakeMeridiano($name,$estado=null,$extra=array()){
		$options = array(
			'Am'=> 'am',
			'Pm'=>'pm'
		);
		return form_dropdown($name, $options, $estado,$extra);
	}
	
	function MakeDescuentosConceptos($name,$estado=null,$extra=array()){
		$options = array(
			''=> 'Seleccione',
			'Sanción Room en mal estado'		=>	'Sanción Room en mal estado',
			'Llegada Tarde'						=>	'Llegada Tarde',
			'Inasistencia'						=>	'Inasistencia',
			'Sanción Página' 					=>	'Sanción Página',
			'Daño mobiliario' 					=>	'Daño mobiliario',
			'Juguetería o lencería' 			=>	'Juguetería o lencería',
			'Otro' 								=>	'Otro'
		);
		return form_dropdown($name, $options, $estado,$extra);
	}
	
	function MakeTipoIdentificacion2($name,$estado=null,$extra=array()){
		$options = array(
			''=> 'Seleccione',
			'CÉDULA CIUDADANÍA'=>'Cédula Ciudadanía',
			'PASAPORTE'=>'Pasaporte'
		);
		return form_dropdown($name, $options, $estado,$extra);
	}
	
	function MakeTipoPagina($name,$estado=null,$extra=array()){
		$options = array(
			''=> 'Seleccione',
			'PVT'=>'PVT',
			'Free'=>'Free',
			'RPH'=>'RPH',
			'RSS'=>'RSS'
		);
		return form_dropdown($name, $options, $estado,$extra);
	}
	
	function MakeMonedaPago($name,$estado=null,$extra=array()){
		$options = array(
			''=> 'Seleccione',
			'Tokens'=>'Tokens',
			'Créditos'=>'Créditos',
			'Dólares'=>'Dólares',
			'Euros'=>'Euros',
			'RSS'=>'RSS'
		);
		return form_dropdown($name, $options, $estado,$extra);
	}
	
	function MakeMonedas($name,$estado=null,$extra=array()){
		$options = array(
			'COP'=> 'COP',
			'USD'=>'$ USD'
		);
		return form_dropdown($name, $options, $estado,$extra);
	}
	
	function MakeCuentaBancaria($name,$estado=null,$extra=array()){
		$options = array(
			''=> 'Seleccione',
			'Bancaria Nacional'=>'Bancaria Nacional',
			'Bancaria internacional'=>'Bancaria internacional',
			'Crédito prepagada'=>'Crédito prepagada'
		);
		return form_dropdown($name, $options, $estado,$extra);
	}
	
	function MakeModalidadCuentaBancaria($name,$estado=null,$extra=array()){
		$options = array(
			''=> 'Seleccione',
			'Cuenta Corriente - Moneda nacional'=>'Cuenta Corriente - Moneda nacional',
			'Cuenta Corriente - Moneda extranjera'=>'Cuenta Corriente - Moneda extranjera',
			'Cuenta de Ahorros'=>'Cuenta de Ahorros',
			'Convenio de Pagos'=>'Convenio de Pagos',
			'Organismos Cooperativos Financieros'=>'Organismos Cooperativos Financieros',
			'Derechos en fideicomiso de inversión'=>'Derechos en fideicomiso de inversión',
			'Rotativo - Moneda Nacional'=>'Rotativo - Moneda Nacional',
			'Tarjeta de Crédito'=>'Tarjeta de Crédito',
			'Crédito prepagado - Monedero virtual'=>'Crédito prepagado - Monedero virtual',
			'Ewallet'=>'Ewallet',
		);
		return form_dropdown($name, $options, $estado,$extra);
	}
	
	function MakeEquivalencia($name,$estado=null,$extra=array()){
		$options = array(
			''=> 'Seleccione',
			'1'=>'1 Dólar',
			'0,05'=>'0,05 Dólar',
			'0,04'=>'0,04 Dólar',
			'0,033'=>'0,033 Dólar',
			'Otro'=>'Otra'
		);
		$estado		=	($estado!="1" && $estado!="0,05" && $estado!="0,04" && $estado!="0,033")?"Otro":$estado;
		return form_dropdown($name, $options, $estado,$extra);
	}
	
	function MakeTipoContratacion($name,$estado=null,$extra=array()){
		$options = array(
			''=> 'Seleccione',
			1=>'Un (1) mes',
			2=>'Dos (2) meses',
			3=>'Tres (3) meses',
			6=>'Seis (6) meses',
			12=>'Doce (12) meses',
			18=>'Dieciocho (18) meses',
			24=>'Veinticuatro (24) meses'
		);
		return form_dropdown($name, $options, $estado,$extra);
	}
	
	function MakePeriodoPagos($name,$estado=null,$extra=array()){
		$options = array(
			''=> 'Seleccione',
			4=>'Semanal',
			2=>'Quincenal'
		);
		return form_dropdown($name, $options, $estado,$extra);
	}
	
	function calcula_montos_x_dias($base,$dias_trabajados){
		return ($base  /  30) * $dias_trabajados;		
	}
	
	function get_escala_x_user_id2($user_id){
		$ci 				=& 	get_instance();
		$tabla				=		DB_PREFIJO."ve_escala_pagos t1";
		$ci->db->select("t1.*");
		$ci->db->from($tabla);
		$ci->db->join(DB_PREFIJO."usuarios t2", 't1.id_escala 	= 	t2.id_escala', 'left');
		$ci->db->where("t2.user_id",$user_id);
		$query			=	$ci->db->get();
		return $query->row();		
	}
	
	function get_escala_x_user_id($user_id){
		$ci 				=& 	get_instance();
		$tabla				=		DB_PREFIJO."ve_escala_pagos t1";
		$ci->db->select("*");
		$ci->db->from($tabla);
		$ci->db->join(DB_PREFIJO."usuarios t2", 't1.id_escala 	= 	t2.id_escala', 'left');
		$ci->db->where("t2.user_id",$user_id);
		$query			=	$ci->db->get();
		return $query->row();		
	}
	
	function escala($id_escala){
		$ci 				=& 	get_instance();
		$tabla				=		DB_PREFIJO."ve_escala_pagos t1";
		$ci->db->select("*");
		$ci->db->from($tabla);
		$ci->db->where("t1.id_escala",$id_escala);
		$query			=	$ci->db->get();
		return $query->row();		
	}
	
	function get_escala_pagos($estado=null,$extra=array(),$name= "id_escala",$key='id_escala'){
		$ci 				=& 	get_instance();
		$tabla				=		DB_PREFIJO."ve_escala_pagos";
		$ci->db->select("*");
		$ci->db->from($tabla);
		$ci->db->where("id_empresa",$ci->user->id_empresa);
		$ci->db->where("estado",1);
		//$ci->db->where("centro_de_costos",$ci->user->centro_de_costos);
		$ci->db->order_by('nombre_escala','ASC');
		$query			=	$ci->db->get();
		$rows			=	$query->result();
		$option 		= 	array(""=>"Seleccione");
		foreach($rows as $v){
			$option[$v->$key] 	= 	$v->nombre_escala;	
		}
		return form_dropdown($name, $option, $estado,$extra);
	}
	
	function get_rel_plataforma($id_plataforma){
		$ci 				=& 	get_instance();
		$tabla				=		DB_PREFIJO."cf_rel_plataformas";
		$get				=	$ci->db->select("rel_plataforma_id")
								->from($tabla)
								->where('id_plataforma',$id_plataforma)
								->where('id_empresa',$ci->user->id_empresa)
								//->where('centro_de_costos',$ci->user->centro_de_costos)
								->get()
								->row();
		if(!empty($get)){
			return true;	
		}else{
			return false;	
		}						
		
	}
	
	function get_concepto_gastos($estado=null,$extra=array()){
		$ci 				=& 	get_instance();
		$tabla				=		DB_PREFIJO."cont_gastos_operacionales";
		$ci->db->select("*");
		$ci->db->from($tabla);
		$ci->db->order_by('descripcion','ASC');
		$query			=	$ci->db->get();
		$rows			=	$query->result();
		$option 		= 	array(""=>"Seleccione");
		foreach($rows as $v){
			$option[$v->gastos_id] 	= 	$v->descripcion;	
		}
		return form_dropdown("gastos_id", $option, $estado,$extra);
	}
	
	function MakeMaster(){
		$ci=&get_instance();
		$tabla=DB_PREFIJO."cf_rel_master t1";
		$ci->db->select("*,t2.tipo_persona");
		$ci->db->from($tabla);
		$ci->db->join(DB_PREFIJO."usuarios t2", 't1.id_plataforma 	= 	t2.user_id', 'left');
		$ci->db->where("t1.id_empresa",$ci->user->id_empresa);
		//$ci->db->where("t1.centro_de_costos",$ci->user->centro_de_costos);
		$ci->db->order_by('t1.nombre_master','ASC');
		$query					=	$ci->db->get();
		$rows					=	$query->result();
		$option 				= 	array(""=>"Seleccione");
		$html					=	'<select name="id_master" id="id_master" class="form-control">';	
			foreach($rows as $v){
				$html			.= 	'<option class="item_plataforma '.$v->id_plataforma.'" value="'.$v->rel_plataforma_id.'">'.$v->nombre_master.'</option>';
			}
		$html					.=	'</select>';	
		return $html;
	}
	
	function MakeCiclosPagos($name,$estado=null,$extra=array(),$options){
		$option 		= 	array(""=>"Seleccione");
		foreach($options as $v){
			$option[$v->id_forma_pago] 	= 	$v->nombre_escala;	
		}
		return form_dropdown($name, $option, $estado,$extra);
	}

	function consultaCiclo(){
		$ci = get_instance();
		$tabla				=	DB_PREFIJO."cf_ciclos_pagos";
		$ci->db->select("mes");
		$ci->db->from($tabla);
		$ci->db->where("id_empresa",$ci->user->id_empresa);
		$ci->db->where('centro_de_costos', $ci->user->centro_de_costos);
		$ci->db->where('fecha_hasta >=',date("Y")."-01-01");
		$ci->db->group_by("mes");
		$query						=	$ci->db->get();
		$rows =  $query->result();
		$ciclos = array();
		foreach ($rows as $k => $v) {
			$ciclos[$v->mes] = $v->mes;
		}
		return $ciclos;
	}	
	
	function MakeMes($name,$class,$index){
		$ciclos_cerrados = consultaCiclo();
		$html	=	'<select id="mesese" name="'.$name.'" class="form-control verify'.$class.'" require><option value="">Seleccione</option>';
			$invalido = 0;
			for($i=$index; $i <=12 ; $i++){ 
				if(!empty($ciclos_cerrados[$i]) ){
					$invalido = $i;
					$html .= '<option value="" style="color:red;" disabled="disabled">'.mes($ciclos_cerrados[$i]).'</option>'; 
					if($index == 12){
						for($b=1; $b <=4 ; $b++){
							if(!empty($ciclos_cerrados[$b]) ){
								$invalido = $b;
								$html .= '<option value="" style="color:red;" disabled="disabled">'.mes($ciclos_cerrados[$b]).'</option>';
							}else{
								$html .= '<option class="validar" value="'.$b.'">'.mes($b).'</option>';
							} 
						}
					}
				}else{
					$html .= '<option class="validar" value="'.$i.'">'.mes($i).'</option>';
					if($index == 12){
						for($b=1; $b <=4 ; $b++){
							$html .= '<option class="validar" value="'.$b.'">'.mes($b).'</option>';
						}
					}
				}
			}
		$html	.=	'</select><input type="hidden" id="invalido" value="'.$invalido.'">';
		return $html;
	}
	
	function MakeRoles($name,$estado=null,$extra=array()){
		$ci 	=& 	get_instance();
		$tabla						=	DB_PREFIJO."sys_roles";
		$ci->db->select("*")->from($tabla);
		$ci->db->where("estado",1);
		$ci->db->order_by('rol','ASC');
		$options		=	$ci->db->get()->result();
		$option 		= 	array(""=>"Seleccione");
		foreach($options as $v){
			$option[$v->rol_id] 	= 	$v->rol;	
		}
		return form_dropdown($name, $option, $estado,$extra);
	}
	
	function MakeUsers($name,$estado=null,$extra=array(),$options){
		$option 		= 	array(""=>"Seleccione");
		foreach($options as $v){
			$option[$v->user_id] 	= 	$v->nombre_legal;	
		}
		return form_dropdown($name, $option, $estado,$extra);
	}
	
	function MakeEmpresas($name,$estado=null,$extra=array(),$options){
		$option 		= 	array(""=>"Seleccione");
		foreach($options as $v){
			$option[$v->user_id] 	= 	$v->nombre_legal;	
		}
		return form_dropdown($name, $option, $estado,$extra);
	}
	
	function MakeListCentrosCostosRooms($name,$estado=null,$extra=array(),$options){
		$option 		= 	array(""=>"Seleccione");
		foreach($options as $v){
			$option[$v->user_id] 	= 	$v->nombre_legal;
			//$option[$v->n_rooms] 	= 	$v->nombre;	
		}
		return form_dropdown($name, $option, $estado,$extra);
	}
	
	function MakeListCentrosCostosAsociados($name,$estado=null,$extra=array(),$options){
		$option 		= 	array(""=>"Seleccione");
		foreach($options as $v){
			$option[$v->user_id] 	= 	$v->nombre_legal ;	
		}
		return form_dropdown($name, $option, $estado,$extra);
	}
	
	function MakeUsersNoRoot($name,$estado=null,$extra=array(),$options){
		$option 		= 	array(""=>"Seleccione");
		
		$users			=	array();
		
		foreach($options as $v){
			$users[$v->user_id]		=	(!empty($v->primer_nombre))?$v->primer_nombre.' '.$v->primer_apellido :$v->persona_contacto;		
		}
		
		asort($users);
		
		foreach($users as $k	=> $v){
			$option[$k]=$v;	
		}
		return form_dropdown($name, $option, $estado,$extra);
	}
	
	function upload($file='userfile',$path='images/uploads/',$config=array("allowed_types"=>'gif|jpg|png')){
		$config['upload_path']        = 	PATH_BASE.$path;
		if(!is_dir($config['upload_path'])){
			if(mkdir($config['upload_path'], 0755,true)){
				$fp		=	fopen($config['upload_path'].'/index.html',"w");
				fwrite($fp,'<a href="http://programandoweb.net">PROGRAMANDOWEB</a>');
				fclose($fp); 
			}else{
				return false;
			}
		}
		$config['encrypt_name']       = 	TRUE;
		$ci 	=& 	get_instance();
		$ci->load->library('upload', $config);	
		//print_r($file);return;
		if(isset($_FILES[$file])){	
			if ($ci->upload -> do_upload($file)){
				return array('upload_data' => $ci->upload->data());
			}else{
				return array('error' => $ci->upload->display_errors());
			}
		}
	}

	function upload2($file='userfile',$path='images/uploads/',$config=array("allowed_types"=>'gif|jpg|png|jpeg',"max_size" => 4000,"max_width"=>10000,"max_height"=>10000)){
		$config['upload_path']        = 	PATH_BASE.$path;
		
		if(!is_dir($config['upload_path'])){
			if(mkdir($config['upload_path'], 0755,true)){
				$fp		=	fopen($config['upload_path'].'/index.html',"w");
				fwrite($fp,'<a href="http://programandoweb.net">PROGRAMANDOWEB</a>');
				fclose($fp); 
			}else{
				return false;
			}
		}
		$config['encrypt_name']       = 	false;
		$ci 	=& 	get_instance();
		$ci->load->library('upload', $config);	
		//pre($file);return;
		//echo answers_json($_FILES[$file] );	
		//die();
		if(isset($_FILES[$file])){	
			if ($ci->upload -> do_upload($file)){
				return array('upload_data' => $ci->upload->data());
			}else{
				return array('error' => $ci->upload->display_errors());
			}
		}
	}

	function calidadImagen($calidad=30,$file='userfile',$path='images/uploads/',$config=array("allowed_types"=>'gif|jpg|png|jpeg')){
		
		$upload = upload2($file,$path,$config);
		
		//echo answers_json($file);	
		//die();
		if(empty($upload['error'])){
			$ci = get_instance();
			$ci->load->library('image_lib');
			if($upload['upload_data']['file_size'] > 200){
				$config['quality'] = "200 kilobytes";
			}
			$ci->load->library('image_lib',$config);
			$config['image_library'] = 'gd2';
			$config['source_image']  = $upload['upload_data']['full_path'];

			if($ci->image_lib->resize()){
				return array("upload_data"=>"Imagen subida y optimisada correctamente");
			}else{
				return array("error"=>$ci->image_lib->display_errors());
			}
		}else{
			return $upload;
		}	
	}

	function verArchivo($ruta='images/uploads/',$vector=false){
		$ci = get_instance();
		$ci->load->helper("directory");
		$map = directory_map($ruta,false,false);
		$imagen = '';
		if($vector){
			$imagen = $map;
		}else{
			if(!empty($map)){
				foreach ($map as $k => $v){
					if($v !== "index.html"){
						$imagen .= '<img src="'.base_url($ruta.'/'.$v).'" class="img-fluid" alt="file no found">';
					}
				}
			}
		}
		return $imagen;
	}

	function descargarArchivo($id,$directorio=null){
		$ci 	=& 	get_instance();
		$ci->load->helper('download');
		if(!empty($directorio) && !empty($id)){
			$data = file_get_contents($directorio.$id);
			force_download($id,$data);
		}else{
			$carpeta = 'images/Novedades/'.$id;
		}
		if(is_dir($carpeta)){
	        if($dir = opendir($carpeta)){
	            while(($archivo = readdir($dir)) !== false){
	                if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess' && $archivo != 'index.html'){
	                	$data = file_get_contents($carpeta.'/'.$archivo);
						force_download('Archivo',$data);
	                }
	            }
	            closedir($dir);
	        }
	    }
		return true;
	}
	
	function set_input_hidden($name,$id='',$row,$format = false){
		if($id==''){
			$id	=	$name;
		}
		$data = array(
				'type'  => 	'hidden',
				'name'  => 	$name,
				'id'    => 	$id
		);
		if(is_object($row)){
			if(isset($row->$name)){
				if($format){
					$data['value']	=	format($row->$name,true);
				}else{
					$data['value']	=	$row->$name;
				}
			}
		}else{
			if($format){
				$data['value']	=	format($row,true);
			}else{
				$data['value']	=	$row;
			}
		}
		echo form_input($data);
	}

	function set_input_checkbox($name,$id='',$value,$cheked,$extra){
		if($id==''){
			$id	=	$name;
		}
		$data = array(
				'type'  => 	'checkbox',
				'name'  => 	$name,
				'id'    => 	$id,
				'class'	=> 	'custom-control-input'
		);
		if(empty($name)){
			unset($data['name']);
		}
		echo '<label class="custom-control custom-checkbox">';
		echo form_checkbox($data,$value,$cheked,$extra).'<span class="custom-control-indicator"></span></label>';
	}

	function OpcionesConfigEmail($data){
		$ci = get_instance();
		$html = '';
		if(!empty($data)){
			foreach ($data as $k => $v){
				if(is_object($v) || is_array($v)){
					foreach ($v as $k1 => $v1){
						$html .=   '<div class="col-md-12 mt-1">
								<button type="button" class="btn btn-light col-md-12 opcionConfigEmail" data-val="'.$k1.'">'.$k1.'</button>
							</div>';
					}
				}else{
					$html .=   '<div class="col-md-12 mt-1">
						<button type="button" class="btn btn-light col-md-12 opcionConfigEmail" data-val="'.$k.'">'.$k.'</button>
					</div>';
				}
			}
		}
		return $html;
	}

	function set_input_radio($name,$id='',$value,$cheked,$clase,$extra){
		if($id==''){
			$id	=	$name;
		}
		$data = array(
				'type'  => 	'radio',
				'name'  => 	$name,
				'id'    => 	$id,
				'class'	=>  $clase
		);
		echo '<label class="custom-control custom-checkbox">';
		echo form_radio($data,$value,$cheked,$extra).'<span class="custom-control-indicator"></span></label>';
	}
	
	function get_dias_trabajados($user_id,$ciclo_de_produccion){
		$ci 					=& 	get_instance();
		return $ci->db->select('*')->from(DB_PREFIJO."rp_dias_trabajados")->where('user_id',$user_id)->where('ciclo_de_produccion',$ciclo_de_produccion)->get()->row();
	}
	
	function set_input_dinamico($name,$row,$placeholder='',$require=false,$class='',$extra=NULL,$hidden=array("user_id"),$type = "text"){
		$data = array(
			'type' 			=> 	$type,
			'readonly'		=> 	'readonly',
			'input_dinamico'=> 	'true',
			'name'  		=> 	$name,
			'id'    		=> 	$name,
			'placeholder' 	=> 	$placeholder,
			'class' 		=> 	'form-control '.$class
		);	
		if(is_array($extra)){
			foreach($extra as $k => $v){
				$data[$k]	=	$v;
			}
		}	
		if($require){
			$data['require']=	$require;
		}
		if(isset($row->$name)){
			$data['value']	=	$row->$name;
		}else{
			$data['value']	=	0;
		}
		$hidden_array=array();
		if(is_array($hidden)){
			foreach($hidden as $k => $v){
				$hidden_array[$v]	=	$row->$v;
			}
		}	
		//pre($row);
		echo form_open(current_url(),array('ajax' => 'true'),$hidden_array);	
		echo form_input($data);
		echo form_close();
	}

	function comprobar_website($url){
	    $h = get_headers($url);
	    $status = array();
	    preg_match('/HTTP\/.* ([0-9]+) .*/', $h[0] , $status);
	    if($status[1] == 200){
	    	return true;
	    }else{
	    	return false;
	    }
	}
	
	function set_input($name,$row,$placeholder='',$require=false,$class='',$extra=NULL,$format=false,$id_por_defecto=true){
		$data = array(
			'type' 			=> 	'text',
			'name'  		=> 	$name,
			'placeholder' 	=> 	$placeholder,
			'class' 		=> 	'form-control '.$class
		);
		if($id_por_defecto){
			$data['id'] = $name;
		}
		if(is_array($extra)){
			foreach($extra as $k => $v){
				$data[$k]	=	@$v;
			}
		}
		if($require){
			$data['require']=	$require;
		}
		if(is_array($row)){
			if($format){
				$data['value']	=	format(@$row[$name],true);
			}else{
				$data['value']	=	@$row[$name];
			}
		}else if(is_object($row)){
			if($format){
				$data['value']	=	format(@$row->$name,true);
			}else{
				$data['value']	=	@$row->$name;
			}
		}else{
			if($format){
				$data['value']	=	format(@$row,true);
			}else{
				$data['value']	=	@$row;
			}
		}
		echo form_input($data);
	}
	
	function logs($user,$tipo_transaccion,$tabla_afectada,$registro_afectado_id=NULL,$modulo_donde_produjo_cambio=NULL,$accion=1,$json=array()){
		$ci 	=& 	get_instance();
		$ci->db->insert(DB_PREFIJO."sys_logs",array(	
										"fecha"=>date("Y-m-d H:i:s"),
										"user_id"=>$user->user_id,
										"tipo_transaccion"=>$tipo_transaccion,
										"tabla_afectada"=>$tabla_afectada,
										"registro_afectado_id"=>$registro_afectado_id,
										"modulo_donde_produjo_cambio"=>$modulo_donde_produjo_cambio,
										"accion"=>$accion,
										"json"=>json_encode($json)));
			
	}
	
	function ini_session($user){
		$ci 	=& 	get_instance();
		$session_id		=	md5(date("Y-m-d H:i:s"));
		if(is_object($user)){
			$user->session_id		=	$session_id;
			$insert					=	$ci->db->insert(DB_PREFIJO."sys_session",array(	"fecha"=>date("Y-m-d H:i:s"),
																						"user_id"=>$user->user_id,
																						"session_id"=>$user->session_id));
		}else if(is_array($user)){
			$user['session_id']		=	$session_id;
			$insert					=	$ci->db->insert(DB_PREFIJO."sys_session",array(	"fecha"=>date("Y-m-d H:i:s"),
																						"user_id"=>$user["user_id"],
																						"session_id"=>$user["session_id"]));
		}
		if($insert){
			return $user;													
		}else{
			return false;	
		}
	}
	
	function chequea_session($user,$bool=false){
		$ci 					=& 	get_instance();
		$session				=	$ci->db->select('*')->from(DB_PREFIJO."sys_session")->where('session_id',$user->session_id)->get()->row();
		$fechaGuardada 			= 	$session->fecha;
		$ahora 					= 	date("Y-m-d H:i:s");  
		$tiempo_transcurrido 	= 	(strtotime($ahora)-strtotime($fechaGuardada));    
		if($tiempo_transcurrido>=SESSION_TIME){
			if($bool){
				return false;	
			}else{
				redirect(base_url("autenticacion/salir"));
			}
		}else{
			if($bool){
				return true;				
			}else{
				$ci->db->where('session_id', $user->session_id);
				$ci->db->update(DB_PREFIJO."sys_session",array("fecha"=>$ahora));
			}
		}
	}
	
	function tiempo_session($user){
		$ci 					=& 	get_instance();
		$session				=	$ci->db->select('*')->from(DB_PREFIJO."sys_session")->where('user_id',$user->user_id)->get()->row();
		$fechaGuardada 			= 	$session->fecha;
		$ahora 					= 	date("Y-m-d H:i:s");  
		$tiempo_transcurrido 	= 	(strtotime($ahora)-strtotime($fechaGuardada)); 
		$user->session_id		=	$session->session_id;
		if($tiempo_transcurrido>=SESSION_TIME){
			destruye_session($user);
			return ini_session($user);
		}else{
			return false;
		}
	}
	
	function destruye_session($user){
		$ci 					=& 	get_instance();
		if(is_object($user)){
			$ci->db->where('session_id', $user->session_id);
			$ci->db->delete(DB_PREFIJO."sys_session");
			return true;
		}else{
			$ci->db->where('session_id', $user["session_id"]);
			$ci->db->delete(DB_PREFIJO."sys_session");
			return true;
		}
	}
	
	function Destroy($session_id){
		$ci 					=& 	get_instance();
		$ci->db->where('session_id', $session_id);
		$ci->db->delete(DB_PREFIJO."sys_session");
	}
	
	function ciclopago($periodo_pagos,$mes,$fecha){
		$periodo=strftime("%d",strtotime($fecha));
		$year = strftime("%Y",strtotime($fecha));
		$mes	=	(int)$mes;
		$mes	=	($mes<10)?'0'.$mes:$mes;
		if($periodo_pagos==4){
			if($periodo=="01"){
				return "S1".'-'.$mes.'-'.$year;
			}else{
				return "S3".'-'.$mes.'-'.$year;
			}
		}else{
			if($periodo=="01"){
				return "Q1".'-'.$mes.'-'.$year;
			}else{
				return "Q2".'-'.$mes.'-'.$year;
			}
		}
	}
	
	function get_ciclo_pago($periodo_pagos){
		if($periodo_pagos==4){
			
			if(date("d")<16){
				return 1;	
			}else{
				return 3;	
			}	
		}else{
			if(date("d")<16){
				return 1;	
			}else{
				return 2;	
			}
		}	
	}
	
	function factura_json($user_id){
		//$ci 				=& 	get_instance();
		//return $ci->db->select('*')->from(DB_PREFIJO."rp_factura")->get()->row();
		//return $ci->db->select('*')->from(DB_PREFIJO."rp_factura")->where('JSON_SEARCH("items","all", "nickname_id")=',$user_id)->get()->row();	
	}
	
	function periodotrm($fecha){
		$ci 				=& 	get_instance();
		/*
		if(date("d")<15){
			$periodo	= 	date("Y-m-").'01';	
		}else{
			$periodo	=	date("Y-m-").'16';	
		}*/	
		return $ci->db->select('*')->from(DB_PREFIJO."sys_trm")->where('fecha',$fecha)->get()->row();	
	}
	
	function trm_ciclo($tipo_periodo,$periodo,$mes){
		$ci 				=& 	get_instance();
		$tipo_periodo		=	($tipo_periodo==2)?$semana="Q":$semana="S";
		$mes_con_cero		=	($mes<10)?"0".$mes:$mes;
		if($tipo_periodo=="Q"){
			if($periodo==1){
				$return				=	"16-".$mes_con_cero.'-'.date("Y");
				//$periodo			=	"-".$mes_con_cero."-16";
				$periodo			=	"-".$mes_con_cero."-01";
				$periodo_para_mysql	=	date("Y").'-'.$mes_con_cero.'-16';
			}else{
				$return				=	"01-".$mes_con_cero.'-'.date("Y");
				//$periodo			=	($mes + 1)."-01";	
				$periodo			=	($mes)."-16";	
				$periodo_para_mysql	=	date("Y").'-'.$mes_con_cero.'-01';
			}
			//$trm			=	$ci->db->select('*')->from(DB_PREFIJO."sys_trm")->where('fecha',date("Y-").$periodo)->get()->row();
			if(date("Y").'-'.$periodo > date("Y-m-d")){
				$fecha = date("Y-m-d");
			}else{
				$fecha = date("Y").'-'.$periodo;
			}
			$trm			=	$ci->db->select('*')->from(DB_PREFIJO."sys_trm")->where('fecha',$fecha)->get()->row();
		}
		if($tipo_periodo=="S"){
			if($periodo==1 || $periodo==2){
				$return				=	"16-".$mes_con_cero.'-'.date("Y");
				$periodo			=	"-".$mes_con_cero."-16";
				$periodo_para_mysql	=	date("Y").'-'.$mes_con_cero.'-16';
			}else{
				$return				=	"01-".$mes_con_cero.'-'.date("Y");
				$periodo			=	($mes + 1)."-01";	
				$periodo_para_mysql	=	date("Y").'-'.$mes_con_cero.'-01';
			}
			$periodo		=	($periodo==3)?"-16":"-01";
			//$trm			=	$ci->db->select('*')->from(DB_PREFIJO."sys_trm")->where('fecha',date("Y-").$periodo)->get()->row();		
			$trm			=	$ci->db->select('*')->from(DB_PREFIJO."sys_trm")->where('fecha',date("Y").$periodo)->get()->row();		
		}
		return array("trm"=>$trm,"periodo"=>$return,"periodo_para_mysql"=>$periodo_para_mysql);
	}
	
	function trm_vigente($int = null){
		$ci 			=& 	get_instance();
		$trm_ayer		=	$ci->db->select('*')->from(DB_PREFIJO."sys_trm")->where('DATEDIFF(NOW(),fecha)<',2)->get()->row();
		$trm			=	$ci->db->select('*')->from(DB_PREFIJO."sys_trm")->where('fecha',date("Y-m-d"))->get()->row();
		if($trm_ayer->monto<@$trm->monto){
			$post		=	'<i class="fa fa-arrow-up" aria-hidden="true"></i>';	
		}else if($trm_ayer->monto>@$trm->monto){
			$post		=	'<i class="fa fa-arrow-down" aria-hidden="true"></i>';	
		}else{
			$post		=	'';	
		}
		//print_r($trm_ayer);
		if(empty($trm)){
			$precio_dolar	=	file_get_contents("https://dolar.wilkinsonpc.com.co/widgets/gratis/dolar-cop-usd-1.html");
			$regex 			= 	'#\<div id="widget_valor"\>(.+?)\<\/div\>#s';
			preg_match($regex, $precio_dolar, $matches);
			$precio_dolar	= 	floatval(str_replace(array("$",","),"",$matches[1]));
			$ci->db->insert(DB_PREFIJO."sys_trm",array(	
										"monto"	=>	$precio_dolar,
										"fecha"	=>	date("Y-m-d")));
			if(!empty($int)){
				return $precio_dolar;
			}
			echo '$'.number_format($precio_dolar,2,',', '.').' '.$post	;
		}else{
			if(!empty($int)){
				return $trm->monto;
			}
			echo '$'.number_format($trm->monto,2,',', '.').' '.$post;	
		}
		
	}
	
	function centrodecostos($centro_de_costos){
		$ci 	=& 	get_instance();
		$tabla						=	DB_PREFIJO."usuarios";
		return $ci->db->select("*")->from($tabla)->where("user_id",$centro_de_costos)->get()->row();
	}

	function getObservaciones($url){
		$ci 	=& 	get_instance();
		$tabla						=	DB_PREFIJO."sys_observaciones";
		return $ci->db->select("*")->from($tabla)->where("url",$url)->where("centro_de_costos",$ci->user->centro_de_costos)->where("empresa_id",$ci->user->id_empresa)->get()->result();
	}

	function nombreUsuario($user_id){
		$ci 	=& 	get_instance();
		$tabla						=	DB_PREFIJO."usuarios";
		return $ci->db->select("CONCAT(COALESCE(`primer_nombre`,''),' ',COALESCE(`segundo_nombre`,''),' ',COALESCE(`primer_apellido`,''),' ',COALESCE(`segundo_apellido`,'')) AS Responsable")->from($tabla)->where("user_id",$user_id)->get()->row();
	}

	function MakeTurnos($name,$estado=null,$row,$extra=array()){
		$sucursal = centrodecostos($row);
			$options = array(""	=>	"Seleccione");
			
				if($sucursal->turno_manama == 1){
					$options["turno_manama"] = "Mañana";
				}
				if($sucursal->turno_tarde == 1){
					$options["turno_tarde"] = "Tarde";
				}
				if($sucursal->turno_noche == 1){
					$options["turno_noche"] = "Noche";
				}
				if($sucursal->turno_intermedio == 1){
					$options["turno_intermedio"] = "Intermedio";
				}
		
		return form_dropdown($name, $options, $estado,$extra);
	}

	function VerificaTurnos($row){
		if(is_array($row)){
			
			if($row["turno_manama"] == 1){
				$row = "Mañana";
					return $row;
			}
			if($row["turno_tarde"] == 1){
				$row = "Tarde";
					return $row;
			}
			if($row['turno_noche'] == 1){
				$row = "Noche";
					return $row;
			}
			if($row["turno_intermedio"] == 1){
				$row = "Intermedio";
					return $row;
			}
		}elseif(is_object($row)){
				if($row->turno_manama == 1){
					$row = "Mañana";
					return $row;
				}
				if($row->turno_tarde == 1){
					$row = "Tarde";
					return $row;
				}
				if($row->turno_noche == 1){
					$row = "Noche";
					return $row;
				}
				if($row->turno_intermedio == 1){
					$row = "Intermedio";
					return $row;
				}
		}else{
			return $row;
		}
	}
	
	function MakeCentrodeCostos($id_empresa,$estado){
		$ci 	=& 	get_instance();
		$tabla						=	DB_PREFIJO."usuarios";
		$options=	$ci->db->select("*")
							->from($tabla)
							->where("type","CentroCostos")
							->where("id_empresa",$id_empresa)
							->get()
							->result();
		$option 		= 	array(""=>"Seleccione");
		$html	=	'<select id="centro_de_costos" name="centro_de_costos" class="form-control" require>';
		foreach($options as $k=> $v){
			if($estado==$v->user_id){
				$html	.=	'<option selected="selected" data-rooms="'.$v->n_rooms.'" data-manana="'.$v->turno_manama.'" data-tarde="'.$v->turno_tarde.'" data-noche="'.$v->turno_noche.'" data-intermedio="'.$v->turno_intermedio.'" value="'.$v->user_id.'">'.$v->nombre_legal.'</option>';	
			}else{
				$html	.=	'<option value="'.$v->user_id.'" data-rooms="'.$v->n_rooms.'" data-manana="'.$v->turno_manama.'" data-tarde="'.$v->turno_tarde.'" data-noche="'.$v->turno_noche.'" data-intermedio="'.$v->turno_intermedio.'">'.$v->nombre_legal.'</option>';	
			}
		}
		$html	.=	'</select>';
		return $html;
	}

	function MakeSucursal($id_empresa,$name,$estado,$extra=array(),$user_id=false){
		$ci 	=& 	get_instance();
		$tabla						=	DB_PREFIJO."usuarios";
		$data 	=	$ci->db->select("*")
							->from($tabla)
							->where("type","CentroCostos")
							->where("id_empresa",$id_empresa)
							->get()
							->result();
		$options = array(""=>"Seleccione");				
		foreach ($data as $k => $v) {
			if($user_id){
				$options[$v->user_id] = $v->nombre_legal;
			}else{
				$options[$v->nombre_legal] = $v->nombre_legal;
			}
			
		}
		return form_dropdown($name, $options, $estado,$extra);
	}

	/*function MakeModelos($name,$extra=array(),$estado=""){
		$tabla		=		DB_PREFIJO."usuarios";
		$ci=&get_instance();
		$ci->db->select('*')->from($tabla);
		$ci->db->where('id_empresa',$ci->user->id_empresa);
		$ci->db->where('type',"Modelos");
		$ci->db->where("estado",1);
		$query			=	$ci->db->get();
		$opciones 	=	$query->result();
		//return pre($opciones);
		$options = array(""=>"Seleccione");
		foreach ($opciones as $k => $v) {
			$options[$v->user_id] = @$v->primer_nombre.' '.@$v->segundo_nombre.' '.@$v->primer_apellido.' '.@$v->segundo_apellido;
		}
		return form_dropdown($name, $options, $estado,$extra);	
	}*/

	function MakeMonitores($id_empresa,$estado){
		$ci 	=& 	get_instance();
		$tabla						=	DB_PREFIJO."usuarios";
		$options=	$ci->db->select("*")
							->from($tabla)
							->where("type","Monitores")
							->where("id_empresa",$id_empresa)
							->where("estado",1)
							->get()
							->result();					
		$html	=	'<select id="Monitor" name="monitor" class="form-control"><option value="No asignado">No asignado</option>';
		foreach($options as $k=> $v){
			if($estado==$v->user_id){
				$html	.=	'<option selected="selected" value="'.$v->user_id.'">'.$v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido.'</option>';	
			}else{
				$html	.=	'<option value="'.$v->user_id.'">'.$v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido.'</option>';	
			}
		}
		$html	.=	'</select>';
		return $html;
	}
	
	function user_x_token($token){
		$ci 	=& 	get_instance();
		$tabla						=	DB_PREFIJO."usuarios";
		return $ci->db->select("*")->from($tabla)->where("token",$token)->get()->row();
	}
	
	function usuarios_like_name($like){
		$ci 	=& 	get_instance();
		$tabla						=	DB_PREFIJO."usuarios";
		return $ci->db->select("*")->from($tabla)->like("primer_nombre",$like)->get()->row();
	}
	
	function nickname_like_name($like,$pagina=null){
		$ci 	=& 	get_instance();
		$tabla	=	DB_PREFIJO."cf_nickname t1";
		$ci->db->select("*,t1.centro_de_costos");
		$ci->db->from($tabla);
		$ci->db->join(DB_PREFIJO."usuarios t2", 't1.id_plataforma=t2.user_id', 'left');
		if($pagina	!=	null){	
			$ci->db->like("t2.primer_nombre",trim ($pagina));
		}
		$ci->db->like("t1.nickname",trim($like));
		$query					=	$ci->db->get();
		return $query->row();
	}
	
	function nickname_like_name_plataforma($like,$id_plataforma){
		$ci 	=& 	get_instance();
		$tabla	=	DB_PREFIJO."cf_nickname t1";
		return $ci->db->select("*,t2.primer_nombre,t2.segundo_nombre,t2.primer_apellido,t2.segundo_apellido,t2.identificacion,t3.nombre_master")
					->from($tabla)
					->join(DB_PREFIJO."usuarios t2", 't1.id_modelo=t2.user_id', 'left')
					->join(DB_PREFIJO."cf_rel_master t3", 't1.id_master=t3.rel_plataforma_id', 'left')
					->where("t1.id_plataforma",$id_plataforma)
					->like("t1.nickname",$like)
					->get()
					->row();
	}
	
	function nrooms($centro_de_costos){
		$ci 	=& 	get_instance();
		$tabla						=	DB_PREFIJO."usuarios";
		return $ci->db->select("n_rooms")->from($tabla)->where("user_id",$centro_de_costos)->get()->row()->n_rooms;
	}
	
	function format($num,$decimal=true,$decimales=true){
		if($num==0 || $num=='') $num=0;
		if($decimales){
			if($decimal){
				return number_format($num, 2, ',', '.');	
			}else{
				return number_format($num,0, '', '.');	
			}
		}else{
			return number_format($num,0, '', '');		
		}
	}

	function VerificarChecbox($num){
		if($num=='Si'){
			$html= '<td width="50">Si</td>
		            <td width="50"><div class="bordeAll" style="width: 15px;height: 15px; vertical-align: middle;text-align:center;">X</div></td>
		            <td width="50">No</td>
		            <td width="40"><div class="bordeAll" style="width: 15px;height: 15px;"></div></td>';
		    return $html;
		}else if($num=='No'){
			$html= '<td width="50">Si</td>
		            <td width="50"><div class="bordeAll" style="width: 15px;height: 15px;"></div></td>
		            <td width="50">No</td>
		            <td width="40"><div class="bordeAll" style="width: 15px;height: 15px;vertical-align: middle;text-align:center;">X</div></td>';
		    return $html;
		}else{
			$html= '<td width="50">Si</td>
		            <td width="50"><div class="bordeAll" style="width: 15px;height: 15px;"></div></td>
		            <td width="50">No</td>
		            <td width="40"><div class="bordeAll" style="width: 15px;height: 15px;"></div></td>';
		    return $html;	
		} 
	}
	
	function DiasTrabajados($user_id,$ciclo_de_produccion){
		$ci 	=& 	get_instance();
		$tabla		=		DB_PREFIJO."rp_dias_trabajados t1";
		$ci->db->select("*");
		$ci->db->from($tabla);
		$ci->db->where('t1.ciclo_de_produccion',$ciclo_de_produccion);
		$ci->db->where('t1.user_id',$user_id);
		$ci->db->where("t1.id_empresa",$ci->user->id_empresa);
		$query			=	$ci->db->get();
		return $query->row();
	}
	
	function estatus($estatus,$tabla,$id='',$consecutivo='',$tipo_documento=1){
		$ci=&get_instance();
		$tabla=DB_PREFIJO.$tabla." t1";	
		if($id!=''){	
			$ci->db->where('id',$id);
		}
		if($consecutivo!=''){	
			$ci->db->where('consecutivo',$consecutivo);
		}
		if($tipo_documento!=''){	
			$ci->db->where('tipo_documento',$tipo_documento);
		}
		if($ci->db->update($tabla,$estatus)){
			return true;	
		}else{
			return false;
		}
	}
	
	function estatus_factura($estatus,$tabla,$id='',$nro_documento=''){
		$ci=&get_instance();
		$tabla=DB_PREFIJO.$tabla." t1";	
		if($id!=''){	
			$ci->db->where('id',$id);
		}
		if($consecutivo!=''){	
			$ci->db->where('nro_documento',$nro_documento);
		}
		if($ci->db->update($tabla,array("estatus"=>$estatus))){
			return true;	
		}else{
			return false;
		}
	}
	
	function image($image,$html=false,$imageTag=false,$attr=array()){
		$return_image=null;
		if(file_exists(PATH_IMG.$image)){
			$return_image = IMG.$image;
		}else{
			$return_image = IMG."No_image.png";
		}
		if(!$html){
			return $return_image;
		}else{
			$atributos	=	'';
			foreach($attr as $k	=> $v){
				$atributos	.=	 $k.'="'.$v.'"';	
			}
			if(!$imageTag){
				return '<img src="'.$return_image.'" '.$atributos.' />';
			}else{
				return '<div class="image_rect image_default" style="background-image:url('.$return_image.');-webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"></div>';	
			}
		}
	}
	
	function sum($obj,$campo){
		$sum=0;
		foreach($obj as $k =>$v){
			$sum +=	$v->$campo;
		}
		return $sum;
	}
	
	function Utilidades_Estatus($tipo,$value){
		$estatus	=	array(	"ut_tareas"=>array("Inactivo","Abierto","Pre Cerrado","Cerrado",9=>"Cancelado"),
								"ut_tareas_asignacion"=>array("No Visto","Aceptado",9=>"Cancelado"),
								"ut_tareas_feedback"=>array("StandBy","Leido",9=>"Eliminado"),
								"ut_tareas_notificaciones"=>array("StandBy","Leido"));
		return 	$estatus[$tipo][$value];					
	}
	
	function Utilidades_Notificaciones($token){
		$ci 	=& 	get_instance();
		$tabla	=	DB_PREFIJO."ut_notificaciones t1";
		$ci->db->select("t1.*");
		$ci->db->from($tabla);
		$ci->db->join(DB_PREFIJO."usuarios t2", 't1.user_id 	= 	t2.user_id', 'left');
		$ci->db->where('t2.token',$token);
		$ci->db->where('t1.estatus',0);
		$return 	=	$ci->db->get()->result();	
		if(!empty($return)){
			$ci->db->where('user_id',$return[0]->user_id);
			$ci->db->update(DB_PREFIJO."ut_notificaciones",array("estatus"=>1));
		}
		return $return;
	}

	function set_form_control($var,$modulo = '/configEmail',$data = true){
		$tabla = DB_PREFIJO."ut_form_control";
		$ci = get_instance();
		if($data){
			if(empty($var['url'])){
				$data = get_form_control(current_url());	
			}else{
				$data = get_form_control($var['url'].$modulo);
			}
		}
		$insert['data']				= json_encode($var);
		if(empty($data)){
			$insert['centro_de_costos'] = $ci->user->centro_de_costos;
			$insert['empresa_id']       = $ci->user->id_empresa;
			if(isset($var['user_id'])){
				$insert['user_id'] = $var['user_id']; 
			}
			if(isset($var['consecutivo'])){
				$insert['consecutivo'] = $var['consecutivo'];
			}
			$insert['estado']			= 1;
			if(isset($var['url'])){
				$insert['nombre_form']		= $var['url'].$modulo;
			}else{
				$insert['nombre_form']		= current_url();
			}
			if($ci->db->insert($tabla,$insert)){
				return true;
			}else{
				return false;
			}
		}else{
			$ci->db->where("id_form_contrl",$data[0]->id_form_contrl);
			if($ci->db->update($tabla,array("data"=>$insert['data']))){
				return true;
			}else{
				return false;
			}
		}
	}

	function set_estado_ut_form_control($estado){
		$tabla = DB_PREFIJO."ut_form_control";
		$ci = get_instance();
		$ci->db->where("nombre_form",current_url());
		$ci->db->where("centro_de_costos",$ci->user->centro_de_costos);
		$ci->db->where("empresa_id",$ci->user->id_empresa);
		if($ci->db->update($tabla,array("estado"=>$estado))){
			return true;
		}else{
			return false;
		}
	}

	function get_form_control($url,$id_form_contrl = null,$estado = null){
		$ci = get_instance();
		$ci->db->select("*");
		$ci->db->from(DB_PREFIJO."ut_form_control");
		$ci->db->where("empresa_id",$ci->user->id_empresa);
		$ci->db->where("nombre_form",$url);
		if(!empty($id_form_contrl)){
			$ci->db->where("id_form_contrl",$id_form_contrl);
		}
		if(!empty($estado)){
			$ci->db->where("estado",$estado);
		}
		$ci->db->order_by('consecutivo',"DESC");
		$query = $ci->db->get();
		$result		=	$query->result();
		return $result;
	}

	function resumen_seguimiento_modelos(){
		$ci = get_instance();
		$ci->db->select("t1.user_id,t2.primer_nombre,t2.segundo_nombre,t2.primer_apellido,t2.segundo_apellido");
		$ci->db->from(DB_PREFIJO."ut_form_control t1");
		$ci->db->join(DB_PREFIJO."usuarios t2", 't1.user_id=t2.user_id', 'left');
		$ci->db->where("t1.empresa_id",$ci->user->id_empresa);
		$ci->db->where("t1.nombre_form",$ci->uri->segment(2));
		$ci->db->group_by("t1.user_id");
		$query = $ci->db->get();
		$data		=	$query->result();
		foreach ($data as $k => $v) {
			$ci->db->select("data,id_form_contrl");
			$ci->db->from(DB_PREFIJO."ut_form_control");
			$ci->db->where("empresa_id",$ci->user->id_empresa);
			$ci->db->where("nombre_form",$ci->uri->segment(2));
			$ci->db->where("user_id",$v->user_id);
			$ci->db->limit(3);
			$ci->db->order_by('id_form_contrl','desc');
			$query = $ci->db->get();
			$result[$v->user_id.'#'.$v->primer_nombre.' '.@$v->segundo_nombre.' '.$v->primer_apellido.' '.@$v->segundo_apellido]	=	$query->result(); 
		}
		return $result;
	}

	function get_certificado($user_id,$estado = 1){
		$ci = get_instance();
		$ci->db->select("consecutivo,data");
		$ci->db->from(DB_PREFIJO."cf_pdf_certificado_comercial");
		$ci->db->where("id_empresa",$ci->user->id_empresa);
		$ci->db->where("centro_de_costos",$ci->user->centro_de_costos);
		$ci->db->where("user_id",$user_id);
		if(!empty($estado)){
			$ci->db->where("estado",$estado);
		}
		$ci->db->order_by('consecutivo',"DESC");
		$query = $ci->db->get();
		$result		=	$query->result();
		return $result;
	}

	function cambiar_estado($tabla,$where,$var){
		$ci = get_instance();
		foreach ($where as $k => $v) {	
			$ci->db->where($k,$v);
		}
		if($ci->db->update(DB_PREFIJO.$tabla,$var)){
			return true;
		}else{
			return false;
		}
	}
	
	function HtmlObservaciones($mail = false){
		$ci = get_instance();
		echo form_open(base_url("Reportes/Observaciones"),array('ajaxing' => 'true'),array("url"=>current_url()));
			echo '<div class="col-md-12">';
				$data = array('name' => 'observacion','value' =>'', 'id'=>'observacion',  'class' => 'form-control' ,'rows' => '3', 'cols' => '40','require'=>'true');
				echo form_textarea($data);
				if(!empty($mail)){
					$correos = get_NotificacionEmail();
					echo set_input_hidden("correos","correos",json_encode($correos));
				}
				echo '<div style=" width:100%; height:20px;"></div>';
				echo '<div class="row">';
					echo '<div class="col-md-12">';
						echo '<table class="tablesorter table table-hover">';
							echo '<thead>';
								echo '<tr>';
									echo '<th>';
										echo 'Nombre';
									echo '</th>';
									echo '<th>';
										echo 'Observación';
									echo '</th>';
									echo '<th width="150">';
										echo 'Fecha';
									echo '</th>';
								echo '</tr>';
							echo '</thead>';
							echo '<tbody>';

							foreach(Observaciones(str_replace('www.','',current_url())) as $k => $v){ 
								echo 	'<tr class="observaciones-tr">';
									echo 	'<td width="250">';
										echo nombre(@$v);
									echo 	'</td>';
									echo 	'<td>';
										echo $v->observacion;
									echo 	'</td>';
									echo 	'<td>';
										echo $v->fecha;
									echo 	'</td>';
								echo	'</tr>';
							}
							echo '</tbody>';
						echo '</table>'; 
					echo '</div>';						
				echo '</div>';
				echo '	<div class="col-md-12">
                    		<button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Grabar</button>
                		</div>';
			echo '</div>';
		echo form_close();	
	}


	function encriptar($var){
		$ci = get_instance();
		$ci->load->library("encryption");
		return $ci->encryption->encrypt($var);
	}

	function desencriptar($var){
		$ci = get_instance();
		$ci->load->library("encryption");
		return $ci->encryption->decrypt($var);
	}

/*function encrypt($var){
	$method = 'AES-256-CBC';
    $ivSize = openssl_cipher_iv_length($method);
    $iv = openssl_random_pseudo_bytes($ivSize);
    $key = "Prueba";

    $encrypted = openssl_encrypt($var, $method, $key, OPENSSL_RAW_DATA, $iv);
    
    // For storage/transmission, we simply concatenate the IV and cipher text
    $encrypted = base64_encode($iv . $encrypted);

    return $encrypted;
}

function decrypt($var){
    $data = base64_decode($var);
    $method = 'AES-256-CBC';
    $key = "Prueba";
    $ivSize = openssl_cipher_iv_length($method);
    $iv = substr($data, 0, $ivSize);
    $decode = openssl_decrypt(substr($data, $ivSize), $method, $key, OPENSSL_RAW_DATA, $iv);

    return $decode;
}*/

function fechaCastellano ($fecha) {
	$fecha = substr($fecha, 0, 10);
	$numeroDia = date('d', strtotime($fecha));
	$dia = date('l', strtotime($fecha));
	$mes = date('F', strtotime($fecha));
	$anio = date('Y', strtotime($fecha));
	$dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
	$dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
	$nombredia = str_replace($dias_EN, $dias_ES, $dia);
  $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
	$meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
	$nombreMes = str_replace($meses_EN, $meses_ES, $mes);
	return $nombredia." ".$numeroDia." de ".$nombreMes." del ".$anio;
  }

function get_cookie($name_cookie = "Acceso") {
  $ci = get_instance();
  $ci->load->helper('cookie');	
  $data['cookie'] = $ci->input->cookie($name_cookie, true);
  return $data;
}

function crear_cookie($var){
	$ci = get_instance();
    $ci->load->helper('cookie');

      $cookie= array(
        'name'   => 'Acceso',
        'value'  => $var,
        'expire' => '2147483647',
        'secure' => TRUE
      );

      $ci->input->set_cookie($cookie);
}

?>