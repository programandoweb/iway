<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php 
$modulo		=	$this->ModuloActivo;
//echo $modulo;return;
$row		=	$this->$modulo->result;
$hidden = array('id_esquema' => (isset($row->id_esquema))?$row->id_esquema:'',"redirect"=>base_url("Departamentos"));
echo form_open(current_url(),array('ajax' => 'true'),$hidden);	?>
<div class="container">
	
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
	        <div class="form">
                <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Centro de costo</h3>
                    </div>
                </div>
                <div class="row form-group item">
                	<div class="col-md-2 text-right">	
                    	<b>Empresa *</b>
                    </div>
                    <div class="col-md-4">	
                    	<?php 	
                            if(!isset($row->persona_contacto)){
                        ?>
	                    <div class="input-group">
	                        <?php  echo MakeUsers("id_empresa",@$row->id_empresa,array("class"=>"form-control","require"=>"require"),$this->users);?>
                        </div>
                        <?php	
                            }else{
                        ?>
                             <h5><?php echo $row->persona_contacto;?></h5>
                        <?php		
                            }
                        ?>				
                    </div>
                    <div class="col-md-2 text-right">	
                    	<b>Código *</b>
                    </div>
                    <div class="col-md-4">	
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
                <div class="row form-group item">  
                	<div class="col-md-2 text-right">	
                    	<b>Sucursal *</b>
                    </div>                
                    <div class="col-md-4">	
                    	<?php 	
                            if(!isset($row->nombre_legal)){
                        ?>
                            <div class="input-group">
                                <input type="text" name="" class="form-control" placeholder="Nombre de la Sucursal" aria-describedby="btnGroupAddon" value="<?php echo (isset($row->nombre))?$row->nombre:''?>" require>
                                <?php 	set_input("nombre_legal",$row,$placeholder='Sucursal',$require=true);?>
                                <span class="input-group-addon" id="btnGroupAddon"><i class="fa fa-id-badge" aria-hidden="true"></i></span>
                            </div>				
                        <?php	
                            }else{
                        ?>
                            <h5><?php echo $row->nombre;?></h5>
                        <?php		
                            }
                        ?>
                        				
                    </div>
                    <div class="col-md-3 text-right">	
                    	<b>No. Rooms *</b>
                    </div>
                    <div class="col-md-3">	
                    	<?php 	
                            if(!isset($row->n_rooms)){
                        ?>
	                    <div class="input-group">
                         	
                        </div>
                        <?php	
                            }else{
                        ?>
                             <h5><?php echo $row->n_rooms;?></h5>
                        <?php		
                            }
                        ?>		
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-2 text-right">	
                    	<b>Dirección *</b>
                    </div>
                    <div class="col-md-9">	
                    	<?php 	
								if(!isset($row->direccion)){set_input("direccion",$row,$placeholder='Dirección',$require=true,"  ",array("maxlength"=>"200"));}
								else{?><h5><?php echo $row->direccion;?></h5><?php }
						?>	
                    </div>
                    <div class="row  sub-item">
                    	<div class="col-md-12">
                            <div class="input-group input-group-md" style="padding:15px;">
								<?php 	
										if(!isset($row->ciudad)){set_input("ciudad",$row,$placeholder='Ciudad',$require=true," col-md-3 ",array("maxlength"=>"50"));}
										else{?><h5 class="col-md-3"><?php echo $row->ciudad;?></h5><?php }
								?>	
                                <?php 	
										if(!isset($row->departamento)){set_input("departamento",$row,$placeholder='Departamento',$require=true," col-md-3 ",array("maxlength"=>"50"));}
										else{?><h5 class="col-md-3"><?php echo $row->departamento;?></h5><?php }
								?>	
                                <?php 	
										if(!isset($row->codigo_postal)){set_input("codigo_postal",$row,$placeholder='Código Postal',$require=true," col-md-2 ",array("maxlength"=>"10"));}
										else{?><h5 class="col-md-4"><?php echo $row->departamento;?></h5><?php }
								?>	
								<?php 	
										if(!isset($row->pais)){set_input("pais",$row,$placeholder='País',$require=true," col-md-4 ",array("maxlength"=>"20"));}
										else{?><h5 class="col-md-2"><?php echo $row->pais;?></h5><?php }
								?>	
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-3 text-right">	
                    	<b>Teléfono / Móvil *</b>
                    </div>
                    <div class="col-md-3">	
	                    <div class="input-group input-group-sm">
							<?php 	
                                if(!isset($row->cod_telefono)){set_input("cod_telefono",$row,$placeholder='',$require=true," col-md-3 ",array("maxlength"=>"3"));}
                                else{?><h5>(<?php echo $row->cod_telefono;?>) </h5><?php }
                            ?>
                            <?php 	
                                if(!isset($row->telefono)){set_input("telefono",$row,$placeholder='Teléfono',$require=true," col-md-9 ",array("maxlength"=>"10"));}
                                else{?><h5><?php echo $row->telefono;?></h5><?php }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3 text-right">	
                    	<b>Otro Teléfono</b>
                    </div>
                    <div class="col-md-3">	
                        <div class="input-group input-group-sm">
	                        <?php 	
                                if(!isset($row->cod_otro_telefono) && $row->cod_otro_telefono=='0'){set_input("cod_otro_telefono",$row,$placeholder='Teléfono',$require=true," col-md-3 ",array("maxlength"=>"3"));}
                                else{?><h5>(<?php echo $row->cod_otro_telefono;?>) </h5><?php }
                            ?>
                            <?php 	
                                if(!isset($row->otro_telefono)&& $row->otro_telefono=='0'){set_input("otro_telefono",$row,$placeholder='',$require=true," col-md-9 ",array("maxlength"=>"10"));}
                                else{?><h5><?php echo $row->otro_telefono;?></h5><?php }
                            ?>
                        </div>
                    </div>
                </div>
				<div class="row form-group item">   
                     <div class="col-md-6">	
                        <?php echo MakeEstado("estado",(isset($row->estado))?$row->estado:NULL,array("class"=>"form-control"));?>
                    </div>
				</div>                    
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a class="btn btn-warning" href="<?php echo base_url($this->uri->segment(1));?>">Cerrar y Volver</a>
                        </div>                        
                    </div>
                </div>            
			</div>                
        </div>
    </div>
</div>
<?php echo form_close();?>
