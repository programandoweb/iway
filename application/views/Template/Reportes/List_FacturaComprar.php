<?php
	$modulo	=  $this->ModuloActivo;
	$ciclo_informacion	=	get_cf_ciclos_pagos_new($this->user->id_empresa,0);
	$activos	=	array();
	$inactivos	=	array();
    $ciclo_abierto = get_cicloabierto();
?>

<div class="container">   
    <?php 
        echo TaskBar(array("name"		=>	array(	"title"	=>	"Gastos.",
                                                    "icono"=>'<i class="fas fa-bars"></i>',
                                                    "url"	=>	current_url()),
                            "add"		=>	array(	"title"	=>	"Agregar Gastos",
                                                    "url"	=>	base_url($this->uri->segment(1)."/Add_Factura2"),
                                                    "lightbox"=>true)
                                                                            
                    )
                );
    ?>            
    <div class="row justify-content-md-center">
        <div class="tab-pane active col-md-12" id="pendientes" role="tabpanel">
            <?php
                $count			=	0;
                $ciclo			=	$this->$modulo->fields;
                $suma_token			=	0;
                $suma_equivalencia	=	0;
                $total_debo = 0;
                $neto = 0;
            ?>
        <div class="bd-example bd-example-tabs" role="tabpanel">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-expanded="false">Actual</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="procesador-tab" data-toggle="tab" href="#procesador" role="tab" aria-controls="procesador" aria-expanded="true">Genera</a>
                </li>                           
            </ul>
            <div class="tab-content" id="myTabContent">
                <div role="tabpanel" class="tab-pane fade active show" id="home" aria-labelledby="home-tab" aria-expanded="false">
                    <table class="ordenar display table table-hover " ordercol=3 order="desc">
                        <thead>
                            <tr>
                                <th class="text-left"><b>Fecha</b></th>
                                <th class="text-center"><b>Tercero</b></th>
                                <th><b>Operación</b></th>
                                <th class="text-center"><b>Documento</b></th>
                                <th class="text-right"><b>Total</b></th>
                                <th class="text-right"><b>Neto</b></th>
                                <th width="60px" class="text-right"><b>Debo</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
        						$total_debito=0;
                                if(count($this->$modulo->result)>0){
                                    $cred = 0;
                                    foreach($this->$modulo->result as $v){
                                        if($v->tipo_documento != 6 && $v->ciclo_de_produccion == $ciclo_abierto->ciclo_produccion_id){
                                        $proveedor  =   json_decode($v->json);
                                        $pagos = pago_gasto($v->nro_documento);
                                        $detalle_contable = detalle_contable($v->nro_documento,array(),array("8"));
                                        $credito_pagos = 0;
                                        foreach ($pagos as $key => $value) {
                                            $credito_pagos +=$value->credito;
                                        }
                                        $credito_pagos = 0;
                                        if($v->tipo_documento==6 || $proveedor->moneda=='Pesos'){
                                            $var_debito     =   $v->debito_COP; 
                                            $total_debito   +=  $var_debito;
                                        }else{
                                            if(empty($proveedor->trm)){
                                                $trm = 1;
                                            }else{
                                                $trm = $proveedor->trm;
                                            }
                                            $var_debito     =   $v->debito * $trm;
                                            $total_debito   +=  $var_debito;
                                        }
                                        foreach ($pagos as $key => $value) {
                                            $credito_pagos += $value->credito;
                                        }
                                        if($v->tipo_documento == 6 && $v->estatus == 0){}else{
                                            $debo = @$detalle_contable[1]->credito - $credito_pagos;
                            ?>
                                        <tr <?php if($v->estatus==9){print('class="table-warning"');}?>>
                                            <td class="text-left">
                                                <?php
                                                    if(isset($proveedor->fecha_transaccion)){
                                                        echo $proveedor->fecha_transaccion;
                                                    }elseif($proveedor->fecha_emision){
                                                        echo $proveedor->fecha_emision;
                                                    }
                                                ?>	                                           
                                            </td>
                                            <td class="text-left">
                                            	<?php
                                                    if(empty($v->nombre_cliente)){ 
            											if(!empty($proveedor->Tercero)){
                                                            echo nombre(centrodecostos($proveedor->Tercero)); 
            											}elseif(!empty($proveedor->nombre_legal)){
                                                            echo $proveedor->nombre_legal;
                                                        }else{
            												echo entidadbancaria($proveedor->banco_id);
            											}
                                                    }else{

                                                        if(empty($v->nombre_cliente)){
                                                            print_r(nombre($v));
                                                        }else{
                                                            print_r($v->nombre_cliente);
                                                        }
                                                    }
        										?>
                                            </td>
                                            <td>
                                                <?php echo tipo_documento($v->tipo_documento); ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                    if($v->tipo_documento == 6){
                                                ?>
        										<a href="<?php echo base_url("Operaciones/RetirosTRMDetalles/".$v->consecutivo)?>" class="lightbox documentos" data-type="iframe" <?php echo ($debo == 0)?:'data-event="reload"'; ?> title="Detalle monetización" >
                                                <?php
                                                    }else{
                                                ?>
                                                <a class="btnss btn-primaryss documentos btn-mdss lightbox" title="Detalle de Gasto" data-type="iframe" <?php echo ($debo == 0)?:'data-event="reload"'; ?> href="<?php echo base_url($this->uri->segment(1)."/VerDetalleGasto/".$v->nro_documento)?>">
                                                <?php
                                                    }
                                                ?>                                     	
        	                                        <?php print_r($v->consecutivo);?>
                                                </a>
                                            </td>
                                            <td class="text-right">
                                                <?php 
        											echo format(($var_debito),false);
        										?>
                                            </td>
                                            <td class="text-right"><?php echo format(@$detalle_contable[1]->credito,false); $neto += @$detalle_contable[1]->credito; ?></td>
                                            <td class="text-right"><?php $total_debo += $debo;  echo format(@$debo,false); ?></td>
                                        </tr>
                            <?php		
                                            }
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
                            <th class="text-center"><b>Total</b></th>
                            <th class="text-right"> <?php echo format(@$total_debito,false);?></th>
                            <th class="text-right"><?php echo format(@$neto,false);?></th>
                            <th class="text-right"><?php echo format(@$total_debo,false);?></th>
                        </tfoot>
                    </table>
                </div>
                <div class="tab-pane fade" id="procesador" role="tabpanel" aria-labelledby="procesador-tab" aria-expanded="true">
                    <table class="ordenar display table table-hover " ordercol=3 order="desc">
                        <thead>
                            <tr>
                                <th class="text-left"><b>Fecha</b></th>
                                <th class="text-center"><b>Tercero</b></th>
                                <th><b>Operación</b></th>
                                <th class="text-center"><b>Documento</b></th>
                                <th class="text-right"><b>Total</b></th>
                                <th class="text-right"><b>Neto</b></th>
                                <th width="60px" class="text-right"><b>Debo</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $total_debito=0;
                                if(count($this->$modulo->result)>0){
                                    $cred = 0;
                                    foreach($this->$modulo->result as $v){
                                        if($v->tipo_documento != 6){
                                        $proveedor  =   json_decode($v->json);
                                        $pagos = pago_gasto($v->nro_documento);
                                        $detalle_contable = detalle_contable($v->nro_documento,array(),array("8"));
                                        $credito_pagos = 0;
                                        foreach ($pagos as $key => $value) {
                                            $credito_pagos +=$value->credito;
                                        }
                                        $credito_pagos = 0;
                                        if($v->tipo_documento==6 || $proveedor->moneda=='Pesos'){
                                            $var_debito     =   $v->debito_COP; 
                                            $total_debito   +=  $var_debito;
                                        }else{
                                            if(empty($proveedor->trm)){
                                                $trm = 1;
                                            }else{
                                                $trm = $proveedor->trm;
                                            }
                                            $var_debito     =   $v->debito * $trm;
                                            $total_debito   +=  $var_debito;
                                        }
                                        foreach ($pagos as $key => $value) {
                                            $credito_pagos += $value->credito;
                                        }
                                        if($v->tipo_documento == 6 && $v->estatus == 0){}else{
                            ?>
                                        <tr <?php if($v->estatus==9){print('class="table-warning"');}?>>
                                            <td class="text-left">
                                                <?php
                                                    if(isset($proveedor->fecha_transaccion)){
                                                        echo $proveedor->fecha_transaccion;
                                                    }elseif($proveedor->fecha_emision){
                                                        echo $proveedor->fecha_emision;
                                                    }
                                                ?>                                             
                                            </td>
                                            <td class="text-left">
                                                <?php
                                                    if(empty($v->nombre_cliente)){ 
                                                        if(!empty($proveedor->Tercero)){
                                                            echo nombre(centrodecostos($proveedor->Tercero)); 
                                                        }elseif(!empty($proveedor->nombre_legal)){
                                                            echo $proveedor->nombre_legal;
                                                        }else{
                                                            echo entidadbancaria($proveedor->banco_id);
                                                        }
                                                    }else{

                                                        if(empty($v->nombre_cliente)){
                                                            print_r(nombre($v));
                                                        }else{
                                                            print_r($v->nombre_cliente);
                                                        }
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo tipo_documento($v->tipo_documento); ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                    if($v->tipo_documento == 6){
                                                ?>
                                                <a href="<?php echo base_url("Operaciones/RetirosTRMDetalles/".$v->consecutivo)?>" class="lightbox documentos" data-type="iframe" data-event="reload" title="Detalle monetización" >
                                                <?php
                                                    }else{
                                                ?>
                                                <a class="btnss btn-primaryss documentos btn-mdss lightbox" title="Detalle de Gasto" data-type="iframe" data-event="reload" href="<?php echo base_url($this->uri->segment(1)."/VerDetalleGasto/".$v->nro_documento)?>">
                                                <?php
                                                    }
                                                ?>                                      
                                                    <?php print_r($v->consecutivo);?>
                                                </a>
                                            </td>
                                            <td class="text-right">
                                                <?php 
                                                    echo format(($var_debito),false);
                                                ?>
                                            </td>
                                            <td class="text-right"><?php echo format(@$detalle_contable[1]->credito,false); $neto += @$detalle_contable[1]->credito; ?></td>
                                            <td class="text-right"><?php $debo = @$detalle_contable[1]->credito - $credito_pagos; $total_debo += $debo;  echo format(@$debo,false); ?></td>
                                        </tr>
                            <?php       
                                            }
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
                            <th class="text-center"><b>Total</b></th>
                            <th class="text-right"> <?php echo format(@$total_debito,false);?></th>
                            <th class="text-right"><?php echo format(@$neto,false);?></th>
                            <th class="text-right"><?php echo format(@$total_debo,false);?></th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
