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
	<i class="fas fa-edit" aria-hidden="true"></i>
*/?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Cuentas Bancarias.",
															'icono'=>'<i class="fas fa-piggy-bank"></i>',
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
						//pre($this->$modulo->result[0]);	
					?>
					<table class="ordenar display table table-hover">
						<thead>
							<tr>
								<th class="text-center"><b>&nbsp;&nbsp;&nbsp;&nbsp;Tercero</b></th>
                                <th class="text-center"><b>&nbsp;&nbsp;&nbsp;&nbsp;Banco</b></th>
                                <th class="text-center"><b>&nbsp;&nbsp;&nbsp;&nbsp;Tipo Cuenta</b></th>
                                <th class="text-center"><b>&nbsp;&nbsp;&nbsp;&nbsp;No Cuenta</b></th>
                                <th class="text-center"><b>&nbsp;&nbsp;&nbsp;&nbsp;Acción</b></th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(@count($this->$modulo->result)>0){
									foreach($this->$modulo->result as$k => $v){
										$json    =  json_decode($this->$modulo->result[$k]->cambio_cuentas_bancarias);
										$n = count($json);
							?>
                            			<tr>
                                        	<td class="text-center">
                                            	<?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>
                                            </td>
                                            <td class="text-center">
	                                            <?php print_r($v->entidad_bancaria);?>
                                            </td>
                                            <td class="text-center">
	                                            <?php print_r($v->tipo_cuenta);?>
                                            </td>
                                            <td class="text-center"><?php print($v->nro_cuenta);?></td>
                                            <td class="text-right">
                                            	<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                            		<?php if(!empty($v->nro_cuenta) && empty($v->contrato_id)){ ?>
	                                                    <a title="Crear Cuenta Bancaria de <?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>" href="<?php echo base_url("Usuarios/AddCuentasBancarias/".$v->user_id.'-'.$v->banco_id.'-'.$v->tipo_cuenta.'-'.$v->nro_cuenta.'/add')?>">
	                                                    	<i class="fas fa-check" aria-hidden="true"></i>
	                                                    </a>
	                                                <?php }else{ ?>
	                                                	<i class="fas fa-ban" aria-hidden="true"></i>
	                                                <?php } ?>    
                                                </div>
                                            	<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                    <a class="lightbox" data-type="iframe" title="Editar Cuenta Bancaria de <?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>" href="<?php echo base_url("Usuarios/AddCuentasBancarias/".$v->user_id.'/edit')?>">
                                                    	<i class="fas fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                	<?php if(!empty($v->contrato_id)){ ?>
                                                    <a title="Cuenta Bancaria de <?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>" href="<?php if( $n > 1){ echo base_url("Usuarios/CuentasBancarias/".$v->user_id.'/NewPDF');}else{ echo base_url("Usuarios/CuentasBancarias/".$v->user_id.'/PDF');}?>" target= "target_blank">
                                                    	<i class="fas fa-file-pdf" aria-hidden="true"></i>
                                                    </a>
                                                    <?php }else{ ?>
                                                    	<i class="fas fa-ban" aria-hidden="true"></i>
	                                                <?php } ?> 
                                                </div>
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                	<?php if(!empty($v->cambio_cuentas_bancarias)){ ?>
                                                    <a class="lightbox" data-type="iframe" title="Historial Cuenta Bancaria de <?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>" href="<?php echo base_url("Usuarios/CuentasBancarias/".$v->user_id.'/Historial')?>">
                                                    	<i class="fas fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                    <?php }else{ ?>
                                                    	<i class="fas fa-ban" aria-hidden="true"></i>
	                                                <?php } ?> 
                                                </div>
                                            </td>	
                                        </tr>
                            <?php		
									}
								}
							?>
						</tbody>
						<tfoot>
							<tr>
								<td class="text-center"><b>Nombre</b></td>
                                <td class="text-center"><b>Banco</b></td>
                                <td class="text-center"><b>Tipo Cuenta</b></td>
                                <td class="text-center"><b>No Cuenta</b></td>
                                <td class="text-center"><b>Acción</b></td>
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
