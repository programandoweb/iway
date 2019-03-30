<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
	$modulo		=	$this->ModuloActivo;
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<div class="row filters">
            	<div class="col-md-12">
                    <?php 
                        echo TaskBar(array("name"       =>  array(  "title" =>  "Bancos Nacionales.",
                                                                    "icono" =>  '<i class="fas fa-university"></i>',
                                                                    "url"   =>  current_url()),
                                    )
                                );
                    ?>
        </div>
    </div>
          