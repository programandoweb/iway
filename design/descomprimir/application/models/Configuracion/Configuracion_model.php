<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
defined('BASEPATH') OR exit('No direct script access allowed');
class Configuracion_model extends CI_Model {
	
	var $fields,$result,$where,$total_rows,$pagination,$search;

	public function get($id_escala){
		$tabla				=		DB_PREFIJO."ve_escala_pagos";
		$this->db->select("*");
		$this->db->from($tabla);
		$this->db->where("id_escala",$id_escala);
		$query			=	$this->db->get();
		$this->result 	=	$query->row();
	}
	
	public function SetSwitchPerfiles(){
		$tabla	=	DB_PREFIJO."usuarios";
		$data	=	$this->user;
		if($this->user->mostrar_inactivos==0){
			$data->mostrar_inactivos=$estatus=1;
		}else{
			$data->mostrar_inactivos=$estatus=0;
		}
		$this->db->where("id_empresa", $this->user->id_empresa);
		if($this->db->update($tabla,array('mostrar_inactivos' =>$estatus))){
			$this->session->set_flashdata('success', 'La información se guardo correctamente.');
			$this->session->set_userdata(array('User'=>$data));
			logs($this->user,2,$tabla,$this->user->id_empresa,"Configuracion","1");
			$return =	true;	
		}else{
			logs($this->user,2,$tabla,$this->user->id_empresa,"Configuracion","0");
			$return =	false;	
		}	
		return $return;
	}
	
	public function get_all_empresas(){
		$tabla				=		DB_PREFIJO."usuarios t1";
  
  		$html_group_open	=		'<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">';
		$html_group_close	=		'</div>';
		$edit_open			=		$html_group_open.'<a class="btn btn-secondary lightbox" title="Cargar Archivo" data-type="iframe" href="'.base_url($this->uri->segment(1).'/Add_'.$this->uri->segment(2,'Logo').'/');
		$edit_close			=		'"><i class="fa fa-upload" aria-hidden="true"></i></a>';
		if($this->uri->segment(2)=='Logo'){
			$this->fields		=		array("CONCAT('<b>',nombre_legal,'</b> <br> ', nombre_comercial) as nombre_legal"=>"Nombre Legal / Comercial",'CONCAT("<img src=\"'.DOMINIO.'images/uploads/",(CASE WHEN logo="" THEN "Logo-Webcamplus-default.png" ELSE logo END),"\" style=\"width:80px;\" class=\"rounded float-left\">") AS imagen'=>"Logotipo","CASE WHEN estado=1 THEN 'Activo' ELSE 'Inactivo' END as estado"=>"Estado"," CONCAT('".$edit_open."',user_id,'".$edit_close."') AS edit"=>"Acción","user_id"=>"user_id");
		}else{
			$this->fields		=		array("CONCAT('<b>',nombre_legal,'</b> <br> ', nombre_comercial) as nombre_legal"=>"Nombre Legal / Comercial",'CONCAT("<img src=\"'.DOMINIO.'images/uploads/",(CASE WHEN firma="" THEN "Logo-Webcamplus-default.png" ELSE firma END),"\" style=\"width:80px;\" class=\"rounded float-left\">") AS imagen'=>"Logotipo","CASE WHEN estado=1 THEN 'Activo' ELSE 'Inactivo' END as estado"=>"Estado"," CONCAT('".$edit_open."',user_id,'".$edit_close."') AS edit"=>"Acción","user_id"=>"user_id");			
		}
		$this->db->select(array_keys($this->fields));
		$this->db->from($tabla);
		$this->db->where("type","empresa");
		$this->db->where('t1.user_id', $this->user->id_empresa);
		if($this->search){
			$this->db->like('nombre_legal', $this->search);			
			$this->db->or_like('nombre_comercial', $this->search);
			$this->db->or_like('estado', $this->search);			
		}
		$this->db->order_by('nombre_legal','ASC');
		$this->db->limit(ELEMENTOS_X_PAGINA,$this->Configuracion->pagination);		
		$query			=	$this->db->get();
		$this->result 	=	$query->result();
		$this->total_rows= $this->total_filas($tabla);

	}
	
	public function setCropperSave($var){
		$imgUrl 		= 	$var['imgUrl'];
		$imgInitW 		= 	$var['imgInitW'];
		$imgInitH 		= 	$var['imgInitH'];
		$imgW 			= 	$var['imgW'];
		$imgH 			= 	$var['imgH'];
		$imgY1 			= 	$var['imgY1'];
		$imgX1 			= 	$var['imgX1'];
		$cropW 			= 	$var['cropW'];
		$cropH 			= 	$var['cropH'];
		$angle 			= 	$var['rotation'];
		$jpeg_quality 	= 	100;
		if(!$this->uri->segment(3)){
			$imagen_por_html=	'images/uploads/perfiles/'.$this->user->user_id;
			$directorio		=	PATH_BASE.'images/uploads/perfiles/'.$this->user->user_id;	
		}else{
			$imagen_por_html=	'images/uploads/perfiles/'.$this->uri->segment(3);
			$directorio		=	PATH_BASE.'images/uploads/perfiles/'.$this->uri->segment(3);	
		}	
		
		if(!is_dir( $directorio )){
			if(!mkdir($directorio, 0755,true)){
				echo 'NO SE PUDO CREAR EL DIRECTORIO, SUGERIMOS LO HAGAS POR FTP';
				return; 
			}else{
				$fp		=	fopen($directorio.'/index.html',"w");
				fwrite($fp,'<a href="http://programandoweb.net">PROGRAMANDOWEB</a>');
				fclose($fp);
			}
		}
		
		$output_filename=$directorio;
		
		$what=getimagesize($imgUrl);

		switch(strtolower($what['mime'])){
			case 'image/png':
				$img_r=imagecreatefrompng($imgUrl);
				$source_image=imagecreatefrompng($imgUrl);
				$type='.png';
				break;
			case 'image/jpeg':
				$img_r=imagecreatefromjpeg($imgUrl);
				$source_image=imagecreatefromjpeg($imgUrl);
				error_log("jpg");
				$type='.jpg';
				break;
			case 'image/gif':
				$img_r=imagecreatefromgif($imgUrl);
				$source_image=imagecreatefromgif($imgUrl);
				$type='.gif';
				break;
			default: die('image type not supported');
		}
		
		
		if(!is_writable(dirname($output_filename))){
			$response['error']	=		'Can`t write cropped File';
		}else{
			$resizedImage = imagecreatetruecolor($imgW, $imgH);
			imagecopyresampled($resizedImage, $source_image, 0, 0, 0, 0, $imgW, $imgH, $imgInitW, $imgInitH);
			$rotated_image = imagerotate($resizedImage, -$angle, 0);
			$rotated_width = imagesx($rotated_image);
			$rotated_height = imagesy($rotated_image);
			$dx = $rotated_width - $imgW;
			$dy = $rotated_height - $imgH;
			$cropped_rotated_image = imagecreatetruecolor($imgW, $imgH);
			imagecolortransparent($cropped_rotated_image, imagecolorallocate($cropped_rotated_image, 0, 0, 0));
			imagecopyresampled($cropped_rotated_image, $rotated_image, 0, 0, $dx / 2, $dy / 2, $imgW, $imgH, $imgW, $imgH);
			$final_image = imagecreatetruecolor($cropW, $cropH);
			imagecolortransparent($final_image, imagecolorallocate($final_image, 0, 0, 0));
			imagecopyresampled($final_image, $cropped_rotated_image, 0, 0, $imgX1, $imgY1, $cropW, $cropH, $cropW, $cropH);
			if($this->uri->segment(4)){
				$profile	=	$this->uri->segment(4);
			}else{
				$profile	=	'profile';
			}
			if($type=='.gif'){
				imagegif($final_image, $output_filename.'/'.str_replace(array(".png",".jpg",".jpeg",".png"),"",$profile).$type, $jpeg_quality);
			} 
			if($type=='.jpg'){
				imagejpeg($final_image, $output_filename.'/'.str_replace(array(".png",".jpg",".jpeg",".png"),"",$profile).$type, $jpeg_quality);
			} 
			if($type=='.png'){
				imagepng($final_image, $output_filename.'/'.str_replace(array(".png",".jpg",".jpeg",".png"),"",$profile).$type, $jpeg_quality);
			} 
			$response	= 	array(
				"status" => 'success',
				"url" => DOMINIO.$imagen_por_html.'/'.$profile.'.jpg'
			);
			$data=$this->user;
			$data->logo=DOMINIO.$imagen_por_html.'/'.$profile.'.jpg';
		}
		return $response;
	}
	
	public function setCropper($var){
		$upload		=	upload('img',$path='images/uploads/',$config=array("allowed_types"=>'gif|jpg|jpeg|png',"max_size"=>1000,"max_width"=>2000,"max_height"=>2000));
		$tabla		=	DB_PREFIJO."usuarios";
		if(!isset($var['user_id'])){
			$var['user_id']	=	$this->user->user_id;	
		}
		$id			=	array("user_id",$var['user_id']);
		$this->db->where($id[0], $id[1]);
		if(!isset($upload['error'])){
			if($this->db->update($tabla,array("logo"=>$upload['upload_data']['file_name'],"logo_json"=>json_encode($upload)))){
				$data=$this->user;
				$data->logo_json=json_encode($upload);
				$data->logo=$upload['upload_data']['file_name'];
				$this->session->set_userdata(array('User'=>$data));	
				logs($this->user,2,$tabla,$id[1],"Configuracion","1",$upload);
				return	$upload;	
			}else{
				logs($this->user,2,$tabla,$id[1],"Configuracion","0",$upload);
				return	$upload;	
			}
		}else{
			logs($this->user,2,$tabla,$id[1],"Configuracion","0",$upload);
			return	$upload;				
		}
	}
	
	public function setLogo($var){
		$upload		=	upload('userfile',$path='images/uploads/');
		$tabla		=	DB_PREFIJO."usuarios";
		$campo		=	$var['campo'];
		pre($upload);
		if(isset($var['redirect'])){
			unset($var['redirect'],$var['campo']);	
		}
		if(!isset($upload['error'])){
			if(isset($var['user_id'])&& !empty($var['user_id'])){
				$id			=		array("user_id",$var['user_id']);
				
				$this->db->where($id[0], $id[1]);
				if($this->db->update($tabla,array($campo=>$upload['upload_data']['file_name'],"logo_json"=>json_encode($upload)))){
					logs($this->user,2,$tabla,$id[1],"Configuracion","1",$upload);
					$return =	true;	
				}else{
					logs($this->user,2,$tabla,$id[1],"Configuracion","0",$upload);
					$return =	false;	
				}
			}
		}else{
			$return	=	$upload;
		}
		return $return;
	}
	
	public function ModificarImagen($var){
			$tabla		=	DB_PREFIJO."usuarios";
			define('UPLOAD_DIR', PATH_BASE.'images/uploads/');
			$img 		= 	$var['image'];
			preg_match("/^data:image\/(.*);base64/i",$img, $match);
			$extension 	= 	$match[1];
			//pre($extension);
			$img 		= 	str_replace('data:image/png;base64,', '', $img);
			$img 		= 	str_replace(' ', '+', $img);
			$data 		= 	base64_decode($img);
			$file 		= 	uniqid() . '.'.$extension;
			$success 	= 	file_put_contents(UPLOAD_DIR .$file, $data);
			if($success){
				$this->db->where("user_id", $this->user->user_id);
				if($this->db->update($tabla,array("logo"=>$file,"logo_json"=>json_encode(array("upload_data"=>$file))))){
					$data					=	$this->user;					
					$data->logo				=	$file;
					$data->logo_json		=	json_encode(array("upload_data"=>$file));
					$this->session->set_userdata(array('User'=>$data));		
					logs($this->user,2,$tabla,$this->user->user_id,"Configuracion IMG Perfil","1",array("upload_data"=>$file));	
				}
			}
			return ($success)?true:false;	
	}

	public function ModificarLogo($var){
			$tabla		=	DB_PREFIJO."usuarios";
			define('UPLOAD_DIR', PATH_BASE.'images/uploads/');
			$img 		= 	$var['image'];
			preg_match("/^data:image\/(.*);base64/i",$img, $match);
			$extension 	= 	$match[1];
			//pre($extension);
			$img 		= 	str_replace('data:image/png;base64,', '', $img);
			$img 		= 	str_replace(' ', '+', $img);
			$data 		= 	base64_decode($img);
			$file 		= 	uniqid() . '.'.$extension;
			$success 	= 	file_put_contents(UPLOAD_DIR .$file, $data);
			if($success){
				$this->db->where("user_id", $this->user->user_id);
				if($this->db->update($tabla,array("logo"=>$file,"logo_json"=>json_encode(array("upload_data"=>$file))))){
					$data					=	$this->user;					
					$data->logo				=	$file;
					$data->logo_json		=	json_encode(array("upload_data"=>$file));
					$this->session->set_userdata(array('User'=>$data));		
					logs($this->user,2,$tabla,$this->user->user_id,"Configuracion IMG Perfil","1",array("upload_data"=>$file));	
				}
			}
			return ($success)?true:false;	
	}
	
	public function UploadModificarImagen($var){
		$upload		=	upload('userfile',$path='images/uploads/',array("allowed_types"=>'gif|jpg|png',"max_size"=>3000,"max_width"=>2048,"max_height"=>2048));
		$tabla		=	DB_PREFIJO."usuarios";
		$campo		=	$var['campo'];
		$return 	=	0;
		if(isset($var['redirect'])){
			unset($var['redirect'],$var['campo']);	
		}
		if(!isset($upload['error'])){
			if(isset($var['user_id'])&& !empty($var['user_id'])){
				$id			=		array("user_id",$var['user_id']);
				$this->db->where($id[0], $id[1]);
				if($this->db->update($tabla,array($campo=>$upload['upload_data']['file_name'],"logo_json"=>json_encode($upload)))){
					logs($this->user,2,$tabla,$id[1],"Configuracion IMG Perfil","1",$upload);
					$return =	true;	
				}else{
					logs($this->user,2,$tabla,$id[1],"Configuracion IMG Perfil","0",$upload);
					$return =	false;	
				}
			}
		}else{
			$return	=	$upload;
		}
		return $return;
	}
	
	public function setCiclosPagos($var){
		$tabla		=		DB_PREFIJO."cf_ciclos_pagos";
		if(isset($var['redirect'])){
			unset($var['redirect']);	
		}
		if(isset($var['ciclos_id'])&& !empty($var['ciclos_id'])){
			$id			=		array("ciclos_id",$var['ciclos_id']);
			$this->db->where($id[0], $id[1]);
			$var["id_empresa"]		=	$this->user->id_empresa;
			if($this->db->update($tabla,$var)){
				logs($this->user,2,$tabla,$id[1],"setCiclosPagos","1",$var);
				return $var['ciclos_id'];	
			}else{
				logs($this->user,2,$tabla,$id[1],"setCiclosPagos","0",$var);
				return false;	
			}
		}else{
			unset($var['ciclos_id']);
			$fecha_desde	=	post("fecha_desde");
			$fecha_hasta	=	post("fecha_hasta");
			foreach(post('nombre') as $k => $v){
				$this->db->insert($tabla,array(	
												"id_empresa"=>$this->user->id_empresa,
												"centro_de_costos"=>$this->user->centro_de_costos,
												"mes"=>post("mes"),
												"nombre"=>$v,
												"fecha_desde"=>$fecha_desde[$k],
												"fecha_hasta"=>$fecha_hasta[$k],
												"estado"=>0
											));
			}
			return true;	
		}
	}
	
	public function total_filas($tabla){
		if($this->search){
			$this->db->from($tabla);
			$this->db->like('nombre', $this->search);			
			$this->db->or_like('descripcion', $this->search);
			$this->db->or_like('estado', $this->search);
			return $this->db->get()->num_rows();			 
		}
		return $this->db->get($tabla)->num_rows();
	}
	
	public function get_CiclosPagos(){
		$tabla				=		DB_PREFIJO."cf_ciclos_pagos t1";
  
  		$html_group_open	=		'<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">';
		$html_group_close	=		'</div>';
		$edit_open			=		$html_group_open.'<a class="btn btn-secondary lightbox" title="Editar Ciclo de Producción" href="'.base_url($this->uri->segment(1).'/CiclosPagos/');
		$edit_close			=		'"><i class="fa fa-upload" aria-hidden="true"></i></a>';
		$this->fields		=		array("CONCAT('<b>',nombre,'</b>') as nombre"=>"Período","CONCAT(fecha_desde,' <BR> ',fecha_hasta)"=>"Fecha Desde / Hasta","CASE WHEN estado=1 THEN 'Cerrrado' ELSE 'Abierto' END as estado"=>"Estado"," CONCAT('".$edit_open."',ciclos_id,'".$edit_close."') AS edit"=>"Acción","ciclos_id"=>"id","mes"=>"mes","centro_de_costos"=>"centro_de_costos");
		$this->db->select(array_keys($this->fields));
		$this->db->from($tabla);
		$this->db->where("id_empresa",$this->user->id_empresa);
		//$this->db->where("centro_de_costos",$this->user->user_id);
		//$this->db->or_where("centro_de_costos",$this->user->centro_de_costos);
		$this->db->group_by(array("centro_de_costos", "mes"));
		$this->db->order_by('fecha_desde','ASC');
		$this->db->limit(ELEMENTOS_X_PAGINA,$this->Configuracion->pagination);		
		$query			=	$this->db->get();
		$this->result 	=	$query->result();
		$this->total_rows= $this->total_filas($tabla);

	}

}
?>