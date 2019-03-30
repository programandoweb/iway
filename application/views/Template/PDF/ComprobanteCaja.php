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
  $modulo   = $this->ModuloActivo;
    $row        =   $this->$modulo->result;
    $json      =   @json_decode($row[0]->json);
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
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif;margin-bottom: 100px;">
      <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:30px;">
        <tr style="padding: 0;margin:0; width:100%;">
            <td style="padding: 0;margin:0;width:60%;">
               <div class="recuadro margen_derecha bordeAll">    
                  <div class="colorFondo"><b>Caja Origen</b></div>
                  <table>
                      <tr>
                        <td>
                            <b>
                              <?php 
                                  echo getCaja($json->id_caja_origen);
                              ?>
                          </b>
                        </td>
                      </tr>
                      <tr>
                          <td>NIT (Id): <b>N.A.</b></td>
                      </tr>
                      <tr>
                          <td>Ciclo de producción: 
                            <b>
                              <?php echo @$row[0]->ciclo_de_produccion?>
                            </b>
                          </td>
                      </tr>
                      <tr>
                          <td>Codigo origen: <b><?php echo $json->procesador_origen_codigo_contable ?></b></td>
                      </tr>
                      <tr>
                          <td>Codigo destino: <b><?php echo $json->procesador_destino_codigo_contable ?></b></td>
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
                                Comprobante de caja: 
                             </td>
                             <td>
                                <b>
                                  <?php echo @$row[0]->abreviacion.' '.@tipo_documento($row[0]->tipo_documento,true).' '.@ceros($row[0]->consecutivo);?>
                                </b> 
                             </td>
                         </tr>
                         <tr>
                             <td>Fecha de Expedición:</td>
                             <td><b><?php echo @$row[0]->fecha;?></b></td>
                         </tr>
                         <tr>
                             <td>Fecha de Vencimiento:</td>
                             <td><b><?php echo @$row[0]->fecha;?></b></td>
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
                             <td><b><?php echo @$row[0]->abreviacion; ?></b></td>
                         </tr>
                     </table>
                </div>              
            </td>
        </tr>
    </table>
    <div style="height: 20px;"></div>
    <div><b>Detalle Comprobante de caja: </b><b></b></div>
    <div style="height: 20px;"></div>
    <table  border="0" cellpadding="0" cellspacing="0" width="100%">
      <thead>
          <tr class="colorFondo">
              <th><b>Concepto</b></th>
              <?php
                  if(@$row[0]->tipo_documento == 18){
              ?>
              <th class="text-center"><b>Caja destino</b></th>
              <?php
                  }else{
              ?>
              <th class="text-center"><b>Caja</b></th>
              <?php
                  }
              ?>
              <th class="text-center"><b>Documento</b></th>
              <th class="text-center"><b>Monto</b></th>
          </tr>
      </thead>
      <tbody>
          <?php
              $sum  = 0;
              //pre($this->$modulo->result);
          ?>
              <tr>
                  <td class="bordeAll">
                      Traslado de dinero en efectivo entre cajas.
                  </td>
                  <td class="bordeAll center">
                  <?php
                      echo getCaja($json->id_caja_destino);
                  ?>
                  </td>
                  <td  class="bordeAll center">
                          <?php echo $this->uri->segment(3);?>
                  </td>
                  <td  class="bordeAll right" >
                      <?php echo format($json->monto,true);?>
                  </td>
              </tr>                   
      </tbody>
      <tfoot>
        <tr class="colorFondo">
          <th></th>
          <th></th>
          <th class="center">Total</th>
          <th class="right"><?php echo format($json->monto,true);?></th>
        </tr>
      </tfoot>  
    </table>
    <div style="height: 20px;"></div>
    <div><b>Registro contable:</b></div>
    <div style="height: 20px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
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
                $debito   = 0;
                $credito  = 0;
                $sum1   =   $sum2   = 0;
                foreach($row as $k=>$v){
                    
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
                    <td class="bordeAll right">
                        <?php
                                $debito +=  @$v->debito;
                                print(format(@$v->debito,true));
                                $sum1 +=  @$v->debito;
                        ?>
                    </td>
                    <td  class="bordeAll right">
                        <?php
                                $credito +=$v->credito;
                                print(format($v->credito,true));
                                $sum2 +=  @$v->credito;
                        ?>
                    </td>
                </tr>
            <?php }?>
        </tbody> 
        <tfoot>
          <tr class="colorFondo">
            <th></th>                            
            <th class="center">Sumas iguales</th>
            <th class="right"><?php echo format($sum1,true);?></th>
            <th class="right"><?php echo format($sum2,true);?></th>
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
                    Certifico (certificamos) que esta operación ha sido verificada de manera detallada antes de su respectivo procesamiento, medio de pago <b>Efectivo</b>.
                    <?php echo(!empty($json->user_id))?" Documento elaborado por <b>".nombre(centrodecostos($json->user_id)).'</b>':''; ?>
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