<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
	$modulo		=	'Formularios';
?>
<table class="ancho cabecera" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td width="30%" colspan="2">
            <img src="<?php echo img_logo($empresa->user_id);?>" style="width:153px;height:90px;" />
        </td>
        <td style="text-align:right; font-size:12px; font-weight:bold;" valign="top" colspan="15">
            <?php echo $empresa->nombre_legal?><br/>
            Nit: <?php echo $empresa->identificacion;?> | <?php echo $empresa->tipo_empresa;?><br />
            <?php echo $empresa->direccion;?><br />               
            PBX: <?php echo $empresa->cod_telefono;?>-<?php echo $empresa->telefono?><br />
            <?php echo $empresa->website;?><br/>
            <?php #pre($empresa); ?>
        </td>
    </tr>
</table>
<div class="footer bordetop pie_de_pagina">
    <table>
        <tr>
            <td style="width:33%; text-align: left;font-size: 9px;color :black;">Fecha impresión documento <?php echo date('Y-m-d'); ?></td>
            <td style="text-align: center;font-size: 9px;"></td>
            <td style="width:33%; text-align: right;font-size: 9px;">Powered by LogicSoft&reg; | www.webcamplus.com.co</td>
        </tr>
    </table>
</div>
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
                                <table class="ordenar display table table-hover" data-url="<?php echo current_url()?>" width="540">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
