<?php
	$modulo			= 	$this->ModuloActivo;
	$trm			=	get_cf_ciclos_pagos_new($this->user->id_empresa,0);
	$global			=	$this->$modulo->result["global"];
	$data			=	$this->$modulo->result["data"];
	$plataformas	=	$this->$modulo->result["plataformas"];
	$plataforma		=	$this->$modulo->result["plataforma"];
	$modelos		=	$this->$modulo->result["modelos"];
	$desde			=	strftime("%d",strtotime($this->uri->segment(4)));
	$hasta			=	strftime("%d",strtotime($this->uri->segment(5)));
	$hidden 		= 	array();
	echo form_open(base_url("Reportes/Quincenales/Aprobar"),array('ajaxing' => 'true'),$hidden);
?>
<div class="container">
	<div class="row justify-content-md-center">
        <?php
            if($this->uri->segment(6) == "true"){
        ?>
            <div class="container text-center m-4">
                <h2 class="font-weight-700 text-uppercase orange">REPORTE APROBADO</h2>
            </div>
        <?php
            }
        ?>
    	<div class="col">
        	<div class="row" id="imprimeme">
            	<div class="col-md-12">
					<?php
                            $total_x_modelo			=	array();
                            $sum_x_plataforma_total	=	0;
                            if(count($modelos)>0){
                            foreach($modelos as $k => $v){
                                if(count($plataformas[$k])>0){
                    ?>
                                    <div id="<?php echo $k;?>">
                                        <table class="table table-hover table-short" >
                                            <thead>
                                                <tr>
                                                    <th >
                                                    	Plataforma
	                                                    <input type="hidden" name="id_modelo" value="<?php echo $k;?>" />
                                                        <input type="hidden" name="fecha_desde" value="<?php echo $this->uri->segment(4);?>" />
                                                        <input type="hidden" name="fecha_hasta" value="<?php echo $this->uri->segment(5);?>" />
                                                    </th>
                                                    <?php 
                                                        $color_gris	=	0;
                                                        $trm->desde	=	(int) date('d', strtotime($this->CicloDePago["objeto"]->fecha_desde));
                                                        $trm->hasta	=	(int) date('d', strtotime($this->CicloDePago["objeto"]->fecha_hasta));
                                                        for($a=$desde; $a<=$hasta;$a++ ){
															
                                                    ?>
                                                        <th class="dias <?php echo ($color_gris==0)?"gris":""; if($color_gris==0){$color_gris++;}else{$color_gris=0;}?>">
                                                            <input type="hidden" name="json[plataformas][]" value="<?php echo $a;?>" />
                                                            <?php echo $a;?>
                                                        </th>
                                                    <?php	
                                                        }
                                                    ?>
                                                    <th width="100" class="text-right">Total Tokens</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $suma_x_dia=array();
                                                    $sum_x_plataforma_total=0;
                                                    $sum_x_modelos_total=0;
                                                    if(count($this->$modulo->result["plataformas"][$k]) > 0){
                                                        foreach($this->$modulo->result["plataformas"][$k] as $k2	=> 	$v2){
                                                        //$tokens		=	get_reporte_quincenal_x_modelo($k,$plataforma[$k2],$desde, $hasta);
                                                        
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <?php print($k2);?>			
                                                        </td>
                                                        <?php 
                                                            $sum_x_modelos=0;
                                                            
                                                            $color_gris=0;
                                                            $trm->desde	=	(int) $trm->desde;
                                                            $sum_x_plataforma		=	0;
															
                                                            for($a=$desde; $a<=$hasta;$a++ ){
                                                                if($a<10){
                                                                    $num	=	"0".$a;	
                                                                }else{
                                                                    $num	=	$a;	
                                                                }
                                                        ?>
                                                                  <td class="dias">
                                                                    <?php
                                                                        $tokens = 0;
                                                                        $tokens = @$data[$k][$k2][$a];
                                                                        /*if(!empty($data[$k][$k2][$a])){
                                                                            foreach (@$data[$k][$k2][$a] as $key => $v) {
                                                                                $tokens += $v;
                                                                            }                                    
                                                                        }*/
                                                                        @$suma_x_dia[$a]        +=  @$tokens;
                                                                        $sum_x_plataforma       +=  @$tokens;
                                                                        $sum_x_plataforma_total +=  @$tokens;

                                                                        echo format($tokens,false);
                                                                    ?>
                                                                    <input type="hidden" name="json[suma_x_dia][<?php echo $a;?>]" value="<?php echo (!empty($tokens))?$tokens:0;?>" />
                                                                    <input type="hidden" name="json[sum_x_plataforma][<?php echo $a;?>]" value="<?php echo (!empty($tokens))?$tokens:0;?>" />
                                                                    <input type="hidden" name="json[sum_x_plataforma_total][<?php echo $a;?>]" value="<?php echo (!empty($tokens))?$tokens:0;?>" />
                                                                  </td>
                                                        <?php
                                                            }
                                                        ?>
                                                        <td class="text-right">
                                                            <?php echo format($sum_x_plataforma,false,true);?>
                                                        </td>
                                                    </tr>
                                                <?php
                                                        }		
                                                    }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Total:</th>
                                                    <?php 
                                                      
                                                        for($a=$desde; $a<=$hasta;$a++ ){
                                                    ?>
                                                              <th class="text-center">
                                                                 <?php echo format(@$suma_x_dia[$a],false,true);?>
                                                              </th>
                                                    <?php
                                                        }
                                                    ?>
                                                    
                                                    <th class="text-right">
                                                        <?php
                                                            @$sum_x_modelos_total2[$k]["modelo"]	=	$v;
                                                            @$sum_x_modelos_total2[$k]["monto"]		+=	$sum_x_plataforma_total;
                                                            echo format($sum_x_plataforma_total,false,true);
                                                        ?>
                                                        <input type="hidden" name="json[sum_x_modelos_total2][<?php echo $k;?>][modelo]" value="<?php echo $v;?>" />
                                                    </th>
                                                </tr>
                                            </tfoot>
                                        </table>                                                        
                                    </div>
                        <?php		
                                }else{
                        ?>
                                    <div >
                                        <h3>NO hay datos</h3>
                                        <table class="table table-hover table-short" >
                                            <thead>
                                                <tr>
                                                    <th width="100">Plataforma</th>
                                                    <th></th>
                                                    <th width="100" class="text-right">Total Tokens</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="3" class="text-center">
                                                        No existen datos
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>                                                       
                                    </div>
                        <?php			
                                }
                            }
                            }else{
                        ?>
                                <div >
                                    <table class="table table-hover table-short" >
                                        <thead>
                                            <tr>
                                                <th width="100">Plataforma</th>
                                                <th></th>
                                                <th width="100" class="text-right">Total Tokens</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="3" class="text-center">
                                                    No existen datos
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>                                                       
                                </div>
                        <?php			
                            }
                        ?>
                </div>
            </div>
            <div class="row text-center">
            	<div class="col">
                    <?php
                       if(!empty($modelos)){
                            $array_hasta = explode("-",$this->uri->segment(5));
                            if($array_hasta[0] == date("Y") && $array_hasta[1] == date("m") && ($array_hasta[2] - date("d")) <= 2){
                    ?>
			     		   <button type="submit" class="btn btn-primary" require="true" value="save">Estoy de acuerdo, Quiero aprobarlo</button>
                    <?php
                            }else{
                    ?>
                            <button type="button" disabled="disabled" class="btn btn-secondary"><b>Estoy de acuerdo, Quiero aprobarlo</b></button>
                    <?php
                            }
                        }
                    ?>                                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php //echo form_close();?>