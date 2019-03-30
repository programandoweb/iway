<?php
	$modulo		=	$this->ModuloActivo;
	if($this->user->type=='Modelos' || empty($this->$modulo->result)){
		//redirect(base_url("Reportes/FacturaVentas"));	
		echo '<script>parent.location.reload();</script>';
		return;	
	}
	$operaciones_json	=	get_operaciones_json($this->uri->segment(3));
	if($opciones_factura	=	getOpcionesFacturacion()->json){
		$opciones_factura	=	json_decode($opciones_factura);
	}
?>
<input id="estatus" type="hidden" value="<?php echo $this->$modulo->result->estatus?>" />
<div class="container text-center" id="pagado">
	<h2 class="font-weight-700 text-uppercase orange">
	<?php 
		//pre($this->$modulo->result);
		 if(checkFacturaPagada($this->uri->segment(3))){
			echo '<input id="nuevo_estatus" type="hidden" value="Pagada" />';
			echo 'Pagada';
		 }else if($this->$modulo->result->estatus==9){
			echo '<input id="nuevo_estatus" type="hidden" value="Anulada" />';
			echo 'Anulada';
		 }else{
			echo '<input id="nuevo_estatus" type="hidden" value="Pendiente" />';
			echo 'Pendiente';
		 } 
	?>
    </h2>
</div>
<div class="container" id="factura">
	<div class="row justify-content-md-center">
    	<div class="col">
            <?php 
                $submenu = array(  "name"      =>  array(  "title" =>  "Datos del Cliente",
                                                                    "url"   =>  current_url()),
                                            "back"      =>  ($this->uri->segment(4)=='iframe')?true:false,
                                            "inbox"     =>  array(  "title" =>  "Recibir pagos",
                                                                    "url"   =>  base_url("Reportes/VerFactura/".$this->uri->segment(3)."/recibir")),
                                            "anular"    =>  array(  "title" =>  "Anular Pagos",
                                                                    "url"   =>  site_url($this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/anular/'.$this->uri->segment(5)),
                                                                    "icono" =>  '<i class="fas fa-trash-alt"></i>',
                                                                    "atributo" => "class='anular'",
                                                                    "confirm"=>true),
                                            "pdf"       =>  array(  "url"      =>  base_url($this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3)).'/PDF',
                                                                    "target"   =>  true
                                                            ),  
                                            //"excel"     =>  true,
                                            "pageleft"  =>  true,
                                            "pageright" =>  true
                    
                                );
                $honorarios_aprobados = get_rp_honorarios_modelos_aprobados();
                foreach ($honorarios_aprobados as $k8 => $v8) {
                    $Honorarios_modelo = json_decode($v8->data_json);
                    foreach ($Honorarios_modelo->HonorariosModelos as $k9 => $v9) {
                        $items_factura_x_nickname   =   items_factura_x_nickname($v9->nickname_id,1);
                        $factura                    =   @$items_factura_x_nickname->consecutivo;
                        if(@$factura == $this->uri->segment(3)){
                            unset($submenu['anular']);
                        }
                    }
                }
                $movimientos        =   array_merge(getMovimientos($this->uri->segment(3),array("111010","130510")),$honorarios_aprobados);
				echo TaskBar($submenu);
			?>
            <div id="imprimeme">
            	<?php 
					$filename	=	$this->$modulo->result->abreviacion.'FV'.$this->uri->segment(3);
				?>
                <input type="hidden" id="filename"  value="<?php echo $filename;?>"/>
                <div class="section__">
                    <div class="row ">
                        <div class="col-md-2">
                           Cliente
                        </div>
                        <div class="col-md-4">
                            <b>
                                <?php 
									if(!$this->$modulo->result->next){
									?>
                                    	<input type="hidden" id="next" value="1" />
                                    <?php	
									}
                                    echo $this->$modulo->result->nombre_cliente;
                                    //pre($this->$modulo->result);
                                ?>
                            </b>
                        </div>
                        <div class="col-md-3 ">
                           <?php print($opciones_factura->nombreDocumentoFac);?>
                        </div>
                        <div class="col-md-3 text-right">
                            <b>
                                <?php 
									
									echo $this->$modulo->result->abreviacion.' FV '.$this->uri->segment(3);
								?>
                            </b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                           Dirección
                        </div>
                        <div class="col-md-4">
                            <b>
                                <?php echo str_replace($this->$modulo->result->Pais,"",$this->$modulo->result->Direccion)?>
                            </b>
                        </div>
                        <div class="col-md-3 ">
                           Ciclo de producción
                        </div>
                        <div class="col-md-3 text-right">
                            <b>
                                <?php 
                                    echo $this->$modulo->result->ciclo_de_produccion
                                ?>
                            </b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                           País
                           <br />
                           ID Cliente
                        </div>
                        <div class="col-md-4 ">
                            <b>
                                <?php echo $this->$modulo->result->Pais?>
                            </b>
                            <br />
                            <b>
                                <?php echo $this->$modulo->result->Nit?>
                            </b>
                        </div>
                        <div class="col-md-3 ">
                           Expedida
                           <br />
                           Vence
                        </div>
                        <div class="col-md-3 text-right">
                            <b>
                                <?php echo $this->$modulo->result->fecha?>
                            </b>
                            <br />
                            <b>
                                <?php echo calculo_fechas($this->$modulo->result->fecha,'+5'); ?>
                            </b>
                        </div>
                    </div>
                </div> 
                <div class="section">           
                    <div class="row ">
                        <div class="col-md-12">
                            <div class="bd-example bd-example-tabs" role="tabpanel">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-expanded="false">Detalle Factura</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="procesador-tab" data-toggle="tab" href="#procesador" role="tab" aria-controls="procesador" aria-expanded="true">Procesador(es)</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="registrocontable-tab" data-toggle="tab" href="#registrocontable" role="tab" aria-controls="registrocontable" aria-expanded="true">Registro Contable</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="relacionpagos-tab" data-toggle="tab" href="#relacionpagos" role="tab" aria-controls="relacionpagos" aria-expanded="true">Relación Pago</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="movimientos-tab" data-toggle="tab" href="#movimientos" role="tab" aria-controls="movimientos" aria-expanded="true">Movimientos</a>
                                    </li>   
                                    <li class="nav-item">
                                        <a class="nav-link" id="observaciones-tab" data-toggle="tab" href="#observaciones" role="tab" aria-controls="observaciones" aria-expanded="true">Observaciones</a>
                                    </li>                            
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div role="tabpanel" class="tab-pane fade active show" id="home" aria-labelledby="home-tab" aria-expanded="false">
                                        <table class="tablesorter table table-hover">
                                            <thead>
                                                <tr>
                                                    <th width="100" class="text-center"><b>Sucursal</b></th>
                                                    <th><b>Tercero</b></th>
                                                    <th width="100" class="text-center">Procesador</th>
                                                    <th width="100" class="text-center"><b>Equivalencia</b></th>
                                                    <th width="100" class="text-center"><b>Producción</b></th>
                                                    <th width="100" class="text-center"><b>Monto</b></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $plataformas_array	=	array();
                                                    $items		=	items_factura_contable($this->uri->segment(3),array("414580","130510"),array("tipo_documento"=>"1"));
                                                    $tokens		=	0;
                                                    $sum_factura=0;
                                                    $cuentas	=	array();
                                                    foreach($items as $k =>$v){
                                                        
                                                    ?>
                                                    <tr>
                                                        <td class="text-center">
                                                            <?php 
                                                                print_r($v->abreviacion);
                                                            ?>
                                                        </td>
                                                        <td  >
                                                            
                                                            <?php 
                                                                /*
																	BUSCAR POR CICLO DE PRODUCCION Y MODELO
																	SI YA HAY UNA NÓMINA APROBADA O PAGADA
																*/
                                                                $json	=	json_decode($v->json);
                                                                echo nombre($v);
																if(comprobar_honorarios_pagos($this->$modulo->result->ciclo_de_produccion,$v->modelo_id)){
																	echo '	<script>
																				$(document).ready(function(){
																					$("a.confirm").remove();
																				})
																			</script>';	
																}
                                                            ?>
                                                            <b>(<?php print($json->nickname);?>)</b>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php 
                                                                echo substr($v->nro_cuenta,0,4);
                                                            ?>
                                                        </td>
                                                        <td  class="text-center">
                                                            <?php 
                                                                print_r($json->equivalencia);
                                                            ?>
                                                        </td>
                                                        <td  class="text-right">
                                                            <?php 
                                                                //pre($json);
                                                                if($v->codigo_contable=='414580'){
                                                                    print_r(format($json->tokens,false));
                                                                    $tokens		=	$tokens+$json->tokens;
                                                                }else{
                                                                    echo "0";	
                                                                }
                                                            ?>
                                                        </td>
                                                        <td width="100" class="text-right">
                                                            <?php 
                                                                //echo format(debito_credito($v),true);
                                                            ?>
                                                            <?php
                                                                $monto_global_usd	=	json_decode($v->json)->monto_global_usd;
                                                                echo format($monto_global_usd,true);
                                                                $sum_factura+=$monto_global_usd;
                                                                @$cuentas[$v->nro_cuenta]	+=	$monto_global_usd;
                                                            ?>
                                                        </td>
                                                    </tr>
                                                <?php }?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right"><b>Total</b></td>
                                                    <td class="text-right"><b><?php echo  format($tokens,false);?></b></td>
                                                    <td class="text-right"><b><?php echo format($sum_factura,true);?></b></td>
                                                </tr>
                                            </tfoot>
                                        </table>                        
                                    </div>
                                    <div class="tab-pane fade" id="procesador" role="tabpanel" aria-labelledby="procesador-tab" aria-expanded="true">
                                        <table class="tablesorter table table-hover">
                                            <thead>
                                                <tr>
                                                    <th ><b>Procesador</b></th>
                                                    <th width="100"  class="text-left"><b>Moneda </b></th>
                                                    <th width="100" class="text-center">Monto</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                        <?php 
                                                $banco_monto	=	0;
                                                $items		=	items_procesadores_contable($this->uri->segment(3),array("tipo_documento"=>"1"));
                                                foreach( $items as $k => $v){
                                                    if(isset($cuentas[$v->nro_cuenta])){
                                        ?>
                                                <tr>
                                                    <td><?php print(entidadbancaria($v->entidad_bancaria));?> <b>(<?php print($v->nro_cuenta);?>)</b></td>
                                                    <td  class="text-left">Dólares</td>
                                                    <td class="text-right">
                                                        <?php 
                                                            print_r(format($cuentas[$v->nro_cuenta],true)); 
                                                            $banco_monto += $cuentas[$v->nro_cuenta];
                                                        ?>
                                                    </td>
                                                </tr>                                            	
                                        <?php		}			
                                                }
                                        ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                   
                                                    <td class="text-right"><b></b></td>
                                                    <td class="text-left"><b>Total</b></td>
                                                    <td class="text-right"><b><?php echo format($sum_factura,true);?></b></td>
                                                </tr>
                                            </tfoot>
                                        </table> 
                                        <input type="hidden" id="credito" value="<?php #echo $this->$modulo->result->total_facturado_dolar;?><?php #echo $banco_monto;?>" />
                                        <input type="hidden" id="credito_cuenta_contable" value="<?php #echo get_monto_codigo_contable_x_factura($this->$modulo->result->nro_documento)->credito;?>" />
                                    </div>
                                    <div class="tab-pane fade" id="registrocontable" role="tabpanel" aria-labelledby="registrocontable-tab" aria-expanded="true">
                                        <table class="tablesorter table table-hover">
                                            <thead>
                                                <tr>
                                                    <th width="100"><b>Cuenta</b></th>
                                                    <th><b>Descripción</b></th>
                                                    <th width="100" class="text-center"><b>Moneda</b></th>
                                                    <th width="100" class="text-center"><b>Débito</b></th>
                                                    <th width="100" class="text-center"><b>Crédito</b></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $debito		=	0;
                                                    $credito	=	0;
                                                    foreach(get_registro_contable_new($this->uri->segment(3)) as $k =>$v){
													if($v->codigo_contable=='414580' || $v->codigo_contable=='130510'){
														$v->moneda_de_pago='USD';	
													}else{
														$v->moneda_de_pago='COP';
													}		
												?>
                                                <tr>
                                                    <td><?php print_r($v->codigo_contable);?></td>
                                                    <td><?php print_r($v->cuenta_contable);?></td>
                                                    <td class="text-center"><?php print_r($v->moneda_de_pago);?></td>
                                                    <td class="text-right">
                                                        <?php 
															//pre($v);
															$debito	+=	$v->debito; 	//+ 	round($v->debito,2); 	
															print_r(format($v->debito));
                                                        ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php 	
                                                                $credito	=	$credito 	+ 	round($v->credito,2); 	
                                                                print_r(format($v->credito));
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php }?>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th class="text-right"><b>Sumas Iguales</b></th>
                                                    <th class="text-right"><?php echo format($debito);?></th>
                                                    <th class="text-right">
                                                        <?php echo format($credito);?> 
                                                    </th>
                                                </tr>
                                            </tbody>                        
                                        </table>                                	
                                    </div>
                                    <div class="tab-pane fade" id="relacionpagos" role="tabpanel" aria-labelledby="relacionpagos-tab" aria-expanded="true">
                                        <table class="tablesorter table table-hover">
                                            <thead>
                                                <tr>
                                                    <th width="150"><b>Fecha</b></th>
                                                     <th><b>Documento</b></td>
                                                    <th class="text-center"><b>Consecutivo</b></th>
                                                    <th width="100" class="text-center"><b>Valor</b></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    //$debito		=	0;
                                                    $credito	=	0;
                                                    foreach(get_registro_contable($this->uri->segment(3),'NOA',"'5'",NULL,"t1.consecutivo") as $k =>$v){
                                                        $credito	+=	$v->credito;									
                                                ?>
                                                        <tr>
                                                            <td width="150">
                                                                <?php print_r($v->fecha);?>
                                                            </td>
                                                            <td><b><?php print_r(tipo_documento($v->tipo_documento));?></b></td>
                                                            <td class="text-center">
                                                            	<input type="hidden" class="registro_contable"  />
                                                                <a class="documentos" title="Comprobante bancario No. <?php echo $v->consecutivo;?>" href="<?php echo base_url($this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$v->consecutivo.'/detalle_contable/'.$this->uri->segment(3).'/iframe');?>">
                                                                    <?php print_r($v->consecutivo);?>
                                                                </a>
                                                            </td>
                                                            <td class="text-right"><b><?php print_r(format($v->credito,TRUE));?></b></td>
                                                        </tr>
                                                 <?php }?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td></td>
                                                    <td><b>Saldo Pendiente</b></td>
                                                    <td><input id="pendientes" type="hidden" value="<?php echo @$debito - @$credito;?>" /></td>
                                                    <td class="text-right"><b><?php echo format($debito - $credito,true);?></b></td>
                                                </tr>
                                            </tfoot>
                                        </table>                         	
                                    </div>
                                    <div class="tab-pane fade" id="movimientos" role="tabpanel" aria-labelledby="movimientos-tab" aria-expanded="true">
                                        <table class="tablesorter table table-hover">
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
                                                    foreach($movimientos as $k => $v){
                                                        if($v->tipo_documento != 1 && $v->tipo_documento != 12){
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
																	if($v->estatus==9){
																		echo ' <b>(Anulado)</b>';			
																	}
																?>
															</td>
                                                            <td class="text-center">
                                                                <?php if($v->tipo_documento==5){?>
                                                                <a class="documentos"  title="Comprobante bancario No. <?php echo $v->consecutivo;?>" href="<?php echo base_url($this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$v->consecutivo.'/detalle_contable/'.$this->uri->segment(3).'/iframe');?>">
                                                                <?php }else if($v->tipo_documento==13){?>
                                                                        <a class="documentos" title="Honorarios de <?php echo nombre($v);?>" href="<?php echo base_url("Usuarios/HonorariosModeloAprobados/".$v->modelo_id."/".$v->consecutivo."/".$v->estatus."/Iframedes")?>">
                                                                    <?php }?>
                                                                    <?php print($v->consecutivo);?>
                                                                </a>
                                                            </td>
                                                            <td><?php print($v->primer_nombre);?> <?php print($v->primer_apellido);?></td>
                                                            <td class="text-right">
                                                                <?php
																	if($v->estatus==9){
																		echo '<div class="tachado">';
																	}
                                                                    if($v->tipo_documento == 13){
                                                                        echo format(json_decode($v->data_json)->pago_global,false);
                                                                    }else if($v->codigo_contable=='111010'){
                                                                        echo format($v->debito,true);
                                                                    }else if($v->codigo_contable=='130510'){
                                                                        echo format($v->debito,true);
                                                                    } 
																	if($v->estatus==9){
																		'</div>';
																	}
                                                                ?>
                                                            </td>
                                                        </tr>
                                                <?php
                                                        }
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                        <?php #echo html_logs('rp_operaciones',$this->uri->segment(3));?>
                                    </div>
                                    <div class="tab-pane fade" id="observaciones" role="tabpanel" aria-labelledby="movimientos-tab" aria-expanded="true">
                                        <div class="col-md-12">
                                            <div style=" width:100%; height:20px;"></div>
                                            <?php 
                                           		HtmlObservaciones();
                                            ?>
                                        </div>
                                        <?php #echo Observaciones(current_url()); ?>
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
<script>
	$(document).ready(function(){
		if($("#next").length>0){
			$('.pageright').remove();
		}
		if($(".registro_contable").length>0){
			$('[title="Anular Pagos"]').remove();
		}
		if($("#nuevo_estatus").val()=='Pagada'){
			//$("#pagado").html('<h2 class="font-weight-700 text-uppercase orange">PAGADO</h2>');
			$(".inbox").remove();
			$(".anular").remove();
			$(".confirm").remove();				
		}
		if($("#nuevo_estatus").val()=='Anulada'){
			//$("#pagado").html('<h2 class="font-weight-700 text-uppercase orange">ANULADA</h2>');
			//$("#navbarNavDropdown").remove();
			$(".inbox").remove();
			$(".anular").remove();
			$(".confirm").remove();	
			$("#excel").remove();	
		}
	});
</script>