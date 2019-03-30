<?php
	if(!@$this->user->id_empresa){
?>	
		<h3 class="text-center">Seleccione un Centro de Costos</h3>
<?php		
		return;	
	}		
$modulo		=	$this->ModuloActivo;
$row		=	$this->$modulo->result;
$json       =   @json_decode($row->json);
$Pagos  =   getMovimientosGeneral($this->uri->segment(4),NULL,14,NULL,$json->ciclopago,$this->uri->segment(3));
$credito_pago_honorarios = 0;
foreach ($Pagos as $key => $value) {
    $credito_pago_honorarios +=$value->credito;
}
$hidden     =   array("redirect"=>str_replace("/Pagar","",current_url()),"nro_documento"=>$row->consecutivo,"ciclo_produccion"=>$json->ciclopago);
echo form_open(base_url("Operaciones/PagarHonorarios/".$this->uri->segment(3)),array("id"=>"transaccion"),$hidden);
?>
<script>
	$( function() {
		/*$( ".datepicker" ).datepicker({changeMonth: false,changeYear: false,minDate: new Date(<?php echo date_format($date, 'Y')?>,<?php echo (int)date_format($date, 'm')-1?>,<?php echo date_format($date, 'd')?>), maxDate: "+3M +1D"});*/
		$( ".datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
		$( ".datepicker" ).datepicker({changeMonth: true,changeYear: true,showOtherMonths: true,selectOtherMonths: true});
		$( "#fecha_recibido" ).val("<?php echo date("Y-m-d");?>");
	});
</script>
<div class="container" style="margin-bottom:100px;">
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3><?php echo $json->data_user->primer_nombre.' '.@$json->data_user->segundo_nombre.' '.$json->data_user->primer_apellido.' '.@$json->data_user->segundo_apellido;?></h3>
                    </div>
                </div>
			</div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-2">
           Proveedor<BR /> ID Proveedor
        </div>
        <div class="col-md-4">
            <b>
                <?php echo $json->data_user->primer_nombre.' '.@$json->data_user->segundo_nombre.' '.$json->data_user->primer_apellido.' '.@$json->data_user->segundo_apellido;?>
                <br />
                <?php echo $json->data_user->identificacion;?>
            </b>
        </div>
        <div class="col-md-2">
            Fecha Desde<br />
            Fecha Hasta                   
        </div>
        <div class="col-md-4 text-right">
             <b>
             <?php 
                /*DAVID MANDÓ A CAMBIAR*/
                echo $json->ciclo_informacion->fecha_desde;
             ?>
            <br />
            <?php
                echo $json->ciclo_informacion->fecha_hasta;
            ?>
            </b>
        </div>
    </div> 
    <div class="row">
        <div class="col-md-2">
           Dirección
        </div>
        <div class="col-md-4">
            <b>
                <?php 
                    echo $json->data_user->direccion; //str_replace($row[0]->Pais,"",$row[0]->Direccion)
                ?>
            </b>
        </div>
        <div class="col-md-3 ">
           Ciclo de producción
        </div>
        <div class="col-md-3 text-right">
            <b>
                <?php echo $json->ciclopago ;?>
            </b>
        </div>
    </div>
    <div style="height: 40px">
         
     </div> 
    <div class="row filters">
    	<div class="col-md-4">
    		<b>Fecha de pago</b>
        </div>
        <div class="col-md-4">
			<?php set_input("fecha_recibido",@$row,$placeholder='Fecha de la Transacción',true,"datepicker");?>
        </div>
        <div class="advertencia"></div>
    </div>
    <div class="row filters">                 
    	<div class="col-md-4">
            <b>Tipo transacción *</b><br/>
        </div>
        <div class="col-md-6">  
            <?php echo MakeSelect("Tipo_transaccion",@$row->Tipo_transaccion,array("class"=>"form-control validar","id"=>"trans"),array("Seleccione","Transferencia","Efectivo"),true); ?>
        </div> 
        <div class="offset-md-4 col-md-6 advertencia"></div>                   
    </div>
    <div class="row filters" id="caja" style="display: none;">                    
        <div class="col-md-4">   
            <b>Caja de Destino *</b>
        </div>
        <div class="col-md-6">  
            <?php echo MakeCajas("caja_id",@$row->CajaDestino,array('class'=>'form-control',"id"=>"CajaDestino"));?>
        </div>
        <div class="offset-md-4 col-md-6 advertencia"></div>                    
    </div>      
    <div class="row filters" id="banco" style="display: none;">
        <div class="col-md-4">
            <b>Procesador de Pago</b> 
        </div>
        <div class="col-md-4">
            <?php
                $procesadores = ResumenBancosNew(array("COP","PESOS")); 
                echo MakeBanco("Banco_destino",@$banco,array("class"=>"form-control","id"=>"Banco_destino"),@$procesadores,true); ?>
        </div>
        <div class="offset-md-4 col-md-6 advertencia"></div>
    </div>
    <!--<div class="row filters">
        <div class="col-md-4">
            <b>Valor a pagar</b> 
        </div>
        <div class="col-md-4">

        </div>
        <div class="col-md-4">
        </div>
    </div>-->
    <div class="row filters">                 
        <div class="col-md-4">
            <b>Pagar total *</b><br/>
        </div>
        <div class="col-md-2">  
            <?php echo set_input_checkbox(null,"Pagar_todo",null,false,null) ?>
        </div>
        <div clas="col-md-6">
            <?php set_input("monto",@$row,$placeholder='Valor a pagar',true,"form-control money text-right validar");?>                        
        </div>
        <div class="offset-md-4 col-md-6 advertencia"></div>                    
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2">
                   Salario Básico
                </div>
                <div class="col-md-4 text-right">
                    <b>
                        <?php
                            $salario_var    =$json->salario_var;
                            echo $salario_var;
                            $recalcular_prima_semestral = $total_liquidacion_ingresos   = (int)str_replace(".","",$salario_var);
                        ?>
                    </b>
                </div>
                <div class="col-md-3 ">
                    Aux. E.P.S
                </div>
                <div class="col-md-3 text-right">
                    <b>
                        <?php 
                            $eps=$json->aux_eps;
                            echo $eps;
                        ?>
                    </b>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                   Aux. Transporte
                </div>
                <div class="col-md-4 text-right">
                    <b>
                       <?php
                            /*AUXILO DE TRANSPORTE*/
                            echo $json->escala_salario; 
                        ?>
                    </b>
                </div>
                <div class="col-md-3 ">
                     Aux. A.R.L
                </div>
                <div class="col-md-3 text-right">
                    <b>
                        <?php 
                            echo $json->aux_arl;
                        ?>
                    </b>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                   Bonificación
                </div>
                <div class="col-md-4 text-right">
                    <b>
                       <?php 
                            echo $json->aux_bonificacion;
                        ?>
                    </b>
                </div>
                 <div class="col-md-3 ">
                    Aux. Caja Compensación
                </div>
                <div class="col-md-3 text-right">
                    <b>
                    <?php 
                        echo $json->aux_aux;
                    ?>
                    </b>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 ">
                    Otros Ingresos
                </div>
                <div class="col-md-3 text-right">
                    <b>
                        <?php 
                            echo        $json->ortros_ingresos;
                        ?>
                    </b>
                </div>
                <div class="col-md-3">
                    Ahorro Semestral (<?php echo format(@$json->escala_prima_porcentaje,true)?>%)
                </div>
                <div class="col-md-3 text-right">
                    <b>
                        <?php 
                            echo $json->total_ahorro_prima;
                        ?>
                    </b>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 ">
                    <b>Total Liquidación de Ingresos</b>
                </div>
                <div class="col-md-3 text-right">
                    <b>
                        <?php echo $json->totalizacion_general;?>
                    </b>
                </div>
                <div class="col-md-2">
                    <b>
                        Total Beneficios
                    </b>
                </div>
                <div class="col-md-4 text-right">
                    <b>
                        <?php echo format(@$json->total_beneficios,false)?>
                    </b>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-2">
                    
                </div>
                <div class="col-md-4 text-right">
                    
                </div>
                <div class="col-md-3 "><b>
                    Total Ingresos</b>
                </div>
                <div class="col-md-3 text-right">
                    <b>
                        <?php 
                            echo $json->totalizacion_general;
                        ?>
                    </b>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-4 text-right">
                    
                </div>
                <div class="col-md-3 ">
                    Descuentos
                </div>
                <div class="col-md-3 text-right">
                    <?php 
                        echo $json->Descuentos_total_monto_cuota;
                    ?>
                </div>
            </div>
            <!--div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-4 text-right">
                    
                </div>
                <?php 
                    $subtotal   =   (   $totalizacion_general - $total_monto_cuota  );
                    
                    if(@$config->ajustar_decena==1 || @$config->porcentaje_retencion>0){
                        if(!empty($config->porcentaje_retencion)){
                            $porcentaje_retencion   =   $config->porcentaje_retencion / 100;
                        }else{
                            $porcentaje_retencion   =   0;
                        }
                        $subtotal_jorge=$subtotal  =  $subtotal - ($subtotal * $porcentaje_retencion);                                          
                    
                ?>
                    <div class="col-md-3 ">
                        <b>Subtotal</b>
                    </div>
                    <div class="col-md-3 text-right">
                        <b>
                            <?php 
                                echo $rp_honorarios_modelos["Subtotal"] =   format($total_liquidacion_ingresos - $total_monto_cuota,false);
                            ?>
                        </b>
                    </div>
                <?php 
                    }
                ?>
            </div-->
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-4 text-right">
                    
                </div>
                <div class="col-md-3 ">
                    ReteFuente (<?php echo $json->porcentaje_retencion;?>%)
                </div>
                <div class="col-md-3 text-right">
                    <?php   
                        echo $json->total_ingresosXporcentaje_retencion;
                    ?>
                </div>
            </div> 
             <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-4 text-right">
                    
                </div>
                <div class="col-md-3 ">
                    <b>Subtotal</b>
                </div>
                <div class="col-md-3 text-right">
                    <b>
                    <?php   
                        echo $json->subtotal_2;
                    ?>
                    </b>
                </div>
            </div>                                    
            <div class="row" style="display:none;">
                <div class="col-md-2">
                </div>
                <div class="col-md-4 text-right">
                    
                </div>
                
                    <div class="col-md-3 ">
                        Subtotal 1
                    </div>
                    <div class="col-md-3 text-right">
                        
                    </div>
                <?php 
                    echo @$json->subtotal1_2;
                ?>
            </div>
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-4 text-right">
                    <?php //pre($config);?>
                </div>
                <?php
                ?>
                    <div class="col-md-3 ">
                        Ajuste a la decena
                    </div>
                    <div class="col-md-3 text-right">
                    <?php   
                        echo $json->ajuste_a_la_decena_prefijo.$json->ajuste_a_la_decena_subtotal;
                    ?>
                    </div>
                <?php 
                
            ?>
            </div>
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-4 text-right">
                    
                </div>
                <div class="col-md-3 ">
                    <b>Total</b>
                </div>
                <div class="col-md-3 text-right">
                    <b>
                        <?php 
                            echo $json->ajuste_a_la_decena;
                        ?>
                    </b>
                </div>
            </div>
        </div>
    </div>         
    <div id="mensaje" class="col-md-12"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">Procesar</button>
                <a class="btn btn-warning historyback text-white">Volver</a>
            </div>                        
        </div>
    </div>  
</div>
<?php echo form_close();?>
<script>
	$(document).ready(function(){
        $('button[type="submit"]').click(function(event){
            var data = $('.validar');
            event.preventDefault();
            var input = 0;
            data.each(function(index, el) {
                if(el.value.length > 0){
                    if(el.value != "Seleccione"){
                        input += 1;
                        if(input == 3){
                            $('form').submit();
                        }
                    }else{
                        $(this).parent("div").parent("div").find('.advertencia').html('<div class="alert alert-danger" role="alert"><strong>Importante!</strong> Este campo es obligatorio.</div>');
                    }
                }else{
                    $(this).parent("div").parent("div").find('.advertencia').html('<div class="alert alert-danger" role="alert"><strong>Importante!</strong> Este campo es obligatorio.</div>');
                }
            });
        });
        $('.validar').keyup(function() {
            $(this).parent("div").parent("div").find('.advertencia').html('');
        });
        var saldo2 = '<?php echo @format($json->pago_global - $credito_pago_honorarios); ?>';
        var saldo = '<?php echo @$json->pago_global - $credito_pago_honorarios; ?>';
		$('#trans').change(function(){
            if($(this).val() == "Efectivo"){
                $(this).parent("div").parent("div").find('.advertencia').html('');
                $('#caja').show();
                $('#banco').hide().removeClass('validar');
                $('#Banco_destino').val('');
                $('#Banco_destino').removeAttr('require').removeClass('validar');
                $('#CajaDestino').addClass("validar","validar");
            }else{
                $(this).parent("div").parent("div").find('.advertencia').html('');
                $('#caja').hide();
                $('#CajaDestino').val('');
                $('#CajaDestino').removeAttr('require').removeClass('validar');
                $('#banco').show();
                $('#Banco_destino').addClass("validar","validar");
            }
        });

        $('#monto').keyup(function(){
            var monto = $('.sumar').val();
            if( parseInt(monto) > parseInt(saldo)){
                $('#mensaje').html('<div class="alert alert-danger" role="alert"><strong>Importante!</strong> No puede suparar monto asignado para este gasto.</div>');
                $('button[type="submit"]').attr("disabled","disabled");
            }else{
                $('#mensaje').html('');
                $('button[type="submit"]').removeAttr("disabled");
            }
        });
		
		var form		=	$("form#transaccion");
		var montos		=	$(".credito");
		var monto_total	=	0;
		montos.each(function(index,v){
			monto_total += parseFloat($(this).val());
		});
		$(".cuenta_contable").html(parseFloat(monto_total).toFixed(2));
		inputs	=	$(".credito");	
		inputs.each(function(index,v){
			$(this).keyup(function(){
				var montos		=	$(".credito");
				var monto_total	=	0;
				montos.each(function(index,v){
					monto_total += parseFloat($(this).val());
					if(parseFloat($(this).val())>$(this).data("default")){
						error("Error","Monto supereado");
						//alert("Monto supereado");
						$(this).val($(this).data("default"));
						$(".cuenta_contable").html(parseFloat($(this).data("default")).toFixed(2));
						form.submit(function(){
							return false;
						});
					}else{
						$(".cuenta_contable").html(parseFloat(monto_total).toFixed(2));
						form.unbind();
					}					
				});
			});
		});
        $('#Pagar_todo').click(function(){
            if($(this).prop("checked")){
                $('#monto').val(saldo2);
                $('input[name="monto"]').val(saldo);
            }else{
                $('#monto').val("");
                $('input[name="monto"]').val("");
            }
        });
	})
</script>