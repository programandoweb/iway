<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
$modulo		=	$this->ModuloActivo;
$row		=	$this->$modulo->result;
@$json = json_decode($row[0]->data);
//pre(@$json); return;
?>

<div class="col-md-12">
	<ul class="nav nav-tabs" role="tablist"> 
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#general" role="tab">
        	 	General
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#anotaciones" role="tab">
                Anotaciones
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#Observaciones" role="tab">
                Observaciones
            </a>
        </li>                         
    </ul>
</div> 
<div class="tab-content col-md-12">
	<div id="general" class="tab-pane active row justify-content-md-center mt-3" role="tabpanel">
		<div class="col-md-8 offset-md-2">
			<div style="text-align: center;">
				<h4>Seguimiento y evalución <?php echo nombre(centrodecostos($row[0]->user_id)); ?></h4>
			</div>
			<div style="height: 40px;"></div>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr class="colorFondo">
						<td  colspan="2" style="text-align: center;"><b>Manejo informático.</b></td>
					</tr>
					<tr>
						<td  width="50%" >Agilidad en el manejo del teclado.</td>
						<td  width="50%" style="text-align: center;"><?php echo @$json->AgilidadTeclado; ?> / 10</td>
					</tr>
					<tr>
						<td  >Uso de comando rápidos.</td>
						<td  style="text-align: center;"><?php echo @$json->usoComandos; ?> / 10</td>
					</tr>
					<tr>
						<td  >Uso de los recursos del navegador.</td>
						<td  style="text-align: center;"><?php echo @$json->usoRecursosNavegador; ?> / 10</td>
					</tr>
					<tr>
						<td  >Calidad de la imagen (configuración).</td>
						<td  style="text-align: center;"><?php echo @$json->calidadImagen; ?> / 10</td>
					</tr>
					<tr>
						<td  >Identificación de los errores de la página.</td>
						<td  style="text-align: center;"><?php echo @$json->identificacionErrores; ?> / 10</td>
					</tr>
					<tr class="colorFondo">
						<td>
							<b>
								Total :
							</b>
						</td>
						<td class="text-center">
							<b>
								<?php
									echo @$json->AgilidadTeclado+@$json->usoComandos+@$json->usoRecursosNavegador+@$json->calidadImagen+@$json->identificacionErrores.' / 50';
								?>
							</b>
						</td>
					</tr>
				</tbody>
			</table>
			<div style="height: 20px;"></div>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr class="colorFondo">
						<td  colspan="2" style="text-align: center;"><b>Conocimiento del inglés.</b></td>
					</tr>
					<tr>
						<td  width="50%" >Sostener conversaciones básicas, sin uso del traductor.</td>
						<td  width="50%" style="text-align: center;"><?php echo @$json->conversacionesSinTraductor; ?> / 10</td>
					</tr>
					<tr>
						<td  >Uso del traductor.</td>
						<td  style="text-align: center;"><?php echo @$json->usoTraductor; ?> / 10</td>
					</tr>
					<tr>
						<td  >Calidad de las traducciones.</td>
						<td  style="text-align: center;"><?php echo @$json->calidadTraducciones; ?> / 10</td>
					</tr>
					<tr>
						<td  >Conocimiento de jerga y abreviaturas.</td>
						<td  style="text-align: center;"><?php echo @$json->conocimientoJerga; ?> / 10</td>
					</tr>
					<tr>
						<td  >Conocimiento de palabras técnicas.</td>
						<td  style="text-align: center;"><?php echo @$json->conocimientopalabrasTecnicas; ?> / 10</td>
					</tr>
					<tr class="colorFondo">
						<td>
							<b>
								Total :
							</b>
						</td>
						<td style="text-align: center;">
							<b>
								<?php
									echo @$json->conversacionesSinTraductor+
										 @$json->usoTraductor+
										 @$json->calidadTraducciones+
										 @$json->conocimientoJerga+
										 @$json->conocimientopalabrasTecnicas.' / 50';
								?>
							</b>
						</td>
					</tr>
				</tbody>
			</table>
			<div style="height: 20px;"></div>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr class="colorFondo">
						<td  colspan="2" style="text-align: center;"><b>Apariencia física.</b></td>
					</tr>
					<tr>
						<td  width="50%" >Estado del cabello.</td>
						<td  width="50%" style="text-align: center;"><?php echo @$json->estadoCabello; ?> / 10</td>
					</tr>
					<tr>
						<td  >Estado de las Uñas.</td>
						<td  style="text-align: center;"><?php echo @$json->estadoUnas; ?> / 10</td>
					</tr>
					<tr>
						<td  >Calidad del maquillaje.</td>
						<td  style="text-align: center;"><?php echo @$json->calidadMaquillaje; ?> / 10</td>
					</tr>
					<tr>
						<td  >Uso de Lencería adecuada.</td>
						<td  style="text-align: center;"><?php echo @$json->usoLenceriaAdecuada; ?> / 10</td>
					</tr>
					<tr class="colorFondo">
						<td>
							<b>
								Total :
							</b>
						</td>
						<td style="text-align: center;">
							<b>
								<?php
									echo 				@$json->estadoCabello+
														@$json->estadoUnas+
														@$json->calidadMaquillaje+
														@$json->usoLenceriaAdecuada.' / 40';
								?>
							</b>
						</td>
					</tr>
				</tbody>
			</table>
			<div style="height: 20px;"></div>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr class="colorFondo">
						<td  colspan="2" style="text-align: center;"><b>Buenas Costumbres.</b></td>
					</tr>
					<tr>
						<td  width="50%" >Organización del room.</td>
						<td  width="50%" style="text-align: center;"><?php echo @$json->OrganizacionRom; ?> / 10</td>
					</tr>
					<tr>
						<td  >No se distrae con dispositivos personales.</td>
						<td  style="text-align: center;"><?php echo @$json->NoSeDistraeConDispositivos; ?> / 10</td>
					</tr>
					<tr>
						<td  >Solo usa el español cuando es necesario.</td>
						<td  style="text-align: center;"><?php echo @$json->UsaEspanolCuandoEsNesc; ?> / 10</td>
					</tr>
					<tr>
						<td  >No usa jerga latina en las traduccion.</td>
						<td  style="text-align: center;"><?php echo @$json->NoJergaLatinaTraduccion; ?> / 10</td>
					</tr>
					<tr class="colorFondo">
						<td>
							<b>
								Total :
							</b>
						</td>
						<td style="text-align: center;">
							<b>
								<?php
									echo @$json->OrganizacionRom+
										 @$json->NoSeDistraeConDispositivos+
										 @$json->UsaEspanolCuandoEsNesc+
										 @$json->NoJergaLatinaTraduccion.' / 40';
								?>
							</b>
						</td>
					</tr>
				</tbody>
			</table>
			<div style="height: 20px;"></div>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr class="colorFondo">
						<td  colspan="2" style="text-align: center;"><b>Conocimiento Teórico.</b></td>
					</tr>
					<tr>
						<td  width="50%" >Manejo de la plataforma de trasmisión.</td>
						<td  width="50%" style="text-align: center;"><?php echo @$json->ManejoPlataforma; ?> / 10</td>
					</tr>
					<tr>
						<td  >Movimientos delante de la cámara.</td>
						<td  style="text-align: center;"><?php echo @$json->MovimientosCamara; ?> / 10</td>
					</tr>
					<tr>
						<td  >Desarrollo de su show.</td>
						<td  style="text-align: center;"><?php echo @$json->DesarrolloShow; ?> / 10</td>
					</tr>
					<tr>
						<td  >Calidad en el uso de juguetes.</td>
						<td  style="text-align: center;"><?php echo @$json->CalidadUsoJuguetes; ?> / 10</td>
					</tr>
					<tr class="colorFondo">
						<td>
							<b>
								Total :
							</b>
						</td>
						<td style="text-align: center;">
							<b>
								<?php
									echo 	@$json->ManejoPlataforma+
											@$json->MovimientosCamara+
											@$json->DesarrolloShow+
											@$json->CalidadUsoJuguetes.' / 40';
								?>
							</b>
						</td>
					</tr>
				</tbody>
			</table>
			<div style="height: 20px;"></div>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr class="colorFondo">
						<td  colspan="2" style="text-align: center;"><b>Uso de Tópics.</b></td>
					</tr>
					<tr>
						<td  width="50%" >Pública topics en las páginas necesarias.</td>
						<td  width="50%" style="text-align: center;"><?php echo @$json->publicaTopics; ?> / 10</td>
					</tr>
					<tr>
						<td  >Estructura del topic.</td>
						<td  style="text-align: center;"><?php echo @$json->EstructuraTopic; ?> / 10</td>
					</tr>
					<tr>
						<td  >Coherencia en la redacción del topic.</td>
						<td  style="text-align: center;"><?php echo @$json->CoherenciaRedaccionTopic; ?> / 10</td>
					</tr>
					<tr>
						<td  >Relación entre el topic y el Show.</td>
						<td  style="text-align: center;"><?php echo @$json->RelTopicShow; ?> / 10</td>
					</tr>
					<tr class="colorFondo">
						<td>
							<b>
								Total :
							</b>
						</td>
						<td style="text-align: center;">
							<b>
								<?php
									echo 	@$json->publicaTopics+
											@$json->EstructuraTopic+
											@$json->CoherenciaRedaccionTopic+
											@$json->RelTopicShow.' / 40';
								?>
							</b>
						</td>
					</tr>
				</tbody>
			</table>
			<div style="height: 20px;"></div>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr class="colorFondo">
						<td  colspan="2" style="text-align: center;"><b>Expresión Corporal.</b></td>
					</tr>
					<tr>
						<td  width="50%" >Expresión de alegría.</td>
						<td  width="50%" style="text-align: center;"><?php echo @$json->ExpresionAlegria; ?> / 10</td>
					</tr>
					<tr>
						<td  >Gesticulación.</td>
						<td  style="text-align: center;"><?php echo @$json->Gesticulacion; ?> / 10</td>
					</tr>
					<tr>
						<td  >Coordinación motriz.</td>
						<td  style="text-align: center;"><?php echo @$json->CordinacionMotriz; ?> / 10</td>
					</tr>
					<tr>
						<td  >Postura corporal.</td>
						<td  style="text-align: center;"><?php echo @$json->Postura; ?> / 10</td>
					</tr>
					<tr>
						<td  >Interacción con los usuarios.</td>
						<td  style="text-align: center;"><?php echo @$json->Interaccion; ?> / 10</td>
					</tr>
					<tr>
						<td  >Calidad del baile.</td>
						<td  style="text-align: center;"><?php echo @$json->CalidadBaile; ?> / 10</td>
					</tr>
					<tr class="colorFondo">
						<td>
							<b>
								Total :
							</b>
						</td>
						<td style="text-align: center;">
							<b>
								<?php
									echo 	@$json->ExpresionAlegria+
											@$json->Gesticulacion2+
											@$json->CordinacionMotriz+
											@$json->Postura+
											@$json->Interaccion+
											@$json->CalidadBaile.' / 60';
								?>
							</b>
						</td>
					</tr>
				</tbody>
			</table>
			<div style="height: 20px;"></div>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr class="colorFondo">
						<td  colspan="2" style="text-align: center;"><b>Personalidad.</b></td>
					</tr>
					<tr>
						<td  width="50%" >Astucia femenina.</td>
						<td  width="50%" style="text-align: center;"><?php echo @$json->Astucia; ?> / 10</td>
					</tr>
					<tr>
						<td  >Capacidades sexuales.</td>
						<td  style="text-align: center;"><?php echo @$json->CapacidadesSexuales; ?> / 10</td>
					</tr>
					<tr>
						<td  >Correcta interpretación de su Rol.</td>
						<td  style="text-align: center;"><?php echo @$json->InterpretacionRol; ?> / 10</td>
					</tr>
							<tr class="colorFondo">
					<td>
						<b>
							Total :
						</b>
					</td>
					<td style="text-align: center;">
						<b>
							<?php
								echo @$json->ExpresionAlegria+
										@$json->Gesticulacion+
										@$json->CordinacionMotriz+
										@$json->Postura´+
										@$json->Interaccion+
										@$json->CalidadBaile+
										@$json->Astucia+
										@$json->CapacidadesSexuales+
										@$json->InterpretacionRol.' / 90';
							?>
						</b>
					</td>
				</tr>
				</tbody>
			</table>
			<div style="height: 20px;"></div>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr class="colorFondo">
						<td  colspan="2" style="text-align: center;"><b>Conversaciones.</b></td>
					</tr>
					<tr>
						<td  width="50%" >Conocimiento ortográfico.</td>
						<td  width="50%" style="text-align: center;"><?php echo @$json->Ortografia; ?> / 10</td>
					</tr>
					<tr>
						<td  >Uso de regionalismos.</td>
						<td  style="text-align: center;"><?php echo @$json->Regionalismos; ?> / 10</td>
					</tr>
					<tr>
						<td  >Coherencia en la conversación.</td>
						<td  style="text-align: center;"><?php echo @$json->CoherenciaConversacion; ?> / 10</td>
					</tr>
					<tr>
						<td  >Fluidez y calidad de la conversación.</td>
						<td  style="text-align: center;"><?php echo @$json->FluidezConversacion; ?> / 10</td>
					</tr>
					<tr class="colorFondo">
						<td>
							<b>
								Total :
							</b>
						</td>
						<td style="text-align: center;">
						<b>
							<?php
								echo @$json->Ortografia+
								@$json->Regionalismos+
								@$json->CoherenciaConversacion+
								@$json->FluidezConversacion.' / 40';
							?>
						</td>
					</tr>
				</tbody>
			</table>
			<div style="height: 20px;"></div>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr class="colorFondo">
						<td  colspan="2" style="text-align: center;"><b>Calidad y Tiempos del Desnudo.</b></td>
					</tr>
					<tr>
						<td  width="50%" >Hace el desnudo de forma correcta.</td>
						<td  width="50%" style="text-align: center;"><?php echo @$json->Desnudo; ?> / 10</td>
					</tr>
					<tr>
						<td  >Calidad del striptease.</td>
						<td  style="text-align: center;"><?php echo @$json->CalidadStriptease; ?> / 10</td>
					</tr>
					<tr>
						<td  >Calidad del Show Free.</td>
						<td  style="text-align: center;"><?php echo @$json->CalidadShow; ?> / 10</td>
					</tr>
					<tr>
						<td  >Sensualidad en los movimientos.</td>
						<td  style="text-align: center;"><?php echo @$json->SensualidadMovimientos; ?> / 10</td>
					</tr>
					<tr class="colorFondo">
						<td>
							<b>
								Total :
							</b>
						</td>
						<td style="text-align: center;">
							<b>	
								<?php
									echo 	@$json->Desnudo+
											@$json->CalidadStriptease+
											@$json->CalidadShow+
											@$json->SensualidadMovimientos.' / 40';
								?>
							</b>
						</td>
					</tr>
					<tr>
						<td></td>
						<td style="height:40px;"> </td>
					</tr>
					<tr>
						<td><b>Total general</b></td>
						<td class="text-center"><b><?php echo $json->total_respuestas; ?> / 490</b></td>
					</tr>
					<tr>
						<td style="height: 30px;"></td>
						<td></td>
					</tr>
					<tr class="colorFondo">
						<td  colspan="2" style="text-align: center;">Evaluador :<b> <?php echo @$json->nombre_evaluador; ?></b></td>
					</tr>
				</tbody>
			</table>
		</div>	
    </div>
    <div id="anotaciones" class="tab-pane row justify-content-md-center mt-3" role="tabpanel">
    	<div class="col-md-8 offset-md-2">
			<div style="text-align: center;">
				<h4>Seguimiento y evalución <?php echo nombre(centrodecostos($row[0]->user_id)); ?></h4>
			</div>
			<div style="height: 40px;"></div>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<?php if(!empty(@$json->Ob_AgilidadTeclado)){ ?>
					<tr>
						<td  width="50%" >Agilidad en el manejo del teclado.</td>
						<td  width="50%" style="text-align: center;"><?php echo @$json->AgilidadTeclado; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_AgilidadTeclado; ?></td>
					</tr>
					<?php } ?>
					<?php if(!empty(@$json->Ob_usoComandos)){ ?>
					<tr>
						<td  >Uso de comando rápidos.</td>
						<td  style="text-align: center;"><?php echo @$json->usoComandos; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_usoComandos; ?></td>
					</tr>
					<?php } ?>
					<?php if(!empty(@$json->Ob_usoRecursosNavegador)){ ?>
					<tr>
						<td  >Uso de los recursos del navegador.</td>
						<td  style="text-align: center;"><?php echo @$json->usoRecursosNavegador; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_usoRecursosNavegador; ?></td>
					</tr>
					<?php } ?>
					<?php if(!empty(@$json->Ob_calidadImagen)){ ?>
					<tr>
						<td  >Calidad de la imagen (configuración).</td>
						<td  style="text-align: center;"><?php echo @$json->calidadImagen; ?> / 10</td>
					</tr>	
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_calidadImagen; ?></td>
					</tr>
					<?php } ?>
					<?php if(!empty(@$json->Ob_identificacionErrores)){ ?>
					<tr>
						<td  >Identificación de los errores de la página.</td>
						<td  style="text-align: center;"><?php echo @$json->identificacionErrores; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_identificacionErrores; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<div style="height: 20px;"></div>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<?php if(!empty(@$json->Ob_conversacionesSinTraductor)){ ?>
					<tr>
						<td  width="50%" >Sostener conversaciones básicas, sin uso del traductor.</td>
						<td  width="50%" style="text-align: center;"><?php echo @$json->conversacionesSinTraductor; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_conversacionesSinTraductor; ?></td>
					</tr>
					<?php } ?>
					<?php if(!empty(@$json->Ob_usoTraductor)){ ?>
					<tr>
						<td  >Uso del traductor.</td>
						<td  style="text-align: center;"><?php echo @$json->usoTraductor; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_usoTraductor; ?></td>
					</tr>
					<?php } ?>
					<?php if(!empty(@$json->Ob_calidadTraducciones)){ ?>
					<tr>
						<td  >Calidad de las traducciones.</td>
						<td  style="text-align: center;"><?php echo @$json->calidadTraducciones; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_calidadTraducciones; ?></td>
					</tr>
					<?php } ?>
					<?php if(!empty(@$json->Ob_conocimientoJerga)){ ?>
					<tr>
						<td  >Conocimiento de jerga y abreviaturas.</td>
						<td  style="text-align: center;"><?php echo @$json->conocimientoJerga; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_conocimientoJerga; ?></td>
					</tr>
					<?php } ?>
					<?php if(!empty(@$json->Ob_conocimientopalabrasTecnicas)){ ?>
					<tr>
						<td  >Conocimiento de palabras técnicas.</td>
						<td  style="text-align: center;"><?php echo @$json->conocimientopalabrasTecnicas; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_conocimientopalabrasTecnicas; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<div style="height: 20px;"></div>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<?php if(!empty(@$json->Ob_estadoCabello)){ ?>
					<tr>
						<td  width="50%" >Estado del cabello.</td>
						<td  width="50%" style="text-align: center;"><?php echo @$json->estadoCabello; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_estadoCabello; ?></td>
					</tr>
					<?php } ?>
					<?php if(!empty(@$json->Ob_estadoUnas)){ ?>
					<tr>
						<td  >Estado de las Uñas.</td>
						<td  style="text-align: center;"><?php echo @$json->estadoUnas; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_estadoUnas; ?></td>
					</tr>
					<?php } ?>
					<?php if(!empty(@$json->Ob_calidadMaquillaje)){ ?>
					<tr>
						<td  >Calidad del maquillaje.</td>
						<td  style="text-align: center;"><?php echo @$json->calidadMaquillaje; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_calidadMaquillaje; ?></td>
					</tr>
					<?php } ?>
					<?php if(!empty(@$json->Ob_usoLenceriaAdecuada)){ ?>
					<tr>
						<td  >Uso de Lencería adecuada.</td>
						<td  style="text-align: center;"><?php echo @$json->usoLenceriaAdecuada; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_usoLenceriaAdecuada; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<div style="height: 20px;"></div>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<?php if(!empty(@$json->Ob_OrganizacionRom)){ ?>
					<tr>
						<td  width="50%" >Organización del room.</td>
						<td  width="50%" style="text-align: center;"><?php echo @$json->OrganizacionRom; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_OrganizacionRom; ?></td>
					</tr>
					<?php } ?>
					<?php if(!empty(@$json->Ob_NoSeDistraeConDispositivos)){ ?>
					<tr>
						<td  >No se distrae con dispositivos personales.</td>
						<td  style="text-align: center;"><?php echo @$json->NoSeDistraeConDispositivos; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_NoSeDistraeConDispositivos; ?></td>
					</tr>
					<?php } ?>
					<?php if(!empty(@$json->Ob_UsaEspanolCuandoEsNesc)){ ?>
					<tr>
						<td  >Solo usa el español cuando es necesario.</td>
						<td  style="text-align: center;"><?php echo @$json->UsaEspanolCuandoEsNesc; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_UsaEspanolCuandoEsNesc; ?></td>
					</tr>
					<?php } ?>
					<?php if(!empty(@$json->Ob_NoJergaLatinaTraduccion)){ ?>
					<tr>
						<td  >No usa jerga latina en las traduccion.</td>
						<td  style="text-align: center;"><?php echo @$json->NoJergaLatinaTraduccion; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_NoJergaLatinaTraduccion; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<div style="height: 20px;"></div>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<?php if(!empty(@$json->Ob_ManejoPlataforma)){ ?>
					<tr>
						<td  width="50%" >Manejo de la plataforma de trasmisión.</td>
						<td  width="50%" style="text-align: center;"><?php echo @$json->ManejoPlataforma; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_ManejoPlataforma; ?></td>
					</tr>
					<?php } ?>
					<?php if(!empty(@$json->Ob_MovimientosCamara)){ ?>
					<tr>
						<td  >Movimientos delante de la cámara.</td>
						<td  style="text-align: center;"><?php echo @$json->MovimientosCamara; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_MovimientosCamara; ?></td>
					</tr>
					<?php } ?>
					<?php if(!empty(@$json->Ob_DesarrolloShow)){ ?>
					<tr>
						<td  >Desarrollo de su show.</td>
						<td  style="text-align: center;"><?php echo @$json->DesarrolloShow; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_DesarrolloShow; ?></td>
					</tr>
					<?php } ?>
					<?php if(!empty(@$json->Ob_CalidadUsoJuguetes)){ ?>
					<tr>
						<td  >Calidad en el uso de juguetes.</td>
						<td  style="text-align: center;"><?php echo @$json->CalidadUsoJuguetes; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_CalidadUsoJuguetes; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<div style="height: 20px;"></div>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<?php if(!empty(@$json->Ob_publicaTopics)){ ?>
					<tr>
						<td  width="50%" >Pública topics en las páginas necesarias.</td>
						<td  width="50%" style="text-align: center;"><?php echo @$json->publicaTopics; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_publicaTopics; ?></td>
					</tr>
					<?php } ?>
					<?php if(!empty(@$json->Ob_EstructuraTopic)){ ?>
					<tr>
						<td  >Estructura del topic.</td>
						<td  style="text-align: center;"><?php echo @$json->EstructuraTopic; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_EstructuraTopic; ?></td>
					</tr>
					<?php } ?>
					<?php if(!empty(@$json->Ob_CoherenciaRedaccionTopic)){ ?>
					<tr>
						<td  >Coherencia en la redacción del topic.</td>
						<td  style="text-align: center;"><?php echo @$json->CoherenciaRedaccionTopic; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_CoherenciaRedaccionTopic; ?></td>
					</tr>
					<?php } ?>
					<?php if(!empty(@$json->Ob_RelTopicShow)){ ?>
					<tr>
						<td  >Relación entre el topic y el Show.</td>
						<td  style="text-align: center;"><?php echo @$json->RelTopicShow; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_RelTopicShow; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<div style="height: 20px;"></div>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<?php if(!empty(@$json->Ob_ExpresionAlegria)){ ?>
					<tr>
						<td  width="50%" >Expresión de alegría.</td>
						<td  width="50%" style="text-align: center;"><?php echo @$json->ExpresionAlegria; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_ExpresionAlegria; ?></td>
					</tr>
					<?php } ?>
					<?php if(!empty(@$json->Ob_Gesticulacion)){ ?>
					<tr>
						<td  >Gesticulación.</td>
						<td  style="text-align: center;"><?php echo @$json->Gesticulacion; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_Gesticulacion; ?></td>
					</tr>
					<?php } ?>
					<?php if(!empty(@$json->Ob_CordinacionMotriz)){ ?>
					<tr>
						<td  >Coordinación motriz.</td>
						<td  style="text-align: center;"><?php echo @$json->CordinacionMotriz; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_CordinacionMotriz; ?></td>
					</tr>
					<?php } ?>
					<?php if(!empty(@$json->Ob_Postura)){ ?>
					<tr>
						<td  >Postura corporal.</td>
						<td  style="text-align: center;"><?php echo @$json->Postura; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_Postura; ?></td>
					</tr>
					<?php } ?>
					<?php if(!empty(@$json->Ob_Interaccion)){ ?>
					<tr>
						<td  >Interacción con los usuarios.</td>
						<td  style="text-align: center;"><?php echo @$json->Interaccion; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_Interaccion; ?></td>
					</tr>
					<?php } ?>
					<?php if(!empty(@$json->Ob_CalidadBaile)){ ?>
					<tr>
						<td  >Calidad del baile.</td>
						<td  style="text-align: center;"><?php echo @$json->CalidadBaile; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_CalidadBaile; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<div style="height: 20px;"></div>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<?php if(!empty(@$json->Ob_Astucia)){ ?>
					<tr>
						<td  width="50%" >Astucia femenina.</td>
						<td  width="50%" style="text-align: center;"><?php echo @$json->Astucia; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_Astucia; ?></td>
					</tr>
					<?php } ?>
					<?php if(!empty(@$json->Ob_CapacidadesSexuales)){ ?>
					<tr>
						<td  >Capacidades sexuales.</td>
						<td  style="text-align: center;"><?php echo @$json->CapacidadesSexuales; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_CapacidadesSexuales; ?></td>
					</tr>
					<?php } ?>
					<?php if(!empty(@$json->Ob_InterpretacionRol)){ ?>
					<tr>
						<td  >Correcta interpretación de su Rol.</td>
						<td  style="text-align: center;"><?php echo @$json->InterpretacionRol; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_InterpretacionRol; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<div style="height: 20px;"></div>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<?php if(!empty(@$json->Ob_Ortografia)){ ?>
					<tr>
						<td  width="50%" >Conocimiento ortográfico.</td>
						<td  width="50%" style="text-align: center;"><?php echo @$json->Ortografia; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_Ortografia; ?></td>
					</tr>
					<?php } ?>
					<?php if(!empty(@$json->Ob_Regionalismos)){ ?>
					<tr>
						<td  >Uso de regionalismos.</td>
						<td  style="text-align: center;"><?php echo @$json->Regionalismos; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_Regionalismos; ?></td>
					</tr>
					<?php } ?>
					<?php if(!empty(@$json->Ob_CoherenciaConversacion)){ ?>
					<tr>
						<td  >Coherencia en la conversación.</td>
						<td  style="text-align: center;"><?php echo @$json->CoherenciaConversacion; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_CoherenciaConversacion; ?></td>
					</tr>
					<?php } ?>
					<?php if(!empty(@$json->Ob_FluidezConversacion)){ ?>
					<tr>
						<td  >Fluidez y calidad de la conversación.</td>
						<td  style="text-align: center;"><?php echo @$json->FluidezConversacion; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_FluidezConversacion; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<div style="height: 20px;"></div>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<?php if(!empty(@$json->Ob_Desnudo)){ ?>
					<tr>
						<td  width="50%" >Hace el desnudo de forma correcta.</td>
						<td  width="50%" style="text-align: center;"><?php echo @$json->Desnudo; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_Desnudo; ?></td>
					</tr>
					<?php } ?>
					<?php if(!empty(@$json->Ob_CalidadStriptease)){ ?>
					<tr>
						<td  >Calidad del striptease.</td>
						<td  style="text-align: center;"><?php echo @$json->CalidadStriptease; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_CalidadStriptease; ?></td>
					</tr>
					<?php } ?>
					<?php if(!empty(@$json->Ob_CalidadShow)){ ?>
					<tr>
						<td  >Calidad del Show Free.</td>
						<td  style="text-align: center;"><?php echo @$json->CalidadShow; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_CalidadShow; ?></td>
					</tr>
					<?php } ?>
					<?php if(!empty(@$json->Ob_SensualidadMovimientos)){ ?>
					<tr>
						<td  >Sensualidad en los movimientos.</td>
						<td  style="text-align: center;"><?php echo @$json->SensualidadMovimientos; ?> / 10</td>
					</tr>
					<tr>
						<td  colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_SensualidadMovimientos; ?></td>
					</tr>
					<?php } ?>
					<tr>
						<td style="height: 30px;"></td>
						<td></td>
					</tr>
					<tr class="colorFondo">
						<td  colspan="2" style="text-align: center;">Evaluador :<b> <?php echo @$json->nombre_evaluador; ?></b></td>
					</tr>
				</tbody>
			</table>
		</div>	
    </div>
    <div class="tab-pane fade" id="Observaciones" role="tabpanel" aria-labelledby="observaciones-tab" aria-expanded="true">
        <div class="col-md-12">
            <div style=" width:100%; height:20px;"></div>
            <?php 
           		HtmlObservaciones();
            ?>
        </div>
        <?php #echo Observaciones(current_url()); ?>
    </div>
</div>
