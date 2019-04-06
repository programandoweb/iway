<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<div class="row filters">
            	<div class="col-md-6">
		            <h4 class="font-weight-700 text-uppercase orange"> Retiros TRM.</h4>
                </div>
                <div class="col-md-6 text-right">
                	<a class="btn btn-primary btn-md lightbox" title="Agregar Retiros TRM" data-type="iframe" href="<?php echo base_url("Operaciones/Add_Retiro_Trm")?>"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</a>
                </div>
           	</div>
            <div class="row">
            	<div class="col-md-12">
					<?php
						$modulo		=	$this->ModuloActivo;
					?>
					<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
						<thead>
							<tr>
								<td><b>Fecha</b></td>
                                <td width="180" class="text-center"><b>Documento</b></td>
                                <td class="text-center"><b>Entidad Bancaria</b></td>
                                <td width="150" class="text-right"><b>Valor Retirado</b></td>
                                <td width="150" class="text-right"><b>USD</b></td>
                                <td width="150" class="text-right"><b>TRM</td>
							</tr>
						</thead>
						<tbody>
							<?php
								$sum_usd=0;
								$sum_cop=0;
								if(count($this->$modulo->result)>0){
									foreach($this->$modulo->result as $v){
										
							?>
                            			<tr>
                                        	<td>
                                            	<?php print_r($v->fecha_transaccion);?>
                                            </td>
                                            
                                            <td class="text-center">
	                                            <a href="<?php echo base_url("Operaciones/RetirosTRMDetalles/".$v->consecutivo)?>" class="lightbox" data-type="iframe" title="Detalle de la transacción Nro <?php print($v->consecutivo);?>" >
													<?php print_r($v->consecutivo);?>
												</a>
                                            </td>
                                            <td class="text-center">
	                                           <?php print($v->Entidad);?> 
                                            </td>

                                            <td class="text-right"><?php print_r(format($v->valor_retiro,false));?></td>
                                            <td class="text-right">
												<?php 
													$sum_usd+=$v->usd_cargado;
													$sum_cop+=$v->valor_retiro;
													print_r(format($v->usd_cargado,true));
												?>
											</td>
											<td class="text-right">
												<?php 
													print format($v->trm,true); 
												?>											
											</td>
                                        </tr>
                            <?php		
									}
								}else{
							?>
								<tr>
									<td colspan="6" class="text-center">
										No hay registros disponibles
									</td>
								</tr>
							<?php		
								}
							?>
						</tbody>
                        <tfoot>
							<tr>
								<td></td>
                                <td width="180"></td>
                                <td class="text-center"><b>Total</b></td>
                                <td width="150" class="text-right"><b><?php echo format($sum_cop,true);?></b></td>
                                <td width="150" class="text-right"><b><?php echo format($sum_usd,true);?></b></td>
                                <td></td>                                
							</tr>
						</tfoot>
					</table>
					<div class="container">
						<?php 
							echo $this->pagination->create_links();
						?>
					</div>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
