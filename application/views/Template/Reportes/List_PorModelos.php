<?php
	$modulo				= 	$this->ModuloActivo;
	$trm				=	get_cf_ciclos_pagos_new($this->user->id_empresa,0);	
	$centro_de_costos	=	$this->user->centro_de_costos;
	$modelos			=	get_modelos();
	$modelos_nombres	=	@$this->$modulo->result["modelos_nombres"];	
	$periodos_de_pago	=	centrodecostos($this->user->id_empresa)->periodo_pagos;
	$cantidad_a_mostrar	=	($periodos_de_pago==2)?4:3;
	$calculo_desde		=	(int)calculo_meses(date("Y-m-d"),'-'.$cantidad_a_mostrar,'m');
	$calculo_hasta      = 	$calculo_desde	+ 	$cantidad_a_mostrar;
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
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Reportes X Modelos.",
															"icono"	=>	'<i class="fas fa-users"></i>',
															"url"	=>	current_url()),

                                    "pdf"       =>  array(  "title" =>  "PDF",
                                                            "url"   =>  current_url().'/PDF'),
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
                                    <a class="nav-link" id="item3-tab" data-toggle="tab" href="#item3" role="tab" aria-controls="item" aria-expanded="false">Producción (<b>USD</b>)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="item4-tab" data-toggle="tab" href="#item4" role="tab" aria-controls="item" aria-expanded="false">Producción (<b>COP</b>)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="item2-tab" data-toggle="tab" href="#item2" role="tab" aria-controls="item" aria-expanded="false">Promedios (<b>Activos</b>)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="item6-tab" data-toggle="tab" href="#item6" role="tab" aria-controls="item" aria-expanded="false">Máximos (<b>Tokens</b>)</a>
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
                                                        for($a=$v1; $a<=$inc_hasta[$k1];$a++){
                                                ?>
                                                    <th class="dias" colspan="<?php echo $periodos_de_pago; ?>"><?php echo mes($a);?></th>
                                                <?php
                                                        }	
                                                    }
                                                ?>
                                                <th width="100" class="text-right"></th>
                                            </tr>
                                            <tr>
                                                <th width="200">Terceros</th>
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
                                                <th width="100" class="text-center">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  
                                                $total=array();
                                                $suma_vertical	=	array();
                                                $suma_total		=	0;
												$RPTRMpromedio	=	array();
                                                foreach($modelos as $k => $v){
                                                    //pre($inc_desde);
                                            ?>
                                                    <tr id="tr_item1_<?php echo $k;?>">
                                                        <td>
                                                            <?php 
                                                                print(nombre($v));
                                                                //pre($v);
                                                            ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php
                                                                print($sucursales[$v->centro_de_costos]->abreviacion);
                                                            ?>
                                                        </td>
                                                        <?php 
                                                            $fila	=	array();
                                                            $suma_horizontal	=	0;
                                                            foreach ($inc_desde as $k3 => $v3) {
                                                                for($a=$v3; $a<=$inc_hasta[$k3];$a++ ){
                                                                    if($periodos_de_pago==2){
                                                                        $mes				=	($a<10)?"0".$a:$a;
                                                                        $RP_X_Modelos		=	RP_X_Modelos($v->user_id,"Q1-".$mes."-".date("Y"),$mes);
																	
                                                        ?>
                                                                <td class="dias text-center">
                                                                    <?php 
                                                                        @$suma_vertical[$a][1]		+=	(@$RP_X_Modelos->credito / 0.05);
                                                                        @$suma_horizontal			+=	(@$RP_X_Modelos->credito / 0.05);
                                                                        if(@$RP_X_Modelos->credito>0){
                                                                            print(format((@$RP_X_Modelos->credito / 0.05),false));
                                                                        }else{
                                                                            echo '---';	
                                                                        }
                                                                        echo @$suma_horizontal[$a];
                                                                    ?>                                                                            
                                                                </td>
                                                                <td class="dias text-right">
                                                            <?php
																	
																	if(!isset($RPTRMpromedio[$a]["Q1"])){
																		//$json_RPTRMpromedio	=	RPTRMpromedio("Q2-".$mes."-".date("Y"),$mes);
																		$RPTRMpromedio[$a]["Q1"]	=	RPTRMpromedio("Q1-".$mes."-".date("Y"),$mes,"Q1");
																		$RPTRMpromedio[$a]["Q2"]	=	RPTRMpromedio("Q2-".$mes."-".date("Y"),$mes,"Q2");
																	}
                                                                    $RP_X_Modelos				=	RP_X_Modelos($v->user_id,"Q2-".$mes."-".date("Y"));
                                                                    @$suma_vertical[$a][2]		+=	(@$RP_X_Modelos->credito / 0.05);
                                                                    @$suma_horizontal			+=	(@$RP_X_Modelos->credito / 0.05);
                                                                    if(@$RP_X_Modelos->credito>0){
                                                                        print(format((@$RP_X_Modelos->credito / 0.05),false));
                                                                    }else{
                                                                        echo '---';	
                                                                    }
                                                            ?>                                                                    	
                                                                </td>
                                                            <?php	
                                                                }else{
                                                                    $mes                =   ($a<10)?"0".$a:$a;
                                                                    $RP_X_Modelos       =   RP_X_Modelos($v->user_id,"S1-".$mes."-".date("Y"),$mes);
                                                            ?>
                                                                <td class="dias text-center">
                                                                    <?php 
                                                                        @$suma_vertical[$a][1]      +=  (@$RP_X_Modelos->credito / 0.05);
                                                                        @$suma_horizontal           +=  (@$RP_X_Modelos->credito / 0.05);
                                                                        if(@$RP_X_Modelos->credito>0){
                                                                            print(format((@$RP_X_Modelos->credito / 0.05),false));
                                                                        }else{
                                                                            echo '---'; 
                                                                        }
                                                                        echo @$suma_horizontal[$a];
                                                                    ?>                                                                            
                                                                </td>
                                                                <td class="dias text-right">
                                                            <?php
                                                                    
                                                                    if(!isset($RPTRMpromedio[$a]["S1"])){
                                                                        //$json_RPTRMpromedio   =   RPTRMpromedio("Q2-".$mes."-".date("Y"),$mes);
                                                                        $RPTRMpromedio[$a]["S1"]    =   RPTRMpromedio("S1-".$mes."-".date("Y"),$mes,"S1");
                                                                        $RPTRMpromedio[$a]["S2"]    =   RPTRMpromedio("S2-".$mes."-".date("Y"),$mes,"S2");
                                                                        $RPTRMpromedio[$a]["S3"]    =   RPTRMpromedio("S4-".$mes."-".date("Y"),$mes,"S3");
                                                                        $RPTRMpromedio[$a]["S4"]    =   RPTRMpromedio("S4-".$mes."-".date("Y"),$mes,"S4");
                                                                    }
                                                                    $RP_X_Modelos               =   RP_X_Modelos($v->user_id,"S2-".$mes."-".date("Y"));
                                                                    @$suma_vertical[$a][2]      +=  (@$RP_X_Modelos->credito / 0.05);
                                                                    @$suma_horizontal           +=  (@$RP_X_Modelos->credito / 0.05);
                                                                    if(@$RP_X_Modelos->credito>0){
                                                                        print(format((@$RP_X_Modelos->credito / 0.05),false));
                                                                    }else{
                                                                        echo '---'; 
                                                                    }
                                                            ?>                                                                      
                                                                </td>
                                                                <td class="dias text-right">
                                                            <?php
                                                                    $RP_X_Modelos               =   RP_X_Modelos($v->user_id,"S3-".$mes."-".date("Y"));
                                                                    @$suma_vertical[$a][2]      +=  (@$RP_X_Modelos->credito / 0.05);
                                                                    @$suma_horizontal           +=  (@$RP_X_Modelos->credito / 0.05);
                                                                    if(@$RP_X_Modelos->credito>0){
                                                                        print(format((@$RP_X_Modelos->credito / 0.05),false));
                                                                    }else{
                                                                        echo '---'; 
                                                                    }
                                                            ?>                                                                      
                                                                </td>
                                                                <td class="dias text-right">
                                                            <?php
                                                                    $RP_X_Modelos               =   RP_X_Modelos($v->user_id,"S4-".$mes."-".date("Y"));
                                                                    @$suma_vertical[$a][2]      +=  (@$RP_X_Modelos->credito / 0.05);
                                                                    @$suma_horizontal           +=  (@$RP_X_Modelos->credito / 0.05);
                                                                    if(@$RP_X_Modelos->credito>0){
                                                                        print(format((@$RP_X_Modelos->credito / 0.05),false));
                                                                    }else{
                                                                        echo '---'; 
                                                                    }
                                                            ?>                                                                      
                                                                </td>
                                                            <?php
                                                                    }			
                                                                }
                                                            }
                                                        ?>
                                                        <td class="text-right">
                                                        	<input type="hidden" class="monto_horizonateles" value="<?php echo @$suma_horizontal;?>" data-rel="tr_item1_<?php echo $k;?>" />
                                                            <?php 
                                                                echo format(@$suma_horizontal,false);
                                                                $suma_total +=	@$suma_horizontal;
                                                            ?>
                                                        </td>
                                                       
                                                    </tr>
                                            <?php 
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
                                                        if($periodos_de_pago==2){
                                            ?>
                                                    <th class="text-right">
                                                        <?php 
                                                            if(@$suma_vertical[$a][1]>0){
                                                                print_r(format(@$suma_vertical[$a][1],false));
                                                            }else{
                                                                echo '---';
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
                                                        }else{
                                            ?>
                                                    <th class="text-right">
                                                        <?php 
                                                            if(@$suma_vertical[$a][1]>0){
                                                                print_r(format(@$suma_vertical[$a][1],false));
                                                            }else{
                                                                echo '---';
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
                                                    <th class="text-right">
                                                        <?php 
                                                            if(@$suma_vertical[$a][3]>0){
                                                                print_r(format(@$suma_vertical[$a][3],false));
                                                            }else{
                                                                echo '---';
                                                            }
                                                        ?>
                                                    </th>
                                                    <th class="text-right">
                                                        <?php 
                                                            if(@$suma_vertical[$a][4]>0){
                                                                print_r(format(@$suma_vertical[$a][4],false));
                                                            }else{
                                                                echo '---'; 
                                                            }
                                                        ?>
                                                    </th>
                                            <?php
                                                        } 
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
                                                    <th class="dias" colspan="<?php echo $periodos_de_pago; ?>"><?php echo mes($a);?></th>
                                                <?php	
                                                        }
                                                    }
                                                ?>
                                                <th width="100" class="text-right"></th>
                                            </tr>
                                            <tr>
                                                <th width="200">Terceros</th>
                                                <th >Sucursal</th>
                                                <?php 
                                                    foreach ($inc_desde as $k6 => $v6) {
                                                        for($a=$v6; $a<=$inc_hasta[$k6];$a++ ){
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
                                                foreach($modelos as $k => $v){
													$cantidad_items_horizontales[$k]=0;
                                                    if($v->estado==1){
                                            ?>
                                                    <tr id="tr_item2_<?php echo $k;?>">
                                                        <td>
                                                            <?php 
                                                                print(nombre($v));
                                                                //pre($v);
                                                            ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php
                                                                print($sucursales[$v->centro_de_costos]->abreviacion);
                                                            ?>
                                                        </td>
                                                        <?php 
                                                            $fila	=	array();
                                                            $suma_horizontal	=	0;
                                                            foreach ($inc_desde as $k7 => $v7){
                                                                for($a=$v7; $a<=$inc_hasta[$k7];$a++ ){
                                                                    if($periodos_de_pago==2){
                                                                        $mes				=	($a<10)?"0".$a:$a;
                                                                        $RP_X_Modelos		=	RP_X_Modelos($v->user_id,"Q1-".$mes."-".date("Y"));
                                                        ?>
                                                                <td class="dias text-right">
                                                                    <?php 
																				
																		@$suma_vertical[$a][1]		+=	(@$RP_X_Modelos->credito / 0.05);
                                                                        @$suma_horizontal			+=	(@$RP_X_Modelos->credito / 0.05);
                                                                        if(@$RP_X_Modelos->credito>0){
                                                                            print(format((@$RP_X_Modelos->credito / 0.05),false));
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
                                                                    $RP_X_Modelos		=	RP_X_Modelos($v->user_id,"Q2-".$mes."-".date("Y"));
																	@$suma_vertical[$a][2]		+=	(@$RP_X_Modelos->credito / 0.05);
                                                                    @$suma_horizontal			+=	(@$RP_X_Modelos->credito / 0.05);
                                                                    if(@$RP_X_Modelos->credito>0){
                                                                        print(format((@$RP_X_Modelos->credito / 0.05),false));
																		$cantidad_items_horizontales[$k]++;
																		@$cantidad_items_verticales[$a][2]	=	@$cantidad_items_verticales[$a][2] + 1;
                                                                    }else{
                                                                        echo '---';	
                                                                    }
                                                            ?>                                                                    	
                                                                </td>
                                                            <?php	
                                                                    }else{
                                                                        $mes                =   ($a<10)?"0".$a:$a;
                                                                        $RP_X_Modelos       =   RP_X_Modelos($v->user_id,"S1-".$mes."-".date("Y"));
                                                            ?>
                                                                <td class="dias text-right">
                                                                    <?php 
                                                                                
                                                                        @$suma_vertical[$a][1]      +=  (@$RP_X_Modelos->credito / 0.05);
                                                                        @$suma_horizontal           +=  (@$RP_X_Modelos->credito / 0.05);
                                                                        if(@$RP_X_Modelos->credito>0){
                                                                            print(format((@$RP_X_Modelos->credito / 0.05),false));
                                                                            @$cantidad_items_verticales[$a][1]  =   @$cantidad_items_verticales[$a][1] + 1;
                                                                            @$cantidad_items_horizontales[$k]++;
                                                                        }else{
                                                                            echo '---'; 
                                                                        }
                                                                        echo @$suma_horizontal[$a];
                                                                    ?>                                                                            
                                                                </td>
                                                                <td class="dias text-right">
                                                            <?php
                                                                    $RP_X_Modelos       =   RP_X_Modelos($v->user_id,"S2-".$mes."-".date("Y"));
                                                                    @$suma_vertical[$a][2]      +=  (@$RP_X_Modelos->credito / 0.05);
                                                                    @$suma_horizontal           +=  (@$RP_X_Modelos->credito / 0.05);
                                                                    if(@$RP_X_Modelos->credito>0){
                                                                        print(format((@$RP_X_Modelos->credito / 0.05),false));
                                                                        $cantidad_items_horizontales[$k]++;
                                                                        @$cantidad_items_verticales[$a][2]  =   @$cantidad_items_verticales[$a][2] + 1;
                                                                    }else{
                                                                        echo '---'; 
                                                                    }
                                                            ?>                                                                      
                                                                </td>
                                                                <td class="dias text-right">
                                                            <?php
                                                                    $RP_X_Modelos       =   RP_X_Modelos($v->user_id,"S3-".$mes."-".date("Y"));
                                                                    @$suma_vertical[$a][3]      +=  (@$RP_X_Modelos->credito / 0.05);
                                                                    @$suma_horizontal           +=  (@$RP_X_Modelos->credito / 0.05);
                                                                    if(@$RP_X_Modelos->credito>0){
                                                                        print(format((@$RP_X_Modelos->credito / 0.05),false));
                                                                        $cantidad_items_horizontales[$k]++;
                                                                        @$cantidad_items_verticales[$a][3]  =   @$cantidad_items_verticales[$a][3] + 1;
                                                                    }else{
                                                                        echo '---'; 
                                                                    }
                                                            ?>                                                                      
                                                                </td>
                                                                <td class="dias text-right">
                                                            <?php
                                                                    $RP_X_Modelos       =   RP_X_Modelos($v->user_id,"S4-".$mes."-".date("Y"));
                                                                    @$suma_vertical[$a][4]      +=  (@$RP_X_Modelos->credito / 0.05);
                                                                    @$suma_horizontal           +=  (@$RP_X_Modelos->credito / 0.05);
                                                                    if(@$RP_X_Modelos->credito>0){
                                                                        print(format((@$RP_X_Modelos->credito / 0.05),false));
                                                                        $cantidad_items_horizontales[$k]++;
                                                                        @$cantidad_items_verticales[$a][4]  =   @$cantidad_items_verticales[$a][4] + 1;
                                                                    }else{
                                                                        echo '---'; 
                                                                    }
                                                            ?>                                                                      
                                                                </td>
                                                            <?php
                                                                    }			
                                                                }
                                                            }
                                                        ?>
                                                        <td class="text-right">
	                                                        <input type="hidden" class="monto_horizonateles" value="<?php echo @$suma_horizontal;?>" data-rel="tr_item2_<?php echo $k;?>" />
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
                                                foreach ($inc_desde as $k8 => $v8) {
                                                    for($a=$v8; $a<=$inc_hasta[$k8];$a++ ){
                                                        if($periodos_de_pago==2){
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
                                                        }else{
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
                                                    <th class="text-right">
                                                        <?php 
                                                            
                                                            if(@$suma_vertical[$a][3]>0){
                                                              print_r(format(@$suma_vertical[$a][3] / @$cantidad_items_verticales[$a][3],false));
                                                            }else{
                                                              //echo '---';
                                                            }
                                                        ?>
                                                    </th>
                                                    <th class="text-right">
                                                        <?php 
                                                            //pre(@$cantidad_items_verticales[$a][2]);
                                                            if(@$suma_vertical[$a][4]>0){
                                                                print_r(format(@$suma_vertical[$a][4] / @$cantidad_items_verticales[$a][2] ,false));
                                                            }else{
                                                                echo '---'; 
                                                            }
                                                        ?>
                                                    </th>
                                            <?php
                                                        }
                                                    }    
                                                }
                                            ?>
                                            <th class="text-right">
                                                <?php #echo format($suma_total,false);?>
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
                                                    foreach ($inc_desde as $k9 => $v9) {
                                                        for($a=$v9; $a<=$inc_hasta[$k9];$a++ ){
                                                ?>
                                                    <th class="dias" colspan="<?php echo $periodos_de_pago; ?>"><?php echo mes($a);?></th>
                                                <?php
                                                        }	
                                                    }
                                                ?>
                                                <th width="100" class="text-right"></th>
                                            </tr>
                                            <tr>
                                                <th width="200">Terceros</th>
                                                <th >Sucursal</th>
                                                <?php 
                                                    foreach ($inc_desde as $k10 => $v10) {
                                                        for($a=$v10; $a<=$inc_hasta[$k10];$a++ ){
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
                                        </thead>
                                        <tbody>
                                            <?php  
                                                $total=array();
                                                $suma_vertical	=	array();
                                                $suma_total		=	0;
                                                foreach($modelos as $k => $v){
                                                    //pre($inc_desde);
                                            ?>
                                                    <tr id="tr_item3_<?php echo $k;?>">
                                                        <td>
                                                            <?php 
                                                                print(nombre($v));
                                                                //pre($v);
                                                            ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php
                                                                print($sucursales[$v->centro_de_costos]->abreviacion);
                                                            ?>
                                                        </td>
                                                        <?php 
                                                            $fila	=	array();
                                                            $suma_horizontal	=	0;
                                                            foreach ($inc_desde as $k11 => $v11) {
                                                                for($a=$v11; $a<=$inc_hasta[$k11];$a++ ){
                                                                    if($periodos_de_pago==2){
                                                                        $mes				=	($a<10)?"0".$a:$a;
                                                                        $RP_X_Modelos		=	RP_X_Modelos($v->user_id,"Q1-".$mes."-".date("Y"));
                                                        ?>
                                                                <td class="dias text-right">
                                                                    <?php 
                                                                        @$suma_vertical[$a][1]		+=	@$RP_X_Modelos->credito;
                                                                        @$suma_horizontal			+=	@$RP_X_Modelos->credito;
                                                                        if(@$RP_X_Modelos->credito>0){
                                                                            print(format(@$RP_X_Modelos->credito,true));
                                                                        }else{
                                                                            echo '---';	
                                                                        }
                                                                        echo @$suma_horizontal[$a];
                                                                    ?>                                                                            
                                                                </td>
                                                                <td class="dias text-right">
                                                            <?php
                                                                    $RP_X_Modelos		=	RP_X_Modelos($v->user_id,"Q2-".$mes."-".date("Y"));
                                                                    @$suma_vertical[$a][2]		+=	@$RP_X_Modelos->credito;
                                                                    @$suma_horizontal			+=	@$RP_X_Modelos->credito;
                                                                    if(@$RP_X_Modelos->credito>0){
                                                                        print(format(@$RP_X_Modelos->credito,true));
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
	                                                        <input type="hidden" class="monto_horizonateles" value="<?php echo @$suma_horizontal;?>" data-rel="tr_item3_<?php echo $k;?>" />
                                                            <?php 
                                                                echo format(@$suma_horizontal,true);
                                                                $suma_total +=	@$suma_horizontal;
                                                            ?>
                                                        </td>
                                                       
                                                    </tr>
                                            <?php 
                                                }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <th>Total</th>
                                            <th></th>
                                            <?php 
                                                $suma_horizontal	=	0;
                                                foreach ($inc_desde as $k12 => $v12) {
                                                    for($a=$v12; $a<=$inc_hasta[$k12];$a++ ){
                                            ?>
                                                    <th class="text-right">
                                                        <?php 
                                                            if(@$suma_vertical[$a][1]>0){
                                                                print_r(format(@$suma_vertical[$a][1],true));
                                                            }else{
                                                                echo '---';
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
                                <div role="tabpanel" class="tab-pane fade" id="item4" aria-labelledby="item-tab" aria-expanded="false">                                
                                	<table class="table table-hover table-shorta" >
                                        <thead>
                                            <tr>
                                                <th width="200"></th>
                                                <th width="50"></th>
                                                <?php 
                                                    $fila	=	array();
                                                    foreach ($inc_desde as $k13 => $v13) {
                                                        for($a=$v13; $a<=$inc_hasta[$k13];$a++ ){
                                                ?>
                                                    <th class="dias" colspan="<?php echo $periodos_de_pago; ?>"><?php echo mes($a);?></th>
                                                <?php	
                                                        }
                                                    }
                                                ?>
                                                <th width="100" class="text-right"></th>
                                            </tr>
                                            <tr>
                                                <th width="200">Terceros</th>
                                                <th >Sucursal</th>
                                                <?php 
                                                    foreach ($inc_desde as $k14 => $v14) {
                                                        for($a=$v14; $a<=$inc_hasta[$k14];$a++ ){
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
                                                    foreach ($inc_desde as $k15 => $v15) {
                                                        for($a=$v15; $a<=$inc_hasta[$k15];$a++ ){
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
                                                foreach($modelos as $k => $v){
                                                    //pre($inc_desde);
                                            ?>
                                                    <tr id="tr_item4_<?php echo $k;?>">
                                                        <td>
                                                            <?php 
                                                                print(nombre($v));
                                                                //pre($v);
                                                            ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php
                                                                print($sucursales[$v->centro_de_costos]->abreviacion);
                                                            ?>
                                                        </td>
                                                        <?php 
                                                            $fila	=	array();
                                                            $suma_horizontal	=	0;
                                                            foreach ($inc_desde as $k16 => $v16) {
                                                                for($a=$v16; $a<=$inc_hasta[$k16];$a++ ){
                                                                    if($periodos_de_pago==2){
                                                                        $mes				=	($a<10)?"0".$a:$a;
                                                                        $RP_X_Modelos		=	RP_X_Modelos($v->user_id,"Q1-".$mes."-".date("Y"));
                                                        ?>
                                                                <td class="dias text-right">
                                                                    <?php 
                                                                        @$suma_vertical[$a][1]		+=	@$RP_X_Modelos->credito * $RPTRMpromedio[$a]["Q1"];
                                                                        @$suma_horizontal			+=	@$RP_X_Modelos->credito * $RPTRMpromedio[$a]["Q1"];
																		
																		if(@$RP_X_Modelos->credito>0){
                                                                            print(format(@$RP_X_Modelos->credito  * $RPTRMpromedio[$a]["Q1"],false));
                                                                        }else{
                                                                            echo '---';	
                                                                        }
                                                                        echo @$suma_horizontal[$a];
                                                                    ?>                                                                            
                                                                </td>
                                                                <td class="dias text-right">
                                                            <?php
                                                                    $RP_X_Modelos		=	RP_X_Modelos($v->user_id,"Q2-".$mes."-".date("Y"));
                                                                    @$suma_vertical[$a][2]		+=	@$RP_X_Modelos->credito * $RPTRMpromedio[$a]["Q1"];
                                                                    @$suma_horizontal			+=	@$RP_X_Modelos->credito * $RPTRMpromedio[$a]["Q2"];
                                                                    if(@$RP_X_Modelos->credito>0){
                                                                        print(format(@$RP_X_Modelos->credito * $RPTRMpromedio[$a]["Q1"],false));
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
                                                        	<input type="hidden" class="monto_horizonateles" value="<?php echo @$suma_horizontal;?>" data-rel="tr_item4_<?php echo $k;?>" />
                                                            <?php 
                                                                echo format(@$suma_horizontal,false);
                                                                $suma_total +=	@$suma_horizontal;
                                                            ?>
                                                        </td>
                                                       
                                                    </tr>
                                            <?php 
                                                }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <th>Total</th>
                                            <th></th>
                                            <?php 
                                                $suma_horizontal	=	0;
                                                foreach ($inc_desde as $k17 => $v17) {
                                                    for($a=$v17; $a<=$inc_hasta[$k17];$a++ ){
                                            ?>
                                                    <th class="text-right">
                                                        <?php 
                                                            if(@$suma_vertical[$a][1]>0){
                                                                print_r(format(@$suma_vertical[$a][1],false));
                                                            }else{
                                                                echo '---';
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
                                <div role="tabpanel" class="tab-pane fade" id="item6" aria-labelledby="item-tab" aria-expanded="false">                                
                                	<table class="table table-hover table-shorta" >
                                        <thead>
                                            <tr>
                                                <th width="200"></th>
                                                <th width="50"></th>
                                                <?php 
                                                    $fila	=	array();
                                                    foreach ($inc_desde as $k20 => $v20) {
                                                        for($a=$v20; $a<=$inc_hasta[$k20];$a++ ){
                                                ?>
                                                    <th class="dias" colspan="<?php echo $periodos_de_pago; ?>"><?php echo mes($a);?></th>
                                                <?php	
                                                        }
                                                    }
                                                ?>
                                            </tr>
                                            <tr>
                                                <th width="200">Terceros</th>
                                                <th >Sucursal</th>
                                                <?php 
                                                    foreach ($inc_desde as $k21 => $v21) {
                                                        for($a=$v21; $a<=$inc_hasta[$k21];$a++ ){
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  
                                                $total=array();
                                                $suma_vertical	=	array();
                                                $suma_total		=	0;
                                                foreach($modelos as $k => $v){
                                                    if($v->estado==1){
                                            ?>
                                                    <tr id="tr_item6_<?php echo $k;?>" class="max-monto" data-rel="<?php echo $k;?>">
                                                        <td>
                                                            <?php 
                                                                print(nombre($v));
                                                                //pre($v);
                                                            ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php
                                                                print($sucursales[$v->centro_de_costos]->abreviacion);
                                                            ?>
                                                        </td>
                                                        <?php 
                                                            $fila	=	array();
                                                            $suma_horizontal	=	0;
                                                            foreach ($inc_desde as $k22 => $v22) {
                                                                for($a=$v22; $a<=$inc_hasta[$k22];$a++ ){
                                                                    if($periodos_de_pago==2){
                                                                        $mes				=	($a<10)?"0".$a:$a;
                                                                        $RP_X_Modelos				=	RP_X_Modelos($v->user_id,"Q1-".$mes."-".date("Y"));
																	   @$suma_vertical[$a][1]		+=	(@$RP_X_Modelos->credito / 0.05);
																	   @$suma_horizontal			+=	(@$RP_X_Modelos->credito / 0.05);
                                                        ?>
                                                                <td class="dias text-right" data-value="<?php echo @$RP_X_Modelos->credito / 0.05;?>">
                                                                    <?php 
                                                                       
                                                                        if(@$RP_X_Modelos->credito>0){
                                                                            print(format((@$RP_X_Modelos->credito / 0.05),false));
                                                                        }else{
                                                                            echo '---';	
                                                                        }
                                                                        //echo @$suma_horizontal[$a];
                                                                    ?>                                                                            
                                                                </td>
                                                            <?php
                                                            	$RP_X_Modelos		=	RP_X_Modelos($v->user_id,"Q2-".$mes."-".date("Y"));
																@$suma_vertical[$a][2]		+=	(@$RP_X_Modelos->credito / 0.05);
																@$suma_horizontal			+=	(@$RP_X_Modelos->credito / 0.05);
															
															?>    
                                                                <td class="dias text-right"  data-value="<?php echo @$RP_X_Modelos->credito / 0.05;?>">
                                                            <?php
                                                                    
                                                                    if(@$RP_X_Modelos->credito>0){
                                                                        print(format((@$RP_X_Modelos->credito / 0.05),false));
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
                                                    </tr>
                                            <?php 
													}
                                                }
                                            ?>
                                        </tbody>
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