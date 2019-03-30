<?php
	$modulo		=	$this->ModuloActivo;
	$ciclo		=	$this->$modulo->fields;
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Otros Ingresos.",
															"url"	=>	current_url()),
									"add"		=>	array(	"title"	=>	"Agregar otros Ingresos",
															"url"	=>	base_url($this->uri->segment(1)."/AddOtrosIngresos"),
															"lightbox"=>true),						
							)
						);
			?>
         