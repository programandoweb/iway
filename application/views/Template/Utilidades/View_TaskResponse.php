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
?>
<script src="design/js/pgrw.Clipboard.js"></script>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col-md-12">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Respuesta a incidencia</h3>
                    </div>
                </div>
                <div id="extra_datos">
					<?php 
                    	$hidden 	= 	array('current_id' => $this->uri->segment(3));
						echo form_open_multipart(current_url(),array(),$hidden);	
					?>
                    <div class="row form-group">  
                    	<div class="col-md-6 text-right">	
                      		<canvas data-url="<?php echo base_url("Utilidades/ViewTaskResponse/16/rest");?>" data-id="pasteTarget" style="width:100%; background: grey; border:none;" id="canvasTarget"></canvas>
                            <textarea id="base64image" name="image" style="display:none;" ></textarea>
        	            </div>
                        <div class="col-md-6">	
                            <?php echo form_textarea('descripcion', "", array('class'=>'form-control','id'=>'pasteTarget'));?>
                        </div>
                    </div>
                    <div class="row form-group text-center" id="adjuntar">  
	                    <div class="col-md-6 text-right">     
	                                  
                        </div>
                        <div class="col-md-6 text-left">   
    	                    <div class="adjuntar btn btn-primary"><i class="fas fa-paperclip"></i> Adjuntar</div>
						</div>                            
                    </div>
				    <div class="row">
                        <div class="col-md-6 text-right">	
    	    	            <b>¿Solicitar Cerrar Incidencia? </b>
        	            </div>
                        <div class="col-md-6">	
							<?php echo MakeSiNo("cerrar",$estado=null,array("class"=>"form-control","require"=>true));?>                        
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>                        
                        </div>
                    </div>
                    <?php echo form_close();?> 
				</div>                    
			</div>
        </div>
    </div>
</div>
<script>
	$(document).ready(function(){
		var adjunto	=	'<div class="col-md-6 text-right"><b>Adjunto *</b></div><div class="col-md-6"><input type="file" name="userfile" /></div>';
		$(".adjuntar").click(function(){
			$("#adjuntar").html(adjunto);	
		});		
	})
</script>