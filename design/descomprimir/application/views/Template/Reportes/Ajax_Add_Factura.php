<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
$modulo		=	$this->ModuloActivo;
$row		=	$this->$modulo->result["rows"];
$periodo_new=	$this->$modulo->result["periodo_new"];
$fecha		=	date("Y-m-d");
if(!empty(periodotrm($fecha))){
	$periodotrm		=	periodotrm($fecha)->monto;
}else{
	$periodotrm		=	0;
}
//pre($periodotrm);
?>
<input id="fecha_emision" type="text" name="fecha_emision" value="" class="form-control datepicker" />
<input type="hidden" name="trm" placeholder="TRM" value="<?php echo $periodotrm;?>" />
<table id="ordenar" class="display table table-hover">
	<thead>
    	<th>Nicknames</th>
        <th width="140" class="text-center">Equi</th>
        <th width="140" class="text-center">TKS</th>
        <th width="140" class="text-right">USD</th>
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
			?>
                    <tr>
                        <td>
                            <div><?php print($v->nickname);?></div>
                            <b style="font-size:10px;"><?php print(nombre($v));?></b>
                        </td>
                        <td>
                            <input maxlength="5" type="text" id="equi_<?php print($v->nickname_id);?>" data-rel="<?php print($v->nickname_id);?>" name="equivalencia[]" value="<?php print(str_replace(",",".",$v->equivalencia));?>"   class="form-control tokens text-center" />					
                        </td>
                        <td >
                            <input type="number" id="input_<?php print($v->nickname_id);?>" data-rel="<?php print($v->nickname_id);?>" name="tokens[]"  value="0" class="form-control tokens text-right suma-tokens" />
                            <input id="total_dolar<?php print($v->nickname_id);?>" name="total_dolar[]" value="0" type="hidden" class="total_dolar">
                            <input id="total_dolar_sin_formato<?php print($v->nickname_id);?>" name="total_dolar_sin_formato[]" value="0" type="hidden" class="total_dolar_sin_formato">
                            <input type="hidden" name="nickname[]" value="<?php print_r($v->nickname);?>" />
                            <input type="hidden" name="nickname_id[]" value="<?php print_r($v->nickname_id);?>" />
                            <input type="hidden" name="id_master[]" value="<?php print_r($v->id_master);?>" />
                            <input type="hidden" name="abreviacion[]" value="<?php print_r($v->abreviacion);?>" />
                            <input type="hidden" name="master_nombre[]" value="<?php print_r($v->nombre_master);?>" />  
                            <input type="hidden" name="id_modelo[]" value="<?php print_r($v->id_modelo);?>" />
                            <input type="hidden" name="modelo_primer_nombre[]" value="<?php print_r($v->primer_nombre);?>" />
                            <input type="hidden" name="modelo_segundo_nombre[]" value="<?php print_r($v->segundo_nombre);?>" />
                            <input type="hidden" name="modelo_primer_apellido[]" value="<?php print_r($v->primer_apellido);?>" />
                            <input type="hidden" name="modelo_segundo_apellido[]" value="<?php print_r($v->segundo_apellido);?>" />
                            <input type="hidden" name="modelo_identificacion[]" value="<?php print_r($v->identificacion);?>" />
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
        	<td>
            	<input type="hidden" name="format_periodo_pago[]" value="<?php print_r(get_ciclos_pagos_now());?>" />
				<input readonly="readonly" class="form-control" type="text" id="total_tokens" name="total_tokens" value="<?php echo $total_tokens ; ?>" require="require" />             
            </td>
        	<td>
				<input readonly="readonly" class="form-control" type="text" id="total_dolares" name="total_dolares" value="<?php echo format($total_dolares) ; ?>" require="require" />                           	
            </td>
        </tr>
    </tfoot>
</table>
 
<input type="hidden" name="id_empresa" value="<?php print_r($this->user->id_empresa);?>" />
<input type="hidden" name="cliente_id" value="<?php print_r($periodo_new->id_empresa);?>" />
<input type="hidden" name="centro_de_costos" value="<?php print_r($periodo_new->centro_de_costos);?>" />
<input type="hidden" name="periodo_pagos" value="<?php print_r(@$periodo_pagos);?>" />
<input type="hidden" id="total_dolares_sin_formato" name="total_dolares_sin_formato" value="<?php echo $total_dolares ; ?>" require="require" />




<script>
	$(document).ready(function(){
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