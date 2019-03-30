<?php
/* 
  DESARROLLO Y PROGRAMACIÓN
  PROGRAMANDOWEB.NET
  LCDO. JORGE MENDEZ
  info@programandoweb.net
*/?>
<?php
  $modulo   = $this->ModuloActivo;
  if($this->user->type=='Modelos'){
    return; 
  }
  setlocale(LC_ALL,"es_ES.UTF-8");
  //pre($this->user);
?>
<?php 
        $OpcionesFactura    =   getOpcionesFactura($empresa->user_id); 
        $items = $this->$modulo->result;
        $reg=count($items);
        $num=$reg/12;
        $Pag=ceil($num)-1;
        $numPag=0;
        for($i=0;$i<=$Pag;$i++){
    $numPag++;
?>        
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

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
  <div class="container" id="factura">
    <div style="height: 40px;"></div>
      <div style="text-align: center;">
          <b>Resumen <?php echo $items[0]->nombre_caja; ?></b>
      </div>
    <div style="height: 40px;"></div>
    <div class="row justify-content-md-center">
          <div class="col-md-12">
              <table border="0" cellpadding="0" cellspacing="0" width="540" class="table">
                  <thead class="colorFondo bordeAll">
                      <tr>
                          <th class="text-left">Fecha</th>
                          <th class="text-left">Tipo Documento</th>
                          <th class="text-center">Documento</th>
                          <th width="100" class="text-right">Debito</th>
                          <th width="100" class="text-right">Crédito</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php 
                
                $debito=0;
                $credito=0;
                              foreach($this->$modulo->result as $v){
                      ?>
                      <tr>
                          <td class="bordeAll" style="text-align: center;"><?php echo $v->fecha;// pre($v); ?></td>
                          <td class="bordeAll" style="text-align: center;"><?php echo tipo_documento($v->tipo_documento); ?></td>
                          <td class="bordeAll" style="text-align: center;"><?php echo $v->consecutivo ?></td>
                          <td class="bordeAll" style="text-align: right;"><?php echo format($v->credito_COP,false); $credito+= $v->credito_COP;?></td>
                          <td class="bordeAll" style="text-align: right;"><?php echo format($v->debito_COP,false);$debito+= $v->debito_COP; ?></td>
                      </tr>
                      <?php
                            }
                       ?>
                  </tbody>
                  <tfoot>
                    <tr>
                        <th></th>
                          <th></th>
                          <th class="bordeAll colorFondo">Total:</th>
                          <th class="bordeAll colorFondo" style="text-align:right;"><?php echo format(@$credito,false); ?></th>
                          <th class="bordeAll colorFondo" style="text-align:right;"><?php echo format(@$debito,false); ?></th>
                      </tr>
                  </tfoot>
              </table>
          </div>
      </div>
  </div>
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
  <div class="footer bordetop" style="position: absolute; bottom:-80px; width: 100%">
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
</div><?php }?>