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
        $keys = array_keys($this->$modulo->result);
        $item1 = $this->$modulo->result[$keys[0]];
        $saldo = operaciones_bancos_prueba($this->uri->segment(3),$this->uri->segment(4));
        $cuenta = get_Cuenta($this->uri->segment(3));
?>
<table class="ancho cabecera" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td width="30%" colspan="2">
            <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:90px;" />
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
<div class="footer bordetop pie_de_pagina" style="position: fixed; bottom:0px; width: 100%">
    <table>
        <tr>
            <td style="width:33%; text-align: left;font-size: 9px;color :black;">Fecha impresión documento <?php echo date('Y-m-d'); ?></td>
            <td style="text-align: center;font-size: 9px;">
            </td>
            <td style="width:33%; text-align: right;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
        </tr>
    </table>
</div>
<?php $abreviacion = centrodecostos($item1->centro_de_costos)->abreviacion; ?>
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif;">
    <div style="height:40px;"></div>
    <div class="col-md-12" style="text-align: center;">
      <b>Resumen Bancos <?php echo $cuenta->tipo_cuenta.' ('.$cuenta->nro_cuenta.')'; ?></b> 
    </div>
    <div style="text-align: center;">
        <b>Fecha generacion Informe: <?php echo date("Y-m-d"); ?></b>
    </div>
    <div style="text-align: center;">
        <b>Saldo: <?php echo format($saldo,true); ?></b>
    </div>  
    <div style="height: 20px"></div>
    <div class="row justify-content-md-center">
        <div class="col-md-12">
            <table class="ancho" border="0" cellpadding="0" cellspacing="0" width="100%">
                <thead>
                    <tr class="colorFondo">
                        <th>Fecha</th>
                        <th>Tipo Documento</th>
                        <th>Documento</th>
                        <th>Debito</th>
                        <th>Crédito</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if(count($this->$modulo->result)>0){
              $debito   = 0;
              $credito  = 0;
                            foreach($items as $v){
                    ?>
                    <tr>
                        <td class="bordeAll" style="text-align: center;"><?php echo $v->fecha ?></td>
                        <td class="bordeAll left"><?php echo tipo_documento($v->tipo_documento); ?></td>
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
                        <td class="bordeAll right">
                          <?php echo format($v->debito,true); $debito+=$v->debito; ?>
                        </td>
                        <td class="bordeAll right">
                            <?php
                                echo format(@$v->credito_nacional,true); $credito+=@$v->credito_nacional;  
                            ?> 
                        </td>
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
                        <th class="colorFondo">Total:</th>
                        <th class="colorFondo right"><?php echo format(@$debito,true);?></th>
                        <th class="colorFondo right"><?php echo format(@$credito,true);?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div style="height:20px; "></div>
</div>