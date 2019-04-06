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
            	<div class="col-md-6">
		            <h4 class="font-weight-700 text-uppercase orange"><?php echo $this->ModuloActivo;?>.</h4>
                </div>
                <div class="col-md-6 text-right">
                    <a class="btn btn-primary btn-md lightbox" title="Agregar Empresa" data-type="iframe" href="<?php echo base_url($this->uri->segment(1)."/Add")?>">
                        <i class="fa fa-plus" aria-hidden="true"></i> 
                        Agregar
                    </a>
                </div>
            </div>
            <div class="row">
            	<div class="col-md-12">
					<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
						<thead>
							<tr>
                            	<td width="300"><b>Nombre Legal / Comercial</b></td>
                                <td ><b>Datos de Contacto</b></td>
                            	<td width="150"><b>Estado</b></td>
                                <td width="40" class="text-center"><b>Acción</b></td>
							</tr>
						</thead>
						<tbody>
                        	<?php 
								if(count($this->$modulo->result)>0){
									foreach($this->$modulo->result as $v){?>
                                        <tr>
                                            <td>
                                            	<?php print_r($v->nombre_legal);?>
                                            </td>
                                            <td>
                                            	<?php print_r($v->contactos);?>
                                            </td>
                                            <td>
                                            	<?php print_r($v->estado);?>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                    <a class="btn btn-secondary" title="Seleccionar Empresa" href="<?php echo base_url("Usuarios/SetCentroCostos/".$v->centro_de_costos)?>">
                                                        <i class="fa fa-building" aria-hidden="true"></i>
                                                    </a>
                                                    <a class="btn btn-secondary lightbox" title="Editar Empresa" data-type="iframe" href="<?php echo base_url("Empresas/Add/".$v->user_id)?>">
                                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    </a>
                                                    <a class="btn btn-secondary lightbox" data-type="iframe" title="Ver Empresa" href="<?php echo base_url("Empresas/Ver/".$v->user_id)?>">
                                                        <i class="fa fa-search" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>	
                            <?php 	}
								}
							?>						
						</tbody>
                        <tfood>
							<tr>
                            	<td><b>Nombre Legal / Comercial</b></td>
                                <td><b>Datos de Contacto</b></td>
                            	<td><b>Estado</b></td>
                                <td class="text-center"><b>Acción</b></td>
							</tr>
						</tfood>
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
