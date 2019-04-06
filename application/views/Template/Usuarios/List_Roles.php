<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
$modulo		=	$this->ModuloActivo;
//pre($this->$modulo->result);
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	$this->uri->segment(2).".",
															"url"	=>	current_url()),
									"add"		=>	array(	"title"	=>	"Agregar rol",
															"url"	=>	base_url($this->uri->segment(1)."/AddRol"),
															"lightbox"=>true),						
							)
						);
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
                            <table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
                                <thead>
                                	<tr>
                                    	<th>Roles</th>
                                        <th width="100" class="text-center">Estado</th>
                                        <th class="text-right" width="20">Acción</th>
									</tr>                
                                </thead>
                                <tbody>
                                    <?php
                                        if(count($this->$modulo->result['activos'])>0){
                                            foreach($this->$modulo->result['activos'] as $v){
									?>
                                		<tr>
                                        	<td><?php print($v->rol);?></td>
                                            <td class="text-center"><?php $campo="CASE WHEN estado=1 THEN 'Activo' ELSE 'Inactivo' END";print($v->$campo);?></td>
                                            <td class="text-center"><?php print($v->edit);?></td>
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
                        <div class="col-md-12 tab-pane" id="inactivos" role="tabpanel">
                        	<table class="ordenar display table table-hover" data-url="<?php echo current_url()?>">
                                <thead>
                                	<tr>
                                    	<th>Roles</th>
                                        <th width="100" class="text-center">Estado</th>
                                        <th class="text-right" width="20">Acción</th>
									</tr>                
                                </thead>
                                <tbody>
                                    <?php
                                        if(count($this->$modulo->result['inactivos'])>0){
                                            foreach($this->$modulo->result['inactivos'] as $v){
									?>
                                		<tr>
                                        	<td><?php print($v->rol);?></td>
                                            <td class="text-center"><?php $campo="CASE WHEN estado=1 THEN 'Activo' ELSE 'Inactivo' END";print($v->$campo);?></td>
                                            <td class="text-center"><?php print($v->edit);?></td>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
