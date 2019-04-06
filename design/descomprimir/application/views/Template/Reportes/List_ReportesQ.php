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
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
       	 	<div class="row filters">
            	<div class="col-md-6">
		            <h4 class="font-weight-700 text-uppercase orange">Reportes Quincenal.</h4>
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
						$suma_token			=	0;
						$suma_equivalencia	=	0;
					?>
					<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
						<thead>
							<tr>
								<td><b>Ciclo</b></td>                                
                                <td><b>Página</b></td>
                                <td width="220" class="text-center"><b>Tokens</b></td>
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
														echo '<a href="'.base_url("Reportes/DetalleQuincenales/".$v->fecha_desde."/".$v->fecha_hasta).'" title="Detalle Producción de '.$v->fecha_desde.' a '.$v->fecha_hasta.'" class="lightbox" data-type="iframe">';
														echo ($this->user->periodo_pagos==4)?'<b>(S'.$inc.')</b> ':'<b>(Q'.$inc.')</b> ';
														echo $v->fecha_desde.' / '.$v->fecha_hasta.'</a><br/>';
														$inc++;
													}													
												?>
                                           </td>
                                           <td class="text-center">
												<?php 
													$inc	=	1;
													foreach($get_cf_ciclos_pagos as $k => $v){
														$total_produccion	=	$this->$modulo->get_total_tokens($v->fecha_desde,$v->fecha_hasta);
														echo '<a href="'.base_url("Reportes/DetalleQuincenales/".$v->fecha_desde."/".$v->fecha_hasta).'" title="Detalle Producción de '.$v->fecha_desde.' a '.$v->fecha_hasta.'" class="btn-azul lightbox" data-type="iframe">';
														echo ($total_produccion!='--')?format($total_produccion):$total_produccion;
														echo '</a><br/>';
														$inc++;
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
