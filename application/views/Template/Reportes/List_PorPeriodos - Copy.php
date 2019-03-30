<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php
	$modulo				= 	$this->ModuloActivo;
	$trm				=	get_cf_ciclos_pagos_new($this->user->id_empresa,0);	
	$centro_de_costos	=	$this->user->centro_de_costos;
	$periodos_de_pago	=	centrodecostos($this->user->id_empresa)->periodo_pagos;
	$cantidad_a_mostrar	=	($periodos_de_pago==2)?2:2;
	$inc_desde			=	(int)calculo_meses(date("Y").'-'.(date("m") - 3).'-'.date("d"),'+'.$cantidad_a_mostrar,'m');
	$inc_desde			=  	$inc_desde -1;
	$inc_hasta			=	$inc_desde	+ 	$cantidad_a_mostrar;
	$plataformas		=	GetPlataformas();
	$sucursales			=	get_sucursales();
	$turnos				=	GetTurnos();
	$rooms				=	GetRooms();
	$nicknames			=	GetNicknames();
	$procesadores		=	GetProcesadores();
	$masters			=	GetMastersXPlataformas();	
	$modelos			=	get_modelos(true);
	$terceros_x_turnos	=	GetTercerosXTurnos($modelos["all"]);
	
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
       	 	<?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Reportes X Sucursales.",
															"icono"	=>	'<i class="fas fa-users"></i>',
															"url"	=>	current_url()),
                                                            "pdf"   =>  true,
                                                            "excel"     =>  true,
                                                            "mail"      =>  array(  "id"    =>  "mail" ),
							)
						);
			?>
        	<div class="row">
            	<div class="col-md-12">
					<div class="section">
                    	<div class="bd-example bd-example-tabs" role="tabpanel">
                        	<ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="item1-tab" data-toggle="tab" href="#item1" role="tab" aria-controls="item" aria-expanded="false">Turnos (<b>Tokens</b>)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="item2-tab" data-toggle="tab" href="#item2" role="tab" aria-controls="item" aria-expanded="false">Rooms (<b>Tokens</b>)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="item3-tab" data-toggle="tab" href="#item3" role="tab" aria-controls="item" aria-expanded="false">Master (<b>Tokens</b>)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="item4-tab" data-toggle="tab" href="#item4" role="tab" aria-controls="item" aria-expanded="false">Procesadores (<b>USD</b>)</a>
                                </li>
							</ul>
                            <div class="tab-content" id="myTabContent">
                              	<div role="tabpanel" class="tab-pane fade active show" id="item1" aria-labelledby="item-tab" aria-expanded="false">                                
                                    <table class="table table-hover table-shorta" >
                                        <thead>
                                            <tr>
                                                <th width="80"></th>
                                                <th width="200"></th>
                                                <th width="100"></th>
                                                <?php 
                                                    $fila	=	array(); 
                                                    for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
                                                ?>
                                                   		<th class="dias" colspan="2"><?php echo mes($a);?></th>
                                                <?php	
                                                    }
                                                ?>
                                                <th width="100" class="text-right"></th>
                                            </tr>
                                            <tr>
                                                <th width="100">Turnos</th>
                                                <th class="text-center">Terceros</th>
                                                <th class="text-center">Sucursal</th>
                                                <?php 
                                                    
                                                    for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
                                                        if($periodos_de_pago==2){
                                                ?>
                                                            <th class="dias">Q1</th>
                                                            <th class="dias">Q2</th>
                                                <?php	
                                                        }else{
                                                ?>
                                                            <th class="dias">S1</th>
                                                            <th class="dias">S2</th>
                                                            <th class="dias">S3</th>
                                                            <th class="dias">S4</th>
                                                <?php			
                                                        }
                                                    }
                                                ?>
                                                <th width="100" class="text-center">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  
												$produccion_x_modelo	=	array();
                                                $total=array();
                                                $suma_vertical	=	array();
                                                $suma_total		=	0;
												$cantidad_items_verticales=array();
												//pre($turnos);
												if($periodos_de_pago==2){
													unset($turnos["turno_intermedio"]);
												}
												foreach($turnos as $k => $v){
                                            ?>
                                                    <tr id="tr_item2_<?php echo $k;?>">
                                                        <td>
                                                            <?php 
                                                              	print($v);
                                                            ?>
                                                        </td>
                                                        <td class="text-left">
                                                            <?php
																if(isset($terceros_x_turnos[$k])){
																	foreach($terceros_x_turnos[$k] as $k2 => $v2){
																		print("<div>".nombre($v2)."</div>");
																	}
																}
                                                            ?>
                                                        </td>
                                                        <td class="text-center">
                                                        	<?php
																if(isset($terceros_x_turnos[$k])){
																	foreach($terceros_x_turnos[$k] as $k2 => $v2){
																		print("<div>".$sucursales[$v2->centro_de_costos]->abreviacion."</div>");
																	}
																}
                                                            ?>
                                                        </td>
                                                        <?php 
                                                            $fila	=	array();
                                                            $suma_horizontal	=	0;
																for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
																	//pre($a);
																	if($periodos_de_pago==2){
																			$mes				=	($a<10)?"0".$a:$a;
																?>
                                                                    <td class="dias text-right">
                                                                        <?php 
                                                                            if(isset($terceros_x_turnos[$k])){
                                                                                foreach($terceros_x_turnos[$k] as $k2 => $v2){
																					//pre($v2->user_id);
																					$RP_X_Modelos	=	RP_X_Modelos($v2->user_id,"Q1-".$mes."-".date("Y")); 
																					if(@$RP_X_Modelos->credito>0){
																						@$cantidad_items_verticales[$a][1]			+=	(@$RP_X_Modelos->credito / 0.05);
																						@$cantidad_items_horizontales[$k][$k2]		+=	(@$RP_X_Modelos->credito / 0.05);
																						print('<div>'.format($RP_X_Modelos->credito / 0.05,false).'</div>');
																					}else{
																						echo '<div>---</div>';	
																					}
																					//echo @$cantidad_items_horizontales[$k][$k2];
                                                                                }
                                                                            }
                                                                        ?>                                                                            
                                                                    </td>
                                                                    <td class="dias text-right">
                                                                	<?php 
                                                                            if(isset($terceros_x_turnos[$k])){
                                                                                foreach($terceros_x_turnos[$k] as $k2 => $v2){
																					//pre($v2->user_id);
																					$RP_X_Modelos	=	RP_X_Modelos($v2->user_id,"Q2-".$mes."-".date("Y")); 
																					if(@$RP_X_Modelos->credito>0){
																						@$cantidad_items_verticales[$a][1]			+=	(@$RP_X_Modelos->credito / 0.05);
																						@$cantidad_items_horizontales[$k][$k2]		+=	(@$RP_X_Modelos->credito / 0.05);
																						print('<div>'.format($RP_X_Modelos->credito / 0.05,false).'</div>');
																					}else{
																						echo '<div>---</div>';	
																					}
																					//echo @$cantidad_items_horizontales[$k][$k2];
                                                                                }
                                                                            }                                                                            																				
                                                                        ?>                                                                   	
                                                                    </td>
                                                                <?php	
                                                                    }else{
                                                                ?>
                                                                    <th class="dias">S1</th>
                                                                    <th class="dias">S2</th>
                                                                    <th class="dias">S3</th>
                                                                    <th class="dias">S4</th>
                                                                <?php			
                                                                    }
                                                                }
                                                            ?>
                                                                <td class="text-right">
                                                                    <input type="hidden" class="monto_horizonateles" value="1<?php echo @$suma_horizontal;?>" data-rel="tr_item2_<?php echo $k;?>" />
                                                                    <?php 
																		  if(isset($terceros_x_turnos[$k])){
                                                                                foreach($terceros_x_turnos[$k] as $k2 => $v2){
																					if(@$cantidad_items_horizontales[$k][$k2]>0){
																						echo '<div>'.format(@$cantidad_items_horizontales[$k][$k2],false).'</div>' ;
																					}else{
																						echo '<div>---</div>';	
																					}
																				}
																		  }
                                                                        //$suma_total +=	@$suma_horizontal;
                                                                    ?>
                                                                </td>
                                                       			
                                                    </tr>
                                            <?php 
													
                                                }
                                            ?>
                                        </tbody>
                                        <!--tfoot>
                                            <th></th>
                                            <th></th>
                                            <th>Total</th>
                                            <?php 
                                                $suma_horizontal	=	0;
                                                for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
                                            ?>
                                                    <th class="text-right">
                                                        <?php 
															print(format(@$cantidad_items_verticales[$a][1],false));
                                                        ?>
                                                    </th>
                                                    <th class="text-right">
                                                        <?php 
															print(format(@$cantidad_items_verticales[$a][2],false));
                                                        ?>
                                                    </th>
                                            <?php 
                                                    
                                                }
                                            ?>
                                            <th class="text-right">

                                            </th>
                                        </tfoot-->
                                    </table>
								</div>
                                <div role="tabpanel" class="tab-pane fade" id="item2" aria-labelledby="item-tab" aria-expanded="false">
                                	<table class="table table-hover table-shorta" >
                                        <thead>
                                            <tr>
                                                <th width="80"></th>
                                                <th width="200"></th>
                                                <th width="100"></th>
                                                <?php 
                                                    $fila	=	array(); 
                                                    for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
                                                ?>
                                                   		<th class="dias" colspan="2"><?php echo mes($a);?></th>
                                                <?php	
                                                    }
                                                ?>
                                                <th width="100" class="text-right"></th>
                                            </tr>
                                            <tr>
                                                <th width="100">Rooms</th>
                                                <th class="text-center">Terceros</th>
                                                <th class="text-center">Sucursal</th>
                                                <?php 
                                                    
                                                    for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
                                                        if($periodos_de_pago==2){
                                                ?>
                                                            <th class="dias">Q1</th>
                                                            <th class="dias">Q2</th>
                                                <?php	
                                                        }else{
                                                ?>
                                                            <th class="dias">S1</th>
                                                            <th class="dias">S2</th>
                                                            <th class="dias">S3</th>
                                                            <th class="dias">S4</th>
                                                <?php			
                                                        }
                                                    }
                                                ?>
                                                <th width="100" class="text-center">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  
                                                $total=array();
                                                $suma_vertical	=	array();
                                                $suma_total		=	0;
												$cantidad_items_verticales=array();
												//pre($turnos);
												if($periodos_de_pago==2){
													unset($turnos["turno_intermedio"]);
												}
												foreach($rooms as $k => $v){
													
													
                                            ?>
                                                    <tr id="tr_item2_<?php echo $k;?>">
                                                        <td>
                                                            <?php 
                                                              	print($v);
                                                            ?>
                                                        </td>
                                                        <td class="text-left">
                                                        	
                                                            <?php
																$sucursales[$k]	=	array();	
																if(isset($modelos["x_rooms"][$k])){
																	foreach($modelos["x_rooms"][$k] as $k2 => $v2){
																		$sucursales[$k][]	=	$sucursales[$v2->centro_de_costos]->abreviacion;
																		print("<div>".nombre($v2)."</div>");
																	}
																}
                                                            ?>
                                                        </td>
                                                        <td class="text-center">
                                                        
                                                        	<?php
																if(isset($sucursales[$k])){
																	foreach($sucursales[$k] as $k2 => $v2){
																		print('<div>'.$v2.'</div>');
																	}
																}
                                                            ?>
                                                        </td>
                                                        <?php 
                                                            $fila	=	array();
                                                            $suma_horizontal	=	array();
																for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
																	//pre($a);
																	if($periodos_de_pago==2){
																			$mes				=	($a<10)?"0".$a:$a;
																?>
                                                                    <td class="dias text-right">
                                                                        <?php 
																			if(isset($modelos["x_rooms"][$k])){
																				foreach($modelos["x_rooms"][$k] as $k2 => $v2){
																					if(isset($produccion_x_modelo[$v2->user_id][$mes][1])){
																						@$cantidad_items_verticales[$a][1]	+=	$produccion_x_modelo[$v2->user_id][$mes][1];
																						@$suma_horizontal[$v2->user_id]	+=	$produccion_x_modelo[$v2->user_id][$mes][1];	
																						print('<div>'.format($produccion_x_modelo[$v2->user_id][$mes][1],false).'</div>');	
																					}else{
																						echo '<div>---</div>';	
																					}
																				}
																			}
                                                                        ?>                                                                            
                                                                    </td>
                                                                    <td class="dias text-right">
                                                                	    <?php 
																			if(isset($modelos["x_rooms"][$k])){
																				foreach($modelos["x_rooms"][$k] as $k2 => $v2){
																					if(isset($produccion_x_modelo[$v2->user_id][$mes][2])){
																						@$cantidad_items_verticales[$a][2]	+=	$produccion_x_modelo[$v2->user_id][$mes][1];
																						@$suma_horizontal[$v2->user_id]	+=	$produccion_x_modelo[$v2->user_id][$mes][1];	
																						print('<div>'.format($produccion_x_modelo[$v2->user_id][$mes][2],false).'</div>');	
																					}else{
																						echo '<div>---</div>';	
																					}
																				}
																			}
                                                                        ?>                                                                	
                                                                    </td>
                                                                <?php	
                                                                    }else{
                                                                ?>
                                                                    <th class="dias">S1</th>
                                                                    <th class="dias">S2</th>
                                                                    <th class="dias">S3</th>
                                                                    <th class="dias">S4</th>
                                                                <?php			
                                                                    }
                                                                }
                                                            ?>
                                                                <td class="text-right">
																	<?php 
																		if(isset($modelos["x_rooms"][$k])){
																			foreach($modelos["x_rooms"][$k] as $k2 => $v2){
																				if(isset($suma_horizontal[$v2->user_id])){
																					print('<div>'.format($suma_horizontal[$v2->user_id],false).'</div>');	
																				}else{
																					echo '<div>---</div>';	
																				}
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
                                            <th></th>
                                            <th></th>
                                            <th>Total</th>
                                            <?php 
                                                $suma_horizontal	=	0;
                                                for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
                                            ?>
                                                    <th class="text-right">
                                                        <?php
															print(format(@$cantidad_items_verticales[$a][1],false));
                                                        ?>
                                                    </th>
                                                    <th class="text-right">
                                                        <?php 
															print(format(@$cantidad_items_verticales[$a][2],false));
                                                        ?>
                                                    </th>
                                            <?php 
                                                    
                                                }
                                            ?>
                                            <th class="text-right">

                                            </th>
                                        </tfoot>
                                    </table>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="item3" aria-labelledby="item-tab" aria-expanded="false">                                
                                	<table class="table table-hover table-shorta" >
                                        <thead>
                                            <tr>
                                                <th ></th>
                                                <th ></th>
                                               
                                                <?php 
                                                    $fila	=	array(); 
                                                    for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
                                                ?>
                                                   		<th class="dias" colspan="2"><?php echo mes($a);?></th>
                                                <?php	
                                                    }
                                                ?>
                                                <th width="100" class="text-right"></th>
                                            </tr>
                                            <tr>
                                                <th width="100">Plataformas</th>
                                                <th width="180">Máster</th>
                                               
                                                <?php 
                                                    
                                                    for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
                                                        if($periodos_de_pago==2){
                                                ?>
                                                            <th class="dias">Q1</th>
                                                            <th class="dias">Q2</th>
                                                <?php	
                                                        }else{
                                                ?>
                                                            <th class="dias">S1</th>
                                                            <th class="dias">S2</th>
                                                            <th class="dias">S3</th>
                                                            <th class="dias">S4</th>
                                                <?php			
                                                        }
                                                    }
                                                ?>
                                                <th width="100" class="text-center">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  
                                                $total=array();
                                                $suma_vertical	=	array();
                                                $suma_total		=	0;
												$cantidad_items_verticales=array();
												//pre($turnos);
												if($periodos_de_pago==2){
													unset($turnos["turno_intermedio"]);
												}
												foreach($plataformas as $k => $v){
													$plataforma_id	=	(int)$v->user_id;
													
                                            ?>
                                                    <tr id="tr_item2_<?php echo $k;?>">
                                                    	<td>
                                                        	<?php 
																print($v->primer_nombre);
															?>
                                                        </td>
                                                        <td>
                                                            <?php 
																foreach($masters[$plataforma_id] as $k2 => $v2){
																	print('<h5>'.$v2->nombre_master.'</h5>');
																	if(isset($nicknames[$v2->rel_plataforma_id])){	
																		foreach($nicknames[$v2->rel_plataforma_id] as $k3 =>$v3){
																			if(!empty(nombre($v3))){
																				$modelos_array[$plataforma_id][$k2][$k3]		=	array(	"modelo_id"=>$v3->user_id,
																																			"plataforma_id"=>$v2->id_plataforma,
																																			);
																				print('<div>'.nombre($v3).'</div>');	
																			}
																		}
																	}																	
																}
                                                            ?>
                                                        </td>
                                                        <?php 
                                                            $fila	=	array();
                                                            $suma_horizontal	=	array();
																for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
																	//pre($a);
																	if($periodos_de_pago==2){
																			$mes				=	($a<10)?"0".$a:$a;
																?>
                                                                    <td class="dias text-right">
                                                                       <?php 
																			foreach($masters[$plataforma_id] as $k2 => $v2){
																				print('<h5>&nbsp;</h5>');
																				if(isset($modelos_array[$plataforma_id][$k2])){
																					foreach($modelos_array[$plataforma_id][$k2] as $k3=>$v3){
																						$RP_X_Master	=	RP_X_Master($v3["modelo_id"],$v3["plataforma_id"],"Q1-".$mes."-".date("Y"));
																						echo '<div>';
																						if(!empty($RP_X_Master->json)){
																							$json_decode	=	json_decode($RP_X_Master->json);
																							if(is_object($json_decode)){
																								@$cantidad_items_verticales[$a][1]			+=	$json_decode->tokens;
																								@$suma_horizontal[$plataforma_id][$k2][$k3]	+=	$json_decode->tokens;
																								print(format($json_decode->tokens,false));	
																							}
																							
																						}else{
																							echo '---';	
																						}
																						echo '</div>';
																						//$RP_X_Plataforma	=	RP_X_Modelos($v3,);
																						//print('<div>'.$v3["modelo_id"].'</div>');
																					}
																				}
																			}
																		?>                                                                           
                                                                    </td>
                                                                    <td class="dias text-right">
                                                                	    <?php 
																			foreach($masters[$plataforma_id] as $k2 => $v2){
																				print('<h5>&nbsp;</h5>');
																				if(isset($modelos_array[$plataforma_id][$k2])){
																					foreach($modelos_array[$plataforma_id][$k2] as $k3=>$v3){
																						$RP_X_Master	=	RP_X_Master($v3["modelo_id"],$v3["plataforma_id"],"Q2-".$mes."-".date("Y"));
																						echo '<div>';
																						if(!empty($RP_X_Master->json)){
																							$json_decode	=	json_decode($RP_X_Master->json);
																							if(is_object($json_decode)){
																								@$cantidad_items_verticales[$a][2]			+=	$json_decode->tokens;
																								@$suma_horizontal[$plataforma_id][$k2][$k3]	+=	$json_decode->tokens;
																								print(format($json_decode->tokens,false));	
																							}
																							
																						}else{
																							echo '---';	
																						}
																						echo '</div>';
																					}
																				}
																			}
																		?>                                                              	
                                                                    </td>
                                                                <?php	
                                                                    }else{
                                                                ?>
                                                                    <th class="dias">S1</th>
                                                                    <th class="dias">S2</th>
                                                                    <th class="dias">S3</th>
                                                                    <th class="dias">S4</th>
                                                                <?php			
                                                                    }
                                                                }
                                                            ?>
                                                                <td class="text-right">
                                                                	<?php 
																		
																			foreach($masters[$plataforma_id] as $k2 => $v2){
																				print('<h5>&nbsp;</h5>');
																				if(isset($modelos_array[$plataforma_id][$k2])){
																					foreach($modelos_array[$plataforma_id][$k2] as $k3=>$v3){
																						
																						echo '<div>';
																							if(isset($suma_horizontal[$plataforma_id][$k2][$k3])){
																								print(format($suma_horizontal[$plataforma_id][$k2][$k3],false));			
																							}else{
																								echo '---';	
																							}
																						
																						
																						echo '</div>';
																					}
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
	                                        <th></th>
                                           	<th>Total</th>
                                            <?php 
                                                $suma_horizontal	=	0;
                                                for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
                                            ?>
                                                    <th class="text-right">
                                                        <?php
															print(format(@$cantidad_items_verticales[$a][1],false));
                                                        ?>
                                                    </th>
                                                    <th class="text-right">
                                                        <?php 
															print(format(@$cantidad_items_verticales[$a][2],false));
                                                        ?>
                                                    </th>
                                            <?php 
                                                    
                                                }
                                            ?>
                                            <th class="text-right">

                                            </th>
                                        </tfoot>
                                    </table>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="item4" aria-labelledby="item-tab" aria-expanded="false">                                
                                	<table class="table table-hover table-shorta" >
                                        <thead>
                                            <tr>
                                                <th ></th>
                                                <th ></th>
                                               
                                                <?php 
                                                    $fila	=	array(); 
                                                    for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
                                                ?>
                                                   		<th class="dias" colspan="2"><?php echo mes($a);?></th>
                                                <?php	
                                                    }
                                                ?>
                                                <th width="100" class="text-right"></th>
                                            </tr>
                                            <tr>
                                                <th width="200">Procesador</th>
                                                <th width="180">Máster</th>
                                               
                                                <?php 
                                                    
                                                    for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
                                                        if($periodos_de_pago==2){
                                                ?>
                                                            <th class="dias">Q1</th>
                                                            <th class="dias">Q2</th>
                                                <?php	
                                                        }else{
                                                ?>
                                                            <th class="dias">S1</th>
                                                            <th class="dias">S2</th>
                                                            <th class="dias">S3</th>
                                                            <th class="dias">S4</th>
                                                <?php			
                                                        }
                                                    }
                                                ?>
                                                <th width="100" class="text-center">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  
                                                $total=array();
                                                $suma_vertical	=	array();
                                                $suma_total		=	0;
												$cantidad_items_verticales=array();
												//pre($turnos);
												if($periodos_de_pago==2){
													unset($turnos["turno_intermedio"]);
												}
												foreach($procesadores as $k => $v){
													$procesador_id	=	(int)$v->id_cuenta;
													
                                            ?>
                                                    <tr id="tr_item2_<?php echo $k;?>">
                                                    	<td>
                                                        	<?php 
																print($v->Entidad);
																echo ' <b>('.$v->nro_cuenta.')</b>';
															?>
                                                        </td>
                                                        <td>
                                                            <?php 
																$mastersXProcesadores	=	GetMastersXProcesadores($v->id_cuenta);
																foreach($mastersXProcesadores as $k2 =>$v2){
																	$master_array[$procesador_id][$v2->rel_plataforma_id][]		= 	$v2;
																	print('<div>'.$v2->nombre_master.' (<b>'.$v2->primer_nombre.'</b>)</div>');	
																}
                                                            ?>
                                                        </td>
                                                        <?php 
                                                            $fila	=	array();
                                                            $suma_horizontal	=	array();
																for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
																	//pre($a);
																	if($periodos_de_pago==2){
																			$mes				=	($a<10)?"0".$a:$a;
																?>
                                                                    <td class="dias text-right">
                                                                       <?php 
																			foreach($master_array[$procesador_id] as $k2 => $v2){
																				$RP_X_Plataforma	=	RP_X_Master_X_Procesador($procesador_id,$k2,"Q1-".$mes."-".date("Y")); 
																				//pre($RP_X_Plataforma);																				
																			}
																		?>                                                                           
                                                                    </td>
                                                                    <td class="dias text-right">
                                                                	    <?php 
																			
																		?>                                                              	
                                                                    </td>
                                                                <?php	
                                                                    }else{
                                                                ?>
                                                                    <th class="dias">S1</th>
                                                                    <th class="dias">S2</th>
                                                                    <th class="dias">S3</th>
                                                                    <th class="dias">S4</th>
                                                                <?php			
                                                                    }
                                                                }
                                                            ?>
                                                                <td class="text-right">
                                                                	<?php 
																		
																			
																	?> 
                                                                </td>
                                                    </tr>
                                            <?php 
													
                                                }
                                            ?>
                                        </tbody>
                                        <tfoot>
	                                        <th></th>
                                           	<th>Total</th>
                                            <?php 
                                                $suma_horizontal	=	0;
                                                for($a=$inc_desde; $a<=$inc_hasta;$a++ ){
                                            ?>
                                                    <th class="text-right">
                                                        <?php
															print(format(@$cantidad_items_verticales[$a][1],false));
                                                        ?>
                                                    </th>
                                                    <th class="text-right">
                                                        <?php 
															print(format(@$cantidad_items_verticales[$a][2],false));
                                                        ?>
                                                    </th>
                                            <?php 
                                                    
                                                }
                                            ?>
                                            <th class="text-right">

                                            </th>
                                        </tfoot>
                                    </table>
                                </div>
							</div>                                                                                                            
						</div>                                                                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	$(document).ready(function(){
		$(".max-monto").each(function(){
			valor_maximo	=	0;
			$(this).find("td[data-value]").each(function(){
				if($(this).data("value") > valor_maximo){
					valor_maximo	=	$(this).data("value");	
				}	
			})
			$('[data-value="'+valor_maximo+'"]').css("font-weight","bold").css("color","#FF8000");
			//console.log(valor_maximo);		
		});
		$(".monto_horizonateles").each(function(k,v){
			if($(v).val()==0){
				$("#"+$(v).data("rel")).remove();
			}
		})
		$(".lightbox").click(function(){
			$(".modal-body").html($($(this).attr("href")).html());
		});	
		$(".total_tokens").each(function(k,v){
			if($(this).val()=="0"){
				$("#"+$(this).data("rel")).remove();
				$("#resumen"+$(this).data("rel")).remove();
				//console.log("#resumen"+$(this).data("rel"));
			}			
		})
	})
</script>