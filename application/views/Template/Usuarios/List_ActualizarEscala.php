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
*/
	$escalas = get_form_control(base_url("Usuarios/configuracionEscala"),null,1);
	if(!empty($escalas)){
		$escala_por_defecto = json_decode($escalas[0]->data)->Escala_por_defecto;
	}else{
		$escala_por_defecto = "Sin asignar";
	}
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
            <?php 
				$submenu = 	array("name"		=>	array(	"title"	=>	"Actualizar Escala.",
																					'icono'=>'<i class="fas fa-signal"></i>',
																					"url"	=>	current_url()),
														   "config"	=>	array(	"title"	=>	"Configurar escala por defecto",
																					"icono"	=>	'<i class="fas fa-cogs"></i>',
																					"url"	=>	current_url().'/Configuracion',
																					"lightbox"=>true)
													);
				if($this->user->type != "Asociados" && $this->user->type != "root" ){
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
					<table class="ordenar display table table-hover" ordercol="0" order="asc">
						<thead>
							<tr>
								<th class="text-center"><b>&nbsp;&nbsp;&nbsp;&nbsp;Tercero</b></th>
                                
                                <th  class="text-center"><b>&nbsp;&nbsp;&nbsp;&nbsp;Contratación</b></th>
                                <th class="text-center"><b>&nbsp;&nbsp;&nbsp;&nbsp;Días</b></th>
                                <th class="text-center"><b>&nbsp;&nbsp;&nbsp;&nbsp;Escala de Pagos</b></th>
                                <th class="text-center"><b>&nbsp;&nbsp;&nbsp;&nbsp;Acción</b></th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(count($this->$modulo->result)>0){
									foreach($this->$modulo->result as $v){
										
							?>
                            			<tr>
                                        	<td class="text-center">
                                            	<?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>
                                            </td>
                                            
                                            <td class="text-center">
	                                            <?php print_r($v->fecha_contratacion);?>
                                            </td>
                                            <td class="text-center">
	                                            <?php contar_dias($v->fecha_contratacion);?>
                                            </td>
                                            <td class="text-center"><?php echo ($v->nombre_escala)?$v->nombre_escala:$escala_por_defecto;?></td>
                                            <td class="text-center">
                                            	<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                	
                                                    <a class="lightbox" data-type="iframe" title="Escala de Pagos para <?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>" href="<?php echo base_url("Usuarios/Add_ActualizarEscala/".$v->user_id.'/edit')?>">
                                                    	<i class="fas fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            	<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">                                          
                                                    <?php if(!empty($v->nombre_escala)){ ?>
                                                    <a class="lightbox" data-type="iframe" title="Historial Escala de Pagos para <?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>" href="<?php echo base_url("Usuarios/Add_ActualizarEscala/".$v->user_id.'/edit/historialEscala')?>">
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
								}else{
							?>
							<?php		
								}
							?>
						</tbody>
						<tfoot>
							<tr>
								<th class="text-center"><b>Tercero</b></th>
                                <th class="text-center"><b>Contratación</b></th>
                                <th class="text-center"><b>Días</b></th>
                                <th class="text-center"><b>Escala de Pagos</b></th>
                                <th class="text-center"><b>Acción</b></th>
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
