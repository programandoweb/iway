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
$hidden 	= 	array('user_id' => $this->uri->segment(3),"redirect"=>base_url("Configuracion/Logo"));
echo form_open_multipart(current_url(),array(),$hidden);	?>
<div class="container" style="margin-bottom:100px;">
	
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Cargar Logo</h3>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Logo a Subir *</b>
                    </div>
                    <div class="col-md-6">
                        <input title="Tamaño máximo permitido 100Kb" data-filetype='var filestype = new Array(".gif", ".jpg", ".png", ".jpeg")' data-sizemax="100000" type="file" id="userfile" name="userfile" placeholder="Imagen a Subir" require>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Imagen Firma a Subir *</b>
                    </div>
                    <div class="col-md-6">
                        <input title="Tamaño máximo permitido 100Kb" data-filetype='var filestype = new Array(".gif", ".jpg", ".png", ".jpeg")' data-sizemax="100000" type="file" id="userfile2" name="userfile2" placeholder="Imagen a Subir" require>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-12 text-center">	
                    	<b>Atención:</b> las imágenes sólo serán permitidas con un máximo peso 100Kb y tamaño máximo de 1024px x 768px
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a class="btn btn-warning" href="<?php echo base_url($this->uri->segment(1).'/Logo');?>">Cerrar y Volver</a>
                        </div>                        
                    </div>
                </div>                   
			</div>
        </div>
    </div>
</div>
<?php echo form_close();?>