<?php
$modulo				=	$this->ModuloActivo;
$OpcionesFactura    =   getOpcionesFactura($this->$modulo->empresa->user_id);
$prefijo 			= 	centrodecostos($this->user->centro_de_costos)->abreviacion;
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<?php 
        		$submenu = array("name"		=>	array(	"title"	=>	"Contratos Modelos.",
															"icono"	=>	'<i class="fas fa-users"></i>',
															"url"	=>	current_url()),
									"config"	=>	array(	"title"	=>	"Configuración contratos",
															"icono"	=>	'<i class="fas fa-cogs"></i>',
															"url"	=>	base_url("Configuracion/ConfiguracionContratos"),
															"lightbox"=>true)
							);
        		if($this->user->type != "root"){
        			unset($submenu['config']);
        		}
				echo TaskBar($submenu);
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
					<table class="ordenar display table table-hover ordercol="1" order="asc">
						<thead>
							<tr>
								<th><b>Nombre</b></th>
                                <th class="text-center"><b>Contratación</b></th>
                                <th class="text-center"><b>Turno</b></th>
                                <th class="text-center"><b>Sucursal</b></th>
                                <th class="text-center"><b>Consecutivo</b></th>
                                <th width="100" class="text-right"><b>Acción</b></th>
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
                                            
                                            <td class="text-center">
	                                            <?php echo $v->fecha_contratacion;?>
                                            </td>
                                            <td class="text-center">
                                            	<?php
                                            		if($v->turno_manama != 0){
                                            			echo 'Mañana';
                                            		}else if($v->turno_tarde != 0){
                                            			echo 'Tarde';
                                            		}else if($v->turno_noche != 0){
                                            			echo 'Noche';
                                            		}else if($v->turno_intermedio != 0){
                                            			echo 'Intermedio';
                                            		}
                                            	?>
                                            </td>
                                            <td class="text-center"><?php print($v->Sucursal);?></td>
                                            <td class="text-center">
												<?php
													if(!empty($v->consecutivo_id)){																			if(empty($OpcionesFactura->prefijoFacturaFac)){
																echo $prefijo;
															}else{
																echo $OpcionesFactura->prefijoFacturaFac;
															} 
														echo '-'.ceros($v->consecutivo_id);
													}  
												?>
                                            </td>
                                            <td class="text-right">
                                            	<?php if(empty($v->consecutivo_id)){ ?>
                                            	<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                            		<?php if($this->user->type == "Asociados"){ ?>
                                            		<a title="Aprobar <?php print($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>" href="<?php echo base_url("Usuarios/CrearContrato/".$this->uri->segment(2).'/'.$v->user_id)?>">
                                                    	<i class="fas fa-check" aria-hidden="true"></i>
                                                    </a>
                                                	<?php } ?>
                                                </div>
                                            	<?php }else{ ?>
                                            		<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                    	<i class="fas fa-ban"></i>
                                                	</div>
                                                <?php } ?>
	                                            <?php if(!empty($v->consecutivo_id)){ ?>
	                                            	<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
	                                                    <a title="Ver Contrato No.<?php echo $v->consecutivo_id; ?> <?php print($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>" href="<?php echo base_url("Usuarios/ContratoModelos/".$v->user_id)?>" target="_blank">
	                                                    	<i class="fas fa-file-pdf" aria-hidden="true"></i>
	                                                    </a>
	                                                </div>
	                                            <?php }else{ ?>
                                            		<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                    	<i class="fas fa-ban"></i>
                                                	</div>
                                                <?php } ?>
                                            </td>	
                                        </tr>
                            <?php		
									}
								}else{
							?>
								
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
