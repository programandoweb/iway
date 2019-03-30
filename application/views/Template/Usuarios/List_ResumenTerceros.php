<?php

	$modulo		=	$this->ModuloActivo;
?>
<div class="container">
	<div class="row justify-content-md-center">
    	<div class="col">
			<?php 
                echo TaskBar(array("name"		=>	array(	"title"	=>	"Resumen Terceros.",
                                                    "icono"	=>	'<i class="fas fa-users"></i>',
                                                    "url"	=>	current_url()),
                    )
                );
            ?>
        	<div class="row">
                <div class="col-md-12">
                    <div class="bd-example bd-example-tabs" role="tabpanel">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="Modelos-tab" data-toggle="tab" href="#modelos" role="tab" aria-controls="home" aria-expanded="false">Modelos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " id="Administrativos-tab" data-toggle="tab" href="#administrativos" role="tab" aria-controls="profile" aria-expanded="true">Administrativos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " id="profile-tab" data-toggle="tab" href="#monitores" role="tab" aria-controls="profile" aria-expanded="true">Monitores</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " id="profile-tab" data-toggle="tab" href="#Proveedores" role="tab" aria-controls="profile" aria-expanded="true">Proveedores</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " id="profile-tab" data-toggle="tab" href="#Asociados" role="tab" aria-controls="profile" aria-expanded="true">Asociados</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div role="tabpanel" class="tab-pane fade active show" id="modelos" aria-labelledby="home-tab" aria-expanded="false">
                                <table class="table table-hover ordenar">
                                    <thead>
                                        <tr>
                                            <th><b>Sucursal</b></th>
                                            <th><b>Nombre</b></th>
                                            <th><b>Dirección / Ciudad / Dpto / País</b></th>
                                            <th><b>Celular</b></th>
                                            <th><b>Telefono</b></th>
                                            <th><b>Email</b></th>
                                            <th><b>Estado</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(!empty($this->$modulo->result['Modelos'])){
                                                foreach($this->$modulo->result['Modelos'] as $v){
                                                    
                                        ?>
                                                    <tr>
                                                        <td class="text-center" style="vertical-align:middle">
                                                            <?php print_r($v->abreviacion);?>
                                                        </td>
                                                        <td class="text-left" style="vertical-align:middle">
                                                            <?php print_r(nombre($v));?>
                                                        </td>
                                                        <td class="text-left">
                                                        	<?php if(!empty($v->direccion)){echo  $v->direccion.'<br />';} ?>
                                                            <?php if(!empty($v->ciudad)){ echo $v->ciudad.'<br />';} ?> 
                                                            <?php if(!empty($v->departamento)){ echo $v->departamento.'<br />';} ?>
                                                            <?php if(!empty($v->pais)){ echo $v->pais.'<br />';} ?>
                                                        </td>
                                                        <td class="text-left">
                                                            <?php echo $v->cod_telefono." ".$v->telefono; ?>                                
                                                        </td>
                                                        <td class="text-left">
                                                            <?php echo $v->cod_otro_telefono." ".$v->otro_telefono; ?>             
                                                        </td>
                                                        <td class="text-left">
                                                            <?php echo $v->email; ?>             
                                                        </td>
                                                        <td class="text-left">
                                                            <?php echo $v->estado; ?>             
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
                            <div class="tab-pane fade " id="administrativos" role="tabpanel" aria-labelledby="profile-tab" aria-expanded="true">
                            	<table class="table table-hover ordenar">
                                    <thead>
                                        <tr>
                                            <th><b>Sucursal</b></th>
                                            <th><b>Nombre</b></th>
                                            <th><b>Dirección / Ciudad / Dpto / País</b></th>
                                            <th><b>Celular</b></th>
                                            <th><b>Telefono</b></th>
                                            <th><b>Email</b></th>
                                            <th><b>Estado</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(!empty($this->$modulo->result['Administrativos'])){
                                                foreach($this->$modulo->result['Administrativos'] as $v){
                                        ?>
                                                    <tr>
                                                        <td class="text-center" style="vertical-align:middle">
                                                            <?php print_r($v->abreviacion);?>
                                                        </td>
                                                        <td class="text-left" style="vertical-align:middle">
                                                            <?php print_r(nombre($v));?>
                                                        </td>
                                                        <td class="text-left">
                                                        	<?php if(!empty($v->direccion)){echo  $v->direccion.'<br />';} ?>
                                                            <?php if(!empty($v->ciudad)){ echo $v->ciudad.'<br />';} ?> 
                                                            <?php if(!empty($v->departamento)){ echo $v->departamento.'<br />';} ?>
                                                            <?php if(!empty($v->pais)){ echo $v->pais.'<br />';} ?>
                                                        </td>
                                                        <td class="text-left">
                                                            <?php echo $v->cod_telefono." ".$v->telefono; ?>                                
                                                        </td>
                                                        <td class="text-left">
                                                            <?php echo $v->cod_otro_telefono." ".$v->otro_telefono; ?>             
                                                        </td>
                                                        <td class="text-left">
                                                            <?php echo $v->email; ?>             
                                                        </td>
                                                        <td class="text-left">
                                                            <?php echo $v->estado; ?>             
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
                            <div class="tab-pane fade " id="monitores" role="tabpanel" aria-labelledby="profile-tab" aria-expanded="true">
                            	<table class="table table-hover ordenar">
                                    <thead>
                                        <tr>
                                            <th><b>Sucursal</b></th>
                                            <th><b>Nombre</b></th>
                                            <th><b>Dirección / Ciudad / Dpto / País</b></th>
                                            <th><b>Celular</b></th>
                                            <th><b>Telefono</b></th>
                                            <th><b>Email</b></th>
                                            <th><b>Estado</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                              if(isset($this->$modulo->result['Monitores'])){
                                                foreach($this->$modulo->result['Monitores'] as $v){
                                        ?>
                                                    <tr>
                                                        <td class="text-center" style="vertical-align:middle">
                                                            <?php print_r($v->abreviacion);?>
                                                        </td>
                                                        <td class="text-left" style="vertical-align:middle">
                                                            <?php print_r(nombre($v));?>
                                                        </td>
                                                        <td class="text-left">
                                                        	<?php if(!empty($v->direccion)){echo  $v->direccion.'<br />';} ?>
                                                            <?php if(!empty($v->ciudad)){ echo $v->ciudad.'<br />';} ?> 
                                                            <?php if(!empty($v->departamento)){ echo $v->departamento.'<br />';} ?>
                                                            <?php if(!empty($v->pais)){ echo $v->pais.'<br />';} ?>
                                                        </td>
                                                        <td class="text-left">
                                                            <?php echo $v->cod_telefono." ".$v->telefono; ?>                                
                                                        </td>
                                                        <td class="text-left">
                                                            <?php echo $v->cod_otro_telefono." ".$v->otro_telefono; ?>             
                                                        </td>
                                                        <td class="text-left">
                                                            <?php echo $v->email; ?>             
                                                        </td>
                                                        <td class="text-left">
                                                            <?php echo $v->estado; ?>             
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
                            <div class="tab-pane fade " id="Proveedores" role="tabpanel" aria-labelledby="profile-tab" aria-expanded="true">
                                <table class="table table-hover ordenar">
                                    <thead>
                                        <tr>
                                            <th><b>Sucursal</b></th>
                                            <th><b>Id </b></th>
                                            <th><b>Nombre</b></th>
                                            <th><b>Dirección</b></th>
                                            <th><b>Ciudad</b></th>
                                            <th><b>Departamento</b></th>
                                            <th><b>Pais</b></th>
                                            <th><b>Celular</b></th>
                                            <th><b>Telefono</b></th>
                                            <th><b>Email</b></th>
                                            <th><b>Estado</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(!empty($this->$modulo->result['Proveedores'])){
                                                foreach($this->$modulo->result['Proveedores'] as $v){
                                                    
                                        ?>
                                                    <tr>
                                                        <td class="text-center" style="vertical-align:middle">
                                                            <?php echo @$v->abreviacion;?>
                                                        </td>
                                                        <td class="text-center" style="vertical-align: middle">
                                                            <?php echo $v->user_id ?>
                                                        </td>
                                                        <td class="text-left" style="vertical-align:middle">
                                                            <?php echo $v->primer_nombre; //print_r(nombre($v));?>
                                                        </td>
                                                        <td class="text-left">
                                                            <?php echo $v->direccion; ?>                                
                                                        </td>
                                                        <td class="text-left">
                                                            <?php echo $v->ciudad; ?>                                
                                                        </td>
                                                        <td class="text-left">
                                                            <?php echo $v->departamento; ?>                                
                                                        </td>
                                                        <td class="text-left">
                                                            <?php echo $v->pais; ?>                                
                                                        </td>
                                                        <td class="text-left">
                                                            <?php echo $v->cod_telefono." ".$v->telefono; ?>                                
                                                        </td>
                                                        <td class="text-left">
                                                            <?php echo $v->cod_otro_telefono." ".$v->otro_telefono; ?>             
                                                        </td>
                                                        <td class="text-left">
                                                            <?php echo $v->email; ?>             
                                                        </td>
                                                        <td class="text-left">
                                                            <?php echo $v->estado; ?>             
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
                            <div class="tab-pane fade " id="Asociados" role="tabpanel" aria-labelledby="profile-tab" aria-expanded="true">
                                <table class="table table-hover ordenar">
                                    <thead>
                                        <tr>
                                            <th><b>Sucursal</b></th>
                                            <th><b>Nombre</b></th>
                                            <th><b>Dirección / Ciudad / Dpto / País</b></th>
                                            <th><b>Celular</b></th>
                                            <th><b>Telefono</b></th>
                                            <th><b>Email</b></th>
                                            <th><b>Estado</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                             if(!empty($this->$modulo->result['Administrativos'])){
                                                foreach($this->$modulo->result['Administrativos'] as $v){
                                        ?>
                                                    <tr>
                                                        <td class="text-center" style="vertical-align:middle">
                                                            <?php print_r($v->abreviacion);?>
                                                        </td>
                                                        <td class="text-left" style="vertical-align:middle">
                                                            <?php print_r(nombre($v));?>
                                                        </td>
                                                        <td class="text-left">
                                                        	<?php if(!empty($v->direccion)){echo  $v->direccion.'<br />';} ?>
                                                            <?php if(!empty($v->ciudad)){ echo $v->ciudad.'<br />';} ?> 
                                                            <?php if(!empty($v->departamento)){ echo $v->departamento.'<br />';} ?>
                                                            <?php if(!empty($v->pais)){ echo $v->pais.'<br />';} ?>
                                                        </td>
                                                        <td class="text-left">
                                                            <?php echo $v->cod_telefono." ".$v->telefono; ?>                                
                                                        </td>
                                                        <td class="text-left">
                                                            <?php echo $v->cod_otro_telefono." ".$v->otro_telefono; ?>             
                                                        </td>
                                                        <td class="text-left">
                                                            <?php echo $v->email; ?>             
                                                        </td>
                                                        <td class="text-left">
                                                            <?php echo $v->estado; ?>             
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
