<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/

	$modulo		=	$this->ModuloActivo;
    foreach ($this->$modulo->result as $k => $v) {
        if($v->estado == "Activo"){
            $Activo[] = $v;
        }else{
            $Inactivo[] = $v;
        }
    }
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
            <?php
                if($this->user->type == "root"){
    				echo TaskBar(array("name"		=>	array(	"title"	=>	$this->ModuloActivo.".",
    															"url"	=>	current_url()),
    									"add"		=>	array(	"title"	=>	"Agregar ".$this->ModuloActivo,
    															"url"	=>	base_url($this->uri->segment(1)."/Add"),
    															"lightbox"=>true),						
    							)
    						);
                }else{
                    echo TaskBar(array("name"       =>  array(  "title" =>  $this->ModuloActivo.".",
                                                                "url"   =>  current_url()),                     
                                )
                            );
                }
            ?>
    <ul class="nav nav-tabs" role="tablist"> 
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#activo" role="tab">
                Activo
            </a>
        </li>
         <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#inactivo" role="tab">
                Inactivo
            </a>
         </li> 
    </ul>
    <div class="justify-content-md-center tab-content" id="imprimeme">
        <div id="activo" class="tab-pane active col-md-12" role="tabpanel">
            <div class="row">
                <div class=" col-md-12">
					<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
						<thead>
							<tr>
                            	<th width="300"><b>Nombre Legal / Comercial</b></th>
                                <th ><b>Datos de Contacto</b></th>
                                <th ><b>Prefijo</b></th>
                                <th class="text-center"><b>Método S.</b></th>
                                <th class="text-center"><b>Período Pago</b></th>
                                <th width="100" class="text-center"><b>Acciones</b></th>
							</tr>
						</thead>
						<tbody>
                        	<?php 
								if(count(@$Activo)>0){
									foreach(@$Activo as $v){?>
                                        <tr>
                                            <td>
                                            	<?php print_r($v->nombre_legal);?>
                                            </td>
                                            <td>
                                            	<?php print_r($v->contactos);?>
                                            </td>
                                            <td class="text-center">
                                            	<?php print(@json_db($v->json,"decode")->PrefijoDocumentos);?>
                                            </td>
                                            <td class="text-center">
                                            	<?php print(SiNo($v->sistema_salarial));?>
                                            </td>
                                            <td class="text-center">
                                            	<?php echo ($v->periodo_pagos==2)?"Quincenal":"Semanal";?>
                                            </td>
                                            <td class="text-center" style="vertical-align:middle;">
                                                
                                                    <a class="" title="Seleccionar Empresa" href="<?php echo base_url("Usuarios/SetCentroCostos/".$v->centro_de_costos)?>">
                                                        <i class="fa fa-building" aria-hidden="true"></i>
                                                    </a>
                                                    <a class="lightbox" title="Editar Empresa" data-type="iframe" href="<?php echo base_url("Empresas/Add/".$v->user_id)?>">
                                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                    <a class="lightbox" data-type="iframe" title="Ver Empresa" href="<?php echo base_url("Empresas/Ver/".$v->user_id)?>">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                    <a class="lightbox" data-type="iframe" title="Configuracion de documentos" href="<?php echo base_url("Empresas/ConfiguracionDocumentos/".$v->user_id)?>">
                                                        <i class="far fa-file"></i>
                                                    </a>
                                                    <a class="" title="Inactivar Empresa" href="<?php echo base_url("Usuarios/CambiarEstado/Modelos/Inactivar/".$v->user_id."/Empresa")?>">
                                                    	<i class="fas fa-toggle-on"></i>
													</a>                                                
                                            </td>
                                        </tr>	
                            <?php 	}
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
        <div id="inactivo" class="tab-pane col-md-12" role="tabpanel">
            <div class="row">
                <div class=" col-md-12">
                    <table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
                        <thead>
                            <tr>
                                <th width="300"><b>Nombre Legal / Comercial</b></th>
                                <th ><b>Datos de Contacto</b></th>
                                <th ><b>Prefijo</b></th>
                                <th class="text-center"><b>Método S.</b></th>
                                <th class="text-center"><b>Período Pago</b></th>
                                <th width="100" class="text-center"><b>Acción</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(count(@$Inactivo)>0){
                                    foreach(@$Inactivo as $v){?>
                                        <tr>
                                            <td>
                                                <?php print_r($v->nombre_legal);?>
                                            </td>
                                            <td>
                                                <?php print_r($v->contactos);?>
                                            </td>
                                            <td class="text-center">
                                            	<?php print(@json_db($v->json,"decode")->PrefijoDocumentos);?>
                                            </td>
                                            <td class="text-center">
                                            	<?php print(SiNo($v->sistema_salarial));?>
                                            </td>
                                            <td class="text-center">
                                            	<?php echo ($v->periodo_pagos==2)?"Quincenal":"Semanal";?>
                                            </td>
                                            <td class="text-center" style="vertical-align:middle;">
                                                
                                                    <a class="" title="Seleccionar Empresa" href="<?php echo base_url("Usuarios/SetCentroCostos/".$v->centro_de_costos)?>">
                                                        <i class="fa fa-building" aria-hidden="true"></i>
                                                    </a>
                                                    <a class="lightbox" title="Editar Empresa" data-type="iframe" href="<?php echo base_url("Empresas/Add/".$v->user_id)?>">
                                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                    <a class="lightbox" data-type="iframe" title="Ver Empresa" href="<?php echo base_url("Empresas/Ver/".$v->user_id)?>">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                    <a class="lightbox" data-type="iframe" title="Configuracion de documentos" href="<?php echo base_url("Empresas/ConfiguracionDocumentos/".$v->user_id)?>">
                                                        <i class="far fa-file"></i>
                                                    </a>
                                                    <a class="" title="Activar Modelos" href="<?php echo base_url("Usuarios/CambiarEstado/Modelos/Activar/".$v->user_id."/Empresa")?>"><i class="fas fa-toggle-off"></i></a>
                                            </td>
                                        </tr>   
                            <?php   }
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
