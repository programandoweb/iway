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
$documento = DocumentoHonorarios(42);
?>
<table class="ancho cabecera" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td width="30%" colspan="2">
            <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:90px;" />
        </td>
        <td style="text-align:right; font-size:12px; font-weight:bold;" valign="top" colspan="15">
            <?php echo $empresa->nombre_legal?><br/>
            Nit: <?php echo $empresa->identificacion;?> | <?php echo $empresa->tipo_empresa;?><br />
            <?php echo $empresa->direccion;?><br />               
            PBX: <?php echo $empresa->cod_telefono;?>-<?php echo $empresa->telefono?><br />
            <?php echo $empresa->website;?><br/>
            <?php #pre($empresa); ?>
        </td>
    </tr>
</table>
<div class="footer bordetop pie_de_pagina">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="width:33%; text-align: left;font-size: 9px;color :black;">Fecha impresión documento <?php echo date('Y-m-d'); ?></td>
            <td style="text-align: center;font-size: 9px;"></td>
            <td style="width:33%; text-align: right;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
        </tr>
    </table>
</div>
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:10px; font-family:font-family: 'Montserrat', sans-serif;text-align: justify;">
	<div style="text-align: center;">
		<h4>Seguimiento y evalución <?php echo $documento->id_documento.' '.$row[0]->consecutivo; ?> <?php echo nombre(centrodecostos($row[0]->user_id)); ?></h4>
	</div>
	<table class="ancho" border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
			<tr class="colorFondo">
				<td  >Evaluador :</td>
				<td ><?php echo @$json->nombre_evaluador; ?></td>
				<td  >Modelo :</td>
				<td ><?php echo nombre(centrodecostos($row[0]->user_id)); ?></td>
			</tr>
		</tbody>
	</table>
	<div style="height: 40px;"></div>
	<table class="table" border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
			<tr class="colorFondo">
				<td class="bordeAll" colspan="2" style="text-align: center;"><b>Manejo informático.</b></td>
			</tr>
			<tr>
				<td class="bordeAll" width="50%" style="text-align: right;">Agilidad en el manejo del teclado.</td>
				<td class="bordeAll" width="50%" style="text-align: center;"><?php echo @$json->AgilidadTeclado; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_AgilidadTeclado)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_AgilidadTeclado; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll" style="text-align: right;">Uso de comando rápidos.</td>
				<td class="bordeAll" style="text-align: center;"><?php echo @$json->usoComandos; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_usoComandos)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_usoComandos; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll" style="text-align: right;">Uso de los recursos del navegador.</td>
				<td class="bordeAll" style="text-align: center;"><?php echo @$json->usoRecursosNavegador; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_usoRecursosNavegador)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_usoRecursosNavegador; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll" style="text-align: right;">Calidad de la imagen (configuración).</td>
				<td class="bordeAll" style="text-align: center;"><?php echo @$json->calidadImagen; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_calidadImagen)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_calidadImagen; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll" style="text-align: right;">Identificación de los errores de la página.</td>
				<td class="bordeAll" style="text-align: center;"><?php echo @$json->identificacionErrores; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_identificacionErrores)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_identificacionErrores; ?></td>
			</tr>
			<?php } 
			?>
			<tr class="colorFondo" style="text-align: right;">
				<td>
					<b>
						Total :
					</b>
				</td>
				<td style="text-align: center;">
					<?php
						echo @$json->AgilidadTeclado+@$json->usoComandos+@$json->usoRecursosNavegador+@$json->calidadImagen+@$json->identificacionErrores.' / 50';
					?>
				</td>
			</tr>
		</tbody>
	</table>
	<div style="height: 20px;"></div>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
			<tr class="colorFondo">
				<td class="bordeAll" colspan="2" style="text-align: center;"><b>Conocimiento del inglés.</b></td>
			</tr>
			<tr>
				<td class="bordeAll" width="50%" style="text-align: right;">Sostener conversaciones básicas, sin uso del traductor.</td>
				<td class="bordeAll" width="50%" style="text-align: center;"><?php echo @$json->conversacionesSinTraductor; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_conversacionesSinTraductor)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_conversacionesSinTraductor; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll" style="text-align: right;">Uso del traductor.</td>
				<td class="bordeAll" style="text-align: center;"><?php echo @$json->usoTraductor; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_usoTraductor)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_usoTraductor; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll" style="text-align: right;">Calidad de las traducciones.</td>
				<td class="bordeAll" style="text-align: center;"><?php echo @$json->calidadTraducciones; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_calidadTraducciones)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_calidadTraducciones; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll" style="text-align: right;">Conocimiento de jerga y abreviaturas.</td>
				<td class="bordeAll" style="text-align: center;"><?php echo @$json->conocimientoJerga; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_conocimientoJerga)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_conocimientoJerga; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll" style="text-align: right;">Conocimiento de palabras técnicas.</td>
				<td class="bordeAll" style="text-align: center;"><?php echo @$json->conocimientopalabrasTecnicas; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_conocimientopalabrasTecnicas)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_conocimientopalabrasTecnicas; ?></td>
			</tr>
			<?php } 
			?>
			<tr class="colorFondo" style="text-align: right;">
				<td>
					<b>
						Total :
					</b>
				</td>
				<td style="text-align: center;">
					<?php
						echo @$json->conversacionesSinTraductor+
							 @$json->usoTraductor+
							 @$json->calidadTraducciones+
							 @$json->conocimientoJerga+
							 @$json->conocimientopalabrasTecnicas.' / 50';
					?>
				</td>
			</tr>
		</tbody>
	</table>
	<div style="height: 20px;"></div>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
			<tr class="colorFondo">
				<td class="bordeAll" colspan="2" style="text-align: center;"><b>Apariencia física.</b></td>
			</tr>
			<tr>
				<td class="bordeAll" width="50%" style="text-align: right;">Estado del cabello.</td>
				<td class="bordeAll" width="50%" style="text-align: center;"><?php echo @$json->estadoCabello; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_estadoCabello)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_estadoCabello; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll" style="text-align: right;">Estado de las Uñas.</td>
				<td class="bordeAll" style="text-align: center;"><?php echo @$json->estadoUnas; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_estadoUnas)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_estadoUnas; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll" style="text-align: right;">Calidad del maquillaje.</td>
				<td class="bordeAll" style="text-align: center;"><?php echo @$json->calidadMaquillaje; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_calidadMaquillaje)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_calidadMaquillaje; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll" style="text-align: right;">Uso de Lencería adecuada.</td>
				<td class="bordeAll" style="text-align: center;"><?php echo @$json->usoLenceriaAdecuada; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_usoLenceriaAdecuada)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_usoLenceriaAdecuada; ?></td>
			</tr>
			<?php } ?>
			<?php 
			?>
			<tr class="colorFondo">
				<td>
					<b>
						Total :
					</b>
				</td>
				<td style="text-align: center;">
					<?php
						echo @$json->estadoCabello+
							 @$json->estadoUnas+
							 @$json->calidadMaquillaje+
							 @$json->usoLenceriaAdecuada.' / 40';
					?>
				</td>
			</tr>
		</tbody>
	</table>
	<div style="height: 20px;"></div>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
			<tr class="colorFondo">
				<td class="bordeAll" colspan="2" style="text-align: center;"><b>Buenas Costumbres.</b></td>
			</tr>
			<tr>
				<td class="bordeAll" width="50%" style="text-align: right;">Organización del room.</td>
				<td class="bordeAll" width="50%" style="text-align: center;"><?php echo @$json->OrganizacionRom; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_OrganizacionRom)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_OrganizacionRom; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll" style="text-align: right;">No se distrae con dispositivos personales.</td>
				<td class="bordeAll" style="text-align: center;"><?php echo @$json->NoSeDistraeConDispositivos; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_NoSeDistraeConDispositivos)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_NoSeDistraeConDispositivos; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll" style="text-align: right;">Solo usa el español cuando es necesario.</td>
				<td class="bordeAll" style="text-align: center;"><?php echo @$json->UsaEspanolCuandoEsNesc; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_UsaEspanolCuandoEsNesc)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_UsaEspanolCuandoEsNesc; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll" style="text-align: right;">No usa jerga latina en las traduccion.</td>
				<td class="bordeAll" style="text-align: center;"><?php echo @$json->NoJergaLatinaTraduccion; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_NoJergaLatinaTraduccion)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_NoJergaLatinaTraduccion; ?></td>
			</tr>
			<?php } ?>
			<tr class="colorFondo">
				<td>
					<b>
						Total :
					</b>
				</td>
				<td style="text-align: center;">
					<?php
						echo @$json->OrganizacionRom+
							 @$json->NoSeDistraeConDispositivos+
							 @$json->UsaEspanolCuandoEsNesc+
							 @$json->NoJergaLatinaTraduccion.' / 50';
					?>
				</td>
			</tr>
		</tbody>
	</table>
	<div style="height: 20px;"></div>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
			<tr class="colorFondo">
				<td class="bordeAll" colspan="2" style="text-align: center;"><b>Conocimiento Teórico.</b></td>
			</tr>
			<tr>
				<td class="bordeAll" width="50%" style="text-align: right;">Manejo de la plataforma de trasmisión.</td>
				<td class="bordeAll" width="50%" style="text-align: center;"><?php echo @$json->ManejoPlataforma; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_ManejoPlataforma)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_ManejoPlataforma; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll" style="text-align: right;">Movimientos delante de la cámara.</td>
				<td class="bordeAll" style="text-align: center;"><?php echo @$json->MovimientosCamara; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_MovimientosCamara)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_MovimientosCamara; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll" style="text-align: right;">Desarrollo de su show.</td>
				<td class="bordeAll" style="text-align: center;"><?php echo @$json->DesarrolloShow; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_DesarrolloShow)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_DesarrolloShow; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll" style="text-align: right;">Calidad en el uso de juguetes.</td>
				<td class="bordeAll" style="text-align: center;"><?php echo @$json->CalidadUsoJuguetes; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_CalidadUsoJuguetes)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_CalidadUsoJuguetes; ?></td>
			</tr>
			<?php } ?>
			<tr class="colorFondo">
				<td>
					<b>
						Total :
					</b>
				</td>
				<td style="text-align: center;">
					<?php
						echo 	@$json->ManejoPlataforma+
								@$json->MovimientosCamara+
								@$json->DesarrolloShow+
								@$json->CalidadUsoJuguetes.' / 40';
					?>
				</td>
			</tr>
		</tbody>
	</table>
	<div style="height: 20px;"></div>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
			<tr class="colorFondo">
				<td class="bordeAll" colspan="2" style="text-align: center;"><b>Uso de Tópics.</b></td>
			</tr>
			<tr>
				<td class="bordeAll" width="50%" style="text-align: right;">Pública topics en las páginas necesarias.</td>
				<td class="bordeAll" width="50%" style="text-align: center;"><?php echo @$json->publicaTopics; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_publicaTopics)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_publicaTopics; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll" style="text-align: right;">Estructura del topic.</td>
				<td class="bordeAll" style="text-align: center;"><?php echo @$json->EstructuraTopic; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_EstructuraTopic)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_EstructuraTopic; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll" style="text-align: right;">Coherencia en la redacción del topic.</td>
				<td class="bordeAll" style="text-align: center;"><?php echo @$json->CoherenciaRedaccionTopic; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_CoherenciaRedaccionTopic)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_CoherenciaRedaccionTopic; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll" style="text-align: right;">Relación entre el topic y el Show.</td>
				<td class="bordeAll" style="text-align: center;"><?php echo @$json->RelTopicShow; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_RelTopicShow)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_RelTopicShow; ?></td>
			</tr>
			<?php } ?>
			<tr class="colorFondo">
				<td>
					<b>
						Total :
					</b>
				</td>
				<td style="text-align: center;">
					<?php
						echo 	@$json->publicaTopics+
								@$json->EstructuraTopic+
								@$json->CoherenciaRedaccionTopic+
								@$json->RelTopicShow.' / 40';
					?>
				</td>
			</tr>
		</tbody>
	</table>
	<div style="height: 20px;"></div>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
			<tr class="colorFondo">
				<td class="bordeAll" colspan="2" style="text-align: center;"><b>Expresión Corporal.</b></td>
			</tr>
			<tr>
				<td class="bordeAll" width="50%" style="text-align: right;">Expresión de alegría.</td>
				<td class="bordeAll" width="50%" style="text-align: center;"><?php echo @$json->ExpresionAlegria; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_ExpresionAlegria)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_ExpresionAlegria; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll" style="text-align: right;">Gesticulación.</td>
				<td class="bordeAll" style="text-align: center;"><?php echo @$json->Gesticulacion; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_Gesticulacion)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_Gesticulacion; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll" style="text-align: right;">Coordinación motriz.</td>
				<td class="bordeAll" style="text-align: center;"><?php echo @$json->CordinacionMotriz; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_CordinacionMotriz)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_CordinacionMotriz; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll" style="text-align: right;">Postura corporal.</td>
				<td class="bordeAll" style="text-align: center;"><?php echo @$json->Postura; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_Postura)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_Postura; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll" style="text-align: right;">Interacción con los usuarios.</td>
				<td class="bordeAll" style="text-align: center;"><?php echo @$json->Interaccion; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_Interaccion)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_Interaccion; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll" style="text-align: right;">Calidad del baile.</td>
				<td class="bordeAll" style="text-align: center;"><?php echo @$json->CalidadBaile; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_CalidadBaile)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_CalidadBaile; ?></td>
			</tr>
			<?php } ?>
			<tr class="colorFondo">
				<td>
					<b>
						Total :
					</b>
				</td>
				<td style="text-align: center;">
					<?php
						echo 	@$json->ExpresionAlegria+
								@$json->Gesticulacion2+
								@$json->CordinacionMotriz+
								@$json->Postura+
								@$json->Interaccion+
								@$json->CalidadBaile.' / 60';
					?>
				</td>
			</tr>
		</tbody>
	</table>
	<div style="height: 20px;"></div>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
			<tr class="colorFondo">
				<td class="bordeAll" colspan="2" style="text-align: center;"><b>Personalidad.</b></td>
			</tr>
			<tr>
				<td class="bordeAll" width="50%" style="text-align: right;">Astucia femenina.</td>
				<td class="bordeAll" width="50%" style="text-align: center;"><?php echo @$json->Astucia; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_Astucia)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_Astucia; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll" style="text-align: right;">Capacidades sexuales.</td>
				<td class="bordeAll" style="text-align: center;"><?php echo @$json->CapacidadesSexuales; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_CapacidadesSexuales)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_CapacidadesSexuales; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll" style="text-align: right;">Correcta interpretación de su Rol.</td>
				<td class="bordeAll" style="text-align: center;"><?php echo @$json->InterpretacionRol; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_InterpretacionRol)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_InterpretacionRol; ?></td>
			</tr>
			<?php } ?>
			<tr class="colorFondo">
				<td>
					<b>
						Total :
					</b>
				</td>
				<td style="text-align: center;">
					<?php
				echo @$json->Astucia+
						@$json->CapacidadesSexuales+
						@$json->InterpretacionRol.' / 30';
					?>
				</td>
			</tr>
		</tbody>
	</table>
	<div style="height: 20px;"></div>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
			<tr class="colorFondo">
				<td class="bordeAll" colspan="2" style="text-align: center;"><b>Conversaciones.</b></td>
			</tr>
			<tr>
				<td class="bordeAll" width="50%" style="text-align: right;">Conocimiento ortográfico.</td>
				<td class="bordeAll" width="50%" style="text-align: center;"><?php echo @$json->Ortografia; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_Ortografia)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_Ortografia; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll" style="text-align: right;">Uso de regionalismos.</td>
				<td class="bordeAll" style="text-align: center;"><?php echo @$json->Regionalismos; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_Regionalismos)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_Regionalismos; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll" style="text-align: right;">Coherencia en la conversación.</td>
				<td class="bordeAll" style="text-align: center;"><?php echo @$json->CoherenciaConversacion; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_CoherenciaConversacion)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_CoherenciaConversacion; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll" style="text-align: right;">Fluidez y calidad de la conversación.</td>
				<td class="bordeAll" style="text-align: center;"><?php echo @$json->FluidezConversacion; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_FluidezConversacion)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_FluidezConversacion; ?></td>
			</tr>
			<?php } ?>
			<tr class="colorFondo">
				<td>
					<b>
						Total :
					</b>
				</td>
				<td style="text-align: center;">
					<?php
				echo @$json->Ortografia+
				@$json->Regionalismos+
				@$json->CoherenciaConversacion+
				@$json->FluidezConversacion.' / 40';					?>
				</td>
			</tr>
		</tbody>
	</table>
	<div style="height: 20px;"></div>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
			<tr class="colorFondo">
				<td class="bordeAll" colspan="2" style="text-align: center;"><b>Calidad y Tiempos del Desnudo.</b></td>
			</tr>
			<tr>
				<td class="bordeAll" width="50%" style="text-align: right;">Hace el desnudo de forma correcta.</td>
				<td class="bordeAll" width="50%" style="text-align: center;"><?php echo @$json->Desnudo; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_Desnudo)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_Desnudo; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll" style="text-align: right;">Calidad del striptease.</td>
				<td class="bordeAll" style="text-align: center;"><?php echo @$json->CalidadStriptease; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_CalidadStriptease)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_CalidadStriptease; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll" style="text-align: right;">Calidad del Show Free.</td>
				<td class="bordeAll" style="text-align: center;"><?php echo @$json->CalidadShow; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_CalidadShow)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_CalidadShow; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll" style="text-align: right;">Sensualidad en los movimientos.</td>
				<td class="bordeAll" style="text-align: center;"><?php echo @$json->SensualidadMovimientos; ?> / 10</td>
			</tr>
			<?php if(!empty(@$json->Ob_SensualidadMovimientos)){ ?>
			<tr>
				<td class="bordeAll" colspan="2" style="text-align: justify; padding:20px;"><?php echo @$json->Ob_SensualidadMovimientos; ?></td>
			</tr>
			<?php } ?>
			<tr class="colorFondo">
				<td>
					<b>
						Total :
					</b>
				</td>
				<td style="text-align: center;">
					<?php
						echo 	@$json->Desnudo+
								@$json->CalidadStriptease+
								@$json->CalidadShow+
								@$json->SensualidadMovimientos.' / 40';
					?>
				</td>
			</tr>
		</tbody>
	</table>					
</div>
