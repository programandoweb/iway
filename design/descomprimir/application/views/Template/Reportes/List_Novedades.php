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
       	 	<div class="row filters">
            	<div class="col-md-6">
		            <h4 class="font-weight-700 text-uppercase orange">Novedades.</h4>
                </div>
                <div class="col-md-6 text-right">
                	<a class="btn btn-primary btn-md lightbox" title="Agregar Novedad" data-type="iframe" href="<?php echo base_url($this->uri->segment(1)."/Add_Novedad")?>"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</a>
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
						$count			=	0;
						$ciclo			=	$this->$modulo->fields;
						$suma_token			=	0;
						$suma_equivalencia	=	0;
					?>
					<table class="ordenar display table table-hover">
						<thead>
							<tr>
								<td><b>Novedad</b></td>
                                <td><b>Fecha</b></td>
                                <td width="220" class="text-center"><b>Estatus</b></td>
							</tr>
						</thead>
						<tbody>
							<?php
								if(count($this->$modulo->result)>0){
									foreach($this->$modulo->result as $v){
							?>
                            			<tr>
                                        	<td>
                                            	<?php 
													print_r($v->asunto);
												?>
                                            </td>
                                            <td>
	                                            <?php 
													print_r($v->fecha_enviado);
												?>
                                            </td>
                                            <td class="text-center">
												<?php 
													echo ($v->estado==0)?" Enviado ":" Leido ";
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
					</table>
                </div>
            </div>
        </div>
    </div>
</div>
