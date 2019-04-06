<?php
	$modulo         =   $this->ModuloActivo;
    $row            =   $this->$modulo->result;
    $aprovadas = array();
    $rechazadas = array();
    $inasistente = array();
    foreach ($row as $indice => $val){
        if($val->estado == 2){
            $aprovadas[] = $val;
        }else if($val->estado == 3){
            $rechazadas[] = $val;
        }else if($val->estado == 4){
            $inasistente[] = $val;
        }
    }
    $sistema_salarial = centrodecostos($this->user->id_empresa)->sistema_salarial;
    //pre($row);
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
       	 	<?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Programar entrevistas",
															"url"	=>	current_url()),
															"add"	=>	array(	"title"	=>	"Programar Entrevista",
																				"lightbox"=>true,
                                                                        "url"=>base_url("Formularios/aspirante")),
                                   /*"config"    =>  array(  "title" =>  "Configuración email notificación",
                                                            "icono" =>  '<i class="fas fa-cogs"></i>',
                                                            "url"   =>  base_url("Utilidades/CorreoNotificacion/".$this->uri->segment(2)),
                                                            "lightbox"=>true),*/		
							)
						);
			?>
            <ul class="nav nav-tabs" role="tablist"> 
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#general" role="tab">
                        General
                    </a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#aprobadas" role="tab">
                        Aprobadas
                    </a>
                 </li> 
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#rechazadas" role="tab">
                        Rechazadas
                    </a>
                 </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#inasistente" role="tab">
                        No se presentó
                    </a>
                 </li> 
            </ul>
			<div class="section tab-content">
                <div id="general" class="tab-pane active" role="tabpanel">
                    <table class="ordenar display table table-hover" data-url="<?php echo current_url()?>" ordercol=1 order="desc">
                        <thead>
                            <tr>
                                <th>Nombre Aspirante</th>
                                <th style="text-align: center;">Consecutivo</th>
                                <th style="text-align: center;">Fecha</th>
                                <th style="text-align: center;">Hora</th>
                                <th style="text-align: center;">Edad</th>
                                <th style="text-align: center;">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(count($row)>0){
                                    foreach($row as $k => $v){
                                        if($v->estado == 1){
                                            $json = json_decode($v->data);
                            ?>
                                        <tr>
                                            <td>
                                                <?php echo @$json->Nombre; ?>
                                            </td>
                                        	<td style="text-align: center;">
                                                <a class="lightbox vin" title="Detalle Aspirante" data-type="iframe" href="<?php echo base_url("Formularios/detalleAspirante/".$v->id_form_contrl); ?>">
                                                    <?php echo @$v->consecutivo; ?>
                                                </a>        
                                            </td>
                                            <td style="text-align: center;"><?php echo @$json->Fecha; ?></td>
                                            <td style="text-align: center;"><?php echo @$json->hora.' ; '.@$json->minutos.' '.@$json->meridiano;?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php echo @$json->Edad; ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php
                                                    if($v->estado == 1){
                                                ?>
                                                <a class="" title="Aprobar aspirante" href="<?php echo base_url("Formularios/CambiarEstado/2/".$v->id_form_contrl);?>">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                                <a class="" title="Rechazar aspirante" href="<?php echo base_url("Formularios/CambiarEstado/3/".$v->id_form_contrl);?>">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                                <a class="" title="Inasistente" href="<?php echo base_url("Formularios/CambiarEstado/4/".$v->id_form_contrl);?>">
                                                    <i class="fas fa-user-times"></i>
                                                </a>
                                                <a class="lightbox" title="Editar aspirante" data-type="iframe" href="<?php echo base_url("Formularios/aspirante/".$v->id_form_contrl);?>">
                                                    <i class="fas fa-edit "></i>
                                                </a>
                                                <?php
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                            <?php
                                        }		
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div id="aprobadas" class="tab-pane" role="tabpanel">
                    <table class="ordenar display table table-hover" data-url="<?php echo current_url()?>" ordercol=1 order="desc">
                        <thead>
                            <tr>
                                <th>Nombre Aspirante</th>
                                <th style="text-align: center;">Consecutivo</th>
                                <th style="text-align: center;">Fecha</th>
                                <th style="text-align: center;">Hora</th>
                                <th style="text-align: center;">Edad</th>
                                <?php
                                    if($sistema_salarial == 1){
                                ?>
                                <th style="text-align: center;">Acción</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(count($aprovadas)>0){
                                    foreach($aprovadas as $k1 => $v1){
                                        $json1 = json_decode($v1->data);
                            ?>
                                        <tr>
                                           <td>
                                                <?php echo @$json1->Nombre; ?>
                                            </td>
                                            <td style="text-align: center;color: blue">
                                                <a class="lightbox vin" title="Detalle Aspirante" data-type="iframe" href="<?php echo base_url("Formularios/detalleAspirante/".$v1->id_form_contrl); ?>">
                                                    <?php echo @$v1->consecutivo; ?>
                                                </a>        
                                            </td>
                                            <td style="text-align: center;"><?php echo @$json1->Fecha; ?></td>
                                            <td style="text-align: center;"><?php echo @$json1->hora.' ; '.@$json1->minutos.' '.@$json1->meridiano;?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php echo $json1->Edad; ?>
                                            </td>
                                            <?php
                                                if($sistema_salarial == 1){
                                            ?>
                                            <td class="text-center">
                                                <a class="" title="Rechazar aspirante" href="<?php echo base_url("Formularios/CambiarEstado/1/".$v1->id_form_contrl);?>">
                                                    <i class="fas fa-arrow-alt-circle-left"></i>
                                                </a>
                                            </td>
                                            <?php } ?>
                                        </tr>
                            <?php       
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div id="rechazadas" class="tab-pane" role="tabpanel">
                    <table class="ordenar display table table-hover" data-url="<?php echo current_url()?>" ordercol=1 order="desc">
                        <thead>
                            <tr>
                                <th>Nombre Aspirante</th>
                                <th style="text-align: center;">Consecutivo</th>
                                <th style="text-align: center;">Fecha</th>
                                <th style="text-align: center;">Hora</th>
                                <th style="text-align: center;">Edad</th>
                                <?php
                                    if($sistema_salarial == 1){
                                ?>
                                <th style="text-align: center;">Acción</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(count($rechazadas)>0){
                                    foreach($rechazadas as $k2 => $v2){
                                        $json2 = json_decode($v2->data);
                            ?>
                                        <tr>
                                            <td>
                                                <?php echo @$json2->Nombre; ?>
                                            </td>
                                            <td style="text-align: center; color: blue">
                                                <a class="lightbox vin" title="Detalle Aspirante" data-type="iframe" href="<?php echo base_url("Formularios/detalleAspirante/".$v2->id_form_contrl); ?>">
                                                    <?php echo @$v2->consecutivo; ?>
                                                </a>        
                                            </td>
                                            <td style="text-align: center;"><?php echo @$json2->Fecha; ?></td>
                                            <td style="text-align: center;"><?php echo @$json2->hora.' ; '.@$json2->minutos.' '.@$json2->meridiano;?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php echo $json2->Edad; ?>
                                            </td>
                                            <?php
                                                if($sistema_salarial == 1){
                                            ?>
                                            <td class="text-center">
                                                <a title="Reiniciar aspirante" href="<?php echo base_url("Formularios/CambiarEstado/1/".$v2->id_form_contrl);?>">
                                                    <i class="fas fa-arrow-alt-circle-left"></i>
                                                </a>
                                            </td>
                                            <?php } ?>
                                        </tr>
                            <?php       
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div id="inasistente" class="tab-pane" role="tabpanel">
                    <table class="ordenar display table table-hover" data-url="<?php echo current_url()?>" ordercol=1 order="desc">
                        <thead>
                            <tr>
                                <th>Nombre Aspirante</th>
                                <th style="text-align: center;">Consecutivo</th>
                                <th style="text-align: center;">Fecha</th>
                                <th style="text-align: center;">Hora</th>
                                <th style="text-align: center;">Edad</th>
                                <th style="text-align: center;">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(count($inasistente)>0){
                                    foreach($inasistente as $k3 => $v3){
                                        $json3 = json_decode($v3->data);
                            ?>
                                        <tr>
                                            <td>
                                                <?php echo @$json3->Nombre; ?>
                                            </td>
                                            <td style="text-align: center; color: blue">
                                                <a class="lightbox vin" title="Detalle Aspirante" data-type="iframe" href="<?php echo base_url("Formularios/detalleAspirante/".$v3->id_form_contrl); ?>">
                                                    <?php echo @$v3->consecutivo; ?>
                                                </a>        
                                            </td>
                                            <td style="text-align: center;"><?php echo @$json3->Fecha; ?></td>
                                            <td style="text-align: center;"><?php echo @$json3->hora.' ; '.@$json3->minutos.' '.@$json3->meridiano;?>
                                            </td>
                                            <td style="text-align: center;">
                                                <?php echo $json3->Edad; ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <a class="" title="Reagendar aspirante" href="<?php echo base_url("Formularios/CambiarEstado/1/".$v3->id_form_contrl);?>">
                                                    <i class="fas fa-arrow-left"></i>
                                                </a>
                                                <?php
                                                    if($sistema_salarial == 1){
                                                ?>
                                                <a  title="Reiniciar aspirante" href="<?php echo base_url("Formularios/CambiarEstado/1/".$v3->id_form_contrl);?>">
                                                    <i class="fas fa-arrow-alt-circle-left"></i>
                                                </a>
                                                <?php } ?>
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