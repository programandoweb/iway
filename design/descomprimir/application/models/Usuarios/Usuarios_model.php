<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Usuarios_model extends CI_Model {
	
	var $fields,$result,$where,$total_rows,$pagination,$search;

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
	
	
	public function get($user_id,$type=''){
		$tabla				=		DB_PREFIJO."usuarios";
		$this->db->select("*");
		$this->db->from($tabla);
		$this->db->where("user_id",$user_id);
		if(!empty($type)){
			$this->db->where("type",$type);
		}
		$query			=	$this->db->get();
		$this->result 	=	$query->row();
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
									CONCAT(t1.cod_telefono,' ',t1.telefono,' <BR> ',t1.email) AS contactos,
									CASE WHEN t1.estado=1 THEN 'Activo' ELSE 'Inactivo' END AS estado,
									GROUP_CONCAT(t3.nickname) as list_nicknames,
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
			->where('t1.type', 'Modelos')->where('t1.estado',1)->where("t1.id_empresa",$this->user->id_empresa);
		if($this->user->principal==0){	$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);	}
		$this->db->group_by('t1.user_id','ASC');
		$this->db->order_by('t1.primer_nombre','ASC');
		$query			=	$this->db->get();
		$rows		 	=	$query->result();
		
		$this->db->select($datos)->from($tabla)
			->join(DB_PREFIJO."usuarios t2",'t1.centro_de_costos=t2.user_id','left')
			->join(DB_PREFIJO."cf_nickname t3",'t1.user_id=t3.id_modelo','left')
			->where('t1.type', 'Modelos')->where('t1.estado',0)->where("t1.id_empresa",$this->user->id_empresa);
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
	
	public function OtrosIngresos(){
		$tabla				=		DB_PREFIJO."rp_otros_ingresos t1" ;
		$this->db->select("*");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."usuarios t2", 't1.user_id 	= 	t2.user_id', 'left');
		$names 	= 	array('Asociados', 'Proveedores', 'Modelos');
		$this->db->where_in('t2.type', $names);
		$this->db->where('t1.estado',1);
		$this->db->where("t1.id_empresa",$this->user->id_empresa);
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
			$names 	= 	array('Administrativos', 'Monitores', 'Modelos');
		}
		$this->db->where_in('t1.type', $names);
		$this->db->where('t1.estado',1);
		$this->db->where("t1.id_empresa",$this->user->id_empresa);
		if($this->user->principal==0){
			$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
		}
		$this->db->order_by('t1.primer_nombre','ASC');
		$query			=	$this->db->get();
		$this->result 	=	$query->result();
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
		if($this->user->mostrar_inactivos==0){
			$this->db->where('t1.estado', 1);
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
		$tabla		=		DB_PREFIJO."rp_descuentos";
		if(isset($var['redirect'])){
			unset($var['redirect']);	
		}
		unset($var["iframe"]);
		$var['id_empresa']			=	(post("id_empresa"))?post("id_empresa"):$this->user->id_empresa;
		$var['centro_de_costos']	=	$this->user->centro_de_costos;			
		if($this->db->insert($tabla,$var)){
			$insert_id			=	$this->db->insert_id();
			logs($this->user,1,$tabla,$insert_id,"Usuarios","1",$var);
			return $insert_id;
		}else{
			return false;	
		}
	}
	
	public function setOtrosIngresos($var){
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
		$this->db->select("t1.*,t2.primer_nombre as plataforma");
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
	
	public function getModelos(){
		$tabla				=		DB_PREFIJO."usuarios t1";
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
		$this->db->where("type","Modelos");
		$this->db->where("estado",1);
		$this->db->order_by('primer_nombre','ASC');
		$query			=	$this->db->get();
		$this->result 	=	$query->result();
	}
	
	public function get_FormasPagos(){
		$tabla					=	DB_PREFIJO."ve_forma_pagos";
		$this->db->select("*");
		$this->db->from($tabla);
		$query					=	$this->db->get();
		return $this->result 	=	$query->result();
	}
	
	public function get_RolesForm($rol_id=''){
		$tabla						=	DB_PREFIJO."sys_roles";
		$this->db->select("*")->from($tabla);
		if(!empty($rol_id)){
			$this->db->where("rol_id",$rol_id);
		}
		$this->roles				=	$this->db->get()->row();
		$tabla						=	DB_PREFIJO."sys_roles_modulos";
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
	
	public function SeguridadSocial($names=array()){
		$tabla				=		DB_PREFIJO."usuarios t1";
		$this->db->select("t1.*,t2.*,t3.nombre_escala,t4.Entidad as entidad_bancaria");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."sys_eps t2", 't1.eps=t2.id', 'left');
		$this->db->join(DB_PREFIJO."ve_escala_pagos t3", 't1.id_escala=t3.id_escala', 'left');
		$this->db->join(DB_PREFIJO."sys_bancos t4", 't1.entidad_bancaria=t4.banco_id', 'left');
		if(count($names)==0){
			$names 				= 		array('Modelos', 'Monitores', 'Administrativos', 'Asociados');
		}
		$this->db->where_in('t1.type', $names);	
		if($this->user->principal<>1){
			$this->db->where('t1.centro_de_costos', $this->user->centro_de_costos);
		}
		if($this->user->mostrar_inactivos==0){
			$this->db->where('t1.estado', 1);
		}
		$this->db->where("t1.id_empresa",$this->user->id_empresa);
		$this->db->order_by('primer_nombre','ASC');
		$this->db->limit(ELEMENTOS_X_PAGINA,$this->Usuarios->pagination);		
		$query				=	$this->db->get();
		$this->result 		=	$query->result();
		//pre($this->result);
		$this->total_rows	= 	$this->total_filas($tabla);
	}
	

	public function get_Roles(){
		$tabla				=		DB_PREFIJO."sys_roles";
  		$html_group_open	=		'<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">';
		$html_group_close	=		'</div>';
		$edit_open			=		$html_group_open.'<a class="btn btn-secondary lightbox" title="Editar Usuario" data-type="iframe" href="'.base_url($this->uri->segment(1).'/AddRol/');
		$edit_close			=		'"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
		$this->fields		=		array("rol"=>"Roles","CASE WHEN estado=1 THEN 'Activo' ELSE 'Inactivo' END"=>"Estado"," CONCAT('".$edit_open."',rol_id,'".$edit_close."') AS edit"=>"Acción");
		$this->db->select(array_keys($this->fields));
		$this->db->from($tabla);
		if($this->search){
			$this->db->like('rol', $this->search);			
			$this->db->or_like('estado', $this->search);			
		}
		$this->db->order_by('rol','ASC');
		$this->db->limit(ELEMENTOS_X_PAGINA,$this->Usuarios->pagination);		
		$query				=	$this->db->get();
		$this->result 		=	$query->result();
		$this->total_rows	= 	$this->total_filas($tabla);
	}
	
	public function get_all2(){
		$tabla				=		DB_PREFIJO."usuarios t1";
		$this->db->select("t1.*,t3.abreviacion");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."usuarios t2", 't1.id_empresa 		= 	t2.user_id', 'left');
		$this->db->join(DB_PREFIJO."usuarios t3", 't1.centro_de_costos 	= 	t3.user_id', 'left');
		$names 				= 		array('Modelos','Monitores','Administrativos','empresa','Asociados', 'Proveedores', 'Modelos', 'CentroCostos');
		$this->db->where_in('t1.type', $names);
		if($this->search){
			$this->db->like('t1.persona_contacto', $this->search);			
			$this->db->or_like('t1.estado', $this->search);			
		}
		if($this->user->mostrar_inactivos==0){
			$this->db->where('t1.estado', 1);
		}
		$this->db->order_by('t1.primer_nombre,t1.nombre_legal','ASC');
		$this->db->limit(ELEMENTOS_X_PAGINA,$this->Usuarios->pagination);		
		$query			=	$this->db->get();
		$this->result 	=	$query->result();
		$this->total_rows= $this->total_filas($tabla);
	}
	
	public function get_all(){
		$tabla				=		DB_PREFIJO."usuarios t1";
  		$html_group_open	=		'<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">';
		$html_group_close	=		'</div>';
		$edit_open			=		$html_group_open.'<a class="btn btn-secondary" title="Editar Usuario" href="'.base_url('Usuarios/Add_Todos/');
		$edit_close			=		'"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
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
  		$html_group_open	=		'<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">';
		$html_group_close	=		'</div>';
		$edit_open			=		$html_group_open.'<a class="btn btn-secondary lightbox" title="Editar Plataforma" data-type="iframe" href="'.base_url($this->uri->segment(1).'/Add_Todos/'.$this->uri->segment(3).'/');
		$edit_close			=		'"><i class="fa fa-pencil" aria-hidden="true"></i></a>'.$html_group_close;
		if($this->uri->segment(3)=='Proveedores' || $case=='Proveedores'){
			//$this->fields		=		array("primer_nombre"=>"Nombre","CONCAT(cod_telefono,' ',telefono,' <BR> ',email) AS contactos"=>"Datos de Contacto","CASE WHEN estado=1 THEN 'Activo' ELSE 'Inactivo' END"=>"Estado"," CONCAT('".$edit_open."',user_id,'".$edit_close."') AS edit"=>"Acción");
			$this->fields		=		array("nombre_legal"=>"Nombre","CONCAT(if(cod_telefono is null ,'',cod_telefono),' ',if(telefono is null ,'',telefono),' <BR> ',if(email is null ,'',email)) AS contactos"=>"Datos de Contacto","CASE WHEN estado=1 THEN 'Activo' ELSE 'Inactivo' END"=>"Estado"," CONCAT('".$edit_open."',user_id,'".$edit_close."') AS edit"=>"Acción");
		}else if($this->uri->segment(3)=='Plataformas' ){
			$this->fields		=		array("primer_nombre"=>"Nombre","CONCAT(tipo_persona,' | ',moneda_de_pago,' | ',equivalencia)"=>"Tipo de Página | Moneda de Pago | Equivalencia","CASE WHEN estado=1 THEN 'Activo' ELSE 'Inactivo' END"=>"Estado"," CONCAT('".$edit_open."',user_id,'".$edit_close."') AS edit"=>"Acción");
		}else if($this->uri->segment(3)=='Plataforma' ){
			$html_group_open	=		'<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
											<a class="btn btn-secondary" title="Agregar Usuario" href="'.base_url($this->uri->segment(1).'/SetCentroCostos/');
			$html_group_close	=		'	"><i class="fa fa-user-plus" aria-hidden="true"></i></a>';
			$edit_open			=		'	<a class="btn btn-secondary lightbox" title="Editar Usuario" data-type="iframe" href="'.base_url($this->uri->segment(1).'/Add_Todos/'.$this->uri->segment(3).'/');
			$edit_close			=		'"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>';
			$this->fields		=		array("primer_nombre"=>"Nombre","CONCAT(tipo_persona,' | ',moneda_de_pago,' | ',equivalencia)"=>"Tipo de Página | Moneda de Pago | Equivalencia"," CONCAT('".$edit_open."',user_id,'".$edit_close."') AS edit"=>"Acción");
			$names				=		array("Plataformas");
		}else if($this->uri->segment(3)=='CentroCostos' ){
			$html_group_open	=		'<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
											<a class="btn btn-secondary" title="Seleccionar sucursal" href="'.base_url($this->uri->segment(1).'/SetCentroCostos/');
			$html_group_close	=		'	"><i class="fa fa-user-plus" aria-hidden="true"></i></a>';
			$edit_open			=		'	<a class="btn btn-secondary lightbox" title="Editar Sucursal" data-type="iframe" href="'.base_url($this->uri->segment(1).'/Add_Todos/'.$this->uri->segment(3).'/');
			$edit_close			=		'"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>';
			$this->fields		=		array("CONCAT(t1.nombre_legal, ' <br> <b>' ,t2.nombre_legal,' </b>')"=>"Nombre","t1.abreviacion"=>"Abreviación","CASE WHEN t1.estado=1 THEN 'Activo' ELSE 'Inactivo' END"=>"Estado"," CONCAT('".$html_group_open."',t1.user_id,'".$html_group_close."','".$edit_open."',t1.user_id,'".$edit_close."') AS edit"=>"Acción");
		}else if($this->uri->segment(3)=='CentroCostos' || $case=='CentroCostos'){
			$this->fields		=		array("nombre_legal"=>"Nombre","abreviacion"=>"Abreviación","CASE WHEN estado=1 THEN 'Activo' ELSE 'Inactivo' END"=>"Estado"," CONCAT('".$edit_open."',user_id,'".$edit_close."') AS edit"=>"Acción");
		}else if($this->uri->segment(3)=='Modelos'){
			$this->fields		=		array("CONCAT(t1.primer_nombre,' ',if(t1.segundo_nombre is null ,'',t1.segundo_nombre) ,' ',t1.primer_apellido,' ',if(t1.segundo_apellido is null ,'',t1.segundo_apellido)) as nombre"=>"Nombre","CONCAT(t1.cod_telefono,' ',t1.telefono,' <BR> ',t1.email) AS contactos"=>"Datos de Contacto","CASE WHEN t1.estado=1 THEN 'Activo' ELSE 'Inactivo' END"=>"Estado","CONCAT('<center>',t20.abreviacion,'</center>') as abreviacion"=>"<center>Centro de Costos</center>"," CONCAT('".$edit_open."',t1.user_id,'".$edit_close."') AS edit"=>"Acción");
		}else if($this->uri->segment(3)=='Monitores'){
			$this->fields		=		array("CONCAT(primer_nombre,' ',if(segundo_nombre is null ,'',segundo_nombre) ,' ',primer_apellido,' ',if(segundo_apellido is null ,'',segundo_apellido)) as nombre"=>"Nombre","CONCAT(cod_telefono,' ',telefono,' <BR> ',email) AS contactos"=>"Datos de Contacto","CASE WHEN estado=1 THEN 'Activo' ELSE 'Inactivo' END"=>"Estado"," CONCAT('".$edit_open."',user_id,'".$edit_close."') AS edit"=>"Acción");
		}else if($this->uri->segment(3)=='Administrativos'){
			$this->fields		=		array("CONCAT(primer_nombre,' ',if(segundo_nombre is null ,'',segundo_nombre) ,' ',primer_apellido,' ',if(segundo_apellido is null ,'',segundo_apellido)) as nombre"=>"Nombre","CONCAT(cod_telefono,' ',telefono,' <BR> ',email) AS contactos"=>"Datos de Contacto","CASE WHEN estado=1 THEN 'Activo' ELSE 'Inactivo' END"=>"Estado"," CONCAT('".$edit_open."',user_id,'".$edit_close."') AS edit"=>"Acción");
		}else{
			$this->fields		=		array("CONCAT(primer_nombre,' ',if(segundo_nombre is null ,'',segundo_nombre) ,' ',primer_apellido,' ',if(segundo_apellido is null ,'',segundo_apellido)) as nombre"=>"Nombre","CONCAT(porcentaje_participacion, '%' )"=>"Participación","CASE WHEN estado=1 THEN 'Activo' ELSE 'Inactivo' END"=>"Estado"," CONCAT('".$edit_open."',user_id,'".$edit_close."') AS edit"=>"Acción");
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
		$query			=	$this->db->get();
		$this->result 	=	$query->result();
		$this->total_rows= $this->total_filas($tabla);
	}
	
	public function get_all_accionistas($names,$centro_de_costos=""){
		$tabla				=		DB_PREFIJO."usuarios";
  		$html_group_open	=		'<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">';
		$html_group_close	=		'</div>';
		$edit_open			=		$html_group_open.'<a class="btn btn-secondary" title="Editar Usuario" href="'.base_url($this->uri->segment(1).'/Add_Todos/Asociados/');
		$edit_close			=		'"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
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
		$this->db->from(DB_PREFIJO."ma_departamentos t1");
		$this->db->join(DB_PREFIJO."usuarios t2", 't1.id_empresa 	= 	t2.user_id', 'left');
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
		
		if($this->user->mostrar_inactivos==0){
			$this->db->where('t1.estado', 1);
		}
		
		if($this->user->type=='root' && $this->user->principal==0){
			$this->db->where("t1.id_empresa","-1");
		}
		
		//$this->db->where("t1.moneda_de_pago<>","RSS");
		$this->db->order_by('t1.primer_nombre','ASC');
		$query				=	$this->db->get();
		$this->result 		=	$query->result();
		$this->total_rows	= 	$this->total_filas($tabla);
	}
	
	public function get_CuentasBancarias(){
		$tabla				=		DB_PREFIJO."fi_cuentas t1";
		$this->db->select("*");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."sys_bancos t2", 't1.entidad_bancaria = t2.banco_id', 'left');
		$this->db->where('centro_de_costos', $this->user->centro_de_costos);
		$this->db->where('estado', "1");
		$this->db->order_by('titular','ASC');
		$query			=	$this->db->get();
		return $this->result 	=	$query->result();
	}
	
	public function get_AsignarMaster($rel_plataforma_id){
		$tabla				=		DB_PREFIJO."cf_rel_master t1";
		$this->db->select('t1.*,t2');
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
		$this->db->from(DB_PREFIJO."usuarios t1");
		$this->db->where("t1.id_empresa",$id_empresa);
		$this->db->where("t1.type","CentroCostos");
		if($this->user->mostrar_inactivos==0){
			$this->db->where('t1.estado', 1);
		}
		$query 	= 	$this->db->get();
		return $query->result() ;
	}
	
	public function get_empresas(){
		$tabla				=		DB_PREFIJO."usuarios t1";
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
		$tabla		=		DB_PREFIJO."usuarios";
		if(isset($var['redirect'])){
			unset($var['redirect']);	
		}
		$this->db->select("password");
		$this->db->from($tabla);
		$this->db->where("user_id",$this->user->user_id);
		$query			=	$this->db->get();
		if($query->row()->password == md5(post("clave_vieja"))){
			$this->db->where("user_id", $this->user->user_id);
			if($this->db->update($tabla,array("password"=>md5(post("clave_nueva"))))){
				logs($this->user,2,$tabla,$this->user->user_id,"Usuarios","1",array("password"=>md5(post("clave_nueva"))));
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
		$tabla		=		DB_PREFIJO."usuarios";
		if(isset($var['redirect'])){
			unset($var['redirect']);	
		}
		unset($var["iframe"]);
		//print_r($var['user_id']);return;
		if(isset($var['user_id'])&& !empty($var['user_id'])){
			$id			=		array("user_id",$var['user_id']);
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
			$this->db->where($id[0], $id[1]);
			if($this->db->update($tabla,$var)){
				logs($this->user,2,$tabla,$id[1],"Usuarios","1",$var);
				return $var['user_id'];	
			}else{
				logs($this->user,2,$tabla,$id[1],"Usuarios","0",$var);
				return false;	
			}
		}else{
			unset($var['user_id']);
			//print_r($var);return;
			$var['token']			=	md5(date("H:i:s Y-M-d"));
			if($var['type']!='Plataformas'){
				$pass					=	explode("@",$var["email"]);
			}else{
				$pass[0]				=	$var["primer_nombre"];	
			}
			$password				=	$pass[0].rand(1000,50000);
			$var['password']		=	md5($password);
			$var['centro_de_costos']=	$this->user->centro_de_costos;
			$var['id_empresa']		=	(post("id_empresa"))?post("id_empresa"):$this->user->id_empresa;
			if(isset($var["email"])){
			$data	=	$this->db->select('*')->from(DB_PREFIJO."usuarios")->where('email',$var["email"])->get()->row();
			if(!empty($data)){
				return array("error"=>array(	"message"	=>	"Lo siento, el correo electrónico ya está registrado en la base de datos",
												"code"		=>	"203"));return;
												
			}}
			if($this->db->insert($tabla,$var)){
				$insert_id			=	$this->db->insert_id();
				logs($this->user,1,$tabla,$insert_id,"Usuarios","1",$var);
				if($var['type']!='Proveedores' && $var['type']!='Plataformas'){
					send_mail(array(
									"recipient"=>$var['email'],
									"subject"=>"Bienvenido a nuestro sistema",
									"body"=>$this->load->view('Template/Emails/bienvenida',array("userPassword"=>$password,"userEmail"=>$var['email'],"userName"=>$var['email'],"href"=>site_url("Apanel")),TRUE),
									));
				}
				return $insert_id;
			}else{
				return false;	
			}
		}
	}
	
	public function setRol($var){
		$tabla		=		DB_PREFIJO."sys_roles";
		if(isset($var['redirect'])){
			unset($var['redirect']);	
		}
		if(isset($var['rol_id'])&& !empty($var['rol_id'])){
			$id					=		array("rol_id",$var['rol_id']);
			$var["json"]		=		json_encode($var["roles_search"]);
			$var["json_edit"]	=		json_encode($var["roles_edit"]);
			$var["json_add"]	=		json_encode($var["roles_add"]);
			unset($var['roles_search'],$var['roles_edit'],$var['roles_add']);
			$this->db->where($id[0], $id[1]);
			if($this->db->update($tabla,$var)){
				logs($this->user,2,$tabla,$id[1],"Usuarios","1",$var);
				return $var['rol_id'];	
			}else{
				logs($this->user,2,$tabla,$id[1],"Usuarios","0",$var);
				return false;	
			}
		}else{
			if(isset($var["roles_search"])){
				$var["json"]		=		json_encode($var["roles_search"]);
				unset($var['roles_search']);
			}
			if(isset($var["roles_edit"])){
				$var["json_edit"]	=		json_encode($var["roles_edit"]);
				unset($var['roles_edit']);
			}
			unset($var['rol_id']);
			if($this->db->insert($tabla,$var)){
				$insert_id			=	$this->db->insert_id();
				logs($this->user,1,$tabla,$insert_id,"Usuarios","1",$var);
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
	
	public function getAsignarNicknameNEW($id_modelo){
		$tabla						=	DB_PREFIJO."cf_nickname";
		$var['id_empresa']			=	$this->user->id_empresa;
		$this->result =	$this->db->select("*")
									->from($tabla)
									->where('id_empresa',$var['id_empresa'])
									->where('id_modelo',$id_modelo)
									->get()->row();
		
	}
	
	public function setAsignarNickname($var){
		$tabla						=	DB_PREFIJO."cf_nickname";
		//$nickname					=	nickname_like_name($var['nickname'],$var['plataforma']);
		$var['id_empresa']			=	$this->user->id_empresa;

		$nickname=$this->db->select("*")
							->from($tabla)
							//->where('centro_de_costos',$this->user->centro_de_costos)
							->where('id_empresa',$var['id_empresa'])
							->where('id_modelo',$var['id_modelo'])
							->where('id_master',$var['id_master'])
							->where('nickname',$var['nickname'])
							->get()->row();
		
		if(isset($var['redirect'])){
			unset($var['redirect']);	
		}
		if(isset($var['plataforma'])){
			unset($var['plataforma']);	
		}
		if(isset($var['nickname_id'])	&& 	!empty($var['nickname_id'])){
			//pre($var);return;			
			$id	=	array("nickname_id",$var['nickname_id']);
			$this->db->where($id[0], $id[1]);
			if($this->db->update($tabla,$var)){
				$this->db->where("nickname", $var['nickname']);
				$this->db->update(DB_PREFIJO."rp_tmp",array("centro_de_costos"=>$var['centro_de_costos']));
				logs($this->user,2,$tabla,$id[1],$tabla,"1",$var);
				return $var['nickname_id'];	
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

}
?>