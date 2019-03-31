<?php

?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
            <?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Asociados.",
															"icono"	=>	'<i class="fas fa-users"></i>',
															"url"	=>	current_url()),
															"add"		=>	array(	"title"	=>	"Agregar ".$this->uri->segment(3),
															"url"	=>	base_url($this->uri->segment(1)."/Add_Todos/Asociado"),
															"lightbox"=>true),
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
					?>
					<table class="ordenar display table table-hover">
						<thead>
							<tr>
								<th><b>Nombre</b></th>
                                <th width="120" class="text-center"><b>Contratación</b></th>
                                <th  class="text-center"><b>Días</b></th>
                                <th class="text-center"><b>EPS</b></th>
                                <th width="80" class="text-center"><b>Acción</b></th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(@count($this->$modulo->result)>0){
									foreach($this->$modulo->result as $v){
										
							?>
                            			<tr>
                                        	<td>
                                            	<?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>
                                            </td>
                                            
                                            <td class="text-center">
	                                            <?php print_r($v->fecha_contratacion);?>
                                            </td>
                                            <td class="text-center">
	                                            <?php contar_dias($v->fecha_contratacion);?>
                                            </td>
                                            <td><?php print_r($v->eps);?></td>
                                            <td class="text-center">
                                            	<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                	
                                                    <a class=" lightbox" data-type="iframe" title="Seguridad Social <?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>" href="<?php echo base_url("Usuarios/Add_Todos/Clientes/".$v->user_id.'Asociados')?>">
                                                    	<i class="fas fa-edit" aria-hidden="true"></i>
                                                    </a>
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