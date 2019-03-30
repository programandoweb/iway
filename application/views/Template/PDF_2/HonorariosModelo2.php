<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
	$modulo						=	$this->ModuloActivo;
	$ciclo_informacion			=	get_cf_ciclos_pagos_new($this->$modulo->result->id_empresa,0);
	$escala_escala_x_user_id	=	get_escala_x_user_id2($this->$modulo->result->user_id);
	$ciclos_pagos_end   		=   get_ciclos_pagos_now();
	$config						=	$this->session->userdata('Configuracion');
	//pre($ciclos_pagos_end);
	$registro					=	get_registro_contable_honorarios_new($this->uri->segment(3),$this->uri->segment(4));
	$debito		=	0;
	$credito	=	0;
	foreach($registro as $v){
		$debito		=	$debito 	+ 	round($v->debito,2); 	
		$credito	=	$credito 	+ 	round($v->credito,2); 	
	}
	$pagos	=	array(	"caja_id"			=>		ResumenCajas(array('110505'),array("6")),
						"procesador_id"		=>		ResumenBancosNew(array("Pesos")),
						"modelo_id"=>$this->uri->segment(3));

	$rp_honorarios_modelos	=	array();
    $row = $this->$modulo->result;	
    //pre($ciclo_informacion);
    pre($row);					
    if($row->turno_manama == 1){
        @$turno = "Mañana";
    }

    if($row->turno_tarde == 1){
        @$turno = "Tarde";
    }

    if($row->turno_noche == 1){
        @$turno = "Noche";
    }

    if($row->turno_intermedio == 1){
        @$turno = "Intermedio";
    }
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:30px;">
    <tr class="colorFondo">
        <th>Liquidación de cuentas en participación (Utilidades y/o honorarios) # HM-GIA-0001</th>
    </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:30px;">
    <tr>
        <td class="colorFondo" width="46%">
            <b>Datos tercero</b>
        </td>
        <td width="10%">
            
        </td>
        <td class="colorFondo">
            <b>Datos Documento</b>
        </td>
    </tr>
    <tr>
        <td style="background: #DEDEDE;">
          <b><?php echo $row->primer_nombre.' '.$row->segundo_nombre.' '. $row->primer_apellido .' '.$row->segundo_apellido; ?></b><br>
          Documento Identificación: <b><?php echo $row->identificacion; ?></b><br>
          Dirección: <b><?php echo $row->direccion; ?></b><br>
          Ciudad: <b><?php echo $row->ciudad; ?></b><br>
          Sucursal: <b><?php echo$centrodecostos->nombre_legal;  ?> - Room:Room#<?php echo $row->room_transmision; ?> - Turno: <?php echo @$turno; ?></b><br>
          Entidad Bancaria: <b><?php echo $row->entidad_bancaria; ?></b><br>
          Cuenta Bancaria: <b><?php echo $row->nro_cuenta; ?></b><br>
          Factor bonificación: <b><?php $factorBonificacion =   number_format($escala_escala_x_user_id->factor_bonificacion, 5, '.', ''); echo $rp_honorarios_modelos["factorBonificacion"]   =   $factorBonificacion; ?></b>
        </td>
        <td>
            
        </td>
        <td style="background: #DEDEDE;">
            Ciclo de pago: 
            <b>
                <?php 
                    $periodo_pagos                              =   centrodecostos($this->$modulo->result->id_empresa);
                    echo $rp_honorarios_modelos["ciclopago"]    =   ciclopago($periodo_pagos->periodo_pagos,$ciclo_informacion->mes,$ciclo_informacion->fecha_desde);
                ?>
            </b><br>
            Fecha inicial: <b><?php echo $ciclo_informacion->fecha_desde; ?></b><br>
            Fecha final:: <b><?php echo $ciclo_informacion->fecha_hasta; ?></b><br>
            Estado: <b></b><br>
            Escala:
                <b>
                    <?php 
                        $escala                                         =   get_escala_x_user_id($this->$modulo->result->user_id);
                        echo $rp_honorarios_modelos["nombre_escala"]    =   $escala->nombre_escala;
                    ?>
                </b><br>
            Días transmitidos:
                <b>
                    <?php 
                        $trm_ciclo          =   trm_ciclo($periodo_pagos->periodo_pagos,get_ciclo_pago($periodo_pagos->periodo_pagos),date("m") - 1);
                        $DiasTrabajados     =   DiasTrabajados($this->$modulo->result->user_id,$ciclo_informacion->fecha_desde);
                        if(!empty($DiasTrabajados)){
                            echo $rp_honorarios_modelos["dias_trabajados"]  =   $dias_trabajados    =   $DiasTrabajados->dias_trabajados;
                        }else{
                            echo $rp_honorarios_modelos["dias_trabajados"]  =   $dias_trabajados    =   15; 
                        }
                    ?>
                    Días
                </b><br>
        Clasificación: <b><?php echo @$row->tipo_modelo; ?> (<?php echo nombreUsuario(@$row->monitor)->Responsable; ?>)</b><br>
            Valor TRM:
                <b>
                    <?php 
                        $trm_now                                =   periodotrm(calculo_fechas($ciclo_informacion->fecha_hasta,$cantidad_dias='+1'))->monto;
                        echo $rp_honorarios_modelos["trm_now"]  =   format($trm_now,true);
                    ?>
                </b>
        </td>
    </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:10px;">
    <tr class="colorFondo">
        <th colspan="4">Datos liquidación cuentas en participación <?php echo $row->primer_nombre.' '.$row->segundo_nombre.' '. $row->primer_apellido .' '.$row->segundo_apellido; ?></th>
    </tr>
    <tr>
        <td style="text-align: center;" class="bordeAll" colspan="2"><b>Detalle beneficios pacto comercial.</b></td>
        <td style="text-align: center;" class="bordeAll" colspan="2"><b>Detalle liquidación de ingresos.</b></td>
    </tr>
    <tr>
        <td class="borderleft">Auxilio E.P.S.</td>
        <td class="borderight" style="text-align: right;">
          <b>
            <?php
              $eps        =   calcula_montos_x_dias($escala_escala_x_user_id->eps,$dias_trabajados);
              print '$ '.(format($eps,false));
            ?>  
          </b>
        </td>
        <td>Pacto comercial (<b>Salario básico</b>)</td>
        <td class="borderight" style="text-align: right;">
            <b>
                <?php 
                    if(!empty($escala_escala_x_user_id)){
                        $salario        =   calcula_montos_x_dias(@$escala_escala_x_user_id->salario,$dias_trabajados);
                        $salario_var    =   (format($salario,false));
                    }else{
                        $salario_var    =   0;  
                    }
                    echo '$ '.$rp_honorarios_modelos["salario_var"]      =   $salario_var;
                ?>
            </b>
        </td>
    <tr>
        <td class="borderleft">Auxilio A.R.L.</td>
        <td class="borderight" style="text-align: right;">
          <b>
            <?php
              $arl  = calcula_montos_x_dias($escala_escala_x_user_id->arl,$dias_trabajados);
              print '$ '.(format($arl,false));
            ?>
          </b>
        </td>
        <td>Pacto comercial (<b>Auxilio de transporte</b>)</td>
        <td class="borderight" style="text-align: right;">
            <b>
                <?php
                    $escala_salario     =       calcula_montos_x_dias($escala_escala_x_user_id->auxilio_transporte,$dias_trabajados);
                    echo '$ '.$rp_honorarios_modelos["escala_salario"]   =   format($escala_salario,false);  
                ?>
            </b>
        </td>
    </tr>
    <tr>
        <td class="borderleft">Auxilio Caja Comp. Familiar</td>
        <td style="text-align: right;" class="borderight">
          <b>
            <?php
                $aux        = calcula_montos_x_dias($escala_escala_x_user_id->caja_compensacion,$dias_trabajados);
                print '$ '.(format($aux,false));
            ?>
          </b>
        </td>
        <td>Pacto comercial (<b>Bonificación quincenal</b>)</td>
        <td class="borderight" style="text-align: right;">
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
                          $items_factura_x_nickname = json_decode($items_factura_x_nickname->json);
                          $produccion   =   @$items_factura_x_nickname->tokens;
                      }else{
                          $produccion   = 0;
                      }
                      $totalP     = $totalP + @$items_factura_x_nickname->monto_global_usd / 0.05;
                      $conversion   = @$items_factura_x_nickname->monto_global_usd / 0.05;
                    }

                    $varmeta  = predateoFactorBonificacion($escala_escala_x_user_id->meta,$dias_trabajados);
                    $bonificacion   = calcular_bonificacion($varmeta,$totalP,$factorBonificacion,$trm_now);
                    //$salario + $escala_salario + $eps + $arl + $aux + $bonificacion;
                    
                    echo '$ '.(format($bonificacion,false)); 
                ?>
            </b>
        </td>
    </tr>
    <tr>
        <td class="borderleft">Provisión Auxilio Semestral (7,5%)*</td>
        <td class="borderight" style="text-align: right;"><b></b></td>
        <td>Otros Ingresos</td>
        <td class="borderight" style="text-align: right;">
            <b>
                <?php 
                    $ortros_ingresos    =   TotalOtrosIngresos($this->$modulo->result->user_id);
                    if(!empty($ortros_ingresos)){
                       echo     '$ '.$rp_honorarios_modelos["ortros_ingresos"]   =   format($ortros_ingresos->valor,false);
                    }else{
                       echo     '$ '.$rp_honorarios_modelos["ortros_ingresos"]   =   format(0.00,false); 
                    }
                    
                ?>
            </b>
        </td>
    </tr>
    <tr class="colorFondo">
        <td>Total benefcios pacto comercial</td>
        <td>
        </td>
        <td>Total liquidación ingresos</td>
        <td></td>
    </tr>
    <tr>
        <td colspan="2" class="bordeAll">Escala de pago SANCIONADA y RETIRADA es liquidada sobre el 50%</td>
        <td class="colorFondo">Total ingresos percibidos + beneficios</td>
        <td class="colorFondo"></td>
    </tr>
    <tr>
        <td colspan="4" class="bordeAll">*Los valores expresados son provisionados, ante retiro antes del día 20 de Junio y Diciembre la empresa no reconocerá este beneficio.</td>
    </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:10px;">
    <thead>
        <tr class="colorFondo">
            <td colspan="4">Detalle de ingreso por plataforma.</td>
        </tr>
        <tr class="colorFondo">
            <th><b>Plataforma</b></th>
            <th><b>Usuario</b></th>
            <th class="text-right"><b>Producción</b></th>
            <th class="text-right"><b>Diferencia</b></th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $totalRQ        =   0;
            $totalP         =   0;
            $rp_honorarios_modelos["HonorariosModelos"]             =   $HonorariosModelos  =   $this->$modulo->HonorariosModelos($this->$modulo->result->user_id);
            foreach($rp_honorarios_modelos["HonorariosModelos"] as $k => $v){
        ?>
            <tr>
                <td class="borderleft">
                    <?php 
                        print($v->primer_nombre);
                        //pre($v);
                    ?>
                </td>
                <td class="borderleft">
                    <?php 
                        print_r($v->nickname);
                        $rp_honorarios_modelos["user_id"][$k]                       =       $user_id        =   $this->$modulo->result->user_id;    
                        $rp_honorarios_modelos["nickname_id"][$k]                   =       $nickname_id    =   $v->nickname_id;
                        $get_diario     =   get_diario($user_id,$nickname_id,$ciclo_informacion->fecha_desde,$ciclo_informacion->fecha_hasta);
                        $conversion_token_standar                                   =       conversion_token_standar(@$get_diario->monto,$v->equivalencia);
                        
                    
                        $items_factura_x_nickname   =   items_factura_x_nickname($v->nickname_id,1);
                        $factura                    =   @$items_factura_x_nickname->consecutivo;
                        
                        if(!empty($items_factura_x_nickname)){
                            $items_factura_x_nickname   =   json_decode($items_factura_x_nickname->json);
                        }
                        
                        if(!empty($items_factura_x_nickname)){
                            $produccion     =   $items_factura_x_nickname->tokens;
                        }else{
                            $produccion     =   0;
                        }
                        $totalP         =   $totalP + @$items_factura_x_nickname->monto_global_usd / 0.05;
                        $conversion     =   conversion_token_standar(@$produccion,$v->equivalencia);
                        $conversion     =   @$items_factura_x_nickname->monto_global_usd / 0.05;
                    ?>
                </td>
                <td class="borderleft">
                    <?php 
                        echo $rp_honorarios_modelos["conversion"][$k]   =   format($conversion,false);
                    ?>
                </td>
                <td class="borderleft borderight">
                    <?php
                        
                        if(!empty($items_factura_x_nickname)){
                            $produccion     =   $items_factura_x_nickname->tokens;
                        }else{
                            $produccion     =   0;
                        } 
                        if(!empty($get_diario)){
                            echo $rp_honorarios_modelos["conversion_conversion_token_standar"][$k]  =   format( $conversion - $conversion_token_standar,false);
                        }else{
                            echo $rp_honorarios_modelos["conversion_conversion_token_standar"][$k]  =   format($conversion,false);  
                        }
                    ?>
                </td>
            </tr>
        <?php }?>
    </tbody>
    <tfoot>
        <tr>
            <td class="bordetop"></td>
            <td class="bordetop colorFondo"><b>Total ingresos</b></td>
            <td class="text-right colorFondo">
                <b>
                    <?php echo $rp_honorarios_modelos["totalP"]         =   format($totalP,false);?>
                </b>
            </td>
            <td class="text-right colorFondo">
                <b> 
                    <?php echo $rp_honorarios_modelos["totalP_totalRQ"] =   format($totalP - $totalRQ,false);?>
                </b>
            </td>
        </tr>
    </tfoot>
</table>
<table  border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:10px;">
    <thead>
        <tr>
            <th colspan="5" class="colorFondo">Descuentos.</th>
        </tr>
        <tr class="colorFondo">
            <th><b>Concepto</b></th>
            <th><b>Observación</b></th>
            <th><b>Cuotas</b></th>
            <th><b>Valor</b></th>
            <th><b>Pendiente</b></th>
        </tr>
    </thead>
    <tbody>
        <?php
            $total_monto_cuota          =   0;
            $total_restante             =   0;
            $rp_honorarios_modelos["Descuentos"]                =   $ListOtrosIngresos          =   Descuentos($this->$modulo->result->user_id);
            if(count($ListOtrosIngresos)>0){
                foreach($ListOtrosIngresos as $k => $v){
        ?>
                    <tr>
                        <td>
                            <?php print_r($v->concepto);?>
                        </td>
                        <td>
                            <?php print_r($v->observacion);?>
                        </td>
                        <td>
                            <?php 
                                $cantidad_de_cuotas = CountCuotasDescuentos($v->descuento_id)->total;
                                echo $rp_honorarios_modelos["cantidad_de_cuotas"][$k]   =   $cantidad_de_cuotas + 1;
                            ?> 
                                / 
                            <?php 
                                echo $rp_honorarios_modelos["nro_quincenas"][$k]        =   $v->nro_quincenas;
                            ?>
                        </td>
                        <td class="text-right">
                            <?php 
                                    $monto_cuota                                        =   $v->valor / $v->nro_quincenas;
                                    $total_monto_cuota                                  =   $total_monto_cuota + $monto_cuota;
                                    echo $rp_honorarios_modelos["monto_cuota"][$k]      =   format($monto_cuota,false);
                                    $pagos["monto_cuota"][$k]                           =   @$monto_cuota;
                            ?>
                        </td>
                        <td class="text-right">
                            <?php 
                                $restar_a_valor = $cantidad_de_cuotas + 1   * $monto_cuota;
                                $restante       =   $v->valor -  $restar_a_valor;
                                $total_restante =   $total_restante + $restante;
                                echo $rp_honorarios_modelos["restante"][$k] =   format($restante ,false);
                            ?>
                        </td>                                           
                    </tr>
        <?php       
                }
                
            }
        ?>
        <?php 
        
            $escala_salario     =       calcula_montos_x_dias($escala_escala_x_user_id->auxilio_transporte,$dias_trabajados);
            $eps                =       calcula_montos_x_dias($escala_escala_x_user_id->eps,$dias_trabajados);
            if($eps>0){
                //$rp_honorarios_modelos["eps"] =   format($eps,false);
                //$total_monto_cuota    =   $total_monto_cuota+$eps;
                $rp_honorarios_modelos["eps"]   =   format(0,false);
                $total_monto_cuota  =   $total_monto_cuota;
            }?>
        <?php
            $arl    =   calcula_montos_x_dias($escala_escala_x_user_id->arl,$dias_trabajados);
            if($arl>0){
                //$rp_honorarios_modelos["arl"] =   format($arl,false);
                //$total_monto_cuota    =   $total_monto_cuota+$arl;
                $rp_honorarios_modelos["arl"]   =   format(0,false);
                $total_monto_cuota  =   $total_monto_cuota;
                
            }
        ?>
        <?php 
            $bonificacion       =   calcular_bonificacion($varmeta,$totalP,$factorBonificacion,$trm_now);
            if(!empty($escala_escala_x_user_id)){
                $salario        =   calcula_montos_x_dias(@$escala_escala_x_user_id->salario,$dias_trabajados);
                $salario_var    =   (format($salario,false));
            }else{
                $salario_var    =   0;  
            }
            $aux                =   calcula_montos_x_dias($escala_escala_x_user_id->caja_compensacion,$dias_trabajados);
            $ahorro_prima       =   $salario + $escala_salario + $eps + $arl + $aux + $bonificacion;
            $total_ahorro_prima =   ($ahorro_prima * $escala_escala_x_user_id->prima)/100;
            if($total_ahorro_prima>0){
                //$total_monto_cuota                                =   $total_monto_cuota+$total_ahorro_prima;
                //$rp_honorarios_modelos["total_ahorro_prima"]  =   format($total_ahorro_prima,false);
                $total_monto_cuota                              =   $total_monto_cuota;
                $rp_honorarios_modelos["total_ahorro_prima"]    =   format(0,false);
            }
        ?>
        <?php 
            if($aux>0){
                //$total_monto_cuota                =   $total_monto_cuota+$aux;
                //$rp_honorarios_modelos["aux"] =   format($aux,false);                                     
                $total_monto_cuota              =   $total_monto_cuota;
                $rp_honorarios_modelos["aux"]   =   format(0,false);                                        
            }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3" class="bordeAll" style="text-align: center;"><b>Dineros recibidos para terceros, favor ver Proveedor que reporta el descuento</b></td>
            <td class="text-center colorFondo"><b>Total Descuentos</b></td>
            <td class="text-right colorFondo"><b><?php     echo $rp_honorarios_modelos["total_restante"]       =   format($total_restante,false);?></b></td>
        </tr>
    </tfoot>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:10px;">
    <thead>
        <tr class="bordeAll">
            <th class="colorFondo" colspan="4">Análisis general.</th>
        </tr>
        <tr class="colorFondo">
            <th colspan="2">Análisis de cumplimiento</th>
            <th colspan="2">Detalle liquidación de ingresos final.</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="borderleft">Total producción</td>
            <td class="borderight" style="text-align: right;">
                <b>
                    <?php echo $rp_honorarios_modelos["totalP"]         =   format($totalP,false);?>
                </b>
            </td>
            <td width="30%">Subtotal</td>
            <td class="borderight" width="15%" style="text-align: right;">
                <b>
                    subtotal
                </b>
            </td>
        </tr>
        <tr>
            <td class="borderleft">Meta ideal</td>
            <td class="borderight" style="text-align: right;">
                <b>
                    <?php echo $rp_honorarios_modelos["totalP"]         =   format($totalP,false);?>
                </b>
            </td>
            <td>Retención en la fuente (0,00%)</td>
            <td class="borderight" style="text-align: right;">
                <b>
                    subtotal
                </b>
            </td>
        </tr>
        <tr>
            <td class="borderleft">Total producción</td>
            <td class="borderight" style="text-align: right;">
                <b>
                    <?php echo $rp_honorarios_modelos["totalP"]         =   format($totalP,false);?>
                </b>
            </td>
            <td class="borderight">Descuentos</td>
            <td class="borderight" style="text-align: right;">
                <b>
                    subtotal
                </b>
            </td>
        </tr>
        <tr>
            <td style="text-align: center;" rowspan="3" colspan="2" class="borderleft">
                <b style="font-size: 10px;">
                    Importante: Pérdida de beneficios del pacto comercial: a) conexión o llegadas tarde más de dos (2) veces a la quincena, b) falta sin justa causa, c) no atención a members, d) no atención monitores, ante pérdida de beneficios modelo asumirá costo seguridad social de ese periodo, porcentaje de pago del 50% (TRMX0,88X0,05X50%).
                </b>
            </td>
            <td class="borderight">Subtotal</td>
            <td style="text-align: right;" class="borderight">584.000</td>
        </tr>
        <tr>
            <td class="borderleft">Ajuste a la descena</td>
            <td class="borderight" style="text-align: right;">584.000</td>
        </tr>
        <tr>
            <td class="colorFondo">Total liquidación de ingresos finales</td>
            <td style="text-align: right;" class="colorFondo">845.254</td>
        </tr>
    </tbody>
</table>  






















<?php
/* 
    DESARROLLO Y PROGRAMACIÓN
    PROGRAMANDOWEB.NET
    LCDO. JORGE MENDEZ
    info@programandoweb.net
*/
    $modulo                     =   $this->ModuloActivo;
    $ciclo_informacion          =   get_cf_ciclos_pagos_new($this->$modulo->result->id_empresa,0);
    $escala_escala_x_user_id    =   get_escala_x_user_id2($this->$modulo->result->user_id);
    $ciclos_pagos_end           =   get_ciclos_pagos_now();
    $config                     =   $this->session->userdata('Configuracion');
    //pre($ciclos_pagos_end);
    $registro                   =   get_registro_contable_honorarios_new($this->uri->segment(3),$this->uri->segment(4));
    $debito     =   0;
    $credito    =   0;
    foreach($registro as $v){
        $debito     =   $debito     +   round($v->debito,2);    
        $credito    =   $credito    +   round($v->credito,2);   
    }
    $pagos  =   array(  "caja_id"           =>      ResumenCajas(array('110505'),array("6")),
                        "procesador_id"     =>      ResumenBancosNew(array("Pesos")),
                        "modelo_id"=>$this->uri->segment(3));

    $rp_honorarios_modelos  =   array();                        
?>
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col">
            <?php 
                $chequeo    =   chequear_Honorarios_X_ciclo_de_produccion($this->uri->segment(3),$this->user->ciclo_produccion_id);
            ?>
                <input type="hidden" id="chequeo" value="<?php if(empty($chequeo)){echo 0;}else{echo 1;}?>" />
            <?php
                    
                if(empty($chequeo)){
                echo TaskBar(array("name"       =>  array(  "title" =>  "Liquidación recaudos Modelos.",
                                                            "icono"=>'<i class="fas fa-bars"></i>',
                                                            "url"   =>  current_url()),
                                    "pago"      =>  array(  "title" =>  "Aprobar Pago",
                                                            "icono" =>  '<i class="fas fa-thumbs-up"></i>',
                                                            "url"   =>  base_url("Operaciones/ProcesarHonorarios/".$this->uri->segment(3))),
                                    "pdf"       =>  true,                       
                                                                                    
                            )
                        );
                }else if($chequeo->estatus==9){
                    echo TaskBar(array("name"       =>  array(  "title" =>  "Liquidación recaudos Modelos.",
                                                            "icono"=>'<i class="fas fa-bars"></i>',
                                                            "url"   =>  current_url()),
                                    "pago"      =>  array(  "title" =>  "Aprobar Pago",
                                                            "icono" =>  '<i class="fas fa-thumbs-up"></i>',
                                                            "url"   =>  base_url("Operaciones/ProcesarHonorarios/".$this->uri->segment(3))),
                                    "pdf"       =>  true,                       
                                                                                    
                            )
                        );
                }else{
                    
                    $chequeo2               =   chequear_Honorarios_Pagados_X_ciclo_nro_documento($this->uri->segment(3),$chequeo->consecutivo);
                    $chequeo3               =   sum_Honorarios_Pagados_X_ciclo_nro_documento($this->uri->segment(3),$chequeo->consecutivo);
                    if(!empty($chequeo2) && ($chequeo3->credito == $chequeo->debito)){
                        $saldo_pendiente    =   $chequeo->debito ;
                        echo TaskBar(array( "name"      =>  array(  "title" =>  "Pago a Modelo.",
                                                                "icono"=>'<i class="fas fa-bars"></i>',
                                                                "url"   =>  current_url()),
                                        "pdf"       =>  true,
                                        "excel"     =>  true,
                                        "mail"      =>  array(  "id"    =>  "mail" ),
                        
                            )
                        );                              
                    }else{
                        if($debito>0){
                            $saldo_pendiente    =   $chequeo->debito - ($debito - $chequeo->debito);
                        }else{
                            $saldo_pendiente    =   $chequeo->debito;   
                        }
                    echo TaskBar(array( "name"      =>  array(  "title" =>  "Pago a Modelo.",
                                                                "icono"=>'<i class="fas fa-bars"></i>',
                                                                "url"   =>  current_url()),
                                        "pago"      =>  array(  "title"=>"Pago Efectivo",
                                                                "icono"=>'<i class="fas fa-dollar-sign"></i>',
                                                                "url"=>base_url("Operaciones/PagarHonorarios/".$this->uri->segment(3))),                                                            
                                        "pdf"       =>  true,
                                        "excel"     =>  true,
                                        "mail"      =>  array(  "id"    =>  "mail" ),           
                            )
                        );
                    }
                }
            ?>
            <div class="row">
                <!--div class="col-md-3">
                   Código de Tercero
                </div>
                <div class="col-md-3 text-right">
                    <b>
                        <?php
                            echo $rp_honorarios_modelos["identificacion"]   =   $this->$modulo->result->identificacion;
                        ?>
                    </b>
                </div-->
                <div class="col-md-2">
                   Período de Pago
                </div>
                <div class="col-md-4 text-right">
                    <b>
                        <?php 
                            $periodo_pagos                              =   centrodecostos($this->$modulo->result->id_empresa);
                            echo $rp_honorarios_modelos["ciclopago"]    =   ciclopago($periodo_pagos->periodo_pagos,$ciclo_informacion->mes,$ciclo_informacion->fecha_desde);
                        ?>
                    </b>
                </div>
                <div class="col-md-3 ">
                   Valor TRM
                </div>
                <div class="col-md-3 text-right">
                    <b>
                        <?php 
                            $trm_now                                =   periodotrm(calculo_fechas($ciclo_informacion->fecha_hasta,$cantidad_dias='+1'))->monto;
                            echo $rp_honorarios_modelos["trm_now"]  =   format($trm_now,true);
                        ?>
                    </b>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                   Sucursal
                </div>
                <div class="col-md-4 text-right">
                    <b>
                        <?php 
                            $centrodecostos                                 =   centrodecostos($this->$modulo->result->centro_de_costos);
                            echo $rp_honorarios_modelos["nombre_legal"]     =   $centrodecostos->nombre_legal;
                        ?>
                    </b>
                </div>
                <div class="col-md-3 ">
                   Días Trabajados
                </div>
                <div class="col-md-3 text-right">
                    <b>
                        <?php 
                            $trm_ciclo          =   trm_ciclo($periodo_pagos->periodo_pagos,get_ciclo_pago($periodo_pagos->periodo_pagos),date("m") - 1);
                            $DiasTrabajados     =   DiasTrabajados($this->$modulo->result->user_id,$ciclo_informacion->fecha_desde);
                            if(!empty($DiasTrabajados)){
                                echo $rp_honorarios_modelos["dias_trabajados"]  =   $dias_trabajados    =   $DiasTrabajados->dias_trabajados;
                            }else{
                                echo $rp_honorarios_modelos["dias_trabajados"]  =   $dias_trabajados    =   15; 
                            }
                        ?>
                        Días
                    </b>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                   Factor Bonificación
                </div>
                <div class="col-md-4 text-right">
                    <b>
                        <?php 
                            $factorBonificacion =   number_format($escala_escala_x_user_id->factor_bonificacion, 5, '.', '');
                            echo $rp_honorarios_modelos["factorBonificacion"]   =   $factorBonificacion;
                        ?>
                    </b>
                </div>
                <div class="col-md-3 ">
                   Escala
                </div>
                <div class="col-md-3 text-right" >
                    <b>
                        <?php 
                            $escala                                         =   get_escala_x_user_id($this->$modulo->result->user_id);
                            echo $rp_honorarios_modelos["nombre_escala"]    =   $escala->nombre_escala;
                        ?>
                    </b>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    Estado Informe Quincenal 
                </div>
                <div class="col-md-2 text-right">
                    <b>
                        <?php 
                            echo $rp_honorarios_modelos["estado_informe_quincenal"] =   format(get_total_tokens($this->$modulo->result->user_id,$ciclo_informacion->fecha_desde,$ciclo_informacion->fecha_hasta),false);
                        ?> Tokens
                    </b>
                </div>
                <div class="col-md-3 ">
                   Meta Ideal
                </div>
                <div class="col-md-3 text-right">
                    <b>
                        <?php 
                            if($this->$modulo->result->meta_ideal>0){
                                $varmeta    =   $this->$modulo->result->meta_ideal;
                                echo $rp_honorarios_modelos["varmeta"]  =   format($varmeta,false);
                            }else{
                                $varmeta    =   predateoFactorBonificacion($escala_escala_x_user_id->meta,$dias_trabajados);
                                echo $rp_honorarios_modelos["varmeta"]  =   format($varmeta,false).' (Por Defecto)';
                            }
                            //echo $rp_honorarios_modelos["varmeta"]    =   format($this->$modulo->result->meta_ideal,false);
                            
                        ?>
                    </b>
                </div>
            </div>
            <div class="section bd-example-tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="plataforma-tab" data-toggle="tab" href="#plataforma" role="tab">
                            Facturación por Plataforma 
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="ingresos-tab" data-toggle="tab" href="#ingresos" role="tab">
                            Otros Ingresos 
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="descuentos-tab" data-toggle="tab" href="#descuentos" role="tab">
                            Descuentos
                        </a>
                    </li>
                    <?php if(count($registro)>0){?>
                    <li class="nav-item">
                        <a class="nav-link" id="registrocontable-tab" data-toggle="tab" href="#registrocontable" role="tab">
                            Registro Contable 
                        </a>
                    </li>
                    <?php }?>
                    <li class="nav-item">
                        <a class="nav-link" id="movimientos-tab" data-toggle="tab" href="#movimientos" role="tab">
                            Movimientos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="ringresos-tab" data-toggle="tab" href="#ringresos" role="tab">
                            Resumen de Ingresos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="observaciones-tab" data-toggle="tab" href="#observaciones" role="tab" aria-controls="observaciones" aria-expanded="true">Observaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="ringresoss-tab" data-toggle="tab" href="#ringresoss" role="tab">
                            Análisis
                        </a>
                    </li>
                </ul>
                <div class="tab-content row">
                    <div class="tab-pane active col-md-12" id="plataforma" role="tabpanel">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th><b>Plataforma</b></th>
                                    <th><b>Usuario</b></th>
                                    <th class="text-center"><b>Factura</b></th>
                                    <th class="text-right"><b>Rep. Quincenal</b></th>
                                    <th class="text-right"><b>Producción</b></th>
                                    <th class="text-right"><b>Diferencia</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $totalRQ        =   0;
                                    $totalP         =   0;
                                    $rp_honorarios_modelos["HonorariosModelos"]             =   $HonorariosModelos  =   $this->$modulo->HonorariosModelos($this->$modulo->result->user_id);
                                    foreach($rp_honorarios_modelos["HonorariosModelos"] as $k => $v){
                                ?>
                                    <tr>
                                        <td>
                                            <?php 
                                                print($v->primer_nombre);
                                                //pre($v);
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                print_r($v->nickname);
                                                $rp_honorarios_modelos["user_id"][$k]                       =       $user_id        =   $this->$modulo->result->user_id;    
                                                $rp_honorarios_modelos["nickname_id"][$k]                   =       $nickname_id    =   $v->nickname_id;
                                                $get_diario     =   get_diario($user_id,$nickname_id,$ciclo_informacion->fecha_desde,$ciclo_informacion->fecha_hasta);
                                                $conversion_token_standar                                   =       conversion_token_standar(@$get_diario->monto,$v->equivalencia);
                                                
                                            
                                                $items_factura_x_nickname   =   items_factura_x_nickname($v->nickname_id,1);
                                                $factura                    =   @$items_factura_x_nickname->consecutivo;
                                                
                                                if(!empty($items_factura_x_nickname)){
                                                    $items_factura_x_nickname   =   json_decode($items_factura_x_nickname->json);
                                                }
                                                
                                                if(!empty($items_factura_x_nickname)){
                                                    $produccion     =   $items_factura_x_nickname->tokens;
                                                }else{
                                                    $produccion     =   0;
                                                }
                                                $totalP         =   $totalP + @$items_factura_x_nickname->monto_global_usd / 0.05;
                                                $conversion     =   conversion_token_standar(@$produccion,$v->equivalencia);
                                                $conversion     =   @$items_factura_x_nickname->monto_global_usd / 0.05;
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                                if(!empty($factura)){
                                            ?>
                                                    <a target="_blank" class="btnss btn-primaryss btn-mdss documentos" href="<?php echo base_url("Reportes/VerFactura/".$factura)?>"><?php echo $factura;?></a>
                                            <?php 
                                                }else{
                                                    echo '---'; 
                                                }                                           
                                            ?>
                                        </td>
                                        <td class="text-right" >
                                            <?php 
                                                echo $rp_honorarios_modelos["conversion_token_standar"][$k] =       format($conversion_token_standar,false);
                                                $totalRQ        =   $totalRQ + $conversion_token_standar;
                                            ?>
                                        </td>
                                        <td class="text-right">
                                            <?php 
                                                echo $rp_honorarios_modelos["conversion"][$k]   =   format($conversion,false);
                                            ?>
                                        </td>
                                        <td class="text-right">
                                            <?php
                                                
                                                if(!empty($items_factura_x_nickname)){
                                                    $produccion     =   $items_factura_x_nickname->tokens;
                                                }else{
                                                    $produccion     =   0;
                                                } 
                                                if(!empty($get_diario)){
                                                    echo $rp_honorarios_modelos["conversion_conversion_token_standar"][$k]  =   format( $conversion - $conversion_token_standar,false);
                                                }else{
                                                    echo $rp_honorarios_modelos["conversion_conversion_token_standar"][$k]  =   format($conversion,false);  
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                <?php }?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center"></td>
                                    <td class="text-right">
                                        <b>
                                        <?php echo $rp_honorarios_modelos["totalRQ"]            =   format($totalRQ,false);?>
                                        </b>
                                    </td>
                                    <td class="text-right">
                                        <b>
                                            <?php echo $rp_honorarios_modelos["totalP"]         =   format($totalP,false);?>
                                        </b>
                                    </td>
                                    <td class="text-right">
                                        <b> 
                                            <?php echo $rp_honorarios_modelos["totalP_totalRQ"] =   format($totalP - $totalRQ,false);?>
                                        </b>
                                    </td>
                                </tr>
                            </tfoot>
                        </table> 
                    </div> 
                    <div class="tab-pane col-md-12" id="ingresos" role="tabpanel">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th><b>Concepto</b></th>
                                    <th><b>Observación</b></th>
                                    <th class="text-center"><b>Recurrencia</b></th>
                                    <th class="text-right"><b>Valor</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $valor_total    = 0;
                                    $rp_honorarios_modelos["ListOtrosIngresos"]     =   $ListOtrosIngresos  =   OtrosIngresos($this->$modulo->result->user_id);
                                    if(count($ListOtrosIngresos)>0){
                                        foreach($ListOtrosIngresos as $k=>$v){
                                ?>
                                            <tr>
                                                <td>
                                                    <?php print_r($v->concepto);?>
                                                </td>
                                                <td>
                                                    <?php print_r($v->observacion);?>
                                                </td>
                                                 <td class="text-center">
                                                    <?php 
                                                        if($v->recurrente==1){
                                                            echo    $rp_honorarios_modelos["recurrente"][$k]    =   'Si';   
                                                        }else{
                                                            echo    $rp_honorarios_modelos["recurrente"][$k]    =   "No";   
                                                        }
                                                        
                                                    ?>
                                                </td>
                                                <td class="text-right">
                                                    <?php 
                                                        $valor_total                                =   $valor_total+$v->valor;
                                                        echo $rp_honorarios_modelos["valor"][$k]    =   format($v->valor,false);
                                                    ?>
                                                </td>
                                               
                                            </tr>
                                <?php       
                                        }
                                    }else{
                                ?>
                                    
                                <?php       
                                    }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center"><b>Total</b></td>
                                    <td class="text-right">
                                        <b>
                                            <?php echo $rp_honorarios_modelos["valor_total"]    =   format($valor_total,false);?>
                                        </b>
                                    </td>
                                </tr>
                            </tfoot>
                        </table> 
                    </div>
                    <div class="tab-pane col-md-12" id="descuentos" role="tabpanel">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th><b>Concepto</b></th>
                                    <th><b>Observación</b></th>
                                    <th><b>Cuotas</b></th>
                                    <th class="text-right"><b>Valor</b></th>
                                    <th class="text-right"><b>Pendiente</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $total_monto_cuota          =   0;
                                    $total_restante             =   0;
                                    $rp_honorarios_modelos["Descuentos"]                =   $ListOtrosIngresos          =   Descuentos($this->$modulo->result->user_id);
                                    if(count($ListOtrosIngresos)>0){
                                        foreach($ListOtrosIngresos as $k => $v){
                                ?>
                                            <tr>
                                                <td>
                                                    <?php print_r($v->concepto);?>
                                                </td>
                                                <td>
                                                    <?php print_r($v->observacion);?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        $cantidad_de_cuotas = CountCuotasDescuentos($v->descuento_id)->total;
                                                        echo $rp_honorarios_modelos["cantidad_de_cuotas"][$k]   =   $cantidad_de_cuotas + 1;
                                                    ?> 
                                                        / 
                                                    <?php 
                                                        echo $rp_honorarios_modelos["nro_quincenas"][$k]        =   $v->nro_quincenas;
                                                    ?>
                                                </td>
                                                <td class="text-right">
                                                    <?php 
                                                            $monto_cuota                                        =   $v->valor / $v->nro_quincenas;
                                                            $total_monto_cuota                                  =   $total_monto_cuota + $monto_cuota;
                                                            echo $rp_honorarios_modelos["monto_cuota"][$k]      =   format($monto_cuota,false);
                                                            $pagos["monto_cuota"][$k]                           =   @$monto_cuota;
                                                    ?>
                                                </td>
                                                <td class="text-right">
                                                    <?php 
                                                        $restar_a_valor = $cantidad_de_cuotas + 1   * $monto_cuota;
                                                        $restante       =   $v->valor -  $restar_a_valor;
                                                        $total_restante =   $total_restante + $restante;
                                                        echo $rp_honorarios_modelos["restante"][$k] =   format($restante ,false);
                                                    ?>
                                                </td>                                           
                                            </tr>
                                <?php       
                                        }
                                        
                                    }
                                ?>
                                <?php 
                                
                                    $escala_salario     =       calcula_montos_x_dias($escala_escala_x_user_id->auxilio_transporte,$dias_trabajados);
                                    $eps                =       calcula_montos_x_dias($escala_escala_x_user_id->eps,$dias_trabajados);
                                    if($eps>0){
                                        //$rp_honorarios_modelos["eps"] =   format($eps,false);
                                        //$total_monto_cuota    =   $total_monto_cuota+$eps;
                                        $rp_honorarios_modelos["eps"]   =   format(0,false);
                                        $total_monto_cuota  =   $total_monto_cuota;
                                    }?>
                                <?php
                                    $arl    =   calcula_montos_x_dias($escala_escala_x_user_id->arl,$dias_trabajados);
                                    if($arl>0){
                                        //$rp_honorarios_modelos["arl"] =   format($arl,false);
                                        //$total_monto_cuota    =   $total_monto_cuota+$arl;
                                        $rp_honorarios_modelos["arl"]   =   format(0,false);
                                        $total_monto_cuota  =   $total_monto_cuota;
                                        
                                    }
                                ?>
                                <?php 
                                    $bonificacion       =   calcular_bonificacion($varmeta,$totalP,$factorBonificacion,$trm_now);
                                    if(!empty($escala_escala_x_user_id)){
                                        $salario        =   calcula_montos_x_dias(@$escala_escala_x_user_id->salario,$dias_trabajados);
                                        $salario_var    =   (format($salario,false));
                                    }else{
                                        $salario_var    =   0;  
                                    }
                                    $aux                =   calcula_montos_x_dias($escala_escala_x_user_id->caja_compensacion,$dias_trabajados);
                                    $ahorro_prima       =   $salario + $escala_salario + $eps + $arl + $aux + $bonificacion;
                                    $total_ahorro_prima =   ($ahorro_prima * $escala_escala_x_user_id->prima)/100;
                                    if($total_ahorro_prima>0){
                                        //$total_monto_cuota                                =   $total_monto_cuota+$total_ahorro_prima;
                                        //$rp_honorarios_modelos["total_ahorro_prima"]  =   format($total_ahorro_prima,false);
                                        $total_monto_cuota                              =   $total_monto_cuota;
                                        $rp_honorarios_modelos["total_ahorro_prima"]    =   format(0,false);
                                    }
                                ?>
                                <?php 
                                    if($aux>0){
                                        //$total_monto_cuota                =   $total_monto_cuota+$aux;
                                        //$rp_honorarios_modelos["aux"] =   format($aux,false);                                     
                                        $total_monto_cuota              =   $total_monto_cuota;
                                        $rp_honorarios_modelos["aux"]   =   format(0,false);                                        
                                    }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center"><b>Total</b></td>
                                    <td class="text-right"><b><?php     echo $rp_honorarios_modelos["total_monto_cuota"]    =   format($total_monto_cuota,false);?></b></td>
                                    <td class="text-right"><b><?php     echo $rp_honorarios_modelos["total_restante"]       =   format($total_restante,false);?></b></td>
                                </tr>
                            </tfoot>
                        </table>  
                    </div>
                    <?php if(count($registro)>0){?>
                        <div class="tab-pane col-md-12" id="registrocontable" role="tabpanel">                    
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th width="100"><b>Cuenta</b></th>
                                        <th><b>Descripción</b></th>
                                        <th width="100" class="text-center"><b>Débito</b></th>
                                        <th width="100" class="text-center"><b>Crédito</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $rp_honorarios_modelos["registro"]  =   $registro;
                                        foreach($registro as $k =>$v){
                                            
                                        ?>
                                            <tr>
                                                <td><?php print_r($v->codigo_contable);?></td>
                                                <td><?php print_r($v->cuenta_contable);?></td>
                                                <td class="text-center">
                                                    <?php 
                                                            //pre($v);
                                                            $debito                                         =   $debito     +   round($v->debito,2);    
                                                            echo $rp_honorarios_modelos["debito"][$k]       =   format($v->debito);
                                                    ?>
                                                </td>
                                                <td class="text-right">
                                                    <?php   
                                                            $credito                                        =   $credito    +   round($v->credito,2);   
                                                            echo $rp_honorarios_modelos["credito"][$k]      =   format($v->credito);
                                                    ?>
                                                </td>
                                            </tr>
                                    <?php 
                                        }
                                    ?>  
                                </tbody>                        
                            </table>                                    
                        </div>
                    <?php }?>
                    <div class="tab-pane col-md-12" id="movimientos" role="tabpanel">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th class="text-center">Operación</th>
                                    <th class="text-center">Documento</th>
                                    <th class="text-left">Responsable</th>
                                    <th class="text-right">Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $rp_honorarios_modelos["movimientos"]               =   $movimientos    =   getMovimientosGeneral(NULL,$this->uri->segment(4),array(12,13),array("138020","233525"),NULL,$this->uri->segment(3));
                                    if(count($movimientos)>0){
                                        foreach($movimientos as $k => $v){
                                ?>                  
                                        <tr>
                                            <td>
                                                <?php 
                                                    print($v->fecha);
                                                ?>
                                            </td>
                                            <td><?php echo $rp_honorarios_modelos["tipo_documento"][$k] =   tipo_documento($v->tipo_documento);?></td>
                                            <td class="text-center">
                                                <?php if($v->tipo_documento==5){?>
                                                <a class="nav-link lightbox documentos"  data-type="iframe" title="Comprobante bancario No. <?php echo $v->consecutivo;?>" href="<?php echo base_url($this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$v->consecutivo.'/detalle_contable/'.$this->uri->segment(3));?>">
                                                <?php }?>
                                                    <?php print($v->consecutivo);?>
                                                <?php if($v->tipo_documento==5){?>                                                                
                                                </a>
                                                <?php }?>
                                            </td>
                                            <td><?php print($v->primer_nombre);?> <?php print($v->primer_apellido);?></td>
                                            <td class="text-right">
                                                <?php
                                                    if($v->debito>0){
                                                        echo format($v->debito,true);
                                                    }else{
                                                        echo format($v->credito,true);
                                                    } 
                                                ?>
                                            </td>
                                        </tr>
                                <?php   
                                        }
                                    }else{
                                ?>
                                    <tr>
                                        <td colspan="5" class="text-center">No hay registros</td>
                                    </tr>
                                <?php       
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane col-md-12" id="ringresos" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-2">
                                       Salario Básico
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <b>
                                            <?php
                                                echo $rp_honorarios_modelos["salario_var"]      =   $salario_var;
                                                $recalcular_prima_semestral = $total_liquidacion_ingresos   = (int)str_replace(".","",$salario_var);
                                            ?>
                                        </b>
                                    </div>
                                    <div class="col-md-3 ">
                                        Aux. E.P.S
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <b>
                                            <?php 
                                                echo $rp_honorarios_modelos["aux_eps"]  =   format($eps,false);
                                                $total_beneficios   = $eps;
                                            ?>
                                        </b>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                       Aux. Transporte
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <b>
                                           <?php
                                                /*AUXILO DE TRANSPORTE*/
                                                echo $rp_honorarios_modelos["escala_salario"]   =   format($escala_salario,false);  
                                                $total_liquidacion_ingresos +=  (int)str_replace(".","",$escala_salario);
                                            ?>
                                        </b>
                                    </div>
                                    <div class="col-md-3 ">
                                        Aux. Caja Compensación
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <b>
                                        <?php 
                                            echo $rp_honorarios_modelos["aux_aux"]          =   format($aux,false);
                                            $total_beneficios   += $aux;
                                        ?>
                                        </b>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                       Bonificación
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <b>
                                           <?php 
                                                echo $rp_honorarios_modelos["aux_bonificacion"] =   format($bonificacion,false);
                                                $recalcular_prima_semestral += $bonificacion;
                                                $total_liquidacion_ingresos += $bonificacion;
                                                
                                                //echo $total_liquidacion_ingresos += $bonificacion;
                                            ?>
                                        </b>
                                    </div>
                                    <div class="col-md-3 ">
                                         Aux. A.R.L
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <b>
                                            <?php 
                                                echo $rp_honorarios_modelos["aux_arl"]  =   format($arl,false);
                                                $total_beneficios   += $arl;
                                            ?>
                                        </b>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 ">
                                        Otros Ingresos
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <b>
                                            <?php 
                                                $ortros_ingresos    =   TotalOtrosIngresos($this->$modulo->result->user_id);
                                                if(!empty($ortros_ingresos)){
                                                   echo     $rp_honorarios_modelos["ortros_ingresos"]   =   format($ortros_ingresos->valor,false);
                                                   $total_liquidacion_ingresos +=$ortros_ingresos->valor;
                                                }else{
                                                   echo     $rp_honorarios_modelos["ortros_ingresos"]   =   format(0.00,false); 
                                                }
                                                
                                            ?>
                                        </b>
                                    </div>
                                    <div class="col-md-3">
                                        Ahorro Semestral (<?php echo $escala->prima?>%)
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <b>
                                            <?php 
                                                $recalculo_prima    =   $recalcular_prima_semestral * ($escala->prima / 100);
                                                $primas             =   round($ahorro_prima, 0) + round($total_ahorro_prima,0);
                                                $hacia_arriba       =   round($primas, -3);
                                                $resultado          =   $primas - $hacia_arriba;
                                                //echo $rp_honorarios_modelos["total_ahorro_prima"] =   format($total_ahorro_prima,false);
                                                echo $rp_honorarios_modelos["total_ahorro_prima"]   =   format($recalculo_prima,false);
                                                $total_beneficios   += $recalculo_prima;
                                            ?>
                                        </b>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 ">
                                        <b>Total Liquidación de Ingresos</b>
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <b>
                                            <?php echo format( $total_liquidacion_ingresos,false);?>
                                        </b>
                                    </div>
                                    <div class="col-md-2">
                                        <b>
                                            Total Beneficios
                                        </b>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <b>
                                            <?php echo format($total_beneficios,false)?>
                                        </b>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-md-2">
                                        
                                    </div>
                                    <div class="col-md-4 text-right">
                                        
                                    </div>
                                    <div class="col-md-3 "><b>
                                        Total Ingresos</b>
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <b>
                                            <?php 
                                                $rp_honorarios_modelos["totalizacion_general"]      =   $totalizacion_general       =   $salario + $escala_salario + $eps + $arl + $aux +$bonificacion + $ortros_ingresos->valor + $total_ahorro_prima;
                                                //echo $rp_honorarios_modelos["totalizacion_general"]   =   format($totalizacion_general,false);
                                                echo $rp_honorarios_modelos["totalizacion_general"] =   format($total_liquidacion_ingresos,false);
                                                $pagos["total_ingresos"]    =   $totalizacion_general; 
                                            ?>
                                        </b>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-4 text-right">
                                        
                                    </div>
                                    <div class="col-md-3 ">
                                        Descuentos
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <?php 
                                            
                                            $rp_honorarios_modelos["total_monto_cuota"]                 =   $total_monto_cuota;
                                            echo $rp_honorarios_modelos["Descuentos_total_monto_cuota"] =   format($total_monto_cuota,false);
                                            $rp_honorarios_modelos["pagos_descuentos"]                  =   $pagos["descuentos"]                                        =   $total_monto_cuota; 
                                            $total_ingresos                                             =   $totalizacion_general -$total_monto_cuota;
                                            $total_liquidacion_ingresos                                 =   $total_liquidacion_ingresos - $total_monto_cuota;
                                        ?>
                                    </div>
                                </div>
                                <!--div class="row">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-4 text-right">
                                        
                                    </div>
                                    <?php 
                                        $subtotal   =   (   $totalizacion_general - $total_monto_cuota  );
                                        
                                        if(@$config->ajustar_decena==1 || @$config->porcentaje_retencion>0){
                                            if(!empty($config->porcentaje_retencion)){
                                                $porcentaje_retencion   =   $config->porcentaje_retencion / 100;
                                            }else{
                                                $porcentaje_retencion   =   0;
                                            }
                                            $subtotal_jorge=$subtotal  =  $subtotal - ($subtotal * $porcentaje_retencion);                                          
                                        
                                    ?>
                                        <div class="col-md-3 ">
                                            <b>Subtotal</b>
                                        </div>
                                        <div class="col-md-3 text-right">
                                            <b>
                                                <?php 
                                                    echo $rp_honorarios_modelos["Subtotal"] =   format($total_liquidacion_ingresos - $total_monto_cuota,false);
                                                ?>
                                            </b>
                                        </div>
                                    <?php 
                                        }
                                    ?>
                                </div-->
                                <div class="row">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-4 text-right">
                                        
                                    </div>
                                    <div class="col-md-3 ">
                                        ReteFuente (<?php echo $rp_honorarios_modelos["porcentaje_retencion"]   =    format($config->porcentaje_retencion,true)?>%)
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <?php   
                                                
                                                $total_liquidacion_rete                         =   $total_liquidacion_ingresos * @$porcentaje_retencion;
                                                $rp_honorarios_modelos["porcentaje_retencion"]  =   $pagos["porcentaje_retencion"]  =   @$config->porcentaje_retencion;
                                                echo $rp_honorarios_modelos["total_ingresosXporcentaje_retencion"]  =   format($total_liquidacion_rete,false);
                                                $rp_honorarios_modelos["rete_fuente"]  =  $pagos["rete_fuente"] = $total_ingresos * @$porcentaje_retencion; 
                                                
                                        ?>
                                    </div>
                                </div> 
                                 <div class="row">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-4 text-right">
                                        
                                    </div>
                                    <div class="col-md-3 ">
                                        <b>Subtotal</b>
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <b>
                                        <?php   
                                                $total_liquidacion_ingresos                 =   $total_liquidacion_ingresos - $total_liquidacion_rete;
                                                echo $rp_honorarios_modelos["subtotal_2"]   =   format($total_liquidacion_ingresos,false);
                                                $subtotaljorge                              =   $total_liquidacion_ingresos;
                                        ?>
                                        </b>
                                    </div>
                                </div>                                    
                                <div class="row" style="display:none;">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-4 text-right">
                                        
                                    </div>
                                    
                                        <div class="col-md-3 ">
                                            Subtotal 1
                                        </div>
                                        <div class="col-md-3 text-right">
                                            
                                        </div>
                                    <?php 
                                        $subtotal1          =   round(($totalizacion_general * @$porcentaje_retencion) - $total_monto_cuota, -3 );
                                        $ajuste_restante    =   $totalizacion_general - $total_monto_cuota;
                                        echo $rp_honorarios_modelos["subtotal1_2"]  =   $subtotal1;
                                    ?>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <?php //pre($config);?>
                                    </div>
                                    <?php if(@$config->ajustar_decena==1){
                                    ?>
                                        <div class="col-md-3 ">
                                            Ajuste a la decena
                                        </div>
                                        <div class="col-md-3 text-right">
                                        <?php   
                                                $ajuste_a_la_decena     =   ajuste_a_la_decena($subtotaljorge); 
                                                if($ajuste_a_la_decena<$subtotaljorge){
                                                    echo '-'.$rp_honorarios_modelos["ajuste_a_la_decena_subtotal"]  =   format($subtotaljorge - $ajuste_a_la_decena,false);
                                                }else{
                                                    $rp_honorarios_modelos["ajuste_a_la_decena_subtotal"]   =   format($ajuste_a_la_decena - $subtotaljorge,false);
                                                    echo '+'.$rp_honorarios_modelos["ajuste_a_la_decena_subtotal"];
                                                }
                                                $rp_honorarios_modelos["ajuste_a_la_decena"]        =   $pagos["ajuste_a_la_decena"] =  $ajuste_a_la_decena - $subtotal; 
                                        ?>
                                        </div>
                                    <?php 
                                    }else{
                                        $ajuste_a_decena    =   $subtotal - $subtotal1; 
                                        $ajuste_a_la_decena =   $subtotal ;
                                    }
                                ?>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-4 text-right">
                                        
                                    </div>
                                    <div class="col-md-3 ">
                                        <b>Total</b>
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <b>
                                            <?php   $rp_honorarios_modelos["pago_global"]   =   $pagos["pago_global"]       =   $ajuste_a_la_decena;  ?>
                                            <input type="hidden" id="total" value="<?php echo $ajuste_a_la_decena;?>" />
                                            <input type="hidden" id="ajuste_a_la_decena2" value="<?php echo $ajuste_a_la_decena;?>" />
                                            <?php 
                                                echo $rp_honorarios_modelos["ajuste_a_la_decena"]   =   format($ajuste_a_la_decena,false);
                                            ?>
                                        </b>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                           
                    <div class="tab-pane fade col-md-12" id="observaciones" role="tabpanel" aria-labelledby="movimientos-tab" aria-expanded="true">
                        <div class="row">
                            <div class="col-md-12">
                                <div style=" width:100%; height:20px;"></div>
                                <?php 
                                    HtmlObservaciones();
                                ?>
                            </div>
                        </div>                            
                    </div>
                </div>                    
            </div>
        </div>
    </div>
</div>


<div id="content" style="display:none;" >
    <?php   
        $hidden             =   array("ajuste_a_la_decena"=>""); 
        echo form_open(base_url("Operaciones/PagarHonorarios/".$this->uri->segment(3)),array('ajax' => 'true','id'=>'form_pago'),$hidden);
    ?>
    <?php echo form_close();?>
</div>
<div style="display:none;">
    <select class="form-control" name="procesador_id"  id="procesador_id" require>
        <?php 
            $rp_honorarios_modelos["Array_Pesos"]           =   ResumenBancosNew(array("Pesos"));
            foreach($rp_honorarios_modelos["Array_Pesos"] as $k2    => $v2){?>
            <option value="<?php print($v2->id_cuenta);?>"><?php print(entidadbancaria($v2->entidad_bancaria)); ?></option>
        <?php }?>
    </select>
    <select class="form-control" name="caja_id" id="caja_id" require>
        <?php 
            $rp_honorarios_modelos["Array_ResumenCajas"]    =   ResumenCajas(array('110505'),array("6"));
            foreach($rp_honorarios_modelos["Array_ResumenCajas"] as $k2 => $v2){?>
            <option value="<?php print($k2);?>"><?php print($v2->nombre_caja); ?></option>
        <?php }?>
    </select>
</div>
<?php
    //pre($pagos);
    
    $this->session->set_userdata(array("pagos"=>$pagos,"rp_honorarios_modelos"=>$rp_honorarios_modelos));
?>
<script>
    $(document).ready(function(){
        if($("#chequeo").val()=="1"){
            $("#ajuste_a_la_decena").val($("#ajuste_a_la_decena2").val());
            var content     =   $(  '<div id="contenedor_dinamico">'+
                                        '<div class="p-3">'+
                                            '<input type="text" class="form-control form-control-sm money" name="ajuste_a_la_decena" value="<?php echo $pagos["pago_global"] * 100;?>" />'+
                                        '</div>'+
                                        '<div class="p-3">'+
                                            '<input type="hidden" name="nro_documento" value="<?php echo $this->uri->segment(4);?>" />'+
                                            '<select class="form-control form-control-sm" id="medio_pago">'+
                                                '<option value="0">Seleccione</option>'+
                                                '<option value="procesador_id">Banco Nacional</option>'+
                                                '<option value="caja_id">Caja</option>'+
                                            '</select>'+
                                        '</div>'+
                                        '<div class="p-3" id="contenedor_procesadores">'+
                                        '</div>'+
                                        '<div class="p-3">'+
                                             '<button class="btn btn-primary" id="" type="submit">Procesar</button>'+
                                        '</div>'+
                                    '</div>');

            makemoney(content.find(".money"));
            var formulario  =   $("#form_pago");
            formulario.submit(function(){
                $('.popovers').popover('hide');
            });
                                            
            $(".pago").click(function(){
                return false;
            }).addClass("popovers")
                    .attr("data-monto","")
                    .attr("data-procesador_id","")
                    .attr("data-nro_cuenta","")
                    .attr("data-placement","bottom")
                    .attr("data-toggle","popover")
                    .attr("title","Pago Efectivo")
                .popover({
                    html:true,
                    offset:"0 150px",
                    content: formulario.html(content),
            });
            
            var _select     =   content.find("#medio_pago");
            _select.change(function(){
                var selector    =   $("#"+content.find("select").val()).clone();
                content.find("#contenedor_procesadores").html(selector);
                var opcion  =   $(this);
                $("#contenedor_procesadores").html($("#"+opcion.val()).clone());
            });
            $(document).keyup(function (event) {
                if (event.which === 27) {
                    $('.popovers').popover('hide');
                }
            });
        }
    });
</script>