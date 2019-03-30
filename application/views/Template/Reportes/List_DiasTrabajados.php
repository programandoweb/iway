<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php
	$modulo		=	$this->ModuloActivo;
	$fecha 		= 	get_cf_ciclos_pagos_new($this->user->id_empresa,0);
	$dias_laborados	=	$this->$modulo->result["dias_laborados"];
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
       	 	<div class="row filters submenu">
                <div class="col-md-12">
                	<?php 
						echo TaskBar(array("name"		=>	array(	"title"	=>	"Reportes X Modelos.",
																	"icono"	=>	'<i class="fas fa-users"></i>',
																	"url"	=>	current_url()),
		                                                            "impresion" =>  true,
		                                                            "pdf"       =>  true,
		                                                            "excel"     =>  true,
                                                            		"mail"      =>  array(  "id"    =>  "mail" ),

									)
								);
					?>                	
                </div>
            </div>
        	<div class="row" id="imprimeme">
            	<div class="col-md-12">
					<?php
						$suma_token			=	0;
						$suma_equivalencia	=	0;
					?>
					<table class="ordenar display table table-hover">
						<thead>
							<tr>
								<th class="thead-light"><b>Modelo</b></th>                                
                                <?php 
									for($a=$fecha->desde;$a<=$fecha->hasta;$a++){
								?>	
                                		<th class="thead-light"><b><?php echo $a?></b></th> 
                                <?php	
									}
								?>
                                <th width="20" class="text-center thead-light"><b>Total</b></th>  
							</tr>
						</thead>
						<tbody>
						 <?php foreach ($this->$modulo->result["data"] as $k => $v){ ?>
						 	<tr>
								<td>
                                	
									<?php 
										print(nombre($v));
									?> 
                                    
                                </td>
                               <?php 
							   		$contar_dias=0;
									for($a=$fecha->desde;$a<=$fecha->hasta;$a++){
								?>	
								<?php 	
										if (isset($dias_laborados[$v->user_id][$a])){
											$contar_dias++;
								?>
                                            <td>
                                                <b>
                                                    X
                                                </b>
                                            </td>
								<?php		
										}else{
								?>
                                            <td>
                                                <b>
                                                    -
                                                </b>
                                            </td>
                                <?php		
										} 
								?>
                                <?php	
									}
								?>
                                 <td class="text-center"><b><?php echo $contar_dias;?></b></td> 
							</tr>
						 <?php } ?>							
						</tbody>
					</table>
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
