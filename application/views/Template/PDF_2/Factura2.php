<?php
/* 
    DESARROLLO Y PROGRAMACIÓN
    PROGRAMANDOWEB.NET
    LCDO. JORGE MENDEZ
    info@programandoweb.net
*/?>
<?php
    $modulo     =   $this->ModuloActivo;
    if($this->user->type=='Modelos' || empty($this->$modulo->result)){
        //redirect(base_url("Reportes/FacturaVentas")); 
        return; 
    }
    //pre($this->$modulo->result);
        $OpcionesFactura    = json_decode(getOpcionesFactura($this->$modulo->result->consecutivo)->json);
        //pre($OpcionesFactura);
        $items      =   items_factura_contable($this->uri->segment(3),array("414580","130510"),array("tipo_documento"=>"1"));
        $reg=count($items);
        $num=$reg/22;
        $Pag=ceil($num)-1;
        $numPag=0;
        $n=array_chunk($items,22);
        $credito            =   items_factura_contable($this->uri->segment(3),array("414580","130510"),array("tipo_documento"=>"1"));
        $monto=0;
        foreach($credito as $k =>$v){
           $monto   +=    json_decode($v->json)->monto_global_usd;       
        } 
        //pre($items);
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
            <td style="text-align:right; font-size:12px; font-weight:bold;" valign="top" colspan="4">
                <?php echo $empresa->nombre_legal?><br/>
                Nit: <?php echo $empresa->identificacion;?> | <?php echo $empresa->tipo_empresa;?><br />
                <?php echo $empresa->direccion;?><br />               
                PBX: <?php echo $empresa->cod_telefono;?>-<?php echo $empresa->telefono?><br/>
                <?php echo $empresa->website;?><br/>
                <?php #pre($empresa); ?>
            </td>
        </tr>
    </table> 
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:30px;">
        <tr style="padding: 0;margin:0; width:100%;">
            <td style="padding: 0;margin:0;width:60%;">
               <div class="recuadro margen_derecha fondoCell bordeAll">    
                  <div class="colorFondo"><b>Datos Cliente</b></div>
                  <table>
                      <tr>
                          <td><b><?php echo $this->$modulo->result->nombre_cliente;?></b></td>
                      </tr>
                      <tr>
                          <td>NIT (Id): <?php print ( $this->$modulo->result->Nit )?></td>
                      </tr>
                      <tr>
                          <td>Dirección: <?php print($this->$modulo->result->Direccion)?></td>
                      </tr>
                      <tr>
                          <td>Ciudad: <?php echo ( $this->$modulo->result->Ciudad )?></td>
                      </tr>
                  </table>
               </div>                   
            </td>        
            <td>
                <div class="recuadro fondoCell bordeAll">
                    <div class="colorFondo"><b>Datos documento</b></div>
                     <table>
                         <tr>
                             <td><b><?php if(!empty($OpcionesFactura->nombreDocumentoFac)){ echo $OpcionesFactura->nombreDocumentoFac;}else{ echo 'Factura de Venta';} ?></b>:</td>
                             <td><?php if(!empty($OpcionesFactura->prefijoFacturaFac)){echo $OpcionesFactura->prefijoFacturaFac.ceros($this->uri->segment(3));}else{echo $this->uri->segment(3);}?></td>
                         </tr>
                         <tr>
                             <td>Fecha de Expedicion:</td>
                             <td><?php print ($this->$modulo->result->fecha )?></td>
                         </tr>
                         <tr>
                             <td>Fecha de Vencimiento:</td>
                             <td> <?php echo calculo_fechas($this->$modulo->result->fecha,'+5'); ?></td>
                         </tr>
                         <tr>
                             <td>Estado:</td>
                             <td>
                             <?php if(get_monto_codigo_contable_x_factura($this->uri->segment(3))->credito==$monto){
                                echo 'Pagada';
                             }else if($this->$modulo->result->estatus==9){
                                echo 'Anulada';
                             }else{
                                echo 'Pendiente';
                             } ?> 
                             </td>
                         </tr>
                         <tr>
                             <td>Sucursal:</td>
                             <td><?php print($this->$modulo->result->abreviacion);?></td>
                         </tr>
                     </table>
                </div>              
            </td>
        </tr>
    </table>
    <div style="height: 20px;"></div>
    <div><b>Detalle Factura</b></div>
    <div style="height: 20px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="540" class="table">
        <thead>
            <tr class="colorFondo bordeAll">
                <th width="80"><b>Sucursal</b></th>
                <th width="180"><b>Tercero</b></th>
                <th>Procesador</th>
                <th><b>Equivalencia</b></th>
                <th><b>TKS</b></th>
                <th><b>USD</b></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $plataformas_array  =   array();
                $tokens     =   0;
                $sum_factura=0;
                $cuentas    =   array();
                foreach($n[$i] as $k =>$v){
                    
                ?>
                <tr>
                    <td class="bordeAll">
                        <?php 
                            print_r($v->abreviacion);
                        ?>
                    </td>
                    <td class="bordeAll">
                        
                        <?php 
                            //pre($v);
                            $json   =   json_decode($v->json);
                            echo $v->primer_nombre_modelo.' '.$v->primer_apellido_modelo;
                        ?>
                        <b>(<?php print($json->nickname);?>)</b>
                    </td>
                    <td class="bordeAll" style="text-align:center;">
                        <?php 
                            echo substr($v->nro_cuenta,0,4);
                        ?>
                    </td>
                    <td  class="bordeAll" style="text-align:center;">
                        <?php 
                            print_r($json->equivalencia);
                        ?>
                    </td>
                    <td class="bordeAll" style="text-align:center;">
                        <?php 
                            //pre($json);
                            if($v->codigo_contable=='414580'){
                                print_r(format($json->tokens,false));
                                $tokens     =   $tokens+$json->tokens;
                            }else{
                                echo "0";   
                            }
                        ?>
                    </td>
                    <td width="100" class="bordeAll" style="text-align:right;">
                        <?php 
                            //echo format(debito_credito($v),true);
                        ?>
                        <?php
                            $monto_global_usd   =   json_decode($v->json)->monto_global_usd;
                            echo format($monto_global_usd,true);
                            $sum_factura+=$monto_global_usd;
                            @$cuentas[$v->nro_cuenta]   +=  $monto_global_usd;
                        ?>
                    </td>
                </tr>
            <?php }?>
        </tbody>
        <tfoot>
            <tr>
                <td style="border:none;"></td>
                <td style="border:none;"></td>
                <td style="border:none;"></td>
                <td class="colorFondo" style="text-align:right;"><b>Total</b></td>
                <td class="colorFondo" style="text-align:center;"><b><?php echo  format($tokens,false);?></b></td>
                <td class="colorFondo" style="text-align:right;"><b><?php echo format($sum_factura,true);?></b></td>
            </tr>
        </tfoot>
    </table>
<?php if($i==$Pag){ ?>
    <div><b>Procesador(es)</b></div>
    <div style="height: 20px;"></div>                        
    <table border="0" cellpadding="0" cellspacing="0" width="540" class="table">
        <thead>
            <tr class="colorFondo bordeAll">
                <th ><b>Procesador</b></th>
                <th width="100"><b>Moneda </b></th>
                <th width="100" class="text-center">Procesador</th>
            </tr>
        </thead>
        <tbody>
    <?php 
            $banco_monto    =   0;
            $items      =   items_procesadores_contable($this->uri->segment(3),array("tipo_documento"=>"1"));
            foreach( $items as $k => $v){
                if(isset($cuentas[$v->nro_cuenta])){
    ?>
            <tr>
                <td class="bordeAll"><?php print(entidadbancaria($v->entidad_bancaria));?> <b>(<?php print($v->nro_cuenta);?>)</b></td>
                <td class="bordeAll" style="text-align:center;">Dólares</td>
                <td class="bordeAll" style="text-align:right;">
                    <?php 
                        print_r(format($cuentas[$v->nro_cuenta],true)); 
                        $banco_monto += $cuentas[$v->nro_cuenta];
                    ?>
                </td>
            </tr>                                               
    <?php       }           
            }
    ?>
        </tbody>
        <tfoot>
            <tr>
               
                <td style="border: none;"><b></b></td>
                <td class="colorFondo" style="text-align:right;"><b>Total</b></td>
                <td class="colorFondo" style="text-align:right;"><b><?php echo format($sum_factura,true);?></b></td>
            </tr>
        </tfoot>
    </table> 
    <?php #echo html_logs('rp_operaciones',$this->uri->segment(3)); este es un cambio?>
<?php 
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
</div>
<?php } ?>














