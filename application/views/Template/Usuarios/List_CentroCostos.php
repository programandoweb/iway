<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
	        <?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Sucursales.",
															"url"	=>	current_url()),
									"add"		=>	array(	"title"	=>	"Agregar Centro de Costo.",
															"url"	=>	base_url($this->uri->segment(1)."/Add_Todos/".$this->uri->segment(3)),
															"lightbox"=>true),	
							)
						);
			?>
            <div class="row">
            	<div class="col-md-12">
					<?php	echo (isset($this->Listado))?$this->Listado:''; ?>
                </div>
            </div>
        </div>
    </div>
</div>
