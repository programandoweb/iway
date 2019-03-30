<?php
	$modulo				= 	$this->ModuloActivo;
	$periodos_de_pago	=	centrodecostos($this->user->id_empresa)->periodo_pagos;
    $periodo = $ciclos_pagos = get_cf_ciclos_pagos(date("m"),$this->user->centro_de_costos);
    $ciclo = array();
    foreach ($periodo as $key => $value) {
        if(date("Y-m-d") >= $value->fecha_desde && date("Y-m-d") <= $value->fecha_hasta ){
            $datetime1 = new DateTime($value->fecha_hasta);
            $datetime2 = new DateTime($value->fecha_desde);
            $interval = $datetime1->diff($datetime2);
            $ciclo[] = $interval->days +1; 
        }
    }
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
       	 	<?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Reportes Cumplimiento X Modelos.",
															"icono"	=>	'<i class="fas fa-users"></i>',
															"url"	=>	current_url()),

                                    "pdf"       =>  array(  "title" =>  "PDF",
                                                            "url"   =>  current_url().'/PDF'),
							)
						);
			?>
        	<div class="row">
            	<div class="col-md-12">
					<div class="section">
                        <div class="tab-content row">
                        <?php
                            $td = '';
                            $total = 0;
                            $subtotal = 0;
                        if(!empty($ciclo)){
                            foreach ($ciclo as $k1 => $v1) {
                                $n1 = $k1+1;
                                if($k1 == 0){
                                    $index = 1;
                                }else{
                                    $key = $k1 - 1;
                                    $index = $ciclo[$key] + 1;
                                }
                        ?>
                                <table class="table table-hover table-shorta" >
                                    <thead>
                                        <tr>
                                            <th width="200">Modelo</th>
                                            <th width="150">Meta ideal</th>
                                            <?php
                                                if($v1 =="total"){
                                                    if($periodos_de_pago == 2){
                                            ?>
                                            <th>Quincena-1</th>
                                            <th>Quincena-2</th>
                                            <?php
                                                    }else{
                                            ?>
                                            <th>Semana-1</th>
                                            <th>Semana-2</th>
                                            <th>Semana-3</th>
                                            <th>Semana-4</th>
                                            <?php            
                                                    }
                                                }else{
                                            ?>
                                            <?php  
                                                    for($a=$index; $a<=$v1;$a++){
                                            ?>
                                                <th class="dias"><?php echo $a;?></th>
                                            <?php	
                                                    }
                                                }
                                            ?>
                                            <th width="100" class="text-right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(!empty($this->$modulo->result)){
                                            foreach ($this->$modulo->result as $key => $value){
                                        ?>
                                        <tr>
                                            <td><?php echo $value['modelo']; ?></td>
                                            <td><?php echo @format($value['meta_ideal'],false); ?></td>
                                            <?php
                                                if($v1 == 'total'){
                                                    echo $td;
                                                }else{ 
                                                    for($a=$index; $a<=$v1;$a++){
                                            ?>
                                                <th class="dias"><?php if(empty($value[$a]['tokens'])){echo 0;}else{echo format($value[$a]['tokens'],false);}?></th>
                                            <?php   
                                                    @$subtotal += $value[$a]['tokens'];
                                                    }
                                                }
                                            ?>
                                            <td width="100" class="text-right">
                                                <?php 
                                                    if($v1 == "total"){
                                                        echo format($total,false);
                                                    }else{
                                                        echo format($subtotal,false);
                                                    }
                                                    $Total[$k1] =$subtotal;
                                                    $total += $subtotal;
                                                    $subtotal = 0;
                                                    $td .= '<td>'.$Total[$k1].'</td>';
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
                                        <th class="text-right">
                                        </th>
                                    </tfoot>
                                </table>
                        <?php
                            }
                        }
                        ?>   
                        </div>                              
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>