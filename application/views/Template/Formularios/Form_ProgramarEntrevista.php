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
$modulo =   $this->ModuloActivo;
echo form_open(current_url());	?>
<div class="container" style="margin-bottom:100px;">
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Enviar invitación para entrevista.</h3>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Documento Aspirante*</b>
                    </div>
                    <div class="col-md-6">	
                        <?php set_input("nro_piso_cedula","",$placeholder='Numero de documento',$require=true,"firstLetterText");?>
                    </div>
				</div>                    
                <div class="row form-group">
                    <div class="col-md-6 text-right">	
                    	<b>Correo *</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php set_input("email","",$placeholder='Corre Electronico',$require=true,"firstLetterText");?>
                    </div>
                </div>
                <div class="text-center" id="btn-generar">
                        <button type="submit" class="btn btn-primary btn-md"> Enviar</button>
                </div>                                     
			</div>
        </div>
    </div>
<?php echo form_close();?>   
</div>


