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
       	 	<div class="row filters">
            	<div class="col-md-12">
		            <h4 class="font-weight-700 text-uppercase orange">
                    	Resumen de Ventas 
					</h4>
                    <b>
                    Importante: El valor de la TRM ha sido calculado sobre la tasa representativa del mercado del día <span id="periodo">A A  A</span>, menos el 5,83% y deberá ser tomado como de referencia, para efectos contables será calculado sobre el promedio de retiros reportados.
                    </b>
                </div>
            </div>
        	<div class="row">
            	<div class="col-md-12">
					<?php
						$suma_token			=	0;
						$suma_equivalencia	=	0;
					?>
					<table class="ordenar display table table-hover">
						<thead>
							<tr>
                            	<td width="100"><b>Sucursal</b></td>
                                <td width="150"><b>Plataforma</b></td>
                            	<td width="150"><b>Nickname</b></td>
                                <td width="100" class="text-center"><b>TKS</b></td>
                                <td class="text-center"><b>Equivalencia</b></td>
                                <td class="text-center"><b>USD</b></td>
                                <td class="text-center"><b>TRM</b></td>
                                <td class="text-center"><b>PP</b></td>
                                <td class="text-center"><b>COP</b></td>
							</tr>
						</thead>
						<tbody>
							<?php
								$total_tokens=0;
								$total_dolares=0;
								$total_pesos=0;
								if(count($this->$modulo->result)>0){
									foreach($this->$modulo->result as $v){
										$periodo_pagos	=	get_periodo_pagos($v->id_empresa)->periodo_pagos;
							?>
                            			<tr>
                                        	<td class="text-center"><?php print_r($v->abreviacion);?></td>
											<td><?php print_r($v->pagina);?></td>
                                            <td><?php print_r($v->nickname);?></td>
                                            <td class="text-center"><?php print_r(format($v->tokens,false));$total_tokens=$v->tokens + $total_tokens;?></td>
                                            <td class="text-center"><?php print_r($v->equivalencia);?></td>
                                            <td class="text-center"><?php $tokens	=	floatval($v->tokens); $equivalencia	= 	floatval(str_replace(",",".",$v->equivalencia));$total_dolar	=	 $tokens * $equivalencia; echo format($total_dolar) ; $total_dolares	= $total_dolar+$total_dolares; ?></td>
                                            <td class="text-right">
												<?php 
													$trm_ciclo	=	trm_ciclo($periodo_pagos,$v->periodo_pagos,$v->mes);
													$trm		=	$trm_ciclo["trm"]->monto * 0.9417;
													echo format($trm,true);
												?>
                                            </td>
                                           	<td>
												<?php 
														echo format_periodo_pago($periodo_pagos,$v->periodo_pagos,$v->mes);
												?>
											</td>
                                            <td class="text-right">
                                            	<?php 
													$total_pesos	=	$total_pesos+ ($trm *$total_dolar);
													echo format($trm *$total_dolar,true);
												?>
                                            </td>
                                        </tr>
                            <?php		
									}
								}else{
							?>
								<tr>
									<td  colspan="5" class="text-center">
										No hay registros disponibles
									</td>
								</tr>
							<?php		
								}
							?>
						</tbody>
                        <tfoot>
                        	<tr>
                            	<td><?php #pre($trm_ciclo);?></td>
                                <td></td>
                                <td><B class="text-right">Total:</B></td>
                                <td class="text-center"><B><?php echo format($total_tokens,false);?></B></td>
                                <td></td>
                                <td class="text-right"><B ><?php echo format($total_dolares);?></B></td>
                                <td></td>
                                <td></td>
                                <td class="text-right"><B ><?php echo format($total_pesos);?></B></td>
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
<script>
	$(document).ready(function(){
		$("#periodo").html("<?php echo $trm_ciclo["periodo"];?>");
	});
</script>