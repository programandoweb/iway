<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Util_model extends CI_Model {
	
	var $dominio,$current_url,$title,$description,$keywords,$author,$extra;
	
	public function __construct(){
		$this->dominio			=	DOMINIO;
		$this->title			=	SEO_TITLE;
		$this->description		=	SEO_DESCRIPTION;
		$this->keywords			=	SEO_KEYWORDS;
		$this->author			=	SEO_GENERATOR;
		$this->current_url		=	current_url();
		$this->extra			=	'';
	}
	
	public function get_header(){
		$return		=	'';
		$return		.=	'<base href="'.$this->dominio.'" />';
		$return		.=	'<link rel="canonical" href="'.$this->current_url.'" />';
		$return		.=	'<meta charset="utf-8">';
		$return		.=	'<link rel="shortcut icon" href="'.$this->dominio.'/images/favicon.png" type="image/x-icon">';
		$return		.=	'<link rel="icon" href="'.$this->dominio.'/images/favicon.png" type="image/x-icon">';
		$return		.=	'<link rel="alternate" hreflang="es" href="'.$this->dominio.'" />';
        $return		.=	'<link rel="author" href="https://plus.google.com/u/0/+LcdoJorgeM%C3%A9ndez/about" />';
		$return		.=	'<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
		$return		.=	'<title>'.$this->title.'</title>';
		$return		.=	'<meta name="description" content="'.$this->description.'">';
		$return		.=	'<meta name="keywords" content="'.$this->keywords.'">';
		$return		.=	'<meta name="author" content="'.$this->author.'">';
		$return		.=	'<meta name="googlebot" content="index, follow" />';
		$return		.=	'<meta name="robots" content="index, follow" />';
		$return		.=	'<meta name="distribution" content="global" />';
		$return		.=	'<meta name="audience" content="all" />';
		$return		.=	'<meta property="og:url" content="'.$this->current_url.'"/>';
		$return		.=	'<meta property="og:image" content=""/>';
		$return		.=	'<meta property="og:site_name" content="'.$this->author.'"/>';
		$return		.=	'<meta property="og:title" content="'.$this->title.'"/>';
		$return		.=	'<meta property="og:description" content="'.$this->description.'"/>';
		$return		.=	'<!--CSS-->';
		$return		.=	'<link href="assets/css/tether.min.css" rel="stylesheet">';		
		$return		.=	'<link href="assets/css/bootstrap.min.css" rel="stylesheet">';
		$return		.=	'<link href="assets/css/animate.css" rel="stylesheet">';		
		$return		.=	'<link href="assets/css/font-awesome.min.css" rel="stylesheet">';
		$return		.=	'<link href="assets/css/jquery-ui.css" rel="stylesheet">';
		$return		.=	'<link href="assets/css/yamm.css" rel="stylesheet">';
		$return		.=	'<link href="design/css/pgrw.css" rel="stylesheet">';
		$return		.=	'<link href="assets/css/croppic.css" rel="stylesheet">';
		$return		.=	'<!--JS-->';
		$return		.=	'<script src="assets/js/accounting.min.js"></script>';
		$return		.=	'<script src="assets/js/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>';
		$return		.=	'<script src="assets/js/jquery-3.2.1.min.js"></script>';
		$return		.=	'<script src="assets/js/jquery-ui.js"></script>';
		$return		.=	'<script src="assets/js/maskedinput.min.js"></script>';
		$return		.=	'<script src="assets/js/tether.min.js"></script>';		
		$return		.=	'<script src="assets/js/bootstrap.min.js"></script>';
		$return		.=	'<script src="design/js/pgrw.js"></script>';
		$return		.=	'<script src="design/js/pgrw.forms.js"></script>';
		$return		.=	'<script src="design/js/pgrw.Windows.js"></script>';
		$return		.=	'<script src="design/js/pgrw.forms.empresas.js"></script>';
		$return		.=	'<script src="assets/js/Chart.js"></script>';
		return $return;
	}
	
	public function get_title(){
		return $this->title;	
	}
	
	public function set_title($title){
		return $this->title 	=	$title;	
	}
	
	public function get_description(){
		return $this->description;	
	}
	
	public function set_description($description){
		return $this->description 	=	$description;	
	}
	
	public function get_keywords(){
		return $this->keywords;	
	}
	
	public function set_keywords($keywords){
		return $this->keywords 	=	$keywords;	
	}
	
	public function get_author(){
		return $this->author;	
	}
	
	public function set_author($author){
		return $this->author 	=	$author;	
	}
	
	public function get_extra(){
		return $this->extra;	
	}
	
	public function set_extra($extra){
		return $this->extra 	=	$extra;	
	}
	
	
}
?>