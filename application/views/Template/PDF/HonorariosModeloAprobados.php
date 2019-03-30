<?php

	$modulo						=	$this->ModuloActivo;
	$json						=	json_db($this->$modulo->result->json,"decode");
	$ciclo_informacion			=	get_cf_ciclos_pagos_new($this->user->id_empresa,0);	
    $ListOtrosIngresos9         =   $json->Descuentos;
    $procesador = $json->data_user;
    $entidad = entidadbancaria($json->data_user->entidad_bancaria);
    //pre($json);
    $Pagos  =   getMovimientosGeneral($this->uri->segment(4),NULL,14,NULL,$json->ciclopago,$this->uri->segment(3));
    $Total_pagado = 0;
    foreach ($Pagos as $key => $value) {
        $Total_pagado += $value->credito;
    }
?>
<table class="ancho cabecera" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td width="30%" colspan="2">
            <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:90px;" />
        </td>
        <td style="text-align:right; font-size:12px; font-weight:bold;" valign="top" colspan="15">
            <?php echo $empresa->nombre_legal?><br/>
            Nit: <?php echo $empresa->identificacion;?> | <?php echo $empresa->tipo_empresa;?><br />
            <?php echo $empresa->direccion;?><br />               
            PBX: <?php echo $empresa->cod_telefono;?>-<?php echo $empresa->telefono?><br />
            <?php echo $empresa->website;?><br/>
            <?php #pre($empresa); ?>
        </td>
    </tr>
</table>
<div class="footer bordetop pie_de_pagina">
    <table>
        <tr>
            <td style="width:33%; text-align: left;font-size: 9px;color :black;">Fecha impresión documento <?php echo date('Y-m-d'); ?></td>
            <td style="text-align: center;font-size: 9px;"></td>
            <td style="width:33%; text-align: right;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
        </tr>
    </table>
</div>
        <?php 
		
			$chequeo	=	chequear_Honorarios_X_ciclo_de_produccion($this->$modulo->result->modelo_id,$this->user->ciclo_produccion_id);
			$chequeo2	=	chequear_Honorarios_Pagados_X_ciclo_nro_documento($this->$modulo->result->modelo_id,$this->uri->segment(4));
			$chequeo3	=	sum_Honorarios_Pagados_X_ciclo_nro_documento($this->$modulo->result->modelo_id,$this->uri->segment(4));
			
			if(!empty($chequeo2) && ($chequeo3->credito == $chequeo->debito)){
				echo '<div class="container text-center" id="pagado"><h2 class="font-weight-700 text-uppercase orange">PAGADO</h2></div>';
			}else{
				//echo 'Aprobado';	
			}	
		
		?>
      <?php 
				$chequeo	=	chequear_Honorarios_X_ciclo_de_produccion($this->uri->segment(3),$this->user->ciclo_produccion_id);
			?>







<div style="font-family:font-family: 'Montserrat', sans-serif; line-height:16px; font-size:12px; font-family:font-family: 'Montserrat', sans-serif;margin-top: -20px;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr style="padding: 0;margin:0; width:100%;">
            <td style="padding: 0;margin:0;width:60%;">
               <div class="recuadro margen_derecha bordeAll">    
                  <div class="colorFondo"><b>Tercero</b></div>
                  <table>
                      <tr>
                        <td colspan="2">
                            <b>
                                <?php echo @nombre($procesador); ?>
                            </b>
                        </td>
                      </tr>
                      <tr>
                          <td>Id Tercero: </td>
                          <td>
                              <b><?php echo @$procesador->identificacion; ?></b>
                          </td>
                      </tr>
                      <tr>
                          <td>Dirección: </td>
                          <td>
                              <b><?php echo @$procesador->direccion;; ?></b>
                          </td>
                      </tr>
                      <tr>
                          <td>Ciudad: </td>
                          <td>
                              <b><?php echo @$procesador->ciudad; ?></b>
                          </td>
                      </tr>
                      <tr>
                          <td>Teléfono:</td>
                          <td>
                              <b><?php echo (!empty($procesador->telefono)?$procesador->telefono:"N.A."); ?></b>
                          </td>
                      </tr>
                      <tr>
                          <td>Escala:</td>
                          <td>
                              <b><?php echo @$json->nombre_escala.' ('.@$json->escala_usuario->meta.') '; ?></b>
                          </td>
                      </tr>
                      <tr>
                          <td>Valor Token (USD): 
                          </td>
                          <td>
                              <b><?php echo @$json->factorBonificacion; ?></b>
                          </td>
                      </tr>
                  </table>
               </div>                   
            </td>        
            <td>
                <div class="recuadro bordeAll">
                    <div class="colorFondo"><b>Datos documento</b></div>
                     <table>
                         <tr>
                             <td width="120">
                                Liquidación Ingresos: 
                             </td>
                             <td>
                                <b>
                                    <?php echo @centrodecostos($procesador->centro_de_costos)->abreviacion.' '.tipo_documento(13,true).' '.ceros($this->uri->segment(4)); ?>
                                </b> 
                             </td>
                         </tr>
                         <tr>
                             <td>Fecha de Expedición:</td>
                             <td><b><?php echo $this->$modulo->result->fecha;?></b></td>
                         </tr>
                         <tr>
                             <td>Fecha de Vencimiento:</td>
                             <td><b><?php echo $this->$modulo->result->fecha;?></b></td>
                         </tr>
                         <tr>
                             <td>Estado:</td>
                             <td>
                                <b>
                                    <?php 
                                      if($Total_pagado == $json->pago_global){
                                        echo 'Pagado';
                                      }else{
                                        echo 'Procesado';  
                                      }
                                    ?>        
                                </b>
                            </td>
                         </tr>
                         <tr>
                             <td>Sucursal:</td>
                             <td></b><?php echo centrodecostos($procesador->centro_de_costos)->abreviacion; ?></b></td>
                         </tr>
                         <tr>
                             <td>Ciclo de producción:</td>
                             <td></b><?php echo $json->ciclopago; ?></b></td>
                         </tr>
                         <tr>
                             <td>Valor TRM:</td>
                             <td></b><?php echo "$ ".$json->trm_now; ?></b></td>
                         </tr>
                     </table>
                </div>              
            </td>
        </tr>
    </table>
    <div style="height: 10px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="table">
        <thead>
            <tr class="colorFondo">
                <th><b>Concepto</b></th>
                <th><b>Monto</b></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                //pre($json->HonorariosModelos);
            ?>
            <tr>
                <td class="bordeAll" style="text-align:justify;">
                    Liquidación de ingresos por cuentas en participación y/o mandato, del <b><?php echo @$json->ciclo_informacion->fecha_desde; ?></b> al <b><?php echo @$json->ciclo_informacion->fecha_hasta; ?></b>; clasificación <b><?php echo (empty($json->data_user->tipo_modelo))?"no asignada":$json->data_user->tipo_modelo; ?></b>, monitor <b><?php echo (empty($json->data_user->monitor))?"no asignado":nombre(centrodecostos($json->data_user->monitor)); ?></b>, meta ideal <b><?php echo @format($json->data_user->meta_ideal,false); ?></b> tokens, cumplimiento meta ideal
                    <b><?php 
                        if(@$json->totalP > 0 && @$json->data_user->meta_ideal > 0){
                          echo format(((intval(str_replace(".","",@$json->totalP)))/floatval(@$json->data_user->meta_ideal)) * 100,true);
                        }else{
                          echo "0,00";
                        }
                    ?></b>%, turno transmisión
                    <b>
                    <?php
                        if($json->data_user->turno_manama == 1){
                            echo "Mañana";
                        }elseif($json->data_user->turno_tarde == 1){
                            echo "Tarde";
                        }elseif($json->data_user->turno_noche == 1){
                            echo "Noche";
                        }else{
                            echo "Intermedio";
                        }
                    ?></b>, Room #
                    <b> 
                    <?php
                        if($json->data_user->room_transmision == 1000000){
                            echo "Satélite";
                        }else{
                            echo $json->data_user->room_transmision;
                        }
                    ?>,
                  </b> entidad bancaria 
                  <b>
                    <?php echo (empty($entidad))?"no reporta":$entidad;?>,
                  </b> cuenta bancaria
                  <b><?php echo (empty($json->data_user->nro_cuenta))?"no reporta":$json->data_user->nro_cuenta; ?></b>.
                </td>
                <td class="bordeAll right">

                    $ <?php
                        $monto_concepto = (floatval(str_replace(".","",$json->totalizacion_general)) + floatval(str_replace(".","",$json->total_beneficios))); 
                        echo format($monto_concepto,false); 
                      ?>
                </td>
            </tr>
        </tbody>
    </table> 
    <div style="height: 10px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="table">
        <thead>
            <tr class="colorFondo">
                <th colspan="5">Producción por Plataforma </th>
            </tr>
            <tr class="colorFondo">
                <th><b>Plataforma</b></th>
                <th><b>Usuario</b></th>
				<th class="text-center"><b>Factura</b></th>
                <th class="text-right"><b>Producción</b></th>
                <th class="text-right" width="120"><b>Vr. Pesos</b></th>
            </tr>
        </thead>
        <tbody>
        	<?php 
				//pre($json->HonorariosModelos);
			?>
            <?php 
				$totalRQ		=	0;
                $totalP			=	0;
                if(!empty($monto_concepto) && !empty($json->totalP)){
                  $operacion      = $monto_concepto/floatval(str_replace(".","",$json->totalP));
                }else{
                  $operacion      = 0;
                }
				foreach($json->HonorariosModelos as $k => $v){
                    $get_diario     =   get_diario($v->user_id,$v->nickname_id,$ciclo_informacion->fecha_desde,$ciclo_informacion->fecha_hasta);
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
                    //pre($v->nickname_id);
                    $totalP         =   $totalP + @$items_factura_x_nickname->monto_global_usd / 0.05;
                    $conversion     =   conversion_token_standar(@$produccion,$v->equivalencia);
                    $conversion     =   @$items_factura_x_nickname->monto_global_usd / 0.05;
                    if(!empty($conversion)){
			?>
                <tr>
                    <td class="bordeAll">
                        <?php 
                            print($v->primer_nombre);
							//pre($v);
                        ?>
                    </td>
                    <td class="bordeAll">
                        <?php 
							print_r($v->nickname);
                        ?>
                    </td>
                    <td class="bordeAll center">
                    	<?php
                        	if(!empty($factura)){
                                echo $factura;
							}else{
								echo '---';	
							}											
						?>
                    </td>
                    <td class="bordeAll right">
                        <?php 
							echo $rp_honorarios_modelos["conversion"][$k]	=	format($conversion,false);
                        ?>
                    </td>
                    <td class="bordeAll right">
                        $ <?php
                        	
                            if(!empty($items_factura_x_nickname)){
                                $produccion		=	$items_factura_x_nickname->tokens;
                            }else{
                                $produccion		=	0;
                            } 
                            if(!empty($get_diario)){
								$rp_honorarios_modelos["conversion_conversion_token_standar"][$k]	=	format( $conversion - $conversion_token_standar,false);
                                echo format(($conversion - $conversion_token_standar)*$operacion,false);
                            }else{
								$rp_honorarios_modelos["conversion_conversion_token_standar"][$k]	=	format($conversion,false);
                                echo format(($conversion*$operacion),false);	
                            }
                        ?>
                    </td>
                </tr>
            <?php
                    }
                }
            ?>
        </tbody>
        <tfoot>
            <tr class="colorFondo">
                <td></td>
                <td></td>
                <td class="center"><b>Total producción</b></td>
                <td class="right">
                	<b>
						<?php echo $rp_honorarios_modelos["totalP"]			=	format($totalP,false);?>
                    </b>
				</td>
                <td class="right">
                	<b>	
						$ <?php echo format($monto_concepto,false); ?>
					</b>
				</td>
            </tr>
        </tfoot>
    </table> 
    <!--<div style="height: 20px;"></div>
    <div><b>Registro Contable: </b><b></b></div>
    <div style="height: 20px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="table"> 
    <?php 
        $registro                   =   get_registro_contable_honorarios_new($this->uri->segment(3),$this->uri->segment(4));
        if(count($registro)>0){
    ?>
        <thead>
            <tr class="colorFondo">
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
                ?>
                    <tr>
                        <td class="bordeAll"><?php print_r($v->codigo_contable);?></td>
                        <td class="bordeAll"><?php print_r($v->cuenta_contable);?></td>
                        <td class="bordeAll right">
                            <?php 
                                    //pre($v);
                                 	$debito											=	$debito 	+ 	round($v->debito,2); 	
                                  	echo $rp_honorarios_modelos["debito"][$k]		=	format($v->debito);
                            ?>
                        </td>
                        <td class="bordeAll right">
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
    <?php }?>-->
    <div style="height: 10px;"></div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" >
        <thead>
             <tr class="colorFondo">
                 <th colspan="4">Detalle liquidación de ingresos.</th>
             </tr>
             <tr class="colorFondo">
                 <th colspan="2">Detalle liquidación de ingresos.</th>
                 <th colspan="2">Detalle beneficios.</th>
             </tr>
         </thead> 
        <tr>
            <td class="bordeAll" width="180">
               Salario Básico
            </td>
            <td class="bordeAll right">
                <b>
                    $ <?php
						$salario_var	=$json->salario_var;
						echo $salario_var;
						$recalcular_prima_semestral	= $total_liquidacion_ingresos	= (int)str_replace(".","",$salario_var);
                    ?>
                </b>
            </td>
            <td class="bordeAll">
              	Aux. E.P.S
            </td>
            <td class="bordeAll right">
                <b>
                	$ <?php 
						$eps=$json->aux_eps;
                        echo $eps;
                    ?>
                </b>
            </td>
        </tr>
        <tr>
            <td class="bordeAll">
               Aux. Transporte
            </td>
            <td class="bordeAll right">
                <b>
                   $ <?php
				   		/*AUXILO DE TRANSPORTE*/
                        echo $json->escala_salario;	
                    ?>
                </b>
            </td>
           	<td class="bordeAll ">
            	 Aux. A.R.L
            </td>
            <td class="bordeAll right">
                <b>
                    $ <?php 
                        echo $json->aux_arl;
                    ?>
                </b>
            </td>
        </tr>
        <tr>
            <td class="bordeAll">
               Bonificación
            </td>
            <td class="bordeAll right">
                <b>
                   $ <?php 
                        echo $json->aux_bonificacion;
                    ?>
                </b>
            </td>
             <td class="bordeAll">
              	Aux. Caja Compensación
            </td>
            <td class="bordeAll right">
            	<b>
                $ <?php 
					echo $json->aux_aux;
				?>
                </b>
            </td>
        </tr>
        <tr>
            <td class="bordeAll">
                Otros Ingresos
            </td>
            <td class="bordeAll right">
                <b>
                    $ <?php 
                        echo		$json->ortros_ingresos;
                    ?>
                </b>
            </td>
            <td class="bordeAll">
                Ahorro Semestral (<?php echo format(@$json->escala_prima_porcentaje,true)?>%)
            </td>
            <td class="bordeAll right">
                <b>
                    $ <?php 
						echo $json->total_ahorro_prima;
                    ?>
                </b>
            </td>
        </tr>
        <tr class="colorFondo">
            <td class="bordeAll">
                <b>Total Liquidación de Ingresos</b>
            </td>
            <td class="bordeAll right">
                <b>
                    $ <?php echo $json->totalizacion_general;?>
                </b>
            </td>
            <td class="bordeAll">
            	<b>
                    Total Beneficios
                </b>
            </td>
            <td class="bordeAll right">
                <b>
                	$ <?php echo format(@$json->total_beneficios,false)?>
                </b>
            </td>
        </tr>
        <tr>
            <td class="col-md-2">
              	
            </td>
            <td class="col-md-4 text-right">
                
            </td>
            <td class="bordeAll colorFondo"><b>
                Total Ingresos</b>
            </td>
            <td class="bordeAll right colorFondo">
                <b>
                    $ <?php 
                        echo $json->totalizacion_general;
                    ?>
                </b>
            </td>
        </tr>
        <tr>
            <td>
            </td>
            <td>
            </td>
            <td class="bordeAll">
                Descuentos
            </td>
            <td class="bordeAll right">
                $ <?php 
					echo $json->Descuentos_total_monto_cuota;
				?>
            </td>
        </tr>
        <!--tr>
            <td class="col-md-2">
            </td>
            <td class="col-md-4 text-right">
                
            </td>
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
                <td class="col-md-3 ">
                    <b>Subtotal</b>
                </td>
                <td class="col-md-3 text-right">
                    <b>
						<?php 
							echo $rp_honorarios_modelos["Subtotal"]	=	format($total_liquidacion_ingresos - $total_monto_cuota,false);
						?>
                    </b>
                </td>
            <?php 
				}
			?>
        </td-->
        <tr>
            <td>
            </td>
            <td> 
            </td>
            <td class="bordeAll">
                ReteFuente (<?php echo $json->porcentaje_retencion;?>%)
            </td>
            <td class="bordeAll right">
            	$ <?php 	
					echo $json->total_ingresosXporcentaje_retencion;
				?>
            </td>
		</tr> 
         <tr>
            <td>
            </td>
            <td> 
            </td>
            <td class="bordeAll colorFondo">
                <b>Subtotal</b>
            </td>
            <td class="bordeAll right colorFondo">
            	<b>
				$ <?php	
					echo $json->subtotal_2;
				?>
                </b>
            </td>
		</tr>                                    
        <tr style="display:none;">
            <td class="col-md-2">
            </td>
            <td class="col-md-4 text-right">
                
            </td>            
            <td class="bordeAll ">
                Subtotal 1
            </td>
            <td class="bordeAll right">
                $ <?php 
                    echo @$json->subtotal1_2;
                ?>
            </td>
        </tr>
        <tr>
            <td>
            </td>
            <td class="bordeAll ">
                Ajuste a la decena
            </td>
            <td class="bordeAll right">
            $ <?php 	
				echo $json->ajuste_a_la_decena_prefijo.$json->ajuste_a_la_decena_subtotal;
			?>
            </td>
        </tr>
        <tr>
            <td class="col-md-2">
            </td>
            <td class="col-md-4 text-right">  
            </td>
            <td class="bordeAll colorFondo">
                <b>Total</b>
            </td>
            <td class="bordeAll right colorFondo">
                <b>
                	$ <?php 
						echo $json->ajuste_a_la_decena;
					?>
                </b>
            </td>
        </tr>
    </table>
    <div style="height:20px; "></div>
    <div class="recuadro fondoCell bordeAll">    
        <div class="colorFondo">
            <b>Importante:</b>
        </div>
        <table>
            <tr>
                <td style="text-align: justify;">
                    Certifico (certificamos) que esta operación ha sido verificada de manera detallada antes de su respectivo procesamiento.
                    <?php echo(!empty($this->$modulo->result->responsable_id))?" Documento elaborado por <b>".nombre(centrodecostos($this->$modulo->result->responsable_id)).'</b>':''; ?>
                </td>
            </tr>
        </table>
        <div style="width: 100%;">
            <div style="height: 40px;"></div>
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="45%">
                            <div class="bordetop linea">
                                Elaboró:
                            </div>
                        </td>
                        <td width="10%"> </td>
                        <td width="45%"> 
                            <div class="bordetop linea"> 
                                Revisó:
                            </div>
                        </td>
                    </tr>
            </table> 
        </div>
    </div> 
</div>