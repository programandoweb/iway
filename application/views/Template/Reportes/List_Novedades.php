<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php
	$modulo		=	$this->ModuloActivo;
	//pre($this->$modulo->result);return;
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
    		<?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Novedades Modelos",
															"icono"	=>	'<i class="fas fa-newspaper"></i>',
															"url"	=>	current_url()),
									"add"		=>	array(	"title"	=>	"Agregar",
															"url"	=>	base_url($this->uri->segment(1)."/Add_Novedad"),
															"lightbox"=>true),						
							)
						);
			?>
        	<div class="row">
            	<div class="col-md-12">
					<?php
						$count			=	0;
						$ciclo			=	$this->$modulo->fields;
						$suma_token			=	0;
						$suma_equivalencia	=	0;
					?>
					<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
						<thead>
							<tr>
								<th><b>Nombre</b></th>
								<th><b>Novedad</b></th>
                                <th><b>Fecha</b></th>
                                <th width="220" class="text-center"><b>Estatus</b></th>
                                <th width="220" class="text-center"><b>Acción</b></th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(count($this->$modulo->result)>0){
									foreach($this->$modulo->result as $v){
							?>
                            			<tr>
                            				<td>
                            					<?php echo $v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido; ?>
                            				</td>
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
                                            <td class="text-center" style="vertical-align: middle;">
                                            	<a href="<?php echo 'Reportes/Add_Novedad/'.$v->novedades_id;?>" class="lightbox" data-type="iframe" title="Comentar Novedad Nro <?php echo $v->novedades_id;?>" >
													<i class="far fa-comments"></i>
												</a>
                                            	<a href="<?php echo current_url().'/'.$v->novedades_id;?>" class="lightbox" data-type="iframe" title="Detalle de la Novedad Nro <?php echo $v->novedades_id;?>" >
													<i class="fas fa-eye"></i>
												</a>                                            
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
                </div>
            </div>
        </div>
    </div>
</div>
