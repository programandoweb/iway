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
$row		=	$this->$modulo->result;
$hidden 	= 	array('type'=>$this->uri->segment(3),'user_id' => (isset($row->user_id))?$row->user_id:'',"redirect"=>base_url("Usuarios/Todos/".$this->uri->segment(3)));
echo form_open(current_url(),array('ajaxing' => 'true'),$hidden);	?>
<script>
	$( function() {
		$( ".datepicker" ).datepicker({changeMonth: true,changeYear: true});
		$( ".datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
		$( ".datepicker" ).datepicker({changeMonth: true,changeYear: true,showOtherMonths: true,selectOtherMonths: true});
		$( "#fecha_expedicion_documento_identidad" ).val("<?php echo (isset($row->fecha_expedicion_documento_identidad)?$row->fecha_expedicion_documento_identidad:null);?>");
		$( "#fecha_nacimiento" ).val("<?php echo (isset($row->fecha_nacimiento)?$row->fecha_nacimiento:null);?>");
		$( "#fecha_sociedad" ).val("<?php echo (isset($row->fecha_sociedad)?$row->fecha_sociedad:null);?>");
	});
</script>
<div class="container" style="margin-bottom:20px;">
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Información Basica</h3>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>IMC (Cajero) *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php set_input("cajero_identificacion",$row,$placeholder='IMC',$require=false,"firstLetterText form-control");?>
                    </div>
				</div>                    
                <div class="row form-group">
                    <div class="col-md-6 text-right">	
                    	<b>Periodo</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php set_input("fecha_transaccion",$row,$placeholder='Periodo',$require=false,"firstLetterText form-control");?>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Entidad Bancaria *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php set_input("banco_id",$row,$placeholder='Segundo Apellido',$require=false,"firstLetterText form-control");?>
                    </div>
				</div>
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">	
                    	<b>No de Transaccion</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php set_input("nro_transaccion",$row,$placeholder='Segundo Apellido',$require=false,"firstLetterText form-control");?>
                    </div>
                </div>
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">	
                    	<b>Tarjeta Numero *</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php set_input("",$row,$placeholder='Segundo Apellido',$require=false,"firstLetterText form-control");?>
                    </div>
                </div>
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">	
                    	<b>Valor Retiro *</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php set_input("valor_retiro",$row,$placeholder='Valor del Retiro',$require=false,"firstLetterText form-control");?>
                    </div>
                </div>
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">	
                    	<b>Usd Cargado *</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php set_input("segundo_apellido",$row,$placeholder='Usd Cargado',$require=false,"firstLetterText form-control");?>
                    </div>
                </div>
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">	
                    	<b>TRM *</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php set_input("trm",$row,$placeholder='TRM',$require=false,"firstLetterText form-control");?>
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
</div>
<?php echo form_close();?>