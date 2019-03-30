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
$hidden 	= 	array();
echo form_open_multipart(current_url(),array('ajaxing' => 'true'),$hidden);?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col-md-12">
        	<div class="form">
	            <div class="row form-group">
	                <div class="col-md-12 text-left">	
                    	<b>Naturaleza e identificación *</b>
                    </div>
                    <div class="row col-md-12">
                        <div class="col-md-6">  
                            <?php echo MakeAsunto(null, array("class"=>"form-control"));?>
                        </div>
                        <div class="col-md-3">
                            <b>Dato Adjunto</b>
                        </div>
                        <div class="col-md-3">
                            <input type="file" name="adjunto">
                            <?php if(!empty($this->uri->segment($this->uri->total_segments()))){ ?>
                                <input type="hidden" value="<?php echo $this->uri->segment($this->uri->total_segments()); ?>" name="parent_id">
                            <?php } ?>
                        </div>
                    </div> 
				</div>                    
                <div class="row form-group">
                    <div class="col-md-12">	
						<textarea name="mensaje" rows="4" id="mensaje" class="form-control" require ></textarea>
                  	</div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>                        
                    </div>
                </div>                   
			</div>
        </div>
    </div>
</div>
<?php echo form_close();?>