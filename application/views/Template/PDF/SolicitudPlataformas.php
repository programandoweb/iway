<?php
$modulo		=	$this->ModuloActivo;
@$row		=	$this->$modulo->result;
@$json 		=   json_decode($row[0]->data);
$modelo 	= 	@centrodecostos($row[0]->user_id);
$centro_de_costos = @centrodecostos($row[0]->centro_de_costos);
$observaciones = getObservaciones(base_url($this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'#observaciones'));
//pre($row);
//pre($json);
//pre($modelo);
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
    <table>
        <tr>
            <td style="width:33%; text-align: left;font-size: 9px;color :black;">Fecha impresión documento <?php echo date('Y-m-d'); ?></td>
            <td style="text-align: center;font-size: 9px;"></td>
            <td style="width:33%; text-align: right;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
        </tr>
    </table>
</div>
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:10px; font-family:font-family: 'Montserrat', sans-serif;text-align: justify;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:30px;">
        <tr style="padding: 0;margin:0; width:100%;">
            <td style="padding: 0;margin:0;width:60%;">
               <div class="recuadro margen_derecha bordeAll">    
                  <div class="colorFondo"><b>Tercero</b></div>
                  <table>
                      <tr>
                        <td>
                            <b>
                                <?php
                                    echo @nombre($modelo); 
                                ?>
                            </b>
                        </td>
                      </tr>
                      <tr>
                          <td>Documento: <b><?php echo @$modelo->identificacion; ?></b></td>
                      </tr>
                      <tr>
                          <td>Dirección: <b><?php echo @$modelo->direccion;; ?></b></td>
                      </tr>
                      <tr>
                          <td>Ciudad: <b><?php echo @$modelo->ciudad; ?> (<?php echo $modelo->departamento; ?>)</td>
                      </tr>
                      <tr>
                          <td>Teléfono: <b><?php echo (!empty($modelo->telefono)?"(".$modelo->cod_telefono.") ".$modelo->telefono:"N.A."); ?></b></td>
                      </tr>
                  </table>
               </div>                   
            </td>        
            <td>
                <div class="recuadro bordeAll">
                    <div class="colorFondo"><b>Datos documento</b></div>
                     <table>
                         <tr>
                             <td width="120">
                                Solicitud Plataforma: 
                             </td>
                             <td>
                                <b>
                                    <?php echo @$centro_de_costos->abreviacion.' '.tipo_documento(50,true).' '.ceros($row[0]->consecutivo); ?>
                                </b> 
                             </td>
                         </tr>
                         <tr>
                             <td>Fecha de Expedición:</td>
                             <td><b><?php echo substr($json->fecha,0,11);?></b></td>
                         </tr>
                         <tr>
                             <td>Fecha de Vencimiento:</td>
                             <td><b><?php echo substr($json->fecha,0,11);?></b></td>
                         </tr>
                         <tr>
                             <td>Estado:</td>
                             <td>
                                <b>
									<?php echo verificaEstadoSolicitudPlataformas($row[0]->estado); ?>        
                                </b>
                            </td>
                         </tr>
                         <tr>
                             <td>Sucursal:</td>
                             <td></b><?php echo $centro_de_costos->abreviacion; ?></b></td>
                         </tr>
                     </table>
                </div>              
            </td>
        </tr>
    </table>
    <div style="height: 20px;"></div>
    <div><b>Detalle solicitud plataforma:</b></div>
    <div style="height: 20px;"></div>
	<div class="container">
		<div class="row justify-content-md-center">
	    	<div class="col">
	            <div class="row">
	            	<div class="col-md-12">
	                    <div class="tab-content row">
	    					<div class="tab-pane active col-md-12" id="datos" role="tabpanel">	
								<table class="ancho" border="0" cellpadding="0" cellspacing="0" width="100%">
									<thead>
										<tr class="colorFondo">
			                                <th class="text-center"><b>Descripción</b></th>
			                                <th class="text-center"><b>Contraseña</b></th>
			                                <th class="text-center"><b>Bloqueo País</b></th>
			                                <th class="text-center"><b>Prioridad</b></th>
										</tr>
									</thead>
									<tbody>
										<?php		
											foreach ($row as $k => $v) {
												$plataforma = json_decode(@$v->data);
										?>
										<tr>
											<td class="bordeAll" style="text-align:justify;">El usuario <b><?php echo @$json->responsable; ?></b>, ha realizado una solicitud de la plataforma <b><?php echo @$plataforma->plataforma; ?></b>, para el tercero <b><?php echo @nombre($modelo); ?></b> con nombre de usuario y/o nickname <b><?php echo @$plataforma->usuario; ?></b></td>
											<td class="bordeAll center"><?php echo @$plataforma->password; ?></td>
											<td class="bordeAll center"><?php echo SiNo($plataforma->bloquear_pais); ?></td>
											<td class="bordeAll center">
												<b>
													<?php echo verPrioridad($plataforma->prioridad); ?>
												</b>
											</td>
										</tr>
										<?php
											}
										?>
									</tbody>
								</table>
							</div>
							<div style="height: 20px;"></div>
							<h4><b>Observacion(es)</b></h4>
							<div class="tab-pane col-md-12" id="observaciones" role="tabpanel">
					            <div class="col-md-12">
						         	<table class="ancho" border="0" cellpadding="0" cellspacing="0" width="100%">
										<thead>
											<tr class="colorFondo">
												<th>
													Usuario
												</th>
												<th>
													Observación
												</th>
												<th class="center">
													Fecha
												</th>
											</tr>
										</thead>
										<tbody>
										<?php
											if(!empty($observaciones)){	
												foreach($observaciones as $k => $v){
										?> 
											 	<tr class="observaciones-tr">
												 	<td class="bordeAll">
														<?php echo nombre(centrodecostos($v->user_id)); ?>
												 	</td>
												 	<td class="bordeAll">
														<?php echo $v->observacion; ?> 
												 	</td>
												 	<td class="bordeAll center">
														<?php echo $v->fecha; ?> 
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
	                </div>
	            </div>
	        </div>
	    </div>
	</div>	
</div>
