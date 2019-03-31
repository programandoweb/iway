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
		            <h4 class="font-weight-700 text-uppercase orange">Certificado comercial.</h4>
                </div>
                <div class="col-md-6 text-right">
                	<?php #btn_export();?>
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
					<table class="ordenar display table table-hover">
						<thead>
							<tr>
								<td><b>Nombre</b></td>
                                <td><b>Cargo</b></td>
                                <td width="100"><b>Ver</b></td>
							</tr>
						</thead>
						<tbody>
							<?php
								
								if(count($this->$modulo->result)>0){
									foreach($this->$modulo->result as $v){
							?>
                            			<tr>
                                        	<td>
                                            	<?php echo nombre($v);?><br />
                                                <?php echo (!empty(rol($v)))?rol($v)->rol:'No definido';?>
                                            </td>
                                            <td>
                                            	<?php echo $v->cargo;?>
                                            </td>
                                            <td>
                                            	<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                	<a class="btn btn-secondary" target="_blank" href="<?php echo base_url("Usuarios/generarPdfCertificadoLaboral/".$v->user_id)?>">
                                                    	<i class="fa fa-file-pdf-o" aria-hidden="true"></i>
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
                                <td><b>Cargo</b></td>
                                <td width="100"><b>Ver</b></td>
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