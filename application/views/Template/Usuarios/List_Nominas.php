<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
$modulo		=	$this->ModuloActivo;
$ciclo		=	$this->$modulo->fields;
$activos	=	$this->$modulo->result["activos"];
$pagados	=	$this->$modulo->result["pagados"];
$pendientes	=	$this->$modulo->result["pendientes"];
$aprobados	=	$this->$modulo->result["aprobados"];
//pre($this->$modulo->result['pendientes'] );return;
?>
<div class="container" id="main_">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Liquidación recaudos Modelos.",
															"icono"=>'<i class="fas fa-bars"></i>',
															"url"	=>	current_url()),
									"config"	=>	array(	"title"	=>	"Personalización",
															"icono"	=>	'<i class="fas fa-cogs"></i>',
															"size"	=>	'modal-md',
															"height"=>	340,
															"url"	=>	base_url("Configuracion/OpcionesHonorariosModelos"),
															"lightbox"=>true),
																					
							)
						);
			?>
            <div class="row" id="imprimeme">
            	<div class="col-md-12  bd-example-tabs">
                    <ul class="nav nav-tabs" role="tablist">
                    	 <li class="nav-item">
                            <a class="nav-link <?php if(count($pendientes)<1){?> active <?php }?>" id="registro-tab" data-toggle="tab" href="#registro" role="tab">
                                Actual
                            </a>
                         </li>                         
                         <li class="nav-item">
                            <a class="nav-link" id="aprobados-tab" data-toggle="tab" href="#aprobados" role="tab">
                                Todos
                            </a>
                         </li>
                         <?php if(count($pendientes)>0){?> 
                             <li class="nav-item">
                                <a class="nav-link" id="observacion-tab" data-toggle="tab" href="#observacion" role="tab">
                                    Por Completar
                                </a>
                             </li>
                        <?php }?>
                    </ul> 
                    <div class="tab-content col-md-12">
                        <div id="registro" class="tab-pane <?php if(count($pendientes)<1){?> active <?php }?> row justify-content-md-center" role="tabpanel">
                            <div class="col-md-12">
                                <table class="table table-hover ordenar" ordercol=3 order="desc">
                                    <thead>
                                        <tr>
                                            <th><b>Nombre</b></th>
                                            <th><b>Escala</b></th>
                                            <th class="text-center">Sede</th>
                                            <th class="text-center">Tipo de tercero</th>
                                            <th width="100" class="text-center"><b>Vr. Honorarios</b></th>
                                            <th width="80" class="text-center"><b>Acción</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            
                                            if(count($activos)>0){
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
                                                        <td class="text-right">
                                                            <?php 
																//pre($v->ajuste_a_la_decena);
																$total_general+=$v->ajuste_a_la_decena;
																print(format($v->ajuste_a_la_decena,false));
	                                                        ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                            <?php
                                                                if(isset($escala->nombre_escala)){ ?>
                                                                    <a class="lightbox" title="Honorarios de <?php echo nombre($v->v);?>" data-type="iframe" href="<?php echo base_url("Usuarios/HonorariosModelo/".$v->v->user_id)?>">
                                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                                	</a>
                                                            <?PHP }else{?>
                                                                        <i class="fa fa-error" aria-hidden="true"></i>
                                                            <?PHP }?>
                                                                <a class="ml-1" target="_blank" title="pdf" href="<?php echo base_url("Usuarios/HonorariosModelo/".$v->v->user_id."/PDF")?>">
                                                                    <i class="fas fa-file-pdf"></i>
                                                                </a>
                                                            </div>
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
                                        <th class="text-right"><?php echo format($total_general,false);?></th>
                                        <th></th>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div id="aprobados" class="tab-pane row justify-content-md-center" role="tabpanel">
							<?php
								//$pagados	=	Operaciones(array("tipo_documento"=>14));								pre($pagados);
                            ?>
                            <div class="col-md-12">
                                <table class="table table-hover ordenar"  ordercol=4 order="desc">
                                    <thead>
                                        <tr>
                                            <th  width="280"><b>Nombre</b></th>
                                            <th><b>Escala</b></th>
                                            <th class="text-center">Sede</th>
                                            <th class="text-center">Tipo de tercero</th>
                                            <th>Estatus</th>
                                            <th class="text-center"><b>Vr. Honorarios</b></th>
                                            <th class="text-center"><b>Documento</b></th>
                                            <th class="text-center"><b>Acción</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            
                                            if(count($aprobados)>0){
                                                foreach($aprobados as $v){
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
																print(centrodecostos($v->escala->centro_de_costos)->abreviacion);
															?>
                                                        </td>
                                                        <td class="text-center">
                                                        	<?php
																print($v->escala->type);
															?>
                                                        </td>
                                                        <td>
                                                        	<?php 
																print($v->estatus);
															?>
                                                        </td>
                                                        <td class="text-right">
                                                            <?php 
																	
																$honorarios			=	get_rp_honorarios_modelos($v->chequeo->modelo_id,$v->chequeo->consecutivo);
																$json_honorarios	=	json_decode($honorarios->json);
																//pre($json_honorarios->porcentaje_retencion);
																print(format($json_honorarios->pago_global,true));
	                                                        ?>
                                                        </td>
                                                        <td class="text-center">
                                                        	<a class="lightbox documentos" title="Honorarios de <?php echo nombre($v->v);?>" data-type="iframe" href="<?php echo base_url("Usuarios/HonorariosModeloAprobados/".$v->v->user_id."/".$v->chequeo->consecutivo)?>">
																<?php
                                                                    print($v->chequeo->consecutivo);
                                                                ?>
                                                            </a>
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                                <a class="ajax" title="Anular aprobación <?php echo nombre($v->v);?>" href="<?php echo base_url("Usuarios/HonorariosModeloAnular/".$v->v->user_id."/".$v->chequeo->consecutivo)?>">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </a>
                                                            </div>
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
                   <?PHP if(count($pendientes)>0){?>
                        <div id="observacion" class="tab-pane <?PHP if(count($pendientes)>0){?> actives <?php }?>  row justify-content-md-center" role="tabpanel">
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
			$.post("<?php echo site_url("Usuarios/HonorariosModelo")?>/"+$(this).val());			
		});
		if(reloader==true){
			//setTimeout(function(){document.location.reload();}, 2500);
			
		}
	});
</script>