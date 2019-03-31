<?php
    if(!@$this->user->id_empresa){
?>  
        <h3 class="text-center">Seleccione un Centro de Costos</h3>
<?php       
        return; 
    }       
    $modulo      =   $this->ModuloActivo;
    $row         =   $this->$modulo->result;
    $responsable =   @$row[0]->responsable_id; 
    //pre($this->$modulo->factura);
    
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
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:30px;">
        <tr style="padding: 0;margin:0; width:100%;">
            <td style="padding: 0;margin:0;width:60%;">
               <div class="recuadro margen_derecha bordeAll">    
                  <div class="colorFondo"><b>Datos Cliente</b></div>
                  <table>
                      <tr>
                          <td><b><?php echo $this->$modulo->factura->nombre_cliente; ?></b></td>
                      </tr>
                      <tr>
                          <td>NIT (Id): <b><?php echo $this->$modulo->factura->Nit;?></b></td>
                      </tr>
                      <tr>
                          <td>Dirección: <b><?php echo $this->$modulo->factura->Direccion; ?></b></td>
                      </tr>
                      <tr>
                          <td>Ciudad: <b><?php echo $this->$modulo->factura->Ciudad; ?> ( <?php echo $this->$modulo->factura->Pais; ?> )</td>
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
                             <td width="120">
                                Comprobante Bancario: 
                             </td>
                             <td>
                                <b><?php echo $this->$modulo->factura->abreviacion.' BR '.$this->uri->segment(3); ?></b> 
                             </td>
                         </tr>
                         <tr>
                             <td>Fecha de Expedición:</td>
                             <td><b><?php echo $row[0]->fecha;?></b></td>
                         </tr>
                         <tr>
                             <td>Fecha de Vencimiento:</td>
                             <td><b><?php echo $row[0]->fecha;?></b></td>
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
                             <td></b><?php echo $this->$modulo->factura->abreviacion; ?></b></td>
                         </tr>
                     </table>
                </div>              
            </td>
        </tr>
    </table>
    <div style="height: 20px;"></div>
    <div><b>Detalle Comprobante Bancario: </b><b></b></div>
    <div style="height: 20px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="table">
        <thead>
            <tr class="colorFondo bordeAll">
                <th width="250"><b>Concepto</b></th>
                <th><b>Procesador</b></th>
                <th><b>Documento</b></th>
                <th><b>Monto</b></th>
            </tr>
        </thead>
        <tbody>
        <?php
            $sum    =   0;
            //pre($this->$modulo->result);
            foreach($this->$modulo->result['detalle_ingreso'] as $k=>$v){
        ?>
            <tr>
                <td class="bordeAll" style="text-align:justify;">
                    Cancelación / Abono Factura de Ventas
                    <b><?php print(entidadbancaria($v->entidad_bancaria));?></b>
                </td>
                <td class="bordeAll" style="text-align:center;">
                    <?php
                        print($v->nro_cuenta);
                    ?>
                </td>
                <td  class="bordeAll" style="text-align:center;" >
                    <a class="documentos" href="<?php echo base_url('Reportes/VerFactura/'.$this->$modulo->factura->consecutivo.'/sinmarco');?>">
                        <?php print_r($this->$modulo->factura->consecutivo);?>
                       
                    </a>
                </td>
                <td  class="bordeAll" style="text-align:right;"><?php print(format($v->debito,true)); $sum+=$v->debito; ?></td>
            </tr>                   
        <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td class="colorFondo" colspan="2">Son: <?php echo num_to_letras($sum,"DÓLARES CON ","CENTAVOS") ?></td>
                <td class="colorFondo" style="text-align:center;"><b>Total</b></td>
                <td class="colorFondo" style="text-align:right;"><b><?php echo format($sum,true); ?></b></td>
            </tr>
        </tfoot>
    </table>
    <div style="height: 20px;"></div>
    <div><b>Registro contable:</b></div>
    <div style="height: 20px;"></div>                        
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <thead>
            <tr class="colorFondo">
                <th><b>Cuenta</b></th>
                <th><b>Concepto Contable</b></th>
                <th><b>Procesador</b></th>
                <th><b>Débito</b></th>
                <th><b>Crédito</b></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $debito     =   0;
                $credito    =   0;
                $items      =   items_factura_contable($this->uri->segment(5),array("414580","130510"),array("tipo_documento"=>5),true);
                $sum1       =       $sum2       =   0;
                foreach($this->$modulo->result['registro_contable'] as $k=>$v){
                    
            ?>                       
                <tr>
                    <td class="bordeAll" style="text-align:center">
                        <?php
                            print($v->codigo_contable);
                        ?>
                    </td>
                    <td class="bordeAll">
                        <?php 
                            print(get_codigo_contable($v->codigo_contable)->cuenta_contable);
                        ?>
                    </td>
                    <td class="bordeAll" style="text-align:center">
                        <?php
                            print($v->nro_cuenta);
                        ?>
                    </td>
                    <td class="bordeAll" style="text-align:right;">
                        <?php
                                $debito +=  @$v->debito;
                                print(format(@$v->debito,true));
                                $sum1   +=  @$v->debito;
                        ?>
                    </td>
                    <td  class="bordeAll" style="text-align:right;">
                        <?php
                                $credito +=$v->credito;
                                print(format($v->credito,true));
                                $sum2   +=  @$v->credito;
                        ?>
                    </td>
                </tr>
            <?php }?>
        </tbody> 
        <tfoot>
            <tr>
                <td></td>
                <td></td>                            
                <td class="colorFondo" style="text-align:center">Sumas iguales</td>
                <td class="colorFondo" style="text-align:right;"><?php echo format($sum1,true);?></td>
                <td class="colorFondo" style="text-align:right;"><?php echo format($sum2,true);?></td>
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
                    Certifico (certificamos) que esta operación ha sido verificada de manera detallada antes de su respectivo procesamiento, medio de pago: <b>transferencia interbancaria</b>.
                    <?php echo(!empty($responsable))?" Documento elaborado por <b>".nombre(centrodecostos($responsable)).'</b>':''; ?>
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













