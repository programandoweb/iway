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
$modulo		=	$this->ModuloActivo;
$row		=	$this->$modulo->result;
$ciclo_informacion	=	get_cf_ciclos_pagos_new($this->user->id_empresa,0);
$periodo_pagos		=	centrodecostos($this->user->id_empresa);
$ciclopago			=	ciclopago($periodo_pagos->periodo_pagos,$ciclo_informacion->mes,$ciclo_informacion->fecha_desde);
$hidden 			= 	array('caja_id' => $this->uri->segment(3));
echo form_open(current_url(),array(),$hidden);	
?>
<script>
	var banco = false;
</script>
<div class="container" style="margin-bottom:100px;">
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Información de Consignación</h3>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Cuenta Bancaria Nacional*</b>
                    </div>
                    <div class="col-md-6">	
						<?php 
							echo Autocpmlete_CuentasBancarias($row,$estado = null,array("class"=>"form-control"),'',$name='procesador_id',array("Pesos","COP"));
						?>
                        <input type="hidden" required class="form-control" name="ciclo_de_produccion" value="<?php echo $ciclopago; ?>" readonly/>
                    </div>
				</div>
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">	
                    	<b>Valor consignado *</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php 
							
							$row=new stdClass();
							$row->valor_consignacion	=	 $this->uri->segment(4);
							set_input("valor_consignacion",$row,$placeholder='Valor a conseginar',$require=false,"form-control money",array(),true);?>
                    </div>
                </div>
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">	
                    	<b>Nro Consignación *</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php 
							set_input("nro_documento",$row,'Nro Consignación',$require=false,"form-control");
						?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary" disabled="disabled">Guardar</button>
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
		var valor = false;
		var nro_consigacion = false;
		$("#nro_documento").keyup(function(event) {
			if($('#valor_consignacion').length > 0){
				valor = true;
			}
			if($(this).length > 0){
				nro_consigacion = true;
			}
			if(banco && valor && nro_consigacion){
				console.log("prueba");
				$('button[type="submit"]').removeAttr('disabled');
			}
		});
		$('#procesador_id').click(function(event) {

		});
		$("#valor_retiro").keyup(function(){
			calcular();
		});
		$("#usd_cargado").keyup(function(){
			calcular();
		});
		$("#usd_cargado").keyup(function(){
			calcular();
		});
		$("#usd_cargado").keyup(function(){
			calcular();
		});
		$("#usd_cargado").focusout(function(){
            calcular();
        });
	});
	function calcular(){
		if($("#valor_retiro").val()=='' || $("#ComisionBancaria").val()=='' || $("#usd_cargado").val()=='' ){
			return false;
		}
		var retiro			=	(parseFloat($("#valor_retiro").val()) +  parseFloat($("#ComisionBancaria").val()));
		var retiro_final	=	retiro/parseFloat($("#usd_cargado").val());
		$("#trmID").val(retiro_final.toFixed(2));	
	}
</script>