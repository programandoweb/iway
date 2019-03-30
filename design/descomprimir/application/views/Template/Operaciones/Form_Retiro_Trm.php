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
$ciclo_informacion	=	get_cf_ciclos_pagos_new($this->user->id_empresa,0);
$periodo_pagos		=	centrodecostos($this->user->id_empresa);
$ciclopago			=	ciclopago($periodo_pagos->periodo_pagos,$ciclo_informacion->mes,$ciclo_informacion->fecha_desde);
$hidden 			= 	array();
echo form_open(current_url(),array('ajaxing' => 'true'),$hidden);	?>
<script>
	$( function() {
		$( ".datepicker" ).datepicker({changeMonth: true,changeYear: false});
		$( ".datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
		$( "#fecha_transaccion" ).val("<?php echo date("Y-m-d");?>");
	});
</script>
<div class="container" style="margin-bottom:100px;">
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
	                    <input type="text" class="form-control" name="ciclo_de_produccion" value="<?php echo $ciclopago; ?>" />
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Entidad Bancaria *</b>
                    </div>
                    <div class="col-md-6">	
						<?php 
							echo bancos($row,null,array("class"=>"form-control"),'banco_id');
						?>
                    </div>
				</div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Cuenta Bancaria Exterior*</b>
                    </div>
                    <div class="col-md-6">	
						<?php 
							echo Autocpmlete_CuentasBancarias($row);
						?>
                    </div>
				</div>
                <!--div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Cuenta Bancaria Nacional*</b>
                    </div>
                    <div class="col-md-6">	
						<?php 
							echo Autocpmlete_CuentasBancarias($row,NULL,array("class"=>"form-control"),'','id_cuenta_nacional','Bancaria Nacional');
						?>
                    </div>
				</div-->
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">	
                    	<b>Fecha Transacción</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php set_input("fecha_transaccion",$row,$placeholder='Fecha de Transacción',$require=false,"firstLetterText form-control datepicker");?>
                    </div>
                </div>
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">	
                    	<b>Nro de Transacción</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php set_input("nro_transaccion",$row,$placeholder='Nro de Transacción',$require=false,"firstLetterText form-control");?>
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
                    	<b>USD Cargado *</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php set_input("usd_cargado",$row,$placeholder='USD Cargado',$require=false,"firstLetterText form-control");?>
                        <input type="hidden" name="trm" id="trmID" class="form-control"/>
                    </div>                    
                </div>
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">   
                        <b>Caja de Destino *</b>
                    </div>
                    <div class="col-md-6">  
                        <?php echo Cajas($row,"CajaDestino",$placeholder='Caja de Destino',$require=true);?>
                        <input type="hidden" name="trm" id="trmID" class="form-control"/>
                    </div>                    
                </div>
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">   
                        <b>Caja de Destino *</b>
                    </div>
                    <div class="col-md-6">  
                        <?php echo Cajas($row,"id_caja",$placeholder='Caja de Destino',$require=true);?>
                        <input type="hidden" name="trm" id="trmID" class="form-control"/>
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
<script>
	$(document).ready(function(){
		$("#valor_retiro").keyup(function(){
			calcular();
		});
		$("#usd_cargado").keyup(function(){
			calcular();
		});
	});
	function calcular(){
		if($("#usd_cargado").val()!='' && $("#valor_retiro").val()!='' ){
			$("#trmID").val(parseFloat($("#valor_retiro").val()) / parseFloat($("#usd_cargado").val()) );	
		}
	}
</script>