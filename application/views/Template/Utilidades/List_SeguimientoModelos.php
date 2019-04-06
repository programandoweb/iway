<?php

$activo = array();
$inactivo = array();	
$modulo = $this->ModuloActivo;
$resumen = @resumen_seguimiento_modelos();

?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<?php
            	echo	TaskBar(array(	"name"		=>	array(	"title"	=>	"Seguimiento Modelos",
																"url"	=>	current_url()),
																"add"	=>	array(	"title"	=> "Seguimiento y evaluación Modelo.",
																"url"	=>  current_url().'/add/42',
																"lightbox"=>true),	
								)
							);
			?>
			<div class="col-md-12">
				<ul class="nav nav-tabs" role="tablist"> 
			        <li class="nav-item">
			            <a class="nav-link active" data-toggle="tab" href="#activo" role="tab">
			        	 	General
			            </a>
			        </li>
			        <li class="nav-item">
			            <a class="nav-link" data-toggle="tab" href="#inactivo" role="tab">
			                Resumen
			            </a>
			         </li>                         
			    </ul>
			</div> 
			<div class="tab-content col-md-12">
				<div id="activo" class="tab-pane active row justify-content-md-center mt-3" role="tabpanel">
		            <div class="row">
		            	<div class="col-md-12">
							<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>" ordercol=1 order="asc">
								<thead>
									<tr>
										<th><b>Fecha</b></th>
		                                <th><b>Modelo</b></th>
										<th class="text-center"><b>Resultado</b></th>
										<th class="text-center"><b>Tipo de documento</b></th>
										<th class="text-center"><b>Documento</b></th>
									    <th class="text-center">Acciones</th>
									</tr>
								</thead>
								<tbody>
									<?php		
										if(!empty($this->$modulo->result)){
											foreach ($this->$modulo->result as $k => $v) {
												$fecha = new DateTime(@json_decode($v->data)->fecha);
												
									?>
									<tr>
										<td><?php echo $fecha->format('Y-m-d'); ?></td>
										<td><?php echo @nombre(centrodecostos($v->user_id)); ?></td>
										<td class="text-center"><?php echo @json_decode($v->data)->total_respuestas; ?> / 490</td>
										<td class="text-center">
										
												<?php echo @tipo_documento(json_decode($v->data)->tipo_documento) ; ?>
										
										</td>
										
										
										<td class="text-center">
											<a class="btnss btn-primaryss documentos btn-mdss lightbox" title="Detalle seguimiento Modelo" data-type="iframe" href="<?php echo base_url('Utilidades/SeguimientoModelos/'.$v->id_form_contrl.'/DetalleSeguimiento')?>">
												<?php echo $v->consecutivo; ?>
											</a>
										</td>
										
										<td class="text-center">
											<a class="" target="_blank" href="<?php echo base_url("Utilidades/SeguimientoModelos/".$v->id_form_contrl."/PDF")?>">
	                                       		<i class="fas fa-file-pdf"></i>
											</a>
											<a title="Enviar a la modelo" href="<?php echo base_url("Utilidades/SeguimientoModelos/".$v->id_form_contrl."/PDF/".$v->user_id."/enviar")?>">
	                                       		<i class="fas fa-envelope"></i>
											</a>
										</td>
									</tr>
									<?php
											}
										}
									?>
								</tbody>
							</table>
		                </div>
		            </div>
		        </div>
		    <div id="inactivo" class="tab-pane row justify-content-md-center mt-3" role="tabpanel">
	    		<div class="row">
	            	<div class="col-md-12">
						<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>" ordercol=1 order="asc">
							<thead>
								<tr>
	                                <th><b>Modelo</b></th>
									<th class="text-center"><b>Analisis 1</b></th>
									<th class="text-center"><b>Analisis 2</b></th>
	                                <th class="text-center"><b>Analisis 3</b></th>
	                                <th class="text-center"><b>Promedio</b></th>
								</tr>
							</thead>
							<tbody>
							<?php
								if (isset($resumen)){
									?>
								<?php
									foreach ($resumen as $k1 => $v1) {
										$modelo = explode('#',$k1);
										$promedio = 0;
								?>
								<tr>
									<td><?php echo $modelo[1]; ?></td>
								<?php
										for ($i=0; $i < 3 ; $i++) {
												$json = @json_decode($v1[$i]->data);
												$promedio += @$json->total_respuestas; 
												echo '<td class="text-center">.'.@$json->total_respuestas.'</td>';
										}
								?>
									<td class="text-center"><?php echo format($promedio/3,true); ?></td>
								</tr>
								<?php
									}
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
</div>		