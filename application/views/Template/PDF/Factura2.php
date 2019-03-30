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
       /*$movimientos    = getMovimientos($this->uri->segment(3),array("111010","130510"));
        foreach ($movimientos as $key => $value) {
           if($value->tipo_documento == 1){
             $responsable = @$value->primer_nombre.' '.@$value->primer_apellido;
           }
        }*/
    //pre($this->$modulo->result);
        $OpcionesFactura    = json_decode(getOpcionesFacturacion($this->$modulo->result->consecutivo)->json);
        $documento = DocumentoHonorarios(1);
        //pre($OpcionesFactura); return;
        $items      =   items_factura_contable($this->uri->segment(3),array("414580","130510"),array("tipo_documento"=>"1"));
        $responsable = @$items[0]->responsable_id;
        $credito            =   items_factura_contable($this->uri->segment(3),array("414580","130510"),array("tipo_documento"=>"1"));
        $monto=0;
        foreach($credito as $k =>$v){
           $monto   +=    json_decode($v->json)->monto_global_usd;       
        } 
        $deb = 0;
        foreach (get_registro_contable_new($this->uri->segment(3)) as $k6 => $val){
            $deb += $val->debito;
         } 
        //pre($items);
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
<div class="subfoter">
    <div class="recuadro fondoCell bordeAll">    
        <div class="colorFondo">
            <b>Importante:</b>
        </div>
        <table>
            <tr>
                <td style="text-align: justify;">
                  <?php 
                        if(!empty($OpcionesFactura->piePaginaFac)){
                            echo @$OpcionesFactura->piePaginaFac;
                            if($OpcionesFactura->nombreDocumentoFac != "Cuenta de Cobro"){
                            echo ', autorización numeración de facturación '.@$OpcionesFactura->res_diam.' ';
                            echo @$Opciones->res_fecha;
                            echo ' tipo '.@$OpcionesFactura->res_tipo;
                            echo ', desde '.@$OpcionesFactura->fac_desde;
                            echo ', hasta '.@$OpcionesFactura->fac_hasta.',';
                            }
                            echo ' Documento elaborado por <b>'.@nombre(centrodecostos($responsable)).'.</b>';
                        }else{
                            echo 'Esta factura se asimila en todos sus efectos a una letra de cambio, de conformidad con el articulo 774 del código de comercio. Autorizo que en caso de incumplimiento de esta obligación sea reportado a las centrales de riesgo, se cobraran intereses por concepto de mora';
                        }
                    ?>
                </td>
            </tr>
        </table>
        <div style="width: 100%;">
            <div style="height: 40px;"></div>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td></td>
                        <td> </td>
                        <td>
                            <?php
                                if(!empty($empresa->firma)){
                                        echo '<img src="'. img_firma($empresa->firma).'" style="width:153px;height:55px;" />';
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="150">
                            <div class="bordetop linea">
                                Elaboró:
                            </div>
                        </td>
                        <td width="50"> </td>
                        <td> 
                            <div class="bordetop linea">
                                <?php
                                    if(@$OpcionesFactura->firmaFac==1){
                                        echo $empresa->nombre_representante_legal.' C.C. '.$empresa->nro_identificacion_representante_legal;
                                    }else{
                                        echo 'Firma y sello cliente';
                                    }
                                ?> 
                            </div>
                        </td>
                    </tr>
            </table> 
        </div>
    </div>    
</div>
<div class="footer bordetop pie_de_pagina">
    <table>
        <tr>
            <td style="width:33%; text-align: left;font-size: 9px;color :black;">Fecha impresión documento <?php echo date('Y-m-d'); ?></td>
            <td style="text-align: center;font-size: 9px;"></td>
            <td style="width:33%; text-align: right;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
        </tr>
    </table>
</div>
<div class="cabecera2">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td>
               <div class="recuadro margen_derecha bordeAll">    
                  <div class="colorFondo"><b>Datos Cliente</b></div>
                  <table>
                      <tr>
                          <td><b><?php echo $this->$modulo->result->nombre_cliente;?></b></td>
                      </tr>
                      <tr>
                          <td>NIT (Id): <b><?php print ( $this->$modulo->result->Nit )?></b></td>
                      </tr>
                      <tr>
                          <td>Dirección: <b><?php print($this->$modulo->result->Direccion)?></b></td>
                      </tr>
                      <tr>
                          <td>Ciudad: <b><?php echo ( $this->$modulo->result->Ciudad )?> ( <?php echo $this->$modulo->result->Pais; ?> )</b></td>
                      </tr>
                      <tr>
                          <td>Teléfono: <b>N.A.</b></td>
                      </tr>
                  </table>
               </div>                   
            </td>        
            <td>
                <div class="recuadro bordeAll">
                    <div class="colorFondo"><b>Datos documento</b></div>
                     <table>
                         <tr>
                             <td><b><?php if(!empty($OpcionesFactura->nombreDocumentoFac)){ echo $OpcionesFactura->nombreDocumentoFac;}else{ echo 'Factura de Venta';} ?></b>:</td>
                             <td>
                                <b>
                                    <?php
                                        echo $this->$modulo->result->abreviacion.' '.@$documento->id_documento.' '.ceros($this->uri->segment(3));
                                    ?>
                                </b>
                            </td>
                         </tr>
                         <tr>
                             <td>Fecha de Expedición:</td>
                             <td><b><?php print ($this->$modulo->result->fecha )?></b></td>
                         </tr>
                         <tr>
                             <td>Fecha de Vencimiento:</td>
                             <td> <b><?php echo calculo_fechas($this->$modulo->result->fecha,'+5'); ?></b></td>
                         </tr>
                         <tr>
                             <td>Estado:</td>
                             <td>
                                <b>
                                     <?php 
                                     
                                     if(checkFacturaPagada($this->uri->segment(3))){
                                        echo 'Pagada';
                                     }else if($this->$modulo->result->estatus==9){
                                        echo 'Anulada';
                                     }else{
                                        echo 'Pendiente';
                                     } ?>
                                </b>
                             </td>
                         </tr>
                         <tr>
                             <td>Sucursal:</td>
                             <td><b><?php print($this->$modulo->result->abreviacion);?></b></td>
                         </tr>
                     </table>
                </div>              
            </td>
        </tr>
    </table>
</div>
<?php 
    $reg=count($items); //Cuenta numero de registros.
    $num=$reg/10; //dividir numero de registros para saber numero de paginas.
    $Pag=ceil($num)-1; //numero de Paginas
    $items_array = array_chunk($items,10);
    for($i=0;$i<=$Pag;$i++){

?>
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif;margin-top: 140px;margin-bottom: 150px;">
    <div style="height: 20px;"></div>
    <div><b>Detalle </b><b><?php if(!empty($OpcionesFactura->nombreDocumentoFac)){ echo $OpcionesFactura->nombreDocumentoFac;}else{ echo 'Factura de Venta';} ?>:</b></div>
    <div style="height: 20px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="table">
        <thead>
            <tr class="colorFondo bordeAll">
                <th width="200"><b>Descripción</b></th>
                <th>Procesador</th>
                <th width="100"><b>Vr. Unitario</b></th>
                <th><b>Cantidad</b></th>
                <th><b>Total</b></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $plataformas_array  =   array();
                $tokens     =   0;
                $sum_factura=0;
                $cuentas    =   array();
                foreach($items_array[$i] as $k =>$v){
                    
                ?>
                <tr>
                    <td class="bordeAll" style="text-align:justify;">
                        
                        <?php 
                            //pre($v);
                            $json   =   json_decode($v->json);
                            echo @$v->primer_nombre_modelo.' '.@$v->segundo_nombre_modelo.' '.@$v->primer_apellido_modelo;
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
                    <td class="bordeAll" style="text-align:right;">
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
                            $sum_factura += floatval($monto_global_usd);
                            echo format($monto_global_usd,true);
                            @$cuentas[$v->nro_cuenta]   +=  $monto_global_usd;
                            $son = explode(",",$sum_factura);
                        ?>
                    </td>
                </tr>
            <?php }?>
        </tbody>
        <tfoot>
            <tr>
                <td class="colorFondo" colspan="2">Son: <?php echo num_to_letras($sum_factura,"DÓLARES CON "," CENTAVOS",false); ?></td>
                <td class="colorFondo" style="text-align:center;"><b>Total</b></td>
                <td class="colorFondo" style="text-align:right;"><b><?php echo  format($tokens,false);?></b></td>
                <td class="colorFondo" style="text-align:right;"><b><?php echo format($sum_factura,true);?></b></td>
            </tr>
        </tfoot>
    </table>
    <div style="height: 20px;"></div>
    <div><b>Procesador (es):</b></div>
    <div style="height: 20px;"></div>                        
    <table border="0" cellpadding="0" cellspacing="0" width="540" class="table">
        <thead>
            <tr class="colorFondo bordeAll">
                <th ><b>Procesador</b></th>
                <th width="100"><b>Moneda </b></th>
                <th width="100" class="text-center">Total</th>
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
                <td class="colorFondo" style="text-align:center;"><b>Total Factura</b></td>
                <td class="colorFondo" style="text-align:right;"><b><?php echo format($monto,true);?></b></td>
            </tr>
        </tfoot>
    </table> 
</div>
<?php
    } 
?> 