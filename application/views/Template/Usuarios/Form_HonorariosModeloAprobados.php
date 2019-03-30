<?php

	$modulo						=	$this->ModuloActivo;
	$json						=	json_db($this->$modulo->result->json,"decode");
	$ciclo_informacion			=	get_cf_ciclos_pagos_new($this->user->id_empresa,0);	
    $ListOtrosIngresos9         =   $json->Descuentos;
    $Pagos  =   getMovimientosGeneral($this->uri->segment(4),NULL,14,NULL,$json->ciclopago,$this->uri->segment(3));
    $Total_pagado = 0;
    foreach ($Pagos as $key => $value) {
        $Total_pagado += $value->credito;
    }
    //pre($ciclo_informacion); return;
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<?php if($this->$modulo->result->estatus==9){?>
	    	<div class="container text-center" id="pagado"><h2 class="font-weight-700 text-uppercase orange">ANULADA</h2></div>
        <?php }
		
			$chequeo	=	chequear_Honorarios_X_ciclo_de_produccion($this->$modulo->result->modelo_id,$this->user->ciclo_produccion_id);
			$chequeo2	=	chequear_Honorarios_Pagados_X_ciclo_nro_documento($this->$modulo->result->modelo_id,$this->uri->segment(4));
			$chequeo3	=	sum_Honorarios_Pagados_X_ciclo_nro_documento($this->$modulo->result->modelo_id,$this->uri->segment(4));
			
			if($Total_pagado == $json->pago_global){
				echo '<div class="container text-center" id="pagado"><h2 class="font-weight-700 text-uppercase orange">PAGADO</h2></div>';
			}else{
				//echo 'Aprobado';	
			}	
		?>
       	<div class="col">
       	 	<?php 
				$chequeo	=	chequear_Honorarios_X_ciclo_de_produccion($this->uri->segment(3),$this->user->ciclo_produccion_id);
			?>
            	<input type="hidden" id="chequeo" value="<?php if(empty($chequeo)){echo 0;}else{echo 1;}?>" />
            <?php
				if($this->$modulo->result->estatus==9 || (!empty($chequeo2) && ($chequeo3->credito == $chequeo->debito))){
								echo 	TaskBar(array( "name"		=>	array(	"title"	=>	"Pago a Modelo.",
														"icono"=>'<i class="fas fa-bars"></i>',
														"url"	=>	current_url()),
                                        "pdf"      =>  array(  "title"=>"Ver pdf",
                                                                "url"=>current_url().'/PDF'),			
						)
					);
					
				}else{
                    $submenu = array( "name"        =>  array(  "title" =>  "Pago a Modelo.",
                                                                "icono"=>'<i class="fas fa-bars"></i>',
                                                                "url"   =>  current_url()),
                                        "back"      =>  ($this->uri->segment(6)=='Iframedes')?true:false,
                                        "config"    =>  array("title" =>  "Pago Efectivo",
                                            "icono"  =>  '<i class="far fa-money-bill-alt"></i>',
                                            "url"   =>  current_url().'/Pagar'),            
                                        "pdf"      =>  array(  "title"=>"Ver pdf",
                                                                "url"=>current_url().'/PDF'),
                                        "anular"    => array("title" => "Anular Honorario",
                                                             "icono"  =>  '<i class="fa fa-trash"></i>',
                                                             "url"   => base_url("Usuarios/HonorariosModeloAnular/".$this->$modulo->result->modelo_id."/".$this->$modulo->result->consecutivo)),    
                                );
                    if(!empty($Pagos)){
                        unset($submenu['anular']);
                    }
                    if($Total_pagado == $json->pago_global){
                        unset($submenu['config']);
                    }
					echo 	TaskBar($submenu);
				}
			?>
            <div class="row">
            	
            	<!--div class="col-md-3">
		           Código de Tercero
                </div>
                <div class="col-md-3 text-right">
                	<b>
	                    <?php
							echo $rp_honorarios_modelos["identificacion"]	=	$this->$modulo->result->identificacion;
						?>
                    </b>
                </div-->
                <div class="col-md-2">
		           Período de Pago
                </div>
                <div class="col-md-4 text-right">
                    <b>
	                    <?php 
							echo $json->ciclopago;
						?>
                    </b>
                </div>
                <div class="col-md-3 ">
		           Valor TRM
                </div>
                <div class="col-md-3 text-right">
	                <b>
						<?php 
							echo $json->trm_now;
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
							echo $json->nombre_legal;
						?>
                    </b>
                </div>
                <div class="col-md-3 ">
		           Días Trabajados
                </div>
                <div class="col-md-3 text-right">
	                <b>
						<?php print($json->dias_trabajados);?>
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
                    	<?php echo $json->factorBonificacion;?>
                    </b>
                </div>
                <div class="col-md-3 ">
		           Escala
                </div>
                <div class="col-md-3 text-right" >
	                <b>
						<?php 
							echo $json->nombre_escala;
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
	                    <?php echo $json->estado_informe_quincenal;?> Tokens
                    </b>
                </div>
                <div class="col-md-3 ">
		           Meta Ideal
                </div>
                <div class="col-md-3 text-right">
	                <b>
						<?php echo $json->varmeta;?>
                   	</b>
                </div>
            </div>
            <div class="section bd-example-tabs">
				<ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="ringresos-tab" data-toggle="tab" href="#ringresos" role="tab">
                            Resumen
                        </a>
                    </li>
                    <li class="nav-item">
                    	<a class="nav-link" id="plataforma-tab" data-toggle="tab" href="#plataforma" role="tab">
                    		Facturación 
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
                    <?php 
						$registro					=	get_registro_contable_honorarios_new($this->uri->segment(3),$this->uri->segment(4));
						if(count($registro)>0){
					?>
                    <li class="nav-item">
                        <a class="nav-link" id="registrocontable-tab" data-toggle="tab" href="#registrocontable" role="tab">
                            Registro Contable 
                        </a>
			  		</li>
                    <?php }?>
                    <li class="nav-item">
                        <a class="nav-link" id="plataforma-tab" data-toggle="tab" href="#RelacionP" role="tab">
                            Relacion Pagos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="movimientos-tab" data-toggle="tab" href="#movimientos" role="tab">
                            Movimientos
                        </a>
			  		</li>
                    <li class="nav-item">
                        <a class="nav-link" id="observaciones-tab" data-toggle="tab" href="#observaciones" role="tab" aria-controls="observaciones" aria-expanded="true">Observaciones</a>
                    </li>
				</ul>
                <div class="tab-content row">
                    <div class="tab-pane col-md-12" id="plataforma" role="tabpanel">
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
									//pre($json->HonorariosModelos);
								?>
                                <?php 
									$totalRQ		=	0;
                                    $totalP			=	0;
									foreach($json->HonorariosModelos as $k => $v){
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
												$get_diario		=	get_diario($v->user_id,$v->nickname_id,$ciclo_informacion->fecha_desde,$ciclo_informacion->fecha_hasta);
												$conversion_token_standar									=		conversion_token_standar(@$get_diario->monto,$v->equivalencia);
												
											
												$items_factura_x_nickname	=	items_factura_x_nickname($v->nickname_id,1);
												$factura					=	@$items_factura_x_nickname->consecutivo;
												
												if(!empty($items_factura_x_nickname)){
													$items_factura_x_nickname	=	json_decode($items_factura_x_nickname->json);
												}
												
                                                if(!empty($items_factura_x_nickname)){
                                                    $produccion		=	$items_factura_x_nickname->tokens;
                                                }else{
                                                    $produccion		=	0;
                                                }
												//pre($v->nickname_id);
                                                $totalP			=	$totalP + @$items_factura_x_nickname->monto_global_usd / 0.05;
                                                $conversion		=	conversion_token_standar(@$produccion,$v->equivalencia);
												$conversion		=	@$items_factura_x_nickname->monto_global_usd / 0.05;
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
                                                echo $rp_honorarios_modelos["conversion_token_standar"][$k]	=		format($conversion_token_standar,false);
                                                $totalRQ		=	$totalRQ + $conversion_token_standar;
                                            ?>
                                        </td>
                                        <td class="text-right">
                                            <?php 
												echo $rp_honorarios_modelos["conversion"][$k]	=	format($conversion,false);
                                            ?>
                                        </td>
                                        <td class="text-right">
                                            <?php
                                            	
                                                if(!empty($items_factura_x_nickname)){
                                                    $produccion		=	$items_factura_x_nickname->tokens;
                                                }else{
                                                    $produccion		=	0;
                                                } 
                                                if(!empty($get_diario)){
													echo $rp_honorarios_modelos["conversion_conversion_token_standar"][$k]	=	format( $conversion - $conversion_token_standar,false);
                                                }else{
													echo $rp_honorarios_modelos["conversion_conversion_token_standar"][$k]	=	format($conversion,false);	
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
                                        <?php echo $rp_honorarios_modelos["totalRQ"]			= 	format($totalRQ,false);?>
                                        </b>
                                    </td>
                                    <td class="text-right">
                                    	<b>
											<?php echo $rp_honorarios_modelos["totalP"]			=	format($totalP,false);?>
                                        </b>
									</td>
                                    <td class="text-right">
                                    	<b>	
											<?php echo $rp_honorarios_modelos["totalP_totalRQ"]	=	format($totalP - $totalRQ,false);?>
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
                                    <th class="text-left"><b>Fecha</b></th>
                                    <th class="text-center"><b>Tercero</b></th>
                                    <th><b>Operación</b></th>
                                    <th class="text-center"><b>Documento</b></th>
                                    <th class="text-right"><b>Total</b></th>
                                    <th class="text-right"><b>Debo</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $valor_total    = 0;
                                    $rp_honorarios_modelos["ListOtrosIngresos"]     =   $ListOtrosIngresos  =   OtrosIngresos($this->$modulo->result->modelo_id,$this->$modulo->result->ciclo_produccion_id);
                                    $total_valor = 0;
                                    if(count($ListOtrosIngresos)>0){
                                        foreach($ListOtrosIngresos as $k=>$v){
                                            $json2       =   json_db($v->json,"decode");
                                ?>
                                <tr>
                                    <td class="text-left">
                                        <?php 
                                            print($json2->fecha_emision);
                                        ?>                                             
                                    </td>
                                    <td class="text-left">
                                        <?php
                                            echo $json2->nombre_legal;
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo tipo_documento($v->tipo_documento); ?>
                                    </td>
                                    <td class="text-center">
                                        <a class="btnss btn-primaryss documentos btn-mdss" title="Detalle otros ingresos" href="<?php echo base_url("Reportes/VerDetalleGasto2/".$v->consecutivo)?>">
                                            <?php print($v->consecutivo);?>
                                        </a>
                                    </td>
                                    <td class="text-right">
                                        <?php
                                            $sum=0;
                                            
                                            foreach($json2->valor as $v2){
                                                if(!empty($v2)){
                                                $sum += $v2 ;
                                                }
                                            }
                                            echo format($sum,false);
                                            $total_valor+=$sum;
                                        ?>
                                    </td>
                                    <td class="text-right">
                                        <?php
                                            /*$pagos      =   @pago_gasto($v->consecutivo,"Activo",$v->consecutivo,31); */
                                            echo format($sum,false); 
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
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th class="text-center"><b>Total</b></th>
                                    <th class="text-right"><?php echo format($total_valor,false);?></th>
                                    <th class="text-right"><?php echo format(@$total_valor,false);?></th>
                                </tr>
                            </tfoot>
                        </table> 
                    </div>
                    <div class="tab-pane col-md-12" id="RelacionP" role="tabpanel">
                        <table class="tablesorter ordenar" ordercol=2 order="desc">
                            <thead>
                                <tr>
                                    <th width="100"><b>Fecha</b></th>
                                    <th><b>Documento</b></th>
                                    <th class="text-center"><b>Consecutivo</b></th>
                                    <th width="100" class="text-center"><b>Valor</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $valor_total    = 0;
                                    $rp_honorarios_modelos["Relacion_Pagos"]     =   $Pagos;
                                    $total_valor = 0;
                                    $credito_pago_honorarios = 0;
                                    $debito_pago_honorarios  = 0;
                                    if(count($Pagos)>0){
                                        foreach($Pagos as $k=>$v){
                                            if($v->credito > 0){
                                ?>                       
                                    <tr>
                                        <td>
                                            <?php
                                                print($v->fecha);
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                print(tipo_documento($v->tipo_documento));
                                                if(json_decode($v->data)->Tipo_transaccion == "Transferencia"){
                                                    echo " (Bancos)";
                                                }else{
                                                    echo " (Cajas)";
                                                }
                                            ?>
                                        </td>
                                        <td class="text-center">

                                            <a class="nav-link vin" title="Comprobante Pago No. <?php echo $v->documento;?>" href="<?php echo base_url('Operaciones/PagosHonorario/'.$v->nro_documento.'/'.$v->documento.'/'.$this->uri->segment(3).'/iframe');?>">
                                                <?php
                                                    echo $v->documento;
                                                ?>
                                            </a>
                                        </td>
                                        <td  class="text-right">
                                            <?php
                                                    $credito_pago_honorarios +=$v->credito;
                                                    print(format($v->credito,true));
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                                            }
                                        }
                                    }
                                ?>
                            </tbody>  
                            <tfoot>
                                <tr>
                                    <th width="100"></th>
                                    <th colspan="2"><b>Saldo pendiente</b></th>
                                    <th width="100" class="text-right">
                                        <b>
                                            <?php
                                                $saldo_pendiente_honorario = $json->pago_global - $credito_pago_honorarios;
                                                echo format($saldo_pendiente_honorario,true); 
                                            ?>        
                                        </b>
                                    </th>
                                </tr>
                            </tfoot>                    
                        </table> 
                    </div>
                    <div class="tab-pane col-md-12" id="descuentos" role="tabpanel">
                    	<table class="table table-hover">
                            <thead>
                                <tr>
                                    <th><b>Concepto</b></th>
                                    <th class="text-center"><b>Documento</b></th>
                                    <th><b>Cuotas</b></th>
                                    <th><b>Total</b></th>
                                    <th class="text-right"><b>Cuota</b></th>
                                    <th class="text-right"><b>Pendiente</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $total_monto_cuota			=	0;
                                    $total_restante				=	0;
                                    $Total_Descuentos           =   0;
                                    if(count($ListOtrosIngresos9)>0){
                                        foreach($ListOtrosIngresos9 as $k9 => $v9){
                                ?>
                                            <tr>
                                                <td>
                                                    <?php print_r($v9->concepto);?>
                                                </td>
                                                <td class="text-center">
                                                    <a class="vin text-center" data-event="reload" title="Ver detalle descuento <?php echo $json->nombre_legal; ?>" href="<?php echo base_url("Usuarios/VerDescuentos/".$v9->descuento_id.'/View/iframe')?>">
                                                        <?php echo $v9->nro_documento; ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php
                                                        $cantidad_de_cuotas = CountCuotasDescuentos($v9->descuento_id);
                                                        echo $rp_honorarios_modelos["cantidad_de_cuotas"][$k9]   =   $cantidad_de_cuotas->total;
                                                    ?> 
                                                        / 
                                                    <?php 
                                                        echo $rp_honorarios_modelos["nro_quincenas"][$k9]        =   $v9->nro_quincenas;
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        $Total_Descuentos += $v9->valor;
                                                        echo format($v9->valor,false); 
                                                    ?>
                                                </td>
                                                <td class="text-right">
                                                    <?php 
                                                            $monto_cuota                                        =   $v9->valor / $v9->nro_quincenas;
                                                            $total_monto_cuota                                  =   $total_monto_cuota + $monto_cuota;
                                                            echo $rp_honorarios_modelos["monto_cuota"][$k9]      =   format($monto_cuota,false);
                                                            $pagos["monto_cuota"][$k9]                           =   @$monto_cuota;
                                                    ?>
                                                </td>
                                                <td class="text-right">
                                                    <?php 
                                                        echo $rp_honorarios_modelos["restante"][$k9] =   format($cantidad_de_cuotas->Pendiente ,false);
                                                        $total_restante += $cantidad_de_cuotas->Pendiente;
                                                    ?>
                                                </td>                                           
                                            </tr>
                                <?php		
                                        }
                                        
                                    }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><b>Total</b></td>
                                    <td><b><?php echo format(@$Total_Descuentos,false); ?></b></td>
                                    <td class="text-right"><b><?php     echo $rp_honorarios_modelos["total_monto_cuota"]    =   format($total_monto_cuota,false);?></b></td>
                                    <td class="text-right"><b><?php     echo $rp_honorarios_modelos["total_restante"]       =   format($total_restante,false);?></b></td>
                                </tr>
                            </tfoot>
                        </table>  
                    </div>
                    <?php if(count($registro)>0){?>
                        <div class="tab-pane col-md-12" id="registrocontable" role="tabpanel">                    
                            <table class="tablesorter table">
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
										$debito	=0;
										$credito=0;
                                    	foreach($registro as $k =>$v){
                                            if($v->tipo_documento != 14){
                                                if($v->debito > 0 || $v->credito > 0){
                                        ?>
                                            <tr>
                                                <td><?php print_r($v->codigo_contable);?></td>
                                                <td><?php print_r($v->cuenta_contable);?></td>
                                                <td class="text-right">
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
                                            } 
                                    	}
                                   	?>	
                                </tbody>
                                <thead>
                                    <tr>
                                        <th class="text-right"></th>
                                        <th class="text-left" ><b>Sumas iguales</b></th>
                                        <th width="100" class="text-right"><b><?php echo format($debito,true); ?></b></th>
                                        <th width="100" class="text-right"><b><?php echo format($credito,true); ?></b></th>
                                    </tr>
                                </thead>                        
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
									$rp_honorarios_modelos["movimientos"]				=	$movimientos	=	array_merge($ListOtrosIngresos9,$ListOtrosIngresos);
									if(count($movimientos)>0){
                                    	foreach($movimientos as $k => $v){
                                ?>                	
                                        <tr>
                                            <td>
                                                <?php 
                                                    print($v->fecha);
                                                ?>
                                            </td>
                                            <td><?php echo $rp_honorarios_modelos["tipo_documento"][$k] =	tipo_documento($v->tipo_documento);?></td>
                                            <td class="text-center">
                                                <?php if($v->tipo_documento==5){?>
                                                <a class="nav-link lightbox documentos"  data-type="iframe" title="Comprobante bancario No. <?php echo $v->consecutivo;?>" href="<?php echo base_url($this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$v->consecutivo.'/detalle_contable/'.$this->uri->segment(3));?>">
                                                    <?php print($v->consecutivo);?>
                                                <?php }else if($v->tipo_documento == 12){?>
                                                    <a class="vin text-center" data-event="reload" title="Ver detalle descuento <?php echo $json->nombre_legal; ?>" href="<?php echo base_url("Usuarios/VerDescuentos/".$v9->descuento_id.'/View/iframe')?>">
                                                        <?php echo $v9->nro_documento; ?>
                                                <?php }else if($v->tipo_documento == 31){ ?>
                                                    <a class="btnss btn-primaryss documentos btn-mdss" title="Detalle otros ingresos" href="<?php echo base_url("Reportes/VerDetalleGasto2/".$v->consecutivo)?>">
                                                        <?php print($v->consecutivo);?>
                                                <?php }else{ ?>

                                                <?php } ?>                                                
                                                </a>
                                            </td>
                                            <td><?php nombre(centrodecostos($v->responsable_id)); ?></td>
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
                    <div class="tab-pane col-md-12 active" id="ringresos" role="tabpanel">
                    	<div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-2">
                                       Salario Básico
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <b>
                                            <?php
												$salario_var	=$json->salario_var;
												echo $salario_var;
												$recalcular_prima_semestral	= $total_liquidacion_ingresos	= (int)str_replace(".","",$salario_var);
                                            ?>
                                        </b>
                                    </div>
                                    <div class="col-md-3 ">
                                      	Aux. E.P.S
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <b>
                                        	<?php 
												$eps=$json->aux_eps;
                                                echo $eps;
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
                                                echo $json->escala_salario;	
                                            ?>
                                        </b>
                                    </div>
                                   	<div class="col-md-3 ">
                                    	 Aux. A.R.L
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <b>
                                            <?php 
                                                echo $json->aux_arl;
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
                                                echo $json->aux_bonificacion;
                                            ?>
                                        </b>
                                    </div>
                                     <div class="col-md-3 ">
                                      	Aux. Caja Compensación
                                    </div>
                                    <div class="col-md-3 text-right">
                                    	<b>
                                        <?php 
											echo $json->aux_aux;
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
                                                echo		$json->ortros_ingresos;
                                            ?>
                                        </b>
                                    </div>
                                    <div class="col-md-3">
                                        Ahorro Semestral (<?php echo format(@$json->escala_prima_porcentaje,true)?>%)
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <b>
                                            <?php 
												echo $json->total_ahorro_prima;
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
                                            <?php echo $json->totalizacion_general;?>
                                        </b>
                                    </div>
                                    <div class="col-md-2">
                                    	<b>
	                                        Total Beneficios
                                        </b>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <b>
                                        	<?php echo format(@$json->total_beneficios,false)?>
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
                                                echo $json->totalizacion_general;
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
											echo $json->Descuentos_total_monto_cuota;
										?>
                                    </div>
                                </div>
                                <!--div class="row">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-4 text-right">
                                        
                                    </div>
                                    <?php 
										$subtotal	=	(	$totalizacion_general - $total_monto_cuota 	);
										
										if(@$config->ajustar_decena==1 || @$config->porcentaje_retencion>0){
											if(!empty($config->porcentaje_retencion)){
												$porcentaje_retencion	=	$config->porcentaje_retencion / 100;
											}else{
												$porcentaje_retencion	=	0;
											}
											$subtotal_jorge=$subtotal  =  $subtotal - ($subtotal * $porcentaje_retencion);											
										
									?>
                                        <div class="col-md-3 ">
                                            <b>Subtotal</b>
                                        </div>
                                        <div class="col-md-3 text-right">
                                            <b>
                								<?php 
													echo $rp_honorarios_modelos["Subtotal"]	=	format($total_liquidacion_ingresos - $total_monto_cuota,false);
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
                                        ReteFuente (<?php echo $json->porcentaje_retencion;?>%)
                                    </div>
                                    <div class="col-md-3 text-right">
                                    	<?php 	
											echo $json->total_ingresosXporcentaje_retencion;
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
											echo $json->subtotal_2;
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
										echo @$json->subtotal1_2;
									?>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <?php //pre($config);?>
                                    </div>
                                    <?php
									?>
                                        <div class="col-md-3 ">
                                            Ajuste a la decena
                                        </div>
                                        <div class="col-md-3 text-right">
                                        <?php 	
											echo $json->ajuste_a_la_decena_prefijo.$json->ajuste_a_la_decena_subtotal;
										?>
                                        </div>
                                    <?php 
									
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
												echo $json->ajuste_a_la_decena;
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
			$rp_honorarios_modelos["Array_Pesos"]			=	ResumenBancosNew(array("Pesos"));
			foreach($rp_honorarios_modelos["Array_Pesos"] as $k2	=> $v2){?>
            <option value="<?php print($v2->id_cuenta);?>"><?php print(entidadbancaria($v2->entidad_bancaria)); ?></option>
        <?php }?>
    </select>
    <select class="form-control" name="caja_id" id="caja_id" require>
        <?php 
			$rp_honorarios_modelos["Array_ResumenCajas"]	=	ResumenCajas(array('110505'),array("6"));
			foreach($rp_honorarios_modelos["Array_ResumenCajas"] as $k2	=> $v2){?>
            <option value="<?php print($k2);?>"><?php print($v2->nombre_caja); ?></option>
        <?php }?>
    </select>
</div>
<?php
	//pre($pagos);
	
	$this->session->set_userdata(array("rp_honorarios_modelos"=>$rp_honorarios_modelos));
    //pre($rp_honorarios_modelos);
?>
<script>
	$(document).ready(function(){
		if($("#chequeo").val()=="1"){
			$("#ajuste_a_la_decena").val($("#ajuste_a_la_decena2").val());
			var content 	= 	$(	'<div id="contenedor_dinamico">'+
										'<div class="p-3">'+
											'<input type="text" class="form-control form-control-sm money" name="ajuste_a_la_decena" value="<?php echo $json->pago_global * 100;?>" />'+
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