<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
	$modulo=$this->ModuloActivo;
	$fecha=get_cf_ciclos_pagos_new($this->user->id_empresa,0);
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
       	 	<?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Reportes X Plataforma.",
															"icono"	=>	'<i class="fas fa-users"></i>',
															"url"	=>	current_url()),
                                                            "pdf"   =>  true,
							)
						);
			?>
        	<div class="row">
            	<div class="col-md-12">
					<div class="section">
                        <table class="ordenar display table table-hover">
                        	<thead>
                        		<tr>
                        			<th width="20%">Plataforma</th>
                                    <th>Modelos</th>
                                    <th>
                                    	<table style="width:100%;"> 
                                        	<tr>                               
												<?php 
                                                    for($a=$fecha->desde;$a<=$fecha->hasta;$a++){
                                                ?>	
                                                        <td class="text-center" style="width:6.6%;"><?php echo $a?></td>                                                 <?php	
                                                    }
                                                ?>
                                            </tr>
                                        </table>
                                    </th>
                        			<th width="100" class="text-right"><b>Total</b></th>  
                        		</tr>
                        	</thead>
                        	<tbody>
                            	<?php foreach($this->$modulo->result["data"] as $k=> $v){?>
                            	<tr>
                                	<td><?php echo $k;?></td>
                                    <td>
                                    	<table>
											<?php 
												$dias_array	=	array();	
												foreach($this->$modulo->result["modelos"] as $k2	=>	$v2){
													foreach($v2 as $k3=> $v3){
														if(isset($this->$modulo->result["data"][$k][$k3])){
														foreach($this->$modulo->result["data"][$k][$k3] as $k4 =>$v4){
															$dias_array[$v4->dia]	=	$v4->debito;
														}}
											?>
                                                    <tr>
                                                        <td>
															<?php 
																echo $v3->primer_nombre.' '.$v3->primer_apellido;  
															?>
                                                        </td>
                                                    </tr>
											<?php	
													}
											?> 
										</table>
                                    </td>
                                    <td>
                                            <table style="width:100%;">
                                                <?php 	
													$total_array	=	array();
                                                    foreach($this->$modulo->result["modelos"] as $k2	=>	$v2){
                                                        foreach($v2 as $k3=> $v3){
                                                ?>
                                                            <tr>
                                                                <?php 
                                                                    $suma_tokens=0;
                                                                    for($a=$fecha->desde;$a<=$fecha->hasta;$a++){
                                                                ?>	
                                                                        <td class="text-center" style="width:6.6%;">
                                                                            <?php 
                                                                                if(isset($dias_array[$a])){
																					$total_array[$a]	=	$dias_array[$a];
                                                                                    echo 'X';	
                                                                                }else{
																					$total_array[$a]	=	0;
                                                                                    echo '-';	
                                                                                }
                                                                            ?>
                                                                        </td> 
                                                                <?php	
                                                                    }?>  
                                                            </tr>
                                                <?php	
                                                        }
                                                    }
                                                ?> 
                                            </table>
                                        <?php 
											}
										?>
                                    </td>
                                    <td class="text-right">
											<table style="width:100%;">
                                                <?php 	
                                                    foreach($this->$modulo->result["modelos"] as $k2	=>	$v2){
                                                        foreach($total_array as $k3=> $v3){
                                                ?>
                                                            <tr>
                                                                <td class="text-center" style="width:6.6%;">
                                                                    <?php 
                                                                        print($v3);
                                                                    ?>
                                                                </td> 
                                                            </tr>
                                                <?php	
                                                        }
                                                    }
                                                ?> 
                                            </table>
									</td>                              	
                                </tr>
                                <?php }?>
                            </tbody>
						</table>         
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>