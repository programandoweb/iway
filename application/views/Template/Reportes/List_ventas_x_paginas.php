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
            	<div class="col-md-6 submenu">
		            <h4 class="font-weight-700 text-uppercase orange">
                    	Factura de Ventas 
					</h4>
                </div>
                <div class="col-md-6">
                	<?php 
                        echo TaskBar(array("name"       =>  array(  "title" =>  "Factura de Ventas",
                                                                    "icono" =>  '<i class="fas fa-users"></i>',
                                                                    "url"   =>  current_url()),
                                                                    "pdf"   =>  true,
                                                                    "excel" =>  true,
                                                                    "mail"      =>  array(  "id"    =>  "mail" ),
                                    )
                                );
                    ?>
                </div>
            </div>
        	<div class="row" id="imprimeme">
            	<div class="col-md-12">
					<?php
						$suma_token			=	0;
						$suma_equivalencia	=	0;
					?>
					<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
						<thead>
							<tr>
                            	<th width="100"><b>Sucursal</b></th>
                                <th width="150"><b>Plataforma</b></th>
                            	<th width="150"><b>Usuario</b></th>
                                <th width="100" class="text-center"><b>TKS</b></th>
                                <th class="text-center"><b>Equivalencia</b></th>
                                <th class="text-center"><b>USD</b></th>
                                <th class="text-center"><b>TRM</b></th>
                                <th class="text-center"><b>PP</b></th>
                                <th class="text-center"><b>COP</b></th>
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
													$trm	=	(trm_ciclo($periodo_pagos,$v->periodo_pagos,$v->mes)->monto) * 0.9417;
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
								
							<?php		
								}
							?>
						</tbody>
                        <tfoot>
                        	<tr>
                            	<td></td>
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
		<?php if($regresar== true && $this->uri->segment(4)==3){?>
			$("#back").attr("href","<?php echo base_url("Reportes/ResultadoImport/Debug/2");?>");	
			$("#back").html('<i class="fa fa-refresh fa-spin fa-1x fa-fw"></i> Completar para Culminar');
		<?php }?>
	});
</script>