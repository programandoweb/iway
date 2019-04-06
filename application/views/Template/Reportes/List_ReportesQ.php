<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php
	$modulo		=	$this->ModuloActivo;
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
       	 	<?php 	echo TaskBar(array("name"		=>	array(	"title"	=>	"Reportes Quincenal.",
																"url"	=>	current_url())
																					
							)
						);
			?> 
        	<div class="row">
            	<div class="col-md-12">
					<?php
						$suma_token			=	0;
						$suma_equivalencia	=	0;
					?>
					<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>" ordercol=0 order="asc">
						<thead>
							<tr>
								<th><b>Ciclo</b></th>                                
                                <th><b>Periodo</b></th>
                                <th class="text-center"><b>Tokens</b></th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(count($this->$modulo->result)>0){
									foreach($this->$modulo->result as $v){
										$get_cf_ciclos_pagos	=	get_cf_ciclos_pagos($v->mes,$v->centro_de_costos);
							?>
                            			<tr>
                                        	<td>
	                                            Mes <?php echo '('.@mes($v->mes).')'; ?>
                                            </td>
                                        	<td>
                                            	<?php 
													$inc	=	1;
													foreach($get_cf_ciclos_pagos as $k => $v){
														echo ($this->user->periodo_pagos==4)?'<b>(S'.$inc.')</b> ':'<b>(Q'.$inc.')</b> ';
														echo $v->fecha_desde.' / '.$v->fecha_hasta.'<br/>';
														$inc++;
													}													
												?>
                                           </td>
                                           <td class="text-center">
												<?php 
													$inc	=	1;
													foreach($get_cf_ciclos_pagos as $k => $v){
														$total_produccion	=	$this->$modulo->get_total_tokens($v->fecha_desde,$v->fecha_hasta);
														
														$check_RQ			=	check_RQ($this->user->user_id,$v->fecha_desde,$v->fecha_hasta);
														
														if(empty($check_RQ)){
															$aprobado = "/false";
														}else{
															$aprobado = "/true";
														}

															echo '<a href="'.base_url("Reportes/PorModelosDetalle/".$this->user->user_id.'/'.$v->fecha_desde."/".$v->fecha_hasta.$aprobado).'" title="Detalle Producción de '.$v->fecha_desde.' a '.$v->fecha_hasta.'" class="btn-azul lightbox" data-type="iframe">';
															echo ($total_produccion!='0')?format($total_produccion,false):$total_produccion;
														if(empty($check_RQ)){	
															echo '</a>';
														}
															echo '<br/>';
														$inc++;
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
					</table>
                </div>
            </div>
        </div>
    </div>
</div>
