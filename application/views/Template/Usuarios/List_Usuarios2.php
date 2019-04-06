<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
$modulo		=	$this->ModuloActivo;


//pre($this->$modulo->result);return;
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
			<?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Perfiles.",
															"url"	=>	current_url()),	
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
					<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
						<thead>
							<tr>
                           
                                        <th><b>Perfil</b></th>
                                        <th class="text-center"><b>Tercero</b></th>
                                        <th width="40"  class="text-center"><b>Usuarios</b></th>
                                        <!--<th width="40"  class="text-center"><b>Sucursal</b></th>-->
                                        <th  class="text-center"><b>Online</b></th>
                                        <!--<th width="100"  class="text-center"><b>Fin session</b></th>-->
                                        <th  class="text-center"><b>Ver</b></th>
                                       
                                    
							</tr>
						</thead>
						<tbody>
                        	<?php 
								if(count(@$this->$modulo->result['Activos'])>0){
									foreach(@$this->$modulo->result['Activos'] as $v){?>
                               <!-- <?php pre($v)?>-->
                                    <tr>
                                            <td ><?php echo @$v->rol?></td>
                                            <td class="text-center">
                                            	<?php echo  @$v->nombre;?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo @$v->username; ?>
                                            </td class="text-center">
                                            <td  class="text-center">
                                            <i title="Fuera de linea" class="fa fa-toggle-off" arial-hidden="true"></i>
                                            </td>
                                            <td class="text-center" style="vertical-align:middle;">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                            <a class=" lightbox" title="Editar Usuario" data-type="iframe" href="<?php echo base_url()?>">
                                                                <i class="fas fa-edit" aria-hidden="true"></i>
                                                            </a>
                                                        </div>                                        
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
                           
                           <th><b>Perfil</b></th>
                           <th class="text-center"><b>Tercero</b></th>
                           <th width="40"  class="text-center"><b>Usuarios</b></th>
                           <!--<th width="40"  class="text-center"><b>Sucursal</b></th>-->
                           <th  class="text-center"><b>Online</b></th>
                           <!--<th width="100"  class="text-center"><b>Fin session</b></th>-->
                           <th  class="text-center"><b>Ver</b></th>
                          
                       
                        </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(count(@$this->$modulo->result['Inactivos'])>0){
                                    foreach(@$this->$modulo->result['Inactivos'] as $v){?>
                                      <!-- <?php pre($v); ?>-->
                                      <tr>
                                            <td ><?php echo @$v->rol?></td>
                                            <td class="text-center">
                                            	<?php echo  @$v->nombre;?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo @$v->username; ?>
                                            </td class="text-center">
                                            <td  class="text-center">
                                            <i title="Fuera de linea" class="fa fa-toggle-off" arial-hidden="true"></i>
                                            </td>
                                            <td class="text-center" style="vertical-align:middle;">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                            <a class=" lightbox" title="Editar Usuario" data-type="iframe" href="<?php echo base_url()?>">
                                                                <i class="fas fa-edit" aria-hidden="true"></i>
                                                            </a>
                                                        </div>                                        
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
    </div>
</div>
