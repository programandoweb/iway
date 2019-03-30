<?php
/* 
    DESARROLLO Y PROGRAMACIÓN
    PROGRAMANDOWEB.NET
    LCDO. JORGE MENDEZ
    info@programandoweb.net
*/?>
<?php
    if(!@$this->user->id_empresa){
?>  
        <h3 class="text-center">Seleccione un Centro de Costos</h3>
<?php       
        return; 
    }       
    $modulo     =   $this->ModuloActivo;
    $row        =   $this->$modulo->result;
    $OpcionesFactura    =   getOpcionesFactura($empresa->user_id);
    $items = count($this->$modulo->result['detalle_ingreso']) + count($this->$modulo->result['registro_contable']);    
    $reg=count($items);
    $num=$reg/12;
    $Pag=ceil($num)-1;
    $numPag=0;
      for($i=0;$i<=$Pag;$i++){
    $numPag++;
?>

<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif;">
    <table class="ancho" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td width="30%" colspan="2">
                <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:55px;" />
            </td>
            <td style="text-align:right; font-size:12px; font-weight:bold;" valign="top" colspan="3">
                <?php echo $empresa->nombre_legal?><br/>
                Nit: <?php echo $empresa->identificacion;?> | <?php echo $empresa->tipo_empresa;?><br />
                <?php echo $empresa->direccion;?><br />               
                PBX: <?php echo $empresa->cod_telefono;?>-<?php echo $empresa->telefono?><br/>
                <?php echo $empresa->website;?><br/>
                <?php #pre($empresa); ?>
            </td>
        </tr>
    </table>
    <div style="height: 40px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="540" class="table">
        <thead>
            <tr class="colorFondo">
                <th>Cliente</th>
                <th>Fecha</th>
                <th>ID Cliente</th>
                <th>Dirección</th>
                <th>Ciclo de producción</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="bordeAll">
                    <?php 
                        //pre($this->$modulo);
                        echo $this->$modulo->factura->nombre_cliente;
                    ?>
                </td>
                <td class="bordeAll" style="text-align: center;"><?php echo $row[0]->fecha;?></td>
                <td class="bordeAll" style="text-align: center;"><?php echo $this->$modulo->factura->Nit;?></td>
                <td class="bordeAll" style="text-align: center;">
                    <?php echo str_replace($this->$modulo->factura->Pais,"",$this->$modulo->factura->Direccion)?>
                </td>
                <td class="bordeAll" style="text-align: center;">
                    <?php echo $this->$modulo->factura->ciclo_de_produccion?>
                </td>
            </tr>
        </tbody>
    </table>
    <div style=" width:100%; height:20px;"></div>
    <div style="text-align: center;">
        <b>Detalle de Ingreso</b>
    </div>
    <div style=" width:100%; height:20px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="540" class="table">
        <thead class="bordeAll">
            <tr class="colorFondo">
                <th colspan="3"><b>Concepto</b></th>
                <th width="100" class="text-center"><b>Documento</b></th>
                <th width="100" class="text-right"><b>Valor</b></th>
            </tr>
        </thead>
        <tbody>
            <?php
                //pre($this->$modulo->result);
                foreach($this->$modulo->result['detalle_ingreso'] as $k=>$v){?>
                <tr>
                    <td class="bordeAll" colspan="3">Cancelación / Abono Factura de Ventas</td>
                    <td class="bordeAll" style="text-align: center;"><?php print_r($this->$modulo->factura->consecutivo);?></td>
                    <td class="bordeAll" style="text-align: right;"><?php print(format($v->debito,true));?></td>
                </tr>                   
            <?php }?>
        </tbody>  
    </table> 
    <div style=" width:100%; height:20px;"></div>
    <div style="text-align: center;">
        <b>Registro Contable</b>
    </div>
    <div style=" width:100%; height:20px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="540" class="table">
        <thead class="bordeAll">
            <tr class="colorFondo">
                <th width="100"><b>Cuenta</b></th>
                <th colspan="2"><b>Concepto Contable</b></th>
                <th width="100" class="text-center"><b>Débito</b></th>
                <th width="100" class="text-center"><b>Crédito</b></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $debito     =   0;
                $credito    =   0;
                $items      =   items_factura_contable($this->uri->segment(5),array("414580","130510"),array("tipo_documento"=>5));
                foreach($this->$modulo->result['registro_contable'] as $k=>$v){
            ?>                       
                <tr>
                    <td class="bordeAll" style="text-align: center;">
                        <?php
                            print($v->codigo_contable);
                        ?>
                    </td>
                    <td class="bordeAll" colspan="2">
                        <?php 
                            print(get_codigo_contable($v->codigo_contable)->cuenta_contable);
                        ?>
                        <?php 
                            
                            //echo entidad_bancaria($v);
                        ?>
                    </td>
                    <td class="bordeAll" style="text-align: right;">
                        <?php
                                $debito +=  @$v->debito;
                                print(format(@$v->debito,true));
                        ?>
                    </td>
                    <td class="bordeAll" style="text-align: right;">
                        <?php
                                $credito +=$v->credito;
                                print(format($v->credito,true));
                        ?>
                    </td>
                </tr>
            <?php }?>
        </tbody>                    
    </table>
       <?php
            if($this->uri->segment($this->uri->total_segments())!=="PDF"){?>
                <table>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="1"></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="1"></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td colspan="2" rowspan="4"></td>
                        <td colspan="1"></td>
                        <td colspan="2" rowspan="4">
                            <?php
                                if(!empty($empresa->firma)){
                                        echo '<img src="'. img_firma($empresa->firma).'" style="width:153px;height:55px;" />';
                                }
                            ?>
                        </td> 
                    </tr>
                    <tr>
                        <td colspan="1"></td>
                    </tr>
                    <tr>
                        <td colspan="1"></td>
                    </tr>
                    <tr>
                        <td colspan="1"></td>
                    </tr>
                    <tr>
                        <td colspan="1"></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="bordetop" width="200">
                            Aprobado:
                        </td>
                        <td colspan="1" width="100"></td>
                        <td colspan="2" class="bordetop" width="200">
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
                    <tr>
                        <td colspan="2" class="bordetop">
                            Fecha impresión documento <?php echo date('Y-m-d'); ?>
                        </td>
                        <td colspan="1" class="bordetop">
                            Página <?php echo $numPag.' / '.($Pag+1); ?>
                        </td>
                        <td colspan="2" class="bordetop">
                            Powered by LogicSoft&reg; | www.webcamplus.com.co
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <?php if(!empty($OpcionesFactura->resolucionFac)){echo $OpcionesFactura->resolucionFac;}else{echo 'La presente resolución aplica únicamente a los documentos de venta que se registren después de grabados estos cambios.';} ?>
                        </td>
                    </tr>
                </table>
            </div>
        <?php
            }else{
         if($i==$Pag){
             $position=count($items);
                if($position > 4){
                     $x=(370*12)/$position;
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
            <td colspan="2" style="text-align: center;font-size: 9px;"><?php if(!empty($OpcionesFactura->resolucionFac)){echo $OpcionesFactura->resolucionFac;}else{echo 'La presente resolución aplica únicamente a los documentos de venta que se registren después de grabados estos cambios.';} ?></td>
        </tr>
    </table>
</div>
</div><?php } }?>