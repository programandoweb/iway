<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php
	$modulo	= $this->ModuloActivo;
	$trm	= get_cf_ciclos_pagos_new($this->user->id_empresa,0);	
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
       	 	<div class="row filters">
            	<div class="col-md-6">
		            <h4 class="font-weight-700 text-uppercase orange">
                    	Reportes X Períodos.
					</h4>
                </div>
            </div>
        	<div class="row">
            	<div class="col-md-12">
					<div class="section">
                        <div class="bd-example bd-example-tabs" role="tabpanel">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                	<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile">
                                    	Discriminado de facturación por Plataforma
                                    </a>
                                </li>
                                <li class="nav-item">
                              	  	<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-expanded="true">
                                    	Resumen de Facturación por Plataforma
                                    </a>
                                </li>
                            </ul>
                        	<div class="tab-content" id="myTabContent">
                            	<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
									<?php
                                        $total_x_modelo		=	array();	 
                                        foreach($this->$modulo->result["global"] as $k => $v){
                                            
                                            if(is_object($v) && isset($this->$modulo->result["detallado"][$v->id_plataforma])){
												if(count($this->$modulo->result["detallado"][$v->id_plataforma])>0){
                                               // pre(@$this->$modulo->result["detallado"][$v->id_plataforma]);
                                    ?>
                                                    <div id="<?php echo $v->primer_nombre;?>">
                                                        <h3><?php print($v->primer_nombre);?></h3>
                                                        <table class="table table-hover table-short" >
                                                            <thead>
                                                                <tr>
                                                                    <th width="200">Modelo</th>
                                                                    <?php 
                                                                        $color_gris	=	0;
                                                                        $trm->desde	=	(int) $trm->desde;
                                                                        for($a=$trm->desde; $a<=$trm->hasta;$a++ ){
                                                                    ?>
                                                                        <th class="dias <?php echo ($color_gris==0)?"gris":""; if($color_gris==0){$color_gris++;}else{$color_gris=0;}?>"><?php echo $a;?></th>
                                                                    <?php	
                                                                        }
                                                                    ?>
                                                                    <th width="200" class="text-right">Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                
                                                                <?php
                                                                    foreach($this->$modulo->result["detallado"][$v->id_plataforma] as $v2){
                                                                        $tokens=get_reporte_quincenal_x_modelo($v2->id_modelo,$desde=false , $hasta=false);
                                                                ?>
                                                                    <tr>
                                                                        <td>
                                                                            <?php print($v2->modelo);?>			
                                                                        </td>
                                                                        <?php 
                                                                            $color_gris	=	0;
                                                                            $trm->desde	=	(int) $trm->desde;
                                                                            for($a=$trm->desde; $a<=$trm->hasta;$a++ ){
																				if($a<10){
																					$num	=	"0".$a;	
																				}else{
																					$num	=	$a;	
																				}
                                                                        ?>
                                                                                  <td class="dias">
																				  	<?php
																						echo format(@$tokens[$num]->tokens,false);
																				  	?>
                                                                                  </td>
                                                                        <?php
                                                                            }
                                                                        ?>
                                                                        <td>
                                                                        
                                                                        </td>
                                                                    </tr>
                                                                <?php		
                                                                    }
                                                                ?>
                                                                
                                                            </tbody>
                                                        </table>                                                        
                                                    </div>
                                            
                                    <?php		}
                                            }
                                        }
                                    ?>
                                </div>
                        		<div role="tabpanel" class="tab-pane fade show active" id="home" aria-labelledby="home-tab">
                                	<div >
                                       
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
		$(".lightbox").click(function(){
			$(".modal-body").html($($(this).attr("href")).html());
		});	
		$(".total_tokens").each(function(k,v){
			console.log($(this).val());
			if($(this).val()=="0"){
				$("#"+$(this).data("rel")).remove();
				$("#resumen"+$(this).data("rel")).remove();
				//console.log("#resumen"+$(this).data("rel"));
			}			
		})
	})
</script>