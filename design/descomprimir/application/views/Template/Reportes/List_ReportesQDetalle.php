<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php
	$modulo		=	$this->ModuloActivo;
	//print_r($this->$modulo->result);return;
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
       	 	<div class="row">
            	<div class="col-md-12">
					<?php
						$count			=	0;
						$ciclo			=	$this->$modulo->fields;
						$suma_token			=	0;
						$suma_equivalencia	=	0;
					?>
					<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
						<thead>
							<tr>
								<td><b>Fecha</b></td>
                                <td class="text-right"><b>Página</b></td>
                                <td width="220" class="text-right"><b>Tokens (0.05)</b></td>
							</tr>
						</thead>
						<tbody>
							<?php
								if(count($this->$modulo->result)>0){
									foreach($this->$modulo->result as $v){
										$detalle	=	$this->Reportes->get_detalle($v->fecha);
							?>
                            			<tr>
                                        	<td>
                                            	<?php 
													print_r($v->fecha);
												?>
                                            </td>
                                            <td class="text-right">
	                                            <?php 
													foreach($detalle as $k2=>$v2){
														echo '<div>';
															print_r($v2->primer_nombre.' (<b>'.$v2->nickname.'</b>)');
														echo '</div>';	
													}													
												?>
                                            </td>
                                            <td class="text-right">
												<?php 
													foreach($detalle as $k2=>$v2){
														echo '<div>';
															echo format($v2->tokens).' ';
															$suma_equivalencia		+=	$v2->tokens;
														echo '</div>';	
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
                            	<td></td>
                                <td class="text-right"><b>Total:</b></td>
                                <td class="text-right"><b><?php echo format($suma_equivalencia).' ';?></b></td>
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
