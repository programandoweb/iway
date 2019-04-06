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
		            <h4 class="font-weight-700 text-uppercase orange"> Cerrar Ciclos.</h4>
                </div>
                <div class="col-md-6 text-right">
                	<a class="btn btn-primary btn-md " href="<?php echo base_url();?>">
                    	<i class="fa fa-chevron-left" aria-hidden="true"></i> 
                        Volver
					</a>
                </div>
            </div>
            <div class="row">
            	<div class="col-md-12">
					<?php
						$colums		=	'';
						$colums		.=	'<tr>';
						$count		=	0;
						$modulo		=	$this->ModuloActivo;
						$ciclo		=	$this->$modulo->fields;
						$colums		.=	'</tr>';	
					?>
					<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
						<thead>
							<tr>
								<td>Período</td>
                                <td>Fecha Desde / Hasta</td>
                                <td width="100">Estado</td>
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
                                            	Mes <?php print_r($v->mes);?>
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
                                            <td>
                                            	<?php 
													$abierto	= 	false;
													foreach($get_cf_ciclos_pagos as $k => $v){
														
														$datetime1 	= 	date_create(date("Y-m-d"));
														$datetime2 	= 	date_create($v->fecha_hasta);
														$interval 	= 	date_diff($datetime1, $datetime2);
														if($interval->format('%R')=='-'){ 
															//echo $interval->format('%R%a');
															 															
														}
														$fecha_hasta 	= 	new DateTime($v->fecha_hasta);														
														$fecha_now    	= 	new DateTime(date("Y-m-d"));
														
														if($fecha_hasta <= $fecha_now){
															$activar	=	true;
														}else{
															$activar	=	false;
														}
														
														//echo $interval->format('%R%a');
														//echo $v->fecha_hasta;echo ' CIERRE - HOY: ';echo date("Y-m-d").' Actual '.$interval->format('%R');
														
														if($v->estado==0 &&  $activar && !$abierto){
															$abierto	=	true;
												?>
                                                            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                                <a class="btn  btn-secondary lightbox" data-type="iframe" title="Cerrar Centro de Costos" href="<?php echo base_url("Ventas/CerrarTRM/".$v->ciclos_id)?>"><i class="fa fa-check" aria-hidden="true"></i> Cerrar <?php echo $v->fecha_hasta;?></a>
                                                            </div>                                                
												<?php
														}else if($v->estado==0 &&  !$activar && !$abierto){
															echo '<div>StandBy</div>';
															$abierto	=	true;
														}else if($v->estado==0 &&  !$activar && $abierto){
															echo '<div>StandBy</div>';
															$abierto	=	true;
														}else if($v->estado==1){
															echo '<div>Cerrado</div>';	
														}
													}													
												?>
                                            </td>	
                                        </tr>
                            <?php		
									}
								}else{
							?>
								<tr>
									<td colspan="3" class="text-center">
										No hay registros disponibles
									</td>
								</tr>
							<?php		
								}
							?>
						</tbody>
						<tfoot>
							<tr>
								<td>Período</td>
                                <td>Fecha Desde / Hasta</td>
                                <td>Estado</td>
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
