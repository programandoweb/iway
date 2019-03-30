<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
	$modulo         =   $this->ModuloActivo;
   
    echo form_open(current_url(),array('autocomplete' => 'off'));
?>
<div class="container margin-top-100">
	<div class="row justify-content-md-center">
    	<div class="col">
          	<img width="200" src="<?php echo DOMINIO?>images/webcamplus-png.png" class="rounded mx-auto d-block" alt="..." />
            <div class="row text-center">
            
            	<div class="col-md-6 offset-md-3">
					<?php echo form_open(base_url($this->uri->segment(1)."/inicio_sesion"),array('ajax' => 'true'));	?>
                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-1">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1" style="width:40px;"><i class="fas fa-id-card" aria-hidden="true"></i></span>
                                    <?php set_input("nro_piso_cedula","",$placeholder='Número de Documento',$require=true,"firstLetterText");?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row text-center">
                            <div class="col-sm-10 offset-sm-1">
                            	<button type="submit" class="btn btn-warning btn-block"> Identificarme </button>
                            </div>
                        </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo form_close();?>
<script>
	$(document).ready(function(){
		$("header").remove();
	});
</script>                                             