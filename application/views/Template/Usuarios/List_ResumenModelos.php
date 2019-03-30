<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/
	$modulo		=	$this->ModuloActivo;
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
        	<?php 
				echo TaskBar(array("name"		=>	array(	"title"	=>	"Reportes X Modelos.",
															"icono"	=>	'<i class="fas fa-users"></i>',
															"url"	=>	current_url()),
                                                            "pdf"   =>  true,
                                                            "excel" =>  true,
                                                            "mail"      =>  array(  "id"    =>  "mail" ),
							)
						);
			?>   
         
            <div class="row">
                <div class="col-md-12">
                    <div class="bd-example bd-example-tabs" role="tabpanel">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-expanded="false">Activos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-expanded="true">Inactivos</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div role="tabpanel" class="tab-pane fade active show" id="home" aria-labelledby="home-tab" aria-expanded="false">
                                <table class="table table-hover ordenar ">
                                    <thead>
                                        <tr>
                                            <th width="50"><b>Sucursal</b></th>
                                            <th class="text-left"><b>Nombre</b></th>
                                            <th class="text-left"><b>Datos de Contacto</b></th>
                                            <th class="text-left"><b>Correo</b></th>
                                            <th class="text-center"><b>Estado</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(count($this->$modulo->result['activos'])>0){
                                                foreach($this->$modulo->result['activos'] as $v){
                                                    
                                        ?>
                                                    <tr>
                                                        <td class="text-center">
                                                            <?php print_r($v->abreviacion);?>
                                                        </td>
                                                        <td class="text-left">
                                                            <?php print_r(nombre($v));?>
                                                        </td>
                                                        <td class="text-left">
                                                            <?php print_r($v->contactos);?>
                                                        </td>
                                                        <td class="text-left">
                                                            <?php print_r($v->email);?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php print_r($v->estado);?>
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
                            </div>
                            <div class="tab-pane fade " id="profile" role="tabpanel" aria-labelledby="profile-tab" aria-expanded="true">
                            	<table class="table table-hover ordenar ">
                                    <thead>
                                        <tr>
                                            <th width="50"><b>Sucursal</b></th>
                                            <th class="text-left"><b>Nombre</b></th>
                                            <th class="text-left"><b>Datos de Contacto</b></th>
                                            <th class="text-left"><b>Correo</b></th>
                                            <th class="text-center"><b>Estado</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(count($this->$modulo->result['inactivos'])>0){
                                                foreach($this->$modulo->result['inactivos'] as $v){
                                                    
                                        ?>
                                                    <tr>
                                                        <td class="text-center">
                                                            <?php print_r($v->abreviacion);?>
                                                        </td>
                                                        <td class="text-left">
                                                            <?php print_r(nombre($v));?>
                                                        </td>
                                                        <td class="text-left">
                                                            <?php print_r($v->contactos);?>
                                                        </td>
                                                        <td class="text-left">
                                                            <?php print_r($v->email);?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php print_r($v->estado);?>
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
                            </div>
                        </div>
                    </div>
                </div>
          </div>
        </div>
    </div>
</div>
