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
$hidden 	= 	array('user_id' => $this->uri->segment(3),'campo' => "logo","redirect"=>base_url("Configuracion/CortarImagen"));
echo form_open_multipart(current_url(),array("class"=>"form-horizontal"),$hidden);	
	$user	=	centrodecostos($this->user->user_id);
?>
<div class="container" style="margin-bottom:20px;">
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Recortar Imagen</h3>
                    </div>
                </div>
                <div class="row">
                	<div class="col-md-3">
                        <label class="img-upload-label">
                        	Upload Image:
                        	<input type="file" class="js-fileinput img-upload" accept="image/jpeg,image/png,image/gif">
                        </label>
                        <button class="js-export img-export">Export</button>
                        <canvas class="js-editorcanvas"></canvas>
                        <canvas class="js-previewcanvas"></canvas>
                    </div>
                	<div class="col-md-6 text-center banner">
                    	<img class="cropper" src="<?php echo DOMINIO?>images/uploads/<?php echo $user->logo ?>" width="100%"/>
                    </div>                	                	
                </div>
			</div>
        </div>
    </div>
</div>
<!--script src="<?php echo DOMINIO?>assets/js/index.js"></script-->
<?php echo form_close();?>