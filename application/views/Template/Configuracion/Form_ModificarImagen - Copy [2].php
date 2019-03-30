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
$hidden 	= 	array('user_id' => $this->user->user_id,'campo' => "logo","redirect"=>base_url($this->uri->segment(1)."/CortarImagen"));
echo form_open_multipart(current_url(),array(),$hidden);	?>
<div class="container" style="margin-bottom:100px;">
	
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Cargar Imagen de Perfil</h3>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Subir Imagen de Perfil *</b>
                    </div>
                    <div class="col-md-6">
                        <input title="Tamaño máximo permitido 100Kb" data-filetype='var filestype = new Array(".gif", ".jpg", ".png", ".jpeg")' data-sizemax="1000000" type="file" id="userfile" name="userfile" placeholder="Imagen a Subir" require>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="alert alert-info" role="alert">
                        <h4 class="alert-heading">Importante</h4>
                    	<p>Las imágenes sólo serán permitidas con un máximo peso 100Kb y tamaño máximo de 1024px x 768px</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a class="btn btn-warning" href="<?php echo base_url($this->uri->segment(1).'/CortarImagen');?>">Recortar Actual</a>
                        </div>                        
                    </div>
                </div>                   
			</div>
        </div>
    </div>
</div>
<?php echo form_close();?>