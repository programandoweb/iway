<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Gestión de Ciclos.",
															"url"	=>	current_url()),
									"add"		=>	array(	"title"	=>	"Agregar Ciclo de Pago.",
															"url"	=>	base_url($this->uri->segment(1)."/Add_CiclosPagos"),
															"lightbox"=>true),	
							)
						);
			?>
            <div class="row">
            	<div class="col-md-12">
					<?php
						$modulo		=	$this->ModuloActivo;
						$ciclo		=	$this->$modulo->fields;
					?>
					<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>" ordercol=1 order="asc">
						<thead>
							<tr>
								<th>Período</th>
								<th>Fecha inicial</th>
                                <th>Fecha final</th>
                                <th class="text-center">TRM de cierre</th>              
                                <th width="100">Estado</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$anterior_ciclo					=	false;
								if(count($this->$modulo->result)>0){
									foreach($this->$modulo->result as $v){
										$get_cf_ciclos_pagos	=	get_cf_ciclos_pagos($v->mes,$v->centro_de_costos);
							?>
                            			<tr>
                                            <td style="vertical-align: middle;">
                                            	<?php echo mes($v->mes);?>
                                            </td>
                                        	<td>
                                            	<?php 
													$inc	=	1;
													
													$trm_promedio					=	0;
													foreach($get_cf_ciclos_pagos as $k => $v){
														$sum=0;
														$num_filas=0;
														if(!empty($this->Ventas->TRM_Promedio["trm_historico"])){
														foreach($this->Ventas->TRM_Promedio["trm_historico"] as $v2){
															$sum	+=	$v2->monto;	
															$num_filas ++;
														}}
														if($num_filas>0){
															$trm_promedio	= 	$sum 	/ 	$num_filas * 0.954;
														}
														$letra_periodo	= ($this->user->periodo_pagos==4)?'S'.$inc.'':'Q'.$inc.'';
														if($v->mes<10){	$mes_str='0'.$v->mes;}else{$mes_str = $v->mes;}
														$ciclo_a_cerrar[$k]				=	new stdclass;
														
														if($v->estado==0){															
															if(!$anterior_ciclo){
																$ciclo_a_cerrar[$k]->cerrar		=	true;		
																$ciclo_a_cerrar[$k]->monto		=	$trm_promedio;
																$anterior_ciclo					=	true;
															}else{
																$ciclo_a_cerrar[$k]->monto		=	$trm_promedio;
																$ciclo_a_cerrar[$k]->cerrar		=	false;		
															}
															$ciclo_a_cerrar[$k]->periodo	=	$letra_periodo.$mes_str.$v->year;
															$ciclo_a_cerrar[$k]->ciclos_id	=	$v->ciclos_id;
															$ciclo_a_cerrar[$k]->estado		=	$v->estado;															
														}else{
															$ciclo_a_cerrar[$k]->cerrar		=	false;	
															$ciclo_a_cerrar[$k]->ciclos_id	=	$v->ciclos_id;
															$ciclo_a_cerrar[$k]->estado		=	$v->estado;
														}
														
														echo '<b>('.$letra_periodo.')</b> ';
														echo $v->fecha_desde.'<br/>';
														$inc++;
													}													
												?>
                                            </td>	
                                            <td>
                                            	<?php 
													$inc	=	1;
													
													$trm_promedio					=	0;
													foreach($get_cf_ciclos_pagos as $k => $v){
														echo $v->fecha_hasta.'<br/>';
														$inc++;
													}													
												?>
                                            	
                                            </td>
                                            <td class="text-right">
                                            	<?php
													foreach($get_cf_ciclos_pagos as $k => $v){
														//pre($v);
                                            			echo format($v->TRM_Liquidacion,true).'<br/>';
                                            		}
                                            	?>
                                            </td>                                       
                                            <td>
                                            	<?php 
													$abierto	= 	true;
													foreach($ciclo_a_cerrar as $k => $v){
														//pre($v);
														if($v->cerrar){
												?>
                                                            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                                <a class="btn  btn-primary lightbox" data-type="iframe" title="Cerrar Ciclo " href="<?php echo base_url("Ventas/CerrarTRM/".$v->ciclos_id."/".$v->periodo)?>">
                                                                	<i class="fa fa-check" aria-hidden="true"></i> .
	                                                                Cerrar <?php echo $v->periodo;?>
                                                                    	<!--( TRM <?php  print(format($v->monto,true));?> ) -->
																</a>
                                                            </div>                                                
												<?php
														}else if($v->estado==0 && !$v->cerrar){
															echo '<div>StandBy</div>';
														}else if($v->estado==1){
															echo '<div>Cerrado <a href="'.base_url("Ventas/ReAbrirCiclo/".@$v->ciclos_id).'"><i class="fas fa-lock-open"></i></a></div>';	
														}
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
								<th>Período</th>
								<th>Fecha inicial</th>
                                <th>Fecha final</th>
                                <th>TRM de cierre</th>              
                                <th width="100">Estado</th>
							</tr>
						</tfoot>
					</table>
                </div>
            </div>
        </div>
    </div>
</div>
