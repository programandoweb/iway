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
		            <h4 class="font-weight-700 text-uppercase orange"> Ciclo de Producción.</h4>
                </div>
                <div class="col-md-6 text-right">
                	<a class="btn btn-primary btn-md lightbox" data-type="iframe" title="Agregar Ciclo de Pago" href="<?php echo base_url($this->uri->segment(1)."/Add_CiclosPagos")?>">
                        <i class="fa fa-plus" aria-hidden="true"></i> 
                        Agregar
                    </a>
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
					<table id="ordenar" class=" display table table-hover">
						<thead>
							<tr>
								<td><b>Período</b></td>
                                <td><b>Fecha Desde / Hasta</b></td>
                                <td width="100"><b>Estado</b></td>
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
													foreach($get_cf_ciclos_pagos as $k => $v){
														echo ($v->estado==0)?'Abierto':'Cerrado';
														echo '<br/>';
													}													
												?>
                                            </td>	
                                        </tr>
                            <?php		
									}
								}else{
							?>
								<tr>
									<td colspan="<?php echo count($ciclo);?>" class="text-center">
										No hay registros disponibles
									</td>
								</tr>
							<?php		
								}
							?>
						</tbody>
						<tfoot>
							<tr>
								<td><b>Período</b></td>
                                <td><b>Fecha Desde / Hasta</b></td>
                                <td width="100"><b>Estado</b></td>
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
