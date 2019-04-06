<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<div class="row filters">
            	<div class="col-md-6">
		            <h4 class="font-weight-700 text-uppercase orange"> Documentos Anulados.</h4>
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
								<th><b>Tipo documento</b></th>
                                <th width="120" class="text-center"><b>Fecha</b></th>
                                <th  class="text-center"><b>Responsable creacion</b></th>
                                <th  class="text-center"><b>Responsable anulación</b></th>
                                <th class="text-center"><b>Consecutivo</b></th>
                                <th width="100" class="text-right"><b>Monto</b></th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(count($this->$modulo->result)>0){
									foreach($this->$modulo->result as $v){
										
							?>
                            			<tr>
                                        	<td>
												<?php echo tipo_documento($v->tipo_documento); ?>
                                            </td>
                                            
                                            <td class="text-center">
	                                            <?php echo $v->fecha;?>
                                            </td>
                                            <td class="text-center">
	                                            <?php echo @nombre(centrodecostos($v->responsable_id));?>
                                            </td>
                                            <td class="text-center">
	                                            <?php echo @nombre(centrodecostos($v->responsable_anular));?>
                                            </td>
					                        <td class="text-center">
					                            <?php if($v->tipo_documento == 1){ ?>
                                            		<a class="btnss btn-primaryss btn-mdss documentos lightbox" title="Factura de venta" data-type="iframe" data-event="reload" href="<?php echo base_url("Reportes/VerFactura/".$v->consecutivo."/sinmarco")?>">
                                            		<?php echo $v->consecutivo; ?></a>
					                            <?php }elseif($v->tipo_documento == 5){ ?>
                                                    <a class="documentos" title="Comprobante bancario No. <?php echo $v->consecutivo;?>" href="<?php echo base_url('Reportes/VerFactura/'.$v->consecutivo.'/detalle_contable/'.$v->nro_documento.'/iframe');?>">
                                                    <?php echo $v->consecutivo; ?></a>
					                        	<?php }elseif($v->tipo_documento== 6){?>
						                        	<a class="nav-link lightbox"  data-type="iframe" title="Comprobante Retiro TRM No. <?php echo $v->consecutivo;?>" href="<?php echo base_url("Operaciones/RetirosTRMDetalles/".$v->consecutivo)?>"><?php echo $v->consecutivo ?></a>
					                            <?php }elseif($v->tipo_documento== 9){?>
					                                <a class="nav-link vin lightbox" data-type="iframe" title="Comprobante Caja No. <?php echo $v->consecutivo;?>" href="<?php echo base_url('Operaciones/ComprobanteCaja/'.$v->consecutivo.'/'.$v->tipo_documento);?>">
					                                <?php echo $v->consecutivo ?></a>
					                            <?php }elseif($v->tipo_documento == 10){ ?>
					                                <a class="nav-link vin lightbox" data-type="iframe" title="Comprobante bancario No. <?php echo $v->consecutivo;?>" href="<?php echo base_url('Operaciones/RetirosTRMDetallesContable/'.$v->consecutivo);?>">
					                                    <?php echo $v->consecutivo; ?></a>
					                            <?php }else if($v->tipo_documento== 11){?>
					                                <a class="nav-link vin lightbox"  data-type="iframe" title="Comprobante Transferencia No. <?php echo $v->consecutivo;?>" href="<?php echo base_url('Operaciones/Transferencia/'.$v->consecutivo);?>">
					                                    <?php echo $v->consecutivo; ?></a>
					                            <?php }else if($v->tipo_documento== 13){?>
                                                	<a class="lightbox" title="Ver detalle honorario anulado" data-type="iframe" data-event="reload" href="<?php echo base_url("Usuarios/HonorariosModelo/".$v->user_id)?>">
					                                    <?php echo $v->consecutivo; ?></a>
					                            <?php }else{ ?>
					                               <a class="nav-link vin lightbox" data-type="iframe" title="Comprobante Transferencia No. <?php echo $v->consecutivo;?>" href="<?php echo base_url('Operaciones/transferencia_nacionales/'.$v->nro_documento.'/'.$v->consecutivo);?>"><?php echo $v->consecutivo ?></a>
												<?php }?>
											</td>
                                            <td class="text-right">
                                            	<?php
                                            		if($v->tipo_documento == 1){
                                            			echo format(json_decode($v->json)->monto_global_usd,true);
                                            		}else{
                                            			echo @format($v->debito,true);
                                            		}  
                                            	?>
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
								<th><b>Tipo documento</b></th>
                                <th width="120" class="text-center"><b>Fecha</b></th>
                                <th  class="text-center"><b>Responsable creacion</b></th>
                                <th  class="text-center"><b>Responsable anulación</b></th>
                                <th class="text-center"><b>Consecutivo</b></th>
                                <th width="100" class="text-right"><b>Monto</b></th>
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
