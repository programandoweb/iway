<?php
	$modulo	=	$this->ModuloActivo;
	$fecha	=	get_cf_ciclos_pagos_new($this->user->id_empresa,0);
	$data	=	$this->$modulo->result["data"];
	$modelos=	$this->$modulo->result["modelos"];
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
       	 	<?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Reportes X Plataforma.",
															"icono"	=>	'<i class="fas fa-users"></i>',
															"url"	=>	current_url()),
                                                            "pdf"   =>  true,
                                                            "excel"     =>  true,
                                                            "mail"      =>  array(  "id"    =>  "mail" ),
							)
						);
			?>
            <div class="row">
	            <div class="col-md-8">
                </div>
                <div class="col-md-4">
	                <?php echo MakePeriodosPago();?>
                </div>
            </div>
            <?php foreach($modelos as $k => $v){?>
            	<div class="section">
                    <div class="row">
                        <h3 class="col"><?php print($k);?></h3>
                    </div>
                    <?php foreach($v as $k2 => $v2){?>
                        <div class="row">
							<div class="col-md-2 col-xs-12">
                            	<?php print($v2->primer_nombre.' '.$v2->primer_apellido);?> 
                            </div>
                            <div class="col-md-10 col-xs-12">
                            	<table width="100%" border="0" cellpadding="0" cellspacing="0">
                                	<thead>
                                    	<?php 
											for($a=$fecha->desde;$a<=$fecha->hasta;$a++){
										?>	
												<th class="text-center" style="width:6.6%;">
													<?php echo $a?>
                                                </th>                                                 
										<?php	
											}
										?>
                                    </thead>
                                    <tbody>
                                    	<tr style="background-color:#f2f2f2;">
                                        	<?php 
											
											foreach($this->$modulo->result["data"][$k][$v2->modelo_id] as $k3=> $v3){
												$dias_array[$v3->dia]	=	($v3->credito>0)?$v3->credito:$v3->debito;
											}

											for($a=$fecha->desde;$a<=$fecha->hasta;$a++){
											?>	
													<td class="text-center" style="width:6.6%;">
														<?php 
															if(isset($dias_array[$a])){
																print(format($dias_array[$a],false));
															}else{
																echo '-';	
															}
															//echo $dias_array[$a];
														?>
													</td>                                                 
											<?php	
												}
											?>
                                        </tr>
                                    </tbody>
                                    <tfoot>
										<tr>
                                        	<?php
												for($a=$fecha->desde;$a<=$fecha->hasta;$a++){
											?>	
													<th class="text-center" style="width:6.6%;">
														
													</th>                                                 
											<?php	
												}
											?>
                                        </tr>
                                    </tfoot>
                                </table>
                          	</div>                            
                        </div>
                    <?php }?>
                </div>
            <?php }?>
        </div>
    </div>
</div>