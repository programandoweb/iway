<?php
$modulo		=	$this->ModuloActivo;
$empresa = centrodecostos($this->user->centro_de_costos)->abreviacion;
$documento = tipo_documento(6,true);
$ciclos_abiertos = get_cicloabierto()->ciclo_produccion_id;
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Monetización",
															"icono"=>'<i class="fab fa-cc-visa"></i>',
															"url"	=>	current_url()),
									"add"		=>	array(	"title"	=>	"Datos de la monetización",
															"url"	=>	base_url("Operaciones/Add_Retiro_Trm"),
															"lightbox"=>true),						
								)
							);
			?>
        	<div class="row">
            	<div class="col-md-12">
	                <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#activos" role="tab" style="margin:0px,padding:0px">
                                <i class="fas fa-angle-right"></i> Actual 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#inactivos" role="tab">
                               <i class="fas fa-angle-right"></i>  General 
                            </a>
                        </li>
                    </ul>
					<?php
						$modulo		=	$this->ModuloActivo;
					?>
                    <div class="tab-content row">
    					<div class="tab-pane active col-md-12" id="activos" role="tabpanel">	
							<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>" ordercol=2 order="desc">
								<thead>
									<tr>
										<th><b>Fecha</b></th>
										<th width="250"><b>Monetizador</b></th>
		                                <th class="text-center"><b>Documento</b></th>
		                                <th class="text-right"><b>Valor Retirado</b></th>
		                                <th class="text-right"><b>USD</b></th>                              
		                                <th class="text-right"><b>TRM</b></th> 
									</tr>
								</thead>
								<tbody>
									<?php
										$i = 0; 
										$sum_usd=0;
										$sum_cop=0;
										$promedio_trm	=	0;
										$items = count($this->$modulo->result);
										$key = $items-1;
										$latest = "";
										$numero_lineas	=	($items>0)?$items:1;
										if($items>0){
											foreach($this->$modulo->result as $k => $v){
												$json	=	json_decode($v->json);
												if($key == $k){
													$latest = "/".$v->consecutivo;
												}
												if($v->estatus != 0 && $v->estatus != 9 && $v->ciclo_produccion_id == $ciclos_abiertos){
												
									?>
		                            			<tr>
		                                        	<td style="vertical-align: middle;">
		                                            	<?php print_r($v->fecha);?>
		                                                <?php 
															$banco	=	get_banco($json->banco_id);
														?>
		                                            </td>
		                                            <td>
		                                            	<b>
															<?php 
									                            if(!empty($json->banco_id)){
									                                echo entidadbancaria($json->banco_id);
									                            }else{
									                                echo @nombre(centrodecostos($json->Tercero));
									                            }
									                        ?>
									                    </b>
		                                            </td>
		                                            <td class="text-center" style="vertical-align: middle;">
			                                            <a href="<?php echo base_url("Operaciones/RetirosTRMDetalles/".$v->consecutivo.$latest)?>" class="lightbox documentos" data-type="iframe" data-event="reload" title="Detalle monetización" >
															<?php print_r($v->consecutivo);?>
														</a>
		                                            </td>
		                                            <td class="text-right" style="vertical-align: middle;">
		                                            	<?php 
		                                            		print_r(format($json->valor_retiro,false));
		                                            		if($v->estatus != 0){
		                                            			$sum_cop+=$json->valor_retiro;
		                                            	?>

		                                            	<input class="monto_oculto" type="hidden" value="<?php echo $json->valor_retiro; ?>">	
		                                            	<?php
		                                            		}else{
		                                            	?>
		                                            	<input class="monto_oculto" type="hidden" value="0">
		                                            	<?php		
		                                            		}
		                                            	?>	
		                                            </td>
		                                            <td class="text-right" style="vertical-align: middle;">
														<?php 
															print_r(format($json->usd_cargado,true));
															if($v->estatus != 0){
		                                            			$sum_usd+=$json->usd_cargado;
														?>
														<input class="monto_oculto2" type="hidden" value="<?php echo $json->usd_cargado; ?>">
		                                            	<?php
		                                            		}else{
		                                            	?>
		                                            	<input class="monto_oculto2" type="hidden" value="0">
		                                            	<?php		
		                                            		}
		                                            	?>	
													</td>											
		                                            <td class="text-right" style="vertical-align: middle;">
														<?php 
															print format($json->trm,true);
															if($v->estatus != 0){ 
																$promedio_trm	+=	$json->trm;
																$i++;
														?>					
														<input class="monto_oculto3" type="hidden" value="<?php echo $json->trm; ?>">
		                                            	<?php
		                                            		}else{
		                                            	?>
		                                            	<input class="monto_oculto3" type="hidden" value="0">
		                                            	<?php		
		                                            		}
		                                            	?>						
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
									<tr>
										<td></td>
										<td></td>
		                                <td class="text-center"><b>Total</b></td>
		                                <td id="total_general" width="150" class="text-right"><b><?php echo format($sum_cop,false);?></b></td>
		                                <td id="total_general2" width="150" class="text-right"><b><?php echo format($sum_usd,true);?></b></td>
		                                <td id="total_general3" class="text-right"><b>
		                                	<?php
		                                		if($promedio_trm == 0 || $i == 0){
		                                			echo "0.00";
		                                		}else{
		                                			echo format($promedio_trm / $i,true);
		                                		}
		                                	?>
		                                    </b>
		                                </td>  
									</tr>
								</tfoot>
							</table>
						</div>
                        <div class="tab-pane  col-md-12" id="inactivos" role="tabpanel">
							<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>" ordercol=2 order="desc">
								<thead>
									<tr>
										<th><b>Fecha</b></th>
										<th width="250"><b>Monetizador</b></th>
		                                <th class="text-center"><b>Documento</b></th>
		                                <th class="text-right"><b>Valor Retirado</b></th>
		                                <th class="text-right"><b>USD</b></th>                              
		                                <th class="text-right"><b>TRM</b></th> 
									</tr>
								</thead>
								<tbody>
									<?php
										$i = 0; 
										$sum_usd=0;
										$sum_cop=0;
										$promedio_trm	=	0;
										$items = count($this->$modulo->result);
										$key = $items-1;
										$latest = "";
										$numero_lineas	=	($items>0)?$items:1;
										if($items>0){
											foreach($this->$modulo->result as $k => $v){
												$json	=	json_decode($v->json);
												if($key == $k){
													$latest = "/".$v->consecutivo;
												}
												if($v->estatus != 0 && $v->estatus != 9){
												
									?>
		                            			<tr>
		                                        	<td style="vertical-align: middle;">
		                                            	<?php print_r($v->fecha);?>
		                                                <?php 
															$banco	=	get_banco($json->banco_id);
														?>
		                                            </td>
		                                            <td>
		                                            	<b>
															<?php 
									                            if(!empty($json->banco_id)){
									                                echo entidadbancaria($json->banco_id);
									                            }else{
									                                echo @nombre(centrodecostos($json->Tercero));
									                            }
									                        ?>
									                    </b>
		                                            </td>
		                                            <td class="text-center" style="vertical-align: middle;">
			                                            <a href="<?php echo base_url("Operaciones/RetirosTRMDetalles/".$v->consecutivo.$latest)?>" class="lightbox documentos" data-type="iframe" data-event="reload" title="Detalle monetización" >
															<?php print_r($v->consecutivo);?>
														</a>
		                                            </td>
		                                            <td class="text-right" style="vertical-align: middle;">
		                                            	<?php 
		                                            		print_r(format($json->valor_retiro,false));
		                                            		if($v->estatus != 0){
		                                            			$sum_cop+=$json->valor_retiro;
		                                            	?>

		                                            	<input class="monto_oculto" type="hidden" value="<?php echo $json->valor_retiro; ?>">	
		                                            	<?php
		                                            		}else{
		                                            	?>
		                                            	<input class="monto_oculto" type="hidden" value="0">
		                                            	<?php		
		                                            		}
		                                            	?>	
		                                            </td>
		                                            <td class="text-right" style="vertical-align: middle;">
														<?php 
															print_r(format($json->usd_cargado,true));
															if($v->estatus != 0){
		                                            			$sum_usd+=$json->usd_cargado;
														?>
														<input class="monto_oculto2" type="hidden" value="<?php echo $json->usd_cargado; ?>">
		                                            	<?php
		                                            		}else{
		                                            	?>
		                                            	<input class="monto_oculto2" type="hidden" value="0">
		                                            	<?php		
		                                            		}
		                                            	?>	
													</td>											
		                                            <td class="text-right" style="vertical-align: middle;">
														<?php 
															print format($json->trm,true);
															if($v->estatus != 0){ 
																$promedio_trm	+=	$json->trm;
																$i++;
														?>					
														<input class="monto_oculto3" type="hidden" value="<?php echo $json->trm; ?>">
		                                            	<?php
		                                            		}else{
		                                            	?>
		                                            	<input class="monto_oculto3" type="hidden" value="0">
		                                            	<?php		
		                                            		}
		                                            	?>						
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
									<tr>
										<td></td>
										<td></td>
		                                <td class="text-center"><b>Total</b></td>
		                                <td id="total_general" width="150" class="text-right"><b><?php echo format($sum_cop,false);?></b></td>
		                                <td id="total_general2" width="150" class="text-right"><b><?php echo format($sum_usd,true);?></b></td>
		                                <td id="total_general3" class="text-right"><b>
		                                	<?php
		                                		if($promedio_trm == 0 || $i == 0){
		                                			echo "0.00";
		                                		}else{
		                                			echo format($promedio_trm / $i,true);
		                                		}
		                                	?>
		                                    </b>
		                                </td>  
									</tr>
								</tfoot>
							</table>
                        </div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
