<?php
/* 
	DESARROLLO Y PROGRAMACIÓN
	PROGRAMANDOWEB.NET
	LCDO. JORGE MENDEZ
	info@programandoweb.net
*/?>
<?php 
$modulo		=	$this->ModuloActivo;
$row		=	$this->$modulo->roles;
$hidden 	= 	array('rol_id' => (isset($row->rol_id))?$row->rol_id:'',"redirect"=>base_url("Usuarios/Roles"));
echo form_open(current_url(),array('ajaxing' => 'true'),$hidden);	?>
<div class="container" style="margin-bottom:100px;">
	
	<div class="row justify-content-md-center">
    	<div class="col-md-8">
        	<div class="form">
	            <div class="row form-group item">
	                <div class="col-md-12 text-center">
		            	<h3>Estructura de Rol</h3>
                    </div>
                </div>
                <div class="row form-group">
	                <div class="col-md-6 text-right">	
                    	<b>Rol *</b>
                    </div>
                    <div class="col-md-6">	
                        <?php 
							//echo '<pre>';print_r($this->roles_modulos_nietos);echo '</pre>';
							set_input("rol",$row,$placeholder='Rol',$require=true);
							$roles		=	json_decode(@$row->json);
							$roles_edit	=	json_decode(@$row->json_edit);
							$roles_add	=	json_decode(@$row->json_add);
						?>
                    </div>
				</div> 
                <div class="row form-group">
                	<?php foreach($this->roles_modulos_padre as $v){?>
                        <div class="col-md-12 text-left">
                        	<h4><?php echo $v->modulo?></h4>
                            <div class="row" style="margin-bottom:20px; border-bottom:3px #e3e3e3 solid;">	
								<?php 
                                    foreach($this->roles_modulos_hijos[$v->id] as $k2 => $v2){
                                        foreach($v2 as $k3=>$v3){
                                            ?>
                                                <div class="col-md-3 text-left"><h6> <?php echo $v3->modulo?> <i class="fa fa-chevron-right" aria-hidden="true"></i></h6></div>
                                                <div class="col-md-9 text-left" style="margin-bottom:20px;" >
                                                	<?php
														#print_r($roles_edit);
														foreach($this->roles_modulos_nietos[$v3->id] as $k4 => $v4){
															//echo '<pre>';print_r($v4);echo '</pre>';
														?>	<div class="row">
	                                                        	<div class="col-md-3 text-right">
                                                                	<h6><?php echo $v4->modulo;?></h6>
                                                                </div>
                                                                <div class="col-md-3 text-center">
                                                                	<i class="fa fa-search" aria-hidden="true"></i>
                                                                	<label class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input " name="roles_search[]"  value="<?php echo $v4->id;?>" <?php if(is_array($roles)){echo (array_search($v4->id,$roles)===false)?'':'checked="checked"';}?>>
                                                                        <span class="custom-control-indicator"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-3 text-center">
                                                                	<i class="fa fa-pencil" aria-hidden="true"></i>
                                                                	<label class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input " name="roles_edit[]"  value="<?php echo $v4->id;?>" <?php if(is_array($roles_edit)){echo (array_search($v4->id,$roles_edit)===false)?'':'checked="checked"';}?>>
                                                                        <span class="custom-control-indicator"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-3 text-center">
                                                                	<i class="fa fa-plus" aria-hidden="true"></i>
                                                                	<label class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input " name="roles_add[]"  value="<?php echo $v4->id;?>" <?php if(is_array($roles_add)){echo (array_search($v4->id,$roles_add)===false)?'':'checked="checked"';}?>>
                                                                        <span class="custom-control-indicator"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
														<?php                                                            
														}
														
													?>
                                                </div>
                                            <?php
                                        }									
                                    }
                                ?>    
                            </div>
                        </div>
                    <?php }?>
				</div>                    
                <div class="row form-group item">
	                <div class="col-md-6 text-right">	
                    	<b>Estado del Rol</b>
                    </div>
                    <div class="col-md-3">	
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