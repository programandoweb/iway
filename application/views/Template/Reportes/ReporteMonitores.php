<?php

$modulo		=	$this->ModuloActivo;
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<?php
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Reportes por Monitor",
															"url"	=>	current_url())												
						)
					);
			?>
            <div class="row">
            	<div class="col-md-12">
                    <table class="ordenar display table table-hover" data-url="<?php echo current_url()?>" ordercol=1 order="desc">
                        <thead>
                            <tr>
                                <th class="text-center">Avatar</th>
                                <th>Nombre</th>
                                <th>Último día</th>
                                <!--<th>Meta real</th>-->
                                <th>Meta ideal</th>
                                <th class="text-center">Total producción</th>
                                <th>Me falta</th>
                                <th>Cumplimiento</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php 
                                $total_ultimo = 0;
                                $meta_real    = 0;
                                $meta_ideal   = 0;
                                $me_falta     = 0;
                                $cumplimiento = 0;
                                $total        = 0;
								foreach(GetUsuarios("Monitores",$select="*",$this->user->id_empresa,1) as $k=> $v){
                                    $resumen_monitor = get_reporteModelos_x_Monitor($v->user_id,$v->centro_de_costos,true);
                                    if(!empty($resumen_monitor)){
                            ?>
                                <tr>
                                    <td>
                                        <img id="efectoImagen" src="<?php print(img_profile($v->user_id))?>" class="img rounded-circle mx-auto d-block" width="30" alt="<?php print(nombre($v))?>" />
                                    </td>
                                    <td><?php echo(nombre($v))?></td>
                                    <td class="text-center">
                                        <?php
                                            $total_ultimo += $resumen_monitor["operaciones"]["ultimo_dia"];  
                                            echo format($resumen_monitor["operaciones"]["ultimo_dia"],false); 
                                        ?>
                                    </td>
                                    <!--<td class="text-center">
                                        <?php
                                            $meta_real += $resumen_monitor["operaciones"]["meta_real"];
                                            echo format($resumen_monitor["operaciones"]["meta_real"],false);  
                                        ?>
                                    </td>-->
                                    <td class="text-center">
                                        <?php 
                                            $meta_ideal += $resumen_monitor["operaciones"]["meta_ideal"];
                                            echo format($resumen_monitor["operaciones"]["meta_ideal"],false); ?>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn-btn-secondary- lightbox vin" title="Detalle reporte" data-type="iframe" href="<?php echo base_url("Reportes/detalleReporteMonitor/".$v->user_id.'/'.$v->centro_de_costos)?>">
                                            <?php 
                                                $bonificacion_X_modelos = @$resumen_monitor[0]->monto; 
                                                echo format(($bonificacion_X_modelos),false);
                                                $total += $bonificacion_X_modelos;
                                            ?>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <?php 
                                            $me_falta += $resumen_monitor["operaciones"]["me_falta"];
                                            echo format($resumen_monitor["operaciones"]["me_falta"],false); ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                            $cumplimiento +=  $resumen_monitor["operaciones"]["cumplimiento"];
                                            echo format($resumen_monitor["operaciones"]["cumplimiento"],false); ?> %</td>
                                </tr>
                            <?php
                                    }
                                }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr class="colorFondo">
                                <th class="text-center"></th>
                                <th class="text-right">Total</th>
                                <th class="text-center"><?php echo format($total_ultimo,false); ?></th>
                                <!--<th class="text-center"><?php echo format($meta_real,false); ?></th>-->
                                <th class="text-center"><?php echo format($meta_ideal,false); ?></th>
                                <th class="text-center"><?php echo format($total,false); ?></th>
                                <th class="text-center"><?php echo format($me_falta,false) ?></th>
                                <th class="text-center"><?php echo format(($cumplimiento/($k+1)),false); ?> %</th>
                            </tr>
                        </tfoot>
                    </table>
				</div>
            </div>
        </div>
    </div>
</div>
