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
//pre($this->Configuracion->empresa);
$hidden 	= 	array('user_id' => $this->user->user_id);
?>
<div class="container" style="margin-bottom:100px;">
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group text-center">
                	<div class="col-md-12">	
                    	<button  class="btn btn-link jscolor {valueElement:'chosen-value', onFineChange:'setTextColor(this)'}">
                        	<i class="fas fa-paint-brush fa-2x"></i>
                        </button>	
                    </div>
				</div> 
                <?php echo form_open(current_url());?>   
                <input id="chosen-value" name='color_aplicativo' value="000000" type="hidden" require />                
				<div class="row form-group text-center">                    
                	<div class="col-md-4">
                    </div>
	                <div class="col-md-4 text-center" id="ejemplo" style=" background-color:<?php echo @$this->Configuracion->empresa->color_aplicativo;?>">
                        
                    </div>
                </div>
                <div class="row form-group text-center send" style="display:none;">                    
                	<div class="col-md-4">
                    </div>
	                <div class="col-md-4 text-center" id="ejemplo">
                    	<button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Guardar</button>
                    </div>
                </div>
                <?php echo form_close();?>
			</div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
		$("#ejemplo").height($("#ejemplo").width());
    })
	function setTextColor(picker) {
		$("#ejemplo").height($("#ejemplo").width())
		$("#chosen-value").val('#' + picker.toString());
        $("#ejemplo").css('background','#' + picker.toString());
		$(".send").show();
	}
</script>