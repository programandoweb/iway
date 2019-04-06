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
		            <h4 class="font-weight-700 text-uppercase orange"><i class="fas fa-users"></i> Notificaciones.</h4>
                </div>
           	</div>
            <div class="row">
            	<div class="col-md-12">
					<?php
						$modulo		=	$this->ModuloActivo;
					?>
					<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
						<thead>
							<tr>
								<th><b>Asunto</b></th>
                                <th width="10" class="text-right"><b>Acción</b></th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(count($this->$modulo->notificaciones)>0){
									foreach($this->$modulo->notificaciones as $v){
										
							?>
                            			<tr>
                                        	<td>
                                            	<?php 
													$Notificacion	=	Notificacion($v);
													print($Notificacion->tarea);
												?>
                                            </td>
                                            <td class="text-center">
                                            	<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                	<?php echo anchor('Utilidades/ViewNotification/'.$v->notificacion_id, '<i class="fas fa-eye" aria-hidden="true"></i>', array("title"=>"Ver Notificación","class"=>"lightbox","data-type"=>"iframe"));?>  
                                                </div>
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
					</table>
                </div>
            </div>
        </div>
    </div>
</div>