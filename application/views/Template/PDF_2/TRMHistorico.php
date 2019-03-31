<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
    $OpcionesFactura    =   getOpcionesFactura($empresa->user_id);
    $modulo	=	$this->ModuloActivo;
	$rows	=	$this->$modulo->result;
        $reg=count($rows);
        $num=$reg/37;
        $Pag=ceil($num)-1;
        $numPag=0;
        $n = array_chunk($rows, 37);     
        for($i=0;$i<=$Pag;$i++){
        $numPag++;
        if($i>0){    
?>
<div style="page-break-after:always;"></div>
<?php } ?>
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif;">
    <table class="ancho" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td width="30%" colspan="2">
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
    <div style="height: 30px;"></div>
	<table border="0" cellpadding="0" cellspacing="0" width="540" class="table">
        <thead>
        	<tr class="colorFondo">
	            <th colspan="2">Fecha</th>
	            <th>TRM</th>	
        	</tr>
        </thead>
        <tbody>	
			<?php foreach($n[$i] as $k => $v){?>
                <tr>
                	<td class="bordeAll" colspan="2"><?php print ($v->fecha)?></td>
                    <td style="text-align: right;" class="bordeAll"><?php print(format($v->monto,false))?></td>
                </tr>
			<?php }?>
         </tbody>
    </table>
    <?php
    if($this->uri->segment($this->uri->total_segments())!=="PDF"){
        if($i==$Pag){
    ?>
        <table>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td rowspan="4"></td>
                <td></td>
                <td rowspan="4">
                    <?php
                        if(!empty($empresa->firma)){
                                echo '<img src="'. img_firma($empresa->firma).'" style="width:153px;height:55px;" />';
                        }
                    ?>
                </td> 
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td class="bordetop" width="200">
                    Aprobado:
                </td>
                <td width="100"></td>
                <td class="bordetop" width="200">
                    <?php
                        if(@$OpcionesFactura->firmaFac==1){
                            echo $empresa->nombre_representante_legal.' C.C. '.$empresa->nro_identificacion_representante_legal;
                        }else{
                            echo 'Firma y sello autorizado';
                        }
                    ?> 
                </td>    
            </tr>
            <tr></tr>
            <tr></tr>
        </table>
    <?php } ?>
        <table>
            <tr></tr>
            <tr></tr>
             <tr>
                <td class="bordetop">
                    Fecha impresión documento <?php echo date('Y-m-d'); ?>
                </td>
                <td class="bordetop">
                    Página <?php echo $numPag.' / '.($Pag+1); ?>
                </td>
                <td class="bordetop">
                    Powered by LogicSoft&reg; | www.webcamplus.com.co
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <?php if(!empty($OpcionesFactura->resolucionFac)){echo $OpcionesFactura->resolucionFac;}else{echo 'La presente resolución aplica únicamente a los documentos de venta que se registren después de grabados estos cambios.';} ?>
                </td>
            </tr>
            <tr></tr>
            <tr></tr>
        </table>
    </div>
<?php 
    }else{
        $m = 60;
         if($i==$Pag){
             $position=count($n[$i]);
                if($position < 35 ){
                     $x=(60*15)/$position;
                     $m=ceil($x);
                }
?>
                <div class="firmas" style="position:absolute;bottom:<?php echo $m; ?>;width: 100%;">
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
             <?php } ?>
<div class="footer bordetop" style="position: absolute; bottom:5px; width: 100%">
    <table>
        <tr>
            <td style="width:33%; text-align: left;font-size: 9px;color :black;">Fecha impresión documento <?php echo date('Y-m-d'); ?></td>
            <td style="text-align: center;font-size: 9px;">Página <?php echo $numPag.' / '.($Pag+1); ?></td>
            <td style="width:33%; text-align: right;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center;font-size: 9px;"><?php if(!empty($OpcionesFactura->resolucionFac)){echo $OpcionesFactura->resolucionFac;}else{echo 'La presente resolución aplica únicamente a los documentos de venta que se registren después de grabados estos cambios.';} ?></td>
        </tr>
    </table>
</div>
</div><?php } } ?>