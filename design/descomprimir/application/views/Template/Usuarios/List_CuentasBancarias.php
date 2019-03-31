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
		            <h4 class="font-weight-700 text-uppercase orange"> Cuentas Bancarias.</h4>
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
                                <td class="text-left"><b>Banco</b></td>
                                <td class="text-center"><b>Tipo Cuenta</b></td>
                                <td class="text-center"><b>Nro Cuenta</b></td>
                                <td width="100" class="text-right"><b>Acción</b></td>
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
                                            
                                            <td class="text-left">
	                                            <?php print_r($v->entidad_bancaria);?>
                                            </td>
                                            <td class="text-center">
	                                            <?php print_r($v->tipo_cuenta);?>
                                            </td>
                                            <td class="text-center"><?php print_r($v->nro_cuenta);?></td>
                                            <td class="text-right">
                                            	<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                	
                                                    <a class="btn btn-secondary lightbox" data-type="iframe" title="Cuenta Bancaria de <?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>" href="<?php echo base_url("Usuarios/AddCuentasBancarias/".$v->user_id.'/edit')?>">
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
									<td colspan="4" class="text-center">
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
                                <td class="text-left"><b>Banco</b></td>
                                <td class="text-center"><b>Tipo Cuenta</b></td>
                                <td class="text-center"><b>Nro Cuenta</b></td>
                                <td width="100" class="text-right"><b>Acción</b></td>
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