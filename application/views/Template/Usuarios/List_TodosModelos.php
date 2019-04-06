<?php
$modulo		=	$this->ModuloActivo;
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<?php
        		//if($this->uri->segment(3) == "Monitores"){
                $submenu = array("name"     =>  array(  "title" =>  $this->uri->segment(3).".",
                                                            "url"   =>  current_url()),
                                    "add"       =>  array(  "title" =>  "Agregar ".$this->uri->segment(3),
                                                            "url"   =>  base_url($this->uri->segment(1)."/Add_Todos/".$this->uri->segment(3)),
                                                            "lightbox"=>true),
                                    "config"    =>  array(  "title" =>  "Configuración tipo de modelo",
                                                            "icono" =>  '<i class="fas fa-cogs"></i>',
                                                            "url"   =>  base_url("Configuracion/tipoModelo"),
                                                            "lightbox"=>true)       
                        );
                if($this->user->type != "Asociados" && $this->user->type != "root" ){
                    unset($submenu['config']);
                } 
				echo TaskBar($submenu);
        		//}
                /*else{
        			echo TaskBar(array("name"		=>	array(	"title"	=>	$this->uri->segment(3).".",
																"url"	=>	current_url()),
										"add"		=>	array(	"title"	=>	"Agregar ".$this->uri->segment(3),
																"url"	=>	base_url($this->uri->segment(1)."/Add_Todos/".$this->uri->segment(3)),
																"lightbox"=>true),						
							)
						);
        		}*/
			?>
            <div class="row">
            	<div class="col-md-12">
	                <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#activos" role="tab" style="margin:0px,padding:0px">
                                <i class="fas fa-angle-right"></i> Activos 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#inactivos" role="tab">
                               <i class="fas fa-angle-right"></i>  Inactivos 
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content row">
    					<div class="tab-pane active col-md-12" id="activos" role="tabpanel">	
                            <table class="ordenar display table table-hover" data-url="<?php echo current_url()?>" ordercol=1 order="asc">
                                <thead>
                                    <th class="text-center">Avatar</th>
                                    <th class="text-center">Tercero</th>
                                    <th>Usuario</th>
                                    <th>Datos de Contacto</th>
                                    <th>Tipo Modelo</th>
                                    <th style="text-align: center;">Acciónes</th>
                                </thead>
                                <tbody>
                                	<?php 
										foreach(GetUsuarios("Modelos",$select="*",$this->user->id_empresa,1) as $k=> $v){?>
                                        <tr>
                                            <td><img id="efectoImagen" src="<?php print(img_profile($v->user_id))?>" class="img rounded-circle mx-auto d-block" width="30" alt="<?php print(nombre($v))?>" /></td>
                                            <td><p class="text-justify"><?php print(nombre($v))?></p></td>
                                            <td>
                                                <?php echo $v->nombre_usuario; ?>
                                            </td>
                                            <td><?php print($v->cod_telefono.' '.$v->telefono.'<br>'.$v->email);?></td>
                                            <td><?php print($v->tipo_modelo);?></td>
                                            <td style="text-align: center;">
                                            	<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                	<a class="btn-btn-secondary- lightbox" title="Editar modelos" data-type="iframe" href="<?php echo base_url("Usuarios/Add_Todos/Modelos/".$v->user_id)?>">
                                                    	<i class="fas fa-edit" aria-hidden="true"></i>
													</a>
                                                    <a class="" target="_blank" href="<?php echo base_url("Usuarios/generarPdfTratamientoDatos/".$v->user_id)?>">
                                                        <i class="fas fa-file-pdf"></i>
                                                    </a>
												</div>
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                <?php if($v->estado==0){$estatus="Activar";}else{$estatus="inactivar";}?>
                                                    <a class="btn-btn-secondary- " title="Inactivar Modelos" href="<?php echo base_url("Usuarios/CambiarEstado/Modelos/".$estatus."/".$v->user_id)?>">
                                                    	<i class="fas fa-toggle-on"></i>
													</a>
                                                   
                                                 
                                                </div>
                                            </td>
                                        </tr>
                                    <?php }?>
                                </tbody>
                            </table>
						</div>
                        <div class="tab-pane  col-md-12" id="inactivos" role="tabpanel">	
                            <table class="ordenar display table table-hover" data-url="<?php echo current_url()?>" ordercol=3 order="desc">
                                <thead>
                                    <th class="text-center">Avatar</th>
                                    <th>Tercero</th>
                                    <th>Usuario</th>
                                    <th>Datos de Contacto</th>
                                    <th>Tipo Modelo</th>
                                    <th style="text-align: center;">Acciónes</th>
                                </thead>
                                <tbody>
                                	<?php 
										foreach(GetUsuarios("Modelos",$select="*",$this->user->id_empresa,"INACTIVOS") as $k=> $v){?>
                                        <tr>
                                            <td><img id="efectoImagen" src="<?php print(img_profile($v->user_id))?>" class="img rounded-circle mx-auto d-block" width="30" alt="<?php print(nombre($v))?>" /></td>
                                            <td><?php print(nombre($v))?></td>
                                            <td>
                                                <?php echo $v->nombre_usuario; ?>
                                            </td>
                                            <td><?php print($v->cod_telefono.' '.$v->telefono.'<br>'.$v->email);?></td>
                                            <td><?php print($v->tipo_modelo);?></td>
                                            <td style="text-align: center;">
                                            	<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                	<a class="btn-btn-secondary- lightbox" title="Editar Modelos" data-type="iframe" href="<?php echo base_url("Usuarios/Add_Todos/Modelos/".$v->user_id)?>">
                                                    	<i class="fas fa-edit" aria-hidden="true"></i>
													</a>
                                                    <a class="" target="_blank" href="<?php echo base_url("Usuarios/generarPdfTratamientoDatos/".$v->user_id)?>">
                                                        <i class="fas fa-file-pdf"></i>
                                                    </a>
												</div>
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                <?php if($v->estado==0){$estatus="Activar";}else{$estatus="inactivar";}?>
                                                    <a class="btn-btn-secondary- " title="Inactivar Modelos" href="<?php echo base_url("Usuarios/CambiarEstado/Modelos/".$estatus."/".$v->user_id)?>">
                                                    	<i class="fas fa-toggle-off"></i>
													</a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php }?>
                                </tbody>
                            </table>
						</div>
					</div>                                                    
                </div>
            </div>
        </div>
    </div>
</div>
