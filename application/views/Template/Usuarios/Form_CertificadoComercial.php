<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php 
$modulo		=	$this->ModuloActivo;
$configuracion_manual = @get_certificado($this->uri->segment(3));
$row		=	@json_decode($configuracion_manual[0]->data);
echo form_open(current_url(),array('ajaxing' => 'true'));	?>
<div class="container" style="margin-bottom:70px;">
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Configuración certificado comercial</h3>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Salario básico mensual *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php set_input("Salario_básico_mensual",@$row->Salario_básico_mensual,"Salario básico mensual",$require=true,"money text-right",null,(!empty($row->Salario_básico_mensual)?true:false),array("class"=>"form-control","require"=>"require"));?>
                    </div>
				</div>                    
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Auxilio de Transporte *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php set_input("Auxilio_de_Transporte",@$row->Auxilio_de_Transporte,"Auxilio de Transporte",$require=true,"money text-right",null,(!empty($row->Auxilio_de_Transporte)?true:false),array("class"=>"form-control","require"=>"require"));?>
                    </div>
				</div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Comisiones, utilidades y/o Bonificaciones, *</b>
                    </div>
                    <div class="col-md-6">
                        <?php set_input("Comisiones_utilidades",@$row->Comisiones_utilidades,"Comisiones, utilidades y/o Bonificaciones",$require=true,"money text-right",null,(!empty(@$row->Comisiones_utilidades)?true:false),array("class"=>"form-control","require"=>"require"));?>
                    </div>
				</div> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>                        
                    </div>
                </div>                   
			</div>
        </div>
    </div>
    <div id='advertencia_input'></div>
</div>
<?php echo form_close();?>
<script>
    $(document).ready(function(){
        //validar('input');
        $('button[type="submit"]').click(function(e){
            var valido= true;
            var salario     = $("#Salario_básico_mensual").val();
            var auxilio    = $("#Auxilio_de_Transporte").val();
            var Comisiones = $("#Comisiones_utilidades").val();
            var contenedor = $('<div class="alert alert-danger col-md-12" role="alert"><strong>Importante: </strong> debe realizar un cambio para continuar, de lo contrario pulsar boton cerrar.</div>');
            if(salario==''){
                valido=false;
             $('#advertencia_input').html(contenedor);
                return false;
            }
            if(auxilio==''){
                valido=false;
                $('#advertencia_input').html(contenedor);
                return false;
            }

            if(Comisiones==''){
                valido=false;
                $('#advertencia_input').html(contenedor);
                return false;
            }
           
           if (valido){
            $('#advertencia_input').html('');
           }
            

         });
    });
</script>