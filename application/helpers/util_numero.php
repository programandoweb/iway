<?php 
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
defined('BASEPATH') OR exit('No direct script access allowed');

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

function getOpcionesFactura($empresa_id){
		$tabla				=		DB_PREFIJO."cf_opciones";
		$ci=&get_instance();
		$ci->db->select("*");
		$ci->db->from($tabla);
		$ci->db->where("empresa_id",$empresa_id);
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
				//$title	.=	'<a href="'.$items['name']['url'].'" class="orange">'.$iconos['title']->icono.' '.$items['name']['title'].'</a>';
				$title	.=	$iconos['title']->icono.' '.$items['name']['title'];
			}else{				
				$title	.=	$iconos['title']->icono.' '.$items['name']['title'];
			}
			unset($items['name']);
		}
	}
	
	
	
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
	$iconos['config']->icono		=	'<i class="fas fa-check"></i>';
	$iconos['config']->title		=	'Configuración';	
	
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
	
	$iconos['pdf']				=	new stdClass();
	if(is_numeric($ci->uri->segment(3))){
		$iconos['pdf']->url		=	$ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$ci->uri->segment(3).'/PDF';	
	}else{
		$iconos['pdf']->url		=	$ci->uri->segment(1).'/'.$ci->uri->segment(2).'/PDF';
	}
	$iconos['pdf']->icono		=	'<i class="fas fa-file-pdf"></i>';
	$iconos['pdf']->title		=	'Documento en PDF';	
	
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
			$iconos['pageleft']->url	=	$ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$left;	
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
		$iconos['pageright']->url	=	$ci->uri->segment(1).'/'.$ci->uri->segment(2).'/'.$right;	
	}else{
		$iconos['pageright']->url	=	$ci->uri->segment(1).'/'.$ci->uri->segment(2);
	}
	$iconos['pageright']->icono	=	'<i class="fas fa-caret-square-right"></i>';
	$iconos['pageright']->title	=	'Documento anterior';
	
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
				$return						.=	'<nav class="navbar navbar-toggleable-md navbar-light bg-faded nav-short p-2">';
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
								if(is_array($v)){
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
										$atributos	=	'class="nav-link lightbox" data-type="iframe"';
									}else{
										$atributos	=	'class="nav-link"';
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
									}else{
										if($v==='lightbox'){
											//pre($v);
											$atributos	=	'class="nav-link lightbox" data-type="iframe"';
										}else{
											$atributos	=	'class="nav-link "';
										}
									}	
									if($iconos[$k]->url!='ocultar'){
										$return						.=	'<a '.$atributos.' title="'.$iconos[$k]->title.'" href="'.$iconos[$k]->url.'" >';					
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
	return $return;
	
}

function saltoLinea($str) {
  return str_replace(array("\r\n", "\r", "\n"), "<br />", $str);
}   
 
function Observaciones($url){
	$ci=&get_instance();
	$tabla=DB_PREFIJO."sys_observaciones";
	$ci->db->select("observacion");
	$ci->db->from($tabla);
	$ci->db->where("url",$url);
	$query=$ci->db->get();
	$row=$query->row();
	if(!empty($row)){
		return $query->row()->observacion;
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

function getMovimientos($nro_documento,$cuenta_contable){
	$ci 	=& 	get_instance();
	$tabla	=	DB_PREFIJO."rp_operaciones t1";
	$ci 	=& 	get_instance();	
	$ci->db->select("t1.codigo_contable, SUM(t1.credito) as credito,SUM(t1.debito) as debito,fecha,tipo_documento,consecutivo,primer_nombre,primer_apellido");
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
	$ci->db->select("SUM(credito) as credito");
	$ci->db->from($tabla);
	$ci->db->where("t1.empresa_id",$ci->user->id_empresa);
	$ci->db->where("t1.procesador_id",$procesador_id);	
	$ci->db->where("t1.codigo_contable",130510);
	$ci->db->where("t1.tipo_documento",5);
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

function tipo_documento($tipo_documento){
	if(is_numeric($tipo_documento)){
		$ci 	=& 	get_instance();
		$tabla		=		DB_PREFIJO."ma_documentos t1";
		$ci->db->select("nombre");
		$ci->db->from($tabla);
		$ci->db->where("t1.documento_id",$tipo_documento);
		$query			=	$ci->db->get();
		$row			=	@$query->row();
		if(!empty($row)){
			$return			=	$row->nombre;
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

function items_factura_contable($id,$codigo_contable=array(),$where=array()){
	$tabla	=	DB_PREFIJO."rp_operaciones t1";
	$ci 	=& 	get_instance();	
	$ci->db->select("	t1.id,
						t2.abreviacion,
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

function set_centro_de_costos_tmp($v){
	$tabla	=	DB_PREFIJO."rp_tmp";
	$ci 	=& 	get_instance();	
	$insert	=	array(	"centro_de_costos"=>$v->centro_de_costos);
	$ci->db->where('reporte_archivo_plano_id', $v->reporte_archivo_plano_id);
	$ci->db->update($tabla,$insert);
}

function entidadbancaria($entidad_bancaria){
	if(is_numeric($entidad_bancaria)){
		$ci 	=& 	get_instance();
		$tabla		=		DB_PREFIJO."sys_bancos t1";
		$ci->db->select("Entidad");
		$ci->db->from($tabla);
		$ci->db->where("t1.banco_id",$entidad_bancaria);
		$query			=	$ci->db->get();
		return $query->row()->Entidad;
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

function me_img_profile(){
	$ci 	=& 	get_instance(); 
	return image("uploads/perfiles/".$ci->user->user_id.'/profile.jpg'); 	
}

function img_logo($empresa_id){
	$ci 	=& 	get_instance(); 
	return image("uploads/perfiles/".$empresa_id.'/logo.jpg'); 	
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
		$tabla	=	DB_PREFIJO."fi_cuentas t1";
		return $ci->db->select("*")->from($tabla)
								->where('t1.id_empresa',$ci->user->id_empresa)
								->where('t1.estado',1)
								->where_in("t1.tipo_monedas",$tipo_monedas)
								->get()
								->result();
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
													->where_in("t1.codigo_contable",array("111005","110505"))
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
													->where_in("t1.codigo_contable",array("111010","110505","530515"))
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
								->where("t1.tipo_documento",10)
								->get()
								->row();
	}
	
	function ResumenCajas($incluir=array('110505'),$tipo_documento=array("TRM Retiro")){
		$ci 	=& 	get_instance();		
		$tabla	=	DB_PREFIJO."fi_cajas t1";
		$rows	=	$ci->db->select("nombre_caja,id_caja")
									->from($tabla)
									->where('t1.id_empresa',$ci->user->id_empresa)
									->get()
									->result();	
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
							
		}							
		return $return;
		
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

	function MakePrioridad($name,$estado=null,$extra=array()){
		$options = array(
			""		=>	"Seleccione",
			'1'         => 'Alta',
			'4'       => 'Moderada',
			'7'       => 'Baja',
			'365'      => 'Idea'
		);
		return form_dropdown($name, $options, $estado,$extra);
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
		$ci->db->select("consecutivo,codigo_contable,debito,credito,entidad_bancaria,nro_cuenta,fecha");
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
		return $ci->db->select("codigo,cuenta_contable")->from($tabla)->where('codigo',$codigo_contable)->get()->row();		 		
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
	
	function calculo_fechas($fecha_desde,$cantidad_dias='+5'){
		$fecha=$fecha_desde;
		$nuevafecha=strtotime ( $cantidad_dias.' day' , strtotime ( $fecha ) ) ;
		$nuevafecha=date( 'Y-m-d' , $nuevafecha );
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
		return $ci->db->select("COUNT(id) as total")->from($tabla)->where('descuento_id',$descuento_id)->get()->row();
	}
	
	function Descuentos($user_id){
		$ci 	=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."rp_descuentos";
		return $ci->db->select("*")->from($tabla)->where('user_id',$user_id)->get()->result();
	}
	
	function TotalOtrosIngresos($user_id){
		$ci 	=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."rp_otros_ingresos";
		return $ci->db->select("SUM(valor) as valor")->from($tabla)->where('user_id',$user_id)->get()->row();
	}
	
	function OtrosIngresos($user_id){
		$ci 	=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."rp_otros_ingresos";
		return $ci->db->select("*")->from($tabla)->where('user_id',$user_id)->get()->result();
	}
	
	function conversion_token_standar($cantidad,$equivalencia){
		//pre($equivalencia);return;
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
	
	function get_registro_contable_new($consecutivo){
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
		$html	.=	'	<input type="text" class="form-control" id="id_master"  placeholder="Master" maxlength="200" value="'.@$actual->nombre_master.'"/>';		
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
	
	function modelo($row, $estado = null,$extra=array("class"=>"form-control","name"=>"id_modelo")){
		if(empty($row)){
			$row=new stdClass();		
			$row->entidad_bancaria='';
		}
		$ci 	=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."usuarios";
		$rows	=	$ci->db->select("*")->from($tabla)->where('id_empresa',$ci->user->id_empresa)->where('type',"Modelos")->get()->result();
		$actual	=	$ci->db->select("*")->from($tabla)->where('user_id',@$row->user_id)->get()->row();
		
		$html	=	'';
		$nombre_set		=	(@$actual->primer_nombre!='' || @$actual->primer_apellido!='')?@$actual->primer_nombre.' '.@$actual->primer_apellido:'';
		$html	.=	'<input type="text" class="form-control" id="id_modelo"  placeholder="Modelo" maxlength="200" value="'.$nombre_set.'"/>';		
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
		$tabla	=	DB_PREFIJO."sys_bancos";
		$rows	=	$ci->db->select("*")->from($tabla)->order_by('Entidad','ASC')->get()->result();
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
		return $ci->db->select("*")->from($tabla)->where('cliente_id',$cliente_id)->get()->row();
	}
	
	function Autocpmlete_CuentasBancarias2($row, $estado = null,$name='procesador_id',$tipo_cuenta="Crédito prepagada"){
		if(empty($row)){
			$row=new stdClass();		
			$row->entidad_bancaria='';
		}
		$ci 	=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."fi_cuentas t1" ;
		$rows	=	$ci->db->select("CONCAT(t2.Entidad,'(',nro_cuenta,')') as entidad_bancaria,t1.id_cuenta")
							->from($tabla)
							->join(DB_PREFIJO."sys_bancos t2", 't1.entidad_bancaria 	= 	t2.banco_id', 'left')
							->where('estado',"1")
							->where('tipo_cuenta',$tipo_cuenta)
							->where('id_empresa',$ci->user->id_empresa)
							->order_by('entidad_bancaria','ASC')->get()->result();

		$array_js	=	array();
							
		$html	=	'<select class="form-control" name="'.$name.'" id="'.$name.'">';
			$html	.=	'<option value="0" data-monto="0">Seleccione</option>';
			foreach($rows as $k	=> $v){
				$banco		=	operaciones_bancos_130510($v->id_cuenta);
				if($banco->credito>0){
					$html	.=	'<option value="'.$v->id_cuenta.'" data-monto="'.$banco->credito.'">'.$v->entidad_bancaria.'</option>';
				}
			}
		$html	.=	'</select>';	
		echo $html;
		return;					
	}

	function Autocpmlete_CuentasBancarias($row, $estado = null,$extra=array("class"=>"form-control"),$subfuncion='',$name='id_cuenta',$tipo_cuenta="Crédito prepagada"){
		
		if(empty($row)){
			$row=new stdClass();		
			$row->entidad_bancaria='';
		}
		$ci 	=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."fi_cuentas t1" ;
		$rows	=	$ci->db->select("CONCAT(t2.Entidad,'(',nro_cuenta,')') as entidad_bancaria,t1.id_cuenta")
							->from($tabla)
							->join(DB_PREFIJO."sys_bancos t2", 't1.entidad_bancaria 	= 	t2.banco_id', 'left')
							->where('estado',"1")
							->where('tipo_cuenta',$tipo_cuenta)
							->where('id_empresa',$ci->user->id_empresa)
							->order_by('entidad_bancaria','ASC')->get()->result();
		$html	=	'';
		$html	.=	'	<input type="text" data-funcion="'.$subfuncion.'" class="form-control" id="id_cuenta_TEXT'.$name.'"  placeholder="Cuenta Bancaria" maxlength="200" value="'.@$row->entidad_bancaria.'" require   />';
		$html	.=	'	<input type="hidden" name="'.$name.'" id="'.$name.'"  require   />';		
		$html	.= 	'	<script>
							$(function(){
								var projects = [';
									foreach($rows as $k => $v){
										$html	.= 	'{
														value: "'.$v->id_cuenta.'",
														label: "'.$v->entidad_bancaria.'"
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
										$( "#id_cuenta_TEXT'.$name.'" ).val( ui.item.label );
										$( "#'.$name.'" ).val( ui.item.value );
										return false;
									}
								});
							});
						</script>
					';
		return $html;	
	}

	function Autocomlete_Usuarios($row, $estado = null,$extra=array("class"=>"form-control"),$name='user_id'){
		
		if(empty($row)){
			$row=new stdClass();		
			$row->primer_nombre='';
		}
		$ci 	=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."usuarios" ;
		$rows	=	$ci->db->select("user_id,primer_nombre,segundo_nombre,primer_apellido,segundo_apellido,centro_de_costos")
							->from($tabla)
							->where('estado',"1")
							->where_in('type',array("Modelos","Monitores","Administrativos"))
							->where('id_empresa',$ci->user->id_empresa)
							->order_by('primer_nombre','ASC')->get()->result();
		$html	=	'';
		$html	.=	'	<input type="text" class="form-control" id="Usuarios_'.$name.'" placeholder="Nombre Completo" maxlength="200" require="require"   />';
		$html	.=	'	<input type="hidden" name="'.$name.'" id="'.$name.'"  require="require"   />';
		$html	.=	'	<input type="hidden" name="centro_de_costos" id="centro_de_costos"  require="require"   />';		
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
	
	function proveedores($row, $estado = null,$extra=array("class"=>"form-control"),$subfuncion=''){
		if(empty($row)){
			$row=new stdClass();		
			$row->entidad_bancaria='';
		}
		$ci 	=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."usuarios";
		$rows	=	$ci->db->select("*")
							->from($tabla)
							->where('type',"Proveedores")
							->where('id_empresa',$ci->user->id_empresa)
							->order_by('nombre_legal','ASC')->get()->result();
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
										$html	.= 	'{
														value: "'.$v->nombre_legal.'",
														label: "'.$v->nombre_legal.'",
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
		$tabla	=	DB_PREFIJO."sys_paginas_webcam";
		$rows	=	$ci->db->select("*")->from($tabla)->order_by('Nombre_legal','ASC')->get()->result();
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
		$html	.=	'	<input type="text" data-funcion="'.$subfuncion.'" class="form-control" id="descripcion"  value="'.@$row->descripcion.'"/>';
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
		if($row->estado==0){
			return 'Inactivo';	
		}else{
			return 'Activo';	
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
	
	function direccion($row){
		if(empty($row)){
			$row=new stdClass();		
			$row->direccion='';
			$row->ciudad='';
			$row->departamento='';
			$row->codigo_postal='';
			$row->pais='';
		}
		$html	=	'';
		$html	.=	'<div class="row form-group">';
			$html	.=	'<div class="col-md-3 text-right">';
				$html	.=	'<b>Dirección *</b>';
			$html	.=	'</div>';
			$html	.=	'<div class="col-md-9">';
				$html	.=	'<input type="text" class="form-control" name="direccion" id="direccion"  placeholder="Dirección" maxlength="200" value="'.$row->direccion.'" require   />';
			$html	.=	'</div>';
			$html	.=	'<div class="row  sub-item">';
				$html	.=	'<div class="col-md-12">';
					$html	.=	'<div class="input-group input-group-sm" style="padding:15px;">';
						$html	.=	'<input type="text" class="form-control col-md-3" id="ciudad" placeholder="Ciudad" maxlength="50"  value="'.$row->ciudad.'"  />';
						$html	.=	'<input type="hidden" name="ciudad" id="contenedor_ciudad" maxlength="50"  value="'.$row->ciudad.'"  />';
						$html	.=	'<input type="text" class="form-control col-md-3" name="departamento" id="departamento" placeholder="Departamento" maxlength="50"  value="'.$row->departamento.'"  />';
						$html	.=	'<input type="text" class="form-control col-md-2" name="codigo_postal" id="codigo_postal" placeholder="Código Postal" maxlength="10"  value="'.$row->codigo_postal.'" />';
						$html	.=	'<input type="text" class="form-control col-md-4" name="pais" id="pais" placeholder="País" maxlength="20"  value="'.$row->pais.'"  />';
					$html	.=	'</div>';
				$html	.=	'</div>';
			$html	.=	'</div>';
		$html	.=	'</div>';
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
									focus: function( event, ui ) {
										$( "#project" ).val( ui.item.label );
											return false;
									},
									select: function( event, ui ) {
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
		return $ci->db->select("*")->from($tabla)->where('mes',$mes)->where('centro_de_costos',$centro_de_costos)->get()->result();	
	}
	
	function get_cf_ciclos_pagos_new($id_empresa,$estado=0){
		$ci 	=& 	get_instance();
		$tabla	=	DB_PREFIJO."cf_ciclos_pagos";
		return $ci->db->select("*,DATE_FORMAT(fecha_desde,'%d') as desde,DATE_FORMAT(fecha_hasta,'%d') as hasta")->from($tabla)->where('id_empresa',$id_empresa)->where('estado',$estado)->get()->row();	
	}
	
	function get_ListMaster($id_plataforma=""){
		$ci 					=& 		get_instance();
		$tabla					=		DB_PREFIJO."cf_rel_master t1";
		$ci->db->select("*");
		$ci->db->from($tabla);
		$ci->db->join(DB_PREFIJO."sys_bancos t2", 't1.cuenta_id 	= 	t2.banco_id', 'left');
		$ci->db->join(DB_PREFIJO."fi_cuentas t3", 't2.banco_id 	= 	t3.id_cuenta', 'left');
		$ci->db->where("t1.id_empresa",$ci->user->id_empresa);
		//$ci->db->where("t1.centro_de_costos",$ci->user->centro_de_costos);
		if(!empty($id_plataforma)){
			$ci->db->where("t1.id_plataforma",$id_plataforma);
		}
		$ci->db->order_by('t1.nombre_master','ASC');
		$query					=	$ci->db->get();
		return $rows			=	$query->result();
	}
	
	function get_Nickname($id_plataforma,$rel_plataforma_id){
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
		$row	=	$ci->db->select("*, MONTH(fecha_desde) as mes, YEAR(fecha_desde) as anio")->from($tabla)->where('ciclos_id',$ciclos_id)->where('id_empresa',$ci->user->id_empresa)->get()->row();	
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
		if(empty($row)){
			return;	
		}
		return $row;
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
		$menu_search				=	json_decode($roles->json);			
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
		
		$ci->email->message($vars["body"]); 
		if($ci->email->send()){
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
	
	function items_factura_x_nickname($nickname_id){
		$ci 	=& 	get_instance(); 
		$tabla	=	DB_PREFIJO."rp_operaciones t1";
		$ci->db->select("t1.*");
		$ci->db->from($tabla);
		$ci->db->where("t1.nickname_id",$nickname_id);
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
	
	function CertificadoLaboral_pdf($html){
		if (PHP_SAPI == 'cli'){die('This example should only be run from a Web Browser');}
		include(PATH_APP.'third_party/PHPExcel/PHPExcel.php');
		
		$rendererLibrary 		= 	'domPDF0.6.0beta3';
		$rendererLibraryPath 	= 	PATH_APP.'third_party/'.$rendererLibrary;
		require_once($rendererLibraryPath."/dompdf_config.inc.php");
		$dompdf = new DOMPDF();
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream("sample.pdf", array("Attachment" => false)); 
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
			""		=>	"Seleccione",
			'1'         => 'Si',
			'0'       => 'No',
			 '2'   => 'N.A.',  
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
	
	function MakeTipoIdentificacion($name,$estado=null,$extra=array()){
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

	function MakeHora($name,$estado=null,$extra=array()){
		$options = array(
			'00'=> '00',
			"01" 			=> "01",
			"02"			=> "02",
			"03"			=> "03",
			"04"			=> "04",
			"05" 			=> "05",
			"06"			=> "06",
			"07"			=> "07",
			"08"			=> "08",
			"09" 			=> "09",
			"10"			=> "10",
			"11"			=> "11",
			"12"			=> "12"
			
		);
		/*$options = array(
			''=> '',
			"Am" 			=> "Am",
			"Pm"			=> "Pm"
			
		);*/
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
	
	function MakeDescuentosConceptos($name,$estado=null,$extra=array()){
		$options = array(
			''=> 'Seleccione',
			'Sanción Room en mal estado'		=>	'Sanción Room en mal estado',
			'Llegada Tarde'						=>	'Llegada Tarde',
			'Inasistencia'						=>	'Inasistencia',
			'Sanción Página' 					=>	'Sanción Página',
			'Préstamos' 						=>	'Préstamos',
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
			''=> 'Seleccione',
			'USD'=>'USD',
			'Pesos'=>'Pesos',
			'Euros'=>'Euros'
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
			1=>'Un(1) mes',
			2=>'Dos(2) meses',
			3=>'Tres(3) meses',
			6=>'Seis(6) meses',
			12=>'Doce(12) meses'
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
	
	function get_escala_pagos($estado=null,$extra=array()){
		$ci 				=& 	get_instance();
		$tabla				=		DB_PREFIJO."ve_escala_pagos";
		$ci->db->select("*");
		$ci->db->from($tabla);
		$ci->db->where("id_empresa",$ci->user->id_empresa);
		//$ci->db->where("centro_de_costos",$ci->user->centro_de_costos);
		$ci->db->order_by('nombre_escala','ASC');
		$query			=	$ci->db->get();
		$rows			=	$query->result();
		$option 		= 	array(""=>"Seleccione");
		foreach($rows as $v){
			$option[$v->id_escala] 	= 	$v->nombre_escala;	
		}
		return form_dropdown("id_escala", $option, $estado,$extra);
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
	
	function MakeMes($name,$estado=null,$extra=array()){
		$option 		= 	array(	""		=>	"Seleccione",
									"01"	=>	"01",
									"02"	=>	"02",
									"03"	=>	"03",
									"04"	=>	"04",
									"05"	=>	"05",
									"06"	=>	"06",
									"07"	=>	"07",
									"08"	=>	"08",
									"09"	=>	"09",
									"10"	=>	"10",
									"11"	=>	"11",
									"12"	=>	"12"
									);
		return form_dropdown($name, $option, $estado,$extra);
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
	
	function upload($file='userfile',$path='images/uploads/',$config=array("allowed_types"=>'gif|jpg|png',"max_size"=>100,"max_width"=>1024,"max_height"=>768)){
		$config['upload_path']        = 	PATH_BASE.$path;
		if(!is_dir($config['upload_path'])){
			if(!mkdir($config['upload_path'], 0755,true)){
				return false; 
			}else{
				$fp		=	fopen($config['upload_path'].'/index.html',"w");
				fwrite($fp,'<a href="http://programandoweb.net">PROGRAMANDOWEB</a>');
				fclose($fp);
			}
		}
		$config['encrypt_name']       = 	TRUE;
		$ci 	=& 	get_instance();
		$ci->load->library('upload', $config);	
		//print_r($file);return;
		if(isset($_FILES[$file])){	
			if ( ! $ci->upload->do_upload($file)){
				return array('error' => $ci->upload->display_errors());			
			}
			else{
				return array('upload_data' => $ci->upload->data());
			}
		}
	}
	
	function set_input_hidden($name,$id='',$row){
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
				$data['value']	=	$row->$name;
			}
		}else{
			$data['value']	=	$row;
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
		echo '<label class="custom-control custom-checkbox">';
		echo form_checkbox($data,$value,$cheked,$extra).'<span class="custom-control-indicator"></span></label>';
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
	
	function set_input_dinamico($name,$row,$placeholder='',$require=false,$class='',$extra=NULL,$hidden=array("user_id")){
		$data = array(
			'type' 			=> 	'text',
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
	
	function set_input($name,$row,$placeholder='',$require=false,$class='',$extra=NULL){
		$data = array(
			'type' 			=> 	'text',
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
		$mes	=	(int)$mes;
		$mes	=	($mes<10)?'0'.$mes:$mes;
		if($periodo_pagos==4){
			if($periodo=="01"){
				return "S1".'-'.$mes.'-'.date("Y");
			}else{
				return "S3".'-'.$mes.'-'.date("Y");
			}
		}else{
			if($periodo=="01"){
				return "Q1".'-'.$mes.'-'.date("Y");
			}else{
				return "Q2".'-'.$mes.'-'.date("Y");
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
		$mes_con_cero		=	($mes<10)?"".$mes:$mes;
		if($tipo_periodo=="Q"){
			if($periodo==1){
				$return				=	"16-".$mes_con_cero.'-'.date("Y");
				//$periodo			=	"-".$mes_con_cero."-16";
				$periodo			=	"-".$mes_con_cero."-01";
				$periodo_para_mysql	=	date("Y").'-'.$mes_con_cero.'-15';
			}else{
				$return				=	"01-".$mes_con_cero.'-'.date("Y");
				//$periodo			=	($mes + 1)."-01";	
				$periodo			=	($mes)."-15";	
				$periodo_para_mysql	=	date("Y").'-'.$mes_con_cero.'-01';
			}
			
			$trm			=	$ci->db->select('*')->from(DB_PREFIJO."sys_trm")->where('fecha',date("Y-").$periodo)->get()->row();		
		}
		if($tipo_periodo=="S"){
			if($periodo==1 || $periodo==2){
				$return				=	"16-".$mes_con_cero.'-'.date("Y");
				$periodo			=	"-".$mes_con_cero."-16";
				$periodo_para_mysql	=	date("Y").'-'.$mes_con_cero.'-15';
			}else{
				$return				=	"01-".$mes_con_cero.'-'.date("Y");
				$periodo			=	($mes + 1)."-01";	
				$periodo_para_mysql	=	date("Y").'-'.$mes_con_cero.'-01';
			}
			$periodo		=	($periodo==3)?"-16":"-01";
			$trm			=	$ci->db->select('*')->from(DB_PREFIJO."sys_trm")->where('fecha',date("Y-").$periodo)->get()->row();		
		}
		return array("trm"=>$trm,"periodo"=>$return,"periodo_para_mysql"=>$periodo_para_mysql);
	}
	
	function trm_vigente(){
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
			echo '$'.number_format($precio_dolar,2,',', '.').' '.$post	;
		}else{
			echo '$'.number_format($trm->monto,2,',', '.').' '.$post;	
		}
		
	}
	
	function centrodecostos($centro_de_costos){
		$ci 	=& 	get_instance();
		$tabla						=	DB_PREFIJO."usuarios";
		return $ci->db->select("*")->from($tabla)->where("user_id",$centro_de_costos)->get()->row();
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
		$html	=	'<select id="centro_de_costos" name="centro_de_costos" class="form-control">';
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
			$ci->db->like("t2.primer_nombre",$pagina);
		}
		$ci->db->like("t1.nickname",$like);
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
	
	function format($num,$decimal=true){
		if($num==0 || $num=='') $num=0;
		if($decimal){
			return number_format($num, 2, ',', '.');	
		}else{
			return number_format($num,0, '', '.');	
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
	
	function estatus($estatus,$tabla,$id='',$consecutivo=''){
		$ci=&get_instance();
		$tabla=DB_PREFIJO.$tabla." t1";	
		if($id!=''){	
			$ci->db->where('id',$id);
		}
		if($consecutivo!=''){	
			$ci->db->where('consecutivo',$consecutivo);
		}
		if($ci->db->update($tabla,array("estatus"=>$estatus))){
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
	
	function HtmlObservaciones(){
		echo form_open(base_url("Reportes/Observaciones"),array('ajax' => 'true'),array("url"=>current_url()));
			echo '<div class="col-md-12">';
				$data = array('name' => 'observacion','value' =>Observaciones(current_url()), 'id'=>'observacion',  'class' => 'form-control' ,'rows' => '3', 'cols' => '40','require'=>'true');
				echo form_textarea($data);
				echo '<div style=" width:100%; height:20px;"></div>';
				echo '	<div class="col-md-12">
                    		<button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Grabar</button>
                		</div>';
			echo '</div>';
		echo form_close();	
	}

	
?>