<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php 
echo form_open(current_url("Formularios/Autenticacion"));?>
<div class="container" style="margin-bottom:20px;">
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Introduce tu documento Para confirmar.</h3>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Documento Aspirante*</b>
                    </div>
                    <div class="col-md-6">	
                        <?php set_input("nro_piso_cedula","",$placeholder='Numero de documento',$require=true,"firstLetterText");?>
                        <input type="hidden" name="token" value"<?php echo $this->uri->segment(4); ?>">
                    </div>
				</div>   
                <div class="row form-group">
                    <div class="text-center" id="btn-generar">
	                    <button type="submit" class="btn btn-primary btn-md"> Enviar</button>
                    </div>                                     
				</div>                    
			</div>
        </div>
    </div>
</div>
<?php echo form_close();?>
<script type="text/javascript">
    $(document).ready(function() {
        var respuesta == "<?php echo $this->uri->segment(3); ?>";
        if(respuesta=="Vencido"){
            $('.form').hide();
        }
    });
</script>