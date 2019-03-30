<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
	$modulo		=	$this->ModuloActivo;
	$ciclo		=	$this->$modulo->fields;
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<div class="row filters">
            	<div class="col-md-6">
		            <h4 class="font-weight-700 text-uppercase orange"> Otros Ingresos.</h4>
                </div>
                <div class="col-md-6 text-right">
                	<?php if(!empty($this->user->id_empresa)){?>
                    <a class="btn btn-primary btn-md lightbox" data-type="iframe" title="Agregar otros Ingresos" href="<?php echo base_url($this->uri->segment(1)."/AddOtrosIngresos")?>">
                        <i class="fa fa-plus" aria-hidden="true"></i> 
                        Agregar
                    </a>
                    <?php }?>
                </div>
           	</div>
            <div class="row">
            	<div class="col-md-12">
					<table class="ordenar display table table-hover">
						<thead>
							<tr>
								<td><b>Funcionario</b></td>
                                <td><b>Concepto</b></td>
                                <td><b>Observación</b></td>
                                <td><b>Valor</b></td>
                                <td class="text-center"><b>Recurrencia</b></td>
                                <td width="100" class="text-center"><b>Acción</b></td>
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
                                            <td>
                                            	<?php print_r($v->concepto);?>
                                            </td>
                                            <td>
                                            	<?php print_r($v->observacion);?>
                                            </td>
                                            <td>
                                            	<?php print(format($v->valor,false));?>
                                            </td>
                                            <td class="text-center">
                                            	<?php 
													if($v->recurrente==1){
														echo 'Si';	
													}else{
														echo "No";	
													}
												?>
                                            </td>
                                            <td class="text-center">
                                            	<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                    <a class="btn btn-secondary" title="Cancelar otros Ingresos <?php print_r($v->primer_nombre.' '.$v->segundo_nombre.' '.$v->primer_apellido.' '.$v->segundo_apellido);?>" href="<?php echo base_url("Usuarios/CancelarOtrosIngresos/".$v->user_id.'/'.$v->descuento_id)?>">
                                                    	<i class="fa fa-trash" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </td>	
                                        </tr>
                            <?php		
									}
								}else{
							?>
								<tr>
									<td colspan="6" class="text-center">
										No hay registros disponibles
									</td>
								</tr>
							<?php		
								}
							?>
						</tbody>
						<tfoot>
							<tr>
								<td><b>Funcionario</b></td>
                                <td><b>Concepto</b></td>
                                <td><b>Observación</b></td>
                                <td><b>Valor</b></td>
                                <td class="text-center"><b>Recurrencia</b></td>
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
