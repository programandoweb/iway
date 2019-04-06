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
                            	<td><b>Página</b></td>
								<td><b>Fechas</b></td>                                
                                <td class="text-right"><b>Producción</b></td>
                                <td width="220" class="text-center"><b>Tokens</b></td>
							</tr>
						</thead>
						<tbody>
							<?php
								if(count($this->$modulo->result)>0){
									foreach($this->$modulo->result as $v){
										$detalle	=	$this->Reportes->get_quicena_detalle($v->id_plataforma);
										
							?>
                            			<tr>
                                        	<td>
	                                            <?php print_r($v->primer_nombre);?>
                                            </td>
                                        	<td>
                                            	<?php 
													foreach($detalle as $k2=>$v2){
														echo '<div>';
															print_r($v2->fecha);
														echo '</div>';	
													}													
												?>
                                            </td>
                                           
                                            <td class="text-right">
												<?php
                                                	pre($detalle);
												?>
                                            </td>
                                            <td class="text-center">
												
                                            </td>
                                        </tr>
                            <?php		
									}
								}else{
							?>
								<tr>
									<td colspan="4" class="text-center">
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
