<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Utilidades extends CI_Controller {
	
	var $util,$user,$ModuloActivo,$path,$listar,$Utilidades,$Breadcrumb,$Uri_Last,$Listado;
	
	public function __construct(){    	
        parent::__construct();
		if(!defined('APANEL_UTILIDADES') || APANEL_UTILIDADES == FALSE){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}

		$this->util 		= 	new Util_model();
		$this->Breadcrumb 	=	$this->uri->segment_array();
		$this->Uri_Last		=	$this->uri->segment($this->uri->total_rsegments());
		$this->user			=	$this->session->userdata('User');
		$this->ModuloActivo	=	'Utilidades';
		$this->Path			=	PATH_VIEW.'/Template/'.$this->ModuloActivo;
		$this->listar		=	new stdClass();	
		$this->load->helper('directory');

		if($this->uri->segment(2) != "enviarCorreoAdvertencia" ){
			if(!isset($_SERVER['HTTP_REFERER'])){
				redirect(base_url("Main/ErrorUrl"));
				return;
			}

		if(empty($this->user)){
			redirect(base_url("Main"));	return;
		}		

		if(defined('APANEL_UTILIDADES')){
			$this->load->model("Utilidades/Utilidades_model");
			$this->Utilidades	= 	new Utilidades_model();
		}
			chequea_session($this->user);
		}
    }
	
	public function Index(){
		if(!defined('APANEL_UTILIDADES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		redirect(base_url($this->uri->segment(1)."/Listado"));	return;
	}

	public function deleteItem(){
		if(!defined('APANEL_UTILIDADES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$tabla = "ut_emails"; 
		$delete = $this->Utilidades->deleteItem($tabla,array("id_email"=>$this->uri->segment(3)));
		if($delete){
			$this->session->set_flashdata('success', "El registro ha sido borrado exitosamente");
		}else{
			$this->session->set_flashdata('danger', "Este registro no ha podido ser eliminado");
		}
		redirect(base_url("Utilidades/CorreoNotificacion"));
		return;
	}

	public function links(){
		$links = insert_links(post());
		echo json_encode($links);
		return;
	}

	public function ConfigEmail(){
		if(post()){
			$set = set_form_control(post());
			if ($this->input->is_ajax_request()){
				if($set){
				$this->Response 		=			array(	"message"	=>	"Los datos han sido guardados correctamente",
															"callback"	=>	"reloader_page()");
				}else{
					$this->Response 		=			array(	"message"	=>	"No se pudo guardar los datos",
																"code"		=>	"203");
				}
			echo answers_json($this->Response);			return;
			}else{
				if($set){
					$this->session->set_flashdata('success', "Los datos han sido guardados correctamente");
				}else{
					$this->session->set_flashdata('danger',"No se pudo guardar los datos");
				}
				redirect(post('url'));
				return;
			}
		}
	}

	public function cambiarEstado(){
		$set = $this->Utilidades->set_estado();
		if($set){
			if($this->uri->segment(5) == "SolicitudPlataformas"){
				$var['url'] = base_url("Utilidades/SolicitudPlataformas/".$this->uri->segment(3).'#observaciones');
				if($this->uri->segment(4) == 2){
					$var['observacion'] = "Esta plataforma ha sido creada, pendiente: aprobación";
				}else if($this->uri->segment(4) == 0){
					$var['observacion'] = "Esta plataforma ha sido rechazada";
				}elseif($this->uri->segment(4) != 9){
					$var['observacion'] = "Esta plataforma ha sido aprobada.";
				}
				if($this->uri->segment(4) != 9){
					$observacion = insertar_Observacion($var);
					$this->session->set_flashdata('success', "El estado de su solicitud ha cambiado");
					$solicitud = GetFormControl($this->uri->segment(3));
					$data = json_decode($solicitud[0]->data); 
					$correos = get_NotificacionEmail(base_url("Utilidades/CorreoNotificacion/SolicitudPlataformas"));
					$correos['modelo'] = new stdClass;
					$correos['modelo']->correo = centrodecostos($solicitud[0]->user_id)->email;
					$correos['monitor'] = new stdClass;
					$correos['monitor']->correo = centrodecostos(centrodecostos($data->id_modelo)->monitor)->email;
					if($this->uri->segment(4) == 2){
						$accion = 'ya fué creada';
						$title  = 'creacion Plataforma';
						$adicional = '.';
					}else if($this->uri->segment(4) == 0){
						$accion = 'fué rechazada';
						$title  = 'creacion Plataforma';
						$adicional = '.';
					}else{
						$accion = 'ya fué aprobada';
						$title  = 'Aprobacion plataforma';
						$adicional = 'ya puedes transmitir.';
					}
					$message = '<p><b style="color: black;">Importante</b>: Hola <b>'.$data->nombre_modelo.'</b>, WebcamPlus® te informa que la cuenta de la plataforma <b>'.$data->plataforma.'</b>; solicitada el <b>'.$data->fecha.'</b> por <b>'.$data->responsable.'</b> '.$accion.' para tu usuario <b>'.$data->usuario.'</b> '.$adicional.'</p>

	        			<p>Cordialmente,</p>
	        			<div style="height: 40px;"></div>
	        			<p><b>Equipo WebcamPlus®.</b></p> 
	        			<p>Para saber mas detalles puedes acceder a tu cuenta dando<a href="https://webcamplus.com.co/belle" target="_blank"> click a este vinculo</a>.</p>';

					foreach ($correos as $k => $v){
						send_mail(array(
							"recipient"=>@$v->correo,
							"subject"=>"Solicitud creacion Plataforma ".$data->plataforma.' '.$data->nombre_modelo,
							"body"=>$this->load->view('Template/Emails/PlantillaEmails',array("title"=>$title,"message"=>$message),TRUE),
						));
					}
				}

				redirect(base_url("Utilidades/SolicitudPlataformas/#".$this->uri->segment(6)));
			}else{
				$this->session->set_flashdata('success', "El estado de su reporte ha cambiado");
				redirect(base_url("Utilidades/SeguimientoModelos/#".$this->uri->segment(6)));
			}
		}else{
			$this->session->set_flashdata('danger', "El estado de su reporte no ha cambiado");
		}
		return;
	}
	
	public function ControlEntregaRoom(){
		if(post()){
			if($this->uri->segment(4) == "form_control"){
			 	$response = $this->Utilidades->info_ControlEntregaRoom(post());
			 	echo answers_json($response);
				return;		
			}
			$set = $this->Utilidades->set_form_control(post());
			if($set){
			$this->Response 		=			array(	"message"	=>	"Los datos han sido guardados correctamente",
														"callback"	=>	"reloader_iframe()");
														
														
			}else{
				$this->Response 		=			array(	"message"	=>	"No se pudo guardar los datos",
															"code"		=>	"203");
			}
			echo answers_json($this->Response);			return;		
		}
		$this->Utilidades->get_form_control();
			if($this->uri->segment($this->uri->total_segments()) == "PDF"){
				$empresa			=	centrodecostos($this->user->id_empresa);
				ob_start();
				$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
				$html				.=	$this->load->view('Template/PDF/ControlEntregaRoom1',array("empresa"=>$empresa),TRUE);	
				$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
				echo $html;
				$salida 			= 	ob_get_clean();
				//echo $salida;return;
				CertificadoLaboral_pdf($salida);
				return;
			}
		if($this->uri->segment(3)){
			$this->listar->view="Utilidades/Form_ControlEntregaRoom";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			formAjax($this->listar->view); 	
			return;		
		}
		$this->listar->view="Utilidades/List_ControlEntregaRoom";	
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
		listados($this->listar->view); 		
	}

	public function CorreoNotificacion(){

		if(post()){
			$set = $this->Utilidades->set_NotificacionEmail(post());
			if($set["response"]){
				$this->Response 		=			$set["data"];
			}else{
				$this->Response 		=			array(	"message"	=>	"No se pudo guardar los datos",
															"code"		=>	"203");
			}
		    
			echo answers_json($this->Response);			return;
		}
		/*$this->listar->view="Utilidades/Form_CorreoNotificacion";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		FormAjax($this->listar->view);*/
		redirect(base_url("Utilidades/SolicitudPlataformas"));
		return true;
	}

	public function CalculaSueldo(){

		if(post()){
			pre(post()); return;
			$set = $this->Utilidades->set_NotificacionEmail(post());
			if($set["response"]){
				$this->Response 		=			$set["data"];
			}else{
				$this->Response 		=			array(	"message"	=>	"No se pudo guardar los datos",
															"code"		=>	"203");
			}
		echo answers_json($this->Response);			return;
		}	
		$this->listar->view="Utilidades/Form_CalculaSueldo";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view);
		return true;
	}

	public function SolicitudPlataformas(){
		if(defined('APANEL_USUARIOS')){
			$this->load->model("Usuarios/Usuarios_model");
			$this->Usuarios	= 	new Usuarios_model();
		}
		if(post()){
			pre(post());
			if($this->uri->segment($this->uri->total_segments()) == "form_control"){
				$response = $this->Utilidades->get_nickname(post());
				echo $response;
				return;
			}
			$set = $this->Utilidades->set_form_control(post());
			if($set){
				//unset($_POST);
				$this->Response 		=			array(	"message"	=>	"Los datos han sido guardados correctamente",
															"callback"	=>	"reloader_iframe()");
				}else{
					$this->Response 		=			array(	"message"	=>	"No se pudo guardar los datos",
																"code"		=>	"203");
				}
				echo answers_json($this->Response);			return;
		}
		$this->Utilidades->get_form_control();
		if($this->uri->segment($this->uri->total_segments()) == "PDF"){
				$empresa			=	centrodecostos($this->user->id_empresa);
				ob_start();
				$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
				$html				.=	$this->load->view('Template/PDF/SolicitudPlataformas',array("empresa"=>$empresa),TRUE);	
				$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
				echo $html;
				$salida 			= 	ob_get_clean();
				//echo $salida;return;
				CertificadoLaboral_pdf($salida);
				return;
			}
		if(is_numeric($this->uri->segment(3))){
			$this->listar->view="Utilidades/List_VerSolicitudPlataformas";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			formAjax($this->listar->view); 	
			return false;

		}else if($this->uri->segment(3)){
			$this->listar->view="Utilidades/Form_SolicitudPlataformas";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			formAjax($this->listar->view); 	
			return false;
				
		}

		$this->listar->view="Utilidades/List_SolicitudPlataformas";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		Listados($this->listar->view);
	}
	
	public function GestionMails(){
		if(!defined('APANEL_UTILIDADES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(post()){
			if($this->Utilidades->set_GestionMails(post())){
				$this->session->set_flashdata('success', 'Felicitaciones, el correo ha sido creado.');
				echo '<script>parent.location.reload();</script>';	
			}else{
				$this->session->set_flashdata('danger', 'Lo sentimos, el correo no fue creado.');	
				echo '<script>alert("Error");</script>';
			}
			return false;	
		}
		if($this->uri->segment(3)=='add'){
			$this->listar->view="Utilidades/Form_GestionMails";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			formAjax($this->listar->view); 	
			return false;	
		}else if($this->uri->segment(3)=='webmail'){
			$this->listar->view="Utilidades/List_MeMails";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			formAjax($this->listar->view); 	
			return false;	
		}
		if($this->user->type=='root' || !$this->uri->segment(3)){
			$this->listar->view="Utilidades/List_GestionMails";			
		}else{
			$this->listar->view="Utilidades/List_MeMails";			
		}		
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view); 		
	}

	public function SeguimientoModelos(){
		if(post()){
			$set = $this->Utilidades->set_form_control(post());
			if($set){
			$this->Response 		=			array(	"message"	=>	"Los datos han sido guardados correctamente",
														"callback"	=>	"reloader_iframe()");
			}else{
				$this->Response 		=			array(	"message"	=>	"No se pudo guardar los datos",
															"code"		=>	"203");
			}
		echo answers_json($this->Response);			return;
		}
		$this->Utilidades->get_form_control();
		if($this->uri->segment(4) == "PDF"){
			$empresa			=	centrodecostos($this->user->id_empresa);
			ob_start();
			$html				=	$this->load->view('Template/PDF/Header',array(),TRUE);
			$html				.=	$this->load->view('Template/PDF/SeguimientoModelos',array("empresa"=>$empresa),TRUE);	
			$html				.=	$this->load->view('Template/PDF/Footer',array(),TRUE);	
			echo $html;
			$salida 			= 	ob_get_clean();
			//echo $salida;return;
			if($this->uri->segment($this->uri->total_segments()) == "enviar"){
				$correo = @centrodecostos($this->uri->segment(5));
				enviar_pdf($salida,$correo->email,"Seguimiento modelo ".nombre($correo),$this->load->view('Template/Emails/PlantillaEmails',array("title"=>"Seguimiento Modelos","message"=>"Hola <b>".nombre($correo)."</b> para tu seguimiento y control adjuntamos el presente documento."),TRUE),"Seguimiento modelo.pdf",$this->uri->segment(2));
				$this->session->set_flashdata('success', "El documento ha sido enviado");
				redirect(base_url("Utilidades/SeguimientoModelos"));
				return;
			}else{
				CertificadoLaboral_pdf($salida);
			}
			return;
		}
		if($this->uri->segment($this->uri->total_segments()) == "DetalleSeguimiento"){
			$this->listar->view="Utilidades/DetalleSeguimientoModelos";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			formAjax($this->listar->view); 	
			return;
		}
		if($this->uri->segment(3)){
			$this->listar->view="Utilidades/Form_SeguimientoModelos";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			formAjax($this->listar->view); 	
			return;		
		}	

		$this->listar->view="Utilidades/List_SeguimientoModelos";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		Listados($this->listar->view);
	}
	
	public function Database(){
		if($this->uri->segment(3)){
			$this->load->dbutil();
			$prefs = array(
				'foreign_key_checks'=>TRUE,
				'ignore'        => array(),                     // List of tables to omit from the backup
				'format'        => 'sql',                       // gzip, zip, txt
				'filename'      => 'mybackup.sql',              // File name - NEEDED ONLY WITH ZIP FILES
				'add_drop'      => TRUE,                        // Whether to add DROP TABLE statements to backup file
				'add_insert'    => FALSE
			);
			$sin_insert 	= 	$this->dbutil->backup($prefs);
			$tables 		= 	$this->db->list_tables();
			$con_insert		=	"";
			foreach($tables as $v){
				$this->db->select("*");
				$this->db->from($v);
				$query=$this->db->get();
				$rows=$query->result();
				$con_insert	.=	" ";
				foreach($rows as $k2 => $v2){
					$con_insert	.=	"INSERT INTO `".$v."` (";
					foreach($v2 as $k3 => $v3){
						$con_insert	.=	"`".$k3."`,";
					}
					$con_insert	=	substr($con_insert,0,-1);
					$con_insert	.=	") VALUE (";		
					foreach($v2 as $k3 => $v3){
						$con_insert	.=	"'".addslashes($v3)."',";
					}
					$con_insert	=	substr($con_insert,0,-1);
					$con_insert	.=	"); \n";		
				}
				
				
			}
			$backup	= $sin_insert.$con_insert;
			$this->load->helper('download');
			force_download('db.sql', $backup);
			return;			
		}
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados("Utilidades/Database"); 		
	}
	
	public function notificaciones(){
		$token=Utilidades_Notificaciones(post("token"));
		if($token){
			echo json_encode(array(	"code"	=>	200,
									"rows"	=>	$token));	
		}else{
			echo json_encode(array(	"code"	=>	200,
									"rows"	=>	$token));
		}		
	}
	
	public function List_Notificaciones(){
		if(!defined('APANEL_UTILIDADES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Utilidades->get_Notificaciones($this->user->user_id);
		$this->listar->view="Utilidades/List_Notificaciones";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view); 	
	}
	
	public function Programadores(){
		if(!defined('APANEL_UTILIDADES')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		$this->Utilidades->get_all_users();
		$this->Utilidades->tasks=$this->Utilidades->get_tasks("1");
		$this->Utilidades->ready=$this->Utilidades->get_tasks("3");
		$this->Utilidades->preready=$this->Utilidades->get_tasks("2");
		$this->Utilidades->get_tasksMe();
		$this->Utilidades->get_Notificaciones($this->user->user_id);
		$this->listar->view="Utilidades/List_Usuarios";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		listados($this->listar->view); 	
	}
	
	public function Edit(){
		if(post()){
			$set_user		=	$this->Utilidades->set_user(post());
			if($set_user){	
				echo '<script>parent.location.reload();</script>';
			}else{
				echo '<script>alert("Error");</script>';
			}
		}
		$this->Utilidades->get_user($this->uri->segment(3));
		$this->listar->view="Utilidades/Form_Usuarios";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		FormAjax($this->listar->view); 		
	}
	
	public function AddTask(){
		if(post()){
			$set_user		=	$this->Utilidades->save(post());
			if($set_user){	
				echo '<script>parent.location.reload();</script>';
			}else{
				echo '<script>alert("Error");</script>';
			}
			return;
		}
		$this->Utilidades->get_all_users();
		$this->Utilidades->get_task($this->uri->segment(3));
		$this->listar->view="Utilidades/Form_Task";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		FormAjax($this->listar->view); 		
	}
	
	public function ViewTaskResponse(){
		if(post() && !$this->uri->segment(4)){
			$set_user		=	$this->Utilidades->SaveTaskResponse(post());
			//pre($_REQUEST);return;
			if($set_user){	
				echo '<script>parent.location.reload();</script>';
			}else{
				echo '<script>alert("Error");</script>';
			}
			return;
		}else if($this->uri->segment(4)=='rest'){
			//$uploadas	=	upload('userfile','images/uploads/tasks/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/',$config=array("allowed_types"=>'gif|jpg|png',"max_size"=>3000,"max_width"=>3000,"max_height"=>3000));
			//pre($_REQUEST);
			return;
		}
		$this->listar->view="Utilidades/View_TaskResponse";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		FormAjax($this->listar->view);
	}
	
	public function ViewTask(){
		if(post()){
			$set_user		=	$this->Utilidades->SaveViewTask(post());
			if($set_user){	
				echo '<script>parent.location.reload();</script>';
			}else{
				echo '<script>alert("Error");</script>';
			}
			return;
		}
		if($this->uri->segment(4)=='close'&&$this->uri->segment(3)){
			$set_user		=	$this->Utilidades->SaveCloseTask($this->uri->segment(3));
			if($set_user){	
				echo '<script>parent.location.reload();</script>';
			}else{
				echo '<script>alert("Error");</script>';
			}
			return;
		}
		if(!post()){
			$this->Utilidades->get_task($this->uri->segment(3));
			$this->Utilidades->get_users_assigned($this->uri->segment(3));
			$this->Utilidades->files = directory_map(PATH_BASE.'images/uploads/tasks/'.$this->uri->segment(3)."/", 1, FALSE);
			$this->listar->view="Utilidades/View_Task";
			$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
			FormAjax($this->listar->view);
		}
	}
	
	public function ViewNotification(){
		$this->Utilidades->get_Notificacion($this->uri->segment(3));
		$this->listar->view="Utilidades/View_Notification";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
		FormAjax($this->listar->view);
	}

	public function enviarCorreoAdvertencia(){

		$this->load->model("Utilidades/Utilidades_model");
		$this->Utilidades	= 	new Utilidades_model();
		$this->Utilidades->enviarCorreoAdvertencia();
		return;
	}
}

?>