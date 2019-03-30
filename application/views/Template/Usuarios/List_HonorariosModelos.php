<?php

    $modulo		=	$this->ModuloActivo;
    $ciclo		=	$this->$modulo->fields;
    $activos	=	$this->$modulo->result["activos"];
    $pagados	=	$this->$modulo->result["pagados"];
    $pendientes	=	$this->$modulo->result["pendientes"];
    $aprobados	=	$this->$modulo->result["aprobados"];
?>
<div class="container" id="main_">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<?php
                $submenu =    array("name"        =>  array(  "title" =>  "Liquidación recaudos Modelos.",
                                                                                "icono"=>'<i class="fas fa-bars"></i>',
                                                                                "url"   =>  current_url()),
                                                        "config"    =>  array(  "title" =>  "Personalización",
                                                                                "icono" =>  '<i class="fas fa-cogs"></i>',
                                                                                "size"  =>  'modal-md',
                                                                                "height"=>  340,
                                                                                "url"   =>  base_url("Configuracion/OpcionesHonorariosModelos"),
                                                                                "lightbox"=>true)
                                                                                                        
                                                );
                if($this->user->type != "Asociados" && $this->user->type != "root" ){
                    unset($submenu['config']);
                } 
				echo TaskBar($submenu);
			?>
            <div class="row" id="imprimeme">
            	<div class="col-md-12  bd-example-tabs">
                    <ul class="nav nav-tabs" role="tablist">
                        <?php if(count($activos)>0){ ?>
                    	 <li class="nav-item">
                            <a class="nav-link active" id="registro-tab" data-toggle="tab" href="#registro" role="tab">
                                Prevalidar
                            </a>
                         </li>
                        <?php } ?>                         
                         <li class="nav-item">
                            <a class="nav-link" id="aprobados-tab" data-toggle="tab" href="#aprobados" role="tab">
                                General
                            </a>
                         </li>
                         <?php if(count($pendientes)>0  || empty($activos)){?> 
                             <li class="nav-item">
                                <a class="nav-link active" id="observacion-tab" data-toggle="tab" href="#observacion" role="tab">
                                    Pendientes
                                </a>
                             </li>
                        <?php }?>
                    </ul> 
                    <div class="tab-content col-md-12">
                        <?php if(count($activos)>0){ ?>
                        <div id="registro" class="tab-pane active row justify-content-md-center" role="tabpanel">
                            <div class="col-md-12">
                                <table class="table table-hover ordenar" ordercol=3 order="desc">
                                    <thead>
                                        <tr>
                                            <th><b>Nombre</b></th>
                                            <th><b>Escala</b></th>
                                            <th class="text-center">Sede</th>
                                            <th class="text-center">Tipo de tercero</th>
                                            <th width="80" class="text-center"><b>Acción</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
												$total_general	=	0;
                                                foreach($activos as $v){
													$escala		=	$v->escala;
                                        ?>
                                                    <tr>
                                                        <td>
                                                        	<?php echo nombre($v->v);?>
                                                        </td>
                                                        <td>
                                                            <?php echo (isset($escala->nombre_escala))?$escala->nombre_escala:'Pendiente';?>
                                                        </td>
                                                        <td class="text-center">
                                                        	<?php
																$tercero	=	centrodecostos($v->escala->centro_de_costos);
																print($tercero->abreviacion);
															?>
                                                        </td>
                                                        <td class="text-center">
                                                        	<?php
																print($v->escala->type);
															?>
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                            <?php
                                                                if(isset($escala->nombre_escala)){ ?>
                                                                    <a class="lightbox" title="Honorarios de <?php echo nombre($v->v);?>" data-type="iframe" data-event="reload" href="<?php echo base_url("Usuarios/HonorariosModelo/".$v->v->user_id)?>">
                                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                                	</a>
                                                            <?PHP }else{?>
                                                                        <i class="fa fa-error" aria-hidden="true"></i>
                                                            <?PHP }?>
                                                            </div>
                                                            <input type="hidden" class="monto_oculto" value="<?php echo $v->ajuste_a_la_decena;?>" />
                                                        </td>
                                                    </tr>
                                        <?php 		
                                                }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th class="text-right">Total</th>
                                        <th></th>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <?php } ?>
                        <div id="aprobados" class="tab-pane row justify-content-md-center" role="tabpanel">
							<?php
								//$pagados	=	Operaciones(array("tipo_documento"=>14));								pre($pagados);
                            ?>
                            <div class="col-md-12">
                                <table class="ordenar display table table-hover " ordercol=3 order="desc">
                                    <thead>
                                        <tr>
                                            <th class="text-left"><b>Fecha</b></th>
                                            <th class="text-center"><b>Tercero</b></th>
                                            <th><b>Operación</b></th>
                                            <th class="text-center"><b>Documento</b></th>
                                            <th class="text-right"><b>Total</b></th>
                                            <th width="60px" class="text-right"><b>Debo</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
											$aprobados2=get_rp_honorarios_modelos_aprobados();
                                            $total_honorarios_aprobados=0;
                                            $debo_honorario_total = 0;
                                            if(count($aprobados2)>0){
                                                foreach($aprobados2 as $v){
                                                    $Pagos  =   getMovimientosGeneral($v->consecutivo,NULL,14,NULL,$v->ciclo_produccion_id,$v->modelo_id);
                                                    $Total_pagado = 0;
                                                    foreach ($Pagos as $key => $value) {
                                                        $Total_pagado += $value->credito;
                                                    }
                                                    $escala				=	$v->id_escala;
													$honorarios			=	get_rp_honorarios_modelos($v->modelo_id,$v->consecutivo);
                                        ?>
                                                    <tr <?php if(!is_object($honorarios)){print('class="table-warning"');}?> >
                                                        <td>
                                                            <?php echo $v->fecha; ?>
                                                        </td>
                                                        <td>
                                                            <?php 
																echo nombre($v);
															?>
                                                        </td>
                                                        <td>
                                                            Pago Honorarios
                                                        </td>
                                                        <td class="text-center">
                                                            <?php
                                                                if(is_object($honorarios)){
                                                                    $json_honorarios    =   json_decode(@$honorarios->json);
                                                                    $total_honorarios_aprobados +=$json_honorarios->pago_global;

                                                                    $debo_honorario = $json_honorarios->pago_global - $Total_pagado;
                                                                }else{

                                                                    $debo_honorario = $v->chequeo->debito - $Total_pagado;
                                                                }
                                                            ?>
                                                        	<a class="lightbox documentos" title="Honorarios de <?php echo nombre($v);?>" data-type="iframe" <?php echo ($debo_honorario == 0)?:'data-event="reload"'; ?> href="<?php echo base_url("Usuarios/HonorariosModeloAprobados/".$v->modelo_id."/".$v->consecutivo."/".$v->estatus)?>">
																<?php
                                                                    print($v->consecutivo);
                                                                ?>
                                                            </a>
                                                        </td>
                                                        <td class="text-right">
                                                            <?php
                                                                if(is_object($honorarios)){
                                                                    print(format(@$json_honorarios->pago_global,false));
                                                                }else{
                                                                    echo '<div class="tachado">'.(format($v->chequeo->debito,false)).'</div>';
                                                                }
                                                            ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php
                                                                echo format($debo_honorario,false);
                                                                $debo_honorario_total =  $debo_honorario;
                                                            ?>
                                                        </td>
                                                    </tr>
                                        <?php 		
                                                }
                                            }else{
                                        ?>
                                        <?php		
                                            }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th class="text-right">Total</th>
                                        <th class="text-right"><?php echo format(@$total_honorarios_aprobados,false)?></th>
                                        <th class="text-right" style="padding-right: 2.3em;"><?php echo format(@$debo_honorario_total,false)?></th>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                   <?PHP if(count($pendientes)>0 || empty($activos)){?>
                        <div id="observacion" class="tab-pane <?PHP if(count($pendientes)>0){?> active <?php }?>  row justify-content-md-center" role="tabpanel">
                            <div class="col-md-12">
                            	<table class="table table-hover ordenar">
                                    <thead>
                                        <tr>
                                            <th><b>Nombre</b></th>
                                            <th></th>
                                            <th></th>
                                            <th><b>Escala</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            
                                            if(count($pendientes)>0){
                                                foreach($pendientes as $v){
                                                   $escala		=	$v->escala;
                                        ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo nombre($v->v);?>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <?php echo (isset($escala->nombre_escala))?$escala->nombre_escala:'Pendiente';?>
                                                        </td>
                                                    </tr>
                                        <?php 		
                                                }
                                            }else{
                                        ?>
                                        <?php		
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
						</div>      
						<?php }?> 
                    </div>
				</div>
            </div>
        </div>
    </div>
</div>
<script>
	$(document).ready(function(){
		var reloader	=	false;
		inputs			=	$(".update_user");
		inputs.each(function(index,v){
			reloader	=	true;	
			//$("#main_").addClass("blurdiv");
			$.post("<?php //echo site_url("Usuarios/HonorariosModelo")?>/"+$(this).val());			
		});
		if(reloader==true){
			//setTimeout(function(){document.location.reload();}, 2500);
			
		}
	});
</script>