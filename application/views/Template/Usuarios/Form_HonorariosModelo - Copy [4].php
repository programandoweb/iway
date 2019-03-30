<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php
	$modulo						=	$this->ModuloActivo;
	$ciclo_informacion			=	get_cf_ciclos_pagos_new($this->$modulo->result->id_empresa,0);
?>
<?php 
	$escala_escala_x_user_id	=	get_escala_x_user_id2($this->$modulo->result->user_id);
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
       	 	<div class="row filters">
            	<div class="col-md-12">
		            <h4 class="font-weight-700 text-uppercase orange">
                    	Resumen de Configuración <?php echo nombre($this->$modulo->result);?> 
					</h4>
                </div>
            </div>
            <div class="row">
            	<div class="col-md-2">
		           Código de Tercero
                </div>
                <div class="col-md-4 text-right">
                	<b>
	                    <?php print_r($this->$modulo->result->identificacion);?>
                    </b>
                </div>
                <div class="col-md-3 ">
		           Valor TRM
                </div>
                <div class="col-md-3 text-right">
	                <b>
						<?php 
							$trm_now=periodotrm($ciclo_informacion->fecha_hasta)->monto;
						echo format($trm_now,true);?>
                   	</b>
                </div>
            </div>
            <div class="row">
            	<div class="col-md-2">
		           Período de Pago
                </div>
                <div class="col-md-4 text-right">
                    <b>
	                    <?php 
							
							//pre($ciclo_informacion);
							$periodo_pagos		=	centrodecostos($this->$modulo->result->id_empresa);
							print(ciclopago($periodo_pagos->periodo_pagos,$ciclo_informacion->mes,$ciclo_informacion->fecha_desde));
							//echo format_periodo_pago($periodo_pagos->periodo_pagos,get_ciclo_pago($periodo_pagos->periodo_pagos),date("m"));
							//pre(get_cf_ciclos_pagos_new($this->$modulo->result->id_empresa,0));							
							
						?>
                    </b>
                </div>
                <div class="col-md-3 ">
		           Días Trabajados
                </div>
                <div class="col-md-3 text-right">
	                <b>
						<?php 
							$trm_ciclo			=	trm_ciclo($periodo_pagos->periodo_pagos,get_ciclo_pago($periodo_pagos->periodo_pagos),date("m") - 1);
							$DiasTrabajados		=	DiasTrabajados($this->$modulo->result->user_id,$ciclo_informacion->fecha_desde);
							if(!empty($DiasTrabajados)){
								echo $dias_trabajados=$DiasTrabajados->dias_trabajados;
							}else{
								echo $dias_trabajados = 15;	
							}
						?>
                        Días
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
							$centrodecostos		=	centrodecostos($this->$modulo->result->centro_de_costos);
							print_r($centrodecostos->nombre_legal);
						?>
                    </b>
                </div>
                <div class="col-md-3 ">
		           Escala
                </div>
                <div class="col-md-3 text-right" >
	                <b>
						<?php 
							$escala	=	get_escala_x_user_id($this->$modulo->result->user_id);
							print_r($escala->nombre_escala);
						?>
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
							$factorBonificacion	=	number_format($escala_escala_x_user_id->factor_bonificacion, 5, '.', '');
							print_r($factorBonificacion);
						?>
                    </b>
                </div>
                <div class="col-md-3 ">
		           Meta
                </div>
                <div class="col-md-3 text-right">
	                <b>
						<?php 
							$varmeta	=	predateoFactorBonificacion($escala_escala_x_user_id->meta,$dias_trabajados);
							print_r(format($varmeta,false));
						?>
                   	</b>
                </div>
            </div>
            <div class="section">
				<ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                    	<a class="nav-link active" data-toggle="tab" href="#plataforma" role="tab">
                    		Facturación por Plataforma 
                    	</a>
                    </li>
			  		<li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#ingresos" role="tab">
                            Otros Ingresos 
                        </a>
			  		</li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#descuentos" role="tab">
                            Descuentos
                        </a>
			  		</li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#ringresos" role="tab">
							Resumen de Ingresos
                        </a>
			  		</li>
				</ul>
                <div class="tab-content row">
                    <div class="tab-pane active col-md-12" id="plataforma" role="tabpanel">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <td><b>Plataforma</b></td>
                                    <td><b>Nickname</b></td>
                                    <td class="text-right"><b>Rep. Quincenal</b></td>
                                    <td class="text-right"><b>Producción</b></td>
                                    <td class="text-right"><b>Diferencia</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $totalRQ		=	0;
                                    $totalP			=	0;
                                    foreach($this->$modulo->HonorariosModelos($this->$modulo->result->user_id) as $v){?>
                                    <tr>
                                        <td>
                                            <?php 
                                                print($v->primer_nombre);
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                print_r($v->nickname);
                                            ?>
                                        </td>
                                        <td class="text-right" >
                                            <?php 
                                                $user_id		=	$this->$modulo->result->user_id;	
                                                $nickname_id	=	$v->nickname_id;
                                                $get_diario		=	get_diario($user_id,$nickname_id,$ciclo_informacion->fecha_desde,$ciclo_informacion->fecha_hasta);
                                                $conversion_token_standar		=	conversion_token_standar(@$get_diario->monto,$v->equivalencia);
                                                print_r(format($conversion_token_standar,false));
                                                $totalRQ		=	$totalRQ + $conversion_token_standar;
                                                
                                            ?>
                                        </td>
                                        <td class="text-right">
                                            <?php 
                                                $items_factura_x_nickname	=	items_factura_x_nickname($v->nickname_id);
                                                if(!empty($items_factura_x_nickname)){
                                                    $produccion		=	$items_factura_x_nickname->tokens;
                                                }else{
                                                    $produccion		=	0;
                                                }
                                                $totalP			=	$totalP + conversion_token_standar(@$produccion,$v->equivalencia);
                                                $conversion		=	conversion_token_standar(@$produccion,$v->equivalencia);
                                                print_r(format($conversion,false));
                                            ?>
                                        </td>
                                        <td class="text-right">
                                            <?php
                                                if(!empty($items_factura_x_nickname)){
                                                    $produccion		=	$items_factura_x_nickname->tokens;
                                                }else{
                                                    $produccion		=	0;
                                                } 
                                                //$produccion		=	items_factura_x_nickname($v->nickname_id)->tokens;
                                                //pre($produccion);
                                                if(!empty($get_diario)){
                                                    //pre($get_diario);
                                                    print(format( $conversion - $conversion_token_standar,false));
                                                }else{
                                                    print_r(format($conversion,false));	
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                <?php }?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td>
                                        <b>
                                        Total
                                        </b>
                                    </td>
                                    <td class="text-right">
                                        <b>
                                        <?php echo format($totalRQ,false);?>
                                        </b>
                                    </td>
                                    <td class="text-right"><b><?php echo format($totalP,false);?></b></td>
                                    <td class="text-right"><b><?php echo format($totalP - $totalRQ,false);?></b></td>
                                </tr>
                            </tfoot>
                        </table> 
					</div> 
                    <div class="tab-pane col-md-12" id="ingresos" role="tabpanel">
                    	<table class="table table-hover">
                            <thead>
                                <tr>
                                    <td><b>Concepto</b></td>
                                    <td><b>Observación</b></td>
                                    <td class="text-center"><b>Recurrencia</b></td>
                                    <td class="text-right"><b>Valor</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $valor_total	= 0;
                                    $ListOtrosIngresos	=	OtrosIngresos($this->$modulo->result->user_id);
                                    if(count($ListOtrosIngresos)>0){
                                        foreach($ListOtrosIngresos as $v){
                                            
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
                                                            echo 'Si';	
                                                        }else{
                                                            echo "No";	
                                                        }
                                                    ?>
                                                </td>
                                                <td class="text-right">
                                                    <?php 
                                                        $valor_total	= 	$valor_total+$v->valor;
                                                        print(format($v->valor,false));
                                                    ?>
                                                </td>
                                               
                                            </tr>
                                <?php		
                                        }
                                    }else{
                                ?>
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            No hay registros disponibles
                                        </td>
                                    </tr>
                                <?php		
                                    }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center"><b>Total</b></td>
                                    <td class="text-right"><b><?php echo format($valor_total,false);?></b></td>
                                </tr>
                            </tfoot>
                        </table> 
                    </div>
                    <div class="tab-pane col-md-12" id="descuentos" role="tabpanel">
                    	<table class="table table-hover">
                            <thead>
                                <tr>
                                    <td><b>Concepto</b></td>
                                    <td><b>Observación</b></td>
                                    <td><b>Cuotas</b></td>
                                    <td class="text-right"><b>Valor</b></td>
                                    <td class="text-right"><b>Pendiente</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $total_monto_cuota	=	0;
                                    $total_restante		=	0;
                                    $ListOtrosIngresos	=	Descuentos($this->$modulo->result->user_id);
                                    if(count($ListOtrosIngresos)>0){
                                        foreach($ListOtrosIngresos as $v){
                                            
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
                                                        echo $cantidad_de_cuotas + 1;?> / 
                                                    <?php print($v->nro_quincenas);?>
                                                </td>
                                                <td class="text-right">
                                                    <?php 
                                                            $monto_cuota	=	$v->valor / $v->nro_quincenas;
                                                            $total_monto_cuota	=	$total_monto_cuota + $monto_cuota;
                                                            print(format($monto_cuota,false));
                                                    ?>
                                                </td>
                                                <td class="text-right">
                                                    <?php 
                                                        $restar_a_valor	= $cantidad_de_cuotas + 1	* $monto_cuota;
                                                        $restante		=	$v->valor -  $restar_a_valor;
                                                        $total_restante	=	$total_restante + $restante;
                                                        print(format($restante ,false));
                                                    ?>
                                                </td>                                           
                                            </tr>
                                <?php		
                                        }
                                        
                                    }
                                ?>
                                <?php 
                                    $escala_salario 	=		calcula_montos_x_dias($escala_escala_x_user_id->auxilio_transporte,$dias_trabajados);
                                    $eps				=		calcula_montos_x_dias($escala_escala_x_user_id->eps,$dias_trabajados);
                                    if($eps>0){
                                ?>
                                        <tr>
                                            <td>Pack Seguridad Social</td>
                                            <td>Auxilio EPS</td>
                                            <td>1/1</td>
                                            <td  class="text-right">
                                                <?php 
                                                    
                                                    //echo format($escala_salario,false);
                                                    echo format($eps,false);
                                                    $total_monto_cuota	= 	$total_monto_cuota+$eps;
                                                ?>
                                            </td>
                                            <td class="text-right">0</td>
                                        </tr>
                                <?php }?>
                                <?php
                                    $arl	=	calcula_montos_x_dias($escala_escala_x_user_id->arl,$dias_trabajados);
                                    if($arl>0){
                                ?>
                                        <tr>
                                            <td>Pack Seguridad Social</td>
                                            <td>Auxilio A.R.L</td>
                                            <td>1/1</td>
                                            <td  class="text-right">
                                                <?php 
                                                    echo format($arl,false);
                                                    $total_monto_cuota	= 	$total_monto_cuota+$arl;
                                                ?>
                                            </td>
                                            <td class="text-right">0</td>
                                        </tr>
                                <?php
                                    }
                                ?>
                                <?php 
                                    $bonificacion		=	calcular_bonificacion($varmeta,$totalP,$factorBonificacion,$trm_now);
                                    if(!empty($escala_escala_x_user_id)){
                                        $salario		=	calcula_montos_x_dias(@$escala_escala_x_user_id->salario,$dias_trabajados);
                                        $salario_var	=	(format($salario,false));
                                    }else{
                                        $salario_var	=	0;	
                                    }
                                    $aux				=	calcula_montos_x_dias($escala_escala_x_user_id->caja_compensacion,$dias_trabajados);
                                    $ahorro_prima		=	$salario + $escala_salario + $eps + $arl + $aux + $bonificacion;
                                    $total_ahorro_prima	=	($ahorro_prima * $escala_escala_x_user_id->prima)/100;
                                    if($total_ahorro_prima>0){
                                                                    
                                ?>
                                <tr>
                                    <td>Pack Seguridad Social</td>
                                    <td>Prima Semestral</td>
                                    <td>1/1</td>
                                    <td  class="text-right">
                                        <?php 
                                            $total_monto_cuota	= 	$total_monto_cuota+$total_ahorro_prima;
                                            echo format($total_ahorro_prima,false);
                                        ?>
                                    </td>
                                    <td class="text-right">0</td>
                                </tr>
                                <?php }?>
                                <?php if($aux>0){?>
                                <tr>
                                    <td>Pack Seguridad Social</td>
                                    <td>Auxilio Caja de Compensación Familiar</td>
                                    <td>1/1</td>
                                    <td  class="text-right">
                                        <?php
                                            $total_monto_cuota	= 	$total_monto_cuota+$aux;
                                            print_r(format($aux,false));										
                                        ?>
                                    </td>
                                    <td class="text-right">0</td>
                                </tr>
                                <?php }?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center"><b>Total</b></td>
                                    <td class="text-right"><b><?php print_r(format($total_monto_cuota,false))?></b></td>
                                    <td class="text-right"><b><?php print_r(format($total_restante,false))?></b></td>
                                </tr>
                            </tfoot>
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
                                                echo $salario_var;
                                            ?>
                                        </b>
                                    </div>
                                    <div class="col-md-3 ">
                                      Aux. Transporte
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <b>
                                           <?php
                                                print_r(format($escala_salario,false));	
                                            ?>
                                        </b>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                       Aux. E.P.S
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <b>
                                            <?php 
                                                
                                                
                                                print_r(format($eps,false));
                                            ?>
                                        </b>
                                    </div>
                                    <div class="col-md-3 ">
                                      Aux. A.R.L
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <b>
                                            <?php 
                                                
                                                print_r(format($arl,false));
                                            ?>
                                        </b>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                       Aux Caja Comp.
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <b>
                                            <?php 
                                                print_r(format($aux,false));
                                            ?>
                                        </b>
                                    </div>
                                    <div class="col-md-3 ">
                                        Bonificación
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <b>
                                            <?php 
                                                //$salario + $escala_salario + $eps + $arl + $aux + $bonificacion;
                                                
                                                echo format($bonificacion,false);
                                                
                                                
                                                
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
                                                $ortros_ingresos 	=	TotalOtrosIngresos($this->$modulo->result->user_id);
                                                if(!empty($ortros_ingresos)){
                                                    print_r(format($ortros_ingresos->valor,false));
                                                }else{
                                                    print_r(format(0.00,false));	
                                                }
                                                
                                            ?>
                                        </b>
                                    </div>
                                    <div class="col-md-2">
                                        Prima Semestral
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <b>
                                            <?php 
                                                
                                                $primas			=	round($ahorro_prima, 0) + round($total_ahorro_prima,0);
                                                $hacia_arriba	=	round($primas, -3);
                                                
                                                $resultado		=	$primas	- $hacia_arriba;
                                                print_r(format($total_ahorro_prima,false));
                                                
                                            ?>
                                        </b>
                                    </div>
                                </div>
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
                                                $totalizacion_general	=	$salario + $escala_salario + $eps + $arl + $aux +$bonificacion + $ortros_ingresos->valor + $total_ahorro_prima;
                                                echo  format($totalizacion_general,false);
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
                                        <?php print_r(format($total_monto_cuota,false));?>
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
                                                $subtotal	=	$totalizacion_general - $total_monto_cuota;
                                                print_r(format($subtotal,false));?>
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
                                        <?php 
                                            $subtotal1	=	round($totalizacion_general - $total_monto_cuota, -3 );
                                            print_r($subtotal1,false);
                                        ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-4 text-right">
                                        
                                    </div>
                                    <div class="col-md-3 ">
                                        Ajuste a la decena
                                    </div>
                                    <div class="col-md-3 text-right">
                                            -<?php 
                                            $ajuste_a_decena	=	$subtotal - $subtotal1;	
                                            print_r(format($subtotal - $subtotal1,false));?>
                                    </div>
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
                                            <input type="hidden" id="total" value="<?php echo $subtotal - $ajuste_a_decena;?>" />
                                            <?php print_r(format($subtotal - $ajuste_a_decena,false));?>
                                            <?php $this->Usuarios->SetTotalizado(array("modelo"=>$this->uri->segment(3),"honorarios"=>($subtotal - $ajuste_a_decena)));	?>
                                        </b>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                           
				</div>                    
			</div>
        </div>
    </div>
</div>