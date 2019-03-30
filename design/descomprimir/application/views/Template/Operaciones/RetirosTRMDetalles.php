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
	$trm				=	$row['trm'];
	$cuenta_contable	=	$row['cuenta_contable'];
?>

<div class="container" style="margin-bottom:100px;">
    <div class="mb-4 col-md-12">
        <?php echo submenu('Retiros TRM','Retiros TRM');?>
    </div>
	<div class="row justify-content-md-center">
    	<div class="col">
        	<div class="row">
                <div class="col-md-12">
                    <b>
                        <?php print($trm->Entidad); ?>
                    </b>
                </div>
            	<div class="col-md-3">
		           IMC
                </div>
                <div class="col-md-3">
                    <b>
	                    <?php 
							print($trm->cajero_identificacion);
						?>
                    </b>
                </div>
                <div class="col-md-3">
                	Fecha
                </div>
                <div class="col-md-3 text-right">
                	<b>
						<?php 
                            print($trm->fecha_transaccion);
                        ?>
                    </b>
                </div>
            </div>
            <div class="row">
            	<div class="col-md-3">
		           Nro. Transacción
                </div>
                <div class="col-md-3">
                    <b>
	                    <?php 
							print($trm->nro_transaccion);
						?>
                    </b>
                </div>
                <div class="col-md-3">
                	Ciclo de Producción
                </div>
                <div class="col-md-3 text-right">
                	<b>
						<?php 
                            print($trm->ciclo_de_produccion);
                        ?>
                    </b>
                </div>
            </div>
            <div class="row">
            	<div class="col-md-3">
		           Valor Retiro
                </div>
                <div class="col-md-3">
	                <b>$<?php print(format($trm->valor_retiro,false));?></b>
                </div>
                <div class="col-md-3">
                	USD Cargado
                </div>
                <div class="col-md-3 text-right">
                	<b><?php print(format($trm->usd_cargado,true));?></b>
                </div>
                <div class="col-md-6">
                    Procesador de Pago:
                </div>
                <div class="col-md-6">
                    <?php print($trm->entidad_bancaria); ?>
                    <b>(<?php print($trm->nro_cuenta); ?>)</b>
                </div>
            </div>
		</div>
	</div>
    <div style=" width:100%; height:20px;"></div>  
	<div class="row filters">
        <div class="col-md-12">
            <h4 class="font-weight-700 text-uppercase orange">
                Registro Contable
            </h4>
        </div>
    </div>              
    <div class="row justify-content-md-center">
    	<div class="col-md-12">
        	<table class="tablesorter table table-hover">
                <thead>
                    <tr>
                        <td width="100"><b>Cuenta</b></td>
                        <td><b>Concepto Contable</b></td>
                        <td width="100" class="text-center"><b>Débito</b></td>
                        <td width="100" class="text-center"><b>Crédito</b></td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
						
                        $debito		=	0;
                        $credito	=	0;
						foreach($cuenta_contable as $v){
					?>                       
                        <tr>
                            <td>
								<?php
                            		print($v->codigo_contable);
								?>
                            </td>
                            <td>
								<?php 
	                                print(get_codigo_contable($v->codigo_contable)->cuenta_contable);
                                ?>
                                <?php 
									
									//echo entidad_bancaria($v);
                                ?>
                            </td>
                            <td class="text-center">
								<?php
										$debito +=$v->debito;
                                        print(format($v->debito,true));
                                ?>
                            </td>
                            <td  class="text-right">
                           	 	<?php
										$credito +=$v->credito;
                                        print(format($v->credito,true));
                                ?>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>  
                <!--tfoot>
                	<tr>
                    	<td></td>
						<td class="text-right"><b>Total:</b></td>
                        <td class="text-right"><?php echo format($debito,true);?></td>
                        <td class="text-right"><?php echo format($credito,true);?>
                        	
                        </td>
                    </tr>
                </tfoot-->  
                <input type="hidden" id="credito" value="<?php echo format($credito,true);?>" />                    
            </table> 
        </div>    
    </div>
</div>
<script>
	$(document).ready(function(){
		$(".creditos").html($("#credito").val());
		$(".recibir").remove();
	});
</script>