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
		            <h4 class="font-weight-700 text-uppercase orange"> Asignar Master.</h4>
                </div>
                <div class="col-md-6 text-right">
                	<?php if(!empty($this->user->id_empresa)){?>
                    <a class="btn btn-primary btn-md lightbox" title="Agragar Nickname" data-type="iframe" href="<?php echo base_url($this->uri->segment(1)."/AddAsignarMaster")?>">
                        <i class="fa fa-plus" aria-hidden="true"></i> 
                        Agregar
                    </a>
                   	<?php }?>
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
								<td><b>Procesador de pago</b></td>
								<td><b>Estado</b></td>
                                <td width="300" class="text-right"><b>Acción</b></td>
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
                                            	<?php
	                                            	 $masters	=	get_ListMaster($v->user_id);
	                                            	 //foreach ($masters as $k1 => $v1) {
	                                            	 //}
	                                            	 pre($masters);
                                            	?>
                                            </td>
                                            <td>
                                            	<?php
                                            		foreach($masters as $k2 => $v2){
                                            			$row = $v2->estado;
                                            			if($row==0){
                                            				echo "Inactivo<br>";
                                            			}else{
                                            				echo "Activo<br>";
                                            			}
                                            		}
                                            	?>
                                            </td>	
                                            <td class="text-right">
                                            	<?php 
													foreach($masters as $k3 => $v3){
													?>	
                                                    	<div>
                                                            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                            	<?php print_r( $v3->nombre_master ) ;	?>
                                                                <a class="btn btn-secondary lightbox" title="Editar Master" data-type="iframe" style="margin-left:20px;" href="<?php echo base_url($this->uri->segment(1)."/AddAsignarMaster/".$v2->rel_plataforma_id)?>">
                                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    <?php	
													}
												?>
                                            </td>	
                                        </tr>
                            <?php		
									}
								}else{
							?>
								<tr>
									<td colspan="2" class="text-center">
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
								<td></td>
								<td></td>
                                <td width="300" class="text-right"><b>Acción</b></td>
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
