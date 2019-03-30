<?php
/* 
  DESARROLLO Y PROGRAMACIÓN
  PROGRAMANDOWEB.NET
  LCDO. JORGE MENDEZkjhv
  info@programandoweb.net
*/?>
<?php
  $modulo   = $this->ModuloActivo;
  if($this->user->type=='Modelos'){
    return; 
  }
  //pre($this->user);
        $OpcionesFactura    =   getOpcionesFactura($empresa->user_id);
        $items = $this->$modulo->result;
        $reg=count($items);
        $num=$reg/8;
        $Pag=ceil($num)-1;
        $numPag=0; 
        $n = array_chunk($items, 8);           
        for($i=0;$i<=$Pag;$i++){
        $numPag++;
        if($i>0){
?>
<div style="page-break-after:always;"></div>
<?php } ?>
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif;margin-bottom: 100px;">
  <table class="ancho" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td width="30%" colspan="2">
                <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:55px;" />
            </td>
            <td style="text-align:right; font-size:12px; font-weight:bold;" valign="top" colspan="4">
                <?php echo $empresa->nombre_legal?><br/>
                Nit: <?php echo $empresa->identificacion;?> | <?php echo $empresa->tipo_empresa;?><br />
                <?php echo $empresa->direccion;?><br />               
                PBX: <?php echo $empresa->cod_telefono;?>-<?php echo $empresa->telefono?><br />
                <?php echo $empresa->website;?><br/>
                <?php #pre($empresa); ?>
            </td>
        </tr>
    </table>
    <div style="height: 20px"></div> 
    <div class="row filters">
        <div class="col-md-12" style="text-align: center;">
          Resumen Bancos.
        </div>
    </div>    
    <div style="height: 20px"></div>
  <div class="row justify-content-md-center">
        <div class="col-md-12">
            <table class="ancho" border="0" cellpadding="0" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Tipo Documento</th>
                        <th>Documento</th>
                        <th>Banco</th>
                        <th>Debito</th>
                        <th>Crédito</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if(count($this->$modulo->result)>0){
              $debito   = 0;
              $credito  = 0;
                            foreach($n[$i] as $v){
                    ?>
                    <tr>
                        <td class="bordeAll" style="text-align: center;"><?php echo $v->fecha ?></td>
                        <td class="bordeAll" style="text-align: center;"><?php echo tipo_documento($v->tipo_documento); ?></td>
                        <td class="bordeAll" style="text-align: center;">
                          <?php 
                if($v->tipo_documento=='5'){
              ?> 
                  <?php echo $v->consecutivo ?>
                            <?php }else if($v->tipo_documento=='6'){
              ?>
                  <?php echo $v->consecutivo; ?>  
                            <?php    
              }else if($v->tipo_documento=='10'){
              ?>
                  <?php echo $v->consecutivo ?>
                            <?php 
              }else if($v->tipo_documento=='11'){
                echo $v->consecutivo;
              }
                if($this->uri->segment(5)==10){
                  $v->debito=$v->credito_nacional;  
                
                }
              ?>
            </td>
                        <td class="bordeAll" style="text-align: center;"><?php echo $v->codigo_contable; ?></td>
                        <td class="bordeAll" style="text-align: center;"><?php echo format($v->debito,true); $debito+=$v->debito; ?></td>
                        <td class="bordeAll" style="text-align: center;"><?php echo format($v->credito,true); $credito+=$v->credito; ?></td>
                    </tr>
                    <?php
                        }
                    }else{ 
                     ?>
                     <tr>
                         <td colspan="6" class="bordeAll" style="text-align: center;">
                             No existen Registros
                         </td>
                     </tr>
                     <?php 
                        }
                     ?>
                </tbody>
                <tfoot>
                  <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th class="colorFondo">Total:</th>
                        <th class="colorFondo"><?php echo format(@$debito,true);?></th>
                        <th class="colorFondo"><?php echo format(@$credito,true);?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
       <?php
            if($this->uri->segment($this->uri->total_segments())!=="PDF"){?>
                <table>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="1"></td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="1"></td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td colspan="2" rowspan="4"></td>
                        <td colspan="1"></td>
                        <td colspan="3" rowspan="4">
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
                        <td colspan="3" class="bordetop" width="200">
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
                        <td colspan="3" class="bordetop">
                            Powered by LogicSoft&reg; | www.webcamplus.com.co
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
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
            <td colspan="3" style="text-align: center;font-size: 9px;"><?php if(!empty($OpcionesFactura->resolucionFac)){echo $OpcionesFactura->resolucionFac;}else{echo 'La presente resolución aplica únicamente a los documentos de venta que se registren después de grabados estos cambios.';} ?></td>
        </tr>
    </table>
</div>
</div><?php } }?>