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
	$historial = get_certificado($this->uri->segment(3),"ANY");
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
            <?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Historial certificado.",
															'icono'=>'<i class="fas fa-signal"></i>',
															"url"	=>	current_url()),
							)
						);
			?>
            <div class="row">
            	<div class="col-md-12">
					<table class="ordenar display table table-hover" ordercol="0" order="asc">
						<thead>
							<tr>
								<th><b>Consecutivo</b></th>
								<th><b>Fecha</b></th>
                                <th width="120" class="text-center"><b>Salario basico Mensual</b></th>
                                <th class="text-center"><b>Auxilio de transporte</b></th>
                                <th class="text-center"><b>Comisiones, utilidades y/o Bonificaciones, </b></th>
                                <th width="100" class="text-right"><b>Total</b></th>
                                <th width="50" class="text-center"><b>Acción</b></th>
							</tr>
						</thead>
						<tbody>
							<?php
								if(count($historial)>0){
									foreach($historial as $v){
										$json = json_decode($v->data);
							?>
                            			<tr>
                                        	<td>
                                            	<?php echo @$v->consecutivo; ?>
                                            </td>
                                            <td>
                                            	<?php echo @$json->fecha; ?>
                                            </td>
                                            <td class="text-center">
	                                            <?php echo @format($json->Salario_básico_mensual,true); ?>
                                            </td>
                                            <td class="text-center">
	                                            <?php echo @format($json->Auxilio_de_Transporte,true);?>
                                            </td>
                                            <td class="text-center">
                                            	<?php echo @format($json->Comisiones_utilidades,true);?>		
                                            </td>
                                            <td class="text-right">
                                       			<?php echo @format(($json->Salario_básico_mensual+$json->Auxilio_de_Transporte+$json->Comisiones_utilidades),true) ?>
                                            </td>
                                            <td class="text-center">
                                            	<!--<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                	<a class="" target="_blank" href="<?php echo base_url("Usuarios/generarPdfCertificadoLaboral/".$this->uri->segment(3))?>">
                                                    	<i class="fas fa-file-pdf"></i>
													</a>
												</div>-->
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
								<th><b>Consecutivo</b></th>
								<th><b>Fecha</b></th>
                                <th width="120" class="text-center"><b>Salario basico Mensual</b></th>
                                <th class="text-center"><b>Auxilio de transporte</b></th>
                                <th class="text-center"><b>Comisiones, utilidades y/o Bonificaciones, </b></th>
                                <th width="100" class="text-right"><b>Total</b></th>
                                <th width="50" class="text-center"><b>Acción</b></th>
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
