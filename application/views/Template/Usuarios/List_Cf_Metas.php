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
$tipo_documento = DocumentoHonorarios(53);
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Historico Meta ideal.",
															"url"	=>	current_url()),
							)
						);
			?>
            <div class="row">
            	<div class="col-md-12">
					<?php
						$modulo		=	$this->ModuloActivo;
						
						$ciclo		=	$this->$modulo->fields;
						//pre($this->$modulo->result);
						//pre(json_decode($this->$modulo->result[0]->data)); return;
					?>
					<table class="display table table-hover">
						<thead>
							<tr>
								<th><b>Tipo documento</b></th>
                                <th class="text-center"><b>Consecutivo</b></th>
                                <th><b>Responsable</b></th>
                                <th class="text-center"><b>Fecha</b></th>
                                <th class="text-center"><b>Escala</b></th>
                                <th class="text-center"><b>Meta escala</b></th>
                                <th class="text-center"><b>Meta ideal</b></th>
							</tr>
						</thead>
						<tbody>
							<?php
								$total_meta			=	0;
								$total_metaideal	=	0;
								//pre($this->$modulo->result);
								if(count($this->$modulo->result)>0){
									foreach($this->$modulo->result as $v){
										$json = json_decode($v->data);
										
							?>
                            		<?php if (isset($json->consecutivo)) {?>
									
										<tr>
                                        	<td>
                                            	<?php echo $tipo_documento->nombre; ?>
                                            </td>
                                            <td class="text-center">
                                            	<?php echo $tipo_documento->id_documento; ?>
	                                            <?php echo ceros(@$json->consecutivo); ?>
                                            </td>
                                            <td>
                                            	<?php 
                                            		echo @$json->responsable;
												?>
                                            </td>
                                            <td class="text-right">
                                            	<?php
                                            		echo @$json->fecha;
												?>
                                            </td>
                                            <td class="text-center">
                                            	<?php echo @$json->Escala; ?>
                                            </td>
                                            <td class="text-center">
                                            	<?php echo format(@$json->meta_escala,true); ?>
                                            </td>
                                            <td class="text-center">
                                            	<?php echo @format(@$json->meta_ideal); ?>
                                            </td>	
                                        </tr>
									<?php	}?>
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
