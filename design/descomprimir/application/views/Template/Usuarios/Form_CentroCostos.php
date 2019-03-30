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
echo form_open(current_url(),array('ajaxing' => 'true'),$hidden);	?>
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
					   		if(@$row->principal==1){
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
                                if(!isset($row->cod_telefono)|| $this->user->type=='root'){set_input("cod_telefono",$row,$placeholder='',$require=true," col-md-3 ",array("maxlength"=>"3"));}
                                else{?><h5>(<?php echo $row->cod_telefono;?>) </h5><?php }
                            ?>
                            <?php 	
                                if(!isset($row->telefono)|| $this->user->type=='root'){set_input("telefono",$row,$placeholder='Teléfono',$require=true," col-md-9 ",array("maxlength"=>"10"));}
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
                                if(!isset($row->cod_otro_telefono)|| $this->user->type=='root'){set_input("cod_otro_telefono",$row,$placeholder='',""," col-md-3 ",array("maxlength"=>"3"));}
                                else{?><h5>(<?php echo @$row->cod_otro_telefono;?>) </h5><?php }
                            ?>
                            <?php 	
                                if(!isset($row->otro_telefono)|| $this->user->type=='root'){set_input("otro_telefono",$row,$placeholder='',""," col-md-9 ",array("maxlength"=>"10"));}
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
                        </div>                        
                    </div>
                </div>                   
			</div>
        </div>
    </div>
</div>
<?php echo form_close();?>