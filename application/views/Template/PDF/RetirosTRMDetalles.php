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
    $modulo      =   $this->ModuloActivo;
    $row         =   $this->$modulo->result;
    $trm         =   $row[0];
    $abreviacion = centrodecostos($this->user->centro_de_costos)->abreviacion;
    $documento   = tipo_documento(6,true);
    $json        =   json_decode($trm->json);
    if(!empty($json->banco_id)){
        $banco      =   entidadbancaria($json->banco_id,"*");
    }else{
        $tercero    =   centrodecostos($json->Tercero);
    }
?>
<?php     
    $debito     =   0;
    $credito    =   0;
    foreach($row as $k  => $v){
        if($v->debito>0 || $v->credito>0 ){
                    $debito +=$v->debito;
        }
    }
?>
<table class="ancho cabecera" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td width="30%" colspan="2">
            <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:90px;" />
        </td>
        <td style="text-align:right; font-size:12px; font-weight:bold;" valign="top" colspan="15">
            <?php echo $empresa->nombre_legal;?><br/>
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
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif;margin-top:-50px;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:30px;">
        <tr style="padding: 0;margin:0; width:100%;">
            <td style="padding: 0;margin:0;width:60%;">
               <div class="recuadro margen_derecha bordeAll">    
                  <div class="colorFondo"><b>Datos Monetizador</b></div>
                  <table>
                      <tr>
                        <td>
                            <b>
                                <?php 
                                    if(!empty($banco)){
                                        echo $banco->Entidad;
                                    }else{
                                        echo @nombre($tercero);
                                    }
                                ?>    
                            </b>
                        </td>
                      </tr>
                      <tr>
                          <td>NIT (Id):
                            <b>
                                <?php
                                    if(!empty($banco)){
                                        echo $banco->Nit;
                                    }else{
                                        echo @$tercero->identificacion;
                                    }
                                ?>
                            </b> 
                          </td>
                      </tr>
                      <tr>
                          <td>Direccion:
                                <b> 
                                  <?php
                                        if(!empty($banco)){
                                            echo $banco->Direccion;
                                        }else{
                                            echo $tercero->direccion;
                                        }
                                  ?>
                                </b>
                          </td>
                      </tr>
                      <tr>
                          <td>Ciudad:
                                <b>
                                <?php
                                    if(!empty($banco)){
                                        echo $banco->Ciudad.' (<b>'.@$banco->Departamento.'</b>)';
                                    }else{
                                        echo $tercero->ciudad.' (<b>'.@$tercero->Departamento.'</b>)';
                                    }
                                ?>
                                </b>
                          </td>
                      </tr>
                      <tr>
                          <td>Teléfono:
                            <b>
                                <?php
                                    if(!empty($banco)){
                                        echo $banco->Telefono;
                                    }else{
                                        echo $tercero->cod_telefono.$tercero->telefono;
                                    }
                                ?>
                            </b>
                          </td>
                      </tr>
                  </table>
               </div>                   
            </td>        
            <td>
                <div class="recuadro bordeAll">
                    <div class="colorFondo"><b>Datos documento</b></div>
                     <table>
                         <tr>
                             <td>Monetización:</td>
                             <td>
                                <b> <?php echo $abreviacion.' '.$documento.' '.ceros($this->uri->segment(3)); ?></b>
                            </td>
                         </tr>
                         <tr>
                             <td>Fecha de Expedición:</td>
                             <td><b><?php echo $json->fecha_transaccion; ?></b></td>
                         </tr>
                         <tr>
                             <td>Fecha de Vencimiento:</td>
                             <td>
                                 <b><?php echo $json->fecha_transaccion; ?></b>
                             </td>
                         </tr>
                         <tr>
                             <td>Estado:</td>
                             <td>
                                <b>
                                    <?php echo estatus_operaciones($trm); ?>
                                </b>
                             </td>
                         </tr>
                         <tr>
                             <td>Sucursal:</td>
                             <td>
                                 <b><?php echo $abreviacion; ?></b>
                             </td>
                         </tr>
                     </table>
                </div>              
            </td>
        </tr>
    </table>
    <div style="height: 20px;"></div>
    <div><b>Detalle Monetización: </b><b></b></div>
    <div style="height: 20px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="table">
        <thead>
            <tr class="colorFondo bordeAll">
                <th width="300"><b>Concepto</b></th>
                <th><b>TRM</b></th>
                <th><b>USD cargado</b></th>
                <th><b>Vr. Total</b></th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td style="text-align:justify;padding-right: 10px;">
                        Monetización de divisas, tipo de transacción <b><?php echo $json->Tipo_transaccion; ?>,</b> destino <b>
                        <?php
                            if(!empty($json->Banco_destino)){
                                $destino = explode("/-/",$json->Banco_destino);
                                echo @entidadbancaria($destino[0]).' ('.$destino[2].')';       
                            }else{
                                echo @getCaja($json->CajaDestino);
                            }
                        ?></b>
                    </td>
                    <td  class="bordeAll" style="text-align:center;">
                       $ <?php
                            echo $json->trm;
                        ?>
                    </td>
                    <td class="bordeAll" style="text-align:right;">
                        <?php print(format($json->usd_cargado,true));?>
                    </td>
                    <td width="100" class="bordeAll" style="text-align:right;">
                        $ <?php echo format($debito,true); ?>
                    </td>
                </tr>
        </tbody>
        <tfoot>
            <tr>
                <td class="colorFondo" colspan="2">Son: <?php echo num_to_letras(intval($debito),"PESOS","CENTAVOS"); ?></td>
                <td class="colorFondo" style="text-align:right;"><b>Total</b></td>
                <td class="colorFondo" style="text-align:right;"><b>$ <?php echo format($debito,true); ?></b></td>
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
                <th width="100" class="text-center">Valor</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="bordeAll">
                    <?php 
                        $cuenta_exterior  =   @get_banco($json->procesador_id);
                        print(@entidadbancaria($cuenta_exterior->entidad_bancaria)); 
                        
                    ?> <b>( <?php print(@$cuenta_exterior->nro_cuenta);?> )</b>
                </td>
                <td class="bordeAll" style="text-align:center;">Dólares</td>
                <td class="bordeAll" style="text-align:right;">
                    <?php print(format($json->usd_cargado,true));?>
                </td>
            </tr>                                               
        </tbody>
        <tfoot>
            <tr>
               
                <td style="border: none;"><b></b></td>
                <td class="colorFondo" style="text-align:center;"><b>Total monetización</b></td>
                <td class="colorFondo" style="text-align:right;"><b><?php print(format($json->usd_cargado,true));?></b></td>
            </tr>
        </tfoot>
    </table>
    <div style="width:100%; height:40px;"></div>
    <b>Registro contable:</b>
    <div style="width:100%; height:9px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="540">
        <thead>
            <tr class="colorFondo">
                <th width="100"><b>Cuenta</b></th>
                <th><b>Concepto Contable</b></th>
                <th width="100" class="text-center"><b>Débito</b></th>
                <th width="100" class="text-center"><b>Crédito</b></th>
            </tr>
        </thead>
        <tbody>
        <?php 
            
            $debe     =   0;
            $credito    =   0;
            foreach($row as $k  => $v){
                if($v->debito>0 || $v->credito>0 ){
        ?>                       
            <tr>
                <td class="bordeAll">
                    <?php
                        print($v->codigo_contable);
                    ?>
                </td>
                <td class="bordeAll">
                    <?php 
                        print(get_codigo_contable($v->codigo_contable)->cuenta_contable);
                    ?>
                </td>
                <td  class="bordeAll" style="text-align:right;">
                    <?php
                            $debe +=$v->debito;
                            print(format(($v->debito),true));
                    ?>
                </td>
                <td class="bordeAll" style="text-align:right;">
                    <?php
                        if($k == 0){
                            echo format($debito,true);
                        }else{
                            echo "0,00";
                        }
                    ?>
                </td>                           
            </tr>
        <?php 
                }
            }
        ?> 
        </tbody>
        <tfoot>
            <tr class="colorFondo">
                <th width="100"></th>
                <th><b>Sumas Iguales</b></th>
                <th width="100" style="text-align:right;"><b><?php echo @format($debe,true); ?></b></th>
                <th width="100" style="text-align:right;"><b><?php echo format($debito,true); ?></b></th>
            </tr>
        </tfoot> 
    </table> 
    <div style="height:20px; "></div>
    <div class="recuadro fondoCell bordeAll">    
        <div class="colorFondo">
            <b>Importante:</b>
        </div>
        <table>
            <tr>
                <td style="text-align: justify;">
                    <p>Declaramos que estos recursos NO provienen de ninguna actividad ilícita de las contempladas en el
                    Código Penal Colombiano o en cualquier norma que lo modifique o adicione, no admitiremos que terceros efectúen depósitos a nombre de <b><?php echo $empresa->nombre_legal; ?></b>, con fondos provenientes de las
                    actividades ilícitas contempladas en el Código Penal Colombiano o en cualquier norma que lo
                    modifique o adicione, ni efectuaremos transacciones destinadas a tales actividades o a favor de
                    personas relacionadas con las mismas, certificamos que estos dineros provienen de la exportación de servicios de entretenimiento para adultos online (transmisión webcam).
                    <?php echo (!empty($trm->responsable_id))?"Documento realizado por <b>".nombre(centrodecostos($trm->responsable_id)):'</b>'; ?>
                    </p>
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
                        </td>
                    </tr>
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














