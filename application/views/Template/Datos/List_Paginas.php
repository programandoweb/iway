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
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<div class="row filters">
            	<div class="col-md-6">
		            <h4 class="font-weight-700 text-uppercase orange"> Datos Páginas.</h4>
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
								<th>Período</th>
                                <th>Fecha Desde / Hasta</th>
                                <th width="100">Ver</th>
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
                                            	Mes <?php echo mes($v->mes);?>
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
													$inc	=	1;
													foreach($get_cf_ciclos_pagos as $k => $v){
												?>
                                                	<div>
                                                		<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                        	<a class="btn btn-secondary lightbox" data-type="iframe" title="Ver Resultados <?php echo ($this->user->periodo_pagos==4)?' (S'.$inc.') ':' (Q'.$inc.') ';?>" href="<?php echo base_url($this->uri->segment(1)."/Resultado/".$this->uri->segment(3).'/'.$v->mes."/".$inc."/".$v->fecha_desde.'/'.$v->fecha_hasta);?>">
                                                            	<i class="fa fa-eye" aria-hidden="true"></i>
															</a>
														</div>
													</div>                                                        
                                                <?php		
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
