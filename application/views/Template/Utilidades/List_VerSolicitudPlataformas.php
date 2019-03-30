<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
$modulo		 =	$this->ModuloActivo;
$row		 =	$this->$modulo->result;
@$envio_email = 	$this->$modulo->result;
$documento 	 =  tipo_documento(50,true);
@$dataEmail 	 =  json_decode(get_form_control(current_url().'/configEmail')[0]->data);
//pre($envio_email);
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<?php
            	echo	TaskBar(array(	"name"		=>	array(	"title"	=>	"Ver Detalle Solicitud Plataformas",
																"url"	=>	current_url()),											
								)
							);
			?>
            <div class="row">
            	<div class="col-md-12">
            		<div class="bd-example bd-example-tabs" role="tabpanel">
                		<ul class="nav nav-tabs" id="myTab" role="tablist">
	                        <li class="nav-item">
	                            <a class="nav-link active" id="datos-tab" data-toggle="tab" href="#datos" role="tab" aria-controls="datos" aria-expanded="false">
	                                <i class="fas fa-angle-right"></i> Datos 
	                            </a>
	                        </li>
	                        <li class="nav-item">
	                            <a class="nav-link" id="observaciones-tab" data-toggle="tab" href="#observaciones" role="tab" aria-controls="observaciones" aria-expanded="true">
	                               <i class="fas fa-angle-right"></i>  Observaciones 
	                            </a>
	                        </li>
	                    </ul>
	                    <div class="tab-content" id="myTabContent">
	    					<div role="tabpanel" class="tab-pane fade active show" id="datos" aria-labelledby="datos-tab">	
								<table class="display table table-hover" ordercol=1 order="asc">
									<thead>
										<tr>
			                            	<th class="text-center"><b>Sucursal</b></th>
			                                <th class="text-center"><b>Usuario</b></th>
			                                <th class="text-center"><b>Contraseña</b></th>
			                                <th class="text-center"><b>Plataforma</b></th>
			                                <th class="text-center"><b>Prioridad</b></th>
			                                <th class="text-center"><b>Bloqueo País</b></th>
			                                <th class="text-center"><b>Etapa</b></th>
										</tr>
									</thead>
									<tbody>
										<?php		
											foreach ($row as $k => $v) {
												$plataforma = json_decode(@$v->data);
										?>
										<tr>
											<td class="text-center"><?php echo nombre(centrodecostos($v->centro_de_costos)); ?></td>
											<td class="text-center"><?php echo @$plataforma->usuario; ?></td>
											<td class="text-center"><?php echo @$plataforma->password; ?></td>
											<td class="text-center"><?php echo @$plataforma->plataforma; ?></td>
											<td class="text-center">
												<?php echo verPrioridad($plataforma->prioridad); ?>
											</td>
											<td class="text-center"><?php echo SiNo($plataforma->bloquear_pais); ?></td>
											<td class="text-center">
												<?php echo verificaEstadoSolicitudPlataformas($v->estado); ?>
											</td>
										</tr>
										<?php
											}
										?>
									</tbody>
								</table>
							</div>
							<div class="tab-pane fade" id="observaciones" role="tabpanel" aria-labelledby="movimientos-tab" aria-expanded="true">
					            <div class="col-md-12">
	                                <div style=" width:100%; height:20px;"></div>
	                                <?php 
	                               		HtmlObservaciones(true);
	                                ?>
	                            </div>
							</div>
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
			e.preventDefault();
			if($('#namePdf').val()){
				$(this).show();
			}
			$('#myModal').modal('toggle');
			var input;
			$('.inputconfigEmail').focusin(function(){
				input = $(this);
				inputval = $(this).val();
			});
			$('.opcionConfigEmail').click(function(){
				var dato = $(this).data('val');
				input.focus();
				input.val(inputval+' '+dato);
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