<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Administrativo extends CI_Controller {

	var $util,$user,$ModuloActivo,$path,$listar,$Administrativo,$Breadcrumb,$Uri_Last;
    public function __construct(){    	
        parent::__construct();
        $this->util 		= 	new Util_model();
		$this->Breadcrumb 	=	$this->uri->segment_array();
		$this->Uri_Last		=	$this->uri->segment($this->uri->total_rsegments());
		$this->user			=	$this->session->userdata('User');
		$this->ModuloActivo	=	'Administrativo';
		$this->Path			=	PATH_VIEW.'/Template/'.$this->ModuloActivo;
		$this->listar		=	new stdClass();	
		if(empty($this->user)){
			redirect(base_url("Main"));	return;
		}
		chequea_session($this->user);		
    
    $this->load->model("Administrativo/Administrativo_model");
    $this->Administrativo	= 	new Administrativo_model();
  
  } 


  public function RecordatorioPagos(){
    if(!isset($_SERVER['HTTP_REFERER'])){
        redirect(base_url("Main/ErrorUrl"));
        return;
          }
    $this->listar->view="Administrativo/List_RecordatorioPago";
    $this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
    Listados($this->listar->view);	
  }

  public function GestionCobro(){
    if(!isset($_SERVER['HTTP_REFERER'])){
        redirect(base_url("Main/ErrorUrl"));
        return;
          }
          
        $this->listar->view="Administrativo/List_GestionCobro";
        $this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
        Listados($this->listar->view);	
  }

  public function AnalisisCredito(){
    if(!isset($_SERVER['HTTP_REFERER'])){
        redirect(base_url("Main/ErrorUrl"));
        return;
     }
          
        $this->listar->view="Administrativo/List_AnalisisCredito";
        $this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
        Listados($this->listar->view);	
  }

  public function Plantillas(){
    if(!isset($_SERVER['HTTP_REFERER'])){
        redirect(base_url("Main/ErrorUrl"));
        return;
     }
        $this->listar->view="Administrativo/List_Plantillas";
        $this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
        Listados($this->listar->view);  
  }

  public function CastigoFactura(){
    if(!isset($_SERVER['HTTP_REFERER'])){
        redirect(base_url("Main/ErrorUrl"));
        return;
     }
        $this->listar->view="Administrativo/List_CastigoFacturas";
        $this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
        Listados($this->listar->view);  
  }

  public function Items(){
    if(!isset($_SERVER['HTTP_REFERER'])){
        redirect(base_url("Main/ErrorUrl"));
        return;
     }
        $this->listar->view="Administrativo/List_Items";
        $this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
        Listados($this->listar->view);  
  }

  public function Calendario(){
    if(!isset($_SERVER['HTTP_REFERER'])){
        redirect(base_url("Main/ErrorUrl"));
        return;
     }
     $this->Administrativo->GetCalendar();
    
     $this->listar->view="Administrativo/View_Calendario";
     $this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
     Listados($this->listar->view);
    //$this->load->view('Template/Administrativo/Api_Calendar');  
  }

   public function Add(){
    if(post()){
     //return;
      //pre(post()); return;
      $this->session->set_flashdata('success', 'El registro se guardó correctamente');
        echo '<script>parent.location.reload();</script>';return;
      $set=$this->Administrativo->Set(post());
      //pre($set); return;
      if($set){
        $this->session->set_flashdata('success', 'El registro se guardó correctamente');
        echo '<script>parent.location.reload();</script>';return;
      }else{
        $this->session->set_flashdata('danger', 'Lo siento, presentamos un problema y no pudimos guardar los datos');
        redirect(current_url());
      }
       return;
      
    } 
    
    if($this->uri->segment(3)=="modificar"){
      //$this->Administrativo->GetCalendar();
    };
   	$this->listar->view	="Administrativo/Form_calendar";
		$this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
    FormAjax($this->listar->view);
    if($this->uri->segment(3)!="modificar"){
    $this->load->view('Template/Administrativo/Api_Calendar');
    } 
  }

  public function Estado(){
    $var['estado'] = 0;
    $this->db->where("id",$this->uri->segment(3));
    $this->db->update("mae_calendario",array("estado"=>$var['estado']));
   //$this->db->reset_query();
   $this->session->set_flashdata('success', 'Evento Desactivado');
    echo '<script>parent.location.reload();</script>';return;
  }

  public function Actas(){
    if(!isset($_SERVER['HTTP_REFERER'])){
      redirect(base_url("Main/ErrorUrl"));
      return;
   }
      $this->listar->view="Administrativo/List_Actas";
      $this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
      Listados($this->listar->view);  
  }

 public function Compromisos(){
  if(!isset($_SERVER['HTTP_REFERER'])){
  redirect(base_url("Main/ErrorUrl"));
  return;
}
  $this->listar->view="Administrativo/List_Compromisos";
  $this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
  Listados($this->listar->view); 
 }

 public function HistoriaLLamadas(){
  if(!isset($_SERVER['HTTP_REFERER'])){
    redirect(base_url("Main/ErrorUrl"));
    return;
  }
    $this->listar->view="Administrativo/List_Historial";
    $this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
    Listados($this->listar->view); 
 }

 public function Correspondencia(){
  if(!isset($_SERVER['HTTP_REFERER'])){
    redirect(base_url("Main/ErrorUrl"));
    return;
  }
    $this->listar->view="Administrativo/List_Correspondencia";
    $this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
    Listados($this->listar->view); 
 }

 public function Lineas(){
  if(!isset($_SERVER['HTTP_REFERER'])){
    redirect(base_url("Main/ErrorUrl"));
    return;
  }
    $this->listar->view="Administrativo/List_Lineas";
    $this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
    Listados($this->listar->view); 
 }

 public function InventarioFisico(){
  if(!isset($_SERVER['HTTP_REFERER'])){
    redirect(base_url("Main/ErrorUrl"));
    return;
  }
    $this->listar->view="Administrativo/List_Inventario";
    $this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
    Listados($this->listar->view); 
 }

 public function add_producto(){
  if(!isset($_SERVER['HTTP_REFERER'])){
    redirect(base_url("Main/ErrorUrl"));
    return;
  }
  if(post()){
    $set=$this->Administrativo->Set_inventario(post());
    if($set){
      $this->session->set_flashdata('success', 'El registro se guardó correctamente');
      echo '<script>parent.location.reload();</script>';return;
    }else{
      $this->session->set_flashdata('danger', 'Lo siento, presentamos un problema y no pudimos guardar los datos');
      redirect(current_url());
    }
    return;
  }
  $this->listar->view	="Administrativo/Form_Inventario";
  $this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);	
  FormAjax($this->listar->view);

 }



 public function Bodegas(){
  if(!isset($_SERVER['HTTP_REFERER'])){
    redirect(base_url("Main/ErrorUrl"));
    return;
  }
    $this->listar->view="Administrativo/List_Bodegas";
    $this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
    Listados($this->listar->view); 

 }

 public function Traslado(){
  if(!isset($_SERVER['HTTP_REFERER'])){
    redirect(base_url("Main/ErrorUrl"));
    return;
  }
    $this->listar->view="Administrativo/List_Traslado";
    $this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
    Listados($this->listar->view); 
 }

 public function OtrasEntradas(){
  if(!isset($_SERVER['HTTP_REFERER'])){
    redirect(base_url("Main/ErrorUrl"));
    return;
  }
    $this->listar->view="Administrativo/List_OtrasEntradas";
    $this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
    Listados($this->listar->view);
 }

 public function OtrasSalidas(){
  if(!isset($_SERVER['HTTP_REFERER'])){
    redirect(base_url("Main/ErrorUrl"));
    return;
  }
    $this->listar->view="Administrativo/List_OtrasSalidas";
    $this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
    Listados($this->listar->view);
 }

 public function AjusteCosto(){
  if(!isset($_SERVER['HTTP_REFERER'])){
    redirect(base_url("Main/ErrorUrl"));
    return;
  }
    $this->listar->view="Administrativo/List_AjusteCosto";
    $this->util->set_title($this->ModuloActivo	." - ".SEO_TITLE);
    Listados($this->listar->view);
 }




}

   