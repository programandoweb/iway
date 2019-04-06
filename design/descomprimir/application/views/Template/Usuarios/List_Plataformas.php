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
		            <h4 class="font-weight-700 text-uppercase orange"> Páginas de Trabajo.</h4>
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
								<td><b>Nombre</b></td>
                                <td><b>Tipo de Página | Moneda de Pago | Equivalencia</b></td>
                                <td width="100"><b>Activar</b></td>
							</tr>
						</thead>
						<tbody>
							<?php
								if(count($this->$modulo->result)>0){
									foreach($this->$modulo->result as $v){
										
							?>
                            			<tr>
                                        	<td>
                                            	<?php print_r($v->primer_nombre);?>
                                            </td>	
                                            <td>
                                            	<?php print_r($v->tipo_persona);?> | <?php print_r($v->moneda_de_pago);?> | <?php print_r($v->equivalencia);?>
                                            </td>	
                                            <td>
                                            	<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                	<a class="btn <?php if(get_rel_plataforma($v->user_id)){echo 'btn-success active';}else{echo 'btn-warning active';}?>" <?php if(!get_rel_plataforma($v->user_id)){ echo 'href="'.base_url("Usuarios/ActivarPlataforma/".$v->user_id.'/1').'"';}else{echo 'href="'.base_url("Usuarios/ActivarPlataforma/".$v->user_id.'/0').'"';}?> title="Activar Plataforma al Centro de costos" >
                                                    	<i class="fa fa-power-off" aria-hidden="true"></i>
                                                    </a>
                                                </div>
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
								<td><b>Nombre</b></td>
                                <td><b>Tipo de Página | Moneda de Pago | Equivalencia</b></td>
                                <td width="100"><b>Activar</b></td>
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
