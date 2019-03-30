<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php
	$OpcionesFactura    =   getOpcionesFactura($empresa->user_id);
	$modulo		=	$this->ModuloActivo;
	//pre($this->$modulo->result); return;
		$count			=	0;
		$ciclo			=	$this->$modulo->fields;
		$suma_token			=	0;
		$suma_equivalencia	=	0;

				if(count($this->$modulo->result)>0){
					foreach($this->$modulo->result as $v){
	?>
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif;">
    <table class="ancho" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td width="30%">
                <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:55px;" />
            </td>
            <td style="text-align:right; font-size:12px; font-weight:bold;" valign="top">
                <?php echo $empresa->nombre_legal?><br/>
                Nit: <?php echo $empresa->identificacion;?> | <?php echo $empresa->tipo_empresa;?><br />
                <?php echo $empresa->direccion;?><br />               
                PBX: <?php echo $empresa->cod_telefono;?>-<?php echo $empresa->telefono?><br/>
                <?php echo $empresa->website;?><br/>
                <?php #pre($empresa); ?>
            </td>
        </tr>
    </table> 
	<div style="height:60px;"></div>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
			<tr class="oscuro">
				<td>Fecha presentación novedad.</td>
				<td>
                    <?php 
						echo($v->fecha_enviado);
					?>
                </td>
            </tr>
            <tr class="claro">
            	<td>Nombre completo funcionario BELLE Colombia®</td>
            	<td>
					<?php echo $v->primer_nombre.' '; ?>
					<?php echo $v->segundo_nombre.' '; ?>
					<?php echo $v->primer_apellido.' '; ?>
					<?php echo $v->segundo_apellido.' '; ?>
            	</td>
            </tr>
            <tr class="oscuro">
            	<td>
            		Centro de costos al que perteneces.
            	</td>
            	<td>
            		<?php echo $v->nombre_legal; ?>
            	</td>
            </tr>
            <tr class="claro">
            	<td>
					<b>Estado</b>
                </td>
                <td>
					<?php 
						echo ($v->estado==0)?" Enviado ":" Leido ";
					?>										
                </td>
            </tr>
		</tbody>
	</table>
	<div style="height:30px;"></div>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<thead>
			<tr class="colorFondo">
				<th><b>Novedad</b></th>
                <th width="220" class="text-center"><b>Mensaje</b></th>
			</tr>
		</thead>
		<tbody>
			<tr>
            	<td class="bordeAll">
                	<?php 
						echo($v->asunto);
					?>
                </td>
                <td class="bordeAll">
					<?php 
						echo $v->mensaje;
					?>										
                </td>
            </tr>
		</tbody>
	</table>
    <?php		
			}
		}else{
	?>
	<?php		
		}
?>
                <div class="firmas" style="position:absolute;bottom:100px;width: 100%;">
                    <table class="ancho" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td></td>
                                <td>
                                    <?php
                                        if(!empty($empresa->firma)){
                                                echo '<img src="'. img_firma($empresa->firma).'" style="width:153px;height:55px;" />';
                                        }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="bordetop linea">
                                        Aprobado:
                                    </div>
                                </td>
                                <td> 
                                    <div class="bordetop linea">
                                        <?php
                                            if(@$OpcionesFactura->firmaFac==1){
                                                echo $empresa->nombre_representante_legal.' C.C. '.$empresa->nro_identificacion_representante_legal;
                                            }else{
                                                echo 'Firma y sello autorizado';
                                            }
                                        ?> 
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding-top:15px;">
                                    <?php 
                                        if(!empty($OpcionesFactura->piePaginaFac)){
                                            echo $OpcionesFactura->piePaginaFac;
                                        }else{
                                            echo 'Esta factura se asimila en todos sus efectos a una letra de cambio, de conformidad con el articulo 774 del código de comercio. Autorizo que en caso de incumplimiento de esta obligación sea reportado a las centrales de riesgo, se cobraran intereses por concepto de mora.';
                                        }
                                    ?>
                                </td>
                            </tr>
                    </table> 
                 </div>
<div class="footer bordetop" style="position: absolute; bottom:5px; width: 100%">
    <table>
        <tr>
            <td style="width:33%; text-align: left;font-size: 9px;color :black;">Fecha impresión documento <?php echo date('Y-m-d'); ?></td>
            <td style="text-align: center;font-size: 9px;">Página 1 / 1</td>
            <td style="width:33%; text-align: right;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center;font-size: 9px;"><?php if(!empty($OpcionesFactura->resolucionFac)){echo $OpcionesFactura->resolucionFac;}else{echo 'La presente resolución aplica únicamente a los documentos de venta que se registren después de grabados estos cambios.';} ?></td>
        </tr>
    </table>
</div>
</div>
