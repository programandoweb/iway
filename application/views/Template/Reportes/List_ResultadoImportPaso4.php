<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php
	$modulo=$this->ModuloActivo;
	$ciclo_informacion=get_cf_ciclos_pagos_new($this->user->id_empresa,0);
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
       	 	<div class="row ">
            	<div class="col-md-12">
		            <h4 class="font-weight-700 text-uppercase orange">
                    	Resumen de Ventas 
					</h4>
                </div>
            </div>
        	<div class="row">
            	<div class="col-md-12">
					<?php
						$suma_token			=	0;
						$suma_equivalencia	=	0;
						$error_datos		=	false;
						$incremento			=	0;
						$btn				=	0;
						//pre($this->$modulo->result);
						if(count($this->$modulo->result)>0){
							foreach($this->$modulo->result as $v){
								if(!empty($v->pagina)){
								$periodo_pagos	=	get_periodo_pagos($v->id_empresa)->periodo_pagos;
								$resultado		=	$this->$modulo->get_reporte_x_pagina($v->centro_de_costos);
								$trm_ciclo		=	trm_ciclo($periodo_pagos,$v->periodo_pagos,$ciclo_informacion->mes);		
								foreach($resultado as $k2 => $v2){
								if(!get_factura($v->id_empresa,$v->centro_de_costos,$trm_ciclo["periodo_para_mysql"],$v2->Nombre_legal)){	
									$incremento++;
									$resultado2	=	$this->$modulo->get_reporte_x_pagina_detallado($v->centro_de_costos,$v2->pagina);
									$hidden 	= 	array(	"nombre_cliente"=>$v2->Nombre_legal,
															"cliente_id"=>$v2->cliente_id,
															"direccion"=>$v2->Direccion.' '.$v2->Ciudad.' '.$v2->Departamento.' '.$v2->Pais,
															"pais"=>$v2->Pais,
															"identificacion_empresa"=>$v2->Nit);
							echo form_open(base_url("Reportes/MakeFactura"),array('ajax' => 'true','id'=>"form_".$k2),$hidden);	
							$ciclo_informacion	=	get_cf_ciclos_pagos_new($this->user->id_empresa,0);
							$fecha_emision		=	@$ciclo_informacion->fecha_hasta;
							//pre($trm_ciclo);
					?>
                    		
                            		<?php #pre($trm_ciclo['trm']->monto)?>		
                                    <input type="hidden" name="factura_grande" value="1" />
                                    <input type="hidden" name="id_empresa" value="<?php print_r($v->id_empresa);?>" />
                                    <input type="hidden" name="periodo_pagos" value="<?php print_r($v->periodo_pagos);?>" />
                                    <input type="hidden" name="fecha_emision" value="<?php echo $fecha_emision;$trm_ciclo["periodo_para_mysql"];?>"/>
                                    <input type="hidden" name="trm" value="<?php echo @$trm_ciclo['trm']->monto;?>"/>
                                    <input type="hidden" name="ciclo_produccion_id" value="<?php echo $ciclo_informacion->ciclos_id; ?>" />

                                                                    
                                    
                                   	<div class="section size-s">
                                        <h5 class="text-center ">Datos del Cliente</h5>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        Señor (es):
                                                    </div>
                                                    <div class="col-md-9">
                                                        <?php print_r($v2->Nombre_legal);?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                       Dirección:
                                                    </div>
                                                    <div class="col-md-9">
                                                        <?php print_r($v2->Direccion);?> <?php print_r($v2->Ciudad);?> <?php print_r($v2->Departamento);?> <?php print_r($v2->Pais);?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                       ID Cliente:
                                                    </div>
                                                    <div class="col-md-9">
                                                        <?php print_r($v2->Nit);?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin-bottom:50px; border-bottom:solid 2px #f2f2f2;"> 
                                        	<?PHP // pre($resultado2);?>
                                            <table class="display table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th width="100" class="text-center"><b>Sucursal</b></th>
                                                        <th class="text-center"><b>Ciclo</b></th>
                                                        <th width="150"><b>Usuario</b></th>
                                                        <th width="100" class="text-center"><b>Equivalencia</b></th>
                                                        <th width="100" class="text-center"><b>Producción</b></th>
                                                        <th class="text-center"><b>Monto</b></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    
                                                        $total_tokens=0;
                                                        $total_dolares=0;
                                                        $total_pesos=0;
														$total_tokens_x_banco=array();
														$total_tokens_x_usd=array();
														$id_unico=0;
														foreach($resultado2 as $v3){
                                                       		$periodo_pagos	=	get_periodo_pagos($v3->id_empresa)->periodo_pagos;
															$id_unico++;	
                                                    ?>
                                                    	
                                                            <tr>
                                                                <td class="text-center">
                                                                	<?php 
																		print_r($v3->abreviacion);
																		//pre($v3);																	
																	?>
                                                                    <input type="hidden" name="borrame[]" value="<?php print_r($v3->reporte_archivo_plano_id);?>" />
                                                                    <input type="hidden" name="abreviacion[]" value="<?php print_r($v3->abreviacion);?>" />
                                                                    <input type="hidden" name="procesador_id[]" value="<?php print_r(get_procesador_id($v3->id_plataforma)->cuenta_id);?>" />
                                                                    <input type="hidden" name="plataforma_id[]" value="<?php print_r($v3->id_plataforma);?>" />
                                                                    
                                                                    
																</td>
                                                                <td class="text-center">
                                                                    <?php 
																			$ciclo_informacion							=	get_cf_ciclos_pagos_new($this->user->id_empresa,0);
																			$ciclopago									=	ciclopago($this->user->periodo_pagos,(int)date("m",strtotime($ciclo_informacion->fecha_desde)),$ciclo_informacion->fecha_desde);
																			print($ciclopago);
                                                                            //$format_periodo_pago	=	format_periodo_pago($periodo_pagos,$v3->periodo_pagos,$v3->mes);
																			//echo $format_periodo_pago;
                                                                    ?>
                                                                    <input type="hidden" name="format_periodo_pago[]" value="<?php print_r($ciclopago);?>" />
                                                                </td>
                                                                <td>
																	<?php 
																		$data_nickname	=	nickname_like_name_plataforma($v3->nickname,$v3->id_plataforma);
																		print_r($v3->nickname);	
																		if(!empty($data_nickname)){
																			//pre($v);
																	?>
                                                                    <input type="hidden" name="centro_de_costos[]" value="<?php print_r($v->centro_de_costos);?>" />
                                                                   	<input type="hidden" name="nickname[]" value="<?php print_r($v3->nickname);?>" />
                                                                    <input type="hidden" name="nickname_id[]" value="<?php print_r($data_nickname->nickname_id);?>" />
                                                                    <input type="hidden" name="id_master[]" value="<?php print_r($data_nickname->id_master);?>" />
                                                                    <input type="hidden" name="master_nombre[]" value="<?php print_r($data_nickname->nombre_master);?>" />  
                                                                    <input type="hidden" name="id_modelo[]" value="<?php print_r($data_nickname->id_modelo);?>" />
                                                                    <input type="hidden" name="modelo_primer_nombre[]" value="<?php print_r($data_nickname->primer_nombre);?>" />
                                                                    <input type="hidden" name="modelo_segundo_nombre[]" value="<?php print_r($data_nickname->segundo_nombre);?>" />
                                                                    <input type="hidden" name="modelo_primer_apellido[]" value="<?php print_r($data_nickname->primer_apellido);?>" />
                                                                    <input type="hidden" name="modelo_segundo_apellido[]" value="<?php print_r($data_nickname->segundo_apellido);?>" />
                                                                    <input type="hidden" name="modelo_identificacion[]" value="<?php print_r($data_nickname->identificacion);?>" />  
                                                                    <?php
																		}else{
																			echo '<br/><b>chequear nickname vacío</b>';	
																		}
																	?>
                                                                </td>
                                                                <td class="text-center">
																	<?php //pre($v3);?>
                                                                    <input type="text" <?php if($btn>0){ echo 'readonly="readonly"';}?>  id="equivalencia<?php echo $id_unico;?>"  data-tokens="<?php print_r($v3->tokens);?>" data-rel="<?php echo $id_unico;?>" class="form-control equivalencia text-right" name="equivalencia[]" maxlength="5" value="<?php print_r(str_replace(",",".",$v3->equivalencia));?>" />
																</td>
                                                                <td class="text-center">
																	<?php 
																		print_r(format($v3->tokens,false));$total_tokens=$v3->tokens + $total_tokens;
																	
																	?>
                                                                    <input type="hidden" id="tokens<?php echo $id_unico;?>" name="tokens[]" value="<?php print_r($v3->tokens);?>" />
																</td>
                                                                <td class="text-center">
																	<?php 	$tokens			=	floatval($v3->tokens); 
																			$equivalencia	= 	floatval(str_replace(",",".",$v3->equivalencia));
																			$total_dolar	=	$tokens * $equivalencia;
																	?> 
																		<span id="span<?php echo $id_unico;?>">
																			<?php echo format($total_dolar) ; ?>
																		</span>
																	<?php	$total_dolares	= 	$total_dolar+$total_dolares; ?>
		                                                             <input type="hidden" id="total_dolar<?php echo $id_unico;?>" name="total_dolar[]" value="<?php echo format($total_dolar) ; ?>" />
                                                                     <input type="hidden" id="total_dolar_sin_formato<?php echo $id_unico;?>" name="total_dolar_sin_formato[]" value="<?php echo $total_dolar ; ?>" />               
                                                                      <?php 
																		$entidada_bancaria										=	$this->$modulo->token_x_bancos($v3->nickname,$v3->id_plataforma);
																		//pre($entidada_bancaria);
																		if(!empty($entidada_bancaria)){
																			$cuenta_banco[$entidada_bancaria->entidad_bancaria]				=	(isset($entidada_bancaria->nro_cuenta)?$entidada_bancaria->nro_cuenta:"");
																			$total_tokens_x_banco[$entidada_bancaria->entidad_bancaria]		=	((isset($total_tokens_x_banco[$entidada_bancaria->entidad_bancaria]))?$total_tokens_x_banco[$entidada_bancaria->entidad_bancaria]:0) + $v3->tokens;
																			$total_tokens_x_usd[$entidada_bancaria->entidad_bancaria]		=	((isset($total_tokens_x_usd[$entidada_bancaria->entidad_bancaria]))?$total_tokens_x_usd[$entidada_bancaria->entidad_bancaria]:0) + $total_dolar;
																		}else{
																			if($error_datos=false){
																				$error_datos		=	true;	
																			}
																		}
																		
																	?>
																</td>
                                                            </tr>
                                                    <?php 
														}
													?>
                                                    
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td>
															
														</td>
                                                        <td></td>
                                                        <td>
                                                        	<input type="hidden" name="total_dolares_sin_formato" value="<?php echo $total_dolares ; ?>" require="require" />
                                                        	<input type="hidden" name="total_dolares" value="<?php echo format($total_dolares) ; ?>" require="require" />               
                                                            <input type="hidden" name="total_tokens" value="<?php echo $total_tokens ; ?>" require="require" />               
                                                        </td>
                                                        <td class="text-center"><B>Total:</B></td>
                                                        <td class="text-center"><B ><?php echo format($total_tokens,false);?></B></td>                                                        
                                                        <td class="text-center"><B id="total_dolares"><?php echo format($total_dolares);?></B></td>                                                        
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <?php 
														if($error_datos==false){
															//pre($v3);
															foreach($total_tokens_x_banco as $key => $value){
																
																//pre($key);
																?>
                                                                <input type="hidden" name="dolares_banco[]" value="<?php echo $key ; ?>" require="require" />
                                                                <input type="hidden" name="cuenta_banco[]" value="<?php echo substr($cuenta_banco[$key],-4,4) ; ?>" require="require" />
                                                                <input type="hidden" name="total_tokens_x_banco[]" value="<?php echo format($value) ; ?>" require="require" />
                                                                <input type="hidden" name="total_dolares_x_banco[]" value="<?php echo format($total_tokens_x_usd[$key]) ; ?>" require="require" /> 
                                                                <?php
																//echo '<div>'.entidadbancaria($key).' <b>('.substr($cuenta_banco[$key],-4,4).')</b>: Tokens <b>'.$value.'</b> USD <b>'.$total_tokens_x_usd[$key].'</b></div>';																		
															}	
														}else{
															echo 'Ha Ocurrido un Error, un Usuario no tiene plataforma asignada ó master';	
														}																
													?>
                                                </div>
                                                
                                                <div class="col-md-4 text-right">
	                                                <?php if($btn==0 && $total_dolares>0){?>
                                                    <button type="submit" class="btn btn-primary btn-md">
                                                        <i class="fa fa-check fa-1x"></i> 
                                                        Aprobar
                                                        <?php $btn++;?>
                                                        
                                                    </button>
                                                    <a href="<?php echo base_url("Reportes/DeleteItemImport/".$v3->centro_de_costos)?>" class="btn btn-warning btn-md"> Borrar para Continuar </a>
                                                    <?php }else{
													?>
                                                    	<a href="<?php echo base_url("Reportes/DeleteItemImport/".@$v3->centro_de_costos)?>" class="btn btn-primary btn-md"> Borrar para Continuar </a>
                                                    <?php	
													}?>
                                                </div>                                
                                            </div>
                                        </div>
									</div>
					<?php		
								echo form_close();
								}/*END V2*/
								}
								}
							}
							if($incremento==0){
								
								echo '<h2 class="text-center">Proceso de Generación de Facturas terminado</h2>';	
							}		
						}else{
							redirect(base_url("Reportes/FacturaVentas"));return;
						}
					?>            
					<div class="container">
						<?php 
							echo $this->pagination->create_links();
						?>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	$(document).ready(function(){
		$("#periodo").html("<?php echo $trm_ciclo["periodo"];?>");
		$(".fecha_emision").val("<?php echo $trm_ciclo["periodo_para_mysql"];?>")
		$(".trm").val("<?php echo @$trm_ciclo["trm"]->monto;?>")
		
		var  formularios	=	$("form");
		formularios.each(function(index,v){
			var formulario	=	$(this);
			var inputs		=	formulario.find(".equivalencia");	
			inputs.each(function(index,v){
				var obj	=	$(this);
				obj.keyup(function(){
					var obj2	=	$(this);
					var total_tks	=	0;
					formulario.find(".equivalencia").each(function(index,v2){
						$(this).val(obj2.val());
						total_tks	+=	($(this).val()* $(this).data("tokens"));						
						calcula_todo($(this));
					})
					$("#total_dolares").html(total_tks.toFixed(2));
				});
			});	
		});
	});
	function calcula_todo(obj){
		//alert(obj.data("tokens"));
		var total_tks	=	(obj.val()*obj.data("tokens")).toFixed(2);
		$("#span"+obj.data("rel")).html(total_tks);
		$("#total_dolar_sin_formato"+obj.data("rel")).val(total_tks);
		$("#total_dolar"+obj.data("rel")).val(total_tks);
	}
</script>