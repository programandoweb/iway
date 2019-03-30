<?php

$modulo		=	$this->ModuloActivo;
?>
<div class="container">
        <div class="row justify-content-md-center">
              <div class="col">
                   <?php 
				   echo TaskBar(array("name"		=>	array(	"title"	=>"Terminos de pago.",
															"url"	=>	current_url()),
									   "add"		=>	array(	"title"	=>	"Terminos pago",
															"url"	=>	base_url($this->uri->segment(1)."/AddRol"),
															"lightbox"=>true),						
							)
						);
			         ?>
              </div>
        </div>
 
</div> 