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
    		<?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Producción diaria Detalle.",
															"icono"	=>	'<i class="fas fa-users"></i>',
															"url"	=>	current_url()),
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
					?>
					<table class="ordenar display table table-hover" ordercol=0 order="desc">
						<thead>
							<tr>
								<th><b>Fecha</b></th>
                                <th class=""><b>Plataforma</b></th>
                                <th class="">Usuario</th>
                                <th width="220" class="text-right"><b>Tokens (0.05)</b></th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(count($this->$modulo->result)>0){
									foreach($this->$modulo->result as $v){
										$detalle	=	$this->Reportes->get_detalle($v->fecha,$v->estado,$v->consecutivo);
							?>
                            			<tr>
                                        	<td>
                                            	<?php 
													print_r($v->fecha);
												?>
                                            </td>
                                            <td class="">
	                                            <?php 
													foreach($detalle as $k2=>$v2){
														echo '<div>';
															print_r($v2->primer_nombre);
														echo '</div>';	
													}													
												?>
                                            </td>
                                            <td>
                                            	<?php 
													foreach($detalle as $k2=>$v2){
														echo '<div>';
														echo $v2->nickname;
														echo '</div>';
													}	
												?>
                                            </td>
                                            <td class="text-right">
												<?php 
													foreach($detalle as $k2=>$v2){
														echo '<div>';
															echo format($v2->tokens,false).' ';
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
							<?php		
								}
							?>
						</tbody>
                        <tfoot>
                        	<tr>
                            	<td></td>
                                <td></td>
                                <td class="text-right"><b>Total:</b></td>                                
                                <td class="text-right"><b><?php echo format($suma_equivalencia,false).' ';?></b></td>
                            </tr>
                        </tfoot>
					</table>
                </div>
            </div>
        </div>
    </div>
</div>
