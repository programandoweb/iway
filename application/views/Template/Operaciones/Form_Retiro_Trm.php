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
$ciclopago			=	@ciclopago($periodo_pagos->periodo_pagos,$ciclo_informacion->mes,$ciclo_informacion->fecha_desde);
$hidden 			= 	array();
$bancos = @$this->$modulo->ResumenBancos()['Nacionales'];
echo form_open(current_url(),array('ajaxing' => 'true'),$hidden);	?>
<script>
	$( function() {
		$( ".datepicker" ).datepicker({changeMonth: true,changeYear: false});
		$( ".datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
		$( "#fecha_transaccion" ).val("<?php echo date("Y-m-d");?>");
	});
</script>
<div class="container" style="margin-bottom:20px;">
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Información Monetización</h3>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-5 text-right">   
                        <b>Monetizador *</b>
                    </div>
                    <div class="col-md-6">  
                        <?php echo MakeSelect("Monetizador",@$row->Monetizador,array("class"=>"form-control","id"=>"Monetizador"),array(" "=>"Seleccione","Cajero"=>"Cajero","Entidad Bancaria"=>"Entidad Bancaria","Tercero"=>"Tercero"),true); ?>
                        <input type="hidden" value="1" require>
                    </div>
                </div>
                <div class="row form-group" id="tercero" style="display: none;">
                    <div class="col-md-5 text-right">   
                        <b>Tercero *</b>
                    </div>
                    <div class="col-md-6">  
                        <?php echo MakeProveedores(@$row,"Tercero","Tercero",false) ;?>
                    </div>
                    <div class="col-md-6 offset-md-5 mt-2" id="alerta">  
                    </div>
                </div> 
                <!--<div class="row form-group">
	                <div class="col-md-5 text-right">	
                    	<b>IMC (Cajero) *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php set_input("cajero_identificacion",$row,$placeholder='IMC',$require=false,"firstLetterText form-control");?>
                    </div>
				</div>-->                    
               	<div class="row form-group" style="display:none;">
                    <div class="col-md-5 text-right">	
                    	<b>Periodo</b>
                    </div>
                    <div class="col-md-6">	
	                    <input type="text" required class="form-control" name="ciclo_de_produccion" value="<?php echo $ciclopago; ?>" readonly/>
                    </div>
                </div>
                <div class="row form-group" id="entidad" style="display: none;">
	                <div class="col-md-5 text-right">	
                    	<b>Entidad Bancaria *</b>
                    </div>
                    <div class="col-md-6">	
						<?php 
							echo bancos($row,null,array("class"=>"form-control"),'banco_id');
						?>
                    </div>
				</div>
                <div class="row form-group">
	                <div class="col-md-5 text-right">	
                    	<b>Cuenta Bancaria Exterior*</b>
                    </div>
                    <div class="col-md-7">	
						<?php 
							echo Autocpmlete_CuentasBancarias2($row);
						?>
                    </div>
				</div>
                <div class="row form-group">                    
                    <div class="col-md-5 text-right">	
                    	<b>Fecha Transacción</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php set_input("fecha_transaccion",$row,$placeholder='Fecha de Transacción',$require=false,"firstLetterText form-control datepicker");?>
                    </div>
                </div>
                <div class="row form-group">                    
                    <div class="col-md-5 text-right">	
                    	<b>Numero de Transacción</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php set_input("nro_transaccion",$row,$placeholder='Nro de Transacción',$require=false,"firstLetterText form-control");?>
                    </div>
                </div>
              	<div class="row form-group">                    
                    <div class="col-md-5 text-right">	
                    	<b>Valor Retiro *</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php set_input("valor_retiro",$row,$placeholder='Valor del Retiro',$require=false,"firstLetterText form-control money");?>
                    </div>
                </div>
                 <div class="row form-group">                    
                    <div class="col-md-5 text-right">   
                        <b>Valor comision Bancaria *</b>
                    </div>
                    <div class="col-md-6">  
                        <input type="text" id="ComisionBancaria" name="ComisionBancaria" placeholder="Valor comisión Bancaria" class="form-control money" value="0">
                    </div>                    
                </div>
                <div class="row form-group">                    
                    <div class="col-md-5 text-right">   
                        <b>USD Cargado *</b>
                    </div>
                    <div class="col-md-6">  
                        <?php set_input("usd_cargado",$row,$placeholder='USD Cargado',$require=false,"firstLetterText form-control money");?>
                        <input type="hidden" id="usd_cargado_oculto" />
                    </div>                    
                </div>
                <div class="row form-group">                    
                    <div class="col-md-5 text-right">   
                        <b>TRM *</b>
                    </div>
                    <div class="col-md-6">  
                        <input type="text" name="trm" id="trmID" class="form-control" readonly="readonly"/>
                    </div>                    
                </div>
                <div class="row form-group">                    
                    <div class="col-md-5 text-right">   
                        <b>Tipo transacción *</b>
                    </div>
                    <div class="col-md-6">  
                        <?php echo MakeSelect("Tipo_transaccion",@$row->Tipo_transaccion,array("class"=>"form-control","id"=>"transaccion"),array("Seleccione","Transferencia","Efectivo"),true); ?>
                    </div>                    
                </div>
                <div class="row form-group" id="caja" style="display: none;">                    
                    <div class="col-md-5 text-right">   
                        <b>Caja de Destino *</b>
                    </div>
                    <div class="col-md-6">  
                        <?php echo MakeCajas("CajaDestino",$row,array('class'=>'form-control','require'=>true,"id"=>"CajaDestino"));?>
                    </div>                    
                </div>
                <div class="row form-group" id="banco" style="display: none;">                    
                    <div class="col-md-5 text-right">   
                        <b>Banco de destino *</b>
                    </div>
                    <div class="col-md-6">  
                        <?php echo MakeBanco("Banco_destino",@$row->Banco_destino,array("class"=>"form-control","id"=>"Banco_destino"),@$bancos,true); ?>
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
        $('#Monetizador').change(function(){
            if($(this).val() == "Tercero"){
                $('#tercero').show();
                $('#entidad').hide();
                $('#content_entidad_bancaria').val('');
                $('#content_entidad_bancaria').removeAttr('require');
            }else{
                $('#tercero').hide();
                $('#contentTercero').val('');
                $('#Tercero').removeAttr('require');
                $('#Tercero').val('');
                $('#entidad').show();
            }
        });
        
        $('#transaccion').change(function(){
            if($(this).val() == "Efectivo"){
                $('#caja').show();
                $('#banco').hide();
                $('#Banco_destino').val('');
                $('#Banco_destino').removeAttr('require');
            }else{
                $('#caja').hide();
                $('#CajaDestino').val('');
                $('#CajaDestino').removeAttr('require');
                $('#banco').show();
            }
        });
        var monto_maximo_transaccion = 0;
		$("#procesador_id").change(function(){
			monto_maximo_transaccion	=	$("#procesador_id option:selected").data("monto");
			monto_maximo_transaccion		=	parseFloat(monto_maximo_transaccion).toFixed(2);
			$("#usd_cargado").val(monto_maximo_transaccion);
			$("#usd_cargado_oculto").val(monto_maximo_transaccion)
			$("#usd_cargado").attr("data-maximo",monto_maximo_transaccion);
		});
		$("#valor_retiro").keyup(function(){
			calcular();
		});
		$("#usd_cargado").keyup(function(){
            var usd = parseFloat($(this).val());
			if( usd > parseFloat(monto_maximo_transaccion)){
                console.log('hola');
				make_message("Error","Monto supereado");
				$(this).val($("#usd_cargado_oculto").val());
				return false;
			}
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
		var retiro			=	(parseFloat($('[name="valor_retiro"]').val()) +  parseFloat($('[name="ComisionBancaria"]').val()));
		var retiro_final	=	retiro/parseFloat($('[name="usd_cargado"]').val());
		$("#trmID").val(retiro_final.toFixed(2));	
	}
</script>