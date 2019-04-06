<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Asignar máster",
															'icono'=>'<i class="fas fa-user-circle"></i>',
															"url"	=>	current_url()),
									"add"		=>	array(	"title"	=>	"Agregar máster",
															"url"	=>	base_url($this->uri->segment(1)."/AddAsignarMaster"),
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
						//pre($this->$modulo->result);	
					?>
					<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
						<thead>
							<tr>
								<th><b>Plataforma</b></th>
								<th class="text-center"><b>Procesador de pago</b></th>
								<th class="text-center"><b>Estado</b></th>
                                <th class="text-center"><b>Acción</b></th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(count($this->$modulo->result)>0){
									foreach($this->$modulo->result as $v){
										
								?>
                            			<tr>
                                        	<td>
                                            	<?php print_r($v->primer_nombre);?>
                                            </td>
                                            <td class="text-center">
                                            	<?php
	                                            	 $masters	=	get_ListMaster($v->user_id);
	                                            	 foreach ($masters as $k1 => $v1) {
	                                            	 	echo $v1->nro_cuenta.'<br>';
	                                            	 }
	                                            	 //pre($masters);
                                            	?>
                                            </td>
                                            <td class="text-center">
                                            	<?php
                                            		foreach($masters as $k2 => $v2){
                                            			if($v2->estado == 0){
                                            				echo "Inactivo<br>";
                                            			}else{
                                            				echo "Activo<br>";
                                            			}
                                            		}
                                            	?>
                                            </td>	
                                            <td class="text-right">
                                            	<?php 
													foreach($masters as $k3 => $v3){
													?>	
                                                    	<div>
                                                            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                            	<?php print_r( $v3->nombre_master ) ;
                                                            	?>

                                                                <a class="lightbox" title="Editar máster" data-type="iframe" style="margin-left:20px;" href="<?php echo base_url($this->uri->segment(1)."/AddAsignarMaster/".$v->user_id."/".$v3->rel_plataforma_id)?>">
                                                                    <i class="fas fa-edit" aria-hidden="true"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    <?php	
													}
												?>
                                            </td>	
                                        </tr>
                            <?php		
									}
								}
							?>
						</tbody>
						<tfoot>
							<tr>
								<td><b>Nombre</b></td>
								<td></td>
								<td></td>
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
