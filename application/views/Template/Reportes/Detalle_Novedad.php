<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php
	$modulo		=	$this->ModuloActivo;
	$comentarios = comentarios_Novedades();
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
    		<?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Detalle Novedad",
															"icono"	=>	'<i class="fas fa-newspaper"></i>',
															"url"	=>	current_url()),
									"pdf"		=>	true,
									"excel"     =>  true,
                                    "mail"      =>  array(  "id"    =>  "mail" ),
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

								if(count($this->$modulo->result)>0){
									foreach($this->$modulo->result as $v){
					?>
					<table class="display table table-hover">
						<tbody>
                			<tr>
                				<td>Fecha presentación novedad.</td>
								<td>
                                    <?php 
										echo($v->fecha_enviado);
									?>
                                </td>
                            </tr>
                            <tr>
                            	<td>Nombre completo funcionario BELLE Colombia®</td>
                            	<td>
									<?php echo $v->primer_nombre.' '; ?>
									<?php echo $v->segundo_nombre.' '; ?>
									<?php echo $v->primer_apellido.' '; ?>
									<?php echo $v->segundo_apellido.' '; ?>
                            	</td>
                            </tr>
                            <tr>
                            	<td>
                            		Centro de costos al que perteneces.
                            	</td>
                            	<td>
                            		<?php echo $v->nombre_legal; ?>
                            	</td>
                            </tr>
                            <tr>
                            	<td>
									<b>Estado</b>
                                </td>
                                <td>
									<?php 
										echo ($v->estado==0)?" Enviado ":" Leido ";
									?>										
                                </td>
                            </tr>
                            <tr>
                            	<td>
                            		<b>Archivo adjunto</b>
                            	</td>
                            	<td>
                            		<a href="<?php echo 'Reportes/Download/'.$v->novedades_id;?>" title="Descargar Archivo" >
										<i class="fa fa-download" aria-hidden="true"></i>
									</a>
                            	</td>
                            </tr>
						</tbody>
					</table>
					<table class="display table table-hover">
						<thead>
							<tr>
								<th><b>Novedad</b></th>
                                <th width="220" class="text-center"><b>Mensaje</b></th>
							</tr>
						</thead>
						<tbody>
                			<tr>
                            	<td>
                                	<?php 
										echo($v->asunto);
									?>
                                </td>
                                <td class="text-center">
									<?php 
										echo $v->mensaje;
									?>										
                                </td>
                            </tr>
						</tbody>
					</table>
                    <?php		
							}
						}else{
					?>
					<?php		
						}
					?>
					<h3>Comentarios:</h3>
					<table class="display table table-hover">
						<thead>
							<tr>
								<th width="140"><b>Hora</b></th>
								<th width="140"><b>Usuario</b></th>
                                <th class="text-center" width="200"><b>Comentario</b></th>
                                <th width="50">Archivo Adjunto</th>
							</tr>
						</thead>
						<tbody>
					<?php 
						foreach ($comentarios as $k => $val) {
					?>
                			<tr>
                                <td>
                                	<?php echo $val->fecha_enviado; ?>
                                </td>
                            	<td>
									<?php echo $v->primer_nombre.' '; ?>
									<?php echo $v->segundo_nombre.' '; ?>
									<?php echo $v->primer_apellido.' '; ?>
									<?php echo $v->segundo_apellido.' '; ?>
                                </td>
                                <td class="text-center">
									<?php 
										echo $val->mensaje;
									?>										
                                </td>
                                <td class="text-center">
                                	<a href="<?php echo 'Reportes/Download/'.$v->novedades_id;?>" title="Descargar Archivo" >
										<i class="fa fa-download" aria-hidden="true"></i>
									</a>
                                </td>
                            </tr>
					<?php } ?>
						</tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
</div>
