<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php 
    $row        =   $this->Reportes->medeben;
    // Se extraen los datos de los Hoorarios ya aprobados
    //$honorarios_aprobados = get_rp_honorarios_modelos_aprobados();
    // Se introducen los datos del pago de los honorarios al result
    //pre($honorarios_aprobados);
    /*$debo_honorarios = new stdClass;
    $array_descuentos = array();  
    foreach ($honorarios_aprobados as $k2 => $v2){
        $json = json_decode($v2->data_json);
        foreach ($json->restante as $k4 => $v4) {
            if($v4 > 0){
                $debo_honorarios->tipo_documento    = $v2->tipo_documento;
                $debo_honorarios->total             = $v4;
                $debo_honorarios->fecha             = $v2->fecha;
                $debo_honorarios->nombre_cliente    = nombre($json->data_user);
                $debo_honorarios->consecutivo       = $v2->consecutivo;
                $debo_honorarios->abreviacion       = centrodecostos($v2->centro_de_costos)->abreviacion;
                $debo_honorarios->estatus           = $v2->estatus;
                $debo_honorarios->modelo_id         = $v2->modelo_id;
                $array_descuentos[] = $debo_honorarios;
            }
        } 
    }
    $me_deben = array_merge($row['pendiente'],$array_descuentos);*/
?>
<?php if($this->user->type == "root"){ ?>
<div style="height: 40px;"></div>
<div class="container">
	<div class="row">	
    	<div class="col-md-12">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="internacionales-tab" data-toggle="tab" href="#dos" role="tab" aria-controls="dos" aria-expanded="true">Debo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="internacionales-tab" data-toggle="tab" href="#tres" role="tab" aria-controls="tres" aria-expanded="true">Me deben</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div role="tabpanel" class="tab-pane fade active show" id="dos" aria-labelledby="dos-tab" aria-expanded="false">
                <table class="ordenar display table table-hover">
                    <thead>
                        <tr>
                            <th><b>Fecha</b></th>
                            <th><b>Tercero</b></th>
                            <th><b>Tipo</b></th>
                            <th class="text-center"><b>Documento</b></th>
                            <th class="text-right"><b>Monto</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
							$total_debo=0;
                            if(count($this->Reportes->debo)>0){
                                foreach($this->Reportes->debo as $v){
									$proveedor		=	json_decode($v->json);
									$cajas			=	Debo(array("modelo_id"=>$v->modelo_id));
									$procesador		=	Debo(array("modelo_id"=>$v->modelo_id),array(2,8,14),array("111010"));
									$saldo_actual	=	$v->debito - $cajas - $procesador;
									if($saldo_actual>0){
                        ?>
                                    <tr>
                                        <td>
                                            <?php 
												if(!empty($proveedor->fecha_emision)){
													print_r($proveedor->fecha_emision);
												}else{
													 print_r($v->fecha);	
												}
											?>	
                                        </td>
                                        <td>
											<?php
                                                if(!empty($proveedor->nombre_legal)){
                                                    echo $proveedor->nombre_legal;
                                                }else{
                                                    echo nombre(centrodecostos($proveedor->modelo_id));
                                                }
                                            ?>	                                           
                                        </td>
                                        <td>
											<?php 
												
												print(tipo_documento($v->tipo_documento));
											?>	                                           
                                        </td>
                                        <td class="text-center">
                                            <?php
                                                //pre($v->codigo_contable);
                                                /*531510*/
                                                if($v->tipo_documento== 6 || $v->tipo_documento== 8){
                                            ?>
                                                    <a class="btnss btn-primaryss btn-mdss documentos lightbox" title="Detalle de Gasto" data-type="iframe" href="<?php echo base_url("Reportes/VerDetalleGasto/".$v->nro_documento)?>"> 
                                                        <?php print_r($v->nro_documento);?>
                                                    </a>
                                            <?php       
                                                }else if($v->tipo_documento == 13){
                                            ?>
                                                    <a class="btnss btn-primaryss btn-mdss documentos lightbox lightbox" title="Detalle de Gasto" data-type="iframe" href="<?php echo base_url("Usuarios/HonorariosModelo/".$v->modelo_id)?>"> 
                                                        <?php print_r($v->nro_documento);?>
                                                    </a>
                                            <?php       
                                                }else if($v->tipo_documento == 31){
                                            ?>
                                                    <a class="btnss btn-primaryss documentos btn-mdss lightbox" title="Detalle otros ingresos" data-event="reload" data-type="iframe" href="<?php echo base_url("Reportes/VerDetalleGasto2/".$v->consecutivo.'/iframe')?>">
                                                        <?php print_r($v->nro_documento);?>
                                                    </a>
                                            <?php       
                                                }                                               
                                            ?>
                                        </td>
                                        <td class="text-right">
                                            <?php 
                                                $pagos      =   @getMovimientosGeneral($v->consecutivo,NULL,"13",$proveedor->contrapartida,NULL,$json->cliente_id); 
                                                $pagos_otros_ingresos = 0;
                                                foreach ($pagos as $k6 => $v6) {
                                                    $pagos_otros_ingresos += $v6->debito;
                                                }
                                                echo format($saldo_actual);
                                                $total_debo+=$saldo_actual;
                                            ?>
                                        </td>
                                    </tr>
                        <?php		
									}
                                }
                            }else{
                        ?>
                            
                        <?php		
                            }
                        ?>
                    </tbody>
                    <tfoot>
                    	<th></th>
                        <th></th>
                        <th></th>
                        <th>Total</th>
                        <th class="text-right"><?php echo  format($total_debo);?></th>
                    </tfoot>
                </table>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="tres" aria-labelledby="tres-tab" aria-expanded="false">
                <table class="ordenar display table table-hover">
                    <thead>
                        <tr>
                            <th><b>Fecha</b></th>
                            <th><b>Tercero</b></th>
                            <th class="text-center"><b>Sucursal</b></th>
                            <th width="150" class="text-center"><b>Documento</b></th>
                            <th width="100" class="text-right"><b>Monto</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            //pre($row['pendiente']);
                            $sum_total=0;
                            $sum_total_pendiente=0;
                            if(count($me_deben)>0){
                                foreach($me_deben as $k => $v){
                        ?>
                                    <tr>
                                        <td>
                                            <?php print($v->fecha);?>                              
                                        </td>
                                        <td>
                                            <?php if(@$v->tipo_documento == 12){ ?>
                                            <a class="lightbox documentos" title="Honorarios de <?php echo $v->nombre_cliente;?>" data-type="iframe" data-event="reload" href="<?php echo base_url("Usuarios/HonorariosModeloAprobados/".$v->modelo_id."/".$v->consecutivo."/".$v->estatus)?>">
                                            <?php }else{ ?>
                                            <a class="btnss btn-primaryss btn-mdss " title="Factura de Venta" data-type="iframe" href="<?php echo base_url($this->uri->segment(1)."/VerFactura/".$v->consecutivo."/sinmarco")?>"> 
                                            <?php } ?>           
                                            <?php print($v->nombre_cliente);?>                      
                                            </a>                                                  
                                        </td>
                                        <td class="text-center">
                                            <?php echo $v->abreviacion;?>                                              
                                        </td>
                                        <td class="text-center">
                                            <?php if(@$v->tipo_documento == 12){ ?>
                                            <a class="lightbox documentos" title="Honorarios de <?php echo $v->nombre_cliente;?>" data-type="iframe" data-event="reload" href="<?php echo base_url("Usuarios/HonorariosModeloAprobados/".$v->modelo_id."/".$v->consecutivo."/".$v->estatus); ?>">
                                            <?php }else{ ?>
                                            <a class="btnss btn-primaryss btn-mdss " title="Factura de Venta" data-type="iframe" href="<?php echo base_url($this->uri->segment(1)."/VerFactura/".$v->consecutivo."/sinmarco")?>"> 
                                            <?php } ?>                                              
                                              <?php print_r($v->consecutivo);?>
                                            </a>
                                        </td>
                                        <td class="text-right">
                                            <?php
                                                if(@$v->tipo_documento == 12){
                                                    $sum_total_pendiente    +=$v->total;
                                                    echo $v->total;
                                                }else{
                                                    $sum_total_pendiente    +=$v->total-sum(get_registro_contable($v->consecutivo,'NOA',"'5'",NULL,"t1.consecutivo"),'credito');
                                                    print(format($v->total-sum(get_registro_contable($v->consecutivo,'NOA',"'5'",NULL,"t1.consecutivo"),'credito'),true));
                                                }
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
                        <th></th>
                        <th></th>
                        <th></th>
                        <th class="text-right">Total</th>
                        <th class="text-right"><?php echo format($sum_total_pendiente,true);?></th>
                    </tfoot>
                </table>
            </div>
        </div>            
	</div>
</div>            
<?php }else{ ?>




<div class="container text-center welcome mt-2">
	<img src="<?php echo DOMINIO?>images//webcamplus-png.png" class="rounded mx-auto d-block" alt="..." />
	<h1 class="font-weight-700 text-uppercase">Bienvenidos al Sistema de Gestión <?php echo SEO_NAME; ?></h1>
    <h2>Contáctanos</h2>
    <h5>sistemas@webcamplus.com.co</h5>
</div>
<?php } ?>