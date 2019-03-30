<?php

$modulo		=	$this->ModuloActivo;
$row		=	$this->$modulo->result;
$documento 	=   tipo_documento(50,true);
$enProceso = array();
$Creado    = array();
$aprobado  = array();
$rechazado = array();
$active = 'active';
foreach ($row as $k => $value) {
	if($value->estado == 1){
		$enProceso[] = $value;
	}elseif($value->estado == 2){
		$Creado[] = $value; 
	}elseif($value->estado == 3){
		$aprobado[] = $value;
	}elseif($value->estado != 9){
		$rechazado[] = $value; 
	}
}
@$data = $this->$modulo->result[0];

?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<?php
        		$submenu = array(	"name"		=>	array(	"title"	=>	"Solicitud Plataformas",
																"url"	=>	current_url()),
																"add"		=>	array(	"title"	=>	"Solicitud de Plataformas",
																"lightbox"=>true),
										"config"	=>	array(	"title"	=>	"Configuración envio email",
																"icono"	=>	'<i class="fas fa-cogs"></i>',
																"atributo" => 'id = "configEmail"',
																"data"     => $data)
										/*"config"	=>	array(	"title"	=>	"Configuración email notificación",
															"icono"	=>	'<i class="fas fa-cogs"></i>',
															"url" => base_url("Utilidades/CorreoNotificacion/SolicitudPlataformas"), 
															"lightbox" =>true),	*/						
								);
                if($this->user->type != "Asociados" && $this->user->type != "root" && $this->user->type != "Administrativo"){
                    unset($submenu['config']);
                } 
            	echo	TaskBar($submenu);
			?>
		    <div class="col-md-12">
				<div class="bd-example bd-example-tabs" role="tabpanel">
		            <ul class="nav nav-tabs" id="myTab" role="tablist">
		                <li class="nav-item">
		                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-expanded="false">En proceso</a>
		                </li>
		                <li class="nav-item">
		                    <a class="nav-link" id="procesador-tab" data-toggle="tab" href="#procesador" role="tab" aria-controls="procesador" aria-expanded="true">Creado</a>
		                </li>
		                <li class="nav-item">
		                    <a class="nav-link" id="registrocontable-tab" data-toggle="tab" href="#registrocontable" role="tab" aria-controls="registrocontable" aria-expanded="true">Aprobado</a>
		                </li> 
		                <li class="nav-item">
		                    <a class="nav-link" id="rechazado-tab" data-toggle="tab" href="#rechazado" role="tab" aria-controls="rechazado" aria-expanded="true">Rechazado</a>
		                </li>                            
		            </ul>
		            <div class="tab-content" id="myTabContent">
		                <div role="tabpanel" class="tab-pane fade active show" id="home" aria-labelledby="home-tab" aria-expanded="false">
							<table class="ordenar display table table-hover" ordercol=3 order="desc">
								<thead>
									<tr>
		                            	<th><b>Fecha</b></th>
		                                <th class="text-center"><b>Modelo</b></th>
		                                <th class="text-center"><b>Plataforma</b></th>
		                                <th class="text-center"><b>Consecutivo</b></th>
		                                <th class="text-center"><b>Prioridad</b></th>
		                                <th class="text-center"><b>Etapa</b></th>
		                                <th class="text-center"><b>Acciónes</b></th>
									</tr>
								</thead>
								<tbody>
									<?php		
										foreach ($enProceso as $k => $v) {
											$plataforma = json_decode($v->data);
									?>
									<tr>
										<td><?php echo substr(@$plataforma->fecha,0,10); ?></td>
										<td class="text-center"><?php echo @$plataforma->nombre_modelo; ?></td>
										<td>
											<?php echo $plataforma->plataforma; ?>
										</td>
										<td class="text-center">
											<a class="lightbox text-primary" title="Ver detalle Solicitud Plataforma <?php echo @$plataforma->nombre_modelo ?>" data-type="iframe" href="<?php echo current_url().'/'.$v->id_form_contrl; ?>">
												<?php echo @$v->consecutivo; ?>
											</a>			
										</td>
										<td class="bordeBottom text-center">
											<?php echo verPrioridad($plataforma->prioridad); ?>
										</td>
										<td class="bordeBottom text-center">
											<?php echo verificaEstadoSolicitudPlataformas($v->estado); ?>
										</td>
										<td class="text-center">
											<a class="" target="_blank" href="<?php echo base_url("Utilidades/SolicitudPlataformas/".$v->id_form_contrl."/PDF")?>">
		                                       	<i class="fas fa-file-pdf"></i>
											</a>
											<?php
												if($v->estado == 1){
                									if($this->user->type != "Monitores" && $this->user->type != "Modelos" && $this->user->type != "Secretaria"){
											?>
		                                    <a title="Crear" href="<?php echo base_url("Utilidades/cambiarEstado/".$v->id_form_contrl."/2/SolicitudPlataformas/procesador")?>">
		                                     <i class="fas fa-check"></i>
		                                    </a>
		                                    <?php
		                                    	}
		                                    	if($this->user->type == "Asociados" || $this->user->type == "root"){
		                                    ?>
		                                    <a title="Anular" href="<?php echo base_url("Utilidades/cambiarEstado/".$v->id_form_contrl."/9/SolicitudPlataformas/procesador")?>">
		                                     <i class="fas fa-trash"></i>
		                                    </a>
		                                    <?php
		                                    		}
		                                    	}else{
		                                    ?>
		                                    <i class="fas fa-ban"></i>
		                                    <?php
		                                    	}
		                                    ?>
										</td>
									</tr>
									<?php
										}
									?>
								</tbody>
							</table>                       
		                </div>
		                <div class="tab-pane fade" id="procesador" role="tabpanel" aria-labelledby="procesador-tab" aria-expanded="true">
							<table class="ordenar display table table-hover" ordercol=3 order="asc">
								<thead>
									<tr>
		                            	<th><b>Fecha</b></th>
		                                <th class="text-center"><b>Modelo</b></th>
		                                <th class="text-center"><b>Plataforma</b></th>
		                                <th class="text-center"><b>Consecutivo</b></th>
		                                <th class="text-center"><b>Prioridad</b></th>
		                                <th class="text-center"><b>Etapa</b></th>
		                                <th class="text-center"><b>Acciónes</b></th>
									</tr>
								</thead>
								<tbody>
									<?php		
										foreach ($Creado as $k => $v) {
											$plataforma = json_decode(@$v->data);
									?>
									<tr>
										<td><?php echo substr(@$plataforma->fecha,0,10); ?></td>
										<td class="text-center"><?php echo @$plataforma->nombre_modelo; ?></td>
										<td>
											<?php echo $plataforma->plataforma; ?>
										</td>
										<td class="text-center">
											<a class="lightbox text-primary" title="Ver detalle Solicitud Plataforma <?php echo @$plataforma->nombre_modelo ?>" data-type="iframe" href="<?php echo current_url().'/'.$v->id_form_contrl; ?>">
												<?php echo @$v->consecutivo; ?>
											</a>			
										</td>
										<td class="bordeBottom text-center">
											<?php echo verPrioridad($plataforma->prioridad); ?>
										</td>
										<td class="bordeBottom text-center">
											<?php echo verificaEstadoSolicitudPlataformas($v->estado); ?>
										</td>
										<td class="text-center">
											<a class="" target="_blank" href="<?php echo base_url("Utilidades/SolicitudPlataformas/".$v->id_form_contrl."/PDF")?>">
		                                       	<i class="fas fa-file-pdf"></i>
											</a>
											<?php
												if($v->estado == 2){
                									if($this->user->type != "Monitores" && $this->user->type != "Modelos" && $this->user->type != "Secretaria"){
											?>
		                                    <a title="Aprobar" href="<?php echo base_url("Utilidades/cambiarEstado/".$v->id_form_contrl."/3/SolicitudPlataformas/registrocontable")?>">
		                                        <i class="fas fa-check"></i>
		                                    </a>
		                                    <a title="Rechazar" href="<?php echo base_url("Utilidades/cambiarEstado/".$v->id_form_contrl."/0/SolicitudPlataformas/rechazado")?>">
		                                        <i class="fas fa-times"></i>
		                                    </a>
		                                    <?php
		                                			}
		                                    	}else{
		                                    ?>
		                                    <i class="fas fa-ban"></i>
		                                    <?php
		                                    	}
		                                    ?>
										</td>
									</tr>
									<?php
										}
									?>
								</tbody>
							</table>
		                </div>
		                <div class="tab-pane fade" id="registrocontable" role="tabpanel" aria-labelledby="registrocontable-tab" aria-expanded="true">
							<table class="ordenar display table table-hover" ordercol=3 order="asc">
								<thead>
									<tr>
		                            	<th><b>Fecha</b></th>
		                                <th class="text-center"><b>Modelo</b></th>
		                                <th class="text-center"><b>Plataforma</b></th>
		                                <th class="text-center"><b>Consecutivo</b></th>
		                                <th class="text-center"><b>Prioridad</b></th>
		                                <th class="text-center"><b>Etapa</b></th>
		                                <th class="text-center"><b>Acciónes</b></th>
									</tr>
								</thead>
								<tbody>
									<?php		
										foreach ($aprobado as $k => $v) {
											$plataforma = json_decode(@$v->data);
									?>
									<tr>
										<td><?php echo substr(@$plataforma->fecha,0,10); ?></td>
										<td class="text-center"><?php echo @$plataforma->nombre_modelo; ?></td>
										<td>
											<?php echo $plataforma->plataforma; ?>
										</td>
										<td class="text-center">
											<a class="lightbox text-primary" title="Ver detalle Solicitud Plataforma <?php echo @$plataforma->nombre_modelo ?>" data-type="iframe" href="<?php echo current_url().'/'.$v->id_form_contrl; ?>">
												<?php echo @$v->consecutivo; ?>
											</a>			
										</td>
										<td class="bordeBottom text-center">
											<?php echo verPrioridad($plataforma->prioridad); ?>
										</td>
										<td class="bordeBottom text-center">
											<?php echo verificaEstadoSolicitudPlataformas($v->estado); ?>
										</td>
										<td class="text-center">
											<a class="" target="_blank" href="<?php echo base_url("Utilidades/SolicitudPlataformas/".$v->id_form_contrl."/PDF")?>">
		                                       	<i class="fas fa-file-pdf"></i>
											</a>
										</td>
									</tr>
									<?php
										}
									?>
								</tbody>
							</table>                               	
		                </div>  
		                <div class="tab-pane fade" id="rechazado" role="tabpanel" aria-labelledby="rechazado-tab" aria-expanded="true">
							<table class="ordenar display table table-hover" ordercol=3 order="asc">
								<thead>
									<tr>
		                            	<th><b>Fecha</b></th>
		                                <th class="text-center"><b>Modelo</b></th>
		                                <th class="text-center"><b>Plataforma</b></th>
		                                <th class="text-center"><b>Consecutivo</b></th>
		                                <th class="text-center"><b>Prioridad</b></th>
		                                <th class="text-center"><b>Etapa</b></th>
		                                <th class="text-center"><b>Acciónes</b></th>
									</tr>
								</thead>
								<tbody>
									<?php		
										foreach ($rechazado as $k => $v) {
											$plataforma = json_decode(@$v->data);
									?>
									<tr>
										<td><?php echo substr(@$plataforma->fecha,0,10); ?></td>
										<td class="text-center"><?php echo @$plataforma->nombre_modelo; ?></td>
										<td>
											<?php echo $plataforma->plataforma; ?>
										</td>
										<td class="text-center">
											<a class="lightbox text-primary" title="Ver detalle Solicitud Plataforma <?php echo @$plataforma->nombre_modelo ?>" data-type="iframe" href="<?php echo current_url().'/'.$v->id_form_contrl; ?>">
												<?php echo @$v->consecutivo; ?>
											</a>			
										</td>
										<td class="bordeBottom text-center">
											<?php echo verPrioridad($plataforma->prioridad); ?>
										</td>
										<td class="bordeBottom text-center">
											<?php echo verificaEstadoSolicitudPlataformas($v->estado); ?>
										</td>
										<td class="text-center">
											<a class="" target="_blank" href="<?php echo base_url("Utilidades/SolicitudPlataformas/".$v->id_form_contrl."/PDF")?>">
		                                       	<i class="fas fa-file-pdf"></i>
											</a>
										</td>
									</tr>
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
</div>
<script>
	$(document).ready(function(){

		$('#configEmail').click(function(e){
			if($('#namePdf').val()){
				$(this).show();
			}
			var input;
			$('.inputconfigEmail').focusin(function(){
				input = $(this);
				inputval = $(this).val();
			});
			$('.opcionConfigEmail').click(function(){
				var dato = $(this).data('val');
				input.focus();
				input.val(inputval+' '+dato);
				var cont_texto = '<var>'+inputval+'</var>'+'<div class="option_select">'+dato+' <i class="fas fa-window-close"></i></div>';
				var texto = input.parent('div').find('.cont');
				texto.html(cont_texto);
				texto.show();
			});
			$('.enviarPDF').click(function(){
				if($(this).val() == "Si"){
					$('#pdf').fadeIn();
				}else{
					$('#pdf').fadeOut();
				}
			});
		});
	});
</script>