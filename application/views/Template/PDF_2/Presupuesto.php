<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
	
	Agregar
	<i class="fa fa-plus" aria-hidden="true"></i>
	Ver
	<i class="fa fa-search" aria-hidden="true"></i>
	Editar
	<i class="fas fa-edit" aria-hidden="true"></i>
*/?>
<?php 
    $modulo		=	$this->ModuloActivo;
    $OpcionesFactura    =   getOpcionesFactura($empresa->user_id);
    $items = $this->$modulo->result;
    $reg=count($items);
    $num=$reg/8;
    $Pag=ceil($num)-1;
    $numPag=0; 
    $n = array_chunk($items, 8);           
    for($i=0;$i<=$Pag;$i++){
    $numPag++;
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
    <div style="height: 20px;"></div>
    <div style="text-align: center;"><b>Detalle presupuesto</b></div>
    <div style="height: 20px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:30px;">
        <thead class="bordeAll">
            <tr class="colorFondo">
                <th><b>Tipo de Gasto</b></th>
                <th class="text-center"><b>Concepto Gasto</b></th>
                <th class="text-center"><b>Observación</b></th>
                <th class="text-right" width="120"><b>Valor</b></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $Total=0;
                if(count($this->$modulo->result)>0){
                    foreach($this->$modulo->result as $v){
            ?>
                        <tr>
                            <td class="bordeAll">
                                <?php echo($v->tipo_gasto); ?>
                            </td>
                            <td class="bordeAll">
                                <?php echo($v->concepto_gasto); ?>
                            </td>
                            <td class="bordeAll">
                                <?php echo($v->observacion); ?>
                            </td>
                            <td class="bordeAll">
                                <?php 
                                $Total+=$v->valor;
                                echo format($v->valor,true);
                                //set_input_dinamico("valor",$v,null,false,"input_dinamico"); ?>                      	
                            </td>	
                        </tr>
            <?php		
                    }
                }else{
            ?>
                        <tr>
                            <td colspan="4" style="text-align: center;">
                                No se encontraron registros
                            </td>
                        </tr>
            <?php		
                }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td ></td>
                <td ></td>
                <td class="colorFondo"><b>Total</b></td>                               
                <td class="colorFondo"><b><?php echo format($Total); ?></b></td>
            </tr>
        </tfoot>
    </table>
<?php 
     if($i==$Pag){
         $position=count($items);
            if($position > 4){
                 $x=(30*12)/$position;
                 $m=ceil($x);
            }else{
                 $m=56;
            }
?>
    <div class="firmas" style="position:absolute;bottom:<?php echo $m ?>;width: 100%;">
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
</div><?php } ?>


