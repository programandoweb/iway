<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
$modulo		=	"Reportes";
$ciclo		=	$this->$modulo->fields;
$activos	=	$this->$modulo->result["activos"];
$pagados	=	$this->$modulo->result["pagados"];
$pendientes	=	$this->$modulo->result["pendientes"];
$aprobados	=	$this->$modulo->result["aprobados"];
//pre($this->$modulo->result);return;
?>
<div class="container" id="main_">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Nomina.",
															"icono"=>'<i class="fas fa-bars"></i>',
															"url"	=>	current_url()),
									"config"	=>	array(	"title"	=>	"Personalización",
															"icono"	=>	'<i class="fas fa-cogs"></i>',
															"size"	=>	'modal-md',
															"height"=>	340,
															"url"	=>	base_url("Configuracion/OpcionesHonorariosModelos"),
															"lightbox"=>true),
																					
							)
						);
			?>
         