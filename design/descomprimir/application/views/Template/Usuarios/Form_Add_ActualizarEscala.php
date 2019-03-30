<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php 
$modulo		=	$this->ModuloActivo;
$row		=	$this->$modulo->result;
$hidden 	= 	array("iframe"=>"Add_Todos_Iframe","user_id"=>$this->uri->segment(3),'type' => (isset($row->type))?$row->type:'');
echo form_open(current_url(),array('ajax' => 'true'),$hidden);	?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col-md-12">
        	<div class="form">
	            <div class="row form-group">
	                <div class="col-md-3 text-right">	
                    	<b>Escala de Pagos *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php echo get_escala_pagos((isset($row->id_escala))?$row->id_escala:NULL,array("class"=>"form-control","require"=>"require"));?>
                    </div>
				</div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>                        
                    </div>
                </div>                   
			</div>
        </div>
    </div>
</div>
<?php echo form_close();?>