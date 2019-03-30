<?php

$modulo		=	$this->ModuloActivo;

//echo  $this->user->rol_id;
    $empresa = get_empresa($this->user->empresa_id);
 ?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<?php
    			echo TaskBar(array("name"		=>	array(	"title"	=>	$this->uri->segment(3).".",
															"url"	=>	current_url()),
									"add"		=>	array(	"title"	=>	"Agregar ".$this->uri->segment(3),
															"url"	=>	base_url($this->uri->segment(1)."/Add_Todos/".$this->uri->segment(3)),
															"lightbox"=>true),						
						)
					);
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
                                        <!--<th><b>Avatar</b></th>-->
                                    	<th class="text-center" width="300"><b>Nombre Legal / Comercial</b></th>
                                    
                                        <th ><b>Datos de Contacto</b></th>
                                        <th class="text-center" width="100" class="text-center"><b>Acciones</b></th>
        							</tr>
        						</thead>
        						<tbody>
                                	<?php 
        								if(count(@$this->$modulo->result['Activos'])>0){
        									foreach(@$this->$modulo->result['Activos'] as $v1){?>
                                            <tr>
                                                   <!-- <td ><img id="efectoImagen" src="<?php   echo img_logo($v1->id);?>" class="img rounded-circle mx-auto d-block" width="30" /></td>-->
                                                    <td class="text-center">
                                                    	<?php print_r(@$v1->nombre);?>
                                                    </td>
                                                    
                                                    <td>
                                                    	<?php echo @$v1->telefono_user.' / '.@$v1->direccion_user;?>
                                                    </td>
                                                    <td class="text-center" style="vertical-align:middle;">
                                                       
                                                           <!-- <a class="" title="Seleccionar Empresa" href="<?php echo base_url("Usuarios/SetEmpresa/")?>">
                                                                <i class="fa fa-building" aria-hidden="true"></i>
                                                            </a>-->
                                                            <a class="lightbox" title="Editar Empresa" data-type="iframe" href="<?php echo base_url("Usuarios/Add_Todos/".$this->uri->segment(3)."/".$v1->user_id)?>">
                                                                <i class="fas fa-edit" aria-hidden="true"></i>
                                                            </a>
                                                            <a class="lightbox" data-type="iframe" title="Ver Empresa" href="<?php echo base_url("Usuarios/VerClientes/".$this->uri->segment(3)."/".$v1->user_id)?>">
                                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                            </a>
                                                           
                                                            <a class="" title="Activar Modelos" href="<?php echo base_url("Usuarios/EstadoCliente/".$this->uri->segment(3)."/".$v1->user_id)?>"><i class="fas fa-toggle-off"></i></a>                                               
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
                                        <th class="text-center" width="300"><b>Nombre Legal / Comercial</b></th>
                                        <th ><b>Datos de Contacto</b></th>
                                        <th class="text-center" width="100" class="text-center"><b>Acciones</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if(count(@$this->$modulo->result['Inactivos'])>0){
                                            foreach(@$this->$modulo->result['Inactivos'] as $v2){?>
                                              <!-- <?php pre($v2); ?>-->
                                                <tr>
                                                    <td><img id="efectoImagen" src="<?php   echo img_logo($v2->id);?>" class="img rounded-circle mx-auto d-block" width="30" /></td>
                                                    <td>
                                                        <?php print_r($v2->nombre);?>
                                                    </td>
                                                    <td>
                                                        <?php echo @$v1->telefono_user.' / '.@$v1->direccion_user;?>
                                                    </td>
                                                    <td class="text-center" style="vertical-align:middle;">
                                                        
                                                           <!-- <a class="" title="Seleccionar Empresa" href="<?php echo base_url("Usuarios/SetEmpresa/")?>">
                                                                <i class="fa fa-building" aria-hidden="true"></i>
                                                            </a>-->
                                                            <a class="lightbox" title="Editar Empresa" data-type="iframe" href="<?php echo base_url("Usuarios/Add_Todos/".$this->uri->segment(3)."/".$v1->user_id)?>">
                                                                <i class="fas fa-edit" aria-hidden="true"></i>
                                                            </a>
                                                            <a class="lightbox" data-type="iframe" title="Ver Empresa" href="<?php echo base_url("Usuarios/VerClientes/".$this->uri->segment(3)."/".$v1->user_id)?>">
                                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                            </a>
                                                           
                                                            <a class="" title="Activar Modelos" href="<?php echo base_url("Usuarios/EstadoCliente/".$this->uri->segment(3)."/".$v1->user_id)?>"><i class="fas fa-toggle-off"></i></a>
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
    </div>
</div>