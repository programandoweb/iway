<?php

$modulo		=	$this->ModuloActivo;
?>
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
        			echo TaskBar(array("name"		=>	array(	"title"	=>	$this->uri->segment(3)."Historial de llamada.",
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
	                <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#activos" role="tab" style="margin:0px,padding:0px">
                                <i class="fas fa-angle-right"></i> Activos 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#inactivos" role="tab">
                               <i class="fas fa-angle-right"></i>  Inactivos 
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content row">
    					<div class="tab-pane active col-md-12" id="activos" role="tabpanel">	
                            <table class="ordenar display table table-hover" ordercol=3 order="desc">
                                <thead>
                                    <th class="text-center">Avatar</th>
                                    <th>Tercero</th>
                                    <th><b>Usuario</b></th>
                                    <th>Datos de Contacto</th>
                                    <th>Salario básico</th>
                                    <th style="text-align: center;">Acciónes</th>
                                </thead>
                        <tbody>
                 </tbody>