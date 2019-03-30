<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Administrativo_model extends CI_Model {

var $fields,$result,$where,$total_rows,$pagination,$search;

public function GetCalendar(){
    $tabla	=	"mae_calendario"; 
    $this->db->select('*')->from($tabla); 
    $this->db->where('estado',1);
    
    if($this->uri->segment(3)=="modificar"){
    $this->db->where('id',$this->uri->segment(4));
    }
    $this->result= json_encode($this->db->get()->result());
    //pre( $this->result);
    
}

public function Set($var){
 $tabla	=	"mae_calendario";
 if(isset($var["id"]) && !empty($var["id"])){
    unset($var['hora']);
    $this->db->where("id", $var["id"]);
    if($this->db->update($tabla, $var)){
        $response = "se ha modificado correctamente";
     
    }else{
        $response = "Ocurrio un error"; 
    } 

 }else{
    unset($var['id']);
    unset($var['hora']);
    
    if($this->db->insert($tabla, $var)){
        $response = "se ha creado un evento";
    }else{
        $response = "No se pudo crear el evento";
    }   
}
 return $response;
}

public function Set_inventario($var){
    $tabla	=	"mae_inventario";
    if(isset($var["id"]) && !empty($var["id"])){
        $this->db->where("id", $var["id"]);
        if($this->db->update($tabla, $var)){
            $response = "se ha modificado correctamente";
         
        }else{
            $response = "Ocurrio un error"; 
        } 
    } else {

        if($this->db->insert($tabla, $var)){
            $response = "El producto se ha guardado correctamente";
        }else{
            $response = "No se pudo guardar el producto consulte con el administrador";
        }   
    
    }
    return $response;

}

public function GetInventario(){
    
}

}   