<?php
/* 
    DESARROLLO Y PROGRAMACIÓN
    PROGRAMANDOWEB.NET
    LCDO. JORGE MENDEZ
    info@programandoweb.net
*/
    $modulo     =   'Formularios';
?>
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col">
            <div class="row filters">
                <div class="col-md-12">
                    <?php 
                        echo TaskBar(array("name"       =>  array(  "title" =>  "Resumen Entrevistas",
                                                                    "url"   =>  current_url()),
                                    )
                                );
                    ?>
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
                                            <th><b>Sucursal</b></th>
                                            <th><b>Nombre</b></th>
                                            <th class="text-center"><b>Test psicotecnico</b></th>
                                            <th class="text-center"><b>Test Inglés</b></th>
                                            <th class="text-center"><b>Test Digitación</b></th>
                                            <th class="text-center" width="20"><b>Acción</b></th>
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
                                                        <td class="text-center text-right">
                                                            <a class="lightbox" title="Ver Detalles Entrevista" data-type="iframe" href="<?php echo base_url("Formularios/VerCertificadoEntrevistas/".$v->entrevista_id)?>">
                                                                        <i class="fa fa-eye" aria-hidden="true"></i>
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
