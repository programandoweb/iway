<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php
		$modulo		=	$this->ModuloActivo;
		$fecha 		= 	get_cf_ciclos_pagos_new($this->user->id_empresa,0);
		$dias_laborados	=	$this->$modulo->result["dias_laborados"];
		$items  =   $this->$modulo->result["data"];
?>
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
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
<div>
    <div style="height: 20px;"></div>
    <div style="text-align: center;"> Dias Asistidos</div>
	<?php
		$suma_token			=	0;
		$suma_equivalencia	=	0;
	?>
	<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:140px;">
		<thead class="bordeAll">
			<tr class="colorFondo">
				<th width="200"><b>Modelo</b></th>                                
                <?php 
					for($a=$fecha->desde;$a<=$fecha->hasta;$a++){
				?>	
                		<th class="thead-light"><b><?php echo $a?></b></th> 
                <?php	
					}
				?>
                <th width="20" class="text-center thead-light"><b>Total</b></th>  
			</tr>
		</thead>
		<tbody>
		 <?php foreach ($items as $k => $v){ ?>
		 	<tr>
				<td class="bordeAll">
                	
					<?php 
						print(nombre($v));
					?> 
                    
                </td>
               <?php 
			   		$contar_dias=0;
					for($a=$fecha->desde;$a<=$fecha->hasta;$a++){
				?>	
				<?php 	
						if (isset($dias_laborados[$v->user_id][$a])){
							$contar_dias++;
				?>
                            <td class="bordeAll" style="text-align: center;">
                                <b>
                                    X
                                </b>
                            </td>
				<?php		
						}else{
				?>
                            <td class="bordeAll" style="text-align: center;">
                                <b>
                                    -
                                </b>
                            </td>
                <?php		
						} 
				?>
                <?php	
					}
				?>
                 <td class="bordeAll" style="text-align: right;"><b><?php echo $contar_dias;?></b></td> 
			</tr>
		 <?php } ?>						
		</tbody>
	</table>
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
</div>