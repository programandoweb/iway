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
				echo TaskBar(array("name"		=>	array(	"title"	=>	$this->centrodecostos->nombre.".",
															"url"	=>	current_url()),
									"add"		=>	array(	"title"	=>	"Agregar",
															"url"	=>	base_url("Usuarios/Add_Todos/Asociados"),
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
