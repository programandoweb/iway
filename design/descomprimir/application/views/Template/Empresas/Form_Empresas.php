<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php 
$modulo		=	$this->ModuloActivo;
$row		=	$this->$modulo->result;
$hidden = array('user_id' => (isset($row->user_id))?$row->user_id:'',"redirect"=>base_url("Empresas/Listado"),"type"=>"empresa");
echo form_open(current_url(),array('ajaxing' => 'true'),$hidden);	?>
<div class="container" style="margin-bottom:100px;">
	
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Información Básica Empresa</h3>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Rol *</b>
                    </div>
                    <div class="col-md-6">	
                       <?php 	
							echo MakeRoles("rol_id",(isset($row->rol_id))?$row->rol_id:NULL,array("class"=>"form-control","id"=>"periodo_pagos","require"=>"require"));
						?> 
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Tipo de Empresa *</b>
                    </div>
                    <div class="col-md-6">	
                       <?php 	
							echo MakeTipoEmpresa("tipo_empresa",(isset($row->tipo_empresa))?$row->tipo_empresa:NULL,array("class"=>"form-control","id"=>"periodo_pagos","require"=>"require"));
						?> 
                    </div>
                </div>
                <div class="row form-group item">
	                <div class="col-md-6 text-right">	
                    	<b>Naturaleza e identificación *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php 	
							if(!isset($row->tipo_persona)){
								echo MakeTipoPersona("tipo_persona",(isset($row->tipo_persona))?$row->tipo_persona:NULL,array("class"=>"form-control","id"=>"tipo_persona"));
							}else{
						?>
                            <?php echo $row->tipo_persona;?>
                        <?php		
							}
						?>
                    </div>
                </div>
                
                
                <div class="row form-group item">
	                <div class="col-md-6 text-right">	
                    	<b>Tipo identificación *</b>
                    </div>
                    <div class="col-md-6">	
                    	<?php 	
							if(!isset($row->tipo_identificacion)){
								echo MakeTipoIdentificacion("tipo_identificacion",(isset($row->tipo_identificacion))?$row->tipo_identificacion:NULL,array("class"=>"form-control","id"=>"tipo_identificacion","pgrw-dependency"=>"{option:'NIT',primary:'identificacion',secundary:'identificacion_ext'}"));
							}else{
						?>
                            <?php echo $row->tipo_identificacion;?>
                        <?php		
							}
						?>
                        <div class="row sub-item" id="sub-item-identificacion">
                        	<div class="col-md-12">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control col-md-9" name="identificacion" id="identificacion"  placeholder="Número de Identificación" maxlength="12" value="<?php echo (isset($row->identificacion))?$row->identificacion:''?>" <?php echo (isset($row->identificacion))?'readonly="readonly"':''?> require />
                                    <input type="text" class="form-control col-md-3" name="identificacion_ext" id="identificacion_ext"  placeholder="DV" maxlength="1" value="<?php echo (isset($row->identificacion_ext))?$row->identificacion_ext:''?>" <?php echo (isset($row->identificacion_ext))?'readonly="readonly"':''?> />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Nombre legal *</b>
                    </div>
                    <div class="col-md-6">	
                        <input type="text" class="form-control" name="nombre_legal"  placeholder="Nombre Legal" value="<?php echo (isset($row->nombre_legal))?$row->nombre_legal:''?>" <?php echo (isset($row->nombre_legal))?'readonly="readonly"':''?>  require/>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Nombre comercial *</b>
                    </div>
                    <div class="col-md-6">	
                        <input type="text" class="form-control" name="nombre_comercial"  placeholder="Nombre comercial" value="<?php echo (isset($row->nombre_comercial))?$row->nombre_comercial:''?>" require  />
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Nombre Representante Legal *</b>
                    </div>
                    <div class="col-md-6">	
                        <input type="text" class="form-control" name="nombre_representante_legal"  placeholder="Nombre Representante Legal" value="<?php echo (isset($row->nombre_representante_legal))?$row->nombre_representante_legal:''?>" require  />
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Número Idenficación *</b>
                    </div>
                    <div class="col-md-6">	
                        <input type="text" class="form-control" name="nro_identificacion_representante_legal"  placeholder="Número Idenficación Representante Legal" value="<?php echo (isset($row->nro_identificacion_representante_legal))?$row->nro_identificacion_representante_legal:''?>" require  />
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Ciudad de Expedición *</b>
                    </div>
                    <div class="col-md-6">	
                    	<?php echo expedicion($row,"ciudad_expedicion_legal",'Ciudad de Expedición',$require=true);?>
                    </div>
                </div>
                <div class="row form-group">
                	<div class="col-md-12 text-center">
	                	<h5 class="col-md-12">Información de Contacto</h5>
                    </div>
                </div>
                <?php
                	echo direccion($row);
				?>
                <div class="row form-group">
	                <div class="col-md-3 text-right">	
                    	<b>Teléfono Móvil *</b>
                    </div>
                    <div class="col-md-3">	
	                    <div class="input-group input-group-sm">
	                        <input type="text" class="form-control col-md-3" name="cod_telefono" maxlength="3"  value="<?php echo (isset($row->cod_telefono))?$row->cod_telefono:''?>" require />
                        	<input type="text" class="form-control col-md-9" name="telefono"  maxlength="10"  value="<?php echo (isset($row->telefono))?$row->telefono:''?>" require />                            
                        </div>
                    </div>
                    <div class="col-md-3 text-right">	
                    	<b>Otro Teléfono</b>
                    </div>
                    <div class="col-md-3">	
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control col-md-3" name="cod_otro_telefono" maxlength="3" value="<?php echo (isset($row->cod_otro_telefono))?$row->cod_otro_telefono:''?>" />
                            <input type="text" class="form-control col-md-9" name="otro_telefono"  maxlength="10" value="<?php echo (isset($row->otro_telefono))?$row->otro_telefono:''?>" />                            
                        </div>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-3 text-right">	
                    	<b>Correo Electrónico *</b>
                    </div>
                    <div class="col-md-3">	
						<input type="text" class="form-control" name="email" maxlength="100" value="<?php echo (isset($row->email))?$row->email:''?>" />
                    </div>
                    <div class="col-md-3 text-right">	
                    	<b><i class="fa fa-skype" aria-hidden="true"></i> Skype</b>
                    </div>
                    <div class="col-md-3">	
						<input type="text" class="form-control" name="skype"  maxlength="100" value="<?php echo (isset($row->skype))?$row->skype:''?>"/>                            
                    </div>
                </div>
                <div class="row form-group item">
	                <div class="col-md-3 text-right">	
                    	<b><i class="fa fa-facebook-official" aria-hidden="true"></i> Facebook</b>
                    </div>
                    <div class="col-md-3">	
						<input type="text" class="form-control" name="facebook" maxlength="300" value="<?php echo (isset($row->facebook))?$row->facebook:''?>" />
                    </div>
                    <div class="col-md-3 text-right">	
                    	<b><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</b>
                    </div>
                    <div class="col-md-3">	
						<input type="text" class="form-control" name="twitter"  maxlength="300"  value="<?php echo (isset($row->twitter))?$row->twitter:''?>"/>                            
                    </div>
                </div>
                <div class="row form-group ">
	                <div class="col-md-3 text-right">	
                    	<b>Persona Contacto *</b>
                    </div>
                    <div class="col-md-3">	
                        <input type="text" class="form-control" name="persona_contacto" value="<?php echo (isset($row->persona_contacto))?$row->persona_contacto:''?>" require />
                    </div>
                    <div class="col-md-3 text-right">	
                    	<b>Rol / Cargo *</b>
                    </div>
                    <div class="col-md-3">	
                        <input type="text" class="form-control" name="rol_cargo" value="<?php echo (isset($row->rol_cargo))?$row->rol_cargo:''?>" require />
                    </div>
                </div>
                <div class="row form-group item">
	                <div class="col-md-6 text-right">	
                    	<b>Website</b>
                    </div>
                    <div class="col-md-6">	
                        <input type="text" class="form-control" name="website" value="<?php echo (isset($row->website))?$row->website:''?>"  />
                    </div>
				</div>
                <div class="row form-group">
                	<div class="col-md-12 text-center">
	                	<h5 class="col-md-12">Configuración</h5>
                    </div>
               </div>
               <div class="row form-group item">
	                <div class="col-md-6 text-right">	
                    	<b>¿Sistema Salarial? *</b>
                    </div>
                    <div class="col-md-3">	
                        <?php echo MakeSiNo("sistema_salarial",(isset($row->sistema_salarial))?$row->sistema_salarial:NULL,array("class"=>"form-control","require"=>"require"));?>
                    </div>
				</div>
               <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Período de Pago *</b>
                    </div>
                    <div class="col-md-6">	
                       <?php 	
							echo MakePeriodoPagos("periodo_pagos",(isset($row->periodo_pagos))?$row->periodo_pagos:NULL,array("class"=>"form-control","id"=>"periodo_pagos","require"=>"require"));
						?> 
                    </div>
                </div>
				<div class="row form-group item">
	                <div class="col-md-6 text-right">	
                    	<b>Estado del Perfil</b>
                    </div>
                    <div class="col-md-6">	
                        <?php echo MakeEstado("estado",(isset($row->estado))?$row->estado:NULL,array("class"=>"form-control"));?>
                    </div>
				</div> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>                        
                    </div>
                </div>                   
			</div>
        </div>
    </div>
</div>
<?php echo form_close();?>