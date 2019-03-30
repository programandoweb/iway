<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php
	if(!@$this->user->id_empresa){
?>	
		<h3 class="text-center">Seleccione un Centro de Costos</h3>
<?php		
		return;	
	}		
$modulo		=	$this->ModuloActivo;
$row		=	$this->$modulo->result;
//pre($row->trm);return;
$hidden 	= 	array("redirect"=>base_url(	"Reportes/VerFactura/".$this->uri->segment(4)),
											"nro_documento"=>$row->nro_documento,
											"cliente_id"=>$row->cliente_id,
											"trm"=>$row->trm,
											"id_empresa"=>$row->id_empresa,
											"centro_de_costos"=>$row->centro_de_costos);
echo form_open(current_url(),array("id"=>"transaccion"),$hidden);	?>

<div class="container" style="margin-bottom:100px;">
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
					//pre($this->$modulo->result->items);
                    foreach( $this->$modulo->result->items as $k => $v){
						
            ?>
                        <div class="row">
                            <div class="col-md-9">
                                <?php 
									$registro_contable	=	get_registro_contable_credito_debito($this->uri->segment(3),'credito',$v->id_cuenta,'130510','');
									//pre($registro_contable);
								?>
                                <input type="hidden" name="procesador_id[]" value="<?php echo $v->id_cuenta;?>" />
                                <?php print_r($v->entidad_bancaria);?> <b>(<?php echo $v->nro_cuenta;?>)</b>
                            </div>
                            <div class="col-md-3 text-right">
                            	<?php
									$total_monto_dolares	=	$v->usd-$registro_contable;
								?>
                            	<input name="total_facturado_dolar[]" value="<?php echo $row->total_facturado_dolar;?>" id="total_facturado_dolar" placeholder="Total Comprobante"  require="1" type="hidden">
                                <input name="_default[]" value="<?php echo $total_monto_dolares;?>" class="_defaults" type="hidden">
                                <input name="credito[]" <?php if($total_monto_dolares==0){ echo 'readonly="readonly"';}?>  data-default="<?php echo $total_monto_dolares;?>"  value="<?php echo $total_monto_dolares;?>" id="credito" type="text" class="form-control credito text-right" autocomplete="off">
                            </div>
                        </div>
            <?php					
                    }
            ?>
            <b>
                
            </b>
            <input id="default" value="<?php echo $row->total_facturado_dolar;?>" type="hidden">
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
                        <td width="100"><b>Cuenta</b></td>
                        <td><b>Descripción</b></td>
                        <td width="100" class="text-center"><b>Débito</b></td>
                        <td width="100" class="text-center"><b>Crédito</b></td>
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
						alert("Monto supereado");
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