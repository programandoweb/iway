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
$hidden 	= 	array('user_id' => $this->user->user_id,'campo' => "logo","redirect"=>base_url($this->uri->segment(1)."/ModificarImagen"));
echo form_open_multipart(current_url(),array(),$hidden);	
?>
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
	                <div class="col-md-4 text-right">	
                    	<b>Upload Image: *</b>
                    </div>
                    <div class="col-md-4">
                        <label class="img-upload-label">
                        	<input type="file" class="js-fileinput img-upload " accept="image/jpeg,image/png,image/gif" data-width="128" data-height="128">
                        </label>
                    </div>
                    <div class="col-md-4">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="js-export img-export btn btn-warning" >Cortar</button>
                            <button id="botonera" type="submit" class="btn btn-primary">Guardar</button>
                        </div>
					</div>                        
                </div>
                <div class="row form-group">
                    <div class="col-md-8 preview">
						<canvas class="js-editorcanvas"></canvas>
                        
                    </div>
                    <div class="col-md-4">
						<canvas class="js-previewcanvas"></canvas>
                        <div id="div1"></div>
                    </div>
                </div>
			</div>
        </div>
    </div>
    
</div>
<?php echo form_close();?>
<script src="<?php echo DOMINIO?>assets/js/index.js"></script>
<script>
	$(document).ready(function(){
		$("#botonera").attr("disabled","disabled");	
		$(".btn-warning").click(function(){
			$("#botonera").removeAttr("disabled");	
		});
		$(".js-export").click(function(){
			$("#div1").append('<input type="hidden" value="'+$("#div1").find("img").attr("src")+'" name="image" />');
		});
	})
</script>