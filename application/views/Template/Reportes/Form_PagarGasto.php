<?php
	if(!@$this->user->id_empresa){
?>	
		<h3 class="text-center">Seleccione un Centro de Costos</h3>
<?php		
		return;	
	}		
$modulo		=	$this->ModuloActivo;
$row		=	$this->$modulo->result;
$json       =   @json_decode($row[0]->json);
$procesadores = ResumenBancosNew(array("COP"));
$hidden 	= 	array("codigo_destino"=>233535,"nro_documento"=>$this->uri->segment(3));
echo form_open(current_url(),array("id"=>"transaccion"),$hidden);	
$date = date_create(date("Y-m-d"));
$proveedor  =   json_decode($row[0]->json);
if($proveedor->fecha_vencimiento < date("Y-m-d")){
    $dias = explode("-",$proveedor->fecha_vencimiento);
    $diferencia = abs($dias[2] - date('d'));
}else{
    $diferencia = 0;
}
foreach ($this->$modulo->result['registro_contable'] as $k => $v) {
    if($v->codigo_contable == $json->contrapartida[0] ){
        $contrapartida_529520 = $v->credito;
    }
}
$pagos      =   @pago_gasto($this->uri->segment(3));
$credito_pagos = 0;
foreach ($pagos as $key => $value) {
    $credito_pagos +=$value->credito;
}
?>
<script>
	$( function() {
		$( ".datepicker" ).datepicker({changeMonth: false,changeYear: false,minDate: new Date(<?php echo date_format($date, 'Y')?>,<?php echo (int)date_format($date, 'm')-1?>,<?php echo date_format($date, 'd')?>), maxDate: "+3M +1D"});
		$( ".datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
		$( ".datepicker" ).datepicker({changeMonth: true,changeYear: true,showOtherMonths: true,selectOtherMonths: true});
		$( "#fecha_recibido" ).val("<?php echo date("Y-m-d");?>");
	});
</script>
<div class="container" style="margin-bottom:20px;">
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3><?php print($json->nombre_legal);?></h3>
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
                <?php 
                    if(empty($row[0]->nombre_cliente)){
                        print_r(nombre($row[0]));
                    }else{
                        echo $proveedor->nombre_legal;
                        //print_r($row[0]->nombre_cliente);
                    }
                ?>
                <br />
                <?php echo $row[0]->Nit;?>
            </b>
        </div>
        <div class="col-md-2">
            Fecha Expedición<br />
            Fecha Vencimiento                   
        </div>
        <div class="col-md-4 text-right">
             <b>
             <?php 
                /*DAVID MANDÓ A CAMBIAR*/
                echo $proveedor->fecha_emision;
             ?>
            <br />
            <?php
                echo $proveedor->fecha_vencimiento;
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
                    echo $proveedor->direccion; //str_replace($row[0]->Pais,"",$row[0]->Direccion)
                ?>
            </b>
        </div>
        <div class="col-md-3 ">
           Ciclo de producción
        </div>
        <div class="col-md-3 text-right">
            <b>
                <?php echo $row[0]->ciclo_de_produccion?>
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
			<?php set_input("fecha_recibido",@$row,$placeholder='Fecha de la Transacción',$require=true,"datepicker");?>
        </div>
    </div>
    <div class="row filters">                 
    	<div class="col-md-4">
            <b>Tipo transacción *</b><br/>
        </div>
        <div class="col-md-6">  
            <?php echo MakeSelect("Tipo_transaccion",@$row->Tipo_transaccion,array("class"=>"form-control","id"=>"trans"),array("Seleccione","Transferencia","Efectivo"),true); ?>
        </div>                    
    </div>
    <div class="row filters" id="caja" style="display: none;">                    
        <div class="col-md-4">   
            <b>Caja de Destino *</b>
        </div>
        <div class="col-md-6">  
            <?php echo MakeCajas("caja_id",@$row->CajaDestino,array('class'=>'form-control','require'=>true,"id"=>"CajaDestino"));?>
        </div>                    
    </div>      
    <div class="row filters" id="banco" style="display: none;">
        <div class="col-md-4">
            <b>Procesador de Pago</b> 
        </div>
        <div class="col-md-4">
            <?php echo MakeBanco("Banco_destino",@$banco,array("class"=>"form-control","id"=>"Banco_destino"),@$procesadores,true); ?>
        </div>
        <div class="col-md-4">
        </div>
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
        <div class="col-md-6">  
            <?php echo set_input_checkbox(null,"Pagar_todo",null,false,null) ?>
        </div>                    
    </div>
    <table class="<?php if(!$this->uri->segment(3)){echo 'ordenar';}?>  display table table-hover">
    <thead>
        <tr>
            <th class="text-left">Concepto</th>
            <th class="text-center">Factura</th>
            <th class="text-center">Dias vencidos</th>
            <th width="100" class="text-center">Documento</th>
            <th width="100" class="text-right">Saldo</th>
            <th width="180" class="text-right">Abono</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            if(count($this->$modulo->result)>0){
                
                $debito=0;
                $credito=0;
                foreach($this->$modulo->result as $v){
                    if(!empty($v->tipo_documento)){
                        $decode=json_db($v->json,"decode");
        ?>
                        <tr>
                            <td style="vertical-align: middle;">
                                <?php 
                                    foreach($decode->descripcion2 as $v2){
                                        if(!empty($v2)){
                                            print($v2.'<br>');  
                                        }
                                    }
                                    //print(get_codigo_contable($v->codigo_contable)->cuenta_contable);
                                ?>
                            </td>
                            <td class="text-center" style="vertical-align: middle;">
                                <?php 
                                    foreach($decode->valor as $v2){
                                        if(!empty($v2)){
                                            echo $decode->nro_documento_ext.'<br/>';
                                        }
                                    }                                                       
                                ?>
                            </td>
                            <td style="vertical-align: middle;text-align: center;">
                                <?php
                                    echo $diferencia;
                                ?>  
                            </td>
                            <td class="text-center" style="vertical-align: middle;">
                                <?php 
                                    foreach($decode->valor as $v2){
                                        if(!empty($v2)){
                                            echo $v->consecutivo.'<br/>';
                                        }
                                    }                                                       
                                ?>
                            </td>
                            <td class="text-right" style="vertical-align: middle;">
                                <?php 
                                    echo format(($contrapartida_529520 - $credito_pagos),true);
                                ?>
                            </td>
                            <td class="text-right">
                                <?php set_input("monto",@$row,$placeholder='Valor a pagar',$require=true,"form-control money text-right");?>
                            </td>
                        </tr>
        <?php
                    }
                }
            }else{ 
         ?>
         
         <?php 
            }
         ?>
    </tbody>
    <tfoot>
    </tfoot>
</table>          
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
        var saldo = '<?php echo @$contrapartida_529520 - @$credito_pagos; ?>';
        var saldo2 = '<?php echo @format($contrapartida_529520 - @$credito_pagos,true); ?>';
		$('#trans').change(function(){
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