<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
	
	Agregar
	<i class="fa fa-plus" aria-hidden="true"></i>
	Ver
	<i class="fa fa-search" aria-hidden="true"></i>
	Editar
	<i class="fa fa-pencil" aria-hidden="true"></i>
*/?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<div class="row filters">
            	<div class="col-md-6">
		            <h4 class="font-weight-700 text-uppercase orange"> Asignar Nickname.</h4>
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
                                <td><b>Datos de Contacto</b></td>
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
                                            	<?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>
                                            </td>
                                            <td>
	                                            <?php print_r($v->email);?>
                                            </td>
                                            <td class="text-right">
                                            	<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                	<?php if($this->user->type=='root' || $this->user->type=='CentroCostos'){?>
                                                        <a class="btn btn-secondary" title="Asignar Modelo" href="<?php echo base_url("Usuarios/SetPerfil/".$v->user_id."/AsignarNickname")?>">
                                                            <i class="fa fa-user-plus" aria-hidden="true"></i>
                                                        </a>
                                                    <?php }?>
                                                	<a class="btn btn-secondary lightbox" data-type="iframe" title="Agregar Nickname" href="<?php echo base_url("Usuarios/AddAsignarNickname/".$v->user_id."/new")?>">
                                                    	<i class="fa fa-plus" aria-hidden="true"></i>
                                                    </a>
                                                    <a class="btn btn-secondary lightbox" data-type="iframe" title="Ver Nickname" href="<?php echo base_url("Usuarios/verNickname/".$v->user_id)?>">
                                                    	<i class="fa fa-search" aria-hidden="true"></i>
                                                    </a>
                                                    <a class="btn btn-secondary lightbox" data-type="iframe" title="Editar Nickname" href="<?php echo base_url("Usuarios/verNickname/".$v->user_id.'/edit')?>">
                                                    	<i class="fa fa-pencil" aria-hidden="true"></i>
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
                                <td><b>Datos de Contacto</b></td>
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
