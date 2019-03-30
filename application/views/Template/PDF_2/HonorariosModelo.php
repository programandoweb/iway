<?php
/* 
  DESARROLLO Y PROGRAMACIÓN
  PROGRAMANDOWEB.NET
  LCDO. JORGE MENDEZ
  info@programandoweb.net
*/
  $modulo           = $this->ModuloActivo;
  $ciclo_informacion      = get_cf_ciclos_pagos_new($this->$modulo->result->id_empresa,0);
  $escala_escala_x_user_id  = get_escala_x_user_id2($this->$modulo->result->user_id);
  $ciclos_pagos_end       =   get_ciclos_pagos_now();
  $config           = $this->session->userdata('Configuracion');
  //pre($ciclos_pagos_end);
  $registro         = get_registro_contable_honorarios_new($this->uri->segment(3),$this->uri->segment(4));
  $debito   = 0;
  $credito  = 0;
  foreach($registro as $v){
    $debito   = $debito   +   round($v->debito,2);  
    $credito  = $credito  +   round($v->credito,2);   
  }
  $pagos  = array(  "caja_id"     =>    ResumenCajas(array('110505'),array("6")),
            "procesador_id"   =>    ResumenBancosNew(array("Pesos")),
            "modelo_id"=>$this->uri->segment(3));

  $rp_honorarios_modelos  = array();            
?>
<?php
    $num=0;
    foreach($this->$modulo->HonorariosModelos($this->$modulo->result->user_id) as $v){ $num++;}
    $reg=$num/7;
    $Pag=ceil($reg);              
    for($i=1;$i<=$Pag;$i++){
?> 
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td width="30%">
                <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:55px;" />
            </td>
            <td style="text-align:right;font-size:12px;font-weight:bold;" valign="top">
               <?php echo $empresa->nombre_legal?><br />
                <?php echo $empresa->identificacion;?> | <?php echo $empresa->tipo_empresa;?><br />
                <?php  echo $centrodecostos->direccion; ?><br />
                PBX: <?php echo $empresa->cod_telefono;?>-<?php echo $empresa->telefono?><br />
                <?php echo $empresa->website;?><br />
            </td>
        </tr>
    </table>
      <div style="text-align: center;margin-top: 10px;">
          <b>Liquidación de ingresos recibidos para terceros.</b>          
      </div>
      <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:10px;">
        <tr style="padding: 0;margin:0; width:100%;">
            <td style="padding: 0;margin:0;width:60%;">
               <div class="recuadro margen_derecha fondoCell">    
                  <div class="colorFondo"><b>Datos Tercero</b> </div>
                    <b><?php echo nombre($this->$modulo->result);?></b><br> 
                    Documento Identificación:<b> <?php print_r($this->$modulo->result->identificacion);?></b><br>
                    Dirección: <b><?php $Texto=$this->$modulo->result->direccion; $direccion = wordwrap($Texto, 45, "<br />\n");
                    echo $direccion; ?></b><br>
                    Ciudad: <b><?php echo ( $this->$modulo->result->ciudad);?></b><br>
                    Telefono: <b><?php echo ( $this->$modulo->result->cod_telefono);?> <?php echo ( $this->$modulo->result->telefono);?></b><br/>
                  
               </div>                   
            </td>        
            <td>
                <div class="recuadro fondoCell">
                    <div class="colorFondo"><b>Datos documento</b></div>
                     Documento:
                     <b>
                      <?php
                      if(!empty($documento)){
                        echo $documento;
                      }  
                      ?>
                      </b><br> 
                     Estado:<b><?php //echo $estado ?></b><br>
                     Sucursal: <b>
                    <?php 
                      $centrodecostos   = centrodecostos($this->$modulo->result->centro_de_costos);
                      print_r($centrodecostos->nombre_legal);
                    ?>
                    </b></b><br>
                     Entidad Bancaria: <b><?php echo entidadbancaria( $this->$modulo->result->entidad_bancaria);?></b><br> 
                     Cuenta Bancaria:<b> <?php echo ( $this->$modulo->result->nro_cuenta);?></b><br> 
                </div>              
            </td>
        </tr>
    </table>
<table class="table" border="0" cellpadding="0" cellspacing="0" width="540" style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif;margin-top: 20px;">
  <tr>
    <th class="bordeAll colorFondo" colspan="4">Datos liquidación dineros <?php echo nombre($this->$modulo->result);?></th>
  </tr>
  <tr>
    <td width="110">Días transmitidos</td>
    <td style="text-align: center;">
       <b>
         <?php
              $periodo_pagos    = centrodecostos($this->$modulo->result->id_empresa); 
              $trm_ciclo      = trm_ciclo($periodo_pagos->periodo_pagos,get_ciclo_pago($periodo_pagos->periodo_pagos),date("m") - 1);
              $DiasTrabajados   = DiasTrabajados($this->$modulo->result->user_id,$ciclo_informacion->fecha_desde);
              if(!empty($DiasTrabajados)){
                echo $dias_trabajados=$DiasTrabajados->dias_trabajados;
              }else{
                echo $dias_trabajados = 15; 
              }
        ?> días
       </b>
    </td>
    <th class="bordeAll" colspan="2">Detalle liquidación de ingresos.</th>
  </tr>
  <tr>
    <td>Escala</td>
    <td style="text-align: center;">
      <b><?php 
          $escala = get_escala_x_user_id($this->$modulo->result->user_id);
          print_r($escala->nombre_escala);
        ?>
      </b>      
    </td>
    <td>Salario básico</td>
    <td style="text-align: right;">
      <b>
        <?php                                   
          if(!empty($escala_escala_x_user_id)){
              $salario    = calcula_montos_x_dias(@$escala_escala_x_user_id->salario,$dias_trabajados);
              $salario_var  = (format($salario,false));
          }else{
              $salario_var  = 0;  
          } 
          echo '$ '.$salario_var;                                                                   
        ?>
      </b>
    </td>
  </tr>
  <tr>
    <td>Factor bonificación</td>
    <td style="text-align: right;">
      <b>
        <?php 
            $factorBonificacion = number_format($escala_escala_x_user_id->factor_bonificacion, 5, '.', '');
            print_r($factorBonificacion);
        ?>
      </b>
    </td>
    <td>Auxilio transporte</td>
    <td style="text-align: right;">
      <b>
        <?php
          $escala_salario   =   calcula_montos_x_dias($escala_escala_x_user_id->auxilio_transporte,$dias_trabajados);
          echo '$ '.(format($escala_salario,false));
        ?>
      </b>
    </td>
  </tr>
  <tr>
    <td>Valor TRM</td>
    <td style="text-align: right;">
      <b>
        <?php 
          $trm_now                = periodotrm(calculo_fechas($ciclo_informacion->fecha_hasta,$cantidad_dias='+1'))->monto;
          echo $rp_honorarios_modelos["trm_now"]  = format($trm_now,true);
        ?>
      </b>
    </td>
    <td>Auxilio E.P.S.</td>
    <td style="text-align: right;">
      <b>
        <?php
          $eps        =   calcula_montos_x_dias($escala_escala_x_user_id->eps,$dias_trabajados);
          print '$ '.(format($eps,false));
        ?>  
      </b>
    </td>
  </tr>
  <tr>
    <td>Total producción</td>
    <td style="text-align: right;">
      <b>
        <?php 
            $totalRQ    = 0;
            $totalP     = 0;
            foreach($this->$modulo->HonorariosModelos($this->$modulo->result->user_id) as $v){

              $user_id    = $this->$modulo->result->user_id;  
              $nickname_id  = $v->nickname_id;
              $get_diario   = get_diario($user_id,$nickname_id,$ciclo_informacion->fecha_desde,$ciclo_informacion->fecha_hasta);
              $conversion_token_standar   = @$items_factura_x_nickname->monto_global_usd / 0.05;
              $totalRQ    = $totalRQ + $conversion_token_standar;
              $items_factura_x_nickname = items_factura_x_nickname($v->nickname_id);
			  
			  if(!empty($items_factura_x_nickname)){
				  $items_factura_x_nickname	= json_decode($items_factura_x_nickname->json);
                  $produccion   = 	@$items_factura_x_nickname->tokens;
              }else{
                  $produccion   = 0;
              }
              $totalP     = $totalP + @$items_factura_x_nickname->monto_global_usd / 0.05;
              $conversion   = @$items_factura_x_nickname->monto_global_usd / 0.05;
            }
            echo format($totalP,false);
        ?>
      </b>
    </td>
    <td>Auxilio A.R.L.</td>
    <td style="text-align: right;">
      <b>
        <?php
          $arl  = calcula_montos_x_dias($escala_escala_x_user_id->arl,$dias_trabajados);
          print '$ '.(format($arl,false));
        ?>
      </b>
    </td>
  </tr>
  <tr>
    <td>Meta de escala</td>
    <td style="text-align: right;">
      <b>
        <?php 
            $varmeta  = predateoFactorBonificacion($escala_escala_x_user_id->meta,$dias_trabajados);
            print_r(format($varmeta,false));
        ?>
      </b>
    </td>
    <td>Auxilio Caja Comp. Familiar</td>
    <td style="text-align: right;">
      <b>
        <?php
            $aux        = calcula_montos_x_dias($escala_escala_x_user_id->caja_compensacion,$dias_trabajados);
            print '$ '.(format($aux,false));
        ?>
      </b>
    </td>
  </tr>
  <tr style="font-size: 11px;">
    <td class="colorFondo">Tokens Bonificación</td>
    <td class="colorFondo" style="text-align: right;">
      <b>
        <?php
            $TKBon  = $totalP - $varmeta;
            if($TKBon<0){
              $TKBon = 0;
            }
            $TK = format($TKBon,false);           
            settype($TK,"string");
            echo format($TKBon,false);
        ?>
      </b>
    </td>
    <td> Bonificacion quincena</td>
    <td style="text-align: right;">
      <b>
        <?php 
            $bonificacion   = calcular_bonificacion($varmeta,$totalP,$factorBonificacion,$trm_now);
            //$salario + $escala_salario + $eps + $arl + $aux + $bonificacion;
            
            echo '$ '.(format($bonificacion,false)); 
        ?>
      </b>
    </td>
  </tr>
  <tr>
    <td>Ciclo pago</td>
    <td style="text-align: center;">
      <b>
        <?php 
            print(ciclopago($periodo_pagos->periodo_pagos,$ciclo_informacion->mes,$ciclo_informacion->fecha_desde));
        ?>
      </b>
    </td>
    <td>Otros ingresos</td>
    <td style="text-align: right;">
      <b>
        <?php 
            $ortros_ingresos  = TotalOtrosIngresos($this->$modulo->result->user_id);
            if(!empty($ortros_ingresos)){
                print '$  '.(format($ortros_ingresos->valor,false));
            }else{
                print '$ '.(format(0.00,false));  
            }
            
        ?>
      </b>
    </td>
  </tr>
  <tr>
    <td>Fecha Inicial</td>
    <td style="text-align: center;">
      <b>
        <?php echo $ciclo_informacion->fecha_desde; ?>
      </b>
    </td>
    <td>Ahorro y/o Prima semestral</td>
    <td style="text-align: right;">
      <b>
        <?php 
            $ahorro_prima   = $salario + $escala_salario + $eps + $arl + $aux + $bonificacion;
            $total_ahorro_prima = ($ahorro_prima * $escala_escala_x_user_id->prima)/100;
            $primas     = round($ahorro_prima, 0) + round($total_ahorro_prima,0);
            $hacia_arriba = round($primas, -3);
            
            $resultado    = $primas - $hacia_arriba;
            echo '$ '.format($total_ahorro_prima,false);
            
        ?>
      </b>
    </td>
  </tr>
  <tr>
    <td class="bordeBottom">Fecha final</td>
    <td class="bordeBottom" style="text-align:center;">
      <b>
        <?php echo $ciclo_informacion->fecha_hasta; ?>
      </b>
    </td>
    <td class="colorFondo bordeBottom"><b>Total liquidación de ingresos</b></td>
    <td class="colorFondo bordeBottom" style="text-align: right;">
      <b>
        <?php 
            $totalizacion_general = $salario + $escala_salario + $eps + $arl + $aux +$bonificacion + $ortros_ingresos->valor + $total_ahorro_prima;
            echo  '$ '.format(round($totalizacion_general),false);
        ?>
      </b>
    </td>
  </tr>
</table>
<table class="table" border="0" cellpadding="0" cellspacing="0" width="540" style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif;margin-top: 20px;">
  <tr>
    <th colspan="4" class="colorFondo bordeAll" >Detalle de ingresos por plataformas.</th>
  </tr>
  <tr style="text-align: center;">
    <td class="colorFondo bordeAll">Plataforma</td>
    <td class="colorFondo bordeAll">Usuario</td>
    <td class="colorFondo bordeAll">Producción</td>
    <td class="colorFondo bordeAll">Discriminado en pesos</td>
  </tr>
   <?php 
                $n=array_chunk($this->$modulo->HonorariosModelos($this->$modulo->result->user_id),7);
                if(isset($key)){
                    $key++;
                }else{
                    $key=0;
                }
                //foreach($n[$key] as $k =>$v){?>
  <?php 
          $Tl = $totalP;
          $TotalDiscriminado =  0;
          if($n>0){
          foreach($n[$key] as $v){
  ?>
  <tr>
    <td>
      <?php  echo $v->primer_nombre."<br>"; ?>
    </td>
    <td>
      <?php print_r($v->nickname);?>
    </td>
    <td style="text-align: right">
      <?php 
          $items_factura_x_nickname = items_factura_x_nickname($v->nickname_id);
		  if(!empty($items_factura_x_nickname)){
			  $items_factura_x_nickname	=	json_decode($items_factura_x_nickname->json);
              $produccion   = $items_factura_x_nickname->tokens;
          }else{
              $produccion   = 0;
          }
          $totalP     = $totalP + @$items_factura_x_nickname->monto_global_usd / 0.05;
          $conversion   = @$items_factura_x_nickname->monto_global_usd / 0.05;
          print (format($conversion,false));
      ?>
    </td>
    <td style="text-align: right;">
      <?php
          if($totalizacion_general==0||$Tl==0||$conversion==0){
          $elcagon  = 0;
          }else{
            $elcagon  = ($totalizacion_general/$Tl)*$conversion;
          }
          echo '$ '.format($elcagon,false);        
      ?>
    </td>
  </tr>
  <?php
      }
    }else{
  ?>
  <tr>
    <td style="text-align: center;">N.A.</td>
    <td style="text-align: center;">N.A.</td>
    <td style="text-align: right;">$ 0</td>
    <td style="text-align: right;">$ 0</td>
  </tr>


  <?php } ?>
  <tr>
    <td class="bordetop" style="border-left: none"></td>
    <td class="colorFondo bordetop"><b>Total ingresos</b></td>
    <td class="colorFondo bordetop" style="text-align: right;">
      <b><?php echo format($Tl,false); ?></b>
    </td>
    <td class="colorFondo bordetop" style="text-align: right;">
      <b><?php echo '$ '.format(round($totalizacion_general),false); ?></b>
    </td>
  </tr>
</table>
<table class="table" border="0" cellpadding="0" cellspacing="0" width="540" style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif;margin-top: 20px;">
  <tr>
    <th class="colorFondo bordeAll" colspan="6">Deducciones generales.</th>
  </tr>
  <tr style="text-align: center;">
      <td class="colorFondo bordeBottom"><b>Concepto</b></td>
      <td  colspan="2" class="colorFondo bordeBottom"><b>Observación</b></td>
      <td class="colorFondo bordeBottom"><b>Cuotas</b></td>
      <td class="colorFondo bordeBottom"><b>Valor</b></td>
      <td class="colorFondo bordeBottom"><b>Pendiente</b></td>
  </tr>
<tbody>
  <?php
      $total_monto_cuota  = 0;
      $total_restante   = 0;
      $ListOtrosIngresos  = Descuentos($this->$modulo->result->user_id);
      if(count($ListOtrosIngresos)>0){
          foreach($ListOtrosIngresos as $v){
              
  ?>
              <tr>
                  <td>
                      <?php print_r($v->concepto);?>
                  </td>
                  <td colspan="2">
                      <?php print_r($v->observacion);?>
                  </td>
                  <td style="text-align: center;">
                      <?php 
                          $cantidad_de_cuotas = CountCuotasDescuentos($v->descuento_id)->total;
                          echo $cantidad_de_cuotas + 1;?> / 
                      <?php print($v->nro_quincenas);?>
                  </td>
                  <td class="text-right" style="text-align: right">
                      <?php 
                              $monto_cuota  = $v->valor / $v->nro_quincenas;
                              $total_monto_cuota  = $total_monto_cuota + $monto_cuota;
                              print '$'.(format($monto_cuota,false));
                      ?>
                  </td>
                  <td class="text-right" style="text-align: right">
                      <?php 
                          $restar_a_valor = $cantidad_de_cuotas + 1 * $monto_cuota;
                          $restante   = $v->valor -  $restar_a_valor;
                          $total_restante = $total_restante + $restante;
                          print '$'.(format($restante ,false));
                      ?>
                  </td>                                           
              </tr>
  <?php   
          }
          
      }else{
  ?>
      <tr>
                  <td>
                      N.A.
                  </td>
                  <td colspan="2">
                      N.A.
                  </td>
                  <td style="text-align: center;">
                      0/0
                  </td>
                  <td class="text-right" style="text-align: right">
                      $ 0
                  </td>
                  <td class="text-right" style="text-align: right">
                      $ 0
                  </td>                                           
              </tr>
  <?php } ?>
  <?php 
      $escala_salario   =   calcula_montos_x_dias($escala_escala_x_user_id->auxilio_transporte,$dias_trabajados);
      $eps        =   calcula_montos_x_dias($escala_escala_x_user_id->eps,$dias_trabajados);
      if($eps>0){
  ?>
          <tr>
              <td>Pack Seguridad Social</td>
              <td colspan="2">Auxilio EPS</td>
              <td style="text-align: center;">1/1</td>
              <td style="text-align: right;">
                  <?php 
                      
                      //echo format($escala_salario,false);
                      echo '$ '.format($eps,false);
                      $total_monto_cuota  =   $total_monto_cuota+$eps;
                  ?>
              </td>
              <td style="text-align: right;"> $ 0</td>
          </tr>
  <?php }?>
  <?php
      $arl  = calcula_montos_x_dias($escala_escala_x_user_id->arl,$dias_trabajados);
      if($arl>0){
  ?>
          <tr>
              <td>Pack Seguridad Social</td>
              <td colspan="2">Auxilio A.R.L</td>
              <td style="text-align: center;">1/1</td>
              <td style="text-align: right;">
                  <?php 
                      echo '$ '.format($arl,false);
                      $total_monto_cuota  =   $total_monto_cuota+$arl;
                  ?>
              </td>
              <td style="text-align: right;">$ 0</td>
          </tr>
  <?php
      }
  ?>
  <?php 
      if(!empty($escala_escala_x_user_id)){
          $salario    = calcula_montos_x_dias(@$escala_escala_x_user_id->salario,$dias_trabajados);
          $salario_var  = (format($salario,false));
      }else{
          $salario_var  = 0;  
      }
      $aux        = calcula_montos_x_dias($escala_escala_x_user_id->caja_compensacion,$dias_trabajados);
      $ahorro_prima   = $salario + $escala_salario + $eps + $arl + $aux + $bonificacion;
      $total_ahorro_prima = ($ahorro_prima * $escala_escala_x_user_id->prima)/100;
      if($total_ahorro_prima>0){
                                      
  ?>
  <tr>
      <td>Pack Seguridad Social</td>
      <td colspan="2">Prima Semestral</td>
      <td style="text-align: center;">1/1</td>
      <td  style="text-align: right;">
          <?php 
              $total_monto_cuota  =   $total_monto_cuota+$total_ahorro_prima;
              echo '$'.format($total_ahorro_prima,false);
          ?>
      </td>
      <td style="text-align: right;">$ 0</td>
  </tr>
  <?php }?>
  <?php if($aux>0){?>
  <tr>
      <td>Pack Seguridad Social</td>
      <td colspan="2">Auxilio Caja de Compensación Familiar</td>
      <td style="text-align: center;">1/1</td>
      <td  style="text-align: right;">
          <?php
              $total_monto_cuota  =   $total_monto_cuota+$aux;
              print '$ '.(format($aux,false));                    
          ?>
      </td>
      <td style="text-align: right;">$ 0</td>
  </tr>
  <?php }?>
</tbody>
<tfoot>
  <tr>        
      <td class="bordetop" style="border-left: none;border-right: none;"></td>
      <td class="bordetop" style="border-left: none;"></td>
      <td colspan="2" class="colorFondo bordetop"><b>Total deducciones</b></td>
      <td class="colorFondo bordetop" style="text-align: right;"><b><?php print_r(format($total_monto_cuota,false))?></b></td>
      <td class="colorFondo" style="text-align: right;"><b><?php print '$ '.(format($total_restante,false)); $total_ingresos     = $totalizacion_general -$total_monto_cuota;?></b></td>
  </tr>
</tfoot>
</table> 
<table width="540" class="table" border="0" cellpadding="0" cellspacing="0" style="font-family:font-family: 'Montserrat', sans-serif; line-height:14px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif;margin-top: 20px;">
  <tr width="540">
    <td width="226" style="border:none;">
      <?php 
        $subtotal = ( $totalizacion_general - $total_monto_cuota  );
        
        if(@$config->ajustar_decena==1 || @$config->porcentaje_retencion>0){
          if(!empty($config->porcentaje_retencion)){
            $porcentaje_retencion = $config->porcentaje_retencion / 100;
          }else{
            $porcentaje_retencion = 0;
          }
          $subtotal_jorge=$subtotal  =  $subtotal - ($subtotal * $porcentaje_retencion);    
      ?>
    </td>
    <td width="222" class="colorFondo bordetop">Subtotal</td>
    <td class="colorFondo bordetop" style="text-align: right;">
      <b>
        <?php 
          echo '$ '.$rp_honorarios_modelos["Subtotal"] = format($total_ingresos,false); 
            }
        ?>
      </b>
    </td>
  </tr>
  <tr>
    <td style="border:none;"></td>
    <td>
      ReteFuente (<?php echo @$rp_honorarios_modelos["porcentaje_retencion"] =  format($config->porcentaje_retencion,true)?>%)
    </td>
    <td style="text-align:right;">
        <?php   
              $rp_honorarios_modelos["porcentaje_retencion"]= $pagos["porcentaje_retencion"]  = @$config->porcentaje_retencion;
              echo '$ '.@$rp_honorarios_modelos["total_ingresosXporcentaje_retencion"]  = format($totalizacion_general * @$porcentaje_retencion,false);
              //$subtotal =   $subtotal - ($totalizacion_general * @$porcentaje_retencion   );
              $rp_honorarios_modelos["rete_fuente"]  =  $pagos["rete_fuente"] = $total_ingresos * @$porcentaje_retencion; 
          ?>
    </td>
  </tr>
  <tr>
    <td style="border:none;"></td>
    <td class="bordeAll"><b>Subtotal</b></td>
    <td class="bordeAll" style="text-align:right;">
      <b>
        <?php 
              echo '$ '.$rp_honorarios_modelos["subtotal_2"] = format($total_ingresos - ($totalizacion_general * @$porcentaje_retencion),false);
              $subtotaljorge    = $total_ingresos - ($totalizacion_general * @$porcentaje_retencion);

          $subtotal1      = round(($totalizacion_general * @$porcentaje_retencion) - $total_monto_cuota, -3 );
          $ajuste_restante  = $totalizacion_general - $total_monto_cuota;
          //echo $rp_honorarios_modelos["subtotal1_2"]  = $subtotal1;
        ?>
      </b>
    </td>
  </tr>
  <tr>
    <td style="border: none;"></td>
    <td><?php if(@$config->ajustar_decena==1){?>
        Ajuste a la decena
    </td>
    <td style="text-align:right;">
                <?php   
                        $ajuste_a_la_decena   = ajuste_a_la_decena($subtotaljorge); 
                        if($ajuste_a_la_decena<$subtotaljorge){
                          echo '-'.$rp_honorarios_modelos["ajuste_a_la_decena_subtotal"]  =   format($subtotaljorge - $ajuste_a_la_decena,false);
                        }else{
                          $rp_honorarios_modelos["ajuste_a_la_decena_subtotal"] =   format($ajuste_a_la_decena - $subtotaljorge,false);
                          echo '+'.$rp_honorarios_modelos["ajuste_a_la_decena_subtotal"];
                        }
                        $rp_honorarios_modelos["ajuste_a_la_decena"]    = $pagos["ajuste_a_la_decena"] =  $ajuste_a_la_decena - $subtotal; 
                  }else{
                    $ajuste_a_decena  = $subtotal - $subtotal1; 
                    $ajuste_a_la_decena = $subtotal ;
                  }
                ?>
    </td>
  </tr>
  <tr>
    <td style="border: none;"></td>
    <td class="bordeAll colorFondo" style="text-align: right;"><b>Total</b></td>
    <td class="bordeAll colorFondo" style="text-align: right;">
        <?php   $rp_honorarios_modelos["pago_global"] = $pagos["pago_global"]   = $ajuste_a_la_decena;  ?>
        <b><?php echo '$ '.$rp_honorarios_modelos["ajuste_a_la_decena"] = format($ajuste_a_la_decena,false);?></b>
    </td>
  </tr>
</table>  
  <div class="footer bordetop" style="position: absolute; bottom:10px; width: 100%">
      <table>
          <tr>
              <td style="width:33%; text-align: left;font-size: 9px;color :black;">Fecha generacion documento <?php //print ( $this->$modulo->result->fecha_emision )?></td>
              <td style="text-align: center;font-size: 9px;">Página <?php echo $i.' / '.$Pag ?></td>
              <td style="width:33%; text-align: right;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
          </tr>
      </table>
  </div>
</div><?php } ?>