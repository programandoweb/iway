<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<?php
        		if($this->uri->segment(3) == "Monitores"){
					echo TaskBar(array("name"		=>	array(	"title"	=>	$this->uri->segment(3).".",
																"url"	=>	current_url()),
										"add"		=>	array(	"title"	=>	"Agregar ".$this->uri->segment(3),
																"url"	=>	base_url($this->uri->segment(1)."/Add_Todos/".$this->uri->segment(3)),
																"lightbox"=>true),
										"config"	=>	array(	"title"	=>	"Personalización de Factura",
																"icono"	=>	'<i class="fas fa-cogs"></i>',
																"url"	=>	base_url("Configuracion/Porcentaje"),
																"lightbox"=>true),													
							)
						);
        		}else{
        			echo TaskBar(array("name"		=>	array(	"title"	=>	$this->uri->segment(3).".",
																"url"	=>	current_url()),
										"add"		=>	array(	"title"	=>	"Agregar ".$this->uri->segment(3),
																"url"	=>	base_url($this->uri->segment(1)."/Add_Todos/".$this->uri->segment(3)),
																"lightbox"=>true),						
							)
						);
        		}
			?>
            <div class="row">
            	<div class="col-md-12">
					<?php	echo (isset($this->Listado))?$this->Listado:''; ?>
                </div>
            </div>
        </div>
    </div>
</div>
