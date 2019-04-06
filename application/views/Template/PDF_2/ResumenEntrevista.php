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
        	<div class="row filters">
            	<div class="col-md-6">
		            Resumen Entrevistas
                </div>
           	</div>
            <div class="row">
                <div class="col-md-12">
                    <div class="bd-example bd-example-tabs" role="tabpanel">                        
                        <div class="tab-content" id="myTabContent">
                            <div role="tabpanel" class="tab-pane fade active show" id="home" aria-labelledby="home-tab" aria-expanded="false">
                                <table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
                                    <thead>
                                        <tr>
                                            <td><b>Sucursal</b></td>
                                            <td><b>Nombre</b></td>
                                            <td class="text-center"><b>Test psicotecnico</b></td>
                                            <td class="text-center"><b>Test Inglés</b></td>
                                            <td class="text-center"><b>Test Digitación</b></td>
                                            <td class="text-center"><b>Ver Detalles</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(count($this->$modulo->result)>0){
                                                foreach($this->$modulo->result as  $key => $v){
                                                    $datos_entrevistado =    json_decode($v->json_entrevista);
                                                    
                                        ?>
                                                    <tr>
                                                        <td>
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
                                                        <td>
                                                            
                                                        </td>
                                                        <td class="text-center">
                                                            <?php 
                                                                if(!empty(json_decode($v->json_respuestas))){
                                                                   echo json_decode($v->json_respuestas)." %";
                                                                }
                                                             ?>
                                                        </td>
                                                        <td>
                                                            
                                                        </td>
                                                        <td class="text-center">
                                                            <a class="btn btn-secondary lightbox" title="Ver Detalles Entrevista" data-type="iframe" href="<?php echo base_url("Formularios/VerDetalles/".$v->entrevista_id)?>">
                                                                        <i class="fa fa-search" aria-hidden="true"></i>
                                                            </a>
                                                        </td>   
                                                    </tr>
                                        <?php       
                                                }
                                            }else{
                                        ?>
                                            <tr>
                                                <td colspan="4" class="text-center">
                                                    No hay registros disponibles
                                                </td>
                                            </tr>
                                        <?php       
                                            }
                                        ?>
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
        </div>
    </div>
</div>
