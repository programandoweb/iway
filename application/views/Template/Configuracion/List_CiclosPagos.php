<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/

?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
            <?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Ciclo de Producción.",
															"url"	=>	current_url()),
									"add"		=>	array(	"title"	=>	"Agregar Ciclo de Pago.",
															"url"	=>	base_url($this->uri->segment(1)."/Add_CiclosPagos"),
															"lightbox"=>true),	
							)
						);
			?>
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
								<th><b>Período</b></th>
                                <th><b>Fecha Desde / Hasta</b></th>
                                <th width="100"><b>Estado</b></th>
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
                                            	<?php echo mes($v->mes);?>
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
