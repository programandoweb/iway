<?php

$modulo				=	$this->ModuloActivo;
$row				=	$this->$modulo->result["rows"];
$periodo_new		=	$this->$modulo->result["periodo_new"];
$ciclo_informacion	=	get_cf_ciclos_pagos_new($this->user->id_empresa,0);
$fecha		=	@$ciclo_informacion->fecha_hasta;
if(!empty(periodotrm($fecha))){
	$periodotrm		=	periodotrm($fecha)->monto;
}else{
	$periodotrm		=	trm_vigente(true);
}
//pre($this->$modulo->result["rows"]);
if(empty($this->$modulo->result["rows"])){
	echo '<div class="text-center">Vacío</div>';
	return;
}
?>
<input id="fecha_emision" type="hidden" name="fecha_emision" value="" class="form-control datepicker" />
<input type="hidden" name="trm" placeholder="TRM" value="<?php echo $periodotrm;?>" />
<table id="ordenar" class="ordenar display table table-hover" data-url="<?php echo current_url()?>" ordercol=1 order="asc">
	<thead>
    	<th>Modelo</th>
        <th>Usuarios</th>
        <th width="140" class="text-center">Equivalencia</th>
        <th width="140" class="text-center">Producción</th>
        <th width="140" class="text-right">Monto</th>
    </thead>
    <tbody>
    	<?php 
			//pre($row);
			$total_tokens=0;
			$total_dolares=0;
			$total_pesos=0;
			$total_tokens_x_banco=array();
			$total_tokens_x_usd=array();
			$id_unico=0;
			if(!empty($row)	&& !empty($periodo_new)){
				foreach($row as $k	=>	$v){
					$periodo_pagos	=	$v->periodo_pagos;
					$id_unico++;	
					$cliente_id		=	$v->id_plataforma;
			?>
                    <tr>
                        <td>
                            <b style="font-size:10px;"><?php print(nombre($v));?></b>
                        </td>
                        <td>
                            <div><?php print($v->nickname);?></div>
                        </td>
                        <td>
                            <input maxlength="5" type="text" id="equi_<?php print($v->nickname_id);?>" data-rel="<?php print($v->nickname_id);?>" name="equivalencia[]" value="<?php print(str_replace(",",".",$v->equivalencia));?>"   class="form-control tokens llenar text-center" />					
                        </td>
                        <td >
                        	<?php 	if($v->moneda_de_pago=='Tokens'){?>
                            			<input type="text" id="input_<?php print($v->nickname_id);?>" data-rel="<?php print($v->nickname_id);?>" name="tokens[]"  value="0" class="form-control tokens text-right suma-tokens" />
                            <?php 	}else{
							?>
                            			<input type="text" id="input_<?php print($v->nickname_id);?>" data-rel="<?php print($v->nickname_id);?>" name="tokens[]"  value="0" class="form-control tokens text-right suma-tokens money" />
                            <?php
									}
							?>
                            
                            <input id="total_dolar<?php print($v->nickname_id);?>" name="total_dolar[]" value="0" type="hidden" class="total_dolar">
                            <input id="total_dolar_sin_formato<?php print($v->nickname_id);?>" name="total_dolar_sin_formato[]" value="0" type="hidden" class="total_dolar_sin_formato">
                            <input type="hidden" name="nickname[]" value="<?php print_r($v->nickname);?>" />
                            <input type="hidden" name="procesador_id[]" value="<?php print_r($v->cuenta_id);?>" />
                            <input type="hidden" name="procesador_codigo_contable[]" value="<?php print_r($v->codigo_contable);?>" />
                            <input type="hidden" name="procesador_codigo_contable_subfijo[]" value="<?php print_r($v->codigo_contable_subfijo);?>" />
                            <input type="hidden" name="plataforma_id[]" value="<?php print_r($v->id_plataforma);?>" />
                            <input type="hidden" name="nickname_id[]" value="<?php print_r($v->nickname_id);?>" />
                            <input type="hidden" name="id_master[]" value="<?php print_r($v->id_master);?>" />
                            <input type="hidden" name="abreviacion[]" value="<?php print_r($v->abreviacion);?>" />
                            <input type="hidden" name="centro_de_costos[]" value="<?php print_r($v->centro_de_costos);?>" />
                            <input type="hidden" name="master_nombre[]" value="<?php print_r($v->nombre_master);?>" />  
                            <input type="hidden" name="id_modelo[]" value="<?php print_r($v->id_modelo);?>" />
                            <input type="hidden" name="modelo_primer_nombre[]" value="<?php print_r($v->primer_nombre);?>" />
                            <input type="hidden" name="modelo_segundo_nombre[]" value="<?php print_r($v->segundo_nombre);?>" />
                            <input type="hidden" name="modelo_primer_apellido[]" value="<?php print_r($v->primer_apellido);?>" />
                            <input type="hidden" name="modelo_segundo_apellido[]" value="<?php print_r($v->segundo_apellido);?>" />
                            <input type="hidden" name="modelo_identificacion[]" value="<?php print_r($v->identificacion);?>" />
                            <input type="hidden" name="ciclo_produccion_id[]" value="<?php echo $ciclo_informacion->ciclos_id; ?>" />
                            <input type="hidden" name="format_periodo_pago[]" value="<?php print_r(get_ciclos_pagos_now());?>" />
                            <input type="hidden" name="id_empresa[]" value="<?php print_r($this->user->id_empresa);?>" />
                            <input type="hidden" name="cliente_id[]" value="<?php print_r(@$cliente_id);?>" />
                            <input type="hidden" name="periodo_pagos[]" value="<?php print_r(@$periodo_pagos);?>" />
                            <input type="hidden" id="total_dolares_sin_formato" name="total_dolares_sin_formato[]" value="<?php echo $total_dolares ; ?>" require="require" />

                            
                        </td>
                        <td class="text-right" id="monto<?php print($v->nickname_id);?>" >
                            0.00
                        </td>
                    </tr>
        <?php 
				}
			}
		?>
    </tbody>
    <tfoot>
    	<tr>
        	<td>
            </td>
			<td>
            </td>
            <td class="text-center">
            	<b>Total</b>
            </td>
        	<td>
            	
				<input readonly="readonly" class="form-control text-right" type="text" id="total_tokens" name="total_tokens" value="<?php echo $total_tokens ; ?>" require="require" />             
            </td>
        	<td>
				<input readonly="readonly" class="form-control text-right" type="text" id="total_dolares" name="total_dolares" value="<?php echo format($total_dolares) ; ?>" require="require" />                           	
            </td>
        </tr>
    </tfoot>
</table>





<script>
	$(document).ready(function(){
        $(".llenar").keyup(function() {
            var val = $(this).val()
            $(".llenar").val(val);
        });
		$( ".datepicker" ).datepicker();
		$( ".datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
		$( ".datepicker" ).datepicker({changeMonth: true,changeYear: true,showOtherMonths: true,selectOtherMonths: true});
		$( "#fecha_emision" ).val("<?php echo $fecha;?>");
		$(".tokens").keyup(function(){
			var total_dolares	=	0;
			var total_tokens	=	0;
			var obj				=	$(this);
			if(obj.val()==''){
				$("#input_"+obj.data("rel")).val(0);	
			}
			var calcular		=	$("#equi_"+obj.data("rel")).val()*$("#input_"+obj.data("rel")).val();
			$("#monto"+obj.data("rel")).html(calcular.toFixed(2));
			$("#total_dolar"+obj.data("rel")).val(calcular.toFixed(2));
			$("#total_dolar_sin_formato"+obj.data("rel")).val(calcular.toFixed(2));
			$(".total_dolar").each(function(index,v){
				var dolares		=	parseFloat($(this).val());
				total_dolares	+=	dolares;				
			});
			if(total_dolares>0){
				$("#btn-generar").show();
			}
			$("#total_dolares").val(total_dolares.toFixed(2));
			$("#total_dolares_sin_formato").val(total_dolares);	
			
			$(".suma-tokens").each(function(index,v){
				total_tokens	+=	parseFloat($(this).val());
			});
			$("#total_tokens").val(total_tokens);	
		});
	});
</script>