<?php
	if(!@$this->user->id_empresa){
?>	
		<h3 class="text-center">Seleccione un Centro de Costos</h3>
<?php		
		return;	
	}		
$modulo		=	$this->ModuloActivo;
$row		=	$this->$modulo->result;
$hidden 	= 	array("redirect"=>base_url(	"Reportes/VerFactura/".$this->uri->segment(3)."/sinmarco"),
											"consecutivo"=>$row->consecutivo,
											"ciclo_de_produccion"=>$row->ciclo_de_produccion,
											"cliente_id"=>$row->cliente_id,
											"centro_de_costos"=>$row->centro_de_costos);
echo form_open(current_url(),array("id"=>"transaccion"),$hidden);	
$date = date_create($row->fecha);
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
		            	<h3><?php print($row->nombre_cliente);?></h3>
                    </div>
                </div>
			</div>
        </div>
    </div>
    <div class="row filters">
    	<div class="col-md-4">
        </div>
        <div class="col-md-4">
			<?php set_input("fecha_recibido",@$row,$placeholder='Fecha de la Transacción',$require=true,"datepicker");?>
        </div>
    </div>        
    <div class="row filters">
        <div class="col-md-12">
            <h4 class="font-weight-700 text-uppercase orange">
                Procesador de Pago 
            </h4>
        </div>
    </div>
    <div class="row" style="margin-bottom:50px;">
        <div class="col-md-2">
           Procesador(es)
        </div>
        <div class="col-md-10">
            <?php 	
					$total_facturado_dolar=0;
					$items		=	items_factura_contable($this->uri->segment(3),array("414580","130510"));
					$cuentas	=	array();
					foreach($items as $k=>$v){
						$monto_global_usd			=	@json_decode($v->json)->monto_global_usd;
						if(isset(json_decode($v->json)->monto_global_usd)){
							@$cuentas[$v->nro_cuenta]	+=	$monto_global_usd;	
						}
					}
					$items		=	items_procesadores_contable($this->uri->segment(3),array("tipo_documento"=>1));
                    foreach( $items as $k => $v){
						if(isset($cuentas[$v->nro_cuenta])){
            ?>
                        <div class="row">
                            <div class="col-md-9">
                                <input type="hidden" name="procesador_id[]" value="<?php echo $v->id_cuenta;?>" />
                                <input type="hidden" name="procesador_codigo_contable[]" value="<?php print_r($v->codigo_contable);?>" />
                                <input type="hidden" name="procesador_codigo_contable_subfijo[]" value="<?php print_r($v->codigo_contable_subfijo);?>" />
                                <?php print(entidadbancaria($v->entidad_bancaria));?> <b>(<?php print($v->nro_cuenta);?>)</b>
                            </div>
                            <div class="col-md-3 text-right">
                            	<?php
									$elmonto_original				=	number_format($cuentas[$v->nro_cuenta], 2, '.', '');
									$operaciones_debito				=	operaciones_bancos_detalle($this->uri->segment(3),$v->procesador_id,"130510",5);
									//pre($operaciones_debito);
									$operaciones_debito->credito	=	number_format($operaciones_debito->credito, 2, '.', '');
									$total_monto_dolares			=	$elmonto_original - $operaciones_debito->credito;
									$total_facturado_dolar			+=	$total_monto_dolares;
								?>
                            	<input name="total_facturado_dolar[]" value="<?php echo $v->credito;?>" id="total_facturado_dolar" placeholder="Total Comprobante"  require="1" type="hidden">
                                <input name="_default[]" value="<?php echo round($cuentas[$v->nro_cuenta] - $operaciones_debito->credito,2);?>" class="_defaults" type="hidden">
                                <input name="credito[]" <?php if(round($total_monto_dolares,2)==0){ echo 'readonly="readonly"';}?>  data-default="<?php echo  round($total_monto_dolares,2);?>"  value="<?php echo round($total_monto_dolares,2);?>" id="credito" type="text" class="form-control credito text-right format_num money__" autocomplete="off">
                            </div>
                        </div>
            <?php		
						}
                    }
            ?>
            <b>
                
            </b>
            <input id="default" value="<?php echo $total_facturado_dolar;?>" type="hidden">
        </div>
    </div>
    <div class="row filters">
        <div class="col-md-12">
            <h4 class="font-weight-700 text-uppercase orange">
                Registro Contable
            </h4>
        </div>
    </div>
    <div class="row justify-content-md-center">
    	<div class="col-md-12">
        	<table class="table table-hover">
                <thead>
                    <tr>
                        <th width="100"><b>Cuenta</b></th>
                        <th><b>Descripción</b></th>
                        <th width="100" class="text-center"><b>Débito</b></th>
                        <th width="100" class="text-center"><b>Crédito</b></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $debito		=	0;
                        $credito	=	0;
					?>                       
                    <tr>
                        <td>130510</td>
                        <td>
							<?php 
								print(get_codigo_contable("130510")->cuenta_contable);
							?>
						</td>
                        <td class="text-center">0.00</td>
                        <td id="130510" class="text-center cuenta_contable"></td>
                    </tr>
                    <tr>
                        <td>111010</td>
                        <td><?php print(get_codigo_contable("111010")->cuenta_contable);?></td>
                        <td id="111010" class="text-center cuenta_contable"></td>
						<td class="text-center">0.00</td>
                    </tr>
                </tbody>                        
            </table> 
        </div>    
    </div>
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
	})
</script>