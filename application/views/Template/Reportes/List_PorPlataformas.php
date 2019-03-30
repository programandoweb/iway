<?php
	$modulo				= 	$this->ModuloActivo;
	$trm				=	get_cf_ciclos_pagos_new($this->user->id_empresa,0);	
	$centro_de_costos	=	$this->user->centro_de_costos;
	$plataformas		=	GetPlataformas();
	$periodos_de_pago	=	centrodecostos($this->user->id_empresa)->periodo_pagos;
	$cantidad_a_mostrar	=	($periodos_de_pago==2)?4:3;
    $calculo_desde      =   (int)calculo_meses(date("Y-m-d"),'-'.$cantidad_a_mostrar,'m');
    $calculo_hasta      =   $calculo_desde  +   $cantidad_a_mostrar;
    if($calculo_hasta > 12){
        $inc_desde = array($calculo_desde,1);
        $inc_hasta = array(12,$calculo_hasta%12);
    }else{
        $inc_desde = $calculo_desde;
        $inc_hasta = $calculo_hasta;
    }
	$sucursales			=	get_sucursales();
	
	
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
       	 	<?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Reportes X Plataformas.",
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
                                    <a class="nav-link active" id="item1-tab" data-toggle="tab" href="#item1" role="tab" aria-controls="item" aria-expanded="false">Producción (<b>Tokens</b>)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="item2-tab" data-toggle="tab" href="#item2" role="tab" aria-controls="item" aria-expanded="false">Producción (<b>USD</b>)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="item3-tab" data-toggle="tab" href="#item3" role="tab" aria-controls="item" aria-expanded="false">Producción (<b>COP</b>)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="item4-tab" data-toggle="tab" href="#item4" role="tab" aria-controls="item" aria-expanded="false">Promedios (<b>Activos</b>)</a>
                                </li>
							</ul>
                            <div class="tab-content" id="myTabContent">
                              	<div role="tabpanel" class="tab-pane fade active show" id="item1" aria-labelledby="item-tab" aria-expanded="false">                                
                                    <table class="table table-hover table-shorta" >
                                        <thead>
                                            <tr>
                                                <th width="200"></th>
                                                <th width="50"></th>
                                                <?php 
                                                    $fila	=	array(); 
                                                    foreach ($inc_desde as $k1 => $v1) {
                                                        for($a=$v1; $a<=$inc_hasta[$k1];$a++ ){
                                                ?>
                                                    <th class="dias" colspan="2"><?php echo mes($a);?></th>
                                                <?php
                                                        }	
                                                    }
                                                ?>
                                                <th width="100" class="text-right"></th>
                                            </tr>
                                            <tr>
                                                <th width="200">Plataformas</th>
                                                <th >Sucursal</th>
                                                <?php 
                                                    
                                                    foreach ($inc_desde as $k2 => $v2) {
                                                        for($a=$v2; $a<=$inc_hasta[$k2];$a++ ){
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
                                                    }
                                                ?>
                                                <th width="100" class="text-center">Promedio (<b>Tokens</b>)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  
                                                $total=array();
                                                $suma_vertical	=	array();
                                                $suma_total		=	0;
												$cantidad_items_verticales=array();
                                                foreach($plataformas as $k => $v){
													$cantidad_items_horizontales[$k]=0;
													
                                                    if($v->estado==1){
                                            ?>
                                                    <tr id="tr_item2_<?php echo $k;?>">
                                                        <td>
                                                            <?php 
                                                                print($v->nombre_legal);
                                                              //  pre($v);
                                                            ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php
                                                                print($v->abreviacion);
                                                            ?>
                                                        </td>
                                                        <?php 
                                                            $fila	=	array();
                                                            $suma_horizontal	=	0;
                                                            foreach ($inc_desde as $k3 => $v3) {
                                                                for($a=$v3; $a<=$inc_hasta[$k3];$a++ ){
                                                                    if($periodos_de_pago==2){
                                                                        $mes				=	($a<10)?"0".$a:$a;
                                                                        $RP_X_Plataforma		=	RP_X_Plataforma($v->plataforma_id,"Q1-".$mes."-".date("Y"));
                                                        ?>
                                                                <td class="dias text-right">
                                                                    <?php 
																				
																		@$suma_vertical[$a][1]		+=	(@$RP_X_Plataforma->credito / 0.05);
                                                                        @$suma_horizontal			+=	(@$RP_X_Plataforma->credito / 0.05);
                                                                        if(@$RP_X_Plataforma->credito>0){
                                                                            print(format((@$RP_X_Plataforma->credito / 0.05),false));
																			@$cantidad_items_verticales[$a][1]	=	@$cantidad_items_verticales[$a][1] + 1;
																			@$cantidad_items_horizontales[$k]++;
                                                                        }else{
                                                                            echo '---';	
                                                                        }
                                                                        echo @$suma_horizontal[$a];
                                                                    ?>                                                                            
                                                                </td>
                                                                <td class="dias text-right">
                                                            <?php
                                                                    $RP_X_Plataforma			=	RP_X_Plataforma($v->plataforma_id,"Q2-".$mes."-".date("Y"));
																	@$suma_vertical[$a][2]		+=	(@$RP_X_Plataforma->credito / 0.05);
                                                                    @$suma_horizontal			+=	(@$RP_X_Plataforma->credito / 0.05);
                                                                    if(@$RP_X_Plataforma->credito>0){
                                                                        print(format((@$RP_X_Plataforma->credito / 0.05),false));
																		$cantidad_items_horizontales[$k]++;
																		@$cantidad_items_verticales[$a][2]	=	@$cantidad_items_verticales[$a][2] + 1;
                                                                    }else{
                                                                        echo '---';	
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
                                                            }
                                                        ?>
                                                        <td class="text-right">
	                                                        <input type="hidden" class="monto_horizonateles" value="1<?php echo @$suma_horizontal;?>" data-rel="tr_item2_<?php echo $k;?>" />
                                                            <?php 
																//echo $cantidad_items_horizontales[$k];
																if(@$cantidad_items_horizontales[$k]>0){
                                                                	echo format(@$suma_horizontal,false) ;
																}
                                                                $suma_total +=	@$suma_horizontal;
                                                            ?>
                                                        </td>
                                                       
                                                    </tr>
                                            <?php 
													}
                                                }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <th>Total</th>
                                            <th></th>
                                            <?php 
                                                $suma_horizontal	=	0;
                                                foreach ($inc_desde as $k4 => $v4) {
                                                    for($a=$v4; $a<=$inc_hasta[$k4];$a++ ){
                                            ?>
                                                    <th class="text-right">
                                                        <?php 
															
                                                            if(@$suma_vertical[$a][1]>0){
                                                              print_r(format(@$suma_vertical[$a][1] ,false));
                                                            }else{
                                                              //echo '---';
                                                            }
                                                        ?>
                                                    </th>
                                                    <th class="text-right">
                                                        <?php 
															//pre(@$cantidad_items_verticales[$a][2]);
                                                            if(@$suma_vertical[$a][2]>0){
                                                                print_r(format(@$suma_vertical[$a][2] ,false));
                                                            }else{
                                                                echo '---';	
                                                            }
                                                        ?>
                                                    </th>
                                            <?php 
                                                    }    
                                                }
                                            ?>
                                            <th class="text-right">
                                                <?php echo format($suma_total,false);?>
                                            </th>
                                        </tfoot>
                                    </table>
								</div>
                                <div role="tabpanel" class="tab-pane fade" id="item2" aria-labelledby="item-tab" aria-expanded="false">                                
                                	<table class="table table-hover table-shorta" >
                                        <thead>
                                            <tr>
                                                <th width="200"></th>
                                                <th width="50"></th>
                                                <?php 
                                                    $fila	=	array(); 
                                                    foreach ($inc_desde as $k5 => $v5) {
                                                        for($a=$v5; $a<=$inc_hasta[$k5];$a++ ){
                                                ?>
                                                    <th class="dias" colspan="2"><?php echo mes($a);?></th>
                                                <?php	
                                                        }
                                                    }
                                                ?>
                                                <th width="100" class="text-right"></th>
                                            </tr>
                                            <tr>
                                                <th width="200">Plataformas</th>
                                                <th >Sucursal</th>
                                                <?php 
                                                    
                                                    foreach ($inc_desde as $k5 => $v5) {
                                                        for($a=$v5; $a<=$inc_hasta[$k5];$a++ ){
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
                                                    }
                                                ?>
                                                <th width="100" class="text-center">Promedio (<b>Tokens</b>)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  
                                                $total=array();
                                                $suma_vertical	=	array();
                                                $suma_total		=	0;

                                                foreach($plataformas as $k => $v){
													
													
                                                    if($v->estado==1){
                                            ?>
                                                    <tr id="tr_item2_<?php echo $k;?>">
                                                        <td>
                                                            <?php 
                                                                print($v->nombre_legal);
                                                              //  pre($v);
                                                            ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php
                                                                print($v->abreviacion);
                                                            ?>
                                                        </td>
                                                        <?php 
                                                            $fila	=	array();
                                                            $suma_horizontal	=	0;
                                                            foreach ($inc_desde as $k1 => $v1) {
                                                                for($a=$v1; $a<=$inc_hasta[$k1];$a++ ){
																    if($periodos_de_pago==2){
                                                                        $mes				=	($a<10)?"0".$a:$a;
                                                                        $RP_X_Plataforma		=	RP_X_Plataforma($v->plataforma_id,"Q1-".$mes."-".date("Y"));
                                                        ?>
                                                                <td class="dias text-right">
                                                                    <?php 
																		if(!isset($RPTRMpromedio[$a]["Q1"])){
																			//$json_RPTRMpromedio	=	RPTRMpromedio("Q2-".$mes."-".date("Y"),$mes);
																			$RPTRMpromedio[$a]["Q1"]	=	RPTRMpromedio("Q1-".$mes."-".date("Y"),$mes,"Q1");
																			$RPTRMpromedio[$a]["Q2"]	=	RPTRMpromedio("Q2-".$mes."-".date("Y"),$mes,"Q2");
																		}				
																		@$suma_vertical[$a][1]		+=	(@$RP_X_Plataforma->credito);
                                                                        @$suma_horizontal			+=	(@$RP_X_Plataforma->credito);
                                                                        if(@$RP_X_Plataforma->credito>0){
                                                                            print(format((@$RP_X_Plataforma->credito ),true));
                                                                        }else{
                                                                            echo '---';	
                                                                        }
                                                                        echo @$suma_horizontal[$a];
                                                                    ?>                                                                            
                                                                </td>
                                                                <td class="dias text-right">
                                                            <?php
                                                                    $RP_X_Plataforma			=	RP_X_Plataforma($v->plataforma_id,"Q2-".$mes."-".date("Y"));
																	@$suma_vertical[$a][2]		+=	(@$RP_X_Plataforma->credito );
                                                                    @$suma_horizontal			+=	(@$RP_X_Plataforma->credito );
                                                                    if(@$RP_X_Plataforma->credito>0){
                                                                        print(format((@$RP_X_Plataforma->credito ),true));
                                                                    }else{
                                                                        echo '---';	
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
                                                            }
                                                        ?>
                                                        <td class="text-right">
	                                                        <input type="hidden" class="monto_horizonateles" value="1<?php echo @$suma_horizontal;?>" data-rel="tr_item2_<?php echo $k;?>" />
                                                            <?php 
																if(@$cantidad_items_horizontales[$k]>0){
                                                                	echo format(@$suma_horizontal,true) ;
																}
                                                                $suma_total +=	@$suma_horizontal;
                                                            ?>
                                                        </td>
                                                       
                                                    </tr>
                                            <?php 
													}
                                                }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <th>Total</th>
                                            <th></th>
                                            <?php 
                                                $suma_horizontal	=	0;
                                                foreach ($inc_desde as $k1 => $v1) {
                                                    for($a=$v1; $a<=$inc_hasta[$k1];$a++ ){
                                            ?>
                                                    <th class="text-right">
                                                        <?php 
															
                                                            if(@$suma_vertical[$a][1]>0){
                                                              print_r(format(@$suma_vertical[$a][1],true));
                                                            }else{
                                                            }
                                                        ?>
                                                    </th>
                                                    <th class="text-right">
                                                        <?php 
                                                            if(@$suma_vertical[$a][2]>0){
                                                                print_r(format(@$suma_vertical[$a][2],true));
                                                            }else{
                                                                echo '---';	
                                                            }
                                                        ?>
                                                    </th>
                                            <?php 
                                                    }    
                                                }
                                            ?>
                                            <th class="text-right">
                                                <?php echo format($suma_total,true);?>
                                            </th>
                                        </tfoot>
                                    </table>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="item3" aria-labelledby="item-tab" aria-expanded="false">                                
                                	<table class="table table-hover table-shorta" >
                                        <thead>
                                            <tr>
                                                <th width="200"></th>
                                                <th width="50"></th>
                                                <?php 
                                                    $fila	=	array(); 
                                                    foreach ($inc_desde as $k1 => $v1) {
                                                        for($a=$v1; $a<=$inc_hasta[$k1];$a++ ){
                                                ?>
                                                    <th class="dias" colspan="2"><?php echo mes($a);?></th>
                                                <?php
                                                        }	
                                                    }
                                                ?>
                                                <th width="100" class="text-right"></th>
                                            </tr>
                                            <tr>
                                                <th width="200">Plataformas</th>
                                                <th >Sucursal</th>
                                                <?php 
                                                    
                                                    foreach ($inc_desde as $k1 => $v1) {
                                                        for($a=$v1; $a<=$inc_hasta[$k1];$a++ ){
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
                                                    }
                                                ?>
                                                <th width="100" class="text-center">Total</th>
                                            </tr>
                                            <tr>
                                                <th width="200" cla>TRM Referencia (Promedio)</th>
                                                <th ></th>
                                                <?php 
                                                    
                                                    foreach ($inc_desde as $k1 => $v1) {
                                                        for($a=$v1; $a<=$inc_hasta[$k1];$a++ ){
                                                            if($periodos_de_pago==2){
                                                ?>
                                                            <th class="dias">
                                                            	<?php echo format($RPTRMpromedio[$a]["Q1"],true)?>
                                                            </th>
                                                            <th class="dias">
                                                            	<?php echo format($RPTRMpromedio[$a]["Q2"],true)?>
                                                            </th>
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
                                                    }
                                                ?>
                                                <th width="100" class="text-center"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  
                                                $total=array();
                                                $suma_vertical	=	array();
                                                $suma_total		=	0;

                                                foreach($plataformas as $k => $v){
													
													
                                                    if($v->estado==1){
                                            ?>
                                                    <tr id="tr_item2_<?php echo $k;?>">
                                                        <td>
                                                            <?php 
                                                                print($v->nombre_legal);
                                                              //  pre($v);
                                                            ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php
                                                                print($v->abreviacion);
                                                            ?>
                                                        </td>
                                                        <?php 
                                                            $fila	=	array();
                                                            $suma_horizontal	=	0;
                                                            foreach ($inc_desde as $k1 => $v1) {
                                                                for($a=$v1; $a<=$inc_hasta[$k1];$a++ ){
                                                                    if($periodos_de_pago==2){
                                                                        $mes				=	($a<10)?"0".$a:$a;
                                                                        $RP_X_Plataforma		=	RP_X_Plataforma($v->plataforma_id,"Q1-".$mes."-".date("Y"));
                                                        ?>
                                                                <td class="dias text-right">
                                                                    <?php 
																				
																		@$suma_vertical[$a][1]		+=	@$RP_X_Plataforma->credito * $RPTRMpromedio[$a]["Q1"];
                                                                        @$suma_horizontal			+=	@$RP_X_Plataforma->credito * $RPTRMpromedio[$a]["Q1"];
                                                                        if(@$RP_X_Plataforma->credito>0){
                                                                            print(format((@$RP_X_Plataforma->credito* $RPTRMpromedio[$a]["Q1"] ),false));
                                                                        }else{
                                                                            echo '---';	
                                                                        }
                                                                        echo @$suma_horizontal[$a];
                                                                    ?>                                                                            
                                                                </td>
                                                                <td class="dias text-right">
                                                            <?php
                                                                    $RP_X_Plataforma			=	RP_X_Plataforma($v->plataforma_id,"Q2-".$mes."-".date("Y"));
                                                                    @$suma_vertical[$a][2]		+=	@$RP_X_Plataforma->credito * $RPTRMpromedio[$a]["Q1"];
                                                                    @$suma_horizontal			+=	@$RP_X_Plataforma->credito * $RPTRMpromedio[$a]["Q2"];
                                                                    if(@$RP_X_Plataforma->credito>0){
                                                                        print(format((@$RP_X_Plataforma->credito* $RPTRMpromedio[$a]["Q1"] ),false));
                                                                    }else{
                                                                        echo '---';	
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
                                                            }
                                                        ?>
                                                        <td class="text-right">
	                                                        <input type="hidden" class="monto_horizonateles" value="1<?php echo @$suma_horizontal;?>" data-rel="tr_item2_<?php echo $k;?>" />
                                                            <?php 
																if(@$cantidad_items_horizontales[$k]>0){
                                                                	echo format(@$suma_horizontal,false) ;
																}
                                                                $suma_total +=	@$suma_horizontal;
                                                            ?>
                                                        </td>
                                                       
                                                    </tr>
                                            <?php 
													}
                                                }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <th>Total</th>
                                            <th></th>
                                            <?php 
                                                $suma_horizontal	=	0;
                                                foreach ($inc_desde as $k1 => $v1) {
                                                    for($a=$v1; $a<=$inc_hasta[$k1];$a++ ){
                                            ?>
                                                    <th class="text-right">
                                                        <?php 
															
                                                            if(@$suma_vertical[$a][1]>0){
                                                              print_r(format(@$suma_vertical[$a][1],false));
                                                            }else{
                                                            }
                                                        ?>
                                                    </th>
                                                    <th class="text-right">
                                                        <?php 
                                                            if(@$suma_vertical[$a][2]>0){
                                                                print_r(format(@$suma_vertical[$a][2],false));
                                                            }else{
                                                                echo '---';	
                                                            }
                                                        ?>
                                                    </th>
                                            <?php 
                                                    }    
                                                }
                                            ?>
                                            <th class="text-right">
                                                <?php echo format($suma_total,false);?>
                                            </th>
                                        </tfoot>
                                    </table>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="item4" aria-labelledby="item-tab" aria-expanded="false">                                
                                	<table class="table table-hover table-shorta" >
                                        <thead>
                                            <tr>
                                                <th width="200"></th>
                                                <th width="50"></th>
                                                <?php 
                                                    $fila	=	array(); 
                                                    foreach ($inc_desde as $k1 => $v1) {
                                                        for($a=$v1; $a<=$inc_hasta[$k1];$a++ ){
                                                ?>
                                                    <th class="dias" colspan="2"><?php echo mes($a);?></th>
                                                <?php
                                                        }	
                                                    }
                                                ?>
                                                <th width="100" class="text-right"></th>
                                            </tr>
                                            <tr>
                                                <th width="200">Plataformas</th>
                                                <th >Sucursal</th>
                                                <?php 
                                                    
                                                    foreach ($inc_desde as $k1 => $v1) {
                                                        for($a=$v1; $a<=$inc_hasta[$k1];$a++ ){
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
                                                    }
                                                ?>
                                                <th width="100" class="text-center">Promedio (<b>Tokens</b>)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  
                                                $total=array();
                                                $suma_vertical	=	array();
                                                $suma_total		=	0;
												$cantidad_items_verticales=array();
                                                foreach($plataformas as $k => $v){
													$cantidad_items_horizontales[$k]=0;
													
                                                    if($v->estado==1){
                                            ?>
                                                    <tr id="tr_item2_<?php echo $k;?>">
                                                        <td>
                                                            <?php 
                                                                print($v->nombre_legal);
                                                              //  pre($v);
                                                            ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php
                                                                print($v->abreviacion);
                                                            ?>
                                                        </td>
                                                        <?php 
                                                            $fila	=	array();
                                                            $suma_horizontal	=	0;
                                                            foreach ($inc_desde as $k1 => $v1) {
                                                                for($a=$v1; $a<=$inc_hasta[$k1];$a++ ){
                                                                if($periodos_de_pago==2){
                                                                    $mes				=	($a<10)?"0".$a:$a;
                                                                    $RP_X_Plataforma		=	RP_X_Plataforma($v->plataforma_id,"Q1-".$mes."-".date("Y"));
                                                        ?>
                                                                <td class="dias text-right">
                                                                    <?php 
																				
																		@$suma_vertical[$a][1]		+=	(@$RP_X_Plataforma->credito / 0.05);
                                                                        @$suma_horizontal			+=	(@$RP_X_Plataforma->credito / 0.05);
                                                                        if(@$RP_X_Plataforma->credito>0){
                                                                            print(format((@$RP_X_Plataforma->credito / 0.05),false));
																			@$cantidad_items_verticales[$a][1]	=	@$cantidad_items_verticales[$a][1] + 1;
																			@$cantidad_items_horizontales[$k]++;
                                                                        }else{
                                                                            echo '---';	
                                                                        }
                                                                        echo @$suma_horizontal[$a];
                                                                    ?>                                                                            
                                                                </td>
                                                                <td class="dias text-right">
                                                            <?php
                                                                    $RP_X_Plataforma			=	RP_X_Plataforma($v->plataforma_id,"Q2-".$mes."-".date("Y"));
																	@$suma_vertical[$a][2]		+=	(@$RP_X_Plataforma->credito / 0.05);
                                                                    @$suma_horizontal			+=	(@$RP_X_Plataforma->credito / 0.05);
                                                                    if(@$RP_X_Plataforma->credito>0){
                                                                        print(format((@$RP_X_Plataforma->credito / 0.05),false));
																		$cantidad_items_horizontales[$k]++;
																		@$cantidad_items_verticales[$a][2]	=	@$cantidad_items_verticales[$a][2] + 1;
                                                                    }else{
                                                                        echo '---';	
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
                                                            }
                                                        ?>
                                                        <td class="text-right">
	                                                        <input type="hidden" class="monto_horizonateles" value="1<?php echo @$suma_horizontal;?>" data-rel="tr_item2_<?php echo $k;?>" />
                                                            <?php 
																//echo $cantidad_items_horizontales[$k];
																if(@$cantidad_items_horizontales[$k]>0){
                                                                	echo format(@$suma_horizontal / $cantidad_items_horizontales[$k],false) ;
																}
                                                                $suma_total +=	@$suma_horizontal;
                                                            ?>
                                                        </td>
                                                       
                                                    </tr>
                                            <?php 
													}
                                                }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <th>Total</th>
                                            <th></th>
                                            <?php 
                                                $suma_horizontal	=	0;
                                                foreach ($inc_desde as $k1 => $v1) {
                                                    for($a=$v1; $a<=$inc_hasta[$k1];$a++ ){
                                            ?>
                                                    <th class="text-right">
                                                        <?php 
															
                                                            if(@$suma_vertical[$a][1]>0){
                                                              print_r(format(@$suma_vertical[$a][1] / @$cantidad_items_verticales[$a][1],false));
                                                            }else{
                                                              //echo '---';
                                                            }
                                                        ?>
                                                    </th>
                                                    <th class="text-right">
                                                        <?php 
															//pre(@$cantidad_items_verticales[$a][2]);
                                                            if(@$suma_vertical[$a][2]>0){
                                                                print_r(format(@$suma_vertical[$a][2] / @$cantidad_items_verticales[$a][2] ,false));
                                                            }else{
                                                                echo '---';	
                                                            }
                                                        ?>
                                                    </th>
                                            <?php 
                                                    }    
                                                }
                                            ?>
                                            <th class="text-right">
                                                <?php #echo format($suma_total,false);?>
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