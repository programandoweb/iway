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
        	<div class="row filters">
            	<div class="col-md-6">
		            <h4 class="font-weight-700 text-uppercase orange"> RESUMEN TERCEROS.</h4>
                </div>
           	</div>
          <div class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="bd-example bd-example-tabs" role="tabpanel">
                        <div class="tab-content" id="myTabContent">
                            <div role="tabpanel" class="tab-pane fade active show" id="modelos" aria-labelledby="home-tab" aria-expanded="false">
                                <table class="table table-hover" width="540">
                                    <thead>
                                        <tr>
                                            <td><b>Sucursal</b></td>
                                            <td><b>Id </b></td>
                                            <td><b>Nombre</b></td>
                                            <td><b>Dirección</b></td>
                                            <td><b>Ciudad</b></td>
                                            <td><b>Departamento</b></td>
                                            <td><b>Pais</b></td>
                                            <td><b>Celular</b></td>
                                            <td><b>Telefono</b></td>
                                            <td><b>Email</b></td>
                                            <td><b>Estado</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(count($this->$modulo->result['Modelos'])>0){
                                                foreach($this->$modulo->result['Modelos'] as $v){
                                                    
                                        ?>
                                                    <tr>
                                                        <td class="text-center" style="vertical-align:middle">
                                                            <?php print_r($v->abreviacion);?>
                                                        </td>
                                                        <td class="text-center" style="vertical-align: middle">
                                                            <?php echo $v->user_id ?>
                                                        </td>
                                                        <td class="text-left" style="vertical-align:middle">
                                                            <?php print_r(nombre($v));?>
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
                                            <tr>
                                                <td colspan="11" class="text-center">
                                                    No hay registros disponibles
                                                </td>
                                            </tr>
                                        <?php		
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade " id="administrativos" role="tabpanel" aria-labelledby="profile-tab" aria-expanded="true">
                            	<table class="table table-hover" width="540">
                                    <thead>
                                        <tr>
                                            <td><b>Sucursal</b></td>
                                            <td><b>Id </b></td>
                                            <td><b>Nombre</b></td>
                                            <td><b>Dirección</b></td>
                                            <td><b>Ciudad</b></td>
                                            <td><b>Departamento</b></td>
                                            <td><b>Pais</b></td>
                                            <td><b>Celular</b></td>
                                            <td><b>Telefono</b></td>
                                            <td><b>Email</b></td>
                                            <td><b>Estado</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(count($this->$modulo->result['Administrativos'])>0){
                                                foreach($this->$modulo->result['Administrativos'] as $v){
                                                    
                                        ?>
                                                    <tr>
                                                        <td class="text-center" style="vertical-align:middle">
                                                            <?php print_r($v->abreviacion);?>
                                                        </td>
                                                        <td class="text-center" style="vertical-align: middle">
                                                            <?php echo $v->user_id ?>
                                                        </td>
                                                        <td class="text-left" style="vertical-align:middle">
                                                            <?php print_r(nombre($v));?>
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
                                            <tr>
                                                <td colspan="11" class="text-center">
                                                    No hay registros disponibles
                                                </td>
                                            </tr>
                                        <?php		
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade " id="monitores" role="tabpanel" aria-labelledby="profile-tab" aria-expanded="true">
                                <table class="table table-hover" width="540">
                                    <thead>
                                        <tr>
                                            <td><b>Sucursal</b></td>
                                            <td><b>Id </b></td>
                                            <td><b>Nombre</b></td>
                                            <td><b>Dirección</b></td>
                                            <td><b>Ciudad</b></td>
                                            <td><b>Departamento</b></td>
                                            <td><b>Pais</b></td>
                                            <td><b>Celular</b></td>
                                            <td><b>Telefono</b></td>
                                            <td><b>Email</b></td>
                                            <td><b>Estado</b></td>
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
                                                        <td class="text-center" style="vertical-align: middle">
                                                            <?php echo $v->user_id ?>
                                                        </td>
                                                        <td class="text-left" style="vertical-align:middle">
                                                            <?php print_r(nombre($v));?>
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
                                            <tr>
                                                <td colspan="11" class="text-center">
                                                    No hay registros disponibles
                                                </td>
                                            </tr>
                                        <?php		
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade " id="Proveedores" role="tabpanel" aria-labelledby="profile-tab" aria-expanded="true">
                                <table class="table table-hover" width="540">
                                    <thead>
                                        <tr>
                                            <td><b>Sucursal</b></td>
                                            <td><b>Id </b></td>
                                            <td><b>Nombre</b></td>
                                            <td><b>Dirección</b></td>
                                            <td><b>Ciudad</b></td>
                                            <td><b>Departamento</b></td>
                                            <td><b>Pais</b></td>
                                            <td><b>Celular</b></td>
                                            <td><b>Telefono</b></td>
                                            <td><b>Email</b></td>
                                            <td><b>Estado</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(count($this->$modulo->result['Proveedores'])>0){
                                                foreach($this->$modulo->result['Proveedores'] as $v){
                                                    
                                        ?>
                                                    <tr>
                                                        <td class="text-center" style="vertical-align:middle">
                                                            <?php print_r($v->abreviacion);?>
                                                        </td>
                                                        <td class="text-center" style="vertical-align: middle">
                                                            <?php echo $v->user_id ?>
                                                        </td>
                                                        <td class="text-left" style="vertical-align:middle">
                                                            <?php print_r(nombre($v));?>
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
                                            <tr>
                                                <td colspan="11" class="text-center">
                                                    No hay registros disponibles
                                                </td>
                                            </tr>
                                        <?php       
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade " id="Asociados" role="tabpanel" aria-labelledby="profile-tab" aria-expanded="true">
                                <table class="table table-hover" width="540">
                                    <thead>
                                        <tr>
                                            <td><b>Sucursal</b></td>
                                            <td><b>Id </b></td>
                                            <td><b>Nombre</b></td>
                                            <td><b>Dirección</b></td>
                                            <td><b>Ciudad</b></td>
                                            <td><b>Departamento</b></td>
                                            <td><b>Pais</b></td>
                                            <td><b>Celular</b></td>
                                            <td><b>Telefono</b></td>
                                            <td><b>Email</b></td>
                                            <td><b>Estado</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(count($this->$modulo->result['Administrativos'])>0){
                                                foreach($this->$modulo->result['Administrativos'] as $v){
                                                    
                                        ?>
                                                    <tr>
                                                        <td class="text-center" style="vertical-align:middle">
                                                            <?php print_r($v->abreviacion);?>
                                                        </td>
                                                        <td class="text-center" style="vertical-align: middle">
                                                            <?php echo $v->user_id ?>
                                                        </td>
                                                        <td class="text-left" style="vertical-align:middle">
                                                            <?php print_r(nombre($v));?>
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
                                            <tr>
                                                <td colspan="11" class="text-center">
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
</div>
