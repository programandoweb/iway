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

    $subtotal=   0;
    
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
    if(count($pagos['caja_id']) > 0){
        foreach ($pagos['caja_id'] as $key => $value) {
            $consecu = $value->consecutivo;
        }
    }
    $documento = DocumentoHonorarios(13);
    $rp_honorarios_modelos  =   array();                         
    $periodo_pagos                              =   centrodecostos($this->$modulo->result->id_empresa);
    $periodo_de_pago = $rp_honorarios_modelos["ciclopago"]    =   ciclopago($periodo_pagos->periodo_pagos,$ciclo_informacion->mes,$ciclo_informacion->fecha_desde);
?>
                        <?php 
                            $trm_now                                =   periodotrm(calculo_fechas($ciclo_informacion->fecha_hasta,$cantidad_dias='+1'))->monto;
                            $Valor_TRM = $rp_honorarios_modelos["trm_now"]  =   format($trm_now,true);
                        ?>
                        <?php 
                            $centrodecostos                                 =   centrodecostos($this->$modulo->result->centro_de_costos);
                            $Sucursal = $rp_honorarios_modelos["nombre_legal"]     =   $centrodecostos->nombre_legal;
                        ?>
                        <?php 
                            $trm_ciclo          =   trm_ciclo($periodo_pagos->periodo_pagos,get_ciclo_pago($periodo_pagos->periodo_pagos),date("m") - 1);
                            $DiasTrabajados     =   DiasTrabajados($this->$modulo->result->user_id,$ciclo_informacion->fecha_desde);
                            if(!empty($DiasTrabajados)){
                                $DiasT = $rp_honorarios_modelos["dias_trabajados"]  =   $dias_trabajados    =   $DiasTrabajados->dias_trabajados;
                            }else{
                                $DiasT = $rp_honorarios_modelos["dias_trabajados"]  =   $dias_trabajados    =   15; 
                            }
                        ?>
                        <?php 
                            $factorBonificacion =   number_format($escala_escala_x_user_id->factor_bonificacion, 5, '.', '');
                            $factorB = $rp_honorarios_modelos["factorBonificacion"]   =   $factorBonificacion;
                        ?>
                        <?php 
                            $escala                                         =   get_escala_x_user_id($this->$modulo->result->user_id);
                            $Esc = $rp_honorarios_modelos["nombre_escala"]    =   $escala->nombre_escala;
                        ?>
                        <?php 
                            $InfQuincenal = $rp_honorarios_modelos["estado_informe_quincenal"] =   format(get_total_tokens($this->$modulo->result->user_id,$ciclo_informacion->fecha_desde,$ciclo_informacion->fecha_hasta),false);
                        ?>
                        <?php 
                            if($this->$modulo->result->meta_ideal>0){
                                $varmeta    =   $this->$modulo->result->meta_ideal;
                                $metaIdeal = $rp_honorarios_modelos["varmeta"]  =   format($varmeta,false);
                            }else{
                                $varmeta    =   predateoFactorBonificacion($escala_escala_x_user_id->meta,$dias_trabajados);
                                $metaIdeal = $rp_honorarios_modelos["varmeta"]  =   format($varmeta,false).' (Por Defecto)';
                            }
                            //echo $rp_honorarios_modelos["varmeta"]    =   format($this->$modulo->result->meta_ideal,false);
                            
                        ?>
                                <?php 
                                    $totalRQ        =   0;
                                    $totalP         =   0;
                                    $rp_honorarios_modelos["HonorariosModelos"]             =   $HonorariosModelos  =   $this->$modulo->HonorariosModelos($this->$modulo->result->user_id);
                                    foreach($rp_honorarios_modelos["HonorariosModelos"] as $k => $v){
                                ?>
                                            <?php 
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
                                            <?php 
                                                $rp_honorarios_modelos["conversion_token_standar"][$k] =       format($conversion_token_standar,false);
                                                $totalRQ        =   $totalRQ + $conversion_token_standar;
                                            ?>
                                            <?php 
                                                $rp_honorarios_modelos["conversion"][$k]   =   format($conversion,false);
                                            ?>
                                            <?php
                                                
                                                if(!empty($items_factura_x_nickname)){
                                                    $produccion     =   $items_factura_x_nickname->tokens;
                                                }else{
                                                    $produccion     =   0;
                                                } 
                                                if(!empty($get_diario)){
                                                    $rp_honorarios_modelos["conversion_conversion_token_standar"][$k]  =   format( $conversion - $conversion_token_standar,false);
                                                }else{
                                                    $rp_honorarios_modelos["conversion_conversion_token_standar"][$k]  =   format($conversion,false);  
                                                }
                                            ?>
                                <?php }?>

                                <?php $rp_honorarios_modelos["totalRQ"]            =   format($totalRQ,false);?>
                                <?php $rp_honorarios_modelos["totalP"]         =   format($totalP,false);?> 
                                <?php $rp_honorarios_modelos["totalP_totalRQ"] =   format($totalP - $totalRQ,false);?>
                                <?php
                                    $valor_total    = 0;
                                    $rp_honorarios_modelos["ListOtrosIngresos"]     =   $ListOtrosIngresos  =   OtrosIngresos($this->$modulo->result->user_id);
                                    if(count($ListOtrosIngresos)>0){
                                        foreach($ListOtrosIngresos as $k=>$v){
                                ?>
                                                    <?php 
                                                        if($v->recurrente==1){
                                                            $rp_honorarios_modelos["recurrente"][$k]    =   'Si';   
                                                        }else{
                                                            $rp_honorarios_modelos["recurrente"][$k]    =   "No";   
                                                        }
                                                        
                                                    ?>
                                                    <?php 
                                                        $valor_total                                =   $valor_total+$v->valor;
                                                        $rp_honorarios_modelos["valor"][$k]    =   format($v->valor,false);
                                                    ?>
                                <?php       
                                        }
                                    }else{
                                ?>
                                    
                                <?php       
                                    }
                                ?>
                                            <?php $rp_honorarios_modelos["valor_total"]    =   format($valor_total,false);?>
                                <?php
                                    $total_monto_cuota          =   0;
                                    $total_restante             =   0;
                                    $rp_honorarios_modelos["Descuentos"]                =   $ListOtrosIngresos          =   Descuentos($this->$modulo->result->user_id);
                                    if(count($ListOtrosIngresos)>0){
                                        foreach($ListOtrosIngresos as $k => $v){
                                ?>
                                                    <?php 
                                                        $cantidad_de_cuotas = CountCuotasDescuentos($v->descuento_id)->total;
                                                        $rp_honorarios_modelos["cantidad_de_cuotas"][$k]   =   $cantidad_de_cuotas + 1;
                                                    ?> 
                                                    <?php 
                                                        $rp_honorarios_modelos["nro_quincenas"][$k]        =   $v->nro_quincenas;
                                                    ?>
                                                    <?php 
                                                            $monto_cuota                                        =   $v->valor / $v->nro_quincenas;
                                                            $total_monto_cuota                                  =   $total_monto_cuota + $monto_cuota;
                                                            $rp_honorarios_modelos["monto_cuota"][$k]      =   format($monto_cuota,false);
                                                            $pagos["monto_cuota"][$k]                           =   @$monto_cuota;
                                                    ?>
                                                    <?php 
                                                        $restar_a_valor = $cantidad_de_cuotas + 1   * $monto_cuota;
                                                        $restante       =   $v->valor -  $restar_a_valor;
                                                        $total_restante =   $total_restante + $restante;
                                                        $rp_honorarios_modelos["restante"][$k] =   format($restante ,false);
                                                    ?>
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
                    <?php $rp_honorarios_modelos["total_monto_cuota"]    =   format($total_monto_cuota,false);
                    $rp_honorarios_modelos["total_restante"]       =   format($total_restante,false);?>
                    <?php if(count($registro)>0){?>

                                    <?php 
                                        $rp_honorarios_modelos["registro"]  =   $registro;
                                        foreach($registro as $k =>$v){
                                            
                                        ?>
                                                    <?php 
                                                            //pre($v);
                                                            $debito                                         =   $debito     +   round($v->debito,2);    
                                                            $rp_honorarios_modelos["debito"][$k]       =   format($v->debito);
                                                    ?>
                                                    <?php   
                                                            $credito                                        =   $credito    +   round($v->credito,2);   
                                                            $rp_honorarios_modelos["credito"][$k]      =   format($v->credito);
                                                    ?>

                                    <?php 
                                        }
                                    ?>  
                    <?php }?>
                                <?php 
                                    $rp_honorarios_modelos["movimientos"]               =   $movimientos    =   getMovimientosGeneral(NULL,$this->uri->segment(4),array(12,13),array("138020","233525"),NULL,$this->uri->segment(3));
                                    if(count($movimientos)>0){
                                        foreach($movimientos as $k => $v){
                                ?>                  
                                            <?php 
                                                $rp_honorarios_modelos["tipo_documento"][$k] =   tipo_documento($v->tipo_documento);
                                            ?>
                                <?php   
                                        }
                                    }else{
                                ?>
                                <?php       
                                    }
                                ?>
                                            <?php
                                                $SalarioBasico = $rp_honorarios_modelos["salario_var"]      =   $salario_var;
                                                $recalcular_prima_semestral = $total_liquidacion_ingresos   = (int)str_replace(".","",$salario_var);
                                            ?>
                                            <?php 
                                                $AuxEPS = $rp_honorarios_modelos["aux_eps"]  =   format($eps,false);
                                                $total_beneficios   = $eps;
                                            ?>
                                           <?php
                                                /*AUXILO DE TRANSPORTE*/
                                                $AuxTransporte = $rp_honorarios_modelos["escala_salario"]   =   format($escala_salario,false);  
                                                $total_liquidacion_ingresos +=  (int)str_replace(".","",$escala_salario);
                                            ?>
                                            <?php 
                                                $AuxARL = $rp_honorarios_modelos["aux_arl"]  =   format($arl,false);
                                                $total_beneficios   += $arl;
                                            ?>
                                           <?php 
                                                $Bon = $rp_honorarios_modelos["aux_bonificacion"] =   format($bonificacion,false);
                                                $recalcular_prima_semestral += $bonificacion;
                                                $total_liquidacion_ingresos += $bonificacion;
                                                
                                                //echo $total_liquidacion_ingresos += $bonificacion;
                                            ?>
                                        <?php 
                                            $AuxCajaCompensacion = $rp_honorarios_modelos["aux_aux"]          =   format($aux,false);
                                            $total_beneficios   += $aux;
                                        ?>
                                            <?php 
                                                $ortros_ingresos    =   TotalOtrosIngresos($this->$modulo->result->user_id);
                                                if(!empty($ortros_ingresos)){
                                                   $OtrosIngresos =   $rp_honorarios_modelos["ortros_ingresos"]   =   format($ortros_ingresos->valor,false);
                                                   $total_liquidacion_ingresos +=$ortros_ingresos->valor;
                                                }else{
                                                   $OtrosIngresos =   $rp_honorarios_modelos["ortros_ingresos"]   =   format(0.00,false); 
                                                }
                                                
                                            ?>
                                        <?php $EscalaP = $escala->prima; $rp_honorarios_modelos["escala_prima_porcentaje"]=$escala->prima;?>
                                            <?php 
                                                $recalculo_prima    =   $recalcular_prima_semestral * ($escala->prima / 100);
                                                $primas             =   round($ahorro_prima, 0) + round($total_ahorro_prima,0);
                                                $hacia_arriba       =   round($primas, -3);
                                                $resultado          =   $primas - $hacia_arriba;
                                                //echo $rp_honorarios_modelos["total_ahorro_prima"] =   format($total_ahorro_prima,false);
                                                $AhorroSemestral = $rp_honorarios_modelos["total_ahorro_prima"]   =   format($recalculo_prima,false);
                                                $total_beneficios   += $recalculo_prima;
                                            ?>
                                            <?php $TotalLiquidacion = format( $total_liquidacion_ingresos,false);?>
                                            <?php $totalBeneficios = format($total_beneficios,false); $rp_honorarios_modelos["total_beneficios"]=$total_beneficios;?>
                                            <?php 
                                                $rp_honorarios_modelos["totalizacion_general"]      =   $totalizacion_general       =   $salario + $escala_salario + $eps + $arl + $aux +$bonificacion + $ortros_ingresos->valor + $total_ahorro_prima;
                                                //echo $rp_honorarios_modelos["totalizacion_general"]   =   format($totalizacion_general,false);
                                                $TotalIngresos = $rp_honorarios_modelos["totalizacion_general"] =   format($total_liquidacion_ingresos,false);
                                                $pagos["total_ingresos"]    =   $totalizacion_general; 
                                            ?>
                                        <?php 
                                            
                                            $rp_honorarios_modelos["total_monto_cuota"]                 =   $total_monto_cuota;
                                            $Descu = $rp_honorarios_modelos["Descuentos_total_monto_cuota"] =   format($total_monto_cuota,false);
                                            $rp_honorarios_modelos["pagos_descuentos"]                  =   $pagos["descuentos"]                                        =   $total_monto_cuota; 
                                            $total_ingresos                                             =   $totalizacion_general -$total_monto_cuota;
                                            $total_liquidacion_ingresos                                 =   $total_liquidacion_ingresos - $total_monto_cuota;
                                        ?>
                                        <?php   
                                                
                                                $total_liquidacion_rete                         =   $total_liquidacion_ingresos * @$porcentaje_retencion;
                                                $rp_honorarios_modelos["porcentaje_retencion"]  =   $pagos["porcentaje_retencion"]  =   @$config->porcentaje_retencion;
                                                $Reten = $rp_honorarios_modelos["total_ingresosXporcentaje_retencion"]  =   format($total_liquidacion_rete,false);
                                                $rp_honorarios_modelos["rete_fuente"]  =  $pagos["rete_fuente"] = $total_ingresos * @$porcentaje_retencion; 
                                                
                                        ?>
                                        <?php   
                                                $total_liquidacion_ingresos                 =   $total_liquidacion_ingresos - $total_liquidacion_rete;
                                                $subto = $rp_honorarios_modelos["subtotal_2"]   =   format($total_liquidacion_ingresos,false);
                                                $subtotaljorge                              =   $total_liquidacion_ingresos;
                                        ?>
                                    <?php 
                                        $subtotal1          =   round(($totalizacion_general * @$porcentaje_retencion) - $total_monto_cuota, -3 );
                                        $ajuste_restante    =   $totalizacion_general - $total_monto_cuota;
                                        $subto1 = $rp_honorarios_modelos["subtotal1_2"]  =   $subtotal1;
                                    ?>
                                    <?php if(@$config->ajustar_decena==1){
                                    ?>
                                        <?php   
                                                $ajuste_a_la_decena     =   ajuste_a_la_decena($subtotaljorge); 
                                                if($ajuste_a_la_decena<$subtotaljorge){
                                                    $rp_honorarios_modelos["ajuste_a_la_decena_prefijo"]    =   '-';
                                                    $AjusteDecena = '-'.$rp_honorarios_modelos["ajuste_a_la_decena_subtotal"]  =   format($subtotaljorge - $ajuste_a_la_decena,false);
                                                }else{
                                                    $rp_honorarios_modelos["ajuste_a_la_decena_prefijo"]    =   '+';
                                                    $rp_honorarios_modelos["ajuste_a_la_decena_subtotal"]   =   format($ajuste_a_la_decena - $subtotaljorge,false);
                                                    $AjusteDecena = '+'.$rp_honorarios_modelos["ajuste_a_la_decena_subtotal"];
                                                }
                                                $rp_honorarios_modelos["ajuste_a_la_decena"]        =   $pagos["ajuste_a_la_decena"] =  $ajuste_a_la_decena - $subtotal; 
                                        ?>
                                    <?php 
                                    }else{
                                        $ajuste_a_decena    =   $subtotal - $subtotal1; 
                                        $ajuste_a_la_decena =   $subtotal ;
                                    }
                                ?>
                                            <?php   $rp_honorarios_modelos["pago_global"]   =   $pagos["pago_global"]       =   $ajuste_a_la_decena;  ?>

                                            <?php 
                                                $Total = $rp_honorarios_modelos["ajuste_a_la_decena"]   =   format($ajuste_a_la_decena,false);
                                            ?>                         
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

    $num=0;
    foreach($this->$modulo->HonorariosModelos($this->$modulo->result->user_id) as $v){ $num++;}
    $reg=$num/7;
    $Pag=ceil($reg);              
    for($i=1;$i<=$Pag;$i++){

?>
<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif;">
    <table class="ancho" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td width="30%" colspan="2">
                <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:55px;" />
            </td>
            <td style="text-align:right; font-size:12px; font-weight:bold;" valign="top" colspan="4">
                <?php echo $empresa->nombre_legal?><br/>
                Nit: <?php echo $empresa->identificacion;?> | <?php echo $empresa->tipo_empresa;?><br />
                <?php echo $empresa->direccion;?><br />               
                PBX: <?php echo $empresa->cod_telefono;?>-<?php echo $empresa->telefono?><br/>
                <?php echo $empresa->website;?><br/>
                <?php #pre($empresa); ?>
            </td>
        </tr>
    </table> 
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:30px;">
        <tr class="colorFondo">
            <th>Liquidación de cuentas en participación (Utilidades y/o honorarios) # 
                <?php
                    echo $documento->id_documento.' '.centrodecostos($this->$modulo->result->centro_de_costos)->abreviacion.' '.@$consecu;
                ?>
            </th>
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
              Sucursal: <b><?php echo $Sucursal; ?> - Room:Room#<?php echo $row->room_transmision; ?> - Turno: <?php echo @$turno; ?></b><br>
              Entidad Bancaria: <b><?php echo $row->entidad_bancaria; ?></b><br>
              Cuenta Bancaria: <b><?php echo $row->nro_cuenta; ?></b><br>
              Factor bonificación: <b><?php echo $factorB; ?></b>
            </td>
            <td>
                
            </td>
            <td style="background: #DEDEDE;">
                Ciclo de pago: 
                <b>
                    <?php 
                        echo $periodo_de_pago;
                    ?>
                </b><br>
                Fecha inicial: <b><?php echo $ciclo_informacion->fecha_desde; ?></b><br>
                Fecha final:: <b><?php echo $ciclo_informacion->fecha_hasta; ?></b><br>
                Estado: <b></b><br>
                Escala:
                    <b>
                        <?php 
                            echo $Esc;
                        ?>
                    </b><br>
                Días transmitidos:
                    <b>
                        <?php 
                            echo $DiasT;
                        ?>
                        Días
                    </b><br>
            Clasificación: <b><?php echo @$row->tipo_modelo; ?> (<?php echo @nombreUsuario(@$row->monitor)->Responsable; ?>)</b><br>
                Valor TRM:
                    <b>
                        <?php 
                            echo $Valor_TRM;
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
                    echo '$ '.$AuxEPS;
                ?>  
              </b>
            </td>
            <td>Pacto comercial (<b>Salario básico</b>)</td>
            <td class="borderight" style="text-align: right;">
                <b>
                    <?php 
                        echo '$ '.$SalarioBasico;
                    ?>
                </b>
            </td>
        <tr>
            <td class="borderleft">Auxilio A.R.L.</td>
            <td class="borderight" style="text-align: right;">
              <b>
                <?php
                    echo '$ '.$AuxARL;
                ?>
              </b>
            </td>
            <td>Pacto comercial (<b>Auxilio de transporte</b>)</td>
            <td class="borderight" style="text-align: right;">
                <b>
                    <?php
                        echo '$ '.$AuxTransporte;
                    ?>
                </b>
            </td>
        </tr>
        <tr>
            <td class="borderleft">Auxilio Caja Comp. Familiar</td>
            <td style="text-align: right;" class="borderight">
              <b>
                <?php
                    echo '$ '.$AuxCajaCompensacion;
                ?>
              </b>
            </td>
            <td>Pacto comercial (<b>Bonificación quincenal</b>)</td>
            <td class="borderight" style="text-align: right;">
                <b>
                    <?php 
                        echo '$ '.$Bon;
                    ?>
                </b>
            </td>
        </tr>
        <tr>
            <td class="borderleft">Provisión Auxilio Semestral (<?php echo $EscalaP = $escala->prima; $rp_honorarios_modelos["escala_prima_porcentaje"]=$escala->prima;?>%)*</td>
            <td class="borderight" style="text-align: right;">
                <b>
                    <?php echo '$ '.$AhorroSemestral; ?>       
                </b>
            </td>
            <td>Otros Ingresos</td>
            <td class="borderight" style="text-align: right;">
                <b>
                    <?php 
                        echo '$ '.$OtrosIngresos;
                    ?>
                </b>
            </td>
        </tr>
        <tr class="colorFondo">
            <td>Total benefcios pacto comercial</td>
            <td style="text-align: right; padding-right: 4px;">
                <?php echo '$ '.$totalBeneficios; ?>
            </td>
            <td>Total liquidación ingresos</td>
            <td style="text-align: right;padding-right: 4px;"><?php echo '$ '.$TotalIngresos; ?></td>
        </tr>
        <tr>
            <td colspan="2" class="bordeAll">Escala de pago SANCIONADA y RETIRADA es liquidada sobre el 50%</td>
            <td class="colorFondo">Total ingresos percibidos + beneficios</td>
            <td class="colorFondo" style="text-align: right;padding-right: 4px"><?php echo '$ '.$totalBeneficiosIngresos = $totalBeneficios + $TotalIngresos; ?></td>
        </tr>
        <tr>
            <td colspan="4" class="bordeAll" style="text-align: center;font-size: 9px;">*Los valores denominados "PROVISIÓN AUXILIO SEMESTRAL" solo serán pagados si no existe terminación de contrato antes del día 20 de Junio y/o Diciembre respectivamente.</td>
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
                    <td class="borderleft" style="text-align: right;padding-right: 5px;">
                        <?php 
                            echo $rp_honorarios_modelos["conversion"][$k]   =   format($conversion,false);
                        ?>
                    </td>
                    <td class="borderleft borderight" style="text-align: right; padding-right: 5px;">
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
                <td class="text-right colorFondo" style="text-align: right;">
                    <b>
                        <?php echo $rp_honorarios_modelos["totalP"]         =   format($totalP,false);?>
                    </b>
                </td>
                <td class="text-right colorFondo" style="text-align: right;">
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
                        <?php echo $subto; ?>
                    </b>
                </td>
            </tr>
            <tr>
                <td class="borderleft">Meta ideal</td>
                <td class="borderight" style="text-align: right;">
                    <b>
                        <?php echo $metaIdeal; ?>
                    </b>
                </td>
                <td>Retención en la fuente (<?php echo $PorcentajeRete = $rp_honorarios_modelos["porcentaje_retencion"]   =    format($config->porcentaje_retencion,true)?> %)</td>
                <td class="borderight" style="text-align: right;">
                    <b>
                        <?php echo $Reten; ?>
                    </b>
                </td>
            </tr>
            <tr>
                <td class="borderleft bordetop">Cumplimiento meta ideal</td>
                <td class="borderight bordetop" style="text-align: right;">
                    <b>
                    </b>
                </td>
                <td class="borderleft">Descuentos</td>
                <td class="borderight" style="text-align: right;">
                    <b>
                        <?php echo $Descu; ?>
                    </b>
                </td>
            </tr>
            <tr>
                <td style="text-align: center;" rowspan="3" colspan="2" class="bordeBottom borderleft bordetop">
                    <b style="font-size: 10px;">
                        Importante: Pérdida de beneficios del pacto comercial: a) conexión o llegadas tarde más de dos (2) veces a la quincena, b) falta sin justa causa, c) no atención a members, d) no atención monitores, ante pérdida de beneficios modelo asumirá costo seguridad social de ese periodo, porcentaje de pago del 50% (TRMX0,88X0,05X50%).
                    </b>
                </td>
                <td class="borderleft">Subtotal</td>
                <td style="text-align: right;" class="borderight"><b><?php echo $subto; ?></b></td>
            </tr>
            <tr>
                <td class="borderleft">Ajuste a la descena</td>
                <td class="borderight" style="text-align: right;"><b><?php echo $AjusteDecena; ?></b></td>
            </tr>
            <tr>
                <td class="colorFondo">Total liquidación de ingresos finales</td>
                <td style="text-align: right;" class="colorFondo"><b><?php echo $Total; ?></b></td>
            </tr>
        </tbody>
    </table>
    <div class="footer bordetop" style="position: absolute; bottom:10px; width: 100%">
      <table>
          <tr>
              <td style="width:33%; text-align: left;font-size: 9px;color :black;">Fecha generacion documento <?php echo date("Y-m-d"); ?></td>
              <td style="text-align: center;font-size: 9px;">Página <?php echo $i.' / '.$Pag ?></td>
              <td style="width:33%; text-align: right;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
          </tr>
      </table>
    </div>
</div>
<?php } ?>  