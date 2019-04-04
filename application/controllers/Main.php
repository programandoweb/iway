<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

  var $util,$user,$Response;

	public function __construct(){
        parent::__construct();
		$this->util 		= 	new Util_model();
		$this->user			=	$this->session->userdata('User');
    }

	public function index(){
		$this->util->set_title(SEO_TITLE);
		$this->load->view('Template/Header');
		if(!empty($this->user)){
			if(MODULO_X_DEFAULT){
				redirect(base_url(MODULO_X_DEFAULT));
			}else{
				$this->load->view('Template/Welcome');
			}
		}else{
			redirect(base_url("Autenticacion"));
		}
		$this->load->view('Template/Footer');
	}

	function import_dump($file_name) {
		$folder_name = '';
		$file_restore = $this->load->file($file_name, true);
		$file_array 	= explode(';', $file_restore);
		foreach ($file_array as $query){
			$this->db->query("SET FOREIGN_KEY_CHECKS = 0");
			if(!empty($query)){
				//echo $query;
				$this->db->query($query);
			}
			$this->db->query("SET FOREIGN_KEY_CHECKS = 1");
		}
	}

	public function Install(){
		ini_set('display_errors', 0);
		if (!$this->db->table_exists("usuarios") ){
			$this->import_dump(PATH_BASE.'iway_db2.sql');
			return;
			$this->db->insert("mae_cliente_joberp",array(	"regimen_empresa"=>"root",
																										"naturaleza"=>"root",
																										"fecha_matricula"=>date("Y-m-d"),
																										"declara_renta"=>"r",
																										"prefijo_documento"=>"r",
																										"tipo_identificacion"=>"r",
																										"numero_identificacion"=>"r",
																										"digitos_verificacion"=>"r",
																										"nombre_legal"=>"r",
																										"nombre_comercial"=>"r",
																										"id_representante_legal"=>"r",
																										"ciudad_expedicion"=>"r",
																										"direccion"=>"r",
																										"ciudad"=>"r",
																										"telefono"=>"r",
																										"celular"=>"r",
																										"email"=>"r",
																										"persona_contacto"=>"r",
																										"cargo"=>"r",
																										"pagina_web"=>"r",
																										"descripcion_cliente"=>"r",
																										"divisa_oficial"=>"r",
																										"documento_moneda_extranjera"=>"r",
																										"logo"=>"r",
																										"logo_json"=>"r",
																										"fecha_registro"=>"r",
																										"responsable_creacion"=>"r",
																										"demo"=>"r",
																										"color_aplicativo"=>"r",
																										"estado"=>"r",
																										"empresa_id1"=>"r",
																										));

			$this->db->insert("usuarios",array(	"empresa_id"=>$this->db->insert_id(),
																					"type_id"=>"Root",
																					"login"=>"root",
																					"email"=>SMTP_USER,
																					"password"=>encriptar("123456"),
																					"intentos_errados"=>0,
																					"estado"=>0,
																					"token"=>md5(date("Y-m-d H:i:s"))));
			redirect(base_url("apanel"));
  	}else{
			redirect(base_url());
		}
	}

	public function modulo_inactivo(){
		$this->util->set_title("Módulo Inactivo - ".SEO_TITLE);
		$this->load->view('Template/Header');
		$this->load->view('Template/Flash');
		$this->load->view('Template/Inactivo');
		$this->load->view('Template/Footer');
		return;
	}

	public function ErrorUrl(){
		$this->util->set_title("Módulo Inactivo - ".SEO_TITLE);
		$this->load->view('Template/Header');
		$this->load->view('Template/Flash');
		$this->load->view('Template/ErrorUrl');
		$this->load->view('Template/Footer');
		return;
	}

	public function Error_NoSucursal(){
		$this->util->set_title("Módulo Inactivo - ".SEO_TITLE);
		$this->load->view('Template/Header');
		$this->load->view('Template/Flash');
		$this->load->view('Template/Error_NoSucursal');
		$this->load->view('Template/Footer');
		return;
	}

	public function error_404(){
		if (!$this->input->is_ajax_request()) {
			$this->util->set_title("Error 404 - ".SEO_TITLE);
			$this->load->view('Template/Header');
			$this->load->view('Template/Error_404');
			$this->load->view('Template/Footer');
		}else{
			$this->Response 		=			array(	"message"	=>	"Lo siento, la página o módulo no existe",
														"code"		=>	"203");
			echo answers_json($this->Response);
		}
	}

}
?>
