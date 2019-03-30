<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
$modulo		=	$this->ModuloActivo;
$rows = $this->$modulo->result;
$monitor    = nombre(centrodecostos($this->uri->segment(3)));
$ciclos_pagos = get_cf_ciclos_pagos(date("m"),$this->uri->segment(4));
$total_ultimo_dia = 0;
$total_meta = 0;
$total_meta_ideal = 0;
$asi_voy = 0;
$me_falta = 0;
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<?php
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Detalle reporte ".nombre(centrodecostos($this->uri->segment(3))),
															"url"	=>	current_url()),
                                   "pdf"		=>	array(  "title" =>  "Ver PDF",
                                                            "url"   =>  current_url().'/PDF')									
						)
					);
			?>
            <div class="row">
            	<div class="col-md-12">
                    <div class="row">
                        <table class="ordenar display table table-hover" ordercol=0 order="asc">
                            <thead>
                                <tr>
                                    <th class="text-center">Nombre Modelo</th>
                                    <th class="text-center">Turno</th>
                                    <th class="text-center">Escala</th>
                                    <th class="text-center">Último día</th>
                                    <!--<th class="text-center">Meta Real</th>-->
                                    <th class="text-center">Meta Ideal</th>
                                    <th class="text-center">Así voy</th>
                                    <th class="text-center">Me falta</th>
                                    <th class="text-center">Cumplimiento</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php 
									foreach($rows as $k=> $v){?>
                                        <tr>
                                            <td><?php print(nombre($v))?></td>
                                            <td>
                                                <?php
                                                    if($v->turno_manama>0){
                                                        echo "Mañana";
                                                    }
                                                    if($v->turno_tarde>0){
                                                        echo "Tarde";
                                                    }
                                                    if($v->turno_noche>0){
                                                        echo "Noche";
                                                    }
                                                    if($v->turno_intermedio>0){
                                                        echo "Intermedio";
                                                    }
                                                    if($v->turno_manama==0 && $v->turno_tarde==0 && $v->turno_noche==0 && $v->turno_intermedio==0 ){
                                                        echo "Default";
                                                    }
                                                ?>
                                            </td>
                                            <td class="text-center"><?php echo $v->nombre_escala;?></td>
                                            <td class="text-right">
                                                <?php
                                                    $ultimo_dia = get_ultimo_dia($v->user_id)->tokens;
                                                    if(!empty($ultimo_dia)){
                                                        $total_ultimo_dia += $ultimo_dia;
                                                        echo format($ultimo_dia,false);
                                                    }else{
                                                        echo "---";
                                                    } 
                                                ?>
                                            </td>
                                            <!--<td class="text-center">
                                                <?php echo format($v->meta,false); $total_meta += $v->meta; ?>
                                            </td>-->
                                            <td class="text-right">
                                                <?php
                                                    echo @format($v->meta_ideal,false);
                                                    $total_meta_ideal +=  $v->meta_ideal;
                                                ?>
                                            </td>
                                            <td class="text-right">
                                                <?php
                                                    foreach($ciclos_pagos as $k1 => $v1){
                                                        if($v1->fecha_desde < date("Y-m-d") && $v1->fecha_hasta > date("Y-m-d")){
                                                            $total_produccion   = get_total_tokens($v->user_id,$v1->fecha_desde,$v1->fecha_hasta);
                                                        }
                                                    }
                                                    if($total_produccion > 0){
                                                        $asi_voy += $total_produccion;
                                                        echo @format($total_produccion,false);
                                                    }else{
                                                        echo "---";
                                                    }
                                                ?>
                                            </td>
                                            <td class="text-right">
                                                <?php
                                                    echo @format(($v->meta_ideal - $total_produccion),false);
                                                    $me_falta += ($v->meta_ideal - $total_produccion); 
                                                ?>
                                            </td>
                                            <td class="text-right">
                                                <?php 
                                                    if(!empty($v->meta_ideal) && !empty($total_produccion)){
                                                        echo format((($total_produccion/$v->meta_ideal)*100),false);    
                                                    }else{
                                                        echo "0";
                                                    } 
                                                ?> %
                                            </td>
                                        </tr>
                                <?php }?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-right"><b><?php echo format($total_ultimo_dia,false); ?></b></td>
                                    <!--<td class="text-right"><?php echo format($total_meta,false); ?></td>-->
                                    <td class="text-right"><b><?php echo format($total_meta_ideal,false); ?></b></td>
                                    <td class="text-right"><b><?php echo format($asi_voy,false) ?></b></td>
                                    <td class="text-right"><b><?php echo format($me_falta,false) ?></b></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>	
					</div>                                                    
                </div>
            </div>
        </div>
    </div>
</div>
