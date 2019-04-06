<?php
  $modulo = $this->ModuloActivo;
 // pre($this->$modulo->result);
?>

<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<?php
        		if($this->uri->segment(3) == "Monitores"){
					echo TaskBar(array("name"		=>	array(	"title"	=>	$this->uri->segment(3).".",
																"url"	=>	current_url()),
										"add"		=>	array(	"title"	=>	"Agregar ".$this->uri->segment(3),
																"url"	=>	base_url($this->uri->segment(1)."/Add_Todos/".$this->uri->segment(3)),
																"lightbox"=>true),
										"config"	=>	array(	"title"	=>	"Personalización de Factura",
																"icono"	=>	'<i class="fas fa-cogs"></i>',
																"url"	=>	base_url("Configuracion/Porcentaje"),
																"lightbox"=>true),													
							)
						);
        		}else{
        			echo TaskBar(array("name"		=>	array(	"title"	=>	"Proveedores.",
																"url"	=>	current_url()),
										"add"		=>	array(	"title"	=>	"Agregar ".$this->uri->segment(3),
																"url"	=>	base_url('Usuarios/add_proveedores'),
																"lightbox"=>true),						
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
                                <!--<th><b>Avatar</b></th>-->
                            	<th class="text-center" width="300"><b>Tercero</b></th>
                            
                                <th ><b>Datos de Contacto</b></th>
                                <th class="text-center" width="100" class="text-center"><b>Acciones</b></th>
							</tr>
						</thead>
						<tbody>
                        	<?php 
								if(count(@$this->$modulo->result['Activos'])>0){
									foreach(@$this->$modulo->result['Activos'] as $v){?>
                               <!-- <?php pre($v)?>-->
                                    <tr>
                                           <!-- <td ><img id="efectoImagen" src="<?php   echo img_logo($v->id);?>" class="img rounded-circle mx-auto d-block" width="30" /></td>-->
                                            <td class="text-center">
                                            	<?php print_r(@$v->nombre_comercial);?>
                                            </td>
                                            
                                            <td>
                                            	<?php echo @$v->telefono.' / '.@$v->direccion;?>
                                            </td>
                                            <td class="text-center" style="vertical-align:middle;">
                                               
                                            <a class="lightbox" title="Editar Proveedores" data-type="iframe" href="<?php echo base_url("Usuarios/add_proveedores/Clientes/".$v->id."/Activos/")?>">
                                                    <i class="fas fa-edit" aria-hidden="true"></i>
                                                   </a>
                                                  <a class="lightbox" data-type="iframe" title="Ver Proveedor" href="<?php echo base_url("Usuarios/VerProveedores/Proveedores/".$v->id."/Activos/")?>">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                   </a>
                                              
                                                   <a class="" title="Inactivar cliente" href="<?php echo base_url("Usuarios/EstadoProveedores/Proveedores/".$v->id."/Activos/")?>">
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
                    <table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
                        <thead>
                            <tr>
                                <th><b>Avatar</b></th>
                                <th width="300"><b>Tercero</b></th>
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
                                                <?php print_r($v->nombre_legal);?>
                                            </td>
                                            <td>
                                                <?php echo @$v->username; ?>
                                            </td>
                                            <td>
                                                <?php echo @$v->direccion;?>
                                            </td>
                                            <td class="text-center" style="vertical-align:middle;">
                                                
                                                   <!-- <a class="" title="Seleccionar Empresa" href="<?php echo base_url("Usuarios/SetEmpresa/")?>">
                                                        <i class="fa fa-building" aria-hidden="true"></i>
                                                    </a>-->
                                                    <a class="lightbox" title="Editar Proveedores" data-type="iframe" href="<?php echo base_url("Usuarios/add_proveedores/Clientes/".$v->id."/Inactivos/")?>">
                                                    <i class="fas fa-edit" aria-hidden="true"></i>
                                                   </a>
                                                  <a class="lightbox" data-type="iframe" title="Ver Proveedor" href="<?php echo base_url("Usuarios/VerProveedores/Proveedores/".$v->id."/Inactivos/")?>">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                   </a>
                                              
                                                   <a class="" title="Inactivar cliente" href="<?php echo base_url("Usuarios/EstadoProveedores/Proveedores/".$v->id."/Inactivos/")?>">
                                                	<i class="fas fa-toggle-on"></i>
												               </a>      
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


   