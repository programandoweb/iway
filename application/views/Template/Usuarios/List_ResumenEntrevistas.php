<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
	$modulo		=	'Formularios';
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
            <?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Resumen Entrevistas.",
															"icono"	=>	'<i class="fas fa-users"></i>',
															"url"	=>	current_url()),
															"add"	=>	array(	"url"	=>	base_url("Formularios/ProgramarEntrevistas/add"),
																				"title"	=>	"Crear Invitación",
																				"lightbox"=>true)															
							)
						);
			?>
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#resumen" role="tab" style="margin:0px,padding:0px">
                                <i class="fas fa-angle-right"></i> Resumen 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="link_detalle" data-toggle="tab" href="#detalle" role="tab">
                                <i class="fas fa-angle-right"></i>  Detalle 
                            </a>
                        </li>
                    </ul>
                    <div class="row justify-content-md-center tab-content" id="imprimeme">                 
                        <div role="tabpanel" class="col-md-12 tab-pane fade active show" id="resumen" aria-labelledby="home-tab" aria-expanded="false">
                            <table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
                                <thead>
                                    <tr>
                                        <th><b>Sucursal</b></th>
                                        <th><b>Nombre</b></th>
                                        <th class="text-center"><b>Test psicotecnico</b></th>
                                        <th class="text-center"><b>Test Inglés</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(count($this->$modulo->result)>0){
                                            foreach($this->$modulo->result as  $key => $v){
                                                $datos_entrevistado =    json_decode($v->json_entrevista);
                                                $datos_examen =    json_decode($v->json_respuestas);
                                    ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <b><?php echo $v->abreviacion; ?></b>
                                                    </td>
                                                    <td>
                                                        <b>
                                                            <?php 
                                                                if(!empty($datos_entrevistado->PrimerNombre)){
                                                                   echo $datos_entrevistado->PrimerNombre." ";
                                                                } 
                                                                if(!empty($datos_entrevistado->SegundoNombre)){
                                                                   echo $datos_entrevistado->SegundoNombre." ";
                                                                }
                                                                if(!empty($datos_entrevistado->PrimerApellido)){
                                                                   echo $datos_entrevistado->PrimerApellido." ";
                                                                } 
                                                                if(!empty($datos_entrevistado->SegundoApellido)){
                                                                   echo $datos_entrevistado->SegundoApellido." ";
                                                                }
                                                            ?>
                                                        </b>
                                                    </td>
                                                    <td class="text-center">
                                                        <a class="lightbox" title="Ver Detalles Entrevista" data-type="iframe" href="<?php echo base_url("Formularios/VerDetalles/".$v->entrevista_id)?>">
                                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        <a class="lightbox" title="Ver Detalles Examen" data-type="iframe" href="<?php echo base_url("Formularios/VerDetalles/".$v->entrevista_id)?>/examen">
                                                            <?php 
                                                                if(!empty($datos_examen->json_entrevista)){
                                                                   echo $datos_examen->json_entrevista." %";
                                                                }
                                                            ?>
                                                        </a>
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
                        <div role="tabpanel" class="col-md-12 tab-pane fade" id="detalle" aria-labelledby="home-tab" aria-expanded="false">
                            <table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
                                <thead>
                                    <tr>
                                        <th width="50" class="text-left">Cédula</th>
                                        <th class="text-left">Nombre</th>
                                        <th class="text-center">Email</th>
                                        <th width="150" class="text-center">URL</th>
                                        <th width="50" class="text-right">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(count($this->Formularios->Entrevistas)>0){
                                            foreach($this->Formularios->Entrevistas as $v){
												if($v->token>0){
                                    ?>
                                                    <tr>
                                                        <td><?php print($v->nro_piso_cedula);?></td>
                                                        <td><?php //pre($v->json_entrevista);?></td>
                                                        <td><?php print($v->email);?></td>
                                                        <td>
                                                            <a target="_blank" href="<?php echo base_url("Formularios/Autenticacion/".$v->token);?>"><?php print($v->token);?></a>
                                                        </td>
                                                        <td class="text-center">
                                                            <a class="nav-link "  data-type="iframe" title="Detalle invitación a <?php echo $v->email;?>" href="<?php echo base_url("Formularios/ProgramarEntrevistas/add/".$v->token."/iframe")?>">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                    <?php		
												}
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
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    if($this->uri->segment(3) == "detalle"){
?>
<script>
    $(document).ready(function(){
        $("#link_detalle").click();
    });
</script>
<?php
    }
?>
