<?php
$modulo		=	$this->ModuloActivo;
$row		=	$this->$modulo->result;
$json = json_decode($row[0]->data);
$modelo = centrodecostos($json->id_modelo);
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
<?php $empresa = centrodecostos($modelo->id_empresa); ?>
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:10px; font-family:font-family: 'Montserrat', sans-serif;text-align: justify;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:30px;">
        <tr style="padding: 0;margin:0; width:100%;">
            <td style="padding: 0;margin:0;width:60%;">
               <div class="recuadro margen_derecha bordeAll">    
                  <div class="colorFondo"><b>Datos Modelo</b></div>
                  <table>
                      <tr>
                        <td>
                            <b><?php echo nombre($modelo); ?></b>
                        </td>
                      </tr>
                      <tr>
                          <td>Documento: <b><?php echo @$modelo->identificacion; ?></b></td>
                      </tr>
                      <tr>
                          <td>Dirección: <b><?php echo @$modelo->direccion;; ?></b></td>
                      </tr>
                      <tr>
                          <td>Ciudad: <b><?php echo @$modelo->ciudad; ?> </td>
                      </tr>
                      <tr>
                          <td>Teléfono: <b><?php echo (!empty($modelo->telefono)?$modelo->telefono:"N.A."); ?></b></td>
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
                                Entrega Room: 
                             </td>
                             <td>
                                <b>
                                    <?php echo $json->room; ?>
                                </b> 
                             </td>
                         </tr>
                         <tr>
                             <td>Fecha de Expedición:</td>
                             <td><b><?php echo substr($json->fecha, 0,10);?></b></td>
                         </tr>
                         <tr>
                             <td>Fecha de Vencimiento:</td>
                             <td><b><?php echo substr($json->fecha, 0,10);?></b></td>
                         </tr>
                         <tr>
                             <td>Estado:</td>
                             <td>
                                <b>
                                	Procesado
                                </b>
                            </td>
                         </tr>
                         <tr>
                             <td>Sucursal:</td>
                             <td></b><?php echo str_replace("_","",$json->turnos); ?></b></td>
                         </tr>
                     </table>
                </div>              
            </td>
        </tr>
    </table>
	<div style="height: 20px;"></div>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
			<tr class="colorFondo">
				<td class="bordeAll"colspan="2" style="text-align: center;"><b>Higiene y Asepxia.</b></td>
			</tr>
			<tr>
				<td class="bordeAll"width="50%" style="text-align: right;">Suelo barrido, trapeado y desinfectado.</td>
				<td class="bordeAll"width="50%" style="text-align: center;"><?php echo SiNo(@$json->suelo); ?></td>
			</tr>
			<?php if(!empty(@$json->ob_suelo)){ ?>
			<tr>
				<td class="bordeAll"colspan="2"><?php echo $json->ob_suelo; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll"style="text-align: right;">Cama sin sabanas (solo protectores plásticos).</td>
				<td class="bordeAll"style="text-align: center;"><?php echo SiNo(@$json->cama); ?></td>
			</tr>
			<?php if(!empty(@$json->ob_cama)){ ?>
			<tr>
				<td class="bordeAll"colspan="2"><?php echo @$json->ob_cama; ?></td>
			</tr>
			<?php } ?>
			<!--<tr>
				<td class="bordeAll"style="text-align: right;">Plástico protector de colchón desinfectado.</td>
				<td class="bordeAll"style="text-align: center;"><?php echo SiNo(@$json->plastico); ?></td>
			</tr>
			<?php if(!empty($json->ob_plastico)){ ?>
			<tr>
				<td class="bordeAll"colspan="2"><?php echo @$json->ob_plastico; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll"style="text-align: right;">Accesorios desinfectados.</td>
				<td class="bordeAll"style="text-align: center;"><?php echo SiNo(@$json->accesorios); ?></td>
			</tr>
			<?php if(!empty(@$json->ob_accesorios)){ ?>
			<tr>
				<td class="bordeAll"colspan="2"><?php echo @$json->ob_accesorios; ?></td>
			</tr>
			<?php } ?>-->
			<tr>
				<td class="bordeAll"style="text-align: right;">Polvo y manchas de las mesas, limpio.</td>
				<td class="bordeAll"style="text-align: center;"><?php echo SiNo(@$json->polvo); ?></td>
			</tr>
			<?php if(!empty(@$json->ob_polvo)){ ?>
			<tr>
				<td class="bordeAll"colspan="2"><?php echo @$json->ob_polvo; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll"style="text-align: right;">Manchas en el suelo, mesas auxiliares, paredes.</td>
				<td class="bordeAll"style="text-align: center;"><?php echo SiNo(@$json->manchas); ?></td>
			</tr>
			<?php if(!empty(@$json->ob_manchas)){ ?>
			<tr>
				<td class="bordeAll"colspan="2"><?php echo @$json->ob_manchas; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll"style="text-align: right;">Manchas en: tendidos, base de cama, almohadas.</td>
				<td class="bordeAll"style="text-align: center;"><?php echo SiNo(@$json->tendidos); ?></td>
			</tr>
			<?php if(!empty($json->ob_tendidos)){ ?>
			<tr>
				<td class="bordeAll"colspan="2"><?php echo @$json->ob_tendidos; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll"style="text-align: right;">Cristal de la cámara limpio.</td>
				<td class="bordeAll"style="text-align: center;"><?php echo SiNo(@$json->cristal); ?></td>
			</tr>
			<?php if(!empty($json->ob_cristal)){ ?>
			<tr>
				<td class="bordeAll"colspan="2"><?php echo @$json->ob_cristal; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll"style="text-align: right;">Lámparas en buen estado (bombillas y cables).</td>
				<td class="bordeAll"style="text-align: center;"><?php echo SiNo(@$json->lampara); ?></td>
			</tr>
			<?php if(!empty(@$json->ob_lampara)){ ?>
			<tr>
				<td class="bordeAll"colspan="2"><?php echo @$json->ob_lampara; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll"style="text-align: right;">Armario y cosas personales ordenados y ubicados.</td>
				<td class="bordeAll"style="text-align: center;"><?php echo SiNo(@$json->armario); ?></td>
			</tr>
			<?php if(!empty(@$json->ob_armario)){ ?>
			<tr>
				<td class="bordeAll"colspan="2"><?php echo @$json->ob_armario; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll"style="text-align: right;">Ventilador funcionando.</td>
				<td class="bordeAll"style="text-align: center;"><?php echo SiNo(@$json->ventilador); ?></td>
			</tr>
			<?php if(!empty(@$json->ob_ventilador)){ ?>
			<tr>
				<td class="bordeAll"colspan="2"><?php echo @$json->ob_ventilador; ?></td>
			</tr>
			<?php } 
				    @$json->turnos;
				    @$json->room;
				    @$json->id_modelo;
				    @$json->suelo;
				    @$json->cama;
				    @$json->plastico;
				    @$json->accesorios;
				    @$json->polvo;
				    @$json->manchas;
				    @$json->tendidos;
				    @$json->cristal;
				    @$json->lampara;
				    @$json->armario;
				    @$json->ventilador; 
			?>
		</tbody>
	</table>
	<div style="height: 20px;"></div>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
			<tr>
				<td class="bordeAll colorFondo"colspan="2" style="text-align: center;"><b>Estado de los Equipos Informáticos</b></td>
			</tr>
			<tr>
				<td class="bordeAll"width="50%" style="text-align: right;">Pc encendido y funcionando.</td>
				<td class="bordeAll"width="50%" style="text-align: center;"><?php echo SiNo(@$json->pc); ?></td>
			</tr>
			<?php if(!empty(@$json->ob_pc)){ ?>
			<tr>
				<td class="bordeAll"colspan="2"><?php echo @$json->ob_pc; ?></td>
			</tr>
			<?php } ?>
			<!--<tr>
				<td class="bordeAll"style="text-align: right;">Todas la luces prendidas.</td>
				<td class="bordeAll"style="text-align: center;"><?php echo SiNo(@$json->luces); ?></td>
			</tr>
			<?php if(!empty(@$json->ob_luces)){ ?>
			<tr>
				<td class="bordeAll"colspan="2"><?php echo @$json->ob_luces; ?></td>
			</tr>
			<?php } ?>-->
			<tr>
				<td class="bordeAll"style="text-align: right;">Cámara con la aplicación abierta.</td>
				<td class="bordeAll"style="text-align: center;"><?php echo SiNo(@$json->camara); ?></td>
			</tr>
			<?php if(!empty(@$json->ob_camara)){ ?>
			<tr>
				<td class="bordeAll"colspan="2"><?php echo @$json->ob_camara; ?></td>
			</tr>
			<?php } ?>
			<!--<tr>
				<td class="bordeAll"style="text-align: right;">Estado de la cámara web (operativa).</td>
				<td class="bordeAll"style="text-align: center;"><?php echo SiNo(@$json->estado); ?></td>
			</tr>
			<?php if(!empty(@$json->ob_estado)){ ?>
			<tr>
				<td class="bordeAll"colspan="2"><?php echo @$json->ob_estado; ?></td>
			</tr>
			<?php } ?>-->
			<tr>
				<td class="bordeAll"style="text-align: right;">Parlantes sonando.</td>
				<td class="bordeAll"style="text-align: center;"><?php echo SiNo(@$json->parlantes); ?></td>
			</tr>
			<?php if(!empty(@$json->ob_parlantes)){ ?>
			<tr>
				<td class="bordeAll"colspan="2"><?php echo @$json->ob_parlantes; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="bordeAll"style="text-align: right;">Golpes, roturas, cables, en buen estado.</td>
				<td class="bordeAll"style="text-align: center;"><?php echo SiNo(@$json->golpes); ?></td>
			</tr>
			<?php if(!empty(@$json->ob_golpes)){ ?>
			<tr>
				<td class="bordeAll"colspan="2"><?php echo @$json->ob_golpes; ?></td>
			</tr>
			<?php } ?> 
			<!--<tr>
				<td class="bordeAll"style="text-align: right;">	Clavija del internet en buen estado.</td>
				<td class="bordeAll"style="text-align: center;"><?php echo SiNo(@$json->clavija); ?></td>
			</tr>
			<?php if(!empty(@$json->ob_clavija)){ ?>
			<tr>
				<td class="bordeAll"colspan="2"><?php echo @$json->ob_clavija; ?></td>
			</tr>
			<?php } ?> 
			<tr>
				<td class="bordeAll"style="text-align: right;">Cables del PC amarrados y en buen estado.</td>
				<td class="bordeAll"style="text-align: center;"><?php echo SiNo(@$json->cables); ?></td>
			</tr>
			<?php if(!empty($json->ob_cables)){ ?>
			<tr>
				<td class="bordeAll"colspan="2"><?php echo @$json->ob_cables; ?></td>
			</tr>
			<?php } 
				@$json->pc; 
			    @$json->luces; 
			    @$json->camara; 
			    @$json->estado; 
			    @$json->parlantes; 
			    @$json->golpes; 
			    @$json->clavija; 
			    @$json->cables;
			?>-->
		</tbody>
	</table>
	<div style="height: 20px;"></div>
    <div class="recuadro fondoCell bordeAll">    
        <div class="colorFondo">
            <b>Importante:</b>
        </div>
        <table>
            <tr>
                <td style="text-align: justify;">
                    Certifico (certificamos) que esta operación ha sido verificada de manera detallada antes de su respectivo procesamiento.
                    <?php echo(!empty($json->responsable))?" Documento elaborado por <b>".$json->responsable.'</b>':''; ?>
                </td>
            </tr>
        </table>
        <div style="width: 100%;">
            <div style="height: 40px;"></div>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="45%">
                            <div class="bordetop linea">
                                Elaboró:
                            </div>
                        </td>
                        <td width="10%"> </td>
                        <td width="45%"> 
                            <div class="bordetop linea"> 
                                Revisó:
                            </div>
                        </td>
                    </tr>
            </table> 
        </div>
    </div> 		
</div>
