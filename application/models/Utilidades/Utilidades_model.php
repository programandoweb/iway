<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Utilidades_model extends CI_Model {
	
	var $fields,$result,$task,$tasks,$where,$total_rows,$pagination,$search,$usuarios,$notificaciones,$notificacion;

	public function deleteItem($var,$var2){
		$tabla = DB_PREFIJO.$var;
		if($this->db->delete($tabla,$var2)){
			return true;
		}else{
			return false;
		}
	}

	public function set_GestionMails($var){
		$cuenta		=	array(	$var["login"].'@'.$var["dominio"],
								$var["password"],
								"unlimited",
								$var["dominio"]);
		if($var["is_model"]==0){						
			if(cpanel_email($cuenta)){
				return true;	
			}
		}else{
			if(cpanel_email($cuenta,true)){
				return true;	
			}
		}
	}

	public function set_NotificacionEmail($var){
		$tabla=DB_PREFIJO."ut_emails";
		$this->db->select("*");
		$this->db->FROM($tabla);
		$this->db->where("correo",$var['correo']);
		$this->db->where("empresa_id",$this->user->id_empresa);
		$this->db->where("centro_de_costos",$this->user->centro_de_costos);
		$this->db->where("Modulo",current_url());
		$query=$this->db->get();
		$data = $query->result();
		if(empty($data)){
			$var['centro_de_costos'] = $this->user->centro_de_costos;
			$var['empresa_id'] 		 = $this->user->id_empresa;
			$var['estado']			 = 1;
			$var['Modulo']			 = current_url();
			if($this->db->insert($tabla,$var)){
				$ultimo_id = $this->db->insert_id();
				logs($this->user,2,$tabla,$this->user->id_empresa,"Usuarios","1",$var);
				$data['response'] = true;
				$data['data']  = array(	"message"	=>	"Felicitaciones el correo fue guardado exitosamente",
										"code"		=>	"100",
										"correo"	=>	$var['correo'],
										"url" 		=>  base_url("Utilidades/deleteItem/".$ultimo_id));
				return $data;	
			}else{
				logs($this->user,2,$tabla,$this->user->id_empresa,"Usuarios","0",$var);
				$error['response'] = false;
				return $data;	
			}
		}else{
			$error['response'] = true;
			$error['data']  = array(	"message"	=>	"Este correo electronico ya existe",
										"code"		=>	"200");
			return $error;
		}
	}

	/*public function get_NotificacionEmail($url){
		$tabla=DB_PREFIJO."ut_emails";
		$this->db->select("*");
		$this->db->from($tabla);
		$this->db->where("empresa_id",$this->user->id_empresa);
		$this->db->where("centro_de_costos",$this->user->centro_de_costos);
		$this->db->where("estado",1);
		$this->db->where("Modulo",$url);
		$query=$this->db->get();
		$this->result=$query->result();
	}*/

	public function enviarCorreoAdvertencia(){
		$tabla=DB_PREFIJO."cf_nickname t1";
		$this->db->select("t1.*,t2.primer_nombre,t2.segundo_nombre,t2.primer_apellido,t2.segundo_apellido,t2.email,t3.primer_nombre as plataforma");
		$this->db->FROM($tabla);
		$this->db->join(DB_PREFIJO."usuarios t2", 't1.id_modelo=t2.user_id', 'left');
		$this->db->join(DB_PREFIJO."usuarios t3", 't1.id_plataforma=t3.user_id', 'left');
		$this->db->where("bloqueo_pais","No");
		$query=$this->db->get();
		$data = $query->result();
		foreach ($data as $k => $v) {
			$opcionesAdicionales = json_decode($v->opciones_adicionales);
			if($opcionesAdicionales->dia <= 3){
				send_mail(array(
					"recipient"=>$v->email,
					"subject"=>"Mensaje de advertencia",
					"body"=>$this->load->view('Template/Emails/MensajeAdvertencia',array("data"=>array("opciones_adicionales"=>$v->opciones_adicionales,"nombre"=>$v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido,"plataforma"=>$v->plataforma,"nickname"=>$v->nickname)),TRUE),
				));
				$contador['opciones_adicionales'] = json_encode(array_merge((array)$opcionesAdicionales,array("dia"=>$opcionesAdicionales->dia + 1)));
				$this->db->where("nickname_id",$data[$k]->nickname_id);	
				$this->db->update(DB_PREFIJO."cf_nickname",$contador);
		 		//echo $contador;
		 	}
		}
		//pre($data);
		 return;
	}

	public function dbutil(){
		$this->load->dbutil();
		$list_databases		=	$this->dbutil->list_databases();
		$tables 			= 	$this->db->list_tables();
		$sql				=	'';
		foreach($tables as $v){
			$tabla			=	$v;
			$sql			.=	"	CREATE TABLE `".$v."` (
										`id` varchar(40) NOT NULL,
										`ip_address` varchar(45) NOT NULL,
										`timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
										`data` blob NOT NULL 
								";
			$fields 		=	$this->db->field_data($tabla);
			foreach($fields as $field){
				$max_length		=	($field->max_length)?"(40)":"";
				$sql			.=	" `".$field->name."` ".$field->type."".$max_length." NOT NULL ";		
				pre($field);	
			}			
			$sql			.=	"	)ENGINE=MyISAM DEFAULT CHARSET=latin1;";
		}		
		return;
	}
	
	public function get_Notificaciones($user_id){
		$tabla=DB_PREFIJO."ut_notificaciones";
		$this->db->select("*");
		$this->db->from($tabla);
		$this->db->where("user_id",$user_id);
		$query=$this->db->get();
		$this->notificaciones=$query->result();
	}

	public function get_nickname($nickname_id){
		$tabla	=	DB_PREFIJO."cf_nickname t1";
		$this->db->select("t1.nickname,t1.password");
		$this->db->from($tabla);
		$this->db->where('t1.id_modelo',$nickname_id["id"]);
		$this->db->join(DB_PREFIJO."usuarios t2", 't1.id_plataforma=t2.user_id', 'left');
		$this->db->where('t1.centro_de_costos',$this->user->centro_de_costos);
		$this->db->where('t1.id_empresa',$this->user->id_empresa);
		$this->db->where('t2.tipo_persona !=',"RSS");
		$row	= 	$this->db->get()->row();
		$response = json_encode($row);
		return $response;
	}
	
	public function get_Notificacion($notificacion_id){
		$tabla=DB_PREFIJO."ut_notificaciones";
		$this->db->select("*");
		$this->db->from($tabla);
		$this->db->where("notificacion_id",$notificacion_id);
		$query=$this->db->get();
		$this->notificacion=$query->row();
		
		$this->db->where("notificacion_id",$this->notificacion->notificacion_id);	
		$this->db->update(DB_PREFIJO."ut_notificaciones",array("estatus"=>2));
	}
	
	public function get_all_users(){
		$tabla=DB_PREFIJO."usuarios";
		$this->db->select("*");
		$this->db->from($tabla);
		$this->db->where_in("type",array("root"));
		$query=$this->db->get();
		$this->usuarios=$query->result();
		
		foreach($this->usuarios as $v){
			$this->db->where("user_id",$v->user_id);	
			$this->db->update(DB_PREFIJO."usuarios",array("token"=>md5($v->user_id)));
		}
	}
	
	public function get_users_assigned($tarea_id){
		$tabla=DB_PREFIJO."ut_tareas_asignacion t1";
		$this->db->select("t1.*,t2.primer_nombre,t2.segundo_nombre,t2.primer_apellido,t2.segundo_apellido");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."usuarios t2", 't1.user_id=t2.user_id', 'left');
		$this->db->where("tarea_id",$tarea_id);
		$query=$this->db->get();
		$this->usuarios=$query->result();
	}
	
	public function get_user($user_id){
		$tabla				=		DB_PREFIJO."usuarios";
		$this->db->select("*");
		$this->db->from($tabla);
		$this->db->where_in("type",array("root"));
		$this->db->where("user_id",$user_id);
		$query			=	$this->db->get();
		$this->result 	=	$query->row();
	}
	
	public function get_task($id){
		$tabla				=	DB_PREFIJO."ut_tareas";
		$this->task 		=	$this->db->select("*")
									->from($tabla)
									->where("tarea_id",$id)
									->get()
									->row();
	}
	
	public function get_tasks($estatus=1){
		$tabla				=		DB_PREFIJO."ut_tareas";
		$this->db->select("*");
		$this->db->from($tabla);
		if($estatus!='all'){
			$this->db->where("estatus",$estatus);
		}
		$this->db->order_by('estatus','ASC');
		$query					=	$this->db->get();
		return $query->result();
	}
	
	public function get_tasksMe($estatus=1){
		$tabla				=		DB_PREFIJO."ut_tareas t1";
		$this->db->select("t1.estatus,t1.tarea,t1.fecha_desde,t1.fecha_hasta,t1.tarea_id");
		$this->db->from($tabla);
		$this->db->join(DB_PREFIJO."ut_tareas_asignacion t2", 't1.tarea_id=t2.tarea_id', 'left');
		$this->db->where("t1.estatus",$estatus);
		$this->db->where("t2.user_id",$this->user->user_id);
		$query			=	$this->db->get();
		$this->tasksMe 	=	$query->result();
	}

	public function set_estado(){
		$var['estado'] = $this->uri->segment(4);
		if($this->uri->segment(5) == "CorreoNotificacion"){
			$tabla = DB_PREFIJO."ut_emails";
			$this->db->where("id_email",$this->uri->segment(3));
		}else{
			$tabla = DB_PREFIJO."ut_form_control";
			$this->db->where("id_form_contrl",$this->uri->segment(3));
		}
		if($this->db->update($tabla,$var)){
			return true;
		}else{
			return false;
		}
	}
	
	public function set_user($var){
		$id					=		array("user_id",$var['user_id']);
		$tabla				=		DB_PREFIJO."usuarios";
		if($id[1]>0){
			$this->db->where($id[0], $id[1]);
			if($this->db->update($tabla,$var)){
				logs($this->user,2,$tabla,$id[1],"Usuarios","1",$var);
				return $var['user_id'];	
			}else{
				logs($this->user,2,$tabla,$id[1],"Usuarios","0",$var);
				return false;	
			}
		}else{
			if($this->db->insert($tabla,$var)){
				logs($this->user,2,$tabla,$id[1],"Usuarios","1",$var);
				return $var['user_id'];	
			}else{
				logs($this->user,2,$tabla,$id[1],"Usuarios","0",$var);
				return false;	
			}
		}
	}

	public function get_form_control($url = null){
		
		$this->db->select("*");
		$this->db->from(DB_PREFIJO."ut_form_control");
		$this->db->where("empresa_id",$this->user->id_empresa);
		if(empty($url)){
			$this->db->where("nombre_form",$this->uri->segment(2));
		}else{
			$this->db->where("nombre_form",$url);
		}
		if($this->uri->segment(3)){
			$this->db->where("id_form_contrl",$this->uri->segment(3));
		}
		$query = $this->db->get();
		$this->result		=	$query->result();
		return;
	}

	public function set_form_control($data){

		if(isset($_FILES)){
		 
			foreach ($_FILES as $k => $v) {
				$prueba = calidadImagen(25,$k,"images/uploads".$this->uri->segment(2),array("allowed_types"=>'gif|jpg|png',"max_width"=>1024,"max_height"=>768));
		      
			}
		}
		$data['responsable'] = nombre(centrodecostos($this->user->user_id));
		if(!empty($data['plataforma'])){
			$data['plataforma'] = nombre(centrodecostos($data['plataforma']));
		}
       	$consecutivo 	= (empty($this->uri->segment(3)))?consecutivo($this->user->id_empresa,$this->uri->segment(4)):consecutivo($this->user->id_empresa,$this->uri->segment(3));
		$data['tipo_documento'] = $this->uri->segment(4);
		$var['consecutivo'] = $consecutivo;
		$data['fecha'] = date("Y-m-d H:i:s");
		$var['data'] = json_encode($data);
		$var['nombre_form'] = $this->uri->segment(2);
		$var['user_id'] = $data['id_modelo'];
		$var['centro_de_costos'] = $this->user->centro_de_costos;
		$var['empresa_id'] = $this->user->id_empresa;
		$var['estado'] = 1;
		$tabla				=		DB_PREFIJO."ut_form_control";

		if($this->db->insert($tabla,$var)){
			$id = $this->db->insert_id();
			$tabla2 = 	DB_PREFIJO."sys_observaciones";
			$observacion['url'] = base_url("Utilidades/SolicitudPlataformas/".$id."#observaciones");
			$observacion['observacion'] = "Se solicita apertura de cuenta";
			$observacion['user_id'] 	= $this->user->user_id;
			$observacion['fecha']		= date("Y-m-d h:i:s");
			$observacion['empresa_id']	= $var['empresa_id'];
			$observacion['centro_de_costos'] = $var['centro_de_costos'];
			if($this->db->insert($tabla2,$observacion)){
				
				if(!empty($data['plataforma'])){
					$this->result[0] = new stdClass;
					foreach ($var as $key => $value) {
						$this->result[0]->$key = $value;
					}
					$empresa			=	centrodecostos($this->user->id_empresa);
					ob_start();
					$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
					$html				.=	$this->load->view('Template/PDF/SolicitudPlataformas',array("empresa"=>$empresa,"url"=>$observacion['url']),TRUE);	
					$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
					echo $html;
					$salida 			= 	ob_get_clean();
					//echo $salida;return;
					//pdf_A5($salida,array(0,0,608,530));
					if(!empty($data['correos'])){
						$correos = json_decode($data['correos']);
						foreach ($correos as $k => $v) {
							enviar_pdf($salida,$v,"Solicitud creación Plataforma ".$data['plataforma'].' '.$data['nombre_modelo'],$this->load->view('Template/Emails/produccion',array("nombre"=>$data['nombre_modelo']),TRUE),"Solicitud Plataforma.pdf",$this->uri->segment(1));
						}
					}
				}
				$tipo = (empty($this->uri->segment(3)))?$this->uri->segment(4):$this->uri->segment(3);
				incrementa_consecutivo($this->user->id_empresa,$tipo);
				logs($this->user,1,$tabla,$var['user_id'],"ut_form_control",1,$data);
				return true;	
			}else{
				logs($this->user,1,$tabla,$var['user_id'],"ut_form_control",0,$data);
				return false;	
			}
		}
	}

	public function info_ControlEntregaRoom($var){
		$tabla				=		DB_PREFIJO."usuarios";
		$this->db->select("room_transmision
						  ,user_id,primer_nombre
						  ,segundo_nombre
						  ,primer_apellido
						  ,segundo_apellido");
		$this->db->from($tabla);
		$this->db->where("type","Modelos");
		$this->db->where("estado",1);
		$this->db->where("id_empresa",$this->user->id_empresa);
		$this->db->where($var['turno'],1);
		if(!empty($var['room'])){
			$this->db->where("room_transmision",$var['room']);
		}else{
			$this->db->group_by("room_transmision");
		}
		$query			=	$this->db->get();
		$result 	=	$query->result();
		return $result;
	}
	
	public function SaveViewTask($var){
		$insert_tareas	=	$var;
		$query	=	$this->db->select("t1.user_id")
								->from(DB_PREFIJO."ut_tareas t1")
								->where("t1.tarea_id",$var['tarea_id'])
								->get();
		$responsable		=	$query->row();
		
		if($responsable->user_id<>$this->user->user_id || $this->user->user_id==1){
			return false;
		}
		
		$this->db->where("tarea_id",$var['tarea_id']);	
		$lunes				=	lunes(1);
		$insert_tareas		=	array_merge($insert_tareas,$lunes);
		$insert_tareas['descripcion']=$var['descripcion'];
		$insert_tareas['estatus']=1;
		$this->db->update(DB_PREFIJO."ut_tareas",$insert_tareas);
		
		$insert_feedback	=	array(	"tarea_id"=>$var['tarea_id'],
										"user_id"=>$this->user->user_id,
										"fecha"=>date("Y-m-d"),
										"mensaje"=>"Editada incidencia " .$var['tarea_id'],
										"estatus"=>1);

		if($this->db->insert(DB_PREFIJO."ut_tareas_feedback",$insert_feedback)){
			$ultima_feedback_id	=	$this->db->insert_id();	
		}

		$query	=	$this->db->select("t1.user_id")
								->from(DB_PREFIJO."ut_tareas_asignacion t1")
								->where("t1.tarea_id",$var['tarea_id'])
								->get();
		
		$asignados_para_notificaciones			=	array();
		foreach($query->result() as $v){
			$asignados_para_notificaciones[]	=	array(	"tabla_notificacion"=>"ut_tareas",
															"user_id"=>$v->user_id,
															"fecha"=>date("Y-m-d"),
															"estatus"=>1,
															"campo_id"=>json_encode(array(	"name"=>"tarea_id",
																							"value"=>$var['tarea_id'],
																							"message"=>"Editada incidencia ".$var['tarea_id'],
																							"responsable_id"=>$this->user->user_id
																							))
															);
		}
		$this->db->insert_batch(DB_PREFIJO.'ut_notificaciones', $asignados_para_notificaciones);		
		return true;
	}
	
	public function SaveCloseTask($current_id){
		$query	=	$this->db->select("t1.user_id")
								->from(DB_PREFIJO."ut_tareas t1")
								->where("t1.tarea_id",$current_id)
								->get();
		$responsable		=	$query->row();
		
		if($responsable->user_id<>$this->user->user_id){
			//return false;
		}
		
		$insert_feedback	=	array(	"tarea_id"=>$current_id,
										"user_id"=>$this->user->user_id,
										"fecha"=>date("Y-m-d"),
										"mensaje"=>"Cerrada incidencia " .$current_id,
										"estatus"=>1);

		if($this->db->insert(DB_PREFIJO."ut_tareas_feedback",$insert_feedback)){
			$ultima_feedback_id	=	$this->db->insert_id();	
		}
		$this->db->where("tarea_id",$current_id);	
		$this->db->update(DB_PREFIJO."ut_tareas",array("estatus"=>3));
		
		$query	=	$this->db->select("t1.user_id")
								->from(DB_PREFIJO."ut_tareas_asignacion t1")
								->where("t1.tarea_id",$current_id)
								->get();
		
		$asignados_para_notificaciones			=	array();
		foreach($query->result() as $v){
			$asignados_para_notificaciones[]	=	array(	"tabla_notificacion"=>"ut_tareas",
															"user_id"=>$v->user_id,
															"fecha"=>date("Y-m-d"),
															"estatus"=>1,
															"campo_id"=>json_encode(array(	"name"=>"tarea_id",
																							"value"=>$current_id,
																							"message"=>"Cerrada incidencia ".$current_id,
																							"responsable_id"=>$this->user->user_id
																							))
															);
		}
		$this->db->insert_batch(DB_PREFIJO.'ut_notificaciones', $asignados_para_notificaciones);		
		return true;
	}
	
	public function SaveTaskResponse($var){
		$insert_feedback	=	array(	"tarea_id"=>$var['current_id'],
										"user_id"=>$this->user->user_id,
										"fecha"=>date("Y-m-d"),
										"mensaje"=>"(Solicitud de cerrar incidencia) " .$var['descripcion'],
										"estatus"=>1);

		if($this->db->insert(DB_PREFIJO."ut_tareas_feedback",$insert_feedback)){
			$ultima_feedback_id	=	$this->db->insert_id();	
		}
		
		if($var['cerrar']==1){
			$this->db->where("tarea_id",$var['current_id']);	
			$this->db->update(DB_PREFIJO."ut_tareas",array("estatus"=>2));				
			$query	=	$this->db->select("t1.user_id")
								->from(DB_PREFIJO."ut_tareas_asignacion t1")
								->where("t1.tarea_id",$var['current_id'])
								->get();
			
			$asignados_para_notificaciones			=	array();
			foreach($query->result() as $v){
				$asignados_para_notificaciones[]	=	array(	"tabla_notificacion"=>"ut_tareas",
																"user_id"=>$v->user_id,
																"fecha"=>date("Y-m-d"),
																"estatus"=>1,
																"campo_id"=>json_encode(array(	"name"=>"tarea_id",
																								"value"=>$var['current_id'],
																								"message"=>"Solicitada cerrar incidencia",
																								"solicitante_id"=>$this->user->user_id
																								))
																);
			}
			$query	=	$this->db->select("t1.user_id")
								->from(DB_PREFIJO."ut_tareas t1")
								->where("t1.tarea_id",$var['current_id'])
								->get();
			$row=$query->row();					
			
			$asignados_para_notificaciones[]		=	array(	"tabla_notificacion"=>"ut_tareas",
																"user_id"=>$row->user_id,
																"fecha"=>date("Y-m-d"),
																"estatus"=>1,
																"campo_id"=>json_encode(array(	"name"=>"tarea_id",
																								"value"=>$var['current_id'],
																								"message"=>"Solicitada cerrar incidencia",
																								"solicitante_id"=>$this->user->user_id
																								))
																);
			$this->db->insert_batch(DB_PREFIJO.'ut_notificaciones', $asignados_para_notificaciones);
		}
		$uploadas	=	upload('userfile','images/uploads/tasks/'.$var['current_id'].'/'.$ultima_feedback_id.'/',$config=array("allowed_types"=>'gif|jpg|png|pdf|doc',"max_size"=>3000,"max_width"=>3000,"max_height"=>3000));
		if($var['image']){
			define('UPLOAD_DIR','images/uploads/tasks/'.$var['current_id'].'/'.$ultima_feedback_id.'/');
			$image_parts = explode(";base64,", $_POST['image']);
			$image_type_aux = explode("image/", $image_parts[0]);
			$image_type = $image_type_aux[1];
			$image_base64 = base64_decode($image_parts[1]);
			$file = UPLOAD_DIR . uniqid() . '.jpg';
			file_put_contents($file, $image_base64);	
		}
		return true;
	}
	
	public function save($var){
		$insert_tareas				=	$var;
		$insert_tareas["user_id"]	=	$this->user->user_id;
		$lunes						=	lunes($var["prioridad"]);
		$insert_tareas				=	array_merge($insert_tareas,$lunes);
		$ultima_tarea_id			=	0;
		$fecha						=	date("Y-m-d");
		$insert_tareas['estatus']	=	1;
		
		$insertar_esto				=	array(
												"user_id"=>$this->user->user_id,
												"fecha_desde"=>$insert_tareas["fecha_desde"],
												"fecha_hasta"=>$insert_tareas["fecha_hasta"],
												"tarea"=>$insert_tareas["descripcion"],
												"estatus"=>$insert_tareas["estatus"],
												"descripcion"=>json_encode($insert_tareas)
											);
	
		unset($insert_tareas["asignacion"],$insert_tareas["prioridad"]);
		if($this->db->insert(DB_PREFIJO."ut_tareas",$insertar_esto)){
			$ultima_tarea_id	=	$this->db->insert_id();	
		}else{
			return false;
		}	
		
		$uploadas	=	upload('userfile','images/uploads/tasks/'.$ultima_tarea_id.'/',$config=array("allowed_types"=>'gif|jpg|png|pdf|doc',"max_size"=>3000,"max_width"=>3000,"max_height"=>3000));
		
		$insert_asignacion=array();
		$insert_notificaciones=array();
		foreach($var["asignacion"] as $k =>$v){
			if(!empty($var["asignacion"][$k])){
				$insert_asignacion[$k]						=	new stdClass();	
				$insert_asignacion[$k]->tarea_id 			=	$ultima_tarea_id;
				$insert_asignacion[$k]->user_id 			=	$v;
				$insert_asignacion[$k]->fecha	 			=	$fecha;			
				$insert_asignacion[$k]->asignacion 			=	$var["asignacion"][$k];
				$insert_asignacion[$k]->estatus 			=	1;
				
				$insert_notificaciones[$k]=new stdClass();	
				$insert_notificaciones[$k]->tabla_notificacion	=	"ut_tareas";
				$insert_notificaciones[$k]->campo_id 			=	json_encode(array("name"=>"tarea_id","value"=>$ultima_tarea_id));
				$insert_notificaciones[$k]->user_id 			=	$v;
				$insert_notificaciones[$k]->fecha	 			=	$fecha;
				$insert_notificaciones[$k]->estatus 			=	0;
			}
		}
		if($this->db->insert_batch(DB_PREFIJO.'ut_tareas_asignacion', $insert_asignacion) &&
		$this->db->insert_batch(DB_PREFIJO.'ut_notificaciones', $insert_notificaciones)){
			return true;	
		}
		
	}
}
?>