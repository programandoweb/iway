<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php
	$modulo		=	$this->ModuloActivo;
	//pre($this->$modulo->result);return;
	$anulados = array();
	$activos   = array();
	foreach ($this->$modulo->result as $k1 => $v1) {
		if($v1->estado == 9){
			$anulados[] = $v1;
		}else{
			$activos[]  = $v1;
		}
	}
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Producción Diaria.",
															"icono"=>'<i class="fas fa-bars"></i>',
															"url"	=>	current_url()),
									"add"		=>	array(	"title"	=>	"Agregar Reporte Diario",
															"url"	=>	base_url($this->uri->segment(1)."/Add_Diario"),
															"lightbox"=>true)
																					
							)
						);
			?>
       	 	<div class="row">
            	<div class="col-md-12">
					<?php
						$count			=	0;
						$ciclo			=	$this->$modulo->fields;
						$suma_token			=	0;
						$suma_equivalencia	=	0;
						$suma_token2		=	0;
						$suma_equivalencia2	=	0;
						$me					=	centrodecostos($this->user->user_id);
					?>
		<div class="bd-example bd-example-tabs" role="tabpanel">
	        <ul class="nav nav-tabs" role="tablist">
	            <li class="nav-item">
	                <a class="nav-link active" data-toggle="tab" id="Vigente-tab" href="#Vigente" role="tab" style="margin:0px,padding:0px">
	                    Activo
	                </a>
	            </li>
	            <li class="nav-item">
	                <a class="nav-link" id="Anulado-tab" data-toggle="tab" href="#Anulado" role="tab">
	                    Anulado
	                </a>
	            </li>
	        </ul>
	        <div class="tab-content col-md-12 ">
	            <div id="Vigente" class="tab-pane active row justify-content-md-center" role="tabpanel">
					<table class="ordenar display table table-hover" ordercol=1 order="desc">
						<thead>
							<tr>
								<th><b>Fecha</b></th>
                                <?php if($me->type!='Modelos'){?>
	                                <th><b>Modelo</b></th>
                                <?php }?>
                                <th class="text-center">Documento</th>
                                <th class="text-right"><b>Producción</b></th>
                                <th width="220" class="text-right"><b>Tokens (0.05)</b></th>
                                <th></th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(count($activos)>0){
									foreach($activos as $v){
										$detalle	=	$this->Reportes->get_detalle($v->fecha,$v->estado,$v->consecutivo);
										if($v->estado == 3){
											$anulado = "anulado";
										}else{
											$anulado = '';
										}
							?>
                            			<tr>
                                        	<td class="<?php echo @$anulado; ?>">
                                            	<?php 
													print_r($v->fecha);
												?>
                                            </td>
                                            <?php if($me->type!='Modelos'){?>
                                                <td class="<?php echo @$anulado; ?>">
                                                    <?php 
														
														$modelo				=	centrodecostos($detalle[0]->id_modelo);
                                                        print(nombre($modelo));
                                                        
														/*foreach($detalle as $k2=>$v2){
                                                            echo '<div>';
                                                                print_r($v2->primer_nombre);
                                                            echo '</div>';	
                                                        }*/													
                                                    ?>
                                                </td>
                                            <?php }?>
                                            <td class="text-center <?php echo @$anulado; ?>">
                                            	<a data-type="iframe" class="documentos lightbox" title="Producción Diaria <?php echo $v->consecutivo; ?>" href="<?php echo base_url("Reportes/DetalleQuincenales/".$v->fecha."/".$v->fecha."/".$v->estado.'/'.$v->consecutivo)?>">
													<?php 
                                                        print($v->consecutivo);												
                                                    ?>
                                                </a>
                                            </td>
                                            <td class="text-right <?php echo @$anulado; ?>">
												<?php 
													$monto_por_item	=	0;
													foreach($detalle as $k2=>$v2){
														$monto_por_item		+=	$v2->monto;
														//echo '<div>';
															//echo  format($v2->monto,false);
															$suma_token		+=	$v2->monto;
														//echo '</div>';	
													}	
													echo  format($monto_por_item,false);
												?>
                                            </td>
                                            <td class="text-right <?php echo @$anulado; ?>">
												<?php 
													$tokens_por_item	=	0;	
													foreach($detalle as $k2=>$v2){
														$tokens_por_item		+=	$v2->tokens;
														//echo '<div>';
															//echo format($v2->tokens,false).' ';
															$suma_equivalencia		+=	$v2->tokens;
														//echo '</div>';	
													}	
													echo  format($tokens_por_item,false);												
												?>												
                                            </td>
                                            <td class="text-center <?php echo @$anulado; ?>">
                                                <a class="ml-1" target="_blank" title="pdf" href="<?php echo base_url("Reportes/DetalleQuincenales/".$v->fecha."/".$v->fecha."/".$v->estado."/".$v->consecutivo."/PDF")?>">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>
                                                <?php
                                                	if($v->fecha == date("Y-m-d") && $v->estado != 3){
                                                ?>
                                            	<a title="Anular reporte" href="<?php echo base_url("Reportes/AnularReporte/".$v->id_modelo.'/'.$v->consecutivo)?>">
                                            		<i class="far fa-calendar-times"></i>
                                                </a>
                                                <?php
                                                	}else{
                                                ?>
                                                <i class="fas fa-ban"></i>
                                                <?php
                                                	}
                                                ?>
                                            </td>
                                        </tr>
                            <?php		
									}
								}
							?>
						
						</tbody>
                        <tfoot>
                        	<tr>
                            	<td></td>
                                <?php if($me->type!='Modelos'){?>
	                                <td></td>
                                <?php }?>
                                <td class="text-right"><b>Total:</b></td>
                                <td class="text-right"><b><?php echo format($suma_token,false);?></b></td>
                                <td class="text-right"><b><?php echo format($suma_equivalencia,false).' ';?></b></td>
                                <td></td>
                            </tr>
                        </tfoot>
					</table>
                </div>
	            <div id="Anulado" class="tab-pane row justify-content-md-center" role="tabpanel">
					<table class="ordenar display table table-hover" ordercol=1 order="desc">
						<thead>
							<tr>
								<th><b>Fecha</b></th>
                                <?php if($me->type!='Modelos'){?>
	                                <th><b>Modelo</b></th>
                                <?php }?>
                                <th class="text-center">Documento</th>
                                <th class="text-right"><b>Producción</b></th>
                                <th width="220" class="text-right"><b>Tokens (0.05)</b></th>
                                <th></th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(count($anulados)>0){
									foreach($anulados as $v2){
										$detalle2	=	$this->Reportes->get_detalle($v2->fecha,$v2->estado,$v2->consecutivo);
										if($v2->estado == 3){
											$anulado = "anulado";
										}else{
											$anulado = '';
										}
							?>
                            			<tr>
                                        	<td class="<?php echo @$anulado; ?>">
                                            	<?php 
													print_r($v2->fecha);
												?>
                                            </td>
                                            <?php if($me->type!='Modelos'){?>
                                                <td class="<?php echo @$anulado; ?>">
                                                    <?php 
														
														$modelo				=	centrodecostos($detalle2[0]->id_modelo);
                                                        print(nombre($modelo));
                                                        
														/*foreach($detalle2 as $k2=>$v2){
                                                            echo '<div>';
                                                                print_r($v2->primer_nombre);
                                                            echo '</div>';	
                                                        }*/													
                                                    ?>
                                                </td>
                                            <?php }?>
                                            <td class="text-center <?php echo @$anulado; ?>">
                                            	<a data-type="iframe" class="documentos lightbox" title="Producción Diaria <?php echo $v2->consecutivo; ?>" href="<?php echo base_url("Reportes/DetalleQuincenales/".$v2->fecha."/".$v2->fecha."/".$v2->estado.'/'.$v2->consecutivo)?>">
													<?php 
                                                        print($v2->consecutivo);												
                                                    ?>
                                                </a>
                                            </td>
                                            <td class="text-right <?php echo @$anulado; ?>">
												<?php 
													$monto_por_item	=	0;
													foreach($detalle2 as $k2=>$v2){
														$monto_por_item		+=	$v2->monto;
														//echo '<div>';
															//echo  format($v2->monto,false);
															$suma_token2		+=	$v2->monto;
														//echo '</div>';	
													}	
													echo  format($monto_por_item,false);
												?>
                                            </td>
                                            <td class="text-right <?php echo @$anulado; ?>">
												<?php 
													$tokens_por_item	=	0;	
													foreach($detalle2 as $k2=>$v2){
														$tokens_por_item		+=	$v2->tokens;
														//echo '<div>';
															//echo format($v2->tokens,false).' ';
															$suma_equivalencia2		+=	$v2->tokens;
														//echo '</div>';	
													}	
													echo  format($tokens_por_item,false);												
												?>												
                                            </td>
                                            <td class="text-center <?php echo @$anulado; ?>">
                                                <a class="ml-1" target="_blank" title="pdf" href="<?php echo base_url("Reportes/DetalleQuincenales/".$v2->fecha."/".$v2->fecha."/9/".$v2->consecutivo."/PDF")?>">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>
                                                <i class="fas fa-ban"></i>
                                            </td>
                                        </tr>
                            <?php		
									}
								}
							?>
						
						</tbody>
                        <tfoot>
                        	<tr>
                            	<td></td>
                                <?php if($me->type!='Modelos'){?>
	                                <td></td>
                                <?php }?>
                                <td class="text-right"><b>Total:</b></td>
                                <td class="text-right"><b><?php echo format($suma_token2,false);?></b></td>
                                <td class="text-right"><b><?php echo format($suma_equivalencia2,false).' ';?></b></td>
                                <td></td>
                            </tr>
                        </tfoot>
					</table>
                </div>
            </div>
        </div>
    </div>
</div>
