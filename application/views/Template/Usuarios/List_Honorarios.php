<?php  
$modulo		=	$this->ModuloActivo;
$rows       = 	$this->$modulo->result;
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
            <?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Honorarios.",
															"url"	=>	current_url()),
									"add"		=>	array(	"title"	=>	"Agregar descuento",
															"url"	=>	base_url("Usuarios/AddDescuentos/Agregar"),
															"lightbox"=>true),						
							)
						);
			?>
          