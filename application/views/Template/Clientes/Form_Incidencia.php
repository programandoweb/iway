<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php 
	if(!centro_de_costos()){
		return;
	}
?>
<?php 
$modulo		=	$this->ModuloActivo;
$row		=	$this->$modulo->result;
$hidden 	= 	array("comercial_id"=>$this->uri->segment(3));
echo form_open(current_url(),array(),$hidden);	?>
<div class="container" style="margin-bottom:20px;">
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Agragar Incidencia</h3>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Incidencia *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php echo form_textarea("observacion",$row,array("class"=>"form-control","require"=>true));?>
                    </div>
				</div> 
                <div class="text-center" id="btn-generar">
                        <button type="submit" class="btn btn-primary btn-md"> Agregar</button>
                </div>                                     
			</div>
        </div>
    </div>
</div>
<?php echo form_close();?>