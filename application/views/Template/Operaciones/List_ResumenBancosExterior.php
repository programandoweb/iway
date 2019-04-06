<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
	$modulo		=	$this->ModuloActivo;
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<div class="row filters">
            	<div class="col-md-12">
                    <?php 
                        echo TaskBar(array("name"       =>  array(  "title" =>  "Bancos Exterior.",
                                                                    "icono" =>  '<i class="fas fa-university"></i>',
                                                                    "url"   =>  current_url()),
                                    )
                                );
                    ?>
                </div>
           	</div>
            <div class="row" id="imprimeme">
	            <div class="col-md-12"> 
                	<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
                        <thead>
                            <tr>
                                <th width="220">Cuentas Bancarias</th>
                                <th width="120" class="text-center">Tipo de Cuenta</th>
                                <th width="100" class="text-center">Transf.</th>
                                <th width="150" class="text-right">Saldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
								$sum=0;
                                if(count($this->$modulo->result['Exterior'])>0){
                                    foreach($this->$modulo->result['Exterior'] as $v){
                                        $saldo = operaciones_bancos_prueba($v->id_cuenta);
                            ?>
                                        <tr>
                                            <td>
												<?php 
													echo entidadbancaria($v->entidad_bancaria)." "; 
												?> (<b><?php print($v->nro_cuenta);?></b>)
											</td>
                                            <td class="text-center">
                                                <?php 
													//pre($banco_111010_transferncias);
													print($v->tipo_cuenta);
												?>
                                            </td>
                                            <td class="text-center">
                                            	<div id="content<?php echo $v->id_cuenta;?>" style="display:none">
                                                	<?php 	
															$hidden 			= 	array();
															echo form_open(base_url("Operaciones/Transferir/Exterior"),array('ajax' => 'true'),$hidden);
													?>
                                                	<input type="hidden" name="procesador_id_origen" class="procesador_id" value="<?php echo $v->id_cuenta;?>" />
                                                    <input type="hidden" name="procesador_origen_codigo_contable" class="procesador_origen_codigo_contable" value="<?php echo $v->codigo_contable;?>" />
                                                    <input type="hidden" name="procesador_origen_codigo_contable_subfijo" class="procesador_origen_codigo_contable_subfijo" value="<?php echo $v->codigo_contable_subfijo;?>" />
                                                    <div class="pb-2">
                                                    	<input type="text" id="monto" name="monto" class="form-control form-control-sm" placeholder="Monto Transferencia" value="<?php print($saldo);?>"/>
													</div>
                                                    <?php 
														echo listBoxSubFijoCodigoContable($this->$modulo->result['Exterior'] ,'nro_cuenta','id_cuenta',$v->id_cuenta,$v->id_cuenta);
														echo form_close();
													?>
                                                </div>
                                                
                                            	<div class="btnz-btn-link <?php echo (($saldo)==0)?'disabled':'popovers'?>" data-monto="<?php print($saldo);?>" data-procesador_id="<?php echo $v->id_cuenta;?>" data-procesador_codigo_contable="<?php echo $v->codigo_contable;?>" data-procesador_codigo_contable_subfijo="<?php echo $v->codigo_contable_subfijo;?>" data-nro_cuenta="<?php echo $v->nro_cuenta;?>" data-placement="top" data-toggle="popover" title="Transferencia de Fondos" >
                                                	<i class="fas fa-exchange-alt"></i>
                                                </div>
                                            </td>
                                            <td class="text-right">
                                            	<a href="<?php echo base_url("Operaciones/BancosDetallesContable/".$v->id_cuenta."/111010/6/11/iframe")?>" class="lightbox vin" data-type="iframe" data-event="reload" title="Detalle de Procesador <?php echo entidadbancaria($v->entidad_bancaria)." "; ?> (<b><?php print($v->nro_cuenta);?></b>)" >
												<?php 
                                                    echo format($saldo,true);
                                                    $sum	+=	$saldo;
                                                ?>
                                                </a>
											</td>
                                        </tr>
                            <?php			
                                    }
                                }else{
							?>
                            	
                            <?php		
								}
                            ?>
                        </tbody>
                        <tfoot>
                        	<tr>
                            	<th></th>
                            	<th></th>
                                <th class="text-right">Total</th>
                                <th class="text-right">
                                    <div id="total_general">
                                    	<?php echo format($sum,true);?>
                                    </div>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
    	        </div>
            </div>                
		</div>
	</div>
</div>