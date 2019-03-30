<?php
	$modulo						=	$this->ModuloActivo;
	$this_modelo				=	centrodecostos($this->$modulo->result->modelo_id);
	$ciclo_informacion			=	get_cf_ciclos_pagos_new($this_modelo->id_empresa,0);
	$rp_honorarios_modelos		=	json_decode($this->$modulo->result->json);
	$pagos						=	array(	"caja_id"			=>		ResumenCajas(array('110505'),array("6")),
											"procesador_id"		=>		ResumenBancosNew(array("COP")),
											"modelo_id"			=>		$this->uri->segment(3));
	$registro	=	@$rp_honorarios_modelos->registro;
?>
<div class="container">
	<div class="row justify-content-md-center">
       	<div class="col">
       	 	<?php 
				$chequeo	=	chequear_Honorarios_X_ciclo_de_produccion($this->uri->segment(3),$this->user->ciclo_produccion_id);
			?>
            	<input type="hidden" id="chequeo" value="<?php if(empty($chequeo)){echo 0;}else{echo 1;}?>" />
            <?php	
				if(empty($chequeo)){
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Liquidación recaudos Modelos.",
															"icono"=>'<i class="fas fa-bars"></i>',
															"url"	=>	current_url()),
									"pago"		=>	array(	"title"	=>	"Procesar Pago",
															"icono"	=>	'<i class="fas fa-dollar-sign"></i>',
															"url"	=>	base_url("Operaciones/ProcesarHonorarios/".$this->uri->segment(3))),
									"pdf"		=>	true,
                                    "excel"     =>  true,
                                    "mail"      =>  array(  "id"    =>  "mail" ),
																					
							)
						);
				}else{
					
					$chequeo2				=	chequear_Honorarios_Pagados_X_ciclo_nro_documento($this->uri->segment(3),$chequeo->consecutivo);
					$chequeo3				=	sum_Honorarios_Pagados_X_ciclo_nro_documento($this->uri->segment(3),$chequeo->consecutivo);
					if(!empty($chequeo2) && ($chequeo3->credito == $chequeo->debito)){
						$saldo_pendiente	=	$chequeo->debito ;
						echo TaskBar(array( "name"		=>	array(	"title"	=>	"Pago a Modelo.",
																"icono"=>'<i class="fas fa-bars"></i>',
																"url"	=>	current_url()),
										"pdf"		=>	true,
                                        "excel"     =>  true,
                                        "mail"      =>  array(  "id"    =>  "mail" ),						
							)
						);								
					}else{
						if(@$debito>0){
							$saldo_pendiente	=	$chequeo->debito - ($debito - $chequeo->debito);
						}else{
							$saldo_pendiente	=	$chequeo->debito;	
						}
					echo TaskBar(array( "name"		=>	array(	"title"	=>	"Pago a Modelo.",
																"icono"=>'<i class="fas fa-bars"></i>',
																"url"	=>	current_url()),
										"pago"		=>	array(	"title"=>"Pago Efectivo",
																"icono"=>'<i class="fas fa-dollar-sign"></i>',
																"url"=>base_url("Operaciones/PagarHonorarios/".$this->uri->segment(3))),															
										"pdf"		=>	true,
                                        "excel"     =>  true,
                                        "mail"      =>  array(  "id"    =>  "mail" ),						
							)
						);
					}
				}
			?>
            <div class="row">
            	<div class="col-md-2">
		           Período de Pago
                </div>
                <div class="col-md-4 text-right">
                    <b>
	                    <?php 
							echo $rp_honorarios_modelos->ciclopago	;
						?>
                    </b>
                </div>
                <div class="col-md-3 ">
		           Valor TRM
                </div>
                <div class="col-md-3 text-right">
	                <b>
						<?php 
							echo $rp_honorarios_modelos->trm_now;
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
							echo $rp_honorarios_modelos->nombre_legal;
						?>
                    </b>
                </div>
                <div class="col-md-3 ">
		           Días Trabajados
                </div>
                <div class="col-md-3 text-right">
	                <b>
						<?php 
							echo $rp_honorarios_modelos->dias_trabajados;							
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
							echo $rp_honorarios_modelos->factorBonificacion;
						?>
                    </b>
                </div>
                <div class="col-md-3 ">
		           Escala
                </div>
                <div class="col-md-3 text-right" >
	                <b>
						<?php 
							echo $rp_honorarios_modelos->nombre_escala;
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
							//pre($ciclo_informacion->fecha_hasta);return;
							$total_tokens_modelo	=	get_total_tokens($this->$modulo->result->modelo_id,$ciclo_informacion->fecha_desde,$ciclo_informacion->fecha_hasta);
							//pre($total_tokens_modelo);
							if(!empty($total_tokens_modelo)){
								echo format($total_tokens_modelo,false);
							}else{
								echo 0;	
							}
						?> Tokens
                    </b>
                </div>
                <div class="col-md-3 ">
		           Meta Ideal
                </div>
                <div class="col-md-3 text-right">
	                <b>
						<?php 
							echo $rp_honorarios_modelos->varmeta;
						?>
                   	</b>
                </div>
            </div>
            <div class="section bd-example-tabs">
				<ul class="nav nav-tabs " role="tablist">
                    <li class="nav-item">
                    	<a class="nav-link active" id="plataforma-tab" data-toggle="tab" href="#plataforma" role="tab">
                    		Facturación por Plataforma 
                    	</a>
                    </li>
			  		<li class="nav-item">
                        <a class="nav-link" id="ingresos-tab"  data-toggle="tab" href="#ingresos" role="tab">
                            Otros Ingresos 
                        </a>
			  		</li>
                    <li class="nav-item">
                        <a class="nav-link" id="descuentos-tab"  data-toggle="tab" href="#descuentos" role="tab">
                            Descuentos
                        </a>
			  		</li>
	                <?php if(count($registro)>0){?>
                    <li class="nav-item">
                        <a class="nav-link" id="registrocontable-tab"  data-toggle="tab" href="#registrocontable" role="tab">
                            Registro Contable 
                        </a>
			  		</li>
                    <?php }?>
                    <li class="nav-item">
                        <a class="nav-link" id="movimientos-tab"  data-toggle="tab" href="#movimientos" role="tab">
                            Movimientos
                        </a>
			  		</li>
                    <li class="nav-item">
                        <a class="nav-link" id="ringresos-tab"  data-toggle="tab" href="#ringresos" role="tab">
							Resumen de Ingresos
                        </a>
			  		</li>
                    <li class="nav-item">
                        <a class="nav-link" id="observaciones-tab" data-toggle="tab" href="#observaciones" role="tab" aria-controls="observaciones" aria-expanded="true">Observaciones</a>
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
                                    $totalRQ		=	0;
                                    $totalP			=	0;
                                    foreach($rp_honorarios_modelos->HonorariosModelos as $k => $v){
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
                                            ?>
                                        </td>
                                        <td class="text-center">
                                        	<?php
												$items_factura_x_nickname	=	items_factura_x_nickname($v->nickname_id,1);
												$factura					=	@$items_factura_x_nickname->consecutivo;
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
												$user_id		=	$this->$modulo->result->modelo_id;	
                                                $nickname_id	=	$v->nickname_id;
                                                echo $rp_honorarios_modelos->conversion_token_standar[$k];
                                            ?>
                                        </td>
                                        <td class="text-right">
                                            <?php 
                                              	echo $rp_honorarios_modelos->conversion[$k];
                                            ?>
                                        </td>
                                        <td class="text-right">
                                            <?php
												echo $rp_honorarios_modelos->conversion_conversion_token_standar[$k];
                                            ?>
                                        </td>
                                    </tr>
                                <?php }?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <b>
                                        Total
                                        </b>
                                    </td>
                                    <td class="text-right">
                                        <b>
                                        	<?php echo $rp_honorarios_modelos->totalRQ;?>
                                        </b>
                                    </td>
                                    <td class="text-right">
                                    	<b>
											<?php echo $rp_honorarios_modelos->totalP;?>
                                        </b>
									</td>
                                    <td class="text-right">
                                    	<b>	
											<?php echo @$rp_honorarios_modelos->totalP_totalRQ;?>
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
                                    $valor_total		= 	0;
                                    $ListOtrosIngresos	=	$rp_honorarios_modelos->ListOtrosIngresos	;
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
                                                          echo 	$rp_honorarios_modelos->recurrente[$k];	
                                                    ?>
                                                </td>
                                                <td class="text-right">
                                                    <?php 
                                                        echo $rp_honorarios_modelos->valor[$k];
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
                                    <td class="text-right">
                                    	<b>
											<?php 
												echo @$rp_honorarios_modelos->valor_total->$k;
											?>
                                        </b>
									</td>
                                </tr>
                            </tfoot>
                        </table> 
                    </div>
                    <div class="tab-pane col-md-12" id="descuentos" role="tabpanel">
                    	<?php 
							$ListOtrosIngresos			=	$rp_honorarios_modelos->Descuentos;
							//pre($ListOtrosIngresos);return;
						?>
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
                                    $total_monto_cuota			=	0;
                                    $total_restante				=	0;
                                   	
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
                                                        echo $rp_honorarios_modelos->cantidad_de_cuotas[$k]	=	$cantidad_de_cuotas + 1;
													?> 
                                                        / 
                                                    <?php 
														echo $rp_honorarios_modelos->nro_quincenas[$k]		=	$v->nro_quincenas;
													?>
                                                </td>
                                                <td class="text-right">
                                                    <?php 
                                                            $monto_cuota										=	$v->valor / $v->nro_quincenas;
                                                            $total_monto_cuota									=	$total_monto_cuota + $monto_cuota;
															echo $rp_honorarios_modelos->monto_cuota[$k]		=	format($monto_cuota,false);
															//$pagos->descuentos_array[$k]			 			= 	$monto_cuota;
                                                    ?>
                                                </td>
                                                <td class="text-right">
                                                    <?php 
                                                        $restar_a_valor	= $cantidad_de_cuotas + 1	* $monto_cuota;
                                                        $restante		=	$v->valor -  $restar_a_valor;
                                                        $total_restante	=	$total_restante + $restante;
														echo $rp_honorarios_modelos->restante[$k]	=	format($restante ,false);
                                                    ?>
                                                </td>                                           
                                            </tr>
                                <?php		
                                        }
                                        
                                    }
                                ?>
                                <?php 
                                    $eps				=		$rp_honorarios_modelos->aux_eps;
                                    if($eps>0){
                                ?>
                                       
									<?php 
                                        //echo format($eps,false);
                                    ?>
                                       
                                <?php }?>
                                <?php
                                    $arl	=	$rp_honorarios_modelos->aux_arl;
                                    if($arl>0){
                                ?>
									<?php 
                                        //echo format($arl,false);
                                        $total_monto_cuota	= 	$total_monto_cuota+$arl;
                                    ?>
                                <?php
                                    }
                                ?>
                                <?php 
                                    if($rp_honorarios_modelos->total_ahorro_prima>0){
                                                                    
                                ?>
                                
								<?php 
                                    //echo $rp_honorarios_modelos->total_ahorro_prima;
                                ?>
                                
                                <?php }?>
                                <?php if($rp_honorarios_modelos->aux_aux>0){?>
                                
								<?php
                                    $total_monto_cuota					= 	$total_monto_cuota+$rp_honorarios_modelos->aux_aux;
                                    //echo $rp_honorarios_modelos->aux_aux;										
                                ?>
                                
                                <?php }?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center"><b>Total</b></td>
                                    <td class="text-right"><b><?php  	echo format($rp_honorarios_modelos->total_monto_cuota,false);?></b></td>
                                    <td class="text-right"><b><?php 	echo format($rp_honorarios_modelos->total_restante,false);?></b></td>
                                </tr>
                            </tfoot>
                        </table>  
                    </div>
                    <?php 
						if(count($registro)>0){
					?>
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
                                    	foreach($registro as $k =>$v){
											
                                        ?>
                                            <tr>
                                                <td><?php print_r($v->codigo_contable);?></td>
                                                <td><?php print_r($v->cuenta_contable);?></td>
                                                <td class="text-center">
                                                    <?php 
                                                            //pre($v);
                                                         	$debito											=	$debito 	+ 	round($v->debito,2); 	
                                                          	echo $rp_honorarios_modelos["debito"][$k]		=	format($v->debito);
                                                    ?>
                                                </td>
                                                <td class="text-right">
                                                    <?php 	
                                                            $credito										=	$credito 	+ 	round($v->credito,2); 	
                                                            echo $rp_honorarios_modelos["credito"][$k]		=	format($v->credito);
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
									$movimientos=$rp_honorarios_modelos->movimientos;
									$movimientos=getMovimientosGeneral(NULL,$this->uri->segment(4),array(12,13),array("138020","233525"),NULL,$this->uri->segment(3));
									if(count($movimientos)>0){
                                    	foreach($movimientos as $k => $v){
                                ?>                	
                                        <tr>
                                            <td>
                                                <?php 
                                                    print($v->fecha);
                                                ?>
                                            </td>
                                            <td><?php //echo $rp_honorarios_modelos->tipo_documento[$k];?></td>
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
                                                echo $rp_honorarios_modelos->salario_var;
                                            ?>
                                        </b>
                                    </div>
                                    <div class="col-md-3 ">
                                      Aux. Transporte
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <b>
                                           <?php
                                                echo $rp_honorarios_modelos->escala_salario;	
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
                                                echo $rp_honorarios_modelos->aux_eps;
                                            ?>
                                        </b>
                                    </div>
                                    <div class="col-md-3 ">
                                      Aux. A.R.L
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <b>
                                            <?php 
                                                echo $rp_honorarios_modelos->aux_arl;
                                            ?>
                                        </b>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                       Aux. Caja Comp.
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <b>
                                            <?php 
                                                echo $rp_honorarios_modelos->aux_aux;
                                            ?>
                                        </b>
                                    </div>
                                    <div class="col-md-3 ">
                                        Bonificación
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <b>
                                            <?php 
                                                echo $rp_honorarios_modelos->aux_bonificacion;
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
                                                   echo 	$rp_honorarios_modelos->ortros_ingresos;
                                            ?>
                                        </b>
                                    </div>
                                    <div class="col-md-2">
                                        Prima Semestral
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <b>
                                            <?php 
                                                echo $rp_honorarios_modelos->total_ahorro_prima;
                                            ?>
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
                                                echo $rp_honorarios_modelos->totalizacion_general;
												$pagos["total_ingresos"] 	=	$rp_honorarios_modelos->totalizacion_general; 
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
											echo $rp_honorarios_modelos->Descuentos_total_monto_cuota;
											$pagos["descuentos"] 	=	$rp_honorarios_modelos->total_monto_cuota; 
										?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-4 text-right">
                                        
                                    </div>
                                    <?php 
										if(@$config->ajustar_decena==1 || @$config->porcentaje_retencion>0){
											if(!empty($config->porcentaje_retencion)){
												$porcentaje_retencion	=	$config->porcentaje_retencion / 100;
											}else{
												$porcentaje_retencion	=	0;
											}
											$subtotal  =  $subtotal - ($subtotal * $porcentaje_retencion);											
										
									?>
                                        <div class="col-md-3 ">
                                            <b>Subtotal</b>
                                        </div>
                                        <div class="col-md-3 text-right">
                                            <b>
                								<?php 
													echo $rp_honorarios_modelos["Subtotal"]	=	format($total_ingresos,false);
												?>
                                            </b>
                                        </div>
                                    <?php 
										}
									?>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-4 text-right">
                                        
                                    </div>
                                    <div class="col-md-3 ">
                                        ReteFuente (<?php echo $rp_honorarios_modelos->porcentaje_retencion;?>%)
                                    </div>
                                    <div class="col-md-3 text-right">
                                    	<?php 	
												$pagos["porcentaje_retencion"]	=	@$rp_honorarios_modelos->porcentaje_retencion;
												echo $rp_honorarios_modelos->total_ingresosXporcentaje_retencion;
												$pagos["rete_fuente"]	=	@$rp_honorarios_modelos->rete_fuente;
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
                                    	<b><?php echo $rp_honorarios_modelos->subtotal_2;?></b>
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
										echo $rp_honorarios_modelos->subtotal1_2;
									?>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-4 text-right">
                                    </div>
                                    <?php if(@$config->ajustar_decena==1){
									?>
                                        <div class="col-md-3 ">
                                            Ajuste a la decena
                                        </div>
                                        <div class="col-md-3 text-right">
                                        <?php 
											   echo $rp_honorarios_modelos->ajuste_a_la_decena_subtotal;
											   $pagos["ajuste_a_la_decena"] =	$rp_honorarios_modelos->ajuste_a_la_decena;
										?>
                                        </div>
                                    <?php 
									}else{
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
                                            <?php 
												$pagos["pago_global"] 	=	@$rp_honorarios_modelos->pago_global	;
												echo $rp_honorarios_modelos->ajuste_a_la_decena;
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
        $hidden 			= 	array("ajuste_a_la_decena"=>""); 
		echo form_open(base_url("Operaciones/PagarHonorarios/".$this->uri->segment(3)),array('ajax' => 'true','id'=>'form_pago'),$hidden);
    ?>
    <?php echo form_close();?>
</div>
<div style="display:none;">
    <select class="form-control" name="procesador_id"  id="procesador_id" require>
        <?php 
			foreach($pagos['procesador_id'] as $k2	=> $v2){?>
            <option value="<?php print($v2->id_cuenta);?>"><?php print(entidadbancaria($v2->entidad_bancaria)); ?></option>
        <?php }?>
    </select>
    <select class="form-control" name="caja_id" id="caja_id" require>
        <?php 
			foreach($pagos["caja_id"] as $k2	=> $v2){?>
            <option value="<?php print($k2);?>"><?php print($v2->nombre_caja); ?></option>
        <?php }?>
    </select>
</div>
<?php
	$this->session->set_userdata(array("pagos"=>$pagos,"rp_honorarios_modelos"=>$rp_honorarios_modelos));
?>

<script>
	$(document).ready(function(){
		if($("#chequeo").val()=="1"){
			$("#ajuste_a_la_decena").val($("#ajuste_a_la_decena2").val());
			var content 	= 	$(	'<div id="contenedor_dinamico">'+
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
			var formulario	=	$("#form_pago");
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
			
			var _select		=	content.find("#medio_pago");
			_select.change(function(){
				var selector	=	$("#"+content.find("select").val()).clone();
				content.find("#contenedor_procesadores").html(selector);
				var opcion	=	$(this);
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