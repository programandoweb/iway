<?php
    $modulo = $this->ModuloActivo;
  /*  $m="Empresas";
    pre($this->$m->result);*/
    //pre($this->user->empresa_id)
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
            <?php
                $submenu = array("name"     =>  array(  "title" =>  $this->ModuloActivo.".",
                                                            "url"   =>  current_url()),
                                    "add"       =>  array(  "title" =>  "Agregar empresa",
                                                            "url"   =>  base_url($this->uri->segment(1)."/Add"),
                                                            "lightbox"=>true),                      
                            );
				echo TaskBar($submenu);
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
					<table class="ordenar display table table-hover">
						<thead>
							<tr>
                                <th><b>Avatar</b></th>
                            	<th class="text-center" width="300"><b>Nombre Legal / Comercial</b></th>
                                <th class="text-center" width="200"><b>Usuario</b></th>
                                <th ><b>Datos de Contacto</b></th>
                                <th class="text-center" width="100" class="text-center"><b>Acciones</b></th>
							</tr>
						</thead>
						<tbody>
                        	<?php 
								if(count(@$this->$modulo->result['Activos'])>0){
									foreach(@$this->$modulo->result['Activos'] as $v){?>
                           <!--<?php pre($v)?>-->
                                    <tr>
                                            <td ><img id="efectoImagen" src="<?php   echo img_logo($v->user_id);?>" class="img rounded-circle mx-auto d-block" width="30" /></td>
                                            <td class="text-center">
                                            <?php echo @$v->nombre_legal.' / '.@$v->nombre_comercial;?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo @$v->username; ?>
                                            </td class="text-center">
                                            <td>
                                            	<?php echo @$v->telefono.' / '.@$v->direccion;?>
                                            </td>
                                            <td class="text-center" style="vertical-align:middle;">
                                                <a class="" title="Seleccionar Empresa" href="<?php echo base_url("Usuarios/SetEmpresa/".$v->empresa_id)?>">
                                                    <i class="fa fa-building" aria-hidden="true"></i>
                                                </a>
                                                <a class="lightbox" title="Editar empresa" data-type="iframe" href="<?php echo base_url("Empresas/Add/".$v->empresa_id."/Activos")?>">
                                                    <i class="fas fa-edit" aria-hidden="true"></i>
                                                </a>
                                                <a class="lightbox" data-type="iframe" title="Ver Empresa" href="<?php echo base_url("Empresas/Ver/".$v->empresa_id."/Activos")?>">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                              
                                                <a class="" title="Inactivar Empresa" href="<?php echo base_url("Usuarios/CambiarEstado/Modelos/Inactivar/".$v->empresa_id."/Empresa")?>">
                                                	<i class="fas fa-toggle-on"></i>
												</a>                                                
                                            </td>
                                        </tr>	
                            <?php 	}
								}
							?>						
						</tbody>
					</table>
                </div>
            </div>
        </div>
        <div id="inactivo" class="tab-pane col-md-12" role="tabpanel">
            <div class="row">
                <div class=" col-md-12">
                    <table class="ordenar display table table-hover">
                        <thead>
                            <tr>
                                <th><b>Avatar</b></th>
                                <th width="300"><b>Nombre Legal / Comercial</b></th>
                                <th width="300"><b>Usuario</b></th>
                                <th ><b>Datos de Contacto</b></th>
                                <th width="100" class="text-center"><b>Acción</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(count(@$this->$modulo->result['Inactivos'])>0){
                                    foreach(@$this->$modulo->result['Inactivos'] as $v){?>
                                      <!-- <?php pre($v); ?>-->
                                        <tr>
                                            <td><img id="efectoImagen" src="<?php   echo img_logo($v->id);?>" class="img rounded-circle mx-auto d-block" width="30" /></td>
                                            <td>
                                            <?php echo @$v->nombre_legal.' / '.@$v->nombre_comercial;?>
                                            </td>
                                            <td>
                                                <?php echo @$v->username; ?>
                                            </td>
                                            <td>
                                                <?php echo @$v->direccion;?>
                                            </td>
                                            <td class="text-center" style="vertical-align:middle;">
                                                
                                                   <!-- <a class="" title="Seleccionar Empresa" href="<?php echo base_url("Usuarios/SetEmpresa/".$v->empresa_id)?>">
                                                        <i class="fa fa-building" aria-hidden="true"></i>
                                                    </a>-->
                                                    <a class="lightbox" title="Editar Empresa" data-type="iframe" href="<?php echo base_url("Empresas/Add/".$v->empresa_id."/Inactivos")?>">
                                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                                    </a>
                                                    <a class="lightbox" data-type="iframe" title="Ver Empresa" href="<?php echo base_url("Empresas/Ver/".$v->empresa_id."/Inactivos")?>">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                   
                                                    <a class="" title="Activar Modelos" href="<?php echo base_url("Usuarios/CambiarEstado/Modelos/Activar/".$v->empresa_id."/Empresa")?>"><i class="fas fa-toggle-off"></i></a>
                                            </td>
                                        </tr>   
                            <?php   }
                                }
                            ?>                      
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
