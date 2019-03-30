
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Departamentos extends CI_Controller {
	
	var $util,$user,$users,$ModuloActivo,$path,$listar,$Departamentos,$Breadcrumb,$Uri_Last,$Listado;
	
	public function __construct(){    	
        parent::__construct();
		if(!defined('APANEL_DEPARTAMENTOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(!APANEL_DEPARTAMENTOS){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}

		$this->util 		= 	new Util_model();
		$this->Breadcrumb 	=	$this->uri->segment_array();
		$this->Uri_Last		=	$this->uri->segment($this->uri->total_rsegments());
		$this->user			=	$this->session->userdata('User');
		$this->ModuloActivo	=	'Departamentos';
		$this->Path			=	PATH_VIEW.'/Template/'.$this->ModuloActivo;
		$this->listar		=	new stdClass();	
		
		if(!isset($_SERVER['HTTP_REFERER'])){
			redirect(base_url("Main/ErrorUrl"));
			return;
		}

		if(empty($this->user)){
			redirect(base_url("Main"));	return;
		}		

		if(defined('APANEL_DEPARTAMENTOS')){
			$this->load->model("Departamentos/Departamentos_model");
			$this->Departamentos	= 	new Departamentos_model();
		}
		chequea_session($this->user);
    }
	
	public function Index(){
		if(!defined('APANEL_DEPARTAMENTOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		redirect(base_url($this->uri->segment(1)."/Listado"));	return;
	}
	
	public function Listado(){
		if(!defined('APANEL_DEPARTAMENTOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		
		if(!is_numeric($this->uri->segment($this->uri->total_segments())) && $this->uri->segment(3)!=''){
			$this->Departamentos->like			=		array("abreviacion",$this->uri->segment($this->uri->total_segments()));
		}
		
		$this->Departamentos->pagination		=		$this->uri->segment($this->uri->total_segments());
		$this->Departamentos->search			=		post("search");
		$this->Departamentos->get_all();		
		
		/*DEVOLVEMOS RESULTADOS DEPENDIENDO DEL TIPO DE LLAMADO*/
		if ($this->input->is_ajax_request()) {
			$this->Response 	=			array("result"=>$this->Departamentos->result,"code"=>"200");	
			echo answers_json($this->Response);	
		}else{
			$this->listar->view="Departamentos/List_Departamentos";
			$this->util->set_title("Centro de costos - ".SEO_TITLE);
			paginator($this->Departamentos->total_rows);
			$this->Listado		=	$this->load->view('Template/Listado',array(),TRUE);	
			listados($this->listar->view); 	
		}
	}
	
	public function Add(){
		if(!defined('APANEL_DEPARTAMENTOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(post()){
			$set	=	$this->Departamentos->set(post());			
			if ($this->input->is_ajax_request()) {
				if($set){
					$this->Response 		=			array(	"message"	=>	"Los datos han sido guardados correctamente",
																				"code"		=>	"200");
				}else{
					$this->Response 		=			array(	"message"	=>	"Lo siento, presentamos un problema y no pudimos guardar los datos",
																"code"		=>	"203");
				}
				echo answers_json($this->Response);
			}else{
				$this->session->set_flashdata('danger', 'Lo siento, presentamos un problema y no pudimos guardar los datos');
				redirect(current_url());
			}
			return;	
		}
		$possible_id		=	$this->uri->segment($this->uri->total_segments());
		$this->Departamentos->get($possible_id);	
		$this->listar->view	="Departamentos/Form_Departamentos";
		$this->util->set_title("Centro de costos - ".SEO_TITLE);	
		$this->users		=	$this->Departamentos->get_users(array('empresa'));	
		$this->Listado		=	$this->load->view('Template/Form',array(),TRUE);
		Form($this->listar->view);	
	}
	
	public function Usuario(){
		if(!defined('APANEL_DEPARTAMENTOS')){
			redirect(base_url("Main/modulo_inactivo"));	return;
		}
		if(post()){
			$set	=	$this->Departamentos->set_dep_users(post());			
			if ($this->input->is_ajax_request()) {
				if($set){
					$this->Response 		=			array(	"message"	=>	"Los datos han sido guardados correctamente",
																				"code"		=>	"200");
				}else{
					$this->Response 		=			array(	"message"	=>	"Lo siento, presentamos un problema y no pudimos guardar los datos",
																"code"		=>	"203");
				}
				echo answers_json($this->Response);
			}else{
				$this->session->set_flashdata('danger', 'Lo siento, presentamos un problema y no pudimos guardar los datos');
				redirect(current_url());
			}
			return;	
		}
		$possible_id		=	$this->uri->segment($this->uri->total_segments());
		$this->dep_users	=	$this->Departamentos->get_dep_users($possible_id);	
		$this->users		=	$this->Departamentos->get_users();	
		$this->listar->view	="Departamentos/Form_Usuarios";
		$this->util->set_title("Centro de costos - ".SEO_TITLE);	
		$this->Listado	=	$this->load->view('Template/Form',array(),TRUE);
		Form($this->listar->view);	
	}
	
	public function Listado_Del(){
		if($id 	= 	$this->uri->segment(3)){
			$delete = $this->db->delete(DB_PREFIJO.'ma_departamentos', array('id_esquema'	=>	$id));
			if($delete){
				$this->session->set_flashdata('success', 'El registro se borró correctamente');			
			}else{
				$this->session->set_flashdata('danger', 'No se pudo borrar el registro');	
			}
		}
		redirect(base_url('Departamentos/Listado'));		
	}
	
}

?>