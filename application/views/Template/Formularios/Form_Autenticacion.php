<?php
/* 
    DESARROLLO Y PROGRAMACIÓN
    PROGRAMANDOWEB.NET
    LCDO. JORGE MENDEZ
    info@programandoweb.net
*/?>
<?php 
echo form_open(current_url("Formularios/Autenticacion"));  
$estado=$this->Formularios->estado($this->uri->segment(3));  
?>
<div class="container" style="margin-bottom:100px;">
    <div class="row justify-content-md-center" style="margin-bottom:20px;">
        <div class="col-md-12 text-center">
	        <h3>Introduce tu documento Para confirmar.</h3>
        </div>
	</div>
    <?php 
    	if($estado){?>
            <div class="row" style="margin-bottom:20px;">
                <div class="col-md-6 text-right">   
                    <b>Documento Aspirante*</b>
                </div>
                <div class="col-md-2">  
                    <?php set_input("nro_piso_cedula","",$placeholder='Numero de documento',$require=true,"firstLetterText");?>
                    <input type="hidden" name="token" value"<?php echo $this->uri->segment(3); ?>">
                </div>
            </div>
            <div class="form-row text-center">   
                <div class="" id="btn-generar">
                    <div class="col-md-12">  
                            <button type="submit" class="btn btn-primary btn-md"> Enviar</button>
                    </div>
                </div>                                    
            </div>                         
		<?php 
			}else{ 
		?>
            <div class="row form-group item">
                <div class="col-md-12 text-center">
                    <h3>Token vencido.</h3>
                </div>
            </div>
		<?php	
			} 
		?>
	</div>
</div>
<?php echo form_close();?>