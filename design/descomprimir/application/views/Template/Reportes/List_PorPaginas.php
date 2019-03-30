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
                    	Reportes X Plataforma.
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
									$total_x_plataforma		=	array();	 
                                    foreach($this->$modulo->result["global"] as $k => $v){
                                        if(is_object($v) && isset($this->$modulo->result["detallado"][$v->id_plataforma])){
                                ?>
                                			<div id="<?php echo $v->primer_nombre;?>">
                                            	<h3><?php print($v->primer_nombre);?></h3>
                                                <table class="table table-hover table-short" >
                                                    <thead>
                                                        <tr>
                                                            <th width="180">Nickname</th>
                                                            <?php 
                                                                $color_gris	=	0;
                                                                $trm->desde	=	(int) $trm->desde;
                                                                for($a=$trm->desde; $a<=$trm->hasta;$a++ ){
                                                            ?>
                                                                <th class="dias <?php echo ($color_gris==0)?"gris":""; if($color_gris==0){$color_gris++;}else{$color_gris=0;}?>"><?php echo $a;?></th>
                                                            <?php	
                                                                }
                                                            ?>
                                                            <th class="text-right">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                            $total_tokens=0;
                                                            $count	=	0;
                                                            if(isset($this->$modulo->result["detallado"][$v->id_plataforma])){
                                                                foreach($this->$modulo->result["detallado"][ $v->id_plataforma] as $k2=>$v2){
                                                                    $tokens=get_reporte_quincenal($v2->id_modelo,$v2->nickname_id,$desde=false , $hasta=false);
																	if(!empty($tokens)){
                                                                    ?>
                                                                        <tr>
                                                                            <td>
                                                                                <?php 
                                                                                    print($v2->nickname);
                                                                                    
                                                                                ?>
                                                                            </td>
                                                                            <?php 
                                                                                $sum_td		=	0;
                                                                                $trm->desde	=	(int) $trm->desde;
                                                                                $color_gris	=	0;
                                                                                
                                                                                for($a=$trm->desde; $a<=$trm->hasta;$a++ ){
                                                                                    if($a<10){
                                                                                        $num	=	"0".$a;	
                                                                                    }else{
                                                                                        $num	=	$a;	
                                                                                    }
                                                                            ?>
                                                                                    <td width="10" class="dias <?php echo ($color_gris==0)?"gris":""; if($color_gris==0){$color_gris++;}else{$color_gris=0;}?>"><?php $tokens_echo	=@$tokens[$num]->tokens; echo ($tokens_echo=='')?"0":str_replace("0.00","0",format($tokens_echo,false)); $sum_td +=@$tokens[$num]->tokens; $total_tokens +=@$tokens[$num]->tokens ?></td>
                                                                            <?php	
                                                                            }
                                                                            ?>
                                                                            <td width="10"  class="text-right"><?php echo format($sum_td,false);?></td>
                                                                            <?php //print(format($v->tokens,false));?>
                                                                        </tr>
                                                        <?php 			$count++;
                                                            
																	}
																}
                                                            }?>
                                                    </tbody>
                                                    <tfoot>
                                                         <tr>
                                                            <th ></th>
                                                            <?php 
                                                                $color_gris	=	0;
                                                                $trm->desde	=	(int) $trm->desde;
                                                                for($a=$trm->desde; $a<$trm->hasta;$a++ ){
                                                            ?>
                                                                <th class="dias"></th>
                                                            <?php	
                                                                }
                                                            ?>
                                                            <th class="text-right">Total</th>
                                                            <th class="text-right">
																<?php echo format($total_tokens,false); $total_x_plataforma[$v->primer_nombre]	= $total_tokens;?>
                                                                <input data-rel="<?php echo $v->primer_nombre;?>" type="hidden" class="total_tokens" id="total_tokens_<?php echo $v->primer_nombre;?>" value="<?php echo $total_tokens;?>" />
                                                            </th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
											</div>                                                
									<?php		
                                        }else{
									?>											
                                    	<input data-rel="<?php echo $v->primer_nombre;?>" type="hidden" class="total_tokens" id="total_tokens_<?php echo $v->primer_nombre;?>" value="<?php echo $total_tokens;?>" />
									<?php                                            
										}
									}
                                    ?>
                                        
                        		</div>
                        		<div role="tabpanel" class="tab-pane fade show active" id="home" aria-labelledby="home-tab">
                                	<div >
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th >Plataforma</th>
                                                    <th width="120"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    foreach($this->$modulo->result["global"] as $k => $v){
                                                        if(is_object($v)){
                                                ?>
                                                        <tr id="resumen<?php print($v->primer_nombre);?>">
                                                            <td>
                                                                <a href="#<?php print($v->primer_nombre);?>" class="lightbox" title="Detalle <?php print($v->primer_nombre);?>">
                                                                    <?php print($v->primer_nombre);?>
                                                                </a>
                                                            </td>
                                                            <td class="text-right">
                                                                <a href="#<?php print($v->primer_nombre);?>" class="lightbox" title="Detalle <?php print($v->primer_nombre);?>">
                                                                    <?php print(format(@$total_x_plataforma[$v->primer_nombre],false));?>                                                        
                                                                </a>                                                                
                                                            </td>
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