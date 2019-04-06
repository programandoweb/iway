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
        	<?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Otro tipo de vinculacion.",
															'icono'=>'<i class="fas fa-certificate"></i>',
															"url"	=>	current_url()),
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
					<?php 
	                    //pre($this->$modulo->result);
                    ?>
					<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
						<thead>
							<tr>
								<th><b>Nombre</b></th>
                                <th><b>Cargo</b></th>
                                <th width="30">Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?php
								
								if(@count($this->$modulo->result)>0){
									foreach($this->$modulo->result as $v){
							?>
                            			<tr>
                                        	<td>
                                            	<?php echo nombre($v);?><br />
                                            </td>
                                            <td>
                                            	<?php echo $v->cargo;?>
                                            </td>
                                            <td class="text-center">
                                            	<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                	<a target="_blank" href="<?php echo base_url("Usuarios/generarPdfCertificadoLaboral/".$v->user_id); ?>">
                                                    	<i class="fas fa-file-pdf"></i>
													</a>
												</div>
												<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                    <a class="lightbox" data-type="iframe" title="Configuración certificado <?php echo nombre($v); ?>" href="<?php echo base_url("Usuarios/setCertificado/".$v->user_id); ?>">
                                                    	<i class="fas fa-cogs" aria-hidden="true"></i>
                                                    </a>
                                                </div>
												<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                    <a title="Enviao certificado <?php echo nombre($v); ?>" href="<?php echo base_url("Usuarios/generarPdfCertificadoLaboral/".$v->user_id.'/email'); ?>">
                                                    	<i class="fas fa-envelope" aria-hidden="true"></i>
                                                    </a>
                                                </div>
												<!--<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                    <a class="lightbox" data-type="iframe" title="Historial certificado <?php echo nombre($v); ?>" href="<?php echo base_url("Usuarios/setCertificado/".$v->user_id.'/history'); ?>">
                                                    	<i class="fas fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                </div>-->
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
