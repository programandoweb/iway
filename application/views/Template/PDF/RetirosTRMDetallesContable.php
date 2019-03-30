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
    $json       =   json_decode($row[0]->json);
    //pre($json); return;
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
<?php     $empresa    =   centrodecostos($json->centro_de_costos); ?>
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif;margin-top: -20px;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:30px;">
        <tr style="padding: 0;margin:0; width:100%;">
            <td style="padding: 0;margin:0;width:60%;">
               <div class="recuadro margen_derecha bordeAll">    
                  <div class="colorFondo"><b>Cuenta Bancaria</b></div>
                  <table>
                      <tr>
                        <td>
                            <b>
                            <?php 
                                $banco  =   get_banco($json->procesador_id);
                                print(entidadbancaria($banco->entidad_bancaria)); 
                            ?> <b> ( <?php print($banco->nro_cuenta);?> )</b>
                        </td>
                      </tr>
                      <tr>
                          <td>NIT (Id): <b><?php echo @$banco->Nit; ?></b></td>
                      </tr>
                      <tr>
                          <td>Dirección: <b><?php echo @$banco->Direccion;; ?></b></td>
                      </tr>
                      <tr>
                          <td>Ciudad: <b><?php echo @$banco->Ciudad; ?> ( <?php echo @$banco->Departamento; ?> )</td>
                      </tr>
                      <tr>
                          <td>Teléfono: <b><?php echo (!empty($banco->Telefono)?$banco->Telefono:"N.A."); ?></b></td>
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
                                Consignación Bancaria: 
                             </td>
                             <td>
                                <b>
                                    <?php echo @$empresa->abreviacion.' '.tipo_documento(10,true).' '.ceros($this->uri->segment(3)); ?>
                                </b> 
                             </td>
                         </tr>
                         <tr>
                             <td>Fecha de Expedición:</td>
                             <td><b><?php echo $row[0]->fecha;?></b></td>
                         </tr>
                         <tr>
                             <td>Transacción número:</td>
                             <td><b><?php echo $row[0]->nro_documento;?></b></td>
                         </tr>
                         <tr>
                             <td>Estado:</td>
                             <td>
                                <b>
                                    <?php 
                                        if($this->$modulo->result[0]->estatus==9){
                                    ?>
                                        Anulado    
                                    <?php       
                                        }else{
                                    ?>
                                        Procesado
                                    <?php
                                        }
                                    ?>        
                                </b>
                            </td>
                         </tr>
                         <tr>
                             <td>Sucursal:</td>
                             <td></b><?php echo $empresa->abreviacion; ?></b></td>
                         </tr>
                     </table>
                </div>              
            </td>
        </tr>
    </table>
    <div style="height: 20px;"></div>
    <div><b>Detalle Consignación Bancaria: </b><b></b></div>
    <div style="height: 20px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="table">
    <thead class="colorFondo bordeAll">
        <tr>
            <th width="250"><b>Concepto</b></th>
            <th class="text-center"><b>Procesador</b></th>
            <th class="text-center"><b>Documento</b></th>
            <th class="text-center"><b>Monto</b></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="bordeAll" style="text-align: justify;padding-right: 10px;">
                Consignación bancaria para 
                <b>
                    <?php
                        print(entidadbancaria($banco->entidad_bancaria)); ?>
                </b> desde
                <b><?php 
                        echo getCaja($json->caja_id); 
                    ?>
                </b>
            </td>
            <td class="bordeAll" style="text-align:center;">
                <b>( <?php print($banco->nro_cuenta); ?> )</b>
            </td>
            <td  class="bordeAll" style="text-align:center;">
                    <?php echo $this->uri->segment(3);?>
            </td>
            <td  class="bordeAll" style="text-align:right;" >
                <?php echo format($json->valor_consignacion,true);?>
            </td>
        </tr>                   
    </tbody>
    <tfoot>
        <tr>
            <td class="colorFondo" colspan="2">Son: <?php echo num_to_letras($json->valor_consignacion,"PESOS CON ","CENTAVOS") ?></td>
            <th class="colorFondo" style="text-align: right;">Total</th>
            <th class="colorFondo" style="text-align:right;"><?php echo format($json->valor_consignacion,true);?></th>
        </tr>
    </tfoot>  
</table> 
    <div style="height: 20px;"></div>
    <div><b>Registro contable:</b></div>
    <div style="height: 20px;"></div>
        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="table">
            <thead class="colorFondo">
                <tr>
                    <th width="100"><b>Cuenta</b></th>
                    <th><b>Concepto Contable</b></th>
                    <th width="100" class="text-center"><b>Débito</b></th>
                    <th width="100" class="text-center"><b>Crédito</b></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    
                    $debito     =   0;
                    $credito    =   0;
                    foreach($row as $k  => $v){
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
                            <?php 
                                
                                //echo entidad_bancaria($v);
                            ?>
                        </td>
                        <td class="bordeAll" style="text-align: right;">
                            <?php
                                    $debito +=$v->debito;
                                    print(format($v->debito,true));
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
            <tfoot>
                <tr class="colorFondo">
                    <th width="100"></th>
                    <th><b>Sumas Iguales</b></th>
                    <th width="100" style="text-align: right;"><b><?php echo format(($debito),true); ?></b></th>
                    <th width="100" style="text-align: right;"><b><?php echo @format($credito,true); ?></b></th>
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
                    Certifico (certificamos) que esta operación ha sido verificada de manera detallada antes de su respectivo procesamiento, medio de pago <b>efectivo</b>.
                    <?php echo(!empty($row[0]->responsable_id))?" Documento elaborado por <b>".nombre(centrodecostos($row[0]->responsable_id)).'</b>':''; ?>
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