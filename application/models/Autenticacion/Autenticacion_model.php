<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Autenticacion_model extends CI_Model {

	var $user;

	public function setrecovertoken(){
		$data	=	user_x_token(post("token"));
		if(!empty($data)){
			$query	=	$this->db->where('user_id', $data->user_id)->update("usuarios", array("token"=>"NULL","password"=>encriptar(post("clave_nueva"))));
			if($query){
				logs($data->user_id,2,"usuarios",$data->user_id,"Autenticacion");
				$this->session->set_flashdata('success', 'La activación ha sido exitosa, ya puede iniciar sesión.');
				return true;
			}else{
				logs($data->user_id,2,"usuarios",$data->user_id,"Autenticacion","0");
				$this->session->set_flashdata('danger', 'No pudo activarse esta cuenta.');
				return false;
			}
			return true;
		}
		pre($data);
	}

  public function login($var){
	//	pre($var); return;
		$user = $this->db->select('*')->from("usuarios")->where('login',$var['username'])->get()->row();

		if(!empty($user)){
			if($user->rol_id != 1){
				$empresa = 	$this->db->select('*')->from("mae_cliente_joberp")->where('empresa_id',$user->empresa_id)->get()->row();
			}
			
			if(isset($empresa)){
				if(md5($var['password']) == $user->password){
					$this->db->where("use_id",$user_id);
					$update['password'] = encriptar($var['password']); 
					$this->db->update("usuarios",$update);					
				}
				$data = array_merge($user,$empresa);
			}else{
				$data = $user;
			}
			//pre(desencriptar($data->password)); return;
			if(desencriptar($data->password)==$var['password']){
        if($data->estatus==0){
          return array("error"=>"Esta cuenta se encuentra inactiva, consulte con el administrador");
        }
        $session  = $this->db->select('*')->from("sys_session")->where('user_id',$data->user_id)->get()->row();
        if(empty($session)){
          unset($data->password);
				//	pre($data->rol_id); return;
					if($data->rol_id == 1){
            $data->menu   = menu();
          }else{
            $data->menu   = menu_usuarios($data->rol_id,$data->empresa_id);
          }
          if($session   = ini_session($data)){
            $this->set_session_login($session);
            return $data;
          }else{
            return false;
          }
        }else{
          $data->session_id   = md5(date("Y-m-d H:i:s"));
          if($this->db->where("user_id",$data->user_id)->update("sys_session",array("fecha"=>date("Y-m-d H:i:s"),"session_id"=>$data->session_id))){
          	$this->set_session_login($data);
            return array("session"=>"Ya existe otra sesión abierta con este usuario y será eliminada");
          }else{
            return array("error"=>"Ha ocurrido un error por favor contacte al administrador de sistemas");
          }
        }
      }else{
        return array("error"=>"La contraseña es incorrecta");
      }
    }else{
      return array("error"=>"Este usuario no esta registrado en la base de datos");
    }
  }

	public function get_user_by_email($var){
		$ci 	=& 	get_instance();
		return $ci->db->select('*')->from("usuarios")->where('username',$var["nombre_usuario"])->get()->row();
	}

	public function set_user_by_token($token){
		$row		=	$this->db->select('*')->from("usuarios")->where('token',$token)->get()->row();
		if(!empty($row)){
			$query	=	$this->db->where('user_id', $row->user_id)->update("usuarios", array("token"=>"NULL"));
			if($query){
				logs($row,2,"usuarios",$row->user_id,"Autenticacion");
				$this->session->set_flashdata('success', 'La activación ha sido exitosa, ya puede iniciar sesión.');
				return true;
			}else{
				logs($row,2,"usuarios",$row->user_id,"Autenticacion","0");
				$this->session->set_flashdata('danger', 'No pudo activarse esta cuenta.');
				return false;
			}
			return true;
		}else{
			$this->session->set_flashdata('danger', 'Token obsoleto o inválido.');
			return false;
		}
	}

	public function set_user($var,$me=FALSE){
		if(isset($var['redirect'])){
			unset($var["redirect"]);
		}
		if(isset($var['id'])){
			$var['password']	=	md5($var['password']);
		}
		if(!isset($var['id'])){
			$var['password']	=	$var['token']	=	md5(date("Y-m-d H:i:s"));
			if(!isset($var['login'])){
				$explode_login	=	explode("@",$var['email']);
				$var['login']	= 	$explode_login[0];
			}
			$var['fecha_registro']	= 	date("Y-m-d");
			$query	=	$this->db->insert(DB_PREFIJO."usuarios", $var);
			logs($this->db->insert_id(),1,"usuarios",$this->db->insert_id(),"Autenticacion","1");
		}else{
			$query	=	$this->db->where('id', $var["id"])->update(DB_PREFIJO."usuarios", $var);
			logs($var["id"],1,"usuarios",$var["id"],"Autenticacion","1");
		}
		if($me){
			$this->set_session_login($var);
		}
		if($query){
			$this->user		=	$var;
			$this->session->set_flashdata('success', 'La información se guardo correctamente.');
			return true;
		}else{
			$this->session->set_flashdata('danger', 'La información no se pudo guardar.');
			return false;
		}
	}

	private function set_session_login($data){
		$this->session->set_userdata(array('User'=>$data));
	}

}
?>
