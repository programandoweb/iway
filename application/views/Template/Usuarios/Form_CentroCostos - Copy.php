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
$hidden 	= 	array('type'=>$this->uri->segment(3),'user_id' => (isset($row->user_id))?$row->user_id:'',"redirect"=>base_url("Usuarios/Todos/".$this->uri->segment(3)));
echo form_open(current_url(),array('ajax' => 'true'),$hidden);	?>
<div class="container" style="margin-bottom:100px;">
	
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Información Básica Sucursales</h3>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Empresa *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php 	
                            if(!isset($row->id_empresa) ){
                        ?>
	                    <div class="input-group">
	                        <?php  echo MakeUsers("id_empresa",@$row->id_empresa,array("class"=>"form-control","require"=>"require"),$this->dep_users);?>
                        </div>
                        <?php	
                            }else{
                        ?>
                             <h5>
							 	<?php 
							 		//$row->id_empresa;
									$empresa	=	centrodecostos($row->id_empresa);	
									echo $empresa->nombre_comercial;
								?>
							</h5>
                        <?php		
                            }
                        ?>		
                    </div>
				</div> 
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Rol *</b>
                    </div>
                    <div class="col-md-6">	
                       <?php 
					   		if($row->principal==1){
								echo 'Empresa';	
						?>	
                        		<input type="hidden" value="12" name="rol_id" />
                        <?php	
							}else{
						?>			
                        		<input type="hidden" value="16" name="rol_id" />
                        <?php		
								echo 'Sucursal';	
							}
							//echo MakeRoles("rol_id",(isset($row->rol_id))?$row->rol_id:NULL,array("class"=>"form-control","id"=>"periodo_pagos","require"=>"require"));
						?> 
                    </div>
                </div>                   
                <div class="row form-group">
                    <div class="col-md-6 text-right">	
                    	<b>Código *</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php 	
                            if(!isset($row->abreviacion) || $row->abreviacion=='DEF'){
                        ?>
                             <div class="input-group">
                                <input type="text" name="abreviacion" class="form-control" placeholder="Código" aria-describedby="btnGroupAddon" value="<?php echo (isset($row->abreviacion))?$row->abreviacion:''?>"  maxlength="3" require>
                                <span class="input-group-addon" id="btnGroupAddon"><i class="fa fa-code" aria-hidden="true"></i></span>
                            </div>				
                        <?php	
                            }else{
                        ?>
                            <h5><?php echo $row->abreviacion;?></h5>
                        <?php		
                            }
                        ?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6 text-right">	
                    	<b>Nombre Sucursal *</b>
                    </div>
                    <div class="col-md-6">	
	                    <?php 	
                            if(!isset($row->nombre_legal) || $this->user->type=='root'){
                        ?>
	                    <?php set_input("nombre_legal",$row,$placeholder='Nombre de Sucursal',$require=true,'',array("aria-describedby"=>"btnGroupAddon","maxlength"=>"80"));?>
                        <?php
							}else{
						?>
                        	<h5><?php echo $row->nombre_legal;?></h5>
                        <?php		
							}
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
							//if(!isset($row->tipo_identificacion)){
							if(1==1){
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
                                    <input type="text" class="form-control col-md-9" name="identificacion" id="identificacion"  placeholder="Número de Identificación" maxlength="12" value="<?php echo (isset($row->identificacion))?$row->identificacion:''?>" <?php echo (isset($row->identificacion))?'':''?> require />
                                    <input type="text" class="form-control col-md-3" name="identificacion_ext" id="identificacion_ext"  placeholder="DV" maxlength="1" value="<?php echo (isset($row->identificacion_ext))?$row->identificacion_ext:''?>" <?php echo (isset($row->identificacion_ext))?'':''?> />
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
                        <input type="text" class="form-control" name="nombre_legal"  placeholder="Nombre Legal" value="<?php echo (isset($row->nombre_legal))?$row->nombre_legal:''?>" <?php echo (isset($row->nombre_legal))?'':''?>  require/>
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
                        <input type="text" class="form-control" name="ciudad_expedicion_legal"  placeholder="Ciudad de Expedición" value="<?php echo (isset($row->ciudad_expedicion_legal))?$row->ciudad_expedicion_legal:''?>" require  />
                    </div>
                </div>
                <div class="row form-group">
                	<div class="col-md-12 text-center">
	                	<h5 class="col-md-12">Configuración</h5>
                    </div>
                </div>
                <div class="row form-group" style="background-color:#f9f9f9; padding:10px;">
                	<div class="col-md-3 text-center">
						<h6 class="">Mañana</h6>
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input " name="turno_manama" value="1" <?php echo (isset($row->turno_manama)&& $row->turno_manama==1)?'checked="checked"':''?>>
                            <span class="custom-control-indicator"></span>
                        </label>
                    </div>
                    <div class="col-md-3 text-center">
						<h6 class="">Tarde</h6>
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input " name="turno_tarde" value="1" <?php echo (isset($row->turno_tarde)&& $row->turno_tarde==1)?'checked="checked"':''?>>
                            <span class="custom-control-indicator"></span>
                        </label>
                    </div>
                    <div class="col-md-3 text-center">
						<h6 class="">Noche</h6>
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input " name="turno_noche" value="1" <?php echo (isset($row->turno_noche)&& $row->turno_noche==1)?'checked="checked"':''?>>
                            <span class="custom-control-indicator"></span>
                        </label>
                    </div>
                    <div class="col-md-3 text-center">
						<h6 class="">Intermedio</h6>
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input " name="turno_intermedio" value="1" <?php echo (isset($row->turno_intermedio)&& $row->turno_intermedio==1)?'checked="checked"':''?>>
                            <span class="custom-control-indicator"></span>
                        </label>
                    </div>
               </div>
                <div class="row form-group">                    
                    <div class="col-md-6 text-right">	
                    	<b>No. Rooms *</b>
                    </div>
                    <div class="col-md-6">	
                   		<?php 	
                            if(!isset($row->n_rooms) || $this->user->type=='root'){
                        ?>
                        <?php set_input("n_rooms",$row,$placeholder='No. Rooms',$require=true);?>
                        <?php	
                            }else{
                        ?>
                             <h5><?php echo $row->n_rooms;?></h5>
                        <?php		
                            }
                        ?>	
	                    
                    </div>
                </div>
                <?php
                	echo direccion($row);
				?>
                <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Información de Contacto</h3>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-3 text-right">	
                    	<b>Teléfono / Móvil *</b>
                    </div>
                    <div class="col-md-3">	
	                    <div class="input-group input-group-sm">
                        
                        	<?php 	
                                if(!isset($row->cod_telefono)|| $this->user->type=='root'){set_input("cod_telefono",$row,$placeholder='',$require=true," col-md-3 salto",array("maxlength"=>"3","data-salto"=>"telefono"));}
                                else{?><h5>(<?php echo $row->cod_telefono;?>) </h5><?php }
                            ?>
                            <?php 	
                                if(!isset($row->telefono)|| $this->user->type=='root'){set_input("telefono",$row,$placeholder='Teléfono',$require=true," col-md-9 ",array("maxlength"=>"10","data-salto"=>"end"));}
                                else{?><h5><?php echo $row->telefono;?></h5><?php }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3 text-right">	
                    	<b>Número Fijo</b>
                    </div>
                    <div class="col-md-3">	
                        <div class="input-group input-group-sm">
	                        <?php 	
                                if(!isset($row->cod_otro_telefono)|| $this->user->type=='root'){set_input("cod_otro_telefono",$row,$placeholder='',""," col-md-3 salto",array("maxlength"=>"3","data-salto"=>"otro_telefono"));}
                                else{?><h5>(<?php echo @$row->cod_otro_telefono;?>) </h5><?php }
                            ?>
                            <?php 	
                                if(!isset($row->otro_telefono)|| $this->user->type=='root'){set_input("otro_telefono",$row,$placeholder='',""," col-md-9 ",array("maxlength"=>"10","data-salto"=>"end"));}
                                else{?><h5><?php echo @$row->otro_telefono;?></h5><?php }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Correo Electrónico *</b>
                    </div>
                    <div class="col-md-6">	
                    	<?php 	
                            if(!isset($row->email)|| $this->user->type=='root'){
                        ?>
						<?php set_input("email",$row,$placeholder='Correo Electrónico',$require=true);?>
                        <?php	
                            }else{
                        ?>
                             <h5><?php echo $row->email;?></h5>
                        <?php		
                            }
                        ?>	
                    </div>
                </div>
                
                <div class="row form-group item">
	                <div class="col-md-6 text-right">	
                    	<b>Estado del Perfil</b>
                    </div>
                    <div class="col-md-3">	
                        <?php echo MakeEstado("estado",(isset($row->estado))?$row->estado:NULL,array("class"=>"form-control","require"=>"require"));?>
                    </div>
				</div> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a class="btn btn-warning" href="<?php echo base_url("Usuarios/Todos/".$this->uri->segment(3));?>"><i class="fas fa-times"></i> Cerrar y Volver</a>
                        </div>                        
                    </div>
                </div>                   
			</div>
        </div>
    </div>
</div>
<?php echo form_close();?>