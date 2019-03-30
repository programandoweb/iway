<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php
	if(!@$this->user->id_empresa){
?>	
		<h3 class="text-center">Seleccione un Centro de Costos</h3>
<?php		
		return;	
	}		
?>
<?php 
$modulo		=	$this->ModuloActivo;
$row		=	$this->$modulo->result;
$hidden 	= 	array("redirect"=>base_url("Reportes/InformePlano"),"equivalencia"=>"0","moneda_de_pago"=>"PERFIL IMPORTADO","tipo_persona"=>"PERFIL IMPORTADO");
echo form_open_multipart(current_url(),array(),$hidden);	?>

<div class="container" style="margin-bottom:100px;">
	
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Cargar Archivo Plano</h3>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-3 text-right">	
                    	<b>Mes *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php 
							echo MakeMes("mes",(isset($row->mes))?$row->mes:NULL,array("class"=>"form-control","require"=>"require"));
						?>
                    </div>
				</div>
                <div class="row form-group">
	                <div class="col-md-3 text-right">	
                    	<b>Período *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php 
							echo MakeCiclos($this->user->periodo_pagos);
						?>
                    </div>
				</div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Imagen a Archivo *</b>
                    </div>
                    <div class="col-md-6">
                        <input type="file" id="userfile" name="userfile" placeholder="Imagen a Subir" require>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="alert alert-info" role="alert">
                        <h4 class="alert-heading">Importante</h4>
                    	<p>Los archivos sólo serán admitidos con un peso máximo de 5MB y formatos en xls o xlsx</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a class="btn btn-warning" href="<?php echo base_url();?>">Cerrar</a>
                        </div>                        
                    </div>
                </div>                   
			</div>
        </div>
    </div>
</div>
<?php echo form_close();?>