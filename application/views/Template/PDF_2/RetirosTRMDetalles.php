<?php
/* 
  DESARROLLO Y PROGRAMACIÓN
  PROGRAMANDOWEB.NET
  LCDO. JORGE MENDEZ
  info@programandoweb.net
*/
  if(!@$this->user->id_empresa){
?>  
    <h3 class="text-center">Seleccione un Centro de Costos</h3>
<?php   
    return; 
  }
  $OpcionesFactura    =   getOpcionesFactura($empresa->user_id);   
  $modulo   = $this->ModuloActivo;
  $row    = $this->$modulo->result;
  $trm    = $row[0];
  $json   = json_decode($trm->json);
  //pre($row);return;  
  $reg=count($row);
  $num=$reg/12;
  $Pag=ceil($num)-1;
  $numPag=0;
    for($i=0;$i<=$Pag;$i++){
  $numPag++;
?> 
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif;margin-bottom: 100px;">
  <table class="ancho" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td width="30%">
                <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:55px;" />
            </td>
            <td style="text-align:right; font-size:12px; font-weight:bold;" valign="top">
                <?php echo $empresa->nombre_legal?><br/>
                Nit: <?php echo $empresa->identificacion;?> | <?php echo $empresa->tipo_empresa;?><br />
                <?php echo $empresa->direccion;?><br />               
                PBX: <?php echo $empresa->cod_telefono;?>-<?php echo $empresa->telefono?><br />
                <?php echo $empresa->website;?><br/>
                <?php #pre($empresa); ?>
            </td>
        </tr>
    </table>
    <div style="height:40px;"></div>
    <div style="text-align: center;font-weight: bold;">
        Retiros TRM Dtalles
    </div>
    <div style="height: 20px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="540" class="table">
      <thead class="colorFondo bordeAll">
        <tr>
          <td>Entidad Bancaria</td>
          <td>IMC</td>
          <td>Fecha</td>
          <td>Nro. Transacción</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="bordeAll" style="text-align:center;"><?php print(entidadbancaria($json->banco_id)); ?></td>
          <td class="bordeAll" style="text-align:center;"><?php print($json->cajero_identificacion);?></td>
          <td class="bordeAll" style="text-align:center;"><?php print($json->fecha_transaccion);?></td>
          <td class="bordeAll" style="text-align:center;"><?php print($json->nro_transaccion);?></td>
        </tr>
      </tbody>
    </table>
    <div style="height: 20px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="540" class="table">
      <thead class="colorFondo bordeAll">
        <tr>
          <td>Ciclo de Producción</td>
          <td>Valor Retiro</td>
          <td>USD Cargado</dh>
          <td>Procesador de Pago:</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="bordeAll" style="text-align:center;"><?php print($json->ciclo_de_produccion);?></td>
          <td class="bordeAll" style="text-align:center;">$<?php print(format($json->valor_retiro,false));?></td>
          <td class="bordeAll" style="text-align:center;"><?php print(format($json->usd_cargado,true));?></td>
          <td class="bordeAll" style="text-align:center;"><?php 
            $banco  = get_banco($json->procesador_id);
            print(entidadbancaria($banco->entidad_bancaria)); ?>
            <b>( <?php print($banco->nro_cuenta);?> )</b></td>
        </tr>
      </tbody>
    </table>
    <div style=" width:100%; height:20px;"></div> 
    <div class="tab-content col-md-12">
        <div id="registro" class="tab-pane active row justify-content-md-center" role="tabpanel">
            <div class="col-md-12">
                <table  border="0" cellpadding="0" cellspacing="0" width="540" class="table">
                    <thead class="colorFondo bordeAll">
                        <tr>
                            <td width="80"><b>Documento</b></td>
                            <td width="100"><b>Cuenta</b></td>
                            <td><b>Concepto Contable</b></td>
                            <td width="100" class="text-center"><b>Débito</b></td>
                            <td width="100" class="text-center"><b>Crédito</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            
                            $debito   = 0;
                            $credito  = 0;
                            foreach($row as $k  => $v){
                                if($v->debito>0 || $v->credito>0 ){
                        ?>                       
                            <tr>
                                <td class="bordeAll" style="text-align:center;">
                                  <?php echo $v->consecutivo ?>
                                </td>
                                <td class="bordeAll" style="text-align:center;">
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
                                <td  class="bordeAll" style="text-align:right;">
                                    <?php
                                            $credito +=$v->credito;
                                            print(format($v->credito,false));
                                    ?>
                                </td>
                                <td class="bordeAll" style="text-align:right;">
                                    <?php
                                          if($k == 0){
                                            $credito1 = 0;
                                            foreach ($row as $key => $value) {
                                               $credito1 += $value->credito;
                                            }
                                            echo format($credito1,false);
                                          }else{
                                            print(format($v->debito,false));
                                          }
                                            $debito +=$v->debito;
                                    ?>
                                    
                                </td>                           
                            </tr>
                        <?php 
                                }
                            }
                        ?>
                    </tbody>                    
                </table> 
          </div>                
        </div>             
    </div>
</div>
 <?php
            if($this->uri->segment($this->uri->total_segments())!=="PDF"){?>
                <table>
                    <tr>
                        <td colspan="4"></td>
                        <td colspan="7"></td>
                        <td colspan="6"></td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td colspan="7"></td>
                        <td colspan="6"></td>
                    </tr>
                    <tr>
                        <td colspan="4" rowspan="4"></td>
                        <td colspan="7"></td>
                        <td colspan="6" rowspan="4">
                            <?php
                                if(!empty($empresa->firma)){
                                        echo '<img src="'. img_firma($empresa->firma).'" style="width:153px;height:55px;" />';
                                }
                            ?>
                        </td> 
                    </tr>
                    <tr>
                        <td colspan="7"></td>
                    </tr>
                    <tr>
                        <td colspan="7"></td>
                    </tr>
                    <tr>
                        <td colspan="7"></td>
                    </tr>
                    <tr>
                        <td colspan="7"></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="bordetop" width="200">
                            Aprobado:
                        </td>
                        <td colspan="7" width="100"></td>
                        <td colspan="6" class="bordetop" width="200">
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
                        <td colspan="6" class="bordetop">
                            Fecha impresión documento <?php echo date('Y-m-d'); ?>
                        </td>
                        <td colspan="5" class="bordetop">
                            Página <?php echo $numPag.' / '.($Pag+1); ?>
                        </td>
                        <td colspan="6" class="bordetop">
                            Powered by LogicSoft&reg; | www.webcamplus.com.co
                        </td>
                    </tr>
                    <tr>
                        <td colspan="17">
                            <?php if(!empty($OpcionesFactura->resolucionFac)){echo $OpcionesFactura->resolucionFac;}else{echo 'La presente resolución aplica únicamente a los documentos de venta que se registren después de grabados estos cambios.';} ?>
                        </td>
                    </tr>
                </table>
            </div>

<?php 
      }else{
         if($i==$Pag){
             $position=count($row);
                if($position > 6){
                     $x=(50*12)/$position;
                     $m=ceil($x);
                }else{
                     $m=90;
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
                            Firmo y autorizo:
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
</div><?php } } ?>