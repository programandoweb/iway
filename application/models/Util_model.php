<?php

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
        $return		.=	'<link rel="author" href="http://ingeniarproyectos.com" />';
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
		//$return		.=	'<link href="assets/css/font-awesome.min.css" rel="stylesheet">';
		$return		.=	'<link href="assets/fontawesome/css/fontawesome-all.min.css" rel="stylesheet">';
		$return		.=	'<link href="assets/css/jquery-ui.css" rel="stylesheet">';
		$return		.=	'<link href="assets/css/yamm.css" rel="stylesheet">';
		$return		.=	'<link href="assets/css/croppic.css" rel="stylesheet">';
		$return		.=	'<link href="design/css/blue/style.css" rel="stylesheet">';
		$return		.=	'<link href="design/css/dataTables.bootstrap4.min.css" rel="stylesheet">';
		$return		.=	'<link href="design/css/fullcalendar.min.css" rel="stylesheet">';
		//$return		.=	'<link href="design/css/fullcalendar.print.min.css" rel="stylesheet">';


		$return		.=	'<!--JS-->';
		$return		.=	'<script src="assets/js/accounting.min.js"></script>';
		$return		.=	'<script src="assets/js/jquery-3.1.1.slim.min.js"  crossorigin="anonymous"></script>';
		$return		.=	'<script src="assets/js/jquery-3.2.1.min.js"></script>';
		$return		.=	'<script src="assets/js/jquery.number.min.js"></script>';
		$return		.=	'<script src="assets/js/jquery-ui.js"></script>';
		$return		.=	'<script src="assets/js/maskedinput.min.js"></script>';
		$return		.=	'<script src="assets/js/tether.min.js"></script>';
		$return		.=	'<script src="assets/js/bootstrap.min.js"></script>';
		$return		.=	'<script src="design/js/pgrw.js"></script>';
		$return		.=	'<script src="design/js/pgrw.forms.js"></script>';
		//$return		.=	'<script src="design/js/pgrw.Windows.js"></script>';
		$return		.=	'<script src="design/js/pgrw.Tables.js"></script>';
		$return		.=	'<script src="design/js/pgrw.forms.empresas.js"></script>';
		$return		.=	'<script src="design/js/jscolor.min.js"></script>';
		$return		.=	'<script src="assets/js/Chart.js"></script>';
/*		$return		.=	'<script src="design/js/jquery-latest.js"></script>';*/
		/*$return		.=	'<script src="design/js/jquery.tablesorter.min.js"></script>';
		/*$return		.=	'<script src="design/js/pgrw.Clipboard.js"></script>';*/
		$return		.=	'<script src="assets/js/jquery.mask.min.js"></script>';
		$return		.=	'<link rel="stylesheet" type="text/css" href="design/css/jquery.dataTables.css">';
  		$return		.=	'<script type="text/javascript" charset="utf8" src="design/js/jquery.dataTables.js"></script>';
		$return		.=	'<script type="text/javascript" charset="utf8" src="design/js/dataTables.bootstrap4.min.js"></script>';
		$return		.=	'<link href="design/css/pgrw.css" rel="stylesheet">';
		$return		.=	'<script type="text/javascript" charset="utf8" src="design/js/moment.min.js"></script>';
		$return		.=	'<script type="text/javascript" charset="utf8" src="design/js/fullcalendar.min.js"></script>';
		$return		.=	'<script type="text/javascript" charset="utf8" src="design/js/gcal.min.js"></script>';
		$return		.=	'<script type="text/javascript" charset="utf8" src="design/js/locale-all.js"></script>';
		$return		.=	'<script type="text/javascript" charset="utf8" src="design/js/Api-calendar.js"></script>';
		$return		.=	'<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.2/umd/popper.min.js"></script>';
		$return		.=	'<script type="text/javascript" charset="utf8" src="design/js/jquery.mCustomScrollbar.concat.min.js"></script>';



		return $return;
	}

	public function get_header_form(){
		$return		=	'';
		$return		.=	'<base href="'.$this->dominio.'" />';
		$return		.=	'<link rel="canonical" href="'.$this->current_url.'" />';
		$return		.=	'<meta charset="utf-8">';
		$return		.=	'<link rel="shortcut icon" href="'.$this->dominio.'/images/favicon.png" type="image/x-icon">';
		$return		.=	'<link rel="icon" href="'.$this->dominio.'/images/favicon.png" type="image/x-icon">';
		$return		.=	'<link rel="alternate" hreflang="es" href="'.$this->dominio.'" />';
        $return		.=	'<link rel="author" href="http://ingeniarproyectos.com" />';
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
		$return		.=	'<link href="assets/css/bootstrap-material.css" rel="stylesheet">';
		$return		.=	'<link href="assets/css/font-awesome.min.css" rel="stylesheet">';
		$return		.=	'<link href="assets/fontawesome/css/fontawesome-all.min.css" rel="stylesheet">';
		$return		.=	'<link href="assets/css/jquery-ui.css" rel="stylesheet">';
	    $return     .=  '<link href="design/css/smart_wizard_theme_circles.css" rel="stylesheet" type="text/css" />';
		$return		.=	'<link href="design/css/forms.css" rel="stylesheet">';
		$return		.=	'<link href="design/css/jquery.datetimepicker.min.css" rel="stylesheet">';

		$return		.=	'<!--JS-->';
		$return		.=	'<script src="assets/js/accounting.min.js"></script>';
		$return		.=	'<script src="assets/js/jquery-3.1.1.slim.min.js" crossorigin="anonymous"></script>';
		$return		.=	'<script src="assets/js/jquery-3.2.1.min.js"></script>';
		//$return		.=	'<script src="assets/js/jquery.number.min.js"></script>';
		$return		.=	'<script src="assets/js/jquery-ui.js"></script>';
		$return		.=	'<script src="assets/js/maskedinput.min.js"></script>';
		$return		.=	'<script src="assets/js/tether.min.js"></script>';
		$return		.=	'<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.2/umd/popper.min.js"></script>';
		$return		.=	'<script src="assets/js/bootstrap-material.js"></script>';
		$return     .=  '<script type="text/javascript" src="design/js/jquery.smartWizard.min.js"></script>';
		$return		.=	'<script src="design/js/forms.js"></script>';
		$return		.=	'<script src="design/js/pgrw.forms.empresas.js"></script>';
		//$return		.=	'<script src="design/js/pgrw.forms.js"></script>';
/*		$return		.=	'<script src="design/js/jquery-latest.js"></script>';*/
		/*$return		.=	'<script src="design/js/jquery.tablesorter.min.js"></script>';
		/*$return		.=	'<script src="design/js/pgrw.Clipboard.js"></script>';*/
		$return		.=	'<script src="assets/js/jquery.mask.min.js"></script>';
		$return		.=	'<script src="design/js/date-picker-es.js"></script>';
		$return		.=	'<script src="design/js/jquery.datetimepicker.full.min.js"></script>';

		//<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>


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
